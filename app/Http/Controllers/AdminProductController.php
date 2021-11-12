<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\ProductAddRequest;
use App\Components\Recursive;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\ProductSize;


use App\Models\ProductTag;
use App\Models\ProductImage;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\DB;
use App\Components\Google_Client;
use Google_Service_Drive;

use Storage;

class AdminProductController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    protected $client; 
    public function __construct(Category $category,Product $product,ProductImage $productImage,Tag $tag,ProductTag $productTag,Google_Client $client){
        $this->category = $category;
        $this->product=$product;
        $this->productImage=$productImage;
        $this->tag=$tag;
        $this->productTag=$productTag;
        $this->client = $client->getClient();
    }

    const DRIVE_CONFIG_URL = ' https://docs.google.com/uc?id=';

    public function index(){
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index',compact('products'));
    }
    public function getCategory($parent_id){
        //load tu db ra
        $data = $this->category->all();
        //
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecursive($parent_id);
        return $htmlOption;
     }


    public function create(){
        $htmlOption = $this->getCategory('');

        return view('admin.product.add',compact('htmlOption'));
    }
    public function store(ProductAddRequest $request){
        try{
        //dung` method all() cung~ dc.
        DB::beginTransaction();
        $dataProductCreate = [
            'name'=>$request->name,
            'price'=>$request->price,
            'content'=>$request->content,
            'user_id' => auth()->id(),
            'category_id' => $request->parent_id,
            'views_count' => 0
        ]; 

        $feature_image_path = "";
        if ($request->hasFile('feature_image_path')) {
            $name = $this->getImageID($request->file('feature_image_path'));
            $dataProductCreate['feature_image_name'] = $name['file_name'];
            $dataProductCreate['feature_image_path'] = self::DRIVE_CONFIG_URL.$name['file_path'];
        }
        $product = $this->product->create($dataProductCreate);

        //insert data to product_images
        if($request->hasFile('image_path')){
            foreach($request->image_path as $fileItem){
                $image = $this->getImageID($fileItem);
                $product -> images()->create([
                    'image_path' => self::DRIVE_CONFIG_URL.$image['file_path'],
                    'image_name' => $image['file_name'],
                ]);
                
            }
        }

        //insert data to product_sizes
        if($request->sizes != null){
            foreach($request->sizes as $size){
                $product->productSizes()->create([
                    'size' => $size,
                    'quantity' => 10
                ]);
            }
        }

        $tagIds = [];
        if(!empty($request->tags)){
            //insert tags for product
            foreach($request->tags as $tagItem){
                //insert to tags
                $tagInstance =  $this->tag->firstOrCreate(['name' => $tagItem]);
                $tagIds[] = $tagInstance->id;
            }
        }
        $product->tags()->attach($tagIds);

        DB::commit();
        return redirect()->route('product.index');
    }catch(Exception $exception){
        DB::rollBack();
        Log::error('Message: '.$exception->getMessage(). 'Line: '.$exception->getLine());
    }
    }

    private function getImageID($image)
    {
        $driveService = new Google_Service_Drive($this->client);

        try {
            $fileMetadata = new \Google_Service_Drive_DriveFile([
                'name' => time().'.'.$image->getClientOriginalExtension(),
            ]);
            $file = $driveService->files->create($fileMetadata, [
                'data' => file_get_contents($image->getRealPath()),
                'uploadType' => 'multipart',
                'fields' => 'id',
            ]);
            // bắt đầu phân quyền
            $driveService->getClient()->setUseBatch(true);
    
            try {
                $batch = $driveService->createBatch();
                $userPermission = new \Google_Service_Drive_Permission([
                    //dành cho mọi người
                    'type' => 'anyone', // user | group | domain | anyone
                    // và chỉ được quyền xem
                    'role' => 'reader', // organizer | owner | writer | commenter | reader
                ]);
                $request = $driveService->permissions->create($file->id, $userPermission, ['fields' => 'id']);
                $batch->add($request, 'user');
                $results = $batch->execute();
            } catch (\Exception $e) {
    
            } finally {
                $driveService->getClient()->setUseBatch(false);
            }
            
            return [
                'file_path' => $file->id,
                'file_name' => $image->getClientOriginalName()
            ];
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function edit(Request $request){
        $product = $this->product->find($request->id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit',compact('product','htmlOption'));
    }
    public function update(Request $request,$id){
        try{
            //dung` method all() cung~ dc.
            DB::beginTransaction();
            $dataProductUpdate = [
                'name'=>$request->name,
                'price'=>$request->price,
                'content'=>$request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->parent_id,
            ]; 


            
            if ($request->hasFile('feature_image_path')) {
                $name = $this->getImageID($request->file('feature_image_path'));
                $dataProductUpdate['feature_image_name'] = $name['file_name'];
                $dataProductUpdate['feature_image_path'] = self::DRIVE_CONFIG_URL.$name['file_path'];
            }

            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);
            //insert data to product_images
            if($request->hasFile('image_path')){
                $this->productImage->where('product_id',$id)->delete();
                foreach($request->image_path as $fileItem){
                    $dataProductImageDetail = $this->getImageID($fileItem);
                    $product -> images()->create([
                        'image_path' =>self::DRIVE_CONFIG_URL.$dataProductImageDetail['file_path'],
                        'image_name' =>$dataProductImageDetail['file_name'],
                    ]);
                    
                }
            }
    
            $tagIds = [];
            if(!empty($request->tags)){
                //insert tags for product
                foreach($request->tags as $tagItem){
                    //insert to tags
                    $tagInstance =  $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->tags()->sync($tagIds);
    
            DB::commit();
            return redirect()->route('product.index');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error('Message: '.$exception->getMessage(). 'Line: '.$exception->getLine());
        }
    }

    public function delete($id){
        return $this->deleteModelTrait($id,$this->product);
    }
}

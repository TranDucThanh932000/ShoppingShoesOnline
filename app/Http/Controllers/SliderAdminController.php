<?php

namespace App\Http\Controllers;
use App\Http\Requests\SliderAddRequest;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use App\Components\Google_Client;
use Google_Service_Drive;
use Storage;

class SliderAdminController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;
    private $slider;
    protected $client; 

    public function __construct(Slider $slider,Google_Client $client){
        $this->slider = $slider;
        $this->client = $client->getClient();
    }

    const DRIVE_CONFIG_URL = ' https://docs.google.com/uc?id=';


    public function index(){
        $sliders = $this->slider->latest()->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }
    public function create(){
        return view('admin.slider.add');
    }
    public function store(SliderAddRequest $request){
        try{
            $dataInsert = [
                'name' => $request->name,
                'description' => $request->description
            ];
            if($request->hasFile('image_path')){
                $dataImageSlider = $this->getImageID($request->file('image_path'));
            }
        
            if(!empty($dataImageSlider)){
                $dataInsert['image_name'] = $dataImageSlider['file_name'];
                $dataInsert['image_path'] = self::DRIVE_CONFIG_URL.$dataImageSlider['file_path'];
            }
            $this->slider->create($dataInsert);
    
            return redirect()->route('slider.index');
        }catch(Exception $exception){
            Log::error("Lỗi : ". $exception->getMessage() . '---Line: ' .$exception->getLine());
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
            
            //return $file->id . 'LKC' . $fileMetadata->name;
            return [
                'file_path' => $file->id,
                'file_name' => $image->getClientOriginalName()
            ];
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function edit($id){
        $slider = $this->slider->find($id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function update(SliderAddRequest $request,$id){
        try{
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description
            ];
            if($request->hasFile('image_path')){
                $dataImageSlider = $this->getImageID($request->file('image_path'));
            }
            if(!empty($dataImageSlider)){
                $dataInsert['image_name'] = $dataImageSlider['file_name'];
                $dataInsert['image_path'] = self::DRIVE_CONFIG_URL.$dataImageSlider['file_path'];
            }
            $this->slider->find($id)->update($dataUpdate);
    
            return redirect()->route('slider.index');
        }catch(Exception $exception){
            Log::error("Lỗi : ". $exception->getMessage() . '---Line: ' .$exception->getLine());
        }
    }
    public function delete($id){    
        return $this->deleteModelTrait($id,$this->slider);
    }
}

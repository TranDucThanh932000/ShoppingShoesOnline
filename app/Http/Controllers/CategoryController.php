<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Components\Recursive;


class CategoryController extends Controller
{

     private $category;
     public function __construct(Category $category){
        $this->category = $category;
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
        return view('admin.category.add',compact('htmlOption'));
     }


   public function indexGuest($slug,$categoryId){
      $categories = Category::where('parent_id',0)->get();
      $categoriesLimit = Category::where('parent_id',0)->take(3)->get();
      $products = Product::where('category_id',$categoryId)->paginate(6);

     return view('product.category.list',compact('categories','categoriesLimit','products'));
   }


    public function index(){
         $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index',compact('categories'));
    }

    public function store(Request $request){
       $this->category->create([
          'name' => $request->name,
          'parent_id' => $request->parent_id,
          'slug' => str_slug($request->name),
       ]);
       return redirect()->route('categories.index');
    }



    public function edit($id){
      $category = $this->category->find($id);
      $htmlOption = $this->getCategory($category->parent_id);
      
      return view('admin.category.edit',compact('category','htmlOption'));
    }

    public function update($id,Request $request){
       $this->category->find($id) ->update([
         'name' => $request->name,
         'parent_id' => $request->parent_id,
         'slug' => str_slug($request->name),
      ]);
       return redirect()->route('categories.index');
    }

    public function delete($id){
      $this->category->find($id)->delete();
      return redirect()->route('categories.index');
    }
}

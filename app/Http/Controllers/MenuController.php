<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Components\MenuRecursive;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    private $menuRecursive;
    private $menu;
    public function __construct(MenuRecursive $menuRecursive,Menu $menu){
        $this->menuRecursive = $menuRecursive;
        $this->menu = $menu;
    }

    public function index(){
        $menus = $this->menu->paginate(10); 
        return view('admin.menus.index',compact('menus'));
    }

    public function create(){
        $optionSelect = $this->menuRecursive -> menuRecursiveAdd();
        return view('admin.menus.add',compact('optionSelect'));
    }

    public function store(Request $request){
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name),
        ]);
        return redirect() -> route('menus.index',);
    }

    public function edit($id,Request $request){
        $menuFollowIdEdit = $this->menu->find($id);
        $optionSelect = $this->menuRecursive -> menuRecursiveEdit($menuFollowIdEdit->parent_id);

        return view('admin.menus.edit',compact('optionSelect','menuFollowIdEdit'));
    }

    public function update($id,Request $request){
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name),
        ]);
        return redirect() -> route('menus.index',);
    }

    public function delete($id){
        $this->menu->find($id)->delete();
        return redirect()->route('menus.index');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Storage;

class PermissonAdminController extends Controller
{
    

    //permissions
    public function create(){
        return view('admin.permission.add');
    }

    public function store(Request $request){
        $permission = Permission::create([
            'name' => $request->module_parent,
            'display_name' => $request->module_parent,
            'parent_id' => 0,
            'key_code' => ''
        ]);

        foreach($request->module_childrent as $value){
            Permission::create([
                'name' => $value,
                'display_name' => $value,
                'parent_id' => $permission->id,
                'key_code' => $value . '_' .$request->module_parent
            ]);
        }
        return view('admin.permission.add');
    }
}

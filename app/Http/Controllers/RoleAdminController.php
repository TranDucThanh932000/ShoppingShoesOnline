<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Storage;

class RoleAdminController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role,Permission $permission){
        $this->role = $role; 
        $this->permission = $permission; 
    }
    public function index(){
        $roles = $this->role->paginate(10);
        return view('admin.role.index',compact('roles'));
    }
    public function create(){
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        return view('admin.role.add',compact('permissionsParent'));
    }
    public function store(Request $request){
        try{
            $role = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);
            $role->permissions()->attach($request->permission_id);
            return redirect()->route('roles.index');
        }catch(Exception $exception){

        }
    }
    public function edit($id){
        $permissionsParent = $this->permission->where('parent_id',0)->get();
        $role = $this->role->find($id);
        $permissionsChecked = $role->permissions;
        return view('admin.role.edit',compact('permissionsParent','role','permissionsChecked'));
    }
    public function update(Request $request){
        try{
            $this->role->find($request->id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);
            $role = $this->role->find($request->id);
            $role->permissions()->sync($request->permission_id);
            return redirect()->route('roles.index');
        }catch(Exception $exception){

        }
    }


}

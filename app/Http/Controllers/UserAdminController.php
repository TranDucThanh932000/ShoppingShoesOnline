<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Storage;


class UserAdminController extends Controller
{
    use DeleteModelTrait;
    private $user;
    private $role;
    public function __construct(User $user,Role $role){
        $this->user = $user;
        $this->role = $role;
    }
    public function index(){
        $users = $this->user->paginate(10);
        return view('admin.users.index',compact('users'));
    }
    public function create(){
        $roles = $this->role->all();
        return view('admin.users.add',compact('roles'));
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $roleIds = $request->role_id;
            $user->roles()->attach($roleIds);
            //thay vì khi insert quan hệ nhiều nhiều phải insert từng bảng 1 thì dùng cách trên của Eloquin nhanh hơn
            // foreach($roleIds as $roleItem){
            //     DB::table('role_user')->insert([
            //         'role_id'=> $roleItem,
            //         'user_id'=> $user->id
            //     ]);
            // }
            DB::commit();
            return redirect()->route('users.index');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error("Lỗi : ". $exception->getMessage() . '---Line: ' .$exception->getLine());
        }
    }

    public function edit($id){
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $rolesOfUser = $user->roles;
        return view('admin.users.edit',compact('roles','user','rolesOfUser'));
    }

    public function update(Request $request,$id){
        try{
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user = $this->user->find($id);
            $roleIds = $request->role_id;
            $user->roles()->sync($roleIds);
            //thay vì khi insert quan hệ nhiều nhiều phải insert từng bảng 1 thì dùng cách trên của Eloquin nhanh hơn
            // foreach($roleIds as $roleItem){
            //     DB::table('role_user')->insert([
            //         'role_id'=> $roleItem,
            //         'user_id'=> $user->id
            //     ]);
            // }
            DB::commit();
            return redirect()->route('users.index');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error("Lỗi : ". $exception->getMessage() . '---Line: ' .$exception->getLine());
        }
    }

    public function delete($id){
        return $this->deleteModelTrait($id,$this->user);
    }
}

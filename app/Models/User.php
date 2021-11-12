<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'manage',
        'avatar',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }
    public function checkPermissionAccess($permissionCheck){
        //lay cac quyen cua user dang login vao he thong
        $roles = auth()->user()->roles;
        foreach($roles as $role){
            $permissions = $role->permissions;
            //so sanh gia tri dua vao cua route hien tai xem co thuoc khong
            if($permissions->contains('key_code',$permissionCheck)){
                return true;
            }
        }
        return false;
        
    }

    public function feedbacks(){
        return $this->hasMany(Feedback::class,'user_id');
    }
}

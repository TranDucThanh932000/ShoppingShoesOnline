<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Product;
use App\Services\PermissionGateAndPolicyAccess;
use App\Policies\ProductPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $permissionGateAndPolicy = new PermissionGateAndPolicyAccess(); 
        $permissionGateAndPolicy->setGateAndPolicyAccess();

        Gate::define('product-edit',function ($user, $id){
            $product = Product::find($id);
            if($user->checkPermissionAccess('edit_product') && $user->id === $product->user_id){
                return true;
            }
            return false;
        });

        Gate::define('product-delete',function ($user, $id){
            $product = Product::find($id);
            if($user->checkPermissionAccess('delete_product') && $user->id === $product->user_id){
                return true;
            }
            return false;
        });

    }

}

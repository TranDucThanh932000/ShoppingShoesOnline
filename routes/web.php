<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/testapigl','DriveController@index');

Route::POST('/testapiglstore',[
    'as' => 'testapi',
    'uses' => 'DriveController@store'
]);

Route::get('/search',[
    'as' => 'searchproduct',
    'uses' => 'SearchController@searchProduct'
]);

Route::get('/',[
    'as' =>'home.homepage',
    'uses'=>'HomeController@index'
]);

Route::get('/products/add-to-cart/{id}/size/{size}',[
    'as' => 'addToCart',
    'uses' => 'ProductController@addToCart'
]);

Route::get('/products/show-cart',[
    'as' => 'showCart',
    'uses' => 'ProductController@showCart'
]);

Route::get('/products/update-cart',[
    'as' => 'updateCart',
    'uses' => 'ProductController@updateProductCart'
]);

Route::get('/products/delete-cart',[
    'as' => 'deleteProductCart',
    'uses' => 'ProductController@deleteProductFromCart'
]);

Route::get('/feedback',[
    'as' => 'feedbackProduct',
    'uses' => 'ProductController@addFeedback'
]);

Route::get('/feedback/{id}',[
    'as' => 'getFeedbackProduct',
    'uses' => 'ProductController@getFeedback'
]);

Route::get('/products/{id}',[
    'as' => 'showProduct',
    'uses' => 'ProductController@showProduct'
]);

Route::get('/get-star',[
    'as' => 'getStar',
    'uses' => 'ProductController@getStar'
]);


Route::get('/login/{id}',[
    'as' => 'loginForm',
    'uses' => 'AdminController@loginToBack'
]);

Route::get('/login', [
    'as'=>'login',
    'uses'=>'AdminController@loginAdmin'
]);


Route::post('/login', 'AdminController@postLoginAdmin');

Route::get('/logout',[
    'as' => 'logout',
    'uses' => 'AdminController@postLogoutAdmin'
]);

Route::get('/loginShowCart', [
    'as'=>'loginShowCart',
    'uses'=>'AdminController@loginShowCart'
]);

Route::post('/loginShowCart', 'AdminController@postLoginShowCart');

Route::get('/register', [
    'as'=>'register',
    'uses'=>'AdminController@register'
]);

Route::post('/register', 'AdminController@postRegister');

Route::get('/forgot-password',[
    'as' => 'forgot-password',
    'uses' => 'AdminController@forgotPassword'
]);

Route::post('/forgot-password','AdminController@postForgotPassword');

Route::get('/getproductimages/{id}',[ProductController::class,'getImages'])->name('getImages');


Route::get('/homeadmin',function(){
    return view('homeadmin');
})->middleware('auth');

Route::get('/category/{slug}/{id}',[
    'as' => 'category.product',
    'uses' => 'CategoryController@indexGuest' 
]);

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {

        Route::get('/',[
            'as' => 'categories.index',
            'uses' => 'CategoryController@index',
            'middleware' => 'can:category-list'
        ]);
    
        Route::get('/create',[
            'as' => 'categories.create',
            'uses' => 'CategoryController@create',
            'middleware' => 'can:category-add'
        ]);
    
        Route::post('/store',[
            'as' => 'categories.store',
            'uses' => 'CategoryController@store'
        ]);
    
        Route::get('/edit/{id}',[
            'as' => 'categories.edit',
            'uses' => 'CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);
    
        Route::post('/update/{id}',[
            'as' => 'categories.update',
            'uses' => 'CategoryController@update'
        ]);
    
        Route::get('/delete/{id}',[
            'as' => 'categories.delete',
            'uses' => 'CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);
    
    });
    
    Route::prefix('menus')->group(function () {
    
        Route::get('/',[
            'as' => 'menus.index',
            'uses' => 'MenuController@index',
            'middleware' => 'can:menu-list'
        ]);
        Route::get('/create',[
            'as' => 'menus.create',
            'uses' => 'MenuController@create',
            'middleware' => 'can:menu-add'
        ]);
    
        Route::post('/store',[
            'as' => 'menus.store',
            'uses' => 'MenuController@store'
        ]);
    
        Route::get('/edit/{id}',[
            'as' => 'menus.edit',
            'uses' => 'MenuController@edit',
            'middleware' => 'can:menu-edit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'menus.delete',
            'uses' => 'MenuController@delete',
            'middleware' => 'can:menu-delete'
        ]);
    });
    Route::prefix('product')->group(function () {
    
        Route::get('/',[
            'as' => 'product.index',
            'uses' => 'AdminProductController@index',
            'middleware' => 'can:product-list'
        ]);
        Route::get('/create',[
            'as' => 'product.create',
            'uses' => 'AdminProductController@create',
            'middleware' => 'can:product-add'
        ]);
        Route::post('/store',[
            'as' => 'product.store',
            'uses' => 'AdminProductController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'product.edit',
            'uses' => 'AdminProductController@edit',
            'middleware' => 'can:product-edit,id'
        ]);
        Route::post('/update/{id}',[
            'as' => 'product.update',
            'uses' => 'AdminProductController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'product.delete',
            'uses' => 'AdminProductController@delete',
            'middleware' => 'can:product-delete,id'
        ]);
    });

    //Slider
    Route::prefix('slider')->group(function () {
    
        Route::get('/',[
            'as' => 'slider.index',
            'uses' => 'SliderAdminController@index',
            'middleware' => 'can:slider-list'
        ]);
        Route::get('/create',[
            'as' => 'slider.create',
            'uses' => 'SliderAdminController@create',
            'middleware' => 'can:slider-add'
        ]);
        Route::post('/store',[
            'as' => 'slider.store',
            'uses' => 'SliderAdminController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'slider.edit',
            'uses' => 'SliderAdminController@edit',
            'middleware' => 'can:slider-edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'slider.update',
            'uses' => 'SliderAdminController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'slider.delete',
            'uses' => 'SliderAdminController@delete',
            'middleware' => 'can:slider-delete'
        ]);
    });
    //Setting
    Route::prefix('setting')->group(function () {
    
        Route::get('/',[
            'as' => 'setting.index',
            'uses' => 'SettingAdminController@index',
            'middleware' => 'can:setting-list'
        ]);
        Route::get('/create',[
            'as' => 'setting.create',
            'uses' => 'SettingAdminController@create',
            'middleware' => 'can:setting-add'
        ]);
        Route::post('/store',[
            'as' => 'setting.store',
            'uses' => 'SettingAdminController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'setting.edit',
            'uses' => 'SettingAdminController@edit',
            'middleware' => 'can:setting-edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'setting.update',
            'uses' => 'SettingAdminController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'setting.delete',
            'uses' => 'SettingAdminController@delete',
            'middleware' => 'can:setting-delete'
        ]);
    });

    //User
    Route::prefix('users')->group(function () {
    
        Route::get('/',[
            'as' => 'users.index',
            'uses' => 'UserAdminController@index',
            'middleware' => 'can:user-list'
        ]);
        Route::get('/create',[
            'as' => 'users.create',
            'uses' => 'UserAdminController@create',
            'middleware' => 'can:user-add'
        ]);
        Route::post('/store',[
            'as' => 'users.store',
            'uses' => 'UserAdminController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'users.edit',
            'uses' => 'UserAdminController@edit',
            'middleware' => 'can:user-edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'users.update',
            'uses' => 'UserAdminController@update'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'users.delete',
            'uses' => 'UserAdminController@delete',
            'middleware' => 'can:user-delete'
        ]);
    });

    //Role
    Route::prefix('roles')->group(function () {
    
        Route::get('/',[
            'as' => 'roles.index',
            'uses' => 'RoleAdminController@index',
            'middleware' => 'can:role-list'        
        ]);
        Route::get('/create',[
            'as' => 'roles.create',
            'uses' => 'RoleAdminController@create',
            'middleware' => 'can:role-add'
        ]);
        Route::post('/store',[
            'as' => 'roles.store',
            'uses' => 'RoleAdminController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'roles.edit',
            'uses' => 'RoleAdminController@edit',
            'middleware' => 'can:role-edit'
        ]);
        Route::post('/update/{id}',[
            'as' => 'roles.update',
            'uses' => 'RoleAdminController@update'
        ]);
    });


    //Permissions
    Route::prefix('permissions')->group(function () {
    
        Route::get('/create',[
            'as' => 'permissions.create',
            'uses' => 'PermissonAdminController@create'
            //'middleware' => 'can:permission-add'
        ]);

        Route::post('/store',[
            'as' => 'permissions.store',
            'uses' => 'PermissonAdminController@store'
        ]);

    });
});


Route::get('/location/provinces',[LocationController::class,'getProvinces'])->name('getProvinces');
Route::get('/location/province/{province}/districts',[LocationController::class,'getDistricts'])->name('getDistricts');
Route::get('/location/district/{district}/wards',[LocationController::class,'getWards'])->name('getWards');
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/check-email/{email}','AdminController@checkEmail');

//reset password
Route::post('/laravel-send-email', 'EmailController@sendEMail')->name('laravel-send-email');

//
Route::post('/email-shopping-cart', 'EmailController@sendMailCart')->name('send-mail-cart');

Route::get('/redirect-google','Auth\SocialController@redirectGoogle')->name('redirectGoogle');

Route::get('/google_callback','Auth\SocialController@processGoogleLogin');

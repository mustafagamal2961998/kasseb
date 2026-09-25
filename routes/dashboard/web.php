<?php

use App\Http\Controllers\Dashboard\About\AboutController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Banner\BannerController;
use App\Http\Controllers\Dashboard\Brand\BrandController;
use App\Http\Controllers\Dashboard\Category\CategoryController;
use App\Http\Controllers\Dashboard\Childcategory\ChildCategoryController;
use App\Http\Controllers\Dashboard\Contact\ContactController;
use App\Http\Controllers\Dashboard\Coupon\CouponController;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\Offer\OfferController;
use App\Http\Controllers\Dashboard\Order\OrderController;
use App\Http\Controllers\Dashboard\Product\ProductController;
use App\Http\Controllers\Dashboard\Refund\RefundController;
use App\Http\Controllers\Dashboard\Setting\SettingController;
use App\Http\Controllers\Dashboard\Slider\SliderController;
use App\Http\Controllers\Dashboard\Subcategory\SubCategoryController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\Notification\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix'=>'dashboard','as'=>'dashboard.'],function(){
    //auth
    // Route::resource('auth',AuthController::class)->middleware('check_admin_status');
    Route::get('auth',[AuthController::class,'index'])->name('auth.index');
    Route::post('auth/store',[AuthController::class,'store'])->name('auth.store')->middleware('check_admin_status');
    Route::group(['middleware'=>['auth:admin','check_admin_status_on_live']],function(){
            //**************************************************************/
            // home
            Route::resource('home',HomeController::class);
            //**************************************************************/
            // banners
            Route::resource('banners',BannerController::class);
            //**************************************************************/
            // offer
            Route::post('offers/cancel/{id}',[OfferController::class,'cancel'])->name('offers.cancel');
            Route::resource('offers',OfferController::class);
            //**************************************************************/
            // slider
            Route::resource('sliders',SliderController::class);
            //**************************************************************/
            // category
            Route::resource('categories',CategoryController::class);
            //**************************************************************/
            //  subcategory
            Route::resource('subcategories',SubCategoryController::class);
            //**************************************************************/
            //  childcategory
            Route::resource('childcategories',ChildCategoryController::class);
            //**************************************************************/
            //  brands
            Route::resource('brands', BrandController::class);
            //**************************************************************/
            // product
            Route::get('products/archived',[ProductController::class,'archived'])->name('products.archived');
            Route::get('products/out-of-stock',[ProductController::class,'outOfStock'])->name('products.out.of.stock');
            Route::put('products/switch/status/{product}', [ProductController::class, 'productSwitchStatus'])->name('products.switch.status');
            Route::get('product/search',[ProductController::class,'productSearch'])->name('products.search');
            Route::put('product/stock/and/price/{product}',[ProductController::class,'updateStockAndPrice'])->name('products.update.stock.and.price');
            Route::post(
                'products/update-inline',
                [ProductController::class, 'updateInline']
            )->name('products.update.inline');

            
            Route::resource('products',ProductController::class);
            //**************************************************************/
            // users
            Route::get('users/blocked',[UserController::class,'blocked'])->name('users.blocked');
            Route::put('users/switch/status/{user}', [UserController::class, 'userSwitchStatus'])->name('users.switch.status');
            Route::resource('users',UserController::class);
            //**************************************************************/
            // order
            Route::resource('orders',OrderController::class);
            //**************************************************************/
            // refund
            Route::resource('refunds',RefundController::class);
            //**************************************************************/
            // coupon
            Route::resource('coupons',CouponController::class);
            //**************************************************************/
            // contact
            Route::resource('contacts',ContactController::class);
            //**************************************************************/
        
            // about
            Route::resource('abouts',AboutController::class);
            //**************************************************************/
        
            // admin
            Route::resource('admins',AdminController::class);
            //**************************************************************/
        
            // setting
            Route::resource('settings',SettingController::class);
           //**************************************************************/
           // notification
            Route::resource('notifications',NotificationController::class);
        

   });
    

});
<?php

use App\Http\Controllers\User\Api\About\AboutController;
use App\Http\Controllers\User\Api\Address\AddressController;
use App\Http\Controllers\User\Api\Auth\AuthController;
use App\Http\Controllers\User\Api\Banner\BannerController;
use App\Http\Controllers\User\Api\Brand\BrandController;
use App\Http\Controllers\User\Api\Cart\CartController;
use App\Http\Controllers\User\Api\Category\CategoryController;
use App\Http\Controllers\User\Api\Contact\ContactController;
use App\Http\Controllers\User\Api\Offer\OfferController;
use App\Http\Controllers\User\Api\Checkout\CheckoutController;
use App\Http\Controllers\User\Api\ChildCategory\ChildCategoryController;
use App\Http\Controllers\User\Api\Favorite\FavoriteController;
use App\Http\Controllers\User\Api\Order\OrderController;
use App\Http\Controllers\User\Api\Order\RefundRequestController;
use App\Http\Controllers\User\Api\Product\ProductController;
use App\Http\Controllers\User\Api\Profile\ProfileController;
use App\Http\Controllers\User\Api\Setting\SettingController;
use App\Http\Controllers\User\Api\Slider\SliderController;
use App\Http\Controllers\User\Api\Noti\NotiController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
    Route::get('all/notifications',[NotiController::class,'index']);

//****************************************************************************************************** */
//****************************************************************************************************** */
//****************************************************************************************************** */
////////////////////////////////////////////// User authuntcation routes //////////////////////////////////
Route::group(['middleware'=>'auth:sanctum'],function(){
//****************************************************************************************************** */
    //cart
    Route::post('carts/check/coupon',[CartController::class,'checkCoupon']);
    Route::apiResource('carts',CartController::class);
//****************************************************************************************************** */
    //profile
    Route::patch('profiles',[ProfileController::class,'update']);
    Route::apiResource('profiles',ProfileController::class)->except('update');
    //address
    Route::apiResource('addresses',AddressController::class);
//****************************************************************************************************** */
    //contact
    Route::apiResource('contacts',ContactController::class);
//****************************************************************************************************** */
    //order 
    Route::get('orders/getall',[OrderController::class,'getAll']);
    Route::apiResource('orders',OrderController::class);
//****************************************************************************************************** */
    //checkout 
    Route::apiResource('checkouts',CheckoutController::class);
//****************************************************************************************************** */
    //refund request
    Route::apiResource('refunds',RefundRequestController::class);
//****************************************************************************************************** */
    //favorite
    Route::resource('favorites',FavoriteController::class);
});
    //banner
    Route::resource('banners',BannerController::class);
//****************************************************************************************************** */
    //slider
    Route::apiResource('sliders',SliderController::class);
//****************************************************************************************************** */
    //category
    Route::apiResource('categories',CategoryController::class);
//****************************************************************************************************** */
    //child category
    Route::apiResource('childcategories',ChildCategoryController::class);
//****************************************************************************************************** */
    //offer
    Route::apiResource('offers',OfferController::class);
//****************************************************************************************************** */
    //about
    Route::get('about',[AboutController::class,'index']);
//****************************************************************************************************** */
    //setting
    Route::get('settings',[SettingController::class,'index']);
//****************************************************************************************************** */
    //product
    Route::resource('products',ProductController::class);
//****************************************************************************************************** */
    //brand
    Route::resource('brands',BrandController::class);  

//****************************************************************************************************** */
   //send otp
    Route::post('send/otp',[AuthController::class,'sendOtp']);
    //****************************************************************************************************** */
    //check otp
    Route::post('check/otp',[AuthController::class,'checkOtp']);
    //****************************************************************************************************** */
    //update password
    Route::post('update/password',[AuthController::class,'updatePassword']);
//****************************************************************************************************** */
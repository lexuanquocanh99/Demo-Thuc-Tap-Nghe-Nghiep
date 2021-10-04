<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticationController as AdminAuth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Store\PostCommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostTagController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Store\ProductReviewController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\Store\Auth\AuthenticationController as UserAuth;
use App\Http\Controllers\Store\BlogController;
use App\Http\Controllers\Store\WishlistController;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\ProductAttributeValueController;

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

//Store
Route::get('/',[StoreController::class,'home'])->name('home');
//About us
Route::get('/about-us',[StoreController::class,'aboutUs'])->name('about-us');
//Contact us
Route::get('/contact',[StoreController::class,'contact'])->name('contact');
Route::post('/contact/message','MessageController@store')->name('contact.store');
//User
Route::get('user/logout',[UserAuth::class,'logout'])->name('user.logout');
Route::get('user/register',[UserAuth::class,'register'])->name('register.form');
Route::post('user/register',[UserAuth::class,'registerSubmit'])->name('register.submit');
//Message
Route::post('/contact/message',[MessageController::class,'store'])->name('contact.store');
//Auth
Route::get('user/login',[UserAuth::class,'login'])->name('login.form');
Route::post('user/login',[UserAuth::class,'loginSubmit'])->name('login.submit');
// Coupon
Route::post('/coupon-store',[CouponController::class,'couponStore'])->name('coupon-store');
// Blog
Route::get('/blog',[BlogController::class,'blog'])->name('blog');
Route::get('/blog-detail/{slug}',[BlogController::class,'blogDetail'])->name('blog.detail');
Route::get('/blog/search',[BlogController::class,'blogSearch'])->name('blog.search');
Route::post('/blog/filter',[BlogController::class,'blogFilter'])->name('blog.filter');
Route::get('blog-cat/{slug}',[BlogController::class,'blogByCategory'])->name('blog.category');
Route::get('blog-tag/{slug}',[BlogController::class,'blogByTag'])->name('blog.tag');
// Product Review
Route::post('product/{slug}/review',[ProductReviewController::class,'store'])->name('review.store');
Route::delete('/review/delete/{id}',[ProductReviewController::class,'destroy'])->name('product-review.delete');

//Order
Route::get('/income',[OrderController::class,'incomeChart'])->name('product.order.income');

// Post Comment
Route::post('post/{slug}/comment',[PostCommentController::class,'store'])->name('post-comment.store');
//Product
Route::get('/product-grids',[StoreController::class,'productGrids'])->name('product-grids');
Route::get('/product-lists',[StoreController::class,'productLists'])->name('product-lists');
Route::match(['get','post'],'/filter',[StoreController::class,'productFilter'])->name('shop.filter');
Route::get('/product-cat/{slug}',[StoreController::class,'productCat'])->name('product-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}',[StoreController::class,'productSubCat'])->name('product-sub-cat');
Route::get('product-detail/{slug}',[StoreController::class,'productDetail'])->name('product-detail');
Route::get('/product-brand/{slug}',[StoreController::class,'productBrand'])->name('product-brand');
Route::post('/product/search',[StoreController::class,'productSearch'])->name('product.search');
// Wishlist
Route::get('/wishlist',[WishlistController::class,'index'])->name('wishlist');
Route::get('/wishlist/{slug}',[WishlistController::class,'wishlist'])->name('add-to-wishlist');
Route::get('wishlist-delete/{id}',[WishlistController::class,'wishlistDelete'])->name('wishlist-delete');
//Cart
Route::post('cart/order',[OrderController::class,'store'])->name('cart.order');
Route::get('/cart',function(){ return view('store.pages.cart'); })->name('cart');
Route::get('/add-to-cart/{slug}',[CartController::class,'addToCart'])->name('add-to-cart');
Route::post('/add-to-cart',[CartController::class,'singleAddToCart'])->name('single-add-to-cart');
Route::get('cart-delete/{id}',[CartController::class,'cartDelete'])->name('cart-delete');
Route::post('cart-update',[CartController::class,'cartUpdate'])->name('cart.update');
//Checkout
Route::get('/checkout',[CartController::class,'checkout'])->name('checkout');
//Post Comment
Route::resource('/post-comment',PostCommentController::class);
Route::post('post/{slug}/comment',[PostCommentController::class,'store'])->name('post-comment.store');
//Product Variant
Route::post('product-variant/check',[ProductVariantController::class,'check'])->name('product-variant.check');

// User Panel
Route::group(['prefix'=>'/user'],function(){
    Route::get('/',[UserDashboardController::class,'index'])->name('user');
    // Profile
    Route::get('/profile',[UserDashboardController::class,'profile'])->name('user-profile');
    Route::post('/profile/{id}',[UserDashboardController::class,'profileUpdate'])->name('user-profile-update');
    //  Order
    Route::get('/order',[UserDashboardController::class,'orderIndex'])->name('user.order.index');
    Route::get('/order/show/{id}',[UserDashboardController::class,'orderShow'])->name('user.order.show');
    Route::delete('/order/delete/{id}',[UserDashboardController::class,'userOrderDelete'])->name('user.order.delete');
    Route::get('order/pdf/{id}',[OrderController::class,'pdf'])->name('order.pdf');
    // Product Review
    Route::get('/user-review',[UserDashboardController::class,'productReviewIndex'])->name('user.product-review.index');
    Route::delete('/user-review/delete/{id}',[UserDashboardController::class,'productReviewDelete'])->name('user.product-review.delete');
    Route::get('/user-review/edit/{id}',[UserDashboardController::class,'productReviewEdit'])->name('user.product-review.edit');
    Route::patch('/user-review/update/{id}',[UserDashboardController::class,'productReviewUpdate'])->name('user.product-review.update');
    // Post comment
    Route::get('user-post/comment',[UserDashboardController::class,'userComment'])->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}',[UserDashboardController::class,'userCommentDelete'])->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}',[UserDashboardController::class,'userCommentEdit'])->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}',[UserDashboardController::class,'userCommentUpdate'])->name('user.post-comment.update');
    // Password Change
    Route::get('change-password', [UserDashboardController::class,'changePassword'])->name('user.change.password.form');
    Route::post('change-password', [UserDashboardController::class,'changPasswordStore'])->name('change.password');
});

//Admin Panel
Route::group(['prefix'=>'/admin'],function(){
    Route::match(['get', 'post'], '/login', [AdminAuth::class, 'login'])->name('admin.login');
    Route::match(['get', 'post'], '/logout', [AdminAuth::class, 'logout'])->name('admin.logout');
    Route::middleware(['auth','admin'])->group(function (){
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        // Message
        Route::resource('/message', MessageController::class);
        Route::get('/message/five',[MessageController::class, 'messageFive'])->name('messages.five');
        // Notification
        Route::get('/notification/{id}',[NotificationController::class, 'show'])->name('admin.notification');
        Route::get('/notifications',[NotificationController::class, 'index'])->name('all.notification');
        Route::delete('/notification/{id}',[NotificationController::class, 'delete'])->name('notification.delete');
        // Category
        Route::resource('/category',CategoryController::class);
        // Ajax for sub category
        Route::post('/category/{id}/child',[CategoryController::class,'getChildByParent']);
        // Brand
        Route::resource('brand',BrandController::class);
        // Banner
        Route::resource('banner',BannerController::class);
        // Shipping
        Route::resource('/shipping',ShippingController::class);
        // Coupon
        Route::resource('/coupon',CouponController::class);
        // Post Category
        Route::resource('/post-category',PostCategoryController::class);
        // Post Tag
        Route::resource('/post-tag',PostTagController::class);
        // Post
        Route::resource('/post',PostController::class);
        // User
        Route::resource('users',UsersController::class);
        // Password Change
        Route::get('change-password', [AdminAuth::class,'changePassword'])->name('change.password.form');
        Route::post('change-password', [AdminAuth::class,'changPasswordStore'])->name('change.password');
        // Setting
        Route::get('settings',[DashboardController::class,'settings'])->name('settings');
        Route::post('setting/update',[DashboardController::class,'settingsUpdate'])->name('settings.update');
        // Product
        Route::resource('/product',ProductController::class);
        //Product Attribute
        Route::resource('/product-attribute',AttributeController::class);
        //Attribute Value
        Route::resource('/attribute-value',AttributeValueController::class);
        //Product Attribute Value
        Route::resource('/product-attribute-value',ProductAttributeValueController::class);
        Route::post('/delete-attribute',[ProductAttributeValueController::class,'deleteAttribute']);
        //Product Variant
        Route::resource('/product-variant',ProductVariantController::class);
        // Order
        Route::resource('/order',OrderController::class);
        //Product Review
        Route::resource('/product-review',ProductReviewController::class);
    });

});

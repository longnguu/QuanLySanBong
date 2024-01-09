<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Events\HelloPusherEvent;

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

Route::get('/', [\App\Http\Controllers\User\HomeController::class,'index'])->name('HomePage');
Route::get('/thuesan', [\App\Http\Controllers\User\DetailsController::class,'index'])->name('details');
Route::get('/thuesan/filter', [\App\Http\Controllers\User\DetailsController::class,'filter'])->name('filterSB');
Route::get('/muaSP', [\App\Http\Controllers\User\DetailsController::class,'index1'])->name('details1');
Route::get('/muaSP/filter', [\App\Http\Controllers\User\DetailsController::class,'filter1'])->name('filterSP');
Route::get('/productDetails',[\App\Http\Controllers\User\ProductController::class,'index'])->name('productDetails');
Route::get('/login', [\App\Http\Controllers\Login\LoginController::class,'index'])->name('login');
Route::post('/store', [\App\Http\Controllers\Login\LoginController::class,'store']);
Route::post('/create', [\App\Http\Controllers\Login\LoginController::class,'create']);
Route::get('/google', [\App\Http\Controllers\Login\GoogleController::class, 'getGoogleSignInUrl']);
Route::get('/google/callback', [\App\Http\Controllers\Login\GoogleController::class, 'loginCallback']);
Route::get('/facebook', [\App\Http\Controllers\Login\FacebookController::class, 'getFBSignInUrl']);
Route::get('/facebook/callback', [\App\Http\Controllers\Login\FacebookController::class, 'loginFBCallback']);
Route::get('/gioithieu', [\App\Http\Controllers\User\GioiThieuController::class, 'index'])->name('gioithieu');
Route::get('/dieukhoan&chinhsach', [\App\Http\Controllers\User\GioiThieuController::class, 'index1'])->name('dkcs');
Route::get('/lienhe', [\App\Http\Controllers\User\GioiThieuController::class, 'index2'])->name('lienhe');


Route::get('/index', [\App\Http\Controllers\User\PusherController::class, 'index'])->name('index');
Route::post('/broadcast', [\App\Http\Controllers\User\PusherController::class, 'broadcast'])->name('broadcast');
Route::post('/receive', [\App\Http\Controllers\User\PusherController::class, 'receive'])->name('receive');


//Route CTV
Route::middleware(['auth','isAdmin:1,2'])->group(function() {
    Route::prefix('CTV')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class,'dashboard'])->name('admin.dashboard');


    });
});
//Route Admin
Route::middleware(['auth','isAdmin:1'])->group(function() {
    Route::prefix('admin')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class,'dashboard'])->name('admin.dashboard');

        Route::prefix('product')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\SanPhamController::class,'index'])->name('admin.product.index');
            Route::get('/add',[\App\Http\Controllers\Admin\SanPhamController::class,'addProduct'])->name('admin.product.add');
            Route::post('/add',[\App\Http\Controllers\Admin\SanPhamController::class,'addProductPost'])->name('admin.product.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\SanPhamController::class,'edit'])->name('admin.product.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\SanPhamController::class,'update'])->name('admin.product.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\SanPhamController::class,'destroy'])->name('admin.product.getDestroy');
            Route::get('/active/{id}',[\App\Http\Controllers\Admin\SanPhamController::class,'active'])->name('admin.product.active');
        });

        Route::prefix('category')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\DanhMucController::class,'index'])->name('admin.category.index');
            Route::get('/add',[\App\Http\Controllers\Admin\DanhMucController::class,'addCate'])->name('admin.category.add');
            Route::post('/add',[\App\Http\Controllers\Admin\DanhMucController::class,'addCatePost'])->name('admin.category.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\DanhMucController::class,'edit'])->name('admin.category.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\DanhMucController::class,'update'])->name('admin.category.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\DanhMucController::class,'destroy'])->name('admin.category.getDestroy');
        });


        Route::prefix('discount')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\DiscountController::class,'index'])->name('admin.discount.index');
            Route::get('/add',[\App\Http\Controllers\Admin\DiscountController::class,'addDiscount'])->name('admin.discount.add');
            Route::post('/add',[\App\Http\Controllers\Admin\DiscountController::class,'addDiscountPost'])->name('admin.discount.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\DiscountController::class,'edit'])->name('admin.discount.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\DiscountController::class,'update'])->name('admin.discount.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\DiscountController::class,'destroy'])->name('admin.discount.getDestroy');
        });

        Route::prefix('order')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\OrderController::class,'index'])->name('admin.order.index');
            Route::get('/add',[\App\Http\Controllers\Admin\OrderController::class,'addDiscount'])->name('admin.order.add');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\OrderController::class,'edit'])->name('admin.order.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\OrderController::class,'update'])->name('admin.order.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\OrderController::class,'destroy'])->name('admin.order.getDestroy');
            Route::get('/detail/{id}', [\App\Http\Controllers\Admin\OrderController::class,'detail'])->name('admin.order.detail');

            Route::get('/action/{id}',[\App\Http\Controllers\Admin\OrderController::class,'action'])->name('admin.order.action');
            Route::get('/cancel/{id}', [\App\Http\Controllers\Admin\OrderController::class,'cancel'])->name('admin.order.cancel');
            Route::get('/returns/{id}', [\App\Http\Controllers\Admin\OrderController::class,'returns'])->name('admin.order.returns');
            Route::get('/del_product/{MaSP}/{MaHD}',[\App\Http\Controllers\Admin\OrderController::class,'destroy'])->name('admin.order.getDestroy');
            Route::get('/detail/{MaSP}/{MaHD}/{sl}', [\App\Http\Controllers\Admin\OrderController::class,'change_sl'])->name('admin.order.change_sl');
        });

        Route::prefix('user')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\UserController::class,'index'])->name('admin.user.index');
            Route::get('/add',[\App\Http\Controllers\Admin\UserController::class,'addUser'])->name('admin.user.add');
            Route::post('/add',[\App\Http\Controllers\Admin\UserController::class,'addUserPost'])->name('admin.user.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\UserController::class,'edit'])->name('admin.user.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\UserController::class,'update'])->name('admin.user.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\UserController::class,'destroy'])->name('admin.user.getDestroy');
        });
        Route::prefix('naptien')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\NapTienController::class,'index'])->name('admin.naptien.index');
            Route::get('/activate/{id}',[\App\Http\Controllers\Admin\NapTienController::class,'activate'])->name('admin.naptien.activate');
            Route::get('/cancel/{id}', [\App\Http\Controllers\Admin\NapTienController::class,'cancel'])->name('admin.naptien.cancel');
        });

        Route::prefix('coupon')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\CouponController::class,'index'])->name('admin.coupon.index');
            Route::get('/add',[\App\Http\Controllers\Admin\CouponController::class,'addCoupon'])->name('admin.coupon.add');
            Route::post('/add',[\App\Http\Controllers\Admin\CouponController::class,'addCouponPost'])->name('admin.coupon.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\CouponController::class,'edit'])->name('admin.coupon.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\CouponController::class,'update'])->name('admin.coupon.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\CouponController::class,'destroy'])->name('admin.coupon.getDestroy');
        });

        Route::prefix('coso')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\CoSoController::class,'index'])->name('admin.coso.index');
            Route::get('/add',[\App\Http\Controllers\Admin\CoSoController::class,'addCoSo'])->name('admin.coso.add');
            Route::post('/add',[\App\Http\Controllers\Admin\CoSoController::class,'addCoSoPost'])->name('admin.coso.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\CoSoController::class,'edit'])->name('admin.coso.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\CoSoController::class,'update'])->name('admin.coso.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\CoSoController::class,'destroy'])->name('admin.coso.getDestroy');
        });


        Route::prefix('sanbong')->group(function () {
            Route::get('/',[\App\Http\Controllers\Admin\SanBongController::class,'index'])->name('admin.sanbong.index');
            Route::get('/add',[\App\Http\Controllers\Admin\SanBongController::class,'addSanBong'])->name('admin.sanbong.add');
            Route::post('/add',[\App\Http\Controllers\Admin\SanBongController::class,'addSanBongPost'])->name('admin.sanbong.save');
            Route::get('/edit/{id}',[\App\Http\Controllers\Admin\SanBongController::class,'edit'])->name('admin.sanbong.edit');
            Route::post('/edit/{id}',[\App\Http\Controllers\Admin\SanBongController::class,'update'])->name('admin.sanbong.edit');
            Route::get('/destroy/{id}',[\App\Http\Controllers\Admin\SanBongController::class,'destroy'])->name('admin.sanbong.getDestroy');
            Route::get('/active/{id}',[\App\Http\Controllers\Admin\SanPhamController::class,'active'])->name('admin.product.active');
        });


    });
});
Route::middleware(['auth','isAdmin:1,2,3'])->group(function() {
    Route::get('logout', [\App\Http\Controllers\Login\LoginController::class, 'logout']);
    Route::get('cart', [\App\Http\Controllers\User\CartController::class, 'index'])->name('cart');
    Route::POST('updatecart', [\App\Http\Controllers\User\CartController::class, 'update']);
    Route::get('addtocart', [\App\Http\Controllers\User\CartController::class, 'store'])->name('user.addtocart');
    Route::get('addtocartt', [\App\Http\Controllers\User\CartController::class, 'storet'])->name('user.addtocartt');
    Route::get('updatecart',[\App\Http\Controllers\User\CartController::class, 'updatecart'])->name("user.updatecart");
    Route::get('/profile', [\App\Http\Controllers\User\UserController::class, 'user_inf'])->name('user.inf');
    Route::get('chat', [\App\Http\Controllers\User\UserController::class, 'chat'])->name('user.inf');
//    Route::get('/cart', [\App\Http\Controllers\User\HomeController::class,'create'])->name('HomePage1');
});

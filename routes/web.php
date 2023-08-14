<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\PayhereController;
use App\Http\Controllers\SubCategoryController;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', function () {
    return view('admin.pages.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// Admin area
Route::group(['prefix' => 'admin/dashboard', 'middleware' => ['web', 'auth']], function () {
    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'settingsUpdate'])->name('admin.settings.update');
    //Categories
    Route::resource('/categories', CategoryController::class);
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');
    // Ajax for sub category
    Route::post('/category/{id}/sub', [CategoryController::class, 'getSubByParent']);
    //Banner
    Route::resource('/banner', BannerController::class);
    Route::delete('/banner/delete/{id}', [BannerController::class, 'destroy'])->name('banner.delete');
    //Brand
    Route::resource('/brand', BrandController::class);
    Route::delete('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
    //Products
    Route::resource('/product', ProductController::class);
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('/products', [HomeController::class, 'products'])->name('products');
});

// User Area
Route::middleware('web')->group(function () {
    Route::get('/products', [WebController::class, 'products'])->name('products');
    Route::match(['get', 'post'], '/products/search', [WebController::class, 'productSearch'])->name('product.search');
    Route::post('/products/review/{slug}', [ProductReviewController::class, 'store'])->name('review.product.submit');
    Route::get('/products/detail/{slug}', [WebController::class, 'productDetail'])->name('product.details');
    Route::match(['get', 'post'], '/products/filter', [WebController::class, 'productFilter'])->name('shop.filter');
    Route::get('/products/category/{slug}', [WebController::class, 'productCat'])->name('product.cat');
    Route::get('/products/subcategory/{slug}/{subCatSlug}', [WebController::class, 'productSubCat'])->name('product.sub.cat');
    Route::get('/products/brand/{slug}', [WebController::class, 'productBrand'])->name('product.brand');
});

// Cart and Order
Route::get('/add-to-cart/{slug}', [CartController::class, 'addToCart'])->name('add.to.cart')->middleware('auth');
Route::post('/add-to-cart', [CartController::class, 'singleAddToCart'])->name('single.add.to.cart')->middleware('auth');
Route::get('/cart/delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/update', [CartController::class, 'cartUpdate'])->name('cart.update');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::post('/checkout/order', [OrderController::class, 'store'])->name('checkout.order')->middleware('auth');

// Payhere
Route::get('payhere/pay/{id}', [PayhereController::class, 'pay'])->name('payhere.pay');
Route::get('payhere/return/{id}', [PayhereController::class, 'return'])->name('payhere.return');
Route::get('payhere/cancel/{id}', [PayhereController::class, 'cancel'])->name('payhere.cancel');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

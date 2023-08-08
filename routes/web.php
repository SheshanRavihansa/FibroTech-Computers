<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
    //Product
    Route::resource('/product', ProductController::class);
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

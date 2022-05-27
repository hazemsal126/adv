<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes(['verify' => true]);
Route::get('/send/email', [App\Http\Controllers\HomeController::class, 'mail']);


Route::get('/', function(){
    return redirect()->route('admin.home');
})->name('home');


Route::post('/front/verifymail', [App\Http\Controllers\front\UserController::class, 'verifymail'])->name('front.verifymail')->middleware('auth');
Route::get('/front/resentcode', [App\Http\Controllers\front\UserController::class, 'resentcode'])->name('front.resentcode')->middleware('auth');

Route::get('/admin/login', [App\Http\Controllers\admin\authcont::class, 'login'])->name('adminlogin');
Route::post('/admin/login', [App\Http\Controllers\admin\authcont::class, 'postIndex'])->name('adlogin');

Route::group(['middleware'=>'admin','prefix'=>'admin'], function() {
    Route::get('/', [App\Http\Controllers\admin\authcont::class, 'index'])->name('admin.home');
    Route::get('/auth/profile', [App\Http\Controllers\admin\authcont::class, 'edit'])->name('admin.auth.profile');
    Route::put('/auth/profile/update', [App\Http\Controllers\admin\authcont::class, 'update'])->name('admin.auth.update');
    Route::get('/logout',[App\Http\Controllers\admin\authcont::class, 'getLogout'])->name('admin.logout');

    Route::resource('roles','App\Http\Controllers\admin\RoleController');

    Route::resource('customer','App\Http\Controllers\admin\CustomerController')->except(['show']);

    Route::resource('faq','App\Http\Controllers\admin\FaqController');

    Route::resource('category','App\Http\Controllers\admin\CategoryController');
    Route::resource('sub_category','App\Http\Controllers\admin\SubCategoryController');
    Route::post('/subcategory/cat_id', [App\Http\Controllers\admin\SubCategoryController::class, 'cat_id'])->name('sub_category.cat_id');

    Route::resource('country','App\Http\Controllers\admin\CountryController');
    Route::resource('city','App\Http\Controllers\admin\CityController');
    Route::post('/city_country/country_id', [App\Http\Controllers\admin\CityController::class, 'country_id'])->name('city.country_id');

    Route::resource('advertisment','App\Http\Controllers\admin\AdvController');

    Route::get('/users', [App\Http\Controllers\admin\UserController::class, 'index'])->name('users');
    Route::get('/users/create', [App\Http\Controllers\admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [App\Http\Controllers\admin\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit/', [App\Http\Controllers\admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [App\Http\Controllers\admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy/{id}', [App\Http\Controllers\admin\UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('/section','App\Http\Controllers\admin\SectionController')->except(['destroy','create','store','show']);

    Route::get('/setting', [App\Http\Controllers\admin\SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting/update', [App\Http\Controllers\admin\SettingController::class, 'update'])->name('setting.update');


});

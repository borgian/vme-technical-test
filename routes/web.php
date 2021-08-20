<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;
use \App\Http\Livewire\ProductCrud;

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



/*
 *  Custom VME routes
 *
 * */


Route::get('/', 'App\Http\Controllers\VmeController@view_products');
Route::get('/productcrud',\App\Http\Livewire\ProductForm::class);
Route::get('/edit_product/{id}',\App\Http\Livewire\ProductForm::class);
Route::post('upload', 'App\Http\Controllers\VmeCsvController@upload');
Route::get('/settings',\App\Http\Livewire\SettingsForm::class);


/*Route::get('/product', function () {
    return 'hi';
});*/

/*
Route::get('edit_product/{id}', function ($id) {
    return view('vme_layouts.form_product_edit',['id'=>$id]);
});*/



//Route::get('store', 'App\Http\Controllers\VmeCsvController@store');




//*******************************************************************************




/*
 *  Original routes
 *
 * */

//Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

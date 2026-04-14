<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParklaringController;

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



Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('login');
})->name('home');
Route::get('/{uniqueCode}', [ParklaringController::class, 'show']);

// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {
    Route::resource('parklaring', \App\Http\Controllers\Admin\ParklaringInfoController::class);
    Route::post('parklaring/{id}/delete_exit_clearance_form', [\App\Http\Controllers\Admin\ParklaringInfoController::class, 'delete_exit_clearance_form'])->name('admin.parklaring.delete_exit_clearance_form');
    Route::post('parklaring/{id}/delete_resignation_form', [\App\Http\Controllers\Admin\ParklaringInfoController::class, 'delete_resignation_form'])->name('admin.parklaring.delete_resignation_form');
    Route::get('parklaring/getApprover/{id}', [\App\Http\Controllers\Admin\ParklaringInfoController::class, 'getApprover'])->name('admin.parklaring.getApprover');
    Route::resource('setting', \App\Http\Controllers\Admin\SettingController::class);
});

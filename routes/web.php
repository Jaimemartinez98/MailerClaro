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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'VerifyRol'], function () {

Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
Route::get('/users/create', [App\Http\Controllers\UsersController::class, 'create'])->name('users.create');
Route::post('/users/store', [App\Http\Controllers\UsersController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{id}', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{id}', [App\Http\Controllers\UsersController::class, 'delete'])->name('users.delete');

});

Route::get('/cities/{id}', [App\Http\Controllers\CitiesController::class, 'getCitiesByDepartment']);
Route::get('/provinces/{id}', [App\Http\Controllers\ProvinciesController::class, 'getProvincesByDepartment']);

Route::get('/emails', [App\Http\Controllers\EmailsController::class, 'index'])->name('emails.index');
Route::get('/emails/create', [App\Http\Controllers\EmailsController::class, 'create'])->name('emails.create');
Route::post('/emails/store', [App\Http\Controllers\EmailsController::class, 'store'])->name('emails.store');
Route::delete('/emails/delete/{id}', [App\Http\Controllers\EmailsController::class, 'delete'])->name('emails.delete');
Route::post('/emails/update/{id}', [App\Http\Controllers\EmailsController::class, 'updateState'])->name('emails.update');

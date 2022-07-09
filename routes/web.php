<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Hospital\HospitalOwnersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Admins
Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
Route::get('/admin/users/{id}', [AdminController::class, 'delete'])->name('admin.users.delete');


// Hospital Owner
Route::get('/hospital/owners', [HospitalOwnersController::class, 'index'])->name('hospital.owners');
Route::post('/hospital/owners/insert', [HospitalOwnersController::class, 'insert'])->name('hospital.owners.insert');
Route::get('/hospital/owners/delete/{id}', [HospitalOwnersController::class, 'delete'])->name('hospital.owners.delete');
Route::post('/hospital/owners/update', [HospitalOwnersController::class, 'update'])->name('hospital.owners.update');


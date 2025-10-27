<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',[UserController::class,'index'])->name('dashboard');
});

// CategoryController Routes

Route::get('categories/all',[CategoryController::class,'index'])->name('categories.index');
Route::get('categories/create',[CategoryController::class,'create'])->name('categories.create');
Route::post('categories/store',[CategoryController::class,'store'])->name('categories.store');
Route::get('categories/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
Route::put('categories/update/{id}',[CategoryController::class,'update'])->name('categories.update');
Route::delete('categories/delete/{id}',[CategoryController::class,'destroy'])->name('categories.destroy');


// BrandController Routes
Route::get('brands/all',[BrandController::class,'index'])->name('brands.index');
Route::post('brands/store',[BrandController::class,'store'])->name('brands.store');
Route::get('brands/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
Route::put('brands/update/{id}',[BrandController::class,'update'])->name('brand.update');
Route::get('brands/delete/{id}',[BrandController::class,'delete'])->name('brand.delete');

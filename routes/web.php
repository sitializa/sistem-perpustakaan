<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('members', MemberController::class);
Route::get('borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
Route::resource('categories', CategoryController::class)->except('show');
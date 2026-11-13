<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::redirect('/', '/books');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);

    Route::get('borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
    Route::get('borrowings/create', [BorrowingController::class, 'create'])->name('borrowings.create');
    Route::post('borrowings', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::get('borrowings/{borrowing}', [BorrowingController::class, 'show'])->name('borrowings.show');
    Route::post('borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
});
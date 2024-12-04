<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\userController;
use App\Http\Controllers\anggotaController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::get('/anggota/loan-requests', [AnggotaController::class, 'loanRequests'])->name('anggota.loan_requests');
    Route::get('/admin/confirm-requests', [anggotaController::class, 'confirmRequests'])->name('admin.confirmRequests');
    Route::patch('/admin/approve-request/{id}', [anggotaController::class, 'approveRequest'])->name('admin.approveRequest');
    Route::delete('/admin/reject-request/{id}', [anggotaController::class, 'rejectRequest'])->name('admin.rejectRequest');
    Route::get('/admin/borrowed-books', [anggotaController::class, 'borrowedBooksAdmin'])->name('admin.borrowedBooks');
    Route::patch('/admin/return-book/{id}', [anggotaController::class, 'returnBookForAdmin'])->name('admin.returnBookForAdmin');
    Route::patch('/admin/complete-loan/{id}', [anggotaController::class, 'completeLoan'])->name('admin.completeLoan');
    Route::patch('/admin/extend-loan/{id}', [anggotaController::class, 'extendLoan'])->name('admin.extendLoan');
    route::resource('books',BookController::class);
    route::resource('users',userController::class);
});
route::group(['middleware' => ['auth', 'role:anggota']], function(){
    Route::get('/anggota/pending-requests', [anggotaController::class, 'pendingRequests'])->name('anggota.pending_requests');
    Route::get('/anggota/borrowed', [anggotaController::class, 'borrowedBooks'])->name('anggota.borrowed');
    Route::get('/borrowed-books', [anggotaController::class, 'borrowedBooks'])->name('anggota.borrowedBooks');
    route::resource('anggota',anggotaController::class);
    Route::patch('/anggota/return-book/{id}', [anggotaController::class, 'returnBook'])->name('anggota.returnBook');
});

Route::get('/dashboard', [anggotaController::class, 'dashboard'])->name('dashboard');
require __DIR__.'/auth.php';

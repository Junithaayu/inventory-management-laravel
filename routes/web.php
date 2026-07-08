<?php

use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;
use App\Models\Borrowing;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $jumlahKategori = Category::count();

    $jumlahProduk = Product::count();

    $barangDipinjam = Borrowing::where('status', 'Dipinjam')->count();

    $barangDikembalikan = Borrowing::where('status', 'Dikembalikan')->count();

    return view('dashboard', compact(
        'jumlahKategori',
        'jumlahProduk',
        'barangDipinjam',
        'barangDikembalikan'
    ));

})->middleware(['auth', 'role:Admin'])->name('dashboard');

Route::resource('categories', CategoryController::class)
    ->middleware(['auth', 'role:Admin']);

Route::resource('products', ProductController::class)
    ->middleware(['auth', 'role:Admin']);

Route::resource('borrowings', BorrowingController::class)
    ->middleware(['auth', 'role:Admin']);

Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'return'])
    ->name('borrowings.return')
    ->middleware(['auth', 'role:Admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

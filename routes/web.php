<?php

use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;
use App\Models\Borrowing;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $jumlahKategori = Category::count();

    $jumlahProduk = Product::count();

    $barangDipinjam = Borrowing::where('status', 'Dipinjam')->count();

    $barangTersedia = Product::sum('stok');

    $barangDikembalikan = Borrowing::where('status', 'Dikembalikan')->count();

    $peminjamanTerbaru = Borrowing::with('details.product')
        ->latest()
        ->take(5)
        ->get();
    
    $stokMenipis = Product::where('stok', '<=', 5)
        ->orderBy('stok')
        ->get();

    $grafikPeminjaman = Borrowing::select(
            DB::raw('MONTH(tanggal_pinjam) as bulan'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy(DB::raw('MONTH(tanggal_pinjam)'))
        ->orderBy(DB::raw('MONTH(tanggal_pinjam)'))
        ->get();

    return view('dashboard', compact(
        'jumlahKategori',
        'jumlahProduk',
        'barangDipinjam',
        'barangDikembalikan',
        'peminjamanTerbaru',
        'stokMenipis',
        'barangTersedia',
        'grafikPeminjaman'
    ));

})->middleware(['auth', 'role:Admin|Staff|Manager'])->name('dashboard');

Route::resource('categories', CategoryController::class)
    ->middleware(['auth', 'role:Admin']);

Route::resource('products', ProductController::class)
    ->only(['index', 'show'])
    ->middleware(['auth', 'role:Admin|Staff|Manager']);

Route::resource('products', ProductController::class)
    ->except(['index', 'show'])
    ->middleware(['auth', 'role:Admin']);

Route::resource('borrowings', BorrowingController::class)
    ->middleware(['auth', 'role:Admin|Staff|Manager']);

Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'return'])
    ->name('borrowings.return')
    ->middleware(['auth', 'role:Admin|Staff|Manager']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

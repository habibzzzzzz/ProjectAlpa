<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatusPengirimanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\KurirController;
use App\Http\Controllers\BlogController;
use App\Models\Blog;
 use App\Http\Controllers\LandingBlogController;
// Landing Page (akses publik)
Route::get('/', function () {
    $blogs = Blog::latest()->take(3)->get();
    return view('landing', compact('blogs'));
})->name('landing');



// Login & Register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/kurir/dashboard', [KurirController::class, 'index'])->name('kurir.dashboard');

// Dashboard user biasa
Route::get('/dashboard', function () {
    return view('customer.home');
})->middleware('auth')->name('dashboard');

// Dashboard admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/user/{id}/edit', [AdminController::class, 'editUser'])->name('admin.user.edit');
    Route::get('/admin/user/{id}', [AdminController::class, 'getUser'])->name('admin.user.get');
    Route::post('/admin/export-laporan', [AdminController::class, 'exportLaporan'])->name('admin.export.laporan');
});

// Form pemesanan
Route::post('/pesan', [PemesananController::class, 'store'])->name('pesan.store');

// Blog untuk customer login
Route::get('/customer/blog/index', [BlogController::class, 'index'])->name('blog.index');
Route::get('/customer/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Halaman customer (setelah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/customer/home', function () {
        return view('customer.home');
    });

    Route::get('/customer/order', function () {
        return view('customer.order');
    });

    Route::get('/customer/history', [\App\Http\Controllers\PemesananController::class, 'history'])->name('customer.history');
    // Dashboard kurir
    Route::prefix('kurir')->middleware(['auth'])->group(function () {
        Route::get('/dashboard', [KurirController::class, 'index'])->name('kurir.dashboard');
    });
    // Tambahkan route update status pengiriman
    Route::post('/status/update/{pemesanan_id}', [\App\Http\Controllers\StatusPengirimanController::class, 'update'])->name('status.update');
    
    // Route untuk menampilkan bukti transfer
    Route::get('/bukti-transfer/{filename}', function($filename) {
        $path = storage_path('app/public/bukti_transfer/' . $filename);
        
        if (!file_exists($path)) {
            abort(404);
        }
        
        return response()->file($path);
    })->name('bukti.transfer.show')->middleware('auth');
});

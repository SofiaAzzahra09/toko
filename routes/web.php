<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\stockController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UnduhLaporan;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/manager/dashboard/{branchId}', [DashboardController::class, 'managerDashboard'])->name('manager.dashboard');
//     Route::get('/supervisor/dashboard/{branchId}', [DashboardController::class, 'supervisorDashboard'])->name('supervisor.dashboard');
//     Route::get('/cashier/dashboard/{branchId}', [DashboardController::class, 'cashierDashboard'])->name('cashier.dashboard');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', RoleMiddleware::class . ':owner'])->group(function () {
    Route::get('/dashboard', [BranchController::class, 'dashboardOwner'])->name('dashboard');
    
    Route::get('/dashboard/{branchId}', [BranchController::class, 'dashboard'])->name('owner.dashboard');
    Route::get('/stok/{branchId?}', [BranchController::class, 'showStock'])->name('stock.show');
    Route::get('/transaksi/{branchId?}', [BranchController::class, 'showTransaction'])->name('transaction.show');
    Route::get('/transaksi/{branchId}/export/excel', [TransaksiController::class, 'exportToExcel'])->name('transactions.export.excel');
    Route::get('/transaksi/{branchId}/export/pdf', [TransaksiController::class, 'exportToPdf'])->name('transactions.export.pdf');
    Route::get('/stok/{branchId}/export/pdf', [stockController::class, 'exportPdf'])->name('stock.export.pdf');
    Route::get('/stok/{branchId}/export/excel', [StockController::class, 'exportExcel'])->name('stock.export.excel');
    Route::get('/owner/informasi', [BranchController::class, 'informationBranch'])->name('owner.informasi');
});

Route::middleware(['auth', RoleMiddleware::class . ':manager'])->group(function () {
    
});

require __DIR__.'/auth.php';

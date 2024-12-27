<?php

namespace App\Http\Controllers;

use App\Models\BranchModel;
use App\Models\StokModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
// use App\Models\ProdukModel;

class BranchController extends Controller
{
    public function getBranch()
    {
        $branches = BranchModel::all(); 
        $branchId = auth()->user()->branch_id ?? 1;
        return view('dashboard', compact('branches'));
    }

    public function index(Request $request)
    {
        return view('dashboard');
    }

    public function dashboardOwner(Request $request)
    {
        $branches = BranchModel::all();

        $branch = null;
        $totalProduk = 0;
        $totalPenjualan = 0;

        if ($request->has('id_cabang')) {
            $branch = BranchModel::find($request->id_cabang);

            if ($branch) {
                $totalProduk = StokModel::where('id_cabang', $branch->id_cabang)->count();
                $totalPenjualan = TransaksiModel::where('id_cabang', $branch->id_cabang)->sum('total_harga');
            }
        }

        return view('dashboard', compact('branches', 'branch', 'totalProduk', 'totalPenjualan'));
    }

    public function dashboard($branchId = null)
    {
        $branchId = $branchId ?? auth()->user()->branch_id ?? 1;
        $branch = BranchModel::findOrFail($branchId);

        if (!auth()->user()->hasRole('owner')) {
            abort(403, 'Unauthorized access');
        }

        return view('owner.dashboard', compact('branch')); 
    }

        public function showStock($branchId)
    {
        $branch = BranchModel::findOrFail($branchId);
        $stocks = StokModel::with(['produk.kategori'])
                    ->where('id_cabang', $branchId)
                    ->get();

        return view('stok.index', compact('branch', 'stocks'));
    }

        public function showTransaction($branchId)
    {
        $branch = BranchModel::findOrFail($branchId);
        $transactions = TransaksiModel::with('kasir', 'transaksiDetail.produk.kategori')
                                ->where('id_cabang', $branch->id_cabang)
                                ->get();

        return view('transaksi.index', compact('branch', 'transactions'));
    }

    public function informationBranch()
    {
        $branches = BranchModel::with('usersStore')->get();
        return view('owner.informasi', compact('branches'));
    }
}

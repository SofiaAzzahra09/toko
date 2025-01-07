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

        $role = 'owner';
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

    public function dashboardRole($branchId = null)
    {
        $user = auth()->user();
        $role = strtolower($user->peran ?? ''); 

        dd($role, $user->roles); 

        if (!in_array($role, ['manager', 'supervisor', 'cashier', 'warehouse'])) {
            abort(403, 'Unauthorized role.');
        }

        $branchId = $branchId ?? $user->branch_id ?? 1;
        $branch = BranchModel::findOrFail($branchId);
        
        if ($role === 'manager') {
            return view('manager.dashboard', compact('branch'));
        } elseif ($role === 'supervisor') {
            return view('supervisor.dashboard', compact('branch'));
        } elseif ($role === 'cashier') {
            return view('cashier.dashboard', compact('branch'));
        } elseif ($role === 'warehouse') {
            return view('warehouse.dashboard', compact('branch'));
        }
    }

//     public function dashboardRole()
// {
//     $user = auth()->user();

//     if (!$user) {
//         abort(403, 'User not authenticated.');
//     }

//     // Pastikan 'peran' adalah field yang valid dan sesuai dengan role yang ada
//     $role = strtolower($user->peran ?? '');
//     $branchId = $user->id_cabang;

//     // Logika pengalihan berdasarkan role dan branchId
//     logger("User role: {$role}, Branch ID: {$branchId}");

//     // Role yang valid
//     $validRoles = ['manager', 'supervisor', 'cashier', 'warehouse'];
//     if (!in_array($role, $validRoles)) {
//         abort(403, 'Unauthorized role.');
//     }

//     $branch = BranchModel::find($branchId);
//     if (!$branch) {
//         abort(403, 'Branch not found.');
//     }

//     return view('manager.dashboard', compact('role', 'branch'));
// }


        public function showStock($branchId)
    {
        $branch = BranchModel::findOrFail($branchId);
        $stocks = StokModel::with(['produk.kategori'])
                    ->where('id_cabang', $branchId)
                    ->get();

        return view('stok.index', compact('branch', 'stocks'));
    }

    public function redirectDashboard()
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'User not authenticated.');
        }

        $role = strtolower($user->peran);  
        $branchId = $user->id_cabang;     

        switch ($role) {
            case 'owner':
                return redirect()->route('dashboard'); 
            case 'manager':
            case 'supervisor':
            case 'cashier':
            case 'warehouse':
                if ($branchId) {
                    return redirect()->route("{$role}.dashboard", ['id_cabang' => $branchId]); 
                }
                abort(403, 'Branch not found for the user.');
            default:
                abort(403, 'Unauthorized access: unrecognized role.');
        }
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

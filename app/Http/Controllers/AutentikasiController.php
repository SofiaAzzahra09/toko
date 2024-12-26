<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutentikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->authenticate();
        // $request->session()->regenerate();

        // $user = Auth::user();
        // session([
        //     'branchId' => $user->id_cabang,
        //     'role' => $user->peran,
        // ]);

        // if ($user->peran === 'manager') {
        //     return redirect()->route('manager.dashboard', ['branchId' => $user->id_cabang]);
        // } elseif ($user->peran === 'supervisor') {
        //     return redirect()->route('supervisor.dashboard', ['branchId' => $user->id_cabang]);
        // } elseif ($user->peran === 'cashier') {
        //     return redirect()->route('cashier.dashboard', ['branchId' => $user->id_cabang]);
        // }elseif ($user->peran === 'warehouse') {
        //     return redirect()->route('warehouse.dashboard', ['branchId' => $user->id_cabang]);
        // }

        // return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

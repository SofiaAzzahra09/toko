<?php

namespace App\Http\Controllers;

use App\Models\BranchModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetBranchController extends Controller
{
    public function getBranch()
    {
        $branches = BranchModel::all();   
        return view('dashboard', compact('branches'));
    }
}

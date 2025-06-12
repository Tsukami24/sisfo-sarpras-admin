<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Loan_item;
use App\Models\Return_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $loans = Loan_item::count();
        $returns = Return_item::count();
        $logs = DB::table('logs')
            ->orderBy('waktu_log', 'desc')
            ->limit(10)
            ->get();
        return view('Admin.dashboard', compact('users', 'loans', 'returns', 'logs'));
    }
}

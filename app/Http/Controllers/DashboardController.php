<?php

namespace App\Http\Controllers;

use App\Models\Loan_item;
use App\Models\Return_item;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $loans = Loan_item::count();
        $returns = Return_item::count();
        return view('dashboard', compact('users','loans','returns'));
    }
}

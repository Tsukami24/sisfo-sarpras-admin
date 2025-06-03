<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Loan_item;
use App\Models\Return_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        } else {
            return back()->withErrors([
                'name' => 'Username atau password salah'
            ])->onlyInput('name');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();

        return redirect('/');
    }

    public function approve($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->status = 'disetujui';
        $loan->admin_id = auth('admin')->id();
        $loan->save();

        return redirect()->back()->with('success', 'Peminjaman disetujui.');
    }

    public function reject($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->status = 'ditolak';
        $loan->admin_id = auth('admin')->id();
        $loan->save();

        return redirect()->back()->with('success', 'Peminjaman ditolak.');
    }

    public function return(Request $request, $id)
    {
        $request->validate([
            'condition' => 'required|in:baik,rusak,hilang   ',
            'fine' => 'required|integer|min:0',
        ]);

        $returnItem = Return_item::findOrFail($id);
        $returnItem->update([
            'condition' => $request->condition,
            'fine' => $request->fine,
            'admin_id' => Auth::guard('admin')->id(),
        ]);

        $unconfirmed = Return_item::where('loan_id', $returnItem->loan_id)
            ->whereNull('admin_id')->count();

        if ($unconfirmed === 0) {
            $loan = Loan::find($returnItem->loan_id);
            $loan->status = 'dikembalikan';
            $loan->save();
        }

        return back()->with('success', 'Item berhasil dikonfirmasi.');
    }




    public function ReturnDate(Request $request, $id)
    {
        $request->validate([
            'return_date' => 'required|date',
        ]);

        $formattedDate = Carbon::parse($request->return_date)->format('Y-m-d H:i:s');

        $loan = Loan::findOrFail($id);
        $loan->update([
            'return_date' => $formattedDate,
            'admin_id' => auth()->guard('admin')->id(),
        ]);

        return redirect()->route('loans')
            ->with('success', 'Tanggal pengembalian berhasil diperbarui.');
    }

}

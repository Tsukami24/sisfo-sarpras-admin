<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Loan;
use App\Models\Return_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{
    public function return(Request $request)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $loan = Loan::findOrFail($request->loan_id);
        $actualReturnDate = Carbon::now('Asia/Jakarta');

        foreach ($request->items as $item) {
            Return_item::create([
                'loan_id' => $loan->id,
                'item_id' => $item['item_id'],
                'admin_id' => null,
                'quantity' => $item['quantity'],
                'condition' => 'good',
                'fine' => 0,
                'returned_date' => $actualReturnDate,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dikembalikan. Menunggu konfirmasi admin.',
        ]);
    }

    public function data_return()
    {
        Carbon::setLocale('id');
        $return_items = Return_item::all();
        return view('data_return', compact('return_items'));
    }
}

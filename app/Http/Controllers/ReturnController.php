<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Loan;
use App\Models\Return_item;
use Illuminate\Http\Request;
use App\Exports\ReturnExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
            $alreadyReturned = Return_item::where('loan_id', $loan->id)
                ->where('item_id', $item['item_id'])
                ->exists();

            if ($alreadyReturned) {
                return response()->json([
                    'success' => false,
                    'message' => 'Barang dengan ID ' . $item['item_id'] . ' sudah pernah dikembalikan.',
                ], 400);
            }

            Return_item::create([
                'loan_id' => $loan->id,
                'item_id' => $item['item_id'],
                'admin_id' => null,
                'quantity' => $item['quantity'],
                'condition' => 'baik',
                'fine' => 0,
                'returned_date' => $actualReturnDate,
            ]);
        }

        $dbItem = Item::find($item['item_id']);
        if ($dbItem) {
            $dbItem->stock += $item['quantity'];
            $dbItem->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dikembalikan. Menunggu konfirmasi admin.',
        ]);
    }

    public function data_return()
    {
        Carbon::setLocale('id');
        $return_items = Return_item::orderByDesc('id')->get();
        return view('Return.data_return', compact('return_items'));
    }

    public function show_report()
    {
        $return_items = Return_item::all();

        return view('Return.report_return', compact('return_items'));
    }

    public function export()
    {
        return Excel::download(new ReturnExport, 'Returns.xlsx');
    }
}

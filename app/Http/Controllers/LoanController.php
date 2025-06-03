<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Loan;
use App\Models\Loan_item;
use App\Exports\LoanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LoanController extends Controller
{
    public function create_loan(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_date' => 'required|date_format:Y-m-d H:i:s',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|in:1',
        ]);

        $itemIds = array_column($request->items, 'id');
        if (count($itemIds) !== count(array_unique($itemIds))) {
            return response()->json([
                'message' => 'Setiap item hanya boleh dipinjam satu kali dalam satu peminjaman.'
            ], 422);
        }

        $loan = Loan::create([
            'user_id' => $request->user_id,
            'loan_date' => $request->loan_date,
            'return_date' => $request->return_date,
            'reason' => $request->reason,
            'status' => 'ditunda',
            'admin_id' => null
        ]);

        foreach ($request->items as $item) {
            $loan->items()->attach($item['id'], ['quantity' => $item['quantity']]);

            $dbItem = Item::find($item['id']);
            if ($dbItem->stock < $item['quantity']) {
                return response()->json([
                    'message' => 'Stok barang tidak mencukupi untuk ' . $dbItem->name
                ], 422);
            }

            $dbItem->stock -= $item['quantity'];
            $dbItem->save();
        }

        return response()->json([
            'message' => 'Peminjaman berhasil diajukan, menunggu persetujuan admin.',
            'loan' => $loan->load('items')
        ]);
    }

    public function loan(Request $request)
    {
        $userId = Auth::id();

        $relations = ['items', 'returnItems.item'];

        $loans = Loan::with($relations)
                ->where('user_id', $userId)
                ->orderByDesc('loan_date')
                ->get();
        return response()->json([
                'success' => true,
                'message' => 'Riwayat peminjaman berhasil diambil',
                'data' => $loans
            ]);
    }

    public function data_loan()
    {
        Carbon::setLocale('id');
        $loan_items = Loan_item::orderByDesc('id')->get();
        return view('Loans.data_peminjaman', compact('loan_items'));
    }

    public function show_report()
    {
        $loan_items = Loan_item::all();

        return view('Loans.report_loan', compact('loan_items'));
    }

    public function export()
    {
        return Excel::download(new LoanExport, 'Loans.xlsx');
    }
}

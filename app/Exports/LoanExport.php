<?php

namespace App\Exports;

use App\Models\Loan;
use App\Models\Loan_item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LoanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $loanItems = Loan_item::with(['loan.user', 'item'])->get();

        return $loanItems->map(function ($loanItem) {
            return [
                'Loan ID' => $loanItem->loan->id,
                'Nama Peminjam' => $loanItem->loan->user->name ?? 'N/A',
                'Nama Item' => $loanItem->item->name ?? 'N/A',
                'Jumlah' => $loanItem->quantity,
                'Tanggal Pinjam' => $loanItem->loan->loan_date,
                'Perkiraan Kembali' => $loanItem->loan->return_date,
            ];
        });
    }

    public function headings(): array
    {
        return ['Loan ID', 'Nama Peminjam', 'Nama Item', 'Jumlah', 'Tanggal Pinjam', 'Perkiraan Kembali'];
    }
}

<?php

namespace App\Exports;

use App\Models\Return_item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReturnExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $returnItems = Return_item::with(['loan.user', 'item'])->get();

        return $returnItems->map(function ($returnItem) {
            return [
                'Id' => $returnItem->id,
                'Loan Id' => $returnItem->loan->id,
                'Nama Peminjam' => $returnItem->loan->user->name ?? 'N/A',
                'Nama Barang' => $returnItem->item->name ?? 'N/A',
                'Jumlah' => $returnItem->quantity,
                'Kondisi' => $returnItem->condition,
                'Denda' => $returnItem->fine,
                'Tanggal Pinjam' => $returnItem->loan->loan_date,
                'Tanggal Kembali' => $returnItem->returned_date,
            ];
        });
    }

    public function headings(): array
    {
        return ['Id','Loan Id', 'Nama Peminjam', 'Nama Barang', 'Jumlah', 'Kondisi', 'Denda' ,'Tanggal Pinjam','Tanggal Kembali'];
    }
}

<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ItemsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $items = Item::with('category')->get();

        return $items->map(function ($item) {
            return [
                'Id' => $item->id,
                'Nama Barang' => $item->name,
                'Deskripsi' => $item->description ?? 'N/A',
                'Total' => $item->total ?? 'N/A',
                'Stok' => $item->stock,
                'Kategori' => $item->category->name ?? 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return ['Id', 'Nama Barang', 'Deskripsi', 'Total', 'Stok', 'Kategori'];
    }
}

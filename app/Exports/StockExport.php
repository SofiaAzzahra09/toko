<?php

namespace App\Exports;

use App\Models\StokModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class StockExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $branchId;

    public function __construct($branchId)
    {
        $this->branchId = $branchId;
    }

    public function collection()
    {
        return StokModel::where('id_cabang', $this->branchId)
                    ->with('produk.kategori') 
                    ->get()
                    ->map(function ($stock) {
                        return [
                            'No' => $stock->id,
                            'Produk' => $stock->produk->nama_produk,
                            'Kategori' => $stock->produk->kategori ? $stock->produk->kategori->nama_kategori : 'Kategori tidak tersedia',
                            'Stok' => $stock->jumlah_stok,
                            'Harga Produk' => 'Rp ' . number_format($stock->produk->harga_produk, 2),
                        ];
                    });
    }
}

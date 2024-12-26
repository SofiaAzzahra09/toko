<?php

namespace App\Exports;

use App\Models\TransaksiModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransactionsExport implements FromCollection
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
        return TransaksiModel::where('id_cabang', $this->branchId)
            ->with(['kasir', 'transaksiDetail.produk.kategori'])
            ->get();
    }

    public function headings(): array
    {
        return [
            'No', 'Kasir', 'Produk', 'Kategori', 'Harga Satuan', 'Jumlah', 'Subtotal', 'Tanggal Transaksi',
        ];
    }
}

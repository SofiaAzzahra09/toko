<?php

namespace Database\Seeders;

use App\Models\TransaksiModel;
use App\Models\UserStore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cabangId = 'cb4';

        $kasir = UserStore::where('peran', 'cashier')
                          ->where('id_cabang', $cabangId)
                          ->first();

        if (!$kasir) {
            echo "Kasir tidak ditemukan.\n";
            return;
        }

        $transaksi = TransaksiModel::create([
            'id_cabang' => $cabangId,
            'id_kasir' => $kasir->id, 
            'total_harga' => 10000.00,
            'total_produk' => 2,
            'tanggal_transaksi' => now(),
        ]);

        $transaksiDetails = [
            [
                'id_transaksi' => $transaksi->id,
                'id_produk' => 1,
                'jumlah' => 1,
                'harga_satuan' => 5000.00,
                'subtotal' => 5000.00,
            ],
            [
                'id_transaksi' => $transaksi->id,
                'id_produk' => 3,
                'jumlah' => 2,
                'harga_satuan' => 15000.00,
                'subtotal' => 2 * 15000.00,
            ],
        ];

        DB::table('transaksi_detail')->insert($transaksiDetails);

        $stokChanges = [];
        foreach ($transaksiDetails as $detail) {
            $stokChanges[] = [
                'id_cabang' => $cabangId,
                'id_produk' => $detail['id_produk'],
                'user_id' => $kasir->id,
                'jumlah' => -$detail['jumlah'], 
                'deskripsi' => 'Pengurangan stok karena penjualan',
                'tanggal_perubahan' => now(),
            ];
        }

        DB::table('stok_changes')->insert($stokChanges);
    }
}

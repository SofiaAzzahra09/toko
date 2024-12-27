<?php

namespace Database\Seeders;

use App\Models\TransaksiModel;
use App\Models\UserStore;
use App\Models\StokModel;
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

        $existingTransaksi = TransaksiModel::where('id_cabang', $cabangId)
                                           ->where('id_kasir', $kasir->id)
                                           ->whereDate('tanggal_transaksi', now()->toDateString()) 
                                           ->first();

        if (!$existingTransaksi) {
            $transaksi = TransaksiModel::create([
                'id_cabang' => $cabangId,
                'id_kasir' => $kasir->id, 
                'total_harga' => 0,
                'total_produk' => 2,
                'tanggal_transaksi' => now(),
            ]);
        } else {
            $transaksi = $existingTransaksi;
        }

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

        foreach ($transaksiDetails as $detail) {
            $existingDetail = DB::table('transaksi_detail')
                                ->where('id_transaksi', $transaksi->id)
                                ->where('id_produk', $detail['id_produk'])
                                ->first();
            
            if (!$existingDetail) {
                DB::table('transaksi_detail')->insert($detail);
            }
        }

        $totalHarga = 0;
        foreach ($transaksiDetails as $detail) {
            $totalHarga += $detail['subtotal']; 
        }

        DB::table('transaksi')
            ->where('id', $transaksi->id)
            ->update(['total_harga' => $totalHarga]);

        $stokChanges = [];
        foreach ($transaksiDetails as $detail) {
            $stokProduk = DB::table('stok_produk')
                            ->where('id_cabang', $cabangId)
                            ->where('id_produk', $detail['id_produk'])
                            ->first();

            if ($stokProduk) {
                $stokChanges[] = [
                    'id_cabang' => $cabangId,
                    'id_produk' => $detail['id_produk'],
                    'user_id' => $kasir->id,
                    'jumlah' => -$detail['jumlah'], 
                    'deskripsi' => 'Pengurangan stok karena penjualan',
                    'tanggal_perubahan' => now(),
                ];

                DB::table('stok_produk')
                  ->where('id_cabang', $cabangId)
                  ->where('id_produk', $detail['id_produk'])
                  ->update([
                      'jumlah_stok' => $stokProduk->jumlah_stok - $detail['jumlah'],
                      'last_updated' => now(),
                  ]);
            }
        }

        // Masukkan perubahan stok ke dalam tabel stok_changes
        DB::table('stok_changes')->insert($stokChanges);
    }
}
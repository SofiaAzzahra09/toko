<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stokData = [
            [
                'id_cabang' => 'cb3',
                'produk' => [
                    ['nama_produk' => 'Indomie Goreng', 'jumlah_stok' => 100],
                    ['nama_produk' => 'Teh Botol Sosro', 'jumlah_stok' => 50],
                ],
            ],
            [
                'id_cabang' => 'cb1',
                'produk' => [
                    ['nama_produk' => 'Indomie Goreng', 'jumlah_stok' => 30],
                    ['nama_produk' => 'Kacang Garuda', 'jumlah_stok' => 75],
                ],
            ],
            [
                'id_cabang' => 'cb1',
                'produk' => [
                    ['nama_produk' => 'Teh Botol Sosro', 'jumlah_stok' => 60],
                    ['nama_produk' => 'Coca-Cola', 'jumlah_stok' => 40],
                ],
            ],
            [
                'id_cabang' => 'cb3', 
                'produk' => [
                    ['nama_produk' => 'Kacang Garuda', 'jumlah_stok' => 43],
                    ['nama_produk' => 'Coca-Cola', 'jumlah_stok' => 20],
                ],
            ],
            [
                'id_cabang' => 'cb4', 
                'produk' => [
                    ['nama_produk' => 'Kacang Garuda', 'jumlah_stok' => 50],
                    ['nama_produk' => 'Teh Botol Sosro', 'jumlah_stok' => 100],
                ],
            ],
            [
                'id_cabang' => 'cb4',
                'produk' => [
                    ['nama_produk' => 'Indomie Goreng', 'jumlah_stok' => 200],
                    ['nama_produk' => 'Kacang Garuda', 'jumlah_stok' => 30],
                ],
            ],
        ];

        foreach ($stokData as $data) {
            foreach ($data['produk'] as $produk) {
                $idProduk = DB::table('produk')
                    ->where('nama_produk', $produk['nama_produk'])
                    ->value('id'); 

                DB::table('stok_produk')->insert([
                    'id_cabang' => $data['id_cabang'],
                    'id_produk' => $idProduk,           
                    'nama_produk' => $produk['nama_produk'],
                    'jumlah_stok' => $produk['jumlah_stok'], 
                    'last_updated' => now(), 
                ]);
            }
        }
    }
}

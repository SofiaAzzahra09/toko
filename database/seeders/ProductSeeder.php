<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
use App\Models\ProdukModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foodCategoryId = DB::table('kategori')->where('nama_kategori', 'Makanan')->value('id_kategori');
        $drinkCategoryId = DB::table('kategori')->where('nama_kategori', 'Minuman')->value('id_kategori');

        DB::table('produk')->insert([
            [
                'nama_produk' => 'Indomie Goreng',
                'id_kategori' => $foodCategoryId,
                'harga_produk' => 3000.00,
            ],
            [
                'nama_produk' => 'Teh Botol Sosro',
                'id_kategori' => $drinkCategoryId, 
                'harga_produk' => 5000.00,
            ],
            [
                'nama_produk' => 'Kacang Garuda',
                'id_kategori' => $foodCategoryId, 
                'harga_produk' => 15000.00,
            ],
            [
                'nama_produk' => 'Coca-Cola',
                'id_kategori' => $drinkCategoryId,
                'harga_produk' => 7000.00,
            ],
            [
                'nama_produk' => 'Mie Sedaap',
                'id_kategori' => $foodCategoryId, 
                'harga_produk' => 2500.00,
            ],
        ]);
    }
}

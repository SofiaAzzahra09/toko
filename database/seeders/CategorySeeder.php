<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'id_kategori' => 'food',
                'nama_kategori' => 'Makanan',
            ],
            [
                'id_kategori' => 'drink',
                'nama_kategori' => 'Minuman',
            ],
        ]);
    }
}

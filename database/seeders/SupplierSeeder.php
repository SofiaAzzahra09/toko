<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 3; $i++) {
            do {
                $namaSupplier = $faker->company;
                $id = strtoupper(substr($namaSupplier, 0, 3)) . rand(10, 99);

                $exists = DB::table('suppliers')->where('id_supplier', $id)->exists();
            } while ($exists);

            DB::table('suppliers')->insert([
                'id_supplier' => $id, 
                'nama_supplier' => $namaSupplier, 
                'telepon' => $faker->phoneNumber, 
                'alamat' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

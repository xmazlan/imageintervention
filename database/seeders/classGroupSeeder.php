<?php

namespace Database\Seeders;

use App\Models\Classgroup;
use Illuminate\Database\Seeder;

class classGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classgroup::insert([
            ['name' => 'Juru Muda'],
            ['name' => 'Juru Muda Tingkat I'],
            ['name' => 'Juru'],
            ['name' => 'Juru Tingkat I'],
            ['name' => 'Pengatur Muda'],
            ['name' => 'Pengatur Muda Tingkat I'],
            ['name' => 'Pengatur'],
            ['name' => 'Pengatur Tingkat I'],
            ['name' => 'Penata Muda'],
            ['name' => 'Penata Muda Tingkat I'],
            ['name' => 'Penata'],
            ['name' => 'Penata Tingkat I'],
            ['name' => 'Pembina'],
            ['name' => 'Pembina Tingkat I'],
            ['name' => 'Pembina Utama Muda'],
            ['name' => 'Pembina Utama Madya'],
            ['name' => 'Pembina Utama']
        ]);
    }
}

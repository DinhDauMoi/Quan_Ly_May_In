<?php

namespace Database\Seeders;

use App\Models\nguoi_dung as ModelsNguoi_dung;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class nguoi_dung extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            ModelsNguoi_dung::create([
                'ten_dang_nhap' => 'admin' . strval($i),
                'mat_khau' => Hash::make('123456' . strval($i))
            ]);
        }
    }
}

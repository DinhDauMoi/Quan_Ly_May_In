<?php

namespace Database\Seeders;

use App\Models\kho as ModelsKho;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class kho extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsKho::create(['ten_kho'=>'Kho 1']);
        ModelsKho::create(['ten_kho' => 'Kho 2']);
        ModelsKho::create(['ten_kho' => 'Kho 3']);
        ModelsKho::create(['ten_kho' => 'Văn phòng']);
        ModelsKho::create(['ten_kho' => 'Điều Vận']);
        ModelsKho::create(['ten_kho' => 'Vacxin']);
        ModelsKho::create(['ten_kho' => 'Nhập']);
    }
}

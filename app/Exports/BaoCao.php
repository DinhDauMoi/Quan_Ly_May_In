<?php

namespace App\Exports;

use App\Models\sua_may_in;
use App\Models\sua_muc_in;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class BaoCao implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [
            'Máy in' => new MayIn(),
            'Mực in' => new MucIn(),
            'Số lượng mực' => new SoLuong(),
        ];

        return $sheets;
    }
}

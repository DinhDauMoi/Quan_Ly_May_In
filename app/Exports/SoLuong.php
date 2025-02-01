<?php

namespace App\Exports;

use App\Models\bao_cao;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SoLuong implements FromCollection, WithMapping, WithTitle, WithHeadings
{
    public function collection()
    {
        return bao_cao::all();
    }

    public function map($baocao): array
    {
        return [
            $baocao->id,
            Carbon::parse($baocao->ngay)->format('Y-m-d'),
            $baocao->so_luong,
        ];
    }

    public function title(): string
    {
        return 'Số lượng mực';
    }

    public function headings(): array
    {
        return [
            'STT',
            'Ngày bơm mực',
            'Số lượng',
        ];
    }
}

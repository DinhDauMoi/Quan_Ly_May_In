<?php

namespace App\Exports;

use App\Models\sua_may_in;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MayIn implements FromCollection, WithMapping, WithTitle, WithHeadings
{
    public function collection()
    {
        return sua_may_in::all();
    }

    public function map($mayIn): array
    {
        $tinhTrang = empty($mayIn->thay_bao_lua) && empty($mayIn->thay_rulo) && empty($mayIn->bao_tri) ? 'OK' : '';
        return [
            $mayIn->id,
            str_pad($mayIn->id_may_in_sua, 3, '0', STR_PAD_LEFT),
            $mayIn->kho ? $mayIn->sua_may_in->ten_kho : 'Không xác định',
            Carbon::parse($mayIn->ngay_bao_hong)->format('Y-m-d'),
            $mayIn->thay_bao_lua,
            $mayIn->thay_rulo,
            $mayIn->bao_tri,
            $mayIn->ghi_chu,
            $tinhTrang,
        ];
    }

    public function title(): string
    {
        return 'Danh sách Máy In';
    }

    public function headings(): array
    {
        return [
            'STT',
            'Tên máy',
            'Kho',
            'Ngày báo hỏng',
            'Bao lụa',
            'Rulo',
            'Bảo trì',
            'Ghi chú',
            'Kiểm tra'
        ];
    }
}

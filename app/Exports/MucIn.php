<?php

namespace App\Exports;

use App\Models\sua_muc_in;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MucIn implements FromCollection, WithMapping, WithTitle, WithHeadings
{
    public function collection()
    {
        return sua_muc_in::all();
    }
    public function map($mucin): array
    {
        return [
            $mucin->id,
            str_pad($mucin->id_muc_in_sua, 3, '0', STR_PAD_LEFT),
            $mucin->kho ? $mucin->sua_muc_in->ten_kho : 'Không xác định',
            Carbon::parse($mucin->ngay_bom_muc)->format('Y-m-d'),
            $mucin->tinh_trang_muc === 'Hết mực' ? 'Hết mực' : 'Còn mực',
            $mucin->thay_drum,
            $mucin->ghi_chu,
        ];
    }

    public function title(): string
    {
        return 'Danh sách Mực In';
    }

    public function headings(): array
    {
        return [
            'STT',
            'Tên mực',
            'Kho',
            'Ngày báo hết mực',
            'Tình trạng',
            'Drum',
            'Ghi chú',
        ];
    }
}

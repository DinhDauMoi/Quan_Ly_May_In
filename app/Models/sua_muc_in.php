<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sua_muc_in extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'sua_muc_in';
    protected $fillable = [
        'id_muc_in_sua',
        'kho',
        'ngay_bom_muc', //ngày bơm mực
        'tinh_trang_muc', //còn hoặc hết
        'thay_drum', //hỏng drum
        'ghi_chu',
    ];
    public function sua_muc_in()
    {
        return $this->belongsTo(kho::class, 'kho');
    }
}

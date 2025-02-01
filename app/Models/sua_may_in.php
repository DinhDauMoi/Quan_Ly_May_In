<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sua_may_in extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'sua_may_in';
    protected $fillable =[
        'id_may_in_sua',
        'kho',
        'ngay_bao_hong', //ngày báo hỏng
        'thay_bao_lua', //thay bao lụa
        'thay_rulo', //thay rulo
        'ghi_chu',
        'bao_tri',
    ];
    public function sua_may_in()
    {
        return $this->belongsTo(Kho::class, 'kho');
    }
}

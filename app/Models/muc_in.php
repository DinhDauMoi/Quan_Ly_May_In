<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class muc_in extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'muc_in';
    protected $fillable = [
        'id_muc_in',
        'kho',
        'trang_thai',
        'ghi_chu'   
    ];
    public function muc_in()
    {
        return $this->belongsTo(kho::class, 'kho');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class nguoi_dung extends Authenticatable
{
    use HasFactory, SoftDeletes;
    protected $table = 'nguoi_dung';
    protected $fillable = [
        'ten_dang_nhap',
        'mat_khau',
    ];
    public function getPasswordAttribute()
    {
        return $this->mat_khau;
    }
}

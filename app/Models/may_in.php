<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class may_in extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'may_in';
    protected $fillable = [
        'id_may_in',
        'kho',
        'trang_thai',
        'ghi_chu'
    ];
    public function may_in()
    {
        return $this->belongsTo(Kho::class, 'kho');
    }
    public function may_in_sua()
    {
        return $this->belongsTo(sua_may_in::class, 'id_may_in');
    }
}

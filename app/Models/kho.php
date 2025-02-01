<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kho extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kho';
    protected $fillable = [
        'ten_kho',
    ];
    public function SuaMayIn()
    {
        return $this->hasMany(sua_may_in::class, 'kho');
    }
}

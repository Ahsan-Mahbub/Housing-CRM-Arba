<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundCategory extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'fund_categories';
    protected $fillable = [
        'name',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}

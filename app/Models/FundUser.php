<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundUser extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'fund_users';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}

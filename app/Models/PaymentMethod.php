<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'payment_methods';
    protected $fillable = [
        'name',
        'details',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}

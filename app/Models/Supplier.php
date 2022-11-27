<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'suppliers';
    protected $fillable = [
        'supplier_name',
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

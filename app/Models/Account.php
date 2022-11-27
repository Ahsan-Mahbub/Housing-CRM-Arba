<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'accounts';
    protected $fillable = [
        'method_id',
        'account_name',
        'price',
        'number',
        'branch',
        'blance',
        'details',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function method(){
        return $this->belongsTo(PaymentMethod::class, 'method_id');
    }
}

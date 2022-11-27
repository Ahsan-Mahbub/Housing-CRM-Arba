<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'transactions';
    protected $fillable = [
        'stock_id',
        'supplier_id',
        'method_id',
        'account_id',
        'date',
        'amount',
    ];

    public function stock(){
        return $this->belongsTo(Stock::class,'stock_id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public function method(){
        return $this->belongsTo(PaymentMethod::class,'method_id');
    }
    public function account(){
        return $this->belongsTo(Account::class,'account_id');
    }
}

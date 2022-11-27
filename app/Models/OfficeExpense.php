<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeExpense extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'office_expenses';
    protected $fillable = [
        'method_id',
        'account_id',
        'reason',
        'amount',
        'date',
        'trx_details',
    ];
    public function method(){
        return $this->belongsTo(PaymentMethod::class,'method_id');
    }
    public function account(){
        return $this->belongsTo(Account::class,'account_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundWithdraw extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'fund_withdraws';
    protected $fillable = [
        'user_id',
        'method_id',
        'account_id',
        'reason',
        'amount',
        'date',
        'trx_details',
    ];

    public function user(){
        return $this->belongsTo(FundUser::class,'user_id');
    }
    public function method(){
        return $this->belongsTo(PaymentMethod::class,'method_id');
    }
    public function account(){
        return $this->belongsTo(Account::class,'account_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'account_transactions';
    protected $fillable = [
        'account_id',
        'type',
        'amount',
        'date',
    ];

    public function account(){
        return $this->belongsTo(Account::class, 'account_id');
    }
}

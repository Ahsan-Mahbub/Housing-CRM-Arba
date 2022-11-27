<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'stocks';
    protected $fillable = [
        'supplier_id',
        'project_id',
        'method_id',
        'account_id',
        'date',
        'purchase_code',
        'total_price',
        'transprotation_cost',
        'grand_total',
        'paid_amount',
        'due',
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public function Project(){
        return $this->belongsTo(Project::class,'project_id');
    }
    public function method(){
        return $this->belongsTo(PaymentMethod::class,'method_id');
    }
    public function account(){
        return $this->belongsTo(Account::class,'account_id');
    }
}

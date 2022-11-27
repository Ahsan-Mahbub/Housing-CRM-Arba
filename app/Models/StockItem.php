<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'stock_items';
    protected $fillable = [
        'stock_id',
        'item_id',
        'purchase_price',
        'qty',
        'discount',
        'sub_total',
    ];

    public function stock(){
        return $this->belongsTo(Stock::class,'stock_id');
    }
    public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }
}

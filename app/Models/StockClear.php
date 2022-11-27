<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockClear extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'stock_clears';
    protected $fillable = [
        'stock_item_id',
        'stock_id',
        'item_id',
        'clear_qty',
        'clear_qty_price'
    ];

    public function stock(){
        return $this->belongsTo(Stock::class,'stock_id');
    }
    public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }
}

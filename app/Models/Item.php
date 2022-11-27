<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'items';
    protected $fillable = [
        'unit_id',
        'item_name',
        'price',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerNotes extends Model
{
    use HasFactory;
    protected $table = 'customer_notes';
    protected $fillable = [
        'customer_id',
        'flat_id',
        'notes'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function flat(){
        return $this->belongsTo(Flat::class,'flat_id');
    }
}

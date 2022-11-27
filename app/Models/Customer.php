<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'customers';
    protected $fillable = [
        'customer_name',
        'phone',
        'email',
        'address',
        'reference_id',
        'creator_ref_id',
        'creator_id',
        'remember_time',
        'notify_status',
    ];

    public function reference(){
        return $this->belongsTo(Reference::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'creator_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignFlat extends Model
{
    use HasFactory;
    protected $table = 'assign_flats';
    protected $fillable = [
        'customer_id',
        'project_id',
        'flat_id',
        'type_id',
        'creator_ref_id',
        'creator_id',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

    public function flat(){
        return $this->belongsTo(Flat::class,'flat_id');
    }

    public function type(){
        return $this->belongsTo(CustomerType::class,'type_id');
    }
}

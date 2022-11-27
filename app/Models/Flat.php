<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'flats';
    protected $fillable = [
        'project_id',
        'flat_name',
        'size',
        'bedroom',
        'bathroom',
        'drawing',
        'dining',
        'balcony',
        'floor',
        'parking',
        'basement',
        'facing',
        'unit',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
}

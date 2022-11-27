<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = 'references';
    protected $fillable = [
        'reference_name',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}

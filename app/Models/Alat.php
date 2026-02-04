<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $fillable = [

    'category_id',
    'name',
    'code',
    'total_qty',
    'good_qty',
    'damaged_qty',
    'lost_qty',
    'borrowed_qty',
    'is_available',
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}

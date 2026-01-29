<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = [
        'name',
        'code',
        'is_active'
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}

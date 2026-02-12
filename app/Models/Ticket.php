<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'alat_id',
        'ticket_number',
        'qty',
        'booked_at',
        'borrowed_at',
        'due_at',
        'returned_at',
        'status',
        'note',
    ];

    public function user(){

    return $this->belongsTo(User::class);
    }
    public function alat(){
        
    return $this->belongsTo(Alat::class);
    }
}

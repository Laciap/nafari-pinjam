<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class AlatReturn extends Model
{
    protected $fillable = [
        'user_id',
        'alat_id',
        'ticket_id',
        'qty',
        'condition',
        'notes',
        'returned_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    protected static function booted()
    {
        static::creating(function(AlatReturn $return)
        {
            if (Auth::check()){
                $return->user_id ??= Auth::id();
            }
            $return->returned_at ??= now();
        });

        static::created(function(AlatReturn $return)
        {
           if($return->ticket){
            $return->ticket->update([
                'status' => 'returned',
                'returned_at' => $return->returned_at
            ]);
           }
        });
    }
}

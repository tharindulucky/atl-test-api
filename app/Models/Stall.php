<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'event_id'];

    public function getEventRel(){
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function getBookingRel(){
        return $this->hasOne(Booking::class, 'stall_id', 'id');
    }
}

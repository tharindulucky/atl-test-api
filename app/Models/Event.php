<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'location', 'long', 'latt', 'start_date', 'end_date'];

    public function getStallsRel(){
        return $this->hasMany(Stall::class, 'event_id', 'id');
    }
}

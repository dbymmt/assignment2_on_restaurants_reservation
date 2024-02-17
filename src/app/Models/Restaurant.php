<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function reservations(){
        return $this->hasMany('App\Models\Reservation');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area');
    }

    public function genre(){
        return $this->belongsTo('App\Models\Genre');
    }

    public function owner(){
        return $this->belongsTo('App\Models\User');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    // use SoftDeletes;

    public $fillable = [
        'user_id',
        'restaurant_id',
        'visitors',
        'scheduled_date',
        'scheduled_time',
        'contact',
    ];


    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function restaurant(){
        return $this->belongsTo('App\Models\Restaurant');
    }
}

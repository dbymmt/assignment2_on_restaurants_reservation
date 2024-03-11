<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public $fillable = [
        'area_id',
        'genre_id',
        'owner_id',
        'name',
        'acceptable_days',
        'detail',
        'image_url',
    ];

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\Owner');
    }

    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');
    }
}

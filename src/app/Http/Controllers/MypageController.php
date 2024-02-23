<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Reservation;

class MypageController extends Controller
{
    //
    public function thanks(){
        return view('thanks');
    }

    public function index(){
        $user = \Auth::user();
        $favorites = Favorite::where('user_id', $user->id)->get();
        $reservations = Reservation::where('user_id', $user->id)-> get();

        return view('mypage', compact('user', 'favorites', 'reservations'));
    }
}

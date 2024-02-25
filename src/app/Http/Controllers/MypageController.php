<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Restaurant;

class MypageController extends Controller
{
    //
    public function thanks(){
        return view('thanks');
    }

    public function index(){
        $user = \Auth::user();

        // 予約
        $reservations = Reservation::where('user_id', $user->id)-> get();

        // レストラン情報
        $restaurants = Restaurant::whereHas('favorites', function($query)use($user){
            $query->where('user_id', $user->id);
        })->get();

        $restaurants->each(function($restaurant)use($user){
            $favorite_id = Favorite::where('user_id', $user->id)
            ->where('restaurant_id', $restaurant->id)->value('id');
            $restaurant->favorite_id = $favorite_id;
        });

        return view('mypage', compact('user', 'reservations', 'restaurants'));
    }

    public function favoriteDelete($favorite_id){
        try{

            $user_id = \Auth::id();

            Favorite::where('user_id', $user_id)
            ->where('id', $favorite_id)
            ->delete();

            return response()->json(true);
            // return 'true';

        } catch(\Exception $e) {
            return response()->json(false);
            // return 'false';
        }
    }

    public function favoriteAdd($restaurant_id){
        $user_id = \Auth::id();

        $favorite = Favorite::create([
            'user_id' => $user_id,
            'restaurant_id' => $restaurant_id,
        ]);

        // $favorite_id = $favorite->id;

        $ret = [
            'result' => true,
            'favorite_id' => $favorite->id,
        ];

        return response()->json($ret);
    }
}

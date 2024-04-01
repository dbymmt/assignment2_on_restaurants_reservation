<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class MypageController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function thanks()
    {
        return view('thanks');
    }

    // index
    public function index()
    {
        $user = \Auth::user();

        // 予約
        $reservations = Reservation::where('user_id', $user->id)->get();

        // レストラン情報
        $restaurants = Restaurant::whereHas('favorites', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        $restaurants->each(function ($restaurant) use ($user) {
            $favorite_id = Favorite::where('user_id', $user->id)
                ->where('restaurant_id', $restaurant->id)->value('id');
            $restaurant->favorite_id = $favorite_id;
        });

        return view('mypage', compact('user', 'reservations', 'restaurants'));
    }

    // お気に入り削除
    public function favoriteDelete($favorite_id)
    {
        try {

            $user_id = \Auth::id();

            Favorite::where('user_id', $user_id)
                ->where('id', $favorite_id)
                ->delete();

            return response()->json(true);
        } catch (\Exception $e) {
            return response()->json(false);
        }
    }

    // お気に入り追加
    public function favoriteAdd($restaurant_id)
    {
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

    // 予約追加
    public function reservationAdd(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = \Auth::id();
        unset($input['_token']);
        unset($input['submitBtn']);

        Reservation::create($input);

        return view('/done');
    }

    // 予約変更
    public function reservationEdit(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = \Auth::id();
        $updated = Reservation::find($input['id'])->update($input);

        $ret = [
            'result' => true,
            'updated' => $updated,
        ];

        return response()->json($ret);
    }

    // 予約削除
    public function reservationDelete(Request $request)
    {
        Reservation::find($request->id)->delete();

        return response()->json(true);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); // ログアウト後にリダイレクトするページを指定
    }
}

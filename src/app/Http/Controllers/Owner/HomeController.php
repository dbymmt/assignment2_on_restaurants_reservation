<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Restaurant;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:owner');
    }

    public function index()
    {
        $user = Auth::user();
        $restaurants = Restaurant::where('owner_id', '=',  $user['id'])->get();
        $areas = Area::all();
        $genres = Genre::all();
        return view('owner.home', compact('user', 'restaurants', 'areas', 'genres'));
    }

    public function detail(Request $request)
    {
        $restaurant = Restaurant::find($request->id);
        $areas = Area::all();
        $genres = Genre::all();
        $reservations = Reservation::where('restaurant_id', '=', $request->id)->get();
        return view('owner.detail', compact('restaurant', 'areas', 'genres', 'reservations'));
    }

    public function restaurantAdd(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        dd($input);

        Restaurant::create($input);

        // return view('owner.home');
        return redirect()->route('owner.home');
    }

    public function restaurantEdit(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        dd($input);

        Restaurant::find($input['id'])->update($input);

        // return view('owner.detail');
        return redirect()->route('owner.detail');
    }

    public function restaurantDelete(Request $request)
    {
        dd($request->id);
        Restaurant::find($request->id)->delete();

        // return view('owner.home');
        return redirect()->route('owner.home');
    }

    public function reservationDelete()
    {
        // 予約削除処理
    }
}

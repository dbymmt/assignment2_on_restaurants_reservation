<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Restaurant;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\Review;

// class HomeController extends Controller
class IndexController extends Controller
{
    //
    public function index()
    {
        $genres = Genre::all();
        $areas = Area::all();
        $restaurants = Restaurant::all();

        // ログイン時はお気に入り情報を付加する
        if (\Auth::id()) {
            $restaurants->each(function ($restaurant) {
                $favoriteId = Favorite::where('user_id', \Auth::id())
                    ->where('restaurant_id', $restaurant->id)
                    ->value('id');
                $restaurant->favorite_id = $favoriteId;
            });
        }


        return view('index', compact('genres', 'areas', 'restaurants'));
    }

    public function detail($restaurant_id)
    {
        $restaurant = Restaurant::find($restaurant_id);
        // 予約猶予用
        $today = Carbon::today();
        $acceptable_day = $restaurant->acceptable_days;
        $acceptDay = $today->addDay($acceptable_day)->format('Y-m-d');

        $reviews = Review::where('restaurant_id', $restaurant_id);

        // レビュー無し
        $score_avg = '評価無し';
        $count = 0;

        // レビュー有り
        if($reviews->count() > 0){
            $score_avg = $reviews->avg('score');
            $count = $reviews->count();    
        }

        return view('detail', compact('restaurant', 'today', 'acceptDay', 'score_avg', 'count'));
    }

    public function search(Request $request)
    {

        $query = Restaurant::query();

        // クエリ生成
        if ($request->input('area')) {
            $query->where('area_id', $request->input('area'));
        }

        if ($request->input('genre')) {
            $query->where('genre_id', $request->input('genre'));
        }

        if ($request->input('keyword')) {
            $query->where('name', 'like', '%' . $request->input('keyword') . '%');
        }

        // テーブルを作成
        $restaurants = $query->with(['area:id,name', 'genre:id,name'])
            ->select('id', 'area_id', 'genre_id', 'name as restaurant_name', 'detail', 'image_url')
            ->get()
            ->map(function ($restaurant) {
                return [
                    'id' => $restaurant->id,
                    'area_id' => $restaurant->area_id,
                    'genre_id' => $restaurant->genre_id,
                    'restaurant_name' => $restaurant->restaurant_name,
                    'detail' => $restaurant->detail,
                    'image_url' => $restaurant->image_url,
                    'area_name' => $restaurant->area->name,
                    'genre_name' => $restaurant->genre->name,
                ];
            });

        return response()->json($restaurants);
    }
}

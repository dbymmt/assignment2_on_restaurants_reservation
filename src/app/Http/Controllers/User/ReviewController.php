<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Carbon\Carbon;
use App\Models\Restaurant;

class ReviewController extends Controller
{
    //
    public function review($id)
    {
        $restaurant_id = $id;
        $restaurant_name = Restaurant::find($id)->name;
        $today = Carbon::now()->format('Y-m-d');
        $reviews = Review::where('restaurant_id', $id)->get();
        $score_avg = '評価無し';
        $count = 0;

        // レビューあり
        if($reviews->count() > 0){
            $score_avg = $reviews->avg('score');
            $count = $reviews->count();    
        }

        return view('review', compact('restaurant_id', 'reviews', 'score_avg', 'count', 'restaurant_name', 'today'));
    }

    public function reviewAdd(Request $request)
    {
        // dd($request->all());
        $input = $request->except('_token');
        $restaurant_id = $input['restaurant_id'];
        // $input['restaurant_id'] = $input['id'];
        // unset($input['id']);

        // dd($input);

        Review::create($input);

        return redirect()->route('user.review', ['id' => $restaurant_id]);
    }

}

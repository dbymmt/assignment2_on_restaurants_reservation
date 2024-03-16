<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Carbon\Carbon;

class ReviewController extends Controller
{
    //
    public function review($id)
    {
        $reviews = Review::where('restaurant_id', $id)->get();
        $score_avg = $reviews->avg('score');
        $count = $reviews->count();
        $restaurant_name = $reviews->first()->restaurant->name;
        $today = Carbon::now()->format('Y-m-d');

        return view(
            'review',
            [
                'reviews' => $reviews,
                'score_avg' => $score_avg,
                'count' => $count,
                'restaurant_name' => $restaurant_name,
                'today' => $today
            ]
        );
    }

    public function reviewAdd(Request $request)
    {
    }
}

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<?php
    // テストデータ
    $restaurants = App\Models\Restaurant::all();

    $restaurants->each(function($restaurant){
        $favoriteId = App\Models\Favorite::where('user_id', 1)
        ->where('restaurant_id', $restaurant->id)
        ->value('id');
        $restaurant->favorite_id = $favoriteId;
    });

?>
<section class="index-favorites">
    @foreach($restaurants as $restaurant)
        @include('part_summary',['restaurant' => $restaurant])
    @endforeach
</section>
@endsection
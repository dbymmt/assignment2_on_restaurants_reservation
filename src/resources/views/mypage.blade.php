@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<?php
    // テストデータ
    $user = App\Models\User::find(2);
    $favorites = App\Models\Favorite::where('user_id', $user->id)->get();
    $reservations = App\Models\Reservation::where('user_id', $user->id)-> get();

?>
<h1 class="mypage-username">{{$user->name}}</h1>
<article class="mypage-body">
    <section class="mypage-reservations">
        <h2 class="mypage-reservation__top">予約状況</h2>
        @foreach($reservations as $reservation)
        <div class="mypage-reservation__main{{$loop->iteration}}">
            <h4 class="mypage-reservation__title"><i class="fa-regular fa-clock"></i>予約{{$loop->iteration}}<i class="fa-regular fa-circle-xmark"></i></h4>
            <dl class="mypage-reservation__detail">
                <dt>Shop</dt><dd id="mypage-reservation__detail-name">{{$reservation->restaurant->name}}</dd>
                <dt>Date</dt><dd id="mypage-reservation__detail-date">{{$reservation->scheduled_date}}</dd>
                <dt>Time</dt><dd id="mypage-reservation__detail-time">{{$reservation->scheduled_time}}</dd>
                <dt>Number</dt><dd id="mypage-reservation__detail-visitors">{{$reservation->visitors}}</dd>
            </dl>
        </div>
        @endforeach
    </section>
    <section class="mypage-favorites">
        <h2 class="mypage-favorites__main-title">お気に入り店舗</h2>
        <div class="mypage-favorites__main">
            @foreach($favorites as $favorite)
                @include('part_summary',['restaurant' => $favorite->restaurant])
            @endforeach
        </div>
    </section>
</article>
@endsection
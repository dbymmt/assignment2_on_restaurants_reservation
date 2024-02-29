@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<h1 class="mypage-username">{{$user->name}}</h1>
<article class="mypage-body" id="mypage">
    <section class="mypage-reservations">
        <h2 class="mypage-reservation__top">予約状況</h2>
        @foreach($reservations as $reservation)
        <div id="mypage-reservation__main{{$loop->iteration}}">
            <h4 class="mypage-reservation__title"><i class="fa-regular fa-clock"></i>予約{{$loop->iteration}}<i class="fa-regular fa-circle-xmark" data-reservation_id = "{{$reservation->id}}"></i></h4>
            <dl class="mypage-reservation__detail">
                <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                <dt>Shop</dt><dd class="mypage-reservation__detail-name" data-restaurant-id="{{$reservation->restaurant_id}}" >{{$reservation->restaurant->name}}</dd>
                <dt>Date</dt>
                <dd class="mypage-reservation__detail-date" data-date="{{$reservation->scheduled_date}}">
                    <input type="date" name="scheduled_date" data-limit="2" value="{{$reservation->scheduled_date}}" disabled>
                </dd>
                <dt>Time</dt>
                <dd class="mypage-reservation__detail-time" >
                    <select name="scheduled_time" id="mypage-reservation__time{{$loop->iteration}}" data-time="{{$reservation->scheduled_time}}" disabled>
                        @for($i=0; $i<24; $i++)
                        <option value="{{$i.':00'}}" {{ (( $i < 10 ? $i = '0'.$i : $i).':00:00') == $reservation->scheduled_time ? "selected" : ""}}>{{$i}}:00</option>
                        @endfor
                    </select>
                </dd>
                <dt>Number</dt>
                <dd class="mypage-reservation__detail-visitors" >
                    <select name="visitors" id="mypage-reservation__visitors{{$loop->iteration}}" data-visitors="{{$reservation->visitors}}" disabled>
                        @for($i=1; $i<9; $i++)
                        <option value="{{$i}}" {{$i == $reservation->visitors ? "selected"  : ""}}>{{$i}}人</option>
                        @endfor
                    </select>
                </dd>
                {{-- <dt>Contact</dt>
                <dd class="mypage-reservation__detail-tel"><input type="text" name="contact" data-tel="{{$reservation->contact}}" value="{{$reservation->contact}}" disabled></dd> --}}
                <button disabled="true">送信</button>
            </dl>
        </div>
        @endforeach
    </section>
    <section class="mypage-favorites">
        <h2 class="mypage-favorites__main-title">お気に入り店舗</h2>
        <div class="mypage-favorites__main">
            @foreach($restaurants as $restaurant)
                @include('part_summary',['restaurant' => $restaurant])
            @endforeach
        </div>
    </section>
</article>
@endsection
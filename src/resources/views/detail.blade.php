@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<article class="detail-main" id="detail">
    <section class="detail-body">
        <h3 class="detail-body__title"><i class="fa-solid fa-less-than" id="detail-body__title-back"></i>{{ $restaurant->name }}</h3>
        <div class="detail-body__img">
            <img src="{{$restaurant->image_url}}" alt="{{$restaurant->name}}">
        </div>
        <div class="detail-body__information">
            <div class="detail-body__tags">
                <span class="detail-body__tag">#{{ $restaurant->area->name }}</span>
                <span class="detail-body__tag">#{{ $restaurant->genre->name }}</span>
            </div>
            <div class="detail-body__detail-phrase">
                {{$restaurant->detail}}
            </div>
        </div>
    </section>

    {{-- 予約(ログインユーザのみ) --}}
    @if(Auth::check())
    <section class="detail-reservation">
        <h3 class="detail-reservation__title">予約</h3>
        <form action="/detail/reservationAdd" method="post">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
            <dl class="detail-reservation__form-body">
                {{-- 日付 --}}
                <dt>Date</dt>
                <dd><input type="date" name="scheduled_date" id="detail-reservation__value-date" min="{{$acceptDay}}"></dd>
                {{-- 時間 --}}
                <dt>Time</dt>
                <dd>
                    <select name="scheduled_time" id="detail-reservation__value-time">
                        @for($i = 0; $i < 24; $i++)
                            <option value="{{$i}}:00">{{$i}}:00</option>
                        @endfor
                    </select>
                </dd>
                {{-- 人数 --}}
                <dt>Number</dt>
                <dd>
                    <select name="visitors" id="detail-reservation__value-visitors">
                        @for($i = 1; $i < 10; $i++)
                            <option value="{{$i}}">{{$i}}人</option>
                        @endfor
                    </select>
                </dd>
                {{-- 連絡先 --}}
                {{-- <dt>Contact</dt>
                <dd><input type="text" name="contact" id="detail-reservation__value-contact"></dd> --}}
            </dl>
            <dl class="detail-reservation__confirm">
                <dt>Shop</dt><dd id="detail-reservation__confirm-name" data-id="{{$restaurant->id}}"></dd>
                <dt>Date</dt><dd id="detail-reservation__confirm-date"></dd>
                <dt>Time</dt><dd id="detail-reservation__confirm-time"></dd>
                <dt>Number</dt><dd id="detail-reservation__confirm-visitors"></dd>
                {{-- <dt>Contact</dt><dd id="detail-reservation__confirm-contact"></dd> --}}
            </dl>
            <input type="submit" name="submitBtn" value="予約する">
        </form>
    </section>
    @endif
</article>


@endsection
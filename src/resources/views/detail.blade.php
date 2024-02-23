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
    <section class="detail-reservation">
        <h3 class="detail-reservation__title">予約</h3>
        <form action="/detail" method="post">
            <div class="detail-reservation__form-body">
                <input type="date" name="date" id="detail-reservation__value-date" min="{{$acceptDay}}">
                <select name="time" id="detail-reservation__value-time">
                    @for($i = 0; $i < 24; $i++)
                        <option value="{{$i}}:00">{{$i}}:00</option>
                    @endfor
                </select>
                <select name="visitors" id="detail-reservation__value-visitors">
                    @for($i = 1; $i < 10; $i++)
                        <option value="{{$i}}">{{$i}}人</option>
                    @endfor
                </select>
            </div>
            <dl class="detail-reservation__confirm">
                <dt>Shop</dt><dd id="detail-reservation__confirm-name"></dd>
                <dt>Date</dt><dd id="detail-reservation__confirm-date"></dd>
                <dt>Time</dt><dd id="detail-reservation__confirm-time"></dd>
                <dt>Number</dt><dd id="detail-reservation__confirm-visitors"></dd>
            </dl>
            <input type="submit" value="予約する">
        </form>
    </section>
</article>


@endsection
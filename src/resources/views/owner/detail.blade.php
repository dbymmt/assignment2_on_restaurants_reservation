@extends('layouts.app-staff')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/detail.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/owner/detail.js') }}"></script>
@endsection

@section('content')

<article class="owner-detail-main" id="owner-detail">
    {{-- 店舗編集 --}}
    <section class="owner-detail-body">
        <h3 class="owner-detail-body__old-restaurant-name">{{$restaurant->name}}を編集</h3>
        <form action="/owner/restaurantEdit" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$restaurant->id}}">
            <input type="hidden" name="owner_id" value="{{Auth::id()}}">
            <p class="owner-detail-body__title"><i class="fa-solid fa-less-than" id="detail-body__title-back"></i>
                店名:<input type="text" name="name" value="{{ $restaurant->name }}">
            </p>
            <div class="owner-detail-body-edit__image-url">
                画像:<input type="file" name="image" onchange="previewImage(this)">
            </div>
            <div class="owner-detail-body__img">
                <img src="{{asset($restaurant->image_url)}}" alt="{{$restaurant->name}}">
            </div>
            <div class="owner-detail-body__information">
                <div class="owner-detail-body__tags">
                    地域:<select name="area_id" id="owner-detail-restaurants-edit__area">
                        <option value="">All Areas</option>
                        @foreach($areas as $area)
                            <option value="{{$area->id}}" {{$area->id === $restaurant->area_id ? "selected" : ""}}>{{$area->name}}</option>
                        @endforeach
                    </select>
                    ジャンル:<select name="genre_id" id="owner-detail-restaurants-edit__genre">
                        <option value="">All Genres</option>
                        @foreach($genres as $genre)
                            <option value="{{$genre->id}}" {{$genre->id === $restaurant->genre_id ? "selected": ""}}>{{$genre->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="owner-detail-body-edit__acceptable-days">
                    予約猶予日数:<input type="text" name="acceptable_days" id="owner-detail-restaurants-edit__acceptable-days" value="{{$restaurant->acceptable_days}}">
                </div>
                <div class="owner-detail-body__detail-phrase">
                    詳細:<textarea name="detail" id="" cols="30" rows="10">{{$restaurant->detail}}</textarea>
                </div>
            </div>
            <div class="owner-detail-body__detail-submit">
                <button id="owner-detail-body__submit">この内容で編集する</button>
            </div>
        </form>
        <form action="/owner/restaurantDelete?id={{$restaurant->id}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="店舗を削除する">
        </form>
    </section>

    {{-- 予約(ログインユーザのみ) --}}
    <section class="owner-detail-reservations-settings">
        <div class="owner-detail-reservations">
            <h3 class="owner-detail-reservation__top">{{$restaurant->name}}の予約状況</h3>
            @if($reservations->isEmpty())
                <h3 class="owner-detail-reservation__null">予約はありません</h3>
            @endif
            @foreach($reservations as $reservation)
            <div id="owner-detail-reservation__main{{$loop->iteration}}">
                <h4 class="owner-detail-reservation__title">◆予約{{$loop->iteration}}<i class="fa-regular fa-circle-xmark" data-reservation_id = "{{$reservation->id}}"></i></h4>
                <dl class="owner-detail-reservation__body">
                    <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                    <dt>Date</dt>
                    <dd class="owner-detail-reservation__detail-date" data-date="{{$reservation->scheduled_date}}">
                        {{$reservation->scheduled_date}}
                    </dd>
                    <dt>Time</dt>
                    <dd class="owner-detail-reservation__detail-time" >
                        {{$reservation->scheduled_time}}
                    </dd>
                    <dt>Number</dt>
                    <dd class="owner-detail-reservation__detail-visitors" >
                        {{$reservation->visitors}}
                    </dd>
                    <button disabled="true">送信</button>
                </dl>
            </div>
            @endforeach
        </div>
    </section>
</article>


@endsection
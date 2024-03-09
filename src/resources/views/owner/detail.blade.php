@extends('layouts.app-staff')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner/detail.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/owner/detail.js') }}"></script>
@endsection

@section('content')

<article class="owner-detail-main" id="owner-detail">
    {{-- 店舗編集 --}}
    <section class="owner-detail-body">
        <h3 class="owner-detail-body__old-restaurant-name">{{$restaurant->name}}を編集</h3>
        <form action="/owner/home/restaurantEdit" method="post">
            @csrf
            <h3 class="owner-detail-body__title"><i class="fa-solid fa-less-than" id="owner-detail-body__title-back"></i>
                <input type="text" name="name" value="{{ $restaurant->name }}">
            </h3>
            <div class="owner-detail-body-edit__image-url">
                <input type="text" name="image_url" value="{{$restaurant->image_url}}">
            </div>
            <div class="owner-detail-body__img">
                <img src="{{$restaurant->image_url}}" alt="{{$restaurant->name}}">
            </div>
            <div class="owner-detail-body__information">
                <div class="owner-detail-body__tags">
                    <select name="area" id="owner-detail-restaurants-edit__area">
                        <option value="">All Areas</option>
                        @foreach($areas as $area)
                            <option value="{{$area->id}}" {{$area->id === $restaurant->area_id ? "selected" : ""}}>{{$area->name}}</option>
                        @endforeach
                    </select>
                    <select name="genre" id="owner-detail-restaurants-edit__genre">
                        <option value="">All Genres</option>
                        @foreach($genres as $genre)
                            <option value="{{$genre->id}}" {{$genre->id === $restaurant->genre_id ? "selected": ""}}>{{$genre->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="owner-detail-body__detail-phrase">
                    <textarea name="detail" id="" cols="30" rows="10">{{$restaurant->detail}}</textarea>
                </div>
            </div>
            <div class="owner-detail-body__detail-submit">
                <input type="submit" value="この内容で編集する">
            </div>
        </form>
        <form action="/owner/detail/restaurantDel/{{$restaurant->id}}">
            @csrf
            @method('delete')
            <input type="submit" value="店舗を削除する">
        </form>
    </section>

    {{-- 予約(ログインユーザのみ) --}}
    <section class="owner-detail-reservations-settings">
        <div class="owner-detail-reservations">
            <h3 class="owner-detail-reservation__top">{{$restaurant->name}}の予約状況</h3>
            @foreach($reservations as $reservation)
            <div id="owner-detail-reservation__main{{$loop->iteration}}">
                <h4 class="owner-detail-reservation__title">◆予約{{$loop->iteration}}<i class="fa-regular fa-circle-xmark" data-reservation_id = "{{$reservation->id}}"></i></h4>
                <dl class="owner-detail-reservation__body">
                    <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                    <dt>Date</dt>
                    <dd class="owner-detail-reservation__detail-date" data-date="{{$reservation->scheduled_date}}">
                        {{-- <input type="date" name="scheduled_date" data-limit="2" value="{{$reservation->scheduled_date}}" disabled> --}}
                        {{$reservation->scheduled_date}}
                    </dd>
                    <dt>Time</dt>
                    <dd class="owner-detail-reservation__detail-time" >
                        {{-- <select name="scheduled_time" id="owner-detail-reservation__time{{$loop->iteration}}" data-time="{{$reservation->scheduled_time}}" disabled>
                            @for($i=0; $i<24; $i++)
                            <option value="{{$i.':00'}}" {{ (( $i < 10 ? $i = '0'.$i : $i).':00:00') == $reservation->scheduled_time ? "selected" : ""}}>{{$i}}:00</option>
                            @endfor
                        </select> --}}
                        {{$reservation->scheduled_time}}
                    </dd>
                    <dt>Number</dt>
                    <dd class="owner-detail-reservation__detail-visitors" >
                        {{-- <select name="visitors" id="owner-detail-reservation__visitors{{$loop->iteration}}" data-visitors="{{$reservation->visitors}}" disabled>
                            @for($i=1; $i<9; $i++)
                            <option value="{{$i}}" {{$i == $reservation->visitors ? "selected"  : ""}}>{{$i}}人</option>
                            @endfor
                        </select> --}}
                        {{$reservation->visitors}}
                    </dd>
                    <button disabled="true">送信</button>
                </dl>
            </div>
            @endforeach
        </div>
        <div class="owner-detail-settings">
            <h3 class="owner-detail-settings__title">{{$restaurant->name}}の情報</h3>
            <dl class="owner-detail-settings__body">
                <dt class="owner-detail-settings__margin-days">予約猶予</dt>
                <dd class="owner-detail-settings__margin-days">
                    中
                    <select name="margin_days" id="owner-detail-settings__margin">
                        @for($i = 1; $i < 10; $i++)
                            <option value="{{$i}}">{{$i}}日</option>
                        @endfor
                    </select>
                </dd>
                <dt class="owner-detail-settings__available-visitos">受け入れ可能人数</dt>
                <dd class="owner-detail-settings__available-visitors">
                    <select name="available-visitors" id="owner-detail-settings__visitor">
                        @for($i = 1; $i < 10; $i++)
                            <option value="{{$i}}">{{$i}}人</option>
                        @endfor
                    </select>
                </dd>
            </dl>
        </div>
    </section>
</article>


@endsection
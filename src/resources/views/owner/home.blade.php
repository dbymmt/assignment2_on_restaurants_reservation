@extends('layouts.app-staff')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/owner/home.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/owner/home.js') }}"></script>
@endsection

@section('content')
<h1 class="owner-index-restaurants__title">{{Auth::guard('owner')->check() ? $user['name'] : ''}}様の店舗一覧</h1>
<article class="owner-index-restaurants" id="owner-home">
    <section class="owner-index-restaurants-body">
        <h4 class="owner-index-restaurants-body__title">店舗一覧</h4>
        <div class="index-restaurants-body__lists">
            @foreach($restaurants as $restaurant)
                @include('part_summary',['restaurant' => $restaurant])
            @endforeach
        </div>
    </section>
    <section class="owner-index-restaurants__add">
        <h4 class="owner-index-restaurants-add__title">店舗新規登録</h4>
        <dl class="owner-index-restaurants__add-body">
            <form action="/owner/restaurantAdd" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="owner_id" value="{{$user['id']}}">
                <dt class="owner-index-restaurants-add__name">店名：</dt>
                @error('name')
                    <span class="owner-index-restaurants-add__error" role="alert">
                        {{ $message }}
                    </span>
                @enderror
                <dd class="owner-index-restaurants-add__name">
                    <input type="text" id="owner-index-restaurants-add__name" name="name">
                </dd>
                <dt class="owner-index-restaurants-add__image">画像：</dt>
                @error('image')
                    <span class="owner-index-restaurants-add__error" role="alert">
                        {{ $message }}
                    </span>
                @enderror
                <dd class="owner-index-restaurants-add__image">
                    <input type="file" id="owner-index-restaurants-add__image" name="image">
                </dd>
                <dt class="owner-index-restaurants-add__area">エリア：</dt>
                @error('area_id')
                    <span class="owner-index-restaurants-add__error" role="alert">
                        {{ $message }}
                    </span>
                @enderror
                <dd class="owner-index-restaurants-add__area">
                    <select name="area_id" id="owner-index-restaurants-add__area">
                        <option value="">All Areas</option>
                        @foreach($areas as $area)
                            <option value="{{$area->id}}">{{$area->name}}</option>
                        @endforeach
                    </select>
                </dd>
                <dt class="owner-index-restaurants-add__genre">ジャンル：</dt>
                @error('genre_id')
                    <span class="owner-index-restaurants-add__error" role="alert">
                        {{ $message }}
                    </span>
                @enderror
                <dd class="owner-index-restaurants-add__genre">
                    <select name="genre_id" id="owner-index-restaurants-add__genre">
                        <option value="">All Genres</option>
                        @foreach($genres as $genre)
                            <option value="{{$genre->id}}">{{$genre->name}}</option>
                        @endforeach
                    </select>
                </dd>
                <dt class="owner-index-restaurants-add__acceptable-days">予約猶予日数：</dt>
                @error('acceptable_days')
                    <span class="owner-index-restaurants-add__error" role="alert">
                        {{ $message }}
                    </span>
                @enderror
                <dd class="owner-index-restaurants-add__acceptable-days">
                    <input type="text" id="owner-index-restaurants-add__acceptable-days" name="acceptable_days" value="2">
                </dd>
                <dt class="owner-index-restaurants-add__detail">詳細：</dt>
                @error('detail')
                    <span class="owner-index-restaurants-add__error" role="alert">
                        {{ $message }}
                    </span>
                @enderror
                <dd class="owner-index-restaurants-add__detail">
                    <textarea name="detail" id="owner-index-restaurants-add__detail" cols="30" rows="10"></textarea>
                </dd>
                <div class="owner-index-restaurants-add-form">
                    <button id="owner-index-restaurants-add__submit">店舗追加</button>
                </div>
            </form>
        </dl>
        <div class="owner-index-mail">
            <a href="{{route('owner.mailIndex')}}">お知らせ作成/送信</a>
        </div>
    </section>
</article>
@endsection
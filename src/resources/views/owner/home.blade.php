@extends('layouts.app-staff')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/owner/home.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/owner/index.js') }}"></script>
@endsection

@section('content')
<h1 class="owner-index-restaurants__title">{{Auth::guard('owner')->check() ? $user['name'] : ''}}様の店舗一覧</h1>
<article class="owner-index-restaurants" id="owner-index">
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
            <form action="/owner/add" method="POST">
                <dt class="owner-index-restaurants-add__name">店名：</dt>
                <dd class="owner-index-restaurants-add__name">
                    <input type="text" id="owner-index-restaurants-add__name" name="name">
                </dd>
                <dt class="owner-index-restaurants-add__image-url">画像URL：</dt>
                <dd class="owner-index-restaurants-add__image-url">
                    <input type="text" id="owner-index-restaurants-add__image-url" name="image_url">
                </dd>
                <dt class="owner-index-restaurants-add__area">エリア：</dt>
                <dd class="owner-index-restaurants-add__area">
                    <select name="area" id="owner-index-restaurants-add__area">
                        <option value="">All Areas</option>
                        @foreach($areas as $area)
                            <option value="{{$area->id}}">{{$area->name}}</option>
                        @endforeach
                    </select>
                </dd>
                <dt class="owner-index-restaurants-add__genre">ジャンル：</dt>
                <dd class="owner-index-restaurants-add__genre">
                    <select name="genre" id="owner-index-restaurants-add__genre">
                        <option value="">All Genres</option>
                        @foreach($genres as $genre)
                            <option value="{{$genre->id}}">{{$genre->name}}</option>
                        @endforeach
                    </select>
                </dd>
                <dt class="owner-index-restaurants-add__detail">詳細：</dt>
                <dd class="owner-index-restaurants-add__detail">
                    <textarea name="detail" id="owner-index-restaurants-add__detail" cols="30" rows="10"></textarea>
                </dd>
                <div class="owner-index-restaurants-add-form">
                    <input type="submit" value="店舗追加">
                </div>
            </form>
        </dl>
    </section>
</article>
@endsection
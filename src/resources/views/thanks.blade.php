@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks_done.css') }}">
@endsection

@section('content')
<article class="thanks-done-main" id="thanks-main">
    <h4 class="thanks-done-message">会員登録ありがとうございます</h4>
    <p class="thanks-done-button"><button onclick="location.href='/login'">ログインする</button></p>
</article>
@endsection
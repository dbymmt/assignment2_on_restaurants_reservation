@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks_done.css') }}">
@endsection

@section('content')
<article class="thanks-done-main">
    <h4 class="thanks-done-message">会員登録ありがとうございます</h4>
    <button value="ログインする"></button>
</article>
@endsection
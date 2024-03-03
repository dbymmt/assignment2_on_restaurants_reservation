@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks_done.css') }}">
@endsection

@section('content')
<article class="thanks-done-main" id="done-main">
    <h4 class="thanks-done-message">ご予約ありがとうございます</h4>
    <p class="thanks-done-button"><button>戻る</button></p>
</article>
@endsection
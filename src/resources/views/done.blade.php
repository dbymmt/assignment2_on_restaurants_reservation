@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks_done.css') }}">
@endsection

@section('content')
<article class="thanks-done-main">
    <h4 class="thanks-done-message">ご予約ありがとうございます</h4>
    <button value="戻る"></button>
</article>
@endsection
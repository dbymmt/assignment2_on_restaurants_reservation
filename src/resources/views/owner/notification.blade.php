@extends('layouts.app-staff')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('js')
{{-- <script src="{{ asset('js/owner/home.js') }}"></script> --}}
@endsection

@section('content')
<article class="notification-body" id="notification-body">
    <h1>お知らせメール</h1>

    <p>こんにちは、{{ $user->name }}さん。</p>

    <textarea name="message" id="message" cols="30" rows="10">
        ここにメールの本文を記述します。
    </textarea>

    <p>
        解約を希望する場合は、以下のリンクをクリックしてください。<br>
        <a href="{{ url("/user/mail/exit?user_mail={$user->email}") }}">解約はこちら</a>
    </p>

    <a href="{{route('owner.sendMail')}}">メール送信</a>
</article>
@endsection
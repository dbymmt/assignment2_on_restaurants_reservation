@extends('layouts.app-staff')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('js')
@endsection

@section('content')
<article class="template-message" id="template-message">
    <form action="{{ route('owner.sendMail') }}" method="POST">
        @csrf
        <div class="template-message-body__title">
            以下にお客様へのメッセージを入力してください
        </div>
        @error('mail_template')
            <div class="template-message-body__error" role="alert">
                {{ $message }}
            </div>
        @enderror
        @if(session('message'))
            <div class="template-message-body__message">
                メッセージ送信完了しました。
            </div>
        @endif
        <textarea name="mail_template" id="mail_template" cols="30" rows="10"></textarea>
        <button type="submit">送信</button>
    </form>
</article>
@endsection
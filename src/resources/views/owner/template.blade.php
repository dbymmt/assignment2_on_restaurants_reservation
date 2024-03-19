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
        <textarea name="mail_template" id="mail_template" cols="30" rows="10"></textarea>
        <button type="submit">送信</button>
    </form>
</article>
@endsection
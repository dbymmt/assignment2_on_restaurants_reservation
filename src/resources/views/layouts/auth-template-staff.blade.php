@extends('layouts.app-staff')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth-template.css')}}">
<link rel="stylesheet" href="{{ asset('css/register_login.css') }}">
@endsection

@section('content')
    <article class="auth-template-main">
        <h4 class="auth-template-title">@yield('title')</h4>
        @yield('auth-content')
    </article>
@endsection
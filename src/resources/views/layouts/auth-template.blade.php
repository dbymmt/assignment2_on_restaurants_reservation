@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth_template.css')}}">
<link rel="stylesheet" href="{{ asset('css/register_login.css') }}">
@endsection

@section('content')
    <article class="auth-template-body">
        <h3 class="aut-template-title">@yield('title')</h3>
        @yield('auth-content')
    </article>
@endsection
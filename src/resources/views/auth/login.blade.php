@extends('layouts.auth-template')

@section('title', 'Login')

@section('auth-content')
<section class="register_login__body">
    <form action="/login" method="post">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="ログイン">
    </form>
</section>

@endsection
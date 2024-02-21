@extends('layouts.auth-template')

@section('title', 'Register')

@section('auth-content')
<section class="register_login__body">
    <form action="/register" method="post">
        <input type="text" name="name" placeholder="Username">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="登録">
    </form>
</section>

@endsection
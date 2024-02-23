@extends('layouts.auth-template')

@section('title', 'Registration')

@section('auth-content')
<section class="register_login__body">
    <form action="/register" method="post">
        @csrf
        <p class="register_login__body-input"><i class="fa-solid fa-user"></i><input type="text" name="name" placeholder="Username"></p>
        <p class="register_login__body-input"><i class="fa-solid fa-envelope"></i><input type="text" name="email" placeholder="Email"></p>
        <p class="register_login__body-input"><i class="fa-solid fa-lock"></i><input type="password" name="password" placeholder="password"></p>
        <p class="register_login__body-submit"><input type="submit" value="登録"></p>
    </form>
</section>

@endsection
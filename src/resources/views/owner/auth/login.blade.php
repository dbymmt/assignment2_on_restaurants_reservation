@extends('layouts.auth-template-staff')

@section('title', 'Owner-Login')

@section('auth-content')
<section class="register_login__body">
    <form action="{{ route('owner.login') }}" method="post">
        @csrf
        <ul class="register_login__errors-email">
        {{-- @if($errors->has('email'))
            @foreach($errors->get('email') as $message)
            <li>{{ $message }}</li>
            @endforeach
        @endif --}}
        @include('auth.errors', ['input' => 'email'])
        </ul>
        <p class="register_login__body-input"><i class="fa-solid fa-envelope"></i><input type="text" name="email" placeholder="Email"></p>
        @include('auth.errors', ['input' => 'password'])
        <p class="register_login__body-input"><i class="fa-solid fa-lock"></i><input class="register_login__body-input" type="password" name="password" placeholder="password"></p>
        <p class="register_login__body-submit"><input type="submit" value="ログイン"></p>
    </form>
</section>

@endsection
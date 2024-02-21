@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<?php
    // テストデータ
    $restaurant = App\Models\Restaurant::first();
?>
<section class="index-favorites">
    @for($i = 0; $i < 10; $i++)
        @include('part_summary',['restaurant' => $restaurant])
    @endfor
</section>
@endsection
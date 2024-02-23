@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<article class="index-restaurants" id="index">
    @foreach($restaurants as $restaurant)
        @include('part_summary',['restaurant' => $restaurant])
    @endforeach
</article>
@endsection
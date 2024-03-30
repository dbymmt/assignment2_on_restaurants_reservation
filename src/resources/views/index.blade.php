@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/index.js') }}"></script>
@endsection

@section('content')
<article class="user-index-restaurants">
    <section class="index-restaurants-body">
        <div class="index-restaurants-body__lists" id="index">
            @foreach($restaurants as $restaurant)
                @include('part_summary',['restaurant' => $restaurant])
            @endforeach
        </div>
    </section>
</article>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/review.js') }}"></script>
@endsection

@section('content')

<article class="review-main" id="review-main">
    <section class="review-title">
        <dl class="review-title__restaurant">
            <dt class="review-title__restaurant-name">レストラン：</dt>
            <dd class="review-title__restaurant-name">{{$restaurant_name}}</dd>
            <dt class="review-title__restaurant-avg-score">評価点：</dt>
            <dd class="review-title__restaurant-avg-score">{{$score_avg}}</dd>
            <dt class="review-title__restaurant-review-number">レビュー数：</dt>
            <dd class="review-title__restaurant-review-number">{{$count}}件</dd>
        </dl>
    </section>
    <section class="review-form-input">
        <dl class="review-form-input__form">
        <form action="/user/review/reviewAdd" method="post">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{$restaurant_id}}">
            <input type="hidden" name="user_id" value="{{Auth::id()}}">
            <dt class="review-form-input__form-visited-date">あなたの訪問日：</dt>
            <dd id="review-form-input__form-visited-date">
                <input type="date" name="visited_date" max="{{$today}}">
            </dd>
            <dt class="review-form-input__form-score">あなたの評価点：</dt>
            <dd id="review-form-input__form-score">
                <input type="radio" name="score" value="5">5
                <input type="radio" name="score" value="4">4
                <input type="radio" name="score" value="3">3
                <input type="radio" name="score" value="2">2
                <input type="radio" name="score" value="1">1
            </dd>
            <dt class="review-form-input__form-comment">コメント：</dt>
            <dd id="review-form-input__form-comment">
                <textarea name="comment" id="review-form-input__form-comment" cols="30" rows="10"></textarea>
            </dd>
            <div class="review-form-input__submit">
                <input type="submit" value="投稿する">
            </div>
        </form>
        </dl>
    </section>
    <section class="review-reviews">
        @if($reviews->count() > 0)
        @foreach($reviews as $review)
            <dl id="review-reviews-body{{$loop->iteration}}">
                <dt class="review-reviews-body__review-score">点数：</dt>
                <dd id="review-reviews-body__review-score">
                    {{$review->score}}
                </dd>
                <dt class="review-reviews-body__review-user">投稿者：</dt>
                <dd id="review-reviews-body__review-user">
                    {{$review->user->name}}
                </dd>
                <dt class="review-reviews-body__review-created-at">投稿日：</dt>
                <dd id="review-reviews-body__review-created-at">
                    {{$review->created_at}}
                </dd>
                <dt class="review-reviews-body__review-visited-date">訪問日：</dt>
                <dd id="review-reviews-body__review-visited-date">
                    {{$review->visited_date}}
                </dd>
                <dt class="review-reviews-body__review-comment">コメント：</dt>
                <dd id="review-reviews-body__review-comment">
                    {{$review->comment}}
                </dd>
            </dl>
            @endforeach
        @else
            <h2 class="review-reviews__nothing">レビューがまだありません</h2>
        @endif            
        
        
    </section>
</article>
@endsection
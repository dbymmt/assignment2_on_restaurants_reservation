<div id="part-summary-restaurant{{$restaurant->id}}">
    <div class="part-summary__img">
        <img src="{{ asset($restaurant->image_url) }}" alt="{{$restaurant->name}}">
    </div>
    <div class="part-summary__detail">
        <h3 class="part-summary__detail-name">
            {{ $restaurant->name }}
        </h3>
        <span class="part-summary__detail-tag">#{{ $restaurant->area->name }}</span>
        <span class="part-summary__detail-tag">#{{ $restaurant->genre->name }}</span>
        <div class="part-summary__detail-detail-heart">
            @if(Auth::guard('owner')->check() && request()->path() === 'owner/home')
                <a href="/owner/detail/{{$restaurant->id}}">編集する</a>
            @else
                <a href="/detail/{{$restaurant->id}}">詳しく見る</a>
            @endif
            @if(Auth::check())
                <span id="part-summary__detail-detail-restaurant{{$restaurant->id}}-heart">
                    @if($restaurant->favorite_id)
                        <i class="fa-solid fa-heart" id="favorite_{{$restaurant->favorite_id}}" data-restaurant="{{$restaurant->id}}"></i>
                    @else
                        <i class="fa-regular fa-heart" data-restaurant="{{$restaurant->id}}"></i>
                    @endif
                </span>
            @endif
        </div>
    </div>
</div>
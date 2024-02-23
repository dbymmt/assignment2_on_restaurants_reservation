<div class="part-summary">
    <div class="part-summary__img">
        <img src="{{ $restaurant->image_url }}" alt="{{$restaurant->name}}">
    </div>
    <div class="part-summary__detail">
        <h3 class="part-summary__detail-name">
            {{ $restaurant->name }}
        </h3>
        <span class="part-summary__detail-tag">#{{ $restaurant->area->name }}</span>
        <span class="part-summary__detail-tag">#{{ $restaurant->genre->name }}</span>
        <div class="part-summary__detail-detail-heart">
            <a href="/detail/{{$restaurant->id}}">詳しく見る</a>
            <span>
                @if($restaurant->favorite_id)
                    <i class="fa-solid fa-heart" id="favorite_{{$restaurant->favorite_id}}"></i>
                @else
                    <i class="fa-regular fa-heart" id="restaurant_{{$restaurant->id}}"></i>
                @endif
            </span>
        </div>
    </div>
</div>
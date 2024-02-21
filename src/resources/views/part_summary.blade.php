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
            <a href="#">詳しく見る</a><i class="fa-solid fa-heart"></i>
        </div>
    </div>
</div>
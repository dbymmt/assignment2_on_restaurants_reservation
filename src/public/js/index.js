
document.addEventListener('DOMContentLoaded', function () {
    // indexページ //
    if (document.querySelector('[id="index"]') != null) {

        ////////////////////////
        // 検索メニューによる検索
        ////////////////////////

        // セレクトボックスとテキスト入力の要素を取得
        let areaSelect = document.querySelector('select[name="area"]');
        let genreSelect = document.querySelector('select[name="genre"]');
        let keywordInput = document.querySelector('input[name="keyword"]');

        // セレクトボックスが変更されたときの処理
        areaSelect.addEventListener('change', function () {
            search();
        });

        genreSelect.addEventListener('change', function () {
            search();
        });

        // テキスト入力が変更されたときの処理
        keywordInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') search();
        });

        // 検索を実行する関数
        function search() {
            let area = areaSelect.value;
            let genre = genreSelect.value;
            let keyword = keywordInput.value;

            axios.get(`/search?area=${area}&genre=${genre}&keyword=${keyword}`)
                .then(response => {
                    const restaurants = response.data;
                    let indexRestaurants = document.querySelector('.index-restaurants-body');
                    indexRestaurants.innerHTML = '';

                    restaurants.forEach(restaurant => {
                        const partSummary = `
                        <div id="part-summary-restaurant${restaurant.id}">
                            <div class="part-summary__img">
                                <img src="${restaurant.image_url}" alt="${restaurant.restaurant_name}">
                            </div>
                            <div class="part-summary__detail">
                                <h3 class="part-summary__detail-name">
                                    ${restaurant.restaurant_name}
                                </h3>
                                <span class="part-summary__detail-tag">#${restaurant.area_name}</span>
                                <span class="part-summary__detail-tag">#${restaurant.genre_name}</span>
                                <div class="part-summary__detail-detail-heart">
                                    <a href="/detail/${restaurant.id}">詳しく見る</a>
                                    ${restaurant.favorite_id ? `<i class="fa-solid fa-heart" id="favorite_${restaurant.favorite_id}"></i>` : `<i class="fa-regular fa-heart" id="restaurant_${restaurant.id}"></i>`}
                                </div>
                            </div>
                        </div>
                    `;
                        indexRestaurants.insertAdjacentHTML('beforeend', partSummary);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }

        /////////////////
        // お気に入り追加
        /////////////////
        toFavoriteIcons = document.querySelectorAll('.part-summary__detail-detail-heart .fa-heart');

        toFavoriteIcons.forEach(function (icon) {
            icon.addEventListener('click', function (event) {
                let restaurantId = icon.dataset.restaurant;

                if (icon.classList.contains('fa-regular')) {
                    const confirmAdd = confirm('追加しますか？');
                    if (confirmAdd === true) {
                        axios.post(`/user/mypage/favoriteAdd/${restaurantId}`)
                            .then(response => {
                                if (response.data.result === true) {
                                    icon.classList.remove('fa-regular');
                                    icon.classList.add('fa-solid');
                                    icon.id = `favorite_${response.data.favorite_id}`;
                                }
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                } else if (icon.classList.contains('fa-solid')) {
                    let favoriteId = icon.getAttribute('id').replace('favorite_', '');
                    const confirmDel = confirm('削除しますか');
                    if (confirmDel === true) {
                        axios.delete(`/user/mypage/favoriteDelete/${favoriteId}`)
                            .then(response => {
                                if (response.data === true) {
                                    icon.classList.remove('fa-solid');
                                    icon.classList.add('fa-regular');
                                    icon.id = '';
                                }
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                }
            });
        });
    }
});
//////////////////
// お気に入り外し
//////////////////
function favoriteIconDelete(callFunc) {
    let favoriteIcons = document.querySelectorAll('.part-summary__detail-detail-heart .fa-solid');

    favoriteIcons.forEach(function (icon) { 
        icon.addEventListener('click', function (event) { 
            let favoriteId = icon.getAttribute('id').replace('favorite_', '');
            let restaurantId = icon.closest('[id*="part-summary-restaurant"]').getAttribute('id').replace('part-summary-restaurant', '');
            const confirmDel = confirm('削除しますか');
            if(confirmDel === true){
                axios.delete(`/mypage/favoriteDelete/${favoriteId}`)
                    .then(response => {
                        if (response.data === true) {
                            callFunc(restaurantId);
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    });
}



document.addEventListener('DOMContentLoaded', function () { 

    ///////////////////////////
    // メニューオープンクローズ
    ///////////////////////////
    let menu_open = document.getElementById('header__menu-open');
    let menu_close = document.getElementById('header__menu-close');
    menu_open.addEventListener('click', function () {
        document.getElementById('header__nav').classList.add("active");

        menu_close.addEventListener('click', function () { 
            document.getElementById('header__nav').classList.remove("active");
        });
    });


    // detailページ //
    if(document.querySelector('[id="detail"]') != null){

        //////////////
        // 予約確認
        //////////////

        if(document.querySelector('[class*="detail-reservation"]')){
            // 予約確認対象要素
            let confirm_restaurant = document.getElementById('detail-reservation__confirm-name');
            let confirm_date = document.getElementById('detail-reservation__confirm-date');
            let confirm_time = document.getElementById('detail-reservation__confirm-time');
            let confirm_visitors = document.getElementById('detail-reservation__confirm-visitors');

            // 店名
            confirm_restaurant.textContent = document.getElementsByClassName('detail-body__title')[0].textContent;

            // 日付
            document.getElementById('detail-reservation__value-date').addEventListener('input', function () {

                // 日数制限(中何日開けるか)
                let limitDays = 1;
                // 入力日
                let inputDate = new Date(this.value);
                // 今日
                let today = new Date();
                // 最短予約許可
                let leastDate = new Date();
                leastDate.setDate(today.getDate() + limitDays);

                if (inputDate < leastDate) {
                    // alert('予約は今日から' + limitDays + '以降に設定してください');
                    confirm_date.textContent = '予約は今日から'+limitDays+'以降にしてください';
                }
                else {
                    confirm_date.textContent = this.value;
                }

            });

            // 時間
            document.getElementById('detail-reservation__value-time').addEventListener('input', function () { 
                confirm_time.textContent = this.value;
            });

            // 人数
            document.getElementById('detail-reservation__value-visitors').addEventListener('input', function () { 
                confirm_visitors.textContent = this.value + '人';
            });

        }

        //////////////
        // 戻るボタン
        //////////////
        const back = document.getElementById('detail-body__title-back');
        back.addEventListener('click', (e) => { history.back(); return false; });
    }

    // indexページ //
    if(document.querySelector('[id="index"]') != null){

        ////////////////////////
        // 検索メニューによる検索
        ////////////////////////

        // セレクトボックスとテキスト入力の要素を取得
        const areaSelect = document.querySelector('select[name="area"]');
        const genreSelect = document.querySelector('select[name="genre"]');
        const keywordInput = document.querySelector('input[name="keyword"]');

        // セレクトボックスが変更されたときの処理
        areaSelect.addEventListener('change', function () {
            search();
        });

        genreSelect.addEventListener('change', function () {
            search();
        });

        // テキスト入力が変更されたときの処理
        keywordInput.addEventListener('input', function () {
            search();
        });

        // 検索を実行する関数
        function search() {
            const area = areaSelect.value;
            const genre = genreSelect.value;
            const keyword = keywordInput.value;

            axios.get(`/search?area=${area}&genre=${genre}&keyword=${keyword}`)
            .then(response => {
                const restaurants = response.data;
                const indexRestaurants = document.querySelector('.index-restaurants');
                indexRestaurants.innerHTML = '';

                restaurants.forEach(restaurant => {
                    const partSummary = `
                        <div class="part-summary">
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
                        axios.post(`/mypage/favoriteAdd/${restaurantId}`)
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
                    if(confirmDel === true){
                        axios.delete(`/mypage/favoriteDelete/${favoriteId}`)
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

    if (document.querySelector('[id="mypage"]') != null) {

        ////////////////////
        // お気に入り外し
        ////////////////////
        favoriteIconDelete(function (restaurantId) {
            let restaurantElement = document.getElementById(`part-summary-restaurant${restaurantId}`);
            if (restaurantElement) {
                restaurantElement.remove();
            }
        });
    }


});




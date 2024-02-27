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

//////////////
// 戻るボタン
//////////////
function backButton(back){
    // const back = document.getElementById('detail-body__title-back');
    back.addEventListener('click', (e) => { history.back(); return false; });
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
            let confirm_contact = document.getElementById('detail-reservation__confirm-contact');
            let confirm_restaurant_id = confirm_restaurant.dataset.id;

            // フォーム
            let formReserve = document.querySelector('form[action*="/detail/reservationAdd"]');
            let formBtn = formReserve.querySelector('input[name*="submitBtn"]');

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

            // 連絡先
            document.getElementById('detail-reservation__value-contact').addEventListener('input', function () { 
                confirm_contact.textContent = this.value;
            });

            // form送信
            formBtn.addEventListener('click', function () { 
                let cfmSubmit = confirm('以下で送信しますか\n' + '\n日付:' + confirm_date.textContent + '\n時間:' + confirm_time.textContent + '\n人数:' + confirm_visitors.textContent + '\n連絡先:' + confirm_contact.textContent);

                if (cfmSubmit === true) formReserve.submit();
            });

        }

        //////////////
        // 戻るボタン
        //////////////
        backButton(document.getElementById('detail-body__title-back'));
        // const back = document.getElementById('detail-body__title-back');
        // back.addEventListener('click', (e) => { history.back(); return false; });
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

    // mypage
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


        /////////////
        // 予約変更
        /////////////
        let reservationDetails = document.querySelectorAll('.mypage-reservation__detail');

        reservationDetails.forEach(function (detail, index) {
            detail.addEventListener('click', function (event) {
                let inputs = detail.querySelectorAll('input, select');
                let submitButton = detail.querySelector('button');

                // 入力可能にする
                inputs.forEach(function (input) {
                    input.removeAttribute('disabled');
                });
                submitButton.removeAttribute('disabled');

                // 予約余裕日の取得
                let dateObj = new Date();
                let today = dateObj.getTime();
                let limitDate = inputs[0].dataset.limit;
                let msec = limitDate * (24 * 60 * 60 * 1000);
                let newday = new Date(today + msec);
                let format = 'YYYY-mm-dd';
                let newday_format = format.replace('YYYY', newday.getFullYear());
                newday_format = newday_format.replace('mm', ("0" + (newday.getMonth() + 1)).slice(-2));
                newday_format = newday_format.replace('dd', ("0" + newday.getDate()).slice(-2));
                inputs[0].setAttribute('min', newday_format);

                // 送信ボタンのクリックイベントを追加
                // submitButton.addEventListener('click', function (event) {
                submitButton.onclick = function (event) {
                    event.stopPropagation(); // 親要素へのイベント伝播を停止
                    let reservationId = detail.querySelector('input[name*="reservation_id"]').value;
                    let restaurantId = detail.querySelector('.mypage-reservation__detail-name').dataset.restaurantId;
                    let date = detail.querySelector('input[name*="scheduled_date"]').value;
                    let time = detail.querySelector('select[name*="scheduled_time"]').value;
                    let visitors = detail.querySelector('select[name*="visitors"]').value;
                    let contact = detail.querySelector('input[name="contact"]').value;

                    // 送信処理を追加
                    cfmEdit = confirm('変更しますか\n\n日付:' + date + '\n時間:' + time + '\n人数:' + visitors + '\n連絡先:' + contact);
                    if(cfmEdit === true){
                        axios.post(`/mypage/reservationEdit?id=${reservationId}&restaurant_id=${restaurantId}&scheduled_date=${date}&scheduled_time=${time}&visitors=${visitors}&contact=${contact}`)
                            .then(response => {
                                if(response.data.result === true){
                                    alert('変更しました');
                                    // 無効化処理
                                    elementDisable(detail);
                                }
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                }

                // 他の項目は無効
                reservationDetails.forEach(function (otherDetail, otherIndex) {
                    if (otherIndex !== index) elementDisable(otherDetail);
                });

                // 外側をクリックされたら無効化
                document.addEventListener('click', function (event) { 
                    if(!event.target.closest('.mypage-reservation__detail')){
                    // if(event.target != this){
                        elementDisable(detail);
                    }
                });

                // 無効化用
                function elementDisable(detail) {
                    let inputs = detail.querySelectorAll('input, select');
                    let submitButton = detail.querySelector('button');
                    inputs.forEach(function (input) {
                        input.setAttribute('disabled', 'disabled');
                    });
                    submitButton.setAttribute('disabled', 'true');
                }
            });
        });

        /////////////
        // 予約削除
        /////////////
        let deleteIcons = document.querySelectorAll('.fa-circle-xmark');

        deleteIcons.forEach(function (deleteIcon) { 
            deleteIcon.addEventListener('click', function () {
                console.log(deleteIcon.parentNode.parentNode);
                let cmDelete = confirm('削除しますか');
                if(cmDelete === true){
                    // 削除処理
                    axios.delete(`/mypage/reservationDel?id=${deleteIcon.dataset.reservation_id}`)
                        .then(response => {
                            if (response.data === true) {
                                alert('削除しました');
                                deleteIcon.parentNode.parentNode.remove();
                            }
                        })
                        .catch(error => { 
                            console.error(error);
                        });
                }
            });
        });
    }

    // 予約終了ページ
    if (document.getElementById('done-main') != null) {
        //////////////
        // 戻るボタン
        //////////////
        backButton(document.querySelector('button'));
    }
});




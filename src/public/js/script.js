document.addEventListener('DOMContentLoaded', function () { 

    console.log('unko');

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

    //////////////
    // 予約確認
    //////////////

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

    //////////////
    // 戻るボタン
    //////////////
    // const back = document.getElementById('detail-body__title-back');
    // back.addEventListener('click', (e) => { history.back(); return false; });

});


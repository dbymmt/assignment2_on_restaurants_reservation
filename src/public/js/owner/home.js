document.addEventListener('DOMContentLoaded', function () { 

    if (document.querySelector('article[id*="owner-home"]')) {
        console.log('owner-home');

        ///////////////////
        // 追加フォーム送信
        ///////////////////
        var editForm = document.querySelector('form[action*="restaurantEdit"]');
        var editFormBtn = document.getElementById('owner-index-restaurants-add__submit');

        editFormBtn.addEventListener('click', function () { 
            let restaurantName = document.querySelector('input[name*="name"]').value;
            let restaurantArea = document.querySelector('select[name*="area_id"]');
            let restaurantAreaSelect = restaurantArea.selectedIndex;
            let restaurantAreaSelectTxt = restaurantArea.options[restaurantAreaSelect].text;
            let restaurantGenre = document.querySelector('select[name*="genre_id"]');
            let restaurantGenreSelect = restaurantGenre.selectedIndex;
            let restaurantGenreSelectTxt = restaurantGenre.options[restaurantGenreSelect].text;
            let restaurantAcceptableDays = document.querySelector('input[name*="acceptable_days"]').value;
            let restaurantDetail = document.querySelector('textarea[name*="detail"]').value;
            const result = confirm('登録しますか？\n' + '\n店舗名:' + restaurantName + '\n地域:' + restaurantAreaSelectTxt + '\nジャンル:' + restaurantGenreSelectTxt + '\n予約猶予日数:' + restaurantAcceptableDays + '\n詳細:' + restaurantDetail);
            if (result === true) editForm.submit();
        });
    }
});
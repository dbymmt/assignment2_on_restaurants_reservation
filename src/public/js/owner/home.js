document.addEventListener('DOMContentLoaded', function () { 

    if(document.querySelector('article[id*="owner-home"]')){
        console.log('owner_index_unko');

        ///////////////////
        // 追加フォーム送信
        ///////////////////
        var editForm = document.querySelector('form[action*="restaurantEdit"]');
        var editFormBtn = document.querySelector('input[value="店舗追加"]');
        editFormBtn.addEventListener('click', function () { 
            let restaurantName = document.querySelector('input[name*="name"]').value;
            let restaurantArea = document.querySelector('select[name*="area_id"]');
            let restaurantAreaSlct = restaurantArea.selectedIndex;
            let restaurantAreaSlctTxt = restaurantArea.options[restaurantAreaSlct].text;
            let restaurantGenre = document.querySelector('select[name*="genre_id"]');
            let restaurantGenreSlct = restaurantGenre.selectedIndex;
            let restaurantGenreSlctTxt = restaurantGenre.options[restaurantGenreSlct].text;
            let restaurantDetail = document.querySelector('textarea[name*="detail"]').value;
            const result = confirm('登録しますか？\n' + '\n店舗名:' + restaurantName + '\n地域:' + restaurantAreaSlctTxt + '\nジャンル:' + restaurantGenreSlctTxt + '\n詳細:' + restaurantDetail);
            if (result === true) editForm.submit();
        });
    }
});
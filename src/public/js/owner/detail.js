document.addEventListener('DOMContentLoaded', function () { 
    
    if(document.querySelector('article[id*="owner-detail"]')){
        console.log('owner_detail_unko');

        ////////////////
        // 編集フォーム送信
        ////////////////
        var editForm = document.querySelector('form[action*="restaurantEdit"]');
        var editFormBtn = document.querySelector('input[value="この内容で編集する"]');
        editFormBtn.addEventListener('click', function () { 
            let restaurantName = document.querySelector('input[name*="name"]').value;
            let restaurantArea = document.querySelector('select[name*="area_id"]');
            let restaurantAreaSlct = restaurantArea.selectedIndex;
            let restaurantAreaSlctTxt = restaurantArea.options[restaurantAreaSlct].text;
            let restaurantGenre = document.querySelector('select[name*="genre_id"]');
            let restaurantGenreSlct = restaurantGenre.selectedIndex;
            let restaurantGenreSlctTxt = restaurantGenre.options[restaurantGenreSlct].text;
            let restaurantDetail = document.querySelector('textarea[name*="detail"]').value;
            const result = confirm('編集しますか？\n' + '\n店舗名:' + restaurantName + '\n地域:' + restaurantAreaSlctTxt + '\nジャンル:' + restaurantGenreSlctTxt + '\n詳細:' + restaurantDetail);
            if (result === true) editForm.submit();
        });

        ////////////////
        // 削除フォーム送信
        ////////////////
        var deleteForm = document.querySelector('form[action*="restaurantDelete"]');
        var deleteBtn = document.querySelector('input[value="店舗を削除する"]');
        deleteBtn.addEventListener('click', function () { 
            let restaurantName = document.querySelector('input[name*="name"]').value;
            const result = confirm(restaurantName + 'を削除します');
            if (result === true) deleteForm.submit();
        });

    }
});
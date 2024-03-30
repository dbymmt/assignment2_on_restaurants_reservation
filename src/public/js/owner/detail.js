// 画像が選択されたときに実行される関数
function previewImage(input) {
    var preview = document.querySelector('.owner-detail-body__img img');
    var file = input.files[0];
    var reader = new FileReader();

    if (file && (file.type === 'image/jpeg' || file.type === 'image/png')) {
        reader.onloadend = function () {
            preview.src = reader.result; // プレビューとして画像を表示
        }
        reader.readAsDataURL(file); // 選択された画像を読み込み
    } else {
        preview.src = ''; // ファイルが選択されていない場合はプレビューをクリア
        alert('ファイルは拡張子jpgもしくはpngのファイルを選択してください');
    }
}

document.addEventListener('DOMContentLoaded', function () { 

    if (document.querySelector('article[id*="owner-detail"]')) {

        console.log('owner-detail');

        ////////////////
        // 編集フォーム送信
        ////////////////
        var editForm = document.querySelector('form[action*="restaurantEdit"]');
        var editFormBtn = document.getElementById('owner-detail-body__submit');

        editFormBtn.addEventListener('click', function () { 
            let restaurantName = document.querySelector('input[name*="name"]').value;
            let restaurantArea = document.querySelector('select[name*="area_id"]');
            let restaurantAreaSelect = restaurantArea.selectedIndex;
            let restaurantAreaSelectTxt = restaurantArea.options[restaurantAreaSelect].text;
            let restaurantGenre = document.querySelector('select[name*="genre_id"]');
            let restaurantGenreSelect = restaurantGenre.selectedIndex;
            let restaurantGenreSelectTxt = restaurantGenre.options[restaurantGenreSelect].text;
            let restaurantAcceptableDays = document.querySelector('input[name="acceptable_days"]').value;
            let restaurantDetail = document.querySelector('textarea[name*="detail"]').value;
            const result = confirm('編集しますか？\n' + '\n店舗名:' + restaurantName + '\n地域:' + restaurantAreaSelectTxt + '\nジャンル:' + restaurantGenreSelectTxt + '\n予約猶予日数:' + restaurantAcceptableDays + '\n詳細:' + restaurantDetail);
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

        //////////////
        // 戻るボタン
        //////////////
        backButton(document.getElementById('detail-body__title-back'));
    }
});
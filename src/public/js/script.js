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


//////////
// 本体
//////////
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



    // 予約終了ページ
    if (document.getElementById('done-main') != null) {
        //////////////
        // 戻るボタン
        //////////////
        backButton(document.querySelector('button'));
    }
});




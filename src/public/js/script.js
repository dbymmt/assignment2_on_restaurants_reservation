document.addEventListener('DOMContentLoaded', function () { 

    console.log('unko');

    // メニューオープンクローズ
    let menu_open = document.getElementById('header__menu-open');
    let menu_close = document.getElementById('header__menu-close');
    menu_open.addEventListener('click', function () {
        document.getElementById('header__nav').classList.add("active");

        menu_close.addEventListener('click', function () { 
            document.getElementById('header__nav').classList.remove("active");
        });
    });


    // 戻るボタン
    // const back = document.getElementById('btn--back');
    // back.addEventListener('click', (e) => { history.back(); return false; });

});


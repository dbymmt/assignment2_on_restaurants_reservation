
document.addEventListener('DOMContentLoaded', function () { 
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
            formBtn.disabled = true;
            formBtn.value = "予約できません";

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
                    confirm_date.textContent = '予約は今日から中' + limitDays + '日空けて以降にしてください';
                    formBtn.disabled = true;
                    formBtn.value = "予約できません";
                }
                else {
                    confirm_date.textContent = this.value;
                    formBtn.disabled = false;
                    formBtn.value = "予約します";
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
            // document.getElementById('detail-reservation__value-contact').addEventListener('input', function () { 
            //     confirm_contact.textContent = this.value;
            // });

            // form送信
            formBtn.addEventListener('click', function () { 
                let cfmSubmit = confirm('以下で送信しますか\n' + '\n日付:' + confirm_date.textContent + '\n時間:' + confirm_time.textContent + '\n人数:' + confirm_visitors.textContent);

                if (cfmSubmit === true) formReserve.submit();
            });

        }

        //////////////
        // 戻るボタン
        //////////////
        backButton(document.getElementById('detail-body__title-back'));
    }

});
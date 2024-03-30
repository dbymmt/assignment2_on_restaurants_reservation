
document.addEventListener('DOMContentLoaded', function () { 

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

                // 入力を可能にする
                inputs.forEach(function (input) {
                    input.removeAttribute('disabled');
                });

                // 予約余裕日の取得
                let dateObj = new Date();
                let today = dateObj.getTime();
                let limitDate = inputs[1].dataset.limit;
                let msec = limitDate * (24 * 60 * 60 * 1000);
                let newday = new Date(today + msec);
                let format = 'YYYY-mm-dd';
                let newday_format = format.replace('YYYY', newday.getFullYear());
                newday_format = newday_format.replace('mm', ("0" + (newday.getMonth() + 1)).slice(-2));
                newday_format = newday_format.replace('dd', ("0" + newday.getDate()).slice(-2));
                inputs[1].setAttribute('min', newday_format);

                // 日付情報
                let date = detail.querySelector('input[name*="scheduled_date"]');
                // 未来日のみボタン押下可能にする
                date.addEventListener('input', function () {
                    date.value > newday_format ? submitButton.removeAttribute('disabled') : submitButton.setAttribute('disabled', 'true');
                });

                // 送信ボタンのクリックイベントを追加
                submitButton.onclick = function (event) {
                    event.stopPropagation(); // 親要素へのイベント伝播を停止
                    let reservationId = detail.querySelector('input[name*="reservation_id"]').value;
                    let restaurantId = detail.querySelector('.mypage-reservation__detail-name').dataset.restaurantId;
                    // let date = detail.querySelector('input[name*="scheduled_date"]').value;
                    let time = detail.querySelector('select[name*="scheduled_time"]').value;
                    let visitors = detail.querySelector('select[name*="visitors"]').value;
                    // let contact = detail.querySelector('input[name="contact"]').value;

                    // 送信処理を追加
                    cfmEdit = confirm('変更しますか\n\n日付:' + date.value + '\n時間:' + time + '\n人数:' + visitors);
                    if(cfmEdit === true){
                        // axios.post(`/mypage/reservationEdit?id=${reservationId}&restaurant_id=${restaurantId}&scheduled_date=${date.value}&scheduled_time=${time}&visitors=${visitors}`)
                        axios.post(`/user/mypage/reservationEdit?id=${reservationId}&restaurant_id=${restaurantId}&scheduled_date=${date.value}&scheduled_time=${time}&visitors=${visitors}`)
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
                let cmDelete = confirm('削除しますか');
                if(cmDelete === true){
                    // 削除処理
                    // axios.delete(`/mypage/reservationDelete?id=${deleteIcon.dataset.reservation_id}`)
                    axios.delete(`/user/mypage/reservationDelete?id=${deleteIcon.dataset.reservation_id}`)
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
});
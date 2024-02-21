// 予約確認対象要素
let confirm_restaurant = document.getElementById('detail-reservation__confirm-name');
let confirm_date = document.getElementById('detail-reservation__confirm-date');
let confirm_time = document.getElementById('detail-reservation__confirm-time');
let confirm_visitors = document.getElementById('detail-reservation__confirm-visitors');

// 店名
confirm_restaurant.textContent = document.getElementsByClassName('detail-body__title')[0].textContent;

// 日付
confirm_date.textContent = document.getElementById('detail-reservation__value-date').value;

// 時間
confirm_time.textContent = document.getElementById('detail-reservation__value-time').value;

// 人数
confirm_visitors.textContent = document.getElementById('detail-reservation__value-visitors').value;

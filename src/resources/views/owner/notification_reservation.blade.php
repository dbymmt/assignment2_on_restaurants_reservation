<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Notification for your-Reservation</title>
</head>
<body>
    <h1>Notification for your-Reservation</h1>
    <p>{{$user->name}}様</p>

    <p>訪問先：{{$reservation->restaurant->name}}</p>
    <p>ご予約人数：{{$reservation->visitors}}</p>
    <p>ご予約日時：{{$reservation->scheduled_date}} {{$reservation->scheduled_time}}</p>

    <p>本日のお越しお待ち申し上げております。</p>

    regards.
</body>
</html>
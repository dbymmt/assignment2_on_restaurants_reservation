<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Notification</title>
</head>
<body>
    <h1>Notification</h1>
    <p>{{$user->name}}様</p>

    <p>{{ $mailTemplate }}</p>

    <p><a href="{{ url("/user/mail/exit?user_mail={$user->email}") }}">解約はこちら</a>
</body>
</html>
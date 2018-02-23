<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>註冊確認信</title>
</head>
<body>
<h1>感謝您註冊！</h1>

<p>
    點擊連結完成：
    <a href="{{ route('static::confirm_email', $user->activation_token) }}">
        {{ route('static::confirm_email', $user->activation_token) }}
    </a>
</p>

</body>
</html>
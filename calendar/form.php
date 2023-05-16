<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>カレンダーアプリ</title>
</head>
<body>
    <h1>カレンダーアプリ</h1>

    <h2>イベントの追加</h2>
    <form method="POST" action="main.php">
        <div class="input">
        <label>イベント名
        <input type="text" name="event" required>
        </label>
        <br>
        <label>日付
        <input type="date" name="date" required>
        </label>
        <br>
        <input type="submit" value="追加">
        </div>
    </form>

    <h2>イベント一覧</h2>
    <?php
    require_once "main.php";
    ?> 
</body>
</html>
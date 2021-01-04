<?php
// 投稿画面
session_start();
$name = $_SESSION['name'];
$person = '<p>投稿者:'. $name .'</p>';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>投稿</h1>

    <?= $person ?>
    <form method="POST" action="insert_do.php">
        <div>
            <textarea name="text" rows="8" cols="40" value=""></textarea>
        </div>
        <input type="submit" class="insert_button" name="btn1" value="投稿する">
    </form>
    
    <script src="../main.js/main.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ログインページ</h1>
    <form action="login.php" method="post">
        <div>
            <label>メールアドレス：<label>
            <input type="text" name="mail" required>
        </div>
        <div>
            <label>パスワード：<label>
            <input type="password" name="pass" required>
        </div>
        <input type="submit" value="ログイン">
    </form>
    <form action="signup.php">
        <input type="submit" value="新規登録">
    </form>
    
</body>
</html>

<?php
    session_start();
    // $maiにpostの値を入れて渡す
    // ログイン、サインアップでそれぞれ、ページを作る
    $_SESSION['mail'] = $_POST['mail'];
?>

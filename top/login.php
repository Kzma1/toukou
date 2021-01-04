<?php
    session_start();
    $mail = $_POST['mail'];
    $dsn = "mysql:host=localhost; dbname=test01; charset=utf8";
    $username = "root";
    $password = "root";
    // DB接続
    try {
        $dbh = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $msg = $e->getMessage();
    }
    // メールアドレスで一致するものを検索
    $sql = "SELECT * FROM login2 WHERE mail = :mail";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $member = $stmt->fetch((PDO::FETCH_ASSOC));

    //指定したハッシュがパスワードにマッチしているかチェック
    if (password_verify($_POST['pass'], $member['pass'])) {// login_formから来た
        $_SESSION['id'] = $member['id'];
        $_SESSION['name'] = $member['name'];
        $msg = 'ログインしました。';
        $link = '<a href="../index/main.php">ホーム</a>';
    } else {
        $msg = 'メールアドレスもしくはパスワードが間違っています。';
        $link = '<a href="login_form.php">戻る</a>';
        echo $_SESSION['pass'] . '<br>';
        echo $member['pass'];
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1><?php echo $msg; ?></h1>
    <?php echo $link; ?>
</body>

</html>

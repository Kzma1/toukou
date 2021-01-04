<?php
    session_start();
    $_SESSION['pass'] = $_POST['pass'];
    $_SESSION['mail'] = $_POST['mail'];

    //フォームからの値をそれぞれ変数に代入
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $dsn = 'mysql:dbname=test01; host=localhost; charset=utf8';
    $username = 'root';
    $password = "root";
    try {
        $dbh = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
        $msg = $e->getMessage();
    }

    //フォームに入力されたmailがすでに登録されていないかチェック
    $sql = "SELECT * FROM login2 WHERE mail = :mail";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($member['mail'] === $mail) {
        $msg = '同じメールアドレスが存在します。';
        $link = '<a href="signup.php">戻る</a>';
    } else {
        //登録されていなければinsert 
        $sql = "INSERT INTO login2(id, name, mail, pass) VALUES (NULL, :name, :mail, :pass)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
        $status = $stmt->execute();

        if($status==false){
            //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
            $error = $stmt->errorInfo();
            exit("ErrorMessage:".$error[2]);
        } else {
            $sql = "SELECT * FROM login2 WHERE mail = :mail";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':mail', $mail);
            $stmt->execute();
            $member = $stmt->fetch(PDO::FETCH_ASSOC);
            $msg = '会員登録が完了しました';
            $_SESSION['id'] = $member['id'];
            $_SESSION['name'] = $member['name'];
            $link = '<a href="../index/main.php">ホーム</a>';
        }
    }

?>

<h1><?php echo $msg; ?></h1><!--メッセージの出力-->
<?php echo $link; ?>
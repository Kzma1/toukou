<?php
    // 投稿処理
    session_start();
    $text = $_POST["text"];
    $name = $_SESSION['name'];
    echo $name;

    // DB接続
    try {
        //ID:'root', Password: 'root'→右端に入力している
        $pdo = new PDO('mysql:dbname=test01;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
        $msg = $e->getMessage();
    }

    // 1. SQL文を用意
    $stmt = $pdo->prepare("INSERT INTO toukou(id, name, text, time)VALUES(NULL, :name, :text, sysdate())");

    //  2. バインド変数を用意
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':text', $text, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

    //  3. 実行
    $status = $stmt->execute();

    //４．データ登録処理後
    if ($status==false) {
        //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
        $error = $stmt->errorInfo();
        exit("ErrorMessage:".$error[2]);
    } else {
        //５．index.phpへリダイレクト
        header('Location:main.php');
    }

?>
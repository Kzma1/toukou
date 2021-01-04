<?php
// 検索処理

    // main.phpから引用
    $button = '<input type="button" value="feel good">';
    $button2 = '<input type="button" value="削除">';
    // 削除は、投稿のDBにsessionでlogin2のidをもたせて、ユーザーを識別？
    // ユーザーが違う場合は削除ボタンを隠す or 自分の投稿の一覧ページを作る
    session_start();
    $username = $_SESSION['name'];
    if (isset($_SESSION['id'])) {//ログインしているとき
        $msg = 'こんにちは' . htmlspecialchars($username, \ENT_QUOTES, 'UTF-8') . 'さん';
        $link = '<a href="../top/logout.php">ログアウト</a>';
    } else {//ログインしていない時
        $msg = 'ログインしていません';
        $link = '<a href="../top/login_form.php">ログイン</a>';
    }

    require_once('dbconfig.php');
    $searchWord = $_POST["inputWord"];

    // DB接続
    try {
        //ID:'root', Password: 'root'→右端に入力している
        $pdo = new PDO('mysql:dbname=test01;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
    }

    // メールアドレスで一致するものを検索
    $sql = "SELECT * FROM toukou WHERE text LIKE '%$searchWord%'";
    $stmt = $pdo->prepare($sql);
    $status = $stmt->execute();
    // $member = $stmt->fetch((PDO::FETCH_ASSOC));

    $view="";
    if ($status==false) {
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    } else {
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $view .= '<div class="toukou_text">' . '<p>' . h(date("Y年m月d日 H:i:s",strtotime($result['time']))) . '/' . h($result['name']) . '/' . h($result['text']) . '</p>' . '<br>' . $button . $button2 . '</div>';
            // 格納されているデータの詳細確認※<pre>でバックぐら表示できる？
        }   
    }
    // header('Location:search.php');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <title>Document</title>
</head>

<body>
    <div class="top_message">
        <h1>STB (Share Today's Best!!)</h1>
        <p><?= $msg . $link ?></p>
    </div>

    <!-- タイムライン -->
    <div>
        <?= $view ?>
        </div>
    </div>

    <!-- 投稿機能へ遷移ボタン -->
    <a href="insert.php">投稿する</a>
    <!-- ワード検索 -->
    <a href="search.php">検索する</a>
</body>
</html>
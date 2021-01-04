<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>ワード検索</h1>
    <form action="search_do.php" method="POST">
        <input type="text" name="inputWord">
        <input type="submit" value="検索">
    </form>

    <?= $view ?>

</body>
</html>
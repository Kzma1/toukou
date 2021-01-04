<?php
function connect() {
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=test01;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DBConnectError'.$e->getMessage());
    }
}

function h($s){
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
  }

?>
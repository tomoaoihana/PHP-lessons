<?php
//ファイルの読み込み
require_once('inc/config.php');

//例外処理（try-catch文）
try{
  // データベースに接続
  $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);

  //エラー発生時に『PDOException』という例外クラスのオブジェクトがスロー（投げる）されるように設定
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo '接続成功！';
  
}catch(PDOException $e){
  //例外発生時の処理
 echo 'エラー！' . $e->getMessage(); //getMessage()メソッドでエラーメッセージを取得 無害かした方がいいい
  exit();

}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新着記事一覧</title>
</head>

<body>
  <h1>新着情報</h1>
</body>

</html>
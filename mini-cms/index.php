<?php
//ファイルの読み込み
require_once('inc/config.php');
require_once('inc/functions.php');

//例外処理（try-catch文）
try{
  // データベースに接続
  $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);

  //エラー発生時に『PDOException』という例外クラスのオブジェクトがスロー（投げる）されるように設定
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //SQL文の作成（クエリー文）
  // $sql = 'INSERT INTO posts (title,content,category_id,created) VALUES("初めましてのご報告","この度、初めての投稿をさせていただきます。",3,NOW())';

  //SQLクエリの実行
  // $dbh -> query($sql);

  //レコードを削除
  // $sql = 'DELETE FROM posts WHERE id=4';

  //SQL文の作成（日付が新しい順）
  $sql = 'SELECT * FROM posts ORDER BY created DESC';
  
  //SQLクエリの実行
  $stmt = $dbh->query($sql);

  //結果を連想配列とて取得

  $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
  // echo '<pre>';
  // print_r($result);
  // echo '</pre>';

  //SQLの接続終了
  $dbh = null;
  



}catch(PDOException $e){
  //例外発生時の処理
 echo 'エラー！' . h( $e->getMessage() ); //getMessage()メソッドでエラーメッセージを取得 無害かした方がいいい htmlspecialcharsを使用
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

  <!-- foreach文で繰り返し処理 -->

  <dl>
    <?php  foreach($result as $post) : ?>
    <dt>
      <time datetime="<?php echo h($post['created']) ?>">
        <?php echo h( date('Y年m月d日',strtotime($post['created']))); ?>
      </time>
    </dt>
    <dd>
      <a href="detail.php?id=<?php echo h($post['id']) ?>">
        <?php echo h($post['title']) ?>
      </a>
    </dd>
    <?php endforeach;  ?>
  </dl>


</body>

</html>
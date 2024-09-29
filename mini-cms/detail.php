<?php
//ファイルの読み込み
require_once('inc/config.php');
require_once('inc/functions.php');

//GETパラメータのチェック
//存在していない、空っぽ、数字でない場合はエラー
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
  header('Location:index.php');//リダイレクト処理(⭐︎後々、数字を正規表現でチェックに変更　!preg_match('/^\d+$/', $_GET['id'])
  exit;
}

//例外処理（try-catch文）
try{
  //データベースに接続
  $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);

 //SQLにえらーが発生した時に例外を投げる設定
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //SQL分の作成（記事のID一致するレコードを抽出）postsとcategories_nameの全フィールドを取得
  //👀SQLには変数を直接埋め込まない🙅
  //SQLインジェクション対策

  $sql = 'SELECT p.*,c.category_name
    FROM posts AS p JOIN categories AS c
    ON p.category_id = c.id
    WHERE p.id = ?';

  //プリペアドステートメントの作成(？に値を入れる準備、テンプレートの作成)
  $stmt = $dbh->prepare($sql);

  //プレースホルダに値をバインド（？に値をガッチャン！！）
  $stmt->bindValue(1,(int)$_GET['id'],PDO::PARAM_INT);


  //ステートメントの実行
  $stmt->execute();

  //実行結果を連想配列として取得
  //確認
  $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
  echo '<pre>';
  print_r($result);
  echo '</pre>';




 //データベースの接続を閉じる
  $dbh = null;

}catch(PDOException $e){
  //エラー発生時の処理
   //エラーメッセージを表示して処理を終了
  echo 'エラー！' . h($e->getMessage());
  exit();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>[記事のタイトル]</title>
</head>

<body>
  <h1>[記事のタイトル]</h1>
  <ul>
    <li>公開日： [記事の公開日]</li>
    <li>カテゴリ： [記事のカテゴリ名]</li>
  </ul>
  <p>
    [記事の内容]
  </p>
  <p><a href="./">一覧に戻る</a></p>
</body>

</html>
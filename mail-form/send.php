<?php
//セッションスターと
session_start();

//日本語の設定
mb_language('ja');
mb_internal_encoding('UTF-8');


//CSRF対策
//トークンが一致しなかったら、入力フォームにリダイレクトする
if(empty($_POST['token']) || $_SESSION['token'] !== $_POST['token']){
  exit('不正なリクエストです');
}


//メールアドレスが空だったら、入力画面に戻す
if(empty($_SESSION['post']['email'])){
  header('Location: ./');
  exit();
}

//値を変数に格納する
$to = 'buoy.code1110@gmail.com';
$subject = '【ダミー】お問い合わせがありました';
$name = $_SESSION['post']['name'];
$email = $_SESSION['post']['email'];
$message = 'お問い合わせがありました'. PHP_EOL;
$message .= PHP_EOL;
$message .= 'お名前' . PHP_EOL;
$message .= $_SESSION['post']['name'] . PHP_EOL;
$message .= PHP_EOL;
$message .= 'メールアドレス' . PHP_EOL;
$message .= $_SESSION['post']['email'] . PHP_EOL;
$message .= PHP_EOL;
$message .= 'お問い合わせ内容' . PHP_EOL;
$message .= $_SESSION['post']['message'] . PHP_EOL;

$from = mb_encode_mimeheader('ダミー') . '<noreply@dummy.com>';

//メール送信
$result = mb_send_mail($to, $subject, $message, 'From: ' . $from);

//メール送信の結果によって、リダイレクト先を変更する
if($result){
  //送信成功
  //セッションの初期化
  $_SESSION = [];
  //クッキーのセッションIDを削除
  setcookie(session_name(), '', time() - 3600);
  //セッションを破棄
  session_destroy();
  //送信成功ページにリダイレクト

  header('Location:thanks.html');}
else{ header('Location:error.html');}
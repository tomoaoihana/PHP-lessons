<?php 

//セッションの開始
session_start();


//$_POSTが空っぽだったら、入力フォームにリダイレクトする
if(empty ($_POST)){
  header('location: ./');
  exit();
}

//CSRF対策
//トークンが一致しなかったら、入力フォームにリダイレクトする
if(empty($_POST['token']) || $_SESSION['token'] !== $_POST['token']){
  exit('不正なリクエストです');
}

//エラーメッセージを格納するための配列を初期化します
$_SESSION['error'] = [];


//お名前の入力チェック
if($_POST['name'] ==''){
  $_SESSION['error']['name'] = 'お名前を入力してください';
}


//上に絶対メルアドの形式チェックを入れる
//なぜ？？
if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
  $_SESSION['error']['email'] = 'メアドの形式が違うよ！';
}

//メールアドレスの未入力チェック
if(($_POST['email'] == '')){
  $_SESSION['error']['email'] = 'メアドを入力してください';
}


//お問い合わせ内容の未入力チェック
if($_POST['message'] == ''){
  $_SESSION['error']['message'] = 'お問い合わせ内容を入力してください';
}


//セッションにユーザーの入力データ保管
$_SESSION['post'] = $_POST;


//$_SESSION['error']が空じゃなかったら、index.phpにリダイレクトする
if(!empty($_SESSION['error'])){
  header('location: ./');
  exit();
}else{
  //エラーがなかった場合、確認画面にリダイレクトする
  header('location: conf.php');
  exit();
}
<?php
//セッションの開始
session_start();

//XSS対策の独時関数
//htmlspecialcharsのショートカット
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//CSRF対策
//トークンの生成
if(!isset($_SESSION['token'])){
  $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>お問い合わせフォーム</title>
</head>

<body>
  <h1>お問い合わせフォーム</h1>
  <form action="set.php" method="post">
    <dl>
      <dt><label for="name">お名前</label></dt>
      <dd>
        <input type="text" name="name" id="name"
          value="<?php if(isset($_SESSION['post']['name'])){ echo h($_SESSION['post']['name']);}?>">
        <?php if(isset($_SESSION['error']['name'])): ?>
        <p><?php echo h($_SESSION['error']['name']) ;?></p>
        <?php endif; ?>
      </dd>
      <dt><label for="email">メールアドレス</label></dt>
      <dd>
        <input type="text" name="email" id="email"
          value="<?php if(isset($_SESSION['post']['email'])){ echo h($_SESSION['post']['email']);}?>">
        <?php if(isset($_SESSION['error']['email'])): ?>
        <p><?php echo h($_SESSION['error']['email']) ?></p>
        <?php endif; ?>
      </dd>
      <dt><label for="message">お問い合わせ内容</label></dt>
      <dd>
        <textarea name="message" id="message" rows="8"
          cols="50"><?php if(isset($_SESSION['post']['message'])){ echo h($_SESSION['post']['message']);}?></textarea>
        <?php if(isset($_SESSION['error']['message'])): ?>
        <p><?php echo h($_SESSION['error']['message'] )?></p>
        <?php endif; ?>
      </dd>
    </dl>
    <p><input type="hidden" name="token" value="<?php echo h($_SESSION['token']) ?>"></p>
    <p><input type="submit" value="入力確認へ"></p>
  </form>
</body>

</html>
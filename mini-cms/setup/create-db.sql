-- データベースの作成

create database mini_cms_app default character set utf8;

-- データベースの選択
use mini_cms_app;

--テーブルの作成(posts,categories)

CREATE TABLE posts(
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(60) NOT NULL,
  content LONGTEXT NOT NULL,
  category_id INT(11),
  created DATETIME ,
  modified TIMESTAMP 
) engine=InnoDB default charset=utf8;

CREATE TABLE categories(
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
 category_name VARCHAR(60) NOT NULL
 
) engine=InnoDB default charset=utf8;

-- サンプルレコードの挿入

INSERT INTO posts(
  title,
  content,
  category_id,
  created
)values(
  'Webサイトを公開しました。',
  '本日、Webサイトを公開しました。お楽しみ下さい。',
  1,
  '2018-04-01 10:00:00'
),
(
  '春の握手会について',
  '	4月21日（土）、 22日（日）の2日間、握手会を開催致します。',
  2,
  '2018-04-16 10:00:00'
),
(
  'ゴールデンウィーク休暇について',
  '4月28日（土） 〜 5月6日（日）までの9日間は、休みを頂戴いたします。',
  1,
  '2018-04-20 10:00:00'
);

INSERT INTO categories(
  category_name
)values(
  'お知らせ'
),
(
  'イベント情報'
),
(
  '活動報告'
);

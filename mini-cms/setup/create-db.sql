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
 category_name VARCHAR(60) NOT NULL,
 
) engine=InnoDB default charset=utf8;
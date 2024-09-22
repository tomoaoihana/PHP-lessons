<?php
//XSS対策のためのHTMLエスケープ
//独自関数h()を定義
function h($S){
  return htmlspecialchars($S, ENT_QUOTES, 'UTF-8');
}
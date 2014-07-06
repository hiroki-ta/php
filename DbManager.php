<?php
function getDb() {
  $dsn = 'mysql:dbname=selfphp; host=localhost';
  $usr = 'hiroki';
  $passwd = 'birthday0923';

  try {
    // データベースへの接続を確立
    $db = new PDO($dsn, $usr, $passwd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // データベース接続時に使用する文字コードをutf8に設定
    $db->exec('SET NAMES utf8');
  } catch (PDOException $e) {
    die("接続時エラー：{$e->getMessage()}");
  }
  return $db;
}

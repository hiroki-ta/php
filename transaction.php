<?php
require_once './DbManager.php';

try {
  // データベースへの接続を確立
  $db = getDb();
  // 例外処理を有効化
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // トランザクションを開始
  $db->beginTransaction();
  $db->exec("INSERT INTO book(isbn, title, price, publish, published)
    VALUES('978-4-7981-1257-2', '独習ASP.NET 2.0', 4179, '翔泳社', '2007-02-20')");
  // ここで主キー制約違反が発生するはず
  $db->exec("INSERT INTO book(isbn, title, price, publish, published)
    VALUES('978-4-7981-1257-3', '独習ASP.NET 5.0', 3500, '翔泳社', '2015-10-05')");
  // すべての処理が成功したら、トランザクションをコミット
  $db->commit();
} catch(PDOException $e) {
  // 例外が発生したら、エラーメッセージを表示＆トランザクションをロールバック
  $db->rollBack();
  print "エラーメッセージ：{$e->getMessage()}";
}

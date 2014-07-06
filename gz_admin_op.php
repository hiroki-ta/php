<?php
error_reporting("E_ALL & ~E_NOTICE");
session_start();
if(isset($_SESSION['us']) && $_SESSION['us'] != null &&
  $_SESSION['tm'] >= time() - 300) {
    $_SESSION['tm'] = time();
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
<title>たび写真館管理画面</title>
</head>
<body>
<?php
    require_once("db_init.php");
    $n = $db->exec("UPDATE table1 SET ope = 1");
    foreach($_POST['check'] as $a => $b) {
      $n = $db->exec("UPDATE table1 SET ope = 0 WHERE ban = $b");
      print $b . "は非公開です<br>";
    }
?>
<p><a href='gz_admin.php'>管理画面に戻る</a></p>
<p><a href='gz.php'>通常画面に戻る</a></p>
<?php
  } else {
    session_destroy();
    print "<p>ちゃんとログオンしてね!<br>
      <a href='gz_logon.php'>ログオン</a></p>";
  }
?>
</body>
</html>

<?php
session_start();
$u = htmlspecialchars($_POST['myn'], ENT_QUOTES);
$p = htmlspecialchars($_POST['myc'], ENT_QUOTES);
$b = htmlspecialchars($_POST['myb'], ENT_QUOTES);
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
<title>コメントを書き込みました</title>
</head>
<body style='background-color:lightblue'>
<?php
if(isset($_SESSION['us']) && $_SESSION['us'] != null &&
  $_SESSION['tm'] >= time()-300) {
    $_SESSION['tm'] = time();
?>
  <p><?php print $u; ?>さんは次のようにコメントを書き込みました</p>
  <p>【コメント】<br><?php print $p; ?></p>
<a href='gz.php'>一覧表示に戻ります</a>
<?php
    require_once("db_init.php");
    $ima = date('YmdHis');
    $ps = $db->prepare("INSERT INTO table3 (ban, com, nam, dat) values (:v_b, :v_c, :v_n, :v_d)");
    $ps->bindParam(':v_b', $b);
    $ps->bindParam(':v_c', $p);
    $ps->bindParam(':v_n', $u);
    $ps->bindParam(':v_d', $ima);
    $ps->execute();
  } else {
    session_destroy();
    print "<p>ちゃんとログオンしてね!<br>
      <a href='gz_logon.php'>ログオン</a></p>";
  }
?>
</body>
</html>

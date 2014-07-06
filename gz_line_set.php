<?php
session_start();
$u = htmlspecialchars($_POST['myn'], ENT_QUOTES);
$b = htmlspecialchars($_POST['myb'], ENT_QUOTES);
if(isset($_SESSION['us']) && $_SESSION['us'] != null &&
  $_SESSION['tm'] >= time()-300) {
    $_SESSION['tm'] = time();
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
<title>イイネを送信しました</title>
</head>
<body sytle='background-color:lightblue'>
<?php
    require_once("db_init.php");
    $ps = $db->prepare("INSERT INTO table4 (ban,nam)
      values (:v_b,:v_n)");
    $ps->bindParam(':v_b', $b);
    $ps->bindParam(':v_n', $u);
    $ps->execute();
    print "<p>" . $u . "さんが「イイネ!」と言いました<br>
      <a href='gz.php'>一覧表示に戻る</a></p>";
  } else {
    session_destroy();
    print "<p>ちゃんとログオンしてね!<br>
      <a href='gz_logon.php'>ログオン</a></p>";
  }
?>
</body>
</html>

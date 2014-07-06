<?php
session_start();
$u = $_GET['sn'];
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
<title>コメントをどうぞ!</title>
</head>
<body style='background-color:lightblue'>
<?php
if(isset($_SESSION['us']) && $_SESSION['us'] != null &&
  $_SESSION['tm'] >= time()-300) {
    $_SESSION['tm'] = time();
?>
  <p><?php print $u; ?>番の画像に対するコメントをどうぞ!</p>

<form action = "gz_com_set.php" method="POST">
名前<br>
<input type = "text" name = "myn"
value = "<?php print $_SESSION['us']; ?>"><br>
コメント<br>
<textarea name = "myc" rows = "10" cols = "70"></textarea><br>
<input type = "hidden" name = "myb" value = "<?php print $u; ?>">
<input type = "submit" value = "送信">
</form>
<p><a href = gz.php>一覧表示に戻る</a></p>
<?php
  } else {
    session_destroy();
    print "<p>ちゃんとログオンしてね!<br>
      <a href='gz_logon.php'>ログオン</a></p>";
  }
?>
</body>
</html>

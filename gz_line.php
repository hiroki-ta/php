<?php
session_start();
$b = $_GET['tran_b'];
if(isset($_SESSION['us']) && $_SESSION['us'] != null &&
  $_SESSION['tm'] >= time() - 300) {
    $_SESSION['tm'] = time();
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
<title>イイネを送信します</title>
</head>
<body style = 'background-color:khaki'>
<p><?php print $b; ?>番の投稿に<u>イイネ!</u>と言いました</p>
名前を入力してください<br>
<form action="gz_line_set.php" method="POST">
名前<br>
<input type = "text" name = "myn"
value = "<?php print $_SESSION['us']; ?>"><br>
<input type = "hidden" name = "myb"
value = "<?php print $b; ?>">
<input type="submit" value="送信">
</form>
<?php
  } else {
    session_destroy();
    print "<p>ちゃんとログオンしてね!<br>
      <a href='gz_logon.php'>ログオン</a></p>";
  }
?>
</body>
</html>

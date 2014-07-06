<?php
session_start();
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
<title>たび画像アップロード</title>
</head>
<body style='background-color:lightblue'>
<?php
if(isset($_SESSION['us']) && $_SESSION['us'] != null &&
  $_SESSION['tm'] >= time()-300) {
    $_SESSION['tm'] = time();
?>
<p style="color:deeppink;font-size:300%">たび写真館</p>
投稿よろしくお願いします!
<form enctype = "multipart/form-data" action = "gz_up_set.php"
method = "POST">
名前<br>
<input type = "text" name = "myn"
value = "<?php print $_SESSION['us']; ?>"><br>
メッセージ<br>
<textarea name = "mym" rows = "10" cols = "70"></textarea><br>
<input type = "file" name = "myf">
<p>送信できるのは1MBまでのJPEG画像だけです!<br>
また展開後のメモリ消費が多い場合アップロードできません。<br>
<input type = "submit" value = "送信"><br>
<a href = gz.php>一覧表示へ</a></p>
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

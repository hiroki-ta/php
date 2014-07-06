<html>
<head>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
<title>たび写真館ログオン</title>
<link rel='stylesheet' href='gz_style_file.css' type='text/css'>
</head>
<body style='background-color:lightblue'>
<p class="title_pink">たび写真館</p>

<?php
if(isset($_COOKIE['gz_user'])) {
  print "<p>" . $_COOKIE['gz_user'] .
    "さんは前回{$_COOKIE['gz_date']}に利用しています</p>";
  $gu = $_COOKIE['gz_user'];
} else {
  print "<p>はじめてのご来場ありがとうございます!</p>";
  $gu="";
}
?>

<p>ログオンしてください。</p>
<form action="gz_logon2.php" method="POST">
ユーザ名
<input type = "text" name = "user" size = "30"
value = "<?php print $gu; ?>"><br>
パスワード
<input type = "password" name = "pass" size= "30">
<input type = "submit" value = "送信">
</form>
</body>
</html>

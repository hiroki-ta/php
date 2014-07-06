<?php
session_start();
$u = htmlspecialchars($_POST['user'], ENT_QUOTES);
$p = htmlspecialchars($_POST['pass'], ENT_QUOTES);
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
<title>ようこそ!たび写真館</title>
<body>
<?php
require_once("db_init.php");
$ps = $db->query("SELECT pas FROM table2 WHERE id='$u'");
if($ps->rowCount()>0){
  $r = $ps->fetch();
  if($r['pas'] === md5($p)) {
    $_SESSION['us'] = $u;
    $_SESSION['tm'] = time();
    if($u === "admin") {
      print "管理者のページにどうぞ<br>
        <a href='gz_admin.php'>管理者のページ</a>";
    } else {
      print "<p>一般ユーザー" . $u . "さん<br>
        ようこそたび写真館へ!</p>
        <a href='gz.php'>
        ここをクリックして一覧表示にどうぞ</a>";
    }
  } else {
    session_destroy();
    print "<p>登録されていないかパスワードが違います<br>
      <a href='gz_logon.php'>ログオン</a></p>";
  }
} else {
  session_destroy();
  print "<p>登録されていないかパスワードが違います<br>
    <a href='gz_logon.php'>ログオン</a></p>";
}
?>
</body>
</html>

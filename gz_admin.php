<?php
session_start();
if(isset($_SESSION['us']) && $_SESSION['us'] != null &&
  $_SESSION['tm'] >= time() - 300) {
    $SESSION['tm'] = time();
    setcookie("gz_user", $_SESSION['us'], time()+60*60*+24*365);
    setcookie("gz_date", date('Y年m月d日H時i分s秒'), time()+60*60*24*365);
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
<title>たび写真館　管理画面</title>
<link rel='stylesheet' href='gz_style_file.css' type='text/css'>
</haed>
<body>
<p>ここは管理者のページです</p>
<p><a href="gz_logoff.php">ログオフ</a></p>
<form action="gz_admin_op.php" method="POST">
<?php
    require_once("db_init.php");
    $ps = $db->query("SELECT * FROM table1 ORDER BY ban DESC");
    while ($r = $ps->fetch()) {
      $tg = $r['gaz'];
      $tb = $r['ban'];
      $to = $r['ope'];
      $li = null;
      $ps_li = $db->query("SELECT DISTINCT * FROM table4
        WHERE ban = $tb");
      $coun_line = 0;
      while($r_li = $ps_li->fetch()) {
        $li = $li . " " . $r_li['nam'];
        $coun_line++;
      }
      print "<div id='box'>対象" . $r['ban'] .
        "<input type = checkbox name = check[] value = $tb";
      if($to == 0) print " CHECKED = checked";
      print ">非公開<br>
      {$r['ban']}【投稿者：{$r['nam']}】{$r['dat']}
      <p class='line'><a href=gz_line.php?tran_b=$tb>イイネ!</a>
      ($coun_line)：$li" . "</p><br>" . nl2br($r['mes'])
      ."<br><a href = './gz_img/$tg' target = '_blank'>
      <img src='./gz_img/thumb_$tg'></a><br>
      <p class = 'com'><a href = 'gz_com.php?sn=$tb'>
      コメントするときはここをクリック</a></p>";

      $ps_com = $db->query("SELECT * FROM table3 WHERE ban = $tb");
      $coun = 1;
      while($r_com = $ps_com->fetch()) {
        print "<p class='com'>● 投稿コメント{$coun}<br>
          【{$r_com['nam']}さんへのメッセージ】{$r_com['dat']}<br>"
          . nl2br($r_com['com']) . "</p>";
        $coun++;
      }
      print "</p></div>";
    }
?>
<input type = "submit" value='公開・非公開の送信'>
</form>
<p><a href = 'gz_up.php'>画像をアップロードするときはここ</a></p>
<p><a href = 'gz_logoff.php'>ログオフ</a></p>
<?php
  } else {
    session_destroy();
    print "<p>ちゃんとログオンしてね!<br>
      <a href='gz_logon.php'>ログオン</a></p>";
  }
?>
</body>
</html>

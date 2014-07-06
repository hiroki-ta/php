<?php
session_start();
?>

<html>
<head>
<meta http equiv='Content-Type' content='text/html;charset=UTF-8'>
<title>アップロード完了</title>
</head>
<body style='background-color:khaki'>
<?php
if(isset($_SESSION["us"]) && $_SESSION["us"] != null &&
$_SESSION['tm']>=time()-300) {
  $file = $_FILES['myf'];

  if($_POST['myn'] <> "" && $_POST['mym'] <> "" && $file['size'] > 0
    && ($file['type'] == 'image/jpeg' ||
    $file['type'] == 'image/pjpeg')
    && (strtolower(mb_strrchr($file['name'], '.', FALSE)) == ".jpg")) {

      if($file['size'] > 1024*1024) {
        unlink($file['tmp_name']);
        print "<p>アップするファイルのサイズは1MB以下にしてください<br>
          <a href='gz_up.php'>アップに戻る</a></p>";
      } else {
        //アップロードされた画像ファイルを移動
        $ima = date('YmdHis');
        $fn = $ima . $file['name'];
        move_uploaded_file($file['tmp_name'], './gz_img/'.$fn);

        $my_nam = htmlspecialchars($_POST['myn'],ENT_QUOTES);
        $my_mes = htmlspecialchars($_POST['mym'],ENT_QUOTES);

        //サムネイルの作成
        $motogazo = @imagecreatefromjpeg("./gz_img/$fn");
        list($w, $h) = getimagesize("./gz_img/$fn");
        $new_h = 200;
        $new_w = $w * 200 / $h;
        $mythumb = imagecreatetruecolor($new_w, $new_h);
        imagecopyresized($mythumb, $motogazo, 0, 0, 0, 0,
          $new_w,$new_h,$w,$h);
        imagejpeg($mythumb, "./gz_img/thumb_$fn");

        //サムネイルの表示
        print "<p>" . $file['name'] . "のアップロードに成功!<br>
          <img src='./gz_img/thumb_$fn'></p>";

        //データベースに追加
        require_once("db_init.php");

        $ps = $db->prepare("INSERT INTO table1 (nam,mes,ope,gaz,dat) VALUES (:v_n,:v_m,1,:v_g,:v_d)");
        $ps->bindParam(':v_n', $my_nam);
        $ps->bindParam(':v_m', $my_mes);
        $ps->bindParam(':v_g', $fn);
        $ps->bindParam(':v_d', $ima);
        $ps->execute();
        print "<a href=gz.php>一覧表示へ</a>";
      }
    } else {
      print "<p>名前とメッセージを入力しJPEGファイルを選択してください<br>
        <a href='gz_up.php'>再度アップロード</a></p>";
    }
} else {
  session_destroy();
  print "<p>ちゃんとログオンしてね!<br>
    <a href='gz_logon.php'>ログオン</a></p>";
}
?>
</body>
</html>

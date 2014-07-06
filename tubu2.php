<?php
$t = $_POST["a"];
print $t;
print "<br>......<br>";
$d = mysql_connect("localhost","hiroki","birthday0923");
mysql_select_db("db",$d);
$r = mysql_query("SELECT * FROM reply WHERE '$t' LIKE CONCAT('%', tubuyaki, '%')");
$n = 1;
while($row = mysql_fetch_array($r)) {
  print $row['henzi'] . "<br>";
  $n++;
}
print ($n == 1)? "なんかおもしろいことないかな？":"";
mysql_close($d);
?>

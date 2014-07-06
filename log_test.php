<?php
$ip = getenv("REMOTE_ADDR");
$ag = getenv("HTTP_USER_AGENT");
$dt = date("YmdHis");
$fh = fopen("my_log.txt","at");

if($fh) {
  fwrite($fh, $dt . "," . $ip . "," . $ag . "\n");
  fclose($fh);
}else {
  print "ファイルのオープンに失敗しました";
}
?>

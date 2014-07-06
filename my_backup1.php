<?php
$from = "./data";
$to = "./data2";
$d = dir($from);
$td = $to . "/" . "bk" . date("Y_m_d_H_i_s");

if(mkdir($td)) {
  while(($s = $d->read()) !== false){
    $p_from = $from . "/" . $s;
    $p_to = $td . "/" . $s;
    if(is_file($p_from)) {
      copy($p_from, $p_to);
    }
  }

  print $p_from . "を" . $p_to . "にコピー<br>";
  print $td . "ディレクトリへのバックアップを完了しました";
}else {
  print "ディレクトリ作成に失敗しました";
}
?>

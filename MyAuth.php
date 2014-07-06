<?php
  require_once 'Auth/Auth.php';
  
      // 認証フォーム呼び出しのためのユーザ定義関数
  function myLogin($usr, $status) {
        // エラーメッセージ（の候補）を連想配列で準備
    $errs = array(
      AUTH_IDLED => 'アイドル時間を超えています。再ログインしてください。',
      AUTH_EXPIRED => '時間切れです。再ログインしてください。',
      AUTH_WRONG_LOGIN => 'ユーザ/パスワードが誤っています。'
    );
        // 認証フォーム呼び出し
    require_once 'login.php';
  }
      // Authクラスのインスタンス化
  $auth = new Auth('MDB2',
    array(
      'dsn' => 'mysqli://hiroki:birthday0923@localhost/selfphp',
      'table' => 'usr',
      'usernamecol' => 'uid',
      'passwordcol' => 'passwd',
      'db_fields' => '*'
    ), 'myLogin'
  );
      // 認証処理の実行
  $auth->start();
      // 認証の成否を判定（未認証、認証失敗時にはスクリプトを終了）
  if(!$auth->checkAuth()) { die(); }

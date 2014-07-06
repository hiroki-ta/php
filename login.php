<h1 align="center">ログインページ</h1>
<hr />
<form method="POST" action="">
  <div style="text-align:center">
    <p>
    ユーザ名：
    <input type="text" name="username" size="20" maxlength="30" />
    </p>
    <p>
    パスワード：
    <input type="password" name="password" size="20" maxlength="30" />
    </p>
    <p>
      <input type="submit" name="submit" value="ログイン" />
    </p>
    <!--エラーメッセージを表示するための領域-->
    <div style="color:Red"><?php print $errs[$status]; ?></div>
  </div>
</form>

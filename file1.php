<html>
<head>
<title>アップロード処理</title>
</head>
<body>
<!--アップロード時はenctype属性に注意-->
<form method="POST" action="file2.php" enctype="multipart/form-data">
ファイルのパス：
<input type="file" name="upfile" size="40" />
<input type="hidden" name="max_file_size" value="1000000" />
<input type="submit" value="アップロード" />
</form>
</body>
</html>

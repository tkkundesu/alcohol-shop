<?php
 if($_SERVER['REQUEST_METHOD']==='POST'){
if(isset($_REQUEST['yes'])){//20歳以上のお客様の場合の処理
	header('Location:index1.php');exit();
}

if(isset($_REQUEST['no'])){//20才未満のお客様の処理
	echo '<script>alert("年齢制限を満たされない方は恐れ入りますがページをお閉じください。");</script>';
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="css/style2.css">
	<link href="https://fonts.googleapis.com/css?family=Donegal+One&display=swap" rel="stylesheet">
</head>
<body>
<div class="ain">
<p class="apen">警告：あなたは２０歳以上ですか？</p>
<p><img src="images/miseinen.png" width="400px" height="320px"></p>
<div class="form_alert">
<form action="" method="post">
<input type="hidden" name="yes" value="yes">
<input type="submit" value="YES!" class="button"><br>
</form>
<form action="" method="post">
<input type="hidden" name="no" value="no">
<input type="submit" value="NO!" class="button">
</form>
</div>
</div>
</body>
</html>

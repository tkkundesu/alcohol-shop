<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head> 
<link rel="icon" href='images/favicon.ico'>
 
	<meta charset="UTF-8">
	<title>酒太郎</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style1.css">
	<link href="https://fonts.googleapis.com/css?family=Donegal+One&display=swap" rel="stylesheet">
</head>
<body>
	<div class="saketaro">
		
		<?PHP
		if(!isset($_SESSION['cart'])){
			 $_SESSION['cart']=[];//カートの個数のセッションが用意されていない場合初期化
	    $_SESSION['cart']['count']=0;}
		echo '<header><div id="header"><a href="index1.php"><img src="images/main-logo2.png" width="150" height="150"></a>';
		if (isset($_SESSION['customer'])) {//ログインしている時の表示
		echo 	'<div class="tag-all"><ul>';
		echo		'<li><span class="logname">',$_SESSION['customer']['name'],'</span>さん</li>';
		echo		'<li><a href="index1.php">ホーム</a></li>';
		echo		'<li><a href="favorite.php">お気に入り</a></li>';
		echo		'<li><a href="cart-show.php">カート('.$_SESSION['cart']['count'].'個)</a></li>';
		echo		'<li><a href="history.php">注文履歴</a></li>';
		echo		'<li><a href="customer-detail.php">お客様情報</a></li>';
		echo		'<li><a href="login-input.php">ログイン</a></li>';
		echo		'<li><a href="logout-input.php">ログアウト</a></li>';
		echo 	'</ul></div>';
		} else{//ログインしていないのに時の表示
		echo 	'<div class="tag-all"><ul>';
		echo		'<li>ようこそゲストさん</li>';
		echo		'<li><a href="index1.php">ホーム</a></li>';
		echo		'<li><a href="favorite.php">お気に入り</a></li>';
		echo		'<li><a href="cart-show.php">カート('.$_SESSION['cart']['count'].'個)</a></li>';
		echo		'<li><a href="history.php">注文履歴</a></li>';
		echo		'<li><a href="customer-input.php">新規登録</a></li>';
		echo		'<li><a href="login-input.php">ログイン</a></li>';
		echo		'<li><a href="logout-input.php">ログアウト</a></li>';
		echo 	'</ul></div>';
		}

		echo '</div></header>';
		?>

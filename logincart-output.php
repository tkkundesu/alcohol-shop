<?php session_start();?>
<?php
require_once(__DIR__.'/config.php');

try{
	$pdo=new PDO(DSN,DB_USERNAME,DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e){
     echo $e->getmessage();
     exit;
 } 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="icon" href='images/favicon.ico'>

	<meta charset="UTF-8">
	<title>teamC</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="css/style2.css">
	<link rel="stylesheet" href="css/style3.css">
	<link href="https://fonts.googleapis.com/css?family=Donegal+One&display=swap" rel="stylesheet">
</head>
<body>
	<div class="saketaro">

<?php
unset($_SESSION['customer']);
$sql=$pdo->prepare('select * from customer where login=? and password=?');
$sql->execute([$_REQUEST['login'], $_REQUEST['password']]);
foreach ($sql as $row) {
	$_SESSION['customer']=[
		'id'=>$row['id'], 'name'=>$row['name'],
		'address'=>$row['address'], 'login'=>$row['login'],
		'password'=>$row['password']];
}
if (isset($_SESSION['customer'])) {
	if(!isset($_SESSION['cart'])){
		 $_SESSION['cart']=[];
		$_SESSION['cart']['count']=0;}
	echo '<header><div id="header"><a href="index1.php"><img src="images/main-logo2.png" width="150" height="150"></a>';
	if (isset($_SESSION['customer'])) {
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
	} else{
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
	require 'cart.php';
} else {
	if(!isset($_SESSION['cart'])){
		 $_SESSION['cart']=[];
		$_SESSION['cart']['count']=0;}
	echo '<header><div id="header"><a href="index1.php"><img src="images/main-logo2.png" width="150" height="150"></a>';
	if (isset($_SESSION['customer'])) {
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
	} else{
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
echo'<script>alert("パスワードまたはログイン名が違います");</script>';
echo '<div id="pan" class="clearfixed">';
require 'logincart-input.php';
echo '</div>';
}
?>
</div>
<?php require 'footer.php'?>;

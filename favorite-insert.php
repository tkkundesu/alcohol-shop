<?php require 'header.php';?>
<?php
if (isset($_SESSION['customer'])) {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	$sql=$pdo->prepare('insert into favorite values(?,?)');
	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo '<a "favorite-insert.php">お気に入り</a>に商品を追加しました。';
	echo '<hr>';
	header('Location:favorite.php');
	exit();
} else {
	echo 'お気に入り商品を追加するには、<a href="login-input.php">ログイン</a>してください。';
}
?>

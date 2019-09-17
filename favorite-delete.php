<?php require 'header.php';?>
<?php
if (isset($_SESSION['customer'])) {
	$pdo=new PDO('mysql:host=localhost;dbname=shop;charset=utf8', 
		'staff', 'password');
	$sql=$pdo->prepare(
		'delete from favorite where customer_id=? and product_id=?');
	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo 'お気に入りから商品を削除しました。';
	echo '<hr>';
	header('Location:favorite.php');
	exit();
} else {
	echo 'お気に入りを消去するには、<a href="login-input.php">ログイン</a>してください。';
}

?>

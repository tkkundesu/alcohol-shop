<?php require 'header.php';?>
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
<?php
if (isset($_SESSION['customer'])) {
	
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

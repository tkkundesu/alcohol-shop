<?php require 'header.php';?>
<?php
require_once(__DIR__.'/config.php');

try{
	$pdo=new PDO(DSN,DB_USERNAME,DB_PASSWORD);//データーベース接続
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e){
     echo $e->getmessage();//エラー表示
     exit;
 } 
?>
<?php
if (isset($_SESSION['customer'])) {
	
	$sql=$pdo->prepare(
		'delete from favorite where customer_id=? and product_id=?');//任意の項目をテーブルから削除
	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo 'お気に入りから商品を削除しました。';
	echo '<hr>';
	header('Location:favorite.php');//リダイレクト
	exit();
} else {
	echo 'お気に入りを消去するには、<a href="login-input.php">ログイン</a>してください。';
}

?>

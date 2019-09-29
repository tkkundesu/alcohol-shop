<?php require 'header.php';?>
<?php
require_once(__DIR__.'/config.php');

try{
	$pdo=new PDO(DSN,DB_USERNAME,DB_PASSWORD);//データベース接続
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e){
     echo $e->getmessage();//エラー表示
     exit;
 } 
?>
<?php
if (isset($_SESSION['customer'])) {
	
	$sql=$pdo->prepare('insert into favorite values(?,?)');//送られてきた情報をもとにデータベースへ追加
	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo '<a "favorite-insert.php">お気に入り</a>に商品を追加しました。';
	echo '<hr>';
	header('Location:favorite.php');
	exit();
} else {
	echo 'お気に入り商品を追加するには、<a href="login-input.php">ログイン</a>してください。';
}
?>

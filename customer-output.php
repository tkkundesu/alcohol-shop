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
if (isset($_SESSION['customer'])) {
	$id=$_SESSION['customer']['id'];//ログイン時、ログイン名重複チェック
	$sql=$pdo->prepare('select * from customer where id!=? and login=?');
	$sql->execute([$id,$_REQUEST['login']]);
} else {
	$sql=$pdo->prepare('select * from customer where login=?');//ログイン名重複チェック
	$sql->execute([$_REQUEST['login']]);
}
if (empty($sql->fetchAll())) {//抽出したsql文が空である場合
	if (isset($_SESSION['customer'])) {
		echo '<div id="pan" class="clearfix main">すでにログインしています。<br>
		<a href="index1.php">ホームに戻る</a></div>';
	} else {
	$sql=$pdo->prepare('insert into customer values(null,?,?,?,?)');//新規顧客情報をカスタマーテーブルへ挿入
	$sql->execute([
		$_REQUEST['name'],$_REQUEST['address'],$_REQUEST['login'],$_REQUEST['password']]);
	echo '<div id="pan" class="clearfix main">お客様情報を登録しました。<br>
	<a href="index1.php">ホームに戻る</a></div>';
	}
}else {
	echo '<div id="pan" class="clearfix main">ログイン名がすでに使用されていますので変更してください。<br>
	<a href="index1.php">ホームに戻る</a></div>';
}
?>
<?php require 'footer.php';?>

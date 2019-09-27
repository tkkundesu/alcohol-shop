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
	$id=$_SESSION['customer']['id'];//ログイン状態の時のログイン名の重複をチェック
	$sql=$pdo->prepare('select * from customer where id!=? and login=?');
	$sql->execute([$id,$_REQUEST['login']]);
} else {
	$sql=$pdo->prepare('select * from customer where login=?');//ログイン名の重複をチェック
	$sql->execute([$_REQUEST['login']]);
}
if (empty($sql->fetchAll())) {
		$sql=$pdo->prepare('update customer set name=?, address=?, login=?, password=? where id=?');
		$sql->execute([
			$_REQUEST['name'],$_REQUEST['address'],$_REQUEST['login'],$_REQUEST['password'],$id]);
		$_SESSION['customer']=[//セッションへ代入
			'id'=>$id, 'name'=>$_REQUEST['name'],'address'=>$_REQUEST['address'],'login'=>$_REQUEST['login'],'password'=>$_REQUEST['password']];
		echo '<div id="pan" class="clearfix main">お客様情報を更新しました。<br>
		<a href="index1.php">ホームに戻る</a></div>';

}else {
	echo '<div id="pan" class="clearfix main">ログイン名がすでに使用されていますので変更してください。</div>';
}
?>
<?php require 'footer.php';?>

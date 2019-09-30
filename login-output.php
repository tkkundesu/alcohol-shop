<?php require 'header.php'; ?>
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
unset($_SESSION['customer']);//アンセットする

$sql=$pdo->prepare('select * from customer where login=? and password=?');//送られてきた情報から抽出
$sql->execute([$_REQUEST['login'], $_REQUEST['password']]);
foreach ($sql as $row) {
	$_SESSION['customer']=[//セッションに格納
		'id'=>$row['id'], 'name'=>$row['name'], 
		'address'=>$row['address'], 'login'=>$row['login'], 
		'password'=>$row['password']];
}
if (isset($_SESSION['customer'])) {
	echo "いらっしゃいませ";
} else {
$alert = "<script type='text/javascript'>alert('パスワードまたはログイン名が違います');</script>";
echo $alert;
}
?>

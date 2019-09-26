<?php require 'header.php'; ?>
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
 if($_SERVER['REQUEST_METHOD']==='POST'){
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
	header('Location:index1.php');exit();
} else {
	echo '<script>alert("ログイン名またはパスワードが違います。");</script>';
}
}
?>
<div id="pan" class="clearfix main"><form action="login-input.php" method="post">
<p>ログイン名<br>
	<span><input type="text" id="ro"name="login" class="textbox"></span></p>
	<br>
<p>パスワード<br>
	<span><input type="password" id="rog"name="password" class="textbox"></span></p>
	<div class="b"><input type="submit" value="ログイン" class="button"></div>
</form></div>
	<?php require 'footer.php'?>

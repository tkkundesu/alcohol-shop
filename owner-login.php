<?php session_start()?>
<?php
require_once(__DIR__.'/config.php');
try{
	$db=new PDO(DSN,DB_USERNAME,DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e){
     echo $e->getmessage();
     exit;
 } 
   if($_SERVER['REQUEST_METHOD']==='POST'){
   	unset($_SESSION["owner"]);
    if(!$_REQUEST["login"]=='' && !$_REQUEST["password"]==''){
   	$sql=$db->prepare('select * from owner where owner_login=? and owner_password=?');
    $sql->execute([$_REQUEST["login"],$_REQUEST["password"]]);
    foreach ($sql as $row) {
      $_SESSION["owner"]=[
        'login'=>$row["owner_login"],'password'=>$row["owner_password"]
      ];
   	}
   }else{
    echo '<script>alert("ログイン名とパスワードを入力してください。");</script>';
    echo '<a href="index1.php">ホームへ</a>';
    exit();
   }
 
   if(isset($_SESSION["owner"])){
   	header('Location:owner.php');exit();
   	}else{
    echo '<script>alert("ログイン名またはパスワードが違います。");</script>';
    echo '<a href="index1.php">ホームへ</a>';
    exit();
   }
 }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
 <header>

 </header>
 <main>
  <h2>管理者用ログインページ</h2>
 	<form action="owner-login.php" method="post">
 	<p class="form">ログイン:<input type="text" name="login"></p>
 	<p class="form">パスワード:<input type="password" name="password"></p>
  <input type="submit" value="送信">
 	</form>
  <a href="index1.php">ホームへ戻る</a>
</body>
</html>

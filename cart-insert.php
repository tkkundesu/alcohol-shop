<?php require 'header.php'; ?>

<?php
$cart=$_SESSION['cart'];//カートの個数を管理するセッション
$id=$_REQUEST['id'];
if(!isset($_SESSION['product'])){
	$_SESSION['product']=[];//カートの中身を管理するセッションが定義されていなかったら用意する
}
$count=0;//カートの個数を管理するセッションの初期化
if(isset($_SESSION['product'][$id])){
	$count=$_SESSION['product'][$id]['count'];//
}
$_SESSION['product'][$id]=[
'name'=>$_REQUEST['name'],
'price'=>$_REQUEST['price'],
'count'=>$count+$_REQUEST['count']
];
$cart=$_SESSION['product']['count']+$cart;
echo '<script>alert("カートに【',$_REQUEST['name'],'】を追加しました");</script>';


?>
<?php require 'footer.php'; ?>

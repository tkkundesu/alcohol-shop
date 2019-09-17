<?php require 'header.php'; ?>

<?php
$cart=$_SESSION['cart'];
$id=$_REQUEST['id'];
if(!isset($_SESSION['product'])){
	$_SESSION['product']=[];
}
$count=0;
if(isset($_SESSION['product'][$id])){
	$count=$_SESSION['product'][$id]['count'];
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

<?php require 'header.php'; ?>

<?php
//カート内の全体の個数から任意の商品の個数を減らす
$_SESSION['cart']['count']=$_SESSION['cart']['count']-$_SESSION['product'][$_REQUEST['id']]['count'];
unset($_SESSION['product'][$_REQUEST['id']]);//カート内の任意の商品をアンセットする
echo '<script>alert("カートから【',$_REQUEST['delete'],'】を削除しました。");</script>';
require 'cart.php';

?>


<?php require 'footer.php'; ?>

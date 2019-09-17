<?php require 'header.php'; ?>

<?php
$_SESSION['cart']['count']=$_SESSION['cart']['count']-$_SESSION['product'][$_REQUEST['id']]['count'];
unset($_SESSION['product'][$_REQUEST['id']]);
echo '<script>alert("カートから【',$_REQUEST['delete'],'】を削除しました。");</script>';
require 'cart.php';

?>


<?php require 'footer.php'; ?>

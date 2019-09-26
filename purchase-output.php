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
<div id="pan" class="clearfixed">
<div class="purchase">
<?php
$purchase_id=1;
foreach ($pdo->query('select max(id) from purchase') as $row) {
	$purchase_id=$row['max(id)']+1;
}
$sql=$pdo->prepare('insert into purchase values(?,?,0)');
if ($sql->execute([$purchase_id, $_SESSION['customer']['id']])) {
	foreach ($_SESSION['product'] as $product_id=>$product) {
		$sql=$pdo->prepare('insert into purchase_detail values(?,?,?,null)');
		$sql->execute([$purchase_id, $product_id, $product['count']]);
	}
	unset($_SESSION['product']);
	unset($_SESSION['cart']);
	echo '<div class="purchase-message">';
	echo '<div class="purchase-img">';
	echo '<img src="images/main-logo2.png" hight="250px" width="250px">';
	echo '</div>';
	echo '<div class="thank">';
	echo '<div class="bold">ご購入の手続きが完了しました。ご注文ありがとうございました。</div>';
	echo '<p><a href="index1.php">ホームへ戻る</a></p>';
	echo '</div>';
	echo '</div>';

} else {
	echo '大変申し訳ございません。ご購入の手続き中にエラーが発生しました。';
	echo 'もう一度やり直してください。';
	echo '<p><a href="purchase-input.php">カートへ戻る</a></p>';
}
?>
</div>
</div>
<?php require 'footer.php'; ?>

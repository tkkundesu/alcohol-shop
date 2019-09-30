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
echo '<div id="pan" class="clearfixed">';
echo '<h2>ご注文履歴</h2>';
if (isset($_SESSION['customer'])) {
	
	$sql_purchase=$pdo->prepare(
		'select * from purchase where customer_id=? and state=0 order by id desc');//購入テーブルから顧客ＩＤに照らし合わせたものを逆順に抽出
	$sql_purchase->execute([$_SESSION['customer']['id']]);
	foreach ($sql_purchase as $row_purchase) {
		$sql_detail=$pdo->prepare(
			'select * from purchase_detail,product '.
			'where purchase_id=? and product_id=id');//商品詳細と商品テーブルを結合し抽出
		$sql_detail->execute([$row_purchase['id']]);
		echo '<table class="table-form">';
		echo '<tr><th>商品番号</th><th>商品名</th>', 
			'<th>価格</th><th>個数</th><th>注文日時</th><th>小計</th></tr>';
		$total=0;
		foreach ($sql_detail as $row_detail) {
			$price=round($row_detail['price']*1.08);
			echo '<tr>';
			echo '<td>', $row_detail['id'], '</td>';
			echo '<td><a href="detail.php?id=', $row_detail['id'], '">', 
				$row_detail['name'], '</a></td>';
			echo '<td>', $price, '円(税込）</td>';
			echo '<td>', $row_detail['count'], '</td>';
			echo '<td>', $row_detail['no_default'], '</td>';
			$subtotal=$price*$row_detail['count'];
			$total+=$subtotal;
			echo '<td>', $subtotal, '円(税込）</td>';
			echo '</tr>';
		}
		echo '<tr><td class="bold">合計</td><td></td><td></td><td></td><td></td><td class="bold">', 
			$total, '円(税込）</td></tr>';
		echo '</table>';
			if($_SERVER['REQUEST_METHOD']==='POST'){
			$sql=$pdo->prepare('update purchase set state=1 where id=?');//注文商品をキャンセルする
		    $sql->execute([$_REQUEST['id']]) ;
		    header('Location:history.php');exit();}
		echo '<form action="" method="post">';
		echo '<input class="button m" type="submit" value="キャンセル">';
		echo '<input type="hidden" name="id" value="'.$row_purchase['id'].'">';
		echo '</form>';		
	}
	echo '<div class="m"><a href="index1.php">ホームへ戻る</a></div>';
} else {
	echo '購入履歴を表示するには、ログインしてください。';
	echo '<a href="index1.php">ホームへ戻る</a>';
}

echo '</div>';
?>
<?php require 'footer.php';?>

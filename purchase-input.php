<?php require 'header.php'; ?>
<div id="pan" class="clearfixed">

<?php

if (!isset($_SESSION['customer'])) {//ログインしていないとき
	echo '<script>alert("ご購入手続きにはログインが必要です。")</script>';
	require 'logincart-input.php';
} else
if (empty($_SESSION['product'])) {//カート空のとき
	echo '<h2>ご注文内容</h2>';
	echo 'カートに商品がありません。';
} else {
	echo '<h2>ご注文内容</h2>';
	echo '<p class="bold">ー お届け先 ー</p>';//顧客名、住所表示
	echo '<p>お名前：', $_SESSION['customer']['name'], '</p>';
	echo '<p>ご住所：', $_SESSION['customer']['address'], '</p>';

	echo '<div class="require-cart">';
	if(!empty($_SESSION['product'])){//カートの商品が入っているとき詳細表示
		echo '<table class="table-form">';
		echo '<th></th><th class="num">商品番号</th><th>商品名</th><th>本体価格</th><th>税込価格</th><th>数量</th><th>小計</th><th></th>';
		$total=0;

		foreach($_SESSION['product'] as $id=>$product){
			echo '<tr>';
			echo '<td></td>';
			echo '<td>',$id,'</td>';
			echo '<td><a href="detail.php?id=',$id,'">',$product['name'],'</a></td>';
			echo '<td>',$product['price'],'円</td>';
			$includeTax=$product['price']*1.08;
			echo '<td>',round($includeTax),'円</td>';
			echo '<td>',$product['count'],'</td>';
			$subtotal=$includeTax*$product['count'];
			$total+=$includeTax;
			echo '<td>',round($subtotal),'円</td>';
			echo '<form class="button" action="cart-delete.php">';//削除処理
			echo '<input type="hidden" name="id" value=',$id,'>';
			echo '<input type="hidden" name="delete" value=',$product['name'],'>';
			echo '<td><input class="button" type="submit" value="削除"></td>';
			echo '</form>';
			echo '</tr>';
		}
		echo '<tr><td></td><td class="bold">合計</td><td></td><td></td><td></td><td></td><td class="bold">',round($total),'円</td><td><a class="bold" href="cart-delete-all.php?id=',$id,'">すべての商品を削除</a></td></tr>';
		echo '</table>';
	}
	echo '</div>';
	echo '<p class="bold">ご注文内容にお間違いがないことをご確認の上、ご注文を確定してください。</p>';
	
	echo '<form name="purchase-submit" action="purchase-output.php" method="post">';
	echo '<input class="button" type="submit" value="ご注文を確定する">';
	echo '</form>';
	
}
?>
</div>
<?php require 'footer.php';?>

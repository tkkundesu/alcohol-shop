
<?php
echo '<div id="pan" class="clearfixed">';
echo '<h2>カート</h2>';
if(!empty($_SESSION['product'])){
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
		$subtotal=$product['price']*1.08*$product['count'];
		$total+=$includeTax;
		echo '<td>',round($subtotal),'円</td>';
		echo '<form class="button" action="cart-delete.php">';
		echo '<input type="hidden" name="id" value=',$id,'>';
		echo '<input type="hidden" name="delete" value=',$product['name'],'>';
		echo '<td><input class="botton" type="submit" value="削除"></td>';
		echo '</form>';
		echo '</tr>';
	}
	echo '<tr><td></td><td class="bold">合計</td><td></td><td></td><td></td><td></td><td class="bold">',round($total),'円</td><td><a class="bold" href="cart-delete-all.php?id=',$id,'">すべての商品を削除</a></td></tr>';
	echo '</table>';
	echo '<div class="purchase-button">';
	echo '<form class="button" name="purchase" action="purchase-input.php" ,method="post">';
	echo '<input type="hidden" name="id" value=',$id,'>';
	echo '<input type="hidden" name="name" value=',$product['name'],'>';
	echo '<input type="hidden" name="price" value=',$product['price'],'>';
	echo '<input type="hidden" name="indludeTax" value=',$includeTax,'>';
	echo '<input type="hidden" name="count" value=',$product['count'],'>';
	echo '<input type="hidden" name="total" value=',$total,'>';
	echo '<input class="bottonp" type="submit" value="ご購入手続きを進める">';
	echo '</form>';
	echo '</div>';

}else{
	echo 'カートに商品がありません。';
}

echo '</div>';
?>

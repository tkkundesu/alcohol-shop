
<?php require 'header.php';?>
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
 <main>
<div id="pan" class="clearfix">	
<div class="category">
		<a href="index.php">all </a>/<a href="top-sales.php"> top-sales </a>/<a href="beer.php"> beer </a>/<a href="wine.php"> wine </a>/<a href="whisky.php"> whisky </a>/<a href="sale.php"> sale </a>
	
			<form action="search.php" method="post" class="index-search">
				<input type="text" name="keyword">
				<input type="submit" value="検索" class="button">
			</form>
	</div>
<h2>お気に入り</h2>
<?php
if (isset($_SESSION['customer'])) {
		
	$sql=$pdo->prepare(
		'select * from favorite, product '.
		'where customer_id=? and product_id=id');
	$sql->execute([$_SESSION['customer']['id']]);
	if(!empty($sql)){
		echo '<table class="table-favorite">';
	    echo '<tr><th>商品番号</th><th>商品名</th><th>価格</th><th>削除</th>';
		foreach ($sql as $row) {
		$id=$row['id'];
		echo '<tr>';
		echo '<td>', $id, '</td>';
		echo '<td><a href="detail.php?id='.$id.'">', $row['name'], 
			'</a></td>';
		echo '<td>', $row['price'], '</td>';
		echo '<td><a href="favorite-delete.php?id=', $id, 
			'">削除</a></td>';
		echo '</tr>';
	}
	echo '</table>';
	}else{
	echo 'お気に入り商品が登録されていません。';
	echo '<p><a href="index1.php">ホームへ戻る</a></p>';
}
	
} else {
	echo 'お気に入りを表示するには、<a href="login-input.php">ログイン</a>してください。';
}
?>
</div>
</main>
<?php require 'footer.php'?>

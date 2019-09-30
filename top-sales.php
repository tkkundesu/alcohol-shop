
<?php
require_once(__DIR__.'/config.php');

try{
	$db=new PDO(DSN,DB_USERNAME,DB_PASSWORD);//データベース接続
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e){
     echo $e->getmessage();//エラー表示
     exit;
 } 


?>

<?php require 'header.php'?>
<main>
<div id="pan" class="clearfix">	
<div class="category">
		<a href="index1.php">all </a>/<a href="top-sales.php"> top-sales </a>/<a href="beer.php"> beer </a>/<a href="wine.php"> wine </a>/<a href="whisky.php"> whisky </a>/<a href="sale.php"> sale </a>
	
			<form action="search.php" method="post" class="index-search">
				<input type="text" name="keyword">
				<input type="submit" value="検索" class="button">
			</form>
	</div>
	<h2>今売れている商品の一覧</h2>
	<div class="category_block">
		<?php
		$sql=$db->query("select product_id,price,name from purchase_detail,product where product_id=product.id group by product_id order by sum(count) DESC ");//購入個数が多い順番に抽出
		foreach ($sql as $row) :?>
		<div class="category_kind"><a href="detail.php?id=<?php echo $row['product_id']; ?>"><img src="images/<?php echo $row['product_id']; ?>.jpg" width="180" height="180" class="img_hover"></a>
		<p><div class="category_name"><?php echo $row['name']; ?></div></p>
		<p><?php echo round($row['price']*1.08); ?>円(税込）</p>
		</div>
		<?php endforeach;?>
	</div>
	</div>
<?php require 'footer.php'?>	

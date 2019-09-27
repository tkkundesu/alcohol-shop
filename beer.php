
<?php
require_once(__DIR__.'/config.php');

try{
	$db=new PDO(DSN,DB_USERNAME,DB_PASSWORD);//データベース接続
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e){
     echo $e->getmessage();//例外表示
     exit;
 } 
?>
<?php require 'header.php';?> 
 <main>
<div id="pan" class="clearfix">	
<div class="category">
		<a href="index1.php">all </a>/<a href="top-sales.php"> top-sales </a>/<a href="beer.php"> beer </a>/<a href="wine.php"> wine </a>/<a href="whisky.php"> whisky </a>/<a href="sale.php"> sale </a>
	
			<form action="search.php" method="post" class="index1-search">
				<input type="text" name="keyword">
				<input type="submit" value="検索" class="button">
			</form>
	</div>
	<h2>ビール</h2>
		<div class="category_block">
	<?php
	//ジャンルがビールの商品の一覧表示画面
	$sql=$db->query("select * from product where genre = 'ビール' ");//ジャンルがビールの商品抽出
	foreach ($sql as $row) :?>
			<div class="category_kind">
			<a href="detail.php?id=<?php echo $row['id'];//商品詳細画面のリンク ?>"><img src="images/<?php echo $row['id']; ?>.jpg" width="180" height="180" class="img_hover"></a>
	<p><?php echo '<div class="category_name">',$row['name'],'</div>'; ?></p>
	<p><?php echo round($row['price']*1.08); //税込計算?>円(税込）</p>
	</div>
	<?php endforeach;?>
</div>
</div>
 </main>
<?php require 'footer.php'?>	

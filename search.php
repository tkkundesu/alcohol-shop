<?php require 'header.php'?>
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
<div id="pan" class="clearfix">
	
<div class="category">
	
		<a href="index.php">all </a>/<a href="top-sales.php"> top-sales </a>/<a href="beer.php"> beer </a>/<a href="wine.php"> wine </a>/<a href="whisky.php"> whisky </a>/<a href="sale.php"> sale </a>
	
			<form action="search.php" method="post">
				<input type="text" name="keyword">
				<input type="submit" value="検索" class="button">
			</form>

</div>
	<h2>商品一覧</h2>
<div class="category_block">
<?php 

	$keyword="";

	if(isset($_REQUEST['keyword'])){
		$keyword=$_REQUEST['keyword'];//送られてきたキーワードを変数に格納
	}

	$sql=$pdo->prepare('select * from product where name like ?');//あいまい検索
	$sql->execute(['%'.$keyword.'%']);
	foreach ($sql as $row) {
		echo '<div class="category_kind"><a href="detail.php?id=',$row['id'],'">';
		echo '<img src="images/',$row['id'], '.jpg" width="180" height="180" class="img_hover"></a>';
		echo '<p><div class="category_name">',$row['name'],'</div></p>';
		echo '<p>', round($row['price']*1.08),'円(税込）</p></div>' ;


		echo "\n";
	}
 ?>
</div>
</div>
 <?php require 'footer.php'?>

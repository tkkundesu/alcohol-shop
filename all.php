
<?php
require_once(__DIR__.'/config.php');

try{
	$db=new PDO(DSN,DB_USERNAME,DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e){
     echo $e->getmessage();
     exit;
 } 


?>

<?php require 'header.php';?> 
<div id="pan" class="clearfix">
	<div class="category">
		<a href="index1.php">top-sales </a>/<a href="all.php"> all </a>/<a href="beer.php"> beer </a>/<a href="wine.php"> wine </a>/<a href="sale.php"> sale </a>
	
			<form action="search.php" method="post" class="index-search">
				<input type="text" name="keyword">
				<input type="submit" value="検索" class="button">
			</form>
	</div>
	<div class="category_block">
<?php
$sql=$db->query('select * from product');
foreach ($sql as $row) :?>
	<div class="category_kind">
	<a href="detail.php?id=<?php echo $row['id']; ?>"><img src="images/<?php echo $row['id']; ?>.jpg"width="180" height="180"></a>
<p><?php echo '<div class="category_name">',$row['name'],'</div>'; ?></p>
<p><?php echo round($row['price']*1.08); ?>円(税込）</p>
	</div>
<?php endforeach;?>
	</div>
</div>
<?php require 'footer.php'?>	

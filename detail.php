<?php require 'header.php';?>
<?php
require_once(__DIR__.'/config.php');

try{
	$pdo=new PDO(DSN,DB_USERNAME,DB_PASSWORD);//データベース接続
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e){
     echo $e->getmessage();//例外表示
     exit;
 } 
?>
<?php
if ($_SERVER ['REQUEST_METHOD'] === 'POST'){
	$id=$_REQUEST['id'];//送られてきたID番号変数に代入
if(!isset($_SESSION['product'])){//セッションプロダクト未定義時定義
	$_SESSION['product']=[];
}
$count=0;
if(isset($_SESSION['product'][$id])){//もともとカートに任意の商品が入っている時の個数を代入
	$count=$_SESSION['product'][$id]['count'];
}
$_SESSION['product'][$id]=[//セッションに情報代入
'name'=>$_REQUEST['name'],
'price'=>$_REQUEST['price'],
'count'=>$count+$_REQUEST['count']
];
$_SESSION['cart']['count']=$_REQUEST['count']+$_SESSION['cart']['count'];//カート内の個数を追加
echo '<script>alert("カートに【',$_REQUEST['name'],'】を追加しました");</script>';
}

?>

<div id="pan" class="clearfix">
	<div class="category">

		<a href="index1.php">all </a>/<a href="top-sales.php"> top-sales </a>/<a href="beer.php"> beer </a>/<a href="wine.php"> wine </a>/<a href="whisky.php"> whisky </a>/<a href="sale.php"> sale </a>
		
		<form action="search.php" method="post" class="index-search">
			<input type="text" name="keyword">
			<input type="submit" value="検索" class="button">
		</form>
	</div>
	<h2>商品詳細</h2>
	<div class="detail-all">
		<div class="detail-img">
			<?php
			$sql=$pdo->prepare('select * from product where id=?');//ID番号のプロダクトテーブル商品を抽出
			$sql->execute([$_REQUEST['id']]);
			foreach ($sql as $row) {
				echo '<img src="images/',$row['id'], '.jpg" width="200" height="200">';//画像表示
				echo '<p>※画像はイメージです</p></div>';
				echo '<div class="detail-about"><form action="detail.php" method="post">';
				echo '<p>商品番号：',$row['id'],'</p>';//商品ID表示
				echo '<p>商品名：',$row['name'],'</p>';//商品名表示
				echo '<p>価格：本体価格',$row['price'],'円　税込価格',round(($row['price'])*1.08),'円</p>';
				echo '<p>個数：<select name="count">';//個数を１０個以内で選択
				for ($i=1;$i<=10;$i++){
					echo'<option value="',$i,'">',$i,'</option>';
				}
				echo '</select></p>';

				echo '<p>商品説明：',$row['description'],'</p>';
				echo '<p>度数：',$row['degree'],'</p>';
				echo '<p>味わい・種類：',$row['taste'],'</p>';

				
				echo '<input type="hidden" name="id" value="',$row['id'],'">';//カート追加時の情報
				echo '<input type="hidden" name="name" value="',$row['name'],'">';//カート追加時の情報
				echo '<input type="hidden" name="price" value="',$row['price'],'">';//カート追加時の情報
				echo '<p><input type="submit" value="カートに追加"></p>';
				echo '</form>';
				echo '<p><a href="favorite-insert.php?id=',$row['id'],'">お気に入りに追加</a></p></div>';
			}
			 ?>
		 </div>
	 
	</div>
</div>
	
<?php require 'footer.php'?>

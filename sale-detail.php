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
	$id=$_REQUEST['id'];//送られてきたＩＤを変数に代入
if(!isset($_SESSION['product'])){
	$_SESSION['product']=[];
}

$count=0;
if(isset($_SESSION['product'][$id])){//任意の商品が既にカートに入っている場合の個数を代入
	$count=$_SESSION['product'][$id]['count'];
}
$_SESSION['product'][$id]=[//セッション格納
'name'=>$_REQUEST['name'],
'price'=>$_REQUEST['price'],
'count'=>$count+$_REQUEST['count']
];
$_SESSION['cart']['count']=$_REQUEST['count']+$_SESSION['cart']['count'];
echo '<script>alert("カートに【',$_REQUEST['name'],'】を追加しました");</script>';
}


?>
<div id="pan" class="clearfix">
	
	<a href="index.php">top-sales </a>/<a href="all.php"> all </a>/<a href="beer.php"> beer </a>/<a href="wine.php"> wine </a>/<a href="sale.php"> sale </a>
	<h2>商品詳細</h2>
	<div class="detail-all">
		<div class="detail-img">
	<?php
	$sql=$pdo->prepare('select * from sale_product where product_id=?');//セールプロダクトテーブルから抽出
	$sql->execute([$_REQUEST['id']]);
	foreach ($sql as $row) {
		echo '<img src="images/',$row['product_id'], '.jpg" width="200" height="200" class="detail-fadein">';
		echo '<p>※画像はイメージです</p></div>';
		echo '<div class="detail-about"><form action="sale-detail.php" method="post">';
		echo '<p>商品番号：',$row['product_id'],'</p>';
		echo '<p>商品名：',$row['name'],'</p>';
		echo '<p>価格：本体価格',$row['price'],'円　税込価格',round(($row['price'])*1.08),'円</p>';
		echo '<p>個数：<select name="count">';
		for ($i=1;$i<=10;$i++){//個数は10個以内で選択
			echo'<option value="',$i,'">',$i,'</option>';
		}
		echo '</select></p>';

		echo '<p>商品説明：',$row['description'],'</p>';
		echo '<p>度数：',$row['degree'],'</p>';
		echo '<p>味わい・種類：',$row['taste'],'</p>';

		
		echo '<input type="hidden" name="id" value="',$row['id'],'">';
		echo '<input type="hidden" name="name" value="',$row['name'],'">';
		echo '<input type="hidden" name="price" value="',$row['price'],'">';
		echo '<p><input type="submit" value="カートに追加"></p>';
		echo '</form>';
		echo '<p><a href="favorite-insert.php?id=',$row['id'],'">お気に入りに追加</a></p><div>';
	}
	 ?>
	 </div>
 </div>
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">
	$(function(){
	    $(window).on('load',function (){
	        $('.detail-fadein').each(function(){
	            var elemPos = $(this).offset().top;
	            var scroll = $(window).scrollTop();
	            var windowHeight = $(window).height();
	            if (scroll > elemPos - windowHeight + 200){
	                $(this).addClass('scrollin');
	            }
	        });
	    });
	});

</script>
</body>
</html>

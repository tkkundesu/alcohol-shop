<?php session_start();?>
<?php
require_once(__DIR__.'/config.php');
define('MAX_FILE_SIZE', 1 * 1024 * 1024);
 if(isset($_REQUEST['logout'])){
    unset($_SESSION["owner"]);
    header('Location:index1.php');
    exit();
  }
try{
  $db=new PDO(DSN,DB_USERNAME,DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
   
 }catch(PDOException $e){
     echo $e->getmessage();
     exit;
 }   
if(isset($_REQUEST['command'])){
  switch ($_REQUEST['command']) {
    case 'update':
    if(empty($_REQUEST["name"] and $_REQUEST["price"]  and $_REQUEST["description"] and $_REQUEST["degree"] and $_REQUEST["taste"]and $_REQUEST["genre"]))
      break;
  $sql=$db->prepare('update product set name=?,price=?,description=?,degree=?,taste=?,genre=? where id=?');
        $sql->execute([$_REQUEST['name'],$_REQUEST['price'],$_REQUEST['description'],$_REQUEST['degree'],$_REQUEST['taste'],$_REQUEST['genre'],$_REQUEST['id']]);
      break;
        case 'insert':
        if(empty($_REQUEST["name"] and $_REQUEST["price"]  and $_REQUEST["description"] and $_REQUEST["degree"] and $_REQUEST["taste"] and $_REQUEST["genre"]))    
        break;
        $sql=$db->prepare('insert into product values(null,?,?,?,?,?,?)');
        $sql->execute([$_REQUEST["name"],$_REQUEST["price"],$_REQUEST["description"],$_REQUEST["degree"],$_REQUEST["taste"],$_REQUEST["genre"]]);
        break;
        case 'delete':
        $sql=$db->prepare('delete from product where id=?');
        $sql->execute([$_REQUEST['id']]);
        break;
        case 'sale':
        $sql=$db->prepare('insert into sale_product values(null,?,?,?,?,?,?,?)');
        $sql->execute([$_REQUEST['id'],$_REQUEST["name"],$_REQUEST["price"],$_REQUEST["description"],$_REQUEST["degree"],$_REQUEST["taste"],$_REQUEST["genre"]]);
        $sql=$db->prepare('delete from product where id=?');
        $sql->execute([$_REQUEST['id']]);
        break;
  }
}

  if(isset($_REQUEST['command_s'])){
  switch ($_REQUEST['command_s']) {
    case 'update':
    if(empty($_REQUEST["name"] and $_REQUEST["price"] and $_REQUEST["genre"] and $_REQUEST["description"] and $_REQUEST["degree"] and $_REQUEST["taste"]))  
      break;
    $sql=$db->prepare('update sale_product set name=?,price=?,description=?,degree=?,taste=?,genre=? where id=?');
        $sql->execute([$_REQUEST['name'],$_REQUEST['price'],$_REQUEST['description'],$_REQUEST['degree'],$_REQUEST['taste'],$_REQUEST['genre'],$_REQUEST['id']]);
      break;
        case 'insert':
        if(empty($_REQUEST["name"] and $_REQUEST["price"] and $_REQUEST["genre"]))    
        break;
        $sql=$db->prepare('insert into sale_product values(null,?,?,?)');
        $sql->execute([$_REQUEST['name'],$_REQUEST['price'],$_REQUEST['genre']]);
        break;
        case 'delete':
        $sql=$db->prepare('delete from sale_product where id=?');
        $sql->execute([$_REQUEST['id']]);
        break;
     
  }
}
if(isset($_REQUEST['upload'])){
  if(isset($_FILES['image']) && isset($_FILES['image']['error'])){
      switch ($_FILES['image']['error']) {
        case UPLOAD_ERR_OK:
         
          break;
        
        case　UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
          echo '<script>alert("ファイルサイズが大きすぎます。");</script>';
          echo '<a href="owner.php">戻る</a>';
          exit;
          break;
        default:
          echo '<script>alert("エラーが発生しました。");</script>';
          echo '<a href="owner.php">戻る</a>';
          exit;
          break;
      }
  }else{
        echo '<script>alert("ファイルを選択してください。");</script>';
        echo '<a href="owner.php">戻る</a>';
        exit;
      }
  $imagetype=exif_imagetype($_FILES['image']['tmp_name']);
  switch ($imagetype) {
    case IMAGETYPE_JPEG:
       $ext='jpg';
      break;
    
    default:
     echo '<script>alert("アップロードできるファイルはＪＰＥＧのみです。");</script>';
     echo '<a href="owner.php">戻る</a>';
     exit;
      break;
  }
  foreach ($db->query('select max(id) from product') as $row) {
  $maxid=$row['max(id)'];
}
  $imagefilename=sprintf('%s.%s',$maxid,$ext);
  $savepath='images/'.$imagefilename;
  if(move_uploaded_file($_FILES['image']['tmp_name'],$savepath)){
    echo '<script>alert("アップロードに成功しました。");</script>';
  }else{
    echo '<script>alert("アップロードに失敗しました。");</script>';
  }
}


  if(isset($_REQUEST['command_c'])){
    // if(echo '<script>confirm("キャンセル処理を確認しましたか？");</script>';){
    $sql_delete1=$db->prepare('delete from purchase where id=?');
    $sql_delete1->execute([$_REQUEST['id']]);
    $sql_delete2=$db->prepare('delete from purchase_detail where purchase_id=?');
    $sql_delete2->execute([$_REQUEST['id']]);
//   }else{
//       exit();
// }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>wordrandom</title>
  <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="app.js"></script>
</head>
<body>
 <header>

 </header>
 <main>
  <form action="" method="post">
    <input type="hidden" name=logout>
    <input type="submit" value="ログアウト">
  </form>
 <p class="ow">商品一覧</p>  
<table>
 <tr>
   <th>商品Id</th><th>商品名</th><th>価格</th><th>商品説明</th><th>度数</th><th>ジャンル詳細</th><th>ジャンル</th>
 </tr>

  <?php

      $sql=$db->query('select * from product ');
        
     foreach ($sql as $row){
  echo '<tr>';    
  echo '<form class="ib" action="owner.php" method="post">';
  echo '<input type="hidden" name="command" value="update">';
  echo '<input type="hidden" name="id" value="', $row['id'], '">';
  echo '<td>'.$row['id'].'</td>';
  echo '<td><input type="text" name="name" value="', $row['name'], '"></td>';
  echo '<td><input type="text" name="price" value="', $row['price'], '"></td>';
  echo '<td><input type="text" name="description" value="', $row['description'], '"></td>';
  echo '<td><input type="text" name="degree" value="', $row['degree'], '"></td>';
  echo '<td><input type="text" name="taste" value="', $row['taste'], '"></td>';
  echo '<td>';
  echo '<select name="genre">'; 
  echo '<option value="', $row['genre'], '">', $row['genre'],'</option>';
  echo '<option value="ビール">ビール</option>';
  echo '<option value="ワイン">ワイン</option>';
  echo '<option value="ウイスキー">ウイスキー</option>';
  echo '</select>';
  echo '</td> ';
  echo '<td><input type="submit" value="更新"></td>';
  echo '</form> ';
  echo '<form class="ib" action="owner.php" method="post">';
  echo '<input type="hidden" name="command" value="delete">';
  echo '<input type="hidden" name="id" value="', $row['id'], '">';
  echo '<td><input type="submit" value="削除"></td>';
  echo '</form>';
  echo '<form class="ib" action="owner.php" method="post">';
  echo '<input type="hidden" name="command" value="sale">';
  echo '<input type="hidden" name="id" value="', $row['id'], '">';
  echo '<input type="hidden" name="name" value="', $row['name'], '">';
  echo '<input type="hidden" name="price" value="', $row['price'], '">';
  echo '<input type="hidden" name="genre" value="', $row['genre'], '">';
  echo '<input type="hidden" name="description" value="', $row['description'], '">';
  echo '<input type="hidden" name="degree" value="', $row['degree'], '">';
  echo '<input type="hidden" name="taste" value="', $row['taste'], '">';
  echo '<td><input type="submit" value="セール"></td>';
  echo '</form>';
  echo '</tr>';
}
?>
<tr>
<form action="owner.php" method="post">
<input type="hidden" name="command" value="insert">
<td></td>
<td><input type="text" name="name"></td>
<td><input type="text" name="price"></td>
<td><input type="text" name="description"></td>
<td><input type="text" name="degree"></td>
<td><input type="text" name="taste"></td>
<td>
<select name="genre">
<option value="ビール">ビール</option>
<option value="ウイスキー">ウイスキー</option>
<option value="ワイン">ワイン</option>
</select>
</td>
<td><input type="submit" value="追加"></td>
</form>
</tr>
</table>
 <p><a href="index1.php" class="rhome">ホーム</a></p>

 <hr>
 <p class="ow">セール商品</p>
 <table>
<tr>
   <th>ID</th><th>商品Id</th><th>商品名</th><th>価格</th><th>商品説明</th><th>度数</th><th>ジャンル詳細</th><th>ジャンル</th>
 </tr>
  <?php
 $sql=$db->query('select * from sale_product ');
        
     foreach ($sql as $row){
  echo '<tr>';    
  echo '<form class="ib" action="owner.php" method="post">';
  echo '<input type="hidden" name="command_s" value="update">';
  echo '<input type="hidden" name="id" value="', $row['id'], '">';
  echo '<td>';
  echo $row['id'];
  echo '</td> ';
  echo '<td>';
  echo $row['product_id'];
  echo '</td> ';
  echo '<td>';
  echo '<input type="text" name="name" value="', $row['name'], '">';
  echo '</td> ';
  echo '<td>';
  echo '<input type="text" name="price" value="', $row['price'], '">';
  echo '</td> ';
  echo '<td><input type="text" name="description" value="', $row['description'], '"></td>';
  echo '<td><input type="text" name="degree" value="', $row['degree'], '"></td>';
  echo '<td><input type="text" name="taste" value="', $row['taste'], '"></td>';
  echo '<td>';
  echo '<select name="genre">'; 
  echo '<option value="', $row['genre'], '">', $row['genre'],'</option>';
  echo '<option value="ビール">ビール</option>';
  echo '<option value="ワイン">ワイン</option>';
  echo '<option value="ウイスキー">ウイスキー</option>';
  echo '</select>';
  echo '</td> ';
  echo '<td>';
  echo '<input type="submit" value="更新">';
  echo '</td> ';
  echo '</form> ';
  echo '<form class="ib" action="owner.php" method="post">';
  echo '<input type="hidden" name="command_s" value="delete">';
  echo '<input type="hidden" name="id" value="', $row['id'], '">';
  echo '<td><input type="submit" value="削除"></td>';
  echo '</form>';
  echo '</tr>';
}
?>
</table>



      <div>
 <p><a href="index1.php" class="rhome">ホーム</a></p>
 <hr>
 <p class="ow">画像追加(※JPEGファイルのみ、またファイルサイズ1ＭＢ以下）</p>
 <form action="owner.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE;?>"> 
  <input type="hidden" name="upload" value="">
  <input type="file" name="image">
  <input type="submit" value="UPLOAD!">
 </form>
 </div>
 <hr>
 <p class="ow">注文状況</p>
 <table border="1">
 <tr>
   <th>購入番号</th><th>顧客番号</th><th>氏名</th><th>商品番号</th><th>数量</th>
 </tr>

<?php
$sql=$db->query('select * from purchase,purchase_detail,customer where state=0 and purchase.id=purchase_detail.purchase_id and purchase.customer_id=customer.id');
foreach ($sql as $row) {
  echo '<tr>';
  echo '<td>';
  echo $row['purchase_id'];
  echo '</td> ';
  echo '<td>';
  echo $row['customer_id'];
  echo '</td> ';
  echo '<td>';
  echo $row['name'];
  echo '</td> ';
  echo '<td>';
  echo $row['product_id'];
  echo '</td> ';
  echo '<td>';
  echo $row['count'];
  echo '</td> ';
  echo '</tr>';
}
?>

</table>
<p><a href="index1.php" class="rhome">ホーム</a></p>
<hr>
 <p class="ow">キャンセルリクエスト一覧</p>
 
 <table border="1">
 <tr>
   <th>購入番号</th><th>顧客番号</th><th>氏名</th><th>商品番号</th><th>数量</th>
 </tr>

<?php
$sql=$db->query('select * from purchase,purchase_detail,customer where state=1 and purchase.id=purchase_detail.purchase_id and purchase.customer_id=customer.id');
foreach ($sql as $row) {
  echo '<tr>';
  echo '<td>';
  echo $row['purchase_id'];
  echo '</td> ';
  echo '<td>';
  echo $row['customer_id'];
  echo '</td> ';
  echo '<td>';
  echo $row['name'];
  echo '</td> ';
  echo '<td>';
  echo $row['product_id'];
  echo '</td> ';
  echo '<td>';
  echo $row['count'];
  echo '</td> ';
  echo '<td>';
  echo '<form class="ib" action="owner.php" method="post">';
  echo '<input type="hidden" name="command_c" value="削除">';
  echo '<input type="hidden" name="id" value="', $row['purchase_id'], '">';
  echo '<input type="submit" value="削除">';
  echo '</form>';
  echo '</td> ';
  echo '</tr>';
}
?>
</table>
<p><a href="index1.php" class="rhome">ホーム</a></p>
 </main>
</body>
</html>

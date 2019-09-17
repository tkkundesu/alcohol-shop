<?php require 'header.php';?>

<?php
echo '<div id="pan" class="clearfix main"><form action="customer-output.php" method="post">';
echo '登録内容はお間違いありませんか?<br>';
echo '<input type="hidden" name="name" value="',$_REQUEST['name'],'">';
echo 'お名前：',$_REQUEST['name'],'<br>';
echo '<input type="hidden" name="address" value="',$_REQUEST['address'],'">';
echo 'ご住所：',$_REQUEST['address'],'<br>';
echo '<input type="hidden" name="login" value="',$_REQUEST['login'],'">';
echo 'ログイン名：',$_REQUEST['login'],'<br>';
echo '<input type="hidden" name="password" value="',$_REQUEST['password'],'">';
echo 'パスワード：',$_REQUEST['password'],'<br>';
echo '<input type="submit" value="登録" class="button">';
echo '</form></div>';
?>
<?php require 'footer.php';?>

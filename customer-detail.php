<?php require 'header.php';?>
<?php
$name=$address=$login=$password='';
if (isset($_SESSION['customer'])){
	$name=$_SESSION['customer']['name'];
	$address=$_SESSION['customer']['address'];
	$login=$_SESSION['customer']['login'];
	$password=$_SESSION['customer']['password'];
	echo '<div id="pan" class="clearfix main"><h2>お客様情報</h2>';
echo '<form action ="customer-detail-confirm.php" method="post">';
echo '<p>お名前<br>';
echo '<span><input type="text" name="name" value="',$name,'" class="textbox">';
echo '</span></p>';
echo '<p>ご住所<br>';
echo '<span><input type="text" name="address" value="',$address,'" class="textbox">';
echo '</span></p>';
echo '<p>ログイン名<br>';
echo '<span><input type="text" name="login" value="',$login,'" class="textbox">';
echo '</span></p>';
echo '<p>パスワード<br>';
echo '<span><input type="password" name="password" value="',$password,'" class="textbox">';
echo '</span></p>';
echo '<div class="b"><input type="submit" value="更新" class="button"></div>';
echo '</form></div>';

} else {
echo '<div id="pan" class="clearfix main">ログインしてください。';
echo '<p><a href="login-input.php">ログインページへ</a></p></div>';
}
?>
<?php require 'footer.php';?>


<?php require 'header.php';?>
<?php
//新規登録画面
echo '<div id="pan" class="clearfix"><h2>新規登録</h2>';
echo '<form action ="customer-confirm.php" method="post">';
echo '<p>お名前<br>';
echo '<span><input type="text" name="name" value="" class="textbox">';
echo '</span></p>';
echo '<p>ご住所<br>';
echo '<span><input type="text" name="address" value="" class="textbox">';
echo '</span></p>';
echo '<p>ログイン名<br>';
echo '<span><input type="text" name="login" value="" class="textbox">';
echo '</span></p>';
echo '<p>パスワード<br>';
echo '<span><input type="password" name="password" value="" class="textbox">';
echo '</span></p>';
echo '<div class="b"><input type="submit" value="確定" class="button"></div>';
echo '</form></div>';
?>
<?php require 'footer.php';?>

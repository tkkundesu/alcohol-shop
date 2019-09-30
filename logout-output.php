<?php require 'header.php'; ?>
<?php
if (isset($_SESSION['customer'])) {//ログイン状態の時はアンセットする
	unset($_SESSION['customer']);
	echo '<div id="pan" class="clearfix main">ログアウトしました。</div>';
} else {
	echo '<div id="pan" class="clearfix main">すでにログアウトしています。</div>';
}
?>

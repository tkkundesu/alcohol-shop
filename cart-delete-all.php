<?php require 'header.php'; ?>

<?php
unset($_SESSION['product']);//カートの中身を管理しているセッションのアンセット
unset($_SESSION['cart']);//カートの個数を管理しているセッションのアンセット?>

<div id="pan" class="clearfixed">
<h2>カート</h2>
<p>カートを空にしました。</p>
<p><a href="index1.php">ホームへ戻る</a></p>
</div>

<?php require 'footer.php'; ?>

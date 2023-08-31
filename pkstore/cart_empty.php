
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品編集</title>
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body>

<header>
<div class="header-left">
    <a href="index.php"><img src="img/logo.png" alt="PKstoreのロゴ" class="img"></a>
    <img src="img/character.png" alt="PKstoreのキャラクター" class="img">
    <a href="buyItem.php">カートの中身（仮）</a>
    <a href="authority.php">管理者用メニュー（仮）</a>
</div>

<div class="header-right">
    <a href="login.php">ログイン・会員登録はこちら</a>
    <ul>
        <!-- ログインしていない -->
        <li><a href="pk_onlineshop.php">グッズ販売</a></li>
        <li><a href="sns.php">SNS</li>
        <li><a href="news.php">新着情報</li>
        <li><a href="store_info.php">店舗情報</a></li>
        <li><a href="mail.php">お問い合わせ</a></li>
    </ul>
</div>
</header>
<main>
<h3>カートが空になりました</h3>
<?php
  require 'vars.php';
  $_SESSION['cart'] = null;
  header('Location: cart.php');
?>



</main>
<footer>

<div class="footer-l">
    <img src="img/logo.png" alt="PKstoreのロゴ" class="img">
    <ul>
        <li><a href="company.php" class="fotter-text">Company</a></li>
        <li><a href="mail.php" class="fotter-text">Contact</a></li>
        <li><a href="store_info.php" class="fotter-text">Map</a></li>
    </ul>
</div>
<div class="footer-r">
    
    <ul>
        <li><a href="index.php"><img src="img/twittericon.png" alt="Xのロゴ" class="img1"></a></li>
        <li><a href="index.php"><img src="img/instaicon.png" alt="Instagramのロゴ" class="img1"></a></li>
        <li><a href="index.php"><img src="img/youtubeicon.png" alt="Youtubeのロゴ" class="img1 youtubeicon"></a></li>

    </ul>
</div>

</footer>

    

</body>
</html>
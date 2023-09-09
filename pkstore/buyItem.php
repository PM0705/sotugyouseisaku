<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カートの中身</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/6-1-7.css">
    
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body>
   
<header>
    <div class="header-left">
        <a href="index.php"><img src="img/logo.png" alt="PKstoreのロゴ" class="img"></a>
        <img src="img/character.png" alt="PKstoreのキャラクター" class="img pkc">   
    </div>
    <!-- 特別管理者 -->
    <?php 
    if(!empty($_SESSION['authority'])){
    $authority = $_SESSION['authority'];
    if ($_SESSION['authority'] == 1){?>
    <div class="authority_menu">
        <a href="authority.php" class="authority-1">管理者用メニュー（仮）</a>
    </div>
    <?php }
    }?>
    <div class="header-right">
        <!-- ログインしていない -->
        <?php if (empty($_SESSION["id"])) :?>
            <a href="login.php">ログイン・会員登録はこちら</a>
            <ul>
                <li><a href="sns.php">SNS</li>
                <li><a href="news.php">新着情報</li>
                <li><a href="store_info.php">店舗情報</a></li>
                <li><a href="mail.php">お問い合わせ</a></li>
            </ul>
        <!-- 一般 -->
        <?php else:?>
                <?php $message = $_SESSION['mail']."さんようこそ";?>
                <div class="message-text"><?php echo htmlspecialchars($message, ENT_QUOTES); ?><a href="logout.php">(ログアウト)</a></div>
            <ul>
                <li><a href="pk_onlineshop.php">shop</a></li>
                <li><a href="sns.php">SNS</li>
                <li><a href="news.php">新着情報</li>
                <li><a href="store_info.php">店舗情報</a></li>
                <li><a href="mail.php">お問い合わせ</a></li>
                <li><a href="cart.php"><img src="img/cart.png" alt="買い物カゴ" class="cart-img"></a></li>
            </ul>
            
        <?php endif; ?>
    </div>
</header>
 <main class="buyItem-page">
 <h3>カートの中身</h3>
    <form method="post"  action="buyItem_comfirm.php" class="buyItem-form">
        <table class="buyItem">
            <tr class="buyItem-tr">
                <th class="th-width10">削除</th>
                <th class="th-width30">商品内容</th>
                <th class="th-width30">数量</th>
                <th class="th-width30">小計</th>
            </tr>
            <tr>
                <td>削除</td>
                <td>
                    <div class="Item-img">
                        <img src="img/NEWg1.png" alt="商品画像" class="Itemimg">
                        <label for="名前">名前</label>
                        <label for="名前" name="item_name">texttexttexttexttexttext</label>
                    </div>
                </td>
                <td><div class="Item-img"><img src="img/NEWg1.png" alt="商品画像" class="Itemimg">
                    <p name="item_name">texttexttexttexttexttext</p></div>
                </td>
                <td name="count">2</td>
                <td name="price">¥2000</td>
            </tr>
        </table>
        <p name="total_price">合計:¥2000</p>
            <div class="contactbox-submit">
                <input type="submit" class="submit Item-submit"value="レジに進む">
            </div>  
    </form>
    <div class="contactbox-submit">
    <form action="" class="buyItem-submit">
            <input type="submit" class="submit Item-submit" value="戻って修正する">
    </form>
    </div>  

</main>
<footer>
    <div class="footer-l">
        <img src="img/logo.png" alt="PKstoreのロゴ" class="logo">
        <ul>
            <li><a href="company.php" class="fotter-text">Company</a></li>
            <li><a href="mail.php" class="fotter-text">Contact</a></li>
            <li><a href="store_info.php" class="fotter-text">Map</a></li>
            <li><a href="index.php"><img src="img/twittericon.png" alt="Xのロゴ" class="img1"></a></li>
            <li><a href="index.php"><img src="img/instaicon.png" alt="Instagramのロゴ" class="img1"></a></li>
            <li><a href="index.php"><img src="img/youtubeicon.png" alt="Youtubeのロゴ" class="img1 youtubeicon"></a></li>

        </ul>
    </div>  
</footer>

</body>
</html>
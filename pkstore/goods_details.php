<?php
session_start();
include 'vars.php'; 
    if (isset($_GET['id'])) {
        try {
 
            // 接続処理
            $dsn = 'mysql:host=localhost;dbname=pkstore77';
            $user = 'pkstore77';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
 
            // SELECT文を発行
            $sql = "SELECT * FROM item_info_transaction WHERE id = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();
            $member = $stmt->fetch(PDO::FETCH_OBJ); // 1件のレコードを取得
            // 接続切断
            $dbh = null;
 
        } catch (PDOException $e) {
            print $e->getMessage() . "<br/>";
            
        }
 
    }
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員管理フォーム</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/6-1-7.css">
    
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body>
   
<header>
    <div class="header-left">
        <a href="index.php"><img src="img/logo.png" alt="PKstoreのロゴ" class="img"></a>
        <img src="img/character.png" alt="PKstoreのキャラクター" class="img">   
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
        <a href="login.php">ログイン・会員登録はこちら</a>
        <a href="cart.php">カートの中身（仮）</a>
        <ul>
            <li><a href="pk_onlineshop.php">グッズ販売</a></li>
            <li><a href="sns.php">SNS</li>
            <li><a href="news.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
        </ul>
        <?php endif; ?>
    </div>
</header>
<main class="regist-page">

<h3>NEW~情報~</h3>

<div class="account_field">
    <form method="post" action="update_new_info.php" name="form" >
        <div class="contact-form errorMsg">
<!-- ID -->
            <input type="hidden" name="id" value="<?php echo($member->id) ?>">
<!-- タイトル・内容 -->            
            <img src="images_comp/<?php echo($member->item_img_path);?>"><br>
            <span class="account_text">商品名:</span><span class="account_text"><?php echo($member->item_name);?></span><br>
            <span class="account_text">値段:</span><span class="account_text"><?php echo($member->item_price);?></span><br>
            <span class="account_text">在庫:</span><span class="account_text"><?php echo($member->item_stock);?></span><br>
            <span class="account_text">キーワード:</span><span class="account_text"><?php echo($member->keyword);?></span><br>
            <span class="account_text">カテゴリー:</span><span class="account_text"><?php echo($member->category);?></span><br>
<!-- NEW -->
            <span class="account_text">NEW:</span><span class="account_text">
            <?php error_reporting(0);
                if ($info_new == 0) {
                    echo "ON";
                    }else{
                            echo "OFF";
                    } ?></span><br>
<!-- 情報 -->
            <span class="account_text">表示:</span><span class="account_text">
            <?php error_reporting(0);
                if ($display == 0) {
                    echo "ON";
                    }else{
                            echo "OFF";
                    } ?></span><br>

<!-- 送信ボタン -->
            <div class="contact-submit">
                <button type="button" class="submit delete" onclick="location.href='delete_comfirm_goods.php?id=<?php echo($member->id) ?>'">削除</button>
                <button type="button" class="submit" onclick="location.href='update_goods.php?id=<?php echo($member->id) ?>'">編集</button>    
            </div>
        </div>
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
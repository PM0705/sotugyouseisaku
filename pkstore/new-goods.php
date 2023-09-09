<?php
session_start();
include 'vars.php'; 
?>
<?php
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
    <title>新着グッズ</title>
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
<main >
<h3>新着グッズ</h3>
    <div class="account_field">
        <div class="contact-form errorMsg">
    <!-- ID -->
            <input type="hidden" name="id" value="<?php echo($member->id) ?>">
    <!-- タイトル・内容 -->  
            <div class="relative">          
                <img src="images_comp/<?php echo($member->item_img_path);?>" class="news-page-img info-img"><br>
                <img src="img/newicon.png" alt="newicon" class="absolute">  
                </div>
            <span class="news_text"><?php echo($member->item_name);?></span><br>
            <span class="news_text">¥<?php echo($member->item_price);?></span><br>

            <form method="post" action="cart.php" enctype="multipart/form-data">
                <select name="buy_count" >
                    <?php for($i=1;$i<10;$i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
                <!-- 売り切れの場合は、formを置換 -->
                <?php if(($member->item_stock) > 0){ ?>

                <input type="hidden" name="id" value="<?= get_SessionValue('id') ?>">
                <input type="hidden" name="item_img_path" value="<?php echo ($member->item_img_path) ?>">
                <input type="hidden" name="item_name" value="<?php echo($member->item_name) ?>">
                <input type="hidden" name="item_price" value="<?php echo ($member->item_price) ?>">
                <div class="contact-submit">
                <input type="submit" name="item_id" value="カートへ" class="submit contact-submit">
                </div> 
            </form>
            <div class="contact-submit">
                <button onclick="location.href='index.php'" class="submit contact-submit">HOMEへ戻る</button>
            </div>
            
            <?php }else{ ?>
                <p>売切</p>
                <button onclick="location.href='index.php'" class="submit">HOMEへ戻る</button>
            <?php } ?>
            

        </div>
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
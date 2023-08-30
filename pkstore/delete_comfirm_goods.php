<?php
 var_dump($_GET);
// includeは最初の１行でOK
include 'vars.php'; 
?>
<?php
    if (isset($_GET['id'])) {
        try {
 
            // 接続処理
            $dsn = 'mysql:host=localhost;dbname=pkstore';
            $user = 'root';
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
    <div class="header-right">
        <a href="login.php">ログイン・会員登録はこちら</a>
        <ul>
<!-- ログインしていない -->
            <li><a href="pk_onlineshop.php">グッズ販売</a></li>
            <li><a href="sns.php">SNS</li>
            <li><a href="index.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
        </ul>
    </div>
</header>
<main class="regist-page">

<h3>NEW~情報~</h3>

<div class="account_field">

        <div class="contact-form errorMsg">
<!-- ID -->
            <input type="hidden" name="id" value="<?php echo($member->id) ?>">
<!-- タイトル・内容 -->            
            <img src="images/<?php echo($member->item_img_path);?>"><br>
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
            <form action="goods_details.php" method="post">
                <button type="button" class="submit" value="前に戻る" onclick="history.back()">前に戻る</button>
            </form>
                <form action="delete_complete_goods.php" method="post">
                    <input type="submit" class="submit" value="削除する"href="delete_complete_account.php<? $result['id'] ?>" name="btnSend">
                    <input type="hidden" value="<?php echo($member->id); ?>" name="id">
            
                </form>    
            </div>
        </div>
</div>






       
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
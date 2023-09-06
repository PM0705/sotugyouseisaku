<?php

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
            $sql = "SELECT * FROM slide WHERE id = :id";
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
    <title>オススメ情報</title>
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
        <li><a href="news.php">新着情報</li>
        <li><a href="store_info.php">店舗情報</a></li>
        <li><a href="mail.php">お問い合わせ</a></li>
    </ul>
</div>
</header>
<main >

    <h3><span><?php echo($member->slide_title);?></span><br></h3>
    <div class="account_field">
        <div class="contact-form errorMsg">
<!-- ID -->
            <input type="hidden" name="id" value="<?php echo($member->id) ?>">
<!-- タイトル・内容 -->            
            <img src="images_comp/<?php echo($member->slide_img_path);?>" class="news-page-img"><br>
            
            <span class="news_text"><?php echo($member->slide_keyword);?></span><br>


<!-- 送信ボタン -->
            <div class="contact-submit">
            <button onclick="location.href='index.php'" class="submit">HOMEへ戻る</button>
            </div>
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
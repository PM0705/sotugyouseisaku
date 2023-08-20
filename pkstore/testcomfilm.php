
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ内容確認</title>
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
 <main class="contact-page">
 <h3>お問い合わせ内容確認</h3>
 <div class="contactbox mail-confirm">
        <p>お問い合わせの内容は、こちらで宜しいでしょうか？
            <br>よろしければ「送信する」ボタンを押してください。
        </p>
        <div class="mail-contactbox-text">
            <p for="名前">名前:
            <?php
            echo $_POST['name'];
            ?></p>
        </div>
        <div class="mail-contactbox-text">
            <p for="メールアドレス">メールアドレス:
            <?php
           echo $_POST['mail'];
           ?>
           </p>
        </div>
        <div class="mail-contactbox-text">
            <p for="電話">電話:
            <?php
           echo $_POST['tel'];
           ?>
           </p>
        </div>
        <div class="mail-contactbox-text">
            <p for="お問い合わせ内容">お問い合わせ内容:<br>
            <?php
           echo $_POST['comments'];
           ?></p>
           
        </div>

        <div class="submit-confirm">
            <form action="test.php" method="post">  
                <input type="submit" class="submit" value="戻って修正する" onclick="window.history.back()">
                <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
                <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                <input type="hidden" value="<?php echo $_POST['tel']; ?>" name="tel">
                <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
            </form>

            </form>
            <form action="mail_complete.php"method="post">
                <input type="submit" class="submit" value="送信する">
                <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
                <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                <input type="hidden" value="<?php echo $_POST['tel']; ?>" name="tel">
                <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
            </form>
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
<?php
mb_internal_encoding("utf8");
$pdo=new PDO("mysql:dbname=pkstore;host=localhost;","root","root");
$pdo ->exec("insert into contactform(name,mail,tel,comments)
       values('".$_POST['name']."',
              '".$_POST['mail']."',
              '".$_POST['tel']."',
              '".$_POST['comments']."');
            ");
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ内容確認</title>
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
            <p for="お問い合わせ内容">お問い合わせ内容:</p>
            <p><?php
           echo $_POST['comments'];
           ?></p>
           
        </div>

        <div class="submit-confirm">
            <form action="mail.php" method="post">  
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

    
 <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!--自作のJS-->
    <script>
    $('.slider').slick({
		autoplay: true,//自動的に動き出すか。初期値はfalse。
		infinite: true,//スライドをループさせるかどうか。初期値はtrue。
		speed: 500,//スライドのスピード。初期値は300。
		slidesToShow: 3,//スライドを画面に3枚見せる
		slidesToScroll: 1,//1回のスクロールで1枚の写真を移動して見せる
		prevArrow: '<div class="slick-prev"></div>',//矢印部分PreviewのHTMLを変更
		nextArrow: '<div class="slick-next"></div>',//矢印部分NextのHTMLを変更
		centerMode: true,//要素を中央ぞろえにする
		variableWidth: true,//幅の違う画像の高さを揃えて表示
		dots: true,//下部ドットナビゲーションの表示
	});
    </script>
    <script src="js/6-1-7.js"></script>
</body>
</html>
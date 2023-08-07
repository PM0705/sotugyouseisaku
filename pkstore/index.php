<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKstoreWELCOM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script class="slide">
      $(document).ready(function(){
        $('.abc').bxSlider({
            auto: true,
            speed: 2000,
            
        });
      });
      
    </script>
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body>
   
 <header>
    <div class="header-left">
        <img src="img/logo.png" alt="PKstoreのロゴ" class="img">
        <img src="img/character.png" alt="PKstoreのキャラクター" class="img">
    </div>
    <div class="header-right">
        <a href="index.php">ログイン・会員登録はこちら</a>
        <ul>
            <!-- ログインしていない -->
            <li><a href="index.php">グッズ販売</a></li>
            <li>SNS</li>
            <li>新着情報</li>
            <li><a href="login.php">店舗情報</a></li>
            <li><a href="login.php">お問い合わせ</a></li>
        </ul>
    </div>
 </header>
 <main>
    <div class="main-container">
        <div class="left">
            <div class="slidebox">
                <div class="abc slide-item">
                    <div><img src="img/jQuery_image1.jpg" alt="スライド1"></div>
                    <div><img src="img/jQuery_image2.jpg" alt="スライド2"></div>
                    <div><img src="img/jQuery_image3.jpg" alt="スライド3"></div>
                    <div><img src="img/jQuery_image4.jpg" alt="スライド4"></div>
                    <div><img src="img/jQuery_image5.jpg" alt="スライド5"></div>
                    
                </div>
            </div>
        </div>
    </div>
 </main>
 <footer>
    
    <div class="footer-l">
        <img src="img/logo.png" alt="PKstoreのロゴ" class="img">
        <ul>
            <li><a href="index.php">Company</a></li>
            <li><a href="index.php">Contact</a></li>
            <li><a href="index.php">Map</a></li>
        </ul>
    </div>
    <div class="footer-r">
        <p>OFFICIAL SNS</p>
        <ul>
                <li><a href="index.php">X（旧twitter）</a></li>
                <li><a href="index.php">Instagram</a></li>
                <li><a href="index.php">Youtube</a></li>
        </ul>
    </div>
    
 </footer>

    
 
</body>
</html>
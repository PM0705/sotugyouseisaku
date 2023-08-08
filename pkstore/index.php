<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKstoreWELCOM</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/6-1-7.css">
    
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
    <ul class="slider"><!--/slider-->
        <li><img src="img/slide1.png" alt="スライド1"></li>
        <li><img src="img/slide2.png" alt="スライド2"></li>
        <li><img src="img/slide3.png" alt="スライド3"></li>
        <li><img src="img/slide4.png" alt="スライド4"></li>
        <li><img src="img/slide5.png" alt="スライド5"></li>
    </ul>
        
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
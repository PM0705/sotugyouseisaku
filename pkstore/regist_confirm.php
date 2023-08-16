<?php
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録フォーム</title>
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
 <h3>会員登録確認フォーム</h3>
 <div class="confirm">
        <p>名前（姓）
           <br>
           <?php
           echo $_POST['family_name'];
           ?>
        </p>
        <p>名前（名）
           <br>
           <?php
           echo $_POST['last_name'];
           ?>
        </p>
        <p>カナ（姓）
           <br>
           <?php
           echo $_POST['family_name_kana'];
           ?>
        </p>
        <p>カナ（名）
           <br>
           <?php
           echo $_POST['last_name_kana'];
           ?>
        </p>
        <p>メールアドレス
           <br>
           <?php
           echo $_POST['mail'];
           ?>
        </p>
        <p>パスワード
           <br>
          
           <?php
             $pw = $_POST['password'];
             echo str_repeat('⚫︎', mb_strlen($pw, 'UTF8'));
            
            ?>
        </p>
        <p>性別
           <br>
           <?php
           error_reporting(0);
           if ($_POST['gender'] == 0) {
               echo "男";
               }else{
                    echo "女";
            }
           ?>
        </p>
        <p>郵便番号
           <br>
           <?php
           echo $_POST['postal_code'];
           ?>
        </p>
        <p>住所（都道府県）
           <br>
           <?php
           echo $_POST['prefecture'];
           ?>
        </p>
        <p>住所（市区町村）
           <br>
           <?php
           echo $_POST['address_1'];
           ?>
        </p>
        <p>住所（番地）
           <br>
           <?php
           echo $_POST['address_2'];
           ?>
        </p>
        <p>アカウント権限
           <br>
           <?php
           error_reporting(0);
           if ($_POST['authority'] == 0) {
               echo "一般";
               }else{
                    echo "管理者";
            }
           ?>
        </p>
        <div class="form submit1">
            <form action="regist.php" method="post">  
                  <input type="submit" class="submit" value="前に戻る" onclick="window.history.back()">
                  <input type="hidden" value="<?php echo $_POST['family_name']; ?>" name="family_name">
                  <input type="hidden" value="<?php echo $_POST['last_name']; ?>" name="last_name">
                  <input type="hidden" value="<?php echo $_POST['family_name_kana']; ?>" name="family_name_kana">
                  <input type="hidden" value="<?php echo $_POST['last_name_kana']; ?>" name="last_name_kana">
                  <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                  <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
                  <input type="hidden" value="<?php echo $_POST['gender']; ?>" name="gender">
                  <input type="hidden" value="<?php echo $_POST['postal_code']; ?>" name="postal_code">
                  <input type="hidden" value="<?php echo $_POST['prefecture']; ?>" name="prefecture">
                  <input type="hidden" value="<?php echo $_POST['address_1']; ?>" name="address_1">
                  <input type="hidden" value="<?php echo $_POST['address_2']; ?>" name="address_2">
                  <input type="hidden" value="<?php echo $_POST['authority']; ?>" name="authority">
            </form>

            <form action="regist_complete.php" method="post">
            
                  <input type="submit" class="submit" value="登録する">
                  <input type="hidden" value="<?php echo $_POST['family_name']; ?>" name="family_name">
                  <input type="hidden" value="<?php echo $_POST['last_name']; ?>" name="last_name">
                  <input type="hidden" value="<?php echo $_POST['family_name_kana']; ?>" name="family_name_kana">
                  <input type="hidden" value="<?php echo $_POST['last_name_kana']; ?>" name="last_name_kana">
                  <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                  <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
                  <input type="hidden" value="<?php echo $_POST['gender']; ?>" name="gender">
                  <input type="hidden" value="<?php echo $_POST['postal_code']; ?>" name="postal_code">
                  <input type="hidden" value="<?php echo $_POST['prefecture']; ?>" name="prefecture">
                  <input type="hidden" value="<?php echo $_POST['address_1']; ?>" name="address_1">
                  <input type="hidden" value="<?php echo $_POST['address_2']; ?>" name="address_2">
                  <input type="hidden" value="<?php echo $_POST['authority']; ?>" name="authority">

                  
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
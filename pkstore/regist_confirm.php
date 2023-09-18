<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録フォーム</title>
    <link rel="stylesheet" href="htmlstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9e0ab757d4.js" crossorigin="anonymous"></script> 
</head>
<body>
   
<div class="header0">
    <!-- ログインしていない -->
            <?php if (empty($_SESSION['id'])) :?> 
            
        <ul>
            <li><a href="sns.php">SNS</li>
            <li><a href="news.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
            <li><a href="login.php">ログイン・会員登録はこちら</a></li>
        </ul>
    <!-- 管理者 -->
            <?php elseif ($_SESSION['authority'] == 1) :?>
                <?php $message1 = $_SESSION['mail']."さんようこそ";?>
        <ul>
            <li><a href="pk_onlineshop.php">shop</a></li>           
            <li><a href="sns.php">SNS</li>
            <li><a href="news.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
            <li><a href="authority.php">管理者用メニュー</a></li>
            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            <li><?php echo htmlspecialchars($message1, ENT_QUOTES); ?><a href="logout.php">(ログアウト)</a></li>
        </ul>
            
        
        <?php else:?>
            <?php $message1 = $_SESSION['mail']."さんようこそ";?>
        <ul>
            <li><a href="pk_onlineshop.php">shop</a></li>
            <li><a href="sns.php">SNS</li>
            <li><a href="news.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            <li><?php echo htmlspecialchars($message1, ENT_QUOTES); ?><a href="logout.php">(ログアウト)</a></li>
  
        </ul>   
        <?php endif; ?>
</div>
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
        <a href="index.php"><img src="img/PKlogo.png" alt="PKstoreのロゴ" class="h-img logo"></a>
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
<?php
session_start();
$message = "";
try {

//フォームから受け取った値を変数に代入
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
mb_internal_encoding("utf8");
$pdo=new PDO("mysql:dbname=pkstore77;host=localhost;","pkstore77","root");
$pdo ->exec("INSERT INTO account_list(family_name,last_name,family_name_kana,last_name_kana,
                         mail,password,gender,postal_code,prefecture,address_1,address_2,authority) 
      VALUES ('".$_POST['family_name']."',
              '".$_POST['last_name']."',
              '".$_POST['family_name_kana']."',
              '".$_POST['last_name_kana']."',
              '".$_POST['mail']."',
              '$password',
              '".$_POST['gender']."',
              '".$_POST['postal_code']."',
              '".$_POST['prefecture']."',
              '".$_POST['address_1']."',
              '".$_POST['address_2']."',
              '".$_POST['authority']."'
              
      );");
    $message = '登録が完了しました。ログインして引き続きPKstoreをお楽しみください';
    } catch (PDOException $e) {
        
        $message = 'エラーが発生したためアカウント登録できません。';

            }
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品管理</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/6-1-7.css">
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body> 
<header>
    <div class="header-left">
        <a href="index.php"><img src="img/pkstore.png" alt="PKstoreのロゴ" class="h-img"></a>
        <img src="img/PKlogo.png" alt="PKstoreのキャラクター" class="pkc">   
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
                <?php $message1 = $_SESSION['mail']."さんようこそ";?>
                <div class="message-text"><?php echo htmlspecialchars($message1, ENT_QUOTES); ?><a href="logout.php">(ログアウト)</a></div>
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
 <main class="regist-page">
      <h3>会員登録完了</h3>
      <div class="confirm">
         <div><?php echo htmlspecialchars($message, ENT_QUOTES); ?></div>
         <form action="login.php">
         <button onclick="location.href='login.php'" class="submit" value="ログインｘ" >
                  ログイン          
         </button>
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
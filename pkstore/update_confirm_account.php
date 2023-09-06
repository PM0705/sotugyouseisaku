<?php
var_dump($_GET);
var_dump($_POST);
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員情報編集フォーム</title>
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
<h3>会員情報編集フォーム</h3>
<div class="confirm">
    <p>名前（姓）<span></span>
    
    <?php
    echo $_POST['family_name'];
    ?>
    </p>
    <p>名前（名） <span></span>
    
    <?php
    echo $_POST['last_name'];
    ?>
    </p>
    <p>カナ（姓）<span></span>
    
    <?php
    echo $_POST['family_name_kana'];
    ?>
    </p>
    <p>カナ（名）<span></span>
    
    <?php
    echo $_POST['last_name_kana'];
    ?>
    </p>
    <p>メールアドレス<span></span>
    
    <?php
    echo $_POST['mail'];
    ?>
    </p>
    <!-- <p>パスワード<span></span> -->
    
    <?php
    // $pw = $_POST['password'];
    // echo str_repeat('⚫︎', mb_strlen($pw, 'UTF8'));
    
    // ?>
    
    </p>
    <p>性別<span></span>
    
    <?php
    error_reporting(0);
    if ($_POST['gender'] == 0) {
        echo "男";
        }else{
                echo "女";
        }
    ?>
    </p>
    <p>郵便番号<span></span>
    
    <?php
    echo $_POST['postal_code'];
    ?>
    </p>
    <p>住所（都道府県）<span></span>
    
    <?php
    echo $_POST['prefecture'];
    ?>
    </p>
    <p>住所（市区町村）<span></span>
    
    <?php
    echo $_POST['address_1'];
    ?>
    </p>
    <p>住所（番地）<span></span>
    
    <?php
    echo $_POST['address_2'];
    ?>
    </p>
    <p>アカウント権限<span></span>
    
    <?php
    error_reporting(0);
    if ($_POST['authority'] == 0) {
        echo "一般";
        }else{
                echo "管理者";
        }
    ?>
    </p>
    <div class="form1">
        <form action="update_account.php" method="post">
            <!-- <input type="submit" class="button1" value="前に戻る"> -->
            <button type="button" class="submit" value="前に戻る" onclick="history.back()">前に戻る</button>
        </form>
        <!-- 更新する・前に戻る -->
        

        <form action="update_complete_account.php" method="post">
        
            <input type="submit" class="submit" value="更新する"href="update_complete_account.php<? $result['id'] ?>" name="btnSend">
            <input type="hidden" value="<?php echo $_POST['id']; ?>" name="id">
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
<?php
session_start();
include 'vars.php'; 
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>情報登録フォーム</title>
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body>  
<header>
    <div class="header-left">
        <a href="index.php"><img src="img/logo.png" alt="PKstoreのロゴ" class="img"></a>
        <img src="img/character.png" alt="PKstoreのキャラクター" class="img pkc">   
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
 <main class="contact-page">
 <h3>情報登録フォーム</h3>
 <div class="contactbox">
    <form method="post"  action="regist_new_info_confirm.php" name="form" enctype="multipart/form-data">
    <div class="contact-form errorMsg">
        <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="info_title">タイトル</label>
            <input type="text" class="contactbox-text" size="35" name="info_title" required maxlength="10"
                    title="漢字・ひらがなでご入力ください"
                    value="<?= getPostValue('info_title') ?>">  
        </div>
        <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="info_text">内容</label>
            <input type="text" class="contactbox-text" size="35" name="info_text" maxlength="100" required 
                    value="<?= getPostValue('info_text') ?>">  
        </div>
<!-- NEW -->
       <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="new">NEW</label>
            <label><input type="radio" name="info_new" value="0" checked>ON</label>
            <label><input type="radio" name="info_new" value="1" <?php if (isset($_POST['info_new']) && $_POST['info_new'] == "1") echo 'checked'; ?>>OFF </label>   
        </div>
    <!-- 表示 -->
        <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="display">表示</label>
            <label><input type="radio" name="display" value="0" checked>ON</label>
            <label><input type="radio" name="display" value="1" <?php if (isset($_POST['display']) && $_POST['display'] == "1") echo 'checked'; ?>>OFF</label>   
        </div>
    <!-- 画像 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="info_img_path">関連画像</label>
                <input type="file" class="text"  name="info_img_path" id="info_img_path" size="35" required
                        value="<?= getPostValue('info_img_path') ?>"><br>        
            </div>
    <!-- 送信ボタン -->
            <div class="submit-confirm">
                    <input type="submit" class="submit" value="確認する" name="info_img_path">
            </div>
        </div>
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
<?php
// includeは最初の１行でOK
include 'vars.php'; 
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>

    
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
            <li><a href="index.php">グッズ販売</a></li>
            <li><a href="sns.php">SNS</li>
            <li><a href="index.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
        </ul>
    </div>
 </header>
 <main class="contact-page">
 <h3>お問い合わせフォーム</h3>
 <div class="contactbox">
    <form method="post"  action="2regist_goods_confirm.php" name="form" enctype="multipart/form-data">
    <div class="contact-form errorMsg">
        <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="slide_title">スライドタイトル</label>
            <input type="text" class="contactbox-text" size="35" name="slide_title" required maxlength="10"
                    title="漢字・ひらがなでご入力ください" 
                    value="<?= getPostValue('slide_title') ?>">  
        </div>


        <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="slide_keyword">スライドキーワード</label>
            <input type="text" class="contactbox-text" size="35" name="slide_keyword" maxlength="100" required 
                    value="<?= getPostValue('slide_keyword') ?>">  
            <span class="err-msg-mail"></span>
        </div>
<!-- NEW -->
       <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="new">NEW</label>
            <input type="radio" name="slide_new" value="0" checked>ON
            <input type="radio" name="slide_new" value="1" <?php if (isset($_POST['slide_new']) && $_POST['slide_new'] == "1") echo 'checked'; ?>>OFF
            
        </div>
    <!-- 表示 -->
        <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="display">表示</label>
            <input type="radio" name="display" value="0" checked>ON
            <input type="radio" name="display" value="1" <?php if (isset($_POST['display']) && $_POST['display'] == "1") echo 'checked'; ?>>OFF
            
        </div>
    <!-- 画像 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="item_img_path">商品画像</label>
                <input type="file" class="text"  name="slide_img_path" id="slide_img_path" size="35" 
                        value="<?= getPostValue('slide_img_path') ?>"><br> 
                
            </div>

    <!-- 送信ボタン -->

            <div class="submit-confirm">
                    <input type="submit" class="submit" value="確認する" name="slide_img_path">
            </div>
        </div>
    </form>
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
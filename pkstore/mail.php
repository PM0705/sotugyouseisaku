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
    <form method="post"  action="mail_confirm.php" name="form">
    <div class="contact-form errorMsg">
        <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="name">名前</label>
            <input type="text" class="contactbox-text" size="35" name="name" required maxlength="10"
                    title="漢字・ひらがなでご入力ください" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" 
                    value="<?= getPostValue('name') ?>">  
        </div>


        <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="メールアドレス">メールアドレス</label>
            <input type="text" class="contactbox-text" size="35" name="mail" maxlength="100" required 
                    value="<?= getPostValue('mail') ?>">  
            <span class="err-msg-mail"></span>
        </div>
        <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="電話番号">電話番号</label>
            <input type="tel" class="contactbox-text" size="35" maxlength="11" required name="tel" 
                    value="<?= getPostValue('tel') ?>">  
        </div>

        <div class="contactbox-text1">
            <label for="必須" class="red">必須</label>
            <label for="コメント">お問い合わせ内容</label>
            <br>
            <textarea name="comments" cols="30" required rows="8" maxlength="255" ><?= getPostValue('comments') ?></textarea>
        </div>
        <div class="contact-submit">         
                <input type="submit" class="submit" value="確認する">
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
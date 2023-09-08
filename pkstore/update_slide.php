<?php
include 'vars.php'; 
?>
<?php
    if (isset($_GET['id'])) {
        try {
 
            // 接続処理
            $dsn = 'mysql:host=localhost;dbname=pkstore77';
            $user = 'pkstore77';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
 
            // SELECT文を発行
            $sql = "SELECT * FROM slide WHERE id = :id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();
            $member = $stmt->fetch(PDO::FETCH_OBJ); // 1件のレコードを取得
            // 接続切断
            $dbh = null;
 
        } catch (PDOException $e) {
            print $e->getMessage() . "<br/>";
            
        }
 
    }
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スライド情報編集フォーム</title>
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
        <a href="login.php">ログイン・会員登録はこちら</a>
        <a href="cart.php">カートの中身（仮）</a>
        <ul>
            <li><a href="pk_onlineshop.php">グッズ販売</a></li>
            <li><a href="sns.php">SNS</li>
            <li><a href="news.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
        </ul>
        <?php endif; ?>
    </div>
</header>
 <main class="regist-page">
 <h3>スライド情報編集フォーム</h3>

 <div class="registbox">
    <form method="post" action="update_confirm_slide.php" name="form" enctype="multipart/form-data">
        <div class="contact-form errorMsg">
            <!-- ID -->
            <input type="hidden" name="id" value="<?php echo($member->id) ?>">
            
<!-- スライドタイトル -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="slide_title">スライドタイトル</label>
                <input type="text" class="text" name="slide_title" id="slide_title" maxlength="10" size="35"
                        value="<?php print($member->slide_title) ?>">
                <span class="err-msg-slide_title"></span>
            </div>
<!-- キーワード -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="slide_keyword">内容</label>
                <input type="text" class="text" name="slide_keyword" id="slide_keyword" maxlength="100" size="35"
                value="<?php print($member->slide_keyword) ?>"> 
                <span class="err-msg-slide_keyword"></span>
            </div>
<!-- NEW -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="slide_new">NEW</label>
                <label><input type="radio" name="slide_new" value="0"<?php print( $member->slide_new == "0" ? ' checked' : ''); ?>>ON</label>
                <label><input type="radio" name="slide_new" value="1"<?php print( $member->slide_new == "1" ? ' checked' : ''); ?>>OFF</label>  
            </div>
<!-- 表示 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="display">表示</label>
                <label><input type="radio" name="display" value="0"<?php print( $member->display == "0" ? ' checked' : ''); ?>>ON</label>
                <label><input type="radio" name="display" value="1"<?php print( $member->display == "1" ? ' checked' : ''); ?>>OFF</label>   
            </div>
<!-- 画像 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="slide_img_path">商品画像</label>
                <input type="file" class="text"  name="slide_img_path" id="slide_img_path" size="35" accept="image/*"
                value="<?php print($member->slide_img_path) ?>"><br> 
                
            </div>

<!-- 送信ボタン -->
                <div class="submit-confirm">
                    <input type="submit" class="submit" value="確認する" name="slide_img_path">
                </div>
        </div>
    </form>      
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
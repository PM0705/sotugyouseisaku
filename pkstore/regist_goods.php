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
    <title>商品登録</title>
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
 <h3>商品登録フォーム</h3>
 <div class="registbox">
    <form method="post" action="regist_goods_confirm.php" name="form" enctype="multipart/form-data">
        <div class="contact-form errorMsg">
            
<!-- アイテム名 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="item_name">アイテム名</label>
                <input type="text" class="text" name="item_name" id="item_name" maxlength="10" size="35"
                        pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" value="<?= getPostValue('item_name') ?>"
                        title="スペースのみ不可"><br> 
                <span class="err-msg-item_name"></span>
            </div>
<!-- 値段 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="item_price">値段</label>
                <input type="text" class="text" name="item_price" id="item_price" maxlength="100" size="35"
                         value="<?= getPostValue('item_price') ?>"
                        title="半角数字でご入力ください"><br> 
                <span class="err-msg-item_price"></span>
            </div>
<!-- 在庫 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="item_stock">在庫</label>
                <input type="text" class="text" name="item_stock" id="item_stock" maxlength="10" size="35"
                         value="<?= getPostValue('item_stock') ?>"
                        title="半角数字でご入力ください"><br> 
                <span class="err-msg-item_stock"></span>
            </div>
<!-- キーワード -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="keyword">キーワード</label>
                <input type="text" class="text" name="keyword" id="keyword" maxlength="10" size="35"
                         value="<?= getPostValue('keyword') ?>"
                        title="スペースのみ不可"><br> 
                <span class="err-msg-keyword"></span>
            </div>

<!-- カテゴリー -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="category">カテゴリー</label>
                <select name="category"id="category"  name="category">
                        <?php 
                        if (!empty($_POST["category"])) :?>
                        <?php 
                        $category=$_POST["category"] 
                        ?>
                            
                            <option value='<?= $_POST["category"] ?>'selected><?php echo $_POST["category"]?></option>
                            <?php
                
                                        $cate = array ('カバン','文房具','タオル','その他');
                                                foreach($cate as $cate){
                                                    
                                        
                                                        print('<option value="'.$cate.'">'.$cate.'</option>');
                                                
                                                    }    
                                    ?>
                        
                        <?php else :?>
                                    <?php
                
                                        $cate = array ('','カバン','文房具','タオル','その他');
                                                foreach($cate as $cate){
                                                    
                                        
                                                        print('<option value="'.$cate.'">'.$cate.'</option>');
                                                
                                                    }    
                                    ?>
                        <?php endif; ?>
                            </select><br>
                            <span class="err-msg-category"></span>
            </div>
<!-- NEW -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="new">NEW</label>
                <input type="radio" name="new" value="0" checked>ON
                <input type="radio" name="new" value="1" <?php if (isset($_POST['new']) && $_POST['new'] == "1") echo 'checked'; ?>>OFF
                
            </div>
<!-- 表示 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="display">NEW</label>
                <input type="radio" name="display" value="0" checked>ON
                <input type="radio" name="display" value="1" <?php if (isset($_POST['display']) && $_POST['display'] == "1") echo 'checked'; ?>>OFF
                
            </div>
<!-- 画像 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="item_img_path">商品画像</label>
                <input type="file" class="text"  name="item_img_path" id="item_img_path" size="35" accept="image/*"
                         value="<?= getPostValue('item_img_path') ?>"><br> 
                
            </div>

<!-- 送信ボタン -->
                <div class="submit-confirm">
                        <input type="submit" class="submit" value="確認する">
                </div>
        </div>
    </form>

        
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
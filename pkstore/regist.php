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
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/6-1-7.css">
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
                <?php $message = $_SESSION['mail']."さんようこそ";?>
                <div class="message-text"><?php echo htmlspecialchars($message, ENT_QUOTES); ?><a href="logout.php">(ログアウト)</a></div>
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
<h3>会員登録フォーム</h3>
<div class="registbox">
    <form method="post" action="regist_confirm.php" name="form"  >
        <div class="contact-form errorMsg">
            
<!-- お名前 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="family_name">名前（姓）<br>※漢字・ひらがなのみ可</label>
                <input type="text" class="text" name="family_name" id="family_name" maxlength="10" size="45"
                        pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" 
                        value="<?= getPostValue('family_name') ?>" title="漢字・ひらがなでご入力ください"><br>    
            </div>
            <div class="err-msg-family_name"></div>

            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="last_name">名前（名）※漢字・ひらがなのみ可</label>
                <input type="text" class="text" name="last_name" id="last_name" maxlength="10" size="45"
                        pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" 
                        value="<?= getPostValue('last_name') ?>" title="漢字・ひらがなでご入力ください"><br>    
            </div>
            <div class="err-msg-last_name"></div>

            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="family_name_kana">カナ（姓）※全角カタカナのみ可</label>
                <input type="text" class="text" name="family_name_kana" id="family_name_kana" maxlength="10" size="45"
                        pattern="^[\u30A0-\u30FF]+$" 
                        value="<?= getPostValue('family_name_kana') ?>" title="全角カタカナでご入力ください"><br>
            </div>
            <div class="err-msg-family_name_kana"></div>

            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="last_name_kana">カナ（名）<br>※全角カタカナのみ可</label>
                <input type="text" class="text" name="last_name_kana" id="last_name_kana" maxlength="10" size="45"
                        pattern="^[\u30A0-\u30FF]+$" 
                        value="<?= getPostValue('last_name_kana') ?>" title="全角カタカナでご入力ください"><br>
            </div>
            <div class="err-msg-last_name_kana"></div>
<!-- mail -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="mail">メールアドレス<br>※半角英数字、記号のみ可</label>
                <input type="text" class="text" name="mail" id="mail" maxlength="100" size="45"
                        pattern="^[a-zA-Z0-9\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-]+$" 
                        value="<?= getPostValue('mail') ?>" title="半角英数字、記号でご入力ください"><br>
            </div>
            <div class="err-msg-mail"></div>
<!-- パスワード -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="password">パスワード※半角英数字のみ入力可</label>
                <input type="text" class="text" name="password" id="password" maxlength="10" size="45"
                        pattern="^[a-zA-Z0-9]+$" 
                        value="<?= getPostValue('password') ?>" title="半角英数字でご入力ください"><br>
            </div>
            <div class="err-msg-password"></div>
<!-- 性別 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="gender">性別</label>
                <label><input type="radio" name="gender" value="0" checked>男</label>
                <label><input type="radio" name="gender" value="1" <?= getPostValue('gender') ?>>女</label>
            </div>
            <div class="err-msg-gender"></div>
<!-- 郵便番号 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="postal_code">郵便番号<br>※半角数字 7文字</label>
                <input type="text" class="text" name="postal_code" id="postal_code" maxlength="7" size="45"
                        pattern="^[\d]{7}" 
                        value="<?= getPostValue('postal_code') ?>" title="半角数字７文字でご入力ください"><br>
            </div>
            <div class="err-msg-postal_code"></div>
<!-- 住所（都道府県） -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="prefecture">住所（都道府県）</label>
                <label><select name="prefecture"id="prefecture"  >
                        <?php 
                        if (!empty($_POST["prefecture"])) :?>
                        <?php 
                        $prefect=$_POST["prefecture"] 
                        ?>
                            
                            <option value='<?= $_POST["prefecture"] ?>'selected><?php echo $_POST["prefecture"]?></option>
                            <?php
                
                                        $prefs = array ('北海道','青森県','岩手県','宮城県','秋田県','山形県',
                                                            '福島県','茨城県','栃木県','群馬県','埼玉県','千葉県',
                                                            '東京都','神奈川県','山梨県','新潟県','富山県','石川県',
                                                            '福井県','長野県','岐阜県','静岡県','愛知県','三重県',
                                                            '滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県',
                                                            '鳥取県','島根県','岡山県','広島県','山口県','徳島県',
                                                            '香川県','愛媛県','高知県','福岡県','佐賀県','長崎県',
                                                            '熊本県','大分県','宮崎県','鹿児島県','沖縄県');
                                                foreach($prefs as $pref){
                                                    
                                        
                                                        print('<option value="'.$pref.'">'.$pref.'</option>');
                                                
                                                    }    
                                    ?>
                        
                        <?php else :?>
                                    <?php
                
                                        $prefs = array ('','北海道','青森県','岩手県','宮城県','秋田県','山形県',
                                                            '福島県','茨城県','栃木県','群馬県','埼玉県','千葉県',
                                                            '東京都','神奈川県','山梨県','新潟県','富山県','石川県',
                                                            '福井県','長野県','岐阜県','静岡県','愛知県','三重県',
                                                            '滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県',
                                                            '鳥取県','島根県','岡山県','広島県','山口県','徳島県',
                                                            '香川県','愛媛県','高知県','福岡県','佐賀県','長崎県',
                                                            '熊本県','大分県','宮崎県','鹿児島県','沖縄県');
                                                foreach($prefs as $pref){
                                                    
                                        
                                                        print('<option value="'.$pref.'">'.$pref.'</option>');
                                                
                                                    }    
                                    ?>
                        <?php endif; ?>
                            </select></label><br>
            </div>
            <div class="err-msg-prefecture"></div>
<!-- 住所（市区町村） -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="address_1">住所（市区町村）<br>※全角で入力/スペースのみ不可</label>
                <input type="text" class="text"  name="address_1" id="address_1" maxlength="10" size="45"
                        pattern="[\d\u30A1-\u30F6\u4E00-\u9FFF\u3040-\u309Fー\s　\-]*" 
                        value="<?= getPostValue('address_1') ?>" title="全角で入力してください/スペースのみ不可"><br>
            </div>
            <div class="err-msg-address_1"></div>
<!-- 住所（番地） -->        
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="address_2">住所（市区町村）<br>※全角で入力/スペースのみ不可</label>
                <input type="text" class="text" name="address_2" id="address_2" maxlength="10" size="45"
                        pattern="[\d\u30A1-\u30F6\u4E00-\u9FFF\u3040-\u309Fー\s　\-]*" 
                        value="<?= getPostValue('address_2') ?>" title="全角で入力してください/スペースのみ不可"><br>
            </div>
            <div class="err-msg-address_2"></div>
<!-- アカウント権限非表示予定 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="authority">アカウント権限</label>
                <label><select name="authority" name="authority" id="authority" value=array()>
                    <option value="0"<?php if (isset($_POST['authority']) && $_POST['authority'] == "0") echo 'selected'; ?>>一般</option>
                    <option value="1"<?php if (isset($_POST['authority']) && $_POST['authority'] == "1") echo 'selected'; ?>>管理者</option>
                </select><label><br>
            </div>
            <div class="err-msg-authority"></div>
<!-- 送信ボタン -->
                <div class="submit-confirm">
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
<script type="text/javascript" src="app2.js"></script>
</body>
</html>
<?php
session_start();
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
            $sql = "SELECT * FROM item_info_transaction WHERE id = :id";
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
    <title>登録商品編集フォーム</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/6-1-7.css">
    <link rel="stylesheet" href="htmlstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
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
<h3>登録商品編集フォーム</h3>

 <div class="registbox">
    <form method="post" action="update_confirm_goods.php" name="form" enctype="multipart/form-data">
        <div class="contact-form errorMsg">
            <!-- ID -->
            <input type="hidden" name="id" value="<?php echo($member->id) ?>">
            
<!-- アイテム名 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="item_name">アイテム名</label>
                <input type="text" class="text" name="item_name" id="item_name"  size="35"
                         value="<?php print($member->item_name) ?>"
                        title="スペースのみ不可"><br> 
                <span class="err-msg-item_name"></span>
            </div>
<!-- 値段 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="item_price">値段</label>
                <input type="number" class="text" name="item_price" id="item_price" maxlength="100" size="35"
                value="<?php print($member->item_price) ?>" title="半角数字でご入力ください" ><br> 
                <span class="err-msg-item_price"></span>
            </div>
<!-- 在庫 -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="item_stock">在庫</label>
                <input type="number" class="text" name="item_stock" id="item_stock" maxlength="10" size="35"
                value="<?php print($member->item_stock) ?>"
                        title="半角数字でご入力ください" ><br> 
                <span class="err-msg-item_stock"></span>
            </div>
<!-- キーワード -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="keyword">キーワード</label>
                <input type="text" class="text" name="keyword" id="keyword" size="35"
                value="<?php print($member->keyword) ?>"
                        title="スペースのみ不可"><br> 
                <span class="err-msg-keyword"></span>
            </div>

<!-- カテゴリー -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="category">カテゴリー</label>
                <select name="category" id="category" name="category">                            
                            <option value="<?php print($member->category) ?>" selected><?php print($member->category) ?></option>
                            <?php
                
                                        $cate = array ('カバン','文房具','タオル','その他');
                                                foreach($cate as $cate){
                                                    
                                        
                                                        print('<option value="'.$cate.'">'.$cate.'</option>');
                                                
                                                    }    
                                    ?>
                            </select><br>
                            <span class="err-msg-category"></span>
            </div>
<!-- NEW -->
            <div class="contactbox-text1">
                <label for="必須" class="red">必須</label>
                <label for="new">NEW</label>
                <label><input type="radio" name="new" value="0"<?php print( $member->new == "0" ? ' checked' : ''); ?>>ON</label>
                <label><input type="radio" name="new" value="1"<?php print( $member->new == "1" ? ' checked' : ''); ?>>OFF</label>
                
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
                <label for="item_img_path">商品画像</label>
                <input type="file" class="text"  name="item_img_path" id="item_img_path" size="35" accept="image/*"
                value="<?php print($member->item_img_path) ?>"><br> 
                
            </div>

<!-- 送信ボタン -->
                <div class="submit-confirm">
                    <input type="submit" class="submit" value="確認する" name="item_img_path">
                </div>
        </div>
    </form>

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
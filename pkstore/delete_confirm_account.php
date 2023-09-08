<?php
include 'vars.php'; 
    if (isset($_GET['id'])) {
        try {
 
            // 接続処理
            $dsn = 'mysql:host=localhost;dbname=pkstore77';
            $user = 'pkstore77';
            $password = 'root';
            $dbh = new PDO($dsn, $user, $password);
 
            // SELECT文を発行
            $sql = "SELECT * FROM account_list WHERE id = :id";
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
    <title>会員削除フォーム</title>
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
<main>
<h3>会員削除フォーム</h3>
<p class="delete_text">本当に削除してよろしいですか?<br>よろしければ削除ボタンを押してください</p>
<div class="account_field">

        <div class="contact-form errorMsg">
<!-- ID -->
            <input type="hidden" name="id" value="<?php echo($member->id) ?>">
            <input type="hidden" name="delete_flag" value="<?php echo($member->delete_flag) ?>">
            
<!-- 名前 -->
            
            <span class="account_text">名前:</span><span class="account_text"><?php echo($member->family_name); echo " "; echo($member->last_name); ?></span><br>
            <span class="account_text">カナ:</span><span class="account_text"><?php echo($member->family_name_kana); echo " "; echo($member->last_name_kana); ?></span><br>
<!-- mail -->
            <span class="account_text">mail:</span><span class="account_text"><?php echo($member->mail); ?></span><br>
<!-- PW-->
            <span class="account_text">パスワード:</span><span class="account_text">安全の為表示されません</span><br>
<!-- 性別 -->
            <span class="account_text">性別:</span><span class="account_text">
            <?php error_reporting(0);
                if ($gender == 0) {
                    echo "男";
                    }else{
                            echo "女";
                    } ?></span><br>
<!-- 郵便住所 -->
            <span class="account_text">郵便番号:</span><span class="account_text"><?php echo($member->postal_code); ?></span><br>
            <span class="account_text">都道府県:</span><span class="account_text"><?php echo($member->prefecture); ?></span><br>
            <span class="account_text">市区町村:</span><span class="account_text"><?php echo($member->address_1); ?></span><br>
            <span class="account_text">番地:</span><span class="account_text"><?php echo($member->address_2); ?></span><br>
<!-- 権限 -->
            <span class="account_text">権限:</span><span class="account_text"><?php 
                error_reporting(0);
                if ($authority == 0) {
                    echo "一般";
                    }else{
                            echo "管理者";
                    }; ?></span><br>
<!-- 送信ボタン -->
            <div class="contact-submit">
            <form action="account_details.php" method="post">
                <button type="button" class="submit" value="前に戻る" onclick="history.back()">前に戻る</button>
            </form>
                <form action="delete_complete_account.php" method="post">
                    <input type="submit" class="submit" value="削除する"href="delete_complete_account.php<? $result['id'] ?>" name="btnSend">
                    <input type="hidden" value="<?php echo($member->id); ?>" name="id">
            
                </form>    
            </div>
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
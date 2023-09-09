<?php
session_start();
// エラーメッセージ、登録完了メッセージの初期化
$message = "";
$array=$_SESSION["cart"];

try {

    //フォームから受け取った値を変数に代入
    mb_internal_encoding("utf8");
    $pdo=new PDO("mysql:dbname=pkstore77;host=localhost;","pkstore77","root");

    foreach ($array as $key => $value) {
        /**
         * データベースへの追加（新規追加時だけ実行。コメント忘れずに）
         */
        $sql = $pdo->prepare('INSERT INTO transaction(item_name, item_price, buy_count, user_id)
                                 VALUES(:item_name, :item_price, :buy_count, :user_id)');
        $sql->execute(array(':item_name' => $value['item_name'], ':item_price' => $value['item_price'], ':buy_count' => $value['buy_count'], ':user_id' => $_SESSION["id"]));
        $message = 'ご購入ありがとうございます！';
        
      }
      $_SESSION = array();
      unset($_SESSION["cart"]);

      $array="";


    } catch (PDOException $e) {
        
        $message = 'エラーが発生したため商品を購入できません';


        }
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品購入フォーム</title>
    
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
    <h3>商品購入フォーム</h3>
    
    <div class="confirm">
        <div><?php echo htmlspecialchars($message, ENT_QUOTES); ?></div>

        <button onclick="location.href='index.php'" class="submit" value="HOMEへ戻る" >TOPページへ戻る</button>
        <button onclick="location.href='authority.php'" class="submit" value="管理者メニューへ戻る" >管理者メニューへ戻る</button>

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

<?php
// エラーメッセージ、登録完了メッセージの初期化
$message = "";
$image = $_POST['item_img_path'];
$dir1 = './images/';
$dir2 = './images_comp/';
// varディレクトリに移動する
rename($dir1 . $image, $dir2 . $image);
try {

    //フォームから受け取った値を変数に代入
    mb_internal_encoding("utf8");
    $pdo=new PDO("mysql:dbname=pkstore;host=localhost;","root","root");
    $pdo ->exec("INSERT INTO item_info_transaction (item_name,item_price,item_stock,keyword,
                            category,item_img_path,new,display) 
        VALUES ('".$_POST['item_name']."',
                '".$_POST['item_price']."',
                '".$_POST['item_stock']."',
                '".$_POST['keyword']."',
                '".$_POST['category']."',
                '".$_POST['item_img_path']."',
                '".$_POST['new']."',
                '".$_POST['display']."'
                
    );");
    $message = '登録が完了しました。ログインして引き続きPKstoreをお楽しみください';
    } catch (PDOException $e) {
        
        $message = 'エラーが発生したためアカウント登録できません。';

        }
?>



<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員登録フォーム</title>
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
    <h3>会員登録完了フォーム</h3>
    <div class="confirm">
        <div><?php echo htmlspecialchars($message, ENT_QUOTES); ?></div>
        <form action="index.php">
        <button onclick="location.href='index.php'" class="submit" value="HOMEへ戻る" >TOPページへ戻る</button>
        <button onclick="location.href='authority.php'" class="submit" value="管理者メニューへ戻る" >管理者メニューへ戻る</button>
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
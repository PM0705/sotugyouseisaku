<?php
// エラーメッセージ、登録完了メッセージの初期化
var_dump($_POST);
$message = "";
$image = $_POST['info_img_path'];
$dir1 = './images/';
$dir2 = './images_comp/';
// varディレクトリに移動する
rename($dir1 . $image, $dir2 . $image);
try {

    //フォームから受け取った値を変数に代入
    mb_internal_encoding("utf8");
    $pdo=new PDO("mysql:dbname=pkstore77;host=localhost;","pkstore77","root");
    $pdo ->exec("INSERT INTO information (info_title,info_text,info_img_path,info_new,
                            display) 
        VALUES ('".$_POST['info_title']."',
                '".$_POST['info_text']."',
                '".$_POST['info_img_path']."',
                '".$_POST['info_new']."',
                '".$_POST['display']."'
                
    );");
    $message = '登録が完了しました。';
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
    <title>情報登録完了フォーム</title>
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
        <li><a href="news.php">新着情報</li>
        <li><a href="store_info.php">店舗情報</a></li>
        <li><a href="mail.php">お問い合わせ</a></li>
    </ul>
</div>
</header>
<main class="regist-page">
    <h3>情報登録完了フォーム</h3>
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
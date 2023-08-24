<?php
var_dump($_POST);
var_dump($_FILES);

?>

<?php
$dsn = "mysql:host=localhost; dbname=pkstore; charset=utf8";
$username = "root";
$password = "root";

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

if (isset($_POST['item_img_path'])){
    // $_FILES['inputで指定したname']['tmp_name']：一時保存ファイル名
          $temp_file = $_FILES['item_img_path']['tmp_name'];
          $dir = './images/';

    if (file_exists($temp_file)) {//②送信した画像が存在するかチェック
        $image = uniqid(mt_rand(), false);//③ファイル名をユニーク化
        switch (@exif_imagetype($temp_file)) {//④画像ファイルかのチェック
            case IMAGETYPE_GIF:
                $image .= '.gif';
                break;
            case IMAGETYPE_JPEG:
                $image .= '.jpg';
                break;
            case IMAGETYPE_PNG:
                $image .= '.png';
                break;
            default:
                echo '拡張子を変更してください';
        }
//⑤DBではなくサーバーのimageディレクトリに画像を保存
        move_uploaded_file($temp_file, $dir . $image);
    }
//⑥DBにはファイル名保存VALUESは取得した値
    $sql = "INSERT INTO item_info_transaction(item_img_path) VALUES (:item_img_path)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':item_img_path', $image, PDO::PARAM_STR);
    $stmt->execute();
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
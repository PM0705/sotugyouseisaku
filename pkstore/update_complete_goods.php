<?php
var_dump($_POST);
// エラーメッセージ、登録完了メッセージの初期化
$id = $_POST['id'];
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
$sql='UPDATE item_info_transaction SET item_name = :item_name, item_price = :item_price,
                    item_stock = :item_stock, keyword = :keyword,
                    category = :category, item_img_path = :item_img_path,
                    new = :new, display = :display
                    WHERE id=:id';
$stmt = $pdo->prepare($sql);
//配列に格納
$params = array(':item_name' => $_REQUEST['item_name'], 
                ':item_price' => $_REQUEST['item_price'], 
                ':item_stock' => $_REQUEST['item_stock'], 
                ':keyword' => $_REQUEST['keyword'], 
                ':category' => $_REQUEST['category'], 
                ':item_img_path' => $_REQUEST['item_img_path'], 
                ':new' => $_REQUEST['new'], 
                ':display' => $_REQUEST['display'], 
                ':id' => $_REQUEST['id']);
$stmt->execute($params);

$message = '更新が完了しました。';
    } catch (PDOException $e) {
        
        $errmessage = 'エラーが発生したためアカウント更新できません。';
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
            }
// header("Location:http://localhost/account/list.php");  
?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品編集フォーム</title>
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
      <h3>商品編集フォーム</h3>
      <div class="confirm">
         <div><?php echo htmlspecialchars($message, ENT_QUOTES); ?></div>
         <button onclick="location.href='index.php'" class="submit" value="HOMEへ戻る" >HOMEへ戻る</button>
         <button onclick="location.href='authority.php'" class="submit" value="HOMEへ戻る" >管理者メニューへ戻る</button>
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
<?php
var_dump($_POST);
// エラーメッセージ、登録完了メッセージの初期化
$id = $_POST['id'];
$image = $_POST['slide_img_path'];
$dir1 = './images/';
$dir2 = './images_comp/';
$message = "";
var_dump($image);
// varディレクトリに移動する
if (rename($dir1 . $image, $dir2 . $image)) {
 
    // 移動が成功したら表示される
    echo '移動しました。';
   
  } else {
   
    // 移動に失敗したら表示される
    echo '移動できない！';
   
  }
try {

//フォームから受け取った値を変数に代入
mb_internal_encoding("utf8");
$pdo=new PDO("mysql:dbname=pkstore;host=localhost;","root","root");
$sql='UPDATE slide SET slide_title = :slide_title, slide_keyword = :slide_keyword,
                    slide_new = :slide_new, display = :display,
                    slide_img_path = :slide_img_path
                    WHERE id=:id';
$stmt = $pdo->prepare($sql);
//配列に格納
$params = array(':slide_title' => $_REQUEST['slide_title'], 
                ':slide_keyword' => $_REQUEST['slide_keyword'], 
                ':slide_new' => $_REQUEST['slide_new'], 
                ':display' => $_REQUEST['display'], 
                ':slide_img_path' => $_REQUEST['slide_img_path'], 
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
    <title>スライド情報編集完了</title>

    
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
      <h3>スライド情報編集完了</h3>
      <div class="confirm">
         <div><?php echo htmlspecialchars($message, ENT_QUOTES); ?></div>
         <button onclick="location.href='index.php'" class="submit" value="HOMEへ戻る" >HOMEへ戻る</button>
         <button onclick="location.href='authority.php'" class="submit" value="HOMEへ戻る" >管理者メニューへ戻る</button>
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
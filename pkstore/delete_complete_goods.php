<?php
session_start();
$id = $_POST['id'];
$message = "";
try {

//フォームから受け取った値を変数に代入
mb_internal_encoding("utf8");
$pdo=new PDO("mysql:dbname=pkstore77;host=localhost;","pkstore77","root");
$sql='UPDATE item_info_transaction SET delete_flag = :delete_flag  WHERE id=:id';
$stmt = $pdo->prepare($sql);
//  更新する値と該当のIDを配列に格納する
$params = array(':delete_flag' => '1' ,
                ':id' => $_POST['id']); 

// 更新する値と該当のIDが入った変数をexecuteにセットしてSQLを実行
$stmt->execute($params);

$message = '削除が完了しました。';
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
    <title>商品情報削除フォーム</title>

    
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
 <main class="regist-page">
      <h3>商品情報削除フォーム</h3>
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
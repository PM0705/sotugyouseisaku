<?php
session_start();
$id = $_POST['id'];
$message = "";
try {

//フォームから受け取った値を変数に代入
mb_internal_encoding("utf8");
$pdo=new PDO("mysql:dbname=pkstore77;host=localhost;","pkstore77","root");
$sql='UPDATE account_list SET family_name = :family_name, last_name = :last_name,
                    family_name_kana = :family_name_kana, last_name_kana = :last_name_kana,
                    mail = :mail,
                    gender = :gender, postal_code = :postal_code,
                    prefecture = :prefecture, postal_code = :postal_code,
                    gender = :gender, address_1 = :address_1,
                    address_2 = :address_2, authority = :authority
                    WHERE id=:id';
$stmt = $pdo->prepare($sql);
//配列に格納
$params = array(':family_name' => $_REQUEST['family_name'], 
                ':last_name' => $_REQUEST['last_name'], 
                ':family_name_kana' => $_REQUEST['family_name_kana'], 
                ':last_name_kana' => $_REQUEST['last_name_kana'], 
                ':mail' => $_REQUEST['mail'], 
                ':gender' => $_REQUEST['gender'], 
                ':postal_code' => $_REQUEST['postal_code'], 
                ':prefecture' => $_REQUEST['prefecture'], 
                ':address_1' => $_REQUEST['address_1'], 
                ':address_2' => $_REQUEST['address_2'],
                ':authority' => $_REQUEST['authority'],
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
    <title>会員情報編集完了</title>

    
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
      <h3>会員情報編集完了</h3>
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
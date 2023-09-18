<?php
session_start();
$id = $_POST['id'];
$message = "";
try {

//フォームから受け取った値を変数に代入
mb_internal_encoding("utf8");
$pdo=new PDO("mysql:dbname=pkstore77;host=localhost;","pkstore77","root");
$sql='UPDATE information SET delete_flag = :delete_flag  WHERE id=:id';
$stmt = $pdo->prepare($sql);
//  更新する値と該当のIDを配列に格納する
$params = array(':delete_flag' => '1' ,
                ':id' => $_POST['id']); 

// 更新する値と該当のIDが入った変数をexecuteにセットしてSQLを実行
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
      <h3>スライド情報編集完了</h3>
      <div class="confirm">
         <div><?php echo htmlspecialchars($message, ENT_QUOTES); ?></div>
         <button onclick="location.href='index.php'" class="submit" value="HOMEへ戻る" >HOMEへ戻る</button>
         <button onclick="location.href='authority.php'" class="submit" value="HOMEへ戻る" >管理者メニューへ戻る</button>
      </div>
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
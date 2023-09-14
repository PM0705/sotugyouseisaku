<?php
session_start();
$errorMessage = "";
//データベース接続情報
$dbuser = 'pkstore77';
$dbpass = 'root';
$dsn = 'mysql:host=localhost;dbname=pkstore77;';

//MySQL接続
try {
  $dbh = new PDO($dsn, $dbuser, $dbpass);
} catch (PDOException $e) {
  exit('データベース接続失敗: ' . $e->getMessage());
}

//DBからユーザ情報を取得
$sql = 'SELECT * FROM account_list WHERE mail = :mail';
$sth = $dbh->prepare($sql);

if (isset($_POST["login"])) {
    //ログインされている場合は表示用メッセージを編集
    $message = $_SESSION['mail']."さんようこそ";
    $message1 = $_SESSION['family_name']."さんようこそ";
    $authority = $_SESSION['authority']."さんようこそ";
    $coution = "権限がないので操作できません";
    
    // １．ユーザIDの入力チェック
    if (empty($_POST["mail"])) {
      $emptyerrorMessage = "メールアドレスが未入力です。";
    } else if (empty($_POST["password"])) {
      $errorMessage = "パスワードが未入力です。";
      
    } 
   
        //フォームから受け取った値を変数に代入
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $sth->bindValue(':mail', $mail);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
   
    //パスワードが正しいかチェック
    //パスワードが正しい場合
    if (password_verify($password, $result['password'])) {
    //情報をセッション変数に登録
    $_SESSION["family_name"] = $result['family_name']; //セッションにログイン情報を登録
    $_SESSION["authority"] = $result['authority']; //セッションにログイン情報を登録
    $_SESSION['mail'] = $result['mail'];
    $_SESSION['id'] = $result['id'];

    header("Location: index.php");
    
     return;   
    } else {
    //パスワードが間違っている場合
    $errorMessage = 'メールアドレスまたはパスワードが間違っています';
    }
}
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body>
   
<header>
    <div class="header-left">
        <a href="index.php"><img src="img/pkstore.png" alt="PKstoreのロゴ" class="h-img"></a>
        <img src="img/PKlogo.png" alt="PKstoreのキャラクター" class="pkc">   
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
                <?php $message1 = $_SESSION['mail']."さんようこそ";?>
                <div class="message-text"><?php echo htmlspecialchars($message1, ENT_QUOTES); ?><a href="logout.php">(ログアウト)</a></div>
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
<main class="login-page">
<h3>ログイン</h3>
<div class="loginform">  
        <form  id="loginForm" name="form" action="login.php" method="POST">
            <div><?php  echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
            <div class="loginform-div"><label for="mail">メールアドレス</label>
                <input type="text" name="mail" id="mail" maxlength="100"
                            title="半角英数字、半角ハイフンでご入力ください"><br>
                    
            </div>
            
            <!-- パスワード -->
            <div class="loginform-div">
                <label for="password">パスワード<br>※半角英数字のみ入力可</label>
                <input type="password" name="password" id="password" maxlength="10"
                            title="半角英数字でご入力ください"><br>
                    
                </div>

            <!-- ログインボタン -->

            <div class="contact-submit">
            <input type="submit" class="submit" value="ログインする" name="login">
            </div>
            </form> 
            <div class="new-ac">
            <a href="regist.php">会員登録はこちら!</a><br>
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
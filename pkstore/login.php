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
    $message = $_SESSION['mail'] . "さんようこそ";
    $message1 = $_SESSION['family_name'] . "さんようこそ";
    $authority = $_SESSION['authority'] . "さんようこそ";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="htmlstyle.css">

</head>

<body>
    <div class="wrapper">
        <div class="header0">
            <!-- ログインしていない -->
            <?php if (empty($_SESSION['id'])) : ?>

                <ul>
                    <li><a href="sns.php">SNS</li>
                    <li><a href="news.php">新着情報</li>
                    <li><a href="store_info.php">店舗情報</a></li>
                    <li><a href="mail.php">お問い合わせ</a></li>
                    <li><a href="login.php">ログイン・会員登録はこちら</a></li>
                </ul>
                <!-- 管理者 -->
            <?php elseif ($_SESSION['authority'] == 1) : ?>
                <?php $message1 = $_SESSION['mail'] . "さんようこそ"; ?>
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


            <?php else : ?>
                <?php $message1 = $_SESSION['mail'] . "さんようこそ"; ?>
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
        <header>
            <div class="header-left">
                <a href="index.php"><img src="img/pkstore.png" alt="PKstoreのロゴ" class="h-img"></a>
            </div>
            <form action="search.php" method="post">
                <div class="input-group header-right sa">
                    <input type="text" id="txt-search" name="seach" class="form-control input-group-prepend fas" placeholder="キーワードを入力"></input>
                    <span class="input-group-btn input-group-append">
                        <input type="submit" id="btn-search" class="btn btn-primary fas" value=&#xf002;></input>
                    </span>
                </div>
            </form>
        </header>
        <main class="login-page">
            <h3>ログイン</h3>
            <div class="loginform">
                <form id="loginForm" name="form" action="login.php" method="POST">
                    <div class="err-msg"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
                    <div class="loginform-b">
                        <label for="mail" class="form-label">メールアドレス</label>
                        <input type="text" name="mail" class="form-control" id="exampleFormControlInput1" maxlength="100" title="半角英数字、半角ハイフンでご入力ください"><br>

                    </div>

                    <!-- パスワード -->
                    <div class="loginform-b">
                        <label for="password" class="form-label">パスワード<br>※半角英数字のみ入力可</label>
                        <input type="password" name="password" class="form-control" id="exampleFormControlInput1" maxlength="10" title="半角英数字でご入力ください"><br>

                    </div>

                    <!-- ログインボタン -->

                    <div class="contact-submit">
                        <input type="submit" class="btn btn-primary" value="ログインする" name="login">
                    </div>
                </form>
                <div class="new-ac">
                    <button onclick="location.href='regist.php'" class="btn btn-warning" value="会員登録はこちらをクリック！">会員登録はこちらをクリック！</button>
                </div>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9e0ab757d4.js" crossorigin="anonymous"></script>

</body>

</html>
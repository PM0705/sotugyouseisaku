<?php
// エラーメッセージ、登録完了メッセージの初期化
$message = "";
$image = $_POST['info_img_path'];
$dir1 = './images/';
$dir2 = './images_comp/';
// varディレクトリに移動する
rename($dir1 . $image, $dir2 . $image);
try {

    //フォームから受け取った値を変数に代入
    mb_internal_encoding("utf8");
    $pdo = new PDO("mysql:dbname=pkstore77;host=localhost;", "pkstore77", "root");
    $pdo->exec("INSERT INTO information (info_title,info_text,info_img_path,info_new,
                            display) 
        VALUES ('" . $_POST['info_title'] . "',
                '" . $_POST['info_text'] . "',
                '" . $_POST['info_img_path'] . "',
                '" . $_POST['info_new'] . "',
                '" . $_POST['display'] . "'
                
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
    <title>情報登録フォーム</title>
    <link rel="icon" href="img/favicon.ico" id="favicon">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon-180x180.png">
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
        <main class="regist-page">
            <h3>情報登録完了フォーム</h3>
            <div class="confirm">
                <div><?php echo htmlspecialchars($message, ENT_QUOTES); ?></div>
                <button onclick="location.href='index.php'" class="btn btn-secondary" value="HOMEへ戻る">TOPページへ戻る</button>
                <button onclick="location.href='authority.php'" class="btn btn-secondary" value="管理者メニューへ戻る">管理者メニューへ戻る</button>
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
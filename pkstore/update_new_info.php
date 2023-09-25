<?php
session_start();
include 'vars.php';
?>
<?php
if (isset($_GET['id'])) {
    try {

        // 接続処理
        $dsn = 'mysql:host=localhost;dbname=pkstore77';
        $user = 'pkstore77';
        $password = 'root';
        $dbh = new PDO($dsn, $user, $password);

        // SELECT文を発行
        $sql = "SELECT * FROM information WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $member = $stmt->fetch(PDO::FETCH_OBJ); // 1件のレコードを取得
        // 接続切断
        $dbh = null;
    } catch (PDOException $e) {
        print $e->getMessage() . "<br/>";
    }
}
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録情報編集フォーム</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="htmlstyle.css">
</head>

<body>
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
        <div class="input-group header-right">
            <input type="text" id="txt-search" class="form-control input-group-prepend" placeholder="キーワードを入力(機能は未実装）"></input>
            <span class="input-group-btn input-group-append">
                <submit type="submit" id="btn-search" class="btn btn-primary"><i class="fas fa-search"></i></submit>
            </span>
        </div>
    </header>
    <main class="regist-page">
        <h3>登録情報編集フォーム</h3>
        <div class="registbox">
            <form method="post" action="update_confirm_new_info.php" name="form" enctype="multipart/form-data">
                <div class="contact-form errorMsg">

                    <!-- ID -->
                    <input type="hidden" name="id" value="<?php echo ($member->id) ?>">

                    <!-- タイトル -->
                    <div class="contactbox-text1">
                        <label for="必須" class="red">必須</label>
                        <label for="info_title" class="form-label">タイトル</label>
                        <input type="text" class="form-control" name="info_title" id="info_title" size="35" value="<?php print($member->info_title) ?>">
                        <span class="err-msg-info_title"></span>
                    </div>
                    <!-- 内容 -->
                    <div class="contactbox-text1">
                        <label for="必須" class="red">必須</label>
                        <label for="info_text" class="form-label">内容</label>
                        <input type="text" class="form-control" name="info_text" id="info_text" maxlength="100" size="35" value="<?php print($member->info_text) ?>">
                        <span class="err-msg-info_text"></span>
                    </div>
                    <!-- NEW -->
                    <div class="contactbox-text1 gender">
                        <label for="必須" class="red">必須</label>
                        <label for="info_new" class="form-label">NEW</label>
                        <span class="gender">
                            <label><input type="radio" name="info_new" value="0" <?php print($member->info_new == "0" ? ' checked' : ''); ?>>ON</label>
                            <label><input type="radio" name="info_new" value="1" <?php print($member->info_new == "1" ? ' checked' : ''); ?>>OFF</label>
                        </span>
                    </div>
                    <!-- 表示 -->
                    <div class="contactbox-text1 gender">
                        <label for="必須" class="red">必須</label>
                        <label for="display" class="form-label">表示</label>
                        <span class="gender">
                            <label><input type="radio" name="display" value="0" <?php print($member->display == "0" ? ' checked' : ''); ?>>ON</label>
                            <label><input type="radio" name="display" value="1" <?php print($member->display == "1" ? ' checked' : ''); ?>>OFF</label>
                        </span>
                    </div>
                    <!-- 画像 -->
                    <div class="contactbox-text1">
                        <label for="必須" class="red">必須</label>
                        <label for="info_img_path" class="form-label">商品画像</label>
                        <input type="file" class="form-control" name="info_img_path" id="info_img_path" size="35" accept="image/*" value="<?php print($member->info_img_path) ?>"><br>

                    </div>

                    <!-- 送信ボタン -->
                    <div class="submit-confirm">
                        <input type="submit" class="btn btn-primary" value="確認する" name="info_img_path">
                    </div>
                </div>
            </form>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9e0ab757d4.js" crossorigin="anonymous"></script>

</body>

</html>
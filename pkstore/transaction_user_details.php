<?php
session_start();
include 'vars.php';
?>
<?php
if (isset($_GET['user_id'])) {
    try {

        // 接続処理
        $dsn = 'mysql:host=localhost;dbname=pkstore77';
        $user = 'pkstore77';
        $password = 'root';
        $dbh = new PDO($dsn, $user, $password);

        // SELECT文を発行
        $sql = "SELECT * FROM account_list WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $_GET['user_id'], PDO::PARAM_INT);
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
    <title>会員管理フォーム</title>
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
        <h3>注文者情報</h3>

        <div class="account_field">

            <div class="contact-form errorMsg">
                <!-- ID -->
                <input type="hidden" name="id" value="<?php echo ($member->id) ?>">
                <input type="hidden" name="delete_flag" value="<?php echo ($member->delete_flag) ?>">

                <!-- 名前 -->
                <span class="account_text">ユーザーID:</span><span class="account_text"><?php echo ($member->id); ?></span><br>
                <span class="account_text">名前:</span><span class="account_text"><?php echo ($member->family_name);
                                                                                echo " ";
                                                                                echo ($member->last_name); ?></span><br>
                <span class="account_text">カナ:</span><span class="account_text"><?php echo ($member->family_name_kana);
                                                                                echo " ";
                                                                                echo ($member->last_name_kana); ?></span><br>
                <!-- mail -->
                <span class="account_text">mail:</span><span class="account_text"><?php echo ($member->mail); ?></span><br>
                <!-- PW-->
                <span class="account_text">パスワード:</span><span class="account_text">安全の為表示されません</span><br>
                <!-- 性別 -->
                <span class="account_text">性別:</span><span class="account_text">
                    <?php
                    if ($gender == 0) {
                        echo "男";
                    } else {
                        echo "女";
                    } ?></span><br>
                <!-- 郵便住所 -->
                <span class="account_text">郵便番号:</span><span class="account_text"><?php echo ($member->postal_code); ?></span><br>
                <span class="account_text">都道府県:</span><span class="account_text"><?php echo ($member->prefecture); ?></span><br>
                <span class="account_text">市区町村:</span><span class="account_text"><?php echo ($member->address_1); ?></span><br>
                <span class="account_text">番地:</span><span class="account_text"><?php echo ($member->address_2); ?></span><br>
                <!-- 権限 -->
                <span class="account_text">権限:</span><span class="account_text"><?php
                                                                                if ($authority == 0) {
                                                                                    echo "一般";
                                                                                } else {
                                                                                    echo "管理者";
                                                                                }; ?></span><br>
                <!-- 送信ボタン -->
                <div class="contact-submit">
                    <button onclick="location.href='transaction_box.php'" class="btn btn-secondary" value="受注BOXへ戻る">受注BOXへ戻る</button>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9e0ab757d4.js" crossorigin="anonymous"></script>

</body>

</html>
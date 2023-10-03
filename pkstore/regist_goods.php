<?php
session_start();
include 'vars.php';
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
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

            <h3>商品登録フォーム</h3>
            <div class="registbox">
                <form method="post" action="regist_goods_confirm.php" name="form" enctype="multipart/form-data">
                    <div class="contact-form errorMsg">
                        <!-- アイテム名 -->
                        <div class="contactbox-text1">
                            <label for="必須" class="red">必須</label>
                            <label for="item_name" class="form-label">アイテム名</label>
                            <input type="text" class="form-control" name="item_name" id="item_name" value="<?= getPostValue('item_name') ?>" title="スペースのみ不可" required><br>
                        </div>
                        <!-- 値段 -->
                        <div class="contactbox-text1">
                            <label for="必須" class="red">必須</label>
                            <label for="item_price" class="form-label">値段</label>
                            <input type="number" class="form-control" name="item_price" id="item_price" maxlength="10" value="<?= getPostValue('item_price') ?>" title="半角数字でご入力ください" required><br>
                        </div>
                        <!-- 在庫 -->
                        <div class="contactbox-text1">
                            <label for="必須" class="red">必須</label>
                            <label for="item_stock" class="form-label">在庫</label>
                            <input type="number" class="form-control" name="item_stock" id="item_stock" maxlength="10" value="<?= getPostValue('item_stock') ?>" title="半角数字でご入力ください" required><br>
                        </div>
                        <!-- キーワード -->
                        <div class="contactbox-text1">
                            <label for="必須" class="red">必須</label>
                            <label for="keyword" class="form-label">キーワード</label>
                            <input type="text" class="form-control" name="keyword" id="keyword" value="<?= getPostValue('keyword') ?>" title="スペースのみ不可" required><br>
                        </div>

                        <!-- カテゴリー -->
                        <div class="contactbox-text1">
                            <label for="必須" class="red">必須</label>
                            <label for="category" class="form-label">カテゴリー</label>
                            <select name="category" id="category" required class="form-select">
                                <?php
                                if (!empty($_POST["category"])) : ?>
                                    <?php
                                    $category = $_POST["category"]
                                    ?>
                                    <option value='<?= $_POST["category"] ?>' selected><?php echo $_POST["category"] ?></option>
                                    <?php
                                    $cate = array('カバン', '文房具', 'タオル', 'その他');
                                    foreach ($cate as $cate) {
                                        print('<option value="' . $cate . '">' . $cate . '</option>');
                                    }
                                    ?>
                                <?php else : ?>
                                    <?php
                                    $cate = array('', 'カバン', '文房具', 'タオル', 'その他');
                                    foreach ($cate as $cate) {
                                        print('<option value="' . $cate . '">' . $cate . '</option>');
                                    }
                                    ?>
                                <?php endif; ?>
                            </select><br>
                        </div>
                        <!-- NEW -->
                        <div class="contactbox-text1 gender">
                            <label for="必須" class="red">必須</label>
                            <label for="new" class="form-label">NEW</label>
                            <span class="gender">
                                <label><input type="radio" name="new" value="0" checked>ON</label>
                                <label><input type="radio" name="new" value="1" <?php if (isset($_POST['new']) && $_POST['new'] == "1") echo 'checked'; ?>>OFF</label>
                            </span>
                        </div>
                        <!-- 表示 -->
                        <div class="contactbox-text1 gender">
                            <label for="必須" class="red">必須</label>
                            <label for="display" class="form-label">表示</label>
                            <span class="gender">
                                <label><input type="radio" name="display" value="0" checked>ON</label>
                                <label><input type="radio" name="display" value="1" <?php if (isset($_POST['display']) && $_POST['display'] == "1") echo 'checked'; ?>>OFF</label>
                            </span>
                        </div>
                        <!-- 画像 -->
                        <div class="contactbox-text1">
                            <label for="必須" class="red">必須</label>
                            <label for="item_img_path" class="form-label">商品画像</label>
                            <input type="file" class="form-control" name="item_img_path" id="item_img_path" size="35" required value="<?= getPostValue('item_img_path') ?>"><br>
                        </div>

                        <!-- 送信ボタン -->
                        <!-- 送信ボタン -->
                        <div class="submit-confirm">
                            <input type="submit" class="btn btn-primary" value="確認する" name="item_img_path">
                        </div>
                    </div>
                </form>
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
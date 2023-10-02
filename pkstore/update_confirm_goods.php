<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録商品編集</title>
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
            <h3>登録商品編集フォーム</h3>
            <div class="confirm">
                <p>アイテム名:
                    <?php
                    echo $_POST['item_name'];
                    ?>
                </p>
                <p>値段:
                    <?php
                    echo $_POST['item_price'];
                    ?>
                </p>
                <p>在庫:
                    <?php
                    echo $_POST['item_stock'];
                    ?>
                </p>
                <p>キーワード:
                    <?php
                    echo $_POST['keyword'];
                    ?>
                </p>
                <p>カテゴリー:
                    <?php
                    echo $_POST['category'];
                    ?>
                </p>
                <p>NEW:
                    <?php

                    if ($_POST['new'] == 0) {
                        echo "ON";
                    } else {
                        echo "OFF";
                    }
                    ?>
                </p>
                <p>表示:
                    <?php

                    if ($_POST['display'] == 0) {
                        echo "ON";
                    } else {
                        echo "OFF";
                    }
                    ?>
                </p>
                <p>商品画像:
                    <?php
                    echo $_FILES['item_img_path']['name'];
                    if (isset($_POST['item_img_path'])) {
                        // $_FILES['inputで指定したname']['tmp_name']：一時保存ファイル名
                        $temp_file = $_FILES['item_img_path']['tmp_name'];
                        $dir = './images/';

                        if (file_exists($temp_file)) { //②送信した画像が存在するかチェック
                            $image = uniqid(mt_rand(), false); //③ファイル名をユニーク化
                            switch (@exif_imagetype($temp_file)) { //④画像ファイルかのチェック
                                case IMAGETYPE_GIF:
                                    $image .= '.gif';
                                    break;
                                case IMAGETYPE_JPEG:
                                    $image .= '.jpg';
                                    break;
                                case IMAGETYPE_PNG:
                                    $image .= '.png';
                                    break;
                                default:
                                    echo '拡張子を変更してください';
                            }
                            //⑤DBではなくサーバーのimageディレクトリに画像を保存
                            move_uploaded_file($temp_file, $dir . $image);
                        }
                    }
                    ?>
                </p>
                <div class="form submit1">
                    <form action="regist_goods.php" method="post">
                        <input type="submit" class="btn btn-secondary" value="前に戻る">
                        <input type="hidden" value="<?php echo $_POST['item_name']; ?>" name="item_name">
                        <input type="hidden" value="<?php echo $_POST['item_price']; ?>" name="item_price">
                        <input type="hidden" value="<?php echo $_POST['item_stock']; ?>" name="item_stock">
                        <input type="hidden" value="<?php echo $_POST['keyword']; ?>" name="keyword">
                        <input type="hidden" value="<?php echo $_POST['category']; ?>" name="category">
                        <input type="hidden" value="<?php echo $_POST['new']; ?>" name="new">
                        <input type="hidden" value="<?php echo $_POST['display']; ?>" name="display">
                    </form>
                    <form action="update_complete_goods.php" method="post">
                        <input type="submit" class="btn btn-primary" value="更新する" href="update_complete.php<? $result['id'] ?>" name="btnSend">
                        <input type="hidden" value="<?php echo $_POST['id']; ?>" name="id">
                        <input type="hidden" value="<?php echo $_POST['item_name']; ?>" name="item_name">
                        <input type="hidden" value="<?php echo $_POST['item_price']; ?>" name="item_price">
                        <input type="hidden" value="<?php echo $_POST['item_stock']; ?>" name="item_stock">
                        <input type="hidden" value="<?php echo $_POST['keyword']; ?>" name="keyword">
                        <input type="hidden" value="<?php echo $_POST['category']; ?>" name="category">
                        <input type="hidden" value="<?php echo $image; ?>" name="item_img_path">
                        <input type="hidden" value="<?php echo $_POST['new']; ?>" name="new">
                        <input type="hidden" value="<?php echo $_POST['display']; ?>" name="display">
                    </form>
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
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PK-onlineshop</title>
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
        <?php
        session_start();
        //データベースへ接続
        $dsn = "mysql:dbname=pkstore77;host=localhost;charset=utf8mb4";
        $username = "pkstore77";
        $password = "root";
        $options = [];
        $pdo = new PDO($dsn, $username, $password, $options);
        if ((isset($_POST["bag"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = 'カバン' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["towel"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = 'タオル' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["pen"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = '文房具' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["camera"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = 'カメラ' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["gift"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = 'プレゼント' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["umbrella"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = '雨具' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["music"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = '音楽' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["game"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = 'ゲーム' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["mug"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = '食器' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["shirt"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = '衣類' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["car"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = '車用品' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["clock"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = '時計' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["wallet"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = '財布' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["stamp"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = 'スタンプ' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["mobile"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = 'スマホアクセサリー' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["pc"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = 'pcアクセサリー' AND display = '0' ORDER BY id DESC");
        }
        if ((isset($_POST["pet"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where  delete_flag = '0' AND category = 'ペット用品' AND display = '0' ORDER BY id DESC");
        }

        ?>
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
            <main>
                <div>
                    <h3>検索結果</h3>

                    <?php
                    $count = $stmt->rowCount();
                    // var_dump($count);
                    if ($count == 0) {
                        $errmessage = "商品はありません。入荷までお待ちくださいませ！";
                    }
                    ?>
                    <p class="noseach"><?php echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p>

                    <div class="result-field">

                        <!-- ここでPHPのforeachを使って結果をループさせる -->
                        <?php foreach ($stmt as $row) : ?>
                            <li>
                                <div class="result-item">
                                    <!-- NEW０の時だけNEWアイコン表示 -->
                                    <?php if (($row['new']) == 0) { ?>
                                        <div class="relative">
                                            <img src="images_comp/<?php echo $row['item_img_path']; ?>" width="auto" height="100">
                                            <img src="img/newicon.png" alt="newicon" class="absolute absolute2 ">
                                        </div>
                                    <?php } else { ?>
                                        <img src="images_comp/<?php echo $row['item_img_path']; ?>" width="auto" height="100">
                                    <?php } ?>
                                    <p class="item-name" name='item_name'><?php echo $row['item_name'] ?></p>
                                    <p class="item_price" name='item_price'>¥<?php echo $row['item_price'] ?></p>


                                    <form method="post" action="cart.php" enctype="multipart/form-data">
                                        <!-- 売り切れの場合は、formを置換 -->
                                        <?php if ($row['item_stock'] > 0) { ?>
                                            <select name="buy_count" class="form-select form-select-sm">
                                                <?php for ($i = 0; $i < 10; $i++) : ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                            <input type="hidden" name="item_img_path" value="<?php echo $_SESSION['id'] ?>">
                                            <input type="hidden" name="item_img_path" value="<?php echo $row['item_img_path'] ?>">
                                            <input type="hidden" name="item_name" value="<?php echo $row['item_name'] ?>">
                                            <input type="hidden" name="item_price" value="<?php echo $row['item_price'] ?>">
                                            <input type="submit" name="item_id" value="カートへ" class="btn btn-danger btnsize1">
                                    </form>
                                <?php } else { ?>
                                    <input type="hidden" name="item_img_path" value="<?php echo $_SESSION['id'] ?>">
                                    <input type="hidden" name="item_img_path" value="<?php echo $row['item_img_path'] ?>">
                                    <input type="hidden" name="item_name" value="<?php echo $row['item_name'] ?>">
                                    <input type="hidden" name="item_price" value="<?php echo $row['item_price'] ?>">
                                    <p style="color: red;">売切</p>
                                <?php } ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
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
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品編集</title>
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
    <?php
    session_start();
    //データベースへ接続
    $dsn = "mysql:dbname=pkstore77;host=localhost;charset=utf8mb4";
    $username = "pkstore77";
    $password = "root";
    $options = [];
    $pdo = new PDO($dsn, $username, $password, $options);
    if ((isset($_POST["item_name"])) && (isset($_POST["keyword"])) && (isset($_POST["category"]))) {
        $stmt = $pdo->query("SELECT * FROM item_info_transaction where delete_flag = '0' ORDER BY id DESC");
        //SQL文を実行して、結果を$stmtに代入する。
    }
    if ($_POST["item_name"] != "" || $_POST["keyword"] != "" || $_POST["category"] != "") { //IDおよびユーザー名の入力有無を確認
        $stmt = $pdo->query("SELECT * FROM item_info_transaction WHERE item_name LIKE  '%" . $_POST["item_name"] . "%' 
                                                                    AND keyword LIKE  '%" . $_POST["keyword"] . "%' 
                                                                    AND category LIKE  '%" . $_POST["category"] . "%' 
                                                                    AND delete_flag = '0' 
                                                                    ORDER BY id DESC"); //SQL文を実行して、結果を$stmtに代入する。    

    }

    ?>

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
        <h3>登録商品検索</h3>
        <form action="goods_list.php" method="post">
            <table class="pk-f">
                <thead>
                    <tr>
                        <th>アイテム名</th>
                        <td>
                            <input type="text" name="item_name" id="item_name" maxlength="100" value="<?= $_POST['item_name'] ?>" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th>キーワード</th>
                        <td>
                            <input type="text" name="keyword" id="keyword" maxlength="100" class="form-control" value="<?= $_POST['keyword'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>カテゴリー</th>
                        <td>
                            <select name="category" id="category" name="category" class="form-select">
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
                        </td>
                    </tr>
                </thead>
            </table>
            <div class="contact-submit">
                <div>
                    <input type="submit" class="btn btn-primary" value="検索する">
                </div>
            </div>
        </form>
        <?php
        $count = $stmt->rowCount();
        // var_dump($count);
        if ($count == 0) {
            $errmessage = "検索結果はありません";
        }
        ?>
        <h3>商品リスト</h3>
        <div class="goods-list-f">
            <table>
                <tr>
                    <th class="title-tr">ID</th>
                    <th class="title-tr">画像</th>
                    <th class="title-tr">アイテム名</th>
                    <th class="title-tr">最終更新日</th>
                    <th class="title-tr">操作</th>
                </tr>
                <!-- ここでPHPのforeachを使って結果をループさせる -->
                <?php foreach ($stmt as $row) : ?>
                    <tr>
                        <td class="list-tr">
                            <?php echo $row['id'] ?>
                        </td>
                        <td class="list-tr">
                            <!-- NEW０の時だけNEWアイコン表示 -->
                            <?php if (($row['new']) == 0) { ?>
                                <div class="relative">
                                    <img src="images_comp/<?php echo $row['item_img_path']; ?>" width="auto" height="100">
                                    <img src="img/newicon.png" alt="newicon" class="absolute absolute2 ">
                                </div>

                            <?php } else { ?>
                                <img src="images_comp/<?php echo $row['item_img_path']; ?>" width="100" height="100">
                            <?php } ?>

                        </td>
                        <td class="list-tr">
                            <?php echo $row['item_name'] ?>
                        </td>
                        <td class="list-tr">
                            <?php
                            echo date('Y/m/d', strtotime($row['update_time']));
                            ?>
                        </td>
                        <td class="list-tr">
                            <!-- ★追加：削除★ -->
                            <button type="button" onclick="location.href='goods_details.php?id=<?php echo ($row['id']) ?>'" class="btn btn-outline-secondary">詳細</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="goods-err"><?php echo htmlspecialchars($errmessage, ENT_QUOTES); ?></div>
        <?php

        if ((isset($_POST["item_name"])) && (isset($_POST["keyword"])) && (isset($_POST["category"]))) {
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where delete_flag = '1' ORDER BY id DESC");
            //SQL文を実行して、結果を$stmtに代入する。
        }
        if ($_POST["item_name"] != "" || $_POST["keyword"] != "" || $_POST["category"] != "") { //IDおよびユーザー名の入力有無を確認
            $stmt = $pdo->query("SELECT * FROM item_info_transaction WHERE item_name LIKE  '%" . $_POST["item_name"] . "%' 
                                                            AND keyword LIKE  '%" . $_POST["keyword"] . "%' 
                                                            AND category LIKE  '%" . $_POST["category"] . "%' 
                                                            AND delete_flag = '1' 
                                                            ORDER BY id DESC"); //SQL文を実行して、結果を$stmtに代入する。    
        }
        ?>




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
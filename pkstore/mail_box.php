<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>受信BOX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="htmlstyle.css">

</head>

<body>
    <?php

    //データベースへ接続
    $dsn = "mysql:dbname=pkstore77;host=localhost;charset=utf8mb4";
    $username = "pkstore77";
    $password = "root";
    $options = [];
    $pdo = new PDO($dsn, $username, $password, $options);
    if ((isset($_POST["name"])) && (isset($_POST["mail"]))) {
        $stmt = $pdo->query("SELECT * FROM contactform ORDER BY id DESC");
        //SQL文を実行して、結果を$stmtに代入する。
    }

    if ($_POST["name"] != "" || $_POST["mail"] != "") { //IDおよびユーザー名の入力有無を確認
        $stmt = $pdo->query("SELECT * FROM contactform WHERE name LIKE  '%" . $_POST["name"] . "%' 
                                                                    AND mail LIKE  '%" . $_POST["mail"] . "%' 
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
        <div class="input-group header-right">
            <input type="text" id="txt-search" class="form-control input-group-prepend" placeholder="キーワードを入力(機能は未実装）"></input>
            <span class="input-group-btn input-group-append">
                <submit type="submit" id="btn-search" class="btn btn-primary"><i class="fas fa-search"></i></submit>
            </span>
        </div>
    </header>
    <main>
        <div class="kizi1">
            <h3>お問い合わせ検索</h3>
            <form action="mail_box.php" method="post">
                <table class="mail-search pk-f">
                    <thead>
                        <tr>

                            <th class="form-label">名前</th>
                            <td>
                                <input type="text" name="name" id="name" maxlength="100" value="<?= $_POST['name'] ?>" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th class="form-label">メールアドレス</th>
                            <td>
                                <input type="text" name="mail" id="mail" maxlength="100" value="<?= $_POST['mail'] ?>" class="form-control">
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
            <h3>受信BOX</h3>

            <!-- ここでPHPのforeachを使って結果をループさせる -->
            <?php foreach ($stmt as $row) : ?>

                <div class="mail-main">
                    <div class="id-name">
                        <p class="id">[<?php echo $row['id'] ?>]</p>
                        <p>なまえ:<br><?php echo $row['name'] ?></p>
                        <p>mail:<br><?php echo $row['mail'] ?></p>
                        <p>連絡先:<br><?php echo $row['tel'] ?></p>
                        <p>受信日:<br>
                            <?php
                            echo date('Y/m/d', strtotime($row['registered_time']));
                            ?>
                        </p>
                    </div>
                    <p class="comments">
                        <?php echo $row['comments'] ?>
                    </p>

                </div>

            <?php endforeach; ?>



            </table>
            <p class="nodate"><?php error_reporting(0);
                                echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p>


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
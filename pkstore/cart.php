<?php
session_start();
include 'vars.php';
$message = "";

?>

<?php
// カートが空の時
if (isset($_SESSION["cart"])) {
    $array = $_SESSION["cart"];
    // 商品の追加
    // 商品の数量がPOSTされた時
    if (isset($_POST["item_name"]) && isset($_POST["buy_count"])) {
        $array_item_name = array_column($array, "item_name");
        // すでにカートに入ってるのと同じ商品がカゴに入った時
        if (in_array($_POST["item_name"], $array_item_name)) {
            $index = array_search($_POST["item_name"], $array_item_name);
            // indexの中のbuy_countのみ増やす
            $array[$index]["buy_count"] += $_POST["buy_count"];
            // 異なる商品がカートに入った時
        } else {
            $array[] = [
                'item_name' => $_POST['item_name'],
                'buy_count' => $_POST['buy_count'],
                'item_price' => $_POST['item_price'],
                'item_img_path' => $_POST['item_img_path']
            ];
        }
    }
    // 商品の削除
    // 商品名だけがPOSTされたとき
    if (isset($_POST["item_name"]) && !isset($_POST["buy_count"])) {
        $array_item_name = array_column($array, "item_name");
        // 商品を削除する
        // 削除フォームにitem_nameだけをPOSTしているのでitem_nameだけPOSTされた時になる
        if (in_array($_POST["item_name"], $array_item_name)) {
            $index = array_search($_POST["item_name"], $array_item_name);
            unset($array[$index]);
            $array = array_values($array);
        }
    }
    // カートに初めて商品を入れる時
} else {
    $array[] = [
        'item_name' => $_POST['item_name'],
        'buy_count' => $_POST['buy_count'],
        'item_price' => $_POST['item_price'],
        'item_img_path' => $_POST['item_img_path']
    ];
}
// 配列をセッションに格納
$_SESSION["cart"] = $array;
?>
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
            <h3>カートの中身</h3>
            <!-- カートが空の時 -->


            <table class="cart_f">
                <?php
                if (!empty($_SESSION["cart"])) { ?>
                    <tr>
                        <th>商品名</th>
                        <th>単価</th>
                        <th>数量</th>
                        <th>小計</th>
                        <th>操作</th>
                    </tr>
                    <?php
                    $total = 0;
                    foreach ($array as $key => $value) : ?>

                        <tr>
                            <td><img src="images_comp/<?php echo $value['item_img_path']; ?>" width="auto" height="100"></td>
                            <td><?php echo $value['item_name']; ?></td>
                            <td><?php echo $value['buy_count']; ?></td>
                            <td><?php echo $value['item_price'] * $value['buy_count']; ?> 円</td>
                            <td>
                                <form method="post" action="cart.php">
                                    <input type="submit" value="削除" class="btn btn-outline-secondary">
                                    <input type="hidden" name="item_name" value="<?php echo $value['item_name']; ?>">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } else {
                    echo '<div style="text-align: center;;">買い物カゴは空です。お買い物をお楽しみください！</div>';
                }
                ?>

            </table>
            <div class="total_price_text">
                <?php
                if (!empty($_SESSION["cart"])) {
                    $total += $value['item_price'] * $value['buy_count'];
                    echo "合計金額:" . number_format($total) . "円";
                }
                ?>
                <?php
                if (!empty($_SESSION["cart"])) { ?>
                    <form method="post" action="cart_complete.php">
                        <input type="submit" value="購入する" class="btn btn-danger">
                    </form>
                    <button onclick="location.href='pk_onlineshop.php'" value="お買い物に戻る" class="btn btn-secondary back">お買い物に戻る</button>
                <?php } else { ?>
                    <button onclick="location.href='pk_onlineshop.php'" value="お買い物に戻る" class="btn btn-danger">お買い物に戻る</button>
                    <button onclick="location.href='index.php'" value="HOMEに戻る" class="btn btn-secondary">HOMEに戻る</button>
                <?php } ?>


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
<?php
    session_start();
    var_dump($_SESSION);
    
    // カートが空の時
    if (isset($_SESSION["cart"])) {
        $array=$_SESSION["cart"];
        // 商品の追加
        // 商品の数量がPOSTされた時
        if (isset($_POST["item_name"])&& isset($_POST["buy_count"])){
            $array_item_name = array_column($array,"item_name");
            // すでにカートに入ってるのと同じ商品がカゴに入った時
            if (in_array($_POST["item_name"],$array_item_name)){
                $index = array_search($_POST["item_name"],$array_item_name);
                // indexの中のbuy_countのみ増やす
                $array[$index]["buy_count"] += $_POST["buy_count"];
            // 異なる商品がカートに入った時
            }else {
                $array[] = [
                    'item_name' => $_POST['item_name'],
                    'buy_count' => $_POST['buy_count'],
                    'item_price' => $_POST['item_price'],
                    'item_img_path' => $_POST['item_img_path'],
                    'user_id' => $_SESSION['id']
                ];
            }
        }
        // 商品の削除
        // 商品名だけがPOSTされたとき
        if (isset($_POST["item_name"])&& !isset($_POST["buy_count"])){
            $array_item_name = array_column($array,"item_name");
            // 商品を削除する
            // 削除フォームにitem_nameだけをPOSTしているのでitem_nameだけPOSTされた時になる
            if (in_array($_POST["item_name"],$array_item_name)){
                $index = array_search($_POST["item_name"],$array_item_name);
                unset($array[$index]);
                $array = array_values($array);
            }
        }
    // カートに初めて商品を入れる時
    }else {
        $array[] = [
            'item_name' => $_POST['item_name'],
            'buy_count' => $_POST['buy_count'],
            'item_price' => $_POST['item_price'],
            'item_img_path' => $_POST['item_img_path'],
            'user_id' => $_SESSION['id']
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
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body>

<header>
<div class="header-left">
    <a href="index.php"><img src="img/logo.png" alt="PKstoreのロゴ" class="img"></a>
    <img src="img/character.png" alt="PKstoreのキャラクター" class="img">
    <a href="buyItem.php">カートの中身（仮）</a>
    <a href="authority.php">管理者用メニュー（仮）</a>
</div>

<div class="header-right">
    <a href="login.php">ログイン・会員登録はこちら</a>
    <ul>
        <!-- ログインしていない -->
        <li><a href="pk_onlineshop.php">グッズ販売</a></li>
        <li><a href="sns.php">SNS</li>
        <li><a href="news.php">新着情報</li>
        <li><a href="store_info.php">店舗情報</a></li>
        <li><a href="mail.php">お問い合わせ</a></li>
    </ul>
</div>
</header>
<main>
<h3>カートの中身</h3>
<!-- カート一覧 -->

<table class="cart_f">
  <tr><th>商品名</th><th>単価</th><th>数量</th><th>小計</th><th>操作</th></tr>
  <?php 
  $total =0;
  foreach ($array as $key => $value): ?>

    <tr>
        <td><img src="images/<?php echo $value['item_img_path']; ?>" width="100" height="100"></td>
        <td><?php echo $value['item_name']; ?></td>
        <td><?php echo $value['buy_count']; ?></td>
        <td><?php echo $value['item_price'] * $value['buy_count']; ?> 円</td>
        <td>
            <form method="post" action="cart.php">
                <input type="submit" value="削除">
                <input type="hidden" name="item_name" value="<?php echo $value['item_name']; ?>">
            </form>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
<div class="total_price_text">
    <?php
    $total += $value['item_price'] * $value['buy_count'];
    echo "合計金額:".number_format($total)."円";
    ?>
    <form method="post" action="cart_complete.php">
      <input type="submit" value="購入する">
    </form>
    <button onclick="location.href='pk_onlineshop.php'"  value="HOMEへ戻る" >お買い物に戻る</button>
</div>




</main>
<footer>

<div class="footer-l">
    <img src="img/logo.png" alt="PKstoreのロゴ" class="img">
    <ul>
        <li><a href="company.php" class="fotter-text">Company</a></li>
        <li><a href="mail.php" class="fotter-text">Contact</a></li>
        <li><a href="store_info.php" class="fotter-text">Map</a></li>
    </ul>
</div>
<div class="footer-r">
    
    <ul>
        <li><a href="index.php"><img src="img/twittericon.png" alt="Xのロゴ" class="img1"></a></li>
        <li><a href="index.php"><img src="img/instaicon.png" alt="Instagramのロゴ" class="img1"></a></li>
        <li><a href="index.php"><img src="img/youtubeicon.png" alt="Youtubeのロゴ" class="img1 youtubeicon"></a></li>

    </ul>
</div>

</footer>

    

</body>
</html>
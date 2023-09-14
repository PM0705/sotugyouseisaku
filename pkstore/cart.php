<?php
session_start();
include 'vars.php'; 
    $message="";

?>
    
<?php
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
                    'item_img_path' => $_POST['item_img_path']
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
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body>
<header>
    <div class="header-left">
        <a href="index.php"><img src="img/pkstore.png" alt="PKstoreのロゴ" class="h-img"></a>
        <img src="img/PKlogo.png" alt="PKstoreのキャラクター" class="pkc">   
    </div>
    <!-- 特別管理者 -->
    <?php 
    if(!empty($_SESSION['authority'])){
    $authority = $_SESSION['authority'];
    if ($_SESSION['authority'] == 1){?>
    <div class="authority_menu">
        <a href="authority.php" class="authority-1">管理者用メニュー（仮）</a>
    </div>
    <?php }
    }?>
    <div class="header-right">
        <!-- ログインしていない -->
        <?php if (empty($_SESSION["id"])) :?>
            <a href="login.php">ログイン・会員登録はこちら</a>
            <ul>
                <li><a href="sns.php">SNS</li>
                <li><a href="news.php">新着情報</li>
                <li><a href="store_info.php">店舗情報</a></li>
                <li><a href="mail.php">お問い合わせ</a></li>
            </ul>
        <!-- 一般 -->
        <?php else:?>
                <?php $message1 = $_SESSION['mail']."さんようこそ";?>
                <div class="message-text"><?php echo htmlspecialchars($message1, ENT_QUOTES); ?><a href="logout.php">(ログアウト)</a></div>
            <ul>
                <li><a href="pk_onlineshop.php">shop</a></li>
                <li><a href="sns.php">SNS</li>
                <li><a href="news.php">新着情報</li>
                <li><a href="store_info.php">店舗情報</a></li>
                <li><a href="mail.php">お問い合わせ</a></li>
                <li><a href="cart.php"><img src="img/cart.png" alt="買い物カゴ" class="cart-img"></a></li>
            </ul>
            
        <?php endif; ?>
    </div>
</header>
<main>
<h3>カートの中身</h3>
<!-- カートが空の時 -->


<table class="cart_f">
<?php 
  if (!empty($_SESSION["cart"])) {?>
  <tr><th>商品名</th><th>単価</th><th>数量</th><th>小計</th><th>操作</th></tr>
  <?php
  $total =0;
  foreach ($array as $key => $value): ?>

    <tr>
        <td><img src="images_comp/<?php echo $value['item_img_path']; ?>" width="100" height="100"></td>
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
    <?php } else{
        echo '<div style="text-align: center;;">買い物カゴは空です。</div>';
        
    }
    ?>

</table>
<div class="total_price_text">
    <?php
    if (!empty($_SESSION["cart"])) {
        $total += $value['item_price'] * $value['buy_count'];
        echo "合計金額:".number_format($total)."円";

    }
    ?>
    <?php 
    if (!empty($_SESSION["cart"])) {?>
    <form method="post" action="cart_complete.php">
      <input type="submit" value="購入する">
    </form>
    <button onclick="location.href='pk_onlineshop.php'"  value="お買い物に戻る" >お買い物に戻る</button>
    <?php }else{?>
        <button onclick="location.href='pk_onlineshop.php'"  value="お買い物に戻る" >お買い物に戻る</button>
        <button onclick="location.href='index.php'"  value="HOMEに戻る" >HOMEに戻る</button>
    <?php } ?>


</div>

</main>
<footer>
    <div class="footer-l">
        <img src="img/logo.png" alt="PKstoreのロゴ" class="logo">
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
</body>
</html>
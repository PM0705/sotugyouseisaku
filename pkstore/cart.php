<?php

　//POSTデータをカート用のセッションに保存
if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=$_POST['id'];
    $buy_count=$_POST['buy_count'];
    $_SESSION['cart'][$id]=$buy_count; //セッションにデータを格納
}
$cart=array();
if(isset($_SESSION['cart'])){
$cart=$_SESSION['cart'];
}
var_dump($cart);

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
<?php
   
//データベースへ接続
    $dsn = "mysql:dbname=pkstore;host=localhost;charset=utf8mb4";
    $username = "root";
    $password = "root";
    $options = [];
    $pdo = new PDO($dsn, $username, $password, $options);
        if ((isset($_POST["item_name"])) && (isset($_POST["keyword"]))&& (isset($_POST["category"]))){
            $stmt = $pdo->query("SELECT * FROM item_info_transaction where delete_flag = '0' ORDER BY id DESC");
            //SQL文を実行して、結果を$stmtに代入する。
        }
        error_reporting(0);
        if($_POST["item_name"] != "" || $_POST["keyword"] != "" || $_POST["category"] != ""){ //IDおよびユーザー名の入力有無を確認
            $stmt = $pdo->query("SELECT * FROM item_info_transaction WHERE item_name LIKE  '%".$_POST["item_name"]."%' 
                                                                    AND keyword LIKE  '%".$_POST["keyword"]."%' 
                                                                    AND category LIKE  '%".$_POST["category"]."%' 
                                                                    AND delete_flag = '0' 
                                                                    ORDER BY id DESC"); //SQL文を実行して、結果を$stmtに代入する。    

        }

        ?>

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
<table>
  <tr><th>商品名</th><th>単価</th><th>数量</th><th>小計</th></tr>
  <?php foreach($rows as $r) { ?>
    <tr>
      <td><?php echo $r['item_name'] ?></td>
      <td><?php echo $r['buy_price'] ?></td>
      <td><?php echo $r['buy_count'] ?></td>
      <td><?php echo $r['buy_price'] * $r['buy_count'] ?> 円</td>
    </tr>
  <?php } ?>
  <tr><td colspan='2'> </td><td><strong>合計</strong></td><td><?php echo $sum ?> 円</td></tr>
</table>
<div class="base">
  <a href="index.php">お買い物に戻る</a>
  <a href="cart_empty.php">カートを空にする</a>
  <a href="buy.php">購入する</a>
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
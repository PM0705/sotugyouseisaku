<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>受注管理画面</title>
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
    $stmt = $pdo->query("SELECT * FROM transaction ");
    $stmt1 = $pdo->query("SELECT * FROM account_list ");

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
 <div class="kizi1">       
    <h3>受注BOX</h3>
    <div class="mail-main">
        <div class="transaction_box">
            <table>
                    <tr>
                        <th>ID</th>
                        <th>ユーザーID</th>
                        <th>商品名</th>
                        <th>個数</th>
                        <th >注文日</th>   
                    </tr>
                    <!-- ここでPHPのforeachを使って結果をループさせる -->
                    <?php foreach ($stmt as $row){ ?>
                        
                    
                    <tr>

                        <td>
                        <?php echo $row['id']?>
                        </td>
                        <td>
                            <?php echo $row['user_id']?>
                        </td>
                        <td>
                            <?php echo $row['buy_count']?>
                        </td>
                        <td>
                            <?php echo $row['item_name']?>
                        </td>
                        <td>
                            <?php 
                                echo date('Y/m/d', strtotime($row['insert_date']));
                            ?>
                        </td>
                        <td>
                            
                            <!-- ★追加：削除★ -->
                            <button type="button"  onclick="location.href='transaction_user_details.php?user_id=<?php echo($row['user_id']) ?>'">表示</button>
                            

                        </td>
                    </tr>

                    <?php } ?>
            </table>
        </div>   
    </div>
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
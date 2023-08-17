<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PKstoreWELCOM</title>
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
        if ((isset($_POST["name"])) && (isset($_POST["mail"]))){
            $stmt = $pdo->query("SELECT * FROM contactform ORDER BY id DESC");
            //SQL文を実行して、結果を$stmtに代入する。
        }
        error_reporting(0);
        if($_POST["name"] != "" || $_POST["mail"] != "" ){ //IDおよびユーザー名の入力有無を確認
            $stmt = $pdo->query("SELECT * FROM contactform WHERE name LIKE  '%".$_POST["name"]."%' 
                                                                    AND mail LIKE  '%".$_POST["mail"]."%' 
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
 <div class="kizi1">
        <h3>お問い合わせ検索</h3>
        <form action="mail_box.php" method="post">
            <table class="mail-search">
                <thead>
                    <tr>
                
                        <th>名前</th>
                        <td>
                            <input type="text" name="name" id="name" maxlength="100" size="35"
                            value="<?= $_POST['name'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>
                            <input type="text" name="mail" id="mail" maxlength="100" size="35"
                            value="<?= $_POST['mail'] ?>">
                        </td>
                    </tr>
                </thead>
            </table>
            <div class="contact-submit">
                <div>
                    <input type="submit" class="submit" value="検索する">
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
        <?php foreach ($stmt as $row): ?>

        <div class="mail-main">
            <div class="id-name">
                <p class="id">[<?php echo $row['id']?>]</p>
                <p>なまえ:<br><?php echo $row['name']?></p>
                <p>mail:<br><?php echo $row['mail']?></p>
                <p>連絡先:<br><?php echo $row['tel']?></p>
                <p>受信日:<br>
                    <?php
                        error_reporting(0);
                        echo date('Y/m/d', strtotime($row['registered_time']));
                    ?>
                </p>
            </div>
           
            
                <p class="comments">
                    <?php echo $row['comments']?>
                </p>
            
        </div>
            
            <?php endforeach; ?>

        
        
        </table>
        <p class="nodate"><?php  error_reporting(0); echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p>
    

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
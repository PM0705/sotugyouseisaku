<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スライド情報管理</title>
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
    $stmt = $pdo->query("SELECT * FROM slide ");
            //SQL文を実行して、結果を$stmtに代入する。
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

        
        <?php
        $count = $stmt->rowCount();
        // var_dump($count);
    if ($count == 0) {
        $errmessage = "検索結果はありません";
        } 
        ?>
        <h3>スライド情報編集</h3>
            <div class="slide">
                    <table>
                        <tr>
                            <th>画像</th>
                            <th>スライドタイトル</th>
                            <th>最終更新日</th>
                            <th >操作</th>
                                
                        </tr>
                        <!-- ここでPHPのforeachを使って結果をループさせる -->
                        <?php foreach ($stmt as $row): ?>
                        <tr>

                            <td>
                                <img src="images_comp/<?php echo $row['slide_img_path']; ?>" >
                            </td>
                            <td>
                                <?php echo $row['slide_title']?>
                            </td>
                            <td>
                                <?php 
                                    echo date('Y/m/d', strtotime($row['update_time']));
                                ?>
                            </td>
                            <td>
                                <!-- ★追加：削除★ -->
                                <button type="button"  onclick="location.href='update_slide.php?id=<?php echo($row['id']) ?>'">編集</button>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
            </div>

        <div class="slide-submit">
            <button onclick="location.href='index.php'" class="submit" value="HOMEへ戻る" >TOPページへ戻る</button>
            <button onclick="location.href='authority.php'" class="submit" value="管理者メニューへ戻る" >管理者メニューへ戻る</button>
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
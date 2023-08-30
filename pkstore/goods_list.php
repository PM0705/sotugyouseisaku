
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
            $stmt = $pdo->query("SELECT * FROM item_info_transaction ORDER BY id DESC");
            //SQL文を実行して、結果を$stmtに代入する。
        }
        error_reporting(0);
        if($_POST["item_name"] != "" || $_POST["keyword"] != "" || $_POST["category"] != ""){ //IDおよびユーザー名の入力有無を確認
            $stmt = $pdo->query("SELECT * FROM item_info_transaction WHERE item_name LIKE  '%".$_POST["item_name"]."%' 
                                                                    AND keyword LIKE  '%".$_POST["keyword"]."%' 
                                                                    AND category LIKE  '%".$_POST["category"]."%' 
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

        <h3>登録商品検索</h3>
        <form action="goods_list.php" method="post">
            <table class="mail-search">
                <thead>
                    <tr>
                
                        <th>アイテム名</th>
                        <td>
                            <input type="text" name="item_name" id="item_name" maxlength="100" size="35"
                            value="<?= $_POST['item_name'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>キーワード</th>
                        <td>
                            <input type="text" name="keyword" id="keyword" maxlength="100" size="35"
                            value="<?= $_POST['keyword'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>カテゴリー</th>
                        <td>
                        <select name="category"id="category"  name="category">
                        <?php 
                        if (!empty($_POST["category"])) :?>
                        <?php 
                        $category=$_POST["category"] 
                        ?>
                            
                            <option value='<?= $_POST["category"] ?>'selected><?php echo $_POST["category"]?></option>
                            <?php
                
                                        $cate = array ('カバン','文房具','タオル','その他');
                                                foreach($cate as $cate){
                                                    
                                        
                                                        print('<option value="'.$cate.'">'.$cate.'</option>');
                                                
                                                    }    
                                    ?>
                        
                        <?php else :?>
                                    <?php
                
                                        $cate = array ('','カバン','文房具','タオル','その他');
                                                foreach($cate as $cate){
                                                    
                                        
                                                        print('<option value="'.$cate.'">'.$cate.'</option>');
                                                
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
        <h3>商品リスト</h3>

                <table>
                    
                    <tr>
                        <th>ID</th>
                        <th>画像</th>
                        <th>アイテム名</th>
                        <th>最終更新日</th>
                        <th >操作</th>
                            
                    </tr>
                    <!-- ここでPHPのforeachを使って結果をループさせる -->
                    <?php foreach ($stmt as $row): ?>
                    <tr>
                        <td>
                            <?php echo $row['id']?>
                        </td>
                        <td>
                            <img src="images/<?php echo $row['item_img_path']; ?>" width="100" height="100">
                        </td>
                        <td>
                            <?php echo $row['item_name']?>
                        </td>
                        <td>
                            <?php 
                                echo date('Y/m/d', strtotime($row['update_time']));
                            ?>
                        </td>
                        <td>
                            <!-- ★追加：削除★ -->
                            <button type="button"  onclick="location.href='goods_details.php?id=<?php echo($row['id']) ?>'">表示</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

       

            
            
            
        <p><?php  error_reporting(0); echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p>
    







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
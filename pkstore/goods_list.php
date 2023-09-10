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
session_start();
//データベースへ接続
    $dsn = "mysql:dbname=pkstore77;host=localhost;charset=utf8mb4";
    $username = "pkstore77";
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
        <img src="img/character.png" alt="PKstoreのキャラクター" class="img pkc">   
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
            <div class="goods-list-f">
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
                    <!-- NEW０の時だけNEWアイコン表示 -->
                        <?php if (($row['new']) == 0){ ?>
                            <div class="relative">
                                <img src="images_comp/<?php echo $row['item_img_path']; ?>" width="100" height="100" >
                                <img src="img/newicon.png" alt="newicon" class="absolute absolute2 ">
                            </div>

                        <?php }else{ ?>
                            <img src="images_comp/<?php echo $row['item_img_path']; ?>" width="100" height="100" >
                        <?php } ?>
                        
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
            </div>  
            <div class="goods-err"><?php  echo htmlspecialchars($errmessage, ENT_QUOTES); ?></div>
<?php

if ((isset($_POST["item_name"])) && (isset($_POST["keyword"]))&& (isset($_POST["category"]))){
    $stmt = $pdo->query("SELECT * FROM item_info_transaction where delete_flag = '1' ORDER BY id DESC");
    //SQL文を実行して、結果を$stmtに代入する。
}
error_reporting(0);
if($_POST["item_name"] != "" || $_POST["keyword"] != "" || $_POST["category"] != ""){ //IDおよびユーザー名の入力有無を確認
    $stmt = $pdo->query("SELECT * FROM item_info_transaction WHERE item_name LIKE  '%".$_POST["item_name"]."%' 
                                                            AND keyword LIKE  '%".$_POST["keyword"]."%' 
                                                            AND category LIKE  '%".$_POST["category"]."%' 
                                                            AND delete_flag = '1' 
                                                            ORDER BY id DESC"); //SQL文を実行して、結果を$stmtに代入する。    
}
?>
<h3>削除済み商品リスト</h3>
<div class="goods-list-f-bottom">
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
</div>
<div class="goods-err"><?php  echo htmlspecialchars($errmessage, ENT_QUOTES); ?></div>

    

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
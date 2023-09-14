<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PK-onlineshop</title>
    
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
           if ((isset($_POST["keyword"]))&& (isset($_POST["category"]))){
               $stmt = $pdo->query("SELECT * FROM item_info_transaction where delete_flag = '0' ORDER BY id DESC");
               //SQL文を実行して、結果を$stmtに代入する。
           }
           if($_POST["keyword"] != "" || $_POST["category"] != ""){ //IDおよびユーザー名の入力有無を確認
               $stmt = $pdo->query("SELECT * FROM item_info_transaction WHERE keyword LIKE  '%".$_POST["keyword"]."%' 
                                                                       AND category LIKE  '%".$_POST["category"]."%' 
                                                                       AND delete_flag = '0'
                                                                       AND display = '0'
                                                                       ORDER BY item_price DESC"); //SQL文を実行して、結果を$stmtに代入する。                                                          
           }
           if($_POST["ip"] == "新着のみ" ){ //IDおよびユーザー名の入力有無を確認
            $stmt = $pdo->query("SELECT * FROM item_info_transaction WHERE keyword LIKE  '%".$_POST["keyword"]."%' 
                                                                    AND category LIKE  '%".$_POST["category"]."%' 
                                                                    AND delete_flag = '0'
                                                                    AND new = '0'
                                                                    AND display = '0'
                                                                    ORDER BY id DESC"); //SQL文を実行して、結果を$stmtに代入する。
        }
           if($_POST["ip"] == "値段の安い順" ){ //IDおよびユーザー名の入力有無を確認
               $stmt = $pdo->query("SELECT * FROM item_info_transaction WHERE keyword LIKE  '%".$_POST["keyword"]."%' 
                                                                       AND category LIKE  '%".$_POST["category"]."%' 
                                                                       AND delete_flag = '0'
                                                                       AND display = '0'
                                                                       ORDER BY item_price ASC"); //SQL文を実行して、結果を$stmtに代入する。
           }
           if($_POST["ip"] == "値段の高い順" ){ //IDおよびユーザー名の入力有無を確認
               $stmt = $pdo->query("SELECT * FROM item_info_transaction WHERE keyword LIKE  '%".$_POST["keyword"]."%' 
                                                                       AND category LIKE  '%".$_POST["category"]."%' 
                                                                       AND delete_flag = '0'
                                                                       AND display = '0'
                                                                       ORDER BY item_price DESC"); //SQL文を実行して、結果を$stmtに代入する。
           }
           
        
  
   
           ?> 
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
<div>
    <h3>商品購入</h3>
        <form action="pk_onlineshop.php" method="post" >
            <table class="pk-f">
                <thead>
                    <tr>
                
                        <th>キーワード</th>
                        <td>
                            <input type="text" name="keyword" id="keyword" maxlength="10" size="45"
                            value="<?= $_POST['keyword'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>カテゴリー</th>
                        <td>
                            <select name="category" id="category" value=array()>
                                <option value=""selected>選択無し</option>
                                <option value="カバン" <?php if (isset($_POST['category']) && $_POST['category'] == "カバン") echo 'selected'; ?>>カバン</option>
                                <option value="文房具" <?php if (isset($_POST['category']) && $_POST['category'] == "文房具") echo 'selected'; ?>>文房具</option>
                                <option value="タオル" <?php if (isset($_POST['category']) && $_POST['category'] == "タオル") echo 'selected'; ?>>タオル</option>
                                <option value="その他" <?php if (isset($_POST['category']) && $_POST['category'] == "その他") echo 'selected'; ?>>その他</option>   
                            </select><br>
                        </td>
                    </tr>
                    <tr>
                        <th>条件</th>
                        <td>
                            <select name="ip" id="ip" value=array()>
                                <option value=""selected>選択無し</option>
                                <option value="新着のみ" <?php if (isset($_POST['ip']) && $_POST['ip'] == "新着のみ") echo 'selected'; ?>>新着のみ</option>
                                <option value="値段の安い順" <?php if (isset($_POST['ip']) && $_POST['ip'] == "値段の安い順") echo 'selected'; ?>>値段の安い順</option>
                                <option value="値段の高い順" <?php if (isset($_POST['ip']) && $_POST['ip'] == "値段の高い順") echo 'selected'; ?>>値段の高い順</option>   
                            </select><br>
                        </td>
                    </tr>
                </thead>
            </table>
            <div class="contact-submit">
                    <input type="submit" class="submit" value="検索する">
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
        <div class="result-field">
            
            <!-- ここでPHPのforeachを使って結果をループさせる -->
            <?php foreach ($stmt as $row): ?>
            <li>
            <div class="result-item">
                <!-- NEW０の時だけNEWアイコン表示 -->
                <?php if (($row['new']) == 0){ ?>
                            <div class="relative">
                                <img src="images_comp/<?php echo $row['item_img_path']; ?>" width="100" height="100" >
                                <img src="img/newicon.png" alt="newicon" class="absolute absolute2 ">
                            </div>
                        <?php }else{ ?>
                            <img src="images_comp/<?php echo $row['item_img_path']; ?>" width="100" height="100" >
                        <?php } ?>
                <p class="item-name" name='item_name'><?php echo $row['item_name']?></p>
                <p class="item_price" name='item_price'>¥<?php echo $row['item_price']?></p>

                
                <form method="post" action="cart.php" enctype="multipart/form-data">
                    <!-- 売り切れの場合は、formを置換 -->
                    <?php if($row['item_stock'] > 0){ ?>
                    <select name="buy_count" >
                        <?php for($i=0;$i<10;$i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                    <input type="hidden" name="item_img_path" value="<?php echo $_SESSION['id'] ?>">
                    <input type="hidden" name="item_img_path" value="<?php echo $row['item_img_path'] ?>">
                    <input type="hidden" name="item_name" value="<?php echo $row['item_name'] ?>">
                    <input type="hidden" name="item_price" value="<?php echo $row['item_price'] ?>">
                    <input type="submit" name="item_id" value="カートへ">
                </form>
                <?php }else{ ?>
                    <input type="hidden" name="item_img_path" value="<?php echo $_SESSION['id'] ?>">
                    <input type="hidden" name="item_img_path" value="<?php echo $row['item_img_path'] ?>">
                    <input type="hidden" name="item_name" value="<?php echo $row['item_name'] ?>">
                    <input type="hidden" name="item_price" value="<?php echo $row['item_price'] ?>">
                    <p style="color: red;">売切</p>
                <?php } ?>
            </div>
            </li>
            <?php endforeach; ?>
        </div>
        <p class="nodate"><?php echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p>

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
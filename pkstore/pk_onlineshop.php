<?php
session_start();
?>

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
           error_reporting(0);
           if($_POST["keyword"] != "" || $_POST["category"] != ""){ //IDおよびユーザー名の入力有無を確認
               $stmt = $pdo->query("SELECT * FROM item_info_transaction WHERE delete_flag = '0' 
                                                                       AND keyword LIKE  '%".$_POST["keyword"]."%' 
                                                                       AND category LIKE  '%".$_POST["category"]."%' 
                                                                       ORDER BY id DESC"); //SQL文を実行して、結果を$stmtに代入する。    
   
           }
   
           ?> 
<header>
    <div class="header-left">
        <a href="index.php"><img src="img/logo.png" alt="PKstoreのロゴ" class="img"></a>
        <img src="img/character.png" alt="PKstoreのキャラクター" class="img">   
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
        <a href="login.php">ログイン・会員登録はこちら</a>
        <a href="cart.php">カートの中身（仮）</a>
        <ul>
            <li><a href="pk_onlineshop.php">グッズ販売</a></li>
            <li><a href="sns.php">SNS</li>
            <li><a href="news.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
        </ul>
        <?php endif; ?>
    </div>
</header>
<main>
<div>
    <h3>商品購入</h3>
        <form action="pk_onlineshop.php" method="post">
            <table>
                <thead>
                    <tr>
                
                        <th>キーワード</th>
                        <td>
                        <input type="text" name="keyword" id="keyword" maxlength="10" 
                            value="<?= $_POST['keyword'] ?>">
                    </tr>
                    <tr>
                        <th>カテゴリー</th>
                        <td>
                            <select name="category" id="category" value=array()>
                                <option value=""selected>選択無し</option>
                                <option value="0" <?php if (isset($_POST['category']) && $_POST['category'] == "0") echo 'selected'; ?>>カバン</option>
                                <option value="1" <?php if (isset($_POST['category']) && $_POST['category'] == "1") echo 'selected'; ?>>文房具</option>
                                <option value="2" <?php if (isset($_POST['category']) && $_POST['category'] == "2") echo 'selected'; ?>>タオル</option>
                                <option value="3" <?php if (isset($_POST['category']) && $_POST['category'] == "3") echo 'selected'; ?>>その他</option>
                                
                                
                            </select><br>
                        </td>
                        <th>並び順</th>
                        <td>
                            <select name="authority" id="authority" value=array()>
                                <option value=""selected>選択無し</option>
                                <option value="0" <?php if (isset($_POST['id']) && $_POST['id'] == "0") echo 'selected'; ?>>新着</option>
                                <option value="1" <?php if (isset($_POST['item_price']) && $_POST['item_price'] == "1") echo 'selected'; ?>>値段の安い順</option>
                                <option value="2" <?php if (isset($_POST['item_price']) && $_POST['item_price'] == "2") echo 'selected'; ?>>値段の高い順</option>
                                
                                
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
        <div class="result-field">
            
            <!-- ここでPHPのforeachを使って結果をループさせる -->
            <?php foreach ($stmt as $row): ?>
            <li>
            <div class="result-item">
            
            <img src="images_comp/<?php echo $row['item_img_path']; ?>" width="100" height="100">
            <p class="item-name" name='item_name'><?php echo $row['item_name']?></p>
            <p class="keyword" ><?php echo $row['keyword']?></p>
            <p class="item_price" name='item_price'>¥<?php echo $row['item_price']?></p>

            
            <form method="post" action="cart.php" enctype="multipart/form-data">
                <select name="buy_count" >
                    <?php for($i=0;$i<10;$i++): ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
                <!-- 売り切れの場合は、formを置換 -->
                <?php if($row['item_stock'] > 0){ ?>

                <input type="hidden" name="item_img_path" value="<?php echo $_SESSION['id'] ?>">
                <input type="hidden" name="item_img_path" value="<?php echo $row['item_img_path'] ?>">
                <input type="hidden" name="item_name" value="<?php echo $row['item_name'] ?>">
                <input type="hidden" name="item_price" value="<?php echo $row['item_price'] ?>">
                <input type="submit" name="item_id" value="カートへ">
            </form>
            <?php }else{ ?>
                <p>売切</p>
            <?php } ?>
            </div>
            </li>
            <?php endforeach; ?>
        </div>
        <p class="nodate"><?php  error_reporting(0); echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p>

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
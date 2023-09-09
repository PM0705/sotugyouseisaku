<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>情報検索フォーム</title>
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
        if ((isset($_POST["info_title"])) && (isset($_POST["info_text"]))){
            $stmt = $pdo->query("SELECT * FROM information where delete_flag = '0' ORDER BY id DESC");
            //SQL文を実行して、結果を$stmtに代入する。
        }
        error_reporting(0);
        if($_POST["info_title"] != "" || $_POST["info_text"] != "" || $_POST["info_new"] != "" || $_POST["display"] != ""){ //IDおよびユーザー名の入力有無を確認
            $stmt = $pdo->query("SELECT * FROM information WHERE info_title LIKE  '%".$_POST["info_title"]."%' 
                                                                    AND info_text LIKE  '%".$_POST["info_text"]."%' 
                                                                    AND info_new LIKE  '%".$_POST["info_new"]."%' 
                                                                    AND display LIKE  '%".$_POST["display"]."%' 
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
                <?php $message = $_SESSION['mail']."さんようこそ";?>
                <div class="message-text"><?php echo htmlspecialchars($message, ENT_QUOTES); ?><a href="logout.php">(ログアウト)</a></div>
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
    <h3>情報検索フォーム</h3>
        <form action="new_info_list.php" method="post">
            <table class="mail-search">
                <thead>
                    <tr>
                        <th>タイトル</th>
                        <td>
                            <input type="text" name="info_title" id="info_title" maxlength="100" size="35"
                            value="<?= $_POST['info_title'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>内容</th>
                        <td>
                            <input type="text" name="info_text" id="info_text" maxlength="100" size="35"
                            value="<?= $_POST['info_text'] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>NEW</th>
                        <td>
                            <div class="radiogender">
                                <lavel><input type="radio" name="info_new" value="" checked>選択無し</lavel>
                                <lavel><input type="radio" name="info_new" value="0" <?php if (isset($_POST['info_new']) && $_POST['info_new'] == "0") echo 'checked'; ?>>ON</label>
                                <lavel><input type="radio" name="info_new" value="1" <?php if (isset($_POST['info_new']) && $_POST['info_new'] == "1") echo 'checked'; ?>>OFF</label>
                            </div>
                        </td>                    
                        <th>表示</th>
                        <td>
                            <div class="radiogender">
                                <lavel><input type="radio" name="display" value="" checked>選択無し</lavel>
                                <lavel><input type="radio" name="display" value="0" <?php if (isset($_POST['display']) && $_POST['display'] == "0") echo 'checked'; ?>>ON</label>
                                <lavel><input type="radio" name="display" value="1" <?php if (isset($_POST['display']) && $_POST['display'] == "1") echo 'checked'; ?>>OFF</label>
                            </div>
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
        <h3>情報リスト</h3>

        <div class="info_field">
                <table>
                    
                    <tr>
                        <th>ID</th>
                        <th>画像</th>
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
                            <img src="images_comp/<?php echo $row['info_img_path']; ?>" width="100" height="100">
                        </td>
                        <td>
                            <?php 
                                echo date('Y/m/d', strtotime($row['update_time']));
                            ?>
                        </td>
                        <td>
                            <!-- ★追加：削除★ -->
                            <button type="button"  onclick="location.href='new_info_details.php?id=<?php echo($row['id']) ?>'">表示</button>
                        </td>
                    </tr>  
                    <?php endforeach; ?>      
                </table>                      
        </div>  
        <p class="nodate"><?php  error_reporting(0); echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p> 

<?php
if ((isset($_POST["info_title"])) && (isset($_POST["info_text"]))){
    $stmt = $pdo->query("SELECT * FROM information where delete_flag = '1' ORDER BY id DESC");
    //SQL文を実行して、結果を$stmtに代入する。
}
error_reporting(0);
if($_POST["info_title"] != "" || $_POST["info_text"] != "" || $_POST["info_new"] != "" || $_POST["display"] != ""){ //IDおよびユーザー名の入力有無を確認
    $stmt = $pdo->query("SELECT * FROM information WHERE info_title LIKE  '%".$_POST["info_title"]."%' 
                                                            AND info_text LIKE  '%".$_POST["info_text"]."%' 
                                                            AND info_new LIKE  '%".$_POST["info_new"]."%' 
                                                            AND display LIKE  '%".$_POST["display"]."%' 
                                                            AND delete_flag = '1' 
                                                            ORDER BY id DESC"); //SQL文を実行して、結果を$stmtに代入する。    
}
?>

        <h3>削除済み情報リスト</h3>

        <div class="info_field">
                <table>
                    
                    <tr>
                        <th>ID</th>
                        <th>画像</th>
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
                            <img src="images/<?php echo $row['info_img_path']; ?>" width="100" height="100">
                        </td>
                        <td>
                            <?php 
                                echo date('Y/m/d', strtotime($row['update_time']));
                            ?>
                        </td>
                        <td>
                            <!-- ★追加：削除★ -->
                            <button type="button"  onclick="location.href='new_info_details.php?id=<?php echo($row['id']) ?>'">表示</button>
                        </td>
                    </tr>  
                    <?php endforeach; ?>      
                </table>                      
        </div>  
        <p class="nodate"><?php  error_reporting(0); echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p> 
    







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
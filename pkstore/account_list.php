<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員リスト</title>
    <link rel="stylesheet" href="htmlstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9e0ab757d4.js" crossorigin="anonymous"></script>
    
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
        if ((isset($_POST["family_name"])) && (isset($_POST["last_name"])) && (isset($_POST["family_name_kana"])) && (isset($_POST["last_name_kana"])) && (isset($_POST["mail"]))){
            $stmt = $pdo->query("SELECT * FROM account_list where delete_flag = '0' ORDER BY id DESC");
            //SQL文を実行して、結果を$stmtに代入する。
        }
        
        if($_POST["family_name"] != "" || $_POST["last_name"] != "" || $_POST["family_name_kana"] != "" || $_POST["last_name_kana"] != "" || $_POST["mail"] != "" || $_POST["gender"] != "" || $_POST["authority"] != "" ){ //IDおよびユーザー名の入力有無を確認
            $stmt = $pdo->query("SELECT * FROM account_list WHERE family_name LIKE  '%".$_POST["family_name"]."%' 
                                                                    AND last_name LIKE  '%".$_POST["last_name"]."%' 
                                                                    AND family_name_kana LIKE  '%".$_POST["family_name_kana"]."%' 
                                                                    AND last_name_kana LIKE  '%".$_POST["last_name_kana"]."%' 
                                                                    AND mail LIKE  '%".$_POST["mail"]."%' 
                                                                    AND gender LIKE  '%".$_POST["gender"]."%' 
                                                                    AND authority LIKE  '%".$_POST["authority"]."%'
                                                                    AND delete_flag = '0' 
                                                                    ORDER BY id DESC"); //SQL文を実行して、結果を$stmtに代入する。    

        }

?>

<div class="header0">
    <!-- ログインしていない -->
            <?php if (empty($_SESSION['id'])) :?> 
            
        <ul>
            <li><a href="sns.php">SNS</li>
            <li><a href="news.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
            <li><a href="login.php">ログイン・会員登録はこちら</a></li>
        </ul>
    <!-- 管理者 -->
            <?php elseif ($_SESSION['authority'] == 1) :?>
                <?php $message1 = $_SESSION['mail']."さんようこそ";?>
        <ul>
            <li><a href="pk_onlineshop.php">shop</a></li>           
            <li><a href="sns.php">SNS</li>
            <li><a href="news.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
            <li><a href="authority.php">管理者用メニュー</a></li>
            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            <li><?php echo htmlspecialchars($message1, ENT_QUOTES); ?><a href="logout.php">(ログアウト)</a></li>
        </ul>
            
        
        <?php else:?>
            <?php $message1 = $_SESSION['mail']."さんようこそ";?>
        <ul>
            <li><a href="pk_onlineshop.php">shop</a></li>
            <li><a href="sns.php">SNS</li>
            <li><a href="news.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            <li><?php echo htmlspecialchars($message1, ENT_QUOTES); ?><a href="logout.php">(ログアウト)</a></li>
  
        </ul>   
        <?php endif; ?>
</div>
   
<header>
    <div class="header-left">
        <a href="index.php"><img src="img/pkstore.png" alt="PKstoreのロゴ" class="h-img"></a>
    </div>
    <div class="input-group header-right">
        <input type="text" id="txt-search" class="form-control input-group-prepend" placeholder="キーワードを入力(機能は未実装）"></input>
        <span class="input-group-btn input-group-append">
            <submit type="submit" id="btn-search" class="btn btn-primary"><i class="fas fa-search"></i></submit>
        </span>
    </div>

</header>
 <main>
        <h3>会員リスト</h3>
        <form action="account_list.php" method="post">
            <table class="mail-search">
                <thead>
                    <tr>
                        <th>名前（姓）</th>
                        <td>
                        <input type="text" name="family_name" id="family_name" maxlength="10" 
                            pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" value="<?= $_POST['family_name'] ?>"
                            title="漢字・ひらがなでご入力ください"><br>
                        
                        <th>名前（名）</th>
                        <td>
                        <input type="text" name="last_name" id="last_name" maxlength="10" value="<?= $_POST['last_name'] ?>"
                            pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" title="漢字・ひらがなでご入力ください"><br>
                        </td>
                    </tr>
                    <tr>
                        
                        <th>カナ（姓）</th>
                        <td>
                        <input type="text" name="family_name_kana" id="family_name_kana" maxlength="10" value="<?= $_POST['family_name_kana'] ?>"
                            pattern="^[\u30A0-\u30FF]+$" title="全角カタカナでご入力ください"><br>
                        </td>
                        <th>カナ（名）</th>
                        <td>
                        <input type="text" name="last_name_kana" id="last_name_kana" maxlength="10" value="<?= $_POST['last_name_kana'] ?>"
                            pattern="^[\u30A0-\u30FF]+$" title="全角カタカナでご入力ください"><br>
                        </td>



                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>
                        <input type="text" name="mail" id="mail" maxlength="100" value="<?= $_POST['mail'] ?>"
                            pattern="^[\w\d\-_-]+@[\w\d_-]+\.[\w\d._-]+$" title="半角英数字、半角ハイフンでご入力ください">
                        </td>
                        <th>性別</th>
                        <td>
                        <div class="radiogender">
                        <input type="radio" name="gender" value="" checked>選択無し
                        <input type="radio" name="gender" value="0" <?php if (isset($_POST['gender']) && $_POST['gender'] == "0") echo 'checked'; ?>>男
                        <input type="radio" name="gender" value="1" <?php if (isset($_POST['gender']) && $_POST['gender'] == "1") echo 'checked'; ?>>女
                        
                        
                        </div>
                        </td>

                    </tr>
                    <tr>
                        
                        <th>アカウント権限</th>
                        <td>
                        <select name="authority" id="authority" value=array()>
                            <option value=""selected>選択無し</option>
                            <option value="0" <?php if (isset($_POST['authority']) && $_POST['authority'] == "0") echo 'selected'; ?>>一般</option>
                            <option value="1" <?php if (isset($_POST['authority']) && $_POST['authority'] == "1") echo 'selected'; ?>>管理者</option>
                            
                            
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
        <h3>アカウント一覧</h3>
        <div class="account_field">
            <table>
                <tr>
                    <th>ID</th>
                    <th>名前（姓）</th>
                    <th>名前（名）</th>
                    <th>カナ（姓）</th>
                    <th>カナ（名）</th>
                    <th>操作</th>      
                </tr>
                <!-- ここでPHPのforeachを使って結果をループさせる -->
                <?php foreach ($stmt as $row): ?>
                <tr>
                    <td>
                        <?php echo $row['id']?>
                    </td>
                    <td>
                        <?php echo $row['family_name']?>
                    </td>
                    <td>
                        <?php echo $row['last_name']?>
                    </td>
                    <td>
                        <?php echo $row['family_name_kana']?>
                    </td>
                    <td>
                        <?php echo $row['last_name_kana']?>
                    </td>
                    <td>
                        <!-- ★追加：削除★ -->                    
                        <button type="button"  onclick="location.href='account_details.php?id=<?php echo($row['id']) ?>'">表示</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <p class="nodate"><?php   echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p>


<?php
//データベースへ接続
$dsn = "mysql:dbname=pkstore77;host=localhost;charset=utf8mb4";
$username = "pkstore77";
$password = "root";
$options = [];
$pdo = new PDO($dsn, $username, $password, $options);
    if ((isset($_POST["family_name"])) && (isset($_POST["last_name"])) && (isset($_POST["family_name_kana"])) && (isset($_POST["last_name_kana"])) && (isset($_POST["mail"]))){
        $stmt = $pdo->query("SELECT * FROM account_list where delete_flag = '1' ORDER BY id DESC"); //SQL文を実行して、結果を$stmtに代入する。
    }
    
    if($_POST["family_name"] != "" || $_POST["last_name"] != "" || $_POST["family_name_kana"] != "" || $_POST["last_name_kana"] != "" || $_POST["mail"] != "" || $_POST["gender"] != "" || $_POST["authority"] != "" ){ //IDおよびユーザー名の入力有無を確認
        $stmt = $pdo->query("SELECT * FROM account_list WHERE family_name LIKE  '%".$_POST["family_name"]."%' 
                                                                AND last_name LIKE  '%".$_POST["last_name"]."%' 
                                                                AND family_name_kana LIKE  '%".$_POST["family_name_kana"]."%' 
                                                                AND last_name_kana LIKE  '%".$_POST["last_name_kana"]."%' 
                                                                AND mail LIKE  '%".$_POST["mail"]."%' 
                                                                AND gender LIKE  '%".$_POST["gender"]."%' 
                                                                AND authority LIKE  '%".$_POST["authority"]."%' 
                                                                AND delete_flag = '1' 
                                                                ORDER BY id DESC"); //SQL文を実行して、結果を$stmtに代入する。
    }
?>
<?php
$count = $stmt->rowCount();
// var_dump($count);
if ($count == 0) {
    $errmessage = "検索結果はありません";
    } 
?>  

    <h3>退会済み会員リスト</h3>
        <div class="account_field">
            <table>
                <tr>
                    <th>ID</th>
                    <th>名前（姓）</th>
                    <th>名前（名）</th>
                    <th>カナ（姓）</th>
                    <th>カナ（名）</th>
                    <th>操作</th>
                </tr>
                <!-- ここでPHPのforeachを使って結果をループさせる -->
                <?php foreach ($stmt as $row): ?>
                <tr >
                    <td>
                        <?php echo $row['id']?>
                    </td>
                    <td>
                        <?php echo $row['family_name']?>
                    </td>
                    <td>
                        <?php echo $row['last_name']?>
                    </td>
                    <td>
                        <?php echo $row['family_name_kana']?>
                    </td>
                    <td>
                        <?php echo $row['last_name_kana']?>
                    </td>
                    <td>
                        <!-- ★追加：削除★ -->                    
                        <button type="button"  onclick="location.href='account_details.php?id=<?php echo($row['id']) ?>'">表示</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <p class="nodate"><?php echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p>

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

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員リスト</title>
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
        if ((isset($_POST["family_name"])) && (isset($_POST["last_name"])) && (isset($_POST["family_name_kana"])) && (isset($_POST["last_name_kana"])) && (isset($_POST["mail"]))){
            $stmt = $pdo->query("SELECT * FROM account_list where delete_flag = '0' ORDER BY id DESC");
            //SQL文を実行して、結果を$stmtに代入する。
        }
        error_reporting(0);
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
                        <button type="button"  onclick="location.href='delete.php?id=<?php echo($row['id']) ?>'">削除</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <p class="nodate"><?php  error_reporting(0); echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p>


<?php
//データベースへ接続
$dsn = "mysql:dbname=lesson01;host=localhost;charset=utf8mb4";
$username = "root";
$password = "root";
$options = [];
$pdo = new PDO($dsn, $username, $password, $options);
    if ((isset($_POST["family_name"])) && (isset($_POST["last_name"])) && (isset($_POST["family_name_kana"])) && (isset($_POST["last_name_kana"])) && (isset($_POST["mail"]))){
        $stmt = $pdo->query("SELECT * FROM diblog_account where delete_flag = '1' ORDER BY id DESC"); //SQL文を実行して、結果を$stmtに代入する。
    }
    error_reporting(0);
    if($_POST["family_name"] != "" || $_POST["last_name"] != "" || $_POST["family_name_kana"] != "" || $_POST["last_name_kana"] != "" || $_POST["mail"] != "" || $_POST["gender"] != "" || $_POST["authority"] != "" ){ //IDおよびユーザー名の入力有無を確認
        $stmt = $pdo->query("SELECT * FROM diblog_account WHERE family_name LIKE  '%".$_POST["family_name"]."%' 
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
                <tr><td>
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
                        <button type="button"  onclick="location.href='delete.php?id=<?php echo($row['id']) ?>'">削除</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <p class="nodate"><?php  error_reporting(0); echo htmlspecialchars($errmessage, ENT_QUOTES); ?></p>

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
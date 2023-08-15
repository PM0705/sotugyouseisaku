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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/6-1-7.css">
    
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body>
   
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
        <h3>アカウント一覧</h3>
        <div class="info">
        <div class="relative new-goods">
            <a href="new-goods.php"><img src="img/newg1.png" alt="newg1" class="info-img"></a>
            <img src="img/newIcon.png" alt="newIcon" class="absolute">
            <p class="new-goods-text">
                texttexttexttexttexttexttexttexttexttexttexttexttext
                <br>texttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttext
            </p>
            <div class="submit-confirm">
            <button onclick="location.href='buyItem.php'" class="submit">カートに入れる</button>
            </div>
        </div>
        <div class="relative new-goods">
            <a href="new-goods.php"><img src="img/newg2.png" alt="newg2" class="info-img"></a>
            <img src="img/newIcon.png" alt="newIcon" class="absolute">
            <p class="new-goods-text">
                texttexttexttexttexttexttexttexttexttexttexttexttext
                <br>texttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttext
            </p>
            <div class="submit-confirm">
            <button onclick="location.href='buyItem.php'" class="submit">カートに入れる</button>
            </div>
        </div>
        <div class="relative new-goods">
            <a href="new-goods.php"><img src="img/newg3.png" alt="newg3" class="info-img"></a>
            <img src="img/newIcon.png" alt="newIcon" class="absolute">
            <p class="new-goods-text">
                texttexttexttexttexttexttexttexttexttexttexttexttext
                <br>texttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttext
            </p>
            <div class="submit-confirm">
            <button onclick="location.href='buyItem.php'" class="submit">カートに入れる</button>
            </div>
        </div>
        <div class="relative new-goods">
            <a href="new-goods.php"><img src="img/newg3.png" alt="newg4" class="info-img"></a>
            <img src="img/newIcon.png" alt="newIcon" class="absolute">
            <p class="new-goods-text">
                texttexttexttexttexttexttexttexttexttexttexttexttext
                <br>texttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttexttext
            </p>
            <div class="submit-confirm">
            <button onclick="location.href='buyItem.php'" class="submit">カートに入れる</button>
            </div>
        </div>
        
    </div>



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
    <div class="kizi1">
        <h3>削除済みアカウント一覧</h3>

        <table>
            <tr>
                <th>ID</th>
                <th>名前（姓）</th>
                <th>名前（名）</th>
                <th>カナ（姓）</th>
                <th>カナ（名）</th>
                <th>メールアドレス</th>
                <th>性別</th>
                <th>アカウント権限</th>
                <th>削除フラグ</th>
                <th>登録日時</th>
                <th>更新日時</th>
                <th ><br>操作<br><p class="dl">※削除済みの為操作できません</p></th>
                
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
                    <?php echo $row['mail']?>
                </td>
                <td>
                    <?php error_reporting(0);
                            if ($row['gender'] == 0) {
                                echo "男";
                                }else{
                                        echo "女";
                                }?>
                </td>
                <td>
                    <?php error_reporting(0);
                        if ($row['authority'] == 0) {
                            echo "一般";
                            }else{
                                    echo "管理者";
                            }?>
                </td>
                <td><?php switch ($row['delete_flag']) {
                                    case '0':
                                        echo "有効";
                                        break;
                                    
                                    default:
                                        echo "無効";
                                        break;
                            } 
                            // switch ($row['delete_flag']) {
                            //         case '0':
                            //             echo "有効";
                            //             break;
                                    
                            //         default:
                            //             echo "無効";
                            //             break;
                            // } 
                        ?>
                    </td>
                    <td>
                        <?php
                             error_reporting(0);
                             echo date('Y/m/d', strtotime($row['registered_time']));
                        ?>
                    </td>
                    <td>
                        <?php 
                             echo date('Y/m/d', strtotime($row['update_time']));
                        ?>
                    </td>
                    <td>
                        <!-- ★追加：削除★ -->
                        <p class="dl_sousa">更新 削除 パスワード変更</p>
                        
                    </td>
            </tr>
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

    
 <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!--自作のJS-->
    <script>
    $('.slider').slick({
		autoplay: true,//自動的に動き出すか。初期値はfalse。
		infinite: true,//スライドをループさせるかどうか。初期値はtrue。
		speed: 500,//スライドのスピード。初期値は300。
		slidesToShow: 3,//スライドを画面に3枚見せる
		slidesToScroll: 1,//1回のスクロールで1枚の写真を移動して見せる
		prevArrow: '<div class="slick-prev"></div>',//矢印部分PreviewのHTMLを変更
		nextArrow: '<div class="slick-next"></div>',//矢印部分NextのHTMLを変更
		centerMode: true,//要素を中央ぞろえにする
		variableWidth: true,//幅の違う画像の高さを揃えて表示
		dots: true,//下部ドットナビゲーションの表示
	});
    </script>
    <script src="js/6-1-7.js"></script>
</body>
</html>
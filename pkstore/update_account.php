<?php
session_start();
include 'vars.php';
?>
<?php
if (isset($_GET['id'])) {
    try {

        // 接続処理
        $dsn = 'mysql:host=localhost;dbname=pkstore77';
        $user = 'pkstore77';
        $password = 'root';
        $dbh = new PDO($dsn, $user, $password);

        // SELECT文を発行
        $sql = "SELECT * FROM account_list WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $member = $stmt->fetch(PDO::FETCH_OBJ); // 1件のレコードを取得

        // 接続切断
        $dbh = null;
    } catch (PDOException $e) {
        print $e->getMessage() . "<br/>";
    }
}
?>

<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員管理フォーム</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="htmlstyle.css">


</head>

<body>
    <div class="header0">
        <!-- ログインしていない -->
        <?php if (empty($_SESSION['id'])) : ?>

            <ul>
                <li><a href="sns.php">SNS</li>
                <li><a href="news.php">新着情報</li>
                <li><a href="store_info.php">店舗情報</a></li>
                <li><a href="mail.php">お問い合わせ</a></li>
                <li><a href="login.php">ログイン・会員登録はこちら</a></li>
            </ul>
            <!-- 管理者 -->
        <?php elseif ($_SESSION['authority'] == 1) : ?>
            <?php $message1 = $_SESSION['mail'] . "さんようこそ"; ?>
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


        <?php else : ?>
            <?php $message1 = $_SESSION['mail'] . "さんようこそ"; ?>
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
        <h3>会員情報編集フォーム</h3>

        <div class="account_field">

            <form method="post" action="update_confirm_account.php" name="form">
                <div class="contact-form errorMsg">

                    <!-- ID -->
                    <input type="hidden" name="id" value="<?php echo ($member->id) ?>">

                    <!-- お名前 -->
                    <label for="family_name" class="form-label">名前（姓）※漢字・ひらがなのみ可</label>
                    <input type="text" name="family_name" id="family_name" class="form-control" maxlength="10" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" title="漢字・ひらがなでご入力ください" value="<?php print($member->family_name) ?>"><br>
                    <span class="err-msg-family_name"></span>
                    <br>
                    <label for="last_name" class="form-label">名前（名）※漢字・ひらがなのみ可</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" maxlength="10" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" title="漢字・ひらがなでご入力ください" value="<?php print($member->last_name) ?>"><br>
                    <span class="err-msg-last_name"></span>
                    <br>
                    <label for="family_name_kana" class="form-label">カナ（姓）※全角カタカナのみ可</label>
                    <input type="text" name="family_name_kana" id="family_name_kana" class="form-control" maxlength="10" pattern="^[\u30A0-\u30FF]+$" title="全角カタカナでご入力ください" value="<?php print($member->family_name_kana) ?>"><br>
                    <span class="err-msg-family_name_kana"></span>
                    <br>
                    <label for="last_name_kana" class="form-label">カナ（名）※全角カタカナのみ可</label>
                    <input type="text" name="last_name_kana" id="last_name_kana" class="form-control" maxlength="10" pattern="^[\u30A0-\u30FF]+$" title="全角カタカナでご入力ください" value="<?php print($member->last_name_kana) ?>"><br>
                    <span class="err-msg-last_name_kana"></span>
                    <br>
                    <!-- mail -->
                    <label for="mail" class="form-label">メールアドレス<br>※半角英数字、半角ハイフンのみ可</label>
                    <input type="text" name="mail" id="mail" class="form-control" maxlength="100" pattern="^[a-zA-Z0-9\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-]+$" title="半角英数字、半角ハイフンでご入力ください" value="<?php print($member->mail) ?>"><br>
                    <span class="err-msg-mail"></span>
                    <br>
                    <!-- パスワード -->
                    <label for="password" class="form-label">パスワード</label>
                    <p class="pwmsg" style="color: red;">※パスワードはこちらでは変更できません</p>
                    <br>
                    <!-- 性別 -->
                    <label for="性別" class="form-label">性別</label>
                    <span class="gender">
                        <label><input type="radio" name="gender" value="0" <?php print($member->gender == "0" ? ' checked' : ''); ?>>男</label>
                        <label><input type="radio" name="gender" value="1" <?php print($member->gender == "1" ? ' checked' : ''); ?>>女</label><br>
                    </span>
                    <span class="err-msg-gender"></span>
                    <br>
                    <!-- 郵便番号 -->
                    <label for="郵便番号" class="form-label">郵便番号</label>
                    <input type=tel class="form-control" id="postal_code" name="postal_code" maxlength="7" pattern="^[\d]{7}" title="半角数字でご入力ください" value="<?php print($member->postal_code) ?>"><br>
                    <span class="err-msg-postal_code"></span>
                    <br>
                    <!-- 住所（都道府県） -->

                    <label for="住所（都道府県）" class="form-label">住所（都道府県）</label>
                    <select name="prefecture" id="prefecture" class="form-select">
                        <option value="<?php print($member->prefecture) ?>" selected><?php print($member->prefecture) ?></option>

                        <?php
                        $prefs = array(
                            '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県',
                            '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県',
                            '東京都', '神奈川県', '山梨県', '新潟県', '富山県', '石川県',
                            '福井県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県',
                            '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県',
                            '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県',
                            '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県',
                            '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
                        );
                        foreach ($prefs as $prefs) {
                            print('<option value="' . $prefs . '">' . $prefs . '</option>');
                        }
                        ?>

                    </select>

                    <br>
                    <span class="err-msg-prefecture"></span>
                    <br>
                    <!-- 住所（市区町村） -->
                    <label for="住所（市区町村）" class="form-label">住所（市区町村）<br>※ひらがな、漢字、数字、全角カタカナ、記号（-/スペース）のみ可</label>
                    <input type="text" class="form-control" size="35" name="address_1" id="address_1" pattern="[\d\u30A1-\u30F6\u4E00-\u9FFF\u3040-\u309Fー\s　\-]*" maxlength="10" title="ひらがな、漢字、数字、カタカナ、記号（-/スペース）でご入力ください" value="<?php print($member->address_1) ?>"><br>
                    <span class="err-msg-address_1"></span>
                    <!-- 住所（番地） -->
                    <label for="住所（番地）" class="form-label">住所（番地）<br>※ひらがな、漢字、数字、全角カタカナ、記号（-/スペース）のみ入力可</label>
                    <input input type="text" class="form-control" size="35" name="address_2" id="address_2" pattern="[\d\u30A1-\u30F6\u4E00-\u9FFF\u3040-\u309Fー\s　\-]*" maxlength="100" title="ひらがな、漢字、数字、カタカナ、記号（-/スペース）でご入力ください" value="<?php print($member->family_name_kana) ?>"><br>
                    <span class="err-msg-address_2"></span>
                    <br>
                    <!-- アカウント権限 -->
                    <label for="アカウント権限" class="form-select">アカウント権限</label>
                    <select name="authority" id="authority" value=array()>
                        <option value="0" <?php if ($member->authority == "0") {
                                                echo ' selected';
                                            } ?>>一般</option>
                        <option value="1" <?php if ($member->authority == "1") {
                                                echo ' selected';
                                            } ?>>管理者</option>
                    </select>
                    <br>

                    <!-- 送信ボタン -->
                    <div class="contact-submit">
                        <div>
                            <input type="submit" class="btn btn-primary" value="確認する">
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </main>
    <footer>
        <div class="footer-l">
            <a href="index.php"><img src="img/PKlogo.png" alt="PKstoreのロゴ" class="h-img logo"></a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9e0ab757d4.js" crossorigin="anonymous"></script>
</body>

</html>
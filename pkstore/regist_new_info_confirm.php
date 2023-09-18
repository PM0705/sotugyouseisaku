<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>情報登録フォーム</title>
    <link rel="stylesheet" href="htmlstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9e0ab757d4.js" crossorigin="anonymous"></script>
    
</head>
<body>
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
 <h3>情報登録フォーム</h3>
 <div class="confirm">
        <p>NEW〜情報〜に登録する内容はこちらでよろしいですか？
            <br>よろしければ「送信する」ボタンを押してください。
        </p>

            <p for="title">タイトル:
            <?php
            echo $_POST['info_title'];
            ?></p>


            <p for="内容">内容:
            <?php
           echo $_POST['info_text'];
           ?>
           </p>


        <p>NEW:
           <?php
           if ($_POST['info_new'] == 0) {
               echo "ON";
               }else{
                    echo "OFF";
            }
           ?>
        </p>
        <p>表示:
           <?php
           if ($_POST['display'] == 0) {
               echo "ON";
               }else{
                    echo "OFF";
            }
           ?>
        </p>
        <p>商品画像:
            <?php
            echo$_FILES['info_img_path']['name'];
            if (isset($_POST['info_img_path'])){
                // $_FILES['inputで指定したname']['tmp_name']：一時保存ファイル名
                    $temp_file = $_FILES['info_img_path']['tmp_name'];
                    $dir = './images/';
            
                if (file_exists($temp_file)) {//②送信した画像が存在するかチェック
                    $image = uniqid(mt_rand(), false);//③ファイル名をユニーク化
                    switch (@exif_imagetype($temp_file)) {//④画像ファイルかのチェック
                        case IMAGETYPE_GIF:
                            $image .= '.gif';
                            break;
                        case IMAGETYPE_JPEG:
                            $image .= '.jpg';
                            break;
                        case IMAGETYPE_PNG:
                            $image .= '.png';
                            break;
                        default:
                            echo '拡張子を変更してください';
                    }
            //⑤DBではなくサーバーのimageディレクトリに画像を保存
                    move_uploaded_file($temp_file, $dir . $image);
                }
            }
            ?>

        <div class="submit-confirm">
            <form action="regist_new_info.php" method="post">  
                <input type="submit" class="submit" value="戻って修正する">
                <input type="hidden" value="<?php echo $_POST['info_title']; ?>" name="info_title">
                <input type="hidden" value="<?php echo $_POST['info_text']; ?>" name="info_text">
                <input type="hidden" value="<?php echo $_POST['info_new']; ?>" name="info_new">
                <input type="hidden" value="<?php echo $_POST['display']; ?>" name="display">
            </form>

            </form>
            <form action="regist_new_info_complete.php"method="post">
                <input type="submit" class="submit" value="登録">
                <input type="hidden" value="<?php echo $_POST['info_title']; ?>" name="info_title">
                <input type="hidden" value="<?php echo $_POST['info_text']; ?>" name="info_text">
                <input type="hidden" value="<?php echo $_POST['info_new']; ?>" name="info_new">
                <input type="hidden" value="<?php echo $_POST['display']; ?>" name="display">
                <input type="hidden" value="<?php echo $image; ?>" name="info_img_path">
            </form>
        </div>
        
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
</body>
</html>
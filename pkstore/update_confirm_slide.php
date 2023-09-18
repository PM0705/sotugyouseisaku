<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スライド情報編集フォーム</title>
    <link rel="stylesheet" href="htmlstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
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
<main class="regist-page">
<h3>スライド情報編集フォーム</h3>
<div class="confirm slide-f">
        <p>スライドタイトル:
           <?php
           echo $_POST['slide_title'];
           ?>
        </p>
        <p>内容:
           <?php
           echo $_POST['slide_keyword'];
           ?>
        </p>
        <p>NEW:
           <?php
           
           if ($_POST['slide_new'] == 0) {
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
           echo$_FILES['slide_img_path']['name'];
           if (isset($_POST['slide_img_path'])){
            // $_FILES['inputで指定したname']['tmp_name']：一時保存ファイル名
                  $temp_file = $_FILES['slide_img_path']['tmp_name'];
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
        </p>
        <div class="form submit1">
            <form action="update_slide.php" method="post">
                <!-- <input type="submit" class="button1" value="前に戻る"> -->
                <button type="button" class="submit" value="前に戻る" onclick="history.back()">前に戻る</button>
            </form>
            <form action="update_complete_slide.php" method="post">
                <input type="submit" class="submit" value="更新する"href="update_complete.php<? $result['id'] ?>" name="btnSend">
                <input type="hidden" value="<?php echo $_POST['id']; ?>" name="id">
                <input type="hidden" value="<?php echo $_POST['slide_title']; ?>" name="slide_title">
                <input type="hidden" value="<?php echo $_POST['slide_keyword']; ?>" name="slide_keyword">
                <input type="hidden" value="<?php echo $_POST['slide_new']; ?>" name="slide_new">
                <input type="hidden" value="<?php echo $_POST['display']; ?>" name="display">
                <input type="hidden" value="<?php echo $image; ?>" name="slide_img_path">
            </form>
        </div> 
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
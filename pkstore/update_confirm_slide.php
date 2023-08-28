<?php
var_dump($_POST);
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スライド情報編集フォーム</title>
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body>
   
 <header>
    <div class="header-left">
        <a href="index.php"><img src="img/logo.png" alt="PKstoreのロゴ" class="img"></a>
        <img src="img/character.png" alt="PKstoreのキャラクター" class="img">
    </div>
    <div class="header-right">
        <a href="login.php">ログイン・会員登録はこちら</a>
        <ul>
<!-- ログインしていない -->
            <li><a href="pk_onlineshop.php">グッズ販売</a></li>
            <li><a href="sns.php">SNS</li>
            <li><a href="index.php">新着情報</li>
            <li><a href="store_info.php">店舗情報</a></li>
            <li><a href="mail.php">お問い合わせ</a></li>
        </ul>
    </div>
 </header>
 <main class="regist-page">
 <h3>スライド情報編集フォーム</h3>
 <div class="confirm">
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
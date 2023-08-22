<?php
var_dump($_POST);
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
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
 <h3>商品編集登録フォーム</h3>
 <div class="confirm">
        <p>アイテム名:
           <?php
           echo $_POST['item_name'];
           ?>
        </p>
        <p>値段:
           <?php
           echo $_POST['item_price'];
           ?>
        </p>
        <p>在庫:
           <?php
           echo $_POST['item_stock'];
           ?>
        </p>
        <p>キーワード:
           <?php
           echo $_POST['keyword'];
           ?>
        </p>
        <p>カテゴリー:
           <?php
           echo $_POST['category'];
           ?>
        </p>
        <p>NEW:
           <?php
           
           if ($_POST['new'] == 0) {
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
           error_reporting(0);
           if($_FILES['item_img_path']['name']){
            echo $_FILES['item_img_path']['name'];
            }
            ?>
        </p>
        <div class="form submit1">
        <form action="update_goods.php" method="post">
                    <!-- <input type="submit" class="button1" value="前に戻る"> -->
                    <button type="button" class="submit" value="前に戻る" onclick="history.back()">
                            前に戻る
                    </button>
                </form>
            <form action="update_complete_goods.php" method="post">
                <input type="submit" class="submit" value="更新する"href="update_complete.php<? $result['id'] ?>" name="btnSend">
                <input type="hidden" value="<?php echo $_POST['id']; ?>" name="id">
                <input type="hidden" value="<?php echo $_POST['item_name']; ?>" name="item_name">
                <input type="hidden" value="<?php echo $_POST['item_price']; ?>" name="item_price">
                <input type="hidden" value="<?php echo $_POST['item_stock']; ?>" name="item_stock">
                <input type="hidden" value="<?php echo $_POST['keyword']; ?>" name="keyword">
                <input type="hidden" value="<?php echo $_POST['category']; ?>" name="category">
                <input type="hidden" value="<?php echo $_POST['new']; ?>" name="new">
                <input type="hidden" value="<?php echo $_POST['display']; ?>" name="display">
                <input type="hidden" value="<?php echo $_POST['item_img_path']; ?>" name="item_img_path">

                  
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
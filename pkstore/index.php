<?php
//セッションの開始
session_start();
include 'vars.php'; 

?>
 <?php
//スライド情報
   //データベースへ接続
       $dsn = "mysql:dbname=pkstore77;host=localhost;charset=utf8mb4";
       $username = "pkstore77";
       $password = "root";
       $options = [];
       $pdo = new PDO($dsn, $username, $password, $options);
       $stmt = $pdo->query("SELECT * FROM slide  where display = '0'ORDER BY id DESC");
       $stmt_newinfo = $pdo->query("SELECT * FROM information where delete_flag = '0' AND display = '0' ORDER BY id DESC , info_new limit 4");
       $stmt_newgoods = $pdo->query("SELECT * FROM item_info_transaction where delete_flag = '0' AND new = '0' AND display = '0' ORDER BY  id DESC , new limit 4");
       $stmt_rank1 = $pdo->query("SELECT * FROM item_info_transaction where delete_flag = '0' AND display = '0' ORDER BY  buy_count DESC limit 1");
       $stmt_rank2 = $pdo->query("SELECT * FROM item_info_transaction where delete_flag = '0' AND display = '0' ORDER BY  buy_count DESC limit 1,1");
       $stmt_rank3 = $pdo->query("SELECT * FROM item_info_transaction where delete_flag = '0' AND display = '0' ORDER BY  buy_count DESC limit 2,1");
       $stmt_rank4 = $pdo->query("SELECT * FROM item_info_transaction where delete_flag = '0' AND display = '0' ORDER BY  buy_count DESC limit 3,1");
               //SQL文を実行して、結果を$stmtに代入する。
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="htmlstyle.css">
    
</head>
<body>
   
<header>
    <div class="header-left">
        <a href="index.php"><img src="img/pkstore.png" alt="PKstoreのロゴ" class="h-img"></a>
        <img src="img/PKlogo.png" alt="PKstoreのキャラクター" class="pkc">   
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
                <?php $message1 = $_SESSION['mail']."さんようこそ";?>
                <div class="message-text"><?php echo htmlspecialchars($message1, ENT_QUOTES); ?><a href="logout.php">(ログアウト)</a></div>
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

    <ul class="slider"><!--/slider-->
    <!-- ここでPHPのforeachを使って結果をループさせる -->
    <?php foreach ($stmt as $row): ?>
        <li> <img src="images_comp/<?php echo $row['slide_img_path']; ?>" alt="スライド" onclick="location.href='slide.php?id=<?php echo($row['id']) ?>'"></li>
    <?php endforeach; ?>
    </ul>

    <h3>NEW〜情報〜</h3>
    <div class="info">
    <?php foreach ($stmt_newinfo as $row): ?>
         <img src="images_comp/<?php echo $row['info_img_path']; ?>" alt="newinfo" onclick="location.href='news_info.php?id=<?php echo($row['id']) ?>'">
    <?php endforeach; ?>
    </div>

    <h3>NEW〜グッズ〜</h3>
    <div class="info">
    <?php foreach ($stmt_newgoods as $row): ?>
        <div class="relative">
            <img src="images_comp/<?php echo $row['item_img_path']; ?>" alt="newg" class="info-img" onclick="location.href='new-goods.php?id=<?php echo($row['id']) ?>'">
            <img src="img/newicon.png" alt="newicon" class="absolute">  
        </div>
    <?php endforeach; ?>
    </div>
    <h3 class="info toprank">人気売上ランキング</h3>
    <div class="info toprank">
        <?php foreach ($stmt_rank1 as $row): ?>
            <div class="relative">
                <img src="images_comp/<?php echo $row['item_img_path']; ?>" alt="newg" class="info-img" onclick="location.href='new-goods.php?id=<?php echo($row['id']) ?>'">
                <img src="img/1st.png" alt="newicon" class="absolute4">  
            </div>
        <?php endforeach; ?>
        <?php foreach ($stmt_rank2 as $row): ?>
            <div class="relative">
                <img src="images_comp/<?php echo $row['item_img_path']; ?>" alt="newg" class="info-img" onclick="location.href='new-goods.php?id=<?php echo($row['id']) ?>'">
                <img src="img/2nd.png" alt="newicon" class="absolute4">  
            </div>
        <?php endforeach; ?>
        <?php foreach ($stmt_rank3 as $row): ?>
            <div class="relative">
                <img src="images_comp/<?php echo $row['item_img_path']; ?>" alt="newg" class="info-img" onclick="location.href='new-goods.php?id=<?php echo($row['id']) ?>'">
                <img src="img/3rd.png" alt="newicon" class="absolute4">  
            </div>
        <?php endforeach; ?>
        <?php foreach ($stmt_rank4 as $row): ?>
            <div class="relative">
                <img src="images_comp/<?php echo $row['item_img_path']; ?>" alt="newg" class="info-img" onclick="location.href='new-goods.php?id=<?php echo($row['id']) ?>'">
                <img src="img/4th.png" alt="newicon" class="absolute4">  
            </div>
        <?php endforeach; ?>
    </div>
    <h3>店舗情報</h3>
    <div class="mapinfo">
        <div class="text-info">
            <p class="title">住所</p>
            <p class="add">〒164-8501<br>東京都○○区○○町○丁目○番○号</p>
            <p class="add2">TEL:000-0000-0000<br>営業時間:10:00~21:00</p>
        </div>
        <div class="googlemap">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3239.740446698844!2d139.661134012126!3d35.70800427246428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018f29092a6e253%3A0x936cd62aa3dafab6!2z44CSMTY0LTAwMDEg5p2x5Lqs6YO95Lit6YeO5Yy65Lit6YeO77yU5LiB55uu77yY4oiS77yY!5e0!3m2!1sja!2sjp!4v1691581831273!5m2!1sja!2sjp"
                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
        
</main>
<footer>
    <div class="footer-l">
        <img src="img/PKlogo.png" alt="PKstoreのロゴ" class="logo">
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
<?php
$dsn = "mysql:host=localhost; dbname=pkstore; charset=utf8";
$username = "root";
$password = "root";
$id = 14;

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
//⑦DBのファイル名を元に画像表示
$sql = "SELECT * FROM item_info_transaction WHERE id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();
$image = $stmt->fetch();
?>

<h1>画像表示</h1>
<img src="images/<?php echo $image['item_img_path']; ?>" width="300" height="300">

<?php
var_dump($_POST);
?>
<?php
$dsn = "mysql:host=localhost; dbname=pkstore; charset=utf8";
$username = "root";
$password = "root";

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

if (isset($_POST['item_img_path'])){
    // $_FILES['inputで指定したname']['tmp_name']：一時保存ファイル名
          $temp_file = $_FILES['item_img_path']['tmp_name'];
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
//⑥DBにはファイル名保存VALUESは取得した値
    $sql = "INSERT INTO item_info_transaction(item_img_path) VALUES (:item_img_path)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':item_img_path', $image, PDO::PARAM_STR);
    $stmt->execute();
}

?>
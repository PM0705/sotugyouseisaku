


<?php


function getPostValue($key)
{
    $value = ""; 
   if(isset($_POST[$key])){
        $value =  $_POST[$key];
    }  
   return $value;
}


?>

<!-- データベースに接続関数（サンプル） -->
<?php
// データベースに接続
function connectDB() {
    $param = 'mysql:dbname=my_image;host=localhost';
    try {
        $pdo = new PDO($param, 'root', 'root');
        return $pdo;

    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
?>



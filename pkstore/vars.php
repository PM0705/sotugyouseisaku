

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
<?php
function get_SessionValue($key)
{
    $value = ""; 
   if(isset($_SESSION[$key])){
        $value =  $_POST[$key];
    }  
   return $value;
}
?>
<?php
function total($key)
{
    $total = ""; 
   if(isset($value[$key])){
        $total =  $value[$key];
    }  
   return $total;
}
?>
<?php
function getResultValue($key)
{
    $value = ""; 
   if(isset($result[$key])){
        $value =  $result[$key];
    }  
   return $value;
}
?>
<?php
function incart($key)
{
    $cart_c = ""; 
   if(!empty($_SESSION[$key])){
        $cart_c =  $result[$key];
    }  
   return $cart_c;
}
?>


<!-- データベースに接続関数（サンプル） -->
<?php
// データベースに接続
function connectDB() {
    $param = 'mysql:dbname=pkstore;host=localhost';
    try {
        $pdo = new PDO($param, 'root', 'root');
        return $pdo;

    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}
?>


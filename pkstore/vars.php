


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


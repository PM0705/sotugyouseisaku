<?php
var_dump($_POST);
?>

<form action="upload.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="image">
    <button><input type="submit" name="upload" value="送信"></button>
</form>


<!-- regist_goods -->

<form method="post" action="upload.php" name="form" enctype="multipart/form-data">

        <input type="file" name="item_img_path">
                         
<!-- 送信ボタン -->
<button><input type="submit" name="item_img_path" value="送信"></button>
<input type="submit" class="submit" value="確認する" name="item_img_path">

        
</form>
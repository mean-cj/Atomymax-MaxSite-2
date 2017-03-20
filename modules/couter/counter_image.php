<?php
header("Content-type: image/png");
$img = ImageCreate(18, 25);
ImageColorAllocate($img, 0, 0, 0);  //กำหนดพื้นรูปเป็นสีดำ

$orange = ImageColorAllocate($img, 255, 128, 0);

/* ตัวแปร $num คือตัวแปรแบบโกลบอลที่ถูกแปลงมาจาก query string ซึ่งไฟล์ 
   counter.php ส่งมาให้ */
ImageChar($img, 5, 5, 5, $num, $orange);

ImagePNG($img);
ImageDestroy($img);
?>

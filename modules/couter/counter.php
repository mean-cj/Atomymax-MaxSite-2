<?php
$globals_test = @ini_get('register_globals');
if ( isset($globals_test) && empty($globals_test) ) {
$types_to_register = array('GET', 'POST', 'COOKIE', 'SESSION', 'SERVER');
foreach ($types_to_register as $type) {
$arr = @${'_' . $type};
if (@count($arr) > 0)
extract($arr, EXTR_SKIP);
}
}
//ถ้ายังไม่มีไฟล์ counter.txt ให้สร้างขึ้นมา โดยเก็บตัวเลข 0 ไว้
if (file_exists("modules/couter/counter.txt") == false) {
  $fp = fopen("modules/couter/counter.txt", "w");
  fputs($fp, 0);
  fclose($fp);
}

//เปิดไฟล์ counter.txt แล้วอ่านตัวอักษร 6 ตัวแรกมาเก็บไว้ที่ตัวแปร $pgcount
$fp = fopen("modules/couter/counter.txt", "r");
$pgcount = fgets($fp, 6);
fclose($fp);

++$pgcount;                      //เพิ่มค่าตัวแปร $pgcount ขึ้น 1
$pgcount = "00000" . $pgcount;   //เติม 00000 นำหน้า

//ตัดสตริงให้เหลือ 6 ตัวอักษร โดยเอาทางขวาของสตริงเป็นหลัก
$pgcount = substr($pgcount, -6);

//พิจารณาสตริง $pgcount ทีละตัวอักษร (ซึ่งก็คือตัวเลขแต่ละหลัก)
for ($i=0; $i<=strlen($pgcount)-1; $i++) {
  /* ใช้แอตทริบิวต์ src ของแท็ก <img> เรียกไปยังไฟล์ counter_image.php 
     โดยส่งผ่าน query string ไปให้ด้วย */
  echo "<img src=\"modules/couter/counter_image.php?num=$pgcount[$i]\">";
}

//เขียนค่าของตัวแปร $pgcount กลับลงสู่ไฟล์ counter.txt
$fp = fopen("modules/couter/counter.txt", "w");
fputs($fp, (int) $pgcount);
fclose($fp);
?>

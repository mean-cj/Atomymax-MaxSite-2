<?

// - - - - - - - - - - เริ่มการติดต่อฐานข้อมูล - - - - - - - - - - //

// กำหนดชื่อเซิร์ฟเวอร์ , ชื่อฐานข้อมูล , ชื่อผู้ใช้งาน  และ รหัสผ่าน สำหรับติดต่อกับฐานข้อมูล
$ServerName = "".DB_HOST."";
$DatabaseName = "".DB_NAME."";
$User = "".DB_USERNAME."";
$Password = "".DB_PASSWORD."";

$startdate = "".WEB_TIMESTART.""; // วันที่เริ่มต้นนับจำนวนสมาชิก
$time_delay = 600; // นับจำนวนเข้าชมขณะนี้ ในช่วงเวลา 10 นาที ( 600 วินาที )
		
// ติดต่อกับฐานข้อมูลผ่านฟังก์ชันของ MySQL
$Conn = mysql_connect($ServerName,$User,$Password) or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");
mysql_select_db($DatabaseName,$Conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");

?>

<?
empty($_GET['name'])?$name="":$name=$_GET['name'];
empty($_GET['file'])?$file="":$file=$_GET['file'];
empty($_SESSION['admin_user'])?$admin_user="":$admin_user=$_SESSION['admin_user'];
empty($_SESSION['admin_pwd'])?$admin_pwd="":$admin_pwd=$_SESSION['admin_pwd'];
empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];
// ( 1 ) ตั้งค่าต่างๆ ของ MySQL Server
	$host = "".DB_HOST."";
	$user = "".DB_USERNAME."";	
	$passwd = "".DB_PASSWORD."";
	$dbname = "".DB_NAME."";
	$tblname = "".TB_ALUMNUS."";

// ( 2 ) Admin Password ไว้ลบ

	$admin_uid = "".$admin_user."";
	$admin_pwd = "".$admin_pwd."";

// ( 3 ) ตั้งค่าจำนวนการแสดงผล
	$list_page = 10;

// ( 4 ) กำหนดขนาดของภาพที่อนุญาตให้ upload ได้ (หน่วยเป็น byte)
	$Image_size = 51200;	// 10240 = 10 kbytes
    $Image_msg = " 50 kb ";
	$imgWidth = 120; //ขนาดความกว้างของรูป ที่สามารถส่งได้ไม่เกิน...

// ( 5 ) Path เก็บรูปสมาชิก
	$path = "icon"; # ตั้งค่า directory ที่เก็บรูปที่ post ลงในเว็บ

// ( 6 ) อีเมลล์ของเว็บมาสเตอร์
	$webmaster_email = "".WEB_EMAIL."";

// ( 7 ) ชื่อเว็บ
	$urlweb = "".WEB_URL.""; 

// ( 8 ) สีของตาราง
	$rowColor1 = "#FDEAFB"; //สีตาราง 1
	$rowColor2 = "#F0F0F0"; //สีตาราง 2 จะสลับกับ สีตาราง 1



?>
<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net

// ถ้าไม่ระบุปีในการค้นหา
if(isset($check_year) and $check_year =="no") {
$year = "" ;
}
if(empty($year) and (isset($check_year) and $check_year=="yes")) {
$year = 0 ;
}

// ค่าเริ่มต้นให้เรียงลำดับสมาชิกจากลำดับล่าสุด
if(empty($level)) {
$level = "id_desc" ;
}

// หาจำนวนสมาชิกทั้งหมด
$check_m = mysql_query("select * from ".TB_MEMBER."") ;
$member_all = mysql_num_rows($check_m) ;

// กำหนดค่าเริ่มต้นต่างๆ เพื่อแบ่งเพจ
if(empty($search)) {
$result2 = mysql_query("select * from ".TB_MEMBER."") ;
$rows2 = mysql_num_rows($result2) ;
}
if((empty($check_year) or $check_year=="no") and isset($search)) {
$result2 = mysql_query("select * from ".TB_MEMBER." where date='$date' and month='$month' ") ;
$rows2 = mysql_num_rows($result2) ;
}
if(isset($check_year) and ($check_year=="yes")) {
$result2 = mysql_query("select * from ".TB_MEMBER." where date='$date' and month='$month' and year='$year' ") ;
$rows2 = mysql_num_rows($result2) ;
}

// จำนวน pagesize หรือจำนวนสมาิชิก ได้ถูกกำหนดไว้แล้วที่ไฟล์ config.inc.php ในตัวแปร $member_num_show_last 
$totalpage = (int)($rows2/$member_num_last) ;
if(($rows2%$member_num_last) !=0) {
$totalpage+=1 ;
}
if(isset($page)) {
$start = $member_num_show_last * ($page-1) ;
}
else {
$start = 0 ;
$page = 1 ;
}


// เข้าสู่การเช็คค่าต่างๆ แบบแบ่งจำนวนสมาชิกขึ้นมาโชว์ตามที่กำหนด
if(empty($search)) { // ถ้าไม่ได้ค้นหาตาม วัน เดือน ปี
// ถ้าเลือกให้แสดงสมาชิกคนแรกก่อน
if($level=="normal") {
$result = mysql_query("select * from member limit $start ,$member_num_last") ;
}
if($level=="id_desc") {
$result = mysql_query("select * from member order by id desc limit $start , $member_num_last") ;
}
}
else { 

##// ถ้าเกิดเข้าสู่การค้นหา //##

// ถ้าไม่เลือกปีในการค้นหา
if((empty($check_year) or $check_year=="no") and isset($search)) {
$result = mysql_query("select * from member where date='$date' and month='$month' ") ;
$rows = mysql_num_rows($result) ;
}
// ถ้าเลือกปีในการค้นหา
if(isset($check_year) and ($check_year=="yes")) {
$result = mysql_query("select * from member where date='$date' and month='$month' and year='$year' ") ;
$rows = mysql_num_rows($result) ;
}
} // จบ else ถ้ามีการค้นหา

// ถ้าไม่มีการค้นหา คือค่าเริ่มต้น ให้บอกจำนวนสมาชิกทั้งหมด
//if(empty($search)) {
//echo "<center><font size='2'><b>5 สมาชิกล่าสุดจาก $member_all ท่าน</b><font></center>" ;
//}
// ถ้ามีการค้นหา ให้แสดงขผลลัพท์ในการค้นหาแทน
//if(isset($search)) {
//echo "<center><font size='2' face='MS Sans Serif' color='red'><b>สมาชิกที่เกิดวันที่ $date/$month/$year มีจำนวนทั้งสิ้น $rows  คน</b></font></center>" ;
//echo "" ;
//}

while($dbarr = mysql_fetch_array($result)) {

?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><br><center>
		  <font size="2"><?=_MEMBER_MOD_FORM_LASTMEM_LAST;?> <strong><?php echo $dbarr['user'] ; ?></strong></font></td>
          </center></td>
        </tr>
      </table>
        <?php 
}

?>
</p>

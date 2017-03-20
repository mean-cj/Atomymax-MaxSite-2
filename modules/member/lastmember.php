<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

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
$totalpage = (int)($rows2/$member_num_show_last) ;
if(($rows2%$member_num_show_last) !=0) {
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
$result = mysql_query("select * from ".TB_MEMBER." limit $start ,$member_num_show_last") ;
}
if($level=="id_desc") {
$result = mysql_query("select * from ".TB_MEMBER." order by id desc limit $start , $member_num_show_last") ;
}
}
else { 

##// ถ้าเกิดเข้าสู่การค้นหา //##

// ถ้าไม่เลือกปีในการค้นหา
if((empty($check_year) or $check_year=="no") and isset($search)) {
$result = mysql_query("select * from ".TB_MEMBER." where date='$date' and month='$month' ") ;
$rows = mysql_num_rows($result) ;
}
// ถ้าเลือกปีในการค้นหา
if(isset($check_year) and ($check_year=="yes")) {
$result = mysql_query("select * from ".TB_MEMBER." where date='$date' and month='$month' and year='$year' ") ;
$rows = mysql_num_rows($result) ;
}
} // จบ else ถ้ามีการค้นหา

// ถ้าไม่มีการค้นหา คือค่าเริ่มต้น ให้บอกจำนวนสมาชิกทั้งหมด
if(empty($search)) {
echo "<center><font size='2'><b>"._MEMBER_MOD_FORM_LASTMEM_TITLE." $member_all "._MEMBER_MOD_FORM_LASTMEM_TITLE2."</b><font></center>" ;
}
// ถ้ามีการค้นหา ให้แสดงขผลลัพท์ในการค้นหาแทน
if(isset($search)) {
echo "<center><font size='2' face='MS Sans Serif' color='red'><b>"._MEMBER_MOD_FORM_LASTMEM_BIRTH." $date/$month/$year "._MEMBER_MOD_FORM_LASTMEM_BIRTH1." $rows  "._MEMBER_MOD_FORM_LASTMEM_BIRTH2."</b></font></center>" ;
echo "" ;
}

echo "" ;

while($dbarr = mysql_fetch_array($result)) {

?>
<br>      
<table width="90%"  border="0" cellspacing="0" cellpadding="0">
	  <TR>
            <TD height="1" class="dotline"></TD>
  </TR>
        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="2">
            <tr>
              <td width="50" align="right"><strong><font size="2">user : </font></strong></td>
              <td><font size="2"><?php echo $dbarr['user'] ; ?></font></td>
            </tr>
            <tr>
              <td width="50" align="right"><strong><font size="2"><?=_ALUM_TABLE_COL3;?> : </font></strong></td>
              <td><font size="2"><?php echo $dbarr['sex'] ; ?></font></td>
            </tr>
          </table></td>
        </tr>
		<TR>
            <TD height="1" class="dotline"></TD>
        </TR>
      </table>
        <?php 
}

?>
</p>

<?php
#### สคริ๊ปนี้ใช้ในการเช็ค ว่าล็อกอินหรือยัง ให้นำสคริ๊ปนี้ไปไว้ที่หน้าที่คุณต้องการให้เช็ค ####
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net

if(!$login_true){
$showmsg="<br><br><center><font size='3' face='MS Sans Serif'><b>"._MEMBER_MOD_CHECK_NOACC."";
	showerror($showmsg);
echo "<meta http-equiv='refresh' content='3;url=?name=member'>";
} else { // ให้ใส่เนื้อหาที่ต้องการต่อจากอันนี้


} //ใส่โค้ดข้างหน้านี้คร่อมเนื้อหาที่ต้องการจำกัดการแสดงเฉพาะสมาชิก
### จบการเช็ค ###
?>


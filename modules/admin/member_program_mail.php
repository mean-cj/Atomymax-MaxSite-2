
<table width="820"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top ><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<img src="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
        <TR>
          <TD><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <a href="?name=admin&file=member"><?=_ADMIN_MEMBER_MENU_TITLE;?></a> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <a href="?name=admin&file=member_mail"><?=_ADMIN_MEMBER_MENU_MAILTO_MEM;?></a></B><br>
<?php

// กำหนด วันเวลา ปัจจุบัน ที่ต้องส่งเมล์
$date = date("d") ;
$month = date("m") ;
$admin_email="".WEB_EMAIL."";
$click=$_POST['click'];
//$click2=$_POST['click2']

if(isset($click)and $click=="click") {
include("member_function.php") ;
}
else {
echo "<meta http-equiv='refresh' content='0; url=?name=admin&file=member_mail'>" ;
exit() ;
}
//mysql_query("set NAMES tis620");	//เลือกภาษาไทย


empty($_POST['edit'])?$edit="":$edit=$_POST['edit'];
empty($_POST['sendmail'])?$sendmail="":$sendmail=$_POST['sendmail'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$form_mail=$_POST['form_mail'];
$up=$_POST['up'];

if (empty($_POST['tt'])){

if($sendmail <>'') { // ถ้าส่งเมล์
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$result = mysql_query("select * from ".TB_MAIL."") ;
$row = mysql_num_rows($result) ;
$dbarr = mysql_fetch_array($result) ;
$ids=$dbarr['id'];
if($row == 0) { // ตรวจสอบว่ามีข้อความหรือยัง ถ้าไม่มีให้กรอกบันทึกลงฐานข้อมูล
echo "<center><font size='3' face='MS Sans Serif'>"._ADMIN_MEMBER_PROGRAM_SENDMAIL_NO_MESS."</font></center>" ;
form_edit() ; // แสดงฟอร์มจากฟังก์ชั่น
}
else {
if(empty($edit) and isset($sendmail)) {
sendemail($sendmail);
}
}
}


if(isset($edit) and empty($sendmail) ) {
echo "<center><font size='3' face='MS Sans Serif'>"._ADMIN_MEMBER_PROGRAM_SENDMAIL_SAVE."</font></center>" ;
form_edit() ;
}
 if(isset($subject) and isset($message)and isset($form_mail) ) {
checkmessage($subject,$message,$form_mail) ;
 }

} else {
	$subject_total=$_POST['subject_total'];
	$message_total=$_POST['message_total'];

// ถ้าส่งเมล์หาสมาชิกทั้งหมด
if(isset($subject_total) and isset($message_total)) {
sendmail_total($subject_total,$message_total) ;
}
}
?>
</td>
</tr>
</table>
</TD>
</TR>
</TABLE>

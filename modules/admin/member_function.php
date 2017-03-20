<?php 
$date = date("j") ;
$month = date("n") ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$admin_email="".WEB_EMAIL."";
//mysql_select_db($db) ;
//mysql_query("set NAMES tis620");	//เลือกภาษาไทย

function form_edit() { // ฟังก์ชั่นแบบฟอร์ในการบันทึกข้อความใหม่ 

$sql = "select * from ".TB_MAIL." " ;
$result = mysql_query($sql) ;
$row = mysql_num_rows($result) ;
$dbarr = mysql_fetch_array($result) ;

 ?>
              <form name="form1" method="post" action="?name=admin&file=member_program_mail">
                <table width="450" border="0" align="center" cellpadding="3" cellspacing="0" class="grids">
                  <tr class="odd">
                    <td colspan="2" ><div align="center"><strong>&nbsp;<?=_ADMIN_MEMBER_FUNCTION_MAIL_BIRTDAY_TITLE;?></strong></font></div></td>
                  </tr>
                  <tr >
                    <td> <?=_ADMIN_MEMBER_FUNCTION_MAIL_TOPIC;?></font></td>
                    <td>
                      <input name="subject" type="text" size="50" maxlength="150" value="<?=$dbarr['subject'];?>">
                    </td>
                  </tr>
                  <tr>
                    <td ><?=_ADMIN_MEMBER_FUNCTION_MAIL_MESSAGE;?></font></td>
                    <td > 
                      <textarea name="message" cols="50" rows="10" id="message"><?=$dbarr['detail'];?></textarea>
                    </font></td>
                  </tr>
                  <tr >
                    <td> from</font></td>
                    <td>
                      <input name="form_mail" type="text" size="50" maxlength="150" id="form_mail" value="<?=$dbarr['form_mail'];?>">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" ><div align="center">

                        <input name="submit" type="submit" id="submit" value="<?=_ADMIN_MEMBER_FUNCTION_MAIL_BUTTON_EDIT;?>">
&nbsp;
                <input name="clear" type="reset" id="clear" value= "<?=_ADMIN_BUTTON_CLEAR;?>">
                <input name="click" type="hidden" id="click" value="click">
                <input name="up" type="hidden" id="up" value="<?=$dbarr['id'];?>">
                    </div></td>
                  </tr>
                </table>
            </form>

  <?php
 }  // จบฟังก์ชั่นแบบฟอร์ม

$subject=$_POST['subject'];
$message=$_POST['message'];
$form_mail=$_POST['form_mail'];
$up=$_POST['up'];

function checkmessage($subject,$message,$form_mail) { //function บันทึกข้อความใหม่ หรือ แก้ไข
if(isset($message) and isset($subject) and isset($form_mail) ) {
$message = htmlspecialchars($message) ;
$message = nl2br($message) ;

$result = mysql_query("select count(id) from ".TB_MAIL."") ;
$count = mysql_num_rows($result) ;
if($count==0) {
$result = mysql_query("insert into ".TB_MAIL." (subject,form_mail,detail) values ('$subject','$form_mail','$message')") ;
//$results= mysql_result($result) ;
if($result) {
echo "<meta http-equiv='refresh' content='0; url=?name=admin&file=member&file=member_mail'>" ;
echo "";
}
else {
echo ""._ADMIN_MEMBER_FUNCTION_SENDMAIL_MESS_ERROR."" ;
echo "<meta http-equiv='refresh' content='3; url=?name=admin&file=member&file=member_mail'>" ;
}
} // จบการตรวจสอบ ถ้ายังไม่มีข้อความ
else { // ถ้าเกิดมีข้อความในฐานข้อมูลแล้ว แต่ต้องการเปลี่ยนใหม่ หรือแก้ไข
//$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$result = mysql_query("update ".TB_MAIL." set form_mail='$form_mail',subject='$subject',detail='$message' ") ;
//$results= mysql_result($result) ;
if($result) {
echo "<meta http-equiv='refresh' content='0; url=?name=admin&file=member&file=member_mail'>" ;
echo "<br>";
}
} // จบถ้ามีข้อความอยุ่แล้ว

} // จบถ้ามีข้อความ

}// จบ function บันทึกข้อความ

// ส่งเมล์อวยพรวันเำกิด 
function sendemail($sendmail) { 
$date = date("j") ;
$month = date("n") ;
$from = "".WEB_EMAIL."" ;

$result_mailx = mysql_query("select * from ".TB_MAIL."") or die ("Err program") ;
$mail_arrx = mysql_fetch_array($result_mailx) ;

$subject = $mail_arrx['subject'] ;
$messaged = $mail_arrx['detail'] ;
$messaged = preg_replace("/<br \>/i","",$messaged) ;
$messagex = "
<html>
<title>".$subject."</title>
<body>
<table>
<tr><td><br>".$messaged."</td></tr>
</table>
</body>
</html>
" ;

$resultx = mysql_query("select * from ".TB_MEMBER." where date='$date' and month='$month'") or die ("Err Program") ;
$numx = mysql_num_rows($resultx) ;
if($numx==0) {
echo "<center><b>"._ADMIN_MEMBER_FUNCTION_SENDMAIL_NO_BIRTDAY."</b>" ;
echo "<meta http-equiv='refresh' content='3; url=?name=admin&file=member&file=member_mail'>" ;
}
else {
require_once("includes/mimemail.inc.php");
 $mail = new MIMEMAIL("HTML"); // ส่งแบบ HTML  
 $mail->senderName = "admin"; // ชื่อผู้ส่ง  
 $mail->senderMail = "".WEB_EMAIL.""; // อีเมลล์ผู้ส่ง  
 //$mail->bcc = $email; // ส่งแบบ bind carbon copy  
 $mail->subject =$subject; // หัวข้ออีเมลล์  
 $mail->body = $messagex;   // ข้อความ หรือ HTML ก็ได้  
// $mail->attachment[] = "path_to_file1/filename1"; // ระบุตำแหน่งไฟล์ที่จะแนบ  
 $mail->create();  
// $mail->send("".$email.""); // เมลล์ผู้รับ  
//$mail->send("".$email."");

while($dbarrx = mysql_fetch_array($resultx)) {
$email_member = $dbarrx['email'] ;
$mail->send("".$email_member."");
}
if($send) {
echo "<center><b>"._ADMIN_MEMBER_FUNCTION_SENDMAIL_OK."</b></font></center>" ;
echo "<center><a href='?name=admin&file=member&file=member_mail'><b>"._ADMIN_MEMBER_FUNCTION_SENDMAIL_GOBACK."</b></font></a></center>" ;
}
else {
echo "<center><b>"._ADMIN_MEMBER_FUNCTION_SENDMAIL_NOSEND."</b></font></center>" ;
echo "<meta http-equiv='refresh' content='3; url=?name=admin&file=member&file=member_mail'>" ;
}
}
}

function sendmail_total($subject_total ,$message_total) {
$subject_total= $_POST['subject_total'] ;
$message_total = $_POST['message_total'] ;
$result = mysql_query("select email from ".TB_MEMBER."") ;
require_once("includes/mimemail.inc.php");
 $mail = new MIMEMAIL("HTML"); // ส่งแบบ HTML  
 $mail->senderName = "admin"; // ชื่อผู้ส่ง  
 $mail->senderMail = "".WEB_EMAIL.""; // อีเมลล์ผู้ส่ง  
 //$mail->bcc = $email; // ส่งแบบ bind carbon copy  
 $mail->subject =$subject_total; // หัวข้ออีเมลล์  
 $mail->body = $message_total;   // ข้อความ หรือ HTML ก็ได้  
// $mail->attachment[] = "path_to_file1/filename1"; // ระบุตำแหน่งไฟล์ที่จะแนบ  
 $mail->create();  
// $mail->send("".$email.""); // เมลล์ผู้รับ  
//$mail->send("".$email."");

while($dbarr = mysql_fetch_array($result)) {
$user_mail=$dbarr['email'];
$mail->send("".$user_mail."");
}

if($send) {
echo "<center><b>"._ADMIN_MEMBER_FUNCTION_SENDMAIL_ALL_OK."</b></font></center>" ;
echo "<meta http-equiv='refresh' content='2;url=?name=admin&file=member&file=member_mail'>" ;
//exit() ;
}
else {
$showmsg ="<center><b>"._ADMIN_MEMBER_FUNCTION_SENDMAIL_ALL_NO."</b></font>
<input type='button' value='"._ADMIN_MEMBER_MESSAGE_NO_DEL_GOBACK."' onclick='history.back();'></center>" ;
	showerror($showmsg);
}
}

 ?>



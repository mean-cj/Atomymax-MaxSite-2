<?php
#### สคริ๊ปนี้ใช้ในการเช็ค ว่าล็อกอินหรือยัง ให้นำสคริ๊ปนี้ไปไว้ที่หน้าที่คุณต้องการให้เช็ค ####
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net

CheckAdmin($admin_user, $admin_pwd);

	if(CheckLevel($admin_user,"member_edit")){
?>

	<TABLE cellSpacing=0 cellPadding=0 width=650 border=0>
      <TBODY>
        <TR><td>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="650" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
		<?php 
require("includes/class.resizepic.php");
if($_GET['op'] == ""){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net
//echo $_POST['PASSWORD'];

$member_id=$_POST['member_id'];
$username=$_POST['USERNAME'];
$password=$_POST['PASSWORD'];
$oldpass=$_POST['oldpass'];
$nic_name=$_POST['nic_name'];
$name=$_POST['name'];
$age=$_POST['age'];
$province=$_POST['province'];
$email=$_POST['email'];
$date=$_POST['date'];
$month=$_POST['month'];
$year=$_POST['year'];
$office=$_POST['office'];
$sex=$_POST['sex'];
$amper=$_POST['amper'];
$education=$_POST['education'];
$work=$_POST['work'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$zipcode=$_POST['zipcode'];
$member_pic=$_POST['member_pic'];
$signature=$_POST['signature'];
// ถ้ากรอกอีเมล์ไม่ถูกต้อง
if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)$/i",$email)){
$showmsg="<br><br><center><font size='3' face='MS Sans Serif'><b>"._MEMBER_MOD_CHEMAIL_CONF."</b></font><br><br><input type='button' value='"._MEMBER_MOD_FORM_JAVA_RETERN."' onclick='history.back();'></center>" ;
	showerror($showmsg);
}

			if($_POST['PASSWORD']){
				$NewPass = md5($_POST['PASSWORD']);
			}else{
				$NewPass = $_POST['oldpass'];
			}

	//Check Pic Size
	$FILE = $_FILES['FILE'];
	$size = getimagesize($FILE['tmp_name']);
	$sizezz=$size[0]*$size[1];
	$widths = $size[0];
	$heights = $size[1];
	//แปลงนามสกุล และทำการ upload
	if ( empty($FILE['tmp_name']))
			{$Filenames = $member_pic ;} 
			else {

	if ( $FILE['size'] > _MEMBER_LIMIT_UPLOAD ) {
	$showmsg="<br><br><center><font size='3' face='MS Sans Serif'><b>"._MEMBER_MOD_FORM_PIC_NOWIDTH." ".(_MEMBER_LIMIT_UPLOAD/1024)." kB "._MEMBER_MOD_FORM_PIC_NOWIDTH1."</b></font><br><br>
	<input type='button' value='"._MEMBER_MOD_FORM_JAVA_RETERN."' onclick='history.back();'></center>" ;
	showerror($showmsg);
	echo "<meta http-equiv='refresh' content='2; url=?name=admin&file=member'>" ;
	exit();
	} 

if (($FILE['type']=='image/jpg') || ($FILE['type']=='image/jpeg') || ($FILE['type']=='image/pjpeg') || ($FILE['type']=='image/JPG') || ($FILE['type']=='image/gif') || ($FILE['type']=='image/x-png') || ($FILE['type']=='image/png')){
//$sqlnew="select * from ".TB_MEMBER." where member_id='$member_id'";
//$result=mysql_db_query($db,$sqlnew);
$resmember = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE member_id='$member_id' ");

while ($r=mysql_fetch_array($resmember)) {
	$image=$r[member_pic];
	if ($image) {
	if (file_exists("icon/$image")) {
	unlink("icon/$image");
	} 
	
	}
}

	if ($widths > _MEMBER_LIMIT_PICWIDTH) {
		$images = $FILE["tmp_name"];
		$new_images = "members_".TIMESTAMP."_".$FILE["name"];
		@copy($FILE["tmp_name"],"icon/members_".TIMESTAMP."_".$FILE["name"]);
		$original_image = "icon/members_".TIMESTAMP."_".$FILE["name"]."";
		$width=_MEMBER_LIMIT_PICWIDTH; 
//		$size=GetimageSize($images);
		$im=$widths/$width;
		$imheight=$heights/$im;
		$image = new hft_image($original_image);
		$image->resize($width,$imheight,  '0');
		if (($FILE['type']=='image/jpg') || ($FILE['type']=='image/jpeg') || ($FILE['type']=='image/pjpeg') || ($FILE['type']=='image/JPG')){
		$image->output_resized("icon/members_".TIMESTAMP."_".$FILE["name"]."", "JPG");
		}
		if (($FILE['type']=='image/gif')){
		$image->output_resized("icon/members_".TIMESTAMP."_".$FILE["name"]."", "GIF");
		}
		if (($FILE['type']=='image/x-png')|| ($FILE['type']=='image/png')){
		$image->output_resized("icon/members_".TIMESTAMP."_".$FILE["name"]."", "PNG");
		}
		$Filenames="members_".TIMESTAMP."_".$FILE["name"]."";
} else {
@copy ($FILE['tmp_name'] , "icon/members_".TIMESTAMP."_".$FILE["name"] );
$Filenames="members_".TIMESTAMP."_".$FILE["name"]."";
}
	} else {
			echo "<script language='javascript'>" ;
			echo "alert('"._MEMBER_MOD_FORM_JAVA_TYPE_PIC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.go(-1)</script>";
			exit();
	}
}


$signup = date("j/n/").(date("Y")+543) ;
$textshow = htmlspecialchars($textshow) ;
$name = htmlspecialchars($name) ;
$address = htmlspecialchars($address) ;
$zipcode = htmlspecialchars($zipcode) ;
$phone = htmlspecialchars($phone) ;

	    $sql[0] = "update ".TB_MEMBER." set name='$name' where member_id='$member_id' ";
		
		$sql[1]= "update ".TB_MEMBER." set sex='$sex' where member_id='$member_id' ";
		
		$sql[2] = "update ".TB_MEMBER." set date='$date' where member_id='$member_id' ";
       
        $sql[3] = "update ".TB_MEMBER." set month='$month' where member_id='$member_id' ";
               
        $sql[4] = "update ".TB_MEMBER." set year='$year' where member_id='$member_id' ";
      
		$sql[5] = "update ".TB_MEMBER." set work='$work' where member_id='$member_id'";
	
		$sql[6] = "update ".TB_MEMBER." set age='$age' where member_id='$member_id' ";
	
		$sql[7] = "update ".TB_MEMBER." set email='$email' where member_id='$member_id' ";
	
		$sql[8] = "update ".TB_MEMBER." set address='$address' where member_id='$member_id' ";
	
		$sql[9] = "update ".TB_MEMBER." set amper='$amper' where member_id='$member_id' ";
		
		$sql[10] = "update ".TB_MEMBER." set province='$province' where member_id='$member_id' ";
	
	    $sql[11] = "update ".TB_MEMBER." set zipcode ='$zipcode' where member_id='$member_id' ";

		$sql[12] = "update ".TB_MEMBER." set phone='$phone' where member_id='$member_id' ";
	
		$sql[13] = "update ".TB_MEMBER." set education='$education' where member_id='$member_id' ";
		
	   $sql[14] = "update ".TB_MEMBER." set work='$work' where member_id='$member_id' ";
	   
	   $sql[15] = "update ".TB_MEMBER." set member_pic='$Filenames' where member_id='$member_id' ";

  	   $sql[16] = "update ".TB_MEMBER." set office='$office' where member_id='$member_id' ";

	   $sql[17] = "update ".TB_MEMBER." set signature='$signature' where member_id='$member_id' ";

	   $sql[18] = "update ".TB_MEMBER." set nic_name='$nic_name' where member_id='$member_id' ";

	   $sql[19] = "update ".TB_MEMBER." set user='$username' where member_id='$member_id' ";

	   $sql[20] = "update ".TB_MEMBER." set password='".$NewPass."' where member_id='$member_id' ";

       for($i=0;$i<21;$i++) {
      $result = mysql_query($sql[$i])  ;
       }

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$MemResult = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$username."' ");
$EditMem= $db->fetch($MemResult);
$level=$EditMem['level'];

if ($EditMem){
			$db->update_db(TB_ADMIN,array(
				"username"=>"".$username."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['name']."",
				"email"=>"".$_POST['email']."",
				"picture"=>"".$Filenames."",
				"level"=>"".$level.""
			)," username='".$_POST['USERNAME_OLD']."' ");
			if($admin_user==$username){
			$URLre = "?name=admin&logout";
			session_unset();
			session_destroy();
			} else {
			$URLrx = "?name=admin&file=member";
			}
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_USER_MESSAGE_EDIT."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"".$URLre."\"><B>"._ADMIN_USER_MESSAGE_CHPASS_GOBACK."</B></A><br><br>";
			$ProcessOutput .= "<A HREF=\"".$URLrx."\"><B>"._ADMIN_USER_MESSAGE_CHPASS_USER."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
			echo $ProcessOutput ;
} else {
			$URLre = "?name=admin&file=member";
echo "<br><br><center><font size=\"3\" face='MS Sans Serif'><b>"._MEMBER_MOD_EDIT_ACCESS."</b></font></center>" ;
echo "<meta http-equiv='refresh' content='2; url=$URLre'>" ;
}
}

}
?>

		  </TD>
      </TR>
    </TABLE>
	</TD>
  </TR>
</TABLE>

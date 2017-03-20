 &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_alumnus.png" BORDER="0">
 <table width="750" align=center cellSpacing=0 cellPadding=0 border=0><tr><TD height="1" class="dotline" colspan="4"></TD></tr></table>
 <br>
<?
if (!empty($_SESSION['admin_user'])){
include("modules/alumnus/config.inc.php");

 // รับค่าตัวแปรมา
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$nic_name = $_POST['nic_name'];
	$age = $_POST['age'];
	$email = $_POST['email'];
	$website = $_POST['website'];
	$school = $_POST['school'];
	$work = $_POST['work'];
	$hobby = $_POST['hobby'];
	$comment = $_POST['comment'];
	$icq = $_POST['icq'];
	$msn = $_POST['msn'];
	$yahoo = $_POST['yahoo'];
	$qq = $_POST['qq'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$sex = $_POST['sex'];
	$province = $_POST['province'];
	$icons = $_POST['icon'];
	$icon=substr($icons,24);
	//if(empty($iconx)){$icon="1.gif";} else { $con=$iconx;}
	$emo = $_POST['emo'];
	empty($_POST['cam'])?$cam="0":$cam=$_POST['cam'];
	empty($_POST['mic'])?$mic="0":$mic=$_POST['mic'];
	$phone= $_POST['phone'];
	$address = $_POST['address'];
	$amper= $_POST['amper'];
	$zipcode= $_POST['zipcode'];
	$pic= $_POST['pic'];
	$numid=$_POST['numid'];
	$yearfin=$_POST['yearfin'];
	// ป้องกันการแทรก html กับ ละเครื่องหมาย ' "
	$first_name = trim(htmlspecialchars($first_name));
	$last_name = trim(htmlspecialchars($last_name));
	$nic_name = trim(htmlspecialchars($nic_name));
	$age = trim(htmlspecialchars($age));
	$email = trim(htmlspecialchars($email));
	$website = trim(htmlspecialchars($website));
	$school = trim(htmlspecialchars($school));
	$work = trim(htmlspecialchars($work));
	$hobby = trim(htmlspecialchars($hobby));
	$comment = trim(htmlspecialchars($comment));
	$icq = trim(htmlspecialchars($icq));
	$msn = trim(htmlspecialchars($msn));
	$yahoo = trim(htmlspecialchars($yahoo));
	$qq = trim(htmlspecialchars($qq));

 if($login_true || $admin_user){
} else {
if(USE_CAPCHA){
check_captcha($_POST['security_code']);
}
}
if($first_name=="" || $last_name=="" ||$nic_name=="" || $sex=="" ||$age=="" || $numid=='' || $yearfin==''|| $province=="" ||$email=="") {
$showmsg="<br><br><center><font size='3' face='MS Sans Serif'><b>"._MEMBER_MOD_FORM_JAVA_DATA_NOT."</b></font><br><br>
<input type='button' value='"._MEMBER_MOD_FORM_JAVA_RETERN."' onclick='history.back();'></center>" ;
	showerror($showmsg);
			exit();
}  
	// ป้องกันคำหยาบของ Comment
	$comment = CheckRude($comment);

	// แปลง วัน/เดือน/ปีเกิด
	$birthday = "$day/$month/$year";
	$MPics = $_FILES['MPic'];

//	echo $MPics['name'];	
	// ตรวจสอบความกว้างของรูป
		if ( empty($MPics['tmp_name'])){
				$filenames=$pic;
			}else{ 
			$size = getimagesize($MPics['tmp_name']);
				if($size[0] > _ALUMNUS_LIMIT_PICWIDTH) { //ถ้าความกว้างมากกว่า 100 pixels (แก้ไขได้ที่ config)
					echo "<br><br><center><font size=3><b>"._ALUM_MOD_SAVE_MPIC_WIDTH1." "._ALUMNUS_LIMIT_PICWIDTH." pixels  "._ALUM_MOD_SAVE_MPIC_WIDTH2." ".$size[0]." pixels "._ALUM_MOD_SAVE_MPIC_WIDTH3."<br><br><a href='javascript:history.back(1)'>[ "._JAVA_FORM_BACK_EDIT." ]</a></b></font></center>";
					exit();
				}


	// ตรวจสอบขนาดของรูป
		if($MPics['size']>_ALUMNUS_LIMIT_UPLOAD) {
				echo "<br><b><center><font size=3 color=red >"._ALUM_MOD_SAVE_MPIC_LIMIT1." ".(_ALUMNUS_LIMIT_UPLOAD)." bytes ["._ALUM_MOD_SAVE_MPIC_LIMIT2." ".$MPics['size']." bytes]</font></center></b><br>";
				echo "<br><b><center><font size=3 color=red >[&nbsp;<a href='javascript:history.back(1)'>"._JAVA_FORM_BACK_EDIT."</a>&nbsp;]</font></center></b>";
				exit();
			}
if (($MPics['type']=='image/jpg') || ($MPics['type']=='image/jpeg') || ($MPics['type']=='image/pjpeg') || ($MPics['type']=='image/JPG') || ($MPics['type']=='image/gif') || ($MPics['type']=='image/x-png')|| ($MPics['type']=='image/png') ){
	// ตั้งชื่อรูปภาพ
			$ppdate = date('Ymd');
			$pmdate = date('His');
			$QPic_name = "$ppdate"."_"."$pmdate";

	// แปลงนามสกุล และทำการ upload
	if ( $MPics['type'] == "image/gif" )
		{
			$filename = $QPic_name.".gif";
		}
	else if ( $MPics['type'] == "image/bmp" )
		{
			$filename = $QPic_name.".bmp";
		}
	elseif (($MPics['type']=="image/jpg")||($MPics['type']=="image/jpeg")||($MPics['type']=="image/pjpeg"))
		{
			$filename = $QPic_name.".jpg";
		}
	elseif (($MPics['type']=="image/png")||($MPics['type']=="image/x-png"))
		{
			$filename = $QPic_name.".png";
		}

			@copy ($MPics['tmp_name'] , "icon/aln_".$filename."" );
			$filenames="aln_".$filename."";
			
	} else {
	$showmsg="<br><br><center><font size='3' face='MS Sans Serif'><b>"._MEMBER_MOD_FORM_JAVA_TYPE_PIC."</b></font><br><br>
	<input type='button' value='"._MEMBER_MOD_FORM_JAVA_RETERN."' onclick='history.back();'></center>" ;
	showerror($showmsg);
	exit();
	}

}
	// (2) ICQ
	if ($icq == "") {
		$icq = "0";
	}
	else {};
	// (3) MSN
	if ($msn == "") {
		$msn = "0";
	}
	else {};
	// (4) YAHOO
	if ($yahoo == "") {
		$yahoo = "0";
	}
	else {};
	// (5) QQ
	if ($qq == "") {
		$qq = "0";
	}
	else {};

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//$sql = "select * from ".TB_ALUMNUS." order by id desc" ;
$result = $db->select_query("select * from ".TB_ALUMNUS." order by id desc") ;
$num_result  = $db->num_rows(TB_ALUMNUS,"id","");
$dbarr = $db->sql_fetchrow($result) ;
$member_db = $dbarr[0]+1 ; // นำค่า id มาเพิ่มให้กับค่ารหัสสมาชิกครั้งละ1

if($member_db>=100) {
$member_in = "0$member_db" ;
}
else {
if($member_db >=10) {
$member_in = "00$member_db" ;
}
else {
$member_in = "000$member_db" ;
}
}
if ($icon==''){
	$iconss="member.png";
} else {
	$iconss=$icon;
}

$member_id = "$member_in" ; // รหัสสมาชิกเช่น ip0001
//empty($MPics['tmp_name'])?$filenames="":$filenames=$pic;

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_ALUMNUS,array(
"first_name"=>"".$first_name."",
"last_name"=>"".$last_name."",
"nic_name"=>"".$nic_name."",
"birthday"=>"".$birthday."",
"age"=>"".$age."",
"sex"=>"".$sex."",
"picture"=>"".$filenames."",
"numid"=>"".$numid."",
"schid"=>"".$schid."",
"yearfin"=>"".$yearfin."",
"email"=>"".$email."",
"website"=>"".$website."",
"address"=>"".$address."",
"amper"=>"".$amper."",
"province"=>"".$province."",
"school"=>"".$school."",
"WORK"=>"".$work."",
"hobby"=>"".$hobby."",
"COMMENT"=>"".$comment."",
"icon"=>"".$iconss."",
"icq"=>"".$icq."",
"msn"=>"".$msn."",
"yahoo"=>"".$yahoo."",
"qq"=>"".$qq."",
"cam"=>"".$cam."",
"mic"=>"".$mic."",
"emo"=>"".$emo."",
"worksta"=>"".$work."",
"tel"=>"".$phone."",
"zipcode"=>"".$zipcode.""
)," id=".$_GET['id']."");
$db->closedb ();
	// แจ้งผลการเพิ่มข้อมูล
		echo "<br><center>";
		echo "<table width=60% border=0 bgcolor=#ffffff cellpadding=7 cellspacing=1>";
		echo "<tr><td align=center bgcolor=#ffffff>";
		echo "<font size=2 face='MS Sans Serif'>";
		echo "<font size=3 color=red><b>"._ALUM_MOD_EDIT_FINISH1." $first_name $last_name "._ALUM_MOD_EDIT_FINISH2."</b></font>";
		echo "</font></td></tr></table></center>";

	// กลับไปหน้าหลัก
	echo "<meta http-equiv=refresh content='1;URL=index.php?name=alumnus'>";

 } else {
?>
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td><h5>&nbsp;&nbsp;Admin Zone</h5></td>
</tr>
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<TR>
<TD height="1" class="dotline"> &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_alumnus.png" BORDER="0"></TD>
</TR>
<tr>
<td> </td>
</tr>
<tr>
<td><div align="center">
<p><img src="images/dangerous.png" width="48" height="42"> </p>
<p><b><?=_ALUM_MOD_FORM_DENIED1;?></b></font> </p>
</div>
<p align="center"><b><?=_ALUM_MOD_FORM_DENIED2;?></font>
<p align="center"><b><?=_ALUM_MOD_FORM_DENIED3;?></font>
<p align="center">

<p align="center"></td>
</tr>
</table></td>
</tr>
</table>
<?
print "<meta http-equiv=refresh content=0;URL=index.php?name=admin>";
 }
?>
<?php
$year=date('Y');
$yearlast=$year+488;
	$Year = date("Y")+544;
	$thaiweekFull=array("วันอาทิตย์ ที่","วันจันทร์ ที่","วันอังคาร ที่","วันพุธ ที่","วันพฤหัสบดี ที่","วันศุกร์ ที่","วันเสาร์ ที่");
	$thaimonthFull=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม", "พฤศจิกายน","ธันวาคม");
	$thaimonth=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.", "พ.ย.","ธ.ค.");

	//คุณสามารถเลือกใช้งานได้ 3 อย่างคือ.. $mdate หรือ $ThaiDate หรือ $ThaiDateFull

	// 3 ส.ค. 2544
	$mdate = date("j ",mktime( date("H")+$hour, date("i")+$min )). $thaimonth[date("m")-1]." ".$Year; 

	// 3 ส.ค. 2544 เวลา 12:36 น.
	$ThaiDate = date("j ").$thaimonth[date("m")-1]." ".$Year.date(" เวลา H:i น.",mktime( date("H")+$hour, date("i")+$min )); 
	
	// วันศุกร์ที่ 3 ส.ค. 2544 เวลา 12:36 น.
	$ThaiDateFull = $thaiweekFull[date("w")]. date(" j "). $thaimonthFull[date("m")-1]. " ". $Year . date(" เวลา H:i น.",mktime( date("H")+$hour, date("i")+$min )); 

	// ได้ค่าเป็น วินาที นับจากปี ค.ศ.1900
	$Logtime = date("U",mktime( date("H")+$hour, date("i")+$min ));

//include "modules/alumnus/config.inc.php";

?>
<HTML>
<HEAD>

<!-- จาวา แถบสี -->
<SCRIPT LANGUAGE="javascript"> 
function mOvr(src,clrOver){ 
if (!src.contains(event.fromElement)){ 
src.style.cursor = 'hand'; 
src.bgColor = clrOver; 
} 
} 
function mOut(src,clrIn){ 
if (!src.contains(event.toElement)){ 
src.style.cursor = 'default'; 
src.bgColor = clrIn; 
} 
} 
</SCRIPT> 

<TITLE>สวัสดีครับสมาชิกใหม่ และ สมาชิกเก่าทุกๆท่าน</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-874">
</HEAD>
<BODY>
<TABLE WIDTH="750"  border="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top</TD>
          <TD width="740" vAlign=top colspan="2">

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" colspan="4"></TD>
				</TR>
      <TR>

        <TD WIDTH="65%"><TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0">
          <TR>
            <TD> </TD>
          </TR>
          <TR>
            <TD VALIGN="top">
              <FORM name ="checkForm" ACTION="?name=member&file=member_add_new" METHOD="post" onSubmit="return check()" ENCTYPE="multipart/form-data">
                <TABLE WIDTH="480" BORDER="0" ALIGN="center" CELLPADDING="2" CELLSPACING="3">
				
                  <TR>
                    <TD COLSPAN="2">
                      <P ALIGN="center"> <STRONG><FONT SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;กรุณากรอกรายละเอียดสำหรับสมัครสมาชิก</FONT></STRONG></P></TD>
                  </TR>
				      <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">
                      <P><STRONG><FONT COLOR="#0000FF" SIZE="1" FACE="MS Sans Serif, Tahoma, sans-serif"><IMG SRC="images/admin/user.gif" ></FONT></STRONG></P></TD>
                    <TD WIDTH="79%" BGCOLOR="#FFFFFF"><STRONG><FONT COLOR="#0000FF" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">ข้อมูลส่วนตัวผู้สมัคร</FONT></STRONG></TD>
                  </TR>
<TR vAlign=top>
<TD vAlign=center align=right width=108 height=2> ชื่อ :</TD>
<TD width=345 height=2><INPUT maxLength=30 size=45 name=first_name>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right width=108>นามสกุล :</TD>
<TD width=345><INPUT maxLength=40 size=45 name=last_name>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right width=108>ชื่อเล่น :</TD>
<TD width=345><INPUT maxLength=20 size=45 name=nic_name>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right width=108>วัน/ เดือน/ ปีเกิด :</TD>
<?
$dt=date('d');
$mt=date('m');
$yy=date('Y');
$yt=$yy+543;
echo "<TD width=400><SELECT name=day>
		<option >--</option>";
for($i=1;$i<32;$i++){
		if ($i<10) {
			$d='0'.$i;
echo 	"<option value=$d>0$i</option>";
	} else {
echo 	"<option value=$i>$i</option>";
	}
}
echo "</select>";
$vmont = Array ("มกราคม","กุมภาพันธ์","มีนาคม",
"เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน",
"ตุลาคม","พฤศจิกายน","ธันวาคม"); 

echo "<select  name=month size=1>
		<option >------------</option>";
for($i=0;$i<count($vmont);$i++){
echo 	"<option value=$vmont[$i]>$vmont[$i]</option>";
}
echo "</select>";

echo "<select  name=year size=1>
		<option >------</option>";
for($a=$yearlast;$a<$Year;$a++){
echo 	"<option value=$a>$a</option>";
}
echo "</select>";

?>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right width=108>อายุ :</TD>
<TD width=345><INPUT name=age id="age" size=4 maxLength=2>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right width=108>เพศ :</TD>
<TD width=345><INPUT name=sex type=radio value=1 checked>
<img src="modules/alumnus/img/male.gif" > ชาย
<INPUT type=radio value=2 name=sex>
<img src="modules/alumnus/img/female.gif"> หญิง
<INPUT type=radio value=3 name=sex>
<img src="modules/alumnus/img/notsoure.gif"> ไม่แน่ใจ<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1">&nbsp;&nbsp;<STRONG>ที่อยู่ : </STRONG></FONT></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT NAME="address" TYPE="text" ID="address" SIZE="50" MAXLENGTH="150"></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>&nbsp;&nbsp;อำเภอ/เขต : </FONT></STRONG></TD>
                    <TD BGCOLOR="#FFFFFF">
                      <INPUT NAME="amper" TYPE="text" ID="amper" SIZE="30">
                    </FONT></TD>
                  </TR>
<TR vAlign=top>
<TD vAlign=center align=right width=108>จังหวัด :</TD>
<TD width=345><select name=province id="province" >
<option value="0" selected>- - - - - เลือก - - - - -</option>
<option value="กระบี่">กระบี่</option>
<option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
<option value="กาญจนบุรี">กาญจนบุรี</option>
<option value="กาฬสินธุ์">กาฬสินธุ์</option>
<option value="กำแพงเพชร">กำแพงเพชร</option>
<option value="ขอนแก่น">ขอนแก่น</option>
<option value="จันทบุรี">จันทบุรี</option>
<option value="ฉะเชิงเทรา">ฉะเชิงเทรา</option>
<option value="ชัยนาท">ชัยนาท</option>
<option value="ชัยภูมิ">ชัยภูมิ</option>
<option value="ชุมพร">ชุมพร</option>
<option value="ชลบุรี">ชลบุรี</option>
<option value="เชียงใหม่">เชียงใหม่</option>
<option value="เชียงราย">เชียงราย</option>
<option value="ตรัง">ตรัง</option>
<option value="ตราด">ตราด</option>
<option value="ตาก">ตาก</option>
<option value="นครนายก">นครนายก</option>
<option value="นครปฐม">นครปฐม</option>
<option value="นครพนม">นครพนม</option>
<option value="นครราชสีมา">นครราชสีมา</option>
<option value="นครศรีธรรมราช">นครศรีธรรมราช</option>
<option value="นครสวรรค์">นครสวรรค์</option>
<option value="นราธิวาส">นราธิวาส</option>
<option value="น่าน">น่าน</option>
<option value="นนทบุรี">นนทบุรี</option>
<option value="บุรีรัมย์">บุรีรัมย์</option>
<option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์</option>
<option value="ปทุมธานี">ปทุมธานี</option>
<option value="ปราจีนบุรี">ปราจีนบุรี</option>
<option value="ปัตตานี">ปัตตานี</option>
<option value="พะเยา">พะเยา</option>
<option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา</option>
<option value="พังงา">พังงา</option>
<option value="พิจิตร">พิจิตร</option>
<option value="พิษณุโลก">พิษณุโลก</option>
<option value="เพชรบุรี">เพชรบุรี</option>
<option value="เพชรบูรณ์">เพชรบูรณ์</option>
<option value="แพร่">แพร่</option>
<option value="พัทลุง">พัทลุง</option>
<option value="ภูเก็ต">ภูเก็ต</option>
<option value="มหาสารคาม">มหาสารคาม</option>
<option value="มุกดาหาร">มุกดาหาร</option>
<option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
<option value="ยโสธร">ยโสธร</option>
<option value="ยะลา">ยะลา</option>
<option value="ร้อยเอ็ด">ร้อยเอ็ด</option>
<option value="ระนอง">ระนอง</option>
<option value="ระยอง">ระยอง</option>
<option value="ราชบุรี">ราชบุรี</option>
<option value="ลพบุรี">ลพบุรี</option>
<option value="ลำปาง">ลำปาง</option>
<option value="ลำพูน">ลำพูน</option>
<option value="เลย">เลย</option>
<option value="ศรีสะเกษ">ศรีสะเกษ</option>
<option value="สกลนคร">สกลนคร</option>
<option value="สงขลา">สงขลา</option>
<option value="สมุทรสาคร">สมุทรสาคร</option>
<option value="สมุทรปราการ">สมุทรปราการ</option>
<option value="สมุทรสงคราม">สมุทรสงคราม</option>
<option value="สระแก้ว">สระแก้ว</option>
<option value="สระบุรี">สระบุรี</option>
<option value="สิงห์บุรี">สิงห์บุรี</option>
<option value="สุโขทัย">สุโขทัย</option>
<option value="สุพรรณบุรี">สุพรรณบุรี</option>
<option value="สุราษฎร์ธานี">สุราษฎร์ธานี</option>
<option value="สุรินทร์">สุรินทร์</option>
<option value="สตูล">สตูล</option>
<option value="หนองคาย">หนองคาย</option>
<option value="หนองบัวลำภู">หนองบัวลำภู</option>
<option value="อำนาจเจริญ">อำนาจเจริญ</option>
<option value="อุดรธานี">อุดรธานี</option>
<option value="อุตรดิตถ์">อุตรดิตถ์</option>
<option value="อุทัยธานี">อุทัยธานี</option>
<option value="อุบลราชธานี">อุบลราชธานี</option>
<option value="อ่างทอง">อ่างทอง</option>
<option value="อื่นๆ">อื่นๆ</option>
</select>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1">&nbsp;&nbsp;<STRONG>รหัสไปรษณีย์ : </STRONG></FONT></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT NAME="zipcode" TYPE="text" ID="zipcode"></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1">&nbsp;&nbsp;<STRONG>เบอร์โทรศัพท์ : </STRONG></FONT></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT NAME="phone" TYPE="text" ID="phone"></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG>การศึกษา : </STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF">
                      <SELECT NAME="education">
                        <OPTION selected VALUE="">เลือกระดับการศึกษา</OPTION>
                        <OPTION VALUE="ประถมศึกษา">ประถมศึกษา</OPTION>
                        <OPTION VALUE="มัธยมศึกษาตอนต้น">มัธยมศึกษาตอนต้น</OPTION>
                        <OPTION VALUE="มัธยมศึกษาตอนปลาย">มัธยมศึกษาตอนปลาย</OPTION>
                        <OPTION VALUE="อาชีวศึกษา / สายอาชีพ">อาชีวศึกษา / สายอาชีพ</OPTION>
                        <OPTION VALUE="ปริญญาตรี">ปริญญาตรี</OPTION>
                        <OPTION VALUE="ปริญญาโท">ปริญญาโท</OPTION>
                        <OPTION VALUE="สูงกว่าปริญญาโท">สูงกว่าปริญญาโท</OPTION>
                      </SELECT>
                    </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG>อาชีพ : </STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF">
                      <SELECT NAME="work" >
                        <OPTION VALUE="" selected>เลือกอาชีพ</OPTION>
                        <OPTION VALUE="นักเรียน/นักศึกษา">นักเรียน/นักศึกษา</OPTION>
                        <OPTION VALUE="ธุรกิจส่วนตัว">ธุรกิจส่วนตัว</OPTION>
                        <OPTION VALUE="แพทย์/พยาบาล">แพทย์/พยาบาล</OPTION>
                        <OPTION VALUE="ครู/อาจารย์">ครู/อาจารย์</OPTION>
                        <OPTION VALUE="นักกฎหมาย/ทนายความ">นักกฎหมาย/ทนายความ</OPTION>
                        <OPTION VALUE="คอมพิวเตอร์">คอมพิวเตอร์</OPTION>
                        <OPTION VALUE="วิศวกร/ช่าง">วิศวกร/ช่าง</OPTION>
                        <OPTION VALUE="พนักงานบัญชี/การเงิน">พนักงานบัญชี/การเงิน</OPTION>
                        <OPTION VALUE="การตลาด/การขาย">การตลาด/การขาย</OPTION>
                        <OPTION VALUE="รับราชการ">รับราชการ</OPTION>
                        <OPTION VALUE="ที่ปรึกษา">ที่ปรึกษา</OPTION>
                        <OPTION VALUE="พนักงานรัฐวิสาหกิจ">พนักงานรัฐวิสาหกิจ</OPTION>
                        <OPTION VALUE="ผู้บริหาร/ผู้จัดการ">ผู้บริหาร/ผู้จัดการ</OPTION>
                        <OPTION VALUE="พนักงานทั่วไป">พนักงานทั่วไป</OPTION>
                        <OPTION VALUE="บริการท่องเที่ยว">บริการท่องเที่ยว</OPTION>
                        <OPTION VALUE="ออกแบบ/ดีไซน์">ออกแบบ/ดีไซน์</OPTION>
                        <OPTION VALUE="พนักงานโรงงาน">พนักงานโรงงาน</OPTION>
                        <OPTION VALUE="นักวิชาการ/นักวิจัยค้นคว้า">นักวิชาการ/นักวิจัยค้นคว้า</OPTION>
                        <OPTION VALUE="สื่อสารมวนชน/นักข่าว">สื่อสารมวนชน/นักข่าว</OPTION>
                        <OPTION VALUE="ดารา/นักแสดง/นักดนตรี">ดารา/นักแสดง/นักดนตรี</OPTION>
                        <OPTION VALUE="ว่างงาน">ว่างงาน</OPTION>
                        <OPTION VALUE="ไม่ได้ทำงาน">ไม่ได้ทำงาน</OPTION>
                        <OPTION VALUE="อื่นๆ">อื่นๆ</OPTION>
                      </SELECT>
                    </FONT></TD>
                  </TR>
                  <TR>
                    <TD ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1"><STRONG>รูปสมาชิก: </FONT></STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT TYPE="file" NAME="FILE" STYLE="width:250" CLASS="inputform">
                      <BR>
                      Limit <?=(_MEMBER_LIMIT_UPLOAD/1024);?> kB, [กxย]=100x80 pixels </TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><FONT COLOR="#0000FF"><STRONG><IMG SRC="images/admin/user.gif" ALIGN="absmiddle"> </STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF">&nbsp; </FONT><FONT COLOR="#0000FF"><STRONG>ข้อมูลของสมาชิกที่เป็นศิษย์เก่า</FONT></STRONG></FONT>&nbsp; </FONT></TD>
                  </TR>
<script language="javascript"> 
<!-- 
var state = 'none'; 

function showhide(layer_ref) { 

if (state == 'block') { 
state = 'none'; 
} 
else { 
state = 'block'; 
} 
if (document.all) { //IS IE 4 or 5 (or 6 beta) 
eval( "document.all." + layer_ref + ".style.display = state"); 
} 
if (document.layers) { //IS NETSCAPE 4 or below 
document.layers[layer_ref].display = state; 
} 
if (document.getElementById &&!document.all) { 
hza = document.getElementById(layer_ref); 
hza.style.display = state; 
} 
}  
//--> 
</script> 
                  <TR>
                    <TD BGCOLOR="#FFFFFF" colspan="2" align="center">
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0" class="style">
<tr>
<td width="0%"><img src="modules/alumnus/img/bc_01.gif" width="22" height="21"></td>
<td width="100%" background="modules/alumnus/img/bc_02.gif">&nbsp;</td>
<td width="0%"><img src="modules/alumnus/img/bc_03.gif" width="22" height="21"></td>
</tr>
<tr>
<td background="modules/alumnus/img/bc_04.gif">&nbsp;</td>
<td align="center">
	<font color="#FF0066"><a href="#div1" onclick="showhide('div1');"><b><< สำหรับท่านที่เคยเป็นศิษย์เก่า กดที่นี่>></FONT></a>
	<div id="div1" style="display: none;">
<SCRIPT src="modules/alumnus/check.js"></SCRIPT>
<SCRIPT src="modules/alumnus/function.js"></SCRIPT>
<TABLE width=471 border=0 align="center" cellPadding=3 class="style">
<TR vAlign=top>
<TD vAlign=center align=right width=135>รหัสประจำตัวประชาชน :</TD>
<TD width=345><INPUT maxLength=30 size=30 name=numid><img src="modules/alumnus/img/priority.gif" width="11" height="12">
</TD>
</tr>
<TR vAlign=top>
<TD vAlign=center align=right width=108>รหัสประจำตัวนักเรียน :</TD>
<TD width=345><INPUT maxLength=30 size=30 name=schid> ** จำไม่ได้ไม่เป็๋นไร
</TD>
</tr>
<TR vAlign=top>
<TD vAlign=center align=right width=108>ปี พ.ศ. ที่จบการศึกษา :</TD>
<TD width=345>
<?
echo "<select  name=yearfin size=1>
		<option >------</option>";
for($a=$yearlast;$a<$Year;$a++){
echo 	"<option value=$a>$a</option>";
}
echo "</select>";
?><img src="modules/alumnus/img/priority.gif" width="11" height="12">
</TD>
</tr>

<TR vAlign=top>
<TD vAlign=center align=right width=108>Homepage (ถ้ามี) :</TD>
<TD width=345><INPUT name="website" id="website" value=http:// size=45 maxLength=100></TD>
</TR>

<TR vAlign=top>
<TD vAlign=center align=right width=108>สถานศึกษา :</TD>
<TD width=345><INPUT maxLength=100 size=30 name=school> ** กรณียังศึกษาต่อที่อื่น
</TD>
</TR>
<TR vAlign=top>
<TD align=right width=108>ที่ทำงาน :</TD>
<TD width=345><INPUT maxLength=100 size=30 name=work1> ** กรณีทำงานแล้ว
</TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right>งานอดิเรก :</TD>
<TD><SELECT name=hobby>
<OPTION value="" selected>- - - - - - - เลือก - - - - - - -</OPTION>
<OPTION 
 value=นอน>นอน</OPTION>
<OPTION 
 value=เลี้ยงสัตว์>เลี้ยงสัตว์</OPTION>
<OPTION 
 value=ทำงานประดิษฐ์>ทำงานประดิษฐ์</OPTION>
<OPTION value=วาดภาพ>วาดภาพ</OPTION>
<OPTION 
 value=ทำงานไม้>ทำงานไม้</OPTION>
<OPTION 
 value=ปลูกต้นไม้>ปลูกต้นไม้</OPTION>
<OPTION value="ถักโครเชร์ นิตติ้ง">ถักโครเชร์ นิตติ้ง</OPTION>
<OPTION 
 value=อ่านหนังสือ>อ่านหนังสือ</OPTION>
<OPTION 
 value=ทำอาหาร>ทำอาหาร</OPTION>
<OPTION 
 value=ถ่ายรูป>ถ่ายรูป</OPTION>
<OPTION 
 value=ตีกอล์ฟ>ตีกอล์ฟ</OPTION>
<OPTION 
 value=เล่นฟุตบอล>เล่นฟุตบอล</OPTION>
<OPTION value="เล่น internet">เล่น internet</OPTION>
<OPTION 
 value=เล่นดนตรี>เล่นดนตรี</OPTION>
<OPTION 
 value=เล่นเทนนิส>เล่นเทนนิส</OPTION>
<OPTION 
 value=เล่นแบตมินตัน>เล่นแบตมินตัน</OPTION>
<OPTION 
 value=เล่นเกมส์>เล่นเกมส์</OPTION>
<OPTION 
 value=ว่ายน้ำ>ว่ายน้ำ</OPTION>
<OPTION 
 value=ช้อบปิ้ง>ช้อบปิ้ง</OPTION>
<OPTION value=ตกปลา>ตกปลา</OPTION>
<OPTION value=แข่งรถ>แข่งรถ</OPTION>
<OPTION 
 value=ปีนหน้าผา>ปีนหน้าผา</OPTION>
<OPTION 
 value=เล่นคอมพิวเตอร์>เล่นคอมพิวเตอร์</OPTION>
<OPTION 
 value=ดูภาพยนต์ ทีวี วีดีโอ>ดูภาพยนต์ ทีวี วีดีโอ</OPTION>
<OPTION 
 value=ฟังเพลง>ฟังเพลง</OPTION>
<OPTION value=แต่งรถ>แต่งรถ</OPTION>
<OPTION 
 value=แต่งเครื่องเสียง>แต่งเครื่องเสียง</OPTION>
<OPTION 
 value=ไม่ได้ทำอะไรเลย>ไม่ได้ทำอะไรเลย</OPTION>
</SELECT></TD>
</TR>
<TR vAlign=top>
<TD vAlign=top align=right width=108>ทักทายเพื่อน :</TD>
<TD width=345><textarea name="comment" cols="45" rows="3"></textarea>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right>ICQ :</TD>
<TD><INPUT name=icq id="icq" size=10 maxLength=10></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right>MSN :</TD>
<TD><INPUT name=msn id="msn" size=45 maxLength=50></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right>YAHOO :</TD>
<TD><INPUT name=yahoo id="yahoo" size=30 maxLength=30></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right>QQ :</TD>
<TD><INPUT name=qq id="qq" size=10 maxLength=10></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right><div align="right">Other :</div></TD>
<TD><input name="cam" type="checkbox" id="cam" value="1">
<img src="modules/alumnus/img/webcam.gif" width="23" height="18" align="absmiddle">
<input name="mic" type="checkbox" id="mic" value="1">
<img src="modules/alumnus/img/mic.gif" width="18" height="20" align="absmiddle"></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right>เลือกไอคอนของท่าน :</TD>
<TD><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="33%"><select name="icon" onChange="showimage()" class="text_box">
<?
								$handle=opendir('modules/alumnus/avartar/');
								while (false!==($file = readdir($handle))) { 
								 if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != "guest.gif") { 
								 echo "<option value=".WEB_URL."/modules/alumnus/avartar/".$file.">$file</option>\n";
								 } 
								}
								closedir($handle);
						 	?>
</select></td>
<td width="67%"><img src="modules/alumnus/avartar/member.png" name="icons" border="0"></td>
</tr>
</table></TD>
</TR>
<TR vAlign=top>
<TD vAlign=top align=right>Emotion :</TD>
<TD><input name="emo" type="radio" value="e1" checked>
<img src="modules/alumnus/emotion/e1.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e2">
<img src="modules/alumnus/emotion/e2.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e3">
<img src="modules/alumnus/emotion/e3.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e4">
<img src="modules/alumnus/emotion/e4.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e5">
<img src="modules/alumnus/emotion/e5.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e6">
<img src="modules/alumnus/emotion/e6.gif" width="19" height="19" align="absmiddle"><br>
<input name="emo" type="radio" value="e7">
<img src="modules/alumnus/emotion/e7.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e8">
<img src="modules/alumnus/emotion/e8.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e9">
<img src="modules/alumnus/emotion/e9.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e10">
<img src="modules/alumnus/emotion/e10.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e11">
<img src="modules/alumnus/emotion/e11.gif" width="20" height="20" align="absmiddle">
<input name="emo" type="radio" value="e12">
<img src="modules/alumnus/emotion/e12.gif" width="20" height="20" align="absmiddle"></TD>
</TR>
</TBODY>
</TABLE>
</div>
</td>
<td background="modules/alumnus/img/bc_06.gif">&nbsp;</td>
</tr>
<tr>
<td><img src="modules/alumnus/img/bc_07.gif" width="22" height="22"></td>
<td background="modules/alumnus/img/bc_08.gif">&nbsp;</td>
<td><img src="modules/alumnus/img/bc_09.gif" width="22" height="22"></td>
</tr>
</table>

</td>
</tr>

                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><FONT COLOR="#0000FF"><STRONG><IMG SRC="images/admin/user.gif" ALIGN="absmiddle"> </STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF">&nbsp; </FONT><FONT COLOR="#0000FF"><STRONG>ข้อมูลในการเข้าสู่ระบบ</FONT></STRONG></FONT>&nbsp; </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1"><STRONG>&nbsp;&nbsp;Login Name : </FONT></STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF">
                      <INPUT NAME="user_name" TYPE="text" ID="user_name" SIZE="20" MAXLENGTH="30">
                      <FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">&nbsp;**<STRONG>&nbsp;</FONT></STRONG></FONT></FONT><FONT COLOR="#FF0000" FACE="MS Sans Serif, Tahoma, sans-serif"><STRONG><FONT  size="1" FACE="MS Sans Serif, Tahoma, sans-serif">ชื่อแสดงเมื่อเข้าระบบ (ภาษาอังกฤษเท่านั้น)</FONT></STRONG></FONT></FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG>Password : </STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF">
                      <INPUT NAME="pwd_name1" TYPE="password" ID="pwd_name1" SIZE="20" MAXLENGTH="30">
&nbsp;<FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">**</FONT> </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>Re-password : </FONT></STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF">
                      <INPUT NAME="pwd_name2" TYPE="password" ID="pwd_name2" SIZE="20" MAXLENGTH="30">
&nbsp;<FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">**</FONT> </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="1"><STRONG>Email : </FONT></STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF">
                      <INPUT NAME="email" TYPE="text" ID="email" SIZE="20">
&nbsp;<FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">**</FONT></FONT></TD>
                  </TR>
<?
if(USE_CAPCHA){
?>
					<TR>
						<TD WIDTH="100" ALIGN="right">
						<?if(CAPCHA_TYPE == 1){ 
							echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						}else if(CAPCHA_TYPE == 2){ 
							echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						};?>
						</TD>
						<TD><INPUT NAME="security_code" TYPE="text" ID="security_code" MAXLENGTH="6" >&nbsp;<FONT COLOR="#FF0000" SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">**</FONT>&nbsp;<B><FONT COLOR="#FF0000" FACE="MS Sans Serif, Tahoma, sans-serif">ใส่รหัสยืนยันป้องกัน spam</FONT></B></TD>
					</TR>
<?
}
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net

?>

                  <TR>
                    <TD ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;</TD>
                    <TD BGCOLOR="#FFFFFF">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;</TD>
                    <TD BGCOLOR="#FFFFFF"><FONT COLOR="#0000FF">รายละเอียดต่างๆจะถูกส่งไปทางอีเมล <BR>
              หากไม่เจอใน Inbox ให้ลองดูที่ Junk E-Mail นะครับ&nbsp;</FONT><FONT COLOR="#0000FF" SIZE="2">&nbsp;</FONT><FONT COLOR="#0000FF" SIZE="1"><STRONG>&nbsp; </STRONG></FONT></FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;</TD>
                    <TD BGCOLOR="#FFFFFF">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;</TD>
                    <TD BGCOLOR="#FFFFFF">
                      <INPUT TYPE="submit" NAME="Submit" VALUE="สมัครสมาชิก">
                      <INPUT TYPE="hidden" NAME="signup" VALUE="date()"> 
&nbsp;
              <INPUT TYPE="reset" NAME="Submit2" VALUE=" เคลียร์">
              <INPUT NAME="ok" TYPE="hidden" ID="ok2" VALUE="ok_pass">
                    </TD>
                  </TR>
                </TABLE>
                <SCRIPT LANGUAGE="javascript">

function check() {
if(document.checkForm.name.value=="") {
alert("กรุณากรอกชื่อ-นามสกุลด้วยครับ") ;
document.checkForm.name.focus() ;
return false ;
}
else if(document.checkForm.year.value=="") {
alert("กรุณากรอก วัน/เดือน/ปีเกิด ให้ครบถ้วนด้วยนะครับ") ;
document.checkForm.year.focus() ;
return false ;
}
else if(isNaN(document.checkForm.year.value)) {
alert("ปีเกิดของท่าน กรุณากรอกเฉพาะตัวเลขนะครับ") ;
document.checkForm.year.focus() ;
return false ;
}
else if(document.checkForm.age.value=="") {
alert("กรุณากรอกอายุด้วยครับ") ;
document.checkForm.age.focus() ;
return false ;
}else if(isNaN(document.checkForm.age.value)) {
alert("กรุณากรอกอายุด้วยตัวเลขเท่านั้นครับ") ;
document.checkForm.age.focus() ;
return false ;
}
else if(document.checkForm.province.selectedIndex==0) {
alert("กรุณาระบุจังหวัดที่ท่านอยู่ด้วยครับ") ;
return false ;
}
else if(isNaN(document.checkForm.zipcode.value)) {
alert("รหัสไปรษณีย์ต้องเป็นตัวเลขครับ") ;
document.checkForm.zipcode.focus() ;
return false ;
}
else if(document.checkForm.user_name.value=="") {
alert("กรุณาระบุชื่อที่ท่านต้องการใช้ในการเข้าระบบด้วยครับ") ;
document.checkForm.user_name.focus() ;
return false ;
}
else if(document.checkForm.pwd_name1.value=="") {
alert("กรุณากรอกรหัสผ่านที่ต้องการด้วยครับ") ;
document.checkForm.pwd_name1.focus() ;
return false ;
}
else if(document.checkForm.pwd_name2.value=="") {
alert("กรุณายืนยันรหัสผ่านอีกครั้ง") ;
document.checkForm.pwd_name2.focus() ;
return false ;
}
else if(document.checkForm.pwd_name1.value != document.checkForm.pwd_name2.value) {
alert("รหัสผ่านทั้งสองไม่ตรงกัน กรุณายืนยันรหัสผ่านให้ถูกต้องด้วยครับ") ;
document.checkForm.pwd_name2.focus() ;
return false ;
}
else if(document.checkForm.email.value=="") {
alert("กรุณากรอกอีเมล์ด้วยนะครับ") ;
return false ;
}
else if(checkForm.email.value.indexOf('@')==-1) {
alert("อีเมล์ของคุณไม่ถูกต้องครับ") ;
document.checkForm.email.focus() ;
return false ;
}
else if(checkForm.email.value.indexOf('.')==-1) {
alert("อีเมล์ของคุณไม่ถูกต้องครับ") ;
document.checkForm.email.focus() ;
return false ;
}

else 
return true ;
}

                      </SCRIPT>
                <BR>
                <BR>
                <BR>
                <BR>
            </FORM>			</TD>
          </TR>
        </TABLE></TD>
      </TR>
    </TABLE></TD>
  </TR>
</TABLE>
</BODY>
</HTML>

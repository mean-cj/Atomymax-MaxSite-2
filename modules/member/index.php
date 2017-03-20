<?include ("editor.php");?>
<?php
$year=date('Y');
$yearlast=$year+488;
	$Year = date("Y")+544;
?>
<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
<style type="text/css">
.object_ok
{
border: 1px solid green;
color: #333333;
}

.object_error
{
border: 1px solid #AC3962;
color: #333333;
}
</style>
<script language="javascript">
pic1 = new Image(16, 16); 
pic1.src = "modules/member/img/loader.gif";

$(document).ready(function(){

$("#username").change(function() { 

var usr = $("#username").val();

if(usr.length >= 4)
{
$("#status").html('<img src="modules/member/img/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "modules/member/checkuser.php",  
    data: "username="+ usr,  
    success: function(msg){  
   
   $("#status").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#username").removeClass('object_error'); // if necessary
		$("#username").addClass("object_ok");
		$(this).html('&nbsp;<img src="modules/member/img/tick.gif" align="absmiddle">');
	} 
	else  
	{  
		$("#username").removeClass('object_ok'); // if necessary
		$("#username").addClass("object_error");
		$(this).html(msg);
	}  
   
   });

 } 
   
  }); 

}
else
	{
	$("#status").html('<font color="red">The username should have at least <strong>4</strong> characters.</font>');
	$("#username").removeClass('object_ok'); // if necessary
	$("#username").addClass("object_error");
	}

});


$("#email").change(function() { 

var email = $("#email").val();

if(email.length >= 4)
{
$("#statusx").html('<img src="modules/member/img/loader.gif" align="absmiddle">&nbsp;Checking availability...');

    $.ajax({  
    type: "POST",  
    url: "modules/member/checkemail.php",  
    data: "email="+ email,  
    success: function(msg){  
   
   $("#statusx").ajaxComplete(function(event, request, settings){ 

	if(msg == 'OK')
	{ 
        $("#email").removeClass('object_error'); // if necessary
		$("#email").addClass("object_ok");
		$(this).html('&nbsp;<img src="modules/member/img/tick.gif" align="absmiddle">');
	}  
	else  
	{  
		$("#email").removeClass('object_ok'); // if necessary
		$("#email").addClass("object_error");
		$(this).html(msg);
	}  
   
   });

 } 
   
  }); 

}
else
	{
	$("#statusx").html('<font color="red">The email should have at least <strong>4</strong> characters.</font>');
	$("#email").removeClass('object_ok'); // if necessary
	$("#email").addClass("object_error");
	}

});
});

</script>
<?
function mosMakePassword($length) {
	$salt = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789";
	$len = strlen($salt);
	$makepass="";
	mt_srand(10000000*(double)microtime());
	for ($i = 0; $i < $length; $i++)
	$makepass .= $salt[mt_rand(0,$len - 1)];
	return $makepass;
}
?>

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

        <TD WIDTH="95%"><TABLE width="740" BORDER="0" CELLSPACING="0" CELLPADDING="0">
          <TR>
            <TD> </TD>
          </TR>
          <TR>
            <TD VALIGN="top">
              <FORM name ="checkForm" ACTION="?name=member&file=member_add_new" METHOD="post" onSubmit="return check()" ENCTYPE="multipart/form-data" class="formidable1" id="checkForm">
                <TABLE WIDTH="730" BORDER="0" ALIGN="center" CELLPADDING="2" CELLSPACING="3" >
				
                  <TR>
                    <TD COLSPAN="2">
                      <P ALIGN="center"> <STRONG>&nbsp;&nbsp;<?=_MEMBER_MOD_FORM_TITLE;?></FONT></STRONG></P></TD>
                  </TR>
              <TR>
                <TD WIDTH="100%" ALIGN="left" BGCOLOR="#0099FF" colspan="2">&nbsp;&nbsp;<IMG SRC="images/admin/user.gif" ><FONT color="#FFFFFF"><b>&nbsp;&nbsp;<?=_MEMBER_MOD_FORM_TITLE_LOGIN;?></FONT></TD>
              </TR>
              <TR>
                <TD WIDTH="20%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>&nbsp;&nbsp;Login Name : </FONT></STRONG></FONT></TD>
                <TD BGCOLOR="#FFFFFF">
                  <INPUT type="text" NAME="username"  ID="username" SIZE="20" MAXLENGTH="20" >
                  <FONT COLOR="#FF0000" >&nbsp;**</FONT>&nbsp;<span id="status"></span></TD>
              </TR>
              <TR>
                <TD WIDTH="20%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG>Password : </STRONG></FONT></TD>
                <TD BGCOLOR="#FFFFFF">
                  <INPUT NAME="pwd_name1" TYPE="text" ID="pwd_name1" SIZE="20" MAXLENGTH="20" value="<?php echo mosMakePassword(8); ?>"  readonly style="color: #FF0000">
&nbsp;<FONT COLOR="#FF0000" >**</FONT> </FONT></TD>
              </TR>
              <TR>
                <TD WIDTH="20%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>Email : </FONT></STRONG></FONT></TD>
                <TD BGCOLOR="#FFFFFF">
                  <INPUT NAME="email" TYPE="text" ID="email" MAXLENGTH="50" >
&nbsp;<FONT COLOR="#FF0000" >**</FONT>&nbsp;<span id="statusx"></span></TD>
              </TR>
				      <TR>
              <TR>
                <TD WIDTH="100%" ALIGN="left" BGCOLOR="#0099FF" colspan="2">&nbsp;&nbsp;<IMG SRC="images/admin/user.gif" ><FONT  color="#FFFFFF"><b>&nbsp;&nbsp;<?=_MEMBER_MOD_FORM_USER_DETAIL_TITLE;?></FONT></TD>
              </TR>
<TR vAlign=top>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG><?=_MEMBER_MOD_FORM_USER_NAME;?> :</TD>
<TD width=345 height=2><INPUT maxLength=30 size=45 name=first_name>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG><?=_MEMBER_MOD_FORM_USER_SUR;?> :</TD>
<TD width=345><INPUT maxLength=40 size=45 name=last_name>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG><?=_MEMBER_MOD_FORM_USER_NICK;?> :</TD>
<TD width=345><INPUT maxLength=20 size=45 name=nic_name>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG><?=_MEMBER_MOD_FORM_USER_BIRTH;?> :</TD>
<?
$dt=date('d');
$mt=date('m');
$yy=date('Y');
$yt=$yy+543;
echo "<TD width=400><SELECT name=day>
		<option >--</option>";
for($i=1;$i<32;$i++){
echo 	"<option value=$i>$i</option>";
}
echo "</select>";
$vmont  = array(_F_Month_1, _F_Month_2, _F_Month_3, _F_Month_4, _F_Month_5, _F_Month_6, _F_Month_7, _F_Month_8, _F_Month_9, _F_Month_10, _F_Month_11, _F_Month_12);

echo "<select  name=month size=1>
		<option >------------</option>";
for($i=0;$i<count($vmont);$i++){
$ss=$i+1;
echo 	"<option value=$ss>$vmont[$i]</option>";
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
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG><?=_ALUM_MOD_FORM_OLD;?> :</TD>
<TD width=345><INPUT name=age id="age" size=4 maxLength=2>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG><?=_ALUM_MOD_FORM_SEX;?> :</TD>
<TD width=345><INPUT name=sex type=radio value=1 checked>
<img src="modules/alumnus/img/male.gif" > <?=_ALUM_MOD_FORM_SEX_MAN;?>
<INPUT type=radio value=2 name=sex>
<img src="modules/alumnus/img/female.gif"> <?=_ALUM_MOD_FORM_SEX_GIRL;?>
<INPUT type=radio value=3 name=sex>
<img src="modules/alumnus/img/notsoure.gif"> <?=_ALUM_MOD_FORM_SEX_BI;?><img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG><?=_ALUM_MOD_FORM_ADD;?> : </STRONG></FONT></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT NAME="address" TYPE="text" ID="address" SIZE="50" MAXLENGTH="150"></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>&nbsp;&nbsp;<?=_ALUM_MOD_FORM_AMP;?> : </FONT></STRONG></TD>
                    <TD BGCOLOR="#FFFFFF">
                      <INPUT NAME="amper" TYPE="text" ID="amper" SIZE="30">
                    </FONT></TD>
                  </TR>
<TR vAlign=top>
<TD vAlign=center align=right WIDTH="21%"><STRONG>&nbsp;&nbsp;<?=_ALUM_MOD_FORM_PROV;?> :</TD>
<TD width=345><?
$vprovince  = array(_PROVINCE_1, _PROVINCE_2, _PROVINCE_3, _PROVINCE_4, _PROVINCE_5, _PROVINCE_6, _PROVINCE_7, _PROVINCE_8, _PROVINCE_9, _PROVINCE_10, _PROVINCE_11, _PROVINCE_12, _PROVINCE_13, _PROVINCE_14, _PROVINCE_15, _PROVINCE_16, _PROVINCE_17, _PROVINCE_18, _PROVINCE_19, _PROVINCE_20, _PROVINCE_21, _PROVINCE_22, _PROVINCE_23, _PROVINCE_24, _PROVINCE_25, _PROVINCE_26, _PROVINCE_27, _PROVINCE_28, _PROVINCE_29, _PROVINCE_30, _PROVINCE_31, _PROVINCE_32, _PROVINCE_33, _PROVINCE_34, _PROVINCE_35, _PROVINCE_36, _PROVINCE_37, _PROVINCE_38, _PROVINCE_39, _PROVINCE_40, _PROVINCE_41, _PROVINCE_42, _PROVINCE_43, _PROVINCE_44, _PROVINCE_45, _PROVINCE_46, _PROVINCE_47, _PROVINCE_48, _PROVINCE_49, _PROVINCE_50, _PROVINCE_51, _PROVINCE_52, _PROVINCE_53, _PROVINCE_54, _PROVINCE_55, _PROVINCE_56, _PROVINCE_57, _PROVINCE_58, _PROVINCE_59, _PROVINCE_60, _PROVINCE_61, _PROVINCE_62, _PROVINCE_63, _PROVINCE_64, _PROVINCE_65, _PROVINCE_66, _PROVINCE_67, _PROVINCE_68, _PROVINCE_69, _PROVINCE_70, _PROVINCE_71, _PROVINCE_72, _PROVINCE_73, _PROVINCE_74, _PROVINCE_75, _PROVINCE_76, _PROVINCE_77);
echo "<select  name=province size=1 >
		<option >------------</option>";
for($i=0;$i<count($vprovince);$i++){
echo 	"<option value=$vprovince[$i]>".$vprovince[$i]."</option>";
}
echo "</select>";
?>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>&nbsp;&nbsp;<?=_ALUM_MOD_FORM_POST;?> : </STRONG></FONT></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT NAME="zipcode" TYPE="text" ID="zipcode"></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>&nbsp;&nbsp;<?=_ALUM_MOD_FORM_TEL;?> : </STRONG></FONT></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT NAME="phone" TYPE="text" ID="phone"></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>&nbsp;&nbsp;<?=_MEMBER_MOD_FORM_USER_EDU;?> : </STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF">
<?
$education  = array(_EDU_1, _EDU_2, _EDU_3, _EDU_4, _EDU_5, _EDU_6, _EDU_7);
echo "<select  name=education size=1 >
		<option >------------</option>";
for($i=0;$i<count($education);$i++){
echo 	"<option value=$education[$i]>".$education[$i]."</option>";
}
echo "</select>";
?>
</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>&nbsp;&nbsp;<?=_MEMBER_MOD_FORM_USER_WORK;?> : </STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF">
<?
$vwork  = array(_WORK_1, _WORK_2, _WORK_3, _WORK_4, _WORK_5, _WORK_6, _WORK_7, _WORK_8, _WORK_9, _WORK_10, _WORK_11, _WORK_12, _WORK_13, _WORK_14, _WORK_15, _WORK_16, _WORK_17, _WORK_18, _WORK_19, _WORK_20, _WORK_21, _WORK_22, _WORK_23);
echo "<select  name=work size=1 >
		<option >------------</option>";
for($i=0;$i<count($vwork);$i++){
echo 	"<option value=$vwork[$i]>".$vwork[$i]."</option>";
}
echo "</select>";
?>
                    </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;&nbsp;<STRONG><?=_ALUM_MOD_FORM_OFFICE;?> : </STRONG></FONT></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT NAME="office" TYPE="text" ID="office" SIZE="50" MAXLENGTH="150"></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF" valign="top"><STRONG>&nbsp;&nbsp;<?=_MEMBER_MOD_FORM_USER_SIG;?> : </STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><textarea cols="70" id="editor1" rows="5"  name="signature" ></textarea>
				  		<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Mini'});</script>
					</TD>
                  </TR>
                  <TR>
                    <TD ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>&nbsp;&nbsp;<?=_MEMBER_MOD_FORM_USER_PIC;?> : </FONT></STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT TYPE="file" NAME="FILE" STYLE="width:250" CLASS="inputform" id="FILE">
                      <BR>
                      Limit <?=(_MEMBER_LIMIT_UPLOAD/1024);?> kB, [ width x height ]=100x80 pixels </TD>
                  </TR>

<?
if(USE_CAPCHA){
?>
					<TR>
						<TD WIDTH="21%" ALIGN="right">
						<?if(CAPCHA_TYPE == 1){ 
							echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						}else if(CAPCHA_TYPE == 2){ 
							echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						};?>
						</TD>
						<TD><INPUT NAME="security_code" TYPE="text" ID="security_code" MAXLENGTH="6" >&nbsp;<FONT COLOR="#FF0000" >**</FONT>&nbsp;<B><FONT COLOR="#FF0000" ><?=_MEMBER_MOD_FORM_USER_SPAM;?></FONT></B></TD>
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
                    <TD BGCOLOR="#FFFFFF"><FONT COLOR="#0000FF"><?=_MEMBER_MOD_FORM_ADD_SENDEMAIL;?> <BR>
             <?=_MEMBER_MOD_FORM_ADD_SENDEMAIL2;?>&nbsp;</FONT><FONT COLOR="#0000FF" SIZE="2">&nbsp;</FONT><FONT COLOR="#0000FF" SIZE="1"><STRONG>&nbsp; </STRONG></FONT></FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;</TD>
                    <TD BGCOLOR="#FFFFFF">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF">&nbsp;</TD>
                    <TD BGCOLOR="#FFFFFF">
                      <INPUT TYPE="submit" NAME="Submit" VALUE="<?=_MEMBER_MOD_FORM_BUTTON_ADD;?>">
                      <INPUT TYPE="hidden" NAME="signup" VALUE="date()"> 
&nbsp;
              <INPUT TYPE="reset" NAME="Submit2" VALUE="<?=_MEMBER_MOD_FORM_BUTTON_CLEAR;?>">
              <INPUT NAME="ok" TYPE="hidden" ID="ok2" VALUE="ok_pass">
                    </TD>
                  </TR>
                </TABLE>
<SCRIPT LANGUAGE="javascript">
function check() {
if(document.getElementById('FILE').value!=""){
    var fty=new Array(".gif",".jpg",".jpeg",".png"); // ประเภทไฟล์ที่อนุญาตให้อัพโหลด  
        var a=document.checkForm.FILE.value; //กำหนดค่าของไฟล์ใหกับตัวแปร a   
        var permiss=0; // เงื่อนไขไฟล์อนุญาต
        a=a.toLowerCase();   
        if(a !=""){
            for(i=0;i<fty.length;i++){ // วน Loop ตรวจสอบไฟล์ที่อนุญาต  
                if(a.lastIndexOf(fty[i])>=0){  // เงื่อนไขไฟล์ที่อนุญาต  
                    permiss=1;
                    break;
                }else{
                    continue;
                }
            } 
            if(permiss==0){
                    alert("<? echo _MEMBER_MOD_FORM_JAVA_TYPE_PIC;?>");     
                document.getElementById('FILE').value="" ; 
                return false;              
            }        
        }       


var x=document.forms["checkForm"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("<?echo _MEMBER_MOD_FORM_JAVA_EMAIL;?>");
  return false;
  }

if(document.checkForm.name.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_USER;?>") ;
document.checkForm.name.focus() ;
return false ;
}
else if(document.checkForm.year.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_BIRTH;?>") ;
document.checkForm.year.focus() ;
return false ;
}
else if(isNaN(document.checkForm.year.value)) {
alert("<?echo _MEMBER_MOD_FORM_JAVA_YEAR;?>") ;
document.checkForm.year.focus() ;
return false ;
}
else if(document.checkForm.age.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_AGE;?>") ;
document.checkForm.age.focus() ;
return false ;
}else if(isNaN(document.checkForm.age.value)) {
alert("<?echo _MEMBER_MOD_FORM_JAVA_AGE_NUM;?>") ;
document.checkForm.age.focus() ;
return false ;
}
else if(document.checkForm.province.selectedIndex==0) {
alert("<?echo _MEMBER_MOD_FORM_JAVA_PROV;?>") ;
return false ;
}
else if(isNaN(document.checkForm.zipcode.value)) {
alert("<?echo _MEMBER_MOD_FORM_JAVA_POST;?>") ;
document.checkForm.zipcode.focus() ;
return false ;
}
else if(document.checkForm.user_name.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_USERNAME;?>") ;
document.checkForm.user_name.focus() ;
return false ;
}
else if(document.checkForm.pwd_name1.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_PASS;?>") ;
document.checkForm.pwd_name1.focus() ;
return false ;
}
else if(document.checkForm.pwd_name2.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_PASS_CONF;?>") ;
document.checkForm.pwd_name2.focus() ;
return false ;
}
else if(document.checkForm.pwd_name1.value != document.checkForm.pwd_name2.value) {
alert("<?echo _MEMBER_MOD_FORM_JAVA_PASS_NOTMATT;?>") ;
document.checkForm.pwd_name2.focus() ;
return false ;
}
else if(document.checkForm.email.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_EMAIL_NULL;?>") ;
return false ;
}

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

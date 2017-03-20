<?php
#### สคริ๊ปนี้ใช้ในการเช็ค ว่าล็อกอินหรือยัง ให้นำสคริ๊ปนี้ไปไว้ที่หน้าที่คุณต้องการให้เช็ค ####
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net

CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);
include ("editor.php");
	if(CheckLevel($_SESSION['admin_user'],"member_edit")){

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

<TABLE WIDTH="820"  border="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="820" vAlign=top ><IMG src="images/topfader.gif" border=0><BR>

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" colspan="4"></TD>
				</TR>
  </TR>
      <TR>
        <TD>&nbsp;&nbsp;
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A>
		<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//$login_true=$_SESSION['login_true'];
$result = mysql_query("select * from ".TB_MEMBER." where member_id='".$_GET['member_id']."' ") or die ("Err Can not to result") ;
$dbarr = mysql_fetch_array($result) ;

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
         <BR>
              <DIV ALIGN="left">
                <P>&nbsp;&nbsp;<STRONG><FONT SIZE="4"><IMG SRC="images/human.gif" ></FONT></STRONG> <FONT COLOR="#FF3300" SIZE="4"><u><STRONG><?=_MEMBER_MOD_MEMEDIT_MENU_TITLE;?> <?php echo $dbarr['user'] ; ?></STRONG></u></FONT></P>
              </DIV>            
            <DIV ALIGN="left">
              <FORM NAME="checkForm" ACTION="?name=admin&file=member_edit_add&id=<?=$dbarr['id'];?>" METHOD="post" onSubmit="return check2();" ENCTYPE="multipart/form-data">
                <TABLE WIDTH="100%" BORDER="0" CELLSPACING="5" CELLPADDING="0" >
				<tr>
				<td ALIGN="right"><B><?=_MEMBER_MOD_MEMEDIT_USERNAME;?> :</B></td><td><INPUT TYPE="text" NAME="USERNAME" size="30" VALUE="<?=$dbarr['user'];?>" readonly style="color: #FF0000">
				<INPUT TYPE="hidden" NAME="USERNAME_OLD" VALUE="<?=$dbarr['user'];?>" >
				</td>
				<td ALIGN="right"><B><?=_MEMBER_MOD_MEMEDIT_PASSWORD;?> :</B></td><td><INPUT TYPE="text" NAME="PASSWORD" size="10" ><font color="#FF0000"><b>** New password</b></font></td>
				</tr>
				                  <TR>
                    <TD ALIGN="right">&nbsp;<STRONG>email </STRONG>: </FONT></TD>
                    <TD>
                      <INPUT NAME="email" TYPE="text" VALUE="<?php echo $dbarr['email'] ;?>" SIZE="25">
                    </FONT></TD>
                    <TD ALIGN="right" WIDTH="18%"><STRONG><?=_MEMBER_MOD_MEMDETAIL_MEMPIC;?> : </FONT></STRONG></TD>
                    <TD WIDTH="38%" ROWSPAN="5" VALIGN="top"><?
					//Show Picture
					if($dbarr['member_pic']){
						$postpicupload = @getimagesize ("icon/".$dbarr['member_pic']."");
						if ( $postpicupload[0] > _MEMBER_LIMIT_PICWIDTH ) {
							$PicUpload = "<img src='icon/".$dbarr['member_pic']."' width='"._MEMBER_LIMIT_PICWIDTH."' border='1' ALIGN='absbottom' class='membericon'>	<br><br>"._MEMBER_MOD_MEMDETAIL_MEMPIC_NOW." ".$dbarr['member_pic']."<BR>";
							}else{
							$PicUpload = "<img src='icon/".$dbarr['member_pic']."' border='1' ALIGN='absbottom' class='membericon'><br><br>"._MEMBER_MOD_MEMDETAIL_MEMPIC_NOW." ".$dbarr['member_pic']."<BR>";
							}
						echo $PicUpload ;
					}else{ echo ""._MEMBER_MOD_MEMDETAIL_MEMPIC_NULL." "; };
					?> 
                      <INPUT NAME="member_pic" TYPE="hidden" VALUE="<?php echo $dbarr['member_pic'] ;?>" >
                    </FONT>&nbsp;
                    </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_NAME;?> : </FONT></STRONG></TD>
                    <TD>
                      <INPUT NAME="name" TYPE="text"  size="20" VALUE="<?php echo "$dbarr[name]" ; ?>">
                    </FONT></TD>
                    <TD ALIGN="right">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_BIRTDAY;?> : </FONT></STRONG></TD>
<?
$dt=date('d');
$mt=date('m');
$yy=date('Y');
$yt=$yy+543;
echo "<TD ><SELECT name=date>
		<option >--</option>";
for($i=1;$i<32;$i++){
echo 	"<option value=$i ";
if($dbarr['date']=="$i"){ echo "selected" ; }
echo ">$i</option>";
}
echo "</select>";
$year=date('Y');
$yearlast=$year+488;
$Year = date("Y")+544;
$vmont  = array(_F_Month_1, _F_Month_2, _F_Month_3, _F_Month_4, _F_Month_5, _F_Month_6, _F_Month_7, _F_Month_8, _F_Month_9, _F_Month_10, _F_Month_11, _F_Month_12);
echo "<select  name=month size=1>";
for($ix=0;$ix<count($vmont);$ix++){
$ss=$ix+1;
echo 	"<option value=$ss ";
if($dbarr['month']=="$ss"){ echo "selected" ; }
echo ">$vmont[$ix]</option>";
}
echo "</select>";

echo "<select  name=year size=1>";
for($a=$yearlast;$a<$Year;$a++){
echo 	"<option value=$a ";
if($dbarr['year']=="$a"){ echo "selected" ; }
echo ">$a</option>";
}
echo "</select>";

?>

</FONT>
</TD>
                     <TD ALIGN="right">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><? echo _MEMBER_MOD_MEMDETAIL_SEX;?> : </FONT></STRONG></TD>
                    <TD>
                      <INPUT NAME="sex" TYPE="radio" VALUE="<? echo _MEMBER_MOD_FORM_SEX_MAN;?>" <?php if($dbarr['sex']==_MEMBER_MOD_FORM_SEX_MAN) { echo "checked" ;}  ?>><img src="modules/alumnus/img/male.gif" >
                <? echo _MEMBER_MOD_FORM_SEX_MAN;?> &nbsp;
                <INPUT NAME="sex" TYPE="radio" VALUE="<? echo _MEMBER_MOD_FORM_SEX_GIRL;?>" <?php if($dbarr['sex']==_MEMBER_MOD_FORM_SEX_GIRL) { echo "checked" ;}  ?>><img src="modules/alumnus/img/female.gif">
                <? echo _MEMBER_MOD_FORM_SEX_GIRL;?>
				<INPUT NAME="sex" TYPE="radio" VALUE="<? echo _ALUM_MOD_FORM_SEX_BI;?>" <?php if($dbarr['sex']==_ALUM_MOD_FORM_SEX_BI) { echo "checked" ;}  ?>><img src="modules/alumnus/img/priority.gif" width="11" height="12">
                <? echo _ALUM_MOD_FORM_SEX_BI;?>
				&nbsp;&nbsp;</FONT></TD>
                    <TD ALIGN="right">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><? echo _MEMBER_MOD_FORM_EDUCATION;?> : </FONT></STRONG></TD>
                    <TD>
<?
$education  = array(_EDU_1, _EDU_2, _EDU_3, _EDU_4, _EDU_5, _EDU_6, _EDU_7);
echo "<select  name=education size=1 >
		<option >------------</option>";
for($i=0;$i<count($education);$i++){
echo 	"<option value=$education[$i] ";
if($dbarr['education']=="$education[$i]"){ echo "selected" ; }
echo ">".$education[$i]."</option>";
}
echo "</select>";
?>
                    </FONT></TD>
                    <TD ALIGN="right">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_ADDRESS;?> : </FONT></STRONG></TD>
                    <TD>
                      <INPUT NAME="address" TYPE="text" VALUE="<?php echo $dbarr['address'] ; ?>">
                    </FONT></TD>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_MEMPIC;?> : </FONT></STRONG></TD>
                    <TD WIDTH="38%"><INPUT TYPE="file" NAME="FILE" STYLE="width:250" CLASS="inputform">
                        <FONT COLOR="#FF0000">
						<BR>Limit  <?=(_MEMBER_LIMIT_UPLOAD/1024);?> kb </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_AMP;?> : </FONT></STRONG></TD>
                    <TD>
                      <INPUT NAME="amper" TYPE="text" VALUE="<?php echo $dbarr['amper'] ; ?>">
                    </FONT></TD>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_FORM_USER_WORK;?> : </STRONG></FONT></TD>
                    <TD WIDTH="38%">
<?
$vwork  = array(_WORK_1, _WORK_2, _WORK_3, _WORK_4, _WORK_5, _WORK_6, _WORK_7, _WORK_8, _WORK_9, _WORK_10, _WORK_11, _WORK_12, _WORK_13, _WORK_14, _WORK_15, _WORK_16, _WORK_17, _WORK_18, _WORK_19, _WORK_20, _WORK_21, _WORK_22, _WORK_23);
echo "<select  name=work size=1 >
		<option >------------</option>";
for($i=0;$i<count($vwork);$i++){
echo 	"<option value=$vwork[$i] ";
if($dbarr['work']=="$vwork[$i]"){ echo "selected" ; }
echo ">".$vwork[$i]."</option>";
}
echo "</select>";
?>
                    </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_PROV;?> : </FONT></STRONG></TD>
 <TD width=345>
 <?
$vprovince  = array(_PROVINCE_1, _PROVINCE_2, _PROVINCE_3, _PROVINCE_4, _PROVINCE_5, _PROVINCE_6, _PROVINCE_7, _PROVINCE_8, _PROVINCE_9, _PROVINCE_10, _PROVINCE_11, _PROVINCE_12, _PROVINCE_13, _PROVINCE_14, _PROVINCE_15, _PROVINCE_16, _PROVINCE_17, _PROVINCE_18, _PROVINCE_19, _PROVINCE_20, _PROVINCE_21, _PROVINCE_22, _PROVINCE_23, _PROVINCE_24, _PROVINCE_25, _PROVINCE_26, _PROVINCE_27, _PROVINCE_28, _PROVINCE_29, _PROVINCE_30, _PROVINCE_31, _PROVINCE_32, _PROVINCE_33, _PROVINCE_34, _PROVINCE_35, _PROVINCE_36, _PROVINCE_37, _PROVINCE_38, _PROVINCE_39, _PROVINCE_40, _PROVINCE_41, _PROVINCE_42, _PROVINCE_43, _PROVINCE_44, _PROVINCE_45, _PROVINCE_46, _PROVINCE_47, _PROVINCE_48, _PROVINCE_49, _PROVINCE_50, _PROVINCE_51, _PROVINCE_52, _PROVINCE_53, _PROVINCE_54, _PROVINCE_55, _PROVINCE_56, _PROVINCE_57, _PROVINCE_58, _PROVINCE_59, _PROVINCE_60, _PROVINCE_61, _PROVINCE_62, _PROVINCE_63, _PROVINCE_64, _PROVINCE_65, _PROVINCE_66, _PROVINCE_67, _PROVINCE_68, _PROVINCE_69, _PROVINCE_70, _PROVINCE_71, _PROVINCE_72, _PROVINCE_73, _PROVINCE_74, _PROVINCE_75, _PROVINCE_76, _PROVINCE_77);
echo "<select  name=province size=1 >
		<option >------------</option>";
for($i=0;$i<count($vprovince);$i++){
echo 	"<option value=$vprovince[$i] ";
if($dbarr['province']=="$vprovince[$i]"){ echo "selected" ; }
echo ">".$vprovince[$i]."</option>";
}
echo "</select>";
?>
</TD>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_POST;?> : </STRONG></FONT></TD>
                    <TD>
                      <INPUT NAME="zipcode" TYPE="text" VALUE="<?php echo $dbarr['zipcode'] ; ?>" SIZE="10" MAXLENGTH="15">
                    </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_PHONE;?> : </FONT></STRONG></TD>
                    <TD>
                      <INPUT NAME="phone" TYPE="text" ID="phone2" VALUE="<?php echo $dbarr['phone'] ;?>">
                    </FONT></TD>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_TIMEADD;?> : </STRONG></FONT></TD>
                    <TD><INPUT NAME="signup" TYPE="text" ID="office" VALUE="<?php echo $dbarr['signup'] ; ?>"></TD>
                  </TR>
                  <TR>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_AGE;?></STRONG>&nbsp;: </FONT></TD>
                    <TD>
                      <INPUT NAME="age" TYPE="text" VALUE="<?php echo $dbarr['age'] ; ?>" SIZE="5" MAXLENGTH="3">  <?=_MEMBER_MOD_MEMDETAIL_PEE;?>                    </FONT></TD>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_FORM_WORK;?></STRONG>&nbsp;:</TD><td>
                      <INPUT NAME="office" TYPE="text" ID="office" VALUE="<?php echo $dbarr['office'] ;?>"></td>
                  </TR>

                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_MEMBER_MOD_FORM_USER_NICK;?> : </STRONG></TD>
                    <TD BGCOLOR="#FFFFFF" ><INPUT NAME="nic_name" TYPE="text"  size="5" VALUE="<?php echo "$dbarr[nic_name]" ; ?>"></TD>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>Email : </STRONG></TD>
                    <TD BGCOLOR="#FFFFFF" ><INPUT NAME="email" TYPE="text"  size="30" VALUE="<?php echo "$dbarr[email]" ; ?>"></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF" valign="top" ><FONT SIZE="2"><STRONG>&nbsp;&nbsp;<?=_MEMBER_MOD_FORM_USER_SIG;?> : </STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF" colspan="3"><textarea cols="70" id="editor1" rows="5"  name="signature" ><?php echo $dbarr['signature'] ;?></textarea>
					<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'AdminBasic'});</script>
					</TD>
                  </TR>
                </TABLE>
                <DIV ALIGN="center"><BR>
				   <INPUT NAME="page" TYPE="hidden" VALUE="<?php echo $_GET['page'] ;?>" >
                    <INPUT NAME="member_id" TYPE="hidden" ID="member_id" VALUE="<?php echo $dbarr['member_id'] ; ?>">
					<INPUT TYPE="hidden" NAME="oldpass" value="<?=$dbarr['password'];?>">
&nbsp;&nbsp; 
            <INPUT TYPE="submit" NAME="Submit2" VALUE="<?=_MEMBER_MOD_FORM_BUTTON_EDIT;?>">
          </FONT></DIV>
<SCRIPT LANGUAGE="javascript">

function check2() {
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
}
else if(isNaN(document.checkForm.age.value)) {
alert("<?echo _MEMBER_MOD_FORM_JAVA_AGE_NUM;?>") ;
document.checkForm.age.focus() ;
return false ;
}
else if(document.checkForm.email.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_EMAIL_NULL;?>") ;
return false ;
}
else 
return true ;
}

      </SCRIPT>
              </FORM>
          </DIV></TD>
      </TR>
    </TABLE></TD>
  </TR>
</TABLE>
<P>&nbsp;</P>

<? } ?>
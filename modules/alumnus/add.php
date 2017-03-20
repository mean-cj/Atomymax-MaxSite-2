<?
include ("editor.php");
$year=date('Y');
$yearlast=$year+488;
	$Year = date("Y")+544;
//include "modules/alumnus/form_search1.php";
include "modules/alumnus/config.inc.php";
if (ISO=='utf-8'){
?>
<SCRIPT src="modules/alumnus/check_utf8.js"></SCRIPT>
<?
} else {
	?>
<SCRIPT src="modules/alumnus/check.js"></SCRIPT>
<?
}
	?>
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
 <table width="650" align=center cellSpacing=0 cellPadding=0 border=0><tr><TD ><IMG SRC="images/menu/textmenu_alumnus.png" BORDER="0"></TD></tr>
 <tr><TD height="1" class="dotline" colspan="4"></td></tr></table>
<strong><a href="index.php"><font color="#990000"><?=_ALUM_MOD_FORM_IN;?></font></a></strong>&nbsp;&nbsp;<font color="#990000"><strong>
<?
include "modules/alumnus/form_search.php";
?>

<form action="index.php?name=alumnus&file=addok" method="post" enctype="multipart/form-data" name="webForm" id="webForm" onSubmit="return check1()">
<table width="650" border="0" align="left" cellpadding="0" cellspacing="0" class="style">
<tr>
<td><TABLE width=650 border=0 align="left" cellPadding=3 class="style">
<TBODY>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_NAME;?> :</font></strong></TD>
<TD width=445 height=2><INPUT maxLength=30 size=45 name=first_name>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_SUR;?> :</font></strong></TD>
<TD width=445><INPUT maxLength=40 size=45 name=last_name>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_NICK;?> :</font></strong></TD>
<TD width=445><INPUT maxLength=20 size=25 name=nic_name>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>Email : </FONT></STRONG></FONT></TD>
<TD BGCOLOR="#FFFFFF"><FONT SIZE="2" FACE="MS Sans Serif, Tahoma, sans-serif">
<INPUT NAME="email" TYPE="text" ID="email" MAXLENGTH="50" ><img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>Homepage  :</TD>
<TD width=445><INPUT name="website" id="website" value=http:// size=45 maxLength=100></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_BIRTHDAY;?> :</TD>
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
echo "<select  name=month size=1 >
		<option >------------</option>";
for($i=0;$i<count($vmont);$i++){
$cd=$i+1;
echo 	"<option value=$cd>".$vmont[$i]."</option>";

}
echo "</select>";

echo "<select  name=year size=1 >
		<option >------</option>";
for($a=$yearlast;$a<$Year;$a++){
echo 	"<option value=".$a.">".$a."</option>";
}
echo "</select>";

?>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>

<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_OLD;?> :</TD>
<TD width=445><INPUT name=age id="age" size=4 maxLength=2>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_SEX;?> :</TD>
<TD width=445><INPUT name=sex type=radio value=1 checked>
<img src="modules/alumnus/img/male.gif" ><?=_ALUM_MOD_FORM_SEX_MAN;?>
<INPUT type=radio value=2 name=sex>
<img src="modules/alumnus/img/female.gif"><?=_ALUM_MOD_FORM_SEX_GIRL;?>
<INPUT type=radio value=3 name=sex>
<img src="modules/alumnus/img/notsoure.gif"><?=_ALUM_MOD_FORM_SEX_BI;?><img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>

<TR vAlign=top>
<TD WIDTH="35%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_NUMID;?> :</TD>
<TD width=445><INPUT maxLength=30 size=30 name=numid><img src="modules/alumnus/img/priority.gif" width="11" height="12">
</TD>
</tr>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_STUID;?> :</TD>
<TD width=445><INPUT maxLength=30 size=30 name=schid> <?=_ALUM_MOD_FORM_JUM;?>
</TD>
</tr>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_YEAR_END;?> :</TD>
<TD width=445>
<?
echo "<select  name=yearfin size=1>
		<option >------</option>";
for($a=$yearlast;$a<$Year;$a++){
echo 	"<option value=".$a.">".$a."</option>";
}
echo "</select>";
?><img src="modules/alumnus/img/priority.gif" width="11" height="12">
</TD>
</tr>

                 <TR>
                    <TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_ADD;?> : </STRONG></FONT></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT NAME="address" TYPE="text" ID="address" SIZE="50" MAXLENGTH="150"></TD>
                  </TR>
                  <TR>
                    <TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_AMP;?> : </FONT></STRONG></TD>
                    <TD BGCOLOR="#FFFFFF">
                      <INPUT NAME="amper" TYPE="text" ID="amper" SIZE="30">
                    </FONT></TD>
                  </TR>

<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_PROV;?> :</TD>
<TD width=445>
<?
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
                    <TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_POST;?> : </STRONG></FONT></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT NAME="zipcode" TYPE="text" ID="zipcode"></TD>
                  </TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_TEL;?> :</TD>
<TD width=445><INPUT name="phone" id="phone" size=20 maxLength=30></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_SCHOOL;?> :</TD>
<TD width=445><INPUT maxLength=100 size=30 name=school> <?=_ALUM_MOD_FORM_SCHOOL_DETAIL;?>
</TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_OFFICE;?> :</TD>
<TD width=445><INPUT maxLength=100 size=30 name=work> <?=_ALUM_MOD_FORM_OFFICE_DETAIL;?>
</TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_HOPPY;?> :</TD>
<TD><INPUT maxLength=100 size=30 name=hobby></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_COMMENT;?> :</TD>
<TD width=545><textarea name="comment" id="comment" cols="35" rows="4"></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'comment',{toolbar: 'Mini'});</script></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>ICQ :</TD>
<TD><INPUT name=icq id="icq" size=10 maxLength=10></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>MSN :</TD>
<TD><INPUT name=msn id="msn" size=45 maxLength=50></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>YAHOO :</TD>
<TD><INPUT name=yahoo id="yahoo" size=30 maxLength=30></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>QQ :</TD>
<TD><INPUT name=qq id="qq" size=10 maxLength=10></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>Other :</div></TD>
<TD>
<input name="cam" type="checkbox" id="cam" value="1">
<img src="modules/alumnus/img/webcam.gif" width="23" height="18" align="absmiddle">
<input name="mic" type="checkbox" id="mic" value="1">
<img src="modules/alumnus/img/mic.gif" width="18" height="20" align="absmiddle"></TD>
</TR>
                  <TR>
                    <TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_MPIC;?> : </FONT></STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT TYPE="file" NAME="MPic" STYLE="width:250" CLASS="inputform" id="MPic">
                      <BR>
                      Limit <?=(_ALUMNUS_LIMIT_UPLOAD/1024);?> kB, <?=_ALUM_MOD_FORM_MPIC_LIMIT;?> <?=(_ALUMNUS_LIMIT_PICWIDTH);?> pixels </TD>
                  </TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_ALUM_MOD_FORM_ICON;?> :</TD>
<TD><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="33%"><select name="icon" id="icon" onChange="showimages()" />
<?
echo "<option value=''>-------</option>";
  if ($handle = opendir("modules/alumnus/avartar")) {
    while (false !== ($item = readdir($handle))) {
      if ($item != "." && $item != ".." && $item != "Thumbs.db" && $item != "guest.gif") {
	echo "<option value=modules/alumnus/avartar/".$item.">$item</option>";
      }
    }
    closedir($handle);
  }

?>
</select>
<script language="javascript">

function showimages()
{
if (!document.images)
return
document.images.icons.src=
	document.webForm.icon.options[document.webForm.icon.selectedIndex].value
}
//-->
</script>
</td>
<td width="67%">&nbsp;&nbsp;<a href="javascript:linkrotate(document.webForm.icon.selectedIndex)" onMouseover="window.status='';return true"><img src="modules/alumnus/avartar/member.png" name="icons" border="0"></a></td>
</tr>
</table></TD>
</TR>
<TR vAlign=top>
<TD  ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>Emotion :</TD>
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
<?
 if($login_true || $admin_user){
} else {
if(USE_CAPCHA){
?>
						<TR>
							<TD  align="right">
							<?if(CAPCHA_TYPE == 1){ 
								echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							}else if(CAPCHA_TYPE == 2){ 
								echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							};?>
							</TD>
							<TD><input name="security_code" type="text" id="security_code" size="20" maxlength="6" style="width:80" > <?=_JAVA_CAPTCHA_ADD;?></TD>
						</TR>
<?
}
}
?>
<TR vAlign=top>
<TD vAlign=center align=right>&nbsp;</TD>
<TD><input type="submit" name="Submit" value=" Submit ">
<input type="reset" name="Reset" value=" Reset "></TD>
</TR>
</TBODY>
</TABLE>
<br>
</td>
</tr>
</table>
</form>


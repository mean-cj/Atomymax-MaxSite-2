<?
include ("editor.php");
if (!empty($_SESSION['admin_user'])){
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
 &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_alumnus.png" BORDER="0">
 <table width="750" align=center cellSpacing=0 cellPadding=0 border=0><tr><TD height="1" class="dotline" colspan="4"></TD></tr></table>
 <br>
<?
include("modules/alumnus/config.inc.php");
$year=date('Y');
$yearlast=$year+484;
$Year = date("Y")+544;
$Yearlast = $Year - 484;
function birthdays($birthday){
//	$birthday = "23/03/1988";
 
	$today = date("d/m/Y");
 
	list($bday, $bmonth, $byear)= explode("/",$birthday);
 
	list($tday, $tmonth, $tyear)= explode("/",$today);
 
	$mbirthday = mktime(0, 0, 0, $bmonth, $bday, $byear);
 
	$mnow = mktime(0, 0, 0, $tmonth, $tday, $tyear );
 
	$mage = ($mnow - $mbirthday);
 
//	echo "วันเกิด $birthday"."<br>\n";
 
//	echo "วันที่ปัจจุบัน $today"."<br>\n";
 
	echo "ปัจจุบันอายุ ".(date("Y", $mage)-1970)."ปี ".(date("m",$mage)-1)."เดือน ".(date("d",$mage)-1)."วัน"."<br>\n";

}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$qr= $db->select_query("SELECT * FROM ".TB_ALUMNUS." where id='".$_GET['id']."'  ");
$arr = $db->fetch($qr);
?>
<form action="index.php?name=alumnus&file=editok&id=<?=$_GET['id'];?>" method="post" enctype="multipart/form-data" name="webForm" id="webForm" onSubmit="return check1()">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="style">
<tr>
<td><TABLE width=571 border=0 align="center" cellPadding=3 class="style">
<TBODY>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_NAME;?> :</b></TD>
<TD width=345 height=2><INPUT maxLength=30 size=45 name=first_name value="<?=$arr['first_name'];?>">
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_SUR;?> :</b></TD>
<TD width=345><INPUT maxLength=40 size=45 name=last_name value="<?=$arr['last_name'];?>">
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_NICK;?> :</b></TD>
<TD width=345><INPUT maxLength=20 size=25 name=nic_name value="<?=$arr['nic_name'];?>">
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b>Email :</b></TD>
<TD BGCOLOR="#FFFFFF"><INPUT NAME="email" TYPE="text" ID="email" MAXLENGTH="80" value="<?=$arr['email'];?>"><img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b>Homepage :</b></TD>
<TD width=345><INPUT name="website" id="website" value="<?=$arr['website'];?>" size=45 maxLength=100></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_BIRTHDAY;?> :</b></TD>
<?
$dt=date('d');
$mt=date('m');
$yy=date('Y');
$yt=$yy+543;
list($bsday, $bsmonth, $bsyear)= explode("/",$arr['birthday']);
//echo "$bsday<br>$bsmonth<br>$bsyear";
echo "<TD width=400><SELECT name=day>
		<option >--</option>";
for($i=1;$i<32;$i++){
echo 	"<option value=$i ";if($bsday==$i){ echo " selected" ; } echo ">$i</option>";
}
echo "</select>";
$vmont  = array(_F_Month_1, _F_Month_2, _F_Month_3, _F_Month_4, _F_Month_5, _F_Month_6, _F_Month_7, _F_Month_8, _F_Month_9, _F_Month_10, _F_Month_11, _F_Month_12);

echo "<select  name=month size=1>
		<option >------------</option>";
for($i=0;$i<count($vmont);$i++){
$cd=$i+1;
echo 	"<option "; if($bsmonth=="".$cd.""){ echo "selected" ; } echo " value=".$cd.">".$vmont[$i]."</option>";
}
echo "</select>";

echo "<select  name=year size=1>
		<option >------</option>";
for($a=$yearlast;$a<$Year;$a++){
echo 	"<option "; if($bsyear=="".$a.""){ echo "selected" ; } echo " value=".$a.">".$a."</option>";
}
echo "</select>";

?>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>

<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="2"><b><?=_ALUM_MOD_FORM_OLD;?> :</b></TD>
<TD width=345><INPUT name=age id="age" size=4 maxLength=2 value="<?=$arr['age'];?>" >
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="2"><b><?=_ALUM_MOD_FORM_SEX;?> :</b></TD>
<TD width=345><INPUT name=sex type=radio value=1 <?if($arr['sex']=="1"){ echo "checked" ; }?>>
<img src="modules/alumnus/img/male.gif" > <?=_ALUM_MOD_FORM_SEX_MAN;?>
<INPUT type=radio value=2 name=sex <?if($arr['sex']=="2"){ echo "checked" ; }?>>
<img src="modules/alumnus/img/female.gif"> <?=_ALUM_MOD_FORM_SEX_GIRL;?>
<INPUT type=radio value=3 name=sex <?if($arr['sex']=="3"){ echo "checked" ; }?>>
<img src="modules/alumnus/img/notsoure.gif"> <?=_ALUM_MOD_FORM_SEX_BI;?><img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>

<TR vAlign=top>
<TD WIDTH="35%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_NUMID;?> :</b></TD>
<TD width=345><INPUT maxLength=30 size=30 name=numid value="<?=$arr['numid'];?>"><img src="modules/alumnus/img/priority.gif" width="11" height="12">
</TD>
</tr>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_STUID;?> :</b></TD>
<TD width=345><INPUT maxLength=30 size=30 name=schid value="<?=$arr['schid'];?>"> <?=_ALUM_MOD_FORM_JUM;?>
</TD>
</tr>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_YEAR_END;?> :</b></TD>
<TD width=345>
<?
echo "<select  name=yearfin size=1>
		<option >------</option>";
for($a=$yearlast;$a<$Year;$a++){
echo 	"<option "; if($arr['yearfin']=="".$a.""){ echo "selected" ; } echo " value=".$a.">".$a."</option>";
}
echo "</select>";
?><img src="modules/alumnus/img/priority.gif" width="11" height="12">
</TD>
</tr>

                 <TR>
                    <TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_ADD;?> : </b></STRONG></FONT></FONT></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT NAME="address" TYPE="text" ID="address" SIZE="50" MAXLENGTH="150" value="<?=$arr['address'];?>"></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_AMP;?> : </b></FONT></STRONG></TD>
                    <TD BGCOLOR="#FFFFFF">
                      <INPUT NAME="amper" TYPE="text" ID="amper" SIZE="30" value="<?=$arr['amper'];?>">
                    </FONT></TD>
                  </TR>

<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_PROV;?> :</b></TD>
<TD width=345>
<?
$vprovince  = array(_PROVINCE_1, _PROVINCE_2, _PROVINCE_3, _PROVINCE_4, _PROVINCE_5, _PROVINCE_6, _PROVINCE_7, _PROVINCE_8, _PROVINCE_9, _PROVINCE_10, _PROVINCE_11, _PROVINCE_12, _PROVINCE_13, _PROVINCE_14, _PROVINCE_15, _PROVINCE_16, _PROVINCE_17, _PROVINCE_18, _PROVINCE_19, _PROVINCE_20, _PROVINCE_21, _PROVINCE_22, _PROVINCE_23, _PROVINCE_24, _PROVINCE_25, _PROVINCE_26, _PROVINCE_27, _PROVINCE_28, _PROVINCE_29, _PROVINCE_30, _PROVINCE_31, _PROVINCE_32, _PROVINCE_33, _PROVINCE_34, _PROVINCE_35, _PROVINCE_36, _PROVINCE_37, _PROVINCE_38, _PROVINCE_39, _PROVINCE_40, _PROVINCE_41, _PROVINCE_42, _PROVINCE_43, _PROVINCE_44, _PROVINCE_45, _PROVINCE_46, _PROVINCE_47, _PROVINCE_48, _PROVINCE_49, _PROVINCE_50, _PROVINCE_51, _PROVINCE_52, _PROVINCE_53, _PROVINCE_54, _PROVINCE_55, _PROVINCE_56, _PROVINCE_57, _PROVINCE_58, _PROVINCE_59, _PROVINCE_60, _PROVINCE_61, _PROVINCE_62, _PROVINCE_63, _PROVINCE_64, _PROVINCE_65, _PROVINCE_66, _PROVINCE_67, _PROVINCE_68, _PROVINCE_69, _PROVINCE_70, _PROVINCE_71, _PROVINCE_72, _PROVINCE_73, _PROVINCE_74, _PROVINCE_75, _PROVINCE_76, _PROVINCE_77);
echo "<select  name=province size=1 >
		<option >------------</option>";
for($i=0;$i<count($vprovince);$i++){
echo 	"<option value=$vprovince[$i] ";
if($arr['province']==$vprovince[$i]){echo "selected" ; }
echo ">".$vprovince[$i]."</option>";
}
echo "</select>";
?>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
                 <TR>
                    <TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_POST;?> : </b></TD>
                    <TD BGCOLOR="#FFFFFF"><INPUT NAME="zipcode" TYPE="text" ID="zipcode" value="<?=$arr['zipcode'];?>" ></TD>
                  </TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_TEL;?> :</b></TD>
<TD width=345><INPUT name="phone" id="phone" size=20 maxLength=30 value="<?=$arr['phone'];?>" ></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_SCHOOL;?> :</b></TD>
<TD width=345><INPUT maxLength=100 size=30 name=school value="<?=$arr['school'];?>" > <?=_ALUM_MOD_FORM_SCHOOL_DETAIL;?>
</TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_OFFICE;?> :</b></TD>
<TD width=345><INPUT maxLength=100 size=30 name=work value="<?=$arr['WORK'];?>" > <?=_ALUM_MOD_FORM_OFFICE_DETAIL;?>
</TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_HOPPY;?> :</b></TD>
<TD><INPUT maxLength=100 size=30 name=hobby value="<?=$arr['hobby'];?>"></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_COMMENT;?> :</b></TD>
<TD width=345><textarea name="comment" cols="45" rows="3" id=name="comment"><?=$arr['COMMENT'];?></textarea><script type="text/javascript">CKEDITOR.replace ( 'comment',{toolbar: 'Mini'});</script></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b>ICQ :</b></TD>
<TD><INPUT name=icq id="icq" size=10 maxLength=10 value="<?=$arr['icq'];?>"></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b>MSN :</b></TD>
<TD><INPUT name=msn id="msn" size=45 maxLength=50 value="<?=$arr['msn'];?>"></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b>YAHOO :</b></TD>
<TD><INPUT name=yahoo id="yahoo" size=30 maxLength=30 value="<?=$arr['yahoo'];?>"></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b>QQ :</b></TD>
<TD><INPUT name=qq id="qq" size=10 maxLength=10 value="<?=$arr['qq'];?>"></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b>Other :</b></TD>
<TD>
<input name="cam" type="checkbox" id="cam" value="1" <?if($arr['cam']=="1"){ echo "checked" ; }?>>
<img src="modules/alumnus/img/webcam.gif" width="23" height="18" align="absmiddle">
<input name="mic" type="checkbox" id="mic" value="1" <?if($arr['mic']=="1"){ echo "checked" ; }?>>
<img src="modules/alumnus/img/mic.gif" width="18" height="20" align="absmiddle"></TD>
</TR>
                  <TR>
                    <TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_MPIC;?> :</b></TD>
                    <TD BGCOLOR="#FFFFFF"><input type=hidden name=pic value=<?=$arr['picture'];?>><?if($arr['picture'] !=""){ echo "<img src=icon/".$arr['picture']." border=0><br>" ; } else { echo "<img src=images/user_blank.gif border=0><br>";}?>
					<INPUT TYPE="file" NAME="MPic" STYLE="width:250" CLASS="inputform">
                      <BR>
                      Limit <?=(_ALUMNUS_LIMIT_UPLOAD/1024);?> kB, <?=_ALUM_MOD_FORM_MPIC_LIMIT;?> <?=(_ALUMNUS_LIMIT_PICWIDTH);?> pixels </TD>
                  </TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><b><?=_ALUM_MOD_FORM_ICON;?> :</b></TD>
<TD><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="33%"><select name="icon" id="icon" onChange="showimages()" />
<?
  if ($handle = opendir("modules/alumnus/avartar")) {
    while (false !== ($item = readdir($handle))) {
      if ($item != "." && $item != ".." && $item != "Thumbs.db" && $item != "guest.gif") {
	echo "<option "; if($arr['icon']=="".$item.""){ echo "selected" ; } echo " value=modules/alumnus/avartar/".$item.">$item</option>";
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
document.images.icons.src=document.webForm.icon.options[document.webForm.icon.selectedIndex].value
}
//-->
</script>
</td>
<td width="67%">&nbsp;&nbsp;<a href="javascript:linkrotate(document.webForm.icon.selectedIndex)" onMouseover="window.status='';return true"><img src="modules/alumnus/avartar/<?=$arr['icon'];?>" name="icons" border="0"></a></td>
</tr>
</table></TD>
</TR>
<TR vAlign=top>
<TD WIDTH="30%" ALIGN="right" BGCOLOR="#FFFFFF"><FONT SIZE="2"><STRONG><FONT FACE="MS Sans Serif, Tahoma, sans-serif">Emotion :</TD>
<TD><input name="emo" type="radio" value="e1" <?if($arr['emo']=="e1"){ echo "checked" ; }?> >
<img src="modules/alumnus/emotion/e1.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e2" <?if($arr['emo']=="e2"){ echo "checked" ; }?>>
<img src="modules/alumnus/emotion/e2.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e3" <?if($arr['emo']=="e3"){ echo "checked" ; }?>>
<img src="modules/alumnus/emotion/e3.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e4" <?if($arr['emo']=="e4"){ echo "checked" ; }?>>
<img src="modules/alumnus/emotion/e4.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e5" <?if($arr['emo']=="e5"){ echo "checked" ; }?>>
<img src="modules/alumnus/emotion/e5.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e6" <?if($arr['emo']=="e6"){ echo "checked" ; }?>>
<img src="modules/alumnus/emotion/e6.gif" width="19" height="19" align="absmiddle"><br>
<input name="emo" type="radio" value="e7" <?if($arr['emo']=="e7"){ echo "checked" ; }?>>
<img src="modules/alumnus/emotion/e7.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e8" <?if($arr['emo']=="e8"){ echo "checked" ; }?>>
<img src="modules/alumnus/emotion/e8.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e9" <?if($arr['emo']=="e9"){ echo "checked" ; }?>>
<img src="modules/alumnus/emotion/e9.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e10" <?if($arr['emo']=="e10"){ echo "checked" ; }?>>
<img src="modules/alumnus/emotion/e10.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e11" <?if($arr['emo']=="e11"){ echo "checked" ; }?>>
<img src="modules/alumnus/emotion/e11.gif" width="20" height="20" align="absmiddle">
<input name="emo" type="radio" value="e12" <?if($arr['emo']=="e12"){ echo "checked" ; }?>>
<img src="modules/alumnus/emotion/e12.gif" width="20" height="20" align="absmiddle"></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right>&nbsp;</TD>
<TD><input type="submit" name="Submit" value=" Submit ">
<input type="reset" name="Reset" value=" Reset "></TD>
</TR>
</TBODY>
</TABLE>
</td>
</tr>

</table>

<?
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

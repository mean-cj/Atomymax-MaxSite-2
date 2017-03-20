
<?
include "modules/alumnus/config.inc.php";
 $_GET['id'] = intval($_GET['id']);

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$result= $db->select_query("SELECT * FROM ".TB_ALUMNUS." where id='".$_GET['id']."'  ");
$NRow = $db->num_rows(TB_ALUMNUS,"id",""); 
$arr = $db->sql_fetchrow($result);


// ตัวแปล ชื่อเล่น
$names = $arr[5];

// ปิดการติดต่อฐานข้อมูล
//mysql_close( $db );

?>

<title>: : <?=_ALUM_MOD_VIEW_TITLE;?> <? echo $names ?> : :</title>
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
<link href="css/template_css.css" rel="stylesheet" type="text/css">
<IMG SRC="images/menu/textmenu_alumnus.png" BORDER="0">
 <table width="400" align=center cellSpacing=0 cellPadding=0 border=0><tr><TD height="1" class="dotline" colspan="4"></TD></tr></table>
 <br>
<center><table width="500" height="300" border="0" align="center" cellpadding="5" cellspacing="0" >
<tr>
<td valign="top"  align="center">

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class=grids>
<tr valign="top" class=odd>
<td width="20%" rowspan="16" ><div align="center"><? if ($arr[8]=="") { echo "<img src=images/nopic.jpg>"; } else { echo "<img src=icon/$arr[8]>"; } ?>
    <br>
    <? echo "$arr[4]"; ?><br>
</div></td>
<td width="30%" ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_VIEW_NAME;?>&nbsp;:&nbsp;</strong></font></div></td>
<td width="70%" ><? echo "$arr[2]&nbsp;&nbsp;$arr[3]"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_FORM_NICK;?>&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "$arr[4]"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_VIEW_BIRTH;?>&nbsp;:&nbsp;</strong></font></div></td>
<?
$thaidate=formatDateThai($arr[5]);
?>
<td ><? echo "$thaidate"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_FORM_OLD;?>&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "$arr[6]"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_FORM_SEX;?>&nbsp;:&nbsp;</strong></font></div></td>
<td ><? if ($arr[7]=="1") {	echo ""._ALUM_MOD_FORM_SEX_MAN."";	} elseif ($arr[6]=="2") { echo ""._ALUM_MOD_FORM_SEX_GIRL.""; } elseif ($arr[6]=="3") { echo ""._ALUM_MOD_FORM_SEX_BI.""; } else {}; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong>E-mail&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "<a href=mailto:$arr[12]>$arr[12]</a>"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong>Homepage&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "<a href=$arr[13] target=_blank>$arr[13]</a>"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_FORM_ADD;?>&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "$arr[14]"; ?></td>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_FORM_AMP;?>&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "$arr[15]"; ?></td>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_FORM_PROV;?>&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "$arr[16]"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_FORM_POST;?>&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "$arr[31]"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_FORM_TEL;?>&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "$arr[30]"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_VIEW_SCHOOL;?>&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "$arr[17]"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_FORM_OFFICE;?>&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "$arr[18]"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ><div align="right"><font color="#990000"><strong><?=_ALUM_MOD_FORM_HOPPY;?>&nbsp;:&nbsp;</strong></font></div></td>
<td ><? echo "$arr[19]"; ?></td>
</tr>
<tr valign="top" class=odd>
<td ></td>
<td ><? if ($arr[26]=="1") { echo "<img src=modules/alumnus/img/webcam.gif>"; } else { echo ""; } ?><? if ($arr[27]=="1") { echo "<img src=modules/alumnus/img/mic.gif>"; } else { echo ""; } ?></td>
</tr>
</table></td>
</tr>
</table>

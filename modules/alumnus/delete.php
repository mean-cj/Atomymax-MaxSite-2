<?
if (!empty($_SESSION['admin_user'])){
	?>
 &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_alumnus.png" BORDER="0">
 <table width="750" align=center cellSpacing=0 cellPadding=0 border=0><tr><TD height="1" class="dotline" colspan="4"></TD></tr></table>
 <br>
<?
include("modules/alumnus/config.inc.php");
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$result = $db->select_query("select * from ".TB_ALUMNUS." where id='".$_GET['id']."' ") ;
while ($arr = $db->sql_fetchrow($result))
			{
		// ทำการเช็คก่อนว่ามีไฟล์รูปหรือไม่
			if($arr[8]=="") {  } else { 
				$file_com = "$path/$arr[8]";
			if (file_exists( $file_com )) { unlink("$file_com"); } else {  };  #ทำการลบรูปออกไป
			};
		}

		// ทำการลบข้อมูล
		$db->del(TB_ALUMNUS," id='".$_GET['id']."' "); 
		$db->closedb ();
		echo "<br><center>";
		echo "<table width=60% border=0 bgcolor=#ffffff cellpadding=7 cellspacing=1>";
		echo "<tr><td align=center bgcolor=#ffffff>";
		echo "<font size=2 face='MS Sans Serif'>";
		echo "<font size=3 color=red><b>"._ALUM_MOD_FORM_DEL_FINISH."</b></font><br><br>";
		echo "</font></td></tr></table></center>";

// โชว์รายละเอียด
print "<meta http-equiv=refresh content=0;URL=index.php?name=alumnus>";
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

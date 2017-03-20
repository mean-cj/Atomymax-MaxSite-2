<?header("content-type: application/x-javascript; charset=tis-620");?>

	<TABLE cellSpacing=0 cellPadding=0  border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD  vAlign=top>
				<TABLE  align=center cellSpacing=0 width="400" cellPadding=0 border=0>
<?
//$_GET['id'] = intval($_GET['id']);
//แสดงข่าวสาร/ประชาสัมพันธ์ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." WHERE id='".$_GET['id']."' ");
$arr['research'] = $db->fetch($res['research']);
$db->closedb ();
$id=$arr['research']['id'];
if(!$arr['research']['id']){
	echo "<BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>"._RESEARCH_MOD_READ_NOID."</B></CENTER><BR><BR><BR><BR>";
}else{
	$content = $arr['research']['detail'];
	$Detail = stripslashes(FixQuotes($content));
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." WHERE id='".$arr['research']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$db->closedb ();
?>

				<tr>
				<td><B><FONT COLOR="#990000"><h5><?=_FORM_CAT;?> <FONT COLOR="#0066FF"><?=$arr['category']['category_name'];?></h>
				</td>
				</tr>
				<TR>
					<TD valign="top">

					<table>
					<tr>
					<td valign="top">
					<img src="icon/research_<?=$arr['research']['post_date'];?>.jpg">
					</td>
					<td>

					<table>
					<tr>
					<td valign="top" bgcolor="#F5F5F5"><B><FONT COLOR="#3333FF"><h5><?=_FORM_MOD_READ_CONT;?></font><FONT COLOR="#990000"><?=$arr['research']['topic'];?></FONT>
					</td>
					</tr>
					<tr>
					<td bgcolor="#F5F5F5"><?=_FORM_MOD_POSTEDX;?> <?=$arr['research']['posted'];?></B>
					</td>
					</tr>
					<tr>
					<td bgcolor="#F5F5F5"><?=_FORM_MOD_READ;?> <?=$arr['research']['pageview'];?>
					</td>
					</tr>
					<tr>
					<td bgcolor="#F5F5F5">
					<?= ThaiTimeConvert($arr['research']['post_date'],"1","");?>						
</td>
					</tr>
					</table></td></tr>
</table>

					</TD>
				</TR>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR>
					<?=$arr['research']['headline'];?>
					<BR><BR>
					</TD>
				</TR>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>


<?
			$count  ++;
	}


?>
</table>
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
	
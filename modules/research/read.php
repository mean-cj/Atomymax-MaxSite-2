
<?
header("content-type: application/x-javascript; charset=tis-620");
?>
<TABLE cellSpacing=0 cellPadding=0  border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>

				<TABLE width="500" align=center cellSpacing=0 cellPadding=0 border=0>
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
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." WHERE id='".$_GET['id']."' ");
$arr['research'] = $db->fetch($res['research']);
$db->closedb ();
	$content = $arr['research']['detail'];
	$Detail = stripslashes(FixQuotes($content));
	//ทำการเพิ่มจำนวนคนเข้าชม
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$q['Pageview'] = "UPDATE ".TB_RESEARCH." SET pageview = pageview+1 WHERE id = '".$_GET['id']."' ";
	$sql['Pageview'] = mysql_query ( $q['Pageview'] ) or sql_error ( "db-query",mysql_error() );
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." WHERE id='".$arr['research']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$db->closedb ();
?>
				<TR>
					<TD colspan="2">
					<B><FONT COLOR="#990000" size=3><?=$arr['category']['category_name'];?>
					</td>
				</tr>
				<TR>
					<TD height="1" class="dotline" colspan="2"></TD>
				</TR>
				<TR>
				<TD align=center bgcolor="#F5F5F5">&nbsp;<img src="icon/research_<?=$arr['research']['post_date'];?>.jpg" >&nbsp;&nbsp;
					</TD>

					<TD width=100% bgcolor="#F5F5F5" valign="top"><FONT COLOR="#000099" size=3><?=_FORM_MOD_READ_CONT;?> </font><FONT COLOR="#CC0000" size=3><?=$arr['research']['topic'];?></FONT></font><?=NewsIcon(TIMESTAMP, $arr['research']['post_date'], "images/icon_new.gif");?><br><br></font><FONT size=2><?=_RESEARCH_AUTHX;?> : <FONT COLOR="#CC0000" size=2> <?=$arr['research']['auth'];?></FONT></B></font><br>
					<?= ThaiTimeConvert($arr['research']['post_date'],"1","");?>
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  <a href="?name=admin&file=research&op=research_edit&id=<? echo $arr['research']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
				  <a href="javascript:Confirm('?name=admin&file=research&op=research_del&id=<? echo $arr['research']['id'];?>&prefix=<? echo $arr['research']['post_date'];?>','<? echo _FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
<?
}
				  ?>
				  <BR>
					<?=_DETAIL_PRIVIEW;?> : <?=$arr['research']['pageview'];?>&nbsp;&nbsp;&nbsp; <?=_RESEARCH_MOD_DOWN_COUNT;?> :  <?=$arr['research']['rate'];?> <?=_RESEARCH_MOD_DOWN_COUNT_NUM;?>

<br>
<?
$rater_ids=$_GET['id'];
$rater_item_name='research';
include("modules/rater/rater.php");
?>
					</TD>
				</TR>
				<TR>
					<TD height="1" class="dotline" colspan="2"></TD>
				</TR>

				<TR>
					<TD colspan="2">
					<BR><font size=2><b><?=_RESEARCH_MOD_ABSTRACT;?> : <br></font></b>
					<?=$Detail;?>

					<BR><BR>
					</TD>
				</TR>

				<TR>
					<TD height="1" class="dotline" colspan="2"></TD>
				</TR>
					<?
 if($arr['research']['full_text']){ 	
?><tr>
<td width=100% bgcolor=#F7F7F7 colspan=2 align=center>
<h5 align="right"><?=_FORM_MOD_DONWLOAD;?>&nbsp;<a href="?name=research&file=rate&id=<?=$arr['research']['id']; ?>&filess=<?=$arr['research']['full_text'];?>"> [Fulltext]</a></td></tr>
<? } 
						$abstracta=$arr['research']['abstract'];
						if ($abstracta !='') {
						echo "<tr><td width=100% bgcolor=#F7F7F7 colspan=2 align=center><font size=2><h5 align=left>"._FORM_MOD_DONWLOAD."&nbsp;<a href=?name=research&file=rate&id=$id&filess=$abstracta>&nbsp;[ "._RESEARCH_MOD_ABSTRACT." ]&nbsp;</a></h5></td></tr>";
						}
						?>
</table>
<?
}
?>


			<!-- End research -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>

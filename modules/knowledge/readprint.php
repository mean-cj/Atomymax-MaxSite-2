<script type="text/javascript">
function showemotion() {
	emotion1.style.display = 'none';
	emotion2.style.display = '';
}
function closeemotion() {
	emotion1.style.display = '';
	emotion2.style.display = 'none';
}

function emoticon(theSmilie) {

	document.form2.COMMENT.value += ' ' + theSmilie + ' ';
	document.form2.COMMENT.focus();
}
</script>
<? OpenTablecom();?>
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0>
<?
$_GET['id'] = intval($_GET['id']);
//แสดงสาระน่ารู้ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['knowledge'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE." WHERE id='".$_GET['id']."' ");
$arr['knowledge'] = $db->fetch($res['knowledge']);
$db->closedb ();
if(!$arr['knowledge']['id']){
	echo "<tr><td><BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>"._FROM_CAT_NO"</B></CENTER><BR><BR><BR><BR></td></tr></table>";
}else{

	$thepage = $arr['knowledge']['detail'];
	$Detail = stripslashes(FixQuotes($thepage));
	//ทำการเพิ่มจำนวนคนเข้าชม
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$q['Pageview'] = "UPDATE ".TB_KNOWLEDGE." SET pageview = pageview+1 WHERE id = '".$_GET['id']."' ";
	$sql['Pageview'] = mysql_query ( $q['Pageview'] ) or sql_error ( "db-query",mysql_error() );
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE_CAT." WHERE id='".$arr['knowledge']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$db->closedb ();
?>
<tr>
<td>
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0 background="images/bread.jpg" height=171>
				<tr>
				<td valign="top" align="left" colspan="3"><B><FONT COLOR="#990000">&nbsp;&nbsp;<?=_FORM_CAT;?> <FONT COLOR="#0066FF"><?=$arr['category']['category_name'];?>
				</td>
				</tr>

				<TR>
					<TD valign="top" >
					<?if ($arr['knowledge']['pic']==1){echo "<img  class=mysborder src=icon/knowledge_".$arr['knowledge']['post_date'].".jpg border=0 align=left>";} else {echo "<img class=mysborder src=images/icon/".$arr['category']['icon']." border=0 align=left>";} ?>
					</td>
					<td valign="top" >
					<table cellSpacing=0 cellPadding=0 border=0>
					<tr>
					<td valign="top" width="100%">
					<B><FONT COLOR="#3333FF"><?=_FORM_MOD_READ_CONT;?> </font><FONT COLOR="#990000"><?=$arr['knowledge']['topic'];?></FONT>					<?=NewsIcon(TIMESTAMP, $arr['knowledge']['post_date'], "images/icon_new.gif");?></td></tr>
					<tr>
					<td>
					<?=_FORM_MOD_POSTEDX;?> <?=$arr['knowledge']['posted'];?>
					</td>
					</tr>
					<tr>
					<td><?=_DETAIL_PRIVIEW;?>  : <?=$arr['knowledge']['pageview'];?>
					</td>
					</tr>
					<tr>
					<td>
					<?= ThaiTimeConvert($arr['knowledge']['post_date'],"1","");?>
					</td>
					<tr>
					</table>
			</td>
			<td valign="top" align="right"><a href="#" onclick="window.print();return false;"><img src="images/printButton.png" alt="<?=_FORM_BUTTON_PRINT;?>"  /></a>&nbsp;&nbsp;
			</td>
			</tr>
			</table>
</td>
</tr>
				<TR>
					<TD>
					<BR>
					<?=breakpage($mod,$page,$id,$thepage);?>
					<BR><BR>
					</TD>
				</TR>
</table>
<?
}
?>
<?CloseTablecom();?>


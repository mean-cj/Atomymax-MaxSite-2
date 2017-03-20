										<table class='iconframe' cellpadding='0' cellspacing='0'>
										<tbody>
										<tr>
										<td class='imageframe'>
  													<TABLE width="<?=$widthSUMC;?>" align=center cellSpacing=0 cellPadding=0 border=0>
			<tr><td colspan="<?=_RESEARCH_COL;?>"><BR>
<div align="right"><B><IMG SRC="images/icon/icon_folder.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=research"><?=_RESEARCH_ALL;?></A> &nbsp;&nbsp;&nbsp; <IMG SRC="images/icon/icon_add.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=research&file=add&op=research_add"><?=_RESEARCH_ADD;?></A></B>&nbsp;&nbsp;</div>
<BR></td></tr>
  <?

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 7;

$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." ORDER BY id DESC LIMIT $limit ");
$count=0;
$i=1;
while($arr['research'] = $db->fetch($res['research'])){
if($i%2==0) { //疏枪⑼А颐 逝押收 
$ColorFill = "#ffffff";
} else {
$ColorFill = "#F9F9F9";
}
	$content = $arr['research']['detail'];
	$Detail = stripslashes(FixQuotes($content));
//   $subject = "㈤亭且立挂创创创创创创创创创创创创创 乱擎";
   if(strlen($Detail)>75) {
    // ㄓ⊙搐且谅仪⑼А眯焚榉砧 55 笛峭选擅
    $Detail = substr($Detail,0,75)."...";
   }

if ($i <=_RESEARCH_COL){
	if ($count==0) { echo "<TR>"; }
	//柰肆谴肆勹 
	$res['category'] = $db->select_query("SELECT category_name FROM ".TB_RESEARCH_CAT." WHERE id='".$arr['research']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$researchid=$arr['research']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(id) as com FROM ".TB_RESEARCH_COMMENT." WHERE id ='".$researchid."' group by id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>
			<TD width="50%" valign=top align="left" valign="top">	
				<TABLE width="100%" align="left">
				<TR>
				<TD class="timemini"><font size="4"><b><?= ThaiTimeMini($arr['research']['post_date'],"");?></b></font></td>
				<td ><?=_RESEARCH_AUTH;?> <FONT COLOR="#990000"><B><?=$arr['research']['auth'];?></font><br><font color=#C3C3C3> 
					<?= ThaiTimeConvert($arr['research']['post_date'],"","");?> </font></td></tr>
					<tr><td colspan="2"><?$rater_ids=$arr['research']['id'];$rater_item_name='research';include("modules/rater/raterss.php");?>
					</B></FONT></TD>
				</TR>
				<TR>
					<TD valign="top" colspan="2">
					<img  src="icon/research_<?=$arr['research']['post_date'];?>.jpg" class="mysborder" border="0"  width="<?=_Iresearch_W;?>" align="left"><A HREF="?name=research&file=readresearch&id=<?=$arr['research']['id'];?>" target="_blank"><B><?=$arr['research']['topic'];?></A></B>
					<?=NewsIcon(TIMESTAMP, $arr['research']['post_date'], "images/icon_new.gif");?><font color=#C3C3C3> ( <?=$arr['research']['pageview'];?> / <?=$arrs['com']['com'];?> )</font>
					<?//=$Detail;?>
					</TD>
				</TR>
				<TR><TD height="3" ></TD></TR>
				</TABLE>
			</TD>
<?
$count++;
if (($count%_RESEARCH_COL) == 0) { echo "</TR><TR><TD colspan=2 height=\"1\" bgcolor=\"$ColorFill\"></TD></TR>"; $count=0; 
} else{	echo "</TD>";} 

} else {
echo "<TR onmouseover=\"this.style.backgroundColor='#FFF0DF'\" onmouseout=\"this.style.backgroundColor='$ColorFill'\" bgcolor='$ColorFill' >";
?>

												<TD bgcolor="<?=$ColorFill;?>" onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='<?=$ColorFill;?>'"  width="100%" valign=top height="20" align="left" colspan="<?=_RESEARCH_COL;?>">	
															<IMG SRC="images/admin/open.gif" BORDER="0" ALIGN="absmiddle"><A HREF="?name=research&file=readresearch&id=<?=$arr['research']['id'];?>"  name="<?=$arr['research']['id'];?>" ><font color="#990066">(<?= ThaiTimeConvert($arr['research']['post_date'],"","");?>) </font><B><?=$arr['research']['topic'];?></A></B>
					<?=NewsIcon(TIMESTAMP, $arr['research']['post_date'], "images/icon_new.gif");?><font color="#CC3300">( <?=_RESEARCH_READ;?> <?=$arr['research']['pageview'];?> )</font> <?=_RESEARCH_AUTH;?> <font color="#CC3300"><?=$arr['research']['auth'];?>
													</TD></tr>

<?
}
$i++;
}
$db->closedb ();

?>
													<tr>
													<td colspan="2" align="right"><A HREF="index.php?name=research" ><img src="images/admin/2_15.gif"></a></td>
													</tr>
													</table>
											</td>
											</tr>
											</table>

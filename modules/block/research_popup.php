										<table class='iconframe' cellpadding='0' cellspacing='0'>
										<tbody>
										<tr>
										<td class='imageframe'>
  													<TABLE width="520" align=center cellSpacing=0 cellPadding=0 border=0>
			<tr><td><BR>
<div align="right"><B><IMG SRC="images/icon/icon_folder.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=research"><?=_RESEARCH_ALL;?></A> &nbsp;&nbsp;&nbsp; <IMG SRC="images/icon/icon_add.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=research&file=add&op=research_add"><?=_RESEARCH_ADD;?> </A></B>&nbsp;&nbsp;</div>
<BR></td></tr>
  <?

//$_GET[category]=1;
if($_GET[category]){
	$SQLwhere = " category='".$_GET[category]."' ";
	$SQLwhere2 = " WHERE category='".$_GET[category]."' ";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 10;
$SUMPAGE = $db->num_rows(TB_RESEARCH,"id","$SQLwhere");
$page=$_GET[page];
if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$res[research] = $db->select_query("SELECT * FROM ".TB_RESEARCH." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
$Color == 0;
while($arr[research] = $db->fetch($res[research])){
//	if ($count==0) { echo "<TR>"; }
echo "<TR>"; 
		if($Color == 0){
		$Color = 1 ;
		$ColorFill = "#F0F0F0";
	}else{
		$Color = 0 ;
		$ColorFill = "#FDEAFB";
	}

	//ชื่อหมวดหมู่ 
	$res[category] = $db->select_query("SELECT category_name FROM ".TB_RESEARCH_CAT." WHERE id='".$arr[research][category]."' "); 
	$arr[category] = $db->fetch($res[category]);
	$researchid=$arr[research][id];
	$ress[com] = $db->select_query("SELECT *,count(id) as com FROM ".TB_RESEARCH_COMMENT." WHERE id ='".$researchid."' group by id"); 
	$arrs[com] = $db->fetch($ress[com]);
?>
												<TD bgcolor="<?=$ColorFill; ?>" width="100%" valign=top height="20" align="left">	
															<IMG SRC="images/admin/open.gif" BORDER="0" ALIGN="absmiddle"><A HREF="?name=research&file=readresearch&id=<?=$arr[research][id];?>"  name="<?=$arr[research][id];?>" title="ajax:index3.php?name=research&file=readresearchtip&id=<?=$arr[research][id];?>"><font color="#990066"><B>[ <?= ThaiTimeConvert($arr[research][post_date],"","");?> ] </font><font color="#0066FF"><?=$arr[research][topic];?></A></font></B>
					<?=NewsIcon(TIMESTAMP, $arr[research][post_date], "images/icon_new.gif");?><font color="#CC3300">( <?=_RESEARCH_READ;?> <?=$arr[research][pageview];?> )</font> <?=_RESEARCH_AUTH;?> <font color="#CC3300"><?=$arr[research][auth];?>
													</TD>

<?
$count++;

echo "</Tr><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>";
if (($count%_RESEARCH_COL) == 0) { echo "</TR><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; 
} else{	echo "</Tr><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>";} 
//echo "</Tr>";
}
$db->closedb ();

?>
													<td>
													</tr>
													<tr>
													<td colspan="2" align="right"><A HREF="index.php?name=research" ><img src="images/admin/2_15.gif"></a></td>
													</tr>
													</table>
											</td>
											</tr>
											</table>


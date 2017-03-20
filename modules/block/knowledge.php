	
										<table class='iconframe' cellpadding='0' cellspacing='0'>
										<tbody>
										<tr>
										<td class='imageframe'>
  													<TABLE width="<?=$widthSUMC;?>" align=center cellSpacing=0 cellPadding=0 border=0>
  <?
//empty($_GET['category'])?$category="1":$category=$_GET['category'];
$category=$_GET['category'];
if(!empty($category)){
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " WHERE category='".$category."' ";
} else {
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " ";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 7 ;

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['knowledge'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE." $SQLwhere2 ORDER BY id DESC LIMIT $limit ");
$count=0;
$i=1;
while($arr['knowledge'] = $db->fetch($res['knowledge'])){
if($i%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#ffffff";
} else {
$ColorFill = "#F9F9F9";
}
if ($i <=_KNOW_COL){
	if ($count==0) { echo "<TR>"; }
	$content = $arr['knowledge']['headline'];
	$Detail = stripslashes(FixQuotes($content));

	$res['category'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE_CAT." WHERE id='".$arr['knowledge']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$knowledgeid=$arr['knowledge']['id'];

	$ress['com'] = $db->select_query("SELECT *,count(knowledge_id) as com FROM ".TB_KNOWLEDGE_COMMENT." WHERE knowledge_id ='".$knowledgeid."' group by knowledge_id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>
			<TD width="50%" valign=top align="left">	
				<TABLE width="100%" border=0 cellSpacing=0 cellPadding=0>
				<TR>
					<TD class="timemini"><font size="4"><b><?= ThaiTimeMini($arr['knowledge']['post_date'],"");?></b></font></td>
					<td ><?=_BLOG_AUTH;?> <FONT COLOR="#990000"><B><?=$arr['knowledge']['posted'];?></font><br><font color=#C3C3C3> 
					<?= ThaiTimeConvert($arr['knowledge']['post_date'],"","");?> </font>&nbsp;&nbsp;<a href="createpdf.php?mo=knowledge&id=<?=$arr['knowledge']['id'];?>" target="_blank"><img src="images/pdf_button.png" border="0"></a>&nbsp;<a href="print.php?name=knowledge&file=readprint&id=<?=$arr['knowledge']['id'];?>" title="<?=_FORM_BUTTON_PRINT;?>" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=770,height=580,directories=no,location=no'); return false;" rel="nofollow"><img src="images/printButton.png" border="0"></a>&nbsp;<A HREF="popup.php?name=sendmail&mo=knowledge&id=<?=$arr['knowledge']['id'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 200} )" class="highslide"><img src="images/emailButton.png" border="0"></a></td></tr>
					<tr><td colspan="2"><?$rater_ids=$arr['knowledge']['id'];$rater_item_name='knowledge';include("modules/rater/raterss.php");?>
					</B></FONT></TD>
				</TR>
								<TR>
					<TD colspan="2" valign="top" align="center">
					<A HREF="?name=knowledge&file=readknowledge&id=<?=$arr['knowledge']['id'];?>" target="_blank">
					<?if ($arr['knowledge']['pic']==1){echo "<img  src=icon/knowledge_".$arr['knowledge']['post_date'].".jpg  class=mysborder border=0 align=center>";} else {echo "<img class=mysborder src=images/icon/".$arr['category']['icon']." border=0 align=center>";} ?></a>
					</td>
					</tr>
				<TR>
					<TD colspan="2"><img src="images/a.gif">
					<A HREF="?name=knowledge&file=readknowledge&id=<?=$arr['knowledge']['id'];?>" target="_blank"><B><?=$arr['knowledge']['topic'];?></A></B>
					<?=NewsIcon(TIMESTAMP, $arr['knowledge']['post_date'], "images/icon_new.gif");?>
					<BR><?=$Detail;?> <A HREF="?name=knowledge&file=readknowledge&id=<?=$arr['knowledge']['id'];?>" ><font color="#0066FF"><?_BLOG_NEXT;?></font></a>
					</TD>
				</TR>
				<TR><TD height="3" ></TD></TR>
				</TABLE>
			</TD>
<?
$count++;
if (($count%_KNOW_COL) == 0) { echo "</TR><TR><TD colspan=2 height=\"1\" bgcolor=\"$ColorFill\"></TD></TR>"; $count=0;
} else{
	echo "</TD>";
} 
} else {
echo "<TR onmouseover=\"this.style.backgroundColor='#FFF0DF'\" onmouseout=\"this.style.backgroundColor='$ColorFill'\" bgcolor='$ColorFill' >"; 
?>

												<TD width="100%" valign=top height="20" align="left" colspan="<?=_KNOW_COL;?>">
												<div class="">
															<IMG SRC="images/17.png" BORDER="0" ALIGN="absmiddle">
															<A HREF="<? WEB_URL;?>index.php?name=knowledge&file=readknowledge&id=<?=$arr['knowledge']['id'];?>" target="_blank" name="<?=$arr['knowledge']['topic'];?>" ><font color="#990066">(<?= ThaiTimeConvert($arr['knowledge']['post_date'],"","");?>)</font><B><?=$arr['knowledge']['topic'];?></A></B>
					<?=NewsIcon(TIMESTAMP, $arr['knowledge']['post_date'], "images/icon_new.gif");?>( <?=$arr['knowledge']['pageview'];?> / <?=$arrs['com']['com'];?> ) <?_DOWNLOAD_AUTH;?> <?=$arr['knowledge']['posted'];?> 
					</div>
													</TD></tr>

<?
}
$i++;
}
$db->closedb ();

?>
													<td>
													</tr>
													<tr>
													<td colspan="2" align="right"><A HREF="index.php?name=knowledge&category=1" ><img src="images/admin/2_15.gif"></a></td>
													</tr>
													</table>
											</td>
											</tr>
											</table>


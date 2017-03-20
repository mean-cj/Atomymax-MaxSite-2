										<table class='iconframe' cellpadding='0' cellspacing='0'>
										<tbody>
										<tr>
										<td class='imageframe'>
  													<TABLE width="<?=$widthSUMC;?>" align=center cellSpacing=0 cellPadding=0 border=0>
  <?

empty($_GET['category'])?$category="2":$category=$_GET['category'];
//$_GET['category']=1;
if(!empty($category)){
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " WHERE category='".$category."' ";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 7;


$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." $SQLwhere2 ORDER BY id DESC LIMIT $limit ");
$count=0;
$i=1;
while($arr['news'] = $db->fetch($res['news'])){
if($i%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#ffffff";
} else {
$ColorFill = "#F9F9F9";
}
if ($i <=_NEWS_COL){
	if ($count==0) { echo "<TR>"; }
	$content = $arr['news']['headline'];
	$Detail = stripslashes(FixQuotes($content));
	$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." WHERE id='".$arr['news']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$newsid=$arr['news']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(news_id) as com FROM ".TB_NEWS_COMMENT." WHERE news_id ='".$newsid."' group by news_id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>
													<TD width="50%" valign=top align="left">	

															<TABLE width="100%" border=0 cellSpacing=0 cellPadding=0>
															<TR>
															<TD class="timemini"><font size="4"><b><?= ThaiTimeMini($arr['news']['post_date'],"");?></b></font></td>
															<td ><?=_BLOG_AUTH;?> <FONT COLOR="#990000"><B><?=$arr['news']['posted'];?></font><br><font color=#C3C3C3> 
					<?= ThaiTimeConvert($arr['news']['post_date'],"","");?> </font>&nbsp;&nbsp;<a href="createpdf.php?mo=news&id=<?=$arr['news']['id'];?>" target="_blank"><img src="images/pdf_button.png" border="0"></a>&nbsp;<a href="print.php?name=news&file=readprint&id=<?=$arr['news']['id'];?>" title="<?=_FORM_BUTTON_PRINT;?>" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=770,height=580,directories=no,location=no'); return false;" rel="nofollow"><img src="images/printButton.png" border="0"></a>&nbsp;<A HREF="popup.php?name=sendmail&mo=news&id=<?=$arr['news']['id'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 200} )" class="highslide"><img src="images/emailButton.png" border="0"></a></td></tr>
					<tr><td colspan="2"><?//=$arr['category']['category_name'];?><?$rater_ids=$arr['news']['id'];$rater_item_name='news';include("modules/rater/raterss.php");?>
															</TD>
															</TR>
															<tr>
															<TD colspan="2" align="center">
															<A HREF="?name=news&file=readnews&id=<?=$arr['news']['id'];?>" >
															<?if ($arr['news']['pic']==1){echo "<img  src=icon/news_".$arr['news']['post_date'].".jpg class=mysborder border=0 align=center>";} else {echo "<img class=mysborder src=images/icon/".$arr['category']['icon']." border=0 align=center>";} ?></a>
															</td>
															</tr>
															<tr>
															<td colspan="2" ><img src="images/a.gif"><A HREF="?name=news&file=readnews&id=<?=$arr['news']['id'];?>" ><b><?=$arr['news']['topic'];?></b></A>
					<?=NewsIcon(TIMESTAMP, $arr['news']['post_date'], "images/icon_new.gif");?> ( <?=$arr['news']['pageview'];?> / <?=$arrs['com']['com'];?> )<br>&nbsp;&nbsp;&nbsp;&nbsp;<?=$Detail;?> <A HREF="?name=news&file=readnews&id=<?=$arr['news']['id'];?>" ><font color="#0066FF"><?=_BLOG_NEXT;?></font></a>
															</TD>
															</TR>
															<TR><TD height="3" ></TD></TR>
															</TABLE>
													</TD>
<?
$count++;

if (($count%_NEWS_COL) == 0) { echo "</TR><TR><TD colspan=2 height=\"1\" bgcolor=\"$ColorFill\"></TD></TR>"; $count=0; 
} else{
	echo "</TD>";
} 

} else {
echo "<TR onmouseover=\"this.style.backgroundColor='#FFF0DF'\" onmouseout=\"this.style.backgroundColor='$ColorFill'\" bgcolor='$ColorFill' >"; 
?>

												<TD width="100%" valign=top height="20" align="left" colspan="<?=_NEWS_COL;?>">
												<div class="">
															<IMG SRC="images/17.png" BORDER="0" ALIGN="absmiddle">
															<A HREF="<? WEB_URL;?>index.php?name=news&file=readnews&id=<?=$arr['news']['id'];?>" target="_blank" name="<?=$arr['news']['topic'];?>" ><font color="#990066">(<?= ThaiTimeConvert($arr['news']['post_date'],"","");?>) </font><B><?=$arr['news']['topic'];?></A></B>
					<?=NewsIcon(TIMESTAMP, $arr['news']['post_date'], "images/icon_new.gif");?>( <?=$arr['news']['pageview'];?> / <?=$arrs['com']['com'];?> ) <?=_DOWNLOAD_AUTH;?> <?=$arr['news']['posted'];?> 
					</div>
													</TD></tr>

<?
}
$i++;
}
$db->closedb ();

?>
													</tr>
													<tr>
													<td align="left"><A HREF="modules/rss/news.xml" ><img src="images/rss.jpg"></a><td  align="right"><A HREF="index.php?name=news&category=<?=$category;?>" ><img src="images/admin/2_15.gif"></a></td>
													</tr>
													</table>
											</td>
											</tr>
											</table>

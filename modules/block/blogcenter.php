	
										<table class='iconframe' cellpadding='0' cellspacing='0'>
										<tbody>
										<tr>
										<td class='imageframe'>
  													<TABLE width="<?=$widthSUMC;?>" align=center cellSpacing=0 cellPadding=0 border=0>
  <?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 7 ;

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." ORDER BY id DESC LIMIT $limit ");
$count=0;
$i=1;
while($arr['blog'] = $db->fetch($res['blog'])){
if($i%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#ffffff";
} else {
$ColorFill = "#F9F9F9";
}
if ($i <=_NEWS_COL){
	if ($count==0) { echo "<TR>"; }
	$content = $arr['blog']['headline'];
	$Detail = stripslashes(FixQuotes($content));

	$res['category'] = $db->select_query("SELECT * FROM ".TB_BLOG_CAT." WHERE id='".$arr['blog']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$blogid=$arr['blog']['id'];

	$ress['com'] = $db->select_query("SELECT *,count(blog_id) as com FROM ".TB_BLOG_COMMENT." WHERE blog_id ='".$blogid."' group by blog_id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>
												<TD width="50%" valign=top align="left">	
				<TABLE width="100%" align=center cellSpacing=1 cellPadding=1 border=0>
				<TR>
					<TD width="50">
					<?
					$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['mem'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$arr['blog']['posted']."' ");
					$arr['mem'] = $db->fetch($res['mem']);
					$res['cblog'] = $db->select_query("SELECT *,count(id) as co FROM ".TB_BLOG." WHERE posted='".$arr['blog']['posted']."' group by posted");
					$arr['cblog'] = $db->fetch($res['cblog']);					
					?>
					<? if ($arr['mem']['member_pic']){ echo "<img src=\"icon/".$arr['mem']['member_pic']."\" width=\"60\">";
					} else {
						echo "<img src=\"icon/member_nrr.gif\" width=\"60\">";
					}
					?>
					</TD>
					<td valign="top" width="50">
					<b><font  size="2"><?=_BLOG_NAME;?> </font><br>
					<b><font  size="2"><?=_BLOG_NUM;?></font><br>
					<b><font  size="2"><?=_BLOG_LEVEL;?></font><br>
					<b><font  size="2"><?=_BLOG_TIME;?></font>
					</td>
					<td valign="top" >
					<b><font color="#CC0000" size="2"><?=$arr['mem']['user'];?></font><br>
					<b><font color="#CC0000" size="2">  <?=$arr['cblog']['co'];?> <?=_BLOG_MOD_NUMS;?> </font><br>
					<b><font color="#CC0000" size="2"><?BlogLevel($arr['cblog']['co']);?></font><br>
					<b><font color=#C3C3C3> <?= ThaiTimeConvert($arr['blog']['post_date'],"","");?></font>
					</td>
					</tr>
					<tr>
					<td colspan="3"><b><font  size="2"><?=_BLOG_AUTH;?></font><font color="#CC0000" size="2">&nbsp;<?=$arr['mem']['name'];?></font></b>&nbsp;<a href="createpdf.php?mo=blog&id=<?=$arr['blog']['id'];?>" target="_blank"><img src="images/pdf_button.png" border="0"></a>&nbsp;<a href="print.php?name=blog&file=readprint&id=<?=$arr['blog']['id'];?>" title="<?=_FORM_BUTTON_PRINT;?>" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=770,height=580,directories=no,location=no'); return false;" rel="nofollow"><img src="images/printButton.png" border="0"></a>&nbsp;<A HREF="popup.php?name=sendmail&mo=blog&id=<?=$arr['blog']['id'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 200} )" class="highslide"><img src="images/emailButton.png" border="0"></a>
					</td>
					</tr>
					<tr>
					<td colspan="3">
					<?$rater_ids=$arr['blog']['id'];$rater_item_name='blog';include("modules/rater/raterss.php");?>
					</td>
					</tr>
				<TR>
					<TD height="1" class="dotline" colspan="3"></TD>
				</TR>
				</table><br>
															<TABLE width="100%" border=0 cellSpacing=0 cellPadding=0>
															<tr>
															<TD colspan="2" align="center">
															<A HREF="?name=blog&file=readblog&id=<?=$arr['blog']['id'];?>" >
																				<? if($arr['blog']['pic']){ echo "<img src=\"icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg\">";
					} else {
					echo "<img src=\"images/icon/".$arr['category']['icon']."\">";
					}
					?></a>
															</td>
															</tr>
															<tr>
															<td colspan="2" ><img src="images/a.gif"><A HREF="?name=blog&file=readblog&id=<?=$arr['blog']['id'];?>" ><b><?=$arr['blog']['topic'];?></b></A>
					<?=NewsIcon(TIMESTAMP, $arr['blog']['post_date'], "images/icon_new.gif");?> ( <?=$arr['blog']['pageview'];?> / <?=$arrs['com']['com'];?> )<br>&nbsp;&nbsp;&nbsp;&nbsp;<?=$Detail;?> <A HREF="?name=blog&file=readblog&id=<?=$arr['blog']['id'];?>" ><font color="#0066FF"><?=_BLOG_NEXT;?></font></a>
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
															<A HREF="<? WEB_URL;?>index.php?name=blog&file=readblog&id=<?=$arr['blog']['id'];?>" target="_blank" name="<?=$arr['blog']['topic'];?>" ><font color="#990066">(<?= ThaiTimeConvert($arr['blog']['post_date'],"","");?>)</font><B><?=$arr['blog']['topic'];?></A></B>
					<?=NewsIcon(TIMESTAMP, $arr['blog']['post_date'], "images/icon_new.gif");?>( <?=$arr['blog']['pageview'];?> / <?=$arrs['com']['com'];?> ) <?=_BLOG_AUTH;?> <?=$arr['blog']['posted'];?> 
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
													<td colspan="2" align="right"><A HREF="index.php?name=blog" ><img src="images/admin/2_15.gif"></a></td>
													</tr>
													</table>
											</td>
											</tr>
											</table>


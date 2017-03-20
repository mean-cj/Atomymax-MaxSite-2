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
$limit = 4;


$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." ORDER BY id DESC LIMIT $limit ");
$count=0;
$i=1;
while($arr['video'] = $db->fetch($res['video'])){
if($i%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#ffffff";
} else {
$ColorFill = "#F9F9F9";
}

	if ($count==0) { echo "<TR>"; }
	$content = $arr['video']['detail'];
	$Detail = stripslashes(FixQuotes($content));
	$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." WHERE id='".$arr['video']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$videoid=$arr['video']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(video_id) as com FROM ".TB_VIDEO_COMMENT." WHERE video_id ='".$videoid."' group by video_id"); 
	$arrs['com'] = $db->fetch($ress['com']);

if($arr['video']['youtube']==1){
$durationx=timeyoutube($arr['video']['times']);
} else {
$durationx = $arr['video']['times'];
}
?>
													<TD width="50%" valign=top align="center">	
														<TABLE width="100%" border=0 cellSpacing=0 cellPadding=0>
															<tr>
															<TD align="center" >
															<TABLE width="200" border=0 cellSpacing=0 cellPadding=0>
															<tr>
															<TD align="left" ><img src="images/video_icon.png" border="0"><a HREF="index.php?name=video&file=readvideo&id=<?=$arr['video']['id'];?>" ><b><? echo $arr['video']['topic'];?></a><?=NewsIcon(TIMESTAMP, $arr['video']['post_date'], "images/icon_new.gif");?></b>
															</td>
															</tr>
															<TD align="left" ><b>By : <FONT COLOR="#990000"><? echo $arr['video']['posted'];?></font></b>
															</td>
															</tr>
															<tr>
															<TD align="center" >
															<div class="photo" >
																
<a HREF="index.php?name=video&file=readvideo&id=<?=$arr['video']['id'];?>" ><span></span><img src="<?if ($arr['video']['youtube']!=1){ if ($arr['video']['pic']){echo "video/thumbs/".$arr['video']['pic'].""; } else{ echo "images/video_blank.gif";} }else { echo "http://img.youtube.com/vi/".$arr['video']['video']."/default.jpg";}?>"  width="<?=_IVIDEOT_W;?>" height="<?=_IVIDEOT_H;?>"></a>
<div class="photox"><?echo $durationx;?></div>

															</div>
															</td>
															</tr>
															<tr >
															<TD align="left" ><b>Rated :</b> <? $rater_ids=$arr['video']['id'];$rater_item_name='video';include("modules/rater/raterx.php");?>
															</td>
															</tr>
															<tr >
<?
//$date = date("D M j G:i:s T Y",$arr['video']['post_date']);
$date = date("M,j Y",$arr['video']['post_date']);
?>
															<TD align="left" ><b>Added :</b> <? echo $date;?>
</td>
</tr>

															<tr >
															<TD align="left" ><b>Duration :</b> <? echo "".$durationx."";?>
</td>
</tr>
															</table>
															</td>
															</tr>
															</TABLE>

													</TD>

<?
$count++;

if (($count%_VIDEO_COL) == 0) { echo "</TR><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; 
} else{
	echo "</TD>";
}
$i++;
}
$db->closedb ();
?>
													</tr>
													<tr>
													<td align="left"></td><td  align="right"><A HREF="index.php?name=video" ><img src="images/admin/2_15.gif"></a></td>
													</tr>
													</table>
											</td>
											</tr>
											</table>

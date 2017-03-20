<?include ("editor.php");?>
<script src="js/jquery.min.js"></script>
<script src="js/flowplayer-3.2.6.min.js"></script>
<script src="js/flowplayer.playlist-3.0.8.min.js"></script> 
<script src="js/jquery.tools.min.js"></script>
<script src="js/swfobject.js"></script>

<style> 
	/* container has a background image */
 
a.player {	
	display:block;
	width:600px;
	height:408px;
	text-align:center;
	color:#fff;
	text-decoration:none;
	cursor:pointer;
	background:#000 url(../video/h500.png) repeat-x 0 0;
	background:-moz-linear-gradient(top, rgba(55, 102, 152, 0.9), rgba(6, 6, 6, 0.9));
	-moz-box-shadow:0 0 40px rgba(100, 118, 173, 0.5);
}
 
a.player:hover {
	background:-moz-linear-gradient(center top, rgba(73, 122, 173, 0.898), rgba(6, 6, 6, 0.898));	
}
 
/* splash image */
a.player img {
	margin-top:125px;
	border:0;	
}
 
	a.player {
		margin-top:0px;		
	}
</style>
<script> 
var urlx = '<?echo WEB_URL;?>';
$(function() {
	// setup player without "internal" playlists
	$f('player', '<?echo WEB_URL;?>/video/flowplayer-3.2.7.swf', {
		clip: { 
			baseUrl: ''+urlx+'' ,
			autoPlay: true,
			autoBuffering: true,
			initialScale: 'scale'
			},          
			play: {             
			label: 'Play',             
			replayLabel: 'Again'         
			}         // disable default controls         

	// use playlist plugin. again loop is true
	})
		.playlist('#myplaylist', {loop:true});

});
</script>

	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0 >
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top >
		  <!-- video -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_video.gif" BORDER="0"><br>
				<TABLE width="740" align=center cellSpacing=2 cellPadding=2 border=0 class="tablex">
<?
empty($_GET['id'])?$id="":$id=$_GET['id'];
//แสดง video  
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." WHERE id='".$id."' ");
$arr['video'] = $db->fetch($res['video']);
$db->closedb ();
if(!$arr['video']['id']){
	echo "<BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>ไม่มีรายการ video นี้</B></CENTER><BR><BR><BR><BR>";
}else{

	//ทำการเพิ่มจำนวนคนเข้าชม
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$q['Pageview'] = "UPDATE ".TB_VIDEO." SET pageview = pageview+1 WHERE id = '".$id."' ";
	$sql['Pageview'] = mysql_query ( $q['Pageview'] ) or sql_error ( "db-query",mysql_error() );
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." WHERE id='".$arr['video']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$CAT=$arr['category']['post_date'];
	$db->closedb ();
?>

				<TR>
					<TD valign="top"  colspan="2" align="center" ><br>
	 			<table cellspacing=0 cellpadding=0 border=0 class='iconframe'>
				<tr>
				<td  border=0  align="center" class='imageframe'>
<!-- player container without nested content -->
<?if ($arr['video']['youtube'] ==0){echo "<a href=\""._VIDEOS_DIR_PATH."/".$arr['video']['video']."\" class=\"player\" id=\"player\"  style=\"float:left\" ></a>";} else {
	echo "<object height=\"408\" width=\"600\"><param name=\"movie\" value=\"http://www.youtube.com/v/".$arr['video']['video']."&amp;hl=en_US&amp;fs=1&amp;\"><param name=\"allowFullScreen\" value=\"true\"><param name=\"allowscriptaccess\" value=\"always\"><embed allowfullscreen=\"true\" allowscriptaccess=\"always\" height=\"408\" src=\"http://www.youtube.com/v/".$arr['video']['video']."&amp;hl=en_US&amp;fs=1&amp;\"  type=\"application/x-shockwave-flash\" width=\"600\"></embed></object>";}?>
 <!-- let rest of the page float normally -->
<br clear="all"/>
</td>
</tr>

  </table>
					</td>
				</TR>
				<tr>
				<td bgcolor="#E2E2E2" valign="top" width="20%" align="right">	
				<B><FONT COLOR="#990000"><?=_FORM_CAT;?> </td><td width="80%" bgcolor="#E2E2E2" valign="top"><FONT COLOR="#0066FF"><?=$arr['category']['category_name'];?>
				</td>
				</tr>
					<tr>
					<td bgcolor="#E2E2E2" valign="top" align="right">Video : </td><td bgcolor="#E2E2E2" valign="top"><b><?=$arr['video']['topic'];?></B>
					</td>
					</tr>
					<tr>
					<td bgcolor="#E2E2E2" valign="top" align="right"> <?=_FORM_DETAIL;?> </td><td bgcolor="#E2E2E2" valign="top"><?=$arr['video']['detail'];?></B>
					</td>
					</tr>
<?
if($arr['video']['youtube']==1){
$durationx=timeyoutube($arr['video']['times']);
} else {
$durationx = $arr['video']['times'];
}
?>
					<tr >
					<td bgcolor="#E2E2E2" valign="top" align="right"> Duration : </td><td bgcolor="#E2E2E2" valign="top"><? echo "".$durationx."";?></B>
</td>
</tr>
					<tr>
					<td bgcolor="#E2E2E2" valign="top" align="right">	<?=_FORM_MOD_POSTEDX;?> </td><td bgcolor="#E2E2E2" valign="top"><?=$arr['video']['posted'];?></B>
					</td>
					</tr>
					<tr>
					<td bgcolor="#E2E2E2" valign="top" align="right"><?=_DETAIL_PRIVIEW;?> : </td><td bgcolor="#E2E2E2" valign="top">
					<?
if ($arr['video']['youtube']==1){
$json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$arr['video']['video']."?v=2&alt=jsonc"));	  
echo $json->data->viewCount;
  } else {
 echo $arr['video']['pageview'];
  }
  ?>
					</td>
					</tr>
					<tr>
					<td bgcolor="#E2E2E2" valign="top" align="right"><?=_FORM_MOD_POSTDATE;?> </td><td bgcolor="#E2E2E2" valign="top">
					<?= ThaiTimeConvert($arr['video']['post_date'],"1","");?>
					
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  <a href="?name=admin&file=video&op=video_edit&id=<? echo $arr['video']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
				  <a href="javascript:Confirm('?name=admin&file=video&op=video_del&id=<? echo $arr['video']['id'];?>&prefix=<? echo $arr['video']['post_date'];?>','<?=_FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
<?
}
?>
</td>
</tr>
<tr>
<td bgcolor="#E2E2E2" valign="top" align="right"><?=_FORM_MOD_VOTE_NUM;?> : </td><td bgcolor="#E2E2E2" valign="top">
<table  width="100%">
<tr>
<td >
<?
$rater_ids=$id;
$rater_item_name='video';
include("modules/rater/rater.php");
?>
</td>
</tr>
					
					</table>
					</TD>
				</TR>
<tr>
					<TD colspan=2>
					<BR>
					<B><FONT COLOR="#009900"><?=_FROM_LINK_FIVECONT;?> <FONT COLOR="#990000">[<?=$arr['category']['category_name'];?>]</B></FONT>
					</td>
					<tr>
<tr>
					<TD colspan=2><B><FONT COLOR="#990099">
<?
//แสดง video  5 อันดับล่าสุดของหมวดหมู่ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['cat_video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." WHERE category='".$arr['category']['id']."' ORDER BY id DESC LIMIT 5 ");
$rows['cat_video'] = $db->rows($res['cat_video']); 
if(!$rows['cat_video']){
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"._FROM_CAT_NO."";
}
while($arr['cat_video'] = $db->fetch($res['cat_video'])){
?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<IMG SRC="images/icon/suggest.gif" BORDER="0" ALIGN="absmiddle"> <B><A HREF="?name=video&file=readvideo&id=<?=$arr['cat_video']['id'];?>" target="_blank"><?=$arr['cat_video']['topic'];?></A></B> <?= ThaiTimeConvert($arr['cat_video']['post_date'],"","");?><BR>
<?
}
$db->closedb ();
?>
					</TD>
				</TR>
<?
}
?>
			</TABLE>
			<BR><BR>
			
<?
if($arr['video']['enable_comment']){

	//Check Comment
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 10 ;
	$SUMPAGE = $db->num_rows(TB_VIDEO_COMMENT,"video_id","video_id=' ".$arr['video']['id']." ' ");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;

	$res['comment'] = $db->select_query("SELECT * FROM ".TB_VIDEO_COMMENT." WHERE video_id='".$arr['video']['id']."' ORDER BY id  LIMIT $goto, $limit ");
	$count=1;
	while($arr['comment'] = $db->fetch($res['comment'])){

?>
<center><table width=550>
<tr>
<td width=100 valign="top">
<table>
<tr>
          <td bgcolor="#FFFFFF" valign="top" align="center" width="100"> 
<br>
<?
	$Name=$arr['comment']['name'];
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." ");
$arr['admin'] = $db->fetch($res['admin']);

if ($arr['admin']['username']==$Name) {
 ?>
<A HREF="?name=admin&file=user&id=<?=$arr['admin']['id']; ?>">
	<? if($arr['admin']['picture']==""){ ?>
	<IMG SRC="icon/member_nrr.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }else{  ?>
	<IMG SRC="icon/<?=$arr['admin']['picture']; ?>" width='80' BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? } 
 ?> </a><?
}else {

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['member'] = $db->select_query("SELECT * FROM ".TB_MEMBER." where user='".$Name."' ");
$arr['member'] = $db->fetch($res['member']);

?>
	<? if($arr['member']['id']==""){ ?>
		<IMG SRC="icon/guest_nrr.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }else{  ?>
<A HREF="?name=member&file=member_Message&id=<?=$arr['member']['id']; ?>">
	<? if($arr['member']['member_pic']==""){ ?>
	<IMG SRC="icon/member_nrr.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }else{  ?>
	<IMG SRC="icon/<?=$arr['member']['member_pic']; ?>" width='80' BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? };?></a>
<?  }; 

	};
?>
</td>
</tr>
</table>

</td>
<td>
<center>
				<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td >
			<img src="images/com/b_01.jpg" width="23" height="13" alt=""></td>
		<td background="images/com/b_02.jpg" height="13" width="100%"></td>
		<td>
			<img src="images/com/b_03.jpg" width="10" height="13" alt=""></td>
	</tr>
	<tr>
		<td >
			<img src="images/com/b_04.jpg" width="23" alt=""></td>
		<td bgcolor="#F5F5F5"  width="100%" alt=""><B><FONT COLOR="#990000"><?=_FROM_COMMENT_NUM;?> <?=$count;?></FONT></B>
				<?if($admin_user){echo " <A HREF=\"?name=video&file=delete_comment&id=".$id."&comment=".$arr['comment']['id']."\"><IMG SRC=\"images/admin/trash.gif\" height=\"18\"  BORDER=\"0\" ALIGN=\"absmiddle\"></A>";};?>
				<?= ThaiTimeConvert($arr['comment']['post_date'],"1","1");?>
		</td>
		<td background="images/com/b_05.jpg" width="10" alt="" height="100%"></td>
	</tr>
	<tr>
		<td background="images/com/b_06.jpg" width="23" height="100%" alt=""></td>
		<td alt=""><br>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<?		if (substr_count($arr['comment']['comment'],'<p>') == 1) {   
		$temp = preg_replace("/<p>/i","",$arr['comment']['comment']);   
		$temp = preg_replace("/<\/p>/i","",$temp);   
		$arr['comment']['comment'] = $temp; 
	} ?>
			<?=(stripslashes($arr['comment']['comment']));?>
			</td>
		<td background="images/com/b_05.jpg" width="10" height="100%" alt=""></td>
	</tr>
		<tr>
		<td background="images/com/b_06.jpg" width="23" height="100%" alt=""></td>
		<td width="100%" alt="" ><hr><FONT COLOR="#990000"><?=_FORM_MOD_POSTED;?> : </FONT></B> <?=$arr['comment']['name'];?> &nbsp;&nbsp; <FONT COLOR="#990000"><B>IP : </B></FONT><?echo preg_replace('/([0-9]+\.[0-9]+)\.[0-9]+\.[0-9]+/', '\1<span style="color:red">.xxx.xxx</span>', $arr['comment']['ip']);?>
			</td>
		<td background="images/com/b_05.jpg" width="10" height="100%" alt=""></td>
	</tr>
	<tr>
		<td >
			<img src="images/com/b_07.jpg" width="23" height="11" alt=""></td>
		<td background="images/com/b_08.jpg" height="11" width="100%" alt=""></td>
		<td>
			<img src="images/com/b_09.jpg" width="10" height="11" alt=""></td>
	</tr>
</table><br>
</td>
</tr>
</table>
<?
			$count  ++;
	}
	echo "<center>";
	SplitPage($page,$totalpage,"?name=video&file=readvideo&id=".$id."");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
	echo "<BR>";
	echo "<BR>";
	$db->closedb ();
?>
			<!-- Enable Comment -->
			<TABLE cellSpacing=0 cellPadding=0 width=550 border=0 align="center">
			  <TBODY>
				<TR>
				  <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
				  <TD width="490" vAlign=top align=left><IMG src="images/topfader.gif" border=0><BR>
				  <IMG SRC="images/menu/textmenu_comment.gif" BORDER="0" ><BR>
						<FORM NAME="form2" METHOD=POST ACTION="?name=video&file=comment&id=<?=$id;?>">
						<TABLE cellSpacing=5 cellPadding=0 width=550 border=0 align="center">
						<TR>
							<TD width="80" align="right"><B><?=_FROM_COMMENT_AUTH;?> : </B></TD>
							<TD><INPUT TYPE="text" NAME="NAME" style="width:300" <?if($login_true){echo "value=\"".$login_true."\" readonly style=\"color: #FF0000\" ";};?><?if($admin_user){echo "value=\"".$admin_user."\" readonly style=\"color: #FF0000\" ";};?>></TD>
						</TR>
<?
 if($login_true || $admin_user){
} else {
if(USE_CAPCHA){
?>
						<TR>
							<TD width="80" align="right">
							<?if(CAPCHA_TYPE == 1){ 
								echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							}else if(CAPCHA_TYPE == 2){ 
								echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							};?>
							</TD>
							<TD><input name="security_code" type="text" id="security_code" size="20" maxlength="6" style="width:80" > <?=_JAVA_CAPTCHA_ADD;?></TD>
						</TR>
<?
}
}
?>
						<TR>
							<TD width="80" align="right" valign=top><B><?=_FROM_COMMENT_NUMX;?>: </B></TD>
							<TD><TEXTAREA NAME="COMMENT" ROWS="10" COLS="100" style="width:400"></TEXTAREA>
		<script type="text/javascript">CKEDITOR.replace ( 'COMMENT',{toolbar: 'Mini'});</script>
	</TD>
						</TR>
						<TR>
							<TD width="80" align="right" valign=top></TD>
							<TD><INPUT TYPE="submit" value="<?=_FROM_BUTTON_COMMENT;?>"><BR>
							<BR><?=_FROM_COMMENT_WORNING;?>
							</TD>
						</TR>
						</TABLE>
						</FORM>
				  </TD>
				</TR>
			  </TBODY>
			</TABLE>
			<BR><BR>
<?=_FROM_COMMENT_AGREE;?><A HREF="mailto:<?=WEB_EMAIL;?>"><?=WEB_EMAIL;?></A> <?=_FROM_COMMENT_AGREE2;?>
			<BR><BR>
			<!-- End Enable Comment -->
<?
}
?>

			<!-- End video -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
<?include ("editor.php");?>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
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
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- gallery -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_gallery.gif" BORDER="0"><BR><BR>
				<TABLE width="740" align=center cellSpacing=2 cellPadding=2 border=0>
<?
empty($_GET['id'])?$id="":$id=$_GET['id'];
//แสดง Gallery  
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['gallery'] = $db->select_query("SELECT * FROM ".TB_GALLERY." WHERE id='".$id."' ");
$arr['gallery'] = $db->fetch($res['gallery']);
$db->closedb ();
if(!$arr['gallery']['id']){
	echo "<BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>"._GALLERY_ALBUM_NULL."</B></CENTER><BR><BR><BR><BR>";
}else{

	//ทำการเพิ่มจำนวนคนเข้าชม
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$q['Pageview'] = "UPDATE ".TB_GALLERY." SET pageview = pageview+1 WHERE id = '".$id."' ";
	$sql['Pageview'] = mysql_query ( $q['Pageview'] ) or sql_error ( "db-query",mysql_error() );
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT." WHERE id='".$arr['gallery']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$CAT=$arr['category']['post_date'];
	$db->closedb ();
?>
				<TR>
					<TD height="1" class="dotline" colspan="2"></TD>
				</TR>
				<TR>
					<TD valign="top" bgcolor="#F7F7F7" colspan="2" align="center" >
	 			<table cellspacing=0 cellpadding=0 border=0 class='iconframe'>
				<tr>
				<td  border=0  align="center" class='imageframe'>
					<a HREF="images/gallery/<? echo "gal_".$CAT."/".$arr['gallery']['pic'];?>" rel="lightbox"><img class="highslide-display-block" border=0 src="<?if($arr['gallery']['id']){ echo "images/gallery/gal_".$CAT."/thb_".$arr['gallery']['pic'].""; } else { echo "images/gallery_blank.gif";}?>" /></a>
					</td><td class='shadow_right'><div class='shadow_top_right'></div></td>
</tr>
<tr>
  <td class='shadow_bottom'><div class='shadow_bottom_left'></div></td>
  <td class='shadow_bottom_right'></td>
  </tr>
  </table>[ <?=_GALLERY_IMG_BIG;?> ]
					</td>
				</TR>
				<tr>
				<td bgcolor="#F7F7F7" valign="top" width="50">		
				<B><FONT COLOR="#990000"><?=_GALLERY_ALBUM_ID;?> </td><td width="80%" bgcolor="#F7F7F7" valign="top"><FONT COLOR="#0066FF"><?=$arr['category']['category_name'];?>
				</td>
				</tr>
					<tr>
					<td bgcolor="#F7F7F7" valign="top">	<?=_GALLERY_ALBUM_POSTED;?> </td><td bgcolor="#F7F7F7" valign="top"><?=$arr['gallery']['posted'];?></B>

					</td>
					</tr>
					<tr>
					<td bgcolor="#F7F7F7" valign="top"><?=_GALLERY_ALBUM_PREVIEW;?> </td><td bgcolor="#F7F7F7" valign="top"><?=$arr['gallery']['pageview'];?>
					</td>
					</tr>
					<tr>
					<td bgcolor="#F7F7F7" valign="top"><?=_GALLERY_ALBUM_POSTED_DATE;?> </td><td bgcolor="#F7F7F7" valign="top">
					<?= ThaiTimeConvert($arr['gallery']['post_date'],"1","");?>
					
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  <a href="?name=admin&file=gallery&op=gallery_edit&id=<? echo $arr['gallery']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
				  <a href="javascript:Confirm('?name=admin&file=gallery&op=gallery_del&id=<? echo $arr['gallery']['id'];?>&prefix=<? echo $arr['gallery']['post_date'];?>','<?echo _FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
<?
}
?>
</td>
</tr>
<tr>
<td bgcolor="#F7F7F7" valign="top" ><?=_GALLERY_VOTE;?> </td><td bgcolor="#F7F7F7" valign="top">
<table  width="100%">
<tr>
<td >
<?
$rater_ids=$id;
$rater_item_name='gallery';
include("modules/rater/rater.php");
?>
</td>
</tr>
					
					</table>
					</TD>
				</TR>
				<TR>
					<TD height="1" class="dotline" colspan=2></TD>
				</TR>
<tr>
					<TD colspan=2>
					<BR>
					<B><FONT COLOR="#009900"><?=_GALLERY_ALBUM_FIVEIMG;?>  <FONT COLOR="#990000">[<?=$arr['category']['category_name'];?>]</B></FONT>
					</td>
					<tr>
<tr>
					<TD colspan=2><B><FONT COLOR="#990099">
<?
//แสดง Gallery  5 อันดับล่าสุดของหมวดหมู่ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['cat_gallery'] = $db->select_query("SELECT * FROM ".TB_GALLERY." WHERE category='".$arr['category']['id']."' ORDER BY id DESC LIMIT 5 ");
$rows['cat_gallery'] = $db->rows($res['cat_gallery']); 
if(!$rows['cat_gallery']){
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"._FROM_CAT_NO."";
}
while($arr['cat_gallery'] = $db->fetch($res['cat_gallery'])){
?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<IMG SRC="images/icon/suggest.gif" BORDER="0" ALIGN="absmiddle"> <B><A HREF="?name=gallery&file=readgal&id=<?=$arr['cat_gallery']['id'];?>" target="_blank"><?=$arr['cat_gallery']['pic'];?></A></B> <?= ThaiTimeConvert($arr['cat_gallery']['post_date'],"","");?><BR>
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
if($arr['gallery']['enable_comment']){

	//Check Comment
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 10 ;
	$SUMPAGE = $db->num_rows(TB_GALLERY_COMMENT,"gallery_id","gallery_id=' ".$arr['gallery']['id']." ' ");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;

	$res['comment'] = $db->select_query("SELECT * FROM ".TB_GALLERY_COMMENT." WHERE gallery_id='".$arr['gallery']['id']."' ORDER BY id  LIMIT $goto, $limit ");
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
				<?if($admin_user){echo " <A HREF=\"?name=gallery&file=delete_comment&id=".$id."&comment=".$arr['comment']['id']."\"><IMG SRC=\"images/admin/trash.gif\" height=\"18\"  BORDER=\"0\" ALIGN=\"absmiddle\"></A>";};?>
				<?= ThaiTimeConvert($arr['comment']['post_date'],"1","1");?>
		</td>
		<td background="images/com/b_05.jpg" width="10" alt="" height="100%"></td>
	</tr>
	<tr>
		<td background="images/com/b_06.jpg" width="23" height="100%" alt=""></td>
		<td alt="">
			&nbsp;&nbsp;<b><?=_FROM_COMMENT_DETAIL;?> </b><br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;<font color="#003366" ><b>
			<?=(stripslashes($arr['comment']['comment']));?></b><br>
			<br>
			</td>
		<td background="images/com/b_05.jpg" width="10" height="100%" alt=""></td>
	</tr>
		<tr>
		<td background="images/com/b_06.jpg" width="23" height="100%" alt=""></td>
		<td width="100%" alt="" ><hr><FONT COLOR="#990000"><?=_BLOG_AUTH;?> </FONT></B> <?=$arr['comment']['name'];?> &nbsp;&nbsp; <FONT COLOR="#990000"><B><?=_FROM_COMMENT_IP;?> </B></FONT><?echo preg_replace('/([0-9]+\.[0-9]+)\.[0-9]+\.[0-9]+/', '\1<span style="color:red">.xxx.xxx</span>', $arr['comment']['ip']);?>
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
	SplitPage($page,$totalpage,"?name=gallery&file=readgallery&id=".$id."");
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
						<FORM NAME="form2" METHOD=POST ACTION="?name=gallery&file=comment&id=<?=$id;?>">
						<TABLE cellSpacing=5 cellPadding=0 width=550 border=0 align="center">
						<TR>
							<TD width="80" align="right"><B><?=_FROM_COMMENT_AUTH;?> </B></TD>
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
							<TD width="80" align="right" valign=top><B><?=_FROM_COMMENT_NUMX;?> </B></TD>
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
			<?=_FROM_COMMENT_AGREE;?> <A HREF="mailto:<?=WEB_EMAIL;?>"><?=WEB_EMAIL;?></A> <?=_FROM_COMMENT_AGREE2;?>
			<BR><BR>
			<!-- End Enable Comment -->
<?
}
?>

			<!-- End gallery -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
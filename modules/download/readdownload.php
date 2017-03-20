<?include ("editor.php");?>
<?
//แรียก user online ทั้งหมด
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user2'] = $db->select_query("SELECT * FROM ".TB_useronline." ");			
			$rows['user2'] = $db->rows($res['user2']);
//ดึง user online จกา table TB_user
	//		while($arr['user2'] = $db->fetch($res['user2'])){	
			$arr['user2'] = $db->fetch($res['user2']);		
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$arr['user2']['useronline']."' ");		
			$arr['user'] = $db->fetch($res['user'])	;
			if ($admin_user<>"" || $login_true<>"" ){
			?>

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
          <TD width="730" vAlign=top>
		  <!-- download -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_user.gif" BORDER="0"><BR><BR>
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0>

<?
$_GET['id'] = intval($_GET['id']);
//แสดงข่าวสาร/ประชาสัมพันธ์ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." WHERE id='".$_GET['id']."' ");
$arr['download'] = $db->fetch($res['download']);
$db->closedb ();
if(!$arr['download']['id']){
	echo "<BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>"._DOWNLOAD_MOD_SEARCH_NULL." </B></CENTER><BR><BR><BR><BR>";
}else{

	$content = $arr['download']['detail'];
	$Detail = stripslashes(FixQuotes($content));
	//ทำการเพิ่มจำนวนคนเข้าชม
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$q['Pageview'] = "UPDATE ".TB_DOWNLOAD." SET pageview = pageview+1 WHERE id = '".$_GET['id']."' ";
	$sql['Pageview'] = mysql_query ( $q['Pageview'] ) or sql_error ( "db-query",mysql_error() );
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD_CAT." WHERE id='".$arr['download']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$db->closedb ();
?>
<tr>
<td colspan="2">
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0 background="images/bread.jpg" height=171>
				<tr>
					<TD colspan="2">
					<B><FONT COLOR="#990000" size=2>&nbsp;&nbsp;<?=_DOWNLOAD_MOD_READ_CAT;?>  <?=$arr['category']['category_name'];?>
					</td>
				</tr>
				<TR>
					<TD width=100 valign="top">

					<img  src="icon/download_<?=$arr['download']['post_date'];?>.jpg" class="mysborder" border="0" align="left>">

					</td>
					<td valign="top" width="540">
				<FONT COLOR="#000099" size=2><?=_FORM_MOD_READ_CONT;?> <?=$arr['download']['topic'];?></FONT></font><?=NewsIcon(TIMESTAMP, $arr['download']['post_date'], "images/icon_new.gif");?><br><FONT COLOR="#CC0000" size=2><?=_FORM_MOD_POSTEDX;?> <?=$arr['download']['posted'];?></FONT></B></font><br>
					<?= ThaiTimeConvert($arr['download']['post_date'],"1","");?>
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  <a href="?name=admin&file=download&op=download_edit&id=<? echo $arr['download']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
				  <a href="javascript:Confirm('?name=admin&file=download&op=download_del&id=<? echo $arr['download']['id'];?>&prefix=<? echo $arr['download']['post_date'];?>','<?=_FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
<?
}
?>
<BR><?=_DETAIL_PRIVIEW;?> : <?=$arr['download']['pageview'];?> 	<?=_DOWNLOAD_T_DOWN;?> : <?=$arr['download']['rate'];?></b>
					</td></tr>
<tr height=10><td colspan="2" >&nbsp;&nbsp;
<?
$rater_ids=$_GET['id'];
$rater_item_name='download';
include("modules/rater/rater.php");
?>
</td>
</tr>
</table>
					</TD>
				</TR>


				<TR>
					<TD align=center width="20%" >

<?
					 if($arr['download']['full_text']){ 	  
?>
<h5><a href="popup.php?name=download&file=rate&id=<?=$arr['download']['id']; ?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )" class="highslide"><img src="images/header.gif"><br><?=_DOWNLOAD_MOD_RATE_ATT;?></a><br>
<? } ?>
<font color="#FF0066"><?=_DOWNLOAD_MOD_READ_SIZE;?> <?	
	$bytes=$arr['download']['size'];
	echo getfilesize($bytes) ;?>
</h5>

					</TD>

					<TD width="80%" valign="top">
					<BR><font size=3><b><?=_DOWNLOAD_MOD_READ_DETAIL;?> : <br></font></b>
					<?=$Detail;?>

					<BR><BR>
					</TD>
				</TR>
				<TR>
					<TD height="1" class="dotline" colspan="2"></TD>
				</TR>
				<TR>
					<TD colspan="2">
					<BR>
					<B><FONT COLOR="#990000"><?=$arr['category']['category_name'];?> <?=_FROM_LINK_FIVECONT;?></B></FONT><BR><BR>
<?
//แสดงข่าวสาร/ประชาสัมพันธ์ 5 อันดับล่าสุดของหมวดหมู่ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['cat_download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." WHERE category='".$arr['category']['id']."' ORDER BY id DESC LIMIT 5 ");
$rows['cat_download'] = $db->rows($res['cat_download']); 
if(!$rows['cat_download']){
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"._FROM_CAT_NO." ";
}
while($arr['cat_download'] = $db->fetch($res['cat_download'])){
?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<IMG SRC="images/icon/suggest.gif" BORDER="0" ALIGN="absmiddle"> <B><A HREF="?name=download&file=readdownload&id=<?=$arr['cat_download']['id'];?>" target="_blank"><?=$arr['cat_download']['topic'];?></A></B> <?= ThaiTimeConvert($arr['cat_download']['post_date'],"","");?><BR>
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
if($arr['download']['enable_comment']){

	//Check Comment
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$total = $db->num_rows(TB_DOWNLOAD_COMMENT,"download_id","download_id=' ".$arr['download']['id']." ' ");
$e_page=10; 
if(!isset($_GET['s_page'])){   
	$_GET['s_page']=0;   
}else{   
	$chk_page=$_GET['s_page'];     
	$_GET['s_page']=$_GET['s_page']*$e_page;   
}
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$qr = $db->select_query("SELECT * FROM ".TB_DOWNLOAD_COMMENT." WHERE download_id='".$arr['download']['id']."' ORDER by id LIMIT ".$_GET['s_page'].",$e_page ");
$numr=$db->num_rows($qr);
if($numr >=1){   
	$plus_p=($chk_page*$e_page)+$numr;   
}else{   
	$plus_p=($chk_page*$e_page);       
}   
$total_p=ceil($total/$e_page);   
$before_p=($chk_page*$e_page)+1;  

	$count=1;
	while($arr['comment'] = $db->fetch($qr)){

?>
<center><table width=750>
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
				<?if($admin_user){echo " <A HREF=\"?name=download&file=delete_comment&id=".$_GET['id']."&comment=".$arr['comment']['id']."\"><IMG SRC=\"images/admin/trash.gif\" height=\"18\"  BORDER=\"0\" ALIGN=\"absmiddle\"></A>";};?>
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
		<td width="100%" alt="" ><hr><FONT COLOR="#990000"><?=_FORM_MOD_POSTEDX;?> </FONT></B> <?=$arr['comment']['name'];?> &nbsp;&nbsp; <FONT COLOR="#990000"><B><?=_FROM_COMMENT_IP;?> </B></FONT><?echo preg_replace('/([0-9]+\.[0-9]+)\.[0-9]+\.[0-9]+/', '\1<span style="color:red">.xxx.xxx</span>', $arr['comment']['ip']);?>
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
<?
			$count  ++;
echo "</td></tr></table>";
	}
	$db->closedb ();
?>
<center><table width=450><tr><td align=center width=100% class="browse_page">
	<?  page_navigator("download","readdownload",$id="".$_GET['id']."",$before_p,$plus_p,$total,$total_p,$chk_page); ?>
</td>
</tr>
</table>


			<!-- Enable Comment -->
			<TABLE cellSpacing=0 cellPadding=0 width=550 border=0 align="center">
			  <TBODY>
				<TR>
				  <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
				  <TD width="490" vAlign=top align=left><IMG src="images/topfader.gif" border=0><BR>
				  <IMG SRC="images/menu/textmenu_comment.gif" BORDER="0"><BR>
						<FORM NAME="form2" METHOD=POST ACTION="?name=download&file=comment&id=<?=$_GET['id'];?>">
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
							<TD><input name="security_code" type="text" id="security_code" size="20" maxlength="6" style="width:80" > <?=_JAVA_CAPTCHA_ADD;?> </TD>
						</TR>
<?
}
}
?>
						<TR>
							<TD width="80" align="right" valign=top><B><?=_FROM_COMMENT_NUMX;?> : </B></TD>
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

			<!-- End download -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
			<?
			} else {
include 'modules/user/danger.php';

		  }
		  ?>
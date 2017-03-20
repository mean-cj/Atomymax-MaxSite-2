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
          <TD width="740" vAlign=top>
		  <!-- research -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/research.gif" BORDER="0"><BR><BR>
		  <? OpenTablecom();?>
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0>
<?
//$_GET['id'] = intval($_GET['id']);
//แสดงข่าวสาร/ประชาสัมพันธ์ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." WHERE id='".$_GET['id']."' ");
$arr['research'] = $db->fetch($res['research']);
$db->closedb ();
$id=$arr['research']['id'];
if(!$arr['research']['id']){
	echo "<tr><td><BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>"._RESEARCH_MOD_READ_NOID."</B></CENTER><BR><BR><BR><BR></td></tr></table>";
}else{
	$content = $arr['research']['detail'];
	$Detail = stripslashes(FixQuotes($content));
	//ทำการเพิ่มจำนวนคนเข้าชม
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." WHERE id='".$_GET['id']."' ");
$arr['research'] = $db->fetch($res['research']);
$full  =$arr['research']['full_text'];
$abst =$arr['research']['abstract'];
$db->closedb ();
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$q['Pageview'] = "UPDATE ".TB_RESEARCH." SET pageview = pageview+1 WHERE id = '".$_GET['id']."' ";
	$sql['Pageview'] = mysql_query ( $q['Pageview'] ) or sql_error ( "db-query",mysql_error() );
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." WHERE id='".$arr['research']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$db->closedb ();
?>
<tr>
<td colspan="2">
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0 background="images/bread.jpg" height=171>
				<tr>
					<TD colspan="2">
					<B><FONT COLOR="#990000" size=2><?=$arr['category']['category_name'];?>
					</td>
				</tr>
				<TR>
				<TD align=center valign=top>&nbsp;<img src="icon/research_<?=$arr['research']['post_date'];?>.jpg" width="80">&nbsp;&nbsp;
					</TD>

					<TD width=100%  valign="top"><FONT COLOR="#000099" size=2><?=_FORM_MOD_READ_CONT;?> </font><FONT COLOR="#CC0000" size=2><?=$arr['research']['topic'];?></FONT></font><?=NewsIcon(TIMESTAMP, $arr['research']['post_date'], "images/icon_new.gif");?><br><br></font><FONT size=2><?=_RESEARCH_AUTHX;?> : <FONT COLOR="#CC0000" size=2> <?=$arr['research']['auth'];?></FONT></B></font><br>
					<?= ThaiTimeConvert($arr['research']['post_date'],"1","");?>
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  <a href="?name=admin&file=research&op=research_edit&id=<? echo $arr['research']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
				  <a href="javascript:Confirm('?name=admin&file=research&op=research_del&id=<? echo $arr['research']['id'];?>&prefix=<? echo $arr['research']['post_date'];?>','<? echo _FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
<?
}
				  ?>
				  <BR>
					<?=_DETAIL_PRIVIEW;?> : <?=$arr['research']['pageview'];?>&nbsp;&nbsp;&nbsp; <?=_RESEARCH_MOD_DOWN_COUNT;?> :  <?=$arr['research']['rate'];?> <?=_RESEARCH_MOD_DOWN_COUNT_NUM;?>
		
</td>
</tr>
<tr>
<td colspan=2>
<?
$rater_ids=$_GET['id'];
$rater_item_name='research';
include("modules/rater/rater.php");
?>
</td>
</tr>
</table>
</td>
</tr>
				<TR>
					<TD colspan="2">
					<BR><font size=2><b><?=_RESEARCH_MOD_ABSTRACT;?> : <br></font></b>
					<?=$Detail;?>

					<BR><BR>
					</TD>
				</TR>
				<TR>
					<TD height="1" class="dotline" colspan="2"></TD>
				</TR>
					<?

 if($full !='' AND $abst !=''){ ?>
<tr><td width=100% bgcolor=#F7F7F7 align=center colspan=2><font size=2><b><?=_FORM_MOD_DONWLOAD;?>&nbsp;<a href="popup.php?name=research&file=rate&id=<?=$id;?>&filess=<?=$arr['research']['full_text'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )" class="highslide"> ( Fulltext )</a>&nbsp;<a href="popup.php?name=research&file=rate&id=<?=$id;?>&filess=<?=$arr['research']['abstract'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )" class="highslide">&nbsp;( <?=_RESEARCH_MOD_ABSTRACT;?> )&nbsp;</a></font></td></tr>
<?} 
 if($full !='' AND $abst ==''){ 	?>
<tr><td width=100% bgcolor=#F7F7F7  align=center colspan=2><font size=2><b><?=_FORM_MOD_DONWLOAD;?>&nbsp;<a href="popup.php?name=research&file=rate&id=<?=$id;?>&filess=<?=$arr['research']['full_text'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )" class="highslide"> ( Fulltext )</a></font></b></td></tr>
<?}
 if($full =='' AND $abst !=''){ 	?>
<tr><td width=100% bgcolor=#F7F7F7  align=center colspan=2><font size=2><b><?=_FORM_MOD_DONWLOAD;?>&nbsp;<a href="popup.php?name=research&file=rate&id=<?=$id;?>&filess=<?=$arr['research']['abstract'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )" class="highslide">&nbsp;( <?=_RESEARCH_MOD_ABSTRACT;?>)&nbsp;</a></font></b></td></tr>
<?} 

?>
</table>
<?
}
?>
<?CloseTablecom();?>
<table align=center cellSpacing=0 cellPadding=0 border=0 width=750>

				<TR>
					<TD align=left>
					<BR>
					<B><FONT COLOR="#990000"><?=$arr['category']['category_name'];?> <?=_FROM_LINK_FIVECONT;?></B></FONT><BR><BR>
<?
//แสดงข่าวสาร/ประชาสัมพันธ์ 5 อันดับล่าสุดของหมวดหมู่ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['cat_research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." WHERE category='".$arr['category']['id']."' ORDER BY id DESC LIMIT 5 ");
$rows['cat_research'] = $db->rows($res['cat_research']); 
if(!$rows['cat_research']){
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"._FROM_CAT_NO."";
}
while($arr['cat_research'] = $db->fetch($res['cat_research'])){
?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<IMG SRC="images/icon/suggest.gif" BORDER="0" ALIGN="absmiddle"> <B><A HREF="?name=research&file=readresearch&id=<?=$arr['cat_research']['id'];?>" target="_blank"><?=$arr['cat_research']['topic'];?></A></B> <?= ThaiTimeConvert($arr['cat_research']['post_date'],"","");?><BR>
<?
}
$db->closedb ();
?>
					</TD>
				</TR>
			</TABLE>
			<BR><BR>
			
<?
if($arr['research']['enable_comment']){

	//Check Comment
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 10 ;
	$SUMPAGE = $db->num_rows(TB_RESEARCH_COMMENT,"research_id","research_id=' ".$arr['research']['id']." ' ");
	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;

	$res['comment'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_COMMENT." WHERE research_id='".$arr['research']['id']."' ORDER BY id LIMIT $goto, $limit ");
	$count=0;
	while($arr['comment'] = $db->fetch($res['comment'])){
		$count  ++;
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
				<?if($admin_user){echo " <A HREF=\"?name=research&file=delete_comment&id=".$_GET['id']."&comment=".$arr['comment']['id']."\"><IMG SRC=\"images/admin/trash.gif\" height=\"18\"  BORDER=\"0\" ALIGN=\"absmiddle\"></A>";};?>
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

</td>
</tr>
</table>
<?
	}
	echo "<center>";
	SplitPage($page,$totalpage,"?name=research&file=readresearch&id=".$_GET['id']."");
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
				  <IMG SRC="images/menu/textmenu_comment.gif" BORDER="0"><BR>
						<FORM NAME="form2" METHOD=POST ACTION="?name=research&file=comment&id=<?=$_GET['id'];?>">
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
							<TD><INPUT TYPE="submit" value="<?=_FROM_COMMENT_BUTTON_ADD;?>"><BR>
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

			<!-- End research -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>

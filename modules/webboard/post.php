    <TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD vAlign=top><BR>
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_webboard.gif" BORDER="0"></td>
		  </tr>
				<TR>
					<TD height="1" class="dotline"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="index.php?name=webboard"><font size='2' color='#0066FF'><b><?=_WEBBOARD_MENU_TITLE;?></b></font></a>&nbsp;&nbsp;   <font size="1">>></font>&nbsp;&nbsp;   <font size="2"><b><?=$CatShow;?></b></font>
  <hr width="95%" color="#999999" align="center" />
<br />


<?
if($_SESSION['login_true']){
CheckWebboard($_SESSION['login_true'], $_SESSION['pwd_login'],$_GET['category']);
} else if($_SESSION['admin_user']){
CheckWebboard($_SESSION['admin_user'], $_SESSION['admin_pwd'],$_GET['category']);
} else {
CheckWebboard('', '',$_GET['category']);
}
include ("editor.php");
if($_GET['action'] == "post"){
	//Check data
	if(!$_POST['topic'] OR !$_POST['category'] OR !$_POST['detail'] OR !$_POST['post_name']){
		echo "<script language='javascript'>" ;
		echo "alert('"._JAVA_DATA_NULL."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
if($_SESSION['login_true'] || $_SESSION['admin_user']){
} else {
	if(USE_CAPCHA){
check_captcha($_POST['security_code']);
	}
}
	//เช็คแบนโฆษณา
	$TOPIC=checkban($_POST['topic']);
	$DETAIL=banword($_POST['detail']);
	$POSTNAME=CheckRude($_POST['post_name']);
		if (substr_count($_POST['detail'],'<p>') == 1) {   
		$temp = preg_replace("/<p>/i","",$_POST['detail']);   
		$temp = preg_replace("/<\/p>/i","",$temp);   
		$_POST['detail'] = $temp; 
	} 
	$FILE = $_FILES['FILE'];
	$FILEATT = $_FILES['FILEATT'];
	if ( $FILE['size'] > _WEBBOARD_LIMIT_UPLOAD ) {
		echo "<script language='javascript'>" ;
		echo "alert('". _WEBBOARD_EDIT_ADD_PIC_WIDTH." ".(_WEBBOARD_LIMIT_UPLOAD/1024)." kB "._WEBBOARD_EDIT_ADD_PIC_WIDTH."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
	if ( $FILEATT['size'] > _WEBBOARD_LIMIT_UPLOADS ) {
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_EDIT_ADD_FILE_SIZE." ".(_WEBBOARD_LIMIT_UPLOADS/1024)." kB "._WEBBOARD_EDIT_ADD_FILE_SIZE1.
			"')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
		if ($FILEATT['name'] !=''){
	$info = strrchr( $FILEATT['name'] , '.' );
	if ( ($info =='.pdf') ||($info =='.doc') ||($info =='.xls') ||($info =='.ppt') ||($info =='.docx') ||($info =='.xlsx') ||($info =='.pptx')||($info =='.zip' ) ||($info =='.ZIP' )) {}else{
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_MESS_TPYE_FILE_NOACC." .doc , .xls , .ppt , .pdf , .zip  "._WEBBOARD_MESS_TPYE_FILE_NOACC1."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
	}
	//แป
	//แปลงนามสกุล และทำการ upload
if($FILE['name']){
if(strrchr($FILE['name'],".")==".jpg" || strrchr($FILE['name'],".")==".png" || strrchr($FILE['name'],".")==".gif"){
	if ( $FILE['type'] == "image/gif" )
			{$Filename = TIMESTAMP.".gif";}
	else if ( $FILE['type'] == "image/x-png" || $FILE['type'] == "image/png")
			{$Filename = TIMESTAMP.".png";}
	else if (($FILE['type']=="image/jpg")||($FILE['type']=="image/jpeg")||($FILE['type']=="image/pjpeg"))
			{$Filename = TIMESTAMP.".jpg";}
	@copy ($FILE['tmp_name'] , "webboard_upload/".$Filename );
} else {
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
}
}
//	@chmod("webboard_upload/".$Filename, 0644);
	//	@copy ($FILEATT['tmp_name'] , "webboard_upload/".TIMESTAMP."_".$FILEATT['name']);
	//Check Member
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

if($_SESSION['admin_user']){
$ISMembers =1;
$update_post = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$_SESSION['admin_user']."'");
$dbarr = $db->fetch($update_post);
$topic_up = $dbarr['topic']+1;
$db->update_db(TB_MEMBER,array(
			"topic"=>"$topic_up"
		)," user='".$_SESSION['admin_user']."' ");
} else if($_SESSION['login_true']){
$ISMembers = 1 ;
$update_post = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$_SESSION['login_true']."'");
$dbarr = $db->fetch($update_post);
$topic_up = $dbarr['topic']+1;
$db->update_db(TB_MEMBER,array(
			"topic"=>"$topic_up"
		)," user='".$_SESSION['login_true']."' ");
}else{
$ISMembers = 0;
}
	//Check Member

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	if ($FILEATT['name']){
	$db->add_db(TB_WEBBOARD,array(
		"category"=>"".$_POST['category']."",
		"topic"=>"".htmlspecialchars($_POST['topic'])."",
		"detail"=>"".$_POST['detail']."",
		"picture"=>"".$Filename."",
		"post_name"=>"".htmlspecialchars($_POST['post_name'])."",
		"is_member"=>"".$ISMembers."",
		"ip_address"=>"".$IPADDRESS."",
		"post_date"=>"".TIMESTAMP."",
		"post_update"=>"".TIMESTAMP."",
		"enable_show"=>"".$_POST['show']."",
		"att"=>"".TIMESTAMP."_".$FILEATT['name'].""
	)); 
@copy ($FILEATT['tmp_name'] , "webboard_upload/".TIMESTAMP."_".$FILEATT['name']);
//@chmod("webboard_upload/".TIMESTAMP."_".$FILEATT['name'], 0644);
	} else {
	$db->add_db(TB_WEBBOARD,array(
		"category"=>"".$_POST['category']."",
		"topic"=>"".htmlspecialchars($_POST['topic'])."",
		"detail"=>"".$_POST['detail']."",
		"picture"=>"".$Filename."",
		"post_name"=>"".htmlspecialchars($_POST['post_name'])."",
		"is_member"=>"".$ISMembers."",
		"ip_address"=>"".$IPADDRESS."",
		"post_date"=>"".TIMESTAMP."",
		"post_update"=>"".TIMESTAMP."",
		"enable_show"=>"".$_POST['show'].""
	)); 
	}
	$db->closedb();
	$PostComplete = True ;
}
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
function showexam() {
	exam1.style.display = 'none';
	exam2.style.display = '';
}
function closeexam() {
	exam1.style.display = '';
	exam2.style.display = 'none';
}
function emoticon(theSmilie) {

	document.form2.detail.value += ' ' + theSmilie + ' ';
	document.form2.detail.focus();
}
</script>

    <style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
.style2 {color: #FF0000}
-->
    </style>
	<br />
	 <?
$_GET['category'] = intval($_GET['category']);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['BoardCat'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." ORDER BY sort ");
while($arr['BoardCat'] = $db->fetch($res['BoardCat'])){
	//Sum Album
	$SumCat = $db->num_rows(TB_WEBBOARD,"id"," category='".$arr['BoardCat']['id']."' "); 
}

if($_GET['category']){
	$SQLwhere = " pin_date='' AND category='".$_GET['category']."' ";
	$SQLwhere2 = " WHERE pin_date='' AND category='".$_GET['category']."' ";
	$SQLwherePin = " WHERE pin_date!='' AND category='".$_GET['category']."' ";
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT category_name FROM ".TB_WEBBOARD_CAT." WHERE id='".$_GET['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$CatShow = $arr['category']['category_name'];
}else{
	$CatShow = ""._WEBBOARD_LISTALL."";
	$SQLwhere = " pin_date='' ";
	$SQLwhere2 = " WHERE pin_date='' ";
	$SQLwherePin = " WHERE pin_date!='' ";
}
?>

<?
//แสดงผลการPost
if($PostComplete){
	//Complete
?>
<BR><BR>
<TABLE width=90% align=center>
<TR>
	<TD><CENTER>
	</CENTER></TD>
</TR>
<TR>
	<TD><CENTER><B><?=_WEBBOARD_COMMENT_POST_SUCCESS;?></B><BR><BR>
	<A HREF="index.php?name=webboard&file=board"><?=_WEBBOARD_COMMENT_EDIT_BACKIN;?></A>
<meta http-equiv="refresh" content="0.5;URL=index.php?name=webboard&file=board&category=<?=$_POST['category'];?>" />
	</CENTER></TD>
</TR>
</TABLE><BR>
<BR>
<?
}else{
	//Not Complete
?>
<br />
<FORM name="form2" METHOD=POST ACTION="index.php?name=webboard&file=post&action=post"  enctype="multipart/form-data">
<TABLE width="700" align="center" border=0>
<TR>
	<TD align=right>&nbsp;</TD>
	<TD colspan="2">
	<INPUT NAME="category" TYPE="hidden" class="inputform" value="<?=$_GET['category'];?>" style="width:40"></TD>
</TR>
<TR>
	<TD align=right width="100"><B><?=_WEBBOARD_TOPIC_TOP;?> : </B></TD>
	<TD colspan="2"><INPUT NAME="topic" TYPE="text" class="inputform" style="width:400"></TD>
</TR>
<?
//กรณี โพสรูปได้ 
if(_ENABLE_BOARD_UPLOAD){
?>
<TR>
	<TD align=right><B><?=_WEBBOARD_FORM_ATT_PIC_TITLE;?> : </B></TD>
	<TD colspan="2"><input type="file" name="FILE" style="width:250" class="inputform"> Limit <?=(_WEBBOARD_LIMIT_UPLOAD/1024);?> kB</TD>
</TR>
<?
}

if($login_true || $admin_user){
?>
<TR>
	<TD width=150 align=right><B><?=_WEBBOARD_FORM_ATT_FILE_TITLE;?> : </B></TD>
	<TD><input type="file" name="FILEATT" style="width:250" class="inputform"> Limit <?=(_WEBBOARD_LIMIT_UPLOADS/1024);?> kB</TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
<?
}
if($login_true || $admin_user){
?>
<TR>
	<TD width=150 align=right><B><?=_WEBBOARD_FORM_TOPIC_MEMBER_ONLY;?> : </B></TD>
	<TD><input type=checkbox name=show  value=1><?=_WEBBOARD_FORM_TOPIC_MEMBER_ONLY_1;?>&nbsp;&nbsp;<input type=checkbox name=show  value=0><?=_WEBBOARD_FORM_TOPIC_MEMBER_ONLY_2;?></TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
<?
}
?>
<TR>
	<TD align=right valign=top><B><?=_WEBBOARD_FORM_DETAIL_TITLE;?> : </B></TD>
	<TD colspan="2">
<textarea cols="50" id="editor1" rows="50"  name="detail" ></textarea>
		<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script>
	</TD>
</TR>
<? 	 if($login_true || $admin_user){
} else {
if(USE_CAPCHA){
?>
						<TR>
							<TD align=right><b><?=_WEBBOARD_CAPTCHA_ADD_TITLE;?> : </b></TD>
						  <TD colspan="2"><input name="security_code" type="text" id="security_code" size="20" maxlength="6" style="width:80" > <?if(CAPCHA_TYPE == 1){ 
								echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							}else if(CAPCHA_TYPE == 2){ 
								echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							};?></TD>
						</TR>
<?
}}
?>
<TR>
	<TD align=right><B><?=_WEBBOARD_FORM_AUTH_POST;?> :</b></TD>
	<TD colspan="2"><INPUT TYPE="text" NAME="post_name" style="width:150" class="inputform" <?if($login_true){echo "value=\"".$login_true."\" readonly style=\"color: #FF0000\" ";} if($admin_user){echo "value=\"".$admin_user."\" readonly style=\"color: #FF0000\" ";};?>></TD>
</TR>
<TR>
	<TD align=right><B></B></TD>
	<TD width="86"><input type="submit" name="Submit" value="<?=_WEBBOARD_FORM_BUTTON_ADD_POST;?>" /></TD>
</TR>
</TABLE>
</FORM>
<?
}

?>
</td>
</tr>
</table>
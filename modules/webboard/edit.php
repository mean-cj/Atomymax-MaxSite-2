<?include ("editor.php");?>
<?
if ($_GET['s_page']){
$s_pagex=$_GET['s_page'];
} else {
$s_pagex=0;
}
//session_start();
CheckAdmin($admin_user, $admin_pwd);
	$_GET['id'] = intval($_GET['id']);
//Post Action
if($_GET['action'] == "edit"){
	//Check data
	if(!$_POST['topic'] OR !$_POST['category'] OR !$_POST['detail'] OR !$_POST['post_name']){
		echo "<script language='javascript'>" ;
		echo "alert('"._JAVA_DATA_NULL."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
	 if($login_true || $admin_user){
} else {
	if(USE_CAPCHA){
check_captcha($_POST['security_code']);
	}
}
	//เช็คแบนโฆษณา
	checkban($_POST['topic']);
	checkban($_POST['detail']);
	checkban($_POST['post_name']);
	//Check Pic Size
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
	//	@copy ($FILEATT['tmp_name'] , "webboard_upload/".TIMESTAMP."_".$FILEATT['name']);
	//Check Member
	if($admin_user){$ISMembers ="1";} else if($login_true){$ISMembers = "1";}else{$ISMembers = "0";}
	//Add Topic
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	if ($FILEATT['name']){
	$db->update_db(TB_WEBBOARD,array(
		"category"=>"".$_POST['category']."",
		"topic"=>"".htmlspecialchars($_POST['topic'])."",
		"detail"=>"".$_POST['detail']."",
		"picture"=>"$Filename",
		"post_name"=>"".htmlspecialchars($_POST['post_name'])."",
		"is_member"=>"".$ISMembers."",
		"ip_address"=>"".$IPADDRESS."",
		"att"=>"".TIMESTAMP."_".$FILEATT['name'].""
	)," id=".$_GET['id'].""); 
@copy ($FILEATT['tmp_name'] , "webboard_upload/".TIMESTAMP."_".$FILEATT['name']);
	} else {
	$db->update_db(TB_WEBBOARD,array(
		"category"=>"".$_POST['category']."",
		"topic"=>"".htmlspecialchars($_POST['topic'])."",
		"detail"=>"".$_POST['detail']."",
		"picture"=>"$Filename",
		"post_name"=>"".htmlspecialchars($_POST['post_name'])."",
		"is_member"=>"".$ISMembers."",
		"ip_address"=>"".$IPADDRESS.""
	)," id=".$_GET['id']."");
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

function emoticon(theSmilie) {

	document.form2.detail.value += ' ' + theSmilie + ' ';
	document.form2.detail.focus();
}
</script>

    <TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- Webboard -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_webboard.gif" BORDER="0"><BR>


<?
//แสดงผลการPost
if($PostComplete){
	//Complete
	echo "<meta http-equiv='refresh' content='2;url=?name=webboard'>";
?>
<BR><BR>
<TABLE width=90% align=center>
<TR>
	<TD><CENTER><IMG SRC="images/post_complete.png" BORDER="0"></CENTER></TD>
</TR>
<TR><TD height=1 class="dotline"></TD></TR>
<TR>
	<TD><CENTER><B><?=_WEBBOARD_COMMENT_EDIT_SUCCESS;?></B><BR><BR>
	<A HREF="?name=webboard"><?=_WEBBOARD_COMMENT_EDIT_BACKIN;?></A>
	</CENTER></TD>
</TR>
<TR><TD height=1 class="dotline"></TD></TR>
</TABLE><BR><BR>
<?
}else{
	//Not Complete
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['web'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id='".$_GET['id']."' ");
	$arr['web'] = $db->fetch($res['web']);
?>
<FORM name="form2" METHOD=POST ACTION="?name=webboard&file=edit&action=edit&id=<?=$_GET['id'];?>&s_page=<?=$s_pagex;?>" enctype="multipart/form-data" >
<TABLE width="95%" align="center">
<TR>
	<TD width=150 align=right><IMG SRC="images/bullet.gif" BORDER="0" ALIGN="absmiddle"> <B><?=_FORM_CAT;?> </B></TD>
	<TD>
	<SELECT NAME="category">
	<OPTION value=""><?=_FROM_SEARCH_CAT_ALL;?></OPTION>
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['BoardCat'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." ORDER BY sort ");
while($arr['BoardCat'] = $db->fetch($res['BoardCat'])){
	echo "<OPTION value=\"".$arr['BoardCat']['id']."\"";
		   if($arr['BoardCat']['id'] == $arr['web']['category']){echo " Selected";}
	   echo ">".$arr['BoardCat']['category_name']."</OPTION>";
}
$db->closedb();
?>
	</SELECT>
	</TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
<TR>
	<TD width=150 align=right><IMG SRC="images/bullet.gif" BORDER="0" ALIGN="absmiddle"> <B><?=_FORM_TOPIC;?> </B></TD>
	<TD><INPUT TYPE="text" NAME="topic" style="width:300" class="inputform" value="<?=$arr['web']['topic'];?>"></TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
<?
//กรณี โพสรูปได้ 
if(_ENABLE_BOARD_UPLOAD){
?>
<TR>
	<TD width=150 align=right><B><?=_WEBBOARD_FORM_ATT_PIC_TITLE;?> : </B></TD>
	<TD><input type="file" name="FILE" style="width:250" class="inputform"> Limit <?=(_WEBBOARD_LIMIT_UPLOAD/1024);?> kB</TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
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
?>
<TR>
	<TD width=150 align=right valign=top><IMG SRC="images/bullet.gif" BORDER="0" ALIGN="absmiddle"> <B><?=_WEBBOARD_FORM_DETAIL_TITLE;?> : </B></TD>
	<TD><TEXTAREA id="editor1" NAME="detail" ROWS="10" style="width:350" class="textareaform"><?=$arr['web']['detail'];?></TEXTAREA>
			<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script>
	</TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
<?
	 if($login_true || $admin_user){
} else {
if(USE_CAPCHA){
?>
						<TR>
							<TD width=150 align=right>
							<?if(CAPCHA_TYPE == 1){ 
								echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							}else if(CAPCHA_TYPE == 2){ 
								echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							};?>
							</TD>
							<TD><input name="security_code" type="text" id="security_code" size="20" maxlength="6" style="width:80" > <?=_JAVA_CAPTCHA_ADD;?></TD>
						</TR>
						<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
<?
}
}
?>
<TR>
	<TD width=150 align=right><IMG SRC="images/bullet.gif" BORDER="0" ALIGN="absmiddle"> <B><?=_WEBBOARD_FORM_AUTH_POST;?> : </B></TD>
	<TD><INPUT TYPE="text" NAME="post_name" style="width:150" class="inputform" <?if($login_true){echo "value=\"".$login_true."\" readonly style=\"color: #FF0000\" ";} if($admin_user){echo "value=\"".$admin_user."\" readonly style=\"color: #FF0000\" ";};?>></TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
<TR>
	<TD width=150 align=right><B></B></TD>
	<TD><INPUT TYPE="submit" value="<?=_WEBBOARD_FORM_BUTTON_ADD;?>" > </TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
</TABLE>
</FORM>
<?
}
//จบการแสดงผลฟอร์ม Post
?>

			<BR><BR>
			<!-- webboard -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
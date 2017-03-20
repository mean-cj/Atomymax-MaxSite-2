<?include ("editor.php");?>
<?
if ($_GET['s_page']){
$s_pagex=$_GET['s_page'];
} else {
$s_pagex=0;
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$VIEWBOARD = $db->fetch($db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE id = '".$_GET['id']."' "));
$db->closedb ();
?>

    <TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
		<TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD vAlign=top><img src="images/topfader.gif" border="0" /><br />
  &nbsp;&nbsp;<img src="images/menu/textmenu_webboard.gif" border="0" /><br> 
  &nbsp;&nbsp;&nbsp;&nbsp;<font size="2" color="red"><?=_WEBBOARD_FORM_EDIT_COMMENT_TITILE;?> &nbsp;&nbsp;[ <a href="?name=webboard&file=read&id=<?=$_GET['id'];?>"><?=_WEBBOARD_FORM_EDIT_BUTTON_BACK;?></a> ] </font><br>    <BR>
<?
		if($login_true==$VIEWBOARD['post_name'] || $admin_user ){

//$id=$_GET['id'];
//Edit Action
if($_GET['action'] == "editcomment"){

	//Check data
	if(!$_POST['DETAIL'] OR !$_POST['post_name']){
		echo "<script language='javascript'>" ;
		echo "alert('"._JAVA_DATA_NULL."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
	 if($login_true==$VIEWBOARD['post_name'] || $admin_user){
} else {
	if(USE_CAPCHA){
check_captcha($_POST['security_code']);
	}
		} //จบ if( !$login_true)
	//เช็คแบนโฆษณา
	//checkban($_POST['DETAIL']);
	checkban($_POST['post_name']);
	//Check Pic Size
if (substr_count($_POST['DETAIL'],'<p>') == 1) {   
		$temp = preg_replace("/<p>/i","",$_POST['DETAIL']);   
		$temp = preg_replace("/<\/p>/i","",$temp);   
		$DETAIL = $temp; 
	} else {
		$DETAIL =$_POST['DETAIL']; 
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
$webboard_pic=$_POST['picture'];
	if ( $FILE['size'] == 0 )
			{$Filename = $webboard_pic ;} 
			else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$PicResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE id='".$_GET['id']."' ");
		while($DelPic = $db->fetch($PicResult)) {
		@unlink("webboard_upload/".$DelPic['picture']."");
		$db->update_db(TB_WEBBOARD_COMMENT,array("picture"=>""	)," id='".$_GET['id']."' ");
		$db->closedb ();
		}

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

	//Check File Size
	$FILEUP = $_FILES['FILEUPLOAD'];
	if ( $FILEUP['size'] > _WEBBOARD_LIMIT_UPLOADS ) {
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_EDIT_ADD_FILE_SIZE." ".(_WEBBOARD_LIMIT_UPLOADS/1024)." kB "._WEBBOARD_EDIT_ADD_FILE_SIZE1.
			"')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
	if ($FILEATT['name']){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_WEBBOARD_COMMENT,array(
			"detail"=>"".$DETAIL."",
			"picture"=>"$Filename",
		"att"=>"".TIMESTAMP."_".$FILEATT['name'].""
	)," id=".$_GET['id'].""); 
@copy ($FILEATT['tmp_name'] , "webboard_upload/".TIMESTAMP."_".$FILEATT['name']);
	} else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_WEBBOARD_COMMENT,array(
			"detail"=>"".$DETAIL."",
			"picture"=>"$Filename"
		)," id='".$_GET['id']."' ");
	}

		$db->closedb ();
	$EditComplete = True ;

//ถ้าต้องการลบรูปประกอบ
if ($_POST['chkdel']=="1") {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$PicResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE id='".$_GET['id']."' ");
		while($DelPic = $db->fetch($PicResult)) {
		@unlink("webboard_upload/".$DelPic['picture']."");
		$db->update_db(TB_WEBBOARD_COMMENT,array("picture"=>""	)," id='".$_GET['id']."' ");
		$db->closedb ();
		}
}
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
function showattatch() {
	attatch1.style.display = 'none';
	attatch2.style.display = '';
}
function closeattatch() {
	attatch1.style.display = '';
	attatch2.style.display = 'none';
}

function emoticon(theSmilie) {

	document.form2.detail.value += ' ' + theSmilie + ' ';
	document.form2.detail.focus();
}
</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>

            <?
//echo $DETAIL;
//แสดงผลการPost
if($EditComplete){
echo "<meta http-equiv='refresh' content='0.5;url=?name=webboard&file=read&id=".$VIEWBOARD['topic_id']."&s_page=".$s_pagex."'>";
	//Complete
?>    <BR>    <BR>
  <TABLE width=90% align=center>
    <TR>
      <TD><CENTER>
      </CENTER></TD>
    </TR>
    <TR>
      <TD><CENTER>
        <B><?=_WEBBOARD_COMMENT_EDIT_SUCCESS;?></B><BR>
        <BR>
        <?=_WEBBOARD_COMMENT_EDIT_SUCCESS_WAIT;?></A>
        <br><br><a href="?name=webboard&file=read&id=<?=$VIEWBOARD['topic_id']?>"><?=_WEBBOARD_COMMENT_EDIT_SUCCESS_CLICK;?></a>
        </CENTER></TD>
    </TR>
  </TABLE><BR><BR>
  <?
}else{
	//Not Complete



//ดึงข้อมูลเดิมมาแสดง
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['webboard'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE id='".$_GET['id']."' ");
		$arr['webboard'] = $db->fetch($res['webboard']);

//ดึงข้อมูลหัวข้อเดิมมาแสดง
		$res['webboardtopic'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id='".$VIEWBOARD['topic_id']."' ");
		$arr['webboardtopic'] = $db->fetch($res['webboardtopic']);
		$db->closedb ();


?>
  <FORM name="form2" METHOD=POST ACTION="?name=webboard&file=editcomment&action=editcomment&id=<?=$_GET['id']?>&s_page=<?=$s_pagex;?>" enctype="multipart/form-data" >
    <TABLE width="98%" align="center">
      <TR>
        <TD width=150 align=right><IMG SRC="images/bullet.gif" BORDER="0" ALIGN="absmiddle"> <B><?=_WEBBOARD_TOPIC_TOP;?> : </B></TD>
	    <TD width=400><input type="text" name="topic" size="50" style="width:300" class="inputform" value="<?=$arr['webboardtopic']['topic']?>" readonly></TD>
    </TR>
      <?
//กรณี โพสรูปได้ 
if(_ENABLE_BOARD_UPLOAD){
?>
      <TR>
        <TD width=150 align=right><B><?=_WEBBOARD_FORM_ATT_PIC_TITLE;?> : </B></TD>
	    <TD>	<?
		if ($arr['webboard']['picture'])	{
			echo "<input type='checkbox' name='chkdel' value='1'>&nbsp;"._WEBBOARD_FORM_DEL_PIC_TITLE."&nbsp;";
			echo "<br><img src='webboard_upload/".$arr['webboard']['picture']."' border='0' align='top' width='150'>";
		}
		?>		<br><font color="red"><?=_WEBBOARD_FORM_UPLOAD_PIC_TITLE;?></font><br><input type="file" name="FILE" style="width:250" class="inputform"> Limit <?=(_WEBBOARD_LIMIT_UPLOAD/1024);?> kB  </TD>
    </TR>
      <?
}
		if($login_true || $admin_user){
?>
<TR>
	<TD align=right><B><?=_WEBBOARD_FORM_ATT_FILE_TITLE;?> : </B></TD>
	<TD><input type="file" name="FILEATT" style="width:250" class="inputform"> Limit <?=(_WEBBOARD_LIMIT_UPLOADS/1024);?> kB</TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
<?
}
?>
  <TR>
    <TD width=150 align=right valign=top ><b><?=_WEBBOARD_FORM_DETAIL_TITLE;?> : </b></TD>
	<TD>
<textarea cols="50" id="editor1" rows="50"  name="DETAIL" ><?=$arr['webboard']['detail'];?></textarea>
		<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script>
	</TD>
</TR>

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
							};?>          </TD>
						      <TD><input name="security_code" type="text" id="security_code" size="20" maxlength="6" style="width:80" > <?=_JAVA_CAPTCHA_ADD;?></TD>
	        </TR>
      <?
}
	}
?>
      <TR>
        <TD width=150 align=right><IMG SRC="images/bullet.gif" BORDER="0" ALIGN="absmiddle"> <B><?=_WEBBOARD_FORM_AUTH_POST;?> : </B></TD>
	    <TD><INPUT TYPE="text" NAME="post_name" style="width:150"  class="inputform" value=<?=$arr['webboard']['post_name'];?> readonly style="color: #FF0000" > </TD>
    </TR>
      <TR>
        <TD width=150 align=right><B></B></TD>
	    <TD><INPUT TYPE="submit" value="<?=_WEBBOARD_FORM_BUTTON_ADD_COM;?>"><INPUT TYPE="hidden" NAME="picture"  value="<?=$arr['webboard']['picture'];?>"><INPUT TYPE="hidden" NAME="fileuploadnew"  value="<?=$arr['webboard']['fileupload'];?>"><INPUT TYPE="hidden" NAME="id"  value="<?=$arr['webboard']['id'];?>"></TD>
    </TR>
      </TABLE>
  </FORM><?
}
		}
//จบการแสดงผลฟอร์ม Post
?>
            
            <BR>			<BR>
</TD></TR>
      </TBODY>
    </TABLE>
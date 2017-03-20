<?
//แรียก user online ทั้งหมด
include ("editor.php");
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
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_user.gif" BORDER="0"><BR>
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
<?
 if($_GET['op'] == "download_add" AND $_GET['action'] == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if($admin_user<>"" || $login_true<>""){


		require("includes/class.resizepic.php");
		$FILE = $_FILES['FILE'];
		$FILES = $_FILES['filesw'];
		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL'] OR !$FILE['type']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
		if (($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}else{
			@copy ($FILE['tmp_name'] , "icon/download_".TIMESTAMP.".jpg" );
			$original_image = "icon/download_".TIMESTAMP.".jpg" ;
			$desired_width = _Idownload_W ;
			$desired_height = _Idownload_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/download_".TIMESTAMP.".jpg", "JPG");
		}
//echo $filesw_name;
		if ($FILES['tmp_name'])
{
//			print ("Local File : $FILES['name'] <br> \n");
//print ("Name : $FILES['name'] \n");
//print ("Size : $FILES['size'] byte \n");
//print ("Type : $FILES['type']  \n");
$abstractxx_name =$FILES['tmp_name'];

     if(strrchr($abstractxx_name,".")==".pdf" || strrchr($abstractxx_name,".")==".doc" ||strrchr($abstractxx_name,".")==".xls" || strrchr($abstractxx_name,".")==".ppt" || strrchr($abstractxx_name,".")==".docx" || strrchr($abstractxx_name,".")==".xlsx" || strrchr($abstractxx_name,".")==".pptx" || strrchr($abstractxx_name,".")==".zip" || strrchr($abstractxx_name,".")==".rar" || strrchr($abstractxx_name,".")==".tar.gz") {	
		 copy($_FILES['abstractxx']['tmp_name'], "data/download_".TIMESTAMP."_".$FILES['name']."");
}else{
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_MESS_TPYE_FILE_NOACC." .doc , .xls , .ppt , .pdf , .zip , .tar.gz , .rar "._WEBBOARD_MESS_TPYE_FILE_NOACC1."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
	//else {

  //             if ( $upload=copy( $FILES['tmp_name'], "data/download_".TIMESTAMP."_".$FILES['name']."")) {
   //             }else{
   //                     print "<center><font color='red'>"._DOWNLOAD_MOD_ERROR1." ".$FILES['name']." "._DOWNLOAD_MOD_ERROR2."</font></center><br>";
   //             }
//	}
    //          unlink($filesw);
			  		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_DOWNLOAD,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".addslashes(htmlspecialchars($_POST['HEADLINE']))."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$_POST['ENABLE_COMMENT']."",
			"full_text"=>"".TIMESTAMP."_".$FILES['name']."",
			"type"=>"".$FILES['type']."",
			"size"=>"".$FILES['size'].""
		));
		$db->closedb ();
} else {
			//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_DOWNLOAD,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".addslashes(htmlspecialchars($_POST['HEADLINE']))."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$_POST['ENABLE_COMMENT'].""));
		$db->closedb ();
}

		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=download\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._DOWNLOAD_MOD_ACC."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=download\"><B>"._DOWNLOAD_MOD_INDEX."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($_GET['op'] == "download_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
if($admin_user<>"" || $login_true<>""){
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=download&file=add&op=download_add&action=add" enctype="multipart/form-data" id="myform">
<B><?=_FORM_TOPIC;?></B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="50">
<BR><BR>


<B><?=_FORM_CAT;?></B><BR>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?=_DOWNLOAD_IMG_TITLE;?> </B><BR>
<IMG name="view01" SRC="images/news_blank.gif" <?echo " WIDTH=\""._Idownload_W."\" HEIGHT=\""._Idownload_H."\" ";?> BORDER="0" ><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_FORM_ICON_FIX1;?> <?echo _Idownload_W." x "._Idownload_H ;?> <?=_FORM_ICON_FIX2;?>
<BR><BR>
<B><?=_FORM_HEADLINE;?></B><BR>
<textarea cols="50" id="editor1" rows="50"  name="HEADLINE" ><?=$HEADLINE;?></textarea>
		<script type="text/javascript">CKEDITOR.replace( 'editor1',{toolbar :	[['Save'],
	['Undo','Redo'],
	['Bold','Italic','Underline','StrikeThrough','Blockquote','Subscript', 'Superscript'],
	['TextColor','BGColor'],
	['OrderedList','UnorderedList'],
	['Link','Unlink','Smiley'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull','FontSize', 'FontFormat','FontName']]});</script>
<BR><BR>
<B><?=_FORM_DETAIL;?></B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ><?=$TextContent;?></textarea>
		<script type="text/javascript">CKEDITOR.replace( 'DETAIL',{
	toolbar :	[    ['-','Save','NewPage','Preview','-','Templates'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],'/',
    ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',  'HiddenField'],['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
    '/',
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Link','Unlink','Anchor'],
    '/',
    ['Styles','Format','Font','FontSize'],['TextColor','BGColor'],['Maximize','ShowBlocks','-','About'],'/',
	['syntaxhighlight','inserthtml','lrcshow','highslide','youtube']]});</script>
<BR>
<br><b><?=_DOWNLOAD_FILE_ATT;?> <input type="file" name="filesw" maxlength ="50" size="50"><br>

<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1"> <?=_FORM_COMMENT;?>
<BR>
<input type="submit" value=" <?=_DOWNLOAD_BUTTON_ADD;?>" name="submit"> <input type="reset" value="<?=_FORM_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
			<BR><BR>
			<!-- Admin -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
			<?
			} else {
include 'modules/user/danger.php';
		  }
		  ?>
<?include ("editor.php");?>

	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/research.gif" BORDER="0"><BR>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
<?
 if($_GET['op'] == "research_add" AND $_GET['action'] == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
//	if($admin_user<>"" || $arr['user']<>""){

	require("includes/class.resizepic.php");
	$abstractxx_name = $_FILES['abstractxx']['name']; 
	$filesw_name = $_FILES['filesw']['name']; 
	$FILE = $_FILES['FILE'];

		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['auth'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL'] OR !$FILE['type']){
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
if(strrchr($filesw_name,".")==".zip" || strrchr($filesw_name,".")==".ZIP"||strrchr($abstractxx_name,".")==".pdf" || strrchr($abstractxx_name,".")==".doc" ||strrchr($abstractxx_name,".")==".xls" || strrchr($abstractxx_name,".")==".ppt" || strrchr($abstractxx_name,".")==".docx" || strrchr($abstractxx_name,".")==".xlsx" || strrchr($abstractxx_name,".")==".pptx"){
			@copy ($FILE['tmp_name'] , "icon/research_".TIMESTAMP.".jpg" );
			$original_image = "icon/research_".TIMESTAMP.".jpg" ;
			$desired_width = _Iresearch_W ;
			$desired_height = _Iresearch_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/research_".TIMESTAMP.".jpg", "JPG");
		} else {
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_MESS_TPYE_FILE_NOACC." .zip .doc , .xls , .ppt , .pdf "._WEBBOARD_MESS_TPYE_FILE_NOACC1."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
		}
}
			if ($login_true){
			$dir=$login_true;
			} else if($admin_user) { $dir=$admin_user;
			} else { $dir='guest';}

if (is_uploaded_file($_FILES['filesw']['tmp_name']) && is_uploaded_file($_FILES['abstractxx']['tmp_name']))
{

if (is_uploaded_file($_FILES['filesw']['tmp_name']))  {
     if(strrchr($filesw_name,".")==".zip" || strrchr($filesw_name,".")==".ZIP") {	
		 copy($_FILES['filesw']['tmp_name'], "data/research_".TIMESTAMP."_$filesw_name");}else{
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_MESS_TPYE_FILE_NOACC." .zip "._WEBBOARD_MESS_TPYE_FILE_NOACC1."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}

	 }  else{
          print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." ".$_FILES['filesw']['name']." "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
	}
if (is_uploaded_file($_FILES['abstractxx']['tmp_name']))  {
     if(strrchr($abstractxx_name,".")==".pdf" || strrchr($abstractxx_name,".")==".doc" ||strrchr($abstractxx_name,".")==".xls" || strrchr($abstractxx_name,".")==".ppt" || strrchr($abstractxx_name,".")==".docx" || strrchr($abstractxx_name,".")==".xlsx" || strrchr($abstractxx_name,".")==".pptx" ) {	

		 copy($_FILES['abstractxx']['tmp_name'], "data/research_".TIMESTAMP."_$abstractxx_name");}else{
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_MESS_TPYE_FILE_NOACC." .doc , .xls , .ppt , .pdf  "._WEBBOARD_MESS_TPYE_FILE_NOACC1."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}

	 }  else{
          print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." ".$_FILES['abstractxx']['name']." "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
	}
			  		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$dir."",
			"auth"=>"".$_POST['auth']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$_POST['ENABLE_COMMENT']."",
			"full_text"=>"research_".TIMESTAMP."_".$filesw_name."", 
			"abstract"=>"research_".TIMESTAMP."_".$abstractxx_name.""  ));
		$db->closedb ();


		  } else if (is_uploaded_file($_FILES['filesw']['tmp_name']) && !is_uploaded_file($_FILES['abstractxx']['tmp_name']))
		{
if (is_uploaded_file($_FILES['filesw']['tmp_name']))  {  
     if(strrchr($filesw_name,".")==".zip" || strrchr($filesw_name,".")==".ZIP") {	
		 copy($_FILES['filesw']['tmp_name'], "data/research_".TIMESTAMP."_$filesw_name");}else{
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_MESS_TPYE_FILE_NOACC." .zip  "._WEBBOARD_MESS_TPYE_FILE_NOACC1."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
			  		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$dir."",
			"auth"=>"".$_POST['auth']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$_POST['ENABLE_COMMENT']."",
			"full_text"=>"research_".TIMESTAMP."_".$filesw_name." "  ));
		$db->closedb ();
	 }  else{
          print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." ".$_FILES['filesw']['name']." "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
	}

} else if (!is_uploaded_file($_FILES['filesw']['tmp_name']) && is_uploaded_file($_FILES['abstractxx']['tmp_name'])){
if (is_uploaded_file($_FILES['abstractxx']['tmp_name']))  {  
     if(strrchr($abstractxx_name,".")==".pdf" || strrchr($abstractxx_name,".")==".doc" ||strrchr($abstractxx_name,".")==".xls" || strrchr($abstractxx_name,".")==".ppt" || strrchr($abstractxx_name,".")==".docx" || strrchr($abstractxx_name,".")==".xlsx" || strrchr($abstractxx_name,".")==".pptx" ) {	
		 copy($_FILES['abstractxx']['tmp_name'], "data/research_".TIMESTAMP."_$abstractxx_name");}else{
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_MESS_TPYE_FILE_NOACC." .doc , .xls , .ppt , .pdf  "._WEBBOARD_MESS_TPYE_FILE_NOACC1."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
      //        unlink($abstractxx_name);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$dir."",
			"auth"=>"".$_POST['auth']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$_POST['ENABLE_COMMENT']."",
			"abstract"=>"research_".TIMESTAMP."_".$abstractxx_name.""  ));
		$db->closedb ();
	 }  else{
          print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." ".$_FILES['abstractxx']['name']." "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
	}

} else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$dir."",
			"auth"=>"".$_POST['auth']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$_POST['ENABLE_COMMENT']."" ));
		$db->closedb ();
}
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=research\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._RESEARCH_MOD_ADD_SUCCESS."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=research\"><B>"._RESEARCH_MOD_ADD_BUTTON_BACKIN." </B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}
else if($_GET['op'] == "research_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
//	if(CheckLevel($admin_user,$_GET['op'])){
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=research&file=add&op=research_add&action=add" enctype="multipart/form-data" id="myform">
<B><?=_RESEARCH_MOD_FORM_NAME_RE;?> :</B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="110">
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_NAME_AUTH;?> :</B><BR>
<INPUT TYPE="text" NAME="auth" size="50" value=<? if($login_true){echo $login_true;} if($admin_user){echo $admin_user;}  ?>>
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_CAT;?> :</B><BR>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_AUTH_PIC;?> : </B><BR>
<IMG name="view01" SRC="images/news_blank.gif" <?echo " WIDTH=\""._Iresearch_W."\" HEIGHT=\""._Iresearch_H."\" ";?> BORDER="0" ><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_FORM_ICON_FIX1;?> <?echo _Iresearch_W." x "._Iresearch_H ;?> <?=_FORM_ICON_FIX2;?>
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_HEADLINE;?> :</B><BR>
<textarea cols="50" id="editor1" rows="50"  name="HEADLINE" ></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Mini'});</script>
<BR><BR>

<B><?=_RESEARCH_MOD_FORM_DETAIL;?> :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'DETAIL',{toolbar: 'Basic'});</script>
<BR>
<center><table><tr><td bgcolor="#F8F8F8" align="center"><h5><font color="#0000CC"><?=_RESEARCH_MOD_FORM_TITLE_ATTRACT;?> : </font></h5></td></tr></table><br>
<table width="600">
<tr>
<td><font face="MS Sans serif" ><b><?=_RESEARCH_MOD_FORM_ABSTRACT;?> : </td><td><input type="file" name="abstractxx" maxlength ="50" size="30" ><font face="MS Sans serif"><?=_RESEARCH_MOD_FORM_ABSTRACT_COM;?></td></tr>
<tr>
<td>
<font face="MS Sans serif" color="#CC0000"><B><?=_RESEARCH_MOD_FORM_FULLTEXT;?>  : </font></td><td><input type="file" name="filesw" maxlength ="50" size="30"><font face="MS Sans serif"><?=_RESEARCH_MOD_FORM_FULLTEXT_COM;?></td></tr>
<tr>
<td>
</table>
<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1"> <?=_RESEARCH_MOD_FORM_ENA_COM;?>
<BR>
<input type="submit" value="<?=_RESEARCH_MOD_FORM_BUTTON_ADD;?>" name="submit"> <input type="reset" value="<?=_RESEARCH_MOD_FORM_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
$fields=$_REQUEST['fields'];
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

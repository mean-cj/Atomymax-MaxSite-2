<?
CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);

$_GET['no'] = intval($_GET['no']);
$_SESSION[no]=$_GET['no'];
//echo $_GET['no'];
?>
<center>
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

	document.form2.message.value += ' ' + theSmilie + ' ';
	document.form2.message.focus();
}
</script>


<?
 if($_GET[op] == "gbook_edit" AND $_GET[action] == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($_SESSION['admin_user'])){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res[news] = $db->select_query("SELECT * FROM ".TB_gbook." WHERE No='".$_GET[no]."' ");
		$arr[news] = $db->fetch($res[news]);
		$db->closedb ();
	if(USE_CAPCHA){
		if($_SESSION['security_code'] != $_POST['security_code'] OR empty($_POST['security_code'])) {
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_CAPTCHA_NOACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.go(-1)</script>";
			exit();
		}
	}

		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_gbook,array(
			"No"=>"$_SESSION[no]",
			"message"=>"".addslashes(htmlspecialchars($_POST[message]))."",
			"Name"=>"".addslashes(htmlspecialchars($_POST[name]))."",
			"Email"=>"$_POST[email]",
			"URL"=>"$_POST[url]"
		)," No=".$_GET[no]."");
		$db->closedb ();


		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GBOOK_MESSAGE_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=gbook\"><B>"._ADMIN_GBOOK_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($_GET[op] == "gbook_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($_SESSION['admin_user'])){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res[news] = $db->select_query("SELECT * FROM ".TB_gbook." WHERE No='".$_GET['no']."' ");
		$arr[news] = $db->fetch($res[news]);
		$db->closedb ();

?>
<FORM name="form2" METHOD=POST ACTION="?name=admin&file=editgbook&op=gbook_edit&action=edit&no=<?=$_GET[no];?>" enctype="multipart/form-data">
              <table width=540  border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" >
			  	<tr>
		<td id="#write">
			<img src="images/com/com_03.gif" width="34" height="16" alt=""></td>
		<td background="images/com/com_04.gif" height="16" width="100%"></td>
				<td background="images/com/com_04.gif" height="16" width="100%"></td>
		<td>
			<img src="images/com/com_06.gif" width="14" height="16" alt=""></td>
	</tr>
                <tr> 
		<td background="images/com/com_12.gif" width="34" height="100%" alt=""></td>
		<td background="images/com/com_13.gif"  width="50" alt=""></td>
                  <td background="images/com/com_13.gif"  width="100%" alt="" align="center">
				  <textarea cols="50" id="editor1" rows="50"  name="HEADLINE" ><?=$_GET['no'];?></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'AdminBasic'});</script>
				
	</TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
</table>
                  </td>
				  		<td background="images/com/com_14.gif" width="14" height="100%" alt=""></td>
                </tr>
                <tr> 
		<td background="images/com/com_12.gif" width="34" height="100%" alt=""></td>
		<td background="images/com/com_13.gif"  width="100%" alt="" valign="top" align="right">*<?=_ADMIN_GBOOK_FORM_MESSAGE;?>:</font></td>
                  <td > 
                    <textarea name="message" cols="80" rows="10" style="width:400" class="textareaform"><?=$arr[news][Message];?></textarea>
                  </td>
				  		<td background="images/com/com_14.gif" width="14" height="100%" alt=""></td>
		            
                </tr>
                <tr> 
		<td background="images/com/com_12.gif" width="34" height="100%" alt=""></td>
		<td background="images/com/com_13.gif"  width="100%" alt="" valign="top" align="right">URL :</font></td>
                  <td bgcolor="#EEF0DE"> 
                    <input type="text" name="url" size="40" maxlength="40" value="<?=$arr[news][URL];?>">
                  </td>
			<td background="images/com/com_14.gif" width="14" height="100%" alt=""></td>
                </tr>
                <tr> 
		<td background="images/com/com_12.gif" width="34" height="100%" alt=""></td>
		<td background="images/com/com_13.gif"  width="100%" alt="" valign="top" align="right">Email :</font></td>
                  <td bgcolor="#EEF0DE"> 
                    <input type="text" name="email" size="40" maxlength="35" value="<?=$arr[news][Email];?>">
                  </td>
				  			<td background="images/com/com_14.gif" width="14" height="100%" alt=""></td>
                </tr>
                <tr> 
		<td background="images/com/com_12.gif" width="34" height="100%" alt=""></td>
		<td background="images/com/com_13.gif"  width="100%" alt="" valign="top" align="right">*<?=_ADMIN_GBOOK_FORM_POSTED;?> :</font></td>
                  <td bgcolor="#EEF0DE">
                    <input type="text" name="name" size="40" maxlength="35" value="<?=$arr[news][Name];?>">
                  </td>
				  <td background="images/com/com_14.gif" width="14" height="100%" alt=""></td>
                </tr>
			  	<tr>
		<td >
			<img src="images/com/com_17.gif" width="34" height="16" alt=""></td>
		<td background="images/com/com_18.gif" height="16" width="100%"></td>
				<td background="images/com/com_18.gif" height="16" width="100%"></td>
		<td>
			<img src="images/com/com_20.gif" width="14" height="16" alt=""></td>
	</tr>
                <tr> 
                  <td colspan="4" align="center"> 
                    <input type="submit" name="Submit" value="<?=_ADMIN_GBOOK_FORM_BUTTON_ADD;?>" class="input_button">
                    <input type="reset" name="reset" value="<?=_ADMIN_GBOOK_FORM_BUTTON_DEL;?>" class="input_button">
                  </td>
                </tr>
              </table>
		  
			  </FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}

?>

				</TD>
				</TR>
			</TABLE>

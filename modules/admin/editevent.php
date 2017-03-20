<?
CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);
include ("editor.php");
if($_GET[op] == "calendar_edit"){
	if(CheckLevel($_SESSION['admin_user'],$_GET[op])){
		if (!$_POST[EventDate] OR !$_POST[subject] OR !$_POST[DETAIL]){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_CALENDAR,array(
			"subject"=>"".$_POST[subject]."",
			"timeout"=>"".$_POST[times]."",
			"detail"=>"".$_POST[DETAIL]."",
			"update_date"=>"".TIMESTAMP.""
		)," id='".$_POST[id]."' ");
		//Edit data
//		$Filename = "".$_POST[EventDate].".txt";
//		$txt_name = "calendardata/".$Filename."";
//		$txt_open = @fopen("$txt_name", "w");
//		@fwrite($txt_open, "".$_POST[DETAIL]."");
//		@fclose($txt_open);
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_CALENDAR_FORM_MESSAGE_EDIT." $_POST[EventDate] "._ADMIN_CALENDAR_FORM_MESSAGE_EDIT1."</B></FONT>";
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<BR><BR><INPUT TYPE=\"submit\" VALUE=\" "._ADMIN_CALENDAR_BUTTON_ADD." \" onclick=\"window.location='?name=admin&file=addevent&dates=".$_POST[EventDate]."'\">";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		$ProcessOutput = $PermissionFalse ;
	}
}else{
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res[event] = $db->select_query("SELECT * FROM ".TB_CALENDAR." WHERE id='".$_GET[id]."' ");
	$arr[event] = $db->fetch($res[event]);
	$db->closedb ();
	if (!$arr[event][id]){
		echo "<script language='javascript'>" ;
		echo "alert('"._ADMIN_CALENDAR_FORM_JAVA_EDIT_NULL."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
	//อ่านค่าจากไฟล์ Text เพื่อแก้ไข
//	$FileEventTopic = "calendardata/".$arr[event][date_event].".txt";
//	$file_open = @fopen($FileEventTopic, "r");
//	$TextContent = @fread ($file_open, @filesize($FileEventTopic));
//	@fclose ($file_open);
	$TextContent = stripslashes($arr[event][detail]);
//$TextContent = $arr[event][detail];
}
?>

	<TABLE cellSpacing=0 cellPadding=0 width=520 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="510" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="500" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B>&nbsp;&nbsp;<IMG SRC="images/icon/calendar.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_CALENDAR_FORM_TITLE_EDIT;?></B>
					<BR><BR>
<?
if(!$ProcessOutput){
?>
<form NAME="myform" METHOD=POST ACTION="?name=admin&file=editevent&op=calendar_edit&id=<?=$_GET[id];?>">
<br>
&nbsp;&nbsp;&nbsp;<b><?=_ADMIN_CALENDAR_FORM_SELECT_DATE;?> :</b><BR>
&nbsp;&nbsp;&nbsp;<input name="EventDate" value="<?=$arr[event][date_event];?>" readonly> 
<BR><BR>
&nbsp;&nbsp;&nbsp;<b><?=_ADMIN_CALENDAR_FORM_TIME;?> :</b><BR>
&nbsp;&nbsp;&nbsp;<INPUT TYPE="text" NAME="times" value="<?=$arr['event']['timeout'];?>" style="width=100"> ( <?=_ADMIN_CALENDAR_FORM_TIME_COM;?> )
<BR><BR>
&nbsp;&nbsp;&nbsp;<b><?=_ADMIN_FORM_TOPIC;?> :</b><BR>
&nbsp;&nbsp;&nbsp;<INPUT TYPE="text" NAME="subject" style="width=400" value="<?=$arr['event']['subject'];?>">
<BR><BR>
&nbsp;&nbsp;&nbsp;<b><?=_ADMIN_FORM_DETAIL;?> :</b><BR>


<textarea cols="50" id="editor1" rows="50"  name="DETAIL" ><?=$arr['event']['detail'];?></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script>
<BR><BR>

<input type="submit" value=" <?=_ADMIN_CALENDAR_FORM_BUTTON_ADD;?> " name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
</form>
<?
}else{
	echo $ProcessOutput ;
}
?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>

<?php 
CheckAdmin($admin_user, $admin_pwd);
include ("editor.php");
?>
<link href="css/template_css.css" rel="stylesheet" type="text/css">
<link href="templates/<?php echo WEB_TEMPLATES;?>/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/datepicker.js"></script>
<script type="text/javascript" src="js/java.js"></script>

<script type="text/javascript" src="datepicker.js"></script>
	<TABLE cellSpacing=0 cellPadding=0 width=620 border=0>
      <TBODY>
        <TR>
          <TD width="610" vAlign=top>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="600" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><BR>
<?php 
if($op == "calendar_add"){
	if(CheckLevel($admin_user,$op)){
		if (!$_POST['EventDate'] OR !$_POST['subject'] OR !$_POST['DETAIL']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
	if(!$_GET['confirm']){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$CKdate = $db->num_rows(TB_CALENDAR,"id"," date_event = '".$_POST['EventDate']."' ");

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->add_db(TB_CALENDAR,array(
					"date_event"=>"".$_POST['EventDate']."",
					"timeout"=>"".$_POST['times']."",
					"subject"=>"".$_POST['subject']."",
					"detail"=>"".$_POST['DETAIL']."",
					"post_date"=>"".TIMESTAMP.""
				));
	
			$nums=$_POST['num'];
			$is=1;
			for($i=1;$i<$nums;$i++){
				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
						$Date=date($_POST['EventDate']); // วันปัจจุบัน สมมุติว่าวันที่ 2006-01-25
						$DateUpdate =date("Y-m-d", strtotime("+$is day",strtotime($Date))); // บวกไปอีก10วัน 
						$sub=$_POST['subject'];
						$id=$i+1;
						$subs="".$_POST['subject']."  ("._ADMIN_CALENDAR_MESSAGE_DATE." $id)";
				$db->add_db(TB_CALENDAR,array(
					"date_event"=>"".$DateUpdate."",
					"timeout"=>"".$_POST['times']."",
					"subject"=>"".$subs."",
					"detail"=>"".$_POST['DETAIL']."",
					"post_date"=>"".TIMESTAMP.""
				));
				$is++;
			} 

				//Add data
		//		$Filename = "".$_POST['EventDate'].".txt";
		//		$txt_name = "calendardata/".$Filename."";
		//		$txt_open = @fopen("$txt_name", "w");
		//		@fwrite($txt_open, "".$_POST['DETAIL']."");
		//		@fclose($txt_open);
				$ProcessOutput .= "<BR><BR>";
				$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
				$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_CALENDAR_MESSAGE_ADD." ".$_POST['EventDate']." "._ADMIN_CALENDAR_MESSAGE_ADD1."</B></FONT>";
				$ProcessOutput .= "<BR><BR>";
				$ProcessOutput .= "<BR><BR><INPUT TYPE=\"submit\" VALUE=\" "._ADMIN_CALENDAR_BUTTON_ADD_TODAY." \" onclick=\"window.location='?name=admin&file=addevent&Date=".$_POST['EventDate']."'\">";
				$ProcessOutput .= "</form></CENTER>";
			$ProcessOutput .= "<br><center><a href=\"javascript:;\" onclick=\"parent.window.location.reload()\">[x] Close and refresh</a></center>";
				$ProcessOutput .= "</CENTER>";
				$ProcessOutput .= "<BR><BR>";

		}else{
				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
				$db->add_db(TB_CALENDAR,array(
					"date_event"=>"".$_POST['EventDate']."",
					"timeout"=>"".$_POST['times']."",
					"subject"=>"".$_POST['subject']."",
					"detail"=>"".$_POST['DETAIL']."",
					"post_date"=>"".TIMESTAMP.""
				));
			$nums=$_POST['num'];
			$is=1;
			for($i=1;$i<$nums;$i++){
				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
						$Date=date($_POST['EventDate']); // วันปัจจุบัน สมมุติว่าวันที่ 2006-01-25
						$DateUpdate =date("Y-m-d", strtotime("+$is day",strtotime($Date))); // บวกไปอีก10วัน 
						$sub=$_POST['subject'];
						$id=$i+1;
						$subs="".$_POST['subject']."  ("._ADMIN_CALENDAR_MESSAGE_DATE." $id)";
				$db->add_db(TB_CALENDAR,array(
					"date_event"=>"".$DateUpdate."",
					"timeout"=>"".$_POST['times']."",
					"subject"=>"".$subs."",
					"detail"=>"".$_POST['DETAIL']."",
					"post_date"=>"".TIMESTAMP.""
				));
			} 


			//Edit data
//			$Filename = "".$_POST['EventDate'].".txt";
//			$txt_name = "calendardata/".$Filename."";
//			$txt_open = @fopen("$txt_name", "w");
//			@fwrite($txt_open, "".$_POST['DETAIL']."");
//			@fclose($txt_open);
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_CALENDAR_MESSAGE_EDIT."</B></FONT>";
			$ProcessOutput .= "<br><center><a href=\"javascript:;\" onclick=\"parent.window.location.reload()\">[x] Close and refresh</a></center>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}
	}else{
		$ProcessOutput = $PermissionFalse ;
	}
		echo $ProcessOutput ;
}

if(!$ProcessOutput){
?>

<form NAME="myform" METHOD=POST ACTION="?name=admin&file=addevent&op=calendar_add">
<br>
&nbsp;&nbsp;&nbsp;<b><?php echo _ADMIN_CALENDAR_FORM_SELECT_DATE;?> :</b><BR>
<?php if(empty($_GET['Date'])){?>
&nbsp;&nbsp;&nbsp;<input name="EventDate" readonly value="<?php echo $_GET['dates'];?>"> <IMG SRC="images/admin/dateselect.gif" BORDER="0" ALT="<?php echo _ADMIN_CALENDAR_FORM_SELECT_DATE;?>" onclick="displayDatePicker('EventDate', false, 'ymd', '-');" align="absmiddle">
<?php } else { ?>
&nbsp;&nbsp;&nbsp;<input name="EventDate" readonly value="<?php echo $_GET['Date'];?>">
<?php }?>
<BR><BR>
&nbsp;&nbsp;&nbsp;<b><?php echo _ADMIN_CALENDAR_FORM_TIME;?> :</b><BR>
&nbsp;&nbsp;&nbsp;<INPUT TYPE="text" NAME="times"  style="width=100"> ( <?php echo _ADMIN_CALENDAR_FORM_TIME_COM;?> )
<BR><BR>
&nbsp;&nbsp;&nbsp;<b><?php echo _ADMIN_CALENDAR_FORM_COUNT_DAY;?> :</b><BR>
&nbsp;&nbsp;&nbsp;<INPUT TYPE="text" NAME="num" style="width=40" > *( <?php echo _ADMIN_CALENDAR_FORM_COUNT_DAY_COM;?> )
<BR><BR>
&nbsp;&nbsp;&nbsp;<b><?php echo _ADMIN_FORM_TOPIC;?> :</b><BR>
&nbsp;&nbsp;&nbsp;<INPUT TYPE="text" NAME="subject" style="width=400">
<BR><BR>
&nbsp;&nbsp;&nbsp;<b><?php echo _ADMIN_FORM_DETAIL;?> :</b><BR>


<textarea cols="50" id="editor1" rows="50"  name="DETAIL" ></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script>
<BR><BR>

<input type="submit" value=" <?php echo _ADMIN_CALENDAR_FORM_BUTTON_ADD;?> " name="submit"> <input type="reset" value="<?php echo _ADMIN_BUTTON_CLEAR;?>" name="reset">
</form>
<?php 
	}
?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
			<BR><BR>

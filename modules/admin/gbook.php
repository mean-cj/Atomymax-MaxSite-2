<?
CheckAdmin($admin_user, $admin_pwd);
include ("editor.php");
?>

	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=5 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;
<BR><BR>
<!-- แสดงผลรายการสมาชิกในคณะ -->
<table width="800" border="0" cellspacing="0" align="center" >
  <tr> 
    <td> 


            <? 
	if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_gbook,"No","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=gbook&op=gbook_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="44"><CENTER><B>Option</B></CENTER></td>
   <td><CENTER><B><?=_ADMIN_GBOOK_TABLE_HEADER_DETAIL;?></B></CENTER></td>
   <td width="50"><CENTER><B><?=_ADMIN_GBOOK_TABLE_HEADER_POSTED;?></B></CENTER></td>
   <td width="80"><CENTER><B>IP</B></CENTER></td>
   <td width="100"><CENTER><B>mail</B></CENTER></td>
    <td width="100"><CENTER><B>website</B></CENTER></td>
   <td width="10"><CENTER><B>Check</B></CENTER></td>
  </tr>  
<?
$res['gbook'] = $db->select_query("SELECT * FROM ".TB_gbook." ORDER BY No DESC LIMIT $goto, $limit ");
$count=0;
while($arr['gbook'] = $db->fetch($res['gbook'])){
		$No = $arr['gbook']['No'];
		$Message= stripslashes(FixQuotes($arr['gbook']['Message']));
		$Email    = wordwrap($arr['gbook']['Email'],30,"<br>\n",1);
		$Name = $arr['gbook']['Name'];
		$is_member=$arr['gbook']['is_member'];
		$Url = $arr['gbook']['URL'];
		$Date = $arr['gbook']['Date'];
		$IP=$arr['gbook']['IP'];
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=gbook&op=gbook_edit&id=<? echo $No ;?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=gbook&op=gbook_del&id=<? echo $No ;?>','<?=_ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><?echo $Message;?> ( <?echo "$Date";?> )</td>
     <td ><CENTER><?echo $Name;?></CENTER></td>
     <td align="center"><?=$IP;?></td>
     <td align="center"><?=$Email;?></td>
     <td align="center"><?=$Url;?></td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<? echo $No;?>"></td>
    </tr>

<?
	$count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="gbook_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=admin&file=gbook");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
 if($op == "gbook_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['news'] = $db->select_query("SELECT * FROM ".TB_gbook." WHERE No='".$_GET['no']."' ");
		$arr['news'] = $db->fetch($res['news']);
		$db->closedb ();
		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_gbook,array(
			"message"=>"".$_POST['Messages']."",
			"Name"=>"".$_POST['Name']."",
			"Email"=>"".$_POST['Email']."",
			"Date"=>"".$_POST['Date']."",
			"IP"=>"".$_POST['IP']."",
			"URL"=>"".$_POST['Url'].""
		)," No=".$_GET['no']."");
		$db->closedb ();


		$ProcessOutput = "<BR><BR>";
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
else if($op == "gbook_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['news'] = $db->select_query("SELECT * FROM ".TB_gbook." WHERE No='".$_GET['id']."' ");
		$arr['news'] = $db->fetch($res['news']);
		$db->closedb ();

?>
<FORM name="form2" METHOD=POST ACTION="?name=admin&file=gbook&op=gbook_edit&action=edit&no=<?=$_GET['id'];?>" enctype="multipart/form-data">
                    <script language="JavaScript">
            <!--
            function  checkfrm(){
if (document.frm_gbook.Message.value.length < 1){
			alert("<? echo _ADMIN_GBOOK_JAVA_CHECK_DETAIL;?>");
			return false;
}
else if (document.frm_gbook.Name.value.length < 1 ){
			alert("<? echo _ADMIN_GBOOK_JAVA_CHECK_USER;?>");
			return false;
}
	}
  //-->
 </script>
				<table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr id="#write">
				<td width="10" height="10"><img src="images/pic/news-tl.gif"></td>
				<td height="10" width="100" background="images/pic/news-tbg.png"></td>
				<td height="10" width="600" background="images/pic/news-tbg.png"></td>
				<td width="10" height="10"><img src="images/pic/news-tr.gif"></td></tr>
                <tr> 
                    <td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="150" valign="top"  align="right" bgcolor="#FFFFFF">*<?=_ADMIN_GBOOK_FORM_MESSAGE;?> :</font></td>
                  <td width="350" align="left"> 
				  <TEXTAREA NAME="Messages" ROWS="10" COLS="150" style="width:500" id="editor1"><?echo $arr['news']['Message'];?></TEXTAREA>
					<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script>
</td>
                    <td width="10" align="center"  height="100%"  background="images/pic/news-right.png"></td>
                </tr>
                <tr> 
                    <td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="120" valign="top"  align="right" bgcolor="#FFFFFF">URL :</font></td>
                  <td width="400" align="left"> 
                    <input type="text" name="Url" size="40" maxlength="40" value="<?echo $arr['news']['URL'];?>">
                  </td>
                    <td width="10" align="center"  height="100%"  background="images/pic/news-right.png"></td>
                </tr>
                <tr> 
                    <td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="120" valign="top"  align="right" bgcolor="#FFFFFF">Email :</font></td>
                  <td width="400" align="left">
                    <input type="text" name="Email" size="40" maxlength="35" value="<?echo $arr['news']['Email'];?>">
                  </td>
                    <td width="10" align="center"  height="100%"  background="images/pic/news-right.png"></td>
                </tr>
                <tr> 
                    <td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="120" valign="top"  align="right" bgcolor="#FFFFFF"><?=_ADMIN_GBOOK_FORM_DATE;?> :</font></td>
                  <td width="400" align="left"> 
                    <input type="text" name="Date" size="40" maxlength="35" value="<?echo $arr['news']['Date'];?>">
                 </td>
                    <td width="10" align="center"  height="100%"  background="images/pic/news-right.png"></td>
						</TR>
				<tr>
                    <td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="120" valign="top"  align="right" bgcolor="#FFFFFF">IP :</font></td>
                  <td width="400" align="left"> 
                    <input type="text" name="IP" size="40" maxlength="35" value="<?echo $arr['news']['IP'];?>">
                  </td>
                    <td width="10" align="center"  height="100%"  background="images/pic/news-right.png"></td>
						</TR>
                <tr> 
                    <td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="120" valign="top"  align="right" bgcolor="#FFFFFF">*<?=_ADMIN_GBOOK_FORM_POSTED;?> :</font></td>
                  <td width="400" align="left"> 
                    <input type="text" name="Name" size="40" maxlength="35" value="<?echo $arr['news']['Name'];?>">
                  </td>
                    <td width="10" align="center"  height="100%"  background="images/pic/news-right.png"></td>
						</TR>
				<tr>
				<td width="10" height="10"><img src="images/pic/news-bl.gif"></td>
				<td height="10" width="120" background="images/pic/news-bbg.png"></td>
				<td height="10" width="400" background="images/pic/news-bbg.png"></td>
				<td width="10" height="10"><img src="images/pic/news-br.gif"></td>
				</tr>
                <tr> 
                  <td colspan="4" align="center"> 
                    <input type="submit" name="Submit" value="<?=_ADMIN_GBOOK_FORM_BUTTON_ADD;?>" class="input_button">
                    <input type="reset" name="reset" value="<?=_ADMIN_GBOOK_FORM_BUTTON_DEL;?>" class="input_button">
                  </td>
                </tr>
              </table>
       
            </form>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
}
else if($op == "gbook_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['gbook'] = $db->select_query("SELECT * FROM ".TB_gbook." WHERE No='".$value."' ");
			$arr['gbook'] = $db->fetch($res['gbook']);
			$db->del(TB_gbook," No='".$value."' "); 
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GBOOK_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=gbook\"><B>"._ADMIN_GBOOK_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "gbook_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_gbook," No='".$_GET['id']."' "); 
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GBOOK_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=gbook\"><B>"._ADMIN_GBOOK_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>


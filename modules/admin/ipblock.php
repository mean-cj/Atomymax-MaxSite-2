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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_IPBLOCK_MENU_TITLE;?> </B>
					<BR><BR>
					<A HREF="?name=admin&file=ipblock"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"><?=_ADMIN_IPBLOCK_MENU_LIST;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=ipblock&op=ipblock_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_IPBLOCK_MENU_ADD_NEW;?></A> &nbsp;&nbsp;&nbsp;
<?
//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE= $db->num_rows(TB_IPBLOCK,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=ipblock&op=ipblock_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr  class="odd">
   <td width="44"><CENTER><B>Option</B></CENTER></td>
      <td ><CENTER><B>ip</B></CENTER></td>
   <td width="250"><CENTER><B><?=_ADMIN_IPBLOCK_TABLE_HEADER_DATE;?></B></td>
   <td width="40"><CENTER><B>Check</B></CENTER></td>
  </tr>  
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$res['ipblock'] = $db->select_query("SELECT * FROM ".TB_IPBLOCK." ORDER BY id  LIMIT $goto, $limit ");
$rows['ipblock'] = $db->rows($res['ipblock']);

$count=0;
while ($arr['ipblock'] = mysql_fetch_array($res['ipblock'])){
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=ipblock&op=ipblock_edit&id=<? echo $arr['ipblock']['id'];?>&page=<? echo $page;?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=ipblock&op=ipblock_del&page=<? echo $page;?>&id=<? echo $arr['ipblock']['id'];?>&prefix=<? echo $arr['ipblock']['post_date'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td align="center" width="50"><? echo $arr['ipblock']['ip'];?></td>
	<td align="center"  ><? echo ThaiTimeConvert($arr['ipblock']['post_date'],"","1");?></td>

     <td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<? echo $arr['ipblock']['id'];?>"></td>
    </tr>

<?
		 $count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="ipblock_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
		SplitPage($page,$totalpage,"?name=admin&file=ipblock");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "ipblock_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
	//	require("includes/class.resizepic.php");
		if (!$_POST['IP'] ){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
		//ทำการเพิ่มข้อมูลลงดาต้าเบส
$REF = TIMESTAMP ; 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); 

$db->add_db(TB_IPBLOCK,array(
"ip"=> $_POST['IP'],
"post_date"=>$REF
));

$db->closedb ();


		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_IPBLOCK_MESSAGE_ADD."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=ipblock\"><B>"._ADMIN_IPBLOCK_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "ipblock_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=ipblock&op=ipblock_add&action=add" enctype="multipart/form-data">
<BR><BR><B>IP :</B><INPUT TYPE="text" NAME="IP" size="20"> * <?=_ADMIN_IPBLOCK_MESSAGE_COM_IP;?>
<BR><BR><BR>
<input type="submit" value=" <?=_ADMIN_IPBLOCK_BUTTON_ADD;?> " name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "ipblock_edit" AND $action == "edit" ){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_IPBLOCK,array(
"ip"=> $_POST['IP']
)," id=".$_GET['id']." ");
$db->closedb ();


		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_IPBLOCK_MESSAGE_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=ipblock\"><B>"._ADMIN_IPBLOCK_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=ipblock&page=".$_GET['page']."'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}

else if($op == "ipblock_edit" ){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['ipblock'] = $db->select_query("SELECT * FROM ".TB_IPBLOCK." WHERE id='".$_GET['id']."' ");
		$arr['ipblock'] = $db->fetch($res['ipblock']);
		$db->closedb ();
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=ipblock&op=ipblock_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
<B>IP :</B><INPUT TYPE="text" NAME="IP" size="50" value="<?=$arr['ipblock']['ip'];?>"> * <?=_ADMIN_IPBLOCK_MESSAGE_COM_IP;?>
<BR><BR>
<br><input type="submit" value="<?=_ADMIN_IPBLOCK_BUTTON_EDIT;?>" name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}

}
else if($op == "ipblock_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){

		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['ipblock'] = $db->select_query("SELECT * FROM ".TB_IPBLOCK." WHERE id='".$value."' ");
			$arr['ipblock'] = $db->fetch($res['ipblock']);
			$db->del(TB_IPBLOCK," id='".$value."' "); 
			$db->closedb ();

		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_IPBLOCK_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=ipblock\"><B>"._ADMIN_IPBLOCK_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=ipblock&page=".$_GET['page']."'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "ipblock_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['ipblock'] = $db->select_query("SELECT * FROM ".TB_IPBLOCK." WHERE id='".$_GET['id']."' ");
			$arr['ipblock'] = $db->fetch($res['ipblock']);

		$db->del(TB_IPBLOCK," id='".$_GET['id']."' "); 
		$db->closedb ();

//	@unlink("ipblockicon/".$_GET['prefix'].".jpg");
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_IPBLOCK_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=ipblock\"><B>"._ADMIN_IPBLOCK_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=ipblock&page=".$_GET['page']."'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "ipblock_update" AND $action == "update"){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_IPBLOCK,array(
			"status"=>"".$_GET['status'].""
		)," id=".$_GET['id']."");
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_IPBLOCK_MESSAGE_UPDATE."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=ipblock\"><B>"._ADMIN_IPBLOCK_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=ipblock&page=".$_GET['page']."'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

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

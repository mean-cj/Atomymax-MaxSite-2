<?
CheckAdmin($admin_user, $admin_pwd);
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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp;  blog  </B>
					<BR><BR>
					<A HREF="?name=admin&file=blog"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_BLOG_MENU_ALL_BLOG;?> </A>  &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=blog_editlevel"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_BLOG_MENU_EDIT_LEVEL;?></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=blog_category"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_MENU_DTAIL_CAT;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=blog_category&op=articlecat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_MENU_ADD_CAT;?></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=blog&op=edit_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_BLOG_MENU_ADD_MEM;?></A><BR><BR>
<?
//////////////////////////////////////////// แสดงรายการ blog  
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_BLOG_LEVEL,"level_id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=blog_editlevel&op=level_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="44"><CENTER><B>Option</B></font></CENTER></td>
   <td><B><?=_ADMIN_BLOG_TABLE_LEVEL_TOPIC;?></B></font></td>
   <td width="100"><CENTER><B><?=_ADMIN_BLOG_TABLE_LEVEL_COUNT;?></B></font></CENTER></td>
   <td width="40"><CENTER><B>Check</B></font></CENTER></td>
  </tr>  
<?
$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG_LEVEL." ORDER BY level_id  LIMIT $goto, $limit ");
$count=0;
while($arr['blog'] = $db->fetch($res['blog'])){

if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=blog_editlevel&op=level_edit&id=<? echo $arr['blog']['level_id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=blog_editlevel&op=level_del&id=<? echo $arr['blog']['level_id'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE_CAT;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><?BlogLevel($arr['blog']['level_count']);?></td>
     <td ><CENTER><?echo $arr['blog']['level_count'];?></CENTER></td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[']" value="<? echo $arr['blog']['level_id'];?>"></td>
    </tr>

<?
$count++;
} 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="level_del" >
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=admin&file=blog_editlevel");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}

else if($op == "level_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit

		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_BLOG_LEVEL,array(
			"level_name"=>"".addslashes(htmlspecialchars($_POST['NAME']))."",
			"level_count"=>"".$_POST['COUNTS'].""
		)," level_id='".$_GET['id']."' ");
		$db->closedb ();


		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOG_MESSAGE_EDIT_LEVEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=blog_editlevel\"><B>"._ADMIN_BLOG_MESSAGE_GOBACK_LEVEL."  </B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}
else if($op == "level_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form

		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG_LEVEL." WHERE level_id='".$_GET['id']."' ");
		$arr['blog'] = $db->fetch($res['blog']);
		$db->closedb ();


		$TextContent = $arr['blog']['level_name'];
		$TextContent = stripslashes($TextContent);

?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=blog_editlevel&op=level_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
<B><?=_ADMIN_BLOG_TABLE_LEVEL_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="80" value="<?=$arr['blog']['level_name'];?>">
<BR><BR>
<B><?=_ADMIN_BLOG_TABLE_LEVEL_COUNT;?> :</B><BR>
<INPUT TYPE="text" NAME="COUNTS" size="20" value="<?=$arr['blog']['level_count'];?>">
<BR><BR>

<input type="submit" value=" <?=_ADMIN_BLOG_BUTTON_LEVEL_EDIT;?> " name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?

}
else if($op == "level_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi

		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG_LEVEL." WHERE level_id='".$value."' ");
			$arr['blog'] = $db->fetch($res['blog']);
			$db->del(TB_BLOG_LEVEL," level_id='".$value."' "); 
			$db->closedb ();

		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOG_MESSAGE_DEL_LEVEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=blog\"><B>"._ADMIN_BLOG_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}
else if($op == "level_del"){
	//////////////////////////////////////////// กรณีลบ Form

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG_LEVEL." WHERE level_id='".$_GET['id']."' ");
		$arr['blog'] = $db->fetch($res['blog']);
		$db->del(TB_BLOG_LEVEL," level_id='".$_GET['id']."' "); 
		$db->closedb ();

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOG_MESSAGE_DEL_LEVEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=blog_editlevel\"><B>"._ADMIN_BLOG_MESSAGE_GOBACK_LEVEL."</B></A>";
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

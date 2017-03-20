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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_RESEARCH_MENU_TITLE;?> </B>
					<BR><BR>
					<A HREF="?name=admin&file=research"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_RESEARCH_MENU_LIST;?> </A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=research&op=research_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_RESEARCH_MENU_ADD_NEW;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=research_category"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle"><?=_ADMIN_MENU_DTAIL_CAT;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=research_category&op=researchcat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"><?=_ADMIN_MENU_ADD_CAT;?></A><BR><BR>
<?
//////////////////////////////////////////// แสดงรายการ
if($op == ""){
?>
<form action="?name=admin&file=research_category&op=researchcat_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td><B><CENTER>Option</CENTER></B></td>
   <td><CENTER><B><?=_ADMIN_RESEARCH_TABLE_CAT_GR;?></B></CENTER></td>
   <td align="center" width="50"><B><?=_ADMIN_FORM_CAT_COUNT;?></B></td>
   <td align="center" width="50"><B><?=_ADMIN_FORM_CAT_ORDER;?></B></td>
   <td><B><CENTER>Check</CENTER></B></td>
  </tr>  
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['researchcat'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." ORDER BY sort ");
$rows['researchcat'] = $db->rows($res['researchcat']);
$CATCOUNT = 0 ;
$count=0;
while ($arr['researchcat'] = mysql_fetch_array($res['researchcat'])){
	$row['sumresearch'] = $db->num_rows(TB_RESEARCH,"id"," category=".$arr['researchcat']['id']." ");
	$rowx['sumresearch'] = $db->num_rows(TB_RESEARCH_CAT,"id","");
    $CATCOUNT ++ ;
   //กำหนดการเปลี่ยนลำดับขึ้น
   $SETSORT_UP = $arr['researchcat']['sort']-1;
   if($CATCOUNT == "1"){
	   $SETSORT_UP = "1" ;
   }
	//กำหนดการเปลี่ยนลำดับลง
   $SETSORT_DOWN = $arr['researchcat']['sort']+1;
   if($CATCOUNT == $rows['researchcat']){
	   $SETSORT_DOWN = $arr['researchcat']['sort'] ;
   }

if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=research_category&op=researchcat_edit&id=<? echo $arr['researchcat']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=research_category&op=researchcat_del&id=<? echo $arr['researchcat']['id'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE_CAT;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><?echo $arr['researchcat']['category_name'];?></td>
	 <td align="center" width="50" ><?echo $row['sumresearch'] ;?></td>
     <td align="center" width="50"><A HREF="?name=admin&file=research_category&op=researchcat_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['researchcat']['id'];?>"><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=research_category&op=researchcat_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['researchcat']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_DOWN;?>"></A></td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[']" value="<? echo $arr['researchcat']['id'];?>"></td>
    </tr>

<?
		 $count++;
 }
$db->closedb ();
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="research_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form>
<?
}
else if($op == "researchcat_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
		//เช็คว่า id ตอนนี้เป็นอะไร
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['researchcat'] = $db->select_query("SELECT sort FROM ".TB_RESEARCH_CAT." ORDER BY sort DESC ");
		$arr['researchcat'] = mysql_fetch_array($res['researchcat']);
		$SORTID = $arr['researchcat']['sort']+1 ;
		//เพิ่มข้อมูลลงดาต้าเบส
		$db->add_db(TB_RESEARCH_CAT,array(
			"category_name"=>"".addslashes(htmlspecialchars($_POST['CATEGORY']))."",
			"sort"=>"$SORTID"
		));
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RESEARCH_MESSAGE_CAT_ADD."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=research_category\"><B>"._ADMIN_RESEARCH_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "researchcat_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM METHOD=POST ACTION="?name=admin&file=research_category&op=researchcat_add&action=add">
<B><?=_ADMIN_FORM_CAT_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="CATEGORY" size="40">
<BR><BR>
<INPUT TYPE="submit" value="<?=_ADMIN_RESEARCH_BUTTON_CAT_ADD;?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "researchcat_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database
	if(CheckLevel($admin_user,$op)){
		//แก้ไขข้อมูลลงดาต้าเบส
		$db->update_db(TB_RESEARCH_CAT,array(
			"category_name"=>"".addslashes(htmlspecialchars($_POST['CATEGORY'])).""
		)," id=".$_GET['id']." ");
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RESEARCH_MESSAGE_CAT_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=research_category\"><B>"._ADMIN_RESEARCH_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "researchcat_edit" AND $action == "sort"){
	//////////////////////////////////////////// Set Sort
	if(CheckLevel($admin_user,$op)){
		//กรณีเลื่อนขึ้น
		if($_GET['move'] == "up"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_RESEARCH_CAT." SET sort = sort+1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_RESEARCH_CAT." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		if($_GET['move'] == "down"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_RESEARCH_CAT." SET sort = sort-1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_RESEARCH_CAT." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RESEARCH_MESSAGE_CAT_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=research_category\"><B>"._ADMIN_RESEARCH_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "researchcat_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['researchcat'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." WHERE id='".$_GET['id']."' ");
		$arr['researchcat'] = $db->fetch($res['researchcat']);
		$db->closedb ();
?>
<FORM METHOD=POST ACTION="?name=admin&file=research_category&op=researchcat_edit&action=edit&id=<?=$_GET['id'];?>">
<B><?=_ADMIN_FORM_CAT_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="CATEGORY" size="40" value="<?=$arr['researchcat']['category_name'];?>">
<BR><BR>
<INPUT TYPE="submit" value="<?=_ADMIN_RESEARCH_BUTTON_CAT_EDIT;?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}

}
else if($op == "researchcat_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->del(TB_RESEARCH_CAT," id='".$value."' "); 
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RESEARCH_MESSAGE_CAT_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=research_category\"><B>"._ADMIN_RESEARCH_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "researchcat_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_RESEARCH_CAT," id='".$_GET['id']."' "); 
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RESEARCH_MESSAGE_CAT_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=research_category\"><B>"._ADMIN_RESEARCH_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
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

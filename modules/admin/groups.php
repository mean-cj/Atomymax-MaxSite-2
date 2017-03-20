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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_GROUP_MENU_INDEX;?></B>
					<BR><BR>
<A HREF="?name=admin&file=user"><IMG SRC="images/admin/admins.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_GROUP_MENU_INDEX;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=user&op=admin_add"><IMG SRC="images/admin/user.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_GROUP_MENU_ADD_ADMIN;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=groups"><IMG SRC="images/admin/keys.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_GROUP_MENU_ADMIN_LEVEL;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=groups&op=group_add"><IMG SRC="images/admin/share.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_GROUP_MENU_ADMIN_ADD_LEVEL;?></A>
<BR><BR>
<!-- แสดงผลรายการกลุ่มผู้ดูแลระบบ -->
<?
//////////////////////////////////////////// แสดงรายชื่อกลุ่มผู้ดูแลระบบ
if($op == ""){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_ADMIN_GROUP,"id","");
if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=groups&op=group_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr  class="odd">
   <td scope="col"><B><CENTER>Option</CENTER></B></td>
   <td scope="col"><B><CENTER>Level</CENTER></B></td>
   <td scope="col"><CENTER><B><?=_ADMIN_FORM_CAT_COUNT;?></B></CENTER></td>
   <td scope="col"><B><CENTER>Check</CENTER></B></td>
  </tr>  
<?
$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ORDER BY id LIMIT $goto, $limit ");
$count=0;
while($arr['groups'] = $db->fetch($res['groups'])){
	$row['user'] = $db->num_rows(TB_ADMIN,"id"," level=".$arr['groups']['id']." ");
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="10%" align="center" scope="col">
      <a href="?name=admin&file=groups&op=group_edit&id=<? echo $arr['groups']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=groups&op=group_del&id=<? echo $arr['groups']['id'];?>&level=<?echo $arr['groups']['name'];?>','<?=_ADMIN_GROUP_BUTTON_DEL_ADMIN;?> : <?echo $arr['groups']['name'];?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td scope="col" align="left"><? echo $arr['groups']['name'];?></td>
     <td scope="col" width="20%"><CENTER><? echo $row['user'];?></CENTER></td>
     <td align="center" width="40" scope="col"><input type="checkbox" name="list[]" value="<? echo $arr['groups']['id'];?>"></td>
    </tr>

<?
	$count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="submit" value="Delete" >
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=admin&file=groups");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
	echo "<BR><BR>";
	
$res['groupstext'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ORDER BY id ");
while ($arr['groupstext'] = $db->fetch($res['groupstext']))
   {
		echo "<LI><B>".$arr['groupstext']['name']." : </B>".$arr['groupstext']['description']."</LI>";
   }
$db->closedb ();

}
else if($op == "group_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Group Admin Database
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$sql['GROUP'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." WHERE name='".$_POST['GROUP_NAME']."'");
		
		$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ");
	/*******/
		$q['GROUPS'] = "INSERT INTO ".TB_ADMIN_GROUP." VALUES(0,'".addslashes(htmlspecialchars($_POST['GROUP_NAME']))."','".addslashes(htmlspecialchars($_POST['GROUP_DESC']))."',";

		for($x=3;$x<mysql_num_fields($res['groups']);$x++)
		{
		$fname =  mysql_field_name($res['groups'], $x);
		$q['GROUPS'] .= "'".$_POST[$fname]."'";
		if($x < mysql_num_fields($res['groups'])-1) $q['GROUPS'] .= ", ";
		}
		$q['GROUPS'] .= ");";
	/*******/
		if( $db->num_rows($sql['GROUP'])<1) {
		mysql_query($q['GROUPS']);
		}
		$db->closedb ();

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GROUP_MESSAGE_ADD_ADMIN."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=user\"><B>"._ADMIN_GROUP_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "group_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Group Admin Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM name="groups" METHOD=POST ACTION="?name=admin&file=groups&op=group_add&action=add">
     <B><?=_ADMIN_GROUP_FORM_GR_NAME;?> :</B><br>
        <input type="text"  name="GROUP_NAME" size="40"><br>
        <B><?=_ADMIN_GROUP_FORM_GR_DETAIL;?> :</B><br>
        <input type="text" name="GROUP_DESC"  size="40"><br>
        <br>
        <B><?=_ADMIN_GROUP_FORM_GR_SELECT;?> :</B><br>
<?
	 $m = 0;
	 $fnum = 3;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ");

	 echo '<table cellspacing="1" cellpadding="4"  bgcolor="#F7F7F7">';
	 for($x=3;$x<mysql_num_fields($res['groups']);$x++)
	 {
	  $fname['GROUPS'] =  mysql_field_name($res['groups'], $x);
	  list($name,$task) = explode("_",$fname['GROUPS']);
	  if(empty($last) || $last <> $name)
	  {
	   if($m<$fnum) 
	   {
	    $l = $fnum - $m;
	    echo '<td colspan="'.$l.'"></td>';
	   }
	   $ime = "echo _".strtoupper($name).";";
	   echo '</tr><tr bgcolor="#ffffff"><td>';
	   eval($ime);
	   echo '</td>';
	   $m=0;
	  }
	  echo '<td><input type="checkbox" name="'.$fname['GROUPS'].'"  value="1"> '.$task.'</td>';
	  $m++;
	  $last = $name;
	 }
	 if($m<$fnum) 
	 {
	  $l = $fnum - $m;
	  echo '<td colspan="'.$l.'"></td>';
	 }
	 echo '</tr></table>';
$db->closedb ();
?>
          <br>
        <input type="button" name="CheckAll" value="<?=_ADMIN_GROUP_BUTTON_SELECT_ALL;?>" onclick="checkAll(document.groups)" >
        <input type="button" name="UnCheckAll" value="<?=_ADMIN_GROUP_BUTTON_UNSELECT_ALL;?>" onclick="uncheckAll(document.groups)" >

        <br>
        <br><br>
        <input type="submit" value="<?=_ADMIN_GROUP_BUTTON_ADD_LEVEL;?>" >
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "group_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข User Admin Database Edit
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ");

		$q['GROUPS'] = "UPDATE ".TB_ADMIN_GROUP." SET name='".addslashes(htmlspecialchars($_POST['GROUP_NAME']))."', description='".addslashes(htmlspecialchars($_POST['GROUP_DESC']))."', ";
		for($x=3;$x<mysql_num_fields($res['groups']);$x++)
		{
		$fname =  mysql_field_name($res['groups'], $x);
		$q['GROUPS'] .= $fname."='".$_POST[$fname]."'";
		if($x < mysql_num_fields($res['groups'])-1) $q['GROUPS'] .= ", ";
		}
		$q['GROUPS'] .= " WHERE id='".$_GET['id']."';";
	  /******/
		$res['groups'] = mysql_query($q['GROUPS']) or die (mysql_error());
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GROUP_MESSAGE_EDIT_ADMIN."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=user\"><B>"._ADMIN_GROUP_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "group_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Group Admin Edit Form
	if(CheckLevel($admin_user,$op)){
		//ดึงกลุ่มผู้ดูแลระบบออกมา
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['group'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." WHERE id='".$_GET['id']."' ");
		$arr['group'] = $db->fetch($res['group']);
		$db->closedb ();
?>
<form action="?name=admin&file=groups&op=group_edit&action=edit&id=<?=$_GET['id'];?>" name="groups" method="post">
     <B><?=_ADMIN_GROUP_FORM_GR_NAME;?> :</B><br>
        <input type="text"  name="GROUP_NAME" size="40" value="<?echo $arr['group']['name'];?>"><br>
        <B><?=_ADMIN_GROUP_FORM_GR_DETAIL;?> :</B><br>
        <input type="text" name="GROUP_DESC"  size="40" value="<?echo $arr['group']['description'];?>"><br>
        <br>
        <B><?=_ADMIN_GROUP_FORM_GR_SELECT;?> :</B><br>
<?
	 $m = 0;
	 $fnum = 3;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ");

	 echo '<table cellspacing="1" cellpadding="4"  bgcolor="#F7F7F7">';
	 for($x=3;$x<mysql_num_fields($res['groups']);$x++)
	 {
	  $fname['GROUPS'] =  mysql_field_name($res['groups'], $x);
	  $fn=$fname['GROUPS'] ;
	  list($name,$task) = explode("_",$fname['GROUPS']);
	  if(empty($last) || $last <> $name)
	  {
	   if($m<$fnum) 
	   {
	    $l = $fnum - $m;
	    echo '<td colspan="'.$l.'"></td>';
	   }
	   $ime = "echo _".strtoupper($name).";";
	   echo '</tr><tr bgcolor="#ffffff"><td>';
	   eval($ime);
	   echo '</td>';
	   $m=0;
	  }
	  echo '<td><input type="checkbox" name="'.$fname['GROUPS'].'" ';
	  if($arr['group'][$fn] == 1)
	  echo 'checked="checked"';
	  echo ' value="1"> '.$task.'</td>';
	  $m++;
	  $last = $name;
	 }
	 if($m<$fnum) 
	 {
	  $l = $fnum - $m;
	  echo '<td colspan="'.$l.'"></td>';
	 }
	 echo '</tr></table>';
$db->closedb ();
?>
          <br>
        <input type="button" name="CheckAll" value="<?=_ADMIN_GROUP_BUTTON_SELECT_ALL;?>" onclick="checkAll(document.groups)" >
        <input type="button" name="UnCheckAll" value="<?=_ADMIN_GROUP_BUTTON_UNSELECT_ALL;?>" onclick="uncheckAll(document.groups)" >

        <br>
        <br><br>
        <input type="submit" value="<?=_ADMIN_GROUP_BUTTON_EDIT_LEVEL;?>" >
        </form>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
}
else if($op == "group_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ User Admin Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->del(TB_ADMIN_GROUP," id='".$value."' "); 
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GROUP_MESSAGE_DEL_ADMIN."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=user\"><B>"._ADMIN_GROUP_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "group_del"){
	//////////////////////////////////////////// กรณีลบ Group Admin Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_ADMIN_GROUP," id='".$_GET['id']."' "); 
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GROUP_MESSAGE_DEL_ADMIN."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=user\"><B>"._ADMIN_GROUP_MESSAGE_GOBACK."</B></A>";
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

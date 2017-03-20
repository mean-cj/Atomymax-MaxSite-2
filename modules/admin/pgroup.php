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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_PERSONNEL_MENU_TITLE;?></B>
					<BR><BR>
<A HREF="?name=admin&file=personnel"><IMG SRC="images/admin/admins.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_PERSONNEL_MENU_LIST;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=personnel&op=admin_add"><IMG SRC="images/admin/user.gif"  BORDER="0" align="absmiddle"><?=_ADMIN_PERSONNEL_MENU_ADD_NEW;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=pgroup"><IMG SRC="images/admin/keys.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_PERSONNEL_MENU_LIST_GROUP;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=pgroup&op=group_add"><IMG SRC="images/admin/share.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_PERSONNEL_MENU_NEW_GROUP;?></A>
<BR><BR>
<!-- แสดงผลรายการกลุ่มบุคลากร -->
<?
//////////////////////////////////////////// แสดงรายชื่อกลุ่มบุคลากร
if($op == ""){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_personnel_group,"gp_id","");
	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=pgroup&op=group_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="60"><B><CENTER>Option</CENTER></B></td>
   <td align=center width="200"><B><?=_ADMIN_PERSONNEL_TABLE_CAT_NAME;?></B></td>
   <td align=center><B><?=_ADMIN_FORM_DETAIL;?></B></td>
   <td width=80><CENTER><B><?=_ADMIN_PERSONNEL_TABLE_CAT_DETAIL;?></B></CENTER></td>
    <td width=20><CENTER><B><?=_ADMIN_FORM_CAT_ORDER;?></B></CENTER></td>
   <td width=20><B><CENTER>Check</CENTER></B></td>
  </tr>  
<?
$res['groups'] = $db->select_query("SELECT * FROM ".TB_personnel_group." ORDER BY sort LIMIT $goto, $limit ");
$CATCOUNT = 0 ;
$count=0;
while($arr['groups'] = $db->fetch($res['groups'])){
	$row['user'] = $db->num_rows(TB_personnel_list,"id"," g_id=".$arr['groups']['gp_id']." ");
    $CATCOUNT ++ ;
	$row['groups'] = $db->num_rows(TB_personnel_group,"gp_id","");
   //กำหนดการเปลี่ยนลำดับขึ้น
   $SETSORT_UP = $arr['groups']['sort']-1;
   if($CATCOUNT == "1"){
	   $SETSORT_UP = "1" ;
   }
	//กำหนดการเปลี่ยนลำดับลง
   $SETSORT_DOWN = $arr['groups']['sort']+1;
   if($CATCOUNT == $row['groups']){
	   $SETSORT_DOWN = $arr['groups']['sort'] ;
   }
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="60" align="center">
      <a href="?name=admin&file=pgroup&op=group_edit&id=<? echo $arr['groups']['gp_id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=pgroup&op=group_del&id=<? echo $arr['groups']['gp_id'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE_CAT;?>: <?echo $arr['groups']['gp_name'];?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
	 <td><a href="?name=admin&file=pgroup&op=group_list&id=<? echo $arr['groups']['gp_id'];?>"><? echo $arr['groups']['gp_name'];?></a></td>
     <td><a href="?name=admin&file=pgroup&op=group_list&id=<? echo $arr['groups']['gp_id'];?>"><? echo $arr['groups']['description'];?></a></td>
     <td ><CENTER><? echo $row['user'];?></CENTER></td>
     <td align="center" width="50"><A HREF="?name=admin&file=pgroup&op=group_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['groups']['gp_id'];?>"><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=pgroup&op=group_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['groups']['gp_id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_DOWN;?>"></A></td>

     <td align="center" width="40"><input type="checkbox" name="list[']" value="<? echo $arr['groups']['gp_id'];?>"></td>
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
  <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=admin&file=pgroup");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
	echo "<BR><BR>";
	
echo "<font color=#003399 size=2><b>"._PERSONNEL_MOD_DETAIL_SELECT_CAT."<b></font><br>";
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groupstext'] = $db->select_query("SELECT * FROM ".TB_personnel_group." ORDER BY gp_id ");
while ($arr['groupstext'] = $db->fetch($res['groupstext']))
   {
		echo "<font color=#990000 size=2><A HREF=\"?name=personnel&file=gdetail&id=".$arr['groupstext']['gp_id']."&op=gdetail&gr=".$arr['groupstext']['gp_name']."\"><B>".$arr['groupstext']['gp_id']." : </B>".$arr['groupstext']['gp_name']."</a></font><br>";
   }
$db->closedb ();

}
else if($op == "group_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Group Admin Database
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['pcat'] = $db->select_query("SELECT sort FROM ".TB_personnel_group." ORDER BY sort DESC ");
		$arr['pcat'] = mysql_fetch_array($res['pcat']);
		$SORTID = $arr['pcat']['sort']+1 ;

			$db->add_db(TB_personnel_group,array(
				"gp_name"=>"".$_POST['GROUP_NAME']."",
				"description"=>"".$_POST['GROUP_DESC']."",
				"sort"=>"$SORTID",
			));
	//	mysql_query($q['GROUPS']) or die (mysql_error());
	
		$db->closedb ();

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=personnel&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_ADD_CAT_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=pgroup\"><B>"._ADMIN_PERSONNEL_MESSAGE_CAT_GOBACK."</B></A>";
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
<FORM name="groups" METHOD=POST ACTION="?name=admin&file=pgroup&op=group_add&action=add">
     <B><?=_ADMIN_PERSONNEL_FORM_GR_NAME;?> :</B><br>
        <input type="text"  name="GROUP_NAME" size="40"><br>
        <B><?=_ADMIN_PERSONNEL_FORM_GR_DETAIL;?> :</B><br>
        <input type="text" name="GROUP_DESC"  size="40"><br>
        <br>
        <input type="submit" value="<?=_ADMIN_PERSONNEL_FORM_BUTTON_CAT_ADD;?>" >
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
//		$q['GROUPS'] = "SELECT * FROM ".TB_personnel_group." ";
//		$sql['GROUPS'] = mysql_query($q['GROUPS']);  

		$q['GROUPS'] = "UPDATE ".TB_personnel_group." SET gp_name='".addslashes(htmlspecialchars($_POST['GROUP_NAME']))."', description='".addslashes(htmlspecialchars($_POST['GROUP_DESC']))."' WHERE gp_id='".$_GET['id']."'";
		//$q['GROUPS'] .= " WHERE gp_id='".$_GET['id']."';";
	  /******/
		$sql['GROUPS'] = mysql_query($q['GROUPS']) or die (mysql_error());
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=personnel&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_EDIT_CAT_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=personnel\"><B>"._ADMIN_PERSONNEL_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "group_edit" AND $action == "sort"){
	//////////////////////////////////////////// Set Sort
	if(CheckLevel($admin_user,$op)){
		//กรณีเลื่อนขึ้น
		if($_GET['move'] == "up"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_personnel_group." SET sort = sort+1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_personnel_group." SET sort = '".$_GET['setsort']."' WHERE gp_id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		if($_GET['move'] == "down"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_personnel_group." SET sort = sort-1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_personnel_group." SET sort = '".$_GET['setsort']."' WHERE gp_id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=personnel&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_EDIT_CAT_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=pgroup\"><B>"._ADMIN_PERSONNEL_MESSAGE_CAT_GOBACK."</B></A>";
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
		//ดึงกลุ่มบุคลากรออกมา
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['group'] = $db->select_query("SELECT * FROM ".TB_personnel_group." WHERE gp_id='".$_GET['id']."' ");
		$arr['group'] = $db->fetch($res['group']);
		$db->closedb ();
?>
<form action="?name=admin&file=pgroup&op=group_edit&action=edit&id=<?=$_GET['id'];?>" name="groups" method="post">
     <B><?=_ADMIN_PERSONNEL_FORM_GR_NAME;?> :</B><br>
        <input type="text"  name="GROUP_NAME" size="40" value="<?echo $arr['group']['gp_name'];?>"><br>
        <B><?=_ADMIN_PERSONNEL_FORM_GR_DETAIL;?> :</B><br>
        <input type="text" name="GROUP_DESC"  size="40" value="<?echo $arr['group']['description'];?>"><br>
        <br>
        <br><br>
        <input type="submit" value="<?=_ADMIN_PERSONNEL_FORM_BUTTON_CAT_EDIT;?>" ><input type="hidden" name="id"  size="40" value="<?echo $arr['group']['gp_id'];?>">
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
			$db->del(TB_personnel_group," gp_id='".$value."' "); 
			$db->del(TB_personnel_list," g_id='".$value."' "); 
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=personnel&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_DEL_CAT_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=personnel\"><B>"._ADMIN_PERSONNEL_MESSAGE_CAT_GOBACK."</B></A>";
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
		$db->del(TB_personnel_group," gp_id='".$_GET['id']."' ");
		$db->del(TB_personnel_list," g_id='".$_GET['id']."' "); 
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=personnel&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_DEL_CAT_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=personnel\"><B>"._ADMIN_PERSONNEL_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "group_list"){
	//////////////////////////////////////////// กรณีลบ Group Admin Form

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$res['user'] = $db->select_query("SELECT * FROM ".TB_personnel_group." where gp_id='".$_GET['id']."'  ");
$SUMPAGE = $db->rows($res['user']);
$arr['group']=$db->fetch($res['user']);
?>
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td align=center><b><font color=#CC0000><?=$arr['group']['gp_name'];?></font></b></td>
   </tr>
  </table><br>
 <?
if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=pgroup&op=gu_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td><B><CENTER>Option</CENTER></B></td>
   <td><B><CENTER><?=_ADMIN_PERSONNEL_TABLE_NAME;?></CENTER></B></td>
	        <td><B><CENTER><?=_ADMIN_PERSONNEL_TABLE_POSISION;?></CENTER></B></td>
   <td><B><CENTER>Email</CENTER></B></td>
   <td><B><CENTER>tel</CENTER></B></td>
	    <td><B><CENTER><?=_ADMIN_PERSONNEL_FORM_ROW;?></CENTER></B></td>
   <td><B><CENTER>Check</CENTER></B></td>
  </tr>  
<?
$res['user'] = $db->select_query("SELECT * FROM ".TB_personnel." as a , ".TB_personnel_list." as b where b.u_id=a.id and  b.g_id='".$_GET['id']."' ORDER BY a.sort  LIMIT $goto, $limit ");
$rows['user'] = $db->rows($res['user']);
$CATCOUNT = 0 ;
$count=0;
while($arr['user'] = $db->fetch($res['user'])){

	 $CATCOUNT ++ ;
	$row['groups'] = $db->num_rows(TB_personnel_list,"id"," g_id='".$_GET['id']."' ");
   //กำหนดการเปลี่ยนลำดับขึ้น
   $SETSORT_UP = $arr['user']['p_order']-1;
   if($CATCOUNT == "1"){
	   $SETSORT_UP = "1" ;
   }
	//กำหนดการเปลี่ยนลำดับลง
   $SETSORT_DOWN = $arr['user']['p_order']+1;
   if($CATCOUNT == $row['groups']){
	   $SETSORT_DOWN = $arr['user']['p_order'] ;
   }
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=pgroup&op=gu_edit&id=<? echo $arr['user']['id'];?>&gid=<?=$_GET['id'];?>"><img src="images/icon/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=pgroup&op=gu_del&gid=<?=$_GET['id'];?>&id=<? echo $arr['user']['id'];?>','<?=_ADMIN_PERSONNEL_DEL_USER_MESSAGE;?> : <?echo $arr['user']['p_name'];?>');"><img src="images/icon/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><A HREF="popup.php?name=personnel&file=popdetail&pid=<? echo $arr['user']['id'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 250} )" class="highslide">
	 <?echo $arr['user']['p_name'];?>
	 </a></td>
	      <td ><? echo $arr['user']['p_position'];?></td>
     <td ><? echo $arr['user']['p_mail'];?></td>
     <td ><? echo $arr['user']['p_tel'];?></td>
  
	 <td align="center" width="50"><A HREF="?name=admin&file=pgroup&op=gu_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['user']['id'];?>"><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=file=pgroup&op=gu_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['user']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_DOWN;?>"></A></td>
     <td  align="center" width="40"><input type="checkbox" name="list[]" value="<? echo $arr['user']['id'];?>"></td>
    </tr>

<?
	$count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=admin&file=personnel");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
	echo "<BR><BR>";

echo "<font color=#003399 size=2><b>"._PERSONNEL_MOD_DETAIL_SELECT_CAT."<b></font><br>";
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groupstext'] = $db->select_query("SELECT * FROM ".TB_personnel_group." ORDER BY gp_id ");
while ($arr['groupstext'] = $db->fetch($res['groupstext']))
   {
		echo "<font color=#990000 size=2><A HREF=\"?name=admin&file=pgroup&op=group_list&id=".$arr['groupstext']['gp_id']."\"><B>".$arr['groupstext']['gp_id']." : </B>".$arr['groupstext']['gp_name']."</a></font><br>";
   }
$db->closedb ();

}
else if($op == "gu_del" ){
	/////////////// ลบบุคลากรออกจาก หนาที่รับผิดชอบ ////////////////
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_personnel_list," u_id='".$_GET['id']."' and g_id='".$_GET['gid']."' "); 
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_DEL_CAT_USER_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=pgroup&op=group_list\"><B>"._ADMIN_PERSONNEL_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	echo $ProcessOutput ;

}
else if($op == "gu_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ User Admin Multi
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	while(list($key, $value) = each ($_POST['list'])){
		$db->del(TB_personnel_list," u_id='".$value."' and g_id='".$_GET['gid']."' "); 
		}
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_DEL_CAT_USER_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=pgroup&op=group_list\"><B>"._ADMIN_PERSONNEL_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	echo $ProcessOutput ;
}
else if($op == "admin_edit" AND $action == "sort"){
	//////////////////////////////////////////// กรณีแก้ไข Form
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['block'] = $db->select_query("SELECT * FROM ".TB_personnel_list." WHERE u_id='".$_GET['id']."' ");
		$arr['block'] = $db->fetch($res['block']);
		$db->closedb ();

		//กรณีเลื่อนขึ้น
		if($_GET['move'] == "up"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_personnel_list." SET p_order = sort+1 WHERE p_order = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_personnel_list." SET p_order = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		if($_GET['move'] == "down"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_personnel_list." SET p_order = sort-1 WHERE p_order= '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_personnel_list." SET p_order = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_EDIT_CAT_USER_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=pgroup\"><B>"._ADMIN_PERSONNEL_MESSAGE_CAT_GOBACK."</B></A>";
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


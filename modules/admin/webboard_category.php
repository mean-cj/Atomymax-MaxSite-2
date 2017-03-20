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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_WEBBOARD_MENU_TITLE;?> </B>
					<BR><BR><A HREF="?name=admin&file=webboard"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_WEBBOARD_MENU_TITLE_LIST;?></A> &nbsp;&nbsp;&nbsp;	<A HREF="?name=admin&file=webboard_category"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_MENU_DTAIL_CAT;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=webboard_category&op=webboard_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_MENU_ADD_CAT;?></A><BR><BR>
<?
//////////////////////////////////////////// แสดงรายการ
if($op == ""){
?>
<form action="?name=admin&file=webboard_category&op=webboard_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td><B><CENTER>Option</CENTER></B></font></td>
   <td><B><CENTER><?=_ADMIN_FORM_CAT;?></CENTER></B></font></td>
   <td align="center" width="100"><B><CENTER><?=_ADMIN_WEBBOARD_MEMBER_SIT;?></CENTER></B></font></td>
   <td align="center" width="50"><B><?=_ADMIN_FORM_CAT_COUNT;?></B></font></td>
   <td align="center" width="50"><B><?=_ADMIN_FORM_CAT_ORDER;?></B></font></td>
   <td><B><CENTER>Check</CENTER></B></font></td>
  </tr>  
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['boardcat'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." ORDER BY sort ");
$rows['boardcat'] = $db->rows($res['boardcat']);
$CATCOUNT = 0 ;
$count=0;
while ($arr['boardcat'] = mysql_fetch_array($res['boardcat'])){
	$row['sumboard'] = $db->num_rows(TB_WEBBOARD,"id"," category=".$arr['boardcat']['id']." ");

    $CATCOUNT ++ ;
   //กำหนดการเปลี่ยนลำดับขึ้น
   $SETSORT_UP = $arr['boardcat']['sort']-1;
   if($CATCOUNT == "1"){
	   $SETSORT_UP = "1" ;
   }
	//กำหนดการเปลี่ยนลำดับลง
   $SETSORT_DOWN = $arr['boardcat']['sort']+1;
   if($CATCOUNT == $rows['boardcat']){
	   $SETSORT_DOWN = $arr['boardcat']['sort'] ;
   }
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=webboard_category&op=webboard_edit&id=<? echo $arr['boardcat']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=webboard_category&op=webboard_del&id=<? echo $arr['boardcat']['id'];?>','<?=_ADMIN_WEBBOARD_MESSAGE_COM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><?echo $arr['boardcat']['category_name'];?></td>
     <td align="center" width="100" ><?if ($arr['boardcat']['status']==1){echo "<font color=#CC3300>"._ADMIN_WEBBOARD_MEMBER_ONLY."</font>"; } else { echo "<font color=#00CC00>"._ADMIN_WEBBOARD_MEMBER_OTHER."</font>";  }?></td>
	 <td align="center" width="50" ><?echo $row['sumboard'] ;?></td>
     <td align="center" width="50"><A HREF="?name=admin&file=webboard_category&op=webboard_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['boardcat']['id'];?>"><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_U;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=webboard_category&op=webboard_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['boardcat']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_DOWN;?>"></A></td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[']" value="<? echo $arr['boardcat']['id'];?>"></td>
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
 <input type="hidden" name="ACTION" value="news_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form>
<?
}
else if($op == "webboard_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
		//เช็คว่า id ตอนนี้เป็นอะไร
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['boardcat'] = $db->select_query("SELECT sort FROM ".TB_WEBBOARD_CAT." ORDER BY sort DESC ");
		$arr['boardcat'] = mysql_fetch_array($res['boardcat']);
		$SORTID = $arr['boardcat']['sort']+1 ;
		//เพิ่มข้อมูลลงดาต้าเบส
		$db->add_db(TB_WEBBOARD_CAT,array(
			"category_name"=>"".addslashes(htmlspecialchars($_POST['CATEGORY']))."",
			"category_des"=>"".addslashes(htmlspecialchars($_POST['CATEGORY_DES']))."",
			"sort"=>"$SORTID",
			"status"=>"".$_POST['STATUS'].""
		));
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_WEBBOARD_MESSAGE_CAT_ADD."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=webboard_category\"><B>"._ADMIN_WEBBOARD_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "webboard_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM METHOD=POST ACTION="?name=admin&file=webboard_category&op=webboard_add&action=add">
<B><?=_ADMIN_FORM_CAT_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="CATEGORY" size="40">
<BR><BR>
<B><?=_ADMIN_FORM_DETAIL;?> :</B><BR>
<textarea name="CATEGORY_DES" cols="40" rows="5" id="editor1">
</textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'AdminBasic'});</script>
<BR><BR>
<B><?=_ADMIN_WEBBOARD_MEMBER_SIT;?></b><input type=radio name=STATUS value=0><B><?=_ADMIN_WEBBOARD_MEMBER_OTHER;?></B><input type=radio name=STATUS value=1><B><?=_ADMIN_WEBBOARD_MEMBER_ONLY;?></B><br>
<BR><BR>
<INPUT TYPE="submit" value="<?=_ADMIN_WEBBOARD_BUTTON_CAT_ADD;?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "webboard_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database
	if(CheckLevel($admin_user,$op)){
		//แก้ไขข้อมูลลงดาต้าเบส
		$db->update_db(TB_WEBBOARD_CAT,array(
			"category_name"=>"".addslashes(htmlspecialchars($_POST['CATEGORY']))."",
			"category_des"=>"".addslashes(htmlspecialchars($_POST['CATEGORY_DES']))."",
			"status"=>"".$_POST['STATUS'].""
		)," id=".$_GET['id']." ");
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_WEBBOARD_MESSAGE_CAT_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=webboard_category\"><B>"._ADMIN_WEBBOARD_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "webboard_edit" AND $action == "sort"){
	//////////////////////////////////////////// Set Sort
	if(CheckLevel($admin_user,$op)){
		//กรณีเลื่อนขึ้น
		if($_GET['move'] == "up"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_WEBBOARD_CAT." SET sort = sort+1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_WEBBOARD_CAT." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		if($_GET['move'] == "down"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_WEBBOARD_CAT." SET sort = sort-1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_WEBBOARD_CAT." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_WEBBOARD_MESSAGE_CAT_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=webboard_category\"><B>"._ADMIN_WEBBOARD_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "webboard_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['boardcat'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." WHERE id='".$_GET['id']."' ");
		$arr['boardcat'] = $db->fetch($res['boardcat']);
		$db->closedb ();
?>
<FORM METHOD=POST ACTION="?name=admin&file=webboard_category&op=webboard_edit&action=edit&id=<?=$_GET['id'];?>">
<B><?=_ADMIN_FORM_CAT_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="CATEGORY" size="40" value="<?=$arr['boardcat']['category_name'];?>">
<BR><BR>
<B><?=_ADMIN_FORM_DETAIL;?> :</B><BR>
<textarea name="CATEGORY_DES" cols="40" rows="5" id="editor1"><?=$arr['boardcat']['category_des'];?>
</textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'AdminBasic'});</script>
<BR><BR>
<B><?=_ADMIN_WEBBOARD_MEMBER_SIT;?></b><input type=radio name=STATUS value=0 <? if ($arr['boardcat']['status']==0) { echo "checked"; } ?>><B><?=_ADMIN_WEBBOARD_MEMBER_OTHER;?></B><input type=radio name=STATUS value=1 <? if ($arr['boardcat']['status']==1) { echo "checked"; } ?>><B><?=_ADMIN_WEBBOARD_MEMBER_ONLY;?></B><br>
<BR><BR>
<INPUT TYPE="submit" value="<?=_ADMIN_WEBBOARD_BUTTON_CAT_EDIT;?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
}
else if($op == "webboard_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$BoardResult = $db->select_query("SELECT id,picture FROM ".TB_WEBBOARD." WHERE category='".$value."' ORDER BY id ");
			while($WebBoard = $db->fetch($BoardResult)){
				$CommentResult = $db->select_query("SELECT id,picture FROM ".TB_WEBBOARD_COMMENT." WHERE topic_id='".$WebBoard['id']."' ORDER BY id ");
				while($Comment = $db->fetch($CommentResult)){
					@unlink("webboard_upload/".$Comment['picture']."");
				}
				@unlink("webboard_upload/".$WebBoard['picture']."");
				$db->del(TB_WEBBOARD_COMMENT," topic_id='".$WebBoard['id']."' "); 
			}
			$db->del(TB_WEBBOARD_CAT," id='".$value."' "); 
			$db->del(TB_WEBBOARD," category='".$value."' "); 
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_WEBBOARD_MESSAGE_CAT_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=webboard_category\"><B>"._ADMIN_WEBBOARD_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "webboard_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$BoardResult = $db->select_query("SELECT id,picture FROM ".TB_WEBBOARD." WHERE category='".$_GET['id']."' ORDER BY id ");
		while($WebBoard = $db->fetch($BoardResult)){
			$CommentResult = $db->select_query("SELECT id,picture FROM ".TB_WEBBOARD_COMMENT." WHERE topic_id='".$WebBoard['id']."' ORDER BY id ");
			while($Comment = $db->fetch($CommentResult)){
				@unlink("webboard_upload/".$Comment['picture']."");
			}
			@unlink("webboard_upload/".$WebBoard['picture']."");
			$db->del(TB_WEBBOARD_COMMENT," topic_id='".$WebBoard['id']."' "); 
		}
		$db->del(TB_WEBBOARD_CAT," id='".$_GET['id']."' "); 
		$db->del(TB_WEBBOARD," category='".$_GET['id']."' "); 
		$db->closedb ();
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_WEBBOARD_MESSAGE_CAT_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=webboard_category\"><B>"._ADMIN_WEBBOARD_MESSAGE_CAT_GOBACK."</B></A>";
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

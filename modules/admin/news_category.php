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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_NEW_MENU_TITLE;?></B>
					<BR><BR>
					<A HREF="?name=admin&file=news"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_NEW_MENU_TITLE_ALL;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=news&op=news_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_NEW_MENU_TITLE_ADD_NEW;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=news_category"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle"><?=_ADMIN_MENU_DTAIL_CAT;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=news_category&op=newscat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"><?=_ADMIN_MENU_ADD_CAT;?></A><BR><BR>
<?
//////////////////////////////////////////// แสดงรายการ
if($op == ""){
?>
<form action="?name=admin&file=news_category&op=newscat_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td><B><CENTER>Option</CENTER></B></td>
   <td><B><CENTER><?=_ADMIN_FORM_CAT;?></CENTER></B></td>
    <td align="center" width="50"><B>icon</B></td>
   <td align="center" width="50"><B><?=_ADMIN_FORM_CAT_COUNT;?></B></td>
   <td align="center" width="50"><B><?=_ADMIN_FORM_CAT_ORDER;?></B></td>
   <td><B><CENTER>Check</CENTER></B></td>
  </tr>  
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['newscat'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." ORDER BY sort ");
$rows['newscat'] = $db->rows($res['newscat']);
$CATCOUNT = 0 ;
$count=0;
while ($arr['newscat'] = mysql_fetch_array($res['newscat'])){
	$row['sumnews'] = $db->num_rows(TB_NEWS,"id"," category=".$arr['newscat']['id']." ");

    $CATCOUNT ++ ;
   //กำหนดการเปลี่ยนลำดับขึ้น
   $SETSORT_UP = $arr['newscat']['sort']-1;
   if($CATCOUNT == "1"){
	   $SETSORT_UP = "1" ;
   }
	//กำหนดการเปลี่ยนลำดับลง
   $SETSORT_DOWN = $arr['newscat']['sort']+1;
   if($CATCOUNT == $rows['newscat']){
	   $SETSORT_DOWN = $arr['newscat']['sort'] ;
   }

if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=news_category&op=newscat_edit&id=<? echo $arr['newscat']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=news_category&op=newscat_del&id=<? echo $arr['newscat']['id'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE_CAT;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><?echo $arr['newscat']['category_name'];?></td>
	 <td align="center" width="50" ><img src="images/icon/<?echo  $arr['newscat']['icon'] ;?>" border="0" width="40" height="30"></td>
	 <td align="center" width="50" ><?echo $row['sumnews'] ;?></td>
     <td align="center" width="50"><A HREF="?name=admin&file=news_category&op=newscat_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['newscat']['id'];?>"><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=news_category&op=newscat_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['newscat']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_DOWN;?>"></A></td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[']" value="<? echo $arr['newscat']['id'];?>"></td>
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
else if($op == "newscat_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
		//เช็คว่า id ตอนนี้เป็นอะไร
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['newscat'] = $db->select_query("SELECT sort FROM ".TB_NEWS_CAT." ORDER BY sort DESC ");
		$arr['newscat'] = mysql_fetch_array($res['newscat']);
		$SORTID = $arr['newscat']['sort']+1 ;
		//เพิ่มข้อมูลลงดาต้าเบส
		require("includes/class.resizepic.php");
		$FILE = $_FILES['FILE'];
		if (!$_POST['CATEGORY'] OR !$FILE['type']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}

		if ((($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")) AND $FILE['size']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
if ($FILE['name']<>'') {
			@copy ($FILE['tmp_name'] , "images/icon/news_".TIMESTAMP.".jpg" );
			$original_image = "images/icon/news_".TIMESTAMP.".jpg" ;
			$desired_width = _INEWS_W ;
			$desired_height = _INEWS_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("images/icon/news_".TIMESTAMP.".jpg", "JPG");
		}

		$db->add_db(TB_NEWS_CAT,array(
			"category_name"=>"".addslashes(htmlspecialchars($_POST['CATEGORY']))."",
			"sort"=>"$SORTID",
			"icon"=>"news_".TIMESTAMP.".jpg"
		));
		$db->closedb ();
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_NEW_MESSAGE_CAT_ADD."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=news_category\"><B>"._ADMIN_NEW_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "newscat_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM METHOD=POST ACTION="?name=admin&file=news_category&op=newscat_add&action=add" enctype="multipart/form-data">
<B><?=_ADMIN_FORM_CAT_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="CATEGORY" size="40">
<BR><BR>
<B><?=_ADMIN_FORM_CAT_ICON;?> :</B><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_ADMIN_FORM_ICON_WIDTH;?> <?echo _INEWS_W." x "._INEWS_H ;?> <?=_ADMIN_FORM_CAT_ICON_WIDTH;?>
<BR><BR>
<INPUT TYPE="submit" value=" <?=_ADMIN_NEW_BUTTON_CAT_ADD;?> ">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "newscat_edit" AND $_GET['action'] == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database
	if(CheckLevel($admin_user,$op)){
		//แก้ไขข้อมูลลงดาต้าเบส
		require("includes/class.resizepic.php");
		$FILE = $_FILES['FILE'];
		if (!$_POST['CATEGORY'] ){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}

if ($FILE['name']<>'') {
		if ((($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")) AND $FILE['size']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
			@copy ($FILE['tmp_name'] , "images/icon/news_".TIMESTAMP.".jpg" );
			$original_image = "images/icon/news_".TIMESTAMP.".jpg" ;
			$desired_width = _INEWS_W ;
			$desired_height = _INEWS_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("images/icon/news_".TIMESTAMP.".jpg", "JPG");
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_NEWS_CAT,array(
			"category_name"=>"".addslashes(htmlspecialchars($_POST['CATEGORY']))."",
			"icon"=>"news_".TIMESTAMP.".jpg"
		)," id=".$_GET['id']." ");
		$db->closedb ();
		} else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_NEWS_CAT,array(
			"category_name"=>"".addslashes(htmlspecialchars($_POST['CATEGORY'])).""
		)," id=".$_GET['id']." ");
		$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_NEW_MESSAGE_CAT_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=news_category\"><B>"._ADMIN_NEW_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "newscat_edit" AND $_GET['action'] == "sort"){
	//////////////////////////////////////////// Set Sort
	if(CheckLevel($admin_user,$op)){
		//กรณีเลื่อนขึ้น
		if($_GET['move'] == "up"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_NEWS_CAT." SET sort = sort+1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_NEWS_CAT." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		if($_GET['move'] == "down"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_NEWS_CAT." SET sort = sort-1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_NEWS_CAT." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_NEW_MESSAGE_CAT_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=news_category\"><B>"._ADMIN_NEW_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "newscat_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['newscat'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." WHERE id='".$_GET['id']."' ");
		$arr['newscat'] = $db->fetch($res['newscat']);
		//echo $arr['newscat']['icon'];
		$db->closedb ();
?>
<FORM METHOD=POST ACTION="?name=admin&file=news_category&op=newscat_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
<B><?=_ADMIN_FORM_CAT_TOPIC;?> :</B><BR>

<INPUT TYPE="text" NAME="CATEGORY" size="40" value="<?=$arr['newscat']['category_name'];?>">
<BR><BR>
<B><?=_ADMIN_FORM_CAT_ICON;?> :</B><BR>
<IMG name="view01" SRC="images/icon/<? echo $arr['newscat']['icon'];?>" <?echo " WIDTH=\""._INEWS_W."\" HEIGHT=\""._INEWS_H."\" ";?> BORDER="0" ><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=350;"><BR>
<?=_ADMIN_FORM_ICON_WIDTH;?> <?echo _INEWS_W." x "._INEWS_H ;?> <?=_ADMIN_FORM_CAT_ICON_WIDTH;?>
<BR><BR>
<INPUT TYPE="submit" value="<?=_ADMIN_NEW_BUTTON_CAT_EDIT;?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
}
else if($op == "newscat_del" AND $_GET['action'] == "multidel"){
/// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->del(TB_NEWS_CAT," id='".$value."' "); 
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_NEW_MESSAGE_CAT_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=news_category\"><B>"._ADMIN_NEW_MESSAGE_CAT_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "newscat_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_NEWS_CAT," id='".$_GET['id']."' "); 
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_NEW_MESSAGE_CAT_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=news_category\"><B>"._ADMIN_NEW_MESSAGE_CAT_GOBACK."</B></A>";
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

<?
CheckAdmin($admin_user, $admin_pwd);
include ("editor.php");
empty($_POST['ENABLE_COMMENT'])?$ENABLE_COMMENT="":$ENABLE_COMMENT=$_POST['ENABLE_COMMENT'];
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
//////////////////////////////////////////// แสดงรายการผลงานทางวิชาการ 
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_RESEARCH,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=research&op=research_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="44"><CENTER><B>Option</B></CENTER></td>
   <td><CENTER><B><?=_ADMIN_RESEARCH_TABLE_HEADER_TOPIC;?></B></CENTER></td>
   <td width="100"><CENTER><B><?=_ADMIN_TABLE_TITLE_POSTED;?></B></CENTER></td>
   <td width="40"><CENTER><B><?=_ADMIN_TABLE_TITLE_CAT;?></B></CENTER></td>
   <td width="40"><CENTER><B>Check</B></CENTER></td>
  </tr>  
<?
$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['research'] = $db->fetch($res['research'])){
	$res['category'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." WHERE id='".$arr['research']['category']."' ");
	$arr['category'] = $db->fetch($res['category']);
		$newsid=$arr['research']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(id) as com FROM ".TB_RESEARCH_COMMENT." WHERE id ='".$newsid."' group by id"); 
	$arrs['com'] = $db->fetch($ress['com']);
	//Comment Icon
	if($arr['research']['enable_comment']){
		$CommentIcon = " <IMG SRC=\"images/icon/suggest.gif\" WIDTH=\"13\" HEIGHT=\"9\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{
		$CommentIcon = "";
	}
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=research&op=research_edit&id=<? echo $arr['research']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=research&op=research_del&id=<? echo $arr['research']['id'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><A HREF="?name=research&file=readresearch&id=<?echo $arr['research']['id'];?>" target="_blank"><?echo $arr['research']['topic'];?></A><?=$CommentIcon;?><?=NewsIcon(TIMESTAMP, $arr['research']['post_date'], "images/icon_new.gif");?><font color="#CC3300">( <?=_FORM_MOD_READ;?> : <?=$arr['research']['pageview'];?> / <?=_FROM_COMMENT_NUMX;?> : <?=$arrs['com']['com'];?> )</font> <?=_ADMIN_RESEARCH_AUTH;?> <font color="#CC3300"><?=$arr['research']['auth'];?></font></td>
     <td ><CENTER><?echo ThaiTimeConvert($arr['research']['post_date'],'','');?></CENTER></td>
     <td align="center">
	 <?if($arr['category']['category_name']){ //หากมีหมวดแสดงรูป ?>
	 <A HREF="#"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle" alt="<?echo $arr['category']['category_name'];?>" onMouseOver="MM_displayStatusMsg('<?echo $arr['category']['category_name'];?>');return document.MM_returnValue"></A>
	 <? } ?>
	 </td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<? echo $arr['research']['id'];?>"></td>
    </tr>

<?
	$count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="research_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=admin&file=research");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "research_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){

	require("includes/class.resizepic.php");
		$FILE = $_FILES['FILE'];
		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['auth'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL'] OR !$FILE['type']){

			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
		if (($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}else{
			@copy ($FILE['tmp_name'] , "icon/research_".TIMESTAMP.".jpg" );
			$original_image = "icon/research_".TIMESTAMP.".jpg" ;
			$desired_width = _Iresearch_W ;
			$desired_height = _Iresearch_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/research_".TIMESTAMP.".jpg", "JPG");
		}
			if ($login_true){
			$dir=$login_true;
			} else if($admin_user) { $dir=$admin_user;
			} else { $dir='guest';}

$filesw_name = $_FILES['filesw']['name']; 
$abstractxx_name = $_FILES['abstractxx']['name']; 


if (is_uploaded_file($_FILES['filesw']['tmp_name']) && is_uploaded_file($_FILES['abstractxx']['tmp_name']))
		{
if (is_uploaded_file($_FILES['filesw']['tmp_name']))  {  
	copy($_FILES['filesw']['tmp_name'], "data/research_".TIMESTAMP."_$filesw_name");
	 }  else{
          print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." ".$_FILES['filesw']['name']." "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
	}
if (is_uploaded_file($_FILES['abstractxx']['tmp_name']))  {  
	copy($_FILES['abstractxx']['tmp_name'], "data/research_".TIMESTAMP."_$abstractxx_name");
	 }  else{
          print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." ".$_FILES['abstractxx']['name']." "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
	}
			  		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$dir."",
			"auth"=>"".$_POST['auth']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"full_text"=>"research_".TIMESTAMP."_".$filesw_name."", 
			"abstract"=>"research_".TIMESTAMP."_".$abstractxx_name.""  ));
		$db->closedb ();


		  } else if (is_uploaded_file($_FILES['filesw']['tmp_name']) && !is_uploaded_file($_FILES['abstractxx']['tmp_name']))
		{
if (is_uploaded_file($_FILES['filesw']['tmp_name']))  {  
	copy($_FILES['filesw']['tmp_name'], "data/research_".TIMESTAMP."_$filesw_name");
			  		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$dir."",
			"auth"=>"".$_POST['auth']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"full_text"=>"research_".TIMESTAMP."_".$filesw_name." "  ));
		$db->closedb ();
	 }  else{
          print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." ".$_FILES['filesw']['name']." "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
	}

} else if (!is_uploaded_file($_FILES['filesw']['tmp_name']) && is_uploaded_file($_FILES['abstractxx']['tmp_name'])){
if (is_uploaded_file($_FILES['abstractxx']['tmp_name']))  {  
	copy($_FILES['abstractxx']['tmp_name'], "data/research_".TIMESTAMP."_$abstractxx_name");
      //        unlink($abstractxx_name);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$dir."",
			"auth"=>"".$_POST['auth']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"abstract"=>"research_".TIMESTAMP."_".$abstractxx_name.""  ));
		$db->closedb ();
	 }  else{
          print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." ".$_FILES['abstractxx']['name']." "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
	}

} else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$dir."",
			"auth"=>"".$_POST['auth']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT."" ));
		$db->closedb ();
}

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RESEARCH_MESSAGE_ADD."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=research\"><B>"._ADMIN_RESEARCH_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "research_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=research&op=research_add&action=add" enctype="multipart/form-data" id="myform">
<B><?=_RESEARCH_MOD_FORM_NAME_RE;?> :</B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="100">
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_NAME_AUTH;?> :</B><BR>
<INPUT TYPE="text" NAME="auth" size="50">
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_CAT;?> :</B><BR>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_AUTH_PIC;?> : </B><BR>
<IMG name="view01" SRC="images/news_blank.gif" <?echo " WIDTH=\""._Iresearch_W."\" HEIGHT=\""._Iresearch_H."\" ";?> BORDER="0" ><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_ADMIN_FORM_ICON_WIDTH;?> <?echo _Iresearch_W." x "._Iresearch_H ;?> <?=_ADMIN_FORM_CAT_ICON_WIDTH;?>
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_HEADLINE;?> :</B><BR>
<textarea cols="100"  rows="10"  name="HEADLINE" ></textarea>
<BR><BR>

<B><?=_RESEARCH_MOD_FORM_DETAIL;?> :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ></textarea>
<BR>
<center><table><tr><td bgcolor="#F8F8F8" align="center"><h5><font color="#0000CC"><?=_RESEARCH_MOD_FORM_TITLE_ATTRACT;?></font></h5></td></tr></table><br>
<table>
<tr>
<td><font face="MS Sans serif" ><b><?=_RESEARCH_MOD_FORM_ABSTRACT;?> : </td><td><input type="file" name="abstractxx" maxlength ="50" size="50"><font face="MS Sans serif"> <?=_RESEARCH_MOD_FORM_ABSTRACT_COM;?></td></tr>
<tr>
<td>
<font face="MS Sans serif" color="#CC0000"><b><?=_RESEARCH_MOD_FORM_FULLTEXT;?> : </font></td><td><input type="file" name="filesw" maxlength ="50" size="50"><font face="MS Sans serif"><?=_RESEARCH_MOD_FORM_FULLTEXT_COM;?></td></tr>
<tr>
<td>
</table>
<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1"> <?=_RESEARCH_MOD_FORM_ENA_COM;?>
<BR>
<input type="submit" value="<?=_RESEARCH_MOD_FORM_BUTTON_ADD;?>" name="submit"> <input type="reset" value="<?=_RESEARCH_MOD_FORM_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "research_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." WHERE id='".$_GET['id']."' ");
		$arr['research'] = $db->fetch($res['research']);
		$db->closedb ();
		require("includes/class.resizepic.php");
		$FILE = $_FILES['FILE'];
		$filesw = $_FILES['filesw'];
		$abstractxx=$_FILES['abstractxx'];
		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['auth'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL'] ){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
		if ($FILE<>'') {
		if ((($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")) AND $FILE['size']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}else{
			@copy ($FILE['tmp_name'] , "icon/research_".$arr['research']['post_date'].".jpg" );
			$original_image = "icon/research_".$arr['research']['post_date'].".jpg" ;
			$desired_width = _Iresearch_W ;
			$desired_height = _Iresearch_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/research_".$arr['research']['post_date'].".jpg", "JPG");
		}
		}

$dir="".$arr['research']['posted']."".$arr['research']['post_date']."";
if ($filesw['name'] != '' && $abstractxx['name'] != '')
		{
               if ( $upload=copy( $filesw['tmp_name'], "data/research_".TIMESTAMP."_".$filesw['name']."")) {
                }else{
                        print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." $filesw "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
                }
              unlink($filesw);
               if ( $upload=copy( $abstractxx['tmp_name'], "data/research_".TIMESTAMP."_".$abstractxx['name']."")) {
                }else{
                        print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." $abstractxx "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
                }
			unlink($abstractxx_name);
			  		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"auth"=>"".$_POST['auth']."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"full_text"=>"research_".TIMESTAMP."_".$filesw['name']."", 
			"abstract"=>"research_".TIMESTAMP."_".$abstractxx['name']."" )," id=".$_GET['id']."");
		$db->closedb ();


		  } else	if ($filesw['name'] != '' && $abstractxx['name'] == '')
		{
               if ( $upload=copy( $filesw['tmp_name'], "data/research_".TIMESTAMP."_".$filesw['name']."")) {
                }else{
                        print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." $filesw "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
                }
              unlink($filesw);

			  		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"auth"=>"".$_POST['auth']."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"full_text"=>"research_".TIMESTAMP."_".$filesw['name']."" )," id=".$_GET['id']."");
		$db->closedb ();
} else if ($abstractxx['name'] != '' && $filesw['name'] == ''){
			$timeaa="".TIMESTAMP."_";
               if ( $upload=copy( $abstractxx['tmp_name'], "data/research_".TIMESTAMP."_".$abstractxx['name']."")) {
                }else{
                        print "<center><font color='red'>"._RESEARCH_MOD_ADD_NOUP_PIC." $abstractxx "._RESEARCH_MOD_ADD_NOUP_PIC1."</font></center><br>";
                }
      //        unlink($abstractxx_name);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"auth"=>"".$_POST['auth']."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"abstract"=>"research_".TIMESTAMP."_".$abstractxx['name']."")," id=".$_GET['id']."");
		$db->closedb ();

} else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_RESEARCH,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"auth"=>"".$_POST['auth']."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT."")," id=".$_GET['id']."");
		$db->closedb ();
}


		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RESEARCH_MESSAGE_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=research\"><B>"._ADMIN_RESEARCH_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "research_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." WHERE id='".$_GET['id']."' ");
		$arr['research'] = $db->fetch($res['research']);
		$HEADLINE = $arr['research']['headline'];
		$HEADLINE= stripslashes($HEADLINE);
		$TextContent = $arr['research']['detail'];
		$TextContent = stripslashes($TextContent);
		$db->closedb ();
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=research&op=research_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
<B><?=_RESEARCH_MOD_FORM_NAME_RE;?> :</B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="100" value="<?=$arr['research']['topic'];?>">
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_NAME_AUTH;?> :</B><BR>
<INPUT TYPE="text" NAME="auth" size="50" value="<?=$arr['research']['auth'];?>">
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_CAT;?> :</B><BR>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   if($arr['category']['id'] == $arr['research']['category']){echo " Selected";}
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_AUTH_PIC;?> :</B><BR>
<IMG name="view01" SRC="icon/research_<?=$arr['research']['post_date'];?>.jpg" <?echo " WIDTH=\""._Iresearch_W."\" HEIGHT=\""._Iresearch_H."\" ";?> BORDER="0" ><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_ADMIN_FORM_ICON_WIDTH;?> <?echo _Iresearch_W." x "._Iresearch_H ;?> <?=_ADMIN_FORM_CAT_ICON_WIDTH;?>
<BR><BR>
<B><?=_RESEARCH_MOD_FORM_HEADLINE;?> :</B><BR>
<textarea cols="100"  rows="10"  name="HEADLINE" ><?=$HEADLINE;?></textarea>
<BR><BR>

<B><?=_RESEARCH_MOD_FORM_DETAIL;?>:</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ><?=$TextContent;?></textarea>
<BR>
<center><table><tr><td bgcolor="#F8F8F8" align="center"><h5><font color="#0000CC"><?=_RESEARCH_MOD_FORM_TITLE_ATTRACT;?></font></h5></td></tr></table><br>
<table>
<tr>
<td><font face="MS Sans serif" ><b><?=_RESEARCH_MOD_FORM_ABSTRACT;?> : </td><td><input type="file" name="abstractxx" maxlength ="50" size="50"><font face="MS Sans serif"> <?=_RESEARCH_MOD_FORM_ABSTRACT_COM;?></td></tr>
<tr>
<td>
<br><font face="MS Sans serif" color="#CC0000"><b><?=_RESEARCH_MOD_FORM_FULLTEXT;?>  : </font></td><td><input type="file" name="filesw" maxlength ="50" size="50"><font face="MS Sans serif"><?=_RESEARCH_MOD_FORM_FULLTEXT_COM;?></td></tr>
<tr>
<td>
</table>
<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1" <?if($arr['research']['enable_comment']){echo " Checked";};?>> <?=_RESEARCH_MOD_FORM_ENA_COM;?>
<BR>
<input type="submit" value="<?=_ADMIN_RESEARCH_BUTTON_EDIT;?>" name="submit"> <input type="reset" value="<?=_RESEARCH_MOD_FORM_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
}
else if($op == "research_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." WHERE id='".$value."' ");
			$arr['research'] = $db->fetch($res['research']);
			$db->del(TB_RESEARCH," id='".$value."' "); 
			@unlink("icon/research_".$arr['research']['post_date'].".jpg");

			if($arr['research']['abstract'] !=''){
			@unlink("data/".$arr['research']['abstract']);
			}
			if($arr['research']['full_text'] !=''){
			@unlink("data/".$arr['research']['full_text']);
			}
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RESEARCH_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=research\"><B>"._ADMIN_RESEARCH_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "research_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//		$db->del(TB_RESEARCH," id='".$_GET['id']."' ");
			$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." WHERE id='".$_GET['id']."' ");
			$arr['research'] = $db->fetch($res['research']);
			$db->del(TB_RESEARCH," id='".$_GET['id']."' "); 
			@unlink("icon/".$arr['research']['post_date'].".jpg");
			if($arr['research']['abstract'] !=''){
			@unlink("data/".$arr['research']['abstract']);
			}
			if($arr['research']['full_text'] !=''){
			@unlink("data/".$arr['research']['full_text']);
			}
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RESEARCH_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=research\"><B>"._ADMIN_RESEARCH_MESSAGE_GOBACK."</B></A>";
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

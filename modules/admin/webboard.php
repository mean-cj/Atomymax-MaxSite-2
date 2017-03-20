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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_WEBBOARD_MENU_TITLE;?> </B>
					<BR><BR><A HREF="?name=admin&file=webboard"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_WEBBOARD_MENU_TITLE_LIST;?></A> &nbsp;&nbsp;&nbsp;	<A HREF="?name=admin&file=webboard_category"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_MENU_DTAIL_CAT;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=webboard_category&op=webboard_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_MENU_ADD_CAT;?></A><BR><BR>
<?
//////////////////////////////////////////// แสดงรายการกระดานถามตอบ 
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_WEBBOARD,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=webboard&op=webboard_del&action=multidel" name="myform" method="post">
<style type="text/css">
<!--
.style2 {font-size: 14px;
	font-weight: bold;
}
-->
</style>
<br />
<TABLE cellSpacing=0 cellPadding=0 width=800 border=0 >
      <TBODY>
				<TR >
					<TD>
          <table width="98%"  align="center" border="0" cellspacing="0" cellpadding="0" class="grids">
            <tr >
              <td height="24" colspan="6"><b><img src="images/icon/icon_folder.gif" width="16" height="16" border="0" align="absmiddle" /> <a href="?name=webboard"><?=$limit;?> <?=_WEBBOARD_LISTALL_UPDATE;?></a> &nbsp;&nbsp;</b></td>
            </tr>
            <tr height="20" class="odd">
           <td width="12%" height="26" align="center" ><b><?=_WEBBOARD_TABLE_TITLE_RANK;?></b></td>
              <td   height="26"><center><b><?=_WEBBOARD_TABLE_TITLE_TOPIC;?></b></center></td>
              <td  width="16%" height="26"><center><b><?=_WEBBOARD_READ_POSTEDX;?></b></center></td>
              <td width="16%" align="center"  height="26"><b>IP</b></td>
              <td width="5%" align="center"  height="26"><b>Check</b></td>
            </tr>
            <?
if(!empty($category)){
	$SQLwhere = " pin_date='' AND category='".$category."' ";
	$SQLwhere2 = " WHERE pin_date='' AND category='".$category."' ";
	$SQLwherePin = " WHERE pin_date!='' AND category='".$category."' ";
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT category_name FROM ".TB_WEBBOARD_CAT." WHERE id='".$category."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$CatShow = $arr['category']['category_name'];
}else{
	$CatShow = ""._WEBBOARD_LISTALL."";
	$SQLwhere = " pin_date='' ";
	$SQLwhere2 = " WHERE pin_date='' ";
	$SQLwherePin = " WHERE pin_date!='' ";
}
$limit = 20;
//แสดงกระทู้ปักหมุด
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['Pin'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD." $SQLwherePin ORDER BY pin_date DESC  LIMIT "._SHOW_BOARD_PIN." ");
while($arr['Pin'] = $db->fetch($res['Pin'])){

		if($arr['Pin']['picture']!=''){
		$PicIcon = " <A HREF=webboard_upload/".$arr['Pin']['picture']." class=\"highslide\" onclick=\"return hs.expand(this)\"><IMG SRC=\"images/preview.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_PIC."\"></a>";
	}else{
		$PicIcon = "";
	}
	if($arr['Pin']['att'] !=''){
		$AttIcon = " <a href=webboard_upload/".$arr['Pin']['att']."><IMG SRC=\"images/attach.gif\" WIDTH=\"8\" HEIGHT=\"13\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_FILE."\"></a>";
	}else{
		$AttIcon = "";
	}

		echo "<tr height=\"22\" bgcolor=#FFFFCC><td  align=\"left\">";
	$SumComm = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id='".$arr['Pin']['id']."' "); 
	if($arr['Pin']['pageview']>45){ echo"<img src='images/icon/topichot.gif' border='0' hspace='5' ALIGN=\"absmiddle\">";}else{echo"<IMG SRC=\"images/icon/dock.gif\" BORDER=\"0\"  hspace='5' ALIGN=\"absmiddle\">";}
		echo "&nbsp;&nbsp;<a href='index.php?name=admin&file=webboard&op=webboard_edit&id=".$arr['Pin']['id']."'><img src='images/edit_f2.png'></a>";
		echo " <A HREF=\"javascript:Confirm('?name=admin&file=webboard&op=webboard_del&id=".$arr['Pin']['id']."','"._WEBBOARD_TOPIC_CON_DEL."');\"><IMG SRC=\"images/admin/trash.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALIGN=\"absmiddle\"></A>";	
	

echo "</td><td> <A HREF=\"?name=webboard&file=read&id=".$arr['Pin']['id']."\" target=\"_blank\">".$arr['Pin']['topic']."</A> ".$PicIcon."&nbsp;".$AttIcon." ";

	//กรณีกระทู้ใหม่ 
	$Comm = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where topic_id='".$arr['Pin']['id']."' ORDER BY id DESC ");
	$Comms = $db->fetch($Comm);
	if($Comms['id']){
	UpdateIcon(TIMESTAMP, $Comms['post_date'], "images/icon/update.gif");
	}else{
	NewsIcon(TIMESTAMP, $arr['Pin']['post_date'], "images/icon_new.gif");
	 };
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($arr['Pin']['pageview'])."/".number_format($SumComm).")</FONT></td>\n";
	//กรณีสมาชิก


	echo "<td  width=\"19%\"><CENTER>";
		if($arr['Pin']['is_member']==1){
			echo "<B><FONT COLOR=\"#FF0033\">".$arr['Pin']['post_name']."</FONT></B>&nbsp;";
		echo "<IMG SRC=\"images/human.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{	echo "<B><FONT COLOR=\"#6600FF\">".$arr['Pin']['post_name']."</FONT></B>&nbsp;"; };
	echo"<br><font size='1'>"._WEBBOARD_DETAIL_POST." ".ThaiTimeConvert($arr['Pin']['post_date'],"","2")."</font></CENTER></td>\n";
		// แสดงคนตอบล่าสุด     
echo "<td  width=\"19%\">";
//$res['ments'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE topic_id=".$arr['Pin']['id']." ORDER BY id DESC LIMIT 1 ");
//$arr['ments'] = $db->fetch($res['ments']);
//if ($arr['ments']['topic_id']){
//	echo "<CENTER><B><FONT COLOR=#6600FF\"> ".$arr['ments']['post_name']."</B></FONT><br><font size='1'>เมื่อ ".ThaiTimeConvert($arr['ments']['post_date'],"","2")."</font></CENTER>\n";
//} else {
//	echo "<CENTER><B></CENTER>\n";
//}
	echo "<center>".$arr['Pin']['ip_address']."</center>";
	echo "</td>";
	echo "<td valign=\"top\" align=\"center\" width=\"40\"><input type=\"checkbox\" name=\"list[]\" value=".$arr['Pin']['id']."></td></tr>";


}
//แสดงผลกระทู้ 
//$limit = _PERPAGE_BOARD ;
$SUMPAGE = $db->num_rows(TB_WEBBOARD,"id","$SQLwhere");

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$count=0;
$BoardResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD." $SQLwhere2 ORDER BY post_date DESC,post_update DESC,id DESC  LIMIT $goto, $limit ");
while($WebBoard = $db->fetch($BoardResult)){
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
	if($WebBoard['picture']!=''){
		$PicIcon = " <A HREF=webboard_upload/".$WebBoard['picture']." class=\"highslide\" onclick=\"return hs.expand(this)\"><IMG SRC=\"images/preview.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_PIC_TITLE."\"></a>";
	}else{
		$PicIcon = "";
	}
	if($WebBoard['att'] !=''){
		$AttIcon = " <a href=webboard_upload/".$WebBoard['att']."><IMG SRC=\"images/attach.gif\" WIDTH=\"8\" HEIGHT=\"13\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_FILE_TITLE."\"></a>";
	}else{
		$AttIcon = "";
	}

	//Sum comment
	$SumComm = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id='".$WebBoard['id']."' "); 
	echo "<tr ".$ColorFill."><td  align=left>";
		if($WebBoard['pageview']>45){ echo"<img src='images/icon/topichot.gif' border='0' hspace='5' ALIGN=\"absmiddle\">";}else{echo"<IMG SRC=\"images/btn_paper.jpg\" BORDER=\"0\"  hspace='5' ALIGN=\"absmiddle\">";}
		echo "&nbsp;&nbsp;<a href='index.php?name=admin&file=webboard&op=webboard_edit&id=".$WebBoard['id']."'><img src='images/edit_f2.png'></a>";
		echo " <A HREF=\"javascript:Confirm('?name=admin&file=webboard&op=webboard_del&id=".$WebBoard['id']."','"._WEBBOARD_TOPIC_CON_DEL."');\"><IMG SRC=\"images/admin/trash.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALIGN=\"absmiddle\"></A>";	

		echo "</td><td > <A HREF=\"?name=webboard&file=read&id=".$WebBoard['id']."\" > <font  color='#333333'>".$WebBoard['topic']."</font></A> ".$PicIcon."&nbsp;".$AttIcon."";	
	

	//กรณีกระทู้ใหม่ 
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$Comm = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where topic_id='".$WebBoard['id']."' ORDER BY id DESC  LIMIT $goto, $limit ");
	$Comms = $db->fetch($Comm);
	$SumComm = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id='".$WebBoard['id']."' "); 
	if($Comms['id']){
	UpdateIcon(TIMESTAMP, $Comms['post_date'], "images/icon/update.gif");
	}else{
	NewsIcon(TIMESTAMP, $WebBoard['post_date'], "images/icon_new.gif");
	 };
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($WebBoard['pageview'])."/".number_format($SumComm).")</FONT></td>\n";
	echo "</td>\n";
	echo "<td width=\"19%\"><CENTER>";
			if($WebBoard['is_member']==1){
		echo "<B><FONT COLOR=\"#FF0066\">".$WebBoard['post_name']."</FONT></B>&nbsp;<IMG SRC=\"images/human.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{	echo "<B><FONT COLOR=\"#6600FF\">".$WebBoard['post_name']."</FONT></B>&nbsp;"; };
	echo "<br><font size='1'>"._WEBBOARD_DETAIL_POST." ".ThaiTimeConvert($WebBoard['post_date'],"","2")."</font></CENTER></td>\n";
		// แสดงคนตอบล่าสุด     
//$res['ment'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE topic_id=".$WebBoard['id']." ORDER BY id DESC LIMIT 1 ");
//$arr['ment']= $db->fetch($res['ment']);
//	if ($arr['ment']['post_name']){
//				if($arr['ment']['is_member']==1){
//	echo "<td width=\"19%\"><CENTER><B><FONT COLOR=#FF0033\"> ".$arr['ment']['post_name']."</B></FONT><IMG SRC=\"images/human.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"><br><font size='1'>เมื่อ ".ThaiTimeConvert($arr['ment']['post_date'],"","2")."</font></CENTER></td>\n";
//				} else {
//	echo "<td width=\"19%\"><CENTER><B><FONT COLOR=#6600FF\"> ".$arr['ment']['post_name']."</B></FONT><br><font size='1'>เมื่อ ".ThaiTimeConvert($arr['ment']['post_date'],"","2")."</font></CENTER></td>\n";
//				}
//	}else {
//	echo "<td width=\"19%\"><CENTER><B></CENTER></td>\n";
//	}
	echo "<td width=\"19%\"><CENTER>".$WebBoard['ip_address']."</center></td>";
?>
	<td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<?=$WebBoard['id'];?>"></td></tr>
	<?


	$count++;
	}
@mysql_free_result($BoardResult);
$db->closedb();
?>
</table><br /></TD></TR></TBODY>
</TABLE> 
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="webboard_del" >
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=admin&file=webboard");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "article_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){

		$FILE = $_FILES['FILE'];
		$FILESS=$_FILES['FILESS'];
		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL'] ){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
if ($FILE['name']) {
		require("includes/class.resizepic.php");
		if (($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}else{
			@copy ($FILE['tmp_name'] , "icon/webboard_".TIMESTAMP.".jpg" );
			$original_image = "icon/webboard_".TIMESTAMP.".jpg" ;
			$desired_width = _IKNOW_W ;
			$desired_height = _IKNOW_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/webboard_".TIMESTAMP.".jpg", "JPG");
		}
	$pic='1';
} else {
	$pic='0';
}

if ($FILESS['name']) {
		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_WEBBOARD,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".addslashes(htmlspecialchars($_POST['HEADLINE']))."",
			"headline"=>"".$_POST['DETAIL']."",
			"posted"=>"".$_SESSION['admin_user']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"attach"=>"".TIMESTAMP."_".$FILESS['name']."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT.""
		));
		$db->closedb ();
	@copy ($FILESS['tmp_name'] , "attach/webboard_".TIMESTAMP."_".$FILESS['name']."");
} else {

		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_WEBBOARD,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".addslashes(htmlspecialchars($_POST['HEADLINE']))."",
			"headline"=>"".$_POST['DETAIL']."",
			"posted"=>"".$_SESSION['admin_user']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT.""
		));
		$db->closedb ();
}


		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._WEBBOARD_COMMENT_POST_SUCCESS."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=webboard\"><B>"._ADMIN_WEBBOARD_MEASSAGE_GOBACK." </B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "article_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=webboard&op=article_add&action=add" enctype="multipart/form-data">
<B><?=_WEBBOARD_TABLE_TITLE_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="50">
<BR><BR>
<B><?=_WEBBOARD_FORM_CAT_TITLE;?> :</B><BR>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?=_ADMIN_FORM_ICON;?> : </B><BR>
<IMG name="view01" SRC="images/webboard_blank.gif" <?echo " WIDTH=\""._IKNOW_W."\" HEIGHT=\""._IKNOW_H."\" ";?> BORDER="0" ><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_ADMIN_FORM_ICON_WIDTH;?> <?echo _IKNOW_W." x "._IKNOW_H ;?> <?=_ADMIN_FORM_ICON_WIDTH1;?>
<BR><BR>

<B><?=_ADMIN_FORM_HEADLINE;?> :</B><BR>
<textarea cols="50" id="editor1" rows="50"  name="HEADLINE" ></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'AdminBasic'});</script>
<BR><BR>

<B><?=_ADMIN_FORM_DETAIL;?> :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ></textarea>
<BR>
<B><?=_ADMIN_FORM_FILE_ATT;?> : </B><BR>
<input type="file" name="FILESS" onpropertychange="view01.src=FILESS.value;" style="width=250;">
<br>
<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1"> <?=_ADMIN_FORM_ALLOW_COMMENT;?>
<BR>
<input type="submit" value=" <?=_ADMIN_WEBBOARD_BUTTON_ADD_WEB;?> " name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "webboard_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$VIEWBOARD = $db->fetch($db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id = '".$_GET['id']."' "));
$db->closedb ();

	//Check data
	if(!$_POST['topic'] OR !$_POST['category'] OR !$_POST['detail']){
		echo "<script language='javascript'>" ;
		echo "alert('"._JAVA_DATA_NULL."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}

	//เช็คแบนโฆษณา
	checkban($_POST['topic']);
	//checkban($_POST['DETAIL']);
	checkban($_POST['post_name']);
	//Check Pic Size
	$FILE = $_FILES['FILE'];
	if ( $FILE['size'] > _WEBBOARD_LIMIT_UPLOAD ) {
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_EDIT_ADD_PIC_WIDTH." ".(_WEBBOARD_LIMIT_UPLOAD/1024)." kB "._WEBBOARD_EDIT_ADD_PIC_WIDTH1."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
$webboard_pic=$_POST['picture'];
	if ( $FILE['size'] == 0 )
			{$Filename = $webboard_pic ;} 
			else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$PicResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id='".$_GET['id']."' ");
		while($DelPic = $db->fetch($PicResult)) {
		@unlink("webboard_upload/".$DelPic['picture']."");
		$db->update_db(TB_WEBBOARD,array("picture"=>""	)," id='".$_GET['id']."' ");
		$db->closedb ();
		}
			}
	//แปลงนามสกุล และทำการ upload
	if ( $FILE['type'] == "image/gif" )
			{$Filename = TIMESTAMP.".gif";}
	if ( $FILE['type'] == "image/png" )
			{$Filename = TIMESTAMP.".png";}
	elseif (($FILE['type']=="image/jpg")||($FILE['type']=="image/jpeg")||($FILE['type']=="image/pjpeg"))
			{$Filename = TIMESTAMP.".jpg";}
	@copy ($FILE['tmp_name'] , "webboard_upload/".$Filename );
	$FILE = $_FILES['FILE'];
	$FILEATT = $_FILES['FILEATT'];
//เพิ่มข้อมูลลง db


	if ($FILEATT['name']){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$db->update_db(TB_WEBBOARD,array(
		"category"=>"".$_POST['category']."",
		"topic"=>"".htmlspecialchars($_POST['topic'])."",
		"detail"=>"".$_POST['detail']."",
		"picture"=>"$Filename",
		"enable_show"=>"".$_POST['show']."",
		"att"=>"".TIMESTAMP."_".$FILEATT['name'].""
)," id=".$_GET['id'].""); 
@copy ($FILEATT['tmp_name'] , "webboard_upload/".TIMESTAMP."_".$FILEATT['name']);
	} else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$db->update_db(TB_WEBBOARD,array(
		"category"=>"".$_POST['category']."",
		"topic"=>"".htmlspecialchars($_POST['topic'])."",
		"detail"=>"".$_POST['detail']."",
		"picture"=>"$Filename",
		"enable_show"=>"".$_POST['show'].""
)," id=".$_GET['id']."");  
	}
		$db->closedb ();


//ถ้าต้องการลบรูปประกอบ
if ($_POST['chkdel']=="1") {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$PicResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id='".$_GET['id']."' ");
		while($DelPic = $db->fetch($PicResult)) {
		@unlink("webboard_upload/".$DelPic['picture']."");
		$db->update_db(TB_WEBBOARD,array("picture"=>""	)," id='".$_GET['id']."' ");
		$db->closedb ();
		}
}

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._WEBBOARD_FORM_EDIT_TOPIC_SUCCESS."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=webboard\"><B>"._ADMIN_WEBBOARD_MEASSAGE_GOBACK."</B></A>";
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
//ดึงข้อมูลเดิมมาแสดง
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['webboard'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id='".$_GET['id']."' ");
		$arr['webboard'] = $db->fetch($res['webboard']);
		$db->closedb ();
		
		?>

  <FORM name="form2" METHOD=POST ACTION="?name=admin&file=webboard&op=webboard_edit&action=edit&id=<?=$_GET['id']?>" enctype="multipart/form-data" >
    <TABLE width="98%" align="center" border="0">
      <TR>
        <TD  align=right width="150"><IMG SRC="images/bullet.gif" BORDER="0" ALIGN="absmiddle"> <B><?=_ADMIN_FORM_CAT;?> : </B></TD>
	    <TD >
	      <SELECT NAME="category" value="<?=$arr['webboard']['category']?>">
	        <OPTION value=""><?=_WEBBOARD_JUM_ALLCAT_SELECT;?></OPTION>
	        <?
//ทำาการดึง category มา
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   if($arr['category']['id'] == $arr['webboard']['category']){echo " Selected";}
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
	        </SELECT>	      </TD>
    </TR>
      <TR>
        <TD width="150" align=right><IMG SRC="images/bullet.gif" BORDER="0" ALIGN="absmiddle"> <B><?=_WEBBOARD_TABLE_TITLE_TOPIC;?> : </B></TD>
	    <TD width="400"><INPUT TYPE="text" NAME="topic" size="50" style="width:300" class="inputform" value="<?=$arr['webboard']['topic']?>"></TD>
    </TR>
      <TR>
        <TD  align=right width="150"><B><?=_WEBBOARD_FORM_ATT_PIC_TITLE;?> : </B></TD>
	    <TD>	<?
		if ($arr['webboard']['picture'])	{
			echo "<input type='checkbox' name='chkdel' value='1'>&nbsp;"._WEBBOARD_FORM_DEL_PIC_TITLE."&nbsp;";
			echo "<br><img src='webboard_upload/".$arr['webboard']['picture']."' border='0'  align='top'>";
		}
		?>		<br><font color="red"><?=_ADMIN_WEBBOARD_UPLOAD_PIC_NEW;?></font><br><input type="file" name="FILE" style="width:250" class="inputform"> Limit <?=(_WEBBOARD_LIMIT_UPLOAD/1024);?> kB  </TD>
    </TR>
<TR>
	<TD align=right width="150"><B><?=_WEBBOARD_INDEX_ATT_FILES;?> : </B></TD>
	<TD><input type="file" name="FILEATT" style="width:250" class="inputform"> Limit <?=(_WEBBOARD_LIMIT_UPLOADS/1024);?> kB</TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>

<TR>
	<TD width=150 align=right><B><?=_WEBBOARD_FORM_TOPIC_MEMBER_ONLY;?> : </B></TD>
	<TD><input type=checkbox name=show  value=1 <?if ($arr['webboard']['enable_show']==1){echo "checked";}?>><?=_WEBBOARD_FORM_TOPIC_MEMBER_ONLY_1;?>&nbsp;&nbsp;<input type=checkbox name=show  value=0 <?if ($arr['webboard']['enable_show']==0){echo "checked";}?>><?=_WEBBOARD_FORM_TOPIC_MEMBER_ONLY_2;?></TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>

<TR>
	<TD  align=right valign=top width="150"><B><?=_WEBBOARD_FORM_DETAIL_TITLE;?> : </B></TD>
	<TD>
<textarea cols="50" id="editor1" rows="50"  name="detail" ><?=$arr['webboard']['detail'];?></textarea>
		<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script>
	</TD>
</TR>
      <TR>
        <TD  align=right width="150"><IMG SRC="images/bullet.gif" BORDER="0" ALIGN="absmiddle"> <B><?=_WEBBOARD_FORM_AUTH_POST;?> : </B></TD>
	    <TD><INPUT TYPE="text" NAME="post_name" style="width:150" class="inputform" value="<?=$arr['webboard']['post_name'];?>"> 
	      <span class="style1"></span></TD>
    </TR>
      <TR>
        <TD  align=right><B></B></TD>
	    <TD><INPUT TYPE="submit" value="<?=_WEBBOARD_FORM_BUTTON_ADD;?>"><INPUT TYPE="hidden" NAME="picture"  value="<?=$arr['webboard']['picture'];?>"><INPUT TYPE="hidden" NAME="fileuploadnew"  value="<?=$arr['webboard']['fileupload'];?>"></TD>
    </TR>
      </TABLE>
  </FORM>
<BR><BR>
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
			$BoardResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id='".$value."' ");
			$WebBoard = $db->fetch($BoardResult);
			$usercom=$WebBoard['post_name'];
			$CommentResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE topic_id='".$WebBoard['id']."' ORDER BY id ");
			while($Comment = $db->fetch($CommentResult)){
				@unlink("webboard_upload/".$Comment['picture']."");
			$db->del(TB_WEBBOARD_COMMENT," topic_id='".$WebBoard['id']."' "); 
		}
		$rows['sum'] = $db->fetch($db->select_query("select * from ".TB_MEMBER." where user='".$usercom."' "));
		if (!empty($rows['sum'])){
		if($rows['sum']['topic'] !='0'){$topic_down=$row['sum']['topic']-1;} else {$topic_down=0;}
		$db->update_db(TB_MEMBER,array(
			"topic" =>"".$topic_down.""
		)," user='".$usercom."' ");
		}
		@unlink("webboard_upload/".$WebBoard['picture']."");
		$db->del(TB_WEBBOARD," id='".$value."' "); 
		$row['sum'] = $db->fetch($db->select_query("select * from ".TB_MEMBER." where user='".$usercom."' "));
		if (!empty($row['sum'])){
		$row=$row['sum']['post']-1;
			$db->update_db(TB_MEMBER,array(
			"post" =>"".$row.""
		)," user='".$usercom."' ");
		}
		}
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._WEBBOARD_TOPIC_DELET_SUCCESS."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=webboard\"><B>"._ADMIN_WEBBOARD_MEASSAGE_GOBACK."</B></A>";
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
		$BoardResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id='".$_GET['id']."' ");
		$WebBoard = $db->fetch($BoardResult);
			$usercom=$WebBoard['post_name'];
			$CommentResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE topic_id='".$WebBoard['id']."' ORDER BY id ");
			while($Comment = $db->fetch($CommentResult)){
				@unlink("webboard_upload/".$Comment['picture']."");


			$db->del(TB_WEBBOARD_COMMENT," topic_id='".$WebBoard['id']."' "); 

		}
		$rows['sum'] = $db->fetch($db->select_query("select * from ".TB_MEMBER." where user='".$usercom."' "));
		if ($rows['sum']){
		if($rows['sum']['topic'] !='0'){$topic_down=$row['sum']['topic']-1;} else {$topic_down=0;}
		$db->update_db(TB_MEMBER,array(
			"topic" =>"".$topic_down.""
		)," user='".$usercom."' ");
		}
		@unlink("webboard_upload/".$WebBoard['picture']."");
		$db->del(TB_WEBBOARD," id='".$_GET['id']."' "); 
		$row['sum'] = $db->fetch($db->select_query("select * from ".TB_MEMBER." where user='".$usercom."' "));
		if ($row['sum']){
		$row=$row['sum']['post']-1;
			$db->update_db(TB_MEMBER,array(
			"post" =>"".$row.""
		)," user='".$usercom."' ");
		}
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._WEBBOARD_TOPIC_DELET_SUCCESS."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=webboard\"><B>"._ADMIN_WEBBOARD_MEASSAGE_GOBACK."</B></A>";
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

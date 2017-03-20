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
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_video.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; video </B>
					<BR><BR>
					<A HREF="?name=admin&file=video"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_VIDEO_MOD_MENU_MAIN;?> </A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video&op=video_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_VIDEO_MENU_ADD_NEW_FILE;?> </A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video_youtube"><IMG SRC="images/admin/7_40.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_VIDEO_MENU_ADD_NEW_YOUTUBE;?>  </A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video_category"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_MENU_DTAIL_CAT;?></A>  &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video_category&op=videocat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_MENU_ADD_CAT;?></A><BR><BR>
<?

//////////////////////////////////////////// แสดงรายการvideo 
if($op == ""){
?>
<FORM NAME="myform" METHOD=POST enctype="multipart/form-data" ACTION="?name=admin&file=video_youtube&op=video_add&action=add">
<center><table border=1 bgcolor=#F7F7F7 bordercolor=#FFFFFF width=700 class="grids"><tr><td  align="right" width="140"><?=_ADMIN_VIDEO_FORM_SELECT_CAT;?></td><td>
<SELECT id="CATEGORY" NAME="CATEGORY" >
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();

?>
</SELECT>
</td></tr>
<tr><td align="right" width="140"  valign="top"><?=_ADMIN_VIDEO_YOUTUBE_FROM_JAK;?> </td><td>
    	<input id="youtube" name="youtube" type="text" size="60"/><br><font color="#990000">[ <?=_ADMIN_VIDEO_YOUTUBE_FROM_URL_COM;?> ]</font>
</td>
</tr>
<tr><td></td><td><INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1"> <?=_ADMIN_LINK_ALLOW_COMMENT;?>
</td></tr>
</table>
<INPUT id="admin" TYPE="hidden" NAME="admin" size="40" value="<?=$_SESSION['admin_user'];?>">
<input type="submit" value="<?=_ADMIN_VIDEO_YOUTUBE_BUTTON_ADD;?>" name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>

<?
}
else if($op == "video_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
//	$Text= "http://www.youtube.com/watch?v=jOhptygCa5s";

$newtext= youtubeID($_POST['youtube']);

		if (!$_POST['CATEGORY'] OR !$_POST['youtube'] ){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
$json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$newtext."?v=2&alt=jsonc"));
//echo '<img src="' . $json->data->thumbnail->sqDefault . '"><br>';
//echo "title : ". utf8_to_tis620($json->data->title)."<br>";
//echo "duration : ". $json->data->duration ."<br>";
//echo "Author : ". $json->data->uploader ."<br>";
//echo "description : ". utf8_to_tis620($json->data->description) ."<br>";
//echo "published : ". $json->data->published."<br>";
$x=preg_replace("/T/i"," ",$json->data->uploaded);
$y=substr($x,0,19);
$times=strtotime($y);
//$date=date('Y-m-d H:i:s',$times);
if(ISO =='utf-8'){
$title=$json->data->title;
$detail=$json->data->description;
$posted=$json->data->uploader;
} else {
$title=utf8_to_tis620($json->data->title);
$detail=utf8_to_tis620($json->data->description);
$posted=utf8_to_tis620($json->data->uploader);
}

	  	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_VIDEO,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".$title."",
			"detail"=>"".$detail."",
			"posted"=>"".$posted."",
			"post_date"=>"".$times."",
			"pic"=>"default.jpg",
			"video"=>"".$newtext."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"youtube"=>"1",
			"times"=>"".$json->data->duration.""
		));
		$db->closedb ();

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_VIDEO_YOUTUBE_MESSAGE_ADD."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=video_youtube\"><B>"._ADMIN_VIDEO_YOUTUBE_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
		echo $ProcessOutput ;
}
else if($op == "video_edit" AND $action == "edit"){
	if(CheckLevel($admin_user,$op)){

$newtext= youtubeID($_POST['youtube']);

		if (!$_POST['CATEGORY'] OR !$_POST['youtube'] ){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
$json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$newtext."?v=2&alt=jsonc"));
//echo '<img src="' . $json->data->thumbnail->sqDefault . '"><br>';
//echo "title : ". utf8_to_tis620($json->data->title)."<br>";
//echo "duration : ". $json->data->duration ."<br>";
//echo "Author : ". $json->data->uploader ."<br>";
//echo "description : ". utf8_to_tis620($json->data->description) ."<br>";
//echo "published : ". $json->data->published."<br>";
$x=preg_replace("/T/i"," ",$json->data->uploaded);
$y=substr($x,0,19);
$times=strtotime($y);
//$date=date('Y-m-d H:i:s',$times);
if(ISO =='utf-8'){
$title=$json->data->title;
$detail=$json->data->description;
$posted=$json->data->uploader;
} else {
$title=utf8_to_tis620($json->data->title);
$detail=utf8_to_tis620($json->data->description);
$posted=utf8_to_tis620($json->data->uploader);
}
	  	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_VIDEO,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".$title."",
			"detail"=>"".$detail."",
			"posted"=>"".$posted."",
			"post_date"=>"".$times."",
			"pic"=>"default.jpg",
			"video"=>"".$newtext."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"youtube"=>"1",
			"times"=>"".$json->data->duration.""
		)," id=".$_GET['id']."");
		$db->closedb ();

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_VIDEO_YOUTUBE_MESSAGE_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=video_youtube\"><B>"._ADMIN_VIDEO_YOUTUBE_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
		echo $ProcessOutput ;
}
else if($op == "video_edit" ){
?>
<FORM NAME="myform" METHOD=POST enctype="multipart/form-data" ACTION="?name=admin&file=video_youtube&op=video_edit&action=edit&id=<?echo $_GET['id'];?>">
<center><table border=1 bgcolor=#F7F7F7 bordercolor=#FFFFFF width=700><tr><td  align="right" width="140"><?=_ADMIN_VIDEO_FORM_SELECT_CAT;?></td><td>
<SELECT id="CATEGORY" NAME="CATEGORY" >
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." WHERE id='".$_GET['id']."' ");
$arr['video'] = $db->fetch($res['video']);

$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   if($arr['category']['id'] == $arr['video']['category']){echo " Selected";}
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();

?>
</SELECT>
</td></tr>
<tr><td align="right" width="140"  valign="top"><?=_ADMIN_VIDEO_YOUTUBE_FROM_JAK;?> </td><td>
    	<input id="youtube" name="youtube" type="text" size="60" value="<?echo "http://www.youtube.com/watch?v=".$arr['video']['video']."";?>"><br><font color="#990000">[ <?=_ADMIN_VIDEO_YOUTUBE_FROM_URL_COM;?> ]</font>
</td>
</tr>
<tr><td></td><td ><INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1"> <?=_ADMIN_LINK_ALLOW_COMMENT;?>
</td></tr>
</table>
<INPUT id="admin" TYPE="hidden" NAME="admin" size="40" value="<?=$_SESSION['admin_user'];?>">
<input type="submit" value="<?=_ADMIN_VIDEO_BUTTON_EDIT;?>" name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>

<?

}
else if($op == "video_del" ){
		if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_VIDEO," id='".$_GET['id']."' "); 
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_VIDEO_YOUTUBE_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=video_youtube\"><B>"._ADMIN_VIDEO_YOUTUBE_MESSAGE_GOBACK."</B></A>";
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


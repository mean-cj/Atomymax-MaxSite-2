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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A></b>
					<BR><BR>
					<A HREF="?name=admin&file=config"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_CONFIG_MENU_INDEX;?></A> <BR><BR>
<?
//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

?>

 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="180" scope="col"><CENTER><B><?=_ADMIN_CONFIG_TABLE_TUM;?></B></CENTER></td>
   <td scope="col"><CENTER><B><?=_ADMIN_CONFIG_TABLE_SAMPLE;?></B></td>
   <td width="90" scope="col"><CENTER><B>width (px)</B></CENTER></td>
   <td width="90" scope="col"><CENTER><B>height (px)</B></CENTER></td>
   <td width="80" scope="col"><CENTER><B><?=_ADMIN_CONFIG_TABLE_CAT;?></B></CENTER></td>
  </tr>  
<?
$res['config'] = $db->select_query("SELECT * FROM ".TB_CONFIG.",".TB_TEMPLATES." where  name=temname and sort between 1 and 3 ");
 $i=1;
 $count=0;
while($arr['config'] = $db->fetch($res['config'])){
	$res['category'] = $db->select_query("SELECT * FROM ".TB_CONFIG_CAT." WHERE id='".$arr['config']['sort']."' ");
	$arr['category'] = $db->fetch($res['category']);
	//Comment Icon
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "";
} else {
$ColorFill = 'class="odd"';
}
?>
    <tr <?php echo $ColorFill; ?>>
     <td valign="top" align="center">
      <a href="javascript:Confirm('?name=admin&file=config&op=config_del&tem=<?=$arr['config']['name'];?>&id=<? echo $arr['config']['sort'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a><br><font color="#CC0000"><b>
     <?echo $arr['category']['category_name'];?></b></font></td> 
     <td valign="top">
<?
 $types=$arr['config']['type'];
 if ($types="application/x-shockwave-flash" ) {
?>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=($arr['config']['width'])/2;?>" height="<?=($arr['config']['height'])/2;?>">
 <param name="movie" value="templates/<?=WEB_TEMPLATES;?>/images/config/<?=$arr['config']['picname'];?>" />
<param name="quality" value="high" />
<embed src="templates/<?=WEB_TEMPLATES;?>/images/config/<?=$arr['config']['picname'];?>"
      quality="height"
      type="application/x-shockwave-flash"
      width="<?=($arr['config']['width'])/2;?>"
      height="<?=($arr['config']['height'])/2;?>"
      pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
<?
	} else {
		  ?>
<img src="images/config/<?=$arr['config']['picname'];?>"  width="50%" height="50%" border="0">

<?
}
?></td>
     <td align="center" valign="top"><?echo $arr['config']['width'];?></td>
	 <td align="center" valign="top"><?echo $arr['config']['height'];?></td>
     <td align="center" valign="top"><?echo $arr['config']['type'];?></td>
    </tr>

<?
	$count++;
	$i++;
 } 
?>
 </table><br>
<?
	$paths="".WEB_PATH."/templates/".WEB_TEMPLATES."/images/config/";
//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['configs'] = $db->select_query("SELECT * FROM ".TB_CONFIG."  ORDER BY id ");
$sd=1;
while($arr['configs'] = $db->fetch($res['configs'])){
if ($arr['configs']['posit']=='title'){ $titlex=$arr['configs']['name'];}
if ($arr['configs']['posit']=='url'){ $urlx=$arr['configs']['name'];}
if ($arr['configs']['posit']=='path'){ $pathx=$arr['configs']['name'];}
if ($arr['configs']['posit']=='footer1'){ $footer1x=$arr['configs']['name'];}
if ($arr['configs']['posit']=='footer2'){ $footer2x=$arr['configs']['name'];}
if ($arr['configs']['posit']=='email'){ $emailx=$arr['configs']['name'];}
if ($arr['configs']['posit']=='templates'){ $templatesx=$arr['configs']['name'];}
$sd++;
}
$res['configs'] = $db->select_query("SELECT * FROM ".TB_CONFIG.",".TB_TEMPLATES." where  name=temname and sort='2' ");
$arr['configs'] = $db->fetch($res['configs']);
?>
 <table width="100%" cellspacing="2" cellpadding="1" bgcolor="#FFFFCC" >
  <tr>

<!--สำหรับการอัพโหลด-->
<form method="post" name="form" id="form" action="?name=admin&file=config&op=config_add&action=add" enctype="multipart/form-data">
  <td align=left><?=_ADMIN_CONFIG_FORM_TOPMINI;?> :</td><td><input type="file" name="fileupload0" class="orenge" size="40"><br> ( <?=_ADMIN_CONFIG_FORM_COMMENT;?> <font color="#CC0000"><b><?=$arr['configs']['width'];?></b></font> px)</td></tr>
  <td align=left><?=_ADMIN_CONFIG_FORM_TOPBIG;?> :</td><td><input type="file" name="fileupload1" class="orenge" size="40"><br> ( <?=_ADMIN_CONFIG_FORM_COMMENT;?> <font color="#CC0000"><b><?=$arr['configs']['width'];?></b></font> px)</td></tr>
  <td align=left><?=_ADMIN_CONFIG_FORM_FOOTER;?> :</td><td><input type="file" name="fileupload2" class="orenge" size="40"><br> ( <?=_ADMIN_CONFIG_FORM_COMMENT;?> <font color="#CC0000"><b><?=$arr['configs']['width'];?></b></font> px)</td></tr>

</td>
</tr>
</table><br>
 <table width="100%" cellspacing="2" cellpadding="1" border="0">
  <tr>
  <td align="center">
 <table  width="100%" cellspacing="2" cellpadding="2" bgcolor="#F4F4F4">
  <tr>
  <td align="right"  width="120"><?=_ADMIN_CONFIG_FORM_MESSAGE_TITLE;?>:</td><td><input type="input" name="TITLE" size="100" value="<?=$titlex;?>"> </td></tr>
  <td align="right"  width="120"><?=_ADMIN_CONFIG_FORM_MESSAGE_URL;?> :</td><td><input type="input" name="URL" size="60" value="<?=$urlx;?>"></td></tr>
  <td align="right"  width="120"><?=_ADMIN_CONFIG_FORM_MESSAGE_PATH;?>:</td><td><input type="input" name="PATH" size="60" value="<?=$pathx;?>"></td></tr>
  <td align="right"  width="120"><?=_ADMIN_CONFIG_FORM_MESSAGE_FOOTER1;?>:</td><td><input type="input" name="FOOTER1" size="100" value="<?=$footer1x;?>"></td></tr>
    <td align="right"  width="120"><?=_ADMIN_CONFIG_FORM_MESSAGE_FOOTER2;?>:</td><td><input type="input" name="FOOTER2" size="100" value="<?=$footer2x;?>"></td></tr>
    <td align="right"  width="120"><?=_ADMIN_CONFIG_FORM_MESSAGE_EMAIL_ADMIN;?>:</td><td><input type="input" name="EMAIL" size="60" value="<?=$emailx;?>"></td></tr>
    <td align="right"  width="120" valign=top>Templates :</td><td valign=top>
	<SELECT name="picture"  id="picture" onChange="showimage()" />
<?

  if ($handle = opendir("templates")) {
    while (false !== ($item = readdir($handle))) {
      if ($item != "." && $item != ".." && $item != "Thumbs.db") {
	echo "<option value=".$item." ";
	if($templatesx==$item){ echo "selected";}
	echo ">$item</option>";
      }
    }
    closedir($handle);
  }

?>
			  </select>
<script language="javascript">
function showimage()
{
if (!document.images)
return
document.images.pictures.src="templates/"+document.form.picture.options[document.form.picture.selectedIndex].value+"/thumbnail.png";
}
//-->
</script>

<br><a href="javascript:linkrotate(document.form.picture.selectedIndex)" onMouseover="window.status='';return true"><img src="templates/<?=$templatesx;?>/thumbnail.png" name="pictures" border=0></a>
	</td></tr>
</td>
</tr>
</table>
</td>

</tr>
  <tr>
  <td colspan="2" align="center"><input type="submit" name="Submit" value="<?=_ADMIN_CONFIG_FORM_BUTTON_EDIT;?>" class="orenge"></d>
  </tr>
</table>

</form>
<?
}
else if($op == "config_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
empty($_FILES['fileupload0'])?$fileuploads[0]="":$fileuploads[0]=$_FILES['fileupload0'];
empty($_FILES['fileupload1'])?$fileuploads[1]="":$fileuploads[1]=$_FILES['fileupload1'];
empty($_FILES['fileupload2'])?$fileuploads[2]="":$fileuploads[2]=$_FILES['fileupload2'];
	    $ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
  for ( $i = 0 ; $i < count( $fileuploads )  ; $i++)
  {
	  if ($fileuploads[$i]['name'] !='' ){
$a=$i+1;

$size = getimagesize($fileuploads[$i]['tmp_name']);
//$size['0']."*".$size['1'];
//echo "".$fileuploads[$i]['name']."<br>";
$width = $size[0];
$height = $size[1];
//echo "$width<br>";
//echo $size['0']."*".$size['1'];
if ($width > _TEMPLATES_WIDTH_CONFIG) {

		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_CONFIG_MESSAGE_LIMIT_WIDTH_PIC." ".$fileuploads[$i]['name']." "._ADMIN_CONFIG_MESSAGE_LIMIT_WIDTH_PIC1." "._TEMPLATES_WIDTH_CONFIG." px</B></FONT><BR><BR>";
		$ProcessOutput .= "<BR><BR>";


} else if($fileuploads[$i]['size'] > _CONFIG_LIMIT_UPLOAD){
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_LINK_PICTURE."  ".$fileuploads[$i]['name']." "._ADMIN_CONFIG_MESSAGE_LIMIT_SIZE_PIC." ".(_CONFIG_LIMIT_UPLOAD/1024)." kbyte</B></FONT><BR><BR>";
		$ProcessOutput .= "<BR><BR>";

} else {

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['tem'] = $db->select_query("SELECT * FROM ".TB_TEMPLATES." WHERE sort='".$a."' and temname='".$_POST['picture']."' ");
$arr['tem'] = $db->fetch($res['tem']);
if (!empty($arr['tem']['sort'])){
		@unlink("templates/".WEB_TEMPLATES."/images/config/".$arr['tem']['picname']."");
 		$db->update_db(TB_TEMPLATES,array(
			"picname"=>"".$fileuploads[$i]['name']."",
			"width"=>"".$width."",
			"height"=>"".$height."",
			"type"=>"".$fileuploads[$i]['type'].""
		)," sort='".$a."' and temname='".$_POST['picture']."' ");
		$db->closedb ();
} else {
 		$db->add_db(TB_TEMPLATES,array(
			"temname"=>"".$_POST['picture']."",
			"picname"=>"".$fileuploads[$i]['name']."",
			"width"=>"".$width."",
			"height"=>"".$height."",
			"type"=>"".$fileuploads[$i]['type']."",
			"sort"=>"".$a.""
		));
		$db->closedb ();
}
   //ทำการอัปโหลดไฟล์ไปยัง path/to/ชื่อไฟล์เดิม
   copy($fileuploads[$i]['tmp_name'], 'templates/'.WEB_TEMPLATES.'/images/config/'.$fileuploads[$i]['name']);

  }
  }
  }

  		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['TITLE'])).""
		)," posit='title' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['URL'])).""
		)," posit='url' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".$_POST['PATH'].""
		)," posit='path' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['FOOTER1'])).""
		)," posit='footer1' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['FOOTER2'])).""
		)," posit='footer2' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".addslashes(htmlspecialchars($_POST['EMAIL'])).""
		)," posit='email' ");
 		$db->update_db(TB_CONFIG,array(
			"name"=>"".$_POST['picture'].""
		)," posit='templates' ");
		$db->closedb ();
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_CONFIG_MESSAGE_EDIT_REPORT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=config'>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=config\"><B>"._ADMIN_CONFIG_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "config_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//		$db->del(TB_DOWNLOAD," id='".$_GET['id']."' ");
			$res['tem'] = $db->select_query("SELECT * FROM ".TB_TEMPLATES." WHERE sort='".$_GET['id']."' and temname='".$_GET['tem']."' ");
			$arr['tem'] = $db->fetch($res['tem']);
			$db->del(TB_TEMPLATES," sort='".$_GET['id']."' and temname='".$_GET['tem']."' "); 
		    $db->closedb ();
			@unlink("templates/".WEB_TEMPLATES."/images/config/".$arr['tem']['picname']."");

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_CONFIG_MESSAGE_DEL_REPORT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=config'>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=config\"><B>"._ADMIN_CONFIG_MESSAGE_GOBACK."</B></A>";
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

<?
CheckAdmin($admin_user, $admin_pwd);
include ("editor.php");
?>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<script language="javascript">
	function fncCreateElement(){
		
	   var mySpan = document.getElementById('mySpan');

	   // Create input file
	   var myElement2 = document.createElement('input');
	   myElement2.setAttribute('type',"file");
	   myElement2.setAttribute('name',"fileUpload[]");
	   myElement2.setAttribute('id',"fil");
	   mySpan.appendChild(myElement2);	
		
       // Create <br>
	   var myElement3 = document.createElement('br');
	   myElement3.setAttribute('id',"br");
	   mySpan.appendChild(myElement3);
	}

	function fncDeleteElement(){

		var mySpan = document.getElementById('mySpan');

			// Remove input file
			var deleteFile = document.getElementById("fil");
			mySpan.removeChild(deleteFile);

			// Remove <br>
			var deleteBr = document.getElementById("br");
			mySpan.removeChild(deleteBr);
	}
</script>
	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_gallery.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; GALLERY </B>
					<BR><BR>
					<A HREF="?name=admin&file=gallery"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_GALLERY_MENU_LIST;?> </A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=gallery&op=gallery_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_GALLERY_MENU_ADD_NEW;?> </A>  &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=gallery_category&op=gallerycat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_GALLERY_MENU_ADD_CAT;?></A><BR><BR>
<?
//////////////////////////////////////////// แสดงรายการGALLERY 
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 10 ;
	$SUMPAGE = $db->num_rows(TB_GALLERY_CAT,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <table width="100%" cellspacing="2" cellpadding="1" >

<?
$count=0;
$res['gallery'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT." ORDER BY id DESC LIMIT $goto, $limit ");
while($arr['gallery'] = $db->fetch($res['gallery'])){
	if ($count==0) { echo "<TR>"; }
	$res['category'] = $db->select_query("SELECT * FROM ".TB_GALLERY." WHERE category='".$arr['gallery']['id']."' order by rand() limit 1");
	$arr['category'] = $db->fetch($res['category']);

?>
     <td width="50%" valign="top">
	 <table>
	 <tr>
	 <td width="<?=_IGALLERYT_W;?>" valign="top">
	 			  						<table cellspacing=0 cellpadding=0 border=0 ><tr><td  height=14 border=0 background= "images/border/TL.gif"></td><td  height=14 border=0 background="images/border/TT.gif"></td><td height=14  border=0 background= "images/border/TR.gif"></td></tr>
<tr><td width=30 border=0 background= "images/border/LL.gif"></td><td  border=0><a href="?name=admin&file=gallery&op=gallery_detail&id=<? echo $arr['gallery']['id'];?>">
                <img class="highslide-display-block" width="<?=(_IGALLERYT_W-35);?>" src="<?if($arr['category']['id']){ echo "images/gallery/gal_".$arr['gallery']['post_date']."/thb_".$arr['category']['pic'].""; } else { echo "images/news_blank.gif";}?>" />
              </a></td><td width=14 border=0 background= "images/border/RR.gif"></td></tr>
			  <tr><td  height=15 border=0 background= images/border/BL.gif></td><td  height=15 border=0 background= "images/border/BB.gif"></td><td height=15 border=0 background= "images/border/BR.gif"></td></tr></table><br>
      <a href="?name=admin&file=gallery_category&op=gallerycat_edit&id=<? echo $arr['gallery']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=gallery_category&op=gallerycat_del&id=<? echo $arr['gallery']['id'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
</td>
<td valign="top">
<font color="#990000"><b><a href="?name=admin&file=gallery&op=gallery_detail&id=<? echo $arr['gallery']['id'];?>"><? echo $arr['gallery']['category_name'];?></b></font></a>  <?=NewsIcon(TIMESTAMP, $arr['gallery']['post_date'], "images/icon_new.gif");?><br> ( <?echo ThaiTimeConvert($arr['gallery']['post_date'],'','');?> )<br><? echo $arr['gallery']['category_detail'];?>
</td>
</tr>
</table>
</td>

<?
$count++;
if (($count%_GALLERYCAT_ADMIN_COL) == 0) { echo "</TR><TR><TD colspan=3 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
 else{
	echo "</TD>";
} 
}
?>

 </table>
<?
	SplitPage($page,$totalpage,"?name=admin&file=gallery");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "gallery_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
require("includes/class.resizepic.php");

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT." where id='".$_POST['CATEGORY']."' ORDER BY sort ");
$arr['category'] = $db->fetch($res['category']);
$CAT=$arr['category']['post_date'];
$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
$count = 0;
foreach ($_FILES['fileUpload']['error'] as $k => $error) {

			if($_FILES["fileUpload"]["name"][$k] != "")
			{
$size = getimagesize($_FILES["fileUpload"]['tmp_name'][$k]);
$widths = $size[0];
$heights = $size[1];
if ($widths*$heights > _IGALLERY_W*_IGALLERY_H) {
		$ProcessOutput .= "<center><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GALLERY_MESSAGE_LIMIT_WIDTH." ".$_FILES["fileUpload"]['name'][$k]." "._ADMIN_GALLERY_MESSAGE_LIMIT_WIDTH1." "._IGALLERY_W." x "._IGALLERY_H." px</B></FONT><BR><BR>";


} else if($_FILES["fileUpload"]['size'][$k] > _GALLERY_LIMIT_UPLOAD){
//	echo "$fileuploads['$i']['size']";
		$ProcessOutput .= "<center><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_LINK_PICTURE." ".$_FILES["fileUpload"]['name'][$k]." "._ADMIN_GALLERY_MESSAGE_LIMIT_SIZE." "._GALLERY_LIMIT_UPLOAD." kbyte</B></FONT><BR><BR>";


} else {
if (($_FILES["fileUpload"]['type'][$k]=='image/jpg') || ($_FILES["fileUpload"]['type'][$k]=='image/jpeg') || ($_FILES["fileUpload"]['type'][$k]=='image/pjpeg') || ($_FILES["fileUpload"]['type'][$k]=='image/JPG')){

//                move_uploaded_file($fileuploads['$i']['tmp_name'], "images/gallery/gal_".$CAT."/".$fileuploads['$i']['name'].""); 
               if ( $upload=copy($_FILES["fileUpload"]['tmp_name'][$k], "images/gallery/gal_".$CAT."/".$_FILES["fileUpload"]['name'][$k]."")) {
				$original_image = "images/gallery/gal_".$CAT."/".$_FILES["fileUpload"]['name'][$k];
				$width = _IGALLERYT_W ;
				$height = _IGALLERYT_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size[1]/$height;
					$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/gallery/gal_".$CAT."/thb_".$_FILES["fileUpload"]['name'][$k]."", "JPG");
	  	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_GALLERY,array(
			"category"=>"".$_POST['CATEGORY']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".TIMESTAMP."",
			"pic"=>"".$_FILES["fileUpload"]['name'][$k]."",
			"enable_comment"=>"1"
		));
		$db->closedb ();
                }else{
						$ProcessOutput .= "<BR><BR>";
                        $ProcessOutput .="<center><font color='red'>"._ADMIN_GALLERY_MESSAGE_NOUP." ".$_FILES["fileUpload"]['name'][$k]."  "._DOWNLOAD_MOD_ERROR2."</font></center><br>";

                }

				} else if (($_FILES["fileUpload"]['type'][$k]=='image/gif')){
               if ( $upload=copy($_FILES["fileUpload"]['tmp_name'][$k], "images/gallery/gal_".$CAT."/".$_FILES["fileUpload"]['name'][$k]."")) {
//                move_uploaded_file($fileuploads['$i']['tmp_name'], "images/gallery/gal_".$CAT."/".$fileuploads['$i']['name'].""); 
				$original_image = "images/gallery/gal_".$CAT."/".$_FILES["fileUpload"]['name'][$k];
				$width = _IGALLERYT_W ;
				$height = _IGALLERYT_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size[1]/$height;
					$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/gallery/gal_".$CAT."/thb_".$_FILES["fileUpload"]['name'][$k]."", "GIF");
	  	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_GALLERY,array(
			"category"=>"".$_POST['CATEGORY']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".TIMESTAMP."",
			"pic"=>"".$_FILES["fileUpload"]['name'][$k]."",
			"enable_comment"=>"1"
		));
		$db->closedb ();
                }else{
						$ProcessOutput .= "<BR><BR>";
                        $ProcessOutput .="<center><font color='red'>"._ADMIN_GALLERY_MESSAGE_NOUP." ".$_FILES["fileUpload"]['name'][$k]."  "._DOWNLOAD_MOD_ERROR2."</font></center><br>";
                }

				} else if (($_FILES["fileUpload"]['type'][$k]=='image/x-png')||($_FILES["fileUpload"]['type'][$k]=='image/png')){
               if ( $upload=copy($_FILES["fileUpload"]['tmp_name'][$k], "images/gallery/gal_".$CAT."/".$_FILES["fileUpload"]['name'][$k]."")) {
 //               move_uploaded_file($fileuploads['$i']['tmp_name'], "images/gallery/gal_".$CAT."/".$fileuploads['$i']['name'].""); 
				$original_image = "images/gallery/gal_".$CAT."/".$_FILES["fileUpload"]['name'][$k];
				$width = _IGALLERYT_W ;
				$height = _IGALLERYT_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
				$im=$size[1]/$height;
				$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/gallery/gal_".$CAT."/thb_".$_FILES["fileUpload"]['name'][$k]."", "PNG");
	  		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->add_db(TB_GALLERY,array(
			"category"=>"".$_POST['CATEGORY']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".TIMESTAMP."",
			"pic"=>"".$_FILES["fileUpload"]['name'][$k]."",
			"enable_comment"=>"1"
		));
			$db->closedb ();
                }else{
						$ProcessOutput .= "<BR><BR>";
                        $ProcessOutput .="<center><font color='red'>"._ADMIN_GALLERY_MESSAGE_NOUP." ".$_FILES["fileUpload"]['name'][$k]."  "._DOWNLOAD_MOD_ERROR2."</font><br>";
                }

}



}
}
$count ++;
}
		$ProcessOutput .= "<center><FONT COLOR=\"#336600\"><B>"._ADMIN_GALLERY_MESSAGE_UP_SUCCESS." ".$count."  "._ADMIN_GALLERY_MESSAGE_UP_SUCCESS1."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=gallery\"><B>"._ADMIN_GALLERY_MESSAGE_GOBACK." </B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	
		echo $ProcessOutput ;
		
}
else if($op == "gallery_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=gallery&op=gallery_add&action=add" enctype="multipart/form-data">
<center><table border=1 bgcolor=#F7F7F7 bordercolor=#FFFFFF width=450 class="grids"><tr class="odd"><td  align=center><?=_ADMIN_GALLERY_FORM_SELECT_CAT;?></td><td>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();

?>
</SELECT>
</td></tr>
<tr class="odd"><td  align=center valign="top"><?=_ADMIN_GALLERY_FORM_SELECT_PIC;?></td><td>
		<input type="file" name="fileUpload[]" width="80">
		<input name="btnCreate" type="button" value="+" onClick="JavaScript:fncCreateElement();">
		<input name="btnDelete" type="button" value="-" onClick="JavaScript:fncDeleteElement();"><br>	
		<span id="mySpan"></span>
<input name="btnSubmit" type="submit" value="<?=_ADMIN_GALLERY_FORM_BUTTON_ADD;?>" >
</td>
</tr>
</table>
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}

else if($op == "gallery_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_GALLERY," id='".$_GET['id']."' "); 
		$db->closedb ();
		if($_GET['pic'] !='0') {
		@unlink("images/gallery/gal_".$_GET['cat']."/".$_GET['pic']."");
		@unlink("images/gallery/gal_".$_GET['cat']."/thb_".$_GET['pic']."");
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GALLERY_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=gallery\"><B>"._ADMIN_GALLERY_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
	   echo "<meta http-equiv='refresh' content='0;url=?name=admin&file=gallery&op=gallery_detail&id=".$_GET['cats']."'>" ; 
}
else if($op == "gallery_detail"){
	//////////////////////////////////////////// ดูรายละเีอียดใน gallery
	if(CheckLevel($admin_user,$op)){

if($_GET['id']){
	$SQLwhere = " where id='".$_GET['id']."' ";
	$SQLwhere2 = " WHERE category='".$_GET['id']."' ";
}

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 15 ;
	$SUMPAGE = $db->num_rows(TB_GALLERY,"id"," category=".$_GET['id']."");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
	$res['cat'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT."  WHERE id='".$_GET['id']."' ");
$arr['cat'] = $db->fetch($res['cat']);
$CAT=$arr['cat']['post_date'];

?>
 <table width="100%" cellspacing="2" cellpadding="1" >
<tr>
<td bgcolor="#F7F7F7" colspan="<?=_GALLERY_ADMIN_COL;?>"><font color="#990000" size="4"><b> >> <? echo $arr['cat']['category_name'];?></b></font></a>  <?=NewsIcon(TIMESTAMP, $arr['cat']['post_date'], "images/icon_new.gif");?> ( <?echo ThaiTimeConvert($arr['cat']['post_date'],'','');?> ) <br><font size="3" color="#0066CC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ <?=_ADMIN_GALLERY_SHOW_TOTAL_PIC;?> <font color="#990000" size="3"><?=$SUMPAGE;?></font> <?=_ADMIN_GALLERY_SHOW_TOTAL_NUM;?> ] <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font size="2"><? echo $arr['cat']['category_detail'];?>
</font></td>
</tr>
<tr>
<td colspan="<?=_GALLERY_ADMIN_COL;?>">&nbsp;&nbsp;<td>
</tr>

<?

$count=0;
$res['gallery'] = $db->select_query("SELECT * FROM ".TB_GALLERY." WHERE category='".$arr['cat']['id']."' ORDER BY id DESC LIMIT $goto, $limit");
while($arr['gallery'] = $db->fetch($res['gallery'])){
	if ($count==0) { echo "<TR>"; }
?>
     <td valign="top" align="left">
	 <table cellpadding="0" cellspacing="0" border="0">
	 <tr>
	 <td width="<?=_IGALLERYT_W+35;?>" colspan="2" >
	 			  						<table cellspacing=0 cellpadding=0 border=0 class='iconframe' ><tr><td  border=0  align="center"><a HREF="images/gallery/<? echo "gal_".$CAT."/".$arr['gallery']['pic'];?>" rel="lightbox">
                <img class="highslide-display-block" border=0 src="<?if($arr['gallery']['id']){ echo "images/gallery/gal_".$CAT."/thb_".$arr['gallery']['pic'].""; } else { echo "images/news_blank.gif";}?>" />
              </a></td><td class='shadow_right'><div class='shadow_top_right'></div></td>
</tr>
<tr>
  <td class='shadow_bottom'><div class='shadow_bottom_left'></div></td>
  <td class='shadow_bottom_right'></td>
  </tr>
  </table>
</td>
</tr>
<tr>
<td align="right">
<a HREF="index.php?name=gallery&file=readgal&id=<?=$arr['gallery']['id'];?>" ><img src="images/icon-view.gif" border="0"></a> <? if($admin_user){?><a href="javascript:Confirm('?name=admin&file=gallery&op=gallery_del&cat=<? echo $CAT;?>&id=<? echo $arr['gallery']['id'];?>&pic=<? echo $arr['gallery']['pic'];?>&cats=<? echo $arr['cat']['id'];?>&prefix=<? echo $arr['gallery']['post_date'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a><?}?>
</td>
</tr>
<tr>
<td align="left"><?=_ADMIN_FORM_POSTED;?> <?=$arr['gallery']['posted'];?> (VIEW : <?=$arr['gallery']['pageview'];?>)<?=NewsIcon(TIMESTAMP, $arr['gallery']['post_date'], "images/icon_new.gif");?>
</td>
</tr>
</table>
</td>
<?
$count++;
if (($count%_GALLERY_ADMIN_COL) == 0) { echo "</TR><TR><TD colspan=5 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
 
}
echo "</table>";
	SplitPage($page,$totalpage,"?name=admin&file=gallery&op=gallery_detail&id=".$_GET['id']."");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;

	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}

}
?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>

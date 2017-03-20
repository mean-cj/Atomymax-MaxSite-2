<?php 
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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?php echo _ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?php echo _ADMIN_NEW_MENU_TITLE;?></B>
					<BR><BR>
					<A HREF="?name=admin&file=news"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?php echo _ADMIN_NEW_MENU_TITLE_ALL;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=news&op=news_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?php echo _ADMIN_NEW_MENU_TITLE_ADD_NEW;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=news_category"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle"><?php echo _ADMIN_MENU_DTAIL_CAT;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=news_category&op=newscat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"><?php echo _ADMIN_MENU_ADD_CAT;?></A><BR><BR>
<?php 
//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_NEWS,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=news&op=news_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="44"><CENTER><B>Option</B></CENTER></td>
   <td><CENTER><B><?php echo _ADMIN_TABLE_TITLE_TOPIC;?></B></CENTER></td>
   <td width="100"><CENTER><B><?php echo _ADMIN_TABLE_TITLE_POSTED;?></B></CENTER></td>
   <td width="40"><CENTER><B><?php echo _ADMIN_TABLE_TITLE_CAT;?></B></CENTER></td>
   <td width="40"><CENTER><B>Check</B></CENTER></td>
      <td width="40"><CENTER><B>Ran</B></CENTER></td>
  </tr>  
<?php 
$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['news'] = $db->fetch($res['news'])){
	$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." WHERE id='".$arr['news']['category']."' ");
	$arr['category'] = $db->fetch($res['category']);
	//Comment Icon
	if($arr['news']['enable_comment']){
		$CommentIcon = " <IMG SRC=\"images/icon/comments-icon.jpg\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_ALLOW_COMMENT."\">";
	}else{
		$CommentIcon = "";
	}
	if($arr['news']['pic']==1){
		$PicIcon = " <A HREF=icon/news_".$arr['news']['post_date'].".jpg class=\"highslide\" onclick=\"return hs.expand(this)\"><IMG SRC=\"images/preview.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_PICTURE."\"></a>";
	}else{
		$PicIcon = "";
	}
	if($arr['news']['attach'] !=''){
		$AttIcon = " <a href=attach/news_".$arr['news']['attach']."><IMG SRC=\"images/attach.gif\" WIDTH=\"8\" HEIGHT=\"13\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_FILE_ATT."\"></a>";
	}else{
		$AttIcon = "";
	}

if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
$res['ran'] = $db->select_query("SELECT * FROM ".TB_RANDOM." where rm_news='".$arr['news']['id']."' ");
$arr['ran'] = $db->fetch($res['ran']);
?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=news&op=news_edit&id=<?php echo $arr['news']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?php echo _ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=news&op=news_del&id=<?php echo $arr['news']['id'];?>&pic=<?php echo $arr['news']['pic'];?>&prefix=<?php echo $arr['news']['post_date'];?>','<?php echo _ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?php echo _ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><A HREF="?name=news&file=readnews&id=<?php echo  $arr['news']['id'];?>" target="_blank"><?php echo  $arr['news']['topic'];?></A><?php echo $CommentIcon;?><?php echo $PicIcon;?><?php echo $AttIcon;?><?php echo NewsIcon(TIMESTAMP, $arr['news']['post_date'], "images/icon_new.gif");?></td>
     <td ><CENTER><?php echo  ThaiTimeConvert($arr['news']['post_date'],'','');?></CENTER></td>
     <td align="center">
	 <?php if ($arr['category']['category_name']){ //หากมีหมวดแสดงรูป ?>
	 <A HREF="#"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle" alt="<?php echo  $arr['category']['category_name'];?>" onMouseOver="MM_displayStatusMsg('<?php echo  $arr['category']['category_name'];?>');return document.MM_returnValue"></A>
	 <?php } ?>
	 </td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<?php echo $arr['news']['id'];?>"></td>
     <td valign="top" align="center" width="40"><?php if  ($arr['news']['ran'] !=0){if ($arr['ran']['status']==0){?><a href="?name=admin&file=news&op=news_ran&id=<?php echo $arr['ran']['id'];?>&fix=up"><img src="images/publish_x.png" border="0" alt="<?php echo _ADMIN_STATUS_OPEN;?>" ></a><?php } else {?><a href="?name=admin&file=news&op=news_ran&id=<?php echo $arr['news']['id'];?>&fix=down"><img src="images/tick.png" border="0" alt="<?php echo _ADMIN_STATUS_CLOSE;?>" ></a><?php }  }else{ echo "<font color=#CC0000><b>NO</b></font>"; }?></td>
    </tr>

<?php 
	$count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="news_del">
 <input type="submit" class='btn btn-primary'  value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?php 
	SplitPage($page,$totalpage,"?name=admin&file=news");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "news_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
		require("includes/class.resizepic.php");
		$FILE = $_FILES['FILE'];
		$FILESS=$_FILES['FILESS'];
		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL'] ){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
$FILER = $_FILES['FILER'];
if (!empty($FILER['name'])){
	$size = getimagesize($FILER['tmp_name']);
	$widths = $size[0];
	$heights = $size[1];
	if ($widths*$heights > _IRAN_W*_IRAN_H) {
		if (($FILER['type']=='image/jpg') || ($FILER['type']=='image/jpeg') || ($FILER['type']=='image/pjpeg')){
			$upload=copy($FILER['tmp_name'], "icon/ranb_".$FILER['name']."");
//			@copy ($FILER['tmp_name'] , "icon/ran_".TIMESTAMP.".jpg" );
			$original_image = "icon/ranb_".$FILER['name']."" ;
			$desired_width = _IRAN_W ;
			$desired_height = _IRAN_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/ran_".$FILER['name']."", "JPG");
		} if (($FILER['type']=='image/gif')){
			$upload=copy($FILER['tmp_name'], "icon/ranb_".$FILER['name']."");
//			@copy ($FILER['tmp_name'] , "icon/ran_".TIMESTAMP.".jpg" );
			$original_image = "icon/ranb_".$FILER['name']."" ;
			$desired_width = _IRAN_W ;
			$desired_height = _IRAN_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/ran_".$FILER['name']."", "GIF");
		}if (($FILER['type']=='image/x-png')||($FILER['type']=='image/png')){
			$upload=copy($FILER['tmp_name'], "icon/ranb_".$FILER['name']."");
//			@copy ($FILER['tmp_name'] , "icon/ran_".TIMESTAMP.".jpg" );
			$original_image = "icon/ranb_".$FILER['name']."" ;
			$desired_width = _IRAN_W ;
			$desired_height = _IRAN_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/ran_".$FILER['name']."", "PNG");
		}
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['ran'] = $db->select_query("SELECT max(id) as MAX FROM ".TB_NEWS." ");
		$rows['ran'] = $db->fetch($res['ran']);
		$newID=$rows['ran']['MAX']+1;
		$db->add_db(TB_RANDOM,array(
			"rm_news"=>"".$newID."",
			"rm_image"=>"ran_".$FILER['name']."",
			"rm_topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"rm_detail"=>"".$_POST['HEADLINE']."",
			"rm_link"=>"".WEB_URL."/?name=news&amp;file=readnews&amp;id=".$newID."",
			"width"=>"".$widths."",
			"height"=>"".$heights."",
			"type"=>"".$FILER['type']."",
			"size"=>"".$FILER['size']."",
			"status"=>"1"
		));
		$db->closedb ();
	} else {
		$upload=copy($FILER['tmp_name'], "icon/ran_".$FILER['name']."");
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['ran'] = $db->select_query("SELECT max(id) as MAX FROM ".TB_NEWS." ");
		$rows['ran'] = $db->fetch($res['ran']);
		$newID=$rows['ran']['MAX']+1;
		$db->add_db(TB_RANDOM,array(
			"rm_news"=>"".$newID."",
			"rm_image"=>"ran_".$FILER['name']."",
			"rm_topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"rm_detail"=>"".$_POST['HEADLINE']."",
			"rm_link"=>"".WEB_URL."/index.php?name=news&amp;file=readnews&amp;id=".$newID."",
			"width"=>"".$widths."",
			"height"=>"".$heights."",
			"type"=>"".$FILER['type']."",
			"size"=>"".$FILER['size']."",
			"status"=>"1"
		));
		$db->closedb ();
	}
$ran='1';

$xml_bns = '<?xml version="1.0" encoding="utf-8"?>
<!-- Configuration panel -->
<banner width = "" height = ""
		startWith = "1" 
		random = "false"

		backgroundColor = "0xffffff" 
		backgroundTransparency = "100"
		
		cellWidth = "50"
		cellHeight = "50"
		
		showMinTime = "0.2"
		showMaxTime = "1.5"
		
		blur = "50"
		netTime = "0.5"
		alphaNet = "80"
		netColor = "0x000000"
		
		overColor = "0x473C31"
		normalColor = "0x000000"
		selectedTextColor = "0xffffff"
		
		selectedButtonAlpha = "70"
		
		controllerVisible = "true"
		controllerBackgroundVisible = "true"
		
		prevNextVisible = "true"
		playBtVisible = "true"
		autoPlay = "true"
		navigationButtonsColor = "0x1a1a1a"
		
		controllerDistanceX = "4"
		controllerDistanceY = "4"
		
		controllerHeight = "20"
		distanceBetweenControllerElements = "10"
		distanceBetweenThumbs = "3"
		
		itemNumberSize = "14"
		
		captionY = "2"
		captionX = "2"			
		
		captionWidth = "525"


		
		loaderColor = "0x000000">
<!-- End panel -->

';
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['ran'] = $db->select_query("SELECT * FROM ".TB_RANDOM." where status='1' ORDER BY id DESC limit 10");
//captionWidth = "525"
//captionWidth = "505"
while($arr['ran'] = $db->fetch($res['ran'])){
$rmbnimg			= "../../icon/".$arr['ran']['rm_image'];
$rmbnimg_arr		= explode("\n",$rmbnimg);
$rmbntopic			= $arr['ran']['rm_topic'];
$rmbntopic_arr		= explode("\n",$rmbntopic);
$rmbntext				= $arr['ran']['rm_detail'];
$rmbntext_arr		= explode("\n",$rmbntext);
$rmbnurl				=  $arr['ran']['rm_link'];
$rmbnurl_arr		= explode("\n",$rmbnurl);
if(ISO=='utf-8'){
$rmbntopic			= $arr['ran']['rm_topic'];
$rmbntopic_arr		= explode("\n",$rmbntopic);
$rmbntext				= $arr['ran']['rm_detail'];
$rmbntext_arr		= explode("\n",$rmbntext);
} else {
$rmbntopic		= tis620_to_utf8($arr['ran']['rm_topic']);
$rmbntopic_arr	= explode("\n",$rmbntopic);
$rmbntext			= tis620_to_utf8($arr['ran']['rm_detail']);
$rmbntext_arr	= explode("\n",$rmbntext);
}
foreach ($rmbnimg_arr  as $ib=>$curr_isrc) {
	$xml_bns .= '
	<item>
		<path>' . trim($curr_isrc) . '</path>
		<title><![CDATA[<font color="#990000">'. trim($rmbntopic_arr [$ib]) . '</font>]]></title>
		<caption><![CDATA[<font color="#000033">'. trim($rmbntext_arr [$ib]) . '</font>]]></caption>
		
		<target>_blank</target>
		<link>' . trim($rmbnurl_arr [$ib]) . '</link>
		
		<bar_color>0xffffff</bar_color>
		<bar_transparency>40</bar_transparency>
		
		<caption_color>0xffffff</caption_color>
		<caption_transparency>60</caption_transparency>
		
		<stroke_color>0xffffff</stroke_color>
		<stroke_transparency>40</stroke_transparency>
		
		<slideshowTime>10</slideshowTime>
	</item>

';
}

}

$xml_bns .= '</banner>';

$module_path = WEB_PATH;
$xml_data_filename = $module_path.'/modules/block/banner.xml';
$xml_prodgallery_file = fopen($xml_data_filename,'w');
fwrite($xml_prodgallery_file, $xml_bns);
fclose($xml_prodgallery_file);

} else{
$ran='0';
}

if ($FILE['name'] !='') {

		if (($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}else{
			@copy ($FILE['tmp_name'] , "icon/news_".TIMESTAMP.".jpg" );
			$original_image = "icon/news_".TIMESTAMP.".jpg" ;
			$desired_width = _INEWS_W ;
			$desired_height = _INEWS_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/news_".TIMESTAMP.".jpg", "JPG");
		}
	$pic='1';
} else {
	$pic='0';
}

if ($FILESS['name'] !='') {
		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_NEWS,array(
			"id"=>"".$newID."",
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"attach"=>"".TIMESTAMP."_".$FILESS['name']."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"ran"=>"".$ran.""
		));
		$db->closedb ();
	@copy ($FILESS['tmp_name'] , "attach/news_".TIMESTAMP."_".$FILESS['name']."");
} else {

		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_NEWS,array(
			"id"=>"".$newID."",
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"ran"=>"".$ran.""
		));
		$db->closedb ();
}

$data ='<?php xml version="1.0" encoding="'.$iso.'"?>'."\n";
$data .='<rss version="2.0">'."\n";
$data .='<channel>'."\n";

$data .='<title>'.WEB_TITILE.'</title>'."\n";
$data .='<description>'._ADMIN_NEW_MENU_TITLE.'</description>'."\n";
$data .='<link>'.WEB_URL.'</link>'."\n";
$data .='<lastBuildDate>'.date("D, d M Y H:i:s").'</lastBuildDate>'."\n";

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$listof= $db->select_query("SELECT * FROM ".TB_NEWS." where category='2' ORDER BY id desc limit 10");

while($result = $db->fetch($listof)) {
$timesdate=ThaiTimeConvert($result['post_date'],"1","");
	$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." WHERE id='".$result['category']."' ");
	$arr['category'] = $db->fetch($res['category']);

if($result['pic']==1){
$pics=''.WEB_URL.'/icon/news_'.$result['post_date'].'.jpg';
}else {
$pics=''.WEB_URL.'/images/icon/'.$arr['category']['icon'].'';
}
$data .='<item>'."\n"; 
$data .='<title>'.$result['topic'].'</title>'."\n"; 
$data .='<link>'.WEB_URL.'/?name=news&amp;file=readnews&amp;id='.$result['id'].'</link>'."\n"; 
$data .='<pic>'.WEB_URL.'/'.$pics.'</pic>'."\n";
$data .='<description>'.$result['headline'].'</description>'."\n";
$data .='<pubDate>'.$result['post_date'].'</pubDate>'."\n";
$data .='</item>'."\n"; 
}

$data .='</channel>'."\n";
$data .='</rss>'."\n";

$f = fopen( 'modules/rss/news.xml' , 'w' ); // 2 อ่านหมายเหตุของบรรทัดนี้ด้านล่าง
fputs( $f , $data );
fclose( $f );

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_NEW_MESSAGE_ADD."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=news\"><B>"._ADMIN_NEW_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=news'>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "news_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=news&op=news_add&action=add" enctype="multipart/form-data">
<B><?php echo _ADMIN_FORM_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="80">
<BR><BR>
<B><?php echo _ADMIN_FORM_CAT;?> :</B><BR>
<SELECT NAME="CATEGORY">
<?php 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?php echo _ADMIN_FORM_ICON;?> : </B><BR>
<IMG name="view01" SRC="images/news_blank.gif" <?php echo  " WIDTH=\""._INEWS_W."\" HEIGHT=\""._INEWS_H."\" ";?> BORDER="0" ><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?php echo _ADMIN_FORM_ICON_WIDTH;?> <?php echo  _INEWS_W." x "._INEWS_H ;?> <?php echo _ADMIN_FORM_ICON_WIDTH1;?>
<BR><BR>
<B><?php echo _ADMIN_FORM_HEADLINE;?> :</B><BR>
<textarea cols="100" rows="10"  name="HEADLINE" ></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'AdminBasic'});</script>
<BR><BR>

<B><?php echo _ADMIN_FORM_DETAIL;?> :</B><BR>

<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ></textarea>

<BR>
<B><?php echo _ADMIN_FORM_FILE_ATT;?> : </B><BR>
<input type="file" name="FILESS" onpropertychange="view01.src=FILESS.value;" style="width=250;">
<br>
<B><?php echo _ADMIN_NEW_ROTATOR_PIC;?> : </B><BR>
<input type="file" name="FILER" onpropertychange="view01.src=FILER.value;" style="width=250;"><BR>
<?php echo _ADMIN_FORM_ICON_WIDTH;?> <?php echo  _IRAN_W." x "._IRAN_H ;?> <?php echo _ADMIN_FORM_CAT_ICON_WIDTH;?>
<br>

<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1"> <?php echo _ADMIN_FORM_ALLOW_COMMENT;?>
<BR>
<input type="submit" class='btn btn-primary'  value="<?php echo _ADMIN_NEW_BUTTON_ADD;?>" name="submit"> <input type="reset" class='btn'  value="<?php echo _ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?php 
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "news_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){
		require("includes/class.resizepic.php");
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE id='".$_GET['id']."' ");
		$arr['news'] = $db->fetch($res['news']);
		$db->closedb ();

		$FILE = $_FILES['FILE'];
		$FILESS=$_FILES['FILESS'];
		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
$FILER = $_FILES['FILER'];
if ($FILER['name'] !=''){
	$size = getimagesize($FILER['tmp_name']);
	$widths = $size[0];
	$heights = $size[1];
	if ($widths*$heights > _IRAN_W*_IRAN_H) {
		if (($FILER['type']=='image/jpg') || ($FILER['type']=='image/jpeg') || ($FILER['type']=='image/pjpeg')){
			$upload=copy($FILER['tmp_name'], "icon/ranb_".$FILER['name']."");
//			@copy ($FILER['tmp_name'] , "icon/ran_".TIMESTAMP.".jpg" );
			$original_image = "icon/ranb_".$FILER['name']."" ;
			$desired_width = _IRAN_W ;
			$desired_height = _IRAN_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/ran_".$FILER['name']."", "JPG");
		} if (($FILER['type']=='image/gif')){
			$upload=copy($FILER['tmp_name'], "icon/ranb_".$FILER['name']."");
//			@copy ($FILER['tmp_name'] , "icon/ran_".TIMESTAMP.".jpg" );
			$original_image = "icon/ranb_".$FILER['name']."" ;
			$desired_width = _IRAN_W ;
			$desired_height = _IRAN_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/ran_".$FILER['name']."", "GIF");
		}if (($FILER['type']=='image/x-png')||($FILER['type']=='image/png')){
			$upload=copy($FILER['tmp_name'], "icon/ranb_".$FILER['name']."");
//			@copy ($FILER['tmp_name'] , "icon/ran_".TIMESTAMP.".jpg" );
			$original_image = "icon/ranb_".$FILER['name']."" ;
			$desired_width = _IRAN_W ;
			$desired_height = _IRAN_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/ran_".$FILER['name']."", "PNG");
		}
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['ran'] = $db->select_query("SELECT * FROM ".TB_RANDOM." where rm_news='".$_GET['id']."' ");
		$rows['ran'] = $db->fetch($res['ran']);
		$newID=$rows['ran']['id'];
		if ($newID !=''){
		$db->update_db(TB_RANDOM,array(
			"rm_image"=>"ran_".$FILER['name']."",
			"rm_topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"rm_detail"=>"".$_POST['HEADLINE']."",
			"rm_link"=>"".WEB_URL."/?name=news&amp;file=readnews&amp;id=".$_GET['id']."",
			"width"=>"".$widths."",
			"height"=>"".$heights."",
			"type"=>"".$FILER['type']."",
			"size"=>"".$FILER['size']."",
			"status"=>"1"
		)," rm_news=".$_GET['id']."");
		$db->closedb ();
		} else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_RANDOM,array(
			"rm_news"=>"".$_GET['id']."",
			"rm_image"=>"ran_".$FILER['name']."",
			"rm_topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"rm_detail"=>"".$_POST['HEADLINE']."",
			"rm_link"=>"".WEB_URL."/?name=news&amp;file=readnews&amp;id=".$_GET['id']."",
			"width"=>"".$widths."",
			"height"=>"".$heights."",
			"type"=>"".$FILER['type']."",
			"size"=>"".$FILER['size']."",
			"status"=>"1"
		));
		$db->closedb ();
		}
	} else {
		$upload=copy($FILER['tmp_name'], "icon/ran_".$FILER['name']."");
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['ran'] = $db->select_query("SELECT * FROM ".TB_RANDOM." where rm_news='".$_GET['id']."' ");
		$rows['ran'] = $db->fetch($res['ran']);
		$newID=$rows['ran']['id'];
		if ($newID !=''){
		$db->update_db(TB_RANDOM,array(
			"rm_image"=>"ran_".$FILER['name']."",
			"rm_topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"rm_detail"=>"".$_POST['HEADLINE']."",
			"rm_link"=>"".WEB_URL."/?name=news&amp;file=readnews&amp;id=".$_GET['id']."",
			"width"=>"".$widths."",
			"height"=>"".$heights."",
			"type"=>"".$FILER['type']."",
			"size"=>"".$FILER['size']."",
			"status"=>"1"
		)," rm_news=".$_GET['id']."");
		$db->closedb ();
		} else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_RANDOM,array(
			"rm_news"=>"".$_GET['id']."",
			"rm_image"=>"ran_".$FILER['name']."",
			"rm_topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"rm_detail"=>"".$_POST['HEADLINE']."",
			"rm_link"=>"".WEB_URL."/?name=news&amp;file=readnews&amp;id=".$_GET['id']."",
			"width"=>"".$widths."",
			"height"=>"".$heights."",
			"type"=>"".$FILER['type']."",
			"size"=>"".$FILER['size']."",
			"status"=>"1"
		));
		$db->closedb ();
		}

	}
$ran='1';

$xml_bns = '<?xml version="1.0" encoding="utf-8"?>
<!-- Configuration panel -->
<banner width = "" height = ""
		startWith = "1" 
		random = "false"

		backgroundColor = "0xffffff" 
		backgroundTransparency = "100"
		
		cellWidth = "50"
		cellHeight = "50"
		
		showMinTime = "0.2"
		showMaxTime = "1.5"
		
		blur = "50"
		netTime = "0.5"
		alphaNet = "80"
		netColor = "0x000000"
		
		overColor = "0x473C31"
		normalColor = "0x000000"
		selectedTextColor = "0xffffff"
		
		selectedButtonAlpha = "70"
		
		controllerVisible = "true"
		controllerBackgroundVisible = "true"
		
		prevNextVisible = "true"
		playBtVisible = "true"
		autoPlay = "true"
		navigationButtonsColor = "0x1a1a1a"
		
		controllerDistanceX = "4"
		controllerDistanceY = "4"
		
		controllerHeight = "20"
		distanceBetweenControllerElements = "10"
		distanceBetweenThumbs = "3"
		
		itemNumberSize = "14"
		
		captionY = "2"
		captionX = "2"			
		
		captionWidth = "525"


		
		loaderColor = "0x000000">
<!-- End panel -->

';
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['ran'] = $db->select_query("SELECT * FROM ".TB_RANDOM." where status='1' ORDER BY id DESC limit 10");
//captionWidth = "525"
//captionWidth = "505"
while($arr['ran'] = $db->fetch($res['ran'])){
$rmbnimg			= "../../icon/".$arr['ran']['rm_image'];
$rmbnimg_arr		= explode("\n",$rmbnimg);
$rmbntopic			= $arr['ran']['rm_topic'];
$rmbntopic_arr		= explode("\n",$rmbntopic);
$rmbntext				= $arr['ran']['rm_detail'];
$rmbntext_arr		= explode("\n",$rmbntext);
$rmbnurl				=  $arr['ran']['rm_link'];
$rmbnurl_arr		= explode("\n",$rmbnurl);
if(ISO=='utf-8'){
$rmbntopic			= $arr['ran']['rm_topic'];
$rmbntopic_arr		= explode("\n",$rmbntopic);
$rmbntext				= $arr['ran']['rm_detail'];
$rmbntext_arr		= explode("\n",$rmbntext);
} else {
$rmbntopic		= tis620_to_utf8($arr['ran']['rm_topic']);
$rmbntopic_arr	= explode("\n",$rmbntopic);
$rmbntext			= tis620_to_utf8($arr['ran']['rm_detail']);
$rmbntext_arr	= explode("\n",$rmbntext);
}
foreach ($rmbnimg_arr  as $ib=>$curr_isrc) {
	$xml_bns .= '
	<item>
		<path>' . trim($curr_isrc) . '</path>
		<title><![CDATA[<font color="#990000">'. trim($rmbntopic_arr [$ib]) . '</font>]]></title>
		<caption><![CDATA[<font color="#000033">'. trim($rmbntext_arr [$ib]) . '</font>]]></caption>
		
		<target>_blank</target>
		<link>' . trim($rmbnurl_arr [$ib]) . '</link>
		
		<bar_color>0xffffff</bar_color>
		<bar_transparency>40</bar_transparency>
		
		<caption_color>0xffffff</caption_color>
		<caption_transparency>60</caption_transparency>
		
		<stroke_color>0xffffff</stroke_color>
		<stroke_transparency>40</stroke_transparency>
		
		<slideshowTime>10</slideshowTime>
	</item>

';
}

}

$xml_bns .= '</banner>';

$module_path = WEB_PATH;
$xml_data_filename = $module_path.'/modules/block/banner.xml';
$xml_prodgallery_file = fopen($xml_data_filename,'w');
fwrite($xml_prodgallery_file, $xml_bns);
fclose($xml_prodgallery_file);


} else{
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['ran'] = $db->select_query("SELECT id FROM ".TB_NEWS." where id='".$_GET['id']."' ");
		$rows['ran'] = $db->fetch($res['ran']);
		if ($rows['ran']['ran']==1){
		$ran='1';
		}else {
		$ran='0';
		}
}

if ($FILE['name'] !='') {

		if ((($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")) AND $FILE['size']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
			@copy ($FILE['tmp_name'] , "icon/news_".$arr['news']['post_date'].".jpg" );
			$original_image = "icon/news_".$arr['news']['post_date'].".jpg" ;
			$desired_width = _INEWS_W ;
			$desired_height = _INEWS_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/news_".$arr['news']['post_date'].".jpg", "JPG");
	$pic='1';
} else {
	if($arr['news']['pic'] ==1){
	$pic='1';} else {
	$pic='0';
	}
}
if ($FILESS['name'] !='') {
		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_NEWS,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".$arr['news']['post_date']."",
			"update_date"=>"".$arr['news']['post_date']."",
			"attach"=>"".$arr['news']['post_date']."_".$FILESS['name']."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"ran"=>"".$ran.""
		)," id=".$_GET['id']."");
		$db->closedb ();
	@copy ($FILESS['tmp_name'] , "attach/news_".$arr['news']['post_date']."_".$FILESS['name']."");
} else {

		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_NEWS,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"update_date"=>"".$arr['news']['post_date']."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"ran"=>"".$ran.""
		)," id=".$_GET['id']."");
		$db->closedb ();
}

$data ='<?php xml version="1.0" encoding="'.$iso.'"?>'."\n";
$data .='<rss version="2.0">'."\n";
$data .='<channel>'."\n";

$data .='<title>'.WEB_TITILE.'</title>'."\n";
$data .='<description>'._ADMIN_NEW_MENU_TITLE.'</description>'."\n";
$data .='<link>'.WEB_URL.'</link>'."\n";
$data .='<lastBuildDate>'.date("D, d M Y H:i:s").'</lastBuildDate>'."\n";

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$listof= $db->select_query("SELECT * FROM ".TB_NEWS." where category='2' ORDER BY id desc limit 10");

while($result = $db->fetch($listof)) {
$timesdate=ThaiTimeConvert($result['post_date'],"1","");
	$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." WHERE id='".$result['category']."' ");
	$arr['category'] = $db->fetch($res['category']);

if($result['pic']==1){
$pics=''.WEB_URL.'/icon/news_'.$result['post_date'].'.jpg';
}else {
$pics=''.WEB_URL.'/images/icon/'.$arr['category']['icon'].'';
}
$data .='<item>'."\n"; 
$data .='<title>'.$result['topic'].'</title>'."\n"; 
$data .='<link>'.WEB_URL.'/?name=news&amp;file=readnews&amp;id='.$result['id'].'</link>'."\n"; 
$data .='<pic>'.$pics.'</pic>'."\n";
$data .='<description>'.$result['headline'].'</description>'."\n";
$data .='<pubDate>'.$result['post_date'].'</pubDate>'."\n";
$data .='</item>'."\n"; 
}

$data .='</channel>'."\n";
$data .='</rss>'."\n";

$f = fopen( 'modules/rss/news.xml' , 'w' ); // 2 อ่านหมายเหตุของบรรทัดนี้ด้านล่าง
fputs( $f , $data );
fclose( $f );

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_NEW_MESSAGE_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=news\"><B>"._ADMIN_NEW_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
//		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=news'>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "news_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE id='".$_GET['id']."' ");
		$arr['news'] = $db->fetch($res['news']);

		$TextContent = $arr['news']['detail'];
		$TextContent = stripslashes($TextContent);
		$HEADLINE = $arr['news']['headline'];
		$HEADLINE= stripslashes($HEADLINE);
		$db->closedb ();
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=news&op=news_edit&action=edit&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
<B><?php echo _ADMIN_FORM_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="80" value="<?php echo $arr['news']['topic'];?>">
<BR><BR>
<B><?php echo _ADMIN_FORM_CAT;?> :</B><BR>
<SELECT NAME="CATEGORY">
<?php 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   if($arr['category']['id'] == $arr['news']['category']){echo " Selected";}
	   echo ">".$arr['category']['category_name']."</option>";
	   $icons=$arr['category']['icon'];
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?php echo _ADMIN_FORM_ICON;?> : </B><BR>
<?php 
	if ($arr['news']['pic'] !=0){?>
<IMG name="view01" SRC="icon/news_<?php echo $arr['news']['post_date'];?>.jpg" <?php echo  " WIDTH=\""._INEWS_W."\" HEIGHT=\""._INEWS_H."\" ";?> BORDER="0" >
<?php }  else {?>
<IMG name="view01" SRC="images/news_blank.gif" <?php echo  " WIDTH=\""._INEWS_W."\" HEIGHT=\""._INEWS_H."\" ";?> BORDER="0" >
<?php 
	}
?>
<BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?php echo _ADMIN_FORM_ICON_WIDTH;?> <?php echo  _INEWS_W." x "._INEWS_H ;?> <?php echo _ADMIN_FORM_ICON_WIDTH1;?>
<BR><BR>
<B><?php echo _ADMIN_FORM_HEADLINE;?> :</B><BR>
<textarea cols="100" rows="10" name="HEADLINE" ><?php echo $HEADLINE;?></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'AdminBasic'});</script>
<BR><BR>


<B><?php echo _ADMIN_FORM_DETAIL;?> :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ><?php echo $TextContent;?></textarea>
<br>
<B><?php echo _ADMIN_FORM_FILE_ATT;?> : </B><BR>
<input type="file" name="FILESS" onpropertychange="view01.src=FILESS.value;" style="width=250;">
<br>
<B><?php echo _ADMIN_NEW_ROTATOR_PIC;?> : </B><BR>
<input type="file" name="FILER" onpropertychange="view01.src=FILER.value;" style="width=250;"><BR>
<?php echo _ADMIN_FORM_ICON_WIDTH;?> <?php echo  _IRAN_W." x "._IRAN_H ;?> <?php echo _ADMIN_FORM_CAT_ICON_WIDTH;?>
<br>
<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1" <?php if ($arr['news']['enable_comment']){echo " Checked";};?>> <?php echo _ADMIN_FORM_ALLOW_COMMENT;?>
<BR>
<input type="submit" class='btn btn-primary'  value="<?php echo _ADMIN_NEW_BUTTON_EDIT;?>" name="submit"> <input type="reset" class='btn'  value="<?php echo _ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?php 
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}

}
else if($op == "news_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE id='".$value."' ");
			$arr['news'] = $db->fetch($res['news']);

			if ($arr['news']['ran']==1){
			$res['ran'] = $db->select_query("SELECT * FROM ".TB_RANDOM." WHERE rm_news='".$arr['news']['id']."' ");
			$arr['ran'] = $db->fetch($res['ran']);
			@unlink("icon/".$arr['ran']['rm_images']."");
			$db->del(TB_RANDOM," rm_news='".$arr['news']['id']."' ");
$xml_bns = '<?xml version="1.0" encoding="utf-8"?>
<!-- Configuration panel -->
<banner width = "" height = ""
		startWith = "1" 
		random = "false"

		backgroundColor = "0xffffff" 
		backgroundTransparency = "100"
		
		cellWidth = "50"
		cellHeight = "50"
		
		showMinTime = "0.2"
		showMaxTime = "1.5"
		
		blur = "50"
		netTime = "0.5"
		alphaNet = "80"
		netColor = "0x000000"
		
		overColor = "0x473C31"
		normalColor = "0x000000"
		selectedTextColor = "0xffffff"
		
		selectedButtonAlpha = "70"
		
		controllerVisible = "true"
		controllerBackgroundVisible = "true"
		
		prevNextVisible = "true"
		playBtVisible = "true"
		autoPlay = "true"
		navigationButtonsColor = "0x1a1a1a"
		
		controllerDistanceX = "4"
		controllerDistanceY = "4"
		
		controllerHeight = "20"
		distanceBetweenControllerElements = "10"
		distanceBetweenThumbs = "3"
		
		itemNumberSize = "14"
		
		captionY = "2"
		captionX = "2"			
		
		captionWidth = "525"


		
		loaderColor = "0x000000">
<!-- End panel -->

';
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['ran'] = $db->select_query("SELECT * FROM ".TB_RANDOM." where status='1' ORDER BY id DESC limit 10");
//captionWidth = "525"
//captionWidth = "505"
while($arr['ran'] = $db->fetch($res['ran'])){
$rmbnimg			= "../../icon/".$arr['ran']['rm_image'];
$rmbnimg_arr		= explode("\n",$rmbnimg);
$rmbntopic			= $arr['ran']['rm_topic'];
$rmbntopic_arr		= explode("\n",$rmbntopic);
$rmbntext				= $arr['ran']['rm_detail'];
$rmbntext_arr		= explode("\n",$rmbntext);
$rmbnurl				=  $arr['ran']['rm_link'];
$rmbnurl_arr		= explode("\n",$rmbnurl);
if(ISO=='utf-8'){
$rmbntopic			= $arr['ran']['rm_topic'];
$rmbntopic_arr		= explode("\n",$rmbntopic);
$rmbntext				= $arr['ran']['rm_detail'];
$rmbntext_arr		= explode("\n",$rmbntext);
} else {
$rmbntopic		= tis620_to_utf8($arr['ran']['rm_topic']);
$rmbntopic_arr	= explode("\n",$rmbntopic);
$rmbntext			= tis620_to_utf8($arr['ran']['rm_detail']);
$rmbntext_arr	= explode("\n",$rmbntext);
}
foreach ($rmbnimg_arr  as $ib=>$curr_isrc) {
	$xml_bns .= '
	<item>
		<path>' . trim($curr_isrc) . '</path>
		<title><![CDATA[<font color="#990000">'. trim($rmbntopic_arr [$ib]) . '</font>]]></title>
		<caption><![CDATA[<font color="#000033">'. trim($rmbntext_arr [$ib]) . '</font>]]></caption>
		
		<target>_blank</target>
		<link>' . trim($rmbnurl_arr [$ib]) . '</link>
		
		<bar_color>0xffffff</bar_color>
		<bar_transparency>40</bar_transparency>
		
		<caption_color>0xffffff</caption_color>
		<caption_transparency>60</caption_transparency>
		
		<stroke_color>0xffffff</stroke_color>
		<stroke_transparency>40</stroke_transparency>
		
		<slideshowTime>10</slideshowTime>
	</item>

';
}

}

$xml_bns .= '</banner>';

$module_path = WEB_PATH;
$xml_data_filename = $module_path.'/modules/block/banner.xml';
$xml_prodgallery_file = fopen($xml_data_filename,'w');
fwrite($xml_prodgallery_file, $xml_bns);
fclose($xml_prodgallery_file);

			}

			$db->del(TB_NEWS," id='".$value."' "); 
			$db->closedb ();
			@unlink("icon/news_".$arr['news']['post_date'].".jpg");


		}
$data ='<?php xml version="1.0" encoding="'.$iso.'"?>'."\n";
$data .='<rss version="2.0">'."\n";
$data .='<channel>'."\n";

$data .='<title>'.WEB_TITILE.'</title>'."\n";
$data .='<description>'._ADMIN_NEW_MENU_TITLE.'</description>'."\n";
$data .='<link>'.WEB_URL.'</link>'."\n";
$data .='<lastBuildDate>'.date("D, d M Y H:i:s").'</lastBuildDate>'."\n";

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$listof= $db->select_query("SELECT * FROM ".TB_NEWS." where category='2' ORDER BY id desc limit 10");

while($result = $db->fetch($listof)) {
$timesdate=ThaiTimeConvert($result['post_date'],"1","");
	$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." WHERE id='".$result['category']."' ");
	$arr['category'] = $db->fetch($res['category']);

if($result['pic']==1){
$pics=''.WEB_URL.'/icon/news_'.$result['post_date'].'.jpg';
}else {
$pics=''.WEB_URL.'/images/icon/'.$arr['category']['icon'].'';
}
$data .='<item>'."\n"; 
$data .='<title>'.$result['topic'].'</title>'."\n"; 
$data .='<link>'.WEB_URL.'/?name=news&amp;file=readnews&amp;id='.$result['id'].'</link>'."\n"; 
$data .='<pic>'.$pics.'</pic>'."\n";
$data .='<description>'.$result['headline'].'</description>'."\n";
$data .='<pubDate>'.$result['post_date'].'</pubDate>'."\n";
$data .='</item>'."\n"; 
}

$data .='</channel>'."\n";
$data .='</rss>'."\n";

$f = fopen( 'modules/rss/news.xml' , 'w' ); // 2 อ่านหมายเหตุของบรรทัดนี้ด้านล่าง
fputs( $f , $data );
fclose( $f );
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_NEW_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=news\"><B>"._ADMIN_NEW_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "news_ran"){
	///////////////////////////////////////////

if($_GET['fix']=='up'){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_RANDOM,array(
			"status"=>"1"
		)," rm_news=".$_GET['id']."");
		$db->closedb ();
}
if($_GET['fix']=='down'){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_RANDOM,array(
			"status"=>"0"
		)," rm_news=".$_GET['id']."");
		$db->closedb ();
}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_NEW_MESSAGE_EDIT_RAN."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=news\"><B>"._ADMIN_NEW_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=news'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}
else if($op == "news_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['new'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE id='".$_GET['id']."' ");
		$arr['new'] = $db->fetch($res['new']);
		if ($arr['new']['ran']==1){
		$res['ran'] = $db->select_query("SELECT * FROM ".TB_RANDOM." WHERE rm_news='".$_GET['id']."' ");
		$arr['ran'] = $db->fetch($res['ran']);
		@unlink("icon/".$arr['ran']['rm_images']."");
		$db->del(TB_RANDOM," rm_news='".$_GET['id']."' ");

$xml_bns = '<?xml version="1.0" encoding="utf-8"?>
<!-- Configuration panel -->
<banner width = "" height = ""
		startWith = "1" 
		random = "false"

		backgroundColor = "0xffffff" 
		backgroundTransparency = "100"
		
		cellWidth = "50"
		cellHeight = "50"
		
		showMinTime = "0.2"
		showMaxTime = "1.5"
		
		blur = "50"
		netTime = "0.5"
		alphaNet = "80"
		netColor = "0x000000"
		
		overColor = "0x473C31"
		normalColor = "0x000000"
		selectedTextColor = "0xffffff"
		
		selectedButtonAlpha = "70"
		
		controllerVisible = "true"
		controllerBackgroundVisible = "true"
		
		prevNextVisible = "true"
		playBtVisible = "true"
		autoPlay = "true"
		navigationButtonsColor = "0x1a1a1a"
		
		controllerDistanceX = "4"
		controllerDistanceY = "4"
		
		controllerHeight = "20"
		distanceBetweenControllerElements = "10"
		distanceBetweenThumbs = "3"
		
		itemNumberSize = "14"
		
		captionY = "2"
		captionX = "2"			
		
		captionWidth = "525"


		
		loaderColor = "0x000000">
<!-- End panel -->

';
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['ran'] = $db->select_query("SELECT * FROM ".TB_RANDOM." where status='1' ORDER BY id DESC limit 10");
//captionWidth = "525"
//captionWidth = "505"
while($arr['ran'] = $db->fetch($res['ran'])){
$rmbnimg			= "../../icon/".$arr['ran']['rm_image'];
$rmbnimg_arr		= explode("\n",$rmbnimg);
$rmbntopic			= $arr['ran']['rm_topic'];
$rmbntopic_arr		= explode("\n",$rmbntopic);
$rmbntext				= $arr['ran']['rm_detail'];
$rmbntext_arr		= explode("\n",$rmbntext);
$rmbnurl				=  $arr['ran']['rm_link'];
$rmbnurl_arr		= explode("\n",$rmbnurl);
if(ISO=='utf-8'){
$rmbntopic			= $arr['ran']['rm_topic'];
$rmbntopic_arr		= explode("\n",$rmbntopic);
$rmbntext				= $arr['ran']['rm_detail'];
$rmbntext_arr		= explode("\n",$rmbntext);
} else {
$rmbntopic		= tis620_to_utf8($arr['ran']['rm_topic']);
$rmbntopic_arr	= explode("\n",$rmbntopic);
$rmbntext			= tis620_to_utf8($arr['ran']['rm_detail']);
$rmbntext_arr	= explode("\n",$rmbntext);
}
foreach ($rmbnimg_arr  as $ib=>$curr_isrc) {
	$xml_bns .= '
	<item>
		<path>' . trim($curr_isrc) . '</path>
		<title><![CDATA[<font color="#990000">'. trim($rmbntopic_arr [$ib]) . '</font>]]></title>
		<caption><![CDATA[<font color="#000033">'. trim($rmbntext_arr [$ib]) . '</font>]]></caption>
		
		<target>_blank</target>
		<link>' . trim($rmbnurl_arr [$ib]) . '</link>
		
		<bar_color>0xffffff</bar_color>
		<bar_transparency>40</bar_transparency>
		
		<caption_color>0xffffff</caption_color>
		<caption_transparency>60</caption_transparency>
		
		<stroke_color>0xffffff</stroke_color>
		<stroke_transparency>40</stroke_transparency>
		
		<slideshowTime>10</slideshowTime>
	</item>

';
}

}

$xml_bns .= '</banner>';

$module_path = WEB_PATH;
$xml_data_filename = $module_path.'/modules/block/banner.xml';
$xml_prodgallery_file = fopen($xml_data_filename,'w');
fwrite($xml_prodgallery_file, $xml_bns);
fclose($xml_prodgallery_file);

		}
		$db->del(TB_NEWS," id='".$_GET['id']."' "); 
		$db->closedb ();
		if($_GET['pic'] !='0') {
		@unlink("icon/news_".$_GET['prefix'].".jpg");
		}
$data ='<?php xml version="1.0" encoding="'.$iso.'"?>'."\n";
$data .='<rss version="2.0">'."\n";
$data .='<channel>'."\n";

$data .='<title>'.WEB_TITILE.'</title>'."\n";
$data .='<description>'._ADMIN_NEW_MENU_TITLE.'</description>'."\n";
$data .='<link>'.WEB_URL.'</link>'."\n";
$data .='<lastBuildDate>'.date("D, d M Y H:i:s").'</lastBuildDate>'."\n";

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$listof= $db->select_query("SELECT * FROM ".TB_NEWS." where category='2' ORDER BY id desc limit 10");

while($result = $db->fetch($listof)) {
$timesdate=ThaiTimeConvert($result['post_date'],"1","");
	$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." WHERE id='".$result['category']."' ");
	$arr['category'] = $db->fetch($res['category']);

if($result['pic']==1){
$pics=''.WEB_URL.'/icon/news_'.$result['post_date'].'.jpg';
}else {
$pics=''.WEB_URL.'/images/icon/'.$arr['category']['icon'].'';
}
$data .='<item>'."\n"; 
$data .='<title>'.$result['topic'].'</title>'."\n"; 
$data .='<link>'.WEB_URL.'/?name=news&amp;file=readnews&amp;id='.$result['id'].'</link>'."\n"; 
$data .='<pic>'.$pics.'</pic>'."\n";
$data .='<description>'.$result['headline'].'</description>'."\n";
$data .='<pubDate>'.$result['post_date'].'</pubDate>'."\n";
$data .='</item>'."\n"; 
}

$data .='</channel>'."\n";
$data .='</rss>'."\n";

$f = fopen( 'modules/rss/news.xml' , 'w' ); // 2 อ่านหมายเหตุของบรรทัดนี้ด้านล่าง
fputs( $f , $data );
fclose( $f );
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_NEW_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=news\"><B>"._ADMIN_NEW_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=news'>";
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

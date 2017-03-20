<?php 
CheckAdmin($admin_user, $admin_pwd);
include ("editor.php");
?>
<script  type="text/javascript" src="modules/admin/uploadify/jquery-1.4.2.min.js"></script>
<link href="modules/admin/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="modules/admin/uploadify/swfobject.js"></script>
<script type="text/javascript" src="modules/admin/uploadify/jquery.uploadify.v2.1.4.js"></script>


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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?php  echo _ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; video </B>
					<BR><BR>
					<A HREF="?name=admin&file=video"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?php  echo _VIDEO_MOD_MENU_MAIN;?> </A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video&op=video_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?php  echo _ADMIN_VIDEO_MENU_ADD_NEW_FILE;?> </A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video_youtube"><IMG SRC="images/admin/7_40.gif"  BORDER="0" align="absmiddle"> <?php  echo _ADMIN_VIDEO_MENU_ADD_NEW_YOUTUBE;?>  </A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video_category"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle"> <?php  echo _ADMIN_MENU_DTAIL_CAT;?></A>  &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video_category&op=videocat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?php  echo _ADMIN_MENU_ADD_CAT;?></A><BR><BR>
<?php 
//////////////////////////////////////////// แสดงรายการvideo 
if($op == ""){
	
	$limit = 10 ;
	$SUMPAGE = $db->num_rows(TB_VIDEO_CAT,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=video&op=video_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="44"><CENTER><B>Option</B></CENTER></td>
  <td width="100"><CENTER><B>thumbs</B></CENTER></td>
   <td><CENTER><B><?php  echo _ADMIN_FORM_TOPIC;?></B></CENTER></td>
   <td width="100"><CENTER><B><?php  echo _ADMIN_TABLE_TITLE_POSTED;?></B></CENTER></td>
   <td width="40"><CENTER><B><?php  echo _ADMIN_TABLE_TITLE_CAT;?></B></CENTER></td>
   <td width="40"><CENTER><B>Check</B></CENTER></td>
  </tr>  
<?php 
$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['video'] = $db->fetch($res['video'])){
	$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." WHERE id='".$arr['video']['category']."' ");
	$arr['category'] = $db->fetch($res['category']);
	$content = $arr['video']['detail'];
	$Detail = stripslashes(FixQuotes($content));
if($arr['video']['youtube']==1){
$durationx=timeyoutube($arr['video']['times']);
} else {
$durationx = $arr['video']['times'];
}
	//Comment Icon
	if($arr['video']['enable_comment']){
		$CommentIcon = " <IMG SRC=\"images/icon/comments-icon.jpg\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_ALLOW_COMMENT."\">";
	}else{
		$CommentIcon = "";
	}
	if($arr['video']['youtube']!=1){
	if($arr['video']['pic']){
		$PicIcon = " <A HREF=video/thumbs/".$arr['video']['pic']." class=\"highslide\" onclick=\"return hs.expand(this)\"><IMG SRC=\"images/preview.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_PICTURE."\"></a>";
	}else{
		$PicIcon = "";
	}
	}else {
		$PicIcon = " <A HREF=http://img.youtube.com/vi/".$arr['video']['video']."/default.jpg class=\"highslide\" onclick=\"return hs.expand(this)\"><IMG SRC=\"images/preview.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_PICTURE."\"></a>";
	}

if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
	$videoid=$arr['video']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(video_id) as com FROM ".TB_VIDEO_COMMENT." WHERE video_id ='".$videoid."' group by video_id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>
    <tr <?php  echo $ColorFill; ?> >
     <td width="44" valign="top">
<?php 
if ($arr['video']['youtube']!=1){
	?>
      <a href="?name=admin&file=video&op=video_edit&id=<?php  echo $arr['video']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?php  echo _ADMIN_BUTTON_EDIT;?>" ></a> 
<?php 
} else {
?>
      <a href="?name=admin&file=video_youtube&op=video_edit&id=<?php  echo $arr['video']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?php  echo _ADMIN_BUTTON_EDIT;?>" ></a> 
	  <?php 
	}
if ($arr['video']['youtube']!=1){
	?>
      <a href="javascript:Confirm('?name=admin&file=video&op=video_del&id=<?php  echo $arr['video']['id'];?>&pic=<?php  echo $arr['video']['pic'];?>&prefix=<?php  echo $arr['video']['post_date'];?>','<?php  echo _ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?php  echo _ADMIN_BUTTON_DEL;?>" ></a>
<?php 
} else {
?>
      <a href="javascript:Confirm('?name=admin&file=video_youtube&op=video_del&id=<?php  echo $arr['video']['id'];?>&prefix=<?php  echo $arr['video']['post_date'];?>','<?php  echo _ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?php  echo _ADMIN_BUTTON_DEL;?>" ></a>
	  <?php 
	}
	  ?>
     </td> 
     <td valign="top" align="center" width="40">
<div class="photomini" >
<a HREF="index.php?name=video&file=readvideo&id=<?php  echo $arr['video']['id'];?>" ><span></span><img src="<?php if ($arr['video']['youtube']!=1){ if ($arr['video']['pic']){echo "video/thumbs/".$arr['video']['pic'].""; } else{ echo "images/video_blank.gif";} }else { echo "http://img.youtube.com/vi/".$arr['video']['video']."/default.jpg";}?>" width="<?php  echo _IVIDEOT_W/2;?>" height="<?php  echo _IVIDEOT_H/2;?>"></a>
<div class="photominix"><?php  echo $durationx;?></div>
															</div>
</td>
     <td valign="top"><A HREF="?name=video&file=readvideo&id=<?php  echo $arr['video']['id'];?>" target="_blank"><?php  echo $arr['video']['topic'];?></A><?php  echo $CommentIcon;?><?php  echo $PicIcon;?><?php  echo NewsIcon(TIMESTAMP, $arr['video']['post_date'], "images/icon_new.gif");?>( <?php  echo $arr['video']['pageview'];?> / <?php  echo $arrs['com']['com'];?> )<br><?php  echo $Detail;?> <A HREF="?name=video&file=readvideo&id=<?php  echo $arr['video']['id'];?>" ><font color="#0066FF"><?php  echo _BLOG_NEXT;?></font></a></td>
     <td valign="top"><CENTER><?php  echo ThaiTimeConvert($arr['video']['post_date'],'','');?></CENTER></td>
     <td align="center" valign="top">
	 <?php if($arr['category']['category_name']){ //หากมีหมวดแสดงรูป ?>
	 <A HREF="#"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle" alt="<?php  echo $arr['category']['category_name'];?>" onMouseOver="MM_displayStatusMsg('<?php  echo $arr['category']['category_name'];?>');return document.MM_returnValue"></A>
	 <?php  } ?>
	 </td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<?php  echo $arr['video']['id'];?>"></td>
    </tr>

<?php 
	$count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" class="btn btn-success btn-success-iefix" name="CheckAll"  value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" class="btn btn-warning btn-warning-iefix" name="UnCheckAll"  value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="video_del">
 <input type="submit" class="btn btn-danger btn-danger-iefix" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?php 
	SplitPage($page,$totalpage,"?name=admin&file=video");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "video_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
require("includes/class.resizepic.php");

$topic=$_POST['topic'];
$detail=$_POST['detail'];

	  	
		$db->update_db(TB_VIDEO,array(
			"category"=>"".$_POST['cat']."",
			"topic"=>"".$topic."",
			"detail"=>"".$detail."",
		), " id=".$_GET['id']."" );
		


		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_CONFIG_MESSAGE_EDIT_REPORT." </B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=video\"><B>"._ADMIN_VIDEO_MESSAGE_GOBACK." </B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
		echo $ProcessOutput ;
}
else if($op == "video_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<script type="text/javascript">
$(document).ready(function() {
  //      var topics = $("input[name='topic']").val();         
//		var details = $("textarea[name='detail']").val();         
//		var data = {topic:topics, detail:details}; 

  $('#file_upload').uploadify({
    'uploader'  : 'modules/admin/uploadify/uploadify.swf',
//    'script'    : 'modules/admin/uploadify/uploadify.php',
     'script' : 'modules/admin/uploadify/uploadify.php',
    'cancelImg' : 'modules/admin/uploadify/cancel.png',
    'folder'    : '<?php  echo ""._VIDEOS_DIR_PATH."";?>',
    'auto'      : true,
	'removeCompleted' : false,
	'multi'		: false,
	'fileExt'     : '*.mpg;*.mpeg;*.avi;*.divx;*.MP4;*.flv;*.wmv;*.RM;*.mov;*.moov;*.asf;*.swf',
	'fileDesc'	: 'We accept video files only!',
	'checkScript': 'modules/admin/uploadify/check.php',
	'displayData': 'speed',
	'scriptData':{'session_id':'<?php  echo session_id(); ?>'},
	'simUploadLimit': 1,
	'sizeLimit'      : '<?php  echo ""._VIDEO_LIMIT_UPLOAD."";?>',//max size bytes - kb
	 'method'        :       'post',
	 'onComplete': function (evt, queueID, fileObj, response, data) {
		$("#topic").append("<input type='hidden' name='topic' id='topic' value='" + topic + "' />");
		$("#detail").append("<textarea>'"+ detail + "'</textarea>");  
			 },
	'onSelect'      : function(event,ID,fileObj) {            
		 $('#file_upload').uploadifySettings('scriptData',{topic:$('#topic').val(),cat:$('#CATEGORY').val(),admin:$('#admin').val(),detail:$('#detail').val()});   
	},
'onError': function (event, queueID ,fileObj, errorObj) {
var msg;
if (errorObj.status == 404) {
alert('Could not find upload script. Use a path relative to:');
msg = 'Could not find upload script.';
alert(msg);
} else if (errorObj.type === "HTTP"){
msg = errorObj.type+": "+errorObj.status;
alert(msg);
}else if (errorObj.type ==="File Size"){
msg = fileObj.name;
alert(''+errorObj.type+' Limit: '+Math.round(errorObj.sizeLimit/1024)+'KB');
}else{
msg = errorObj.type+": "+errorObj.text;
alert(msg);
return false;
}
},
	'onAllComplete' : function(event,data) { alert(data.filesUploaded + ' <?php  echo _ADMIN_VIDEO_JAVA_UP_VIDEO_SUC;?> !' );}
  });
   });
</script>
<script type="text/javascript">
$(document).ready(function() {
  $('#fileupload').uploadify({
    'uploader'  : 'modules/admin/uploadify/uploadify.swf',
//    'script'    : 'modules/admin/uploadify/uploadify.php',
     'script' : 'modules/admin/uploadify/uploadify.php',
    'cancelImg' : 'modules/admin/uploadify/cancel.png',
    'folder'    : '<?php  echo ""._THUMBS_DIR_PATH."";?>',
    'auto'      : true,
	'removeCompleted' : false,
	'multi'		: false,
	'fileExt'     : '*.JPG;*.jpg;*.jpeg;*.png;*.gif', 
	'fileDesc'	: 'We accept images files only!',
	'checkScript': 'modules/admin/uploadify/check.php',
	'displayData': 'speed',
	'simUploadLimit': 1,
'scriptData':{'session_id':'<?php  echo session_id(); ?>'},
	 'method'        :       'post',
	 'onComplete': function (evt, queueID, fileObj, response, data) {
		 var imgURL = '<?php  echo ""._THUMBS_DIR_PATH."";?>' + response ;
		$("#topic").append("<input type='hidden' name='topic' id='topic' value='" + topic + "' />");
		$("#detail").append("<textarea>'"+ detail + "'</textarea>");  
			 },
	'onSelect'      : function(event,ID,fileObj) {            
		 $('#fileupload').uploadifySettings('scriptData',{topic:$('#topic').val(),cat:$('#CATEGORY').val(),admin:$('#admin').val(),detail:$('#detail').val()});
	},
'onError': function (event, queueID ,fileObj, errorObj) {
var msg;
if (errorObj.status == 404) {
alert('Could not find upload script. Use a path relative to:');
msg = 'Could not find upload script.';
alert(msg);
} else if (errorObj.type === "HTTP"){
msg = errorObj.type+": "+errorObj.status;
alert(msg);
}else{
msg = errorObj.type+": "+errorObj.text;
alert(msg);
return false;
}
},
	'onAllComplete' : function(event,data) { 
		alert(data.filesUploaded + ' <?php  echo _ADMIN_VIDEO_JAVA_UP_PIC_SUC;?> ! ' );
		}
  });
});
</script>

<FORM NAME="myform" METHOD="POST" enctype="multipart/form-data" >
<center><table border="1" bgcolor="#F7F7F7" bordercolor="#FFFFFF" width="650" class="grids"><tr><td  align="right" width="100"><?php  echo _ADMIN_VIDEO_FORM_SELECT_CAT;?></td><td>
<SELECT id="CATEGORY" NAME="CATEGORY" onchange="javascript:$('#file_upload').uploadifySettings('scriptData',{'cat':$('#CATGORY').val()});">
<?php 

$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}


?>
</SELECT>
</td></tr>
<tr><td  align="right" width="100" valign="top"><?php  echo _ADMIN_VIDEO_FORM_TOPIC;?></td><td>
<INPUT id="topic" TYPE="text" NAME="topic" size="40">
</td>
</tr>
<tr><td align="right" width="100" valign="top"><?php  echo _ADMIN_VIDEO_FORM_DETAIL;?></td><td>
<textarea cols="80" rows="10"  name="detail" id="detail"></textarea>
</td>
</tr>

<tr><td  align="right" width="100" valign="top"><?php  echo _ADMIN_VIDEO_FORM_THUMBS;?></td><td>
    	<input id="fileupload" name="fileupload" type="file" />
		<a href="javascript:$('#fileupload').uploadifyUpload();">Upload Files</a> | <a href="javascript:$('#fileupload').uploadifyClearQueue();">Clear Queue</a><br><font color="#990000">[ <?php  echo _ADMIN_VIDEO_FORM_THUMBS_COM;?> <?php  echo _IVIDEOT_W;?> x <?php  echo _IVIDEOT_H;?> px]</font>
</td>
</tr>
<tr><td align="right" width="100"  valign="top"><?php  echo _ADMIN_VIDEO_FORM_VIDEO;?></td><td>
    	<input id="file_upload" name="file_upload" type="file" />
		<a href="javascript:$('#file_upload').uploadifyUpload();">Upload Files</a> | <a href="javascript:$('#file_upload').uploadifyClearQueue();">Clear Queue</a><br><font color="#990000">[ <?php  echo _ADMIN_VIDEO_FORM_VIDEO_COM;?> <?php  echo getfilesize(_VIDEO_LIMIT_UPLOAD);?> <?php  echo _ADMIN_VIDEO_FORM_VIDEO_COM1;?>]</font>
</td>
</tr>
</table>
<INPUT id="admin" TYPE="hidden" NAME="admin" size="40" value="<?php  echo $_SESSION['admin_user'];?>">

</FORM>
<BR><BR>
<?php 
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "video_edit"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<script type="text/javascript">
$(document).ready(function() {
  //      var topics = $("input[name='topic']").val();         
//		var details = $("textarea[name='detail']").val();         
//		var data = {topic:topics, detail:details}; 
  $('#file_upload').uploadify({
    'uploader'  : 'modules/admin/uploadify/uploadify.swf',
//    'script'    : 'modules/admin/uploadify/uploadify.php',
     'script' : 'modules/admin/uploadify/uploadify.php',
    'cancelImg' : 'modules/admin/uploadify/cancel.png',
    'folder'    : '<?php  echo ""._VIDEOS_DIR_PATH."";?>',
    'auto'      : true,
	'removeCompleted' : false,
	'multi'		: false,
	'fileExt'     : '*.mpg;*.mpeg;*.avi;*.divx;*.MP4;*.flv;*.wmv;*.RM;*.mov;*.moov;*.asf;*.swf',
	'fileDesc'	: 'We accept video files only!',
	'checkScript': 'modules/admin/uploadify/check.php',
	'displayData': 'speed',
'scriptData':{'session_id':'<?php  echo session_id(); ?>'},
	'simUploadLimit': 1,
	'sizeLimit'      : '<?php  echo ""._VIDEO_LIMIT_UPLOAD."";?>',//max size bytes - kb
	 'method'        :       'post',
	 'onComplete': function (evt, queueID, fileObj, response, data) {
		$("#topic").append("<input type='hidden' name='topic' id='topic' value='" + topic + "' />");
		$("#detail").append("<textarea>'"+ detail + "'</textarea>");  
		$("#id").append("<input type='hidden' name='id' id='id' value='" + id + "' ");  
			 },
	'onSelect'      : function(event,ID,fileObj) {            
		 $('#file_upload').uploadifySettings('scriptData',{topic:$('#topic').val(),id:$('#id').val(),cat:$('#CATEGORY').val(),admin:$('#admin').val(),detail:$('#detail').val()});   
	},
'onError': function (event, queueID ,fileObj, errorObj) {
var msg;
if (errorObj.status == 404) {
alert('Could not find upload script. Use a path relative to:');
msg = 'Could not find upload script.';
alert(msg);
} else if (errorObj.type === "HTTP"){
msg = errorObj.type+": "+errorObj.status;
alert(msg);
}else if (errorObj.type ==="File Size"){
msg = fileObj.name;
alert(''+errorObj.type+' Limit: '+Math.round(errorObj.sizeLimit/1024)+'KB');
}else{
msg = errorObj.type+": "+errorObj.text;
alert(msg);
return false;
}
},
	'onAllComplete' : function(event,data) { alert(data.filesUploaded + ' <?php  echo _ADMIN_VIDEO_JAVA_UP_VIDEO_SUC;?> !' );}
  });
   });
</script>
<script type="text/javascript">
$(document).ready(function() {
  $('#fileupload').uploadify({
    'uploader'  : 'modules/admin/uploadify/uploadify.swf',
//    'script'    : 'modules/admin/uploadify/uploadify.php',
     'script' : 'modules/admin/uploadify/uploadify.php',
    'cancelImg' : 'modules/admin/uploadify/cancel.png',
    'folder'    : '<?php  echo ""._THUMBS_DIR_PATH."";?>',
    'auto'      : true,
	'removeCompleted' : false,
	'multi'		: false,
	'fileExt'     : '*.JPG;*.jpg;*.jpeg;*.png;*.gif', 
	'fileDesc'	: 'We accept images files only!',
	'checkScript': 'modules/admin/uploadify/check.php',
	'displayData': 'speed',
'scriptData':{'session_id':'<?php  echo session_id(); ?>'},
	'simUploadLimit': 1,
	 'method'        :       'post',
	 'onComplete': function (evt, queueID, fileObj, response, data) {
		 var imgURL = '<?php  echo ""._THUMBS_DIR_PATH."";?>' + response ;
		$("#topic").append("<input type='hidden' name='topic' id='topic' value='" + topic + "' />");
		$("#detail").append("<textarea>'"+ detail + "'</textarea>");
		$("#id").append("<input type='hidden' name='id' id='id' value='" + id + "' ");  
			 },
	'onSelect'      : function(event,ID,fileObj) {            
		 $('#fileupload').uploadifySettings('scriptData',{topic:$('#topic').val(),id:$('#id').val(),cat:$('#CATEGORY').val(),admin:$('#admin').val(),detail:$('#detail').val()});
	},
'onError': function (event, queueID ,fileObj, errorObj) {
var msg;
if (errorObj.status == 404) {
alert('Could not find upload script. Use a path relative to:');
msg = 'Could not find upload script.';
alert(msg);
} else if (errorObj.type === "HTTP"){
msg = errorObj.type+": "+errorObj.status;
alert(msg);
}else{
msg = errorObj.type+": "+errorObj.text;
alert(msg);
return false;
}
},
	'onAllComplete' : function(event,data) { 
		alert(data.filesUploaded + ' <?php  echo _ADMIN_VIDEO_JAVA_UP_PIC_SUC;?> ! ' );
		}
  });
});
</script>

<FORM NAME="myform" METHOD=POST enctype="multipart/form-data" ACTION="?name=admin&file=video&op=video_edit&action=edit&id=<?php  echo $_GET['id'];?>">
<center><table border=1 bgcolor=#F7F7F7 bordercolor=#FFFFFF width=650 class="grids"><tr><td  align="right" width="100"><?php  echo _ADMIN_VIDEO_FORM_SELECT_CAT;?></td><td>
<SELECT id="CATEGORY" NAME="CATEGORY" onchange="javascript:$('#file_upload').uploadifySettings('scriptData',{'cat':$('#CATGORY').val()});">
<?php 

$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." where id='".$_GET['id']."' ");
$arr['video'] = $db->fetch($res['video']);
		$TextContent = $arr['video']['detail'];
		$TextContent = stripslashes($TextContent);
		$HEADLINE = $arr['video']['topic'];
		$HEADLINE= stripslashes($HEADLINE);


$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}


?>
</SELECT>
</td></tr>
<tr><td  align="right" width="100" valign="top"><?php  echo _ADMIN_VIDEO_FORM_TOPIC;?></td><td>
<INPUT id="topic" TYPE="text" NAME="topic" size="40" value=<?php  echo $HEADLINE;?>>
</td>
</tr>
<tr><td align="right" width="100" valign="top"><?php  echo _ADMIN_VIDEO_FORM_DETAIL;?></td><td>
<textarea cols="80" rows="10"  name="detail" id="detail" ><?php  echo $TextContent;?></textarea>
</td>
</tr>

<tr><td  align="right" width="100" valign="top"><?php  echo _ADMIN_VIDEO_FORM_THUMBS;?></td><td>
    	<input id="fileupload" name="fileupload" type="file" />
		<a href="javascript:$('#fileupload').uploadifyUpload();">Upload Files</a> | <a href="javascript:$('#fileupload').uploadifyClearQueue();">Clear Queue</a><br><font color="#990000">[ <?php  echo _ADMIN_VIDEO_FORM_THUMBS_COM;?> <?php  echo _IVIDEOT_W;?> x <?php  echo _IVIDEOT_H;?> px]</font>
</td>
</tr>
<tr><td align="right" width="100"  valign="top"><?php  echo _ADMIN_VIDEO_FORM_VIDEO;?></td><td>
    	<input id="file_upload" name="file_upload" type="file" />
		<a href="javascript:$('#file_upload').uploadifyUpload();">Upload Files</a> | <a href="javascript:$('#file_upload').uploadifyClearQueue();">Clear Queue</a><br><font color="#990000">[ <?php  echo _ADMIN_VIDEO_FORM_VIDEO_COM;?> <?php  echo getfilesize(_VIDEO_LIMIT_UPLOAD);?> <?php  echo _ADMIN_VIDEO_FORM_VIDEO_COM1;?>]</font>
</td>
</tr>
</table>
<input type='hidden' name='id' id='id' value="<?php  echo $_GET['id'];?>" />
<INPUT id="admin" TYPE="hidden" NAME="admin" size="40" value="<?php  echo $_SESSION['admin_user'];?>">
<INPUT type="submit" class="btn btn-primary btn-primary-iefix"  value="video edit" > 
</FORM>
<BR><BR>
<?php 
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "video_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			
			$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." WHERE id='".$value."' ");
			$arr['video'] = $db->fetch($res['video']);

			$db->del(TB_VIDEO," id='".$value."' "); 
			
			if ($arr['video']['pic'] !=''){
			@unlink("video/thumbs/".$arr['video']['pic']."");
			}
			if ($arr['video']['video'] !=''){
			@unlink("video/".$arr['video']['video']."");
			}
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_VIDEO_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=video\"><B>"._ADMIN_VIDEO_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "video_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
			
			$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." WHERE id='".$_GET['id']."' ");
			$arr['video'] = $db->fetch($res['video']);
			$db->del(TB_VIDEO," id='".$_GET['id']."' "); 
			
			if ($arr['video']['pic'] !=''){
			@unlink("video/thumbs/".$arr['video']['pic']."");
			}
			if ($arr['video']['video'] !=''){
			@unlink("video/".$arr['video']['video']."");
			}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_VIDEO_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=video\"><B>"._ADMIN_VIDEO_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
	   echo "<meta http-equiv='refresh' content='0;url=?name=admin&file=video'>" ; 
}
else if($op == "video_detail"){
	//////////////////////////////////////////// ดูรายละเีอียดใน video
	if(CheckLevel($admin_user,$op)){

if($_GET['id']){
	$SQLwhere = " where id='".$_GET['id']."' ";
	$SQLwhere2 = " WHERE category='".$_GET['id']."' ";
}

	
	$limit = 15 ;
	$SUMPAGE = $db->num_rows(TB_VIDEO,"id"," category=".$_GET['id']."");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
	$res['cat'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT."  WHERE id='".$_GET['id']."' ");
$arr['cat'] = $db->fetch($res['cat']);
$CAT=$arr['cat']['post_date'];

?>
 <table width="100%" cellspacing="2" cellpadding="1" >
<tr>
<td bgcolor="#F7F7F7" colspan="<?php  echo _VIDEO_ADMIN_COL;?>"><font color="#990000" size="4"><b> >> <?php  echo $arr['cat']['category_name'];?></b></font></a>  <?php  echo NewsIcon(TIMESTAMP, $arr['cat']['post_date'], "images/icon_new.gif");?> ( <?php  echo ThaiTimeConvert($arr['cat']['post_date'],'','');?> ) <br><font size="3" color="#0066CC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ <?php  echo _ADMIN_VIDEO_VIDEO_ALL;?> <font color="#990000" size="3"><?php  echo $SUMPAGE;?></font> video ] <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font size="2"><?php  echo $arr['cat']['category_detail'];?>
</font></td>
</tr>
<tr>
<td colspan="<?php  echo _VIDEO_ADMIN_COL;?>">&nbsp;&nbsp;<td>
</tr>

<?php 

$count=0;
$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." WHERE category='".$arr['cat']['id']."' ORDER BY id DESC LIMIT $goto, $limit");
while($arr['video'] = $db->fetch($res['video'])){
	if ($count==0) { echo "<TR>"; }
?>
     <td valign="top" align="left">
	 <table cellpadding="0" cellspacing="0" border="0">
	 <tr>
	 <td width="<?php  echo _IVIDEOT_W+35;?>" colspan="2" >
	 			  						<table cellspacing=0 cellpadding=0 border=0 class='iconframe' ><tr><td  border=0  align="center"><a HREF="index.php?name=video&file=readvideo&id=<?php  echo $arr['video']['id'];?>" ><img src="<?php if ($arr['video']['pic']){echo "video/thumbs/".$arr['video']['pic'].""; } else { echo "images/video_blank.gif";}?>"></a>
</td><td class='shadow_right'><div class='shadow_top_right'></div></td>
</tr>
<tr>
  <td class='shadow_bottom'><div class='shadow_bottom_left'></div></td>
  <td class='shadow_bottom_right'></td>
  </tr>
  </table>
</td>
</tr>
<tr>
<td align="left"><a HREF="index.php?name=video&file=readvideo&id=<?php  echo $arr['video']['id'];?>" ><?php  echo $arr['video']['detail'];?></a>
</td>
</tr>
<tr>
<td align="left">
<a HREF="index.php?name=video&file=readvideo&id=<?php  echo $arr['video']['id'];?>" ><img src="images/icon-view.gif" border="0"></a> <?php  if($admin_user){?><a href="javascript:Confirm('?name=admin&file=video&op=video_del&cat=<?php  echo $CAT;?>&id=<?php  echo $arr['video']['id'];?>&pic=<?php  echo $arr['video']['pic'];?>&cats=<?php  echo $arr['cat']['id'];?>&prefix=<?php  echo $arr['video']['post_date'];?>','<?php  echo _ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?php  echo _ADMIN_BUTTON_DEL;?>" ></a><?php }?>
</td>
</tr>
<tr>
<td align="left"><?php  echo _ADMIN_FORM_POSTED;?> <?php  echo $arr['video']['posted'];?> (VIEW : <?php  echo $arr['video']['pageview'];?>)<?php  echo NewsIcon(TIMESTAMP, $arr['video']['post_date'], "images/icon_new.gif");?>
</td>
</tr>
</table>
</td>
<?php 
$count++;
if (($count%_VIDEO_ADMIN_COL) == 0) { echo "</TR><TR><TD colspan=5 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
 
}
echo "</table>";
	SplitPage($page,$totalpage,"?name=admin&file=video");
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


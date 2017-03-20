<?include ("editor.php");?>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<script language="javascript"> 
<!-- 
var state = 'none'; 

function showhide(layer_ref) { 

if (state == 'block') { 
state = 'none'; 
} 
else { 
state = 'block'; 
} 
if (document.all) { //IS IE 4 or 5 (or 6 beta) 
eval( "document.all." + layer_ref + ".style.display = state"); 
} 
if (document.layers) { //IS NETSCAPE 4 or below 
document.layers['layer_ref'].display = state; 
} 
if (document.getElementById &&!document.all) { 
hza = document.getElementById(layer_ref); 
hza.style.display = state; 
} 
} 
//--> 
</script> 

<?
if ($_GET['s_page']){
$s_pagex=$_GET['s_page'];
} else {
$s_pagex=0;
}
$_GET['id'] = intval($_GET['id']);
//ดึงข้อมูลกระทู้ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$VIEWBOARD = $db->fetch($db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id = '".$_GET['id']."' "));
$db->closedb ();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$VIEWBOARDMENT = $db->fetch($db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE topic_id = '".$_GET['id']."' "));
$db->closedb ();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$boardcategory = $db->fetch($db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." WHERE id = '".$VIEWBOARD['category']."' "));
$db->closedb ();
if($_SESSION['login_true']){
CheckWebboard($login_true, $_SESSION['pwd_login'],$VIEWBOARD['category']);
} else if($_SESSION['admin_user']){
CheckWebboard($admin_user, $admin_pwd,$VIEWBOARD['category']);
} else {
CheckWebboard('', '',$VIEWBOARD['category']);
}
//กรณีไม่มีรายการกระทู้ 
NotTrueAlert($VIEWBOARD['id'], "3", ""._WEBBOARD_READ_NO_TOPIC."");

	//แสดงผลกระทู้ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 9 ;
$SUMPAGE = $db->num_rows(TB_WEBBOARD_COMMENT,"id","topic_id = '".$_GET['id']."'");

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=1) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

if($action == "comment"){
	//Check data
	if(!$_POST['topic'] OR !$_POST['detail'] OR !$_POST['post_name'] OR !$_GET['id']){
		echo "<script language='javascript'>" ;
		echo "alert('"._JAVA_DATA_NULL."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
 if($login_true || $admin_user){
} else {
	if(USE_CAPCHA){
check_captcha($_POST['security_code']);
	}
}
	//เช็คแบนโฆษณา
	$TOPIC=checkban($_POST['topic']);
	$DETAIL=banword($_POST['detail']);
	$POSTNAME=CheckRude($_POST['post_name']);
	if (substr_count($_POST['detail'],'<p>') == 1) {   
		$temp = preg_replace("/<p>/i","",$_POST['detail']);   
		$temp = preg_replace("/<\/p>/i","",$temp);   
		$_POST['detail'] = $temp; 
	} 

	//Check Pic Size
	$FILE = $_FILES['FILE'];
	$FILEATT = $_FILES['FILEATT'];
	if ( $FILE['size'] > _WEBBOARD_LIMIT_UPLOAD ) {
		echo "<script language='javascript'>" ;
		echo "alert('". _WEBBOARD_EDIT_ADD_PIC_WIDTH." ".(_WEBBOARD_LIMIT_UPLOAD/1024)." kB "._WEBBOARD_EDIT_ADD_PIC_WIDTH."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
	if ( $FILEATT['size'] > _WEBBOARD_LIMIT_UPLOADS ) {
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_EDIT_ADD_FILE_SIZE." ".(_WEBBOARD_LIMIT_UPLOADS/1024)." kB "._WEBBOARD_EDIT_ADD_FILE_SIZE1.
			"')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
		if ($FILEATT['name'] !=''){
	$info = strrchr( $FILEATT['name'] , '.' );
	if ( ($info =='.pdf') ||($info =='.doc') ||($info =='.xls') ||($info =='.ppt') ||($info =='.docx') ||($info =='.xlsx') ||($info =='.pptx')||($info =='.zip' ) ||($info =='.ZIP' )) {}else{
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_MESS_TPYE_FILE_NOACC." .doc , .xls , .ppt , .pdf , .zip  "._WEBBOARD_MESS_TPYE_FILE_NOACC1."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
	}
	//แป
	//แปลงนามสกุล และทำการ upload
	if ( $FILE['type'] == "image/gif" )
			{$Filename = TIMESTAMP.".gif";}
	else if ( $FILE['type'] == "image/x-png" )
			{$Filename = TIMESTAMP.".png";}
	else if ( $FILE['type'] == "image/png" )
			{$Filename = TIMESTAMP.".png";}
	else if (($FILE['type']=="image/jpg")||($FILE['type']=="image/jpeg")||($FILE['type']=="image/pjpeg"))
			{$Filename = TIMESTAMP.".jpg";}
	@copy ($FILE['tmp_name'] , "webboard_upload/".$Filename."" );
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
if($admin_user){$ISMembers ="1";
$update_post = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$admin_user."'");
$dbarr = $db->fetch($update_post);
$post = $dbarr['post']+1;
$db->update_db(TB_MEMBER,array(
			"post"=>"$post"
		)," user='".$admin_user."' ");
} else if($login_true){
$ISMembers = '1';
$update_post = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$login_true."'");
$dbarr = $db->fetch($update_post);
$post = $dbarr['post']+1;
$db->update_db(TB_MEMBER,array(
			"post"=>"$post"
		)," user='".$login_true."' ");
}else{$ISMembers = "0";}
	//Add Topic
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	if (!empty($FILEATT['name'])){
	$db->add_db(TB_WEBBOARD_COMMENT,array(
		"topic_id"=>"".$_GET['id']."",
		"detail"=>"".$_POST['detail']."",
		"picture"=>"".$Filename."",
		"post_name"=>"".htmlspecialchars($_POST['post_name'])."",
		"is_member"=>"".$ISMembers."",
		"ip_address"=>"".$IPADDRESS."",
		"post_date"=>"".TIMESTAMP."",
		"att"=>"".TIMESTAMP."_".$FILEATT['name'].""
	)); 
@copy ($FILEATT['tmp_name'] , "webboard_upload/".TIMESTAMP."_".$FILEATT['name']);
	} else {
	$db->add_db(TB_WEBBOARD_COMMENT,array(
		"topic_id"=>"".$_GET['id']."",
		"detail"=>"".$_POST['detail']."",
		"picture"=>"".$Filename."",
		"post_name"=>"".htmlspecialchars($_POST['post_name'])."",
		"is_member"=>"".$ISMembers."",
		"ip_address"=>"".$IPADDRESS."",
		"post_date"=>"".TIMESTAMP."",
	)); 
	}
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_WEBBOARD,array(
			"post_update"=>"".TIMESTAMP.""
		)," id='".$_GET['id']."' ");
		$db->closedb ();
	$PostComplete = True ;
}

//จำนวนคนเข้าชม
$PAGEVIEW = $VIEWBOARD['pageview']+1 ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update(TB_WEBBOARD," pageview='$PAGEVIEW' "," id='".$_GET['id']."' ");
$db->closedb ();
?>
<script type="text/javascript">
function showemotion() {
	emotion1.style.display = 'none';
	emotion2.style.display = '';
}
function closeemotion() {
	emotion1.style.display = '';
	emotion2.style.display = 'none';
}

function emoticon(theSmilie) {

	document.form2.detail.value += ' ' + theSmilie + ' ';
	document.form2.detail.focus();
}
</script>

    <TABLE cellSpacing=0 cellPadding=0 width=750 border=0 bgcolor=#FFFFFF>
      <TBODY>
        <TR>
          <TD vAlign=top><BR>
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_webboard.gif" BORDER="0"></td>
		  </tr>
				<TR>
					<TD height="1" class="dotline"><br>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" >
			<tr>
						<td width="24%" align="right"><? echo "<a href=\"#div1\" onclick=\"showhide('div1');\"><img src='images/webboard/reply.png'  hspace='2' vspace='5' border='0' /></a><a href='index.php?name=webboard&amp;file=post&category=".$boardcategory['id']."'><img src='images/webboard/post.png' hspace='2' vspace='5'  border='0' /></a>" ; ?></td>
			</td>
			</tr>
            <tr><td width="76%" height="30">&nbsp;&nbsp;&nbsp;<a href="index.php?name=webboard"><font size='2' color="#FF6600"><?=_WEBBOARD_MENU_TITLE;?> </font></a><font size="1" color="#000000">&gt;&gt; </font><a href="?name=webboard&file=board&category=<?=$boardcategory['id'];?>"><font size="2" color="#FF6600"><?=$boardcategory['category_name'];?>
            </font></a> <font size="1" color="#000000">&gt;&gt; </font><BR></td>
		    </tr>
            <tr>
              <td height="50" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="89%"><img src="images/icon/icon-sk-05[1].gif" width="40" height="31" hspace="5" vspace="5" align="absmiddle" /><font color="#990000" size="2"><b>
                    <?=$VIEWBOARD['topic'];?>&nbsp;
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$Comm = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where topic_id='".$VIEWBOARD['id']."' ORDER BY id DESC  LIMIT $goto, $limit ");
	$Comms = $db->fetch($Comm);
	if($Comms['id']){
	UpdateIcon(TIMESTAMP, $Comms['post_date'], "images/icon/update.gif");
	}else{
	NewsIcon(TIMESTAMP, $VIEWBOARD['post_date'], "images/icon_new.gif");
	 };
	 ?>
                  </b></font></td>
                  <td width="11%"><font size="2" color="#339900"><b>VIEW :
                        <?=$VIEWBOARD['pageview'];?>
                  </b></font>&nbsp;&nbsp;&nbsp;</td>
                </tr>
              </table>              </td>
		    </tr>
          </table>
<?
//แสดงผลการPost 
if(!empty($PostComplete)){
	//Complete
?>
<BR><BR>
<TABLE width=90% align=center>
<TR>
	<TD><CENTER>
	</CENTER></TD>
</TR>
<TR>
	<TD><CENTER><B><?=_WEBBOARD_COMMENT_ADD_SUCCESS;?></B><BR><BR>
	<A HREF="index.php?name=webboard&file=read&id=<?=$_GET['id'];?>"><?=_WEBBOARD_COMMENT_EDIT_TOPIN;?></A>
	<meta http-equiv="refresh" content="0.5;URL=index.php?name=webboard&file=read&id=<?=$_GET['id'];?>">
	</CENTER></TD>
</TR>
</TABLE><BR>
<?
}else{
	//Not Complete
?>

				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				<td width="10" height="10"><img src="images/pic/news-tl.gif"></td>
				<td height="10" colspan="3" background="images/pic/news-tbg.png"></td>
				<td width="10" height="10"><img src="images/pic/news-tr.gif"></td>
				</tr>
                  <tr>
                    <td width="10" rowspan="4" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="120" rowspan="4" valign="top"  align="center" bgcolor="#EEEEEE">
<? if (!empty($VIEWBOARD['is_member'])){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$VIEW = $db->select_query("SELECT * FROM ".TB_MEMBER."  where user='".$VIEWBOARD['post_name']."' ");
$VIEWS = $db->fetch($VIEW);
$id = $VIEWS['id'];
$topic = $VIEWS['topic'];
$post = $VIEWS['post'];
$sex = $VIEWS['sex'];
$email = $VIEWS['email'];
$lastlog = $VIEWS['lastlog'];

	$res['on'] = $db->select_query("SELECT * FROM ".TB_useronline." WHERE useronline='".$VIEWS['user']."' ");
	$arr['on'] = $db->fetch($res['on']);
	$useron = $arr['on']['useronline'];


if ($VIEWS['id']){

if ($VIEWS['member_pic']){
echo "<font color=#000000><b>"._FORM_MOD_POSTED."</font><font color=#CC0000>	 ".$VIEWBOARD['post_name']." <a href='popup.php?name=member&file=member_view&id=".$VIEWS['id']."' onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )\" class=\"highslide\" ><img src=icon/".$VIEWS['member_pic']."></a><br>";
} else {
echo "<font color=#000000><b>"._FORM_MOD_POSTED."</font><font color=#CC0000>	 ".$VIEWBOARD['post_name']." <br><a href='popup.php?name=member&file=member_view&id=".$VIEWS['id']."' onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )\" class=\"highslide\" ><img src=icon/member_nrr.gif></a><br>";
}
$cc = $topic+$post;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$VIEWw = $db->select_query("SELECT * FROM ".TB_WEBBOARD." as a ,".TB_ADMIN." as b where b.username='".$VIEWBOARD['post_name']."' and a.post_name=b.username and a.id=".$VIEWBOARD['id']." ");
$VIEWw = $db->fetch($VIEWw);
if ($VIEWw['username']){
echo "<table width=120 border=0 cellspacing=0 cellpadding=0><tr><td valign=top align=center>";
echo"&nbsp;&nbsp;<b>Administrator</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
echo "</td></tr></table>";

} else {
echo "<table width=120 border=0 cellspacing=0 cellpadding=0><tr><td valign=top align=center>";
if((0 < $cc) && ($cc <= (50))) echo"&nbsp;&nbsp;<b>Newbie</b><br>&nbsp;<img src=images/icon/star[1].png border=0/>";
else if((50 < $cc) && ($cc <= (100))) echo"&nbsp;&nbsp;<b>Jr.Member</b><br>&nbsp;&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
else if((100 < $cc) && ($cc <= (200))) echo"&nbsp;&nbsp;<b>Full Member</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
else if((200 < $cc) && ($cc <= (500))) echo"&nbsp;&nbsp;<b>Sr.Member</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
else if((500 < $cc) && ($cc <= (1000))) echo"&nbsp;&nbsp;<b>Super Member</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
else if(1000 < $cc) echo"&nbsp;&nbsp;<b>Hero Member</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
echo "</td></tr></table>";
}
} else {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$VIEWy = $db->select_query("SELECT * FROM ".TB_ADMIN." where username='".$VIEWBOARD['post_name']."' ");
$VIEWSy = $db->fetch($VIEWy);
$adname=$VIEWSy['username'];
$POSTS = $db->rows($db->select_query("SELECT * FROM ".TB_WEBBOARD." where post_name='".$adname."' "));
$COMS =  $db->rows($db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where post_name='".$adname."' "));


	$res['on'] = $db->select_query("SELECT * FROM ".TB_useronline." WHERE useronline='".$adname."'  ");
	$arr['on'] = $db->fetch($res['on']);
	$useron = $arr['on']['useronline'];


$emaily = $VIEWSy['email'];

echo "<table width=120 border=0 cellspacing=0 cellpadding=0><tr><td valign=top align=center>";
if ($VIEWSy['picture']){
echo "<font color=#000000><b>"._FORM_MOD_POSTED."</font><font color=#CC0000>	 ".$VIEWBOARD['post_name']." <br><img src=icon/".$VIEWSy['picture'].
	">";
} else {
echo "<font color=#000000><b>"._FORM_MOD_POSTED."</font><font color=#CC0000>	 ".$VIEWBOARD['post_name']." <br><img src=icon/admin_admin.png>";
}
echo"<br>&nbsp;&nbsp;<b>Administrator</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
echo "</td></tr></table>";
}


} else {
echo "<font color=#000000><b>"._FORM_MOD_POSTED."</font><font color=#CC0000>	 ".$VIEWBOARD['post_name']." <br><img src=icon/guest_nrr.gif>";
}
?>
<br />
			  <?
$rpgSettings = array();
$rpgSettings['init'] = 5;
$rpgSettings['incre'] = 3;
function calRpg($p) {
   global $rpgSettings;
   $i = 0; $j = $rpgSettings['init']; $l = 0;
   while ($i < $p) {  $l++;   $i += $j;   $j += $rpgSettings['incre'];   }
   $fn = $i;
   $cbase = ($i - ($j - $rpgSettings['incre']));
   if ($l < 1) $l = 1;
   $pc = (($p - $cbase) / ($fn - $cbase)) * 100;
   return array( 
      'level' => $l,
      'cbase' => $cbase,
      'nbase' => $fn,
      'perce' => $pc
   );
}
?>
<?if (!empty($VIEWS['id'])){?>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><font size="2" color="#333333">UID : </font><font size="2" color="#3399FF"><b>No.<? echo $id;?></b></font><br />      <font size="2" color="#FF3399"><?=_WEBBOARD_READ_POSTED;?></font> : <font size="2" color="#339900"><? echo $topic;?></font><br /><font size="2" color="#FF6600"><?=_WEBBOARD_READ_COMMENTED;?></font> : <font size="2" color="#FF6600"><? echo $post;?></font><br />      <font size="2" color="#333333"><?=_WEBBOARD_READ_MEMBER_SEX;?> : <? echo $sex;?></font><br />
<?


		$cp = $VIEWS['topic']+$VIEWS['post'];
         $cr = calRpg($cp);
         echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_LEVEL." : ". $cr['level']."</FONT><br><FONT size='2' color='#333333'>Exp : ".round($cr['perce'])."%</FONT>"; ?><br /><? if ($useron!=''){ echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_ONLINE." : <img src=\"images/useron.gif\" border=\"0\"> </font>";} else {echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_OFFLINE." : <img src=\"images/useroff.gif\" border=\"0\"></font> ";}?><br><FONT size="2" color="#333333"><?=_WEBBOARD_READ_MEMBER_LASTLOG;?> : <? echo $lastlog;?></font><br>
		  <b>IP</b> : <FONT size='1'><?list($a, $b, $c, $d) = explode('.', $VIEWBOARD['ip_address']); echo "$a.$b.$c.<span style=\"color:red\">xxx</span>";?></font></td>
    </tr>
</table>
<br />
<? echo "<a href='popup.php?name=member&file=member_view&id=".$id."' target='_blank' onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )\" class=\"highslide\" > "; ?><img src="images/icon/userinfo.gif" width="16" height="16" alt="<?=_WEBBOARD_READ_MEMBER_DETAIL;?>" /><? echo "</a>";?>&nbsp;
<a href="mailto:<? echo $email ?>" ><img src="images/icon/email.gif" width="16" height="16" border="0"  title="<? echo $email?>" /></a>
<BR>
<BR>
<? } else {
$POSTSx = $db->rows($db->select_query("SELECT * FROM ".TB_WEBBOARD." where post_name='".$VIEWBOARD['post_name']."' and NOT is_member ='1' "));
$COMSx =  $db->rows($db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where post_name='".$VIEWBOARD['post_name']."' and NOT is_member ='1'  "));

	?>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><font size="2" color="#333333">UID : </font><font color="#CC0000"><?=_WEBBOARD_READ_MEMBER_NULL;?></font><br />      <font size="2" color="#FF3399"><?=_WEBBOARD_READ_POSTED;?></font> : <font size="2" color="#339900"><? echo $POSTSx;?></font><br /><font size="2" color="#FF6600"><?=_WEBBOARD_READ_COMMENTED;?></font> : <font size="2" color="#FF6600"><? echo $COMSx;?></font><br />      <font size="2" color="#333333"><?=_WEBBOARD_READ_MEMBER_SEX;?> : <? echo $sex?></font><br />
<?
		$cpx = $POSTSx+$COMSx;
         $crx = calRpg($cpx);
         echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_LEVEL." : ". $crx['level']."</FONT><br>
		  <FONT size='2' color='#333333'>Exp : ".round($crx['perce'])."%</FONT>"; ?><br /><FONT size="2" color="#333333"><?=_WEBBOARD_READ_MEMBER_LASTLOG;?> : <? echo $lastlog;?></font><br>
		<? if (!empty($useron)){ echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_ONLINE." : <img src=\"images/useron.gif\" border=\"0\"> </font>";} else {echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_OFFLINE." : <img src=\"images/useroff.gif\" border=\"0\"></font> ";}?><br>
		<B>IP</b> : <FONT size='1'><?list($a, $b, $c, $d) = explode('.', $VIEWBOARD['ip_address']); echo "$a.$b.$c.<span style=\"color:red\">xxx</span>";?></font><br>
		  </td>
    </tr>
</table>

<BR>
<?
}
?>
</td>
                    <td width="10" rowspan="4" valign="top">&nbsp;</td>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="666" height="28"><b><font color="#000000"><?=_WEBBOARD_DETAIL_POST;?> : </font></b>
<?= ThaiTimeConvert($VIEWBOARD['post_date'],"1","1");?>

<?
if($admin_user){
	echo "<br>";
	if($VIEWBOARD['pin_date']){
		echo "<A HREF=\"javascript:Confirm('?name=webboard&file=pin_topic&action=removepin&id=".$_GET['id']."','"._WEBBOARD_PIN_CON_DEL."');\"><IMG SRC=\"images/admin/pin.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\"> "._WEBBOARD_PIN_CON_DEL_CENCLE." </A>&nbsp;&nbsp;&nbsp;";
	}else{
		echo "<A HREF=\"javascript:Confirm('?name=webboard&file=pin_topic&action=addpin&id=".$_GET['id']."','"._WEBBOARD_PIN_CON_ADD."');\"><IMG SRC=\"images/admin/pin.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\"> "._WEBBOARD_PIN_CON_DEL_SUB." </A>&nbsp;&nbsp;&nbsp;";
	}
	echo " <A HREF=\"javascript:Confirm('?name=webboard&file=delete_topic&id=".$_GET['id']."','"._WEBBOARD_TOPIC_CON_DEL."');\"><IMG SRC=\"images/admin/trash.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALIGN=\"absmiddle\"> "._WEBBOARD_TOPIC_CON_DEL_SUB." </A>";
};

				if(CheckLevel($admin_user,"webboard_edit")){
						echo "&nbsp;&nbsp;<a href='index.php?name=webboard&file=edittopic&id=".$VIEWBOARD['id']."&s_page=".$s_pagex."'><img src='images/edit_f2.png'>"._WEBBOARD_FORM_EDIT_TOPIC_TITILE."</a></font>";						
					}else{ };				?>&nbsp;&nbsp;
                          <? //กรณีสมาชิก
					if($login_true==$VIEWBOARD['post_name']){
						echo "&nbsp;&nbsp;<a href='index.php?name=webboard&file=edittopic&id=".$VIEWBOARD['id']."&s_page=".$s_pagex."'><img src='images/mail1[1].gif'>"._WEBBOARD_FORM_EDIT_TOPIC_TITILE."</a>";						
					}else{ };
$headertext = "#ffffff";         // สีตัวอักษรส่วนหัวของหน้าต่าง popup
$headerbackground = "#FFCC00";  // สีพื้นส่วนหัวของหน้าต่าง popup
$bigbtn = True; // True = ปุ่ม(ภาษาไทย)ขนาดใหญ่, False =  ปุ่ม(ภาษาไทย)ขนาดเล็ก
if ($bigbtn) {
	$btn="<img src=\"images/lg-share-en.gif\" alt=\""._WEBBOARD_PIC_TOPIC_SHARE_TITLE_ADD."\" height=\"16\" width=\"125\" border=\"0\" />";
} else {
	$btn="<img src=\"images/sm-share-en.gif\" alt=\""._WEBBOARD_PIC_TOPIC_SHARE_TITLE_CANCLE."\" height=\"16\" width=\"83\" border=\"0\" />";
}
?>
<!-- AddThis Bookmark Button BEGIN -->
<script type="text/javascript">
	var addthis_header_color = "$headertext";
	var addthis_header_background = "$headerbackground";
	var addthis_config = {ui_language: "en"};
</script><a href="<?=WEB_URL;?>" onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><?=$btn;?><script type="text/javascript" src="http://s7.addthis.com/js/200/addthis_widget.js"></script>
<!-- AddThis Bookmark Button END -->
					</td>
                      </tr>
                    </table>                    </td>
                    <td width="10" rowspan="4" align="center"  height="100%"  background="images/pic/news-right.png"></td>
                  </tr>
                  <tr>
                    <td height="1" class="dotline"></TD>
                  </tr>
                  <tr>
                    <td height="250" valign="top"><br />
                      <?
					//Show Picture
					if($VIEWBOARD['picture']){
						$postpicupload = @getimagesize ("webboard_upload/".$VIEWBOARD['picture']."");
						if ( $postpicupload['0'] > _WEBBOARD_LIMIT_PICWIDTH ) {
							$PicUpload = "<BR><CENTER><a href='webboard_upload/".$VIEWBOARD['picture']."' rel='lightbox'><img class='highslide-display-block' src='webboard_upload/".$VIEWBOARD['picture']."' width='"._WEBBOARD_LIMIT_PICWIDTH."' border='0' ></a><BR>[ "._WEBBOARD_PIC_REAL_WIDTH." ]</CENTER><BR>";
							}else{
							$PicUpload = "<BR><CENTER><img src='webboard_upload/".$VIEWBOARD['picture']."' border='0' ><BR></CENTER><BR>";
							}
						echo $PicUpload ;
					}else{ };

  if($VIEWBOARD['enable_show']){ 
 if(!$login_true && !$admin_user){
  echo "<table cellSpacing=0 cellPadding=0 width='95%' height='24' align='center' ><tr><td bgcolor=#FDEAFD>&nbsp;<img src='images/lock.png' border='0' hspace='4'>&nbsp;<font size='2' color='#333333'>"._WEBBOARD_TOPIC_MEMBER_ONLY."</font></TD></TR></table>" ;}
else { echo "    ".banword(stripslashes($VIEWBOARD['detail']))."        "; 
if($VIEWBOARD['att']) {?><br><table cellSpacing=0 cellPadding=0 width='50%' align='center' height='16' ><tr><td align=center valign=center><a href="webboard_upload/<?echo $VIEWBOARD['att'];?>"><img src="images/download.png"><font color="red"></a></td></tr></table><?}
}
}
else {echo "    ".banword(stripslashes($VIEWBOARD['detail']))."        ";
if($VIEWBOARD['att']) {?><br><table cellSpacing=0 cellPadding=0 width='90%' align='left' ><tr><td align=left ><a href="webboard_upload/<?echo $VIEWBOARD['att'];?>"><img src="images/download.png"></a></td></tr></table><?}
					}
?>
                      <br /><br /></td>
                  </tr>

                  <tr>
                    <td valign="top"><?if($VIEWS['user']==$VIEWBOARD['post_name']){ if($VIEWS['signature'] ){ echo "<img src='images/webboard/sigline.gif' width='363' height='16' /><br>";?> <?=stripslashes($VIEWS['signature']); echo "<br><br>"; }else{} }  ?>

	<div align="right">&nbsp;[ <a href="index.php?name=webboard&file=read&id=<?=$VIEWBOARD[id];?>&actionpost=quote#div1"><?=_WEBBOARD_READ_QOUTE;?></a> ]</div>	
	<br clear="all" />
	<div id="voting_result">
	</div>
</div>
					</td>

                  </tr>
					
					</td>

                  </tr>
				<tr>
				<td width="10" height="10"><img src="images/pic/news-bl.gif"></td>
				<td height="10" colspan="3" background="images/pic/news-bbg.png"></td>
				<td width="10" height="10"><img src="images/pic/news-br.gif"></td>
				</tr>
            </table>
</td>
                  </tr>
            </table><br>

				<?
//ดึงรายการความคิดเห็น
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$total = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id=' ".$VIEWBOARD['id']." ' ");
$e_page=5; 
if(empty($_GET['s_page'])){   
	$_GET['s_page']=0;
	$chk_page=$_GET['s_page'];
	$s_page=$_GET['s_page'];
}else{   
	$chk_page=$_GET['s_page'];     
	$_GET['s_page']=$_GET['s_page']*$e_page;   
		$s_page=$_GET['s_page'];
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$qr = $db->select_query("select * from ".TB_WEBBOARD_COMMENT." where topic_id=' ".$VIEWBOARD['id']." ' ORDER BY id  LIMIT ".$_GET['s_page'].",$e_page ");
$numr=$db->num_rows($qr);
if($numr >=1){   
	$plus_p=($chk_page*$e_page)+$numr;   
}else{   
	$plus_p=($chk_page*$e_page);       
}   
$total_p=ceil($total/$e_page);   
$before_p=($chk_page*$e_page)+1;  
 
$count=0; 
while($arr['comment'] = $db->fetch($qr)){
$count++; 
?>
<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="100%">
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				<td width="11" height="11"><img src="images/pic/block01.jpg"></td>
				<td height="11" colspan="3" background="images/pic/block02.jpg"></td>
				<td width="12" height="11"><img src="images/pic/block03.jpg"></td>
				</tr>
              <tr>
			  <td width="12" rowspan="6" align="center"  height="100%"  background="images/pic/block04.jpg"></td>
                <td width="120" rowspan="6" valign="top" bgcolor="#F5F5F5" align="center">

<? if ($arr['comment']['is_member']==1){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$VIEWxx = $db->select_query("SELECT * FROM ".TB_MEMBER."  where user='".$arr['comment']['post_name']."' ");
$VIEWSxx = $db->fetch($VIEWxx);
$idxx = $VIEWSxx['id'];
$topicx = $VIEWSxx['topic'];
$postx = $VIEWSxx['post'];
$sexx = $VIEWSxx['sex'];
$emailx = $VIEWSxx['email'];
$lastlogx = $VIEWSxx['lastlog'];



if ($VIEWSxx['id']){

if ($VIEWSxx['member_pic']){
echo "<font color=#000000><b>"._FORM_MOD_POSTED."</font><font color=#CC0000>	 ".$arr['comment']['post_name']." <a href='popup.php?name=member&file=member_view&id=".$VIEWSxx['id']."' onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )\" class=\"highslide\" ><img src=icon/".$VIEWSxx['member_pic']."></a><br>";
} else {
echo "<font color=#000000><b>"._FORM_MOD_POSTED."</font><font color=#CC0000>	 ".$arr['comment']['post_name']." <br><a href='popup.php?name=member&file=member_view&id=".$VIEWSxx['id']."' onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )\" class=\"highslide\" ><img src=icon/member_nrr.gif></a><br>";
}
$cc = $topicx+$postx;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$VIEWq = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." as a,".TB_ADMIN." as b where a.post_name='".$arr['comment']['post_name']."' and b.username=a.post_name and a.topic_id=".$VIEWBOARD['id']."");
$VIEWq = $db->fetch($VIEWq);
if ($VIEWq['username']){
echo "<table width=120 border=0 cellspacing=0 cellpadding=0><tr><td valign=top align=center>";
echo"&nbsp;&nbsp;<b>Administrator</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
echo "</td></tr></table>";

} else {
echo "<table width=120 border=0 cellspacing=0 cellpadding=0><tr><td valign=top align=center>";
if((0 < $cc) && ($cc <= (50))) echo"&nbsp;&nbsp;<b>Newbie</b><br>&nbsp;<img src=images/icon/star[1].png border=0/>";
else if((50 < $cc) && ($cc <= (100))) echo"&nbsp;&nbsp;<b>Jr.Member</b><br>&nbsp;&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
else if((100 < $cc) && ($cc <= (200))) echo"&nbsp;&nbsp;<b>Full Member</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
else if((200 < $cc) && ($cc <= (500))) echo"&nbsp;&nbsp;<b>Sr.Member</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
else if((500 < $cc) && ($cc <= (1000))) echo"&nbsp;&nbsp;<b>Super Member</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
else if(1000 < $cc) echo"&nbsp;&nbsp;<b>Hero Member</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
echo "</td></tr></table>";
}
?>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><font size="2" color="#333333">UID : </font><font size="2" color="#3399FF"><b>No.<? echo $idxx;?></b></font><br />      <font size="2" color="#FF3399"><?=_WEBBOARD_READ_POSTED;?></font> : <font size="2" color="#339900"><? echo $topicx;?></font><br />      <font size="2" color="#FF6600"><?=_WEBBOARD_READ_COMMENTED;?></font> : <font size="2" color="#FF6600"><? echo $postx;?></font><br />      <font size="2" color="#333333"><?=_WEBBOARD_READ_MEMBER_SEX;?> : <? echo $sexx;?></font><br />
        <?
	$res['onx'] = $db->select_query("SELECT * FROM ".TB_useronline." WHERE useronline='".$VIEWSxx['user']."' ");
	$arr['onx'] = $db->fetch($res['onx']);
	$useronxs = $arr['onx']['useronline'];

		$cp = $VIEWSxx['topic']+$VIEWSxx['post'];
         $cr = calRpg($cp);
         echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_LEVEL." : ". $cr['level']."</FONT><br>
		  <FONT size='2' color='#333333'>Exp : ".round($cr['perce'])."%</FONT>"; ?>
      <br /><? if (!empty($useronxs)){ echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_ONLINE." : <img src=\"images/useron.gif\" border=\"0\"> </font>";} else {echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_OFFLINE." : <img src=\"images/useroff.gif\" border=\"0\"></font> ";}?><br><font size="2" color="#333333"><?=_WEBBOARD_READ_MEMBER_LASTLOG;?> : <? echo $lastlogx;?><br><B>IP</b> : <FONT size='1'><?list($a, $b, $c, $d) = explode('.', $arr['comment']['ip_address']); echo "$a.$b.$c.<span style=\"color:red\">xxx</span>";?></font><br></font></td>
  </tr>
</table>
<br />
<? echo "<a href='popup.php?name=member&file=member_view&id=".$idxx."' target='_blank' onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )\" class=\"highslide\" >"; ?><img src="images/icon/userinfo.gif" width="16" height="16" alt="<?=_WEBBOARD_READ_MEMBER_DETAIL;?>" /><? echo "</a>";?>&nbsp;
<a href="mailto:<? echo $emailx; ?>" ><img src="images/icon/email.gif" width="16" height="16" border="0"  title="<? echo $emailx;?>" /></a>
<BR>
<BR>
<?
} else {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$VIEWyy = $db->select_query("SELECT * FROM ".TB_ADMIN." where username='".$arr['comment']['post_name']."' ");
$VIEWSyy = $db->fetch($VIEWyy);
$adname=$VIEWSyy['username'];
$idyy = $VIEWSyy['id'];
$POSTS = $db->rows($db->select_query("SELECT * FROM ".TB_WEBBOARD." where post_name='".$adname."' "));
$COMS =  $db->rows($db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where post_name='".$adname."' "));
	$res['ony'] = $db->select_query("SELECT * FROM ".TB_useronline." WHERE useronline='".$VIEWSyy['username']."' ");
	$arr['ony'] = $db->fetch($res['ony']);
	$userony = $arr['ony']['useronline'];

	$res['onys'] = $db->select_query("SELECT * FROM ".TB_useronline." WHERE useronline='".$admin_user."' and useronline='".$arr['comment']['post_name']."'");
	$arr['onys'] = $db->fetch($res['onys']);
$adminon = $arr['onys']['useronline'];

$emaily = $VIEWSy['email'];

echo "<table width=120 border=0 cellspacing=0 cellpadding=0><tr><td valign=top align=center>";
if ($VIEWSyy['picture']){
echo "<font color=#000000><b>"._FORM_MOD_POSTED."</font><font color=#CC0000>	 ".$arr['comment']['post_name']." <br><img src=icon/".$VIEWSyy['picture'].
	">";
} else {
echo "<font color=#000000><b>"._FORM_MOD_POSTED."</font><font color=#CC0000>	 ".$arr['comment']['post_name']." <br><img src=icon/admin_admin.png>";
}
echo"<br>&nbsp;&nbsp;<b>Administrator</b><br>&nbsp;<img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/><img src=images/icon/star[1].png border=0/>";
echo "</td></tr></table>";
?>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><font size="2" color="#333333">UID : </font><font size="2" color="#3399FF"><b>No.<? echo $idyy;?></b></font><br />      <font size="2" color="#FF3399"><?=_WEBBOARD_READ_POSTED;?></font> : <font size="2" color="#339900"><? echo $POSTS;?></font><br />      <font size="2" color="#FF6600"><?=_WEBBOARD_READ_COMMENTED;?></font> : <font size="2" color="#FF6600"><? echo $COMS;?></font><br />
        <?
		$cp = $POSTS+$COMS;
         $cr = calRpg($cp);
         echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_LEVEL." : ". $cr['level']."</FONT><br><FONT size='2' color='#333333'>Exp : ".round($cr['perce'])."%</FONT>"; ?>
      <br /><?if (!empty($userony)){ echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_ONLINE." : <img src=\"images/useron.gif\" border=\"0\"> </font>";} else if (!empty($adminon)){ echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_ONLINE." : <img src=\"images/useron.gif\" border=\"0\"> </font>";} else {echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_OFFLINE." : <img src=\"images/useroff.gif\" border=\"0\"></font> ";}?><br><font size="2" color="#333333"><?=_WEBBOARD_READ_MEMBER_LASTLOG;?> : <? echo $lastlogx;?><br>
	  <B>IP</b> : <FONT size='1'><?list($a, $b, $c, $d) = explode('.', $arr['comment']['ip_address']); echo "$a.$b.$c.<span style=\"color:red\">xxx</span>";?></font><br>
	  </td>
  </tr>
</table>
<br />
<? echo "</a>";?>&nbsp;
<a href="mailto:<? echo $emaily; ?>" ><img src="images/icon/email.gif" width="16" height="16" border="0"  title="<? echo $emaily;?>" /></a>
<BR>
<BR>
<?
}

} else {
$POSTSaa = $db->rows($db->select_query("SELECT * FROM ".TB_WEBBOARD." where post_name='".$arr['comment']['post_name']."' and NOT is_member ='1' "));
$COMSaa =  $db->rows($db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where post_name='".$arr['comment']['post_name']."' and NOT is_member ='1' "));
	$res['onyaa'] = $db->select_query("SELECT * FROM ".TB_useronline." WHERE useronline='".$arr['comment']['post_name']."' ");
	$arr['onyaa'] = $db->fetch($res['onyaa']);
	$useronyaa = $arr['onyaa']['useronline'];


echo "<font color=#000000><b>"._WEBBOARD_READ_POSTEDX."</font><font color=#CC0000>	 ".$arr['comment']['post_name']." <br><img src=icon/guest_nrr.gif>";
?>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><font size="2" color="#333333">UID : </font><font color="#CC0000"><?=_WEBBOARD_READ_MEMBER_NULL;?></font></b></font><br />      <font size="2" color="#FF3399"><?=_WEBBOARD_READ_POSTED;?></font> : <font size="2" color="#339900"><?=$POSTSaa;?></font><br />      <font size="2" color="#FF6600"><?=_WEBBOARD_READ_COMMENTED;?></font> : <font size="2" color="#FF6600"><?=$COMSaa;?></font><br />
        <?
		$cpaa = $POSTSaa+$COMSaa;
         $craa = calRpg($cp);
         echo "<FONT size='2' color='#333333'>"._WEBBOARD_READ_MEMBER_LEVEL." : ". $craa['level']."</FONT><br><FONT size='2' color='#333333'>Exp : ".round($craa['perce'])."%</FONT>"; ?>
      <br />
	  	<B>IP</b> : <FONT size='1'><?list($a, $b, $c, $d) = explode('.', $arr['comment']['ip_address']); echo "$a.$b.$c.<span style=\"color:red\">xxx</span>";?></font><br>
		</td>
  </tr>
</table>
<br />

<?
}
?>



 </td>
	 <td width="10" rowspan="6" valign="top">&nbsp;</td>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td  height="28"><b><font color="#000000"><?=_FROM_COMMENT_NUM;?>
                    <?=($s_pagex*$e_page)+$count;?>
                    </font></b>
                    <?if($admin_user){echo " <A HREF=\"javascript:Confirm('?name=webboard&file=delete_comment&id=".$_GET['id']."&comment=".$arr['comment']['id']."','"._FROM_COMFIRM_DEL."');\"><IMG SRC=\"images/admin/trash.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALIGN=\"absmiddle\"></A>";};?>
                    &nbsp;<?=_WEBBOARD_DETAIL_POST;?>
                    <?= ThaiTimeConvert($arr['comment']['post_date'],"","2");?></td>
                  </tr>
                </table>
				</td>
				<td width="12" rowspan="6" align="center"  height="100%"  background="images/pic/block05.jpg"></td>
              </tr>
			  <tr>
				<td height="1" class="dotline"></td>
			</tr>
			    <tr>
                <td height="200" valign="top"><br />
                  <?
//Show Picture
if($arr['comment']['picture']){
	$postpicupload = @getimagesize ("webboard_upload/".$arr['comment']['picture']."");
	if ( $postpicupload['0'] > _WEBBOARD_LIMIT_PICWIDTH ) {
		$PicUpload = "<BR><CENTER><a href='webboard_upload/".$arr['comment']['picture']."' rel='lightbox'><img class='highslide-display-block' src='webboard_upload/".$arr['comment']['picture']."' width='"._WEBBOARD_LIMIT_PICWIDTH."' border='0' ></a><BR>[ "._WEBBOARD_PIC_REAL_WIDTH." ]</CENTER><BR>";
		}else{
		$PicUpload = "<BR><CENTER><img src='webboard_upload/".$arr['comment']['picture']."' border='0' ><BR></CENTER><BR>";
		}
	echo $PicUpload ;
}else{ };
?>

                  <?=banword(stripslashes($arr['comment']['detail']));?><br />
                  <br />
</td>

		      </tr>

                  <tr>
                    <td valign="top"><?if($VIEWSxx['user']==$arr['comment']['post_name']){ if($VIEWSxx['signature'] ){ echo "<img src='images/webboard/sigline.gif' width='363' height='16' /><br>";?> <?=stripslashes($VIEWSxx['signature']); echo "<br><br>"; }else{} } ?>
										<div align="right">[ <a href="index.php?name=webboard&file=read&id=<?=$VIEWBOARD[id];?>&mentid=<?=$arr[comment][id];?>&actionpost=quote&commentpost=quote2#reply"><?=_WEBBOARD_READ_QOUTE;?></a> ]	</div>
					</td>
                  </tr>
			
			  			  <tr>
				<td height="1" class="dotline"></td>
			</tr>
              <tr>
                <td height="24"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="250" align="left"><? //เช็คสิทธิ์แก้ไข comment
				if(CheckLevel($admin_user,"webboard_edit")){
						echo "<a href='index.php?name=webboard&file=editcomment&id=".$arr['comment']['id']."&s_page=".$s_pagex."'>&nbsp;<img src='images/edit_f2.png'>[&nbsp;"._WEBBOARD_FORM_EDIT_COMMENT_TITILE."&nbsp;]</a>&nbsp;</font>";						
					}else{ };
				?>&nbsp;&nbsp;<? //เช็คสิทธิ์แก้ไข comment
				if($arr['comment']['att']){
						echo "<a href='".WEB_URL."/webboard_upload/".$arr['comment']['att']."'>&nbsp;<img src='images/download.png'></a></font>";						
					}else{ };
				?></td>
                    <td>&nbsp;</td>
                    <td width="80">&nbsp;</td>
                    <td width="80" align="center"><?	if($login_true==$arr['comment']['post_name']){
						echo "<a href='index.php?name=webboard&file=editcomment&id=".$arr['comment']['id']."&s_page=".$s_pagex."'>"._WEBBOARD_FORM_EDIT_TOPIC_TITILE."</a>";						
					}else{ };				?></td>
                    <td width="76" align="center"><a href="#top" alt="<?=_WEBBOARD_READ_OPTOP;?>"><img src="images/top.png"></a></td>
                  </tr>
                </table></td>
              </tr>
				<tr>
				<td width="11" height="12"><img src="images/pic/block06.jpg"></td>
				<td height="11" colspan="3" background="images/pic/block07.jpg"></td>
				<td width="12" height="12"><img src="images/pic/block08.jpg"></td>
				</tr>
            </table>
</td>
</td>
</table>
			<?
//							$count  ++;
}
$db->closedb ();
?>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="500" class="browse_page" ><?
		page_navigator("webboard","read",$id="".$_GET['id']."",$before_p,$plus_p,$total,$total_p,$chk_page); ?></td></tr>
     <tr><td width="100%" align=right><? echo "<a href=\"#div1\" onclick=\"showhide('div1');\"><img src='images/webboard/reply.png'  hspace='2' vspace='5' border='0' /></a><a href='index.php?name=webboard&amp;file=post&category=".$boardcategory['id']."'><img src='images/webboard/post.png' hspace='2' vspace='5'  border='0' /></a>" ; ?></td>
   </tr>
</table>

<div id="div1" style="display: show;">
  <TABLE cellSpacing=0 cellPadding=0 width=100% border=0 align="center">
			  <TBODY>
				<TR>
				  <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
				  <TD  vAlign=top align=left><IMG src="images/topfader.gif" border=0><BR>
				  <a name="lastPost">
				  <br />
				    <table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td bgcolor="#FFFFFF"><img src="images/menu/textmenu_comment.gif" border="0" /></td>
                      </tr>
                    </table>
				    <FORM name="form2" METHOD=POST ACTION="?name=webboard&file=read&action=comment&id=<?=$_GET['id'];?>" enctype="multipart/form-data" >
				      <TABLE width="97%" align="center" bgcolor="#FFFFFF">
<TR>
	<TD width=150 align=right><B><?=_WEBBOARD_COMMENT_TOPIC_RE;?> : </B></TD>
	<TD><INPUT TYPE="text" NAME="topic" style="width:450"  class="inputform" value="<?=$VIEWBOARD['topic'];?>" readonly style="color: #FF0000"></TD>
</TR>
<?
//กรณี โพสรูปได้ 
if(_ENABLE_BOARD_UPLOAD){
?>
<TR>
	<TD width=150 align=right><B><?=_WEBBOARD_FORM_ATT_PIC_TITLE;?> : </B></TD>
	<TD><input type="file" name="FILE" style="width:350" class="inputform"> 
	<?=_WEBBOARD_FORM_LIMIT_SIZE;?> <?=(_WEBBOARD_LIMIT_UPLOAD/1024);?> kB</TD>
</TR>
<?
}
if($login_true || $admin_user){
?>
<TR>
	<TD width=150 align=right><B><?=_WEBBOARD_FORM_ATT_FILE_TITLE;?> : </B></TD>
	<TD><input type="file" name="FILEATT" style="width:250" class="inputform"> Limit <?=(_WEBBOARD_LIMIT_UPLOADS/1024);?> kB</TD>
</TR>
<TR><TD colspan=2 height=1 class="dotline"></TD></TR>
<?
}
?>
<TR>
	<TD width=150 align=right valign=top><B><?=_WEBBOARD_READ_DETAIL_TITLE;?> : </B></TD>
	<TD colspan="2">
<style>
#blockquote {
background-repeat: no-repeat;
background-position: left center;
width: 400px;
padding-left: 110px;
padding-right: 5px;
border: 2px dashed #FC8A42;
}
</style>
<?
	if ($_GET['actionpost']) {
	echo "<a name=reply>";
	if ($_GET[commentpost]) {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$BOARDQUOTE = $db->fetch($db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE id = '".$_GET['mentid']."' "));
$db->closedb ();
	} else {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$BOARDQUOTE = $db->fetch($db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id = '".$_GET['id']."' "));
$db->closedb (); }
//$editdetails="[quote]".$BOARDQUOTE[detail]."[/quote]";
$editdetails="<blockquote > <b>"._WEBBOARD_READ_QOUTE_TOPIC." (Quote Tpoic ID)</b> <font color='orange'>".$BOARDQUOTE['id']."</font> "._WEBBOARD_READ_POSTED." (By) <u><b>".$BOARDQUOTE['post_name']."</b></u> : <br>".$BOARDQUOTE['detail']."</blockquote><br>";
$TextContent = stripslashes($editdetails);
if($BOARDQUOTE['enable_show'] ==0){
?>
<textarea cols="50" id="editor1" rows="50"  name="detail" ><div style="background-repeat: no-repeat;background-position: left center;
background-color :#F3F3F3;width: 520px;border: 1px dashed #FC8A42;"><?=$TextContent;?></div></textarea>
		<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script>
	</TD>
</TR>

<?
} else {
if($login_true || $admin_user){
?>
<textarea cols="50" id="editor1" rows="50"  name="detail" ><div style="background-repeat: no-repeat;background-position: left center;
background-color :#F3F3F3;width: 520px;border: 1px dashed #FC8A42;"><?=$TextContent;?></div></textarea>
		<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script>
	</TD>
</TR>

<?
} else {
?>
<textarea cols="50" id="editor1" rows="50"  name="detail" ><div style="background-repeat: no-repeat;background-position: left center;
background-color :#F3F3F3;width: 520px;border: 1px dashed #FC8A42;"><?php echo _WEBBOARD_TOPIC_MEMBER_ONLY;?></div></textarea>
		<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script>
	</TD>
</TR>
<?php
}
}
}	else {
?>
<textarea cols="50" id="editor1" rows="50"  name="detail" ></textarea>
		<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script>
	</TD>
</TR>
<?
}
if($login_true || $admin_user){
} else {
if(USE_CAPCHA){
?>
						<TR>
							<TD width=150 align=right>
							<?if(CAPCHA_TYPE == 1){ 
								echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							}else if(CAPCHA_TYPE == 2){ 
								echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							};?>							</TD>
							<TD><input name="security_code" type="text" id="security_code" size="20" maxlength="6" style="width:80" > <?=_JAVA_CAPTCHA_ADD;?></TD>
						</TR>
<?
}}
?>
<TR>
	<TD align=right><B><?=_WEBBOARD_FORM_AUTH_POST;?> :</b></TD>
	<TD colspan="2"><INPUT TYPE="text" NAME="post_name" style="width:150" class="inputform" <?if($login_true){echo "value=\"".$login_true."\" readonly style=\"color: #FF0000\" ";} if($admin_user){echo "value=\"".$admin_user."\" readonly style=\"color: #FF0000\" ";};?>></TD>
</TR>
<tr>
	<TD align=right>&nbsp;</TD><TD><input type="submit" name="Submit" value="<?=_WEBBOARD_FORM_BUTTON_ADD_POST;?>" /></TD>
</TR>
</TABLE>
</FORM>
<br />

<? ;} ?>
</TD>
        </TR>
      </TBODY>
</TABLE>
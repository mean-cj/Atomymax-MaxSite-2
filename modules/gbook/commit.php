<center>
<table width="750">
<tr>
<td align="center">
<?php

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['member'] = $db->select_query("SELECT * FROM ".TB_MEMBER." where user='".$_POST['Name']."' ");
$arr['member'] = $db->fetch($res['member']);

if (!empty($arr['member']['user'])){
$isMEMBER=1;
echo "<center><font face='Verdana,MS Sans Serif' size='2'>"._GBOOK_NO_ACCESS." $Name "._GBOOK_NO_ACCESS1."<br></b><br>
   <input type='button' value='"._GBOOK_BUTTON_BACK."' style= 'border: silver; border-style: groove; border-top-width: 2px; border-right-width: 2px; border-bottom-width: 2px; border-left-width: 2px; background-color: #FFCC66' onclick='window.history.go(-1);'></center>";
 exit;
} else {
$isMEMBER=0;
}

if (!$_POST['Name']) {
echo "<center><font face='Verdana,MS Sans Serif' size='2'>"._GBOOK_NO_NAME."<br></b><br>
   <input type='button' value='"._GBOOK_BUTTON_BACK."' style= 'border: silver; border-style: groove; border-top-width: 2px; border-right-width: 2px; border-bottom-width: 2px; border-left-width: 2px; background-color: #FFCC66' onclick='window.history.go(-1);'></center>";
 exit; } 

if(strlen($Email)>1){
if (!preg_match ("/@./i", $Email)) { 
echo "<center><font face='Verdana,MS Sans Serif' size='2'>"._GBOOK_NO_EMAIL." $Email "._GBOOK_NO_EMAIL1."<br></b><br>
   <input type='button' value='"._GBOOK_BUTTON_BACK."'  style= 'border: silver; border-style: groove; border-top-width: 2px; border-right-width: 2px; border-bottom-width: 2px; border-left-width: 2px; background-color: #FFCC66' onclick='window.history.go(-1);'></center>";
 exit; } 
}
 if($login_true || $admin_user){
} else {
if(USE_CAPCHA){
check_captcha($_POST['security_code']);
}
}
//header ("Location: index.php?name=gbook&file=index");
?>

<?php
//include("connectdb.php");
global $Date;
global $tDate;

$Dates =  thai_date();
$IP =$IPADDRESS; 
$Messages=$_POST['Messages'];
$Name=$_POST['Name'];
$Email=$_POST['Email'];
$Url=$_POST['Url'];
//phpinfo();

if($login_true<>''){
if(empty($_SESSION['uax']) || $_SESSION['uax'] != $login_true.":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'])
{
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->del(TB_useronline," useronline='".$_SESSION['login_true']."' "); 
$db->add_db(TB_IPBLOCK,array(
	"ip"=>"".$IPADDRESS."",
	"post_date"=>"".time().""
	));
$db->closedb ();
session_unset();
//session_destroy();
session_regenerate_id(); // เริ่ม session อื่นใหม
die('Session Hijacking Attempt');
}
$sql_add = "INSERT INTO ".TB_gbook." (Message, Name, is_member , Email, IP, URL, Date) VALUES ( '$Messages', '$Name', '$isMEMBER', '$Email', '$IP', '$Url', '$Dates')";
$result =mysql_query($sql_add) or die("Errror :" . mysql_error());
} else if($admin_user <>'' ) {
if(empty($_SESSION['ua']) || $_SESSION['ua'] != $admin_user.":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'])
{
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->del(TB_useronline," useronline='".$_SESSION['admin_user']."' "); 
$db->add_db(TB_IPBLOCK,array(
	"ip"=>"".$IPADDRESS."",
	"post_date"=>"".time().""
	));
$db->closedb ();
session_unset();
//session_destroy();
session_regenerate_id(); // เริ่ม session อื่นใหม
die('Session Hijacking Attempt');
}
$sql_add = "INSERT INTO ".TB_gbook." (Message, Name, is_member , Email, IP, URL, Date) VALUES ('$Messages', '$Name', '$isMEMBER','$Email', '$IP', '$Url', '$Dates')";
$result =mysql_query($sql_add) or die("Errror :" . mysql_error());
} else {
$sql_add = "INSERT INTO ".TB_gbook." (Message, Name, is_member , Email, IP, URL, Date) VALUES ( '$Messages', '$Name', '$isMEMBER','$Email', '$IP', '$Url', '$Dates')";
$result =mysql_query($sql_add) or die("Errror :" . mysql_error());
}
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._GBOOK_ADD_ACCESS."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"?name=gbook\"><B>"._GBOOK_GO_BACK."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
function thai_date(){
$thaiday = array(_Sunday,_Monday,_Tuesday,_Wednesday,_Thursday,_Friday,_Saturday);
$thaimonth = array(_Month_1,_Month_2,_Month_3,_Month_4,_Month_5,_Month_6,_Month_7,_Month_8,_Month_9,_Month_10,_Month_11,_Month_12);
$Date =$thaiday[date("w")]." ".date("j")." ".$thaimonth[date("m")-1]." ";
$Ythai= date("Y")+543;
$Date .= $Ythai; 
 return $Date;
}
?>
</div>
</td>
</tr>
</table>

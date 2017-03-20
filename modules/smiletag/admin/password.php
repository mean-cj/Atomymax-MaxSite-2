<?php
	require_once("".WEB_URL."/includes/config.in.php");
//include("../includes/config.in.php");
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res[user] = $db->select_query("SELECT * FROM ".TB_ADMIN." where user='".$_SESSION[admin_user]."' ");
$arr[user] = $db->fetch($res[user]);

	$Username =$_SESSION[admin_user];
	$Password = $_SESSION[admin_pwd];

  $db->closedb ();

?>

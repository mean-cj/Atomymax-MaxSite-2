<?php 
include_once ("../../mainfile.php");

	$strUsername = trim($_POST["username"]);

	if(trim($strUsername) == "")
	{
		echo "empty";
		exit();
	}

if (preg_match('/^[a-zA-Z0-9]{4,15}$/', $strUsername))
{
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); // เชื่อมต่อฐานข้อมูล 
$db_query = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$strUsername."' "); // ดึงข้อมูลให้ตรงกันในตารางสมาชิก 
$objResult = $db->fetch($db_query); 
	if($objResult)
	{
	echo '<font color="red">The username <strong><font color=#00CC00>'.$strUsername.'</font></strong> is already in use.</font>';
		exit();
	}
	else
	{
		echo "<img src='modules/member/img/tick.gif' align='absmiddle'>";
	}
$db->closedb (); 
} else {
		echo "<font color='red'><strong>invalid</strong></font>";
		exit();
}

?>
<?                   
$ct_ip = $_SERVER["REMOTE_ADDR"];
$ct_yyyy = date("Y") ;
$ct_mm = date("m") ;
$ct_dd = date("d") ;
$ct_time = time();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql = "select * from ".TB_ACTIVEUSER." where ct_yyyy = '$ct_yyyy' AND ct_mm = '$ct_mm' AND ct_dd = '$ct_dd' AND ct_ip = '$ct_ip' ";
$result = $db->select_query($sql);
$num = $db->rows($result);

if(!isset($_SESSION["ss_counter"]))
{

	$_SESSION["ss_counter"] = "y";
	if($num==0)
	{
		$sql = "insert into ".TB_ACTIVEUSER." (ct_yyyy,ct_mm,ct_dd,ct_ip,ct_count,ct_time) values ('$ct_yyyy','$ct_mm','$ct_dd','$ct_ip','1','$ct_time')";
		$result = $db->select_query($sql);
	}
	else
	{
		$sql = "update ".TB_ACTIVEUSER." set ct_count = ct_count+1 , ct_time = '$ct_time' , where ct_yyyy = '$ct_yyyy' AND ct_mm = '$ct_mm' AND ct_dd = '$ct_dd' AND ct_ip = '$ct_ip' ";
		$result = $db->select_query($sql);
	}
}
else
{
	if($num==0)
	{
		$sql = "insert into ".TB_ACTIVEUSER." (ct_yyyy,ct_mm,ct_dd,ct_ip,ct_count,ct_time) values ('$ct_yyyy','$ct_mm','$ct_dd','$ct_ip','1','$ct_time')";
		$result = $db->select_query($sql);
	}
	else
	{
		$sql = "update ".TB_ACTIVEUSER." set ct_time = $ct_time where ct_yyyy = '$ct_yyyy' AND ct_mm = '$ct_mm' AND ct_dd = '$ct_dd' AND ct_ip = '$ct_ip' ";
		$result = $db->select_query($sql);
	}
}

?>
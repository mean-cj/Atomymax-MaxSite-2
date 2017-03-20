<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res[user] = $db->select_query("SELECT * FROM ".TB_personnel." where id='".$pid."' ");
$arr[user] = $db->fetch($res[user]);
?>
<img src="images/personnel/<? echo $arr[user][p_pic];?>">



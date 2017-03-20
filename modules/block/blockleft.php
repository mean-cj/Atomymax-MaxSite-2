<?
	//	CheckUser($_SESSION['admin_user']);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where leftblock='1' order by sort");
		while ($arr['block'] = $db->fetch($res['block'])) {

	if ( $arr['block']['filename'] !='') {
		include "modules/block/".$arr['block']['filename']"."$arr['block']['sfile']."";
	} else {

	}
}

?>

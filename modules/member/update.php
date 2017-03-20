<?
require_once("mainfile.php");
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$res['alter'] = $db->select_query("ALTER TABLE ".TB_MEMBER." CHANGE password password VARCHAR( 32 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ");
$arr['alter'] = $db->fetch($res['alter']);

$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." ORDER BY id ") ;
$count=0;
while($arr['user'] = $db->fetch($res['user'])){
			$db->update_db(TB_MEMBER,array(
				"password"=>"".md5($arr['user']['password']).""
			)," id='".$arr['user']['id']."' ");
			$count++;
}
echo "<center>update success record=".$count."</center>";
?>
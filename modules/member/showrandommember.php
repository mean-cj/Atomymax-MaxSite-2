<?
//สุ่มแสดงสมาชิก 5 คน
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['member']= $db->select_query("SELECT * FROM ".TB_MEMBER." ORDER BY rand() limit 5");
echo " "._MEMBER_MOD_USER_RAN5." <br> <br><strong>";
while($arr['member'] = $db->fetch($res['member'])){
?>
<font size='1' face='MS Sans Serif'>&nbsp;<u><? echo $arr['member']['user'];?></u><br>&nbsp;

<?                
       }
	   
echo "</strong>";

$db->closedb ();
//จบการสุ่มแสดงสมาชิกล่าสุด
?>				
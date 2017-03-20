<?
//แสดงสมาชิกล่าสุด
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['member'] = $db->select_query("SELECT * FROM ".TB_MEMBER." ORDER BY id DESC LIMIT 1 ");
while($arr['member'] = $db->fetch($res['member'])){
?>
<font size="2" face="MS Sans Serif"></font><u><?=_MEMBER_MOD_USER_LAST;?></u><br>
<br><strong> <A HREF="?name=member&file=member_read&id=<?=$arr['member']['id']; ?>">[ <?=$arr['member']['user'];?> ]</strong><br>
</font><br>
	<? if($arr['member']['member_pic']==""){ ?>
	<IMG SRC="icon/member_nrr.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }else{  ?>
	<IMG SRC="icon/<?=$arr[member][member_pic]; ?>" width='100' BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }; ?>
</a><br>
             
<?
       }
$db->closedb ();
//จบการแสดงสมาชิกล่าสุด
?>				
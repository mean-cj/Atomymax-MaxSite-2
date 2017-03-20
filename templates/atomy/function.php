<?
define("_TEMPLATES_WIDTH_CONFIG","996"); //ขนาดไฟล
//loadblock
function LoadBlock($pblock=""){
	global $db ;
	$widthLR=220; //ขนาดของ block ซ้าย,ขวา
	$widthL=5; // ขนาดของเส้นขอบซ้าย ของ block ซ้าย,ขวา
	$widthR=4; // ขนาดของเส้นขอบขวา ของ block ซ้าย,ขวา
	$widthSUM=$widthLR-($widthL+$widthR);  //ขนาดที่เหลือแสดงผลแต่ละ block ซ้าย,ขวา

	$widthCU=530; //ขนาดของ block ที่แสดงผลตรงกลาง
	$widthCL=7; // ขนาดของเส้นขอบซ้าย ของ block ตรงกลาง
	$widthCR=7; // ขนาดของเส้นขอบขวา ของ block ตรงกลาง
	$widthSUMC=$widthCU-($widthCL+$widthCR); //ขนาดที่เหลือแสดงผลแต่ละ block ตรงกลาง
	//Check Level
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['blocksx'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE status='1' and pblock='$pblock' order by sort");
	while($arr['blocksx'] = $db->fetch($res['blocksx'])){
	$sfile=$arr['blocksx']['sfile'];
	$filename=$arr['blocksx']['filename'];
	$code=$arr['blocksx']['code'];
	if ($pblock=='left' || $pblock=='right'){
	?>
	<center><table id="Table_01" width="<?=$widthLR;?>" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3" class="titleleft" background="templates/<?echo WEB_TEMPLATES;?>/images/menu/mainleft.png" width="<?=$widthLR;?>" height="44" alt=""><?echo $arr['blocksx']['blockname'];?></td>
	</tr>
	<tr>
		<td background="templates/<?echo WEB_TEMPLATES;?>/images/menu/barleft_02.png" width="<?=$widthL;?>" height="100%" alt=""></td>
		<td >
	<?
	if($code==''){
	include ("modules/block/".$filename.".".$sfile."");
	}else{
	echo $code;
	}
	?>
	</td>
		<td background="templates/<?echo WEB_TEMPLATES;?>/images/menu/barleft_04.png" width="<?=$widthR;?>" height="100%" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/barleft_05.png" width="5" height="12" alt=""></td>
		<td >
		<img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/barleft_07.png" width="211" height="12" alt=""></td>
		<td>
			<img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/barleft_08.png" width="4" height="12" alt=""></td>
	</tr>
</table>
	<?
	} else if ($pblock=='center' || $pblock=='user1' ){
	?>
	<center><table id="Table_01" width="530" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3" class="titlecenter" background="templates/<?echo WEB_TEMPLATES;?>/images/menu/barcenter.png" width="<?=$widthCU;?>" height="45" alt=""><?echo $arr['blocksx']['blockname'];?></td>
	</tr>
	<tr>
		<td background="templates/<?echo WEB_TEMPLATES;?>/images/menu/4.gif" width="<?=$widthCL;?>" height="7" alt=""></td>
		<td >
	<?
	if($code==''){
	include ("modules/block/".$filename.".".$sfile."");
	}else{
	echo $code;
	}
	?>
			</td>
		<td background="templates/<?echo WEB_TEMPLATES;?>/images/menu/5.gif" width="<?=$widthCR;?>" height="7" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/6.gif" width="7" height="7" alt=""></td>
		<td >
		<img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/7.gif" width="100%" height="7" alt=""></td>
		<td>
			<img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/8.gif" width="7" height="7" alt=""></td>
	</tr>
</table>
	<?
	} else {
	if($code==''){
	include ("modules/block/".$filename.".".$sfile."");
	}else{
	echo $code;
	}

	}

	}
}
?>
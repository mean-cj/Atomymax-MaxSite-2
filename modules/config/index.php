<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); // Connect DB
$res['config'] = $db->select_query("SELECT * FROM ".TB_CONFIG." ORDER BY id where posit='".$_GET['id']."' ");
while($arr['config'] = $db->fetch($res['config'])){
$db->closedb (); // Disconnect DB
	if ($arr['config']['type']='application/x-shockwave-flash' ) {
?>
<TABLE width="<?=$arr['config']['width'];?>" align=center cellSpacing=0 cellPadding=0 border=0>
<TR>
<TD width="<?=$arr['config']['width'];?>">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$arr['config']['width'];?>" height="<?=$arr['config']['height'];?>">
 <param name="movie" value="images/config/<?=$arr['config']['name'];?>" />
<param name="quality" value="high" />
<embed src="images/config/<?=$arr['config']['name'];?>"
      quality="high"
      type="application/x-shockwave-flash"
      width="<?=$arr['config']['width'];?>"
      height="<?=$arr['config']['height'];?>"
      pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
</td>
</tr>
</td>
</tr>
</table>
<?
	} else {
		  ?>
<TABLE width="<?=$arr['config']['width'];?>" align=center cellSpacing=0 cellPadding=0 border=0>
<TR>
<TD width="<?=$arr['config']['width'];?>">
<img src="templates/<?echo WEB_TEMPLATES;?>/images/config/<?=$arr['config']['name'];?>"  width="<?=$arr['config']['width'];?>" height="<?=$arr['config']['height'];?>" border="0">
</td>
</tr>
</td>
</tr>
</table>
<?
	  }
}
?>


<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); // Connect DB
$res['config'] = $db->select_query("SELECT * FROM ".TB_CONFIG.",".TB_TEMPLATES." where name=temname and sort='1' ");
$arr['config'] = $db->fetch($res['config']);
//$db->closedb (); // Disconnect DB
 $types=$arr['config']['type'];

 if ($types !='application/x-shockwave-flash' ) {
?>
<TABLE width="<?=$arr['config']['width'];?>" cellSpacing=0 cellPadding=0 border=0>
	<TR>
		<TD valign="top" width="<?=$arr['config']['width'];?>" background="templates/<?echo WEB_TEMPLATES;?>/images/config/<?=$arr['config']['picname'];?>"  width="<?=$arr['config']['width'];?>" height="<?=$arr['config']['height'];?>" border="0" >
	</td>
</tr>
</table>
<?
	} else {
		  ?>

<TABLE width="<?=$arr['config']['width'];?>" align=center cellSpacing=0 cellPadding=0 border=0>
<TR>
<TD width="<?=$arr['config']['width'];?>" border="0">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$arr['config']['width'];?>" height="<?=$arr['config']['height'];?>" border="0">
 <param name="movie" value="templates/<?=WEB_TEMPLATES;?>/images/config/<?=$arr['config']['picname'];?>" />
<param name="quality" value="high" />
<param name="wmode" value="transparent">
<embed src="templates/<?=WEB_TEMPLATES;?>/images/config/<?=$arr['config']['picname'];?>"
      quality="high"
      type="application/x-shockwave-flash"
      width="<?=$arr['config']['width'];?>"
      height="<?=$arr['config']['height'];?>"
pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="opaque"></embed>
</object>
</td>
</tr>
</table>
<?
}
?>


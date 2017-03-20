<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); // Connect DB
$res['config'] = $db->select_query("SELECT * FROM ".TB_CONFIG.",".TB_TEMPLATES." where name=temname and sort='3' ");
$arr['config'] = $db->fetch($res['config']);
?>
<TABLE width="<?=$arr['config']['width'];?>" align=center cellSpacing=0 cellPadding=0 border=0>
<TR>
<TD width="<?=$arr['config']['width'];?>">
<img src="templates/<?echo WEB_TEMPLATES;?>/images/config/<?=$arr['config']['picname'];?>"  width="<?=$arr['config']['width'];?>" height="<?=$arr['config']['height'];?>" border="0">
</td>
</tr>
</table>
<?
$db->closedb ();
?>


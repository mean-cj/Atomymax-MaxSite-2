<?
$pid=$_GET['pid'];
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
	$res['admin'] = $db->select_query("SELECT * FROM ".TB_personnel." WHERE id='".$pid."' ");
	$arr['admin'] = $db->fetch($res['admin']);
	$db->closedb ();

?>
<link href="css/template_css.css" rel="stylesheet" type="text/css">
<table border="0" cellSpacing=0 cellPadding=0 border=0>
<tr>
<td align="center" valign="top" cellSpacing=0 cellPadding=5 border=0 >
<table class='iconframe' width="120" border="0" cellpadding="0" cellspacing="0" class=grids>
<tr class=odd>
  <td class='imageframe' align="center" valign="top" border="0"><?if ($arr['admin']['p_pic']){?><img src='images/personnel/<? echo $arr['admin']['p_pic'];?>' width="<?=_IPER_W;?>" height="<?=_IPER_H;?>"/><?} else { echo "<img src=\"images/nopic.jpg\" border=0"; }?></td>
  <td class='shadow_right'><div class='shadow_top_right'></div></td>
</tr>
<tr>
  <td class='shadow_bottom'><div class='shadow_bottom_left'></div></td>
  <td class='shadow_bottom_right'></td>
</tr>
</table>
</td>

<td valign="top">
<table border="0" cellpadding="0" cellspacing="0" class=grids>
<tr class=odd>

<td width="120" align=left valign="top"><b><?=_PERSONNEL_MOD_DETAIL_NAME_FULL;?> :</b></td><td width="400" align=left valign="top"><font color=#CC0000><?echo $arr['admin']['p_name'];?></td>
</tr>
<td width="120" align=left valign="top"><b><?=_PERSONNEL_MOD_DETAIL_POSITION;?> :</b></td><td width="400" align=left valign="top"><font color=#CC0000><?echo $arr['admin']['p_position'];?></td>
</tr><tr>
<td width="120" align=left valign="top"><b><?=_PERSONNEL_MOD_DETAIL_DATA;?> :</b></td><td width="400" align=left valign="top"><font color=#CC0000><?echo $arr['admin']['p_data'];?></td>
</tr><tr>
<td width="120" align=left valign="top"><b><?=_PERSONNEL_MOD_DETAIL_ADD;?> :</b></td><td width="400" align=left valign="top"><font color=#CC0000><?echo $arr['admin']['p_add'];?></td>
</tr><tr>
<td width="120" align=left valign="top"><b>Telephone :</b></td width="400" align=left valign="top"><td><font color=#CC0000><?echo $arr['admin']['p_tel'];?></td>
</tr><tr>
<td width="120" align=left valign="top"><b>Email :</b></td><td width="400" align=left valign="top"><font color=#CC0000><?echo $arr['admin']['p_mail'];?></td>
</tr>
<tr>
<td colspan=2 align=left valign="top">
<table border="0" cellpadding="0" cellspacing="0" class=grids>

<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groups'] = $db->select_query("SELECT * FROM ".TB_personnel_group." as a,".TB_personnel_list." as b  where b.g_id=a.gp_id and b.u_id='".$arr['admin']['id']."' ORDER BY a.gp_id ");
while ($arr['groups'] = $db->fetch($res['groups'])){

?>
<tr class=odd><td width="300" align=left valign="top"><B><?=_PERSONNEL_MOD_DETAIL_CAT;?> :</b> <font color=#CC0000><? echo $arr['groups']['gp_name'];?></font><br><b><?=_PERSONNEL_MOD_DETAIL_DATAX_CAT;?> :</b> <font color=#33CC00><? echo $arr['groups']['p_detail'];?></font></td></tr>
<?
}
$db->closedb ();
?>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
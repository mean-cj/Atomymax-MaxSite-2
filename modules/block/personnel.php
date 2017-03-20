<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM ".TB_personnel." where boss='1' ");
$arr['user'] = $db->fetch($res['user']);

?>

<table width="<?=$widthSUM;?>" border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="center">
<table class='iconframe' cellpadding="0" cellspacing="0">
<tr>
  <td class='imageframe' align="center"> <A HREF="images/personnel/<? echo $arr['user']['p_pic'];?>" class="highslide" onclick="return hs.expand(this)">
	  <img src='images/personnel/thb_<? echo $arr['user']['p_pic'];?>' /></a></td>
  <td class='shadow_right'><div class='shadow_top_right'></div></td>
</tr>
<tr>
  <td class='shadow_bottom'><div class='shadow_bottom_left'></div></td>
  <td class='shadow_bottom_right'></td>
</tr>
</table>
</td>
</tr>
	 <tr >
	  <td align="center"><A HREF="popup.php?name=personnel&file=popdetail&pid=<?=$arr['user']['id'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 250} )" class="highslide"><? echo $arr['user']['p_name'];?><br><b><font color="#CC0000"><? echo $arr['user']['p_position'];?></b><br><? echo $arr['user']['p_data'];?></font></a></td>

</tr>

	<tr>
	<td>
	<table cellspacing="0" cellpadding="0" width="<?=$widthSUM;?>" border="0">
	<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groupstext'] = $db->select_query("SELECT * FROM ".TB_personnel_group." ORDER BY gp_id ");
while ($arr['groupstext'] = $db->fetch($res['groupstext']))
   {
echo "<tr class=off onmouseover=this.className=\"on\" onmouseout=this.className=\"off\">";
echo '<td><ul id="menu" style="list-style:none; padding:0;height:24px;"><li>';
		echo "<A HREF=\"?name=personnel&file=gdetail&id=".$arr['groupstext']['gp_id']."&op=gdetail&gr=".$arr['groupstext']['gp_name']."\"><B>".$arr['groupstext']['gp_name']."</a></li></ul></td></tr>";
   }
$db->closedb ();
?>
<tr bgcolor="#ffffff">
<td  align="right" bgcolor="#ffffff"><A HREF="index.php?name=personnel&file=detail" ><img src="images/admin/2_15.gif"></a></td>
</tr>
</table>
</td>
</tr>
</table>



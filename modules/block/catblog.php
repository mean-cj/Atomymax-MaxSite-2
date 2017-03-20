	<table cellspacing="0" cellpadding="0" width="<?=$widthSUM;?>" border="0">
	<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groupstext'] = $db->select_query("SELECT * FROM ".TB_BLOG_CAT." ORDER BY id ");
while ($arr['groupstext'] = $db->fetch($res['groupstext']))
   {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['row']= $db->select_query("SELECT * FROM ".TB_BLOG." where category='".$arr['groupstext']['id']."' ORDER BY id ");
$row=$db->rows($res['row']);
echo "<tr class=off onmouseover=this.className=\"on\" onmouseout=this.className=\"off\">";
echo '<td><ul id="menu" style="list-style:none; padding:0;height:24px;"><li>';
		echo "<A HREF=\"?name=blog&category=".$arr['groupstext']['id']."\"><B>".$arr['groupstext']['category_name']." ( ".$row." )</a></li></ul></td></tr>";
   }
$db->closedb ();
?>
</table>



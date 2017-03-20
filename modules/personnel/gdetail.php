<?php

echo "<center><font style=\"font-size:14pt\"><b>"._PERSONNEL_MOD_GDETAIL_TITLE."<br><font color=#CC0000>".$_GET['gr']."</font></b></font></center>";
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
echo "<table border=\"0\" width=\"750\"><tr><td>";
echo "<table border=\"0\" width=\"100%\"><tr><td align=\"center\">";
 $sql="SELECT * FROM ".TB_personnel_list." WHERE p_order='1' AND g_id='".$_GET['id']."' ";
 $result = $db->select_query($sql);
 //$num = $db->sql_numrows($result);
 $num = $db->num_rows(TB_personnel_list,"id"," p_order='1' AND g_id='".$_GET['id']."' ");

	if ($num != 0) {
		while ($row = $db->sql_fetchrow($result)) {
			$res['user'] = $db->select_query("SELECT * FROM ".TB_personnel." where id='".$row['u_id']."' ORDER BY sort ");
			$rowx= $db->fetch($res['user']);

			$organization_id =$rowx['id'];
			$org_images =$rowx['p_pic'];
			$org_position  =$rowx['p_position'];
			$org_name =$rowx['p_name'];
			$org_data =$rowx['p_data'];
			$id=$organization_id;
//echo "$org_name";
		echo "<td align=\"center\"><table border=\"0\"><tr><td align=\"center\">";
			if($org_images){echo "<A HREF=\"images/personnel/".$org_images."\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src=\"images/personnel/thb_".$org_images."\" border=0 alt=\""._PERSONNEL_MOD_GDETAIL_DETAIL."\"></a>";} else { echo "<img src=\"images/nopic.jpg\" border=0"; }
			echo "</td></tr>";
			echo "<tr><td align=\"center\" bgcolor=\"#affeff\"><b>"
			."<A HREF=\"popup.php?name=personnel&file=popdetail&pid=".$id."\" onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 250} )\" class=\"highslide\">"
			."$org_name</a></td></tr></b>"
			."<tr><td align=\"center\" bgcolor=\"#affeff\">"
			."<A HREF=\"popup.php?name=personnel&file=popdetail&pid=".$id."\" onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 250} )\" class=\"highslide\">"
			."$org_position</a></td></tr>"
			."<tr><td align=\"center\" bgcolor=\"#aef0ff\">"
			."<A HREF=\"popup.php?name=personnel&file=popdetail&pid=".$id."\" onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 250} )\" class=\"highslide\">"
			."$org_data</a></b></td></tr></table></td>";
			 }
	}
echo "</tr></table></tr></td>";


$nums = $db->num_rows(TB_personnel_list,"id"," g_id='".$_GET['id']."' and p_order !='1' ");
echo "<tr><td><table border=\"0\" width=\"100%\">";

for ($irow=1;$irow <=$nums;$irow++){
$irowx=$irow+1;
echo "<tr><td align=\"center\"><table border=\"0\" width=\"100%\"><tr>";
 $sql="SELECT * FROM ".TB_personnel_list." as a,".TB_personnel." as b WHERE a.p_order='".$irowx."' AND a.g_id='".$_GET['id']."'  and a.u_id=b.id order by b.sort" ;
 $result = $db->select_query($sql);
 $num = $db->rows($result);
//echo "$num";
	if (!empty($num)) {
		while ($row = $db->sql_fetchrow($result)) {
			$res['user'] = $db->select_query("SELECT * FROM ".TB_personnel." where id='".$row['u_id']."' ORDER BY sort ");
			$rowx= $db->fetch($res['user']);
			$organization_id =$rowx['id'];
			$org_images =$rowx['p_pic'];
			$org_position  =$rowx['p_position'];
			$org_name =$rowx['p_name'];
			$org_data =$rowx['p_data'];
			$id=$organization_id;
//echo "$org_name";
		echo "<td align=\"center\"><table border=\"0\"><tr><td align=\"center\">";
			if($org_images){echo "<A HREF=\"images/personnel/".$org_images."\" class=\"highslide\" onclick=\"return hs.expand(this)\"><img src=\"images/personnel/thb_".$org_images."\" border=0 alt=\""._PERSONNEL_MOD_GDETAIL_DETAIL."\"></a>";} else { echo "<img src=\"images/knowledge_blank.gif\" border=0"; }
			echo "</td></tr>";
			echo "<tr><td align=\"center\" bgcolor=\"#affeff\"><b>"
			."<A HREF=\"popup.php?name=personnel&file=popdetail&pid=".$id."\" onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 250} )\" class=\"highslide\">"
			."$org_name</a></td></tr></b>"
			."<tr><td align=\"center\" bgcolor=\"#affeff\">"
			."<A HREF=\"popup.php?name=personnel&file=popdetail&pid=".$id."\" onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 250} )\" class=\"highslide\">"
			."$org_position</a></td></tr>"
			."<tr><td align=\"center\" bgcolor=\"#aef0ff\">"
			."<A HREF=\"popup.php?name=personnel&file=popdetail&pid=".$id."\" onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 250} )\" class=\"highslide\">"
			."$org_data</a></b></td></tr></table></td>";
			 }
	}
echo "</tr></table></td></tr>";

}

echo "</table>";
echo "</td></tr></table>";
echo "<font color=#003399 size=2><b>"._PERSONNEL_MOD_DETAIL_SELECT_CAT."<b></font><br>";
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groupstext'] = $db->select_query("SELECT * FROM ".TB_personnel_group." ORDER BY gp_id ");
while ($arr['groupstext'] = $db->fetch($res['groupstext']))
   {
		echo "<font color=#990000 size=2><A HREF=\"?name=personnel&file=gdetail&id=".$arr['groupstext']['gp_id']."&op=gdetail&gr=".$arr['groupstext']['gp_name']."\"><B>".$arr['groupstext']['gp_id']." : </B>".$arr['groupstext']['gp_name']."</a></font><br>";
   }
$db->closedb ();


?>

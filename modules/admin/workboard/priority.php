	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="780" align=center cellSpacing=0 cellPadding=5 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD >
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp;<?=_WORKBOARD_ADMIN_MENU_TITLE;?></B>
<br>
<?php
######################################################################
# WorkBoard 1.2.0
######################################################################
#
# Copyright (c) 2003 by Burnwave and Nukescripts Network
# http://www.burnwave.com/, http://www.nukescripts.net/
#
######################################################################

CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);


include("modules/admin/workboard/includes/functions.php");
if(ISO=='utf-8'){
include("modules/admin/workboard/language/lang-thai_utf-8.php");
} else {
include("modules/admin/workboard/language/lang-thai.php");
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
#####################################
# Statuses
#####################################

function workboardPriorityList(){
	global $prefix, $db, $bgcolor2;

	workboard_admin_menu();

	echo "<CENTER><FONT CLASS=\"title\"><B>"._WORKBOARD_ADMIN_PRIORITY_PRIORITYLIST."</B></FONT></CENTER>";

	echo "<BR>";
	$priorityresult = $db->select_query("select priority_id, priority_name, priority_weight from ".TB_WORKBOARD_PRIORITIES." order by priority_weight desc");
	$priority_total = $db->rows($priorityresult);

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=3 width=\"100%\" bgcolor=\"$bgcolor2\"><nobr><b>"._WORKBOARD_ADMIN_PRIORITY_PRIORITYOPTIONS."</b></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/options.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr><a href=\"index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityAdd\">"._WORKBOARD_ADMIN_PRIORITY_PRIORITYADD."</a></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/stats.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr>"._WORKBOARD_ADMIN_PRIORITY_TOTALPRIORITIES.": <b>$priority_total</b></nobr></td></tr>";
	echo "</table>";

	echo "<br>";

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=2 bgcolor=\"$bgcolor2\" width=\"100%\"><b>"._WORKBOARD_ADMIN_PRIORITY_PRIORITYLIST."</b></a></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._WORKBOARD_ADMIN_PRIORITY_WEIGHT."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._WORKBOARD_ADMIN_FUNCTIONS."</b></td></tr>";
	if($priority_total != 0){
		while ($pri = $db->fetch($priorityresult)) {
			echo "<tr>";
			echo "<td><img src=\"images/workboard/icons/priority.png\"></td>";
			echo "<td width=\"100%\"><a href=\"index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityEdit&priority_id=$pri[priority_id]\">$pri[priority_name]</a></td>";
			echo "<td align=\"center\">$pri[priority_weight]</td>";
			echo "<td align=\"center\"><NOBR>[ <a href=\"index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityEdit&priority_id=$pri[priority_id]\">"._WORKBOARD_ADMIN_EDIT."</a>";
			echo " | <a href=\"index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityRemove&priority_id=$pri[priority_id]\">"._WORKBOARD_ADMIN_DELETE."</a> ]</NOBR></td>";
			echo "</tr>";
	}
	} else {
		echo "<tr>";
	echo "<td width=\"100%\" colspan=4 align=\"center\">"._WORKBOARD_ADMIN_PRIORITY_NOPRIORITY."</td>";
		echo "</tr>";
	}
	echo "</table>";

}

function workboardPriorityAdd(){
	global $prefix, $db;

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_PRIORITY_PRIORITYADD."</B></CENTER>";

	echo "<BR>";

	echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityInsert\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardPriorityInsert\">"
		."<font class=\"option\"><b>"._WORKBOARD_ADMIN_PRIORITY_PRIORITYADD."</b></font><br><br>"
		.""._WORKBOARD_ADMIN_PRIORITY_PRIORITYNAME.": <input type=\"text\" name=\"priority_name\" size=\"30\"><br>"
		.""._WORKBOARD_ADMIN_PRIORITY_PRIORITYWEIGHT.": <input type=\"text\" name=\"priority_weight\" size=\"3\"><br><br>"
		."<input type=\"submit\" value=\""._WORKBOARD_ADMIN_PRIORITY_PRIORITYADD."\">"
		."</form>";

}

function workboardPriorityInsert($priority_name, $priority_weight){
	global $priority_name, $priority_weight, $db;
				$db->add_db(TB_WORKBOARD_PRIORITIES,array(
			"priority_name"=>"$_POST[priority_name]",
			"priority_weight"=>"$_POST[priority_weight]"
		));
		$db->closedb ();
	header("Location: index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityList");
}

function workboardPriorityEdit($priority_id){
	global $prefix, $db;
	$priorityresult = $db->select_query("select priority_name, priority_weight from ".TB_WORKBOARD_PRIORITIES." where priority_id='$priority_id'");
	$list2= $db->fetch($priorityresult);

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_PRIORITY_EDITPRIORITY."</B></CENTER>";

	echo "<BR>";

	echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityUpdate\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardPriorityUpdate\"><input type=\"hidden\" name=\"priority_id\" value=\"$priority_id\">"
		."<font class=\"option\"><b>"._WORKBOARD_ADMIN_PRIORITY_EDITPRIORITY."</b></font><br><br>"
		.""._WORKBOARD_ADMIN_PRIORITY_PRIORITYNAME.": <input type=\"text\" name=\"priority_name\" size=\"30\" value=\"$list2[priority_name]\"><br>"
		.""._WORKBOARD_ADMIN_PRIORITY_PRIORITYWEIGHT.": <input type=\"text\" name=\"priority_weight\" size=\"3\" value=\"$list2[priority_weight]\"><br><br>"
		."<input type=\"submit\" value=\""._WORKBOARD_ADMIN_PRIORITY_UPDATEPRIORITY."\">"
		."</form>";

}

function workboardPriorityUpdate($priority_id, $priority_name, $priority_weight){
	global $priority_id, $priority_name, $priority_weight, $db;
		$db->update_db(TB_WORKBOARD_PRIORITIES,array(
			"priority_name"=>"$_POST[priority_name]",
			"priority_weight"=>"$_POST[priority_weight]"
		)," priority_id=".$priority_id."");
		$db->closedb ();

	header("Location: index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityList");
}

function workboardPriorityRemove($priority_id){
	global $priority_id, $db;
	$priorityresult = $db->select_query("select priority_name, priority_weight from ".TB_WORKBOARD_PRIORITIES." where priority_id='$priority_id'");
	$list3= $db->fetch($priorityresult);

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_PRIORITY_DELETEPRIORITY."</B></CENTER>";

	echo "<BR>";

	echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityDelete\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardPriorityDelete\"><input type=\"hidden\" name=\"priority_id\" value=\"$priority_id\">";
	echo "<center><b>"._WORKBOARD_ADMIN_PRIORITY_SWAPPRIORITY."</b><br><br>";
	echo "$list3[priority_name] -> ";
	echo "<select name=\"swap_priority_id\">";
	echo "<option value=\"0\">---------</option>";
	$prioritylist = $db->select_query("select priority_id, priority_name from ".TB_WORKBOARD_PRIORITIES." where priority_id != '$priority_id' order by priority_weight");
	while($list= $db->fetch($prioritylist)){
		echo "<option value=\"$list[priority_id]\">$list[priority_name]</option>";
	}
	echo "</select>";
	echo "<br><br><input type=\"submit\" value=\""._WORKBOARD_ADMIN_PRIORITY_DELETEPRIORITY."\"><br>"
		."</form>";

}

function workboardPriorityDelete($priority_id, $swap_priority_id){
	global $prefix, $db;
		$db->del(TB_WORKBOARD_PRIORITIES," priority_id='".$priority_id."' "); 
		$db->update_db(TB_WORKBOARD_TASKS,array(
			"priority_id"=>"$swap_priority_id"
		)," priority_id='".$priority_id."'");
		$db->closedb ();

	header("Location: index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityList");
}

##############
# Cases
##############
switch ($op) {
	
	case "WorkBoardPriorityList":
	workboardPriorityList();
	break;
	
	case "WorkBoardPriorityAdd":
	workboardPriorityAdd();
	break;
	
	case "WorkBoardPriorityInsert":
	workboardPriorityInsert($priority_name, $priority_weight);
	break;
	
	case "WorkBoardPriorityEdit":
	workboardPriorityEdit($priority_id);
	break;
	
	case "WorkBoardPriorityUpdate":
	workboardPriorityUpdate($priority_id, $priority_name, $priority_weight);
	break;
	
	case "WorkBoardPriorityRemove":
	workboardPriorityRemove($priority_id);
	break;
	
	case "WorkBoardPriorityDelete":
	workboardPriorityDelete($priority_id, $swap_priority_id);
	break;
	
}


?>
</td>
</tr>
</table>
</td>
</tr>
</table>

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

function workboardStatusList(){
	global $prefix, $db, $bgcolor2;

	workboard_admin_menu();

	echo "<CENTER><FONT CLASS=\"title\"><B>"._WORKBOARD_ADMIN_STATUS_STATUSLIST."</B></FONT></CENTER>";

	echo "<BR>";
	$statusresult = $db->select_query("select status_id, status_name from ".TB_WORKBOARD_STATUS." order by status_name");
	$status_total = $db->rows($statusresult);

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=3 width=\"100%\" bgcolor=\"$bgcolor2\"><nobr><b>"._WORKBOARD_ADMIN_STATUS_STATUSOPTIONS."</b></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/options.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr><a href=\"index.php?name=admin/workboard&file=status&op=WorkBoardStatusAdd\">"._WORKBOARD_ADMIN_STATUS_STATUSADD."</a></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/stats.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr>"._WORKBOARD_ADMIN_STATUS_TOTALSTATUSES.": <b>$status_total</b></nobr></td></tr>";
	echo "</table>";

	echo "<br>";

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=2 bgcolor=\"$bgcolor2\" width=\"100%\"><b>"._WORKBOARD_ADMIN_STATUS_STATUSLIST."</b></a></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._WORKBOARD_ADMIN_FUNCTIONS."</b></td></tr>";
	if($status_total != 0){
		while ($list = $db->fetch($statusresult)) {
			echo "<tr>";
    		echo "<td><img src=\"images/workboard/icons/status.png\"></td>";
    		echo "<td width=\"100%\"><a href=\"index.php?name=admin/workboard&file=status&op=WorkBoardStatusEdit&status_id=$list[status_id]\">$list[status_name]</a></td>";
    		echo "<td align=\"center\"><NOBR>[ <a href=\"index.php?name=admin/workboard&file=status&op=WorkBoardStatusEdit&status_id=$list[status_id]\">"._WORKBOARD_ADMIN_EDIT."</a>";
			echo " | <a href=\"index.php?name=admin/workboard&file=status&op=WorkBoardStatusRemove&status_id=$list[status_id]\">"._WORKBOARD_ADMIN_DELETE."</a> ]</NOBR></td>";
			echo "</tr>";
    	}
	} else {
		echo "<tr>";
    	echo "<td width=\"100%\" colspan=3 align=\"center\">"._WORKBOARD_ADMIN_STATUS_NOSTATUS."</td>";
		echo "</tr>";
	}
	echo "</table>";

}

function workboardStatusAdd(){
	global $prefix, $db;

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_STATUS_STATUSADD."</B></CENTER>";

    echo "<BR>";

    echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=status&op=WorkBoardStatusInsert\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardStatusInsert\">"
		."<font class=\"option\"><b>"._WORKBOARD_ADMIN_STATUS_STATUSADD."</b></font><br><br>"
		.""._WORKBOARD_ADMIN_STATUS_STATUSNAME.": <input type=\"text\" name=\"status_name\" size=\"30\"><br>"
		.""._WORKBOARD_ADMIN_STATUS_STATUSDESCRIPTION.":<br><textarea name=\"status_description\" cols=\"60\" rows=\"10\"></textarea><br><br>"
		."<input type=\"submit\" value=\""._WORKBOARD_ADMIN_STATUS_STATUSADD."\">"
		."</form>";

}

function workboardStatusInsert($status_name, $status_description){
	global $status_name, $status_description, $db;
					$db->add_db(TB_WORKBOARD_STATUS,array(
			"status_name"=>"$_POST[status_name]",
			"status_description"=>"$_POST[status_description]"
		));
		$db->closedb ();
	header("Location: index.php?name=admin/workboard&file=status&op=WorkBoardStatusList");
}

function workboardStatusEdit($status_id){
	global $status_id, $db;
	$statusresult = $db->select_query("select status_name, status_description from ".TB_WORKBOARD_STATUS." where status_id='$status_id'");
	$list= $db->fetch($statusresult);

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_STATUS_EDITSTATUS."</B></CENTER>";

    echo "<BR>";

    echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=status&op=WorkBoardStatusUpdate\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardStatusUpdate\"><input type=\"hidden\" name=\"status_id\" value=\"$status_id\">"
		."<font class=\"option\"><b>"._WORKBOARD_ADMIN_STATUS_EDITSTATUS."</b></font><br><br>"
		.""._WORKBOARD_ADMIN_STATUS_STATUSNAME.": <input type=\"text\" name=\"status_name\" size=\"30\" value=\"$list[status_name]\"><br>"
		.""._WORKBOARD_ADMIN_STATUS_STATUSDESCRIPTION.":<br><textarea name=\"status_description\" cols=\"60\" rows=\"10\">$list[status_description]</textarea><br><br>"
		."<input type=\"submit\" value=\""._WORKBOARD_ADMIN_STATUS_UPDATESTATUS."\">";

}

function workboardStatusUpdate($status_id, $status_name, $status_description){
	global $status_id, $status_name, $status_description, $db;
		$db->update_db(TB_WORKBOARD_STATUS,array(
			"status_name"=>"$_POST[status_name]",
			"status_description"=>"$_POST[status_description]"
		)," status_id=".$status_id."");
		$db->closedb ();
	header("Location: index.php?name=admin/workboard&file=status&op=WorkBoardStatusList");
}

function workboardStatusRemove($status_id){
	global $status_id, $db;
	$statusresult = $db->select_query("select status_name, status_description from ".TB_WORKBOARD_STATUS." where status_id='$status_id'");
	$list = $db->fetch($statusresult);

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_STATUS_DELETESTATUS."</B></CENTER>";

    echo "<BR>";

	echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=status&op=WorkBoardStatusDelete\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardStatusDelete\"><input type=\"hidden\" name=\"status_id\" value=\"$status_id\">";
	echo "<center><b>"._WORKBOARD_ADMIN_STATUS_SWAPSTATUS."</b><br><br>";
	echo "$list[status_name] -> ";
	echo "<select name=\"swap_status_id\">";
	echo "<option value=\"0\">---------</option>";
	$statuslist = $db->select_query("select status_id, status_name from ".TB_WORKBOARD_STATUS." where status_id != '$status_id' order by status_name");
	while($list2 = $db->fetch($statuslist)){
		echo "<option value=\"$list2[status_id]\">$list2[status_name]</option>";
	}
	echo "</select>";
	echo "<br><br><input type=\"submit\" value=\""._WORKBOARD_ADMIN_STATUS_DELETESTATUS."\"><br>"
		."</form>";

}

function workboardStatusDelete($status_id, $swap_status_id){
	global $status_id, $swap_status_id, $db;
		$db->del(TB_WORKBOARD_STATUS," status_id='".$status_id."' "); 
		$db->update_db(TB_WORKBOARD_TASKS,array(
			"status_id"=>"$swap_status_id"
		)," status_id='".$status_id."'");
		$db->closedb ();
	header("Location: index.php?name=admin/workboard&file=status&op=WorkBoardStatusList");
}

##############
# Cases
##############
switch ($op) {
	
	case "WorkBoardStatusList":
	workboardStatusList();
	break;
	
	case "WorkBoardStatusAdd":
	workboardStatusAdd();
	break;
	
	case "WorkBoardStatusInsert":
	workboardStatusInsert($status_name, $status_description);
	break;
	
	case "WorkBoardStatusEdit":
	workboardStatusEdit($status_id);
	break;
	
	case "WorkBoardStatusUpdate":
	workboardStatusUpdate($status_id, $status_name, $status_description);
	break;
	
	case "WorkBoardStatusRemove":
	workboardStatusRemove($status_id);
	break;
	
	case "WorkBoardStatusDelete":
	workboardStatusDelete($status_id, $swap_status_id);
	break;
	
}


?>
</td>
</tr>
</table>
</td>
</tr>
</table>

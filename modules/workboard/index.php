	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0 >
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_work.png" BORDER="0"><BR>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=5 border=0 >
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
<?php
######################################################################
# WorkBoard 1.2.0
######################################################################
#
# Copyright (c) 2003 by Burnwave and Nukescripts Network
# http://www.burnwave.com/, http://www.nukescripts.net/
#
######################################################################
include("modules/admin/workboard/includes/functions.php");
//include("modules/workboard/language/lang-thai.php");
$bgcolor1="#3399FF";
$bgcolor2="#E9E9E9";
$bgcolor3="#FFCCCC";
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

##################
# Front Page
##################
function index() {
    global $prefix, $db, $bgcolor2, $module_name;

	echo "<center><b>"._WORKBOARD_MODULE_INDEX_TITLE."</b></center>";

	echo "<br>";

	echo "<center>";
	echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\">";
	echo "<td width=100%  align=left colspan=2><b>"._WORKBOARD_MODULE_INDEX_PROJECTNAME."</b></td>";
	echo "<td  align=center><nobr><b>"._WORKBOARD_MODULE_INDEX_STATUS."</b></nobr></td>";
	echo "<td  align=center><nobr><b>"._WORKBOARD_MODULE_INDEX_PERCENT."</b></nobr></td>";
	echo "<td  align=center><nobr><b>"._WORKBOARD_MODULE_INDEX_TASKS."</b></nobr></td>";
	echo "<td  align=center><nobr><b>"._WORKBOARD_MODULE_INDEX_PRIORITY."</b></nobr></td>";
	echo "<td  align=center><nobr><b>"._WORKBOARD_MODULE_INDEX_ASSIGNED."</b></nobr></td>";
	echo "</tr>";
	$projectresult = $db->select_query("SELECT * FROM web_workboard_projects order by project_name");
	while ($project= $db->fetch($projectresult)) {
	$percentresult = $db->select_query("select status_percent, priority_id from web_workboard_tasks where project_id='$project[project_id]'");
	$percentnumber = $db->rows($percentresult);
	if ($project['status_percent'] == 0 AND $percentnumber > 0) {
		$percentoverall = $percentfactor = 0;
		while(list($status_percent, $priority_id) = $db->fetch($percentresult)) {
			$priority = workboard_m_priority_info($priority_id);
			if ($priority['priority_weight'] > 0) {
				$percentoverall = $percentoverall + ($status_percent * $priority['priority_weight']);
				$percentfactor = $percentfactor + $priority['priority_weight'];
			}
		}
		if ($percentnumber > 0 AND $percentfactor > 0) {
			$percenttotal = $percentoverall / $percentfactor;
			$project['status_percent'] = number_format($percenttotal, 0, '.', ',');
		}
	}
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$statusresults = $db->select_query("SELECT * FROM web_workboard_status WHERE status_id='$project[status_id]'");
	$status = $db->fetch($statusresults);

	$priorityresults = $db->select_query("SELECT * FROM web_workboard_priorities WHERE priority_id='$project[priority_id]'");
	$priority = $db->fetch($priorityresults);
		$memberresult = $db->select_query("select member_id from web_workboard_projects_members where project_id='$project[project_id]' order by member_id");
		$member_total = $db->rows($memberresult);
		$taskresult = $db->select_query("SELECT task_id, status_id FROM web_workboard_tasks where project_id='$project[project_id]' order by task_name");
		$taskrows = $db->rows($taskresult);
		echo "<tr>";
		echo "<td align=center><img src=\"images/workboard/icons/project.png\" alt=\""._WORKBOARD_MODULE_INDEX_PROJECTID." #$project_id\"></td>";
		echo "<td align=left width=100%><a href=\"index.php?name=workboard&file=project&project_id=$project[project_id]\">".$project['project_name']."</a></td>";
		echo "<td align=center>";
		if($status['status_name'] != ""){ echo "".$status['status_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_INDEX_NA."</i>"; }
		echo "</td>";
		echo "<td align=center>".$project['status_percent']."</td>";
		echo "<td align=center>$taskrows</td>";
		echo "<td align=center><nobr>";
		if($priority['priority_name'] != ""){ echo "".$priority['priority_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_PROJECT_NA."</i>"; }
		echo "</nobr></td>";
		echo "<td align=center><nobr>$member_total "._WORKBOARD_MODULE_INDEX_MEMBERS."</nobr></td>";
		echo "</tr>";
	}
	echo "<tr class=\"odd\"><td  colspan=7 align=right><a href=\"index.php?name=workboard&file=map\"><b>"._WORKBOARD_MODULE_INDEX_VIEWALL."</b></a></td></tr>";
	echo "</table>";
	echo "</center>";

}


switch($wb_op) {
	
	default:
    index();
    break;

}

?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
			<BR><BR>
			<!-- Admin -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_work.png" BORDER="0"><BR>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
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
function workboardMapView($column, $direction) {
    global $prefix, $db, $bgcolor2, $module_name;

	echo "<center><b>"._WORKBOARD_MODULE_MAP_TITLE."</b></center>";

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

	$statusresults = $db->select_query("SELECT * FROM web_workboard_status WHERE status_id='$project[status_id]'");
	$status = $db->fetch($statusresults);
	$priorityresults = $db->select_query("SELECT * FROM web_workboard_priorities WHERE priority_id='$project[priority_id]'");
	$priority = $db->fetch($priorityresults);
//	echo "$project[project_id]";
$memberresult = $db->select_query("select *,count(project_id) as num from web_workboard_projects_members where project_id='$project[project_id]' group by project_id");
//$member_total = $db->rows($membersresult);
$mem = $db->fetch($memberresult);
		echo "<br>";

		echo "<center>";
		echo "<table width=\"100%\" style=\"background-color: #ffffff; border: 1px solid\" cellspacing=\"0\" cellpadding=\"2\">";
		echo "<tr>";
		echo "<td width=100% bgcolor=\"$bgcolor2\" align=left colspan=2><b>"._WORKBOARD_MODULE_MAP_PROJECT."</b></td>";
		echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_MAP_STATUS."</b></nobr></td>";
		echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_MAP_PERCENT."</b></nobr></td>";
		echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_MAP_PRIORITY."</b></nobr></td>";
		echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_MAP_ASSIGNED."</b></nobr></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td align=center><img src=\"images/workboard/icons/project.png\" alt=\""._WORKBOARD_MODULE_MAP_PROJECTID." #$project_id\"></td>";
		echo "<td align=left width=100%><a href=\"index.php?name=workboard&file=project&project_id=$project[project_id]\">".$project['project_name']."</a></td>";
		echo "<td align=center>";
		if($status['status_name'] != ""){ echo "".$status['status_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_MAP_NA."</i>"; }
		echo "</td>";
		echo "<td align=center>".$project['status_percent']."</td>";
		echo "<td align=center><nobr>";
		if($priority['priority_name'] != ""){ echo "".$priority['priority_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_MAP_NA."</i>"; }
		echo "</nobr></td>";
		echo "<td align=center><nobr>$mem[num] "._WORKBOARD_MODULE_MAP_MEMBERS."</nobr></td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td width=100% bgcolor=\"$bgcolor2\" align=left colspan=6><b>"._WORKBOARD_MODULE_MAP_TASKS."</b></td>";
		echo "</tr>";
		if(!$column) $column = "task_name";
		if(!$direction) $direction = "asc";
$taskresult = $db->select_query("SELECT task_id, task_name, status_percent, priority_id, status_id FROM web_workboard_tasks where project_id='$project[project_id]' order by $column $direction");
		$task_total = $db->rows($taskresult);
		if($task_total != 0){
while ($st= $db->fetch($taskresult)) {
	$statusresults = $db->select_query("SELECT * FROM web_workboard_status WHERE status_id='$st[status_id]'");
	$status = $db->fetch($statusresults);
//	echo "$st[task_id]";
$memberresult = $db->select_query("select *,count(task_id) as ta from web_workboard_tasks_members where task_id='$st[task_id]' group by task_id");
$mems = $db->fetch($memberresult);
	$priorityresults = $db->select_query("SELECT * FROM web_workboard_priorities WHERE priority_id='$st[priority_id]'");
	$priority = $db->fetch($priorityresults);
				echo "<tr>";
				echo "<td><img src=\"images/workboard/icons/task.png\"></td>";
				echo "<td width=\"100%\"><a href=\"index.php?name=workboard&file=task&task_id=$st[task_id]\">$st[task_name]</a></td>";
				echo "<td align=center><nobr>";
				if($status['status_name'] != ""){ echo "".$status['status_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_MAP_NA."</i>"; }
				echo "</nobr></td>";
				echo "<td align=center><nobr>$st[status_percent]</nobr></td>";
				echo "<td align=center><nobr>";
				if($priority['priority_name'] != ""){ echo "".$priority['priority_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_MAP_NA."</i>"; }
				echo "</nobr></td>";
				echo "<td align=center><nobr>$mems[ta] "._WORKBOARD_MODULE_MAP_MEMBERS."</nobr></td>";
				echo "</tr>";
			}
			echo "<tr>";
			echo "<form method=\"post\" action=\"modules.php\">";
			echo "<input type=\"hidden\" name=\"file\" value=\"map\">";
			echo "<input type=\"hidden\" name=\"wb_op\" value=\"ProjectMapTaskSort\">";
			echo "<input type=\"hidden\" name=\"project_id\" value=\"$project[project_id]\">";
			echo "<td align=\"right\" bgcolor=\"$bgcolor2\" width=\"100%\" colspan=6><b>"._WORKBOARD_MODULE_PROJECT_SORT.":</b> ";
			echo "<SELECT NAME=\"column\">";
			if($column == "task_name") $selcolumn1 = "selected";
			echo "<OPTION VALUE=\"task_name\" $selcolumn1>"._WORKBOARD_MODULE_PROJECT_TASKNAME."</OPTION>";
			if($column == "status_id") $selcolumn2 = "selected";
			echo "<OPTION VALUE=\"status_id\" $selcolumn2>"._WORKBOARD_MODULE_PROJECT_STATUS."</OPTION>";
			if($column == "priority_id") $selcolumn3 = "selected";
			echo "<OPTION VALUE=\"priority_id\" $selcolumn3>"._WORKBOARD_MODULE_PROJECT_PRIORITY."</OPTION>";
			echo "</SELECT> ";
			echo "<SELECT NAME=\"direction\">";
			if($direction == "asc") $seldirection1 = "selected";
			echo "<OPTION VALUE=\"asc\" $seldirection1>"._WORKBOARD_MODULE_PROJECT_ASC."</OPTION>";
			if($direction == "desc") $seldirection2 = "selected";
			echo "<OPTION VALUE=\"desc\" $seldirection2>"._WORKBOARD_MODULE_PROJECT_DESC."</OPTION>";
			echo "</SELECT> ";
			echo "<input type=\"submit\" value=\""._WORKBOARD_MODULE_PROJECT_SORT."\">";
			echo "</td></form></tr>";
			echo "<tr>";
		} else {
			echo "<tr>";
			echo "<td width=\"100%\" colspan=6 align=\"center\"><nobr>"._WORKBOARD_MODULE_MAP_NOTASKS."</nobr></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</center>";

	}

}


function workboardProjectMapTaskSort($column, $direction){
	global $prefix, $db, $module_name;
	header("Location: index.php?name=workboard&file=map&column=".$column."&direction=".$direction."");
}
	



switch($wb_op) {

	case "ProjectMapTaskSort":
	workboardProjectMapTaskSort($column, $direction);
	break;
	
	default:
    workboardMapView($column, $direction);
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
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
# Project Page
##################
function workboardViewProject($project_id, $column, $direction) {
    global $project_id, $column, $direction, $db, $bgcolor2, $module_name;


	echo "<center><b>"._WORKBOARD_MODULE_PROJECT_TITLE." $project_id</b></center>";

	echo "<br>";
	$projectresults = $db->select_query("SELECT * FROM web_workboard_projects WHERE project_id='$project_id'");
	$project = $db->fetch($projectresults);
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
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
	$memberresult = $db->select_query("select member_id from web_workboard_projects_members where project_id='$project[project_id]' order by member_id");
	$member_total = $db->rows($memberresult);
	$priorityresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_PRIORITIES." WHERE priority_id='$project[priority_id]'");
	$priority = $db->fetch($priorityresults);
	//PROJECT INFORMATION

	echo "<center><table width=\"100%\" style=\"background-color: #ffffff; border: 1px solid\" cellspacing=\"0\" cellpadding=\"2\">";
	echo "<tr>";
	echo "<td bgcolor=\"$bgcolor2\" width=100% align=left colspan=2><nobr><b>"._WORKBOARD_MODULE_PROJECT_PROJECTNAME."</b></nobr></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_PROJECT_STATUS."</b></nobr></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_PROJECT_PERCENT."</b></nobr></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_PROJECT_PRIORITY."</b></nobr></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align=center><img src=\"images/workboard/icons/project.png\"></td>";
	echo "<td align=left width=100%><nobr>".$project['project_name']."</nobr></td>";
	echo "<td align=center>";
	if($status['status_name'] != ""){ echo "".$status['status_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_PROJECT_NA."</i>"; }
	echo "</td>";
	echo "<td align=center>".$project['status_percent']."</td>";
	echo "<td align=center><nobr>";
	if($priority['priority_name'] != ""){ echo "".$priority['priority_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_PROJECT_NA."</i>"; }
	echo "</nobr></td>";
	echo "</tr>";
	if($project['date_started'] != '0000-00-00 00:00:00' || $project['date_finished'] != '0000-00-00 00:00:00'){
		echo "<tr>";
		echo "<td bgcolor=\"$bgcolor2\" width=100% align=left colspan=5><nobr><b>"._WORKBOARD_MODULE_PROJECT_STATINFO."</b></nobr></td>";
		echo "</tr>";
		if($project['date_started'] != '0000-00-00 00:00:00'){
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/i", $project['date_started'], $start_date);
			$start_date = strftime("%d/%m/%Y", mktime($start_date[4],$start_date[5],$start_date[6],$start_date[2],$start_date[3],$start_date[1]));
			$start_date = ucfirst($start_date);	
			echo "<tr>";
			echo "<td align=center><img src=\"images/workboard/icons/date.png\"></td>";
			echo "<td align=left width=100% colspan=4><nobr>"._WORKBOARD_MODULE_PROJECT_STARTDATE.": <b>".$start_date."</b></nobr></td>";
			echo "</tr>";
		}
		if($project['date_finished'] != '0000-00-00 00:00:00'){
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/i", $project['date_finished'], $finish_date);
			$finish_date = strftime("%d/%m/%Y", mktime($finish_date[4],$finish_date[5],$finish_date[6],$finish_date[2],$finish_date[3],$finish_date[1]));
			$finish_date = ucfirst($finish_date);	
			echo "<tr>";
			echo "<td align=center><img src=\"images/workboard/icons/date.png\"></td>";
			echo "<td align=left width=100% colspan=4><nobr>"._WORKBOARD_MODULE_PROJECT_FINISHDATE.": <b>".$finish_date."</b></nobr></td>";
			echo "</tr>";
		}
	}
	echo "</table>";

	echo "<br>";
	//PROJECT DESCRIPTION
	echo "<table width=\"100%\" style=\"background-color: #ffffff; border: 1px solid\" cellspacing=\"0\" cellpadding=\"2\">";
	echo "<tr>";
	echo "<td align=\"left\" colspan=2 bgcolor=\"$bgcolor2\" width=\"100%\"><nobr><b>"._WORKBOARD_MODULE_PROJECT_PROJECTDETAILS.":</b></nobr></td></tr>";
	echo "<tr><td align=\"left\" colspan=2 bgcolor=\"#ffffff\" width=\"100%\">&nbsp;&nbsp;&nbsp;&nbsp;".$project['project_description']."</td></tr>";
	echo "</table>";
	echo "<br>";
	//PROJECT TASKS
	if(!$column) $column = "task_name";
	if(!$direction) $direction = "asc";

	echo "<table width=\"100%\" style=\"background-color: #ffffff; border: 1px solid\" cellspacing=\"0\" cellpadding=\"2\">";
	echo "<tr>";
	echo "<td align=\"left\" colspan=2 bgcolor=\"$bgcolor2\" width=\"100%\"><nobr><b>"._WORKBOARD_MODULE_PROJECT_PROJECTTASKS."</b></nobr></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_PROJECT_STATUS."</b></nobr></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_PROJECT_PERCENT."</b></nobr></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_PROJECT_PRIORITY."</b></nobr></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_PROJECT_ASSIGNED."</b></nobr></td>";
	echo "</tr>";
	$taskresult = $db->select_query("select task_id, task_name, status_percent, priority_id, status_id from web_workboard_tasks where project_id='$project[project_id]' order by $column $direction");
	$task_total = $db->rows($taskresult);
	if($task_total != 0){
		while ($st = $db->fetch($taskresult)) {
	$statusresults = $db->select_query("SELECT * FROM web_workboard_status WHERE status_id='$st[status_id]'");
	$status = $db->fetch($statusresults);
			$memberresult = $db->select_query("select member_id from web_workboard_tasks_members where task_id='$st[task_id]' order by member_id");
			$member_total = $db->rows($memberresult);
	$priorityresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_PRIORITIES." WHERE priority_id='$st[priority_id]'");
	$priority = $db->fetch($priorityresults);
			echo "<tr>";
			echo "<td><img src=\"images/workboard/icons/task.png\"></td>";
			echo "<td width=\"100%\"><a href=\"index.php?name=workboard&file=task&task_id=$st[task_id]\">$st[task_name]</a></td>";
			echo "<td align=center><nobr>";
			if($status['status_name'] != ""){ echo "".$status['status_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_PROJECT_NA."</i>"; }
			echo "</nobr></td>";
			echo "<td align=center><nobr>$st[status_percent]</nobr></td>";
			echo "<td align=center><nobr>";
			if($priority['priority_name'] != ""){ echo "".$priority['priority_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_PROJECT_NA."</i>"; }
			echo "</nobr></td>";
			echo "<td align=center><nobr>$member_total "._WORKBOARD_MODULE_PROJECT_MEMBERS."</nobr></td>";
			echo "</tr>";
    	}
		echo "<tr>";
		echo "<form method=\"post\" action=\"index.php?name=workboard&file=project\">";
		echo "<input type=\"hidden\" name=\"name\" value=\"workboard\">";
		echo "<input type=\"hidden\" name=\"file\" value=\"project\">";
		echo "<input type=\"hidden\" name=\"wb_op\" value=\"ProjectTaskSort\">";
		echo "<input type=\"hidden\" name=\"project_id\" value=\"$project_id\">";
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
    	echo "<td width=\"100%\" colspan=6 align=\"center\"><nobr>"._WORKBOARD_MODULE_PROJECT_NOTASKS."</nobr></td>";
		echo "</tr>";
	}
	echo "</table>";

	echo "<br>";
	//ASSIGNED MEMBERS

	echo "<center><table width=\"100%\" style=\"background-color: #ffffff; border: 1px solid\" cellspacing=\"0\" cellpadding=\"2\">";
	echo "<tr>";
	echo "<td bgcolor=\"$bgcolor2\" align=left colspan=2><nobr><b>"._WORKBOARD_MODULE_PROJECT_PROJECTMEMBERS."</b></nobr></td><td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_PROJECT_POSITION."</b></nobr></td>";
	echo "</tr>";
	$memberresult = $db->select_query("select member_id, position_id from web_workboard_projects_members where project_id='$project[project_id]' order by member_id");
	$member_total = $db->rows($memberresult);
	if($member_total != 0){
		while ($sed= $db->fetch($memberresult)) {
	$memberresults = $db->select_query("SELECT * FROM web_workboard_members WHERE member_id='$sed[member_id]'");
	$member = $db->fetch($memberresults);
	$positionresults = $db->select_query("SELECT * FROM web_workboard_positions WHERE position_id='$sed[position_id]'");
	$position = $db->fetch($positionresults);
			echo "<tr><td><img src=\"images/workboard/icons/member.png\"></td><td width=\"100%\" align=\"left\"><a href=\"mailto: ".workboard_encode_email($member['member_email'])."\">".$member['member_name']."</a></td><td>";
			if($position['position_name'] != ""){ echo "<nobr>".$position['position_name']."</nobr>"; } else { echo "&nbsp;"; }
			echo "</td>";
		}
	} else {
		echo "<tr><td colspan=3><center><nobr>"._WORKBOARD_MODULE_PROJECT_NOMEMBERS."</nobr></center></td></tr>";
	}
	echo "</table>";

}

function workboardProjectSort($project_id, $column, $direction){
	global $project_id, $column, $direction, $db, $module_name;
	header("Location: index.php?name=workboard&file=project&project_id=".$project_id."&column=".$column."&direction=".$direction."");
}

switch($wb_op) {
	
	case "ProjectTaskSort":
	workboardProjectSort($project_id, $column, $direction);
	break;
	
	default:
    workboardViewProject($project_id, $column, $direction);
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
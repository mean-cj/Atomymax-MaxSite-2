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
# Task Page
##################
function workboardViewTask($task_id) {
    global $prefix, $db, $bgcolor2, $module_name;


	echo "<center><b>"._WORKBOARD_MODULE_TASK_TITLE." $task_id</b></center>";

	echo "<br>";
	$taskresult = $db->select_query("SELECT task_id, project_id, status_id,priority_id FROM web_workboard_tasks where task_id='$task_id'");
	$st= $db->fetch($taskresult);
	$taskresults = $db->select_query("SELECT * FROM web_workboard_tasks WHERE task_id='$st[task_id]'");
	$task = $db->fetch($taskresults);
	$projectresults = $db->select_query("SELECT * FROM web_workboard_projects WHERE project_id='$st[project_id]'");
	$project = $db->fetch($projectresults);
	$percentresult = $db->select_query("select status_percent, priority_id from web_workboard_tasks where project_id='$st[project_id]'");
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

	$statusresults = $db->select_query("SELECT * FROM web_workboard_status WHERE status_id='$st[status_id]'");
	$status = $db->fetch($statusresults);
	$priorityresults = $db->select_query("SELECT * FROM web_workboard_priorities WHERE priority_id='$st[priority_id]'");
	$priority = $db->fetch($priorityresults);
	//TASK INFORMATION

	echo "<center><table width=\"100%\" style=\"background-color: #ffffff; border: 1px solid\" cellspacing=\"0\" cellpadding=\"2\">";
	echo "<tr>";
	echo "<td bgcolor=\"$bgcolor2\" width=100% align=left colspan=5><nobr><b>"._WORKBOARD_MODULE_TASK_PROJECTNAME."</b></nobr></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align=center><img src=\"images/workboard/icons/project.png\"></td>";
	echo "<td align=left width=100% colspan=4><nobr><a href=\"index.php?name=workboard&file=project&project_id=$project[project_id]\">".$project['project_name']."</a></nobr></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td bgcolor=\"$bgcolor2\" width=100% align=left colspan=2><nobr><b>"._WORKBOARD_MODULE_TASK_TASKNAME."</b></nobr></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>Status</b></nobr></td><td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_TASK_PERCENT."</b></nobr></td>";
	echo "<td bgcolor=\"$bgcolor2\" align=center><nobr><b>"._WORKBOARD_MODULE_TASK_PRIORITY."</b></nobr></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td align=center><img src=\"images/workboard/icons/task.png\"></td>";
	echo "<td align=left width=100%><nobr>".$task['task_name']."</nobr></td>";
	echo "<td align=center><nobr>";
	if($status['status_name'] != ""){ echo "".$status['status_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_TASK_NA."</i>"; }
	echo "</nobr></td>";
	echo "<td align=center><nobr>".$task['status_percent']."</nobr></td>";
	echo "<td align=center><nobr>";
	if($priority['priority_name'] != ""){ echo "".$priority['priority_name'].""; } else { echo "<i>"._WORKBOARD_MODULE_PROJECT_NA."</i>"; }
	echo "</nobr></td>";
	echo "</tr>";
	if($task['date_started'] != '0000-00-00 00:00:00' || $task['date_finished'] != '0000-00-00 00:00:00'){
		echo "<tr>";
		echo "<td bgcolor=\"$bgcolor2\" width=100% align=left colspan=5><nobr><b>"._WORKBOARD_MODULE_TASK_STATINFO."</b></nobr></td>";
		echo "</tr>";
		if($task['date_started'] != '0000-00-00 00:00:00'){
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/i", $task['date_started'], $start_date);
			$start_date = strftime("%d/%m/ %Y", mktime($start_date[4],$start_date[5],$start_date[6],$start_date[2],$start_date[3],$start_date[1]));
			$start_date = ucfirst($start_date);
			echo "<tr>";
			echo "<td align=center><img src=\"images/workboard/icons/date.png\"></td>";
			echo "<td align=left width=100% colspan=4><nobr>"._WORKBOARD_MODULE_TASK_STARTDATE.": <b>".$start_date."</b></nobr></td>";
			echo "</tr>";
		}
		if($task['date_finished'] != '0000-00-00 00:00:00'){
			preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/i", $task['date_finished'], $finish_date);
			$finish_date = strftime("%d/%m/ %Y", mktime($finish_date[4],$finish_date[5],$finish_date[6],$finish_date[2],$finish_date[3],$finish_date[1]));
			$finish_date = ucfirst($finish_date);	
			echo "<tr>";
			echo "<td align=center><img src=\"images/workboard/icons/date.png\"></td>";
			echo "<td align=left width=100% colspan=4><nobr>"._WORKBOARD_MODULE_TASK_FINISHDATE.": <b>".$finish_date."</b></nobr></td>";
			echo "</tr>";
		}
	}
	echo "</table>";

	echo "<br>";
	//TASK DESCRIPTION

	echo "<b>"._WORKBOARD_MODULE_TASK_TASKDETAILS.":</b><br><br>";
	echo "".$task['task_description']."";

	echo "<br>";
	//ASSIGNED MEMBERS

	echo "<center><table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\">";
	echo "<tr>";
	echo "<td bgcolor=\"$bgcolor2\" align=left colspan=2><nobr><b>"._WORKBOARD_MODULE_TASK_MEMBERS."</b></nobr></td>";
	echo "</tr>";
	$memberresult = $db->select_query("select member_id from web_workboard_tasks_members where task_id='$task_id' order by member_id");
	$member_total = $db->rows($memberresult);
	if($member_total != 0){
		while ($md = $db->fetch($memberresult)) {
	$memberresults = $db->select_query("SELECT * FROM web_workboard_members WHERE member_id='$md[member_id]'");
	$member = $db->fetch($memberresults);
			echo "<tr><td><img src=\"images/workboard/icons/member.png\"></td><td width=\"100%\" align=\"left\"><a href=\"mailto: ".workboard_encode_email($member['member_email'])."\">".$member['member_name']."</a></td>";
		}
	} else {
		echo "<tr><td colspan=2>"._WORKBOARD_MODULE_TASK_NOMEMBERS."</td></tr>";
	}
	echo "</table>";

}

switch($wb_op) {
	
	default:
    workboardViewTask($task_id);
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
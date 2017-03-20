<?php
######################################################################
# WorkBoard 1.2.0
######################################################################
#
# Copyright (c) 2003 by Burnwave and Nukescripts Network
# http://www.burnwave.com/, http://www.nukescripts.net/
#
######################################################################
require_once("includes/config.in.php");
require_once("includes/class.mysql.php");
require_once("includes/function.in.php");

function workboard_admin_menu(){

    //GraphicAdmin();
echo "<br>";
    echo "<TABLE ALIGN=\"left\" WIDTH=\"95%\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=#EEEEEE>";
    echo "<TR>";
    echo "<TD >";
    echo "<IMG SRC=\"images/admin/open.gif\"  BORDER=\"0\" align=\"absmiddle\"><A href=\"index.php?name=admin/workboard&file=index&op=WorkBoardIndex\"><b>"._WORKBOARD_ADMIN_FUNCTIONS_MENU_MAINMENU."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<IMG SRC=\"images/admin/book.gif\"  BORDER=\"0\" align=\"absmiddle\"><A href=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectList\"><b>"._WORKBOARD_ADMIN_FUNCTIONS_MENU_PROJECTS."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<IMG SRC=\"images/admin/folders.gif\"  BORDER=\"0\" align=\"absmiddle\"><A href=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskList\"><b>"._WORKBOARD_ADMIN_FUNCTIONS_MENU_TASKS."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<IMG SRC=\"images/admin/opendir.gif\"  BORDER=\"0\" align=\"absmiddle\"><A href=\"index.php?name=admin/workboard&file=status&op=WorkBoardStatusList\"><b>"._WORKBOARD_ADMIN_FUNCTIONS_MENU_STATUSES."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<IMG SRC=\"images/admin/share.gif\"  BORDER=\"0\" align=\"absmiddle\"><A href=\"index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityList\"><b>"._WORKBOARD_ADMIN_FUNCTIONS_MENU_PRIORITIES."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<IMG SRC=\"images/admin/user.gif\"  BORDER=\"0\" align=\"absmiddle\"><A href=\"index.php?name=admin/workboard&file=members&op=WorkBoardMemberList\"><b>"._WORKBOARD_ADMIN_FUNCTIONS_MENU_MEMBERS."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<IMG SRC=\"images/admin/admins.gif\"  BORDER=\"0\" align=\"absmiddle\"><A href=\"index.php?name=admin/workboard&file=positions&op=WorkBoardPositionList\"><b>"._WORKBOARD_ADMIN_FUNCTIONS_MENU_POSITIONS."</a>&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "</TD>";
    echo "</TR>";
    echo "</TABLE>";

    echo "<br>";
	echo "<br>";
		echo "<br>";
}

function workboard_project_info($project_id){
global $db, $project_id;
	$projectresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_PROJECTS." WHERE project_id='$project_id'");
	$project = $db->fetch($projectresults);
	return $project;
}

function workboard_task_info($task_id){
global $db, $task_id;
	$taskresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_TASKS."  WHERE task_id='$task_id'");
	$task = $db->fetch($taskresults);
	return $task;
}

function workboard_member_info($member_id){
global $db, $member_id;
	$memberresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_MEMBERS."  WHERE member_id='$member_id'");
	$member = $db->fetch($memberresults);
	return $member;
}

function workboard_status_info($status_id){
global $db, $status_id;
	$statusresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_STATUS." WHERE status_id='$status_id'");
	$status = $db->fetch($statusresults);
	return $status;
}

function workboard_position_info($position_id){
global $db, $position_id;
	$positionresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_POSITIONS." WHERE position_id='$position_id'");
	$position = $db->fetch($positionresults);
	return $position;
}

function workboard_priority_info($priority_id){
global $db, $priority_id;
	$priorityresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_PRIORITIES." WHERE priority_id='$priority_id'");
	$priority = $db->fetch($priorityresults);
	return $priority;
}
function workboard_m_project_info($project_id){
	global $project_id, $db;
	$projectresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_PROJECTS." WHERE project_id='$project_id'");
	$project = $db->fetch($projectresults);
	$percentresult = $db->select_query("select status_percent, priority_id from ".TB_WORKBOARD_TASKS." where project_id='$project_id'");
	$percentnumber = $db->rows();
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
	return $project;
}

function workboard_m_task_info($task_id){
	global $task_id, $db;
	$taskresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_TASKS." WHERE task_id='$task_id'");
	$task = $db->fetch($taskresults);
	return $task;
}

function workboard_m_member_info($member_id){
	global $member_id, $db;
	$memberresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_MEMBERS." WHERE member_id='$member_id'");
	$member = $db->fetch($memberresults);
	return $member;
}

function workboard_m_status_info($status_id){
	global $status_id, $db;
	$statusresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_STATUS." WHERE status_id='$status_id'");
	$status = $db->fetch($statusresults);
	return $status;
}

function workboard_m_position_info($position_id){
	global $position_id, $db;
	$positionresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_POSITIONS." WHERE position_id='$position_id'");
	$position = $db->fetch($positionresults);
	return $position;
}

function workboard_m_priority_info($priority_id){
	global $priority_id, $db;
	$priorityresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_PRIORITIES." WHERE priority_id='$priority_id'");
	$priority = $db->fetch($priorityresults);
	return $priority;
}

function workboard_encode_email($email_address){
	$encoded = bin2hex("$email_address");
	$encoded = chunk_split($encoded, 2, '%');
	$encoded = '%' . substr($encoded, 0, strlen($encoded) - 1);
	return $encoded;
}
?>
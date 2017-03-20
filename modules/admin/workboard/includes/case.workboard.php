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

switch($op) {

	case "WorkBoardIndex":
	include("modules/admin/workboard/index.php");
	break;

	case "WorkBoardMemberList":
	case "WorkBoardMemberAdd":
	case "WorkBoardMemberInsert":
	case "WorkBoardMemberEdit":
	case "WorkBoardMemberUpdate":
	case "WorkBoardMemberRemove":
	case "WorkBoardMemberDelete":
	include("modules/admin/workboard/members.php");
	break;

	case "WorkBoardPositionList":
	case "WorkBoardPositionAdd":
	case "WorkBoardPositionInsert":
	case "WorkBoardPositionEdit":
	case "WorkBoardPositionUpdate":
	case "WorkBoardPositionRemove":
	case "WorkBoardPositionDelete":
	include("modules/admin/workboard/positions.php");
	break;


	case "WorkBoardProjectList":
	case "WorkBoardProjectTasks":
	case "WorkBoardProjectAdd":
	case "WorkBoardProjectInsert":
	case "WorkBoardProjectEdit":
	case "WorkBoardProjectUpdate":
	case "WorkBoardProjectMembersUpdate":
	case "WorkBoardProjectRemove":
	case "WorkBoardProjectDelete":
	include("modules/admin/workboard/projects.php");
	break;

	case "WorkBoardTaskList":
	case "WorkBoardTaskListRedirection":
	case "WorkBoardTaskAdd":
	case "WorkBoardTaskInsert":
	case "WorkBoardTaskEdit":
	case "WorkBoardTaskUpdate":
	case "WorkBoardTaskMembersUpdate":
	case "WorkBoardTaskRemove":
	case "WorkBoardTaskDelete":
	include("modules/admin/workboard/tasks.php");
	break;

	case "WorkBoardStatusList":
	case "WorkBoardStatusAdd":
	case "WorkBoardStatusInsert":
	case "WorkBoardStatusEdit":
	case "WorkBoardStatusUpdate":
	case "WorkBoardStatusRemove":
	case "WorkBoardStatusDelete":
	include("modules/admin/workboard/status.php");
	break;

	case "WorkBoardPriorityList":
	case "WorkBoardPriorityAdd":
	case "WorkBoardPriorityInsert":
	case "WorkBoardPriorityEdit":
	case "WorkBoardPriorityUpdate":
	case "WorkBoardPriorityRemove":
	case "WorkBoardPriorityDelete":
	include("modules/admin/workboard/priority.php");
	break;

}

?>

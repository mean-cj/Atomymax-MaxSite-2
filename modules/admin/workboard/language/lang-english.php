<?php
######################################################################
# WorkBoard 1.2.0
######################################################################
#
# Copyright (c) 2003 by Burnwave and Nukescripts Network
# http://www.burnwave.com/, http://www.nukescripts.net/
#
######################################################################

#############################################
# CORE SYSTEM
# DIR: admin/modules/workboard/
#############################################
######################################################################
# Global Admin Definitions
######################################################################
define("_WORKBOARD_ADMIN_EDIT","Edit");
define("_WORKBOARD_ADMIN_DELETE","Delete");
define("_WORKBOARD_ADMIN_YES","Yes");
define("_WORKBOARD_ADMIN_NO","No");
define("_WORKBOARD_ADMIN_FUNCTIONS","Functions");
define("_WORKBOARD_ADMIN_UPDATE","Update");
define("_WORKBOARD_ADMIN_ACTIVATE","Activate");
define("_WORKBOARD_ADMIN_DEACTIVATE","Deactivate");

######################################################################
# From file: members.php
######################################################################
define("_WORKBOARD_ADMIN_MEMBERS_MEMBERLIST","Member List");
define("_WORKBOARD_ADMIN_MEMBERS_MEMBEROPTIONS","Member Options / Statistics");
define("_WORKBOARD_ADMIN_MEMBERS_MEMBERADD","Add Member");
define("_WORKBOARD_ADMIN_MEMBERS_TOTALMEMBERS","Members");
define("_WORKBOARD_ADMIN_MEMBERS_MEMBERNAME","Member's Name");
define("_WORKBOARD_ADMIN_MEMBERS_MEMBEREMAIL","Member's Email");
define("_WORKBOARD_ADMIN_MEMBERS_NOMEMBERS","There are no members in the database.");
define("_WORKBOARD_ADMIN_MEMBERS_EDITMEMBER","Edit Status");
define("_WORKBOARD_ADMIN_MEMBERS_UPDATEMEMBER","Update Member");
define("_WORKBOARD_ADMIN_MEMBERS_DELETESTATUS","Delete Member");
define("_WORKBOARD_ADMIN_MEMBERS_SWAPMEMBER","In order to delete this member, please choose a replacement for associated tasks.");

######################################################################
# From file: index.php
######################################################################
define("_WORKBOARD_ADMIN_INDEX_PROJECTS","Projects");
define("_WORKBOARD_ADMIN_INDEX_PROJECTSDESC","Manage projects.");
define("_WORKBOARD_ADMIN_INDEX_TASKS","Tasks");
define("_WORKBOARD_ADMIN_INDEX_TASKSDESC","Manage project tasks.");
define("_WORKBOARD_ADMIN_INDEX_MEMBERS","Members");
define("_WORKBOARD_ADMIN_INDEX_MEMBERSDESC","Manage members.");
define("_WORKBOARD_ADMIN_INDEX_PRIORITIES","Priorities");
define("_WORKBOARD_ADMIN_INDEX_PRIORITIESDESC","Manage task priorities.");
define("_WORKBOARD_ADMIN_INDEX_STATUSES","Statuses");
define("_WORKBOARD_ADMIN_INDEX_STATUSESDESC","Manage task statuses.");
define("_WORKBOARD_ADMIN_INDEX_POSITIONS","Positions");
define("_WORKBOARD_ADMIN_INDEX_POSITIONSDESC","Manage project positions.");
define("_WORKBOARD_ADMIN_INDEX_COPYRIGHT","© 2003-2004 <B>WorkBoard</B> || <a href=\"http://www.burnwave.com\"><b>Burnwave, Ltd.</b></a>, <a href=\"http://www.nukescripts.net\"><b>NukeScripts Network</b></a>");

######################################################################
# From file: positions.php
######################################################################
define("_WORKBOARD_ADMIN_POSITION_POSITIONLIST","Position List");
define("_WORKBOARD_ADMIN_POSITION_POSITIONOPTIONS","Pn ositioOptions");
define("_WORKBOARD_ADMIN_POSITION_POSITIONADD","Add Position");
define("_WORKBOARD_ADMIN_POSITION_POSITIONNAME","Position Name");
define("_WORKBOARD_ADMIN_POSITION_POSITIONDESCRIPTION","Position Description");
define("_WORKBOARD_ADMIN_POSITION_NOPOSITIONS","There are no positions in the database.");
define("_WORKBOARD_ADMIN_POSITION_EDITPOSITION","Edit Position");
define("_WORKBOARD_ADMIN_POSITION_UPDATEPOSITION","Update Position");
define("_WORKBOARD_ADMIN_POSITION_DELETEPOSITION","Delete Position");
define("_WORKBOARD_ADMIN_POSITION_TOTALPOSITIONS","Total Positions");
define("_WORKBOARD_ADMIN_POSITION_SWAPPOSITION","In order to delete this position, please choose a replacement for members.");

######################################################################
# From file: priority.php
######################################################################
define("_WORKBOARD_ADMIN_PRIORITY_PRIORITYLIST","Priority List");
define("_WORKBOARD_ADMIN_PRIORITY_PRIORITYOPTIONS","Priority Options");
define("_WORKBOARD_ADMIN_PRIORITY_PRIORITYADD","Add Priority");
define("_WORKBOARD_ADMIN_PRIORITY_PRIORITYNAME","Priority Name");
define("_WORKBOARD_ADMIN_PRIORITY_PRIORITYWEIGHT","Priority Weight");
define("_WORKBOARD_ADMIN_PRIORITY_NOPRIORITY","There are no priorities in the database.");
define("_WORKBOARD_ADMIN_PRIORITY_EDITPRIORITY","Edit Priority");
define("_WORKBOARD_ADMIN_PRIORITY_UPDATEPRIORITY","Update Priority");
define("_WORKBOARD_ADMIN_PRIORITY_DELETEPRIORITY","Delete Priority");
define("_WORKBOARD_ADMIN_PRIORITY_TOTALPRIORITIES","Total Priorities");
define("_WORKBOARD_ADMIN_PRIORITY_WEIGHT","Weight");
define("_WORKBOARD_ADMIN_PRIORITY_SWAPPRIORITY","In order to delete this priority, please choose a replacement for associated tasks.");

######################################################################
# From file: projects.php
######################################################################
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTLIST","Project List");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTOPTIONS","Project Options / Statistics");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTADD","Add Project");
define("_WORKBOARD_ADMIN_PROJECTS_TASKS","Tasks");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTNAME","Project Name");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTDESCRIPTION","Project Description");
define("_WORKBOARD_ADMIN_PROJECTS_NOPROJECTS","There are no projects in the database.");
define("_WORKBOARD_ADMIN_PROJECTS_EDITPROJECT","Edit Project");
define("_WORKBOARD_ADMIN_PROJECTS_UPDATEPROJECT","Update Project");
define("_WORKBOARD_ADMIN_PROJECTS_DELETEPROJECT","Delete Project");
define("_WORKBOARD_ADMIN_PROJECTS_CONFIRMDELETE","Deleting this project will delete all tasks associated with it.");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTTASKLIST","Project Task List");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECT","Project");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTS","Projects");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTTASKS","Project Tasks");
define("_WORKBOARD_ADMIN_PROJECTS_ADDTASK","Add Task");
define("_WORKBOARD_ADMIN_PROJECTS_TASKSTATUS","Status");
define("_WORKBOARD_ADMIN_PROJECTS_TOTALPROJECTS","Total Projects");
define("_WORKBOARD_ADMIN_PROJECTS_TOTALTASKS","Total Tasks");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTMEMBERS","Project Members");
define("_WORKBOARD_ADMIN_PROJECTS_NOTASKS","There are no tasks associated with this project.");
define("_WORKBOARD_ADMIN_PROJECTS_NOMEMBERS","There are no members associated with this project.");
define("_WORKBOARD_ADMIN_PROJECTS_ASSIGNMEMBERS","Assign Members");
define("_WORKBOARD_ADMIN_PROJECTS_STATUSPERCENT","Status Percentage");
define("_WORKBOARD_ADMIN_PROJECTS_STATUSPERCENT_CALCULATE","(0 = Calculate Percentage from Tasks)");
define("_WORKBOARD_ADMIN_PROJECTS_STATUS","Status");
define("_WORKBOARD_ADMIN_PROJECTS_STARTDATE","Start Date");
define("_WORKBOARD_ADMIN_PROJECTS_PRIORITY","Priority");
define("_WORKBOARD_ADMIN_PROJECTS_FINISHDATE","Finish Date");


######################################################################
# From file: status.php
######################################################################
define("_WORKBOARD_ADMIN_STATUS_STATUSLIST","Status List");
define("_WORKBOARD_ADMIN_STATUS_STATUSOPTIONS","Status Options");
define("_WORKBOARD_ADMIN_STATUS_STATUSADD","Add Status");
define("_WORKBOARD_ADMIN_STATUS_STATUSNAME","Status Name");
define("_WORKBOARD_ADMIN_STATUS_STATUSDESCRIPTION","Status Description");
define("_WORKBOARD_ADMIN_STATUS_NOSTATUS","There are no statuses in the database.");
define("_WORKBOARD_ADMIN_STATUS_EDITSTATUS","Edit Status");
define("_WORKBOARD_ADMIN_STATUS_UPDATESTATUS","Update Status");
define("_WORKBOARD_ADMIN_STATUS_DELETESTATUS","Delete Status");
define("_WORKBOARD_ADMIN_STATUS_TOTALSTATUSES","Total Statuses");
define("_WORKBOARD_ADMIN_STATUS_SWAPSTATUS","In order to delete this status, please choose a replacement for associated tasks.");

######################################################################
# From file: tasks.php
######################################################################
define("_WORKBOARD_ADMIN_TASKS_PRIORITY","Priority");
define("_WORKBOARD_ADMIN_TASKS_TASKLIST","Task List");
define("_WORKBOARD_ADMIN_TASKS_TASKOPTIONS","Task Options / Statistics");
define("_WORKBOARD_ADMIN_TASKS_TASKADD","Add Task");
define("_WORKBOARD_ADMIN_TASKS_TASKNAME","Task Name");
define("_WORKBOARD_ADMIN_TASKS_TASKDESCRIPTION","Task Description");
define("_WORKBOARD_ADMIN_TASKS_PROJECTNAME","Project");
define("_WORKBOARD_ADMIN_TASKS_ASSIGNMEMBERS","Assign Members");
define("_WORKBOARD_ADMIN_TASKS_TASKDESCRIPTION","Task Description");
define("_WORKBOARD_ADMIN_TASKS_NOTASKS","There are no tasks in the database.");
define("_WORKBOARD_ADMIN_TASKS_EDITTASK","Edit Task");
define("_WORKBOARD_ADMIN_TASKS_UPDATETASK","Update Task");
define("_WORKBOARD_ADMIN_TASKS_DELETETASK","Delete Task");
define("_WORKBOARD_ADMIN_TASKS_TOTALTASKS","Total Tasks");
define("_WORKBOARD_ADMIN_TASKS_PROJECT","Project");
define("_WORKBOARD_ADMIN_TASKS_ASSIGNEDMEMBERS","Assigned Members");
define("_WORKBOARD_ADMIN_TASKS_NONEASSIGNED","There are no assigned members to this task.");
define("_WORKBOARD_ADMIN_TASKS_STATUS","Status");
define("_WORKBOARD_ADMIN_TASKS_ASC","ASC");
define("_WORKBOARD_ADMIN_TASKS_DESC","DESC");
define("_WORKBOARD_ADMIN_TASKS_SORT","Sort");
define("_WORKBOARD_ADMIN_TASKS_TASKID","Task ID");
define("_WORKBOARD_ADMIN_TASKS_PROJECTID","Project ID");
define("_WORKBOARD_ADMIN_TASKS_MEMBERID","Member ID");
define("_WORKBOARD_ADMIN_TASKS_STATUSPERCENT","Status Percentage");
define("_WORKBOARD_ADMIN_TASKS_STATUSID","Status ID");
define("_WORKBOARD_ADMIN_TASKS_PRIORITYID","Priority ID");
define("_WORKBOARD_ADMIN_TASKS_PAGE","Page");
define("_WORKBOARD_ADMIN_TASKS_OF","of");
define("_WORKBOARD_ADMIN_TASKS_CONFIRMDELETE","Are you sure you want to delete this task?");
define("_WORKBOARD_ADMIN_TASKS_STARTDATE","Start Date");
define("_WORKBOARD_ADMIN_TASKS_FINISHDATE","Finish Date");
define("_WORKBOARD_ADMIN_TASKS_NA","N/A");

######################################################################
# From file: includes/functions.php
######################################################################
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU","WorkBoard Administration");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_MAINMENU","Main Menu");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_TASKS","Tasks");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_POSITIONS","Positions");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_PRIORITIES","Priorities");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_PROJECTS","Projects");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_STATUSES","Statuses");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_MEMBERS","Members");

?>
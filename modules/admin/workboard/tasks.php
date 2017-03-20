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
include ("editor.php");

CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);


include("modules/admin/workboard/includes/functions.php");
if(ISO=='utf-8'){
include("modules/admin/workboard/language/lang-thai_utf-8.php");
} else {
include("modules/admin/workboard/language/lang-thai.php");
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
#####################################
# Tasks
#####################################

function workboardTaskList($page, $per_page, $column, $direction){
    global $page, $per_page, $column, $direction, $db, $bgcolor2;
	if(!$page) $page = 1;
	if(!$per_page) $per_page = 25;
	if(!$column) $column = "project_id";
	if(!$direction) $direction = "desc";
	
	workboard_admin_menu();
	
	echo "<CENTER><FONT CLASS=\"title\"><B>"._WORKBOARD_ADMIN_TASKS_TASKLIST."</B></FONT></CENTER>";
	
	echo "<BR>";
	
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=3 bgcolor=\"$bgcolor2\"><nobr><b>"._WORKBOARD_ADMIN_TASKS_TASKOPTIONS."</b></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/options.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr><a href=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskAdd\">"._WORKBOARD_ADMIN_TASKS_TASKADD."</a></nobr></td></tr>";
	$taskrows = $db->rows($db->select_query("select task_id from ".TB_WORKBOARD_TASKS.""));
	echo "<tr><td><img src=\"images/workboard/icons/stats.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr>"._WORKBOARD_ADMIN_TASKS_TOTALTASKS.": <b>$taskrows</b></nobr></td></tr>";
	echo "</table>";
	
	echo "<BR>";
	//Page Counter
	$total_pages = ($taskrows / $per_page);
	$total_pages_quotient = ($taskrows % $per_page);
	if($total_pages_quotient != 0){
		$total_pages = ceil($total_pages);
	}
	$start_list = ($per_page * ($page-1));
	$end_list = $per_page;
	//End Page Counter
	
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	//Navigation Options
	echo "<tr class=\"odd\"><form method=\"post\" action=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskListRedirection\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardTaskListRedirection\"><td align=\"right\" bgcolor=\"$bgcolor2\" width=\"100%\" colspan=5><b>"._WORKBOARD_ADMIN_TASKS_SORT.":</b> ";
	echo "<SELECT NAME=\"column\">";
	if($column == "task_id") $selcolumn1 = "selected";
	echo "<OPTION VALUE=\"task_id\" $selcolumn1>"._WORKBOARD_ADMIN_TASKS_TASKID."</OPTION>";
	if($column == "project_id") $selcolumn2 = "selected";
	echo "<OPTION VALUE=\"project_id\" $selcolumn2>"._WORKBOARD_ADMIN_TASKS_PROJECTID."</OPTION>";
	if($column == "status_id") $selcolumn3 = "selected";
	echo "<OPTION VALUE=\"status_id\" $selcolumn3>"._WORKBOARD_ADMIN_TASKS_STATUSID."</OPTION>";
	if($column == "priority_id") $selcolumn4 = "selected";
	echo "<OPTION VALUE=\"priority_id\" $selcolumn4>"._WORKBOARD_ADMIN_TASKS_PRIORITYID."</OPTION>";
	echo "</SELECT> ";
	echo "<SELECT NAME=\"direction\">";
	if($direction == "asc") $seldirection1 = "selected";
	echo "<OPTION VALUE=\"asc\" $seldirection1>"._WORKBOARD_ADMIN_TASKS_ASC."</OPTION>";
	if($direction == "desc") $seldirection2 = "selected";
	echo "<OPTION VALUE=\"desc\" $seldirection2>"._WORKBOARD_ADMIN_TASKS_DESC."</OPTION>";
	echo "</SELECT> ";
	echo "<SELECT NAME=\"per_page\">";
	if($per_page == 5) $selperpage1 = "selected";
	echo "<OPTION VALUE=\"5\" $selperpage1>5</OPTION>";
	if($per_page == 10) $selperpage2 = "selected";
	echo "<OPTION VALUE=\"10\" $selperpage2>10</OPTION>";
	if($per_page == 25) $selperpage3 = "selected";
	echo "<OPTION VALUE=\"25\" $selperpage3>25</OPTION>";
	if($per_page == 50) $selperpage4 = "selected";
	echo "<OPTION VALUE=\"50\" $selperpage4>50</OPTION>";
	if($per_page == 100) $selperpage5 = "selected";
	echo "<OPTION VALUE=\"100\" $selperpage5>100</OPTION>";
	if($per_page == 200) $selperpage6 = "selected";
	echo "<OPTION VALUE=\"200\" $selperpage6>200</OPTION>";
	echo "</SELECT> ";
	echo "<input type=\"submit\" value=\""._WORKBOARD_ADMIN_TASKS_SORT."\">";
	echo "</td></form></tr>";
	//End Navigation Options
	echo "<tr><td align=\"left\" bgcolor=\"$bgcolor2\" width=\"100%\" colspan=2>";
	echo "<NOBR><b>"._WORKBOARD_ADMIN_TASKS_TASKLIST."</b></NOBR>";
	echo "</td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._WORKBOARD_ADMIN_TASKS_STATUS."</b></td>";
	echo "<td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._WORKBOARD_ADMIN_TASKS_PRIORITY."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._WORKBOARD_ADMIN_FUNCTIONS."</b></td></tr>";
	if($taskrows > 0){
		$reviewresult = $db->select_query("select task_id, task_name, project_id, priority_id, status_id from ".TB_WORKBOARD_TASKS." order by $column $direction limit $start_list, $end_list");
		while ($list = $db->fetch($reviewresult)){
	$statusresult = $db->select_query("select status_name, status_description from ".TB_WORKBOARD_STATUS." where status_id='$list[status_id]'");
	$status= $db->fetch($statusresult);
	$projectresult = $db->select_query("select project_id,project_name from ".TB_WORKBOARD_PROJECTS." where project_id='$list[project_id]'");
	$project= $db->fetch($projectresult);
	$priorityresult = $db->select_query("select priority_name, priority_weight from ".TB_WORKBOARD_PRIORITIES." where priority_id='$list[priority_id]'");
	$priority= $db->fetch($priorityresult);

						echo "<tr>";
			echo "<td><img src=\"images/workboard/icons/task.png\" alt=\""._WORKBOARD_ADMIN_TASKS_TASKID." $list[task_id]\"></td>";
			echo "<td width=\"100%\">";
			echo "<a href=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskEdit&task_id=$list[task_id]\">$list[task_name]</a>";
			echo "</td>";
			echo "<td align=center>";
			if($status['status_name'] != ''){ echo "<a href=\"index.php?name=admin/workboard&file=status&op=WorkBoardStatusList\">".$status['status_name']."</a>"; } else { echo "<i>"._WORKBOARD_ADMIN_TASKS_NA."</i>"; }
			echo "</td>";
			echo "<td align=center><NOBR>";
			if($priority['priority_name'] != ""){ echo "<a href=\"index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityList\">".$priority['priority_name']."</a>"; } else { echo "<i>"._WORKBOARD_ADMIN_TASKS_NA."</i>"; }
			echo "</td>";
			echo "<td align=center><NOBR>[ <a href=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskEdit&task_id=$list[task_id]\">"._WORKBOARD_ADMIN_EDIT."</a> | <a href=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskRemove&task_id=$list[task_id]\">"._WORKBOARD_ADMIN_DELETE."</a> ]</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td><img src=\"images/workboard/icons/arrow.png\"></td>";
			echo "<td colspan=4 width=\"100%\" align=center><table width=100% cellspacing=\"0\" cellpadding=\"0\"><tr><td align=left><b>"._WORKBOARD_ADMIN_TASKS_PROJECT.":</b> <a href=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectList\">".$project['project_name']."</a></td><td align=right>";
			$members = $db->select_query("select member_id from ".TB_WORKBOARD_TASKS_MEMBERS." where task_id='$list[task_id]'");

echo "<b>"._WORKBOARD_ADMIN_TASKS_ASSIGNEDMEMBERS.":</b> ";
  while($df= $db->fetch($members)) {
//	  echo "$member_ids";
			$memberss = $db->select_query("select * from ".TB_WORKBOARD_MEMBERS." where member_id='$df[member_id]'");
	$sdf=$db->fetch($memberss);
			echo "<a href=\"index.php?name=admin/workboard&file=members&op=WorkBoardMemberList\"><font color=#CC0033> $sdf[member_name] : </font></a>";
  }
			echo "</td></tr></table>";
			echo "</tr>";
		}
		//Page List
		echo "<tr><form method=\"post\" action=\"index.php?name=admin/workboard&file=tasks\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardTaskListRedirection\"><input type=\"hidden\" name=\"column\" value=\"$column\"><input type=\"hidden\" name=\"direction\" value=\"$direction\"><input type=\"hidden\" name=\"per_page\" value=\"$per_page\"><td colspan=5 width=\"100%\" align=left bgcolor=\"$bgcolor2\">";
		if($page != 1) {
			echo "<a href=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskListRedirection&page=".($page - 1)."&column=$column&direction=$direction&per_page=$per_page\">";
			echo "<<";
			echo "</a> ";
		}
		echo "<b>"._WORKBOARD_ADMIN_TASKS_PAGE."</b>";
		echo " <SELECT NAME=\"page\" onChange=\"submit()\">";
		for($i=1; $i<=$total_pages; $i++){
			if($i==$page){ $sel = "selected"; } else { $sel = ""; }
			echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
		}
		echo "</SELECT> <b>"._WORKBOARD_ADMIN_TASKS_OF." $total_pages</b>";
		if($page != $total_pages) {
			echo " <a href=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskListRedirection&page=".($page + 1)."&column=$column&direction=$direction&per_page=$per_page\">";
			echo ">>";
			echo "</a> ";
		}
		echo "</td></form></tr>";
		//End Page List
	} else {
		echo "<tr><td colspan=5 width=\"100%\" align=center>"._WORKBOARD_ADMIN_TASKS_NOTASKS."</td></tr>";
	}
	echo "</table>";
	
	
}

function workboardTaskListRedirection($page, $per_page, $column, $direction){
	if(!$page) $page = 1;
	header("Location: index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskList&page=$page&per_page=$per_page&column=$column&direction=$direction");
}

function workboardTaskAdd($project_id){
	global $project_id, $db;

	workboard_admin_menu();
	
	echo "<CENTER><B>"._WORKBOARD_ADMIN_TASKS_TASKADD."</B></CENTER>";
    
    echo "<BR>";
	
	echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskInsert\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardTaskInsert\">";
	echo "<font class=\"option\"><b>"._WORKBOARD_ADMIN_TASKS_TASKADD."</b></font><br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_PROJECTNAME.": <select name=\"project_id\">";
	$projectlist = $db->select_query("select project_id, project_name from ".TB_WORKBOARD_PROJECTS." order by project_name");
	while($list = $db->fetch($projectlist)){
		if($list[project_id] == $project_id){ $sel = "selected"; } else { $sel = ""; }
		echo "<option value=\"$list[project_id]\" $sel>$list[project_name]</option>";
	}
	echo "</select><br><br>";	
	echo ""._WORKBOARD_ADMIN_TASKS_TASKNAME.": <input type=\"text\" name=\"task_name\" size=\"30\"><br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_TASKDESCRIPTION.":<br><textarea name=\"task_description\" cols=\"60\" rows=\"10\" id=\"editor1\"></textarea><script type=\"text/javascript\">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script><br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_PRIORITY.": <SELECT NAME=\"priority_id\">";
	echo "<option value=\"0\">---------</option>";
	$prioritylist = $db->select_query("select priority_id, priority_name from ".TB_WORKBOARD_PRIORITIES." order by priority_weight");
	while($list2= $db->fetch($prioritylist)){
		echo "<option value=\"$list2[priority_id]\">$list2[priority_name]</option>";
	}
	echo "</SELECT><br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_STATUSPERCENT.": <input type=\"text\" name=\"status_percent\" size=\"4\">%<br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_STATUS.": <select name=\"status_id\">";
	echo "<option value=\"0\">---------</option>";
	$statuslist = $db->select_query("select status_id, status_name from ".TB_WORKBOARD_STATUS." order by status_name");
	while($list3 = $db->fetch($statuslist)){
		echo "<option value=\"$list3[status_id]\">$list3[status_name]</option>";
	}
	echo "</select><br><br>";
		echo ""._WORKBOARD_ADMIN_TASKS_STARTDATE.": <SELECT NAME=\"task_start_day\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 31; $i++){
		if($i == date("d")){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
	echo "</SELECT>";
	echo "<SELECT NAME=\"task_start_month\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 12; $i++){
		if($i == date("m")){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
	echo "</SELECT>";

	echo "<input type=text name=\"task_start_year\" value=\"".date("Y")."\" size=4 maxlength=4><br><br>";
		echo ""._WORKBOARD_ADMIN_TASKS_FINISHDATE.": <SELECT NAME=\"task_finish_day\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 31; $i++){
		echo "<OPTION VALUE=\"$i\">$i</OPTION>";
	}
	echo "</SELECT>";

	echo "<SELECT NAME=\"task_finish_month\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 12; $i++){
		echo "<OPTION VALUE=\"$i\">$i</OPTION>";
	}
	echo "</SELECT>";

	echo "<input type=text name=\"task_finish_year\" value=\"0000\" size=4 maxlength=4><br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_ASSIGNMEMBERS.":<br>";
	echo "<SELECT NAME=\"member_ids[]\" size=\"10\" multiple>";
	$memberlistresult = $db->select_query("select member_id, member_name from ".TB_WORKBOARD_MEMBERS." order by member_name");
	while($list4= $db->fetch($memberlistresult)) {
		echo "<OPTION VALUE=\"$list4[member_id]\">$list4[member_name]</OPTION>";
	}
	echo "</SELECT><br><br>";
	echo "<input type=\"submit\" value=\""._WORKBOARD_ADMIN_TASKS_TASKADD."\">"
		."</form>";

}

function workboardTaskInsert($project_id, $task_name, $task_description, $priority_id, $status_percent, $status_id, $task_start_month, $task_start_day, $task_start_year, $task_finish_month, $task_finish_day, $task_finish_year, $member_ids){
	global $project_id, $task_name, $task_description, $priority_id, $status_percent, $status_id, $task_start_month, $task_start_day, $task_start_year, $task_finish_month, $task_finish_day, $task_finish_year, $member_ids, $db;
	$date = date("Y-m-d H:i:s");
	$start_date = "$task_start_year-$task_start_month-$task_start_day 00:00:00";
	$finish_date = "$task_finish_year-$task_finish_month-$task_finish_day 00:00:00";
		$db->add_db(TB_WORKBOARD_TASKS,array(
			"project_id"=>"$_POST[project_id]",
			"task_name"=>"$_POST[task_name]",
			"task_description"=>"$_POST[task_description]",
			"priority_id"=>"$_POST[priority_id]",
			"status_id"=>"$_POST[status_id]",
			"status_percent"=>"$_POST[status_percent]",
			"date_created"=>"$date",
			"date_started"=>"$start_date",
			"date_finished"=>"$finish_date"
		));

	$taskresult = $db->select_query("SELECT task_id FROM ".TB_WORKBOARD_TASKS." WHERE date_created='$date'");
$task_id = $db->fetch($taskresult);
if(implode("", $member_ids) > "") {
  while(list($null, $member_id) = each($member_ids)) {
    $numrows = $db->rows($db->select_query("SELECT * FROM ".TB_WORKBOARD_TASKS_MEMBERS." WHERE task_id='$task_id' AND member_id='$member_id'"));
    if($numrows == 0) {
		$db->add_db(TB_WORKBOARD_TASKS_MEMBERS,array(
			"task_id"=>"$task_id[task_id]",
			"member_id"=>"$member_id"
		));
  }
  }
	}


	header("Location: index.php?name=admin/workboard&file=projects&op=WorkBoardProjectTasks&project_id=$project_id");
}

function workboardTaskEdit($task_id){
	global $task_id, $db, $bgcolor2;

	$taskresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_TASKS."  WHERE task_id='$task_id'");
	$task = $db->fetch($taskresults);
	workboard_admin_menu();
	
	echo "<CENTER><B>"._WORKBOARD_ADMIN_TASKS_EDITTASK."</B></CENTER>";
	
	echo "<BR>";
	
	echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskUpdate\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardTaskUpdate\"><input type=\"hidden\" name=\"task_id\" value=\"$task_id\">"
		."<font class=\"option\"><b>"._WORKBOARD_ADMIN_TASKS_EDITTASK."</b></font><br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_PROJECTNAME.": <select name=\"project_id\">";
	$projectlist = $db->select_query("select project_id, project_name from ".TB_WORKBOARD_PROJECTS." order by project_name");
	while($pro= $db->fetch($projectlist)){
		if($pro[project_id] == $task['project_id']){ $sel = "selected"; } else { $sel = ""; }
		echo "<option value=\"$pro[project_id]\" $sel>$pro[project_name]</option>";
	}
	echo "</select><br><br>";	
	echo ""._WORKBOARD_ADMIN_TASKS_TASKNAME.": <input type=\"text\" name=\"task_name\" size=\"30\" value=\"".$task['task_name']."\"><br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_TASKDESCRIPTION.":<br><textarea name=\"task_description\" cols=\"60\" rows=\"10\" id=\"editor1\">".$task['task_description']."</textarea><script type=\"text/javascript\">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script><br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_PRIORITY.": <SELECT NAME=\"priority_id\">";
	echo "<option value=\"0\">---------</option>";
	$prioritylist = $db->select_query("select priority_id, priority_name from ".TB_WORKBOARD_PRIORITIES." order by priority_weight");
	while($priority = $db->fetch($prioritylist)){
		if($priority[priority_id] == $task['priority_id']){ $sel = "selected"; } else { $sel = ""; }
		echo "<option value=\"$priority[priority_id]\" $sel>$priority[priority_name]</option>";
	}
	echo "</SELECT><br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_STATUSPERCENT.": <input type=\"text\" name=\"status_percent\" size=\"4\" value=\"".$task['status_percent']."\">%<br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_STATUS.": <select name=\"status_id\">";
	echo "<option value=\"0\">---------</option>";
	$statuslist = $db->select_query("select status_id, status_name from ".TB_WORKBOARD_STATUS." order by status_name");
	while($status = $db->fetch($statuslist)){
		if($status[status_id] == $task['status_id']){ $sel = "selected"; } else { $sel = ""; }
		echo "<option value=\"$status[status_id]\" $sel>$status[status_name]</option>";
	}
	echo "</select><br><br>";
	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/i", $task['date_started'], $start_date);
	preg_match ("/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/i", $task['date_finished'], $finish_date);
		echo ""._WORKBOARD_ADMIN_TASKS_STARTDATE.": <SELECT NAME=\"task_start_day\">";
		echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 31; $i++){
		if($i == $start_date[3]){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
		echo "</SELECT>";
	echo "<SELECT NAME=\"task_start_month\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 12; $i++){
		if($i == $start_date[2]){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
	echo "</SELECT>";
	echo "<input type=text name=\"task_start_year\" value=\"".$start_date[1]."\" size=4 maxlength=4><br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_FINISHDATE.": <SELECT NAME=\"task_finish_day\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 31; $i++){
		if($i == $finish_date[3]){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
	echo "</SELECT>";
	echo "<SELECT NAME=\"task_finish_month\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 12; $i++){
		if($i == $finish_date[2]){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
	echo "</SELECT>";

	echo "<input type=text name=\"task_finish_year\" value=\"".$finish_date[1]."\" size=4 maxlength=4><br><br>";
	echo ""._WORKBOARD_ADMIN_TASKS_ASSIGNMEMBERS.":<br>";
	echo "<SELECT NAME=\"member_ids[]\" size=\"10\" multiple>";
	$memberlistresult = $db->select_query("select member_id, member_name from ".TB_WORKBOARD_MEMBERS." order by member_name");
	while($member = $db->fetch($memberlistresult)) {
		$memberexresult = $db->select_query("SELECT member_id,member_name FROM ".TB_WORKBOARD_TASKS_MEMBERS." WHERE member_id='$member[member_id]' AND task_id='$task_id'");
		$numrows = $db->rows($memberexresult);
		if($numrows < 1){
			echo "<OPTION VALUE=\"$member[member_id]\">$member[member_name]</OPTION>";
		}
	}
	echo "</SELECT><br><br>";
	echo "<input type=\"submit\" value=\""._WORKBOARD_ADMIN_TASKS_UPDATETASK."\">"
		."</form>";
	
	echo "<br>";
	
	echo "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\"><form method=\"post\" action=\"index.php?name=admin/workboard&file=tasks\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardTaskMembersUpdate\"><INPUT TYPE=HIDDEN NAME=\"task_id\" VALUE=\"$task_id\">";
	echo "<tr><td align=\"left\" bgcolor=\"$bgcolor2\" width=\"100%\" colspan=2><b>";
	echo ""._WORKBOARD_ADMIN_TASKS_ASSIGNEDMEMBERS."";
	echo "</b></a></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._WORKBOARD_ADMIN_DELETE."</b></td></tr>";
	$membersresult = $db->select_query("select member_id from ".TB_WORKBOARD_TASKS_MEMBERS." where task_id='$task_id' order by member_id");
	$numrows = $db->rows($membersresult);
	if($numrows > 0){
		while ($memberid = $db->fetch($membersresult)){
	$memberresultss = $db->select_query("SELECT * FROM ".TB_WORKBOARD_MEMBERS."  WHERE member_id='$memberid[member_id]'");
	$memberx = $db->fetch($memberresultss);
			echo "<tr>";
			echo "<td><INPUT TYPE=HIDDEN NAME=\"member_ids[]\" VALUE=\"$member_id\"><img src=\"images/workboard/icons/member.png\"></td><td width=\"100%\">".$memberx['member_name']."</td>";
			echo "<td align=center><NOBR><input name=\"delete_member_ids[]\" type=\"checkbox\" value=\"$member_id\"></td>";
			echo "</tr>";
		}
		echo "<tr><td colspan=3 width=\"100%\" align=right bgcolor=\"$bgcolor2\"><input type=\"submit\" value=\""._WORKBOARD_ADMIN_UPDATE."\"><input type=\"submit\" value=\""._WORKBOARD_ADMIN_DELETE."\"></td></tr>";
	} else {
		echo "<tr><td colspan=3 width=\"100%\" align=center>"._WORKBOARD_ADMIN_TASKS_NONEASSIGNED."</td></tr>";
	}
	echo "</form></TABLE>";

}

function workboardTaskUpdate($task_id, $project_id, $task_name, $task_description, $priority_id, $status_percent, $status_id,  $task_start_month, $task_start_day, $task_start_year, $task_finish_month, $task_finish_day, $task_finish_year, $member_ids){
	global $task_id, $project_id, $task_name, $task_description, $priority_id, $status_percent, $status_id,  $task_start_month, $task_start_day, $task_start_year, $task_finish_month, $task_finish_day, $task_finish_year, $member_ids, $db;
	$date = date("Y-m-d H:i:s");
	$start_date = "$task_start_year-$task_start_month-$task_start_day 00:00:00";
	$finish_date = "$task_finish_year-$task_finish_month-$task_finish_day 00:00:00";
		$db->update_db(TB_WORKBOARD_TASKS,array(
			"project_id"=>"$_POST[project_id]",
			"task_name"=>"$_POST[task_name]",
			"task_description"=>"$_POST[task_description]",
			"status_id"=>"$_POST[status_id]",
			"status_percent"=>"$_POST[status_percent]",
			"date_created"=>"$date",
			"date_started"=>"$start_date",
			"date_finished"=>"$finish_date"
		)," task_id=".$task_id."");

	$taskresult = $db->select_query("SELECT task_id FROM ".TB_WORKBOARD_TASKS." WHERE date_created='$date'");
$task_id = $db->fetch($taskresult);
if(implode("", $member_ids) > "") {
  while(list($null, $member_id) = each($member_ids)) {
    $numrows = $db->rows($db->select_query("SELECT * FROM ".TB_WORKBOARD_TASKS_MEMBERS." WHERE task_id='$task_id' AND member_id='$member_id'"));
    if($numrows == 0) {
		$db->add_db(TB_WORKBOARD_TASKS_MEMBERS,array(
			"task_id"=>"$task_id[task_id]",
			"member_id"=>"$member_id"
		));
  }
  }
	}
	header("Location: index.php?name=admin/workboard&file=projects&op=WorkBoardProjectTasks&project_id=$project_id");
}

function workboardTaskMembersUpdate($task_id, $member_ids, $delete_member_ids){
	global $task_id, $member_ids, $delete_member_ids, $db;
	for($i = 0; $i < count($delete_member_ids); $i++){
		$db->del(TB_WORKBOARD_TASKS_MEMBERS , "member_id='".$delete_member_ids[$i]."' AND task_id='".$task_id."'");
	}
	header("Location: index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskEdit&task_id=$task_id");
}

function workboardTaskRemove($task_id){
	global $task_id, $db;
	$taskresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_TASKS."  WHERE task_id='$task_id'");
	$task = $db->fetch($taskresults);

	workboard_admin_menu();
	
	echo "<CENTER><B>"._WORKBOARD_ADMIN_TASKS_DELETETASK."</B></CENTER>";
    
    echo "<BR>";
	
	echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskDelete\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardTaskDelete\"><input type=\"hidden\" name=\"task_id\" value=\"$task_id\">";
	echo "<center><b>"._WORKBOARD_ADMIN_TASKS_CONFIRMDELETE."</b><br><br>[".$task['task_id']."] ".$task['task_name']." ";
	echo "<br><br><input type=\"submit\" value=\""._WORKBOARD_ADMIN_TASKS_DELETETASK."\"><br>"
		."</form>";

}

function workboardTaskDelete($task_id){
	global $task_id, $db;
		$db->del(TB_WORKBOARD_TASKS," task_id='".$task_id."' "); 
		$db->del(TB_WORKBOARD_TASKS_MEMBERS," task_id='".$task_id."' "); 
	header("Location: index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskList");
}

##############
# Cases
##############
switch ($op) {
	
	case "WorkBoardTaskList":
	workboardTaskList($page, $per_page, $column, $direction);
	break;
	
	case "WorkBoardTaskListRedirection":
	workboardTaskListRedirection($page, $per_page, $column, $direction);
	break;
	
	case "WorkBoardTaskAdd":
	workboardTaskAdd($project_id);
	break;
	
	case "WorkBoardTaskInsert":
	workboardTaskInsert($project_id, $task_name, $task_description, $priority_id, $status_percent, $status_id, $task_start_month, $task_start_day, $task_start_year, $task_finish_month, $task_finish_day, $task_finish_year, $member_ids);
	break;
	
	case "WorkBoardTaskEdit":
	workboardTaskEdit($task_id);
	break;
	
	case "WorkBoardTaskUpdate":
	workboardTaskUpdate($task_id, $project_id, $task_name, $task_description, $priority_id, $status_percent, $status_id, $task_start_month, $task_start_day, $task_start_year, $task_finish_month, $task_finish_day, $task_finish_year, $member_ids);
	break;
	
	case "WorkBoardTaskMembersUpdate":
	workboardTaskMembersUpdate($task_id, $member_ids, $delete_member_ids);
	break;
	
	case "WorkBoardTaskRemove":
	workboardTaskRemove($task_id);
	break;
	
	case "WorkBoardTaskDelete":
	workboardTaskDelete($task_id);
	break;
	
}


?>
</td>
</tr>
</table>
</td>
</tr>
</table>

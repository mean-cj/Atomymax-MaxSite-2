	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="780" align=center cellSpacing=0 cellPadding=0 border=0>
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

CheckAdmin($admin_user, $admin_pwd);
include("modules/admin/workboard/includes/functions.php");
if(ISO=='utf-8'){
include("modules/admin/workboard/language/lang-thai_utf-8.php");
} else {
include("modules/admin/workboard/language/lang-thai.php");
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
#####################################
# Projects
#####################################

function workboardProjectList(){
	global $db , $bgcolor2;

	workboard_admin_menu();

	echo "<CENTER><FONT CLASS=\"title\"><B>"._WORKBOARD_ADMIN_PROJECTS_PROJECTLIST."</B></FONT></CENTER>";

	echo "<BR>";

	$projectresult = $db->select_query("select * from ".TB_WORKBOARD_PROJECTS." order by project_id");
	$project_total = $db->rows($projectresult);


	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=3 width=\"100%\" ><nobr><b>"._WORKBOARD_ADMIN_PROJECTS_PROJECTOPTIONS."</b></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/options.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr><a href=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectAdd\">"._WORKBOARD_ADMIN_PROJECTS_PROJECTADD."</a></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/stats.png\"></td><td align=\"left\" colspan=3 width=\"100%\"><nobr>"._WORKBOARD_ADMIN_PROJECTS_TOTALPROJECTS.": <b>$project_total "._WORKBOARD_ADMIN_TOTLE_PROJECT."</b></nobr></td></tr>";
	echo "</table>";

	echo "<br>";

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=2  width=\"100%\"><b>"._WORKBOARD_ADMIN_PROJECTS_PROJECTLIST."</b></a></td><td align=\"center\"  ><b>"._WORKBOARD_ADMIN_TOTLE_NUM." "._WORKBOARD_ADMIN_PROJECTS_TASKS."</b></td><td align=\"center\"  ><b>"._WORKBOARD_ADMIN_FUNCTIONS."</b></td></tr>";
	if($project_total != 0){
		while ($sd=$db->fetch($projectresult)) {
			$tasksresult = $db->select_query("select task_id from ".TB_WORKBOARD_TASKS." where project_id='$sd[project_id]'");
			$tasks = $db->rows($tasksresult);
			echo "<tr>";
    		echo "<td width=\"10%\"><img src=\"images/workboard/icons/project.png\"></td>";
    		echo "<td ><a href=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectTasks&project_id=$sd[project_id]\">$sd[project_name]</a></td>";
    		echo "<td align=\"center\" ><a href=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectTasks&project_id=$sd[project_id]\">$tasks</a></td>";
			echo "<td align=\"center\" width=\"10%\"><NOBR>[ <a href=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectEdit&project_id=$sd[project_id]\">"._WORKBOARD_ADMIN_EDIT."</a>";
			echo " | <a href=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectRemove&project_id=$sd[project_id]\">"._WORKBOARD_ADMIN_DELETE."</a> ]</NOBR></td>";
			echo "</tr>";
    	}
	} else {
		echo "<tr>";
    	echo "<td width=\"100%\" colspan=4 align=\"center\">"._WORKBOARD_ADMIN_PROJECTS_NOPROJECTS."</td>";
		echo "</tr>";
	}
	echo "</table>";


}

function workboardProjectTasks($project_id){
	global $project_id, $db, $bgcolor2;
	$projectresult = $db->select_query("select * from ".TB_WORKBOARD_PROJECTS." where project_id='$project_id'");
	$sds= $db->fetch($projectresult);

	workboard_admin_menu();

	echo "<CENTER><FONT CLASS=\"title\"><B>"._WORKBOARD_ADMIN_PROJECTS_PROJECTTASKLIST."</B></FONT></CENTER>";

	echo "<BR>";
	$taskresult = $db->select_query("select task_id, task_name, priority_id from ".TB_WORKBOARD_TASKS." where project_id='$sds[project_id]' order by task_name");
	$task_total = $db->rows($taskresult);

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=2  width=\"100%\"><nobr><b>"._WORKBOARD_ADMIN_PROJECTS_PROJECT."</b></nobr></td><td align=\"center\" colspan=2 ><b>"._WORKBOARD_ADMIN_FUNCTIONS."</b></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/project.png\"></td><td width=\"100%\" colspan=1 align=\"left\">";
	echo "<a href=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectList\">"._WORKBOARD_ADMIN_PROJECTS_PROJECTS."</a> / <b>$sds[project_name]</b>";
	echo "</td><td align=\"center\"><nobr>[ <a href=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectEdit&project_id=$sds[project_id]\">"._WORKBOARD_ADMIN_EDIT."</a> | <a href=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectRemove&project_id=$sds[project_id]\">"._WORKBOARD_ADMIN_DELETE."</a> ]</nobr></td></tr>";
	echo "<tr><td align=\"left\" colspan=4 width=\"100%\" ><nobr><b>"._WORKBOARD_ADMIN_PROJECTS_PROJECTOPTIONS."</b></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/options.png\"></td><td align=\"left\" colspan=3 width=\"100%\"><nobr><a href=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskAdd&project_id=$sds[project_id]\">"._WORKBOARD_ADMIN_PROJECTS_ADDTASK."</a></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/stats.png\"></td><td align=\"left\" colspan=3 width=\"100%\"><nobr>"._WORKBOARD_ADMIN_PROJECTS_TOTALTASKS.": <b>$task_total "._WORKBOARD_MODULE_INDEX_TASKS."</b></nobr></td></tr>";
	echo "</table>";

	echo "<br>";

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=2  width=\"100%\"><b>"._WORKBOARD_ADMIN_PROJECTS_PROJECTTASKS."</b></a></td>";
	echo "<td align=\"center\" ><b>"._WORKBOARD_ADMIN_TASKS_PRIORITY."</b></td><td align=\"center\" ><b>"._WORKBOARD_ADMIN_FUNCTIONS."</b></td></tr>";
	if($task_total != 0){
		while ($task = $db->fetch($taskresult)) {
			echo "<tr>";
			echo "<td><img src=\"images/workboard/icons/task.png\"></td>";
			echo "<td width=\"100%\"><a href=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskEdit&task_id=$task[task_id]\">$task[task_name]</a></td>";
	$priorityresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_PRIORITIES." WHERE priority_id='$task[priority_id]'");
	$priority = $db->fetch($priorityresults);
			echo "<td align=\"center\">";
			if($priority['priority_name'] != ""){
				echo "<a href=\"index.php?name=admin/workboard&file=priority&op=WorkBoardPriorityList\">".$priority['priority_name']."</a>";
			} else {
				echo "<i>N/A</i>";
			}
			echo "</td>";
			echo "<td align=\"center\"><NOBR>[ <a href=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskEdit&task_id=$task[task_id]\">"._WORKBOARD_ADMIN_EDIT."</a>";
			echo " | <a href=\"index.php?name=admin/workboard&file=tasks&op=WorkBoardTaskRemove&task_id=$task[task_id]\">"._WORKBOARD_ADMIN_DELETE."</a> ]</NOBR></td>";
			echo "</tr>";
		}
	} else {
		echo "<tr>";
	echo "<td width=\"100%\" colspan=4 align=\"center\">"._WORKBOARD_ADMIN_PROJECTS_NOTASKS."</td>";
		echo "</tr>";
	}
	echo "</table>";

	echo "<br>";

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" class=\"grids\"><form method=\"post\" action=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectMembersUpdate\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardProjectMembersUpdate\"><INPUT TYPE=HIDDEN NAME=\"project_id\" VALUE=\"$sds[project_id]\">";
	echo "<tr class=\"odd\"><td align=\"left\"  width=\"100%\" colspan=2><b>";
	echo ""._WORKBOARD_ADMIN_PROJECTS_PROJECTMEMBERS."";
	echo "</b></a></td><td  align=center><b>"._WORKBOARD_ADMIN_INDEX_POSITIONS."</b></td><td align=\"center\" ><b>"._WORKBOARD_ADMIN_DELETE."</b></td></tr>";
$pid=$sds[project_id];
	$membersresultw = $db->select_query("SELECT * FROM ".TB_WORKBOARD_PROJECTS_MEMBERS." where project_id='$pid' ");
	$numrowsw = $db->rows($membersresultw);
	if($numrowsw > 0){
	$membersresultx = $db->select_query("SELECT * FROM ".TB_WORKBOARD_PROJECTS_MEMBERS." where project_id='$pid' order by member_id");
while ($mem= $db->fetch($membersresultx)){
	$memberresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_MEMBERS."  WHERE member_id='$mem[member_id]'");
	$member = $db->fetch($memberresults);
	$positionresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_POSITIONS." WHERE position_id='$mem[position_id]'");
	$position = $db->fetch($positionresults);
			echo "<tr>";
    		echo "<td><INPUT TYPE=HIDDEN NAME=\"member_ids[]\" VALUE=\"$member[member_id]\"><img src=\"images/workboard/icons/member.png\"></td><td width=\"100%\">".$member['member_name']."</td>";
    		echo "<td><SELECT NAME=\"position_ids[]\">";
			$positionlistresult = $db->select_query("select position_id, position_name from ".TB_WORKBOARD_POSITIONS." order by position_name");
			echo "<OPTION VALUE=\"0\">------</OPTION>";
			while($post = $db->fetch($positionlistresult)) {
				if($post['position_id'] == $position['position_id']){ $sel = "selected"; } else { $sel = ""; }
				echo "<OPTION VALUE=\"$post[position_id]\" $sel>$post[position_name]</OPTION>";
			}
			echo "</SELECT></td>";
			echo "<td align=center><NOBR><input name=\"delete_member_ids[]\" type=\"checkbox\" value=\"$member[member_id]\"></td>";
			echo "</tr>";
		}
		echo "<tr><td colspan=4 width=\"100%\" align=right ><input type=\"submit\" value=\""._WORKBOARD_ADMIN_UPDATE."\"><input type=\"submit\" value=\""._WORKBOARD_ADMIN_DELETE."\"></td></tr>";
	} else {
		echo "<tr><td colspan=4 width=\"100%\" align=center>"._WORKBOARD_ADMIN_PROJECTS_NOMEMBERS."</td></tr>";
	}
	echo "</form></TABLE>";

}

function workboardProjectAdd(){
global $db, $bgcolor2;
	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_PROJECTS_PROJECTADD."</B></CENTER>";

    echo "<BR>";

    echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectInsert\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardProjectInsert\">"
		."<font class=\"option\"><b>"._WORKBOARD_ADMIN_PROJECTS_PROJECTADD."</b></font><br><br>"
		.""._WORKBOARD_ADMIN_PROJECTS_PROJECTNAME.": <input type=\"text\" name=\"project_name\" size=\"30\"><br>"
		.""._WORKBOARD_ADMIN_PROJECTS_PROJECTDESCRIPTION.":<br><textarea name=\"project_description\" cols=\"60\" rows=\"10\" id=\"editor1\"></textarea><script type=\"text/javascript\">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script><br><br>";
	echo ""._WORKBOARD_ADMIN_PROJECTS_PRIORITY.": <SELECT NAME=\"priority_id\">";
	echo "<option value=\"0\">---------</option>";
	$prioritylist = $db->select_query("select * from ".TB_WORKBOARD_PRIORITIES." order by priority_weight");
	while($pri = $db->fetch($prioritylist)){
		echo "<option value=\"$pri[priority_id]\">$pri[priority_name]</option>";
	}
	echo "</SELECT><br><br>";
	echo ""._WORKBOARD_ADMIN_PROJECTS_STATUSPERCENT.": <input type=\"text\" name=\"status_percent\" size=\"4\">% "._WORKBOARD_ADMIN_PROJECTS_STATUSPERCENT_CALCULATE."<br><br>";
	echo ""._WORKBOARD_ADMIN_PROJECTS_STATUS.": <select name=\"status_id\">";
	echo "<option value=\"0\">---------</option>";
	$statuslist = $db->select_query("select status_id, status_name from ".TB_WORKBOARD_STATUS." order by status_name");
	while($sta= $db->fetch($statuslist)){
		echo "<option value=\"$sta[status_id]\">$sta[status_name]</option>";
	}
	echo "</select><br><br>";
		echo ""._WORKBOARD_ADMIN_PROJECTS_STARTDATE.": <SELECT NAME=\"project_start_day\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 31; $i++){
		if($i == date("d")){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
	echo "</SELECT>";
	echo "<SELECT NAME=\"project_start_month\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 12; $i++){
		if($i == date("m")){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
	echo "</SELECT>";

	echo "<input type=text name=\"project_start_year\" value=\"".date("Y")."\" size=4 maxlength=4><br><br>";
		echo ""._WORKBOARD_ADMIN_PROJECTS_FINISHDATE.": <SELECT NAME=\"project_finish_day\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 31; $i++){
		echo "<OPTION VALUE=\"$i\">$i</OPTION>";
	}
	echo "</SELECT>";
	echo "<SELECT NAME=\"project_finish_month\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 12; $i++){
		echo "<OPTION VALUE=\"$i\">$i</OPTION>";
	}
	echo "</SELECT>";

	echo "<input type=text name=\"project_finish_year\" value=\"0000\" size=4 maxlength=4><br><br>";
	echo ""._WORKBOARD_ADMIN_PROJECTS_ASSIGNMEMBERS.":<br>";
	echo "<SELECT NAME=\"member_ids[]\" size=\"10\" multiple>";
	$memberlistresult = $db->select_query("select member_id, member_name from ".TB_WORKBOARD_MEMBERS." order by member_name");
	while($mem = $db->fetch($memberlistresult)) {
		echo "<OPTION VALUE=\"$mem[member_id]\">$mem[member_name]</OPTION>";
	}
	echo "</SELECT><br><br>";
	echo "<SELECT NAME=\"position\">";
		$postlistresult = $db->select_query("select * from ".TB_WORKBOARD_POSITIONS." order by position_name");
	while($po = $db->fetch($postlistresult)) {
		echo "<OPTION VALUE=\"$po[position_id]\">$po[position_name]</OPTION>";
	}
	echo "</SELECT><br><br>"

		."<input type=\"submit\" value=\""._WORKBOARD_ADMIN_PROJECTS_PROJECTADD."\">"
		."</form>";

}

function workboardProjectInsert($project_name, $project_description, $priority_id, $status_id, $status_percent, $project_start_month, $project_start_day, $project_start_year, $project_finish_month, $project_finish_day, $project_finish_year, $member_ids){
	global $db,$project_name, $project_description, $priority_id, $status_id, $status_percent, $project_start_month, $project_start_day, $project_start_year, $project_finish_month, $project_finish_day, $project_finish_year, $member_ids;
	$date = date("Y-m-d H:i:s");
	$start_date = "$project_start_year-$project_start_month-$project_start_day 00:00:00";
	$finish_date = "$project_finish_year-$project_finish_month-$project_finish_day 00:00:00";
		$db->add_db(TB_WORKBOARD_PROJECTS,array(
			"project_name"=>"$_POST[project_name]",
			"project_description"=>"$_POST[project_description]",
			"priority_id"=>"$_POST[priority_id]",
			"status_id"=>"$_POST[status_id]",
			"status_percent"=>"$_POST[status_percent]",
			"date_created"=>"$date",
			"date_started"=>"$start_date",
			"date_finished"=>"$finish_date"
		));
	$taskresult = $db->select_query("SELECT project_id FROM ".TB_WORKBOARD_PROJECTS." WHERE date_created='$date'");
$task_id = $db->fetch($taskresult);
if(implode("", $member_ids) > "") {
  while(list($null, $member_id) = each($member_ids)) {
    $numrows = $db->rows($db->select_query("SELECT * FROM ".TB_WORKBOARD_PROJECTS_MEMBERS." WHERE member_id='$member_id' and project_id='$task_id' "));
    if($numrows == 0) {
		$db->add_db(TB_WORKBOARD_PROJECTS_MEMBERS,array(
			"project_id"=>"$task_id[project_id]",
			"member_id"=>"$member_id",
			"position_id"=>"$_POST[position]"
		));
  }
  }
	}


	header("Location: index.php?name=admin/workboard&file=projects&op=WorkBoardProjectTasks&project_id=".$task_id['project_id']."");
}

function workboardProjectEdit($project_id){
	global $project_id, $db;

	$projectresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_PROJECTS." WHERE project_id='".$project_id."' ");
	$project = $db->fetch($projectresults);

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_PROJECTS_EDITPROJECT."</B></CENTER>";

    echo "<BR>";

    echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectUpdate\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardProjectUpdate\"><input type=\"hidden\" name=\"project_id\" value=\"$project[project_id]\">"
		."<font class=\"option\"><b>"._WORKBOARD_ADMIN_PROJECTS_EDITPROJECT."</b></font><br><br>"
		.""._WORKBOARD_ADMIN_PROJECTS_PROJECTNAME.": <input type=\"text\" name=\"project_name\" size=\"30\" value=\"$project[project_name]\"><br>"
		.""._WORKBOARD_ADMIN_PROJECTS_PROJECTDESCRIPTION.":<br><textarea name=\"project_description\" cols=\"60\" rows=\"10\" id=\"editor1\">$project[project_description]</textarea><script type=\"text/javascript\">CKEDITOR.replace ( 'editor1',{toolbar: 'Basic'});</script><br><br>";
	echo ""._WORKBOARD_ADMIN_PROJECTS_PRIORITY.": <SELECT NAME=\"priority_id\">";
	echo "<option value=\"0\">---------</option>";
	$prioritylist = $db->select_query("select priority_id, priority_name from ".TB_WORKBOARD_PRIORITIES." order by priority_weight");
	while($pri = $db->fetch($prioritylist)){
		if($pri[priority_id] == $project['priority_id']){ $sel = "selected"; } else { $sel = ""; }
		echo "<option value=\"$pri[priority_id]\" $sel>$pri[priority_name]</option>";
	}
	echo "</SELECT><br><br>";
	echo ""._WORKBOARD_ADMIN_PROJECTS_STATUSPERCENT.": <input type=\"text\" name=\"status_percent\" size=\"4\" value=\"".$project['status_percent']."\">% "._WORKBOARD_ADMIN_PROJECTS_STATUSPERCENT_CALCULATE."<br><br>";
	echo ""._WORKBOARD_ADMIN_PROJECTS_STATUS.": <select name=\"status_id\">";
	echo "<option value=\"0\">---------</option>";
	$statuslist = $db->select_query("select status_id, status_name from ".TB_WORKBOARD_STATUS." order by status_name");
	while($sta = $db->fetch($statuslist)){
		if($sta[status_id] == $project['status_id']){ $sel = "selected"; } else { $sel = ""; }
		echo "<option value=\"$sta[status_id]\" $sel>$sta[status_name]</option>";
	}
	echo "</select><br><br>";
	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $project['date_started'], $start_date);
	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $project['date_finished'], $finish_date);
	echo ""._WORKBOARD_ADMIN_PROJECTS_STARTDATE.": <SELECT NAME=\"project_start_month\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 12; $i++){
		if($i == $start_date[2]){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
	echo "</SELECT>";
	echo "<SELECT NAME=\"project_start_day\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 31; $i++){
		if($i == $start_date[3]){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
	echo "</SELECT>";
	echo "<input type=text name=\"project_start_year\" value=\"".$start_date[1]."\" size=4 maxlength=4><br><br>";
	echo ""._WORKBOARD_ADMIN_PROJECTS_FINISHDATE.": <SELECT NAME=\"project_finish_month\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 12; $i++){
		if($i == $finish_date[2]){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
	echo "</SELECT>";
	echo "<SELECT NAME=\"project_finish_day\">";
	echo "<OPTION VALUE=\"00\">--</OPTION>";
	for($i = 1; $i <= 31; $i++){
		if($i == $finish_date[3]){ $sel = "selected"; } else { $sel = ""; }
		echo "<OPTION VALUE=\"$i\" $sel>$i</OPTION>";
	}
	echo "</SELECT>";
	echo "<input type=text name=\"project_finish_year\" value=\"".$finish_date[1]."\" size=4 maxlength=4><br><br>";
	echo ""._WORKBOARD_ADMIN_PROJECTS_ASSIGNMEMBERS.":<br>";
	echo "<SELECT NAME=\"member_ids[]\" size=\"10\" multiple>";
	$memberlistresult = $db->select_query("select member_id, member_name from ".TB_WORKBOARD_MEMBERS." order by member_name");
	while($mem= $db->fetch($memberlistresult)) {

			echo "<OPTION VALUE=\"$mem[member_id]\">$mem[member_name]</OPTION>";

	}

	echo "</SELECT><br><br>"

		."<input type=\"submit\" value=\""._WORKBOARD_ADMIN_PROJECTS_UPDATEPROJECT."\">"
		."</form>";

}

function workboardProjectUpdate($project_id, $project_name, $project_description, $priority_id, $status_id, $status_percent, $project_start_month, $project_start_day, $project_start_year, $project_finish_month, $project_finish_day, $project_finish_year, $member_ids){
	global $db,$project_id, $project_name, $project_description, $priority_id, $status_id, $status_percent, $project_start_month, $project_start_day, $project_start_year, $project_finish_month, $project_finish_day, $project_finish_year, $member_ids;
	$date = date("Y-m-d H:i:s");
	$start_date = "$project_start_year-$project_start_month-$project_start_day 00:00:00";
	$finish_date = "$project_finish_year-$project_finish_month-$project_finish_day 00:00:00";
			$db->update_db(TB_WORKBOARD_PROJECTS,array(
			"project_name"=>"$_POST[project_name]",
			"project_description"=>"$_POST[project_description]",
			"priority_id"=>"$_POST[priority_id]",
			"status_id"=>"$_POST[status_id]",
			"status_percent"=>"$_POST[status_percent]",
			"date_created"=>"$date",
			"date_started"=>"$start_date",
			"date_finished"=>"$finish_date"
		)," project_id=".$project_id."");

	$taskresult = $db->select_query("SELECT project_id FROM ".TB_WORKBOARD_PROJECTS." WHERE date_created='$date'");
$task_id = $db->fetch($taskresult);
if(implode("", $member_ids) > "") {
  while(list($null, $member_id) = each($member_ids)) {
    $numrows = $db->rows($db->select_query("SELECT * FROM ".TB_WORKBOARD_PROJECTS_MEMBERS." WHERE member_id='$member_id' and project_id='$task_id[project_id]' "));
    if($numrows == 0) {
		$db->add_db(TB_WORKBOARD_PROJECTS_MEMBERS,array(
			"project_id"=>"$task_id[project_id]",
			"member_id"=>"$member_id",
			"position_id"=>"$_POST[position]"
		));
  }
  }
	}
//echo "$task_id[project_id]";
	header("Location: index.php?name=admin/workboard&file=projects&op=WorkBoardProjectTasks&project_id=".$task_id['project_id']."");
}

function workboardProjectMembersUpdate($project_id, $member_ids, $position_ids, $delete_member_ids){
	global $db,$project_id, $member_ids, $position_ids, $delete_member_ids;

	for($i = 0; $i < count($delete_member_ids); $i++){
		$db->del(TB_WORKBOARD_PROJECTS_MEMBERS ," member_id='".$delete_member_ids[$i]."' AND project_id='".$project_id."'");
	}
	for($i = 0; $i < count($member_ids); $i++){
				$db->update_db(TB_WORKBOARD_PROJECTS_MEMBERS,array(
			"position_id"=>"".$position_ids[$i].""
		)," project_id=".$project_id." and member_id=".$member_ids[$i]."");
	}
	header("Location: index.php?name=admin/workboard&file=projects&op=WorkBoardProjectTasks&project_id=".$project_id."");
}

function workboardProjectRemove($project_id){
global $db, $project_id;
	$projectresults = $db->select_query("SELECT * FROM ".TB_WORKBOARD_PROJECTS." WHERE project_id='$project_id'");
	$project = $db->fetch($projectresults);

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_PROJECTS_DELETEPROJECT."</B></CENTER>";

    echo "<BR>";

	echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectDelete\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardProjectDelete\"><input type=\"hidden\" name=\"project_id\" value=\"$project[project_id]\">";
	echo "<center><b>"._WORKBOARD_ADMIN_PROJECTS_CONFIRMDELETE."</b><br><br>";
	echo "<b>"._WORKBOARD_MODULE_MAP_PROJECT." :  $project[project_name] </b><br>"._WORKBOARD_MODULE_PROJECT_PROJECTDETAILS." : $project[project_description]";
	echo "<br><br><input type=\"submit\" value=\""._WORKBOARD_ADMIN_PROJECTS_DELETEPROJECT."\"><br>";
	echo "</form>";

}

function workboardProjectDelete($project_id){
	global $db , $project_id;
//	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$db->del(TB_WORKBOARD_PROJECTS ," project_id='".$project_id."' ") or die ("error1");
	$db->del(TB_WORKBOARD_PROJECTS_MEMBERS ," project_id='".$project_id."' ");
	$taskresult = $db->select_query("select task_id from web_workboard_tasks where project_id='".$project_id."' ");
	while ($task_id = $db->fetch($taskresult)) {
		$db->del(TB_WORKBOARD_TASKS ," task_id='".$task_id[task_id]."' AND project_id='".$project_id."' ");
		$db->del(TB_WORKBOARD_TASKS_MEMBERS ," task_id='".$task_id[task_id]."' ");
    }

	header("Location: index.php?name=admin/workboard&file=projects&op=WorkBoardProjectList");
}

##############
# Cases
##############
switch ($op) {
	
	case "WorkBoardProjectList":
	workboardProjectList();
	break;
	
	case "WorkBoardProjectTasks":
	workboardProjectTasks($project_id);
	break;
	
	case "WorkBoardProjectAdd":
	workboardProjectAdd();
	break;
	
	case "WorkBoardProjectInsert":
	workboardProjectInsert($project_name, $project_description, $priority_id, $status_id, $status_percent, $project_start_month, $project_start_day, $project_start_year, $project_finish_month, $project_finish_day, $project_finish_year, $member_ids);
	break;
	
	case "WorkBoardProjectEdit":
	workboardProjectEdit($project_id);
	break;
	
	case "WorkBoardProjectUpdate":
	workboardProjectUpdate($project_id, $project_name, $project_description, $priority_id, $status_id, $status_percent, $project_start_month, $project_start_day, $project_start_year, $project_finish_month, $project_finish_day, $project_finish_year, $member_ids);
	break;
	
	case "WorkBoardProjectMembersUpdate":
	workboardProjectMembersUpdate($project_id, $member_ids, $position_ids, $delete_member_ids);
	break;
	
	case "WorkBoardProjectRemove":
	workboardProjectRemove($project_id);
	break;
	
	case "WorkBoardProjectDelete":
	workboardProjectDelete($project_id);
	break;
	
}

?>
</td>
</tr>
</table>
</td>
</tr>
</table>

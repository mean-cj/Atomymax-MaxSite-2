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

###########################
# Index
###########################
?>
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
<?

function workboardIndex(){
workboard_admin_menu();
	global $db , $bgcolor2;

	//workboard_admin_menu();

	echo "<CENTER><FONT CLASS=\"title\"><B>"._WORKBOARD_ADMIN_PROJECTS_PROJECTLIST."</B></FONT></CENTER>";

	echo "<BR>";

	$projectresult = $db->select_query("select * from ".TB_WORKBOARD_PROJECTS." order by project_id");
	$project_total = $db->rows($projectresult);


	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=3 width=\"100%\" bgcolor=\"$bgcolor2\"><nobr><b>"._WORKBOARD_ADMIN_PROJECTS_PROJECTOPTIONS."</b></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/options.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr><a href=\"index.php?name=admin/workboard&file=projects&op=WorkBoardProjectAdd\">"._WORKBOARD_ADMIN_PROJECTS_PROJECTADD."</a></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/stats.png\"></td><td align=\"left\" colspan=3 width=\"100%\"><nobr>"._WORKBOARD_ADMIN_PROJECTS_TOTALPROJECTS.": <b>$project_total "._WORKBOARD_ADMIN_TOTLE_PROJECT."</b></nobr></td></tr>";
	echo "</table>";

	echo "<br>";

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=2 bgcolor=\"$bgcolor2\" width=\"100%\"><b>"._WORKBOARD_ADMIN_PROJECTS_PROJECTLIST."</b></a></td><td align=\"center\" bgcolor=\"$bgcolor2\" ><b>"._WORKBOARD_ADMIN_TOTLE_NUM." "._WORKBOARD_ADMIN_PROJECTS_TASKS."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\" ><b>"._WORKBOARD_ADMIN_FUNCTIONS."</b></td></tr>";
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

//	CloseTable();
//	include("footer.php");
}

switch ($op) {

    case "WorkBoardIndex":
	workboardIndex();
    break;

}


?>

				</TD>
				</TR>
			</TABLE>
							</TD>
				</TR>
			</TABLE>
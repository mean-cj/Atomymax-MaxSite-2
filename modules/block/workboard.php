
<?
$summ=$widthSUMC-10;
?>

  													<TABLE width="<?=$summ;?>" align=center cellSpacing=0 cellPadding=5 border=0>
													<tr>
													<td align=center>
<?php
######################################################################
# WorkBoard 1.2.0
######################################################################
#
# Copyright (c) 2003 by Burnwave and Nukescripts Network
# http://www.burnwave.com/, http://www.nukescripts.net/
#
######################################################################

global  $db;
include("modules/admin/workboard/includes/functions.php");
//include("modules/workboard/language/lang-thai.php");



$content = "<center><table width=$summ border=\"0\"  cellspacing=\"0\" cellpadding=\"0\" class=grids>";
$content .= "<tr class=odd>";
$content .= "<td width=100%  align=center colspan=2><b>"._WORKBOARD_BLOCK_PRJLIST_PROJECTNAME."</b></td>";
$content .= "<td  align=center><nobr><b>"._WORKBOARD_BLOCK_PRJLIST_STATUS."</b></nobr></td>";
$content .= "<td  align=center><nobr><b>"._WORKBOARD_BLOCK_PRJLIST_PROGRESSBAR."</b></nobr></td>";
$content .= "<td  align=center><nobr><b>"._WORKBOARD_BLOCK_PRJLIST_PERCENT."</b></nobr></td>";
$content .= "</tr>";
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$projectresult = $db->select_query("SELECT * FROM web_workboard_projects order by project_name limit 10" );
$count=0;
	while ($id= $db->fetch($projectresult)) {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$projectresults = $db->select_query("SELECT * FROM web_workboard_projects WHERE project_id='".$id['project_id']."' ");
	$project = $db->fetch($projectresults);
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$percentresult = $db->select_query("select status_percent, priority_id from web_workboard_tasks where project_id='".$id['project_id']."'  ");
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
	$statusresults = $db->select_query("SELECT * FROM web_workboard_status WHERE status_id='$id[status_id]'");
	$status = $db->fetch($statusresults);

if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

$content .= "<tr ".$ColorFill.">";
$content .= "<td align=center><img src=\"images/workboard/icons/project.png\" alt=\""._WORKBOARD_MODULE_INDEX_PROJECTID." #$id[project_id]\"></td>";
$content .= "<td align=left width=100%><a href=\"index.php?name=workboard&file=project&project_id=$id[project_id]\">".$project['project_name']."</a></td>";
$content .= "<td align=center>";
		if($status['status_name'] != ""){ $content .= "".$status['status_name'].""; } else { $content .= "<i>"._WORKBOARD_MODULE_INDEX_NA."</i>"; }
$content .=  "</td>";
$content .=  "<td align=left><nobr>";

//Status Bar

if($project['status_percent'] == 0){
	$content .=  "<img src=\"images/workboard/bar_empty_left.png\"><img src=\"images/workboard/bar_empty_center.png\" width=100 height=7><img src=\"images/workboard/bar_empty_right.png\">";
} else {
	if($project['status_percent'] > 100){ $status_percent = 100; } else { $status_percent = $project['status_percent']; }
	$content .=  "<img src=\"images/workboard/bar_left.png\"><img src=\"images/workboard/bar_center.png\" width=".$status_percent." height=7>";
	if($status_percent < 100){
		$percent_incomplete = 100 - $status_percent;
		$content .= "<img src=\"images/workboard/bar_empty_center.png\" width=".$percent_incomplete." height=7>";
		$content .= "<img src=\"images/workboard/bar_empty_right.png\">";
	} else {
		$content .= "<img src=\"images/workboard/bar_right.png\">";
	}
}

$content .=  "</nobr></td>";
$content .=  "<td align=center>".$project['status_percent']."</td>";
$content .=  "</tr>";
$count++;
	}
$content .=  "</table></center>";
echo $content;
?>

													<tr>
													<td  align="right"><A HREF="index.php?name=workboard" ><img src="images/admin/2_15.gif"></a></td>
													</tr>
													</table>


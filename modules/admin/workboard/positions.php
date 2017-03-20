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

CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);
include("modules/admin/workboard/includes/functions.php");
if(ISO=='utf-8'){
include("modules/admin/workboard/language/lang-thai_utf-8.php");
} else {
include("modules/admin/workboard/language/lang-thai.php");
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
#####################################
# Positions
#####################################

function workboardPositionList(){
	global $db, $bgcolor2;

	workboard_admin_menu();

	echo "<CENTER><FONT CLASS=\"title\"><B>"._WORKBOARD_ADMIN_POSITION_POSITIONLIST."</B></FONT></CENTER>";

	echo "<BR>";
	$positionresult = $db->select_query("select position_id, position_name from ".TB_WORKBOARD_POSITIONS." order by position_name");
	$position_total = $db->rows($positionresult);

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=3 width=\"100%\" bgcolor=\"$bgcolor2\"><nobr><b>"._WORKBOARD_ADMIN_POSITION_POSITIONOPTIONS."</b></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/options.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr><a href=\"index.php?name=admin/workboard&file=positions&op=WorkBoardPositionAdd\">"._WORKBOARD_ADMIN_POSITION_POSITIONADD."</a></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/stats.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr>"._WORKBOARD_ADMIN_POSITION_TOTALPOSITIONS.": <b>$position_total</b></nobr></td></tr>";
	echo "</table>";

	echo "<br>";

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=2 bgcolor=\"$bgcolor2\" width=\"100%\"><b>"._WORKBOARD_ADMIN_POSITION_POSITIONLIST."</b></a></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._WORKBOARD_ADMIN_FUNCTIONS."</b></td></tr>";
	if($position_total != 0){
		while ($post= $db->fetch($positionresult)) {
			echo "<tr>";
    		echo "<td><img src=\"images/workboard/icons/position.png\"></td>";
    		echo "<td width=\"100%\"><a href=\"index.php?name=admin/workboard&file=positions&op=WorkBoardPositionEdit&position_id=$post[position_id]\">$post[position_name]</a></td>";
    		echo "<td align=\"center\"><NOBR>[ <a href=\"index.php?name=admin/workboard&file=positions&op=WorkBoardPositionEdit&position_id=$post[position_id]\">"._WORKBOARD_ADMIN_EDIT."</a>";
			echo " | <a href=\"index.php?name=admin/workboard&file=positions&op=WorkBoardPositionRemove&position_id=$post[position_id]\">"._WORKBOARD_ADMIN_DELETE."</a> ]</NOBR></td>";
			echo "</tr>";
    	}
	} else {
		echo "<tr>";
    	echo "<td width=\"100%\" colspan=3 align=\"center\">"._WORKBOARD_ADMIN_POSITION_NOPOSITIONS."</td>";
		echo "</tr>";
	}
	echo "</table>";

}

function workboardPositionAdd(){
	global $db;

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_POSITION_POSITIONADD."</B></CENTER>";

    echo "<BR>";

    echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=positions&op=WorkBoardPositionInsert\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardPositionInsert\">"
		."<font class=\"option\"><b>"._WORKBOARD_ADMIN_POSITION_POSITIONADD."</b></font><br><br>"
		.""._WORKBOARD_ADMIN_POSITION_POSITIONNAME.": <input type=\"text\" name=\"position_name\" size=\"30\"><br>"
		.""._WORKBOARD_ADMIN_POSITION_POSITIONDESCRIPTION.":<br><textarea name=\"position_description\" cols=\"60\" rows=\"10\"></textarea><br><br>"
		."<input type=\"submit\" value=\""._WORKBOARD_ADMIN_POSITION_POSITIONADD."\">"
		."</form>";

}

function workboardPositionInsert($position_name, $position_description){
	global $position_name, $position_description, $db;
			$db->add_db(TB_WORKBOARD_POSITIONS,array(
			"position_name"=>"$_POST[position_name]",
			"position_description"=>"$_POST[position_description]"
		));
		$db->closedb ();

	header("Location: index.php?name=admin/workboard&file=positions&op=WorkBoardPositionList");
}

function workboardPositionEdit($position_id){
	global $position_id, $db;
//	echo "$position_id";
	$positionresult = $db->select_query("select position_name, position_description from ".TB_WORKBOARD_POSITIONS." where position_id='$position_id'");
	$posi = $db->fetch($positionresult);

	workboard_admin_menu();

	//echo "<CENTER><B>"._WORKBOARD_ADMIN_POSITION_EDITPOSITION."</B></CENTER>";

    echo "<BR>";

    echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=positions&op=WorkBoardPositionUpdate\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardPositionUpdate\"><input type=\"hidden\" name=\"position_id\" value=\"$position_id\">"
		."<font class=\"option\"><b>"._WORKBOARD_ADMIN_POSITION_EDITPOSITION."</b></font><br><br>"
		.""._WORKBOARD_ADMIN_POSITION_POSITIONNAME.": <input type=\"text\" name=\"position_name\" size=\"30\" value=\"$posi[position_name]\"><br>"
		.""._WORKBOARD_ADMIN_POSITION_POSITIONDESCRIPTION.":<br><textarea name=\"position_description\" cols=\"60\" rows=\"10\">$posi[position_description]</textarea><br><br>"
		."<input type=\"submit\" value=\""._WORKBOARD_ADMIN_POSITION_UPDATEPOSITION."\">"
		."</form>";

}

function workboardPositionUpdate($position_id, $position_name, $position_description){
	global $position_id, $position_name, $position_description, $db;
		$db->update_db(TB_WORKBOARD_POSITIONS,array(
			"position_name"=>"$_POST[position_name]",
			"position_description"=>"$_POST[position_description]"
		)," position_id=".$_POST[position_id]."");
		$db->closedb ();

	header("Location: index.php?name=admin/workboard&file=positions&op=WorkBoardPositionList");
}

function workboardPositionRemove($position_id){
	global $position_id, $db;
	$positionresult = $db->select_query("select position_name, position_description from ".TB_WORKBOARD_POSITIONS." where position_id='$position_id'");

	$ro = $db->fetch($positionresult);

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_POSITION_DELETEPOSITION."</B></CENTER>";

    echo "<BR>";

	echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=positions&op=WorkBoardPositionDelete\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardPositionDelete\"><input type=\"hidden\" name=\"position_id\" value=\"$position_id\">";
	echo "<center><b>"._WORKBOARD_ADMIN_POSITION_SWAPPOSITION."</b><br><br>";
	echo "$ro[position_name] -> ";
	echo "<select name=\"swap_position_id\">";
	echo "<option value=\"0\">---------</option>";
	$positionlist = $db->select_query("select position_id, position_name from ".TB_WORKBOARD_POSITIONS." where position_id != '$position_id' order by position_name");
	while($ros= $db->fetch($positionlist)){
		echo "<option value=\"$ros[position_id]\">$ros[position_name]</option>";
	}
	echo "</select>";
	echo "<br><br><input type=\"submit\" value=\""._WORKBOARD_ADMIN_POSITION_DELETEPOSITION."\"><br>"
		."</form>";

}

function workboardPositionDelete($position_id, $swap_position_id){
	global $position_id, $swap_position_id, $db;
		$db->del(TB_WORKBOARD_POSITIONS," position_id='".$position_id."' "); 
		$db->update_db(TB_WORKBOARD_PROJECTS_MEMBERS,array(
			"position_id"=>"$swap_position_id"
		)," position_id='".$position_id."'");
		$db->closedb ();
//		echo "$position_id, $swap_position_id, $db";
	header("Location: index.php?name=admin/workboard&file=positions&op=WorkBoardPositionList");
}

##############
# Cases
##############
switch ($op) {
	
	case "WorkBoardPositionList":
	workboardPositionList();
	break;
	
	case "WorkBoardPositionAdd":
	workboardPositionAdd();
	break;
	
	case "WorkBoardPositionInsert":
	workboardPositionInsert($position_name, $position_description);
	break;
	
	case "WorkBoardPositionEdit":
	workboardPositionEdit($position_id);
	break;
	
	case "WorkBoardPositionUpdate":
	workboardPositionUpdate($position_id, $position_name, $position_description);
	break;
	
	case "WorkBoardPositionRemove":
	workboardPositionRemove($position_id);
	break;
	
	case "WorkBoardPositionDelete":
	workboardPositionDelete($position_id, $swap_position_id);
	break;
	
}


?>
</td>
</tr>
</table>
</td>
</tr>
</table>

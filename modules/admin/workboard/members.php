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

CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

include("modules/admin/workboard/includes/functions.php");
if(ISO=='utf-8'){
include("modules/admin/workboard/language/lang-thai_utf-8.php");
} else {
include("modules/admin/workboard/language/lang-thai.php");
}



#####################################
# Members
#####################################

function workboardMemberList(){
	global $db, $bgcolor2;
//	include("header.php");
	workboard_admin_menu();

	echo "<CENTER><FONT CLASS=\"title\"><B>"._WORKBOARD_ADMIN_MEMBERS_MEMBERLIST."</B></FONT></CENTER>";

	echo "<BR>";
	$memberresult = $db->select_query("select member_id, member_name from ".TB_WORKBOARD_MEMBERS." order by member_name");
	$member_total = $db->rows($memberresult);

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=3 width=\"100%\" bgcolor=\"$bgcolor2\"><nobr><b>"._WORKBOARD_ADMIN_MEMBERS_MEMBEROPTIONS."</b></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/options.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr><a href=\"index.php?name=admin/workboard&file=members&op=WorkBoardMemberAdd\">"._WORKBOARD_ADMIN_MEMBERS_MEMBERADD."</a></nobr></td></tr>";
	echo "<tr><td><img src=\"images/workboard/icons/stats.png\"></td><td align=\"left\" colspan=2 width=\"100%\"><nobr>"._WORKBOARD_ADMIN_MEMBERS_TOTALMEMBERS.": <b>$member_total</b></nobr></td></tr>";
	echo "</table>";

	echo "<br>";

	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
	echo "<tr class=\"odd\"><td align=\"left\" colspan=2 bgcolor=\"$bgcolor2\" width=\"100%\"><b>"._WORKBOARD_ADMIN_MEMBERS_MEMBERLIST."</b></a></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._WORKBOARD_ADMIN_FUNCTIONS."</b></td></tr>";
	if($member_total != 0){
		while ($mem= $db->fetch($memberresult)) {
			echo "<tr>";
    		echo "<td><img src=\"images/workboard/icons/member.png\"></td>";
    		echo "<td width=\"100%\"><a href=\"index.php?name=admin/workboard&file=members&op=WorkBoardMemberEdit&member_id=$mem[member_id]\">$mem[member_name]</a></td>";
    		echo "<td align=\"center\"><NOBR>[ <a href=\"index.php?name=admin/workboard&file=members&op=WorkBoardMemberEdit&member_id=$mem[member_id]\">"._WORKBOARD_ADMIN_EDIT."</a>";
			echo " | <a href=\"index.php?name=admin/workboard&file=members&op=WorkBoardMemberRemove&member_id=$mem[member_id]\">"._WORKBOARD_ADMIN_DELETE."</a> ]</NOBR></td>";
			echo "</tr>";
    	}
	} else {
		echo "<tr>";
    	echo "<td width=\"100%\" colspan=3 align=\"center\">"._WORKBOARD_ADMIN_MEMBERS_NOMEMBERS."</td>";
		echo "</tr>";
	}
	echo "</table>";

}

function workboardMemberAdd(){
	global $db, $bgcolor2;
	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_MEMBERS_MEMBERADD."</B></CENTER>";

    echo "<BR>";

    echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=members&op=WorkBoardMemberInsert\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardMemberInsert\">"
		."<font class=\"option\"><b>"._WORKBOARD_ADMIN_MEMBERS_MEMBERADD."</b></font><br><br>"
		.""._WORKBOARD_ADMIN_MEMBERS_MEMBERNAME.": <input type=\"text\" name=\"member_name\" size=\"30\"><br>"
		.""._WORKBOARD_ADMIN_MEMBERS_MEMBEREMAIL.": <input type=\"text\" name=\"member_email\" size=\"30\"><br><br>"
		."<input type=\"submit\" value=\""._WORKBOARD_ADMIN_MEMBERS_MEMBERADD."\">"
		."</form>";

}

function workboardMemberInsert($member_name, $member_email){
global $db, $member_name, $member_email;
				$db->add_db(TB_WORKBOARD_MEMBERS,array(
			"member_name"=>"$_POST[member_name]",
			"member_email"=>"$_POST[member_email]"
		));
		$db->closedb ();

	header("Location: index.php?name=admin/workboard&file=members&op=WorkBoardMemberList");
}

function workboardMemberEdit($member_id){
	global $member_id, $db;
	$memberresult = $db->select_query("select member_name, member_email from ".TB_WORKBOARD_MEMBERS." where member_id='$member_id'");
	$mems = $db->fetch($memberresult);

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_MEMBERS_EDITMEMBER."</B></CENTER>";

    echo "<BR>";

    echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=members&op=WorkBoardMemberUpdate\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardMemberUpdate\"><input type=\"hidden\" name=\"member_id\" value=\"$member_id\">"
		."<font class=\"option\"><b>"._WORKBOARD_ADMIN_MEMBERS_EDITMEMBER."</b></font><br><br>"
		.""._WORKBOARD_ADMIN_MEMBERS_MEMBERNAME.": <input type=\"text\" name=\"member_name\" size=\"30\" value=\"$mems[member_name]\"><br>"
		.""._WORKBOARD_ADMIN_MEMBERS_MEMBEREMAIL.": <input type=\"text\" name=\"member_email\" size=\"30\" value=\"$mems[member_email]\"><br><br>"
		."<input type=\"submit\" value=\""._WORKBOARD_ADMIN_MEMBERS_UPDATEMEMBER."\">"
		."</form>";

}

function workboardMemberUpdate($member_id, $member_name, $member_email){
	global $member_id, $member_name, $member_email, $db;

		$db->update_db(TB_WORKBOARD_MEMBERS,array(
			"member_name"=>"$_POST[member_name]",
			"member_email"=>"$_POST[member_email]"
		)," member_id=".$member_id."");
		$db->closedb ();
	header("Location: index.php?name=admin/workboard&file=members&op=WorkBoardMemberList");
}

function workboardMemberRemove($member_id){
	global $member_id, $db;
	$memberresult = $db->select_query("select member_name from ".TB_WORKBOARD_MEMBERS." where member_id='$member_id'");
	$list = $db->fetch($memberresult);

	workboard_admin_menu();

	echo "<CENTER><B>"._WORKBOARD_ADMIN_MEMBERS_DELETESTATUS."</B></CENTER>";

    echo "<BR>";

	echo "<form method=\"post\" action=\"index.php?name=admin/workboard&file=members&op=WorkBoardMemberDelete\" enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"op\" value=\"WorkBoardMemberDelete\"><input type=\"hidden\" name=\"member_id\" value=\"$member_id\">";
	echo "<center><b>"._WORKBOARD_ADMIN_MEMBERS_SWAPMEMBER."</b><br><br>";
	echo "$list[member_name] -> ";
	echo "<select name=\"swap_member_id\">";
	echo "<option value=\"0\">---------</option>";
	$memberlist = $db->select_query("select member_id, member_name from ".TB_WORKBOARD_MEMBERS." where member_id != '$member_id' order by member_name");
	while($list2 = $db->fetch($memberlist)){
		echo "<option value=\"$list2[member_id]\">$list2[member_name]</option>";
	}
	echo "</select>";
	echo "<br><br><input type=\"submit\" value=\""._WORKBOARD_ADMIN_MEMBERS_DELETESTATUS."\"><br>"
		."</form>";

}

function workboardMemberDelete($member_id, $swap_member_id){
	global $member_id, $swap_member_id, $db;
		$db->del(TB_WORKBOARD_MEMBERS," member_id='".$member_id."' "); 
		$db->update_db(TB_WORKBOARD_TASKS_MEMBERS,array(
			"member_id"=>"$swap_member_id"
		)," member_id='".$member_id."'");
		$db->closedb ();

	header("Location: index.php?name=admin/workboard&file=members&op=WorkBoardMemberList");
}

##############
# Cases
##############
switch ($op) {
	
	case "WorkBoardMemberList":
	workboardMemberList();
	break;
	
	case "WorkBoardMemberAdd":
	workboardMemberAdd();
	break;
	
	case "WorkBoardMemberInsert":
	workboardMemberInsert($member_name, $member_email);
	break;
	
	case "WorkBoardMemberEdit":
	workboardMemberEdit($member_id);
	break;
	
	case "WorkBoardMemberUpdate":
	workboardMemberUpdate($member_id, $member_name, $member_email);
	break;
	
	case "WorkBoardMemberRemove":
	workboardMemberRemove($member_id);
	break;
	
	case "WorkBoardMemberDelete":
	workboardMemberDelete($member_id, $swap_member_id);
	break;
	
}


?>

</td>
</tr>
</table>
</td>
</tr>
</table>
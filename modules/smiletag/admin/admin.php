<?php
	require_once('modules/smiletag/admin/checkSession.php');
//	  defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>SmileTAG - Administration Panel</title>
<link href="modules/smiletag/admin/smiletag-admin.css" type=text/css rel=stylesheet>
<script type="text/javascript" language="JavaScript" src="modules/smiletag/admin/smiletag-admin.js"></script>
</head>

<body onLoad="MM_preloadImages('modules/smiletag/admin/images/messages.png','modules/smiletag/admin/images/moderation.png','modules/smiletag/admin/images/ban.png','modules/smiletag/admin/images/smilies.png','modules/smiletag/admin/images/badwords.png','modules/smiletag/admin/images/config.png')">
<br>
<TABLE WIDTH="820"  border="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>

		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" ><BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_USER_MENU_TITLE;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; SmileTAG </B>
					<BR><BR></TD>
				</TR>

<div class=centermain align=center>
  <div class=main>&nbsp;&nbsp;
    <table border="0" cellpadding="0" cellspacing="0" width="800">
	<tr><td><br>
    <table class=adminform align="center" >
      <tbody>
        <tr>
          <td valign=top><div id=cpanel>
              <div style="float: left">
                <div class=icon><a 
      href="?name=admin&file=smiletag&show=messages"><img src="modules/smiletag/admin/images/messages.png" 
      alt="Messages" border=0 align=middle><span><b>Messages</b></span></a></div>
              </div>
              <div style="float: left">
                <div class=icon><a 
      href="?name=admin&file=smiletag&show=moderation"><img src="modules/smiletag/admin/images/moderation.png" 
      alt="Awaiting Moderation"  
      border=0 align=middle> <span><b>Awaiting Moderation</b></span></a></div>
              </div>
              <div style="float: left">
                <div class=icon><a 
      href="?name=admin&file=smiletag&show=ban"><img src="modules/smiletag/admin/images/ban.png" 
      alt="Ban List" name=""  
      border=0 align=middle><span><b>Ban List</b></span> </a></div>
              </div>
              <div style="float: left">
                <div class=icon><a 
      href="?name=admin&file=smiletag&show=smilies"><img 
      alt="Smilies" src="modules/smiletag/admin/images/smilies.png" align=middle 
      border=0 name=""> <span><b>Smilies</b></span> </a></div>
              </div>
              <div style="float: left">
                <div class=icon><a 
      href="?name=admin&file=smiletag&show=badwords"><img src="modules/smiletag/admin/images/badwords.png" 
      alt="Bad Words" 
      name=""  border=0 align=middle> <span><b>Bad Words</b></span> </a></div>
              </div>
              <div style="float: left">
                <div class=icon><a 
      href="?name=admin&file=smiletag&show=configuration"><img 
      alt="Global Configuration" src="modules/smiletag/admin/images/config.png" align=middle 
      border=0 name=""> <span> <b>Configuration</b></span> </a></div>
              </div>
            </div></td>
        </tr>
      </tbody>
    </table>
	<br />
	<?php
		if(!empty($_SESSION['SMILETAG_MESSAGE'])){
	?>		<div align="center">
			<table width="50%" border="0" cellpadding="0" cellspacing="0" class="grid">
             <tr class="odd">
               <th valign="middle" nowrap scope="col"><img src="modules/smiletag/admin/images/info.png" align="absmiddle"><span class="infoText"><?php echo $_SESSION['SMILETAG_MESSAGE']; ?></span> </th>
             </tr>
           </table></div><br />
	<?php
           	$_SESSION['SMILETAG_MESSAGE'] = null;
		}
	?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
		   <td align="center" valign="top">
		  	<?php
		  		$show = null;
		  		if(!empty($_GET['show'])){
		  		    $show = trim($_GET['show']);
		  		}
		  		
		  		if($show == 'messages'){ //show messages list
		  			require_once('modules/smiletag/admin/showMessage.php');	
		  		}elseif($show == 'edit_message'){ //show edit message form
		  			require_once('showEditMessage.php');
		  		}elseif($show == 'moderation'){ //show messages moderation list
		  			require_once('modules/smiletag/admin/showMessageModeration.php');
		  		}elseif($show == 'edit_message_moderation'){ //show edit message form in moderation list
		  			require_once('modules/smiletag/admin/showEditMessageModeration.php');
		  		}elseif($show == 'ban'){ //show ban list
		  			require_once('modules/smiletag/admin/showBan.php');
		  		}elseif($show == 'smilies'){ //show smilies list
		  			require_once('showSmilies.php');
		  		}elseif($show == 'badwords'){ //show badwords list
		  			require_once('modules/smiletag/admin/showBadwords.php');
		  		}elseif($show == 'configuration'){ //show global configuration
		  			require_once('modules/smiletag/admin/showConfiguration.php');
		  		}
		  	?>	
		   </td>
		</tr>
	</table>
	</td></tr>
   </table>
  </div>
</div>

</td>
</tr>
</table>

</body>
</html>

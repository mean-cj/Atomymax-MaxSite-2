<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?=WEB_TITILE;?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$iso;?>">
<meta name="keywords" content="<?=WEB_TITILE;?>">
<meta name="description" content="<?=WEB_TITILE;?>">

<meta name="google-site-verification" content="ivsFd-l28inFeN0lt4bISp98fdzCDXEJb4BcXJGfEog" />
<link href="templates/cli3/css/cli3.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
// create a new Date object then get the current time
var start = new Date();
var startsec = start.getTime();

// run a loop counting up to 250,000
var num = 0;
for( var i = 0; i < 250000; i++ )
{
  num++;
}

var stop  = new Date();
var stopsec = stop.getTime();

var loadtime = ( stopsec - startsec ) / 1000;

  </script>

</head>

<body background="templates/cli3/images/bg.gif">

<?
require_once("mainfile.php");
$_SERVER['PHP_SELF'] = "index.php";
if(ISO =='utf-8'){
require_once("templates/".WEB_TEMPLATES."/lang/tem_thai_utf8.php");
} else {
require_once("templates/".WEB_TEMPLATES."/lang/tem_thai_tis620.php");
}
?>
<div id="dhtmltooltip"></div>

<TABLE width="1024" height="100%" border="0" align="center" cellPadding="0" cellSpacing="0" bgcolor="#ffffff">
	<tr>
		<TD width="1024" align="center" >
			<div align="center">
			<div id="outer1" >
				<div id="outer2" >
				<table id="Table_01" width="<?=_TEMPLATES_WIDTH_CONFIG;?>" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td colspan="6" >
<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); // Connect DB
$res['config'] = $db->select_query("SELECT * FROM ".TB_CONFIG.",".TB_TEMPLATES." where name=temname and sort='1' ");
$arr['config'] = $db->fetch($res['config']);
//$db->closedb (); // Disconnect DB
 $types=$arr['config']['type'];

 if ($types !='application/x-shockwave-flash' ) {
?>
<TABLE width="<?=$arr['config']['width'];?>" align=right cellSpacing=0 cellPadding=0 border=0>
<TR>
<TD valign="top" width="<?=$arr['config']['width'];?>" background="templates/<?echo WEB_TEMPLATES;?>/images/config/<?=$arr['config']['picname'];?>"  width="<?=$arr['config']['width'];?>" height="<?=$arr['config']['height'];?>" border="0" valign="top" colspan="6">
<table align=right cellSpacing=0 cellPadding=0 border="0">
<tr>
<td colspan="6" align="right" >
		<?
empty($_SESSION['admin_user'])?$admin_user="":$admin_user=$_SESSION['admin_user'];
empty($_SESSION['admin_pwd'])?$admin_pwd="":$admin_pwd=$_SESSION['admin_pwd'];
empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];
if ($admin_user) {
echo "<font color=#CFCFCF><b>"._TEM_WEL." </font><font color=#3366FF>$admin_user </b></font>";
}else if($login_true){
echo "<font color=#CFCFCF><b>"._TEM_WEL." </font><font color=#00CC33>$login_true </b></font>";
} else {
echo "<font color=#CFCFCF><b>"._TEM_WEL." </font><font color=#CC0000>"._TEM_WEL_GUEST."</b></font>";
}
?>
&nbsp;&nbsp;<br>
</td>
</tr>
<?php if (CountBlock('header')) { ?>
<tr><td colspan="6" align="right" >
<?
	LoadBlock('header'); 
?>
</td>
</tr>
<? } ?>
					<tr>
						<td background="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_01.png" width="95" height="37" border="0">
			<a href="index.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('home','','templates/<?echo WEB_TEMPLATES;?>/images/menu/menu1_01.png',1)"><img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_01.png" width="95" height="37" alt="" name="home"></a></td>
						<td  background="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_02.png" width="83" height="37" border="0" >
			<a href="?name=news" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('news','','templates/<?echo WEB_TEMPLATES;?>/images/menu/menu1_02.png',1)"><img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_02.png" width="83" height="37" alt="" name="news"></a></td>
						<td background="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_03.png" border="0" width="96" height="37">
			<a href="?name=webboard" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('webboard','','templates/<?echo WEB_TEMPLATES;?>/images/menu/menu1_03.png',1)"><img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_03.png" width="96" height="37" name="webboard" alt=""></a></td>
						<td background="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_04.png" border="0" width="102" height="37">
			<a href="?name=gallery" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('gallery','','templates/<?echo WEB_TEMPLATES;?>/images/menu/menu1_04.png',1)"><img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_04.png" width="102" height="37" alt="" name="gallery"></a></td>
						<td background="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_05.png" border="0" width="93" height="37">
				<a href="?name=gbook" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('gbook','','templates/<?echo WEB_TEMPLATES;?>/images/menu/menu1_05.png',1)"><img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_05.png" width="93" height="37" alt="" name="gbook"></a></td>
						<td background="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_06.png" border="0" width="91" height="37"><a href="?name=admin" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('admin','','templates/<?echo WEB_TEMPLATES;?>/images/menu/menu1_06.png',1)"><img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/menu_06.png" width="91" height="37" alt="" name="admin"></a></td>
					</tr>
</table>
</td>
</tr>
</table>
<?
	} else {
		  ?>

<TABLE width="<?=$arr['config']['width'];?>" align=center cellSpacing=0 cellPadding=0 border=0>
<TR>
<TD width="<?=$arr['config']['width'];?>" border="0">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="<?=$arr['config']['width'];?>" height="<?=$arr['config']['height'];?>" border="0">
 <param name="movie" value="templates/<?=WEB_TEMPLATES;?>/images/config/<?=$arr['config']['picname'];?>" />
<param name="quality" value="high" />
<param name="wmode" value="transparent">
<embed src="templates/<?=WEB_TEMPLATES;?>/images/config/<?=$arr['config']['picname'];?>"
      quality="high"
      type="application/x-shockwave-flash"
      width="<?=$arr['config']['width'];?>"
      height="<?=$arr['config']['height'];?>"
pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="opaque"></embed>
</object>
</td>
</tr>
</table>
<?
}
?>


						</td>
					</tr>
					<tr>
						<td colspan="6"><? include 'modules/config/top2.php'; ?></td>
					</tr>
					<tr>
						<td colspan="6" background="templates/<?echo WEB_TEMPLATES;?>/images/bar.png" width=1000 height=27 >
							<?php if (CountBlock('pathway')) { ?>
													<?php LoadBlock('pathway'); ?>
									<?php } ?>
						</td>
					</tr>
				</table>

<center>
				<TABLE cellSpacing=0 cellPadding=0 width=<?=_TEMPLATES_WIDTH_CONFIG;?> align=center border=0>
				<TBODY>
				</table>
<table cellSpacing=0 cellPadding=0 width=990 align=center border=0>
<tr>
<td width=990>
				<TABLE cellSpacing=0 cellPadding=0 width=990 align=center border=0>
				<TBODY>
					<TR>
					<td width="220" valign="top">
								<? if($name<>"admin" && $name<>"admin/workboard" && $name<>"admin/backup" ) { ?>


								<? //blockleft;?>

									<?php if (CountBlock('left')) { ?>

										<table cellspacing="0" cellpadding="0" width="220" >
											<tr><td width="220" valign="top" id="leftcol">
													<?php LoadBlock('left'); ?>
													</td>
											</tr>
										</table><br>
									<?php } ?>


						<?}?>
						</td>
						<TD vAlign="top" align="center" width="10" ></TD>
<TD vAlign="top" align="center" width="100%" align="center">

	<? if($name=="") { ?>

										<table width="100%" cellspacing="0" cellpadding="0" >
											<tr>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="770" vAlign=top align=left><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;
								<? //blockcenter;?>
 									<?php if (CountBlock('user2')) { ?>

										<table width="100%" cellspacing="0" cellpadding="0" >
											<tr>
												<td >
                        							<div >
													<?php LoadBlock('user2'); ?>
													</div>
												</td>
											</tr>
										</table>
										<br>
									<?php } ?>

									<?php if (CountBlock('center')) { ?>
									<table cellspacing="0" cellpadding="0" width="100%">
										<tr>
										<td >
										<div >
											<?php LoadBlock('center'); ?>
                         				<div>
										</td>
										</tr>
									</table>
										<br>
									<?php } ?>
									
									<?php if (CountBlock('user1')) { ?>
									<center>
									<table width="100%" cellspacing="0" cellpadding="0" >
										<tr>
											<td >
												<div id="main_top_wrape">
												<?php LoadBlock('user1'); ?>
												</div>
											</td>
										</tr>
										</table><br>
										</center>
										<?php } ?>

				</td>


<? //blockright;?>
							<?php if (CountBlock('right')) { ?>
        <TD width="10" vAlign=top></TD>
          <TD width="220" vAlign=top align=left>
									
							<table cellspacing="0" cellpadding="0" width="220" >
							<tr>
								<td width="220" valign="top"  align="center">
								<?php LoadBlock('right'); ?>
						</td>
						</tr>
						</table><br><br>
						</td>
						<?php } ?>
			</td>
			</tr>
			</table>

<?} else {
OpenTable();
require_once ("".$MODPATHFILE."");
 CloseTable();
} ?>
</td>
						</tr>
						</table>
</td>
</tr>
									<?php if (CountBlock('bottom')) { ?>
<tr>
<td>
									<table width="<?=_TEMPLATES_WIDTH_CONFIG;?>" cellspacing="0" cellpadding="0">
										<tr>
											<td >
                        					<div >
											<?php LoadBlock('bottom'); ?>
											</div>
											</td>
										</tr>
									</table>
</td>
</tr>
									<?php } ?>
</table>

	  <table border="0" align="center" cellpadding="0" cellspacing="0" width="<?=_TEMPLATES_WIDTH_CONFIG;?>">
        <tr>
          <td valign="top" class="footer" bgcolor="#1B6AE0"><?include "modules/config/top3.php";?>
		  </td>
		  </tr>
		  <tr>
          <td valign="top" class="footer" bgcolor="#1B6AE0">
		  <div align="center" ><strong><b><?=WEB_FOOTER1;?></b></strong><br><?=WEB_FOOTER2;?>
<br>
<SCRIPT>
 document.write(" : <?echo _TEM_LOAD_PAGE;?>" +loadtime+ " <? echo _TEM_LOAD_PAGE_TIME;?> : ");
</SCRIPT>
<br>
@2010-2011 under <a target="_blank" href="http://www.gnu.org/copyleft/gpl.html"><font color="#CCCCCC" size="2">  GNU General Public License</font></a><font color="#ffffff">   Edit&Applied by</font><a target="_blank" title="<?=_TEM_POSITION;?>" href="http://maxtom.sytes.net/">  <font color="#CCCCCC" size="2">Chudsagorn phikulthong</font></a><br>
<div align="center" ><font color="#ffffff" size="2">Power by : <a href="http://maxtom.sytes.net" target="_blank" ><font color="#CCCCCC" size="2"><?= _SCRIPT." "._VERSION ;?></font></a>
</div>

		  </td>
		 </tr>
      </table>

</td>
</tr>
</table>
</div>
</div>
</div>
  </TD>

    </TR>
  </TBODY>
</TABLE>
</body>
</html>
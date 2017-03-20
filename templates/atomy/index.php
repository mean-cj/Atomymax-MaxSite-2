<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?=WEB_TITILE;?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$iso;?>">
<meta name="keywords" content="<?=WEB_TITILE;?>">
<meta name="description" content="<?=WEB_TITILE;?>">
<link href="templates/atomy/css/atomy.css" rel="stylesheet" type="text/css">
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

<body background="templates/atomy/images/bg.gif">
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

<TABLE width=1024 height="100%" border=0 align=center cellPadding=0 cellSpacing=0 bgcolor="#ffffff">
	<tr >
		<TD width="1024" align="center">
		<div align="center">
			<div id="outer1" >
				<div id="outer2" >
				<table id="Table_01" width="<?=_TEMPLATES_WIDTH_CONFIG;?>" border="0" cellpadding="0" cellspacing="0"  align="center" >
					<tr>
						<td colspan="9" align="center">
<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); // Connect DB
$res['config'] = $db->select_query("SELECT * FROM ".TB_CONFIG.",".TB_TEMPLATES." where name=temname and sort='1' ");
$arr['config'] = $db->fetch($res['config']);
//$db->closedb (); // Disconnect DB
 $types=$arr['config']['type'];

 if ($types !='application/x-shockwave-flash' ) {
?>
<TABLE width="<?=$arr['config']['width'];?>" cellSpacing=0 cellPadding=0 border=0>
	<TR>
		<TD valign="top" width="<?=$arr['config']['width'];?>" background="templates/<?echo WEB_TEMPLATES;?>/images/config/<?=$arr['config']['picname'];?>"  width="<?=$arr['config']['width'];?>" height="<?=$arr['config']['height'];?>" border="0">
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
						<td colspan="9" align="center"><? include 'modules/config/top2.php'; ?></td>
					</tr>
					<tr  align="center">
						<td background="templates/atomy/images/menu/atomy_bar1.png" width="196" height="44" border="0">
			<a href="index.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('home','','templates/atomy/images/menu/atomy_bar11.png',1)"><img src="templates/atomy/images/menu/atomy_bar1.png" width="196" height="44" alt="" name="home"></a></td>
						<td  background="templates/atomy/images/menu/atomy_bar2.png" width="87" height="44" border="0" >
			<a href="?name=news" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('news','','templates/atomy/images/menu/atomy_bar22.png',1)"><img src="templates/atomy/images/menu/atomy_bar2.png" width="87" height="44" alt="" name="news"></a></td>
						<td background="templates/atomy/images/menu/atomy_bar3.png" border="0" width="135" height="44">
			<a href="?name=knowledge" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('knowledge','','templates/atomy/images/menu/atomy_bar33.png',1)"><img src="templates/atomy/images/menu/atomy_bar3.png" width="135" height="44" name="knowledge" alt=""></a></td>
						<td background="templates/atomy/images/menu/atomy_bar4.png" border="0" width="125" height="44">
			<a href="?name=webboard" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('webboard','','templates/atomy/images/menu/atomy_bar44.png',1)"><img src="templates/atomy/images/menu/atomy_bar4.png" width="125" height="44" alt="" name="webboard"></a></td>
						<td background="templates/atomy/images/menu/atomy_bar5.png" border="0" width="136" height="44">
				<a href="?name=download" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('download','','templates/atomy/images/menu/atomy_bar55.png',1)"><img src="templates/atomy/images/menu/atomy_bar5.png" width="136" height="44" alt="" name="download"></a></td>
						<td background="templates/atomy/images/menu/atomy_bar6.png" border="0" width="114" height="44">
			<a href="?name=gallery" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('gallery','','templates/atomy/images/menu/atomy_bar66.png',1)"><img src="templates/atomy/images/menu/atomy_bar6.png" width="114" height="44" alt="" name="gallery"></a></td>
						<td background="templates/atomy/images/menu/atomy_bar7.png" border="0" width="102" height="44"><a href="?name=admin" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('admin','','templates/atomy/images/menu/atomy_bar77.png',1)"><img src="templates/atomy/images/menu/atomy_bar7.png" width="102" height="44" alt="" name="admin"></a></td>
					</tr>
				</table>

<center>
<table cellSpacing=0 cellPadding=0 width=<?=_TEMPLATES_WIDTH_CONFIG;?> align=center border=0>
<tr>
<td width=996  align="center">
				<TABLE cellSpacing=0 cellPadding=0 width=<?=_TEMPLATES_WIDTH_CONFIG;?> align=center border=0>
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
						<TD vAlign="top" align="center" width="10" >&nbsp;</TD>
<TD vAlign="top" align="center" width="100%" align="center">

	<? if($name=="") { ?>

										<table width="100%" cellspacing="0" cellpadding="0" >
											<tr>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="530" vAlign=top align=left><IMG src="images/topfader.gif" border=0><BR>
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
<TD width="10" vAlign=top>&nbsp;&nbsp;</TD>

<? //blockright;?>
							<?php if (CountBlock('right')) { ?>

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

<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); // Connect DB
$res['config'] = $db->select_query("SELECT * FROM ".TB_CONFIG.",".TB_TEMPLATES." where name=temname and sort='3' ");
$arr['config'] = $db->fetch($res['config']);
//$db->closedb (); // Disconnect DB
 $types=$arr['config']['type'];
?>

	  <table border="0" align="center" cellpadding="5" cellspacing="0" background="templates/<?echo WEB_TEMPLATES;?>/images/config/<?=$arr['config']['picname'];?>"  width="<?=$arr['config']['width'];?>" height="<?=$arr['config']['height'];?>">
        <tr height="5">
		<TD valign="top" width="<?=$arr['config']['width'];?>"  border="0">
			</td>
        </tr>
		<tr>
          <td valign="top" ><div align="center" ><font color="#ffffff">Based on : <a href="http://maxsite.geniuscyber.com" target="_blank" ><font color="#ffffff">Maxsite1.10 </a>Modified to <a href="<?=WEB_URL;?>" target="_blank" ><font color="#ffffff"><?= _SCRIPT." "._VERSION ;?></a></div>
		  </td>
		 </tr>
        <tr>
          <td valign="top" class="foottext"><div align="center" ><strong><b><?=WEB_FOOTER1;?></b></strong><br><?=WEB_FOOTER2;?><br>Based on : <a href="http://maxsite.geniuscyber.com" target="_blank" ><font color=#0066FF><b>Maxsite1.10 </font></b></a> Modified to <a href="<?=WEB_URL;?>" target="_blank" ><b><font color=#0066FF><?= _SCRIPT." "._VERSION ;?></b></font></a>
<SCRIPT>
 document.write(" : <?echo _TEM_LOAD_PAGE;?>" +loadtime+ " <? echo _TEM_LOAD_PAGE_TIME;?> : ");
</SCRIPT>




		  </td>
			</div>
			</td>
        </tr>

      </table>

</td>
</tr>
</table>
	  </TD>
</div>
</div>
    </TR>
  </TBODY>
</TABLE>
</body>
</html>
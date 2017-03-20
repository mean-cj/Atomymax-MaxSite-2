<?
require_once("mainfile.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=WEB_URL;?>-Offline</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$iso;?>">
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" href="css/template_css.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html;" />
</head>
<body>

<p>&nbsp;</p>
<table width="650" align="center" style="background-color: #ffffff; border: 1px solid">
<tr>
	<td width="60%" height="50" align="center">
	<img src="images/dangerous.png" alt="dangerous" align="middle" />
	</td>
</tr>
<tr> 
	<td align="center">
	<h1>
	<?=WEB_URL;?>
	</h1>
	</td>
</tr>
	<tr> 
		<td width="39%" align="center">
		<h2>
		<?php echo _INSTALL_WARN; ?>
		</h2>
		</td>
	</tr>

</table>

</body>
</html>

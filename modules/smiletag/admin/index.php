<?php
//	session_start();
	//  defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>SmileTAG Admin Panel - Login</title>
<link href="modules/smiletag/admin/smiletag-login.css" type=text/css rel=stylesheet>
<link href="modules/smiletag/admin/smiletag-admin.css" type=text/css rel=stylesheet>
</head>

<body>
<?php 
	if(empty($admin_user)){
//		$_SESSION['admin_user'] = null;	
?>
<div align="center" style="padding-top:20px; padding-bottom:0px;">
			<table width="30%" border="0" cellpadding="0" cellspacing="0" class="grid">
             <tr class="odd">
               <th valign="middle" nowrap scope="col"><img src="modules/smiletag/admin/images/info.png" align="absmiddle"><span class="infoText">Incorrect Username and Password!</span> </th>
             </tr>
			</table>
</div>

<div id="ctr" align="center">
	<div class="login">
		<div class="login-form">
			<span class="panelTitle">SmileTAG Admin Panel</span><br /><br />
			<form action="?name=smiletag/admin/loginProcess.php" method="post" name="loginForm" id="loginForm">
			<div class="form-block">
				<div class="inputlabel">Username</div>
				<div><input name="username" type="text" class="inputbox" size="15" /></div>
				<div class="inputlabel">Password</div>
				<div><input name="password" type="password" class="inputbox" size="15" /></div>
				<div align="left"><input type="submit" name="submit" class="button" value="Login" /></div>
			</div>
			</form>
	  </div>
		<div class="login-text">
			<div class="ctr"><img src="modules/smiletag/admin/images/login.png" /></div>
			
	  </div>
<?php 
	}  else {
header("Location: ?name=smiletag/admin&file=admin");
	  }
?>
</div>
</body>
</html>

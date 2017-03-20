<?php
#### สคริ๊ปนี้ใช้ในการเช็ค ว่าล็อกอินหรือยัง ให้นำสคริ๊ปนี้ไปไว้ที่หน้าที่คุณต้องการให้เช็ค ####

if(!$login_true) {
exit() ;
echo " bgcolor=E8E8E8";
}
### จบการเช็ค ###
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net

?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body bgcolor="E8E8E8">
<strong><font color="#FF6633" size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$result = mysql_query("select * from member where user='$login_true'") or die ("Err Can not to result") ;
$dbarr = mysql_fetch_array($result) ;


?>&nbsp;
Wellcome <?php echo $dbarr['user'] ; ?> </font> </strong> 
</body>
</html>

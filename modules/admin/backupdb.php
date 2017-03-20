<?php
require_once("includes/config.in.php");
require_once("includes/class.mysql.php");
CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);
/*=====================================================================================*/
/* SCRIPT CONFIGURATION */
/*=====================================================================================*/
$mysql['host']    = ''.DB_HOST.'';                    // ussually localhost
$mysql['user']    = ''.DB_USERNAME.'';                         // mysql username
$mysql['pass']    = ''.DB_PASSWORD.'';                     // mysql password
$mysql['name']    = ''.DB_NAME.'';				// mysql database name
if(ISO=='utf-8'){
$mysql['charset'] = "utf8";                          // connection charset
} else {
$mysql['charset'] = "tis620";                          // connection charset
}
$file = 'backup/'.date('Y-m-d').'-db_backup.zip'; // will produce file like 2009-05-19-db_backup.zip

/*=====================================================================================*/
/* DONOT EDIT BEYOND THIS LINE */
/*=====================================================================================*/
 
// show all error
error_reporting(E_ALL);
 
 
// you may need this
//ini_set('max_execution_time',0);
//ini_set('memory_limit','100M');
 
// file name of sql file , will be deleted when backup finished
$sql_file = 'backup/db_backup.sql';
 
// try to create file
if ( ! $fp = @fopen($sql_file,'w'))
{
 die('Cannot create file db_backup.sql please check file permission');
}
 
 
// connect to mysql
$mysql_link = mysql_connect($mysql['host'],$mysql['user'],$mysql['pass']) or die(mysql_error());
mysql_select_db($mysql['name'],$mysql_link) or die(mysql_error($mysql_link));
//mysql_query("SET NAMES {$mysql['charset']}",$mysql_link);
mysql_query("SET character_set_results={$mysql['charset']}",$mysql_link); 
mysql_query("SET character_set_client={$mysql['charset']}",$mysql_link);
mysql_query("SET character_set_connection={$mysql['charset']}",$mysql_link);
// close mysql on exit
register_shutdown_function(create_function('$link','if (is_resource($link)) mysql_close($link);'),$mysql_link);
 
 
// list all tables
$tables = array();
$result = mysql_query("SHOW TABLES FROM `{$mysql['name']}`",$mysql_link);
while (($row = mysql_fetch_array($result,MYSQL_NUM)) !== FALSE)
{
 $tables[] = $row[0];
}
mysql_free_result($result);
 
 
// check if have no table
if (count($tables) === 0)
{
 die('No tables in database');
}
 
 
 
function format_insert_value($value)
{
 global $mysql_link;
 return ($value === '') ? "''" : "'".mysql_real_escape_string($value,$mysql_link)."'" ;
}
 
// export each table
foreach ($tables as $table)
{
 $result = mysql_query("SHOW CREATE TABLE `{$table}`",$mysql_link);
 $row = mysql_fetch_array($result,MYSQL_NUM);
 mysql_free_result($result);
 
 if ( ! $row)
 {
  echo 'Cannot create table structure for table "'.$table.'"';
  continue;
 }
 
 $structure = "DROP TABLE IF EXISTS `{$table}`;\n\n";
 $structure .= $row[1].";\n\n";
 
 // write sql table structure to file
 fwrite($fp,$structure);
 
 // get data from table
 $result = mysql_query("SELECT * FROM `{$table}`",$mysql_link);
 while (($row = mysql_fetch_assoc($result)) !== FALSE)
 {
  $row = array_map('format_insert_value',$row);
  $sql = "INSERT INTO `{$table}` VALUES (".implode(',',$row).");\n";
  fwrite($fp,$sql);
 }
 mysql_free_result($result);
}
 
fclose($fp);
 
 
// zipfile
require_once 'dZip.inc.php'; // change this if you put dZip.inc.php on other place
$zip = new dZip($file);
$zip->addFile("backup/db_backup.sql", "db_backup.sql");
$zip->save();

//	$ZipName = "MyFiles/MyZip.zip";
//	require_once("dZip.inc.php"); // include Class
//	$zip = new dZip($ZipName); // New Class
//	$zip->addFile("thaicreate1.txt", "thaicreate1.txt"); // Source,Destination
//	$zip->addFile("thaicreate2.txt", "thaicreate2.txt");
//	$zip->addDir("MySub"); // Add Folder
//	$zip->addFile("thaicreate3.txt", "MySub/thaicreate3.txt"); // Add file to Sub
//	$zip->addFile("thaicreate4.txt", "MySub/thaicreate4.txt");
//	$zip->save();
//	echo "Zip Successful Click <a href=$ZipName>here</a> to Download";


@unlink($sql_file) or die("Database backup finished");

?>
<body>
	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<BR><BR>
 <br>
 <?
$files=substr($file,7,24);
echo "<center><h4>"._ADMIN_BACKUPDATA_MESSAGE_ACCESS."<a href=\"".WEB_URL."/backup/$files\" target=\"_blank\">&nbsp;&nbsp;$files</a></h4><br><br><font color=red><h4>"._ADMIN_BACKUP_MESSAGE_DEL."</font></h4>";
?>
<h4><a href="index.php?name=admin&file=filemanager&u=admin&copt=1&sortKey=0&pathext=backup/" target="_blank"><<  <?=_ADMIN_BACKUP_MESSAGE_DEL1;?> >></a></h4>

</td>
</tr>
</table>
				</TD>
				</TR>
			</TABLE>

<?php
// defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
    require_once('lib/domit/xml_domit_lite_include.php');
	require_once('lib/St_XmlParser.class.php');	
	require_once('lib/St_ConfigManager.class.php');
	require_once('lib/St_FileDao.class.php');
	require_once('lib/St_PersistenceManager.class.php');
	require_once('lib/St_TemplateParser.class.php');
	require_once('lib/St_ViewManager.class.php');
	
//	echo "<p align=\"center\"><center><a name=\"scroller\"></a><MARQUEE direction=\"up\" height=\"180\" width=\"180\" scrollamount=\"2\" scrolldelay=\"0\" onmouseover=this.stop() onmouseout=this.start()>";
//echo "<table cellspacing=\"0\" cellpadding=\"0\"  width=\"150\"><tr >";

	$viewManager =& new St_ViewManager();
	$viewManager->display();
	
//echo "</MARQUEE></p>";
?>
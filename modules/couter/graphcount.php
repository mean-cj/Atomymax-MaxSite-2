<?php
/*******************************************************************************
*  Title: PHP graphical hit counter (PHPGcount)
*  Version: 1.1 @ October 26, 2007
*  Author: Klemen Stirn
*  Website: http://www.phpjunkyard.com
********************************************************************************
*  COPYRIGHT NOTICE
*  Copyright 2004-2007 Klemen Stirn. All Rights Reserved.
*
*  This script may be used and modified free of charge by anyone
*  AS LONG AS COPYRIGHT NOTICES AND ALL THE COMMENTS REMAIN INTACT.
*  By using this code you agree to indemnify Klemen Stirn from any
*  liability that might arise from it's use.
*
*  Selling the code for this program, in part or full, without prior
*  written consent is expressly forbidden.
*
*  Obtain permission before redistributing this software over the Internet
*  or in any other medium. In all cases copyright and header must remain
*  intact. This Copyright is in full effect in any country that has
*  International Trade Agreements with the United States of America or
*  with the European Union.
*******************************************************************************/

// SETUP YOUR COUNTER
// Detailed information found in the readme file

// URL of the folder where script is installed. INCLUDE a trailing "/" !!!
$base_url = ''.WEB_URL.'';
// Default image style (font)
$default_style = '57chevy';
// Default counter image extension
$default_ext = 'gif';
// Count UNIQUE visitors ONLY? 1 = YES, 0 = NO
$count_unique = 0;
// Number of hours a visitor is considered as "unique"
$unique_hours = 24;
// Minimum number of digits shown (zero-padding). Set to 0 to disable.
$min_digits =0;

#############################
#     DO NOT EDIT BELOW     #
#############################

/* Turn error notices off */
error_reporting(E_ALL ^ E_NOTICE);
if (!$_GET['pages']){
	$_GET['pages']='index';
}
/* Get page and log file names */
$pages       = input($_GET['pages']) or die('ERROR: Missing page ID');
$logfile    = 'modules/couter/counter.txt';

/* Get style and extension information */
$style      = input($_GET['style']) or $style = $default_style;
$style_dir  = 'modules/couter/styles/' . $style . '/';
$ext        = input($_GET['ext']) or $ext = $default_ext;

/* Does the log exist? */
if (file_exists($logfile)) {

    /* Get current count */
    $count = trim(file_get_contents($logfile)) or $count = 0;

    if ($count_unique==0 || $_COOKIE['gcount_unique']!=$pages) {
        /* Increase the count by 1 */
		$count = $count + 1;
//        $count = $count + 1;
		$pcount = "00000".$count;
		$pcount = substr($pcount, -6);

        $fp = @fopen($logfile,'w+') or die('ERROR: Can\'t write to the log file ('.$logfile.'), please make sure this file exists and is CHMOD to 666 (rw-rw-rw-)!');
        flock($fp, LOCK_EX);
        fputs($fp, $pcount);
        flock($fp, LOCK_UN);
        fclose($fp);

        /* Print the Cookie and P3P compact privacy policy */
        header('P3P: CP="NOI NID"');
        setcookie('gcount_unique', $pages, time()+60*60*$unique_hours);
    }

    /* Is zero-padding enabled? */
    if ($min_digits > 0) {
        $pcount = sprintf('%0'.$min_digits.'s',$pcount);
    }

    /* Print out Javascript code and exit */
    $len = strlen($pcount);


    for ($i=0;$i<$len;$i++) {

 //       echo '<img src="'.$base_url . $style_dir . substr($pcount,$i,1) . '.' . $ext .'" border="0">';
 echo '<img src="'. $style_dir . substr($pcount,$i,1) . '.' . $ext .'" border="0">';
    }
//    exit();

} else {
    die('ERROR: Invalid log file!');
}

/* This functin handles input parameters making sure nothing dangerous is passed in */
function input($in) {
    $out = htmlentities(stripslashes($in));
    $out = str_replace(array('/','\\'), '', $out);
    return $out;
}
?>

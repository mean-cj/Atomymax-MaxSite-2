<?
require_once('getid3/getid3.php');
// getId3 library uses deprecated eregi_* functions 
// which generate errors under PHP 5.3 - so I excluded them
//error_reporting(E_ALL ^ E_DEPRECATED);

// just for debugging/sample
//header('Content-Type: text/plain');

// path to your .flv file
$filename = 'monkan.flv';

$getID3 = new getID3();
$fileInfo = $getID3->analyze($filename);

// echoes something like 127.8743
//print 'Playtime in seconds: ' . $fileInfo['playtime_seconds']; 

//print chr(10);

// echoes something like: 2:07
print 'Playtime in minute:seconds format: ' . $fileInfo['playtime_string'];


?>
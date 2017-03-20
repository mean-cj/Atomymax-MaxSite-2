<?php 
/*
Uploadify v2.1.4
Release Date: November 8, 2010

Copyright (c) 2010 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
require_once("../../../includes/class.resizepic.php");
require_once("../../../includes/config.in.php");
require_once("../../../includes/class.mysql.php");
require_once("../../../includes/array.in.php");
require_once("../../../includes/class.ban.php");
require_once("../../../includes/class.calendar.php");
require_once("../../../includes/function.in.php");
require_once("../../../setconf.php");
require_once("../../../includes/class.resizepic.php");
require_once('getid3/getid3.php');
$db = New DB();
if (ISO=='tis-620'){
$topic=utf8_to_tis620($_POST['topic']);
$detail=utf8_to_tis620($_POST['detail']);
} else {
$topic=$_POST['topic'];
$detail=$_POST['detail'];
}

if(!empty($_POST['id'])){
$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." where id='".$_POST['id']."' ");
$arr['video'] = $db->fetch($res['video']);
} else {
$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." where topic='".$topic."' ");
$arr['video'] = $db->fetch($res['video']);
}
if ($arr['video']['id'] ){

if (!empty($_FILES['Filedata']['tmp_name'])){
	if((strchr($_FILES['Filedata']['name'],".")==".JPG") ||(strchr($_FILES['Filedata']['name'],".")==".jpg") || (strchr($_FILES['Filedata']['name'],".")==".GIF") || (strchr($_FILES['Filedata']['name'],".")==".gift") || (strchr($_FILES['Filedata']['name'],".")==".PNG") || (strchr($_FILES['Filedata']['name'],".")==".png")){
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] .$_REQUEST['folder']. '/';
	$targetFile =  str_replace('//','/',$targetPath) . TIMESTAMP."_".$_FILES['Filedata']['name'];
	
	 $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	 $fileTypes  = str_replace(';','|',$fileTypes);
	 $typesArray = split('\|',$fileTypes);
	 $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	 if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
$size = getimagesize($_FILES['Filedata']['tmp_name']);
$widths = $size[0];
$heights = $size[1];

if ($widths > _IVIDEOT_W || $heights > _IVIDEOT_H) {
if ((strchr($_FILES['Filedata']['name'],".")==".JPG") ||(strchr($_FILES['Filedata']['name'],".")==".jpg")){
				move_uploaded_file($tempFile,$targetFile);
				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _IVIDEOT_W ;
				$height = _IVIDEOT_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size[1]/$height;
					$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized(str_replace('//','/',$targetPath)."thb_".TIMESTAMP."_".$_FILES['Filedata']['name']."", "JPG");
	  	
		$db->update_db(TB_VIDEO,array(
			"category"=>"".$_POST['cat']."",
			"topic"=>"".$topic."",
			"detail"=>"".$detail."",
			"pic"=>"thb_".TIMESTAMP."_".$_FILES['Filedata']['name'].""
		), " id=".$arr['video']['id']."" );
		
		unlink($targetFile);
				} else if ((strchr($_FILES['Filedata']['name'],".")==".GIF") || (strchr($_FILES['Filedata']['name'],".")==".gift")){
				move_uploaded_file($tempFile,$targetFile);
				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _IVIDEOT_W ;
				$height = _IVIDEOT_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size[1]/$height;
					$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized(str_replace('//','/',$targetPath)."thb_".TIMESTAMP."_".$_FILES['Filedata']['name']."", "GIF");
	  	
		$db->update_db(TB_VIDEO,array(
			"category"=>"".$_POST['cat']."",
			"topic"=>"".$topic."",
			"detail"=>"".$detail."",
			"pic"=>"thb_".TIMESTAMP."_".$_FILES['Filedata']['name'].""
		), " id=".$arr['video']['id']."" );
		
		unlink($targetFile);
				} else if ((strchr($_FILES['Filedata']['name'],".")==".PNG") || (strchr($_FILES['Filedata']['name'],".")==".png")){
				move_uploaded_file($tempFile,$targetFile);
				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _IVIDEOT_W ;
				$height = _IVIDEOT_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size[1]/$height;
					$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized(str_replace('//','/',$targetPath)."thb_".TIMESTAMP."_".$_FILES['Filedata']['name']."", "PNG");
	  	
		$db->update_db(TB_VIDEO,array(
			"category"=>"".$_POST['cat']."",
			"topic"=>"".$topic."",
			"detail"=>"".$detail."",
			"pic"=>"thb_".TIMESTAMP."_".$_FILES['Filedata']['name'].""
		), " id=".$arr['video']['id']."" );
		
		unlink($targetFile);
}
} else {
//copy($_FILES['Filedata']['tmp_name'], "video/thumbs/".TIMESTAMP."_".$_FILES['Filedata']['name']."")) 
		move_uploaded_file($tempFile,$targetFile);
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
	  	
		$db->update_db(TB_VIDEO,array(
			"category"=>"".$_POST['cat']."",
			"topic"=>"".$topic."",
			"detail"=>"".$detail."",
			"pic"=>"".TIMESTAMP."_".$_FILES['Filedata']['name'].""
		), " id=".$arr['video']['id']."" );
}
	 }
	} else {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	if((strchr($_FILES['Filedata']['name'],".")==".mpg") ||(strchr($_FILES['Filedata']['name'],".")==".mov") || (strchr($_FILES['Filedata']['name'],".")==".avi") || (strchr($_FILES['Filedata']['name'],".")==".wmv") || (strchr($_FILES['Filedata']['name'],".")==".MP4") || (strchr($_FILES['Filedata']['name'],".")==".flv")){
	$targetPath = $_SERVER['DOCUMENT_ROOT'] .$_REQUEST['folder']. '/';
	$targetFile =  str_replace('//','/',$targetPath) . TIMESTAMP."_".$_FILES['Filedata']['name'];
	
	 $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	 $fileTypes  = str_replace(';','|',$fileTypes);
	 $typesArray = split('\|',$fileTypes);
	 $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	 if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
		move_uploaded_file($tempFile,$targetFile);
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
		$sizes=getfilesize($_FILES['Filedata']['size']);

$getID3 = new getID3();
$fileInfo = $getID3->analyze($targetFile);

	  	
		$db->update_db(TB_VIDEO,array(
			"category"=>"".$_POST['cat']."",
			"topic"=>"".$topic."",
			"detail"=>"".$detail."",
			"video"=>"".TIMESTAMP."_".$_FILES['Filedata']['name']."",
			"size"=>"".$sizes."",
			"times"=>"".$fileInfo['playtime_string'].""
		), " id=".$arr['video']['id']."" );


	 }
	 }
	}
}
//upload new
} else {
	if (!empty($_FILES['Filedata']['tmp_name'])){
	if((strchr($_FILES['Filedata']['name'],".")==".JPG") ||(strchr($_FILES['Filedata']['name'],".")==".jpg") || (strchr($_FILES['Filedata']['name'],".")==".GIF") || (strchr($_FILES['Filedata']['name'],".")==".gift") || (strchr($_FILES['Filedata']['name'],".")==".PNG") || (strchr($_FILES['Filedata']['name'],".")==".png")){

	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] .$_REQUEST['folder']. '/';
	$targetFile =  str_replace('//','/',$targetPath) . TIMESTAMP."_".$_FILES['Filedata']['name'];
	
	 $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	 $fileTypes  = str_replace(';','|',$fileTypes);
	 $typesArray = split('\|',$fileTypes);
	 $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	 if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
$size = getimagesize($_FILES['Filedata']['tmp_name']);
$widths = $size[0];
$heights = $size[1];

if ($widths > _IVIDEOT_W || $heights > _IVIDEOT_H) {
if ((strchr($_FILES['Filedata']['name'],".")==".JPG") ||(strchr($_FILES['Filedata']['name'],".")==".jpg")){
				move_uploaded_file($tempFile,$targetFile);
				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _IVIDEOT_W ;
				$height = _IVIDEOT_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
				$im=$desired_width/$width;
				$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
				$im=$size[1]/$height;
				$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized(str_replace('//','/',$targetPath)."thb_".TIMESTAMP."_".$_FILES['Filedata']['name']."", "JPG");
			  	
		$db->add_db(TB_VIDEO,array(
			"category"=>"".$_POST['cat']."",
			"topic"=>"".$topic."",
			"detail"=>"".$detail."",
			"posted"=>"".$_POST['admin']."",
			"post_date"=>"".TIMESTAMP."",
			"pic"=>"thb_".TIMESTAMP."_".$_FILES['Filedata']['name']."",
			"enable_comment"=>"1",
			"youtube"=>"0"
		));
		
		unlink($targetFile);
				} else if ((strchr($_FILES['Filedata']['name'],".")==".GIF") || (strchr($_FILES['Filedata']['name'],".")==".gift")){
				move_uploaded_file($tempFile,$targetFile);
				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _IVIDEOT_W ;
				$height = _IVIDEOT_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
				$im=$desired_width/$width;
				$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
				$im=$size[1]/$height;
				$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized(str_replace('//','/',$targetPath)."thb_".TIMESTAMP."_".$_FILES['Filedata']['name']."", "GIF");
			  	
		$db->add_db(TB_VIDEO,array(
			"category"=>"".$_POST['cat']."",
			"topic"=>"".$topic."",
			"detail"=>"".$detail."",
			"posted"=>"".$_POST['admin']."",
			"post_date"=>"".TIMESTAMP."",
			"pic"=>"thb_".TIMESTAMP."_".$_FILES['Filedata']['name']."",
			"enable_comment"=>"1",
			"youtube"=>"0"
		));
		
		unlink($targetFile);
				} else if ((strchr($_FILES['Filedata']['name'],".")==".PNG") || (strchr($_FILES['Filedata']['name'],".")==".png")){
				move_uploaded_file($tempFile,$targetFile);
				echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
				$original_image = $targetFile;
				$width = _IVIDEOT_W ;
				$height = _IVIDEOT_H ;
				$desired_width = $size[0] ;
				$desired_height = $size[1] ;
				if ($desired_width > $width ) {
				$im=$desired_width/$width;
				$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
				$im=$size[1]/$height;
				$imwidth=$size[0]/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized(str_replace('//','/',$targetPath)."thb_".TIMESTAMP."_".$_FILES['Filedata']['name']."", "PNG");
			  	
		$db->add_db(TB_VIDEO,array(
			"category"=>"".$_POST['cat']."",
			"topic"=>"".$topic."",
			"detail"=>"".$detail."",
			"posted"=>"".$_POST['admin']."",
			"post_date"=>"".TIMESTAMP."",
			"pic"=>"thb_".TIMESTAMP."_".$_FILES['Filedata']['name']."",
			"enable_comment"=>"1",
			"youtube"=>"0"
		));
		
		unlink($targetFile);
}
} else {
//copy($_FILES['Filedata']['tmp_name'], "video/thumbs/".TIMESTAMP."_".$_FILES['Filedata']['name']."")) 
		move_uploaded_file($tempFile,$targetFile);
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
		  	
			$db->add_db(TB_VIDEO,array(
			"category"=>"".$_POST['cat']."",
			"topic"=>"".$topic."",
			"detail"=>"".$detail."",
			"posted"=>"".$_POST['admin']."",
			"post_date"=>"".TIMESTAMP."",
			"pic"=>"".TIMESTAMP."_".$_FILES['Filedata']['name']."",
			"enable_comment"=>"1",
			"youtube"=>"0"
		));
}
	}
		} else {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	if((strchr($_FILES['Filedata']['name'],".")==".mpg") ||(strchr($_FILES['Filedata']['name'],".")==".mov") || (strchr($_FILES['Filedata']['name'],".")==".avi") || (strchr($_FILES['Filedata']['name'],".")==".wmv") || (strchr($_FILES['Filedata']['name'],".")==".MP4") || (strchr($_FILES['Filedata']['name'],".")==".flv")){
	$targetPath = $_SERVER['DOCUMENT_ROOT'] .$_REQUEST['folder']. '/';
	$targetFile =  str_replace('//','/',$targetPath) . TIMESTAMP."_".$_FILES['Filedata']['name'];
	
	 $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	 $fileTypes  = str_replace(';','|',$fileTypes);
	 $typesArray = split('\|',$fileTypes);
	 $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	 if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
		move_uploaded_file($tempFile,$targetFile);
		echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
$sizes=getfilesize($_FILES['Filedata']['size']);
$getID3 = new getID3();
$fileInfo = $getID3->analyze($targetFile);
	  	
		$db->add_db(TB_VIDEO,array(
			"category"=>"".$_POST['cat']."",
			"topic"=>"".$topic."",
			"detail"=>"".$detail."",
			"posted"=>"".$_POST['admin']."",
			"post_date"=>"".TIMESTAMP."",
			"video"=>"".TIMESTAMP."_".$_FILES['Filedata']['name']."",
			"enable_comment"=>"1",
			"youtube"=>"0",
			"size"=>"".$sizes."",
			"times"=>"".$fileInfo['playtime_string'].""
		));
	 }

}
}
}
}

?>
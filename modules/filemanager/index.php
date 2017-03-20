<?php
CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);
$ver=".024";
?>
	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="810" vAlign=top><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_MENU_MAIN_INDEX;?></A> &nbsp;&nbsp;<BR><BR>
<?
/*
Todo:
BUG: cpmv with no available dirs to cpmv to .. error.
- check setroot -- needs to cover more directories.
- review urlpath, path and abspath.
x Create new file.
- God mode - overrides filters.
- Add Touch feature.
- Add Waste Basket.
- Reload / Refresh button.
x Finish work on CpMv -- check against block lists
*/

/************************************************************************************/
/* Simple Web File Manager                                                          */
/* Allows viewing, editing, renaming and deleting of files within a limited         */
/* directory scope.                                                                 */
/*                                                                                  */
/* This is an alpha copy for development and testing only.                          */
/* Copyright (C) 2003 Lee Herron - All rights reserved.                             */
/* Web Site: http://onedotoh.sourceforge.net                                        */
/*    Email: lee_herron@users.sourceforge.net                                       */
/*                                                                                  */
/* This program is free software; you can redistribute it and/or                    */
/* modify it under the terms of the GNU General Public License                      */
/* as published by the Free Software Foundation; either version 2                   */
/* of the License, or (at your option) any later version.                           */
/*                                                                                  */
/* This program is distributed in the hope that it will be useful,                  */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of                   */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                    */
/* GNU General Public License for more details.                                     */
/*                                                                                  */
/* You should have received a copy of the GNU General Public License                */
/* along with this program; if not, write to the Free Software                      */
/* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.      */
/* License information can also be found at: http://www.gnu.org/copyleft/gpl.html   */
/*                                                                                  */
/* This program is built on the original QTOFileManager.                            */
/* Copyright (C) 2001 Quentin O'Sullivan <quentin@qto.com> All rights reserved.     */
/* Web Site: http://www.qto.com/fm                                                  */
/************************************************************************************/



/***************** USER CONFIGURATIONS **********************************************/
/************************************************************************************/

/*/ set these configuration variables /*/

// change this to the username you would like to use. 
// leave it empty if you dont want to use authentication
$user = "".$_SESSION['admin_user']."";  
$pass = "".$_SESSION['admin_pwd']."";

// currently nonfunctional
$guser = "admin"; // God mode overrides filename filters
$gpass = "atomnet"; 


/****  Limits, Settings and Filters  ****/

// Limit amount of harddrive space and size of file to upload.
$MaxFileSize = "204800"; // max file size in bytes
$HDDSpace = "102400000"; // max total size of all files in directory

// make this = 0 if you dont want to be able to make directories
$MakeDirOn = 1; 

// add any file names to this array which should remain invisible
$HiddenFiles = array("fm_files",".htaccess","fmstyle.css"); 

// make this = 0 if you dont want the to use the edit function at all
$EditOn = 1; 

// add the extensions of file types that you would like to be able to edit
$EditExtensions = array("htm","html","txt","php","css"); 

// Sort default 0 = Filename / 1 = Size / 2 = Last Modified / 3 = File Type
$sortdefault = 2;

// Allow new file creation.
$CreateFileOn = 1;

// add extensions of file types allowed to create.
$NewFileTypes = array("txt","html");

// add extensions of file types you want "turned off"
$ExtensionsOFF = array("php","cgi","php4","php3","pl","js");

// add files that shall not be uploaded, copied over, renamed or deleted. 
$ModifyBlock = array("readme.txt","COPYING",".htaccess","fm.php","fmstyle.css","docs","history.txt");

// add names of directories that DO NOT ALLOW UPLOADS.
$NoUploadDirs = array("docs/");

// add names of directories that DO NOT ALLOW DIRECTORY CREATION.
$NoCreateDirs = array("docs/");

// add characters to strip out of filenames
$snr = array("%","'","+","\\","/","#","..","!",'"',',','?','*','~');

/****  Directory Definitions and Paths  ****/

// Set path and name for MyLink (displayed at top right
// mylink is relative to domain - if /bob is defined, then the link will be 
// http://www.domain.com/bob -- mylinkname is the link display text.

$mylink = "http://sourceforge.net/projects/onedotoh/";
$mylinkname = "OurProject";

// ** Notes: SFM can be configured in one of two ways:
// ** 1. Drop-In: path used is based on script location,
// **    setting for this mode is: defineroot=0
// ** 2. Defined Root: path is defined to a location away
// **    from script location. Setting: defineroot=1
// **    and directory information *MUST* be set.

// Define root path (1=On 0=Off) 
// Off only gives access to the directory you place sfm within.

$defineroot = 1;

/* Define root path required only if defineroot=1 */
// sfm allows for you to limit and/or define the directory that it 
// has access to, that is; it can be placed in a specific directory 
// and give access to that directory alone or you can give it access 
// to directories defined below and it will only have access to those 
// directories.

// if you chose to give access to directories outside of directory
// sfm is in, then define vars below and set DEFINEROOT=0.

// This is rudamentry at best. Add an element to the following for  
// each directory you want to allow file management access.
//
// $dir[?] = path to directory [end with slash /]
// $dirroot[?] = Label for Directory (display only)
// $dirpath[?] = public label for path (display only)
//
// $nav[?] = actual link navigation strings */
// if this is dir[1] then copt=1, etc 
// example: <a href="fm.php?copt=1">Note files</a> | Test files';
//
/* Directory 7: */
//$dir[7]='/html/test/';
//$dirroot[7]='Test';
//$dirpath[7]='/test/';
//$nav[7]='<a href="fm.php?u=$u&copt=7">Note files</a> | Test files';


/* Directory 1: */
$dir[1]='';
$dirroot[1]=''.WEB_PATH.'/modules/filemanager/gallery';
$dirpath[1]=''.WEB_PATH.'/modules/filemanager/gallery/';
$nav[1]='<a href="?name=filemanager&file=index&u=$u&copt=2">Note files</a> | Test files';




/* Directory 2: */
$dir[2]='/var/www/html/notes/yesterdays/';
$dirroot[2]='Notes';
$dirpath[2]='/notes/yesterdays/';
$nav[2]='Note  files | <a href="?name=filemanager&file=index&u=$u&copt=1">Test files</a>';


/************************************************************************************/
/***************** END OF USER CONFIGURATIONS ***************************************/



/** Globals OFF 4.2+ Support - thanks to apz for this patch **/
if (ini_get('register_globals') < 1) {
    $PHP_SELF = $_SERVER['PHP_SELF'];
    if (isset($_REQUEST['u'])) { $u = $_REQUEST['u']; }
    else { $u = ""; }
    if (isset($_REQUEST['login'])) { $login = $_REQUEST['login']; }
    else { $login = ""; }
    if (isset($_REQUEST['password'])) { $password = $_REQUEST['password']; }
    else { $password  = ""; }
    if (isset($_REQUEST['pathext'] )) { $pathext = $_REQUEST['pathext']; }
    else { $pathext = ""; }
    if (isset($_REQUEST['sortKey'] )) { $sortKey = $_REQUEST['sortKey']; }
    else { $sortKey = $sortdefault; }
    if (isset($_REQUEST['copt'])) { $copt = $_REQUEST['copt']; }
    else { $copt = ""; }
    if (isset($_REQUEST['cpmvname'] )) { $cpmvname = $_REQUEST['cpmvname']; }
    else { $cpmvname = ""; }
    if (isset($_REQUEST['action'] )) { $action = $_REQUEST['action']; }
    else { $action = ""; }
    if (isset($_REQUEST['mc2path'] )) { $mc2path = $_REQUEST['mc2path']; }
    else { $mc2path = ""; }
    if (isset($_REQUEST['cmtcpmv'] )) { $cmtcpmv = $_REQUEST['cmtcpmv']; }
    else { $cmtcpmv = ""; }
    if (isset($_REQUEST['cancel'] )) { $cancel = $_REQUEST['cancel']; }
    else { $cancel = ""; }
    if (isset($_REQUEST['rename'] )) { $rename = $_REQUEST['rename']; }
    else { $rename = ""; }
    if (isset($_REQUEST['delete'] )) { $delete = $_REQUEST['delete']; }
    else { $delete = ""; }
    if (isset($_REQUEST['changename'] )) { $changename = $_REQUEST['changename']; }
    else { $changename = ""; }
    if (isset($_REQUEST['targetname'] )) { $targetname = $_REQUEST['targetname']; }
    else { $targetname = ""; }
    if (isset($_REQUEST['oldname'] )) { $oldname = $_REQUEST['oldname']; }
    else { $oldname = ""; }
    if (isset($_REQUEST['upload'] )) { $upload = $_REQUEST['upload']; }
    else { $upload = ""; }
    if (isset($_REQUEST['savenew'] )) { $savenew = $_REQUEST['savenew']; }
    else { $savenew = ""; }
    if (isset($_REQUEST['newfilename'] )) { $newfilename = $_REQUEST['newfilename']; }
    else { $newfilename = ""; }
    if (isset($_REQUEST['newfileext'] )) { $newfileext = $_REQUEST['newfileext']; }
    else { $newfileext = ""; }
}


$ThisFileName = basename(__FILE__); // get the file name
$abspath = str_replace($ThisFileName,"",__FILE__);   // get the directory path

// full path
$path=$abspath;
$urlpath=''.WEB_URL.'/';
// Installed dir only - relative path.
$relpath = dirname($PHP_SELF).'/';

if (preg_match("/\.\./i", $pathext)) {
    $hack="<font color=red><b>HACK ATTEMPT - SysOp Notified</b></font><p>";
    $pathext="";
}
if ($defineroot==1) {
    setroot($vpath);
}
else {
    $copt=1;
    $dir[1]=$path;
    $dirroot[1]='Demo';
    $dirpath[1]=$path;
    $dirpath[1]="/demo/";
    $nav[1]="<a href=\"$PHP_SELF?u=$u&sortKey=$sortKey\">Home</a>";
}

/* Initialized Varibles */
$navbar ="<font face=verdana size=1>$nav[$copt]</font>";
$HDDTotal = dirsize($path);
$HDDTotalABR = setsize($HDDTotal); 
$HDDSpaceABR = setsize($HDDSpace);
$freespaceABR = setsize($HDDSpace - $HDDTotal); // work out how much free space is left
$MaxFileSizeABR = setsize($MaxFileSize);

//$password=md5($_POST['password']);
$u=$_SESSION['admin_user'];
$passoword=$_SESSION['admin_pwd'];
if ($login) {
    if(!($u == $user && $password == $pass)) {
        $msg = "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>The login details were incorrect</font><p>";
		$msg .= "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>$u</font><p>";
				$msg .= "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>$password</font><p>";
        $loginfailed = 1;
    }
}
if ($user == $u) {
    $navbar .= "<font face=verdana size=1> | </font>";
	//    $navbar .= "<font face=verdana size=1> | <a href=\"$PHP_SELF?name=filemanager&file=index\">logout</a></font>";
}
if ($back) {
    $pathext = substr($pathext, 0, -1);
    $slashpos = strrpos($pathext, "/");
    if($slashpos == 0) {
        $pathext = "";  
    }
    else {
        $pathext = substr($pathext, 0, ($slashpos+1));
    }
}
/*  Rename item was select / create form */
if (($user == $u || $user == "") && $rename) {
    $filemanager = renform();
}
/* if an Create new file button was clicked */
elseif (($user == $u || $user == "") && $createfile) {
    $filemanager = newfileedit();
}
/* if an edit link was clicked */
elseif(($user == $u || $user == "") && $edit) {
    $filemanager = ascedit($edit);
}
elseif(($user == $u || $user == "") && $cpmv) {
    $filemanager = cpmvform($cpmv);
}
/* if a TXT file link was clicked */
elseif ($action == 'viewascii') {
    $filemanager = viewascii();
}
/* if an IMAGE file link was clicked */
elseif ($action == 'view') {
    $filemanager = viewimage();
}
elseif (($user == $u || $user == "") && !$loginfailed) {
        
    /* if the save button was pressed on the edit screen */
    if($save) {
        $newcontent = stripslashes($newcontent);
        $fp = @fopen($path.$pathext.$savefile, "w");
        if ($fp) {
            fwrite($fp, $newcontent);
            fclose($fp);
        }
        else {
            $msg = "<font color=red>Write Permissions Not Available</font><p>";
        }
    }
    /* if the save new file button was pressed on the edit screen */
    if ($savenew) {

        if ($newfilename!="") {

            $newfilename = trim($newfilename).trim($newfileext);
            $newfilename = strip_tags($newfilename);
            $newfilename = str_replace($snr,"",$newfilename);

            if (OffFile($newfilename)) { $newfilename = $newfilename.'.off'; }
            if (TargetOK($newfilename)) { $go1=1; }
            if (UpPathOK($pathext)) { $go2=1; }

            if ($go1+$go2==2) {
                if (!file_exists($path.$pathext.$newfilename)) {
                    $msg = "new file created named: $newfilename<hr>";
                    $nfh = fopen ($path.$pathext.$newfilename, "w");
                    fwrite($nfh,$newcontent);
                    fclose($nfh);
                }
            }
            else {
                if ($go1==0) { $msg = "Filename: $newfilename is blocked from use.<hr>"; }
                if ($go2==0) { $msg = "This directory does not allow new file creation.<hr>"; }
            }

            $go1="";$go2="";
        }
        else { $msg = "No new filename entered<hr>"; }
    }
    /* If the rename link was clicked */
    if ($changename) {

        $targetname = strip_tags ( $targetname);
        $targetname = str_replace($snr,"",$targetname);
        $nname = trim($targetname);

        // Change name of existing file Okay?

        // Modify this file okay?
        if (TargetOK($oldname)) { $go1=1; }

        // Is New name Okay?
        if (TargetOK($nname)) { $go2=1; }

        // Is it okay to rename this Extension?
        if (OffFile($oldname)) { $go2="0"; }
        if (OffFile($nname)) { $go2="0"; }

        if ($go1+$go2==2) {
            $renamed = @rename ($path.$pathext."$oldname", $path.$pathext."$nname");
            if($renamed<1) { $msg="<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>Rename process FAILED!</font><p>"; }
        }
        else {
            if ($go1==0) { $whichname="Existing file"; $effectedname=$oldname; }
            if ($go2==0) { $whichname="Target filenme"; $effectedname=$nname; }
            $msg = "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>The $whichname: $effectedname has been BLOCKED from this action.</font><p>";
        }
    }

    /* If CpMv Form was submitted */
    if($cmtcpmv) {
        if ($mc2path=="/") { $mc2path=""; }
        if ($action=='copy') {
            $cm_result = copy($path.$pathext.$cpmvname, $path.$mc2path.$cpmvname);
            $cpmvaction="Copied";
        }
        else {
            $cm_result = copy($path.$pathext.$cpmvname, $path.$mc2path.$cpmvname);
            unlink($path.$pathext.$cpmvname);
            $cpmvaction="Moved";
        }

        if ($cm_result==1) {
            $msg="<table>
            <tr><td align=right>$cpmvaction:</td><td>$relpath$pathext$cpmvname</td></tr>
            <tr><td align=right>to:</td><td>$relpath$mc2path</td></tr></table><br>";
        }
        else {$msg="error in copy/move";}
    }


    $HDDTotal = dirsize($path); // get the total size of all files in the directory including any sub directorys
    /* if the upload button was pressed */
    if ($upload) {

        /* if a file was actually uploaded */
        if($_FILES['uploadedfile']['name']) {
            $_FILES['uploadedfile']['name'] = strip_tags ($_FILES['uploadedfile']['name']);
            $_FILES['uploadedfile']['name'] = str_replace($snr,"",$_FILES['uploadedfile']['name']);  // remove any % signs from the file name
            $_FILES['uploadedfile']['name'] = trim($_FILES['uploadedfile']['name']);

            /* if the file size is within allowed limits */
 //           if($_FILES['uploadedfile']['size'] > 0 && $_FILES['uploadedfile']['size'] < $MaxFileSize) {
            if($_FILES['uploadedfile']['size'] > 0  ) {
				/* if adding the file will not exceed the maximum allowed total */
                if(($HDDTotal + $_FILES['uploadedfile']['size']) < $HDDSpace) {
                    if (TargetOK($_FILES['uploadedfile']['name'])==1) {
                        if (OffFile($_FILES['uploadedfile']['name'])) {
                            $OffExt=".off";
                        }

$size = getimagesize($_FILES['uploadedfile']['tmp_name']);
$size[0]."*".$size[1];
//$width = $size[0];
//$height = $size[1];
if ($size[0]."*".$size[1] > '500*600' ) {
		$msg = "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>"._FILEMANAGER_MOD_IMG_LIMIT." <br> "._FILEMANAGER_MOD_IMG_WIDTH." $size[0] px "._FILEMANAGER_MOD_IMG_HIEGHT." $size[1] px </font><p>";
}  else {
			require("includes/class.resizepic.php");
			if (($_FILES['uploadedfile']['type']=='image/jpg') || ($_FILES['uploadedfile']['type']=='image/jpeg') || ($_FILES['uploadedfile']['type']=='image/pjpeg')){
                move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $path.$pathext.$_FILES['uploadedfile']['name'].$OffExt); 
				$original_image = "modules/filemanager/".$pathext.$_FILES['uploadedfile']['name'];
				$width = _IGALLERY_W ;
				$height = _IGALLERY_H ;
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
				$image->output_resized("modules/filemanager/".$pathext."thb_".$_FILES['uploadedfile']['name']."", "JPG");
			//	$msg = "$im $desired_width  $imheight $desired_height";
				} else if (($_FILES['uploadedfile']['type']=='image/gif')){
                move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $path.$pathext.$_FILES['uploadedfile']['name'].$OffExt); 
				$original_image = "modules/filemanager/".$pathext.$_FILES['uploadedfile']['name'];
				$width = _IGALLERY_W ;
				$height = _IGALLERY_H ;
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
				$image->output_resized("modules/filemanager/".$pathext."thb_".$_FILES['uploadedfile']['name']."", "GIF");
				} else if (($_FILES['uploadedfile']['type']=='image/x-png')){
                move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $path.$pathext.$_FILES['uploadedfile']['name'].$OffExt); 
				$original_image = "modules/filemanager/".$pathext.$_FILES['uploadedfile']['name'];
				$width = _IGALLERY_W ;
				$height = _IGALLERY_H ;
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
				$image->output_resized("modules/filemanager/".$pathext."thb_".$_FILES['uploadedfile']['name']."", "PNG");
				} else {
                        /* put the file in the directory */
                        move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $path.$pathext.$_FILES['uploadedfile']['name'].$OffExt); 
				}

}
                    } else {
                        $msg = "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>The Filename: ".$_FILES['uploadedfile']['name']." is BLOCKED from being uploaded here.</font><p>";
                    }
                }  else {
//                    $msg = "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>พื้นที่ในการเก็บข้อมูลไม่เพียงพอ<br>ไม่สามารถอัพโลหดได้.</font><p>";
                    $msg = "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>"._FILEMANAGER_MOD_IMG_NOUP."</font><p>";
                }
            }
            else {
                $MaxKB = setsize($MaxFileSize); // show the max file size in Kb
                $msg =  "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>"._FILEMANAGER_MOD_IMG_MAX." $MaxKB "._FILEMANAGER_MOD_IMG_MAX1."</font><p>";
            }
        }
        else {
            $msg =  "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>"._FILEMANAGER_MOD_SELECT_FILE."</font><p>";
        }

   }
    /* if the delete button was pressed */
    elseif($delete) {
        // Ok2Edit
        if (TargetOK($delete)) {
            /* delete the file or directory */
            if(is_dir($path.$pathext.$delete)) {
                $result = @rmdir($path.$pathext.$delete);
                if($result == 0) {
                    $msg = "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>"._FILEMANAGER_MOD_NODEL_FOLDER."</font><p>";
                }
            }
            else {
                unlink($path.$pathext.$delete);
            }
        }
        else {
            $msg = "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>Deleting file: $delete is a BLOCKED action.</font><p>";
        }
    }
    elseif($mkdir && $MakeDirOn) {
        $dirname = strip_tags ( $dirname);
        $dirname = str_replace($snr,"",$dirname);
        $dirname = trim($dirname);
        if (TargetOK($dirname)) {
            $result = mkdir($path.$pathext.$dirname, 0777);
            if(!$result) {
                $msg = "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>The folder could not be created. Make sure the name you<br>entered is a valid folder name.</font><p>";
            }
        }
        else {
            $msg = "<font face='Verdana, Arial, Hevetica' size='2' color='#ff0000'>Creating Directory: $dirname is a BLOCKED action.</font><p>";
        }
    }

    // If download initiate then progress to directory list.
    if ($action == 'download') {
        $filedata = stat($path.$pathext.$filename); // get some info about the file
        $filesize = $filedata[7]; // size in bytes
        $ft = getfiletype("$filename");
        header("Content-Type: $ft[1]");
        header("Content-Length: $filesize");
        header("Content-Disposition: attachment; filename=$filename");
        readfile($path.$pathext.$filename);
        exit;
    }

    $freespace = ($HDDSpace - $HDDTotal); // work out how much free space is left
    $freespace = setsize($freespace); // convert to size abbreviation.
    $HDDSpace = setsize($HDDSpace); // convert to size abbreviation.

    /* if $MakeDirOn has been set to on show some html for making directories */
    if($MakeDirOn) {
        if (CreateDirOK($pathext)) {
            $mkdirhtml = "<input class=altButton type=\"text\" name=\"dirname\" size=\"15\"> <input class=altButton type=\"submit\" name=\"mkdir\" value=\"Make Folder\">";
        }
        else {
            $mkdirhtml = '<span class=smallblack>[ Direction Creation not permitted here ]</span>';
        }
    }
    if ($CreateFileOn) {
        if (UpPathOK($pathext)) {
            $createfilehtml = "<input class=altButton type=\"submit\" name=\"createfile\" size=\"15\" value=\" * \">";
        }
        else {
            $createfilehtml = "--";
        }
    }

    if (UpPathOK($pathext)) {
        $uploadfield =<<<endupform
            <input type="hidden" name="MAX_FILE_SIZE" value="$MaxFileSize">
         <input type="hidden" name="copt" value="$copt">
         <input class=altButton type="file" name="uploadedfile"><input class=altButton type="submit" name="upload" value="Upload">
         <input type="hidden" name="u" value="$u">
         <input type="hidden" name="pathext" value="$pathext">
         <input type="hidden" name=sortKey value="$sortKey">
endupform;
    }
    else {
        $uploadfield = '<span class=smallblack>[ Uploads not permitted here ]</span>';
    }

    /*
    Build the html that makes up the file manager. The
    $filemanager variable holds the first part of the
    html including the form tags and the top 2 heading
    rows of the table which dont display files.
    */
    
    $filemanager=makheader();


    /*  if the current directory is a sub directory 
        show a back link to get back to the previous directory */

    if($pathext) {
        $filemanager  .= <<<content
        <tr>
            <td bgcolor="#ffffff" align=center><img src="modules/filemanager/fm_files/parent.gif" width="20" height="20" border=0></td><td>&nbsp;<a href="$PHP_SELF?name=filemanager&file=index&u=$u&back=1&sortKey=$sortKey&pathext=$pathext&copt=$copt"><font face="Verdana, Arial, Helvetica" size="2" color="#666666">&laquo;BACK</font></a>&nbsp;</td>
            <td bgcolor="#ffffff"></td><td></td><td bgcolor="#ffffff"></td><td></td><td bgcolor="#ffffff"></td><td></td>
        </tr>
        <tr> 
            <td height="1" bgcolor="#000000" colspan=8></td>
        </tr>   
content;
    }

    /* Build the table rows which contain the file information */
    $newpath = substr($path.$pathext, 0, -1);   // remove the forward or backwards slash from the path
    if ($dir = @opendir($newpath)) {
        /* loop once for each name in the directory */
        $fc=0;
        while($file = readdir($dir)) {
            $match="1";
            // if the name is not a directory and the name is not the name of this program file
            if($file != "." && $file != ".." && $file != "$ThisFileName") {
                $match = 0;
            }
            if (!hidecheck($file)) { $match=1; }        
            // if there were no matches the file should not be hidden
            if(!$match) {
                $filedata = stat($newpath.'/'.$file); // get some info about the file
                $fileattrib[$fc][0] = $file;
                $fileattrib[$fc][1] = $filedata[7]; // size in bytes
                $fileattrib[$fc][2] = $filedata[9]; // time of last modification
                $fileattrib[$fc][5] = date("m/d/Y h:i:sA",$filedata[9]);
                if (is_dir($newpath.'/'.$file)) { $fileattrib[$fc][3]="Folder"; }
                else { 
                    $ft=getfiletype($file);
                    $fileattrib[$fc][3]=$ft[0]; // TYPE
                    $fileattrib[$fc][4]=$ft[1]; // Download or Browse 
                    //$fileattrib[$fc][3]=getfiletype($file); 
                } 
                $fc++;
            }
        }
    }
    else {
  
        $patherror="<p><center><font face=\"Verdana, Arial, Hevetica\" size=\"3\" color=red><b>directory incorrectly defined</b></font></center></p>";
    }

    /* Sort Keys *//*
    0 = Filename
    1 = Size
    2 = Last Modified
    3 = File Type
    */

    if ($sortKey=="") { $sortKey="$sortdefault"; }
    if (count($fileattrib)>1) { usort( $fileattrib, "myCompare" ); }

    /*/ Build Table Data List /*/
    for($i = 0; $i < (count($fileattrib)); $i++) {

        $file=$fileattrib[$i][0];
        $filetype=$fileattrib[$i][3];

        // create some html for a link to delete, rename and edit files 
        if (TargetOK($file)) {
            $deletelink = "<a href=\"$PHP_SELF?name=filemanager&file=index&delete=$file&copt=$copt&sortKey=$sortKey&u=$u&pathext=$pathext\" title=\"DELETE $file\"><font face=\"Verdana, Arial, Helvetica\" size=\"1\" color=\"#FF0033\"><b>DEL</b></font></a>";
            if ($filetype=="OFF") { 
                $renamelink="---";
            }
            else {
                    $renamelink = "<a href=\"$PHP_SELFname=filemanager&file=fm&rename=$file&copt=$copt&sortKey=$sortKey&u=$u&pathext=$pathext\" title=\"Rename $file\"><font face=\"Verdana, Arial, Helvetica\" size=\"1\" color=\"#666666\">REN</font></a>";
            }
        }
        else {
            $deletelink = "---";
            $renamelink = "---";
        }

        // find out if the file is one that can be edited
        $editlink = "---";

        // if the edit function is turned on and the file is not a directory
        if($EditOn && $filetype != "Folder")  {
            if (Ok2Edit($fileattrib[$i][3])) {
                if (TargetOK($file)) {
                    $editlink =     "<a href=\"$PHP_SELF?name=filemanager&file=index&edit=$file&u=$u&copt=$copt&pathext=$pathext\"><font face='Verdana, Arial, Helvetica' size='1' color='#666666' title=\"Edit $file\"><b>EDIT</b></font></a>";
                }
                else {
                    $editlink = "---";
                }
            }
        }

        // copy/move link creation
        $cpmv="---";
        if ($filetype != "Folder" && TargetOK($file)) {
            $cpmv =     "<a class=5c title=\"Copy or Move $file\" href=\"$PHP_SELF?name=filemanager&file=index&cpmv=$file&u=$u&copt=$copt&pathext=$pathext\"><font face='Verdana, Arial, Helvetica' size='1' color='#666666'><b>CpMv</b></font></a>";
        }


        $iconlinks = geticon($fileattrib[$i][3],$fileattrib[$i][5]);

        $fileicon=$iconlinks[0];
        $filename=$iconlinks[1];

        $nsize=setsize($fileattrib[$i][1]);
        $content .= <<<content
            <tr>
                <td bgcolor="#ffffff" width=26 align=center>$fileicon</td>
                <td width=55%>&nbsp;<font face="Verdana, Arial, Helvetica" size="2">$filename</font>&nbsp;</td>
                <td bgcolor="#ffffff" class=smallblack align=right><nobr>&nbsp;$nsize&nbsp;</nobr></td>
                <td align=center><font face="Verdana, Arial, Helvetica" size="1">$filetype</font></td>
                <td bgcolor="#ffffff" align=center>&nbsp;$editlink&nbsp;</td>
                <td align=center>&nbsp;$cpmv&nbsp;</td>
                <td bgcolor="#ffffff" align=center>&nbsp;$renamelink&nbsp;</td>
                <td align=center>&nbsp;$deletelink&nbsp;</td>
            </tr>
            <tr> 
                <td height="1" colspan=8 bgcolor="#808080"><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="1" border=0 alt=""></td>
            </tr>   
content;

    }

    if ($nofiles==1) { $nf="<font face=\"Verdana, Arial, Helvetica\" size=2>Folder is Empty</font>"; }
    $content .= "</table>"; // add some closing tags to the $content variable
    $filemanager  .= $content; // append the html to the $filemanager variable
}
else {
    $filemanager = <<<content
    <center><br>

    <table cellspacing=0 cellpadding=1 border=0><tr><td bgcolor=black>
    <table bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="4" width=353 background="fm_files/bg_lock.jpg">
    <tr>
    <td colspan=2 align=center>
    <font face="Verdana, Arial, Hevetica" size="4" color="#333333"><b>Simple File Manager - Login</b></font><br>
    <form name="form1" method="post" action="$PHP_SELF?name=filemanager&file=index" id="form1">$msg
        </td>
    </tr>
    <tr>
        <td align=right><font face="Verdana, Arial, Hevetica" size="2"><b>User Name:</b></font></td>
        <td align=left><input class=altButton type="text" name="u" value="$user"></td>
    </tr>
    <tr>
        <td align=right><font face="Verdana, Arial, Hevetica" size="2"><b>Password:</b></font></td>
        <td align=left><input class=altButton type="password" name="password"></td>
    </tr>
    <tr><td colspan=2 align=center><input class=altButton type="submit" name="login" value="Login"></td></tr>
    </form>
    </table></td></tr></table><br>
    </center>
content;
}


/* Check if Dir has MakDir permissions */
function CreateDirOK($chkpath) {
    global $NoCreateDirs;
    $okay=1;
    foreach($NoCreateDirs as $name) {
        // check the name against no create dir list
        if($chkpath == $name) {  
            $okay = "";  // unset if not okay
        }
    }   
    return $okay;
}


/* Check if Dir has Upload permissions */
function UpPathOK($chkpath) {
    // checks with no trailing slash
    global $NoUploadDirs;
    $okay=1;
    foreach($NoUploadDirs as $name) {
        // check the name against no upload dir list
        if($chkpath == $name) {  
            $okay = "";  // unset if not okay
        }
    }   
    return $okay;

}


/* Sort Routine */
function myCompare( $arrayA, $arrayB ){
    global $sortKey;
    if( $arrayA[$sortKey] == $arrayB[$sortKey] )
        return 0;
    return( $arrayA[$sortKey] < $arrayB[$sortKey] ? -1 : 1 );
}


/* calculate the size of files in $dir */
function dirssize($dir) {
    $size = -1;
    if ($dh = @opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." and $file != "..") {
                $path = $dir."/".$file;
                if (is_dir($path)) {
                    $size += dirssize("$path/");
                }
                elseif (is_file($path)) {
                    $size += filesize($path);
                }
            }
        }
        closedir($dh);
    }
    return $size;
}

function setsize ($size) {

    // Setup some common file size measurements.
    $kb = 1024;         // Kilobyte
    $mb = 1024 * $kb;   // Megabyte
    $gb = 1024 * $mb;   // Gigabyte
    $tb = 1024 * $gb;   // Terabyte
    
    /* If it's less than a kb we just return the size, otherwise we keep going until
    the size is in the appropriate measurement range. */
    if($size < $kb) {
        return $size." B";
    }
    else if($size < $mb) {
        return round($size/$kb,2)." KB";
    }
    else if($size < $gb) {
        return round($size/$mb,2)." MB";
    }
    else if($size < $tb) {
        return round($size/$gb,2)." GB";
    }
    else {
        return round($size/$tb,2)." TB";
    }
}

function renform() {
    global $rnaction,$oldname,$rename,$u,$sortKey,$pathext,$PHP_SELF;
    $filemanager = makbar();
    $filemanager .= <<<content
    <tr><td align=center colspan=3>
    <form name="form1" method="post" action="$PHP_SELF?name=filemanager&file=index">
    <input type="hidden" name=rnaction value=1>
    <input type="hidden" name=oldname value="$rename">
    <input type="hidden" name=u value="$u">
    <input type="hidden" name=sortKey value="$sortKey">
    <input type="hidden" name=pathext value="$pathext">    
    <center>
    <table border=0 width=100>
        <tr><td class=normalred>Rename: </td><td class=normalblack>$rename</td></tr>
        <tr><td align=right class=normalred>to: </td><td><input class=altButton type="text" name="targetname"></td></tr>
        <tr><td align=right></td><td><input class=altButton type="submit" name="changename" value="Rename"><input class=altButton type="submit" name="cancel" value="Cancel"></td></tr>
    </table>
    </form>
    </td>
    </tr>
    </table>
    </center>
content;
    return $filemanager;
}

function cpmvform($t) {
    global $rootdir,$PHP_SELF,$pathext,$path,$relpath,$u;
    $options = makdiroptions(listdir($path,0));
    $filemanager .= makbar();
    $filemanager .= <<<content
    <tr><td colspan=3><hr></td></tr>
    <tr><td colspan=3 align=center>

        <table cellpadding=0 cellspacing=3 border=0><tr><form method=post action="$PHP_SELF?name=filemanager&file=index">
            <input type="hidden" name="cpmvname" value="$t"><input type="hidden" name="pathext" value="$pathext">
            <td class=normalblack align=right>Action: </td><td>&nbsp;</td><td class=normalblack><input type="radio" name="action" checked value="copy"> <b>copy</b> <input type="radio" name="action" value="move"> <b>move</b></td></tr>
            <tr><td class=normalblack align=right>Filename:</td><td>&nbsp;</td><td class=normalblack>&nbsp;<b>$t</b></td></tr>
            <tr><td class=normalblack align=right>from:</td><td>&nbsp;</td><td class=normalblack>&nbsp;$relpath$pathext</td></tr>
            <tr><td class=normalblack align=right>to:</td><td>&nbsp;</td><td class=normalblack>&nbsp;<select class=altButton name="mc2path">$options</select></td></tr>
            <tr><td colspan=3 align=center><input class=altButton type="submit" name="cmtcpmv" value="Commit"><input class=altButton type="submit" name="cancel" value="Cancel"></td></tr>
            <input type="hidden" name=u value=$u>
            </form>
        </table>

    </td></tr>
    <tr><td colspan=3><hr></td></tr>
content;
    return $filemanager;
}
function listdir($wdir) {
    global $d, $nd,$pathext;
    $hndl=opendir($wdir);
    while($file=readdir($hndl)) {
        if ($file=='.' || $file=='..') { continue; }
        if (is_link($wdir.$file)) { continue; }

        if (!hidecheck($file)) { continue; }
        if (!UpPathOK($file.'/')) { continue; }
        if (is_dir($wdir.$file)) {
            if ($pathext != $file.'/' ) { 
                $nd++;
                $d[$nd]=$wdir.$file;
            }
            listdir($wdir.$file."/");
        }
    }
    closedir($hndl); 
    return $d;
}
function makdiroptions($dop) {
    global $rd_len,$pathext,$path;
    $rd_len=strlen($path);
    foreach ($dop as $tmp) {
        $z=substr($tmp, $rd_len,(strlen($tmp)-($rd_len)));
        $options .= "<option>$z/</option>";
    }
    if (!$pathext=="") {$rt="<option>/</option>"; }
    return $rt.$options;
}

function makfiletypelist() {
    global $NewFileTypes;
    foreach ($NewFileTypes as $tmp) {
        $options .= "<option>.$tmp</option>";
    }
    return $options;
}

function ascedit ($edit) {    
    global $path,$pathext,$dirroot,$PHP_SELF,$copt,$u,$sortKey,$msg;
    
    $filemanager = makbar();
    
    $fp = @fopen($path.$pathext.$edit, "r");
    if ($fp) {
        $oldcontent = fread($fp, filesize($path.$pathext.$edit));
        $oldcontent = htmlspecialchars($oldcontent);
        fclose($fp);

    $filemanager .= <<<content
    <center>
    <table border="0" cellspacing="0" cellpadding="0">
    <tr>
    <td class=normalblack>
    <form name="form1" method="post" action="$PHP_SELF?name=filemanager&file=index">
          <center>
          Current Directory: /$dirroot[$copt]/$pathext<br>File Editing: <b>$edit</b><p>
            <textarea name="newcontent" cols="60" rows="15">$oldcontent</textarea>
            <br>
            <br>
            <input type="hidden" name="copt" value="$copt">
            <input class=altButton type="submit" name="save" value="Save">
            <input class=altButton type="submit" name="cancel" value="Cancel">
            <input type="hidden" name="u" value="$u">
            <input type="hidden" name="savefile" value="$edit">
            <input type="hidden" name="pathext" value="$pathext">
            <input type="hidden" name=sortKey value="$sortKey">
          </center>
    </form>
    </td>
    </tr>
    </table>
    </center>
content;
    }
    else {
        $filemanager .= "<tr><td colspan=3 class=normalred align=center>Failed to open $edit</td></tr>";
    }
    return $filemanager;
}




function newfileedit() {    
    global $path,$pathext,$dirroot,$PHP_SELF,$copt,$u,$sortKey,$msg;

    $options=makfiletypelist();
    $filemanager = makbar();
    
    $filemanager .= <<<content
    <tr><td colspan=3 align=center>
    <table border="0" cellspacing="0" cellpadding="0" width=100%>
    <tr>
    <td class=normalblack>
    <form name="form1" method="post" action="$PHP_SELF?name=filemanager&file=index">
          <center>
          Current Directory: /$dirroot[$copt]/$pathext<hr>New Filename: <input class=altButton type="text" name="newfilename">
    <select class=altButton name="newfileext">
        $options
    </select>    
    <hr><p>
            <textarea name="newcontent" cols="60" rows="15"></textarea>
            <br>
            <br>
            <input type="hidden" name="copt" value="$copt">
            <input class=altButton type="submit" name="savenew" value="Save">
            <input class=altButton type="submit" name="cancel" value="Cancel">
            <input type="hidden" name="u" value="$u">
            <input type="hidden" name="pathext" value="$pathext">
            <input type="hidden" name=sortKey value="$sortKey">
          </center>
    </form>
    </td>
    </tr>
    </table>
    </td></tr>
content;

    return $filemanager;
}


function makheader() {
    global $copt,$hack,$MaxFileSize,$mkdirhtml,$navbar,$dirroot,$dirpath,$uploadfield;
    global $msg,$mylink,$mylinkname,$pathext,$pathext,$PHP_SELF,$u,$sortKey,$createfilehtml;

    $Type="Type";
    $Size="Size";

    switch ($sortKey) {
        case "0":
            $fnl="[";
            $fnr="]";
            break;
        case 1:
            $Size="[Size]";
            break;
        case 2:
            $lml="[";
            $lmr="]";
            break;
        case 3:
            $Type="[Type]";

            break;
    }


    $filemanager = <<<content

        <table width=100% cellpadding=0 cellspacing=0 border=0>


            <tr><td colspan=3 bgcolor="#ffffff"><font face=verdana size=2><b>&nbsp;Area:</b> $dirroot[$copt]</font></td></tr>
            <tr><td colspan=3 bgcolor="#ffffff"><font face=verdana size=2><b>&nbsp;Path:</b> $dirpath[$copt]$pathext</font></td></tr>
            <tr><td colspan=3 height=3 bgcolor="#ffffff"><img src="modules/filemanager/fm_files/spacer.gif" width="3" height="1" border=0 alt=""></td></tr>
            
            <tr><td bgcolor="#ffffff" colspan=3 height=1><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="1" border=0 alt=""></td></tr>
            <tr><td bgcolor="#ffffff" colspan=3 height=1><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="1" border=0 alt=""></td></tr>

            <tr><td colspan=3 height=6><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="1" border=0 alt=""></td></tr>
            <tr><td colspan=3 align=center><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="1" border=0 alt=""></td></tr>

            <tr><td colspan=3 align=center>
                <font face="Verdana, Arial, Hevetica" size="2"><b>$hack$msg</b></font>
    
                <table cellpadding=0 cellspacing=0 border=0 width=100%>
                    <form name="form1" method="post" action="$PHP_SELF?name=filemanager&file=index" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="$MaxFileSize">
                    <input type="hidden" name="copt" value="$copt">
                    <tr>
                        <td align=center width=10%>$createfilehtml</td>
                        <td width=1 bgcolor="#ffffff"><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="1" border=0></td>        
                        <td align=center width=40%>
                            $mkdirhtml 
                        </td>
                        <td width=1 bgcolor=black><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="1" border=0></td>
                        <td align=center width=50%>$uploadfield</td>
                            </form>
                    </tr>
                </table>
            
            </td></tr>

            <tr><td colspan=3 height=6><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="1" border=0 alt=""></td></tr>
            <tr><td colspan=3 align=center><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="1" border=0 alt=""></td></tr>

            <tr><td bgcolor="#ffffff" colspan=3 height=1><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="1" border=0 alt=""></td></tr>
            <tr><td bgcolor="#ffffff" colspan=3 height=1><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="1" border=0 alt=""></td></tr>

            <tr><td colspan=3 height=6><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="6" border=0 alt=""></td></tr>

        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#eeeeee">
            <tr> 
                <td height="20" width=22 bgcolor="#0066FF"></td>
                <td bgcolor="#0066FF" height="20" align=center>&nbsp;<a href="$PHP_SELF?name=filemanager&file=index&copt=$copt&u=$u&pathext=$pathext&sortKey=0"><font face="Verdana, Arial, Helvetica" size="2" color="#FFFFFF"><b>$fnl FILENAME $fnr</b></font></a>&nbsp;</td>
                <td height="20" bgcolor="#0066FF" align=center><a href="$PHP_SELF?name=filemanager&file=index&copt=$copt&u=$u&pathext=$pathext&sortKey=1"><font face="Verdana, Arial, Helvetica" size="2" color="#FFFFFF"><b>$Size</b></font></a></td>
                <td height="20" bgcolor="#0066FF" align=center><a href="$PHP_SELF?name=filemanager&file=index&copt=$copt&u=$u&pathext=$pathext&sortKey=3"><font face="Verdana, Arial, Helvetica" size="2" color="#FFFFFF"><b>$Type</b></font></a></td>
                <td height="20" bgcolor="#0066FF" colspan=4 align=center><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica"><b>Action</b></font></td>
            </tr>
            <tr> 
                <td height="2" bgcolor="#999999" colspan=8></td>
            </tr>
content;
    return $filemanager;
}


function makbar() {
    global $copt,$hack,$MaxFileSize,$mkdirhtml,$navbar,$dirroot,$dirpath;
    global $msg,$mylink,$mylinkname,$pathext,$PHP_SELF,$u;

    $filemanager = <<<content

        <table width=100% cellpadding=0 cellspacing=0 border=0>
            <tr><td bgcolor='#333399' colspan=3 valign=middle>&nbsp;&nbsp;<img src="modules/filemanager/fm_files/explorer.gif" width="20" height="20" border=0 align=middle><font face="Verdana, Arial, Hevetica" size="2" color="#ffffff"><b>File Manager</b></font></td></tr>

        <tr><td bgcolor="#000000" colspan=3 height=2><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="2" border=0 alt=""></td></tr>
            <tr><td bgcolor="#eeeeee" colspan=2 width=30%>&nbsp;&nbsp;$navbar</td><td bgcolor="#eeeeee" align=right><a href="$mylink">$mylinkname</a>&nbsp;&nbsp;</td></tr>

            <tr><td bgcolor="#000000" colspan=3 height=2><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="2" border=0 alt=""></td></tr>
            <tr><td colspan=3 height=3><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="3" border=0 alt=""></td></tr>
content;
    return $filemanager;
}

function setroot($vpath) {
    global $dir, $dirroot, $dirpath, $nav, $path,$copt, $sharedhost;
    /* If adding more than two directores, add an elseif for each. */
    if ($copt==1) {
       $path = $path.$dir[1];
    }
    elseif ($copt==2) {
        $path = $path.$dir[2];
    }
    else {
        $path = $path.$dir[1];
        $copt=1;
    }
}

function hidecheck ($ckfilename) {
    global $HiddenFiles;
    $okay=1;
    foreach($HiddenFiles as $name) {
        // check the name is not the same as the hidden file name
        if($ckfilename == $name) {  
            $okay = "";  // unset if not okay
        }
    }   
    return $okay;
}
function Ok2Edit ($ckfileext) {
    //$hide= hidecheck ($tmp);
    global $EditExtensions;
    foreach($EditExtensions as $name) {
        // check the name is not the same as the hidden file name
        if($ckfileext == strtoupper($name)) {   
            $okay = "1";     
        }
    }   
    return $okay;

}
function TargetOK ($chck) {
    global $ModifyBlock;
    $okay=1;
    if (isset($ModifyBlock)) {
        foreach($ModifyBlock as $name) {
            // check the name is not Blocked.
            if($chck == $name) {   
                $okay = "0";
            }
        }
    }
    return $okay;
}


function getfiletype ($file) {
    $file=strtolower($file);
    $dotpos = strrpos($file, ".");
    if ($dotpos < 1) {
        $ft[0]="UnK";
        $ft[1]="application/octet-stream";
        return $ft;
    }
    else {
        $filetype = substr($file,$dotpos+1);
    }
    if ($filetype=="html") {
        $ft[0]="HTML";
        $ft[1]="";
        return $ft;
    }
    elseif ($filetype=="htm") {
        $ft[0]="HTML";
        $ft[1]="";
        return $ft;
    }
    elseif ($filetype=="jpg") {
        $ft[0]="JPG";
        $ft[1]="";
        return $ft;
    }
    elseif ($filetype=="bak") {
        $ft[0]="BAK";
        $ft[1]="application/octet-stream";
        return $ft;
    }
    elseif ($filetype=="db") {
        $ft[0]="DB";
        $ft[1]="application/octet-stream";
        return $ft;
    }
    elseif ($filetype=="bmp") {
        $ft[0]="BMP";
        $ft[1]="";
        return $ft;
    }
    elseif ($filetype=="txt") {
        $ft[0]="TXT";
        $ft[1]="text/plain";
        return $ft;
    }
    elseif ($filetype=="log") {
        $ft[0]="LOG";
        $ft[1]="text/plain";
        return $ft;
    }
    elseif ($filetype=="pdf") {
        $ft[0]="PDF";
        $ft[1]="application/pdf";
        return $ft;
    }
    elseif ($filetype=="rtf") {
        $ft[0]="RTF";
        $ft[1]="application/rtf";
        return $ft;
    }
    elseif ($filetype=="css") {
        $ft[0]="CSS";
        $ft[1]="text/css";
        return $ft;
    }
    elseif ($filetype=="doc") {
        $ft[0]="DOC";
        $ft[1]="application/msword";
        return $ft;
    }
    elseif ($filetype=="gif") {
        $ft[0]="GIF";
        $ft[1]="";
        return $ft;
    }
    elseif ($filetype=="png") {
        $ft[0]="PNG";
        $ft[1]="";
        return $ft;
    }
    elseif ($filetype=="zip") {
        $ft[0]="ZIP";
        $ft[1]="application/zip";
        return $ft;
    }
    elseif ($filetype=="php") {
        $ft[0]="PHP";
        $ft[1]="application/octet-stream";
        return $ft;
    }
    elseif ($filetype=="off") {
        $ft[0]="OFF";
        $ft[1]="application/octet-stream";
        return $ft;
    }
    else {
        $ft[0]="GNC";
        $ft[1]="application/octet-stream";
        return $ft;
    }
}


function geticon($filetype,$tida) {
    global $dirpath,$copt,$path,$pathext,$file,$sortKey,$u,$urlpath,$PHP_SELF;
    if ($filetype=="HTML") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/html.gif\" width=\"20\" height=\"20\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$urlpath$pathext$file?u=$u\">$file</a>";
    }
    elseif ($filetype=="Folder") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/foldericon.gif\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"?name=filemanager&file=index&u=$u&copt=$copt&sortKey=$sortKey&pathext=$pathext$file/\">$file</a>";
    }
    elseif ($filetype=="BMP") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/jpg.gif\" width=\"20\" height=\"20\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$PHP_SELF?name=filemanager&file=index&action=view&cz=x&filename=$file&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey\">$file</a>";
    }
    elseif ($filetype=="JPG") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/jpg.gif\" width=\"20\" height=\"20\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$PHP_SELF?name=filemanager&file=index&action=view&cz=x&filename=$file&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey\">$file</a>";
    }
    elseif ($filetype=="GIF") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/gif.gif\" width=\"20\" height=\"20\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$PHP_SELF?name=filemanager&file=index&action=view&cz=x&filename=$file&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey\">$file</a>";
    }
    elseif ($filetype=="PNG") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/png.gif\" width=\"16\" height=\"16\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$PHP_SELF?name=filemanager&file=index&action=view&cz=x&filename=$file&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey\">$file</a>";
    }
    elseif ($filetype=="TXT") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/txt.gif\" width=\"20\" height=\"20\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$PHP_SELF?name=filemanager&file=index&action=viewascii&filename=$file&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey\">$file</a>";
    }
    elseif ($filetype=="LOG") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/txt.gif\" width=\"20\" height=\"20\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$PHP_SELF?name=filemanager&file=index&action=viewascii&filename=$file&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey\">$file</a>";
    }
    elseif ($filetype=="CSS") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/css.gif\" width=\"20\" height=\"20\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$urlpath$pathext$file?u=$u\">$file</a>";
    }
    elseif ($filetype=="RTF") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/rtf.gif\" width=\"18\" height=\"18\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$urlpath$pathext$file?u=$u\">$file</a>";
    }
    elseif ($filetype=="PDF") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/pdf.gif\" width=\"20\" height=\"20\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$urlpath$pathext$file?u=$u\">$file</a>";
    }
    elseif ($filetype=="DOC") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/word.gif\" width=\"17\" height=\"17\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$PHP_SELF?name=filemanager&file=index&action=download&filename=$file&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey\">$file</a>";
    }
    elseif ($filetype=="PHP") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/phpx.jpg\" width=\"20\" height=\"20\"  border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$PHP_SELF?name=filemanager&file=index&action=download&filename=$file&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey\">$file</a>";
    }
    elseif ($filetype=="ZIP") {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/zip.gif\" width=\"20\" height=\"20\" border=0 alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$PHP_SELF?name=filemanager&file=index&action=download&filename=$file&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey\">$file</a>";
    }
    else {
        $iconlink[0] = "<img src=\"modules/filemanager/fm_files/fileicon.gif\" width=\"11\" height=\"13\" alt=\"$tida\">";
        $iconlink[1] = "<a href=\"$PHP_SELF?name=filemanager&file=index&action=download&filename=$file&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey\">$file</a>";
    }
    return $iconlink;
}



function OffFile ($ckfile) {
    global $ExtensionsOFF;
    $dotpos = strrpos($ckfile, ".");
    if ($dotpos < 1) {
        return "";
    }
    else {
        $ckfileext = strtoupper(substr($ckfile,$dotpos+1));
    }
    // check to see if files should be OFF - This appends .OFF
    // to filename and disables rename to that extension.
    if (isset($ExtensionsOFF)) {
        foreach($ExtensionsOFF as $name) {
            if($ckfileext == strtoupper($name)) {   
                $OFF = "1";     
            }
        }   
    }
    return $OFF;
}


function viewascii () {        
    global $path,$pathext,$filename,$PHP_SELF,$u,$sortKey,$copt,$urlpath;

    $file_stat = stat($path.$pathext.$filename);

    $size = setsize($file_stat[7]);
    $lastmod = date("m/d/Y h:i:sA",$file_stat[10]);
    $created = date("m/d/Y h:i:sA",$file_stat[8]);
    $content_array = file("$path$pathext$filename");
    $content = implode("", $content_array);

    $content = htmlspecialchars($content);

    $filemanager = makbar();
    $filemanager .= <<<content
    <tr><td colspan=3 height=3><hr></td></tr>
    <tr><td colspan=3 align=center>
        <table width=100% border=0>
            <tr><td align=center class=normalblack><b>Viewing text "$filename"</td>
            <td class=smallblack align=right>
                Size: $size
            </td>
            <td  class=smallblack align=right>created: $created</td>
            <td>&nbsp;</td>
            <td align=center>
                <a href="$PHP_SELF?name=filemanager&file=index&u=$u&sortKey=$sortKey&pathext=$pathext&copt=$copt"><font face=Verdana, Arial, Helvetica size=2>&laquo;BACK</font></a>
            </td></tr>
        </table>
        <hr>
        <table border="0" cellspacing="0" cellpadding="0" width=96%>
            <tr>
                <td class=normalblack align=center>
                    [non-edit]

                    <table cellpadding=1 cellspacing=0 border=0><tr><td bgcolor="#330033">
                        <table width=80% height=100% bgcolor="#ffffff" cellpadding=10 border=0>
                            <tr>
                                <td align=center valign=middle>
                            <textarea readonly name="content" rows="20" cols="66" wrap=virtual>$content</textarea>
                        </td>
                            </tr>
                        </table>
                    </td></tr></table>
                    <span class=smallblack>Last Modified: $lastmod</span>
                </td>
            </tr>
        </table><p align=left>
        &nbsp;&nbsp;<a href="$PHP_SELF?name=filemanager&file=index&u=$u&sortKey=$sortKey&pathext=$pathext&copt=$copt"><font face=Verdana, Arial, Helvetica size=2>&laquo;BACK</font></a></p>
    </td></tr>
content;
return $filemanager;

}
function viewimage () {        
    global $path,$pathext,$filename,$cz,$za,$PHP_SELF,$u,$sortKey,$copt,$urlpath;

    $image_info = getimagesize($path.$pathext.$filename);
    $image_stat = stat($path.$pathext.$filename); // get some info about the file

    $ImageType = array("x","GIF","JPG","PNG","SWF","PSD","BMP","TIFF","TIFF","JPC","JP2","JPX","JB2","SWC","IFF");
    $zoom = array(".25",".50",".75","1","1.25","1.50","1.75","2");
    $maxzoom = 7;
    $minzoom = 0;

    $f_type = $ImageType[$image_info[2]];

    // $cz current zoom
    // $za = zoom action +1/-1

    if($cz=="x") {
        if($image_info[0]>600) { $cz=1; }
        elseif ($image_info[0]>440) { $cz=2; }
        else { $cz=3; }
    }

    $cz = $cz + $za;
    if ($cz > $maxzoom) { $cz=$maxzoom; }
    if ($cz < $minzoom) { $cz=$minzoom; }

    $f_width = $image_info[0] * $zoom[$cz];
    $f_height = $image_info[1] * $zoom[$cz];

    $zoom_stat = $zoom[$cz] * 100;

    $size = setsize($image_stat[7]);
    $lastmod =  date("m/d/Y h:i:sA",$image_stat[10]);

    $filemanager = makbar();
    $filemanager .= <<<content
    <tr><td colspan=3 height=3><hr></td></tr>
    <tr><td colspan=3>
        <table width=100% border=0>
            <tr><td align=center class=normalblack><b>Viewing "$filename" at $zoom_stat%</td>
            <td class=smallblack align=right>
                Image type: $f_type<br>
                Size: $size
            </td><td  class=smallblack align=right>
                Width: $image_info[0]<br>
                Height: $image_info[1]
            </td>
            <td>&nbsp;</td>
            <td align=center>
                <a href="$PHP_SELF?name=filemanager&file=index&u=$u&sortKey=$sortKey&pathext=$pathext&copt=$copt"><font face=Verdana, Arial, Helvetica size=2>&laquo;BACK</font></a>
            </td></tr>
        </table>
        <hr>
        <table border="0" cellspacing="0" cellpadding="0" width=96%>
            <tr>
                <td class=normalblack align=center>
                    <a href="$PHP_SELF?name=filemanager&file=index&action=view&cz=$cz&za=-1&filename=$filename&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey"><img src=modules/filemanager/fm_files/minus.gif width=11 height=11 border=0 alt=Zoom In>&nbsp;Zoom Out</a>&nbsp;<a href="$PHP_SELF?name=filemanager&file=index&action=view&cz=$cz&za=1&filename=$filename&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey"><img src=modules/filemanager/fm_files/plus.gif width=11 height=11 border=0 alt=Zoom Out>&nbsp;Zoom In</a>&nbsp;<a href="$PHP_SELF?name=filemanager&file=index&action=view&cz=3&za=0&filename=$filename&pathext=$pathext&u=$u&copt=$copt&sortKey=$sortKey"><img src=modules/filemanager/fm_files/original.gif width=11 height=11 border=0 alt=Original Size>&nbsp;Original Size</a>

                    <table cellpadding=1 cellspacing=0 border=0><tr><td bgcolor="#330033">
                        <table width=80% height=100% bgcolor="#ffffff" cellpadding=10 border=0>
                            <tr>
                                <td align=center valign=middle><img src="$urlpath/modules/filemanager/$pathext$filename" width=$f_width height=$f_height border=0></td>
                            </tr>
                        </table>
                    </td></tr></table>
                    <span class=smallblack>Last Modified: $lastmod</span>
                </td>
            </tr>
        </table><p>
        &nbsp;&nbsp;<a href="$PHP_SELF?name=filemanager&file=index&u=$u&sortKey=$sortKey&pathext=$pathext&copt=$copt"><font face=Verdana, Arial, Helvetica size=2>&laquo;BACK</font></a>
    </td></tr>
content;
return $filemanager;
}



?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="fmstyle.css" />
<title>sfm: <?php echo $dirroot[$copt]; ?></title>
</head>
<body bgcolor="#008080">

<center><br><p>
<table cellpadding=2 cellspacing=0 bgcolor=#CFCFCF>
    <tr><td>
        <table border='0' cellspacing='0' cellpadding='0' width=690 bgcolor="#C0C0C0">
            <tr>
                <td>
                    <?php echo $filemanager ?>
                    <table cellpadding=0 cellspacing=0 border=0 width=100%>
                        <?php if (isset($nf)) { echo "<tr><td colspan=6 align=center>$nf</td></tr>"; } ?>
                        <tr><td height="3" colspan=6 bgcolor="#CFCFCF"><img src="modules/filemanager/fm_files/spacer.gif" width="1" height="3" border=0></td></tr>
                        <tr>
                            <td colspan=6 bgcolor=#ffffff align=center>
                                <table cellpadding=0 cellspacing=3 width=98%>
                                    <tr>
                                        <td><font face="Verdana, Arial, Hevetica" size="1"><b>Total Space:</b> <?php echo $HDDSpaceABR; ?> <b>Max File Size:</b> <?php echo $MaxFileSizeABR; ?><br><b>Free Space:</b> <?php echo $freespaceABR; ?> <b>Used Space:</b> <?php echo $HDDTotalABR; ?></font></td>
                                        <td valign=bottom align=right><a class=tiny href=http://onedotoh.sourceforge.net target=blank><i>simple file manager</i></a><span class=tiny> <?php echo $ver; ?></i> </span> &#945; [gpl]&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <?php echo $patherror; ?>
                </td>
            </tr>
        </table>
    </td></tr>
</table>

</center>
</body>
</html>


						<BR><BR>
					</TD>
				</TR>
			</TABLE>
			<BR><BR>
			<!-- Admin -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>

	<?
CheckAdmin($admin_user, $admin_pwd);
?>
<script language="javascript">
	function fncCreateElement(){
		
	   var mySpan = document.getElementById('mySpan');
	   // Create input file
	   var myElement1 = document.createElement('input');
	   myElement1.setAttribute('type',"file");
	   myElement1.setAttribute('name',"fileUpload[]");
	   myElement1.setAttribute('id',"fil");
	   mySpan.appendChild(myElement1);	

       // Create <br>
	   var myElement2 = document.createElement('br');
	   myElement2.setAttribute('id',"br");
	   mySpan.appendChild(myElement2);
	}

	function fncDeleteElement(){

		var mySpan = document.getElementById('mySpan');
 
			// Remove input file
			var deleteFile = document.getElementById("fil");
			mySpan.removeChild(deleteFile);

			// Remove <br>
			var deleteBr = document.getElementById("br");
			mySpan.removeChild(deleteBr);
	}
</script>
	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=5 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD >
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A>
					<BR><BR>
					</td>
					</tr>
					<tr>
					<TD align="center">

<?
$path="".WEB_PATH."/images/random/";
//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
if($action == ""){
?>
<!--สำหรับการอัพโหลด-->
<form method="post" name="upload" action="?name=admin&file=uploads&op=up&action=upload" enctype="multipart/form-data">
<input name="hdnLine" type="hidden" value="1">
<table cellSpacing=0 cellPadding=0><tr><td align="left">
		<input type="file" name="fileUpload[]" class="orenge" ><br>
		<span id="mySpan"></span>
		<input name="btnCreate" type="button" value="+" onClick="JavaScript:fncCreateElement();">
		<input name="btnDelete" type="button" value="-" onClick="JavaScript:fncDeleteElement();"><input name="btnSubmit" type="submit" value="uploads" ><br>
</td>
</tr>
</table>
</form>


<form method="post" name="myform" action="?name=admin&file=uploads&op=gal_del&action=multidel" enctype="multipart/form-data">
<? 
// install variables 
$host = "images/random/"; // the folder where index.php is located 
// path for folder, file, buttons(back and home) images 
$img_back="images/backs.gif"; 
$img_folder="images/folder.gif"; 
$img_file="images/pic_s.gif"; 
$img_home="images/home.gif"; 
// end of install variables

// returns the extension of a file 
function strip_ext($name) 
{
     $ext = substr($name, strlen($name)-4, 4); 
     if(strpos($ext,'.') === false) // if we have a folder element 
     { 
           return " "; // we return a string of space characters for later sort, 
              // so that the folder items remain on the first positions 
     } 
     return $ext; // if we have a file we return the extension - .gif, .jpg, etc. 
}

 

// returns the files from the $path and returns them in an array 
function getFiles($path) {
$path="".WEB_PATH."/images/random/";
   $files = array(); 
   $fileNames = array(); 
   $i = 0; 
   // build 
   if (is_dir($path)) { 
    if ($dh = opendir($path)) { 
     while (($file = readdir($dh)) !== false) { 
      if (($file == ".") || ($file == "..")) continue; 
      $fullpath = $path . "/" . $file; 
      //$fkey = strtolower($file); 
      $fkey = $file; 
      while (array_key_exists($fkey,$fileNames)) $fkey .= " "; 
      $a = stat($fullpath); 
      $files[$fkey]['size'] = $a['size']; 
      if ($a['size'] == 0) $files[$fkey]['sizetext'] = "-"; 
      else if ($a['size'] > 1024 && $a['size'] <= 1024*1024) $files[$fkey]['sizetext'] = (ceil($a['size']/1024*100)/100) . " K"; 
      else if ($a['size'] > 1024*1024) $files[$fkey]['sizetext'] = (ceil($a['size']/(1024*1024)*100)/100) . " Mb"; 
      else $files[$fkey]['sizetext'] = $a['size'] . " bytes"; 
      $files[$fkey]['name'] = $file; 
      $e = strip_ext($file); // $e is the extension - for example, .gif 
      $files[$fkey]['type'] = filetype($fullpath); // file, dir, etc 
      $k=$e.$file; // we use this string for sorting the array elements by extension and filename; 
      $fileNames[$i++] = $k; 
     } 
     closedir($dh); 
    } else die ("Cannot open directory: $path"); 
   } else die ("Path is not a directory: $path"); 
   sort($fileNames,SORT_STRING); // sorting 
   $sortedFiles = array(); 
   $i = 0; 
   foreach($fileNames as $f) { 
     $f = substr($f, 4, strlen($f)-4); // we remove the extension we added in front of the filename for sorting 
     if($files[$f]['name'] !='') $sortedFiles[$i++] = $files[$f]; 
    }// ends the foreach where we build the final sorted array 
   return $sortedFiles; 
}


// folder navigation code 
$startdir = "./"; 
if(isset($_GET['dir'])) { 
    $prev = $_GET['dir']; 
    $folder = $_GET['dir']; 
    echo "<a href=\"javascript:history.go(-1)\"><img src=\"".$img_back."\"></a> <a href=\"".$host."\"><img src=\"".$img_home."\"></a> <br/><br/>"; 
} else { $folder = $startdir; $prev='';} 
// end folder navigation code


$files = getFiles($folder);
echo "<table border=0 cellspacing=0 cellpadding=0  width=450 class=grids><tr class=odd><td  align=center></td><td  align=center>File Name</td><td  align=center>File Type</td><td  align=center>File Size</td><td  align=center>delete</td><td  align=center>select</td></tr>";
$count=0;
foreach ($files as $file) { 
    if(strip_ext($file['name'])!='.php'){ 
     $image = $img_file; 
     if($file['type']=='dir') { 
      $image = $img_folder; 
      $cmd='?dir='.$prev.$file['name'].'/'; 
     }// if the element is a directory 
     else $cmd=$prev.$file['name']; 
	 if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

     echo "<tr ".$ColorFill."><td  align=center><img src=\"".$image."\" /></td><td><a href=\"".$host."".$cmd."\" title=\"".$file['type'].",".$file['sizetext']." class=\"highslide\" onclick=\"return hs.expand(this)\"\"> ".$file['name']."</a></td><td align=center>".$file['type']."<td align=center>".$file['sizetext']."</td><td  align=center><a href=\"?name=admin&file=uploads&op=del&action=delete&id=".$cmd."\"><img src=\"images/delete.png\" /></a></td><td align=center><input type=checkbox name=list[] value=".$cmd."></td></tr>"; 
    }//if strip_ext 
$count++;
}//foreach 
?>
</table>
<table border=0 cellspacing=0 cellpadding=0  width=450 >
<tr>
<td colspan=6 align=right>
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="gal_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 <td>
</tr>
</table>
 </form>
<?
}
else if($action == "upload" and  $op == "up"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
$count = 0;
foreach ($_FILES['fileUpload']['error'] as $k => $error) {
     	$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=uploads\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
if($_FILES["fileUpload"]['name'][$k] != "")
{
$size = getimagesize($_FILES["fileUpload"]['tmp_name'][$k]);
$widths = $size[0];
$heights = $size[1];
$ss=0;
$sd=0;
if ($widths*$heights > 520*300) {
//	    $ProcessOutput = "<BR><BR>";
//		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=uploads\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RANDOMPIC_MEASSAGE_LIMIT_PIC_WIDTH." ".$_FILES["fileUpload"]['name'][$k]." "._ADMIN_RANDOMPIC_MEASSAGE_LIMIT_PIC_WIDTH1."</B></FONT><BR><BR>";
//		$ProcessOutput .= "<A HREF=\"?name=admin&file=uploads\"><B>"._ADMIN_RANDOMPIC_MEASSAGE_GOBACK."</B></A>";
//		$ProcessOutput .= "</CENTER>";
//		$ProcessOutput .= "<BR><BR>";
$ss++;
} else if($_FILES["fileUpload"]['size'][$k] > 1024000){
//		$ProcessOutput = "<BR><BR>";
//		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=uploads\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RANDOMPIC_MEASSAGE_LIMIT_PIC_WIDTH." ".$_FILES["fileUpload"]['name'][$k]." "._ADMIN_RANDOMPIC_MEASSAGE_LIMIT_PIC_WIDTH2."</B></FONT><BR><BR>";
//		$ProcessOutput .= "<A HREF=\"?name=admin&file=uploads\"><B>"._ADMIN_RANDOMPIC_MEASSAGE_GOBACK."</B></A>";
//	$ProcessOutput .= "</CENTER>";
//		$ProcessOutput .= "<BR><BR>";
$sd++;
  } else {
   copy($_FILES["fileUpload"]['tmp_name'][$k], 'images/random/'.$_FILES["fileUpload"]['name'][$k]);

  }

}
$count ++;

}
$co=($count-($ss+$sd));
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RANDOMPIC_MEASSAGE_UPLOAD_SUC." ".$co." "._ADMIN_RANDOMPIC_MEASSAGE_UPLOAD_SUC1."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=uploads\"><B>"._ADMIN_RANDOMPIC_MEASSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	echo $ProcessOutput ;
//   echo "<meta http-equiv='refresh' content='0;url=?name=admin&file=uploads'>" ; 

}
///////////////////////////////////////////////////////////////////////////////////////////////////////
else if($action == "delete" and  $op == "del"){

//	$_GET['id'] = intval($_GET['id']);
	$files=$_GET['id'];
//	echo "$files";
	unlink($path.$files);
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RANDOMPIC_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=uploads\"><B>"._ADMIN_RANDOMPIC_MEASSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;

//   echo "<meta http-equiv='refresh' content='0;url=?name=admin&file=uploads'>" ; 

}
///////////////////////////////////////////////////////////////////////////////////////////////////////
else if($op == "gal_del" and  $action == "multidel"){
		while(list($key, $value) = each ($_POST['list'])){
			$files=$value;
			unlink($path.$files);
			}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_RANDOMPIC_MESSAGE_DEL_LIST."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=uploads\"><B>"._ADMIN_RANDOMPIC_MEASSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;

//   echo "<meta http-equiv='refresh' content='0;url=?name=admin&file=uploads'>" ; 

}

?>
 						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>


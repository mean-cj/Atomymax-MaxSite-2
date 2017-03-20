<center><table >
<tbody>
<tr>
<td align="center">
<div align="center">
<?
		$dir=opendir("images/random");
		$file="";
		$a=0;
		$i=0;

?>
<script language="javascript">
var url = './';
var pic_height=200; //ความสูง
var pic_width=520; //ความกว้าง
var stop_time=5000; 
var show_text=0; 
var txtcolor="000000"; //สีตัวอักษร
var bgcolor="fffff"; //สีพื้นหลัง
var imag=new Array();
var link=new Array();
var text=new Array();
</script>
<?
$iNumber = 0;
$aImages = array();
		while (($file=readdir($dir))==true) {
//		print $file ."<br>";
		if (($file!=".")&&($file!="..")&&($file!="Thumbs.db")) { 
		$a+=$file;
		$aImages[$iNumber]=$file;
 			$iNumber++;
		}
}
echo '<script language="javascript">';  
echo 'var imag = new Array(';
for ($i = 0;$i<count($aImages);$i++)  
{ 
    if ($i ==0) //the first image 
        {  
        echo '"'.WEB_URL.'/images/random/'. $aImages[$i] . '"';  
        }  
    else //all the rest of the images 
        {  
        echo ',"'.WEB_URL.'/images/random/'. $aImages[$i] . '"';  
        } 
}
echo ');'; 
echo 'var link= new Array(';  
for ($i = 0;$i<count($aImages);$i++)  
{ 
    if ($i ==0) //the first image 
        {  
        echo '"'.WEB_URL.'/images/random/'. $aImages[$i] . '"';  
        }  
    else //all the rest of the images 
        {  
        echo ',"'.WEB_URL.'/images/random/'. $aImages[$i] . '"';  
        } 
}
echo ');'; 
echo 'var text= new Array(';  
for ($i = 0;$i<count($aImages);$i++)  
{ 
    if ($i ==0) //the first image 
        {  
        echo '" '._FLASH_NUM.' '.($i+1).'"';  
        }  
    else //all the rest of the images 
        {  
        echo ', "'._FLASH_NUM.' '.($i+1).'"';  
        }  
}

echo ');'; 
echo '</script>';



echo '<script language="javascript">';  
echo 'var button_pos='; 
echo ''.count($aImages).';'; 
//echo 'var pic_width='; 
//echo ''.$widthCU.';'; 
echo '</script>';

?>

<script language="javascript">

var swf_height=show_text==1?pic_height+20:pic_height;
var pics="", links="", texts="";
for(var i=0; i<imag.length; i++){
        pics=pics+("|"+imag[i]);
        links=links+("|"+link[i]);
        texts=texts+("|"+text[i]);
}

pics=pics.substring(1);
links=links.substring(1);
texts=texts.substring(1);
document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cabversion=6,0,0,0" width="'+ pic_width +'" height="'+ swf_height +'">');
document.write('<param name="movie" value="'+url+'/modules/randomimg/focus.swf">');//ที่อยู่ flash
document.write('<param name="quality" value="high"><param name="wmode" value="opaque">');
document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&pic_width='+pic_width+'&pic_height='+pic_height+'&show_text='+show_text+'&txtcolor='+txtcolor+'&bgcolor='+bgcolor+'&button_pos='+button_pos+'&stop_time='+stop_time+'">');
document.write('<embed src="'+url+'/modules/randomimg/focus.swf" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&pic_width='+pic_width+'&pic_height='+pic_height+'&show_text='+show_text+'&txtcolor='+txtcolor+'&bgcolor='+bgcolor+'&button_pos='+button_pos+'&stop_time='+stop_time+'" quality="high" width="'+ pic_width +'" height="'+ swf_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
document.write('</object>');
</script>
</div>
</td>
</tr>
</table></center><br>
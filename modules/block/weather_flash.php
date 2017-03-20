 <table width="<?=$widthSUM;?>" cellspacing="0" cellpadding="0" border="0">
<tr>
<td width="<?=$widthSUM;?>" align="center">

<table  width="<?=$widthSUM;?>"  border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="24" align="left">
<td ><div align="center">
<script src="modules/block/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript">

var currentTime = new Date();
var month = currentTime.getMonth()+1;
var day = currentTime.getDate();
var year = currentTime.getFullYear();
if (month < 10){
month = "0" + month
}
var time = year + "-" + month + "-" + day;
var strSrcFile='http://www.tmd.go.th/animation/thai?ver='+time;
var strXmlFile='http://www.tmd.go.th/animation/thai_query.php%3Fd%3D'+time;
var intWidth='190';
var intHeight='311';									

if (strSrcFile!="")
	{
		AC_FL_RunContent
		(
			 'codebase'		,'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0',
			 'width'		,intWidth,
			 'height'		,intHeight,
			 'src'			,strSrcFile,
			 'quality'		,'high',
			 'pluginspage'	,'http://www.macromedia.com/go/getflashplayer',
			 'movie'		,strSrcFile,
			 'FlashVars'	,'file=' + strXmlFile
		 );
	}
</script>
</div></td>
     
  </tr>
  <td align="left">&nbsp;</td>
</table>
</td>
</tr>
</table>



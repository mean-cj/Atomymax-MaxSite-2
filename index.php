<?php 
//$ebits = ini_get('error_reporting');
//error_reporting($ebits ^ E_NOTICE);
//ob_start();
//session_start();


//$ebits = ini_get('error_reporting');   //รายงาน error ของ php
//error_reporting($ebits ^ E_NOTICE);  //รายงาน error ของ php

if ( !file_exists( 'includes/config.in.php' ) || filesize( 'includes/config.in.php' ) < 9.00 ) {
	header( 'Location: install/index.php' );
	exit();
}


/*
Installation sub folder check, removed for work with CVS*/
if (file_exists( 'install/index.php' )) {
	include ('offline.php');
	exit();
}
/**/

require_once("mainfile.php");
$_SERVER['PHP_SELF'] = "index.php";
empty($_GET['name'])?$name="":$name=$_GET['name'];
empty($_GET['file'])?$file="":$file=$_GET['file'];
GETMODULE($name,$file);
 // Make sure you're using correct paths here
empty($_SESSION['admin_user'])?$admin_user="":$admin_user=$_SESSION['admin_user'];
empty($_SESSION['admin_pwd'])?$admin_pwd="":$admin_pwd=$_SESSION['admin_pwd'];
empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];
empty($_SESSION['pwd_login'])?$pwd_login="":$pwd_login=$_SESSION['pwd_login'];
empty($_GET['op'])?$op="":$op=$_GET['op'];
empty($_GET['action'])?$action="":$action=$_GET['action'];
empty($_GET['page'])?$page="":$page=$_GET['page'];
empty($_GET['category'])?$category="":$category=$_GET['category'];
empty($_POST['loop'])?$loop="":$loop=$_POST['loop'];
?>

<link href="css/template_css.css" rel="stylesheet" type="text/css">
<link href="css/Scroller_Stop.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/favicon.ico">
<script type="text/javascript" src="highslide/highslide.js"></script>
<script type="text/javascript" src="highslide/highslide-html.js"></script>
<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="js/datepicker.js"></script>
<script type="text/javascript" src="js/java.js"></script>
<script type="text/javascript" src="js/autocomplete.js"></script>
<script type="text/javascript" src="js/Style_event.js" ></script>
<script type="text/javascript" src="js/Style_cookie.js" ></script>
<script type="text/javascript" src="js/Style_size.js" ></script>
<script type="text/javascript" src="js/Set_text.js" ></script>

<script type="text/javascript">

function checkAll(field)
{
  for(i = 0; i < field.elements.length; i++)
     field[i].checked = true ;
}

function uncheckAll(field)
{
 for(i = 0; i < field.elements.length; i++)
    field[i].checked = false ;
}

function Confirm(link,text) 
{
  if (confirm(text))
     window.location=link
}

  function delConfirm(obj){
	var status=false;
	for(var i=0 ; i < obj.elements.length ; i++ ){
		if(obj[i].type=='checkbox'){
			if(obj[i].checked==true){
				status=true;
			}
		}
	}
	if(status==false){
		alert('<?php echo _ADMIN_JAVA_CONFIRM_SELECT_DEL;?>');
		return false;
	}else{
		if(confirm('<?php echo _ADMIN_JAVA_CONFIRM_DEL;?>')){
			return true;
		}else{
			return false;
		}
	}
}
</script>
<script type="text/javascript">    
    hs.graphicsDir = 'highslide/graphics/';
    hs.outlineType = 'rounded-white';
    hs.outlineWhileAnimating = true;
    hs.objectLoadTime = 'after';
</script>
<div class="highslide-html-content" id="highslide-html" style="width: 500px">
	<div class="highslide-move" style="border: 0; height: 18px; padding: 2px; cursor: default">
	    <a href="#" onclick="return hs.close(this)" class="control">[x] <?php echo _HIGH_CLOSE;?></a>
	</div>
	<div class="highslide-body"></div>
	<div style="text-align: center; border-top: 1px solid silver; padding: 5px 0">
		Powered by <A HREF="<?php echo WEB_URL;?>" target="_blank"><?php echo  _SCRIPT." "._VERSION ;?></A>
	</div>
</div>
<script language="JavaScript1.2">
/*
Fading Image Script 
Dynamic Drive (www.dynamicdrive.com)
*/

function makevisible(cur,which){
  if (which==0)
    cur.filters.alpha.opacity=100
  else
    cur.filters.alpha.opacity=50
}
</script>

<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->

</script>
<script language="JavaScript">
<!--
function MM_displayStatusMsg(msgStr) { //v1.0
  status=msgStr;
  document.MM_returnValue = true;
}
//-->
</script>

<?php 
require_once( 'templates/'.WEB_TEMPLATES.'/index.php' );


?>


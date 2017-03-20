<?
require_once("mainfile.php");
$PHP_SELF = "popup.php";
empty($_GET['name'])?$name="":$name=$_GET['name'];
empty($_GET['file'])?$file="":$file=$_GET['file'];
empty($_SESSION['admin_user'])?$admin_user="":$admin_user=$_SESSION['admin_user'];
empty($_SESSION['admin_pwd'])?$admin_pwd="":$admin_pwd=$_SESSION['admin_pwd'];
empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];
empty($_SESSION['pwd_login'])?$pwd_login="":$pwd_login=$_SESSION['pwd_login'];
empty($_GET['op'])?$op="":$op=$_GET['op'];
empty($_GET['action'])?$action="":$action=$_GET['action'];
empty($_GET['page'])?$page="":$page=$_GET['page'];
empty($_GET['catgory'])?$catgory="":$catgory=$_GET['catgory'];
GETMODULE($name,$file);

?>
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=<?=ISO;?>">
<link href="templates/<?=WEB_TEMPLATES ;?>/css/<?=WEB_TEMPLATES ;?>.css" rel="stylesheet" type="text/css">
<link href="css/template_css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/datepicker.js"></script>
<script type="text/javascript" src="js/java.js"></script>
<script type="text/javascript">
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
		alert('<? echo _ADMIN_JAVA_CONFIRM_SELECT_DEL;?>');
		return false;
	}else{
		if(confirm('<? echo _ADMIN_JAVA_CONFIRM_DEL;?>')){
			return true;
		}else{
			return false;
		}
	}
}
</script>
</head>

<body  >

<!-- Content -->
<?include ("".$MODPATHFILE."");?>
<!-- End Content -->

</body>
</html>

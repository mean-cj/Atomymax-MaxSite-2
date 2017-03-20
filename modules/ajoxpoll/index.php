<?
//session_start();
$sess_id = session_id();
require_once("connect.php");
//*******------POLL
$page = 'home';
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$q = $db->select_query("select * from ".TB_POLL." where status='1' order by id desc limit 1");
$r = $db->fetch($q);
$pid = $r['id'];

$question = '<p>&nbsp;&nbsp;&nbsp;'.$r['poll_question'].'</p><hr width="95%">';
$opt = explode("|",$r['poll_options']);
$op = count($opt)-2;
$options = "";

for($z=0;$z<=$op;$z++){
$options .= '<li><input type="radio" name="opt" id="opt" value="'.$z.'" /> '.$opt[$z].'</li>';
}
$options .='<input type="hidden" name="poll_id" id="poll_id" value="'.$pid.'" /><input type="hidden" name="topt" id="topt" value="'.$op.'" />';

////**********************************
$qz = $db->select_query("select * from ".TB_POLL_VOTES." where ip = '$sess_id' and poll_id ='$pid' ");
$rz = $db->rows($qz);

if($rz<=0){
$showpoll = '<table boder="0"><tr><td width="$widthSUM" align="left"><span id="vote_msg" align="left">
			<form name="vote-form" action="javascript:submit_vote(document.getElementById(\'vote-form\'));" id="vote-form" method="post">
            <b style="font-size:13px;text-align:left">'.$question.'</b>
			<ol id="poll-options">'.$options.'
			</ol>
			<center><input type="submit" name="vote" id="vote" value="Submit Vote" /></center>
			</form><br>
			<div align="right"><a href="javascript:getpage(\'modules/ajoxpoll/resultb.php?poll_id='.$pid.'\', \'vote_msg\');" class="readmore3" id="view-poll" >'._POLL_VOTE_DETAIL.'</a>
</td></tr></table>';
}else{  

require_once("mainfile.php");
//include("connect.php");
error_reporting(0);

$poll_id = mysql_real_escape_string($pid);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$q = $db->select_query("select * from web_poll_votes where poll_id ='$poll_id' order by vote_id asc") ;
$total = $db->rows($q);


$q2 = $db->select_query("select * from web_polls where id='$poll_id'");
$rec = $db->fetch($q2);

$question = $rec['poll_question'];
$o = explode("|",$rec['poll_options']);
$all = count($o)-2;

////----tally votes
$opt = array();
$prc = array();
for($ctr=0;$ctr<=$all;$ctr++){
	$opt[$ctr] = 0;
	$qx = $db->select_query("select * from web_poll_votes where poll_id ='$poll_id' and vote_id='$ctr'");
	$opt[$ctr]	= $db->rows($qx);
	$prc[$ctr] = ($opt[$ctr]/$total) * 100;
}
$showpoll ='<span id="vote_msg" align="left"><div style="font-family:Arial, Helvetica, sans-serif;font-size:14px;"><b>&nbsp;&nbsp;'.$question.'</b></div>';
//$showpoll .='<div align="right" width=100%><a href="javascript:getpage(\'modules/ajoxpoll/resultb.php?poll_id='.$pid.'\', \'vote_msg\');" class="readmore3" id="view-poll" >'._POLL_VOTE_DETAIL.'</a>';
?>
<style>
.bars{
	height:12px;
	background:#FFCC00;	
	float:left;
}

.divs{
	float:left;
	margin-right:10px;
}
</style>
<!--<table width="32%" border="0">
<? 
for($x=0;$x<=$all;$x++){
?>
  <tr>
    <td width="92"><? //=$o[$x]; ?></td>
    <td width="17"><? //=$opt[$x] ?></td>
    <td width="403" style="width:250px"><div class="bars" style="width:<? //=$prc[$x] ?>%;"></div></td>    
  </tr>
<? } ?>  
</table>
-->
<? 
echo "<table width=$widthSUM>";
for($x=0;$x<=$all;$x++){

    $showpoll .='<tr><td width=120>&nbsp;'.$o[$x].'</td><td width=30>&nbsp;'.$opt[$x] .'</td><td width=30>'.substr($prc[$x],0,5).'%</td></tr><tr><td colspan=3 width=$widthSUM><div class="bars" style="width:'.$prc[$x].'%;"></div></td></tr>';
	  } 
	$showpoll .='<tr><td colspan=3 width=$widthSUM>Total Votes : '.$total.'</tr></table></span>';
}
?>
<html>
<head><title></title>
</head>
<script>
 //VOTE POLL -------------------------------------
    function makeVote(url, parameters) {
      http_request = false;
      if (window.XMLHttpRequest) { // Mozilla, Safari,...
         http_request = new XMLHttpRequest();
         if (http_request.overrideMimeType) {
         	// set type accordingly to anticipated content type
            //http_request.overrideMimeType('text/xml');
            http_request.overrideMimeType('text/html');
         }
      } else if (window.ActiveXObject) { // IE
         try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
            try {
               http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
         }
      }
      if (!http_request) {
         alert('Cannot create XMLHTTP instance');
         return false;
      }
      
      http_request.onreadystatechange = alertVote;
      http_request.open('POST', url, true);
      http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=<?echo ISO;?>");
      http_request.setRequestHeader("Content-length", parameters.length);
      http_request.setRequestHeader("Connection", "close");
      http_request.send(parameters);
   }

   function alertVote() {
      if (http_request.readyState == 4) {
         if (http_request.status == 200) {
            //alert(http_request.responseText);
            result = http_request.responseText;
            document.getElementById('vote_msg').innerHTML = result;            
         } else {
            alert('There was a problem with the request.');
         }
      }
   }
   
function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}
 
   function submit_vote(obj) {
	  var vote_value = getCheckedValue(document.forms['vote-form'].elements['opt']);
      var poststr = "poll_id=" + encodeURI( document.getElementById("poll_id").value ) +
                    "&voteid=" + encodeURI( vote_value);				
      makeVote('modules/ajoxpoll/vote.php', poststr);
   }
</script>

        
<script type="text/javascript">

	function getxmlhttp(){
		var page_request = false;
		if (window.XMLHttpRequest){
			return xmlhttp = new XMLHttpRequest();
		}else if (window.ActiveXObject){
			try {
				return xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}catch (e){
				try{
					return xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}catch (e){}
			}
		}else{
			return false
		}
	}
	
	function getpage(url, container){
		xmlhttp = getxmlhttp();
		xmlhttp.open('GET', url);
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById(container).innerHTML = xmlhttp.responseText;
//				tinyMCE.execCommand("mceAddControl",false,'content');
			}else{
	//		document.getElementById(container).innerHTML = "<h5>Loading.....</h5>";
				document.getElementById(container).innerHTML = '<div style="text-align:center;"><img src="images/loadingx.gif" /></div>';
			}			
			//alert(xmlhttp.status);
			//document.getElementById(container).innerHTML = xmlhttp.responseText;
		}
		xmlhttp.send(null);
	}
	
	
</script>
        
<body>
<div  style="width:<?=$widthSUM;?>px;font-size:11px;font-family:Arial, Helvetica, sans-serif;border:solid #999999 0px;">
  <?=$showpoll; ?>

<br />
</div>

</body>
</html>
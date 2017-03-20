<? // Save Votes
  header("Expires: Sat, 1 Jan 2010 00:00:00 GMT");
  header("Last-Modified: ".gmdate( "D, d M Y H:i:s")."GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  
  //กำหนด header ตอนรับ
  header("content-type: application/x-javascript; charset=".ISO."");
require_once("../../mainfile.php");
//include("connect.php");
error_reporting(0);

$poll_id = mysql_real_escape_string($_GET['poll_id']);
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

?>
<h3><?=$question ?></h3>
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
<div style="font-family:Arial, Helvetica, sans-serif;font-size:11px;">
<strong>BAR GRAPH</strong>
<? 
for($x=0;$x<=$all;$x++){
?>
    <div style="float:left;width:100px;">&nbsp;<?=$o[$x]; ?></div><div style="float:left;width:30px;">&nbsp;&nbsp;&nbsp;
	  <?=$opt[$x] ?></div>
	<div class="divs" style="width:30px;"><?=substr($prc[$x],0,5) ?>%</div><br><div class="divs" style="width:160px;"><div class="bars" style="width:<?=$prc[$x] ?>%;"></div></div>
  <p>
      <? 
	  } ?>
  </p>
  
  <br />
  <strong>PIE CHART</strong>
<? 
$datas = "";
$sel = "";
for($x=0;$x<=$all;$x++){
	  if($x==$all){
	  $datas .= $prc[$x] ;
	  $sel .= $o[$x];	  }
	  else{
	  $datas .= $prc[$x] . "*";
	  $sel .= $o[$x] . "*";
	  }
	  }
?>
<div align="left"><img src="modules/ajoxpoll/chart.php?data=<?=$datas ?>&label=<?=$sel ?>"></div><br />
<h5><b>Total Votes : <?=$total ?></b></h5></div>

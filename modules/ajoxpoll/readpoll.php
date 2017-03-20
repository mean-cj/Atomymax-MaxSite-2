<?

require_once("mainfile.php");

$poll_id = $_GET['poll_id'];

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$q = $db->select_query("select * from web_poll_votes where poll_id ='$poll_id' order by vote_id asc");
$total = $db->rows($q);
if ($total) {

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
<font color="#CC0000" size="3"><b><?=$question ?></b></font>
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
<table class="grids" cellspacing="0" cellpadding="0">
<tr class="odd"><td colspan="3"><strong>BAR GRAPH</strong></td>
<? 
for($x=0;$x<=$all;$x++){
?>
    <tr ><td ><div class="divs" style="width:80px;"><?=$o[$x]; ?> (<?=$opt[$x] ?>)</div></td>
	<td><div class="divs" style="width:50px;"><?=substr($prc[$x],0,5) ?>%</div></td><td><div class="divs" style="width:300px;"><div class="bars" style="width:<?=$prc[$x] ?>%;"></div></div></td></tr>
      <? 
	  } ?>
  </table>
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
if(ISO=='utf-8'){
$selx=$sel;
} else {
$selx=tis620_to_utf8($sel);
}
//echo $selx;
?>
<div align="left"><img src="modules/ajoxpoll/chartbig.php?data=<?=$datas; ?>&label=<?=$selx; ?>"></div><br />
<font color="#CC0000" size="3"><b>Total Votes : <?=$total; ?></b></font></div>
<?
 } else {
echo "<center><font color=#CC0000 size=3><b>"._POLL_VOTE_NULL."</b></font></center>";
}
?>
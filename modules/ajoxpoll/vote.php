<?
  header("Expires: Sat, 1 Jan 2010 00:00:00 GMT");
  header("Last-Modified: ".gmdate( "D, d M Y H:i:s")."GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  
  //กำหนด header ตอนรับ
  header("content-type: application/x-javascript; charset=".ISO." ");
//session_start();

require_once("../../mainfile.php");

$poll_id = $_POST['poll_id'];
$vote_id = $_POST['voteid'];

$ses = session_id();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$q = $db->select_query("insert into ".TB_POLL_VOTES." (poll_id,vote_id,ip) values ('$poll_id','$vote_id','$ses')");
echo '<ul id="poll-list-single">
				<li>
				<p style="text-align:left"><b>'._POLL_VOTE_THANK.'</p>
				</li>
				</ul><div align="right"><a href="javascript:getpage(\'modules/ajoxpoll/resultb.php?poll_id='.$poll_id.'\', \'vote_msg\');" class="readmore3" id="view-poll" >'._POLL_VOTE_DETAIL.'</a>&nbsp;&nbsp;&nbsp;</div>';


?> 
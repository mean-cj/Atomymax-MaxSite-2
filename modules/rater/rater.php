<?
$IPADDRESS=get_real_ip();
// User settings
$rater_ip_voting_restriction = true; // restrict ip address voting (true or false)
$rater_ip_vote_qty=1; // how many times an ip address can vote
$rater_already_rated_msg=""._RATER_MOD_VOTE_LIMIT_TAIL." ".$rater_ip_vote_qty." "._RATER_MOD_VOTE_LIMIT_TAIL1."";
$rater_not_selected_msg=""._RATER_MOD_VOTE_SELECT_NUM."";
$rater_thankyou_msg=""._RATER_MOD_VOTE_THANK."";
$rater_generic_text="this item"; // generic item text
$rater_end_of_line_char="\n"; // may want to change for different operating systems
 $rater_ip = $IPADDRESS; 
 if(!isset($rater_id)) $rater_id=1;
if(!isset($rater_item_name)) $rater_item_name=$rater_generic_text;


// DO NOT MODIFY BELOW THIS LINE
$rater_filename='item_'.$rater_id.".rating";
$rater_rating=0;
$rater_stars="";
$rater_stars_txt="";
$rater_rating=0;
$rater_votes=0;
$rater_msg="";

// Rating action
if(isset($_REQUEST["rate".$rater_id])){
 if(isset($_REQUEST["rating_".$rater_id])){
$ratingrate=$_REQUEST["rating_".$rater_id];
  while(list($key,$val)=each($_REQUEST["rating_".$rater_id])){
   $rater_rating=$val;
  }
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['vote'] = $db->select_query("SELECT * FROM ".TB_VOTE." WHERE ip='".$rater_ip."' and name='".$rater_item_name."' and name_id='".$rater_ids."'");
$arr['vote'] = $db->fetch($res['vote']);
$voteip=$arr['vote']['ip'];
//echo $voteip;
if($voteip){
     $rater_msg=$rater_already_rated_msg;
//	exit();
} else {

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->add_db(TB_VOTE,array(
					"num"=>"".$rater_rating."",
					"ip"=>"".$rater_ip."",
					"name"=>"".$rater_item_name."",
					"name_id"=>"".$rater_ids.""
				));
$rater_msg=$rater_thankyou_msg;
}

	} else {
  $rater_msg=$rater_not_selected_msg;
  $db->closedb ();
	}
}

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['votesum'] = $db->select_query("SELECT * FROM ".TB_VOTE." WHERE name='".$rater_item_name."' and name_id='".$rater_ids."'");
$idxxs=0;
$rater_sum=0;
while($arrs['votesum'] = $db->fetch($res['votesum'])){
$rater_sum+=$arrs['votesum']['num'];
$idxxs+=count($arrs['votesum']['id']);
}
//echo $rater_sum;
//echo $idxxs;
if ($rater_sum !=0 || $idxxs !=0 ) {
$rater_rating=number_format(($rater_sum/$idxxs), 2, '.', '');
}

// Assign star image
if ($rater_rating <= 0  ){$rater_stars = "modules/rater/img/00star.gif";$rater_stars_txt="Not Rated";}
if ($rater_rating >= 0.5){$rater_stars = "modules/rater/img/05star.gif";$rater_stars_txt="0.5";}
if ($rater_rating >= 1  ){$rater_stars = "modules/rater/img/1star.gif";$rater_stars_txt="1";}
if ($rater_rating >= 1.5){$rater_stars = "modules/rater/img/15star.gif";$rater_stars_txt="1.5";}
if ($rater_rating >= 2  ){$rater_stars = "modules/rater/img/2star.gif";$rater_stars_txt="2";}
if ($rater_rating >= 2.5){$rater_stars = "modules/rater/img/25star.gif";$rater_stars_txt="2.5";}
if ($rater_rating >= 3  ){$rater_stars = "modules/rater/img/3star.gif";$rater_stars_txt="3";}
if ($rater_rating >= 3.5){$rater_stars = "modules/rater/img/35star.gif";$rater_stars_txt="3.5";}
if ($rater_rating >= 4  ){$rater_stars = "modules/rater/img/4star.gif";$rater_stars_txt="4";}
if ($rater_rating >= 4.5){$rater_stars = "modules/rater/img/45star.gif";$rater_stars_txt="4.5";}
if ($rater_rating >= 5  ){$rater_stars = "modules/rater/img/5star.gif";$rater_stars_txt="5";}


// Output
$conf['dir'] = str_replace('\\', '/', dirname(__FILE__));
// Absolute path
$conf['path'] = "http://".$_SERVER['SERVER_NAME'].str_replace($_SERVER['DOCUMENT_ROOT'], '', $conf['dir']);
// uri แบบที่ตัด root folder ออก
$conf['uri'] = str_replace($conf['path'].'/', '', $_SERVER['REQUEST_URI']);

echo '<table ><tr><td  align=left><div class="hreview">';
//echo '<form method="post" action="'.WEB_URL.'?name=rater&file=test">';
echo '<form method="post" action="'.$conf['uri'].'">';
//echo '<h3 class="item">Rate <span class="fn">'.$rater_item_name.'</span></h3>';
echo '<span  class="rating"><img src="'.$rater_stars.'?x='.uniqid((double)microtime()*1000000,1).'" alt="'.$rater_stars_txt.' stars" /> <b>'._RATER_MOD_VOTE_AVEG.' : <font color=#CC0000>'.$rater_stars_txt.'</font></span>  '._RATER_MOD_VOTE_TOTAL.'<font color=#CC0000><span class="reviewcount"> '.$idxxs.' </font>'._RATER_MOD_VOTE_NUM.'</span>.';
//echo '</div></td></tr>';
//echo '<tr><td  align=left>';
echo '<label for="rate5_'.$rater_id.'"><input type="radio" value="5" name="rating_'.$rater_id.'[]" id="rate5_'.$rater_id.'" /><b>'._RATER_MOD_VOTE_RATE_5.'</label>';
echo '<label for="rate4_'.$rater_id.'"><input type="radio" value="4" name="rating_'.$rater_id.'[]" id="rate4_'.$rater_id.'" /><b>'._RATER_MOD_VOTE_RATE_4.'</label>';
echo '<label for="rate3_'.$rater_id.'"><input type="radio" value="3" name="rating_'.$rater_id.'[]" id="rate3_'.$rater_id.'" /><b>'._RATER_MOD_VOTE_RATE_3.'</label>';
echo '<label for="rate2_'.$rater_id.'"><input type="radio" value="2" name="rating_'.$rater_id.'[]" id="rate2_'.$rater_id.'" /><b>'._RATER_MOD_VOTE_RATE_2.'</label>';
echo '<label for="rate1_'.$rater_id.'"><input type="radio" value="1" name="rating_'.$rater_id.'[]" id="rate1_'.$rater_id.'" /><b>'._RATER_MOD_VOTE_RATE_1.'</label>';
echo '<input type="hidden" name="rs_id" value="'.$rater_id.'" />';
echo '<input type="submit" name="rate'.$rater_id.'" value="'._RATER_MOD_BUTTON_ADD.'" />';
//echo '</div>';
if($rater_msg!="") echo "<div><b><font color=#CC0000>".$rater_msg."</div>";
echo '</form>';
echo '</div></td></tr></table>';

?>


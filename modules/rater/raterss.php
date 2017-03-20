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


echo '<table ><tr><td  align=left><div class="hreview">';
echo '<span  class="rating"><img src="'.$rater_stars.'?x='.uniqid((double)microtime()*1000000,1).'" alt="'.$rater_stars_txt.' stars" />  ( <font color=#CC0000>'.$rater_stars_txt.'</font></span> / <font color=#CC0000><span class="reviewcount">'.$idxxs.' </font> )</span>';

echo '</div></td></tr></table>';

?>


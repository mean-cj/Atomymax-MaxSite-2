<?
//หากมีการเรียกไฟล์นี้โดยตรง
if (preg_match("/array.in.php/i",$_SERVER['PHP_SELF'])) {
    Header("Location: ../index.php");
    die();
}

$DAY_FULL_TEXT = array(
"Sunday"  => ""._Sunday."",
"Monday"=> ""._Monday."",
"Tuesday" => ""._Tuesday."",
"Wednesday" => ""._Wednesday."",
"Thursday"=> ""._Thursday."",
"Friday" => ""._Friday."",
"Saturday" => ""._Saturday.""
);

$DAY_SHORT_TEXT = array(
"Sunday" => ""._S_Sunday."",
"Monday" => ""._S_Monday."" ,
"Tuesday" => ""._S_Tuesday."" ,
"Wednesday" => ""._S_Wednesday."" ,
"Thursday" => ""._S_Thursday."",
"Friday" => ""._S_Friday."" ,
"Saturday" => ""._S_Saturday.""
);

$SHORT_MONTH = array(
"1" => ""._Month_1."",
"2" => ""._Month_2."",
"3" => ""._Month_3."",
"4" => ""._Month_4."",
"5" => ""._Month_5."",
"6" => ""._Month_6."",
"7" => ""._Month_7."",
"8" => ""._Month_8."",
"9" => ""._Month_9."",
"10" => ""._Month_10."",
"11" => ""._Month_11."",
"12" => ""._Month_12.""
);

$FULL_MONTH = array(
"1" => ""._F_Month_1."",
"2" => ""._F_Month_2."",
"3" => ""._F_Month_3."",
"4" => ""._F_Month_4."",
"5" => ""._F_Month_5."",
"6" => ""._F_Month_6."",
"7" => ""._F_Month_7."",
"8" => ""._F_Month_8."",
"9" => ""._F_Month_9."",
"10" => ""._F_Month_10."",
"11" => ""._F_Month_11."",
"12" => ""._F_Month_12.""
);

$FULL_MONTH2 = array(
"01" => ""._F2_Month_1."",
"02" => ""._F2_Month_2."",
"03" => ""._F2_Month_3."",
"04" => ""._F2_Month_4."",
"05" => ""._F2_Month_5."",
"06" => ""._F2_Month_6."",
"07" => ""._F2_Month_7."",
"08" => ""._F2_Month_8."",
"09" => ""._F2_Month_9."",
"10" => ""._F2_Month_10."",
"11" => ""._F2_Month_11."",
"12" => ""._F2_Month_12.""
);

?>
<? include("../../mainfile.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Poll</title>

<style type="text/css">
body {font-family:Arial,Verdana,Sans-Serif; background: #FFFFFF;}
a {color:#000000;}

#container{
margin:20px 0px 20px 0px;
}
.style3 {
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight:bold;
}
#leftPanel{
border:#000000 1px solid;
width:250px;
height:600px;
overflow:auto;
float:left;
margin-right:50px;
}

#rightPanel{
border:#000000 1px solid;
width:950px;
height:800px;
overflow:auto;
margin:0 auto;
}

.navigation{
list-style:none;
width:100%;
height:100%;
}
.mainMenu{
list-style:none;
width:100%;
} 
.secondMenu{
list-style:none;
width:100%;
}
.thirdMenu{
list-style:none;
width:100%
}

.navigation a{
text-decoration:none;
}

.close{
width:14px;
height:14px;
display:block;
float:left;
margin:3px 5px 0px 0px;
}

.open{
width:14px;
height:14px;
display:block;
float:left;
margin:3px 5px 0px 0px;
}

#header{
height:20px;
overflow:hidden;
}

#header h4{
height:20px;
float:left;
margin:0px 0px 0px 0px;
}
#article-table-list{
	padding:4px 8px;
}
#rightPanel h1{
	color:#333;
	font-size:18px;
	padding:10px 0 0 9px;
}
#article-table-list tr td.checkedBox {
	text-align:center;
}
#article-table-list tr td{
	font-size:12px;
	padding:3px 2px;
}
</style>

</head>
<script type="text/javascript" >
var i = 1;
function CreateTextbox()
{

/*
if(i>1){
ii = i - 1;
v1 = document.getElementById('opt1').value
v2 = document.getElementById('opt2').value
}else{
v1 = "";	
}*/
if(i<=10){
		
		try{
		v1 = document.getElementById('opt1').value
		v2 = document.getElementById('opt2').value
		v3 = document.getElementById('opt3').value
		v4 = document.getElementById('opt4').value
		v5 = document.getElementById('opt5').value
		v6 = document.getElementById('opt6').value
		v7 = document.getElementById('opt7').value
		v8 = document.getElementById('opt8').value
		v9 = document.getElementById('opt9').value
		v10 = document.getElementById('opt10').value
		
		
		}
		catch(err){
			
		}
		
		document.getElementById('createTextbox').innerHTML = document.getElementById('createTextbox').innerHTML + "<input type=text name='opt"+i+"' id='opt"+i+"' size='40' /><br>";
		document.getElementById('ctr').value = i;
		i++;
		
		try{
		document.getElementById('opt1').value = v1
		document.getElementById('opt2').value = v2
		document.getElementById('opt3').value = v3
		document.getElementById('opt4').value = v4
		document.getElementById('opt5').value = v5
		document.getElementById('opt6').value = v6	
		document.getElementById('opt7').value = v7
		document.getElementById('opt8').value = v8
		document.getElementById('opt9').value = v9
		document.getElementById('opt10').value = v10		
		}
		catch(err){
			
		}
}
else
{
alert('Max limit reach');	
}


}
</script>

<?
$do = $_GET['do'];; 
$pid = $_GET['id'];

?>

<body>
<!-- main --><!-- end main -->

<div id="rightPanel" style="margin-top:20px;">

<script>
function submitt(){
var ask = confirm("Delete this data?");
if(ask == 1){
document.form1.submit();
}
else {
	return  falsel
}

}
</script>
<h2><a href="managepoll.php?do=add">Add</a> | 
  <a href="javascript:void();" onclick="submitt()">Delete</a>
  <?
if($do=='del'){
//error_reporting(0);	
	$itm = $_POST['xtr'];

for($x=1;$x<=$itm;$x++){
	$pid = $_POST['chk'.$x];
	$qx = mysql_query("delete from web_polls where id = '$pid'");
}
	
	
}
?>
</h2>
	<h1>Manage Polls
  <? 
		/*$qq = mysql_query("select title from content_categories where id = '$cat'");
		$rec = mysql_fetch_array($qq);
		echo $rec['title'];*/
	?></h1>
	<span name="myspan" id="myspan"></span>

<? if($do=='' || $do=='del'){  ?> 
<div id="article-table-list">
<form id="form1" name="form1" method="post" action="managepoll.php?do=del">
  <table width="100%" border="0" style="border:#333333 solid 1px;">
    <tr>
      <td width="2%" bgcolor="#b3bfb9"><!--<input name="chkall" type="checkbox" id="chkall" value="1" onClick="checkAll(document.form1.list)"/>--></td>
      <td width="6%" bgcolor="#b3bfb9"><span class="style3">ID</span></td>
      <td width="27%" bgcolor="#b3bfb9"><span class="style3">Poll Question</span></td>
      </tr>
    <?
$ctr = 0;
$q = mysql_query("select * from web_polls order by id desc limit 20");
$bg = 1;
while($rec=mysql_fetch_array($q)){
	$pollid = $rec['id'];
	/*$qq = mysql_query("select username from user_master where id = '$uid' ");
	$res = mysql_fetch_array($qq);*/
	$ctr++;
		if($bg==1){
		$bgcol = "#efefef";	
		$bg=0;
		}
		else
		{
		$bgcol = "#FFFFFF";	
		$bg=1;					
		}
	
?>

    <tr>
      <td  bgcolor="<?=$bgcol ?>" class="checkedBox"><input type="checkbox" name="chk<?=$ctr ?>" id="chk<?=$ctr ?>" value="<?=$rec['id'] ?>"/></td>
      <td  bgcolor="<?=$bgcol ?>"><?=$rec['id'] ?></td>
      <td  bgcolor="<?=$bgcol ?>"><a href="managepoll.php?do=edit&id=<?=$rec['id'] ?>">
        <?=$rec['poll_question'] ?>
      </a></td>
      </tr>
    <? } ?>
    <tr>
      <td bgcolor="#b3bfb9"><input name="xtr" type="hidden" id="xtr" value="<?=$ctr ?>" /></td>
      <td bgcolor="#b3bfb9">&nbsp;</td>
      <td bgcolor="#b3bfb9">&nbsp;</td>
      </tr>
  </table>
</form>
<p>
  <? }elseif($do=='add'){ ?>
</p>
<form id="form2" name="form2" method="post" action="">
<?
if(isset($_POST['savep'])){
$question = $_POST['poll_question'];
$ctr = $_POST['ctr'];
$page = mysql_real_escape_string($_POST['page']);
$options="";
	for($x=1;$x<=$ctr;$x++){
			$options .=  mysql_real_escape_string($_POST['opt'.$x])."|";
	}

$q = mysql_query("insert into polls (poll_question,poll_options,page)values('$question','$options','$page')");
echo "<script>alert('New Poll Created');parent.location='managepoll.php'</script>";

}
?>
  <table width="70%" border="0" align="center">
    <tr>
      <td height="29" colspan="2" align="center">Create New Poll </td>
      </tr>
    <tr>
      <td width="28%">POLL QUESTION</td>
      <td width="72%"><input name="poll_question" type="text" id="poll_question" size="50" /></td>
    </tr>
    <tr>
      <td height="31">SHOW ON </td>
      <td><select name="page" id="page">
        <option value="home" selected="selected">Home</option>
        <option value="entertainment">Entertainment</option>
      </select></td>
    </tr>
    <tr>
      <td height="30" valign="top"><input type="button" value="Add Option" onclick="CreateTextbox()" /></td>
      <td>
      <div id="createTextbox" style="width:300px;"></div></td>
    </tr>
    <tr>
      <td><input type="hidden" name="ctr" id="ctr" /></td>
      <td><input type="submit" value="   SAVE   " name="savep" />
        <input type="button" value="   CANCEL   " onclick="parent.location='managepoll.php'"/></td>
    </tr>
  </table>
</form>

  <? }elseif($do=='edit'){ ?>
<form id="form2" name="form2" method="post" action="">
<?
if(isset($_POST['savee'])){
$question = $_POST['poll_question'];
$ctr = $_POST['ctr2'];
$page = mysql_real_escape_string($_POST['page']);
$idd = $_POST['idd'];

$options="";
	for($x=0;$x<=$ctr;$x++){
		if(strlen($_POST['opt'.$x])>0){
			$options .= mysql_real_escape_string($_POST['opt'.$x])."|";
		}
	}

$q = mysql_query("Update polls set poll_question='$question',poll_options='$options',page='$page' where id = '$idd'");
echo "<script>alert('Poll Updated');parent.location='managepoll.php'</script>";

}

$qq = mysql_query("select * from polls where id = '$pid'");
$rec = mysql_fetch_array($qq);
$op = explode("|",$rec['poll_options']);
$octr = count($op) - 2;

?>
  <table width="70%" border="0" align="center">
    <tr>
      <td height="29" colspan="2" align="center">Edit Poll </td>
      </tr>
    <tr>
      <td width="28%">POLL QUESTION</td>
      <td width="72%"><input name="poll_question" type="text" id="poll_question" size="50" value="<?=$rec['poll_question']; ?>"/></td>
    </tr>
    <tr>
      <td height="31">SHOW ON </td>
      <td><select name="page" id="page">
        <option value="home" <? if($rec['page']=='home'){echo 'selected="selected"';} ?>  >Home</option>
        <option value="entertainment" <? if($rec['page']=='entertainment'){echo 'selected="selected"';} ?>>Entertainment</option>
      </select></td>
    </tr>
<script>
function addTextbox(){
	
	var last = eval(document.getElementById('ctr2').value) + 1;
	document.getElementById('opt'+ last).style.display = "block";
	
	document.getElementById('ctr2').value = last;
}
</script>

    
    <tr>
      <td height="30" valign="top"><input type="button" value="Add Option" onclick="addTextbox()" /></td>
      <td>
      <? for($xx=0;$xx<=$octr;$xx++){ ?><input name="opt<?=$xx; ?>" type="text" value="<?=$op[$xx]; ?>" size="40"/><br /><? } ?>     
      <? for($xx=$octr+1;$xx<10;$xx++){ ?><input id="opt<?=$xx; ?>" name="opt<?=$xx; ?>" type="text" value="" size="40" style="display:none" /><? } ?>           
      </td>
    </tr>
    <tr> 
      <td><input type="hidden" name="ctr2" id="ctr2" value="<?=$octr ?>" />
        <input type="hidden" name="idd" id="idd" value="<?=$pid ?>" /></td>
      <td><input type="submit" value="   SAVE   " name="savee" />
        <input type="button" value="   CANCEL   " onclick="parent.location='managepoll.php'"/></td>
    </tr>
  </table>
</form>
<? } ?>
</div>
</div>
</body>
</html>

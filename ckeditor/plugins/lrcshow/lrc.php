<?php
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Music Player with Lyrics Rolling</title>
</head>
<body bgcolor="#000000" style="margin:0;">
<SCRIPT type=text/javascript> 
function the(s){
return document.getElementById(s);
}
</SCRIPT>
<script type="text/javascript">
var url="";
var player="wmp";
var auto="no";
var loop="no";
var lrcurl="";
<?
$url=$_GET['url'];
$player=$_GET['player'];
$auto=$_GET['auto'];
$loop=$_GET['loop'];
$lrc=$_GET['lrc'];

if ($url) {
	echo "url='$url';";
}
if ($player=='rmp') {
	echo "player='rmp';";
}
else{
	echo "player='wmp';";
}
if ($auto=='yes') {
	echo "auto='yes';";
}
else{
	echo "auto='no';";
}
if ($loop=='yes') {
	echo "loop='yes';";
}
else{
	echo "loop='no';";
}

if ($lrc) { 
echo "lrcurl='$lrc';";
}
?>
</script>
<div id=lrcshow><!--<span align=center>Music Player with Lyrics Rolling</span>--></div>
<script type="text/javascript" src="js/cute.js"></script>
<script type="text/javascript" src="js/type.js"></script>
<script type="text/javascript" src="js/lrcbox.js"></script>
<link type="text/css" rel="stylesheet" href="lrcstyle.css"></link>
<span id="lrcdata" style="display:none"><!--
<?
if ($lrc) {
$root= $_SERVER['DOCUMENT_ROOT'];
$lrctxt = $root . $lrc; //set the path to a lyrics text file
require_once $lrctxt;
}
?>-->
</span>
<span id="container" style="display:none"></span>
<script>
/***Call lyrics text display start***/
var Lyric = function(){
var that = this;
this.preTime = 0;
this.nextTime = 0;
this.currIndex = 0;
this.lrc = the('lrcdata').innerHTML.replace(/<!--/,'').replace(/-->/,'').split("[");
this.array = [];
 
this.init = function(){
var array = [];
if (that.lrc.length > 5){
for (var i = 0; i < that.lrc.length; i++){
var g = {};
var t = that.lrc[i].split("]");
g.time = that.getTime(t[0]);
if (isNaN(g.time))
continue;
g.c = t[1];
if (g.c == "")
g.c = that.getNext(i);
array.push(g);
}
 /**/
array.sort(function(x, y) {
if (x.time > y.time)
return 1;
else if (x.time < y.time)
return -1;
else
return 0;
});

var tc = '';
for (var i = 0; i < array.length; i++){
var g = array[i];
if (!g.c) {
g.c = "";
}
tc+=("<div id='lrc" + i + "'>" + g.c + "</div>\n");
}
the('container').innerHTML=tc;

} else {
the("container").innerHTML = the("lrcdata").innerHTML.replace(/<!--/,'').replace(/-->/,'');
}
that.lines = array;
};
 
this.getNext = function(i){
var result = "";
var i = i + 1;
if(that.lrc[i]){
t = that.lrc[i].split("]");
if (t[1] == "")
result = that.getNext(i);
else
result = t[1]
}
return result;
};
 
this.getTime = function(str){
var time = 0;
var ta = str.split(":");
if (ta.length < 2)
return time;
 
if (ta[1].indexOf(".") > 0) {
var tb = ta[1].split(".");
time = ta[0] * 60 * 1000 + tb[0] * 1000 + tb[1] * 10;
}
else
time = ta[0] * 60 * 1000 + ta[1] * 1000;
return time;
};

};
new Lyric().init();
/***Call lyrics text display end***/
</script>
</body>
</html>
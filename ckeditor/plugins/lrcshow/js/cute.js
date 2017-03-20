function play()
{
  var m = lrcdata.innerHTML.slice(4,-3);
  lrcobj = new lrcClass(m);
  lrcobj.cnane = "lrcobj";
  lrcobj.haohaiplay = LRCPlayerObj;
  lrcobj.oceanx = LrcOcx; 

  setInterval("lrcobj.run();",100);
}
window.onload = function(){play();}

function LajoxLRCShow (url,player,auto,repeat){
var playobjshow,playerjs;
var autoval,autonum,aloop,bloop ;
if (auto=="yes"){autoval="true"; autonum="1";}
if (auto=="no"){autoval="false"; autonum="0";}
if (repeat=="yes"){aloop="100"; bloop="-1";}
if (repeat=="no"){aloop="1"; bloop="0";}
if (player=="wmp"){
playerjs="wm.js";
playobjshow = "";
playobjshow+="<object id=\"mediaPlayerObj\" width=\"400\" height=\"64\" type=\"application/x-oleobject\"  ";
playobjshow+="classid=\"CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6\" > ";
playobjshow+="<param name=\"url\" value=\""+url+"\"> ";
playobjshow+="<param name=\"autoStart\" value=\""+autoval+"\"> ";
playobjshow+="<param name=\"playCount\" value=\""+aloop+"\"> ";
playobjshow+="<param name=\"defaultFrame\" value=\"datawindow\">  ";     
playobjshow+="<embed src=\""+url+"\"  ";
playobjshow+="align=\"baseline\" border=\"0\" width=\"400\" height=\"68\" ";
playobjshow+="type=\"application/x-mplayer2\" pluginspage=\"\" ";
playobjshow+="name=\"MediaPlayer1\" autostart=\""+autonum+"\"  ";
playobjshow+="showcontrols=\"1\" showpositioncontrols=\"0\" ";
playobjshow+="showaudiocontrols=\"1\" showtracker=\"1\" showdisplay=\"0\" autorewind=\"0\" ";
playobjshow+="showstatusbar=\"1\" autosize=\"0\" showgotobar=\"0\" showcaptioning=\"0\" ";            
playobjshow+="animationatstart=\"0\" transparentatstart=\"0\" allowscan=\"1\" ";
playobjshow+="enablecontextmenu=\"1\" clicktoplay=\"0\" defaultframe=\"datawindow\" invokeurls=\"0\"> ";
playobjshow+="</embed></object>";
}
if (player=="rmp"){
playerjs="rm.js";
playobjshow = "";
playobjshow+="<OBJECT id=\"realPlayerObj\" classid=\"clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA\"  ";
playobjshow+="width=400 height=50 align=\"middle\" id=video1> ";
playobjshow+="<param name=\"_ExtentX\" value=\"16140\" /> ";
playobjshow+="<param name=\"_ExtentY\" value=\"1588\" /> ";
playobjshow+="<param name=\"AUTOSTART\" value=\""+autonum+"\" /> ";
playobjshow+="<param name=\"SHUFFLE\" value=\"0\" /> ";
playobjshow+="<param name=\"PREFETCH\" value=\"0\" /> ";
playobjshow+="<param name=\"NOLABELS\" value=\"0\" /> ";
playobjshow+="<param name=\"SRC\" value=\""+url+"\" /> ";
playobjshow+="<param name=\"CONTROLS\" value=\"StatusBar,ControlPanel\" /> ";
playobjshow+="<param name=\"CONSOLE\" value=\"Clip1\" /> ";
playobjshow+="<param name=\"LOOP\" value=\""+bloop+"\" /> ";
playobjshow+="<param name=\"NUMLOOP\" value=\"0\" /> ";
playobjshow+="<param name=\"CENTER\" value=\"0\" /> ";
playobjshow+="<param name=\"MAINTAINASPECT\" value=\"0\" /> ";
playobjshow+="<param name=\"BACKGROUNDCOLOR\" value=\"#000000\" /> ";
playobjshow+="<embed src=\""+url+"\"  ";
playobjshow+="type=\"audio/x-pn-realaudio-plugin\" console=\"Clip1\" controls=\"ControlPanel,StatusBar\"  ";
playobjshow+="height=\"50\" width=\"400\" autostart=\""+autoval+"\">  ";
playobjshow+="</embed></OBJECT>";
}

var ssss="";
/*
ssss="<div id=\"lrcarea\" onmouseover=\"menulink.style.display=\'block\';\" onmouseout=\"menulink.style.display='none';\"><div id=\"lrcdiv\"><div id=\"splay\">\n";
ssss+= playobjshow;
ssss+="</div><div style=\"height:18\"><span id=\"menulink\" style=\"display:none\"></span></div></div> \n";
*/
ssss="<div id=\"lrcarea\"><div id=\"lrcdiv\"><div id=\"splay\">\n";
ssss+= playobjshow;
ssss+="</div><div style=\"height:18\"><center><a style=\"color:#00FFFF\" href=\"#\" onclick=\"javascript:seeLrcText2('container')\">Text</a>&nbsp;&nbsp;<a style=\"color:#00FFFF\" href=\""+lrcurl+"\" target=\"_blank\">Lyrics</a>&nbsp;&nbsp;<a style=\"color:#00FFFF\" href=\""+url+"\">Download</a></center></div></div> \n";
ssss+="<div id=\"bkk\"><div id=\"lrcollbox\"><span id=\"geci\" ></span></div></div></div>";
//document.writeln(ssss);
document.getElementById('lrcshow').innerHTML = ssss;

}

LajoxLRCShow(url,player,auto,loop);

var MusicGeCi = document.getElementById("geci");
MusicGeCi.innerHTML = "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"400\" id=\"lrcoll\"><tr><td nowrap height=\"30\" align=\"center\" id=\"lrcwt1\"></td></tr><tr><td nowrap height=\"30\" align=\"center\" id=\"lrcwt2\"></td></tr><tr><td nowrap height=\"30\" align=\"center\" id=\"lrcwt3\"></td></tr><tr><td nowrap height=\"30\" align=\"center\" class=\"kong\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td nowrap height=\"30\"><span id=\"lrcbox\" style=\"width:0;\"></span></td></tr><tr id=\"tbltr1\"><td nowrap height=\"30\"><span id=\"lrcbc\"></span></td></tr></table></td></tr><tr id=\"tbltr2\"><td nowrap height=\"30\" align=\"center\" id=\"lrcwt4\"></td></tr><tr id=\"tbltr2\"><td nowrap height=\"30\" align=\"center\" id=\"lrcwt5\"></td></tr></table>";


/***
function copyToClipBoard(lyric){	//Copy lyrics to clipboard
var clipBoardContent=document.getElementById(lyric).innerHTML;
clipBoardContent = clipBoardContent.replace(/\[0.*?\]/gi, "" ); //Filter time stamp
clipBoardContent = clipBoardContent.replace(/<!--/, "" );
clipBoardContent = clipBoardContent.replace(/-->/, "" );
window.clipboardData.clearData();
window.clipboardData.setData("Text",clipBoardContent);
alert("Copy Lyrics success!");
}
***/
function outMenu()
	{
		var menuStr;
		menuStr = "<center>\n&nbsp;&nbsp;";
		menuStr += "<a style=\"color:#00FFFF\" href=\"#\" onclick=\"javascript:seeLrcText('lrcdata')\">View lyrics</a>\n";
		menuStr += "<a style=\"color:#00FFFF\" href=\"#\" onclick=\"javascript:saveLrc('lrcdata')\">Download LRC lyrics</a>\n";
		menuStr += "<a style=\"color:#00FFFF\" href=\""+MusicUrl+"\">Download Music</a>\n";
		menuStr += "</center>";
		
		//parent.document.all("menulink").innerHTML = menuStr;
	}
	//outMenu();

function saveLrc(lrc) { //Function: Download LRC Lyrics
        var winname = window.open('', '_blank', 'top=10000');
        winname.document.open('text/html', 'replace');
        var str = document.getElementById(lrc).innerHTML.replace('<!--','').replace('-->','');
        winname.document.write(str);
        winname.document.execCommand('saveas','','LRC歌词.lrc');
        winname.close();
}

function seeLrcText(obj) { //View lyrics Function
		 var lrcobj = document.getElementById(obj).innerHTML;
		 lrcobj = lrcobj.replace(/\[0.*?\]/gi, "" );
		 lrcobj = lrcobj.replace(/<!--/,'');
		 lrcobj = lrcobj.replace(/-->/,'');
		 lrcobj = lrcobj.replace(/\[ti:([^\[\]:]+)\]/i,"Song:$1");
		 lrcobj = lrcobj.replace(/\[ar:([^\[\]:]+)\]/i,"Singer:$1");
		 lrcobj = lrcobj.replace(/\[al:([^\[\]:]+)\]/i,"Album:$1");
		 lrcobj = lrcobj.replace(/\[by:([^\[\]:]+)\]/i,"Editor:$1");
		 winEx=window.open('', 'winEx', 'width=450,height=400,resizable=yes,top=150,left=300,status=no,scrollbars=yes,resizeable=no,toolbar=no,menubar=no,location=no');
		 winEx.document.write("<pre>"+lrcobj+"</pre>");
        }

function seeLrcText2(obj) { //View lyrics Function 2
		 var lrcobj = document.getElementById(obj).innerHTML;
		 winEx=window.open('', 'winEx', 'width=420,height=420,resizable=yes,top=150,left=300,status=no,scrollbars=yes,resizeable=no,toolbar=no,menubar=no,location=no');
		 winEx.document.write("<body bgcolor='#FFFFFF'><div style='font-size: 14px; color: #0000FF;'>"+lrcobj+"</div></body>");
        }



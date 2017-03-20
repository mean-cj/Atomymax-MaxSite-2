		<table  border="0" align="center" cellpadding="0" cellspacing="0" >
			<tr>
			<td align=center border=0 >
			<div align="center">
<style>
#newsdiv {
     height: 104px;
}

#wait2 {
     position: relative;
     top: 40%;
     left: 40%;
}

a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
<div id=newsdiv></div>
<script language=Javascript>
var images=new Array();
var dats=new Array();
images[0]=new Image();
images[0].src='images/random/1.jpg';
dats[0]='<table><tr><td><img src=images/random/1.jpg border=0 align=absmiddle></td></tr></table>';
images[1]=new Image();
images[1].src='images/random/2.jpg';
dats[1]='<table><tr><td><img src=images/random/2.jpg border=0  align=absmiddle></td></tr></table>';
images[2]=new Image();
images[2].src='images/random/3.jpg';
dats[2]='<table><tr><td><img src=images/random/3.jpg border=0  align=absmiddle></td></tr></table>';
images[3]=new Image();
images[3].src='images/random/4.jpg';
dats[3]='<table><tr><td><img src=images/random/4.jpg border=0  align=absmiddle></td></tr></table>';
images[4]=new Image();
images[4].src='images/random/5.jpg';
dats[4]='<table><tr><td><img src=images/random/5.jpg border=0  align=absmiddle></td></tr></table>';
var id=0;
function displayimage() {
     switch (Math.floor(Math.random()*7)) {
     case 6: filterstring="progid:DXImageTransform.Microsoft.Checkerboard(squaresX=12, squaresY=8, direction='right', duration=1)"; break
     case 5: filterstring="progid:DXImageTransform.Microsoft.Pixelate(duration=3)"; break
     case 4: filterstring="progid:DXImageTransform.Microsoft.Fade(duration=3,overlap=1.0)"; break
     case 3: filterstring="progid:DXImageTransform.Microsoft.GradientWipe(GradientSize=1.0, Duration=3, Motion=reverse, wipeStyle=1)"; break
     case 2: filterstring="progid:DXImageTransform.Microsoft.GradientWipe(GradientSize=1.0, Duration=3, wipeStyle=1)"; break
     case 1: filterstring="progid:DXImageTransform.Microsoft.GradientWipe(GradientSize=1.0, Duration=3, Motion=reverse)"; break
     default: filterstring="progid:DXImageTransform.Microsoft.GradientWipe(GradientSize=1.0, Duration=3)"; break
     }
     
     if (document.getElementById) {
          var imgobj=document.getElementById("newsdiv");
          
          if (imgobj.filters && window.createPopup) {
               imgobj.style.filter=filterstring;
               imgobj.filters[0].Apply();
          }
          imgobj.innerHTML=dats[id];
          if (imgobj.filters && window.createPopup) imgobj.filters[0].Play();
          
          id++;
          if (id==dats.length) id=0;
     }
}
window.setInterval("displayimage()", 5000);
</script>
		</div>
		</td>
		</tr>
		<tr>
		<td>&nbsp;&nbsp;
		</td>
		</tr>
	</table>


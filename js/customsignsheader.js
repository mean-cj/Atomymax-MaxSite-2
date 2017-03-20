function currentlocation() { 
		if (dhtmlHistory.getCurrentLocation()=="" || dhtmlHistory.getCurrentLocation()!="location1") {
			myLightbox.end(); 
			window.clearInterval(chid);
			} 
		} 

function checkhistory()	{
		chid = window.setInterval("currentlocation()",200);
		return chid;
	}

function countdown()	{
		window.setTimeout("checkhistory()", 1000)
	}


function showdiv(which,thisdiv) {
	var divnumber = thisdiv.substring(thisdiv.length-1)
	document.getElementById(which).style.display = 'block';
	document.getElementById(thisdiv).style.display = 'none';
	document.getElementById('divcollapse' + divnumber).style.display = 'block';
	if (dhtmlHistory.getCurrentLocation()!="showgallery") {
		dhtmlHistory.add('showgallery',{message: ''}) 
		}
}

function hidediv(which,thisdiv) {
	document.getElementById(which).style.display = 'none';
	document.getElementById(thisdiv).style.display = 'none';
	document.getElementById('divexpand' + thisdiv.substring(thisdiv.length-1)).style.display = 'block';
}

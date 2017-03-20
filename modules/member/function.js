// ฟังก์ชั่นต่าง ๆ

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function copyOnline(Onlineid){
	window.clipboardData.clearData()
	window.clipboardData.setData("Text" ,Onlineid)
	alert("Copy " +Onlineid+" เรียบร้อยแล้วครับ")
}

function clearcombo(elem){
 var i;
 for (i = elem.options.length - 1; i >= 0; i--) elem.options[i] = null;
 elem.selectedIndex = -1;
}
function populatelist2(elem, index){
 for (var i = 0; i < a[index].length; i= i + 2){
  elem.options[elem.options.length] = new Option(a[index][i + 1], a[index][i]);
 }
}
function clicklist(elem){
 clearcombo(document.f1.category)
 populatelist2(document.f1.category, elem[elem.selectedIndex].value);
 return true;
}
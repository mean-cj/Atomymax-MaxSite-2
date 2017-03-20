// ฟังก์ชั่นต่าง ๆ

function check1()
{
	var temp;
	var digit2="!#$%&'()*+,./:;<=>?@[\]^_`{|}~‘’ฯÛÜ฿ๆ๏๐๑๒๓๔๕๖๗๘๙๚๛üýþÿ";
	var digit3="!#$%&'()*+,./:;<=>?@[\]^_`{|}~‘’ฯÛÜ฿ๆ๏๐๑๒๓๔๕๖๗๘๙๚๛üýþÿกขฃคฆงจฉชซฌญดตฎฏฐตฒณถทธนบปผฝพฟภมยรลฤฦวศษสหฬอฮะา ิ ี ื ึ ุ ู โ ่ ้ ๊ ๋ ็ ์ ำ ไ เ แ ํ ใ ";
	var emailchars="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@._0123456789";
	var agechars="0123456789";
	var errmsg="";

	if(document.forms.webForm.first_name.value == "")
	{
		alert("กรุณาใส่ ชื่อของท่าน");
		return false;
	}

	if (document.webForm.first_name.value.length!=0){
				for (var i=0;i<document.webForm.first_name.value.length;i++) {
 temp=document.webForm.first_name.value.substring(i,i+1)
 if (digit2.indexOf(temp)!=-1) {
			errmsg="โปรดใส่ ชื่อของท่าน เป็นตัวอักษรภาษาอังกฤษ หรือ ตัวภาษาไทย และไม่ควรใช้สัญลักษณ์พิเศษต่าง ๆ ";
			alert(errmsg);
			return false;
 }
 }
	}
	
if(document.forms.webForm.last_name.value == "")
	{
		alert("กรุณาใส่ นามสกุลของท่าน");
		return false;
	}

	if (document.webForm.last_name.value.length!=0){
				for (var i=0;i<document.webForm.last_name.value.length;i++) {
 temp=document.webForm.last_name.value.substring(i,i+1)
 if (digit2.indexOf(temp)!=-1) {
			errmsg="โปรดใส่ นามสกุลของท่าน เป็นตัวอักษรภาษาอังกฤษ หรือ ตัวภาษาไทย และไม่ควรใช้สัญลักษณ์พิเศษต่าง ๆ ";
			alert(errmsg);
			return false;
 }
 }
	}

if(document.forms.webForm.nic_name.value == "")
	{
		alert("กรุณาใส่ ชื่อเล่นของท่าน");
		return false;
	}

	if (document.webForm.nic_name.value.length!=0){
				for (var i=0;i<document.webForm.nic_name.value.length;i++) {
 temp=document.webForm.nic_name.value.substring(i,i+1)
 if (digit2.indexOf(temp)!=-1) {
			errmsg="โปรดใส่ ชื่อเล่นของท่าน เป็นตัวอักษรภาษาอังกฤษ หรือ ตัวภาษาไทย และไม่ควรใช้สัญลักษณ์พิเศษต่าง ๆ ";
			alert(errmsg);
			return false;
 }
 }
	}
	
	if(document.forms.webForm.day.selectedIndex == 0)
	{
		alert("กรุณาเลือกวันเกิดของท่าน");
		return false;
	}
	
	if(document.forms.webForm.month.selectedIndex == 0)
	{
		alert("กรุณาเลือกเดือนเกิดของท่าน");
		return false;
	}
	
	if(document.forms.webForm.year.selectedIndex == 0)
	{
		alert("กรุณาเลือกปีเกิดของท่าน");
		return false;
	}
	
	if(document.forms.webForm.age.value == "")
	{
		alert("กรุณาใส่อายุ");
		return false;
	}
	
	 if (document.webForm.age.value.length != 0) { 
	 for (var i=0;i<document.webForm.age.value.length;i++) {
		 temp=document.webForm.age.value.substring(i,i+1)
			if (agechars.indexOf(temp)==-1) {
			errmsg="โปรดใส่ อายุ เป็นตัวเลข เท่านั้น!";
			alert(errmsg);
			return false;
 }
 }
 }
	
	if(document.forms.webForm.email.value == "")
	{
		alert("กรุณาใส่อีเมลล์");
		return false;
	}

	 if (document.webForm.email.value.length != 0) {
	 for (var i=0;i<document.webForm.email.value.length;i++) {
		 temp=document.webForm.email.value.substring(i,i+1)
			if (emailchars.indexOf(temp)==-1) {
				errmsg="โปรดใส่ อีเมลล์ เป็นภาษาอังกฤษ และไม่ควรใช้สัญลักษณ์พิเศษต่าง ๆ ";
				alert(errmsg);
				return false;
 }
 }
 }

	if(webForm.email.value.indexOf('@')==-1)
	{
 		alert("กรุณาใส่อีเมลล์ให้ถูกต้อง");
 	return false;
 		}
	if(webForm.email.value.indexOf('.')==-1)
	{
 		alert("กรุณาใส่อีเมลล์ให้ถูกต้อง");
 	return false;
 		}

	if(document.forms.webForm.province.selectedIndex == 0)
	{
		alert("กรุณาเลือกจังหวัดของท่าน");
		return false;
	}
	
	if(document.forms.webForm.comment.value == "")
	{
		alert("กรุณาใส่คำทักทายเพื่อน");
		return false;
	}

}

function showimage()
{
	document.images.icons.src=""+document.webForm.icon.options[document.webForm.icon.selectedIndex].value;
}
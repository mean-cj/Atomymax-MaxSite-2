// ¿Ñ§¡ìªÑè¹µèÒ§ æ

function check1()
{
if(document.getElementById('MPic').value!=""){
    var fty=new Array(".gif",".jpg",".jpeg",".png"); // ประเภทไฟล์ที่อนุญาตให้อัพโหลด  
        var a=document.webForm.MPic.value; //กำหนดค่าของไฟล์ใหกับตัวแปร a   
        var permiss=0; // เงื่อนไขไฟล์อนุญาต
        a=a.toLowerCase();   
        if(a !=""){
            for(i=0;i<fty.length;i++){ // วน Loop ตรวจสอบไฟล์ที่อนุญาต  
                if(a.lastIndexOf(fty[i])>=0){  // เงื่อนไขไฟล์ที่อนุญาต  
                    permiss=1;
                    break;
                }else{
                    continue;
                }
            } 
            if(permiss==0){
                    alert("รูปภาพต้องเป็นนามสกุลไฟล์ .jpg , .gif , .png เท่านั้นครับ !!!!");     
                document.getElementById('MPic').value="" ; 
                return false;              
            }        
        }    


	var temp;
	var digit2="!#$%&'()*+,./:;<=>?@[\]^_`{|}~‘’ÏÛÜßæïðñòóôõö÷øùúûüýþÿ";
	var digit3="!#$%&'()*+,./:;<=>?@[\]^_`{|}~‘’ÏÛÜßæïðñòóôõö÷øùúûüýþÿ¡¢£¤¦§¨©ª«¬­´µ®¯°µ²³¶·¸¹º»¼½¾¿ÀÁÂÃÅÄÆÇÈÉÊËÌÍÎÐÒ Ô Õ × Ö Ø Ù â è é ê ë ç ì Ó ä à á í ã ";
	var emailchars="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz@._0123456789";
	var agechars="0123456789";
	var errmsg="";

	if(document.forms.webForm.first_name.value == "")
	{
		alert("กรุณากรอกชื่อด้วยครับ");
		return false;
	}

	if (document.webForm.first_name.value.length!=0){
				for (var i=0;i<document.webForm.first_name.value.length;i++) {
 temp=document.webForm.first_name.value.substring(i,i+1)
 if (digit2.indexOf(temp)!=-1) {
			errmsg="ชื่อของท่านต้องไม่มีอักขระพิเศษ ครับ";
			alert(errmsg);
			return false;
 }
 }
	}
	
if(document.forms.webForm.last_name.value == "")
	{
		alert("กรุณากรอกนามสกุลด้วยครับ");
		return false;
	}

	if (document.webForm.last_name.value.length!=0){
				for (var i=0;i<document.webForm.last_name.value.length;i++) {
 temp=document.webForm.last_name.value.substring(i,i+1)
 if (digit2.indexOf(temp)!=-1) {
			errmsg="นามสกุล ของท่านต้องไม่มีอักขระพิเศษ ครับ";
			alert(errmsg);
			return false;
 }
 }
	}

if(document.forms.webForm.nic_name.value == "")
	{
		alert("กรอกชื่อเล่นด้วยครับ");
		return false;
	}

	if (document.webForm.nic_name.value.length!=0){
				for (var i=0;i<document.webForm.nic_name.value.length;i++) {
 temp=document.webForm.nic_name.value.substring(i,i+1)
 if (digit2.indexOf(temp)!=-1) {
			errmsg="ชื่อเล่นต้องไม่มีอักขระพิเศษครับ";
			alert(errmsg);
			return false;
 }
 }
	}
	
	if(document.forms.webForm.day.selectedIndex == 0)
	{
		alert("กรุณากรอกวันเกิดด้วยครับ");
		return false;
	}
	
	if(document.forms.webForm.month.selectedIndex == 0)
	{
		alert("กรุณากรอกเดือนเกิดด้วยครับ");
		return false;
	}
	
	if(document.forms.webForm.year.selectedIndex == 0)
	{
		alert("กรุณากรอกปีเกิดด้วยครับ");
		return false;
	}
	
	if(document.forms.webForm.age.value == "")
	{
		alert("กรุณากรอกอายุของท่านด้วยครับ");
		return false;
	}
	
	 if (document.webForm.age.value.length != 0) { 
	 for (var i=0;i<document.webForm.age.value.length;i++) {
		 temp=document.webForm.age.value.substring(i,i+1)
			if (agechars.indexOf(temp)==-1) {
			errmsg="อายุของท่านไม่ถูกต้อง";
			alert(errmsg);
			return false;
 }
 }
 }
	
	if(document.forms.webForm.email.value == "")
	{
		alert("กรุณากรอก email ด้วยครับ");
		return false;
	}

	 if (document.webForm.email.value.length != 0) {
	 for (var i=0;i<document.webForm.email.value.length;i++) {
		 temp=document.webForm.email.value.substring(i,i+1)
			if (emailchars.indexOf(temp)==-1) {
				errmsg="รูปแบบ email ไม่ถูกต้องครับ";
				alert(errmsg);
				return false;
 }
 }
 }

	if(webForm.email.value.indexOf('@')==-1)
	{
 		alert("รูปแบบ email ไม่ถูกต้องครับ");
 	return false;
 		}
	if(webForm.email.value.indexOf('.')==-1)
	{
 		alert("รูปแบบ email ไม่ถูกต้องครับ");
 	return false;
 		}

	if(document.forms.webForm.province.selectedIndex == 0)
	{
		alert("กรุณาเลือกจังหวัดด้วยครับ");
		return false;
	}
	
//	if(document.forms.webForm.comment.value == "")
//	{
//		alert("ช่วยกรอกข้อมูลการทักทายเพื่อนด้วยครับ");
//		return false;
//	}

}
}

function showimage()
{
	document.images.icons.src=""+document.webForm.icon.options[document.webForm.icon.selectedIndex].value;
}
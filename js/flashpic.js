//var url = window.location.href;
//var url = String(window.location);
var url = './';
var pic_width=520; //ความกว้าง
var pic_height=200; //ความสูง
var button_pos=6; //จำนวนภาพ
var stop_time=5000; 
var show_text=0; 
var txtcolor="000000"; //สีตัวอักษร
var bgcolor="fffff"; //สีพื้นหลัง
var imag=new Array();
var link=new Array();
var text=new Array();


imag[1]=""+url+"/images/random/wat1.jpg";//รูปป้ายโฆษณาที่ 1
link[1]=""+url+"/images/random/wat1.jpg";//Link ที่ต้องการไปหา เมื่อ คลิก
text[1]="รูปภาพที่ 1";//คำอธิบายใต้ภาพ

imag[2]=""+url+"/images/random/wat2.jpg";//รูปป้ายโฆษณาที่ 2
link[2]=""+url+"/images/random/wat2.jpg";//Link ที่ต้องการไปหา เมื่อ คลิก
text[2]="รูปภาพที่ 2";//คำอธิบายใต้ภาพ

imag[3]=""+url+"/images/random/wat3.jpg";//รูปป้ายโฆษณาที่ 3
link[3]=""+url+"/images/random/wat3.jpg";//Link ที่ต้องการไปหา เมื่อ คลิก
text[3]="รูปภาพที่ 3";//คำอธิบายใต้ภาพ

imag[4]=""+url+"/images/random/wat4.jpg";//รูปป้ายโฆษณาที่ 4
link[4]=""+url+"/images/random/wat4.jpg";//Link ที่ต้องการไปหา เมื่อ คลิก
text[4]="รูปภาพที่ 4";//คำอธิบายใต้ภาพ

imag[5]=""+url+"/images/random/wat5.jpg";//รูปป้ายโฆษณาที่ 5
link[5]=""+url+"/images/random/wat5.jpg";//Link ที่ต้องการไปหา เมื่อ คลิก
text[5]="รูปภาพที่ 5";//คำอธิบายใต้ภาพ

imag[6]=""+url+"/images/random/wat6.jpg";//รูปป้ายโฆษณาที่ 6
link[6]=""+url+"/images/random/wat6.jpg";//Link ที่ต้องการไปหา เมื่อ คลิก
text[6]="รูปภาพที่ 6";//คำอธิบายใต้ภาพ


var swf_height=show_text==1?pic_height+20:pic_height;
var pics="", links="", texts="";
for(var i=1; i<imag.length; i++){
        pics=pics+("|"+imag[i]);
        links=links+("|"+link[i]);
        texts=texts+("|"+text[i]);
}
pics=pics.substring(1);
links=links.substring(1);
texts=texts.substring(1);
document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cabversion=6,0,0,0" width="'+ pic_width +'" height="'+ swf_height +'">');
document.write('<param name="movie" value="'+url+'/modules/randomimg/focus.swf">');//ที่อยู่ flash
document.write('<param name="quality" value="high"><param name="wmode" value="opaque">');
document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&pic_width='+pic_width+'&pic_height='+pic_height+'&show_text='+show_text+'&txtcolor='+txtcolor+'&bgcolor='+bgcolor+'&button_pos='+button_pos+'&stop_time='+stop_time+'">');
document.write('<embed src="'+url+'/modules/randomimg/focus.swf" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&pic_width='+pic_width+'&pic_height='+pic_height+'&show_text='+show_text+'&txtcolor='+txtcolor+'&bgcolor='+bgcolor+'&button_pos='+button_pos+'&stop_time='+stop_time+'" quality="high" width="'+ pic_width +'" height="'+ swf_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
document.write('</object>');

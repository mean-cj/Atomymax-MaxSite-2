<?php
//require_once('mainfile.php');
//require_once("includes/html2pdf/setPDF.php");
require_once('mainfile.php');
ob_end_clean();
$_GET['id'] = intval($_GET['id']);
//แสดงข่าวสาร/ประชาสัมพันธ์ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
if ($mo=='news'){
$res['pdf'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE id='".$_GET['id']."' ");
$arr['pdf'] = $db->fetch($res['pdf']);
$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." WHERE id='".$arr['pdf']['category']."' "); 
$arr['category'] = $db->fetch($res['category']);
} else if ($mo=='knowledge'){
$res['pdf'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE." WHERE id='".$_GET['id']."' ");
$arr['pdf'] = $db->fetch($res['pdf']);
$res['category'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE_CAT." WHERE id='".$arr['pdf']['category']."' "); 
$arr['category'] = $db->fetch($res['category']);
} else if ($mo=='blog'){
$res['pdf'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE id='".$_GET['id']."' ");
$arr['pdf'] = $db->fetch($res['pdf']);
$res['category'] = $db->select_query("SELECT * FROM ".TB_BLOG_CAT." WHERE id='".$arr['pdf']['category']."' "); 
$arr['category'] = $db->fetch($res['category']);
}
$db->closedb ();
$cat=''._PDF_CAT.' : '.$arr['category']['category_name'].'<br>';
$titles=''._PDF_TOPIC.' : '.stripslashes(FixQuotes($arr['pdf']['topic'])).'<br>';
$authors=''._FORM_MOD_POSTED.' : '.$arr['pdf']['posted'].'<br>';
$da= ThaiTimeConvert($arr['pdf']['post_date'],"1","");
$dates=''._FORM_MOD_POSTDATE.' '.$da.'<br>';
$view=''._DETAIL_PRIVIEW.'  : '.$arr['pdf']['pageview'].'<br>';
if ($arr['pdf']['pic']==1){
	if($mo=='blog'){
	$imagex='<img  src=icon/'.$mo.'_'.$arr['pdf']['post_date'].'_'.$arr['pdf']['posted'].'.jpg><br>';
	}else {
	$imagex='<img  src=icon/'.$mo.'_'.$arr['pdf']['post_date'].'.jpg><br>';
	}

	} else {
	$imagex='<img src=images/icon/'.$arr['category']['icon'].'><br>';
	}
$sum=''.$imagex.''.$cat.''.$titles.''.$authors.''.$dates.''.$view.'';


require_once('includes/html2pdf/config/lang/eng.php');
require_once('includes/html2pdf/tcpdf.php');
require_once('includes/html2pdf/htmltoolkit.php');
// ค่าเริ่มต้นต่างๆ สามารถเข้าไปกำหนดได้ที่ไฟล์ tcpdf_config.php ในโฟลเดอร์ config
// สร้าง PDF document ใหม่
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// กำหนดรายละเอียดของเอกสาร pdf แสดงเมื่อคลิกขวาที่ไฟล์ PDF แล้วเลือก Document Property
$pdf->SetCreator(PDF_CREATOR); // เครื่องมือสร้าง PDF  ค่าเริ่ม PDF_CREATOR = TCPDF
$pdf->SetAuthor(''._PDF_AUTH.' : '.$arr['pdf']['posted'].''); // ชื่อผู้สร้างไฟล์ PDF
$pdf->SetTitle(''._PDF_CAT.' : '.$arr['category']['category_name'].'');//  กำหนด Title
$pdf->SetSubject(''._PDF_TOPIC.' : '.$arr['pdf']['topic'].''); // กำหนด Subject
$pdf->SetKeywords('TCPDF, PDF, USING HTML 2 PDF'); // กำหนด Keyword

//   กำหนดค่าเริ่มต้นสำหรับ Header
//	PDF_HEADER_LOGO  โลโก้รูปภาพส่วน Header
//	PDF_HEADER_LOGO_WIDTH ความกว้างของโลโก้ เป็น มิลเมตร (mm)
//	PDF_HEADER_TITLE หัวเรื่องของ Header
//	PDF_HEADER_STRING ข้อความที่ต้องการแสดงในส่วน header ขึ้นบรรทัดใหม่ใช้ \n
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// กำหนดค่าเริ่มต้น Font สำหรับช่องว่าง
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//ตั้งค่าหน้ากระดาษ
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//กำหนดการแบ่งหน้าอัตโนมัติ
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// กำหนดอัดราส่วนของรูปภาพ
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 

// กำหนดกลุ่มภาษา
$pdf->setLanguageArray($l); 

// กำหนด Font กรณีใช้ภาษาไทยใช้ freeserif
$pdf->SetFont('freeserif', '', 10);


$pdf->AddPage();

// กำหนด HTML code หรือรับค่าจากตัวแปรที่ส่งมา
//	กรณีกำหนดโดยตรง
//	ตัวอย่าง กรณีรับจากตัวแปร



$thepage = $arr['pdf']['detail'];
$Detail = stripslashes(FixQuotes($thepage));
$xxx=''.$sum.''.$Detail.'';
if(ISO =='utf-8'){
$Detailss=$xxx;
} else {
$Detailss=iconv("TIS-620","UTF-8",$xxx);
}
 $htmlcontent =$Detailss;
//$htmlcontent='<p>ทดสอบ</p>';
$htmlcontent=stripslashes($htmlcontent);
$htmlcontent=AdjustHTML($htmlcontent);

// สร้างเนื้อหาจาก  HTML code
$pdf->writeHTML($htmlcontent, true, 0, true, 0);

// เลื่อน pointer ไปหน้าสุดท้าย
$pdf->lastPage();

// ปิดและสร้างเอกสาร PDF
$pdf->Output('createpdf.pdf', 'I');

?>
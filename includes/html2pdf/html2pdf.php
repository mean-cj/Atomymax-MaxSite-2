<?php
require_once("setPDF.php");
// เพิ่มหน้าใน PDF 
$pdf->AddPage();

// กำหนด HTML code หรือรับค่าจากตัวแปรที่ส่งมา
//	กรณีกำหนดโดยตรง
//	ตัวอย่าง กรณีรับจากตัวแปร
// $htmlcontent =$_POST['HTMLcode'];
$htmlcontent='<p>ทดสอบ</p>';
$htmlcontent=stripslashes($htmlcontent);
$htmlcontent=AdjustHTML($htmlcontent);

// สร้างเนื้อหาจาก  HTML code
$pdf->writeHTML($htmlcontent, true, 0, true, 0);

// เลื่อน pointer ไปหน้าสุดท้าย
$pdf->lastPage();

// ปิดและสร้างเอกสาร PDF
$pdf->Output('test.pdf', 'I');
?>
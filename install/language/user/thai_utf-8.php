<?php
/**
* @version $Id: thai.php,v 1.2 2006/01/04 04:44:09 laithaidev Exp $
* @package Mambo LaiThai Project
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
//defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// Language and Encode of frontend language
DEFINE('_LANGUAGE','th');
DEFINE('_ISO','charset=tis-620');

/** common */
DEFINE('_NOT_AUTH','ขออภัยข้อมูลส่วนนี้สำหรับสมาชิกเท่านั้น');
DEFINE('_DO_LOGIN','คุณต้องการ ล็อกอิน เข้าใช้งาน ?');
DEFINE('_VALID_AZ09',"กรุณาใส่ข้อมูล %s.  ห้ามใช้ช่องว่าง (space), จำนวนไม่ต่ำกว่า %d ตัวอักษร และเป็นอักษร 0-9,a-z,A-Z");
DEFINE('_CMN_YES',' ใช่ ');
DEFINE('_CMN_NO',' ไม่ ');
DEFINE('_CMN_SHOW',' แสดง ');
DEFINE('_CMN_HIDE',' ซ่อน ');

DEFINE('_CMN_NAME','ชื่อ');
DEFINE('_CMN_DESCRIPTION','รายละเอียด');
DEFINE('_CMN_SAVE','บันทึก');
DEFINE('_CMN_CANCEL','ยกเลิก');
DEFINE('_CMN_PRINT','พิมพ์');
DEFINE('_CMN_PDF','PDF');
DEFINE('_CMN_EMAIL','ส่งเมล');
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','มาจาก');
DEFINE('_CMN_ORDERING','ลำดับการเรียง');
DEFINE('_CMN_ACCESS','สิทธิในการเข้าถึง');
DEFINE('_CMN_SELECT','เลือก');

DEFINE('_CMN_NEXT','ต่อไป');
DEFINE('_CMN_NEXT_ARROW'," &gt;&gt;");
DEFINE('_CMN_PREV','ย้อนกลับ');
DEFINE('_CMN_PREV_ARROW',"&lt;&lt; ");

DEFINE('_CMN_SORT_NONE','ไม่ เรียงลำดับ');
DEFINE('_CMN_SORT_ASC','เรียงจากน้อยไปมาก');
DEFINE('_CMN_SORT_DESC','เรียงจากมากมาน้อย');

DEFINE('_CMN_NEW','ใหม่');
DEFINE('_CMN_NONE','None');
DEFINE('_CMN_LEFT','Left');
DEFINE('_CMN_RIGHT','Right');
DEFINE('_CMN_CENTER','Center');
DEFINE('_CMN_ARCHIVE','เอกสารสำคัญ');
DEFINE('_CMN_UNARCHIVE','ยกเลิกเอกสารสำคัญ');
DEFINE('_CMN_TOP','บน');
DEFINE('_CMN_BOTTOM','ล่าง');

DEFINE('_CMN_PUBLISHED','เผยแพร่');
DEFINE('_CMN_UNPUBLISHED','งดเผยแพร่');

DEFINE('_CMN_EDIT_HTML','แก้ไข HTML');
DEFINE('_CMN_EDIT_CSS','แก้ไข CSS');

DEFINE('_CMN_DELETE','ลบ');

DEFINE('_CMN_FOLDER','โฟลเดอร์');
DEFINE('_CMN_SUBFOLDER','โฟลเดอร์ย่อย');
DEFINE('_CMN_OPTIONAL','ข้อกำหนดเพิ่มเติม');
DEFINE('_CMN_REQUIRED','จำเป็นต้องกรอก');

DEFINE('_CMN_CONTINUE','ต่อไป');

DEFINE('_CMN_NEW_ITEM_LAST','ข้อมูลใหม่อยู่หลัง');
DEFINE('_CMN_NEW_ITEM_FIRST','ข้อมูลใหม่มาก่อน');
DEFINE('_LOGIN_INCOMPLETE','กรุณาใส่ข้อมูลผู้ใช้และรหัสผ่านให้ครบถ้วน');
DEFINE('_LOGIN_BLOCKED','ล็อกอินของคุณ ถูกระงับการใช้งาน. กรุณาติดต่อผู้ดูแลระบบ');
DEFINE('_LOGIN_INCORRECT','ชื่อผู้ใช้หรือรหัสผ่าน ไม่ถูกต้อง  กรุณาลองใหม่');
DEFINE('_LOGIN_NOADMINS','คุณไม่สามารถล็อกอิน ได้  เนื่องจากผู้ดูแลระบบ ยังไม่ได้จัดเตรียมข้อมูลไว้');
DEFINE('_CMN_JAVASCRIPT','!คำเตือน! จาวาสคริป ไม่ได้เปิดใช้งาน');

DEFINE('_NEW_MESSAGE','มีข้อความใหม่ส่งถึงคุณ');
DEFINE('_MESSAGE_FAILED','ข้อความไม่สามารถส่งได้เนื่องจาก User ไม่ได้เปิดใช้งานเมลบ๊อกซ์');

DEFINE('_CMN_IFRAMES', 'เบราเซอร์ของคุณไม่สามารถแสดงแฟรมได้');

DEFINE('_INSTALL_WARN','เพื่อความปลอดภัยกรุณาลบโฟลเดอร์ และไฟล์ ในโฟลเดอร์ Installlation ออกก่อน');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><b>ไฟล์เทมเพลตมีปัญหากรุณาลองใหม่:</b></font>');
DEFINE('_NO_PARAMS','ไม่ได้ตั้งค่า พารามิเตอร์ สำหรับไอเทม');
DEFINE('_HANDLER','ผู้ดูแลไม่ได้กำหนดสำหรับชนิดนี้');

/** mambots */
DEFINE('_TOC_JUMPTO','ดัชนี บทความ');

/**  content */
DEFINE('_READ_MORE','อ่านข้อมูลเพิ่มเติม...');
DEFINE('_READ_MORE_REGISTER','ลงทะเบียน เพื่ออ่านข้อมูลได้มากขึ้น...');
DEFINE('_MORE','ข้อมูลเพิ่มเติม...');
DEFINE('_ON_NEW_CONTENT', "มี คอนเท้นท์ใหม่ ส่งมา โดย [ %s ]  หัวข้อ [ %s ]  จาก section [ %s ]  และ category  [ %s ]" );
DEFINE('_SEL_CATEGORY','- เลือก ประเภท -');
DEFINE('_SEL_SECTION','- เลือก หมวดหมู่ -');
DEFINE('_SEL_AUTHOR','- เลือก ผู้แต่ง -');
DEFINE('_SEL_POSITION','- เลือก ตำแหน่ง -');
DEFINE('_SEL_TYPE','- เลือก ชนิด -');
DEFINE('_EMPTY_CATEGORY',' ไม่มีบทความใน ประเภทนี้ ');
DEFINE('_EMPTY_BLOG','ไม่มีบทความ');
DEFINE('_NOT_EXIST','ไม่พบหน้าที่คุณพยายามเรียกดู <br />กรุณาเลือกหน้าข้อมูลจากเมนูหลัก');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','ลงคะแนน');
DEFINE('_BUTTON_RESULTS','ผลลัพธ์');
DEFINE('_USERNAME','ชื่อผู้ใช้');
DEFINE('_LOST_PASSWORD','ลืมรหัสผ่าน?');
DEFINE('_PASSWORD','รหัสผ่าน');
DEFINE('_BUTTON_LOGIN','เข้าสู่ระบบ');
DEFINE('_BUTTON_LOGOUT','ออกจากระบบ');
DEFINE('_NO_ACCOUNT','ยังไม่ได้ลงทะเบียน?');
DEFINE('_CREATE_ACCOUNT','ลงทะเบียนใหม่');
DEFINE('_VOTE_POOR','แย่จัง');
DEFINE('_VOTE_BEST','ดีมาก');
DEFINE('_USER_RATING','ระดับผู้ใช้');
DEFINE('_RATE_BUTTON','ให้คะแนน');
DEFINE('_REMEMBER_ME','จำข้อมูลการล็อกอิน');

/** contact.php */
DEFINE('_ENQUIRY','ติดต่อ/สอบถาม');
DEFINE('_ENQUIRY_TEXT','นี่คืออีเมลข้อความ (ติดต่อ/สอบถาม) จาก');
DEFINE('_COPY_TEXT','นี้คือสำเนาข้อความของคุณที่ส่งถึงผู้ดูแล %s');
DEFINE('_COPY_SUBJECT','คัดลอกจาก: ');
DEFINE('_THANK_MESSAGE','ขอบคุณสำหรับ ข้อความของคุณ');
DEFINE('_CLOAKING','อีเมลนี้จะถูกป้องกันจากสแปมบอท แต่คุณต้องเปิดการใช้งานจาวาสคริปก่อน');
DEFINE('_CONTACT_HEADER_NAME','ชื่อ');
DEFINE('_CONTACT_HEADER_POS','ตำแหน่ง');
DEFINE('_CONTACT_HEADER_EMAIL','อีเมล');
DEFINE('_CONTACT_HEADER_PHONE','โทรศัพท์');
DEFINE('_CONTACT_HEADER_FAX','โทรสาร');
DEFINE('_CONTACTS_DESC','รายการติดต่อสำหรับเว็บไชต์.');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','ติดต่อ/สอบถาม');
DEFINE('_EMAIL_DESCRIPTION','ส่งขอความหาเราได้ที่นี้:');
DEFINE('_NAME_PROMPT',' กรุณาใส่ชื่อคุณ:');
DEFINE('_EMAIL_PROMPT',' กรุณาใส่อีเมลของคุณ:');
DEFINE('_MESSAGE_PROMPT',' ข้อความที่ต้องการติดต่อ:');
DEFINE('_SEND_BUTTON','ส่งข้อความ');
DEFINE('_CONTACT_FORM_NC','กรุณาตรวจสอบความถูกต้องของข้อมูลทั้งหมด.');
DEFINE('_CONTACT_TELEPHONE','เบอร์โทรศัพท์: ');
DEFINE('_CONTACT_MOBILE','มือถือ: ');
DEFINE('_CONTACT_FAX','โทรสาร: ');
DEFINE('_CONTACT_EMAIL','อีเมล: ');
DEFINE('_CONTACT_NAME','ชื่อ: ');
DEFINE('_CONTACT_POSITION','ตำเหน่ง: ');
DEFINE('_CONTACT_ADDRESS','บ้านเลขที่: ');
DEFINE('_CONTACT_MISC','ข้อมูลเพิ่มเติม: ');
DEFINE('_CONTACT_SEL','ต้องการติดต่อกับ:');
DEFINE('_CONTACT_NONE','ไม่มีรายละเอียดการติดต่อ.');
DEFINE('_EMAIL_A_COPY','สำเนาข้อความนี้ไปยังอีเมลคุณ');
DEFINE('_CONTACT_DOWNLOAD_AS','ดาวโหลดข้อมูลเป็น');
DEFINE('_VCARD','วีการ์ด');

/** pageNavigation */
DEFINE('_PN_PAGE','หน้า');
DEFINE('_PN_OF','จาก');
DEFINE('_PN_START','หน้าแรก');
DEFINE('_PN_PREVIOUS','ย้อนกลับ');
DEFINE('_PN_NEXT','หน้าถัดไป');
DEFINE('_PN_END','หน้าสุดท้าย');
DEFINE('_PN_DISPLAY_NR','แสดง  #');
DEFINE('_PN_RESULTS','ผลลัพธ์');

/** emailfriend */
DEFINE('_EMAIL_TITLE','อีเมลให้เพื่อน');
DEFINE('_EMAIL_FRIEND','ส่งอีเมลข้อมูลนี้ให้เพื่อน.');
DEFINE('_EMAIL_FRIEND_ADDR',"อีเมลของเพื่อนคุณ:");
DEFINE('_EMAIL_YOUR_NAME','ชื่อของคุณ:');
DEFINE('_EMAIL_YOUR_MAIL','อีเมลของคุณ:');
DEFINE('_SUBJECT_PROMPT',' หัวข้อ:');
DEFINE('_BUTTON_SUBMIT_MAIL','ส่งอีเมล');
DEFINE('_BUTTON_CANCEL','ยกเลิก');
DEFINE('_EMAIL_ERR_NOINFO','กรุณาใส่อีเมลที่ถูกต้องของคุณรวมทั้งอีเมลของเพื่อนที่ต้องการส่ง');
DEFINE('_EMAIL_MSG',' ข้อมูลที่คุณได้รับจากเว็บ "%s" ได้ถูกส่งมาให้คุณโดย %s ( %s ).

You can access it at the following url: 
%s');
DEFINE('_EMAIL_INFO','ข้อมูลนี้จัดส่งโดย');
DEFINE('_EMAIL_SENT','ข้อมูลนี้ได้จัดส่งไปยัง');
DEFINE('_PROMPT_CLOSE','ปิดหน้าต่างนี้');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', 'เขียนโดย');
DEFINE('_WRITTEN_BY', 'เขียนโดย');
DEFINE('_LAST_UPDATED', 'แก้ไขล่าสุดเมื่อ');
DEFINE('_BACK','[ ย้อนกลับ ]');
DEFINE('_LEGEND','คำบรรยาย');
DEFINE('_DATE','วันที่');
DEFINE('_ORDER_DROPDOWN','การเรียงลำดับ');
DEFINE('_HEADER_TITLE','ชื่อเรื่อง');
DEFINE('_HEADER_AUTHOR','ผู้เขียน');
DEFINE('_HEADER_SUBMITTED','เขียนเมื่อ');
DEFINE('_HEADER_HITS','ผู้ชม');
DEFINE('_E_EDIT','แก้ไข');
DEFINE('_E_ADD','เพิ่ม');
DEFINE('_E_WARNUSER','กรุณาเลือกว่าจะ ยกเลิก หรือ บันทึก สิ่งที่กำลังแก้ไขอยู่');
DEFINE('_E_WARNTITLE','กรุณาใส่ ชื่อเรื่องด้วยครับ');
DEFINE('_E_WARNTEXT','กรุณาใส่ข้อความเกริ่นนำเรื่องด้วยครับ');
DEFINE('_E_WARNCAT','กรุณาเลือกประเภทรายการ ');
DEFINE('_E_CONTENT','เนื้อหา');
DEFINE('_E_TITLE','ชื่อเรื่อง:');
DEFINE('_E_CATEGORY','ประเภท:');
DEFINE('_E_INTRO','่ข้อความเกริ่นนำ');
DEFINE('_E_MAIN','เนื้อหาหลัก');
DEFINE('_E_MOSIMAGE','ใส่ {mosimage}');
DEFINE('_E_IMAGES','รูปภาพ');
DEFINE('_E_GALLERY_IMAGES','แฟ้มรูปภาพ');
DEFINE('_E_CONTENT_IMAGES','รูปภาพบทความ');
DEFINE('_E_EDIT_IMAGE','แก้ไขรูปภาพ');
DEFINE('_E_INSERT','แทรก');
DEFINE('_E_UP','ขึ้น');
DEFINE('_E_DOWN','ลง');
DEFINE('_E_REMOVE','เอาออก');
DEFINE('_E_SOURCE','ซอร์ส:');
DEFINE('_E_ALIGN','ตำแหน่งข้อความ:');
DEFINE('_E_ALT','ข้อความอธิบายภาพ:');
DEFINE('_E_BORDER','กรอบ:');
DEFINE('_E_CAPTION','คำบรรยายภาพ');
DEFINE('_E_APPLY','ใช้งาน');
DEFINE('_E_PUBLISHING','เผยแพร');
DEFINE('_E_STATE','สถานะ:');
DEFINE('_E_AUTHOR_ALIAS','ชื่อผู้เขียน:');
DEFINE('_E_ACCESS_LEVEL','ระดับการเข้าถึง:');
DEFINE('_E_ORDERING','การจัดเรียง:');
DEFINE('_E_START_PUB','เริ่มเผยแพร่ตั้งแต่วันที่:');
DEFINE('_E_FINISH_PUB','สิ้นสุดวันที่:');
DEFINE('_E_SHOW_FP','แสดงที่หน้าแรก:');
DEFINE('_E_HIDE_TITLE','ซ่อนชื่อเรื่อง:');
DEFINE('_E_METADATA','เมตาดาต้า');
DEFINE('_E_M_DESC','คำอธิบาย:');
DEFINE('_E_M_KEY','คำที่ใช้ในการค้นหา:');
DEFINE('_E_SUBJECT','หัวข้อ:');
DEFINE('_E_EXPIRES','วันหมดอายุ:');
DEFINE('_E_VERSION','เวอร์ชั่น:');
DEFINE('_E_ABOUT','เกี่ยวกับ');
DEFINE('_E_CREATED','เขียนเมื่อ:');
DEFINE('_E_LAST_MOD','แก้ไขล่าสุดเมื่อ:');
DEFINE('_E_HITS','ผู้ชม:');
DEFINE('_E_SAVE','บันทึก');
DEFINE('_E_CANCEL','ยกเลิก');
DEFINE('_E_REGISTERED','เฉพาะสมาชิกเท่านั้น');
DEFINE('_E_ITEM_INFO','รายละเอียดเกี่ยวกับรายการ');
DEFINE('_E_ITEM_SAVED','บันทึกรายการเรียบร้อยแล้ว.');
DEFINE('_ITEM_PREVIOUS','&lt; ก่อนหน้า');
DEFINE('_ITEM_NEXT','ถัดไป &gt;');


/** content.php */
DEFINE('_SECTION_ARCHIVE_EMPTY','ไม่มีเอกสารสำคัญในหมวดหมู่นี้กรุณาลองอีกครั้ง');
DEFINE('_CATEGORY_ARCHIVE_EMPTY','ไม่มีเอกสารสำคัญในประเภทนี้กรุณาลองอีกครั้ง');
DEFINE('_HEADER_SECTION_ARCHIVE','หมวดหมู่ เอกสารสำคัญ');
DEFINE('_HEADER_CATEGORY_ARCHIVE','ประเภท เอกสารสำคัญ');
DEFINE('_ARCHIVE_SEARCH_FAILURE','ไม่มีเอกสารสำคัญใน %s %s');	// values are month then year
DEFINE('_ARCHIVE_SEARCH_SUCCESS','มีเอกสารสำคัญใน %s %s');	// values are month then year
DEFINE('_FILTER','หาคำ');
DEFINE('_ORDER_DROPDOWN_DA','วันที่ เก่าก่อน');
DEFINE('_ORDER_DROPDOWN_DD','วันที่ ใหม่ก่อน');
DEFINE('_ORDER_DROPDOWN_TA','หัวข้อ เก่าก่อน');
DEFINE('_ORDER_DROPDOWN_TD','หัวข้อ ใหม่ก่อน');
DEFINE('_ORDER_DROPDOWN_HA','ผู้ชม เก่าก่อน');
DEFINE('_ORDER_DROPDOWN_HD','ผู้ชม ใหม่ก่อน');
DEFINE('_ORDER_DROPDOWN_AUA','ผู้เขียน เก่าก่อน');
DEFINE('_ORDER_DROPDOWN_AUD','ผู้เขียน ใหม่ก่อน');
DEFINE('_ORDER_DROPDOWN_O','การจัดเรียง');

/** poll.php */
DEFINE('_ALERT_ENABLED','คุณต้องกำหนดให้ Cookies ทำงานด้วย!');
DEFINE('_ALREADY_VOTE','คุณได้ลงคะแนนไปแล้วสำหรับแบบสำรวจวันนี้!');
DEFINE('_NO_SELECTION','คุยยังไม่ได้เลือกตัวเลือกที่ให้มา โปรดเลือกอีกครั้ง');
DEFINE('_THANKS','ขอบคุณสำหรับการลงคะแนน!');
DEFINE('_SELECT_POLL','เลือกรายการแบบสำรวจ');

/** classes/html/poll.php */
DEFINE('_JAN','มกราคม');
DEFINE('_FEB','กุมภาพันธ์');
DEFINE('_MAR','มีนาคม');
DEFINE('_APR','เมษายน');
DEFINE('_MAY','พฤษภาคม');
DEFINE('_JUN','มิถุนายน');
DEFINE('_JUL','กรกฏาคม');
DEFINE('_AUG','สิงหาคม');
DEFINE('_SEP','กันยายน');
DEFINE('_OCT','ตุลาคม');
DEFINE('_NOV','พฤษจิกายน');
DEFINE('_DEC','ธันวาคม');
DEFINE('_POLL_TITLE','ผลการลงคะแนน');
DEFINE('_SURVEY_TITLE','หัวข้อแบบสำรวจ:');
DEFINE('_NUM_VOTERS','จำนวนผู้ลงคะแนน');
DEFINE('_FIRST_VOTE','ลงคะแนนครั้งแรก');
DEFINE('_LAST_VOTE','ลงคะแนนครั้งล่าสุด');
DEFINE('_SEL_POLL','เลือก โพล:');
DEFINE('_NO_RESULTS','ยังไม่มีผลลัพธ์สำหรับโพลนี้.');

/** registration.php */
DEFINE('_ERROR_PASS','ขออภัย, ไม่พบผู้ใช้นี้ในทะเบียน');
DEFINE('_NEWPASS_MSG','สมาชิกที่ใช้ชื่อ $checkusername ในการสมัครเป็นสมาชิก\n'
.'ของเว็บ $mosConfig_live_site ได้ลืมรหัสในการล็อกอินและได้ขอให้จัดส่งรหัสผ่านใหม่\n\n'
.' รหัสใหม่ของคุณคือ: $newpass\n\nหากคุณไม่ได้ขอให้ระบบจัดส่งอีเมลนี้มาให้\ไม่ต้องเป็นกังวล.'
.' เพราะรหัสผ่านจะถูกส่งมาทางอีเมลของคุณเท่านั้น จะไม่มีคนอื่นทราบ'
.' คุณสามารถใช้ รหัสผ่านนี้ล็อกอิน และเปลี่ยนเป็นรหัสที่คุณต้องการได้เอง.');
DEFINE('_NEWPASS_SUB','$_sitename :: รหัสประจำตัวสำหรับ - $checkusername');
DEFINE('_NEWPASS_SENT','รหัสใหม่ได้บันทึกและถูกส่งไปแล้ว!');
DEFINE('_REGWARN_NAME','กรุณาใส่ชื่อ  ของคุณ');
DEFINE('_REGWARN_UNAME','กรุณาใส่ชื่อสำหรับล็อกอิน');
DEFINE('_REGWARN_MAIL','กรุณาใส่อีเมลของคุณ');
DEFINE('_REGWARN_PASS','ใส่รหัสผ่านไม่ต้องเว้นวรรค, ตัวอักษรต้องมากกว่า 6 ตัว และเป็นอักษร 0-9,a-z,A-Z');
DEFINE('_REGWARN_VPASS1','ยืนยันรหัสผ่านอีกครั้ง');
DEFINE('_REGWARN_VPASS2','คุณใส่รหัส 2 ครั้งไม่เหมือนกัน, กรุณาใส่อีกครั้ง');
DEFINE('_REGWARN_INUSE','ชื่อนี้ได้ถูกใช้งานแล้ว. โปรดใช้ชื่ออื่น');
DEFINE('_REGWARN_EMAIL_INUSE', 'อีเมลนี้ได้ลงทะเบียนแล้ว ถ้าคุณลืมรหัสผ่านคลิ๊ก "ลืมรหัสผ่าน" เราจะส่งรหัสผ่านใหม่ให้คุณ');
DEFINE('_SEND_SUB','รายละเอียดสมาชิกใหม่ %s ใน %s');
DEFINE('_USEND_MSG_ACTIVATE', 'สวัสดีคุณ %s,

ขอบคุณที่สมัครสมาชิก %s. คุณสามารถเข้าใช้งานได้ทันทีที่คุณยืนยัน
หากต้องการยืนยัน คลิ๊ก link หรือ copy แล้ววาง ในช่อง address ในเบราซ์เซอร์ของคุณ:
%s

หลังจากยืนยันแล้วกรุณาล็อกอินเข้าสู่ %s โดยใช้ ชื่อผู้ใช้ และรหัสผ่านตามนี้:

ชื่อผู้ใช้ - %s
รหัสผ่าน - %s');
DEFINE('_USEND_MSG', "สวัสดีคุณ %s,

ขอบคุณที่สมัครสมาชิก %s.

คุณสามารถล็อกอินเข้าใช้งาน %s ด้วย ชื่อผู้ใช้ และ รหัสผ่าน ที่คุณได้ลงทะเบียนไว้ ");
DEFINE('_USEND_MSG_NOPASS','สวัสดีคุณ $name,\n\n คุณได้เพิ่มสมาชิกในเว็บ $mosConfig_live_site.\n'
.'คุณสามารถล็อกอินเข้าสู่เว็บ  $mosConfig_live_site ด้วย ชื่อผู้ใช้ และ รหัสผ่าน ที่คุณได้ลงทะเบียนไว้\n\n'
.'ข้อความนี้เป็นข้อความอัตโนมัติจากระบบ  คุณไม่จำเป็นต้องตอบกลับ\n');
DEFINE('_ASEND_MSG','สวัสดี %s,

มีสมาชิกใหม่ลงทะเบียนมายัง %s.
ด้านล่างนี้คือ รายละเอียดของสมาชิก:

ชื่อ - %s
e-mail - %s
ชื่อผู้ใช้ - %s

ข้อความนี้เป็นข้อความอัตโนมัติจากระบบ  คุณไม่จำเป็นต้องตอบกลับ');
DEFINE('_REG_COMPLETE_NOPASS','<div class="componentheading">ลงทะเบียนเสร็จแล้วครับ!</div><br />&nbsp;&nbsp;'
.'คุณสามารถเข้าใช้ได้ทันท<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">ลงทะเบียนเสร็จแล้วครับ!</div><br />คุณสามารถเข้าใช้ได้ทันที');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">การลงทะเบียนเสร็จสมบูรณ์!</div><br />คุณต้องยืนยันตัวคุณก่อนโดยเข้าไปเปิดอีเมลที่ลงทะเบียนไว้แล้วคลิ๊กลิ้งค์เพื่อยีนยันจากนันสามารถเข้าใช้งานได้.');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">การลงทะเบียนเสร็จสมบูรณ์!</div><br />การยืนยันเสร็จสมบูรณ์คุณสามารถล็อกอินเข้าใช้งานด้วย ชื่อผู้ใช้ และ รหัสผ่าน ที่คุณได้ลงทะเบียนไว้');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">การยืนยันไม่ผ่าน</div><br />ไม่มีชื่อผู้ใช้นี้อยู่ในฐานข้อมูล.');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','ลืมรหัสผ่าน?');
DEFINE('_NEW_PASS_DESC','กรุณาใส่  ชื่อสำหรับล็อกอิน และอีเมล ของคุณ แล้วคลิกที่ปุ่ม ส่งรหัสผ่าน<br />'
.'คุณจะได้รับรหัสผ่านทางอีเมล  และให้ใช้รหัสใหม่ที่ได้รับนี้ ในการล็อกอินเข้าใช้งาน');
DEFINE('_PROMPT_UNAME','ชื่อสำหรับล็อกอิน:');
DEFINE('_PROMPT_EMAIL','อีเมล:');
DEFINE('_BUTTON_SEND_PASS','ส่งรหัสผ่าน');
DEFINE('_REGISTER_TITLE','ลงทะเบียน');
DEFINE('_REGISTER_NAME','ชื่อ:');
DEFINE('_REGISTER_UNAME','ชื่อในการล็อกอิน:');
DEFINE('_REGISTER_EMAIL','อีเมล:');
DEFINE('_REGISTER_PASS','รหัสผ่าน:');
DEFINE('_REGISTER_VPASS','ยืนยันรหัสผ่าน:');
DEFINE('_REGISTER_REQUIRED','กรุณาใส่ข้อมูลใน (*) ให้ครบถ้วน');
DEFINE('_BUTTON_SEND_REG','ส่ง การลงทะเบียน');
DEFINE('_SENDING_PASSWORD','รหัสผ่านของคุณจะถูกส่งไปยังอีเมลที่ให้ไว้<br />เมื่อคุณได้รับรหัสผ่าน'
.' คุณสามารถที่จะล็อกอินเข้ามาเปลี่ยนรหัสใหม่ได้เองตามต้องการ');

/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','ค้นหา');
DEFINE('_PROMPT_KEYWORD','คำที่ใช้ค้นหา');
DEFINE('_SEARCH_MATCHES','พบ %d ข้อความ');
DEFINE('_CONCLUSION','รวม $totalRows ข้อมูลที่พบ ค้นหาข้อมูล  <b>$searchword</b> ด้วย');
DEFINE('_NOKEYWORD','ไม่พบข้อมูล');
DEFINE('_IGNOREKEYWORD','หนึ่งหรือหลายคำในนี้ไม่สามารถค้นหาได้');
DEFINE('_SEARCH_ANYWORDS','บางคำ');
DEFINE('_SEARCH_ALLWORDS','ทุกคำ');
DEFINE('_SEARCH_PHRASE','ทุกตัวอักษร');
DEFINE('_SEARCH_NEWEST','ใหม่ก่อน');
DEFINE('_SEARCH_OLDEST','เก่าก่อน');
DEFINE('_SEARCH_POPULAR','สุดฮอต');
DEFINE('_SEARCH_ALPHABETICAL','ตามลำดับอักษร');
DEFINE('_SEARCH_CATEGORY','หมวดหมู่ /ประเภท');

/** templates/*.php */
DEFINE('_DATE_FORMAT','l, F d Y');  //Uses PHP's DATE Command Format - Depreciated
/**
* Modify this line to reflect how you want the date to appear in your site
*
*e.g. DEFINE("_DATE_FORMAT_LC","%A, %d %B %Y %H:%M"); //Uses PHP's strftime Command Format
*/
/** DEFINE("_DATE_FORMAT_LC","%A, %d %B %Y"); //Uses PHP's strftime Command Format */
/** DEFINE("_DATE_FORMAT_LC2","%A, %d %B %Y %H:%M"); */
DEFINE('_DATE_FORMAT_LC',"%A, %d %B %Y"); //Uses PHP's strftime Command Format
DEFINE('_DATE_FORMAT_LC2',"%A, %d %B %Y %H:%M");
DEFINE('_SEARCH_BOX','ค้นหา...');
DEFINE('_NEWSFLASH_BOX','ข่าวด่วน!');
DEFINE('_MAINMENU_BOX','เมนูหลัก');

/** classes/html/usermenu.php */
DEFINE('_UMENU_TITLE','เมนูสมาชิก');
DEFINE('_HI','สวัสดี, ');

/** user.php */
DEFINE('_SAVE_ERR','กรุณาใส่ข้อมูลให้ครบทุกช่อง');
DEFINE('_THANK_SUB','ขอขอบคุณสำหรับข้อมูลที่คุณส่งเข้ามา. เจ้าหน้าที่จะทำการตรวจสอบก่อนที่จะนำขึ้นแสดงในเว็บแห่งนี้');
DEFINE('_UP_SIZE','กรุณาใส่ภาพขนาดไม่เกิน 15kb ');
DEFINE('_UP_EXISTS','รูป $userfile_name นี้มีอยู่แล้ว. กรุณาเปลี่ยนชื่อแล้วส่งขึ้นมาใหม่อีกครั้ง');
DEFINE('_UP_COPY_FAIL','การส่งข้อมูลไม่สำเร็จ');
DEFINE('_UP_TYPE_WARN','รูปภาพควรจะเป็นภาพที่มีนามสกุล gif, หรือ jpg ');
DEFINE('_MAIL_SUB','สมาชิกส่งข้อมูลมายังเว็บ');
DEFINE('_MAIL_MSG','สวัสดี $adminName,\n\nมีสมาชิกได้ส่ง $type, $title, โดย $author'
.' เข้ามาในเว็บ $mosConfig_live_site website.\n'
.'กรุณาเข้าไปยัง $mosConfig_live_site/administrator เพื่อตรวจสอบและอนุมัติ $type.\n\n'
.'ข้อความนี้ถูกส่งเข้ามาด้วยระบบอัตโนมัติ เพื่อแจ้งให้คุณทราบเท่านั้น ไม่จำเป็นต้องตอบกลับ\n');
DEFINE('_PASS_VERR1','ถ้าต้องการเปลี่ยนรหัสผ่าน กรุณาใส่รหัสผ่านอีกครั้งเพื่อยืนยัน');
DEFINE('_PASS_VERR2','ถ้าต้องการเปลี่ยนรหัสผ่าน ตรวจสอบให้แน่ใจว่า รหัสผ่าน ทั้งสองครั้งเหมือนกัน');
DEFINE('_UNAME_INUSE','ชื่อสมาชิกนี้มีผู้อื่นใช้แล้ว');
DEFINE('_UPDATE','แก้ไข');
DEFINE('_USER_DETAILS_SAVE','ได้บันทึกข้อมูลของคุณแล้ว');
DEFINE('_USER_LOGIN','ล็อกอิน เข้าใช้งาน');

/** components/com_user */
DEFINE('_EDIT_TITLE','แก้ไขข้อมูลของคุณ');
DEFINE('_YOUR_NAME','ชื่อของคุณ:');
DEFINE('_EMAIL','อีเมล');
DEFINE('_UNAME','ชื่อในการล็อกอิน:');
DEFINE('_PASS','รหัสผ่าน:');
DEFINE('_VPASS','ยืนยันรหัสผ่าน:');
DEFINE('_SUBMIT_SUCCESS','การส่งข้อมูลเสร็จเรียบร้อย!');
DEFINE('_SUBMIT_SUCCESS_DESC','ข้อมูลของคุณถูกจัดส่งให้กับผู้ดูแลเว็บเป็นที่เรียบร้อย  เราจะตรวจสอบ และนำขึ้นแสดงบนเว็บไซต์แห่งนี้โดยเร็ว.');
DEFINE('_WELCOME','ยินดีต้อนรับ!');
DEFINE('_WELCOME_DESC','ขอต้อนรับเข้าสู่ ส่วนของสมาชิก');
DEFINE('_CONF_CHECKED_IN','ตรวจสอบ ว่า นำเข้าหมดแล้ว');
DEFINE('_CHECK_TABLE','ตรวจสอบตาราง');
DEFINE('_CHECKED_IN','ตรวจสอบ ');
DEFINE('_CHECKED_IN_ITEMS',' ข้อมูลรายการ');
DEFINE('_PASS_MATCH','รหัสผ่านไม่เหมือนกันกรุณาตรวจสอบ');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','กรุณาใส่ชื่อด้วยครับ');
DEFINE('_BNR_CONTACT','คุณไม่ได้ใส่รายละเอียดการติดต่อ');
DEFINE('_BNR_VALID_EMAIL','กรุณาใส่อีเมล');
DEFINE('_BNR_CLIENT','คุณไม่ได้เลือกหมวดหมู่');
DEFINE('_BNR_NAME','กรุณาใส่ชื่อให้ป้ายโฆษณา');
DEFINE('_BNR_IMAGE','กรุณาใส่รูปให้ป้ายโฆษณา');
DEFINE('_BNR_URL','กรุณาใส่การเชื่อมโยง(URL)');

/** components/com_login */
DEFINE('_ALREADY_LOGIN','คุณได้ทำการล็อกอินเข้าระบบแล้ว!');
DEFINE('_LOGOUT','คลิกที่นี่ เพื่อออกจากระบบ');
DEFINE('_LOGIN_TEXT','ใช้ชื่อสมาชิกและรหัสผ่าน เพื่อการเข้าใช้อย่างสมบูรณ์');
DEFINE('_LOGIN_SUCCESS','คุณได้ทำการล็อกอินเข้าระบบแล้ว!');
DEFINE('_LOGOUT_SUCCESS','คุณได้ทำการออกจากระบบแล้ว!');
DEFINE('_LOGIN_DESCRIPTION','ส่วนนี้สำหรับสมาชิกเท่านั้น');
DEFINE('_LOGOUT_DESCRIPTION','คุณต้องการที่จะออกจากระบบแล้ว!');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','รวมเว็บน่าสนใจ');
DEFINE('_WEBLINKS_DESC','ทางเราจะพยายามรวบรวมเว็บที่มีประโยชน์ เพื่อให้ทุกท่าน <br/>'
.'ได้ค้นหาข้อมูลต่าง ๆ จากแหล่งข้อมูลนี้  โดยท่านสามารถเลือกประเภทเว็บ และเลือก URL เพื่อเข้าชมเว็บ.');
DEFINE('_HEADER_TITLE_WEBLINKS','รวมเว็บน่าสนใจ');
DEFINE('_SECTION','หมวดหมู่ :');
DEFINE('_SUBMIT_LINK','ส่งข้อมูลแนะนำเว็บ');
DEFINE('_URL','URL:');
DEFINE('_URL_DESC','คำอธิบายเว็บ:');
DEFINE('_NAME','ชื่อเว็บ:');
DEFINE('_WEBLINK_EXIST','ชื่อ เว็บ นี้มีอยู่แแล้ว, กรุณาลองใหม่.');
DEFINE('_WEBLINK_TITLE','เว็บ ของคุณต้องมีหัวชื่อเรื่อง.');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','ชื่อ');
DEFINE('_FEED_ARTICLES','# บทความ');
DEFINE('_FEED_LINK','ลิ้งค์');

/** whos_online.php */
DEFINE('_WE_HAVE', 'ขณะนี้มี ');
DEFINE('_AND', ' และ ');
DEFINE('_GUEST_COUNT','$guest_array บุคคลทั่วไป');
DEFINE('_GUESTS_COUNT','$guest_array บุคคลทั่วไป');
DEFINE('_MEMBER_COUNT','$user_array สมาชิก');
DEFINE('_MEMBERS_COUNT','$user_array สมาชิก');
DEFINE('_ONLINE',' ออนไลน์');
DEFINE('_NONE','ไม่มีสมาชิกออนไลน์');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','เวลา ');
DEFINE('_MEMBERS_STAT','จำนวนสมาชิก ');
DEFINE('_HITS_STAT','ผู้ชม');
DEFINE('_NEWS_STAT','จำนวนข่าวสาร ');
DEFINE('_LINKS_STAT','เว็บลิงค์');
DEFINE('_VISITORS','ผู้เยี่ยมชม');

/** /adminstrator/components/com_menus/admin.menus.html.php */
DEFINE('_MAINMENU_HOME','*  [mainmenu] เป็นเมนูแรกที่ต้องมี  *');
DEFINE('_MAINMENU_DEL','*  คุณไม่สามารถ `ลบ` เมนูนี้ได้เพราะจำเป็นต้องมี *');
DEFINE('_MENU_GROUP','* Some `เมนูบางชนิดสามารถกำหนดได้ว่าสมาชิกระดับใดสามารถใช้ได้ *');


/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', 'รายละเอียดสมาชิกใหม่' );
DEFINE('_NEW_USER_MESSAGE', 'สวัสดีคุณ %s,


คุณได้เพิ่มสมาชิกในเว็บ %s โดยผู้ดูแล

ในอีเมลฉบับนี้คุณจะได้รับชื่อผู้ใช้ รหัสผ่าน สำหรับ log ล็อกอินเข้าใช้งาน %s:

ชื่อผู้ใช้ - %s
ระหัสผ่าน - %s


ข้อความนี้เป็นข้อความอัตโนมัติจากระบบ คุณไม่ต้องตอบกลับ');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "ได้รับข้อความจาก '%s'

Message:
" );

/** includes/mamboxml.php */
DEFINE('_DONT_USE_IMAGE','- ไม่ต้องการใช้รูปภาพ -');
DEFINE('_USE_DEFAULT_IMAGE','- ใช้รูปภาพพื้นฐาน -');

/** global frontend translation string */
global $TR_STRS;
$TR_STRS[strtolower('Banners')] = 'ป้ายโฆษณา';
$TR_STRS[strtolower('Search')] = 'ค้นหา';
$TR_STRS[strtolower('Main Menu')] = 'เมนูหลัก';
$TR_STRS[strtolower('User Menu')] = 'เมนูผู้ใช้';
$TR_STRS[strtolower('Other Menu')] = 'เมนูอื่นๆ ';
$TR_STRS[strtolower('Login Form')] = 'Login Form';
$TR_STRS[strtolower('Syndicate')] = 'กระจายข่าว';
$TR_STRS[strtolower('Statistics')] = 'สถิติการใช้งาน';
$TR_STRS[strtolower('Template Chooser')] = 'เลือกใช้เทมเพลต';
$TR_STRS[strtolower('Archive')] = 'เอกสารสำคัญ';
$TR_STRS[strtolower('Sections')] = 'หมวดหมู่';
$TR_STRS[strtolower('Related Items')] = 'รายการที่เกี่ยวข้อง';
$TR_STRS[strtolower('Wrapper')] = 'Wrapper';
$TR_STRS[strtolower('Newsflash')] = 'Newsflash';
$TR_STRS[strtolower('Polls')] = 'โพลล์';
$TR_STRS[strtolower("Who's Online")] = "Who's Online";
$TR_STRS[strtolower('Random Image')] = 'สุ่มภาพ';
$TR_STRS[strtolower('Top Menu')] = 'เมนูด้านบน';
$TR_STRS[strtolower('Latest News')] = 'ข่าวสารล่าสุด';
$TR_STRS[strtolower('Popular')] = 'ได้รับความนิยมสูง';

?>

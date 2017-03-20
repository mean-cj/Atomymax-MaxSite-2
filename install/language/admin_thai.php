<?php
/**
* @version $Id: admin_thai_tis-620.php,v 1.5 2005/12/14 03:27:52 Ninekrit Exp $
* @package MamLang 1.0
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
* Powered By: mamboHub.com & mambolaithai.org
*/


//defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// Language and Encode of admin language
DEFINE('_A_LANGUAGE','th');
DEFINE('_A_ISO','charset=tis-620');

// needed for $alt text in toolbar item
DEFINE('_A_CANCEL','ยกเลิก'); 
DEFINE('_A_SAVE','บันทึก');
DEFINE('_A_APPLY','ใช้งาน'); 
DEFINE('_A_CLOSE','ยกเลิก');
DEFINE('_A_COPY','คัดลอก');
DEFINE('_A_MOVE','ย้าย');
DEFINE('_A_DELETE','ลบ'); 
DEFINE('_A_NEXT','ถัดไป'); 
DEFINE('_A_BACK','ก่อนหน้า'); 
DEFINE('_A_DEFAULT','ค่าเริ่มต้น'); 
DEFINE('_A_RESTORE','นำกลับ'); 

/**
* @location /../includes/mambo.php
* @desc Includes translations of several droplists and non-translated stuff
*/

//Droplist
DEFINE('_A_TOP','บน');
DEFINE('_A_ALL','ทั้งหมด');
DEFINE('_A_NONE','ไม่กำหนด');
DEFINE('_A_SELECT_IMAGE','เลือกรูป');
DEFINE('_A_NO_USER','ไม่มีสมาชิก');
DEFINE('_A_CREATE_CAT','ท่านจะต้องทำการสร้างหมวดย่อยก่อน');
DEFINE('_A_PARENT_BROWSER_NAV','เปิดในหน้าต่างเดิม');
DEFINE('_A_NEW_BROWSER_NAV','เปิดหน้าต่างใหม่');
DEFINE('_A_NEW_W_BROWSER_NAV','เปิดหน้าต่างใหม่โดยไม่มีเมนูเบราว์เซอร์');

//Main Texts
DEFINE('_A_PUBLISHED_PEND','รอการเผยแพร่');
DEFINE('_A_PUBLISHED_CURRENT','เผยแพร่แล้ว');
DEFINE('_A_PUBLISHED_EXPIRED','เผยแพร่แล้วแต่หมดอายุ');
DEFINE('_A_PUBLISHED_NOT','ไม่เผยแพร่');
DEFINE('_A_TOGGLE_STATE','คลิกที่ไอคอนเพื่อเปลี่ยนสถานะ');

//Alt Hover
DEFINE('_A_PENDING','รอ');
DEFINE('_A_VISIBLE','มองเห็นได้');
DEFINE('_A_FINISHED','เสร็จสิ้น');
DEFINE('_A_MOVE_UP','เลื่อนขึ้น');
DEFINE('_A_MOVE_DOWN','เลื่อนลง');

/**
* @desc Includes the main adminLanguage class which refers to var's for translations
*/
class adminLanguage {

var $RTLsupport = false;

var $A_MAIL = 'กล่องข้อความ';

//templates/mambo_admin_blue/login.php
var $A_USERNAME = 'ชื่อสมาชิก';
var $A_PASSWORD = 'รหัสผ่าน';
var $A_WELCOME_MAMBO = '<p>ระบบบริหารจัดการเว็บไซต์</p><p>กรุณาใส่รายละเอียดเพื่อล็อกอิน</p><p>หากคุณไม่มีหน้าที่เกี่ยวข้อง<br>กรุณาปิดหน้าต่างนี้ด้วยครับ</p>';
var $A_WARNING_JAVASCRIPT = '!คำเตือน!! คุณต้องเปิดการใช้งานจาวาสคริปต์เพื่อใช้ในการจัดการในส่วนของการดูแลระบบ';

//templates/mambo_admin_blue/index.php
var $A_LOGIN = 'เข้าสู่ระบบ';    //NineKrit ADDED
var $A_GENERATE_TIME = 'หน้านี้ถูกสร้างขึ้นภายใน %f วินาที';
var $A_LOGOUT = 'ออกจากระบบ';

//popups/contentwindow.php
var $A_TITLE_CPRE = 'แสดงเนื้อหา';
var $A_CLOSE = 'ปิด';
var $A_PRINT = 'พิมพ์';

//popups/modulewindow.php
var $A_TITLE_MPRE = 'แสดงโมดูล';

//popups/pollwindow.php
var $A_TITLE_PPRE = 'แสดงแบบสำรวจ';
var $A_VOTE = 'โหวต';
var $A_RESULTS = 'ผลลัพธ์';

//popups/uploadimage.php
var $A_TITLE_UPLOAD = 'อัพโหลดไฟล์';
var $A_FILE_UPLOAD = 'อัพโหลดไฟล์';
var $A_UPLOAD = 'อัพโหลด';
var $A_FILE_MAX_SIZE = 'ขนาดสูงสุด'; //Ken ADDED

//modules/mod_components.php
var $A_ERROR = 'เกิดความผิดพลาด!';

//modules/mod_fullmenu.php
var $A_MENU_HOME = 'หน้าหลัก';
var $A_MENU_HOME_PAGE = 'โฮมเพจ';
var $A_MENU_CTRL_PANEL = 'แผงควบคุม'; //NineKrit ADDED
var $A_MENU_SITE = 'เว็บ';
var $A_MENU_SITE_MENU ='การจัดการเว็บไซต์';
var $A_MENU_SITE_MANAGEMENT = 'การบริหารจัดการเว็บ';  //NineKrit ADDED
var $A_MENU_CONFIGURATION = 'ตั้งค่าคอนฟิค';
var $A_MENU_LANGUAGES = 'ภาษา';
var $A_MENU_MANAGE_LANG = 'เปลี่ยนภาษา';
var $A_MENU_LANG_MANAGE = 'ปรับเปลี่ยนภาษา';
var $A_MENU_INSTALL = 'ติดตั้ง';
var $A_MENU_INSTALL_LANG = 'ติดตั้งภาษา';
var $A_MENU_MEDIA_MANAGE = 'การจัดการมีเดียไฟล์';
var $A_MENU_MANAGE_MEDIA = 'การจัดการไฟล์';
var $A_MENU_PREVIEW = 'แสดงตัวอย่าง';
var $A_MENU_NEW_WINDOW = 'ในหน้าต่างใหม่';
var $A_MENU_INLINE = 'ในหน้าต่างนี้';
var $A_MENU_INLINE_POS = 'ในหน้าต่างนี้และแสดงตำแหน่งของโมดูล';
var $A_MENU_STATISTICS = 'สถิติ';
var $A_MENU_STATISTICS_SITE = 'สถิติเว็บ';
var $A_MENU_BROWSER = 'บราวเซอร์, โอเอส, โดเมน';
var $A_MENU_PAGE_IMP = 'สถิติการเข้าชมหน้าเพจ';
var $A_MENU_SEARCH_TEXT = 'สถิติคำค้น';
var $A_MENU_TEMP_MANAGE = 'การจัดการเทมเพลต';
var $A_MENU_TEMP_CHANGE = 'เปลี่ยนเทมเพลตเว็บไซต์';
var $A_MENU_INSTALL_TEMPLATES = 'ติดตั้งเทมเพลตเว็บไซต์';  //NineKrit ADDED
var $A_MENU_SITE_TEMP = 'เทมเพลตเว็บไซต์';
var $A_MENU_ADMIN_TEMP = 'เทมเพลตผู้ดูแล';
var $A_MENU_ADMIN_CHANGE_TEMP = 'เปลี่ยนเทมเพลตผู้ดูแล';
var $A_MENU_INSTALL_ADMIN_TEMPLATES = 'ติดตั้ง เทมเพลตผู้ดูแล'; //NineKrit ADDED
var $A_MENU_MODUL_POS = 'ตำแหน่งโมดูล';
var $A_MENU_TEMP_POS = 'ตำแหน่ง เทมเพลต';
var $A_MENU_TRASH_MANAGE = 'การจัดการถังรีไชเคิล';
var $A_MENU_MANAGE_TRASH = 'การจัดการถังรีไชเคิล';
var $A_MENU_USER_MANAGE = 'การจัดการสมาชิก';
var $A_MENU_MANAGE_USER = 'การจัดการสมาชิก';
var $A_MENU_ADD_EDIT = 'เพิ่ม/แก้ไข สมาชิก';
var $A_MENU_MASS_MAIL = 'ส่งจดหมาย';
var $A_MENU_MAIL_USERS = 'ส่งจดหมายถึงกลุ่มสมาชิก';
var $A_MENU_MANAGE_STR = 'การจัดการโครงสร้างเว็บ';
var $A_MENU_MANAGEMENT = 'เมนู การจัดการ'; //NineKrit ADDED
var $A_MENU_CONTENT = 'เนื้อหา';
var $A_MENU_CONTENT_MANAGE = 'การจัดการเนื้อหา';
var $A_MENU_CONTENT_MANAGERS = 'การจัดการเนื้อหา';
var $A_MENU_CONTENT_BY_SECTION = 'เนื้อหาตามหมวด';  //NineKrit ADDED
var $A_MENU_MANAGE_CONTENT = 'การจัดการ รายการเนื้อหา';
var $A_MENU_MANAGE_CONTACTS = 'การจัดการส่วนการติดต่อ';
var $A_MENU_ITEMS = 'รายการ';
var $A_MENU_ADDNEDIT = 'เพิ่ม/แก้ไข';
var $A_MENU_ARCHIVE = 'คลังเนื้อหา';
var $A_MENU_OTHER_MANAGE = 'ระบบจัดการอื่นๆ ';
var $A_MENU_ITEMS_FRONT = 'การจัดการรายการหน้าเว็บ';
var $A_MENU_ITEMS_CONTENT = 'การจัดการรายการในเนื้อหา';
var $A_MENU_ITEMS_ARCHIVE = 'การจัดการรายการในคลังเนื้อหา';
var $A_MENU_ARCHIVE_MANAGE = 'การจัดการคลังเนื้อหา';
var $A_MENU_CONTENT_SEC = 'การจัดการส่วนหลัก ของเนื้อหา';
var $A_MENU_CONTENT_CAT = 'การจัดการประเภท ของเนื้อหา';
var $A_MENU_CATEGORIES = 'ประเภท';
var $A_MENU_COMPONENTS = 'คอมโพเน้นท์';
var $A_MENU_COMPONENTS_MANAGEMENT = 'การจัดการคอมโพเน้นท์';  // NineKrit Add
var $A_MENU_INST_UNST = 'ติดตั้ง/ลบ';
var $A_MENU_INST_UNST_COMPONENTS = 'ติดตั้ง/ลบคอมโพเน้นท์';  // NineKrit Add
var $A_MENU_MORE_COMP = 'คอมโพเน้นท์อื่นๆ ';
var $A_MENU_MORE_COMP2 = 'คอมโพเน้นท์อื่น ๆ เพิ่มเติม...';//NineKrit Add
var $A_MENU_MODULES = 'โมดูล';
var $A_MENU_INST_UNST_MODULES = 'ติดตั้ง/ลบโมดูล';//NineKrit Add
var $A_MENU_MODULES_MANAGEMENT = 'การจัดการโมดูล'; //NineKrit Add
var $A_MENU_INSTALL_CUST = 'ติดตั้งโมดูล';
var $A_MENU_SITE_MOD = 'โมดูลเว็บ';
var $A_MENU_SITE_MOD_MANAGE = 'การจัดการโมดูลเว็บ';
var $A_MENU_ADMIN_MOD = 'โมดูลของผู้ดูแล';
var $A_MENU_ADMIN_MOD_MANAGE = 'การจัดการโมดูลของผู้ดูแล';
var $A_MENU_MAMBOTS = 'แมมบอท';
var $A_MENU_INST_UNST_MAMBOTS = 'ติดตั้ง/ลบ แมมบอท';//ninekrit Add
var $A_MENU_MAMBOTS_MANAGE = 'การจัดการ แมมบอท'; //ninekrit Add
var $A_MENU_CUSTOM_MAMBOT = 'ติดตั้ง แมมบอท'; 
var $A_MENU_SITE_MAMBOT = 'แมมบอทเว็บ';
var $A_MENU_SITE_MAMBOTS = 'แมมบอทเว็บ';
var $A_MENU_MAMBOT_MANAGE = 'การจัดการแมมบอทเว็บ';
var $A_MENU_INSTALLERS = 'ติดตั้ง';//KEN ADDED
var $A_MENU_INSTALLERS_LIST = 'รายการที่จะติดตั้ง';//KEN ADDED
var $A_MENU_TEMPLATES_SITE = 'เทมเพลต - เว็บไซต์';//KEN ADDED
var $A_MENU_TEMPLATES_SITE_INST = 'ติดตั้งเทมเพลตเว็บไซต์';//KEN ADDED
var $A_MENU_TEMPLATES_ADMIN = 'เทมเพลต - ผู้ดูแลระบบ';//KEN ADDED
var $A_MENU_TEMPLATES_ADMIN_INST = 'ติดตั้งเทมเพลตผู้ดูแลระบบ';//KEN ADDED
var $A_MENU_MESSAGES = 'ข้อความ';
var $A_MENU_MESSAGES_MANAGEMENT = 'การจัดการส่งข้อความ';//KEN ADDED
var $A_MENU_INBOX = 'กล่องข้อความเข้า';
var $A_MENU_PRIV_MSG = 'ข้อความส่วนบุคคล';
var $A_MENU_GLOBAL_CHECK = 'ตรวจสอบรายละเอียดทั้งหมด';
var $A_MENU_CHECK_INOUT = 'เช็คอินรายการเช็คเอาท์ทั้งหมด';
var $A_MENU_SYSTEM_INFO = 'ข้อมูลระบบ';
var $A_MENU_CLEAN_CACHE = 'ลบแคช';
var $A_MENU_CLEAN_CACHE_ITEMS = 'ล้างแคชของเนื้อหาทั้งหมด';
var $A_MENU_BIG_THANKS = 'ขอบคุณเป็นพิเศษสำหรับผู้ให้กำลังใจและคำปรึกษาทุกท่าน';
var $A_MENU_SUPPORT = 'การช่วยเหลือ';
var $A_MENU_SYSTEM = 'ระบบ';
var $A_MENU_SYSTEM_MNG = 'การจัดการระบบ';

//modules/mod_latest.php
var $A_LATEST_ADDED = 'เนื้อหา/เนื้อหา ล่าสุด';

//modules/mod_logged.php
var $A_USER_LOGGED = 'ผู้ใช้งานที่ล็อกอินอยู่';
var $A_USER_FORCE_LOGOUT = 'เคลียร์ผู้ใช้งานออกจากระบบ';

//modules/mod_online.php
var $A_ONLINE_USERS = 'ผู้ใช้งานออนไลน์';

//modules/mod_popular.php
var $A_POPULAR_MOST = 'มีคนให้ความสนใจมากที่สุด';
var $A_CREATED = 'เขียน';
var $A_HITS = 'ผู้ชม';

//modules/mod_quickicon.php
var $A_MENU_MANAGER = 'การจัดการเมนู';
var $A_FRONTPAGE_MANAGER = 'การจัดการเนื้อหาหน้าเว็บ';
var $A_STATIC_MANAGER = 'เนื้อหาสเตติก';
var $A_SECTION_MANAGER = 'เพิ่ม/แก้ไข หมวดของเนื้อหา';
var $A_CATEGORY_MANAGER = 'เพิ่ม/แก้ไข ประเภทของเนื้อหา';
var $A_ALL_MANAGER = 'เนื้อหาทั้งหมด';
var $A_TRASH_MANAGER = 'การจัดการถังรีไซเคิล';
var $A_GLOBAL_CONF = 'ตั้งค่าคอนฟิคหลัก';
var $A_HELP = 'ช่วยเหลือ';

//includes/menubar.html.php
var $A_NEW = 'สร้างใหม่';
var $A_PUBLISH = 'เผยแพร่';
var $A_DEFAULT = 'ค่าเริ่มต้น';
var $A_ASSIGN = 'ระบุ';
var $A_UNPUBLISH = 'ไม่เผยแพร่';
var $A_UNARCHIVE = 'ยกเลิกคลังเนื้อหา';
var $A_EDIT = 'แก้ไข';
var $A_DELETE = 'ลบ';
var $A_TRASH = 'ถังรีไซเคิล';
var $A_SAVE = 'จัดเก็บ';
var $A_BACK = 'กลับ';
var $A_CANCEL = 'ยกเลิก';

//Alerts
var $A_ALERT_SELECT_TO = 'โปรดเลือกประเภทเพื่อ';
var $A_ALERT_SELECT_PUB = 'โปรดเลือกรายการเพื่อเผยแพร่';
var $A_ALERT_SELECT_PUB_LIST = 'โปรดเลือกรายการเพื่อกำหนดเป็นค่าเริ่มต้น';
var $A_ALERT_ITEM_ASSIGN = 'โปรดเลือกเรื่องเพื่อกำหนด';
var $A_ALERT_SELECT_UNPUBLISH = 'โปรดเลือกรายการเพื่อยุติการเผยแพร่';
var $A_ALERT_SELECT_ARCHIVE = 'โปรดเลือกรายการเพื่อจัดเก็บเป็นคลังเนื้อหา';
var $A_ALERT_SELECT_UNARCHIVE = 'โปรดเลือกรายการเพื่อยกเลิกเป็นคลังเนื้อหา';
var $A_ALERT_SELECT_EDIT = 'โปรดเลือกรายการเพื่อแก้ไข';
var $A_ALERT_SELECT_DELETE = 'โปรดเลือกรายการเพื่อลบ';
var $A_ALERT_CONFIRM_DELETE = 'คุณแน่ใจไหมที่จะลบรายการนี้?';

//Alerts
var $A_ALERT_ENTER_PASSWORD = 'กรุณาใส่รหัสผ่าน'; 
var $A_ALERT_INCORRECT = 'ชื่อ, รหัสผ่าน, หรือ ระดับของผู้ใช้งานซ้ำหรือผิดพลาด.  ลองใหม่อีกครั้ง';
var $A_ALERT_INCORRECT_TRY = 'ชื่อ, รหัสผ่าน, ซ้ำหรือผิดพลาด.  ลองใหม่อีกครั้ง';
var $A_ALERT_ALPHA = 'ไม่สามารถใส่อักขระพิเศษหรือเว้นวรรคได้';
var $A_ALERT_IMAGE_UPLOAD = 'กรุณาเลือกรูปที่ต้องการอับโหลดก่อน';
var $A_ALERT_IMAGE_EXISTS = "รูป %s มีอยู่แล้ว";
var $A_ALERT_IMAGE_FILENAME = 'ไฟล์ที่ใช้ได้คือ gif, png, jpg, bmp, swf, doc, xls หรือ ppt';
var $A_ALERT_UPLOAD_FAILED = "อับโหลด %s ไม่สำเร็จ";
var $A_ALERT_UPLOAD_SUC = "อับโหลด %s ไปยัง %s เสร็จแล้ว";
var $A_ALERT_UPLOAD_SUC2 = "อับโหลด %s ไปยัง %s เรียบร้อย";

//includes/pageNavigation.php
var $A_OF = 'จาก'; 
var $A_NO_RECORD_FOUND = 'ไม่มีในบันทึก';
var $A_FIRST_PAGE = 'หน้าแรก';
var $A_PREVIOUS_PAGE = 'หน้าก่อนหน้า';
var $A_NEXT_PAGE = 'หน้าต่อไป';
var $A_END_PAGE = 'หน้าสุดท้าย';
var $A_PREVIOUS = 'ก่อนหน้า';
var $A_NEXT = 'ต่อไป';
var $A_END = 'สุดท้าย';
var $A_DISPLAY = 'แสดง';
var $A_MOVE_UP = 'เลื่อนขึ้น';
var $A_MOVE_DOWN = 'เลื่อนลง';

//DIRECTORY COMPONENTS ALL FILES
var $A_COMP_CHECKED_OUT = 'นำออก';
var $A_COMP_TITLE = 'ชื่อเรื่อง';
var $A_COMP_IMAGE = 'รูป';
var $A_COMP_FRONT_PAGE = 'หน้าแรกเว็บ';
var $A_COMP_IMAGE_POSITION = 'ตำแหน่งรูปภาพ';
var $A_COMP_FILTER = 'ค้นหา';
var $A_COMP_ORDERING = 'การเรียงลำดับ';
var $A_COMP_ACCESS_LEVEL = 'ระดับการเข้าถึง';
var $A_COMP_PUBLISHED = 'เผยแพร่';
var $A_COMP_PUBLISH = 'เผยแพร่';
var $A_COMP_UNPUBLISHED = 'ไม่เผยแพร่';
var $A_COMP_UNPUBLISH = 'ไม่เผยแพร่';
var $A_COMP_REORDER = 'การจัดลำดับ';
var $A_COMP_ORDER = 'ลำดับ';
var $A_COMP_SAVE_ORDER = 'บันทึกการจัดลำดับ';
var $A_COMP_ACCESS = 'การเข้าถึง';
var $A_COMP_SECTION = 'หมวด';
var $A_COMP_NB = '#';
var $A_COMP_ACTIVE = '# จำนวนเนื้อหา';
var $A_COMP_TRASH = '# ถูกนำออก';
var $A_COMP_DESCRIPTION = 'คำอธิบาย';
var $A_COMP_SELECT_MENU_TYPE = 'กรุณาเลือกเมนู';
var $A_COMP_ENTER_MENU_NAME = 'กรุณาใส่ชื่อเมนู';
var $A_COMP_CREATE_MENU_LINK = 'คุณแน่ใจหรือไม่ที่จะสร้างเมนูนี้? \nหากไม่มีการบันทึก การเปลี่ยนแปลงจะไม่มีผล';
var $A_COMP_LINK_TO_MENU = 'ลิงก์เมนู';
var $A_COMP_CREATE_MENU = 'จะสร้างเมนูใหม่ในเมนูที่คุณเลือก';
var $A_COMP_SELECT_MENU = 'เลือกเมนู';
var $A_COMP_MENU_TYPE_SELECT = 'เลือกรูปแบบเมนู';
var $A_COMP_MENU_NAME_ITEM = 'ชื่อเมนู';
var $A_COMP_MENU_LINKS = 'ออกจากเมนูลิงก์';
var $A_COMP_MENU_LINKS_AVAIL = 'เมนูลิงก์จะใช้ได้เมื่อทำการบันทึก';
var $A_COMP_NONE = 'ไม่มี';
var $A_COMP_MENU = 'เมนู';
var $A_COMP_TYPE = 'รูปแบบ';
var $A_COMP_EDIT = 'แก้ไข';
var $A_COMP_NEW = 'สร้างใหม';
var $A_COMP_ADD = 'เพิ่ม';
var $A_COMP_ITEM_NAME = 'ชื่อรายการ';
var $A_COMP_STATE = 'สถานะ';
var $A_COMP_TRASHED = 'ลบ';
var $A_COMP_NAME = 'ชื่อ';
var $A_COMP_DEFAULT = 'ค่าเริ่มต้น';
var $A_COMP_CATEG = 'ประเภท';
var $A_COMP_LINK_USER = 'เชื่อมโยงไปยังผู้ใช้งาน';
var $A_COMP_CONTACT = 'ติดต่อ';
var $A_COMP_EMAIL = 'อีเมล';
var $A_COMP_PREVIEW = 'แสดงตัวอย่าง';
var $A_COMP_ITEMS = 'รายการ';
var $A_COMP_ITEM = 'รายการ';
var $A_COMP_ID = 'เลขหมาย';
var $A_COMP_EXPIRED = 'หมดอายุ';
var $A_COMP_YES = 'ใช่';
var $A_COMP_NO = 'ไม่';
var $A_COMP_EDITING = 'แก้ไข';
var $A_COMP_ADDING = 'เพิ่ม';
var $A_COMP_ARCHIVED = 'ตั้งเป็นคลังเนื้อหา';
var $A_COMP_HITS = 'ผู้ชม';
var $A_COMP_SOURCE = 'ที่มา';
var $A_COMP_SEL_ITEM = 'เลือกรายการสำหรับ';
var $A_COMP_DATE = 'วันที่';
var $A_COMP_AUTHOR = 'ผู้เขียน';
var $A_COMP_ANOTHER_ADMIN = 'กำลังแก้ไขโดยผู้ดูแลท่านอื่นอยู่';
var $A_COMP_SAVE_UNWRT = 'ทำให้  ไม่สามารถเขียนทับได้ หลังจากทำบันทึก';
var $A_COMP_OVERRIDE_SAVE = 'ยกเลิกการป้องกันการเขียนทับขณะทำการบันทึก';
var $A_COMP_ORDER_SAVED = 'บันทึกการจัดเรียงลำดับ';
var $A_COMP_NO_PARAMETERS = 'ไม่มี การส่งค่าพารามิเตอร์';
var $A_COMP_POSITION = 'ตำแหน่ง';
var $A_COMP_SHOW_ADV_DETAILS = 'แสดงข้อมูลรายละเอียด'; //SINN TRANS.
var $A_COMP_HIDE_ADV_DETAILS = 'ซ่อนข้อมูลรายละเอียด'; //SINN TRANS.

//components/com_admin/admin.admin.html.php
var $A_COMP_ADMIN_HOME = 'แผงควบคุม';
var $A_COMP_ADMIN_SIMP_MODE = 'Simple Mode';
var $A_COMP_ADMIN_SIMP_MODE_SELECTED = 'Simple Mode (selected)';
var $A_COMP_ADMIN_SIMP_MODE_UNSELECTED = 'Simple Mode (unselected)';
var $A_COMP_ADMIN_ADV_MODE = 'Advanced Mode';
var $A_COMP_ADMIN_ADV_MODE_SELECTED = 'Advanced Mode (selected)';
var $A_COMP_ADMIN_ADV_MODE_UNSELECTED = 'Advanced Mode (unselected)';
//var $A_COMP_ADMIN_TITLE = 'Control Panel';
var $A_COMP_ADMIN_INFO = 'ข้อมูล';
var $A_COMP_ADMIN_SYSTEM = 'ข้อมูลระบบ';
var $A_COMP_ADMIN_PHP_BUILT_ON = 'PHP ทำงานในระบบ:';
var $A_COMP_ADMIN_DB = 'ฐานข้อมูลเวอร์ชั่น:';
var $A_COMP_ADMIN_PHP_VERSION = 'PHP เวอร์ชั่น:';
var $A_COMP_ADMIN_SERVER = 'เว็บเซิร์ฟเวอร์:';
var $A_COMP_ADMIN_SERVER_TO_PHP = 'จากเว็บเซิร์ฟเวอร์สู่รูปแบบพีเอชพี:';
var $A_COMP_ADMIN_MAMBO_VERSION = 'เวอร์ชั่นแมมโบ้:'; //Mambo Version
var $A_COMP_ADMIN_AGENT = 'ตัวแทนผู้ใช้:';
var $A_COMP_ADMIN_SETTINGS = 'การตั้งค่าใน PHP :';
var $A_COMP_ADMIN_MODE = 'เซพโหมด:';
var $A_COMP_ADMIN_BASEDIR = 'เปิดโฟลเดอร์เริ่มต้น:';
var $A_COMP_ADMIN_ERRORS = 'แสดงข้อผิดพลาด:';
var $A_COMP_ADMIN_OPEN_TAGS = 'แท็กเปิดแบบสั้น:';
var $A_COMP_ADMIN_FILE_UPLOADS = 'อัพโหลดไฟล์:';
var $A_COMP_ADMIN_QUOTES = 'Magic Quotes:';
var $A_COMP_ADMIN_REG_GLOBALS = 'Register Globals:';
var $A_COMP_ADMIN_OUTPUT_BUFF = 'Output Buffering:';
var $A_COMP_ADMIN_S_SAVE_PATH = 'Session save path:';
var $A_COMP_ADMIN_S_AUTO_START = 'Session auto start:';
var $A_COMP_ADMIN_XML = 'XML ทำงานได้:';
var $A_COMP_ADMIN_ZLIB = 'Zlib ทำงานได้:';
var $A_COMP_ADMIN_DISABLED = 'ฟังก์ชันที่ไม่ทำงาน:';
var $A_COMP_ADMIN_WYSIWYG = 'WYSIWYG เอดิเตอร์:';
var $A_COMP_ADMIN_CONF_FILE = 'ไฟล์เก็บค่าคอนฟิค:';
var $A_COMP_ADMIN_PHP_INFO2 = 'รายละเอียด PHP';
var $A_COMP_ADMIN_PHP_INFO = 'รายละเอียด PHP';
var $A_COMP_ADMIN_PERMISSIONS='การยินยอม';
var $A_COMP_ADMIN_DIR_PERM = 'การยินยอมของไดเรกทอรี่่';
var $A_COMP_ADMIN_FOR_ALL = 'แมมโบ้สามารถทำงานได้อย่างสมบูรณ์ก็ต่อเมื่อทุกไดเรกทอรี่่ "สามารถเขียนได้:';
var $A_COMP_ADMIN_CREDITS = 'คำนิยม';
var $A_COMP_ADMIN_APP = 'แอพพลิเคชัน';
var $A_COMP_ADMIN_URL = 'URL';
var $A_COMP_ADMIN_VERSION = 'เวอร์ชั่น';
var $A_COMP_ADMIN_LICENSE = 'ลิขสิทธิ์';
var $A_COMP_ADMIN_CALENDAR = 'ปฏิทิน';
var $A_COMP_ADMIN_PUB_DOMAIN = 'เผยแพร่โดเมน';
var $A_COMP_ADMIN_ICONS = 'ไอคอน';
var $A_COMP_ADMIN_INDEX = 'ดัชนี';
var $A_COMP_ADMIN_SITE_PREVIEW = 'ดูตัวอย่างเว็บ';
var $A_COMP_ADMIN_OPEN_NEW_WIN = 'เปิดหน้าต่างใหม่';

//components/com_admin/admin.admin.php
var $A_COMP_ALERT_NO_LINK = 'ไม่มีลิงก์สำหรับรายการนี้';

//components/com_banners/admin.banners.html.php
var $A_COMP_BANNERS_MANAGER = 'การจัดการป้ายโฆษณา';
var $A_COMP_BANNERS_NAME = 'ชื่อป้ายโฆษณา';
var $A_COMP_BANNERS_IMPRESS_MADE = 'แสดงไปแล้ว';
var $A_COMP_BANNERS_IMPRESS_LEFT = 'จำนวนครั้งที่เหลือ';
var $A_COMP_BANNERS_CLICKS = 'คลิก';
var $A_COMP_BANNERS_CLICKS2 = '% คลิก';
var $A_COMP_BANNERS_PUBLISHED = 'เผยแพร่';
var $A_COMP_BANNERS_LOCK = 'นำออก';
var $A_COMP_BANNERS_PROVIDE = 'กรุณาตั้งชื่อป้ายโฆษณา';
var $A_COMP_BANNERS_SELECT_IMAGE = 'กรุณาเลือกรูป.';
var $A_COMP_BANNERS_FILL_URL = 'กรุณาใส่  URL สำหรับป้ายโฆษณา.';
var $A_COMP_BANNERS_BANNER = 'ป้ายโฆษณา';
var $A_COMP_BANNERS_DETAILS = 'รายละเอียด';
var $A_COMP_BANNERS_CLIENT = 'ชื่อลูกค้าโฆษณา';
var $A_COMP_BANNERS_PURCHASED = 'จำนวนครั้งที่แสดง';
var $A_COMP_BANNERS_UNLIMITED = 'ไม่จำกัดจำนวนครั้ง';
var $A_COMP_BANNERS_URL = 'ที่อยู่ URL ของป้ายโฆษณา';
var $A_COMP_BANNERS_SHOW = 'แสดงป้ายโฆษณา';
var $A_COMP_BANNERS_CLICK_URL = 'คลิก URL';
var $A_COMP_BANNERS_CUSTOM = 'โค้ดในการเรียกป้ายโฆษณา';
var $A_COMP_BANNERS_RESET_CLICKS = 'เริ่มจำนวนคลิกใหม่';
var $A_COMP_BANNERS_IMAGE = 'ไฟล์รูปป้ายโฆษณา';
var $A_COMP_BANNERS_CLIENT_MANAGER = 'การจัดการลูกค้าป้ายโฆษณา';
var $A_COMP_BANNERS_NO_ACTIVE = 'จำนวนแบนเนอร์ที่ทำการแสดง';
var $A_COMP_BANNERS_FILL_CL_NAME = 'กรุณาระบุชื่อกลุ่มแบนเนอร์';
var $A_COMP_BANNERS_FILL_CO_NAME = 'กรุณาใส่ชื่อผู้ติดต่อ';
var $A_COMP_BANNERS_FILL_CO_EMAIL = 'กรุณาใส่อีเมลของผู้ติดต่อ';
var $A_COMP_BANNERS_TITLE_CLIENT = 'ชื่อผู้ซื้อป้ายโฆษณา';
var $A_COMP_BANNERS_CONTACT_NAME = 'ชื่อผู้ติดต่อ';
var $A_COMP_BANNERS_CONTACT_EMAIL = 'อีเมลผู้ติดต่อ';
var $A_COMP_BANNERS_EXTRA = 'ข้อมูลเพิ่มเติม';

//components/com_banners/admin.banners.php
var $A_COMP_BANNERS_SELECT_CLIENT = 'เลือกลูกค้า';
var $A_COMP_BANNERS_THE_CLIENT = 'ลูกค้ารายนี้ [ ';
var $A_COMP_BANNERS_EDITED = ' ] กำลังมีการแก้ไขโดยผู้ดูแลท่านอื่นอยู่';
var $A_COMP_BANNERS_DEL_CLIENT = 'ไม่สามารถลบลูกค้าได้เนื่องจากยังมีแถบป้ายโฆษณาของลูกค้าอยู่';

//components/com_categories/admin.categories.html.php
var $A_COMP_CATEG_MANAGER = 'การจัดการประเภท <small><small>[ เนื้อหา: ทั้งหมด ]</small></small>';
var $A_COMP_CATEG_CATEGS = 'ประเภท <small><small>[ %s ]</small></small>';
var $A_COMP_CATEG_NAME = 'ชื่อประเภท';
var $A_COMP_CATEG_ID = 'หมายเลขประเภท';
var $A_COMP_CATEG_MUST_NAME = 'กรุณาใส่ชื่อประเภท';
var $A_COMP_CATEG_DETAILS = 'รายละเอียดประเภท';
var $A_COMP_CATEG_TITLE = 'หัวข้อ';
var $A_COMP_CATEG_TABLE = 'ตาราง';
var $A_COMP_CATEG_BLOG = 'บล็อก ประเภท';
var $A_COMP_CATEG_BLOG_ARCHIVE = 'ประเภทของบล็อกคลังเนื้อหา';
var $A_COMP_CATEG_MESSAGE = 'ประเภท';
var $A_COMP_CATEG_MESSAGE2 = 'กำลังถูกแก้ไขโดยผู้ดูแลท่านอื่นอยู๋';
var $A_COMP_CATEG_MOVE = 'ย้ายประเภท';
var $A_COMP_CATEG_MOVE_TO_SECTION = 'ย้ายไปหมวด';
var $A_COMP_CATEG_BEING_MOVED = 'กำลังย้ายประเภท';
var $A_COMP_CATEG_CONTENT = 'เนื้อหาที่ถูกย้าย';
var $A_COMP_CATEG_MOVE_CATEG = 'นี่จะเป็นการย้ายประเภท';
var $A_COMP_CATEG_ALL_ITEMS = 'และเนื้อหาทั้งหมดในประเภทนี้ด้วย';
var $A_COMP_CATEG_TO_SECTION = 'ไปยังหมวดที่เลือกไว้';
var $A_COMP_CATEG_COPY = 'คัดลอกประเภท';
var $A_COMP_CATEG_COPY_TO_SECTION = 'คัดลอกไปหมวด';
var $A_COMP_CATEG_BEING_COPIED = 'กำลังคัดลอกประเภท';
var $A_COMP_CATEG_ITEMS_COPIED = 'กำลังคัดลอกเนื้อหา';
var $A_COMP_CATEG_COPY_CATEGS = 'นี่จะเป็นการคัดลอกประเภท';

//components/com_categories/admin.categories.php
var $A_COMP_CATEG_DELETE = 'เลือกประเภทที่จะลบ';
var $A_COMP_CATEG_CATEG_S = 'ประเภท';
var $A_COMP_CATEG_CANNOT_REMOVE = 'ไม่สามารถย้ายได้เนื่องจากมีรายการย่อยภายใน';
var $A_COMP_CATEG_SELECT = 'เลือกประเภทเพื่อ';
var $A_COMP_CATEG_ITEM_MOVE = 'เลือกเนื้อหาเพื่อย้าย';
var $A_COMP_CATEG_MOVED_TO = 'ย้ายประเภทไป';
var $A_COMP_CATEG_COPY_OF = 'สำเนาของ';
var $A_COMP_CATEG_COPIED_TO = 'ประเภทถูกทำสำเนาไปยัง';
var $A_COMP_CATEG_SELECT_TYPE = 'เลือกชนิด';
var $A_COMP_CATEG_CONTACT_CATEG_TABLE = 'ตารางประเภทการติดต่อ';
var $A_COMP_CATEG_NEWSFEED_CATEG_TABLE = 'ตารางประเภทการให้ข่าว';
var $A_COMP_CATEG_WEBLINK_CATEG_TABLE = 'ตารางประเภทเว็บลิงก์';
var $A_COMP_CATEG_CONTENT_CATEG_TABLE = 'ตารางประเภท';
var $A_COMP_CATEG_CONTENT_CATEG_BLOG = 'บล็อกประเภทเนื้อหา';
var $A_COMP_CATEG_CONTENT_CATEG_ARCH_BLOG = 'บล็อกประเภทคลังเนื้อหา';

//components/com_checkin/admin.checkin.php
var $A_COMP_CHECK_TITLE = 'เช็คอินทั้งหมด';
var $A_COMP_CHECK_DB_T = 'ตารางฐานข้อมูล';
var $A_COMP_CHECK_NB_ITEMS = '# จำนวนรายการ';
var $A_COMP_CHECK_IN = 'เช็คอิน';
var $A_COMP_CHECK_TABLE = 'ตารางเช็คอิน';
var $A_COMP_CHECK_DONE = 'รายการที่เช็คเอาท์ได้ถูกเช็คอินทั้งหมดแล้ว';

//components/com_config/admin.config.html.php
var $A_COMP_CONF_GC = 'การปรับแต่งระบบ';
var $A_COMP_CONF_IS = 'เป็น';
var $A_COMP_CONF_WRT = 'เขียนได้';
var $A_COMP_CONF_UNWRT = 'เขียนไม่ได้';
//var $A_COMP_CONF_SITE_PAGE = 'site-page';
var $A_COMP_CONF_OFFLINE = 'เว็บออฟไลน์';
var $A_COMP_CONF_OFFMESSAGE = 'ข้อความออฟไลน์';
var $A_COMP_CONF_OFFMESSAGE_TIP = 'ข้อความที่จะแสดงเวลาเว็บปิด';
var $A_COMP_CONF_ERR_MESSAGE = 'ข้อความผิดพลาดของระบบ';
var $A_COMP_CONF_ERR_MESSAGE_TIP = 'ข้อความที่จะแสดงเมื่อติดต่อฐานข้อมูลไม่ได้';
var $A_COMP_CONF_SITE_NAME = 'ชื่อเว็บ';
var $A_COMP_CONF_UN_LINKS = 'แสดงลิงก์ที่ไม่มีสิทธิ์';
var $A_COMP_CONF_UN_LINKS_TIP = 'ถ้าใช่,จะแสดงลิงก์ไปข้อความที่ลงทะเบียนไว้ แม้ว่าคุณจะไม่ได้เข้าสู่ระบบก็ตาม ผู้ใช้จะต้องเข้าสู่ระบบเพื่อดูข้อความเต็ม';
var $A_COMP_CONF_USER_REG = 'อนุญาตให้ผู้ใช้ลงทะเบียน';
var $A_COMP_CONF_USER_REG_TIP = 'ถ้าใช่ ผู้ใช้จะสามารถลงทะเบียนได้เอง';
var $A_COMP_CONF_AC_ACT = 'ใช้การยืนยันลงทะเบียน';
var $A_COMP_CONF_AC_ACT_TIP = 'ถ้าใช่ ผู้ใช้จะได้รับอีเมลที่มีลิงก์เพื่อยืนยันการสมัคร';
var $A_COMP_CONF_REQ_EMAIL = 'ห้ามมีอีเมลซ้ำกัน';
var $A_COMP_CONF_REQ_EMAIL_TIP = 'ถ้าใช่ ผู้ใช้ห้ามมีอีเมลซ้ำกัน';
var $A_COMP_CONF_DEBUG = 'แก้ไขข้อผิดพลาดเว็บ';
var $A_COMP_CONF_DEBUG_TIP = 'ถ้าใช่  จะแสดงข้อความวินิจฉัยและความผิดพลาด SQL เมื่อเกิดความผิดพลาด';
var $A_COMP_CONF_EDITOR = 'ตัวเขียนข้อความแบบเหมือนหน้าจอจริง';
var $A_COMP_CONF_LENGTH = 'ความยาวรายการ';
var $A_COMP_CONF_LENGTH_TIP = 'ตั้งค่าความยาวของรายการในส่วนควบคุมระบบสำหรับผู้ใช้ทุกคน';
var $A_COMP_CONF_SITE_ICON = 'ไอคอนของเว็บไซด์';
var $A_COMP_CONF_SITE_ICON_TIP = 'ถ้าปล่อยว่างไว้หรือหาไฟล์ไม่พบจะใช้ favicon.ico';
//var $A_COMP_CONF_LOCAL_PG = 'Locale-page';
var $A_COMP_CONF_LOCALE = 'ภาษา'; //Locale
var $A_COMP_CONF_LANG = 'ภาษาด้านหน้าเว็บ';
var $A_COMP_CONF_ALANG = 'ภาษาผู้ดูแลระบบ';
var $A_COMP_CONF_TIME_SET = 'ค่าเหลื่อมเวลา';
var $A_COMP_CONF_DATE = 'ตั้งค่าเวลาปัจจุบันที่จะแสดง';
var $A_COMP_CONF_LOCAL = 'ประเทศ';
//var $A_COMP_CONF_CONT_PAGE = 'content-page';
var $A_COMP_CONF_CONTROL = '* พารามิเตอร์เหล่านี้ควบคุมการแสดงผล *';
var $A_COMP_CONF_LINK_TITLES = 'ชื่อเนื้อหาเป็นลิงก์';
var $A_COMP_CONF_MORE_LINK = 'อ่านต่อคลิกที่นี่';
var $A_COMP_CONF_MORE_LINK_TIP = 'ถ้าตั้งค่าเป็นแสดง จะมีข้อความ อ่านต่อคลิกที่นี่';
var $A_COMP_CONF_RATE_VOTE = 'โหวตให้คะแนน';
var $A_COMP_CONF_RATE_VOTE_TIP = 'ถ้าตั้งค่าเป็นแสดง จะมีการโหวตให้คะแนนเนื้อหา';
var $A_COMP_CONF_AUTHOR = 'ชื่อผู้เขียน';
var $A_COMP_CONF_AUTHOR_TIP = 'ถ้าตั้งค่าเป็นแสดง จะมีการแสดงชื่อผู้เขียน สามารถปรับแต่งค่าในเมนูย่อยได้อีกที';
var $A_COMP_CONF_CREATED = 'วันเวลาที่สร้าง';
var $A_COMP_CONF_CREATED_TIP = 'ถ้าตั้งค่าเป็นแสดง จะมีการแสดงวันเวลาที่สร้าง สามารถปรับแต่งค่าในเมนูย่อยได้อีกที';
var $A_COMP_CONF_MOD_DATE = 'วันเวลาที่แก้ไข';
var $A_COMP_CONF_MOD_DATE_TIP = 'ถ้าตั้งค่าเป็นแสดง จะมีการแสดงวันเวลาที่แก้ไข สามารถปรับแต่งค่าในเมนูย่อยได้อีกที';
var $A_COMP_CONF_HITS = 'จำนวนครั้งที่เข้าขม';
var $A_COMP_CONF_HITS_TIP = 'ถ้าตั้งค่าเป็นแสดง จะมีการแสดงจำนวนครั้งที่เข้าขม สามารถปรับแต่งค่าในเมนูย่อยได้อีกที';
var $A_COMP_CONF_PDF = 'ไอคอน PDF';
var $A_COMP_CONF_OPT_MEDIA = 'ตัวเลือกนี้ไม่สามารถใช้ได้เนื่องจากโฟลเดอร์ media ไม่สามารถเขียนได้';
var $A_COMP_CONF_PRINT_ICON = 'ไอคอนพิมพ์';
var $A_COMP_CONF_EMAIL_ICON = 'ไอคอนอีเมล';
var $A_COMP_CONF_ICONS = 'ไอคอน';
var $A_COMP_CONF_USE_OR_TEXT = 'เลือกการใช้ไอคอนหรือตัวหนังสือสำหรับ PDF การพิมพ์หรืออีเมล ';
var $A_COMP_CONF_TBL_CONTENTS = 'ตารางสารบัญสำหรับเนื้อหาที่มีหลายหน้า';
var $A_COMP_CONF_BACK_BUTTON = 'ปุ่มย้อนกลับ';
var $A_COMP_CONF_CONTENT_NAV = 'แผงนำทางเนื้อหา';
var $A_COMP_CONF_HYPER = 'ชื่อเนื้อหาคลิกได้';
//var $A_COMP_CONF_DB_PAGE = 'db-page';
var $A_COMP_CONF_HOSTNAME = 'ชื่อโฮสต์';
var $A_COMP_CONF_DB_USERNAME = 'ชื่อผู้ใช้';
var $A_COMP_CONF_DB_PW = 'พาสเวิร์ด';
var $A_COMP_CONF_DB_NAME = 'ดาต้าเบส';
var $A_COMP_CONF_DB_PREFIX = 'คำนำหน้าดาต้าเบส';
var $A_COMP_CONF_NOT_CH = '!! อย่าเปลี่ยนถ้าคุณไม่แน่ใจ!!';
//Svar $A_COMP_CONF_S_PAGE = 'server-page';
var $A_COMP_CONF_ABS_PATH = 'ค่าเต็มของพาธ';
var $A_COMP_CONF_LIVE = 'ที่อยู่จริง';
var $A_COMP_CONF_SECRET = 'คำลับ';
var $A_COMP_CONF_GZIP = 'บีบอัดด้วย GZIP';
var $A_COMP_CONF_CP_BUFFER = 'บีบอัดบับเฟอร์ ถ้าสามารถทำได้';
var $A_COMP_CONF_SESSION_TIME = 'เวลาเซสชั่นสำหรับการล็อกอิน';
var $A_COMP_CONF_SEC = 'วินาที';
var $A_COMP_CONF_AUTO_LOGOUT = 'ล็อกเอาท์อัตโนมัติหลังจากเวลา';
var $A_COMP_CONF_ERR_REPORT = 'รายงานความผิดพลาด';
var $A_COMP_CONF_REG_GLOBALS_EMU = 'การจำค่าการลงทะเบียน'; ///
var $A_COMP_CONF_REG_GLOBALS_EMU_DESC = 'การจำค่าการลงทะเบียน. คอมโพเน้นท์จำนวนหนึ่งอาจหยุดทำงานเมื่อตั้งค่าตัวเลือกนี้เป็น Off.';
var $A_COMP_CONF_HELP_SERVER = 'เซิร์ฟเวอร์ที่ให้ความช่วยเหลือ';
var $A_COMP_CONF_FILE_CREATION = 'การสร้างไฟล์';
var $A_COMP_CONF_FILE_PERM = 'การเข้าถึงไฟล์';
var $A_COMP_CONF_FILE_DONT_CHMOD = 'ไม่เปลี่ยน CHMOD ไฟล์ใหม่';
var $A_COMP_CONF_FILE_CHMOD = 'เปลี่ยน CHMOD ไฟล์ใหม่';
var $A_COMP_CONF_FILE_CHMOD_TIP = 'เลือกการตั้งค่านี้เพื่อกำหนดการเข้าถึงสำหรับไฟล์ที่สร้างใหม่';
var $A_COMP_CONF_APPLY_FILE = 'ทำกับไฟล์ที่มีอยู่';
var $A_COMP_CONF_APPLY_FILE_TIP = 'เลือกข้อนี้จะเปลี่ยนการเข้าถึงไฟล์ที่มีอยู่ทั้งหมด การใช้ตัวเลือกนี้อย่างไม่เหมาะสมอาจทำให้เว็บไม่ทำงาน';
var $A_COMP_CONF_DIR_CREATION = 'การสร้างไดเรกทอรี่่';
var $A_COMP_CONF_DIR_PERM = 'การเข้าถึงไดเรกทอรี่่';
var $A_COMP_CONF_DIR_DONT_CHMOD = 'ไม่เปลี่ยน(CHMOD)การเข้าถึงไดเรกทอรี่่ใหม่ ';
var $A_COMP_CONF_DIR_CHMOD = 'เปลี่ยน(CHMOD)การเข้าถึงไดเรกทอรี่่ใหม่';
var $A_COMP_CONF_DIR_CHMOD_TIP = 'เลือกข้อนี้เพื่อตั้งค่าการเข้าถึงไดเรกทอรี่่ใหม่';
var $A_COMP_CONF_APPLY_DIR = 'ทำกับไดเรกทอรี่่ที่มีอยู่';
var $A_COMP_CONF_APPLY_DIR_TIP = 'เลือกข้อนี้จะเปลี่ยนการเข้าถึงไดเรกทอรี่่ที่มีอยู่ทั้งหมด การใช้ตัวเลือกนี้อย่างไม่เหมาะสมอาจทำให้เว็บไม่ทำงาน';
var $A_COMP_CONF_USER = 'ผู้ใช้';
var $A_COMP_CONF_GROUP = 'กลุ่ม';
var $A_COMP_CONF_WORLD = 'ทั้งหมด';
var $A_COMP_CONF_READ = 'อ่าน';
var $A_COMP_CONF_WRITE = 'เขียน';
var $A_COMP_CONF_EXECUTE = 'ทำงาน';
var $A_COMP_CONF_SEARCH = 'ค้นหา';
//var $A_COMP_CONF_META_PAGE = 'metadata-page';
var $A_COMP_CONF_META_DESC = 'รายละเอียดค่าแท็กเมต้าของเว็บ';
var $A_COMP_CONF_META_KEY = 'คำสำคัญในแท็กเมต้าของเว็บ';
var $A_COMP_CONF_META_TITLE = 'แสดงชื่อเว็บในแท็กเมต้าของเว็บ';
var $A_COMP_CONF_META_ITEMS = 'แสดงชื่อเว็บในแท็กเมต้าของเว็บเมื่ออ่านเนื้อหา';
var $A_COMP_CONF_META_AUTHOR = 'แสดงชื่อผู้เขียนในแท็กเมต้า';
var $A_COMP_CONF_META_AUTHOR_TIP = 'แสดงชื่อผู้เขียนในแท็กเมต้าของเว็บเมื่ออ่านเนื้อหา';
//var $A_COMP_CONF_MAIL_PAGE = 'mail-page';
var $A_COMP_CONF_MAIL = 'ตัวส่งเมล';
var $A_COMP_CONF_MAIL_FROM = 'ส่งเมลจาก';
var $A_COMP_CONF_MAIL_FROM_NAME = 'จากชื่อ';
var $A_COMP_CONF_MAIL_SENDMAIL_PATH = 'พาธการส่งเมล';
var $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP Auth';
var $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP User';
var $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP Pass';
var $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP Host';
//var $A_COMP_CONF_CACHE_PAGE = 'cache-page';
var $A_COMP_CONF_CACHE = 'มีการเก็บแคช';
var $A_COMP_CONF_CACHE_FOLDER = 'โฟลเดอร์แคช';
var $A_COMP_CONF_CACHE_DIR = 'ไดเรกทอรี่่ที่เก็บแคชในตอนนี้คือ';
var $A_COMP_CONF_CACHE_DIR_UNWRT = 'ไดเรกทอรี่่ที่เก็บแคชไม่สามารถเขียนได้ กรุณาตั้งค่าเป็น CHMOD755 ก่อนที่จะใช้แคช';
var $A_COMP_CONF_CACHE_TIME = 'ระยะเวลาแคช';
//var $A_COMP_CONF_STATS_PAGE = 'stats-page';
var $A_COMP_CONF_STATS = 'สถิติ';
var $A_COMP_CONF_STATS_ENABLE = 'ตั้งค่าการเก็บสถิติของเว็บ';
var $A_COMP_CONF_STATS_LOG_HITS = 'เก็บจำนวนการเข้าชมแต่ละวัน';
var $A_COMP_CONF_STATS_WARN_DATA = 'คำเตือน:จะมีการเก็บข้อมูลจำนวนมาก';
var $A_COMP_CONF_STATS_LOG_SEARCH = 'เก็บคำค้นหา';
//var $A_COMP_CONF_SEO_PAGE = 'seo-page';
var $A_COMP_CONF_SEO_LBL = 'SEO';
var $A_COMP_CONF_SEO = 'ปรับแต่งสำหรับเครื่องมือค้นหาเว็บ';
var $A_COMP_CONF_SEO_SEFU = 'ชื่อ URL แบบง่ายเหมาะกับเครื่องมือค้นหาเว็บ';
var $A_COMP_CONF_SEO_APACHE = 'สำหรับอาปาเช่เท่านั้น ! ให้เปลี่ยนชื่อ htaccess.txt เป็น .htaccess ก่อนจะใช้งาน';
var $A_COMP_CONF_SEO_DYN = 'ชื่อเว็บเปลี่ยนได้ตามเนื้อหา';
var $A_COMP_CONF_SEO_DYN_TITLE = 'ชื่อเว็บเปลี่ยนได้ตามเนื้อหา';
var $A_COMP_CONF_SERVER = 'เซิร์ฟเวอร์';
var $A_COMP_CONF_METADATA = 'เมตาดาต้า';
var $A_COMP_CONF_EMAIL = 'เมล';
var $A_COMP_CONF_CACHE_TAB = 'แคช';

//components/com_config/admin.config.php
var $A_COMP_CONF_HIDE = 'ซ่อน';
var $A_COMP_CONF_SHOW = 'แสดง';
var $A_COMP_CONF_DEFAULT = 'ค่าปกติของระบบ';
var $A_COMP_CONF_NONE = 'ไม่';
var $A_COMP_CONF_SIMPLE = 'ง่าย';
var $A_COMP_CONF_MAX = 'มากสุด';
var $A_COMP_CONF_MAIL_FC = 'ใช้การส่งเมลของ PHP';
var $A_COMP_CONF_SEND = 'ส่งเมล';
var $A_COMP_CONF_SMTP = 'SMTP เซิร์ฟเวอร์';
var $A_COMP_CONF_UPDATED = 'The Configuration Details have been updated!'; //รายละเอียดการตั้งค่าได้ถูกปรับปรุงแล้ว
var $A_COMP_CONF_ERR_OCC = 'มีความผิดพลาด ไม่สามารถเปิดไฟล์ระบบเพื่อเขียนได้';

//components/com_contact/admin.contact.html.php
var $A_COMP_CONT_MANAGER = 'จัดการการติดต่อ';
var $A_COMP_CONT_FILTER = 'ค้นหา';
var $A_COMP_CONT_YOUR_NAME = 'คุณต้องใส่ชื่อ';
var $A_COMP_CONT_CATEG = 'เลือกประเภท';
var $A_COMP_CONT_DETAILS = 'รายละเอียดการติดต่อ';
var $A_COMP_CONT_POSITION = 'ตำแหน่งของผู้ติดต่อ';
var $A_COMP_CONT_ADDRESS = 'ที่อยู่ ถนน';
var $A_COMP_CONT_TOWN = 'ตำบล อำเภอ';
var $A_COMP_CONT_STATE = 'จังหวัด';
var $A_COMP_CONT_COUNTRY = 'ประเทศ';
var $A_COMP_CONT_POSTAL_CODE = 'รหัสไปรษณีย์';
var $A_COMP_CONT_TEL = 'โทรศัพท์';
var $A_COMP_CONT_FAX = 'แฟกซ์';
var $A_COMP_CONT_INFO = 'รายละเอียดอื่นๆ';
//var $A_COMP_CONT_PUBLISH = 'publish-page';
var $A_COMP_CONT_PUBLISHING = 'รายละเอียดการเผยแพร่';
var $A_COMP_CONT_SITE_DEFAULT = 'ค่าเริ่มต้นของเว็บ';
//var $A_COMP_CONT_IMG_PAGE = 'images-page';
var $A_COMP_CONT_IMG_INFO = 'รายละเอียดรูป';
var $A_COMP_CONT_PARAMS = 'หน้าการตั้งค่าพารามิเตอร์';
var $A_COMP_CONT_PARAMETERS = 'พารามิเตอร์';
var $A_COMP_CONT_PARAM_MESS = '* พารามิเตอร์เหล่านี้ควบคุมการแสดงผลเมื่อคุณดูการติดต่อ *';
var $A_COMP_CONT_PUB_TAB = 'เผยแพร่';
var $A_COMP_CONT_IMG_TAB = 'รูป';

//components/com_contact/admin.contact.php
var $A_COMP_CONT_SELECT_REC = 'เลือกรายการเพื่อ';

//components/com_content/admin.content.html.php
var $A_COMP_CONTENT_ITEMS_MNG = 'การจัดการเนื้อหา';
var $A_COMP_CONTENT_ALL_ITEMS = 'เนื้อหาทั้งหมด';
var $A_COMP_CONTENT_START_ALWAYS = 'เริ่มต้น:เสมอ';
var $A_COMP_CONTENT_START = 'เริ่ม';
var $A_COMP_CONTENT_FIN_NOEXP = 'จบ:ไม่หมดอายุ';
var $A_COMP_CONTENT_FINISH = 'จบ';
var $A_COMP_CONTENT_PUBLISH_INFO = 'รายละเอียดการพิมพ์';
var $A_COMP_CONTENT_TRASH = 'โปรดเลือกรายการที่ต้องการลบ';
var $A_COMP_CONTENT_TRASH_MESS = 'คุณแน่ใจหรือไม่ ว่าจะโยนที่เลือกไว้ทิ้ง? \n อันนี้จะไม่ได้ลบแบบสมบรูณ์ ';//Are you sure you want to Trash the selected items? \nThis will not permanently delete the items.
var $A_COMP_CONTENT_ARCHIVE = 'จัดเก็บคลังเนื้อหา';
var $A_COMP_CONTENT_ARCHIVE_MNG = 'การจัดการคลังเนื้อหา';
var $A_COMP_CONTENT_MANAGER = 'การจัดการ';
var $A_COMP_CONTENT_ZERO = 'คุณแน่ใจหรือไม่ ที่จะตั้งค่าจำนวนครั้งให้เป็นศูนย์ \n การเปลี่ยนแปลงที่ยังไม่ได้บันทึกจะหายไปด้วย';
var $A_COMP_CONTENT_MUST_TITLE = 'เนื้อหาต้องมีหัวเรื่อง';
var $A_COMP_CONTENT_MUST_NAME = 'เนื้อหาต้องมีชื่อเรื่อง';
var $A_COMP_CONTENT_MUST_SECTION = 'คุณต้องเลือกหมวด';
var $A_COMP_CONTENT_MUST_CATEG = 'คุณต้องเลือกประเภท';
var $A_COMP_CONTENT_ITEMS = 'รายการเนื้อหา';
var $A_COMP_CONTENT_IN = 'เนื้อหาใน';
var $A_COMP_CONTENT_TITLE_ALIAS = 'ชื่อแทนหัวเรื่อง';
var $A_COMP_CONTENT_ITEM_DETAILS = 'รายละเอียดรายการ';
var $A_COMP_CONTENT_INTRO = 'ข้อความส่วนต้น';
var $A_COMP_CONTENT_MAIN = 'ข้อความหลัก';
var $A_COMP_CONTENT_PUB_INFO = 'รายละเอียดการเผยแพร่';
var $A_COMP_CONTENT_FRONTPAGE = 'แสดงในหน้าแรก';
var $A_COMP_CONTENT_AUTHOR = 'ชื่อแทนผู้เขียน';
var $A_COMP_CONTENT_CREATOR = 'เปลี่ยนผู้สร้าง';
var $A_COMP_CONTENT_OVERRIDE = 'แก้ไขวันที่สร้าง';
var $A_COMP_CONTENT_START_PUB = 'เริ่มเผยแพร่';
var $A_COMP_CONTENT_FINISH_PUB = 'สิ้นสุดการเผยแพร่';
var $A_COMP_CONTENT_ID = 'หมายเลขเนื้อหา';
var $A_COMP_CONTENT_DRAFT_UNPUB = 'ต้นฉบับยังไม่เผยแพร่';
var $A_COMP_CONTENT_RESET_HIT = 'เริ่มต้นนับใหม่';
var $A_COMP_CONTENT_REVISED = 'ทบทวน';
var $A_COMP_CONTENT_TIMES = 'ครั้ง';
var $A_COMP_CONTENT_CREATED = 'สร้าง';
var $A_COMP_CONTENT_BY = 'โดย';
var $A_COMP_CONTENT_NEW_DOC = 'เนื้อหาใหม่';
var $A_COMP_CONTENT_LAST_MOD = 'แก้ไขครั้งสุดท้าย';
var $A_COMP_CONTENT_NOT_MOD = 'ไม่แก้ไข';
var $A_COMP_CONTENT_MOSIMAGE = 'ควบคุมรูปแมมโบ';
var $A_COMP_CONTENT_SUB_FOLDER = 'โฟลเดอร์ย่อย';
var $A_COMP_CONTENT_GALLERY = 'แกลลอรี่รูปภาพ';
var $A_COMP_CONTENT_IMAGES = 'รูปในเนื้อหา';
var $A_COMP_CONTENT_UP = 'ขึ้น';
var $A_COMP_CONTENT_DOWN = 'ลง';
var $A_COMP_CONTENT_REMOVE = 'ย้าย';
var $A_COMP_CONTENT_EDIT_IMAGE = 'แก้ไขรูปที่เลือก';
var $A_COMP_CONTENT_IMG_ALIGN = 'จัดวางรูป';
var $A_COMP_CONTENT_ALIGN = 'จัดวาง';
var $A_COMP_CONTENT_ALT = 'ข้อความของรูป';
var $A_COMP_CONTENT_BORDER = 'ขอบ';
var $A_COMP_CONTENT_IMG_CAPTION = 'หัวข้อ';
var $A_COMP_CONTENT_IMG_CAPTION_POS = 'ตำแหน่งหัวข้อ';
var $A_COMP_CONTENT_IMG_CAPTION_ALIGN = 'การจัดวางหัวข้อ';
var $A_COMP_CONTENT_IMG_WIDTH = 'กว้าง';
var $A_COMP_CONTENT_APPLY = 'กระทำ';
var $A_COMP_CONTENT_PARAM = 'ควบคุมพารามิเตอร์';
var $A_COMP_CONTENT_PARAM_MESS = '* พารามิเตอร์เหล่านี้ควบคุมการแสดงผลเมื่อคุณดูเนื้อหา *';
var $A_COMP_CONTENT_META_DATA = 'ข้อมูลเมต้า';
var $A_COMP_CONTENT_KEYWORDS = 'คำสำคัญ';
//var $A_COMP_CONTENT_LINK_PAGE = 'link-page';
var $A_COMP_CONTENT_LINK_CI = 'นี่จะเป็นการสร้างลิงก์ ให้เนื้อหาในเมนู';
var $A_COMP_CONTENT_LINK_NAME = 'ชื่อลิงก์';
var $A_COMP_CONTENT_SOMETHING = 'โปรดเลือกบางอย่าง';
var $A_COMP_CONTENT_MOVE_ITEMS = 'ย้ายรายการ';
var $A_COMP_CONTENT_MOVE_SECCAT = 'ย้ายไปยัง หมวด/ประเภท';
var $A_COMP_CONTENT_ITEMS_MOVED = 'รายการกำลังถูกย้าย';
var $A_COMP_CONTENT_SECCAT = 'โปรดเลือกหมวด/ประเภทที่จะทำสำเนารายการไปไว้';
var $A_COMP_CONTENT_COPY_ITEMS = 'ทำสำเนาเนื้อหา';
var $A_COMP_CONTENT_COPY_SECCAT = 'ทำสำเนาไปหมวด/ประเภท';
var $A_COMP_CONTENT_ITEMS_COPIED = 'รายการกำลังถูกทำสำเนา';
var $A_COMP_CONTENT_PUBLISHING = 'เผยแพร่';
var $A_COMP_CONTENT_IMAGES2 = 'รูป';
var $A_COMP_CONTENT_META_INFO = 'รายละเอียดเมต้า';
var $A_COMP_CONTENT_ADD_ETC = 'เพิ่มหมวด/ประเภท/หัวเรื่อง';
var $A_COMP_CONTENT_LINK_TO_MENU = 'ลิงก์ไปเมนู';
var $A_COMP_CONTENT_EDIT_CONTENT = 'แก้ไขเนื้อหา';
var $A_COMP_CONTENT_EDIT_STATIC = 'แก้ไขเนื้อหาสเตติก';
var $A_COMP_CONTENT_EDIT_SECTION = 'แก้ไขหมวด';
var $A_COMP_CONTENT_EDIT_CATEGORY = 'แก้ไขประเภท';
var $A_COMP_CONTENT_EDIT_USER = 'แก้ไขผู้ใช้';
//components/com_content/admin.content.php
var $A_COMP_CONTENT_CACHE = 'ล้างแคช';
var $A_COMP_CONTENT_CANNOT = 'ไม่สามารถลบคลังเนื้อหา';
var $A_COMP_CONTENT_MODULE = 'โมดูล';
var $A_COMP_CONTENT_ANOTHER = 'กำลังถูกแก้ไขโดยผู้ดูแลท่านอื่น';
var $A_COMP_CONTENT_ARCHIVED = 'รายการได้เป็นคลังเนื้อหาเรียบร้อยแล้ว';
var $A_COMP_CONTENT_PUBLISHED = 'รายการได้ถูกเผยแพร่แล้ว';
var $A_COMP_CONTENT_UNPUBLISHED = 'ยกเลิกการเผยแพร่แล้ว';
var $A_COMP_CONTENT_SEL_TOG = 'เลือกรายการที่จะเปลี่ยน';
var $A_COMP_CONTENT_SEL_DEL = 'เลือกรายการที่จะย้าย';
var $A_COMP_CONTENT_SEL_MOVE = 'รายการได้ถูกย้ายไปหมวดที่ต้องการแล้ว';
var $A_COMP_CONTENT_MOVED = 'รายการได้ถูกย้ายไปหมวดที่ต้องการแล้ว';
var $A_COMP_CONTENT_ERR_OCCURRED = 'มีความผิดพลาดเกิดขึ้น';
var $A_COMP_CONTENT_COPIED = 'รายการได้ถูกทำสำเนาไปหมวดที่ต้องการแล้ว';
var $A_COMP_CONTENT_RESET_HIT_COUNT = 'ได้ตั้งค่าการนับใหม่แล้วสำหรับ';
var $A_COMP_CONTENT_IN_MENU = '(ลิงก์ เนื้อหาสเตติก) ในเมนู';
var $A_COMP_CONTENT_SUCCESS = 'สร้างเรียบร้อย';
var $A_COMP_CONTENT_SELECT_CAT = 'เลือกประเภท';
var $A_COMP_CONTENT_SELECT_SEC = 'เลือกหมวด';

//components/com_content/toolbar.content.html.php
var $A_COMP_CONTENT_BAR_TRASH = 'ถังขยะ';
var $A_COMP_CONTENT_BAR_MOVE = 'ย้าย';
var $A_COMP_CONTENT_BAR_COPY = 'ทำสำเนา';
var $A_COMP_CONTENT_BAR_SAVE = 'บันทึก';

//components/com_frontpage/admin.frontpage.html.php
var $A_COMP_FRONT_PAGE_MNG = 'จัดการหน้าแรก';
//var $A_COMP_FRONT_PAGE_ITEMS = 'Front Page Items';
var $A_COMP_FRONT_ORDER = 'ลำดับ';

//components/com_frontpage/admin.frontpage.php
var $A_COMP_FRONT_COUNT_NUM = 'จำนวนต้องเป็นตัวเลข';
var $A_COMP_FRONT_INTRO_NUM = 'จำนวนต้องเป็นตัวเลข';
var $A_COMP_FRONT_WELCOME = 'ขอต้อนรับสู่หน้าแรก';
var $A_COMP_FRONT_IDONOT = 'ฉันไม่มีอะไรจะแสดง';

//components/com_frontpage/toolbar.frontpage.html.php
var $A_COMP_FRONT_REMOVE = 'เอาออก';

//components/com_languages/admin.languages.html.php
var $A_COMP_LANG_INSTALL = 'การจัดการภาษา <small><small>[ เว็บไซต์ ]</small></small>';
var $A_COMP_LANG_LANG = 'ภาษา';
var $A_COMP_LANG_EMAIL = 'อีเมลผู้เขียน';
var $A_COMP_LANG_EDITOR = 'บรรณาธิการภาษา';
var $A_COMP_LANG_FILE = 'ไฟล์ภาษา';

//components/com_languages/admin.languages.php
var $A_COMP_LANG_UPDATED = 'การตั้งค่าได้ถูกปรับปรุงแล้ว';
var $A_COMP_LANG_M_SURE = 'ผิดพลาด ! แน่ใจแล้วหรือยังว่า configuration.php สามารถเขียนได้';
var $A_COMP_LANG_CANNOT = 'คุณไม่สามารถลบภาษาที่กำลังใช้ได้';
var $A_COMP_LANG_FAILED_OPEN = 'การทำงานล้มเหลว:ไม่สามารถเปิด';
var $A_COMP_LANG_FAILED_SPEC = 'การทำงานล้มเหลว:ไม่ระบุภาษา';
var $A_COMP_LANG_FAILED_EMPTY = 'การทำงานล้มเหลว:ข้อความว่าง';
var $A_COMP_LANG_FAILED_UNWRT = 'การทำงานล้มเหลว:ไม่สามารถเขียน';
var $A_COMP_LANG_FAILED_FILE = 'การทำงานล้มเหลว:ไม่สามารถเปิดไฟล์เพื่อเขียนได้';

//components/com_mambots/admin.mambots.html.php
var $A_COMP_MAMB_ADMIN = 'ผู้ดูแล';
var $A_COMP_MAMB_SITE = 'เว็บไซต์';
var $A_COMP_MAMB_MANAGER = 'การจัดการแมมบอท';
var $A_COMP_MAMB_NAME = 'ชื่อแมมบอท';
var $A_COMP_MAMB_FILE = 'ไฟล์';
var $A_COMP_MAMB_MUST_NAME = 'แมมบอทจะต้องมีชื่อ';
var $A_COMP_MAMB_MUST_FNAME = 'แมมบอทจะต้องมีชื่อไฟล์';
var $A_COMP_MAMB_DETAILS = 'รายละเอียดแมมบอท';
var $A_COMP_MAMB_FOLDER = 'โฟลเดอร์';
var $A_COMP_MAMB_MFILE = 'ไฟล์แมมบอท';
var $A_COMP_MAMB_ORDER = 'ลำดับแมมบอท';

//components/com_mambots/admin.mambots.php
var $A_COMP_MAMB_EDIT = 'กำลังถูกแก้ไขโดยผู้ดูแลท่านอื่น';
var $A_COMP_MAMB_DEL = 'เลือกโมดูลที่จะลบ';
var $A_COMP_MAMB_TO = 'เลือกแมมบอทเพื่อ';
var $A_COMP_MAMB_PUB = 'เผยแพร่';
var $A_COMP_MAMB_UNPUB = 'ยกเลิกการเผยแพร่';
var $A_COMP_MAMB_SAVED_CHANGES = 'บันทึกการเปลี่ยนแปลงของแมมบอทเรียบร้อย: '; //KEN ADDED
var $A_COMP_MAMB_SAVED = 'การบันทึกแมมบอทเรียบร้อย: '; //KEN ADDED
var $A_COMP_MAMB_ORDERING = 'ค่าเริ่มต้นของรายการใหม่อยู่ลำดับสุดท้าย ลำดับสามารถแก้ไขได้ภายหลังจากบันทึกแล้ว'; //KEN ADDED
var $A_COMP_MAMB_ORDERING_SAVED = 'บันทึกการแมมบอทเรียบร้อย '; //KEN ADDED

//components/com_massmail/admin.massmail.html.php
var $A_COMP_MASS_SUBJECT = 'โปรดใส่หัวข้อ';
var $A_COMP_MASS_SELECT_GROUP = 'โปรดเลือกกลุ่ม';
var $A_COMP_MASS_MESSAGE = 'โปรดใส่ข้อความ';
var $A_COMP_MASS_MAIL = 'เมลกลุ่ม';
var $A_COMP_MASS_GROUP = 'กลุ่ม';
var $A_COMP_MASS_DETAILS = 'รายละเอียด'; //KEN ADDED
var $A_COMP_MASS_CHILD = 'ส่งเมลไปยังกลุ่มย่อยด้วย';
var $A_COMP_MASS_HTML = 'ส่งในรูปแบบ HTML'; //KEN ADDED
var $A_COMP_MASS_SUB = 'หัวข้อ';
var $A_COMP_MASS_MESS = 'ข้อความ';

//components/com_massmail/toolbar.massmail.html.php
var $A_COMP_MASS_SEND = 'ส่งเมล';

//components/com_massmail/admin.massmail.php
var $A_COMP_MASS_ALL = 'ผู้ใช้ทุกกลุ่ม';
var $A_COMP_MASS_FILL = 'โปรดกรอกฟอร์มให้ถูกต้อง';
var $A_COMP_MASS_SENT = 'ส่งเมลไป';
var $A_COMP_MASS_USERS = 'ผู้ใช้';

//components/com_media/admin.media.html.php
var $A_COMP_MEDIA_MG = 'การจัดการมีเดียไฟล์';
var $A_COMP_MEDIA_DIR = 'ไดเรกทอรี่่';
var $A_COMP_MEDIA_UP = 'ขึ้น';
var $A_COMP_MEDIA_UPLOAD = 'อัพโหลด';
var $A_COMP_MEDIA_UPLOAD_MAX = 'ขนาดสูงสุด';
var $A_COMP_MEDIA_CODE = 'โคด';
var $A_COMP_MEDIA_CDIR = 'สร้างไดเรกทอรี่่';
var $A_COMP_MEDIA_PROBLEM = 'ปัญหาการตั้งค่า';
var $A_COMP_MEDIA_EXIST = 'ไม่มีอยู่.';
var $A_COMP_MEDIA_DEL = 'ลบ';
var $A_COMP_MEDIA_INSERT = 'ใส่ข้อความที่นี่';
var $A_COMP_MEDIA_DEL_FILE = "ลบไฟล์ \"+file+\"?";
var $A_COMP_MEDIA_DEL_ALL = "มี \"+numFiles+\" ไฟล์/โฟลเดอร์ใน \"+folder+\". โปรดลบทุกไฟล์/โฟลเดอร์ใน \"+folder+\" ก่อน";
var $A_COMP_MEDIA_DEL_FOLD = "ลบโฟลเดอร์ \"+folder+\"?";
var $A_COMP_MEDIA_NO_IMG = 'ไม่พบรูป';

//components/com_media/admin.media.php
var $A_COMP_MEDIA_NO_HACK = 'กรุณาอย่าแฮก';
var $A_COMP_MEDIA_DIR_SAFEMODE = 'การสร้างไดเรกทอรี่่ไม่สามารถทำได้ขณะที่อยู่ในเซพโหมด เนื่องจากจะก่อให้เกิดปัญหาได้';
var $A_COMP_MEDIA_ALPHA = 'ชื่อไดเรคตอรี่ต้องใช้ตัวอักษรตัวเลขห้ามมีช่องว่าง';
var $A_COMP_MEDIA_FAILED = 'การอัพโหลดล้มเหลว มีไฟล์อยู่แล้ว';
var $A_COMP_MEDIA_ONLY = 'เฉพาะไฟล์ gif, png, jpg, bmp, pdf, swf, doc, xls หรือ ppt จึงจะอัพโหลดได้';
var $A_COMP_MEDIA_UP_FAILED = 'การอัพโหลดล้มเหลว';
var $A_COMP_MEDIA_UP_COMP = 'อัพโหลเรียบร้อย';
var $A_COMP_MEDIA_NOT_EMPTY = '<font color="red">ไม่สามารถลบ: ไม่ว่าง!</font>';//KEN ADDED
//components/com_media/toolbar.media.html.php
var $A_COMP_MEDIA_CREATE = 'สร้าง';

//components/com_menumanager/admin.menumanager.html.php
var $A_COMP_MENU_NAME = 'ชื่อเมนู';
var $A_COMP_MENU_TYPE = 'ชนิดเมนู';
var $A_COMP_MENU_TITLE = 'ชื่อโมดูล';
var $A_COMP_MENU_ITEMS = 'รายการโมดูล';//KEN ADDED
var $A_COMP_MENU_PUB = '# เผยแพร่';//KEN ADDED
var $A_COMP_MENU_UNPUB = '# ไม่เผยแพร่';//KEN ADDED
var $A_COMP_MENU_TRASH = '# ถังขยะ';//KEN ADDED
var $A_COMP_MENU_MODULES = '# โมดูล';//KEN ADDED
var $A_COMP_MENU_EDIT_NAME = 'แก้ไขชื่อเมนู';//KEN ADDED
var $A_COMP_MENU_EDIT_ITEM = 'แก้ไขรายการเมนู';//KEN ADDED
var $A_COMP_MENU_ID = 'หมายเลขโมดูล';
var $A_COMP_MENU_TIPS = 'นี่เป็นการพิสูจน์ชื่อที่ใช้โดยแมมโบ ดังนั้นชื่อไม่ควรมีช่องว่างและไม่ซ้ำกับชื่ออื่น';//KEN ADDED
var $A_COMP_MENU_TIPS2 = 'ชื่อของโมดูล mod_mainmenu ต้องการแสดงในเมนู';//KEN ADDED
var $A_COMP_MENU_TIPS3 = '* โมดูล mod_mainmenu ใหม่,ที่อยู่ในชื่อโมดูลที่คุณกรอกไว้จะถูกบันทึกโดยอัตโนมัติเมื่อคุณบันทึกเมนู *<br/><br/>การตั้งค่าต่างๆสามารถแก้ไขในส่วน "การจัดการโมดูล [ เว็บไซต์ ]":  โมดูล -> โมดูลเว็บ';//KEN ADDED
var $A_COMP_MENU_ASSIGN = 'ไม่มีโมดูลที่ต้องการแสดงในเมนู';
var $A_COMP_MENU_ENTER = 'โปรดใส่ชื่อเมนูที่ต้องการ';
var $A_COMP_MENU_ENTER_TYPE = 'โปรดใส่ชื่อประเภทเมนูที่ต้องการ';
var $A_COMP_MENU_ENTER_TITLE = 'โปรดใส่ชื่อโมดูลที่ต้องการ';
var $A_COMP_MENU_DETAILS = 'รายละเอียดของเมนู';
var $A_COMP_MENU_MAINMENU = 'โมดูล mod_mainmenu ที่มีชื่อซ้ำ ระบบจะทำการสร้าง และแก้ไขให้อัตโนมัติ เมื่อคุณบันทึกเมนูนี้.';
var $A_COMP_MENU_DEL = 'ลบเมนู';
var $A_COMP_MENU_MODULE_DEL = 'เมนู/โมดูลถูกลบ';
var $A_COMP_MENU_ITEMS_DEL = 'รายการเมนูถูกลบ';
var $A_COMP_MENU_WILL = '* นี่จะ';
var $A_COMP_MENU_WILL2 = 'เมนูนี้, <br />โปรดระวัง เมนูนี้อาจเชื่อมโยงกับเมนูอื่นอยู่ *';
var $A_COMP_MENU_YOU_SURE = 'คุณต้องการที่จะลบเมนูนี้หรือไม่? \nระบบจะลบรายการเมนู และโมดูลของเมนูนี้ทั้งหมด';
var $A_COMP_MENU_NAME_MENU = 'โปรดใส่ชื่อสำเนาของเมนู';
var $A_COMP_MENU_NAME_MOD = 'โปรดใส่ชื่อโมดูลใหม่';
var $A_COMP_MENU_COPY = 'คัดลอกเมนู';
var $A_COMP_MENU_NEW = 'ชื่อเมนูใหม่';
var $A_COMP_MENU_NEW_MOD = 'ชื่อโมดูลใหม่';//KEN ADDED
var $A_COMP_MENU_COPIED = 'กำลังคัดลอกเมนู';
var $A_COMP_MENU_ITEMS_COPIED = 'คัดลอกรายการเมนู';
var $A_COMP_MENU_MOD_MENU = 'ชื่อเหมือนกัน<br />ระบบจะสร้างและบันทึกให้อัตโนมัติ';

//components/com_menumanager/admin.menumanager.php
var $A_COMP_MENU_CREATED = 'สร้างเมนูใหม่';
var $A_COMP_MENU_UPDATED = 'รายการเมนูและโมดูลถูกปรับปรุง';
var $A_COMP_MENU_DETECTED = 'ลบเมนู';
var $A_COMP_MENU_COPY_OF = 'คัดลอกเมนู';
var $A_COMP_MENU_CONSIST = 'สร้าง, ประกอบกับ';
var $A_COMP_MENU_RENAME_WARNING = 'คุณไม่สามารถเปลี่ยนชื่อเมนูหลักเนื่องจากจะทำให้ Mambo ทำงานผิดพลาด';
var $A_COMP_MENU_EXISTS_WARNING = 'ชื่อเมนนี้มีอยู่ในระบบแล้ว - กรุณาตั้งชื่อที่ไม่ซ้ำกับชื่อเมนูที่มีอยู่';

//components/com_menumanager/toolbar.menumanager.html.php
var $A_COMP_MENU_BAR_DEL = 'ลบ';

//components/com_messages/admin.messages.html.php
var $A_COMP_MESS_PRIVATE = 'ข้อความส่วนตัว';
var $A_COMP_MESS_SEARCH = 'ค้นหา';
var $A_COMP_MESS_FROM = 'จาก';
var $A_COMP_MESS_READ = 'อ่าน';
var $A_COMP_MESS_UNREAD = 'ไม่ถูกอ่าน';
var $A_COMP_MESS_CONF = 'ตั้งค่า Configuration ของข้อความส่วนตัว';
var $A_COMP_MESS_GENERAL = 'ทั่วไป';
var $A_COMP_MESS_SURE = 'คุณแน่ใจใช่ไหม?';
var $A_COMP_MESS_INBOX = 'ล็อค Inbox';
var $A_COMP_MESS_MAILME = 'ส่งอีเมลให้ฉันถ้ามีข้อความใหม่เข้ามา';
var $A_COMP_MESS_VIEW = 'เรียกดูข้อความส่วนตัว';
var $A_COMP_MESS_POSTED = 'ส่ง';
var $A_COMP_MESS_PROVIDE_SUB = 'กรุณาใส่ชื่อเรื่อง';
var $A_COMP_MESS_PROVIDE_MESS = 'กรุณาใส่ข้อความที่จะส่ง';
var $A_COMP_MESS_PROVIDE_REC = 'กรุณาระบุผู้รับปลายทาง';
var $A_COMP_MESS_NEW = 'ข้อความส่วนตัวใหม่';
var $A_COMP_MESS_TO = 'ถึง';

//components/com_messages/toolbar.messages.html.php
var $A_COMP_MESS_SEND = 'ส่ง';
var $A_COMP_MESS_REPLY = 'ตอบกลับ';

//components/com_modules/admin.modules.html.php
var $A_COMP_MOD_MANAGER = 'การจัดการโมดูล';
var $A_COMP_MOD_NAME = 'ชื่อโมดูล';
var $A_COMP_MOD_POSITION = 'ตำแหน่ง';
var $A_COMP_MOD_PAGES = 'หน้า';
var $A_COMP_MOD_VARIES = 'มาก';
var $A_COMP_MOD_ALL = 'ทั้งหมด';
var $A_COMP_MOD_USER = 'ผู้ใช้';
var $A_COMP_MOD_MUST_TITLE = 'กรุณาใส่หัวข้อของโมดูล';
var $A_COMP_MOD_MODULE = 'โมดูล';
var $A_COMP_MOD_DETAILS = 'รายละเอียดของโมดูล';
var $A_COMP_MOD_SHOW_TITLE = 'แสดงหัวข้อ';
var $A_COMP_MOD_ORDER = 'ลำดับโมดูล';
var $A_COMP_MOD_CONTENT = 'เนื้อความ';
var $A_COMP_MOD_PAGES_ITEMS = 'หน้า / รายการ';
var $A_COMP_MOD_CUSTOM_OUTPUT = 'เอาต์พุตทั้วไป';
var $A_COMP_MOD_MOD_POSITION = 'ตำแหน่งโมดูล';
var $A_COMP_MOD_ITEM_LINK = 'เมนูรายการลิงก์';
var $A_COMP_MOD_TAB_LBL = 'ที่ตั้ง';

//components/com_modules/admin.modules.php
var $A_COMP_MOD_MODULES = 'โมดูล';
var $A_COMP_MOD_MOD_COPIED = 'คัดลอกโมดูล';//KEN ADDED
var $A_COMP_MOD_SAVED_CHANGES = 'บันทึกการเปลี่ยนแปลงโมดูลสำเร็จ: ';//KEN ADDED
var $A_COMP_MOD_SAVED_MOD = 'บันทึกโมดูลสำเร็จ: ';//KEN ADDED
var $A_COMP_MOD_CANNOT = 'ไม่สามารถลบโมดูลได้ ต้องถอนโมดูลออกก่อน';
var $A_COMP_MOD_SELECT_TO = 'เลือกโมดูลไปยัง';

//components/com_modules/toolbar.modules.html.php
var $A_COMP_MOD_PREVIEW = 'แสดงตัวอย่าง';
var $A_COMP_MOD_PREVIEW_TIP = 'คุณสามารถเรียกดูโมดูลได้อย่างเดียว';

//components/com_newsfeeds/admin.newsfeeds.html.php
var $A_COMP_FEED_TITLE = 'การจัดการ Newsfeed';
var $A_COMP_FEED_NEWS = 'News Feed';
var $A_COMP_FEED_ARTICLES = 'จำนวนเนื้อหา';
var $A_COMP_FEED_CACHE = 'เวลาแคช(วินาที)';
var $A_COMP_FEED_EDIT_FEED = 'แก้ไข Newsfeed';//KEN ADDED
var $A_COMP_FEED_FILL_NAME = 'โปรดใส่ชื่อ newsfeed';
var $A_COMP_FEED_SEL_CATEG = 'โปรดเลือกหมวดหมู่';
var $A_COMP_FEED_FILL_LINK = 'โปรดใส่ลิงก์ของ newsfeed ';
var $A_COMP_FEED_FILL_NB = 'โปรดระบุจำนวนเนื้อหาที่ต้องการแสดง.';
var $A_COMP_FEED_FILL_REFRESH = 'โปรดระบุเวลาการล้าง cache';
var $A_COMP_FEED_LINK = 'ลิงก์';
var $A_COMP_FEED_NB_ARTICLE = 'จำนวนของเนื้อหา';
var $A_COMP_FEED_IN_SEC = 'เวลา cache (ต่อวินาที)';

//components/com_poll/admin.poll.html.php
var $A_COMP_POLL_MANAGER = 'การจัดการโพลล์';
var $A_COMP_POLL_TITLE = 'ชื่อเรื่องโพลล์';
var $A_COMP_POLL_OPTIONS = 'ตัวเลือก';
var $A_COMP_POLL_MUST_TITLE = 'กรุณาใส่หัวข้อโพลล์';
var $A_COMP_POLL_NON_ZERO = 'การตั้งค่าโพลล์ต้องใส่เลขมากกว่า 0';
var $A_COMP_POLL_POLL = 'โพลล์';
var $A_COMP_POLL_SHOW = 'แสดงรายการเมนู';
var $A_COMP_POLL_LAG = 'เวลา';
var $A_COMP_POLL_EDIT = 'แก้ไขโพลล์';//KEN ADDED
var $A_COMP_POLL_BETWEEN = '(เวลาระหว่างโหวต)';

//components/com_poll/admin.poll.php
var $A_COMP_POLL_THE = 'โพลล์';
var $A_COMP_POLL_BEING = 'แก้ไขโดยผู้ดูแลระบบ';

//components/com_poll/poll.class.php
var $A_COMP_POLL_TRY_AGAIN = 'โมดูลมีอยู่ในระบบแล้ว กรุณาลองใหม่';

//components/com_sections/admin.sections.html.php
var $A_COMP_SECT_MANAGER = 'การจัดการหมวด';
var $A_COMP_SECT_NAME = 'ชื่อหมวด';
var $A_COMP_SECT_ID = 'หมวดลำดับที่';
var $A_COMP_SECT_NB_CATEG = 'จำนวนประเภท';
var $A_COMP_SECT_NEW = 'หมวดใหม่n';
var $A_COMP_SECT_SEL_MENU = 'โปรดเลือกเมนู';
var $A_COMP_SECT_MUST_NAME = 'กรุณาใส่ชื่อหมวด';
var $A_COMP_SECT_MUST_TITLE = 'กรุณาใส่ชื่อเรื่องหมวด';
var $A_COMP_SECT_DETAILS = 'รายละเอียดหมวด';
var $A_COMP_SECT_SCOPE = 'ขอบเขต';
var $A_COMP_SECT_SHORT_NAME = 'ชื่อที่ใช้สั้นเกินไป';
var $A_COMP_SECT_LONG_NAME = 'ชื่อที่ใช้ยาวเกินไป';
var $A_COMP_SECT_COPY = 'คัดลอกหมวด';
var $A_COMP_SECT_COPY_TO = 'คัดลอกไปหมวด';
var $A_COMP_SECT_NEW_NAME = 'ชื่อหมวดใหม่';
var $A_COMP_SECT_WILL_COPY = 'คัดลอกประเภทนี้<br />และรายการทั้งหมดในประเภท (ทุกอย่าง)<br />ไปในหมวดใหม่';
var $A_COMP_SECT_MENU_LINK = 'เมนูลิงก์ใช้งานได้ เมื่อถูกบันทึก';//KEN ADDED

//components/com_sections/admin.sections.php
var $A_COMP_SECT_THE = 'หมวด';
var $A_COMP_SECT_LIST = 'รายการหมวด';
var $A_COMP_SECT_BLOG = 'บล็อกหมวด';
var $A_COMP_SECT_ARCHIVE_BLOG = 'บล็อกหมวดคลังเนื้อหา';
var $A_COMP_SECT_DELETE = 'เลือกหมวดที่ต้องการลบ';
var $A_COMP_SECT_SEC = 'หมวด';
var $A_COMP_SECT_CANNOT = 'ไม่สามารถลบได้ เนื่องจากมีประเภทเชื่อมโยงอยู่';
var $A_COMP_SECT_SUCCESS_DEL = 'ลบได้สำเร็จ';
var $A_COMP_SECT_TO = 'เลือกหมวดไปยัง';
var $A_COMP_SECT_CANNOT_PUB = 'ไม่สามารถเผยแพร่ได้ ไม่มีเนื้อหาในหมวด';
var $A_COMP_SECT_AND_ALL = 'และ ประเภท/รายการทั้งหมดถูกคัดลอก';
var $A_COMP_SECT_IN_MENU = 'ในเมนู';
var $A_COMP_SECT_CHANGES_SAVED = 'หมวดที่แก้ไขถูกบันทึกแล้ว';//KEN ADDED
var $A_COMP_SECT_SECTION_SAVED = 'บันทึกหมวด';//KEN ADDED

//components/com_statistics/admin.statistics.html.php
var $A_COMP_STAT_OS = 'เบราว์เซอร์, โอเอส, สถิติ โดเมน';
var $A_COMP_STAT_BR_PAGE = 'เบราว์เซอร์';
var $A_COMP_STAT_BROWSER = 'เบราว์เซอร์';
var $A_COMP_STAT_OS_PAGE = 'ระบบปฏิบัติการ';
var $A_COMP_STAT_OP_SYST = 'ระบบปฏิบัติการ';
var $A_COMP_STAT_URL_PAGE = 'สถิติ โดเมน';
var $A_COMP_STAT_URL = 'โดเมน';
var $A_COMP_STAT_IMPR = 'สถิติหน้าที่ถูกสนใจ';
var $A_COMP_STAT_PG_IMPR = 'หน้าที่ถูกสนใจ';
var $A_COMP_STAT_SCH_ENG = 'สถิติของคำหรือข้อความที่ใช้ค้นหา';
var $A_COMP_STAT_LOG_IS = 'สถิติผู้เข้าระบบ';
var $A_COMP_STAT_ENABLED = 'เปิดใช้งาน';
var $A_COMP_STAT_DISABLED = 'ปิด';
var $A_COMP_STAT_SCH_TEXT = 'ข้อความค้นหา';
var $A_COMP_STAT_T_REQ = 'จำนวนครั้งที่ค้นหา';
var $A_COMP_STAT_R_RETURN = 'ค้นพบทั้งหมด';

//components/com_syndicate/admin.syndicate.html.php
var $A_COMP_SYND_SET = 'ตั้งค่าการกระจายข่าวสาร';

//components/com_syndicate/admin.syndicate.php
var $A_COMP_SYND_SAVED = 'การตั้งค่าถูกบันทึกเรียบร้อย';

//components/com_templates/admin.templates.html.php
var $A_COMP_TEMP_NO_PREVIEW = 'ไม่สามารถแสดงได้';
var $A_COMP_TEMP_INSTALL = 'การติดตั้ง';
var $A_COMP_TEMP_TP = 'เทมเพลต';
var $A_COMP_TEMP_PREVIEW = 'แสดงเทมเพลต';
var $A_COMP_TEMP_ASSIGN = 'กำหนดเทมเพลต';
var $A_COMP_TEMP_AUTHOR_URL = 'ลิงก์ของผู้ออกแบบเทมเพลต';
var $A_COMP_TEMP_EDITOR = 'แก้ไขเทมเพลต';
var $A_COMP_TEMP_PATH = 'ที่ตั้ง : เทมเพลต';
var $A_COMP_TEMP_WRT = ' - สามารถเขียนทับได้';
var $A_COMP_TEMP_UNWRT = ' - ไม่สามารถเขียนทับได้';
var $A_COMP_TEMP_ST_EDITOR = 'แก้ไขรูปแบบเทมเพลต';
var $A_COMP_TEMP_NAME = 'ที่ตั้ง';
var $A_COMP_TEMP_ASSIGN_TP = 'กำหนดเทมเพลต';
var $A_COMP_TEMP_TO_MENU = 'ไปรายการเมนู';
var $A_COMP_TEMP_PAGES = 'หน้า';
var $A_COMP_TEMP_ = 'ตำแหน่ง';

//components/com_templates/admin.templates.php
var $A_COMP_TEMP_CANNOT = 'ไม่สามารถลบได้ เนื่องจากเทมเพลตถูกใช้งาน';
var $A_COMP_TEMP_NOT_OPEN = 'ผิดพลาด: ไม่สามารถเปิดได้';
var $A_COMP_TEMP_FLD_SPEC = 'ผิดพลาด: ระบุเทมเพลตไม่ได';
var $A_COMP_TEMP_FLD_EMPTY = 'ผิดพลาด: ไม่มีเนื้อหา';
var $A_COMP_TEMP_FLD_WRT = 'ผิดพลาด: เปิดไฟล์สำหรับเขียนทับไม่ได้';
var $A_COMP_TEMP_FLD_NOT = 'ผิดพลาด: ไฟล์ไม่สามารถเขียนได้';
var $A_COMP_TEMP_SAVED = 'บันทึกสำเร็จ';

//components/com_trash/admin.trash.html.php
var $A_COMP_TRASH_MANAGER = 'การจัดการถังรีไซเคิล';
var $A_COMP_TRASH_ITEMS = 'รายการเนื้อหา';
var $A_COMP_TRASH_MENU_ITEMS = 'รายการเมนู';
var $A_COMP_TRASH_DEL_ITEMS = 'ลบรายการ';
var $A_COMP_TRASH_NB_ITEMS = 'หมายเลข';
var $A_COMP_TRASH_ITEM_DEL = 'กำลังลบ';
var $A_COMP_TRASH_PERM_DEL = 'ลบถาวร';
var $A_COMP_TRASH_THESE = 'ไม่มีรายการในฐานข้อมูล *';
var $A_COMP_TRASH_YOU_SURE = 'คุณแน่ใจที่จะลบใช่หรือไม่? \nลบออกจากฐานข้อมูลเรียบร้อยแล้ว';
var $A_COMP_TRASH_RESTORE = 'คืนค่ารายการ';
var $A_COMP_TRASH_NUMBER = 'จำนวนรายการ';
var $A_COMP_TRASH_ITEM_REST = 'คืนค่าสำเร็จ';
var $A_COMP_TRASH_REST = 'คืนค่า';
var $A_COMP_TRASH_RETURN = 'ประเภท,<br />กลับไปเป็นค่าปกติ ไม่มีการเผยแพร่ *';
var $A_COMP_TRASH_ARE_YOU = 'คุณต้องการคืนค่ารายการนี้ใช่หรือไม่?';

//components/com_trash/admin.trash.php
var $A_COMP_TRASH_SUCCESS_DEL = 'รายการถูกลบสำเร็จ';
var $A_COMP_TRASH_SUCCESS_REST = 'คืนค่ารายการสำเร็จ';

//components/com_trash/toolbar.trash.html.php
var $A_COMP_TRASH_DEL = 'ลบ';

//components/com_typedcontent/admin.typedcontent.html.php
var $A_COMP_TYPED_STATIC = 'การจัดการเนื้อหาสเตติก';
var $A_COMP_TYPED_LINKS = 'ลิงก์';
var $A_COMP_TYPED_ARE_YOU = 'แน่ใจที่จะสร้างลิงก์เนื้อหาสเตติก? \nไม่สามารถทำได้ เนื้อหามีปัญหา.';
var $A_COMP_TYPED_CONTENT = 'ประเภทเนื้อหา';
var $A_COMP_TYPED_TEXT = 'ข้อความหลัก: (ต้องใส่)';
var $A_COMP_TYPED_EXPIRES = 'หมดอายุ';
var $A_COMP_TYPED_WILL = 'สร้าง \'ลิงก์ - เนื้อหาสเตติก\' ในเมนูที่เลือก';
var $A_COMP_TYPED_ITEM = 'รายการเนื้อหาสเตติก';

//components/com_typedcontent/admin.typedcontent.php
var $A_COMP_TYPED_SAVED = 'ประเภทเนื้อหาบันทึกสำเร็จ';
var $A_COMP_TYPED_CHG_SAVED = 'บันทึกการแก้ไขประเภทเนื้อหาสำเร็จ';
var $A_COMP_TYPED_TRASHED = 'หัวข้อนี้ ส่งไปยังถังรีไซเคิล';

//components/com_users/admin.users.html.php
var $A_COMP_USERS_ID = 'ชื่อผู้ใช้งาน';
var $A_COMP_USERS_LOG_IN = 'ล็อกอิน';
var $A_COMP_USERS_LAST = 'เข้าใช้ล่าสุด';
var $A_COMP_USERS_BLOCKED = 'ระงับการใช้งาน';
var $A_COMP_USERS_YOU_MUST = 'กรุณาใส่ชื่อผู้ใช้';
var $A_COMP_USERS_YOU_LOGIN = 'ชื่อที่ใช้ล็อกอิน สั้นเกินไป';
var $A_COMP_USERS_MUST_EMAIL = 'กรุณาใส่อีเมล';
var $A_COMP_USERS_ASSIGN = 'ใส่กลุ่มผู้ใช้';
var $A_COMP_USERS_NO_MATCH = 'รหัส ไม่ตรง';
var $A_COMP_USERS_NO_FRONTEND = 'คุณเลือกกลุ่มไม่ถูกต้อง กรุณาเลือกกลุ่มอื่นที่เป็น `Public Frontend`';
var $A_COMP_USERS_NO_BACKEND = 'คุณเลือกกลุ่มไม่ถูกต้อง กรุณาเลือกกลุ่มอื่นที่เป็น `Public Backend`';
var $A_COMP_USERS_DETAILS = 'รายละเอียดผู้ใช้งาน';
var $A_COMP_USERS_EMAIL = 'อีเมล';
var $A_COMP_USERS_PASS = 'รหัสผ่านใหม่';
var $A_COMP_USERS_VERIFY = 'ยืนยันรหัสผ่าน';
var $A_COMP_USERS_BLOCK = 'ระงับการใช้งาน';
var $A_COMP_USERS_SUBMI = 'ส่งอีเมลตอบรับ';
var $A_COMP_USERS_REG_DATE = 'วันที่สมัคร';
var $A_COMP_USERS_VISIT_DATE = 'วันที่เข้าใช้ล่าสุด';
var $A_COMP_USERS_CONTACT = 'ข้อมูลการติดต่อ';
var $A_COMP_USERS_NO_DETAIL = 'ไม่มีรายละเอียดการติดต่อของผู้ใช้งาน<br />ดูที่ \'คอมโพเน้นท์ -> การติดต่อ -> จัดการการติดต่อ\' สำหรับเพิ่มรายละเอียด';
var $A_COMP_USERS_CHANGE_CONTACT = 'เปลี่ยนแปลงรายละเอียดข้อมูลติดต่อ';
var $A_COMP_USERS_CONTACT_INFO = 'คอมโพเน้นท์ -> การติดต่อ -> จัดการการติดต่อ';

//components/com_users/admin.users.php
var $A_COMP_USERS_SUPER_ADMIN = 'ผู้ดูแลระบบ';
var $A_COMP_USERS_CANNOT = 'คุณไม่สามารถลบผู้ดูแลระบบได้';
var $A_COMP_USERS_NOT_DEL_SELF = 'คุณไม่สามารถลบตัวเองได้!';
var $A_COMP_USERS_NOT_DEL_ADMIN = 'คุณไม่สามารถลบผูดูลระบบ นอกจากคุณจะเป็นระดับ `Super Administrators';

//components/com_users/toolbar.users.html.php
var $A_COMP_USERS_LOGOUT = 'เอาออกจากระบบ';

//components/com_weblinks/admin.weblinks.html.php
var $A_COMP_WEBL_MANAGER = 'การจัดการเว็บลิงก์';
var $A_COMP_WEBL_APPROVED = 'อนุมัติ';
var $A_COMP_WEBL_MUST_TITLE = 'คุณไม่ได้เลือกหัวข้อ';
var $A_COMP_WEBL_MUST_CATEG = 'คุณไม่ได้เลือกหมวด';
var $A_COMP_WEBL_MUST_URL = 'คุณไม่ได้ใส่ URL.';
var $A_COMP_WEBL_WL = 'เว็บลิงก์';

//components/com_installer/admin.installer.php
var $A_INSTALL_NOT_FOUND = "ไม่พบไฟล์ที่จะติดตั้ง ";
var $A_INSTALL_NOT_AVAIL = "การติดตั้งไม่สำเร็จ";
var $A_INSTALL_ENABLE_MSG = "การติดตั้งทำต่อไม่ได้ ต้องตั้งค่าการอัพโหลดไฟล์ให้ใช้ได้ก่อน ควรใช้การติดตั้งจากไดเรกทอรี่ที่มีให้.";
var $A_INSTALL_ERROR_MSG_TITLE = 'ติดตั้ง - ผิดพลาด';
var $A_INSTALL_ZLIB_MSG = "การติดตั้งทำต่อไม่ได้ ต้องให้ zlib ถูกติดตั้งก่อน";
var $A_INSTALL_NOFILE_MSG = 'ไม่มีไฟล์ที่ถูกเลือก';
var $A_INSTALL_NEWMODULE_ERROR_MSG_TITLE = 'อัพโหลดโมดูลใหม่ - ผิดพลาด';
var $A_INSTALL_UPLOAD_PRE = 'อัพโหลด ';
var $A_INSTALL_UPLOAD_POST = ' - อัพโหลด ไม่สำเร็จ';
var $A_INSTALL_UPLOAD_POST2 = ' -  อัพโหลด ผิดพลาด';
var $A_INSTALL_SUCCESS = 'สำเร็จ';
var $A_INSTALL_ERROR = 'ผิดพลาด';
var $A_INSTALL_FAILED = 'ไม่สำเร็จ';
var $A_INSTALL_SELECT_DIR = 'โปรดเลือกไดเรกทอรี่่';
var $A_INSTALL_UPLOAD_NEW = 'อัพโหลดใหม่ ';
var $A_INSTALL_FAIL_PERMISSION = 'เกิดข้อผิดพลาดในการอัพโหลดไฟล์ ไม่ได้แก้ไขสิทธิ.';
var $A_INSTALL_FAIL_MOVE = 'ไม่สามารถย้ายไฟล์ไปยัง <code>/media</code> ไดเรกทอรี่.';
var $A_INSTALL_FAIL_WRITE = 'อัพโหลดไม่สำเร็จ <code>/media</code> ไดเรกทอรี่ไม่สามารถเขียนทับได้.';
var $A_INSTALL_FAIL_EXIST = 'อัพโหลดไม่สำเร็จ <code>/media</code> ไม่พบไดเรกทอรี่.';

//components/com_installer/admin.installer.html.php
var $A_INSTALL_WRITABLE = 'สามารถเขียนทับได้';
var $A_INSTALL_UNWRITABLE = 'เขียนทับไม่ได้';
var $A_INSTALL_CONTINUE = 'ทำต่อ ...';
var $A_INSTALL_UPLOAD_PACK_FILE = 'อัพโหลดแพคเกจไฟล์';
var $A_INSTALL_PACK_FILE = 'แพคเกจไฟล์:';
var $A_INSTALL_UPL_INSTALL = "อัพโหลดไฟล์ &amp; ติดตั้ง";
var $A_INSTALL_FROM_DIR = 'ติดตั้งจากไดเรกทอรี่';
var $A_INSTALL_DIR = 'ติดตั้งไดเรกทอรี่่:';
var $A_INSTALL_DO_INSTALL = 'ติดตั้ง';

//components/com_installer/component/component.html.php
var $A_INSTALL_COMP_INSTALLED = 'ติดตั้งคอมโพเน้นท์';
var $A_INSTALL_COMP_CURRENT = 'กำลังติดตั้ง';
var $A_INSTALL_COMP_MENU = 'เมนูลิงก์ คอมโพเน้นท์';
var $A_INSTALL_COMP_AUTHOR = 'ผู้สร้าง';
var $A_INSTALL_COMP_VERSION = 'เวอร์ชั่น';
var $A_INSTALL_COMP_DATE = 'วันที่';
var $A_INSTALL_COMP_AUTH_MAIL = 'อีเมลผู้สร้าง';
var $A_INSTALL_COMP_AUTH_URL = 'URL ผู้สร้าง';
var $A_INSTALL_COMP_NONE = 'ไม่มีการติดตั้งคอมโพเน้นท์';

//components/com_installer/component/component.php
var $A_INSTALL_COMP_UPL_NEW = 'อัพโหลดคอมโพเน้นท์ใหม่';

//components/com_installer/language/language.php
var $A_INSTALL_LANG = 'อัพโหลดภาษาใหม่';
var $A_INSTALL_BACK_LANG_MGR = 'กลับไปที่การจัดการภาษา';

//components/com_installer/language/language.class.php
var $A_INSTALL_LANG_NOREMOVE = 'ลบไม่ได้ , ไม่มีภาษาติดตั้ง';
var $A_INSTALL_LANG_UN_ERR = 'การลบ - มีข้อผิดพลาด';
var $A_INSTALL_LANG_DELETING = 'กำลังลบ';

//components/com_installer/mambot/mambot.html.php
var $A_INSTALL_MAMB_MAMBOTS = 'แมมบอท';
var $A_INSTALL_MAMB_CORE = 'เฉพาะแมมบอทเหล่านี้ที่เอาออกได้ - บางแมมบอทหลักไม่สามารถย้ายได้';
var $A_INSTALL_MAMB_MAMBOT = 'แมมบอท';
var $A_INSTALL_MAMB_TYPE = 'ประเภท';
var $A_INSTALL_MAMB_AUTHOR = 'ผู้สร้าง';
var $A_INSTALL_MAMB_VERSION = 'เวอร์ชั่น';
var $A_INSTALL_MAMB_DATE = 'วันที่';
var $A_INSTALL_MAMB_AUTH_MAIL = 'อีเมลผู้สร้าง';
var $A_INSTALL_MAMB_AUTH_URL = 'URL ผู้สร้าง';
var $A_INSTALL_MOD_NO_MAMBOTS = 'ไม่มีแมมบอทที่เลือกไว้ ติดตั้งอยู่';

//components/com_installer/mambot/mambot.php
var $A_INSTALL_MAMB_INSTALL_MAMBOT = 'ติดตั้งแมมบอท';


//components/com_installer/module/module.html.php
var $A_INSTALL_MOD_MODS = 'โมดูล';
var $A_INSTALL_MOD_FILTER = 'แสดง';
var $A_INSTALL_MOD_CORE = 'บางโมดูลเท่านั้น ที่สามารถลบออกจากการแสดงผล - และบางอันไม่สามารถลบออกได้';//Modules that can be uninstalled are displayed - some Core Modules cannot be removed.
var $A_INSTALL_MOD_MOD = 'ไฟล์โมดูล';
var $A_INSTALL_MOD_CLIENT = 'กลุ่มลูกค้า';
var $A_INSTALL_MOD_AUTHOR = 'ผู้สร้าง';
var $A_INSTALL_MOD_VERSION = 'เวอร์ชั่น';
var $A_INSTALL_MOD_DATE = 'วันที่';
var $A_INSTALL_MOD_AUTH_MAIL = 'อีเมลผู้สร้าง';
var $A_INSTALL_MOD_AUTH_URL = 'URL ผู้สร้าง';
var $A_INSTALL_MOD_NO_CUSTOM = 'ไม่มีโมดูลที่เลือกติดตั้งในระบบ';

//components/com_installer/module/module.php
var $A_INSTALL_MOD_INSTALL_MOD = 'ติดตั้งโมดูล';
var $A_INSTALL_MOD_ADMIN_MOD = 'โมดูลผู้ดูแลระบบ'; //Admin Modules

//components/com_install/template/template.php
var $A_INSTALL_TEMPL_INSTALL = 'ติดตั้งเทมเพลต';
var $A_INSTALL_TEMPL_SITE_TEMPL = 'ไซต์';
var $A_INSTALL_TEMPL_ADMIN_TEMPL = 'ผู้ดูแลระบบ';
var $A_INSTALL_TEMPL_BACKTTO_TEMPL = 'กลับไปที่เทมเพลต';

//components/com_menus/admin.menus.html.php
var $A_COMP_MENUS_MAX_LVLS = 'ระดับสูงสุด';
var $A_COMP_MENUS_MENU_ITEM = 'หมวดเมนู';
var $A_COMP_MENUS_MENU_ORDER = 'ลำดับ';//KEN ADDED
var $A_COMP_MENUS_MENU_SAVE_ORDER = 'บันทึกลำดับ';//KEN ADDED
var $A_COMP_MENUS_MENU_ITEMID = 'รายการid';//KEN ADDED
var $A_COMP_MENUS_MENU_CID = 'CID';//KEN ADDED
var $A_COMP_MENUS_MENU_CONTENT = 'เนื้อหา';//KEN ADDED
var $A_COMP_MENUS_MENU_MISC = 'อื่นๆ';//KEN ADDED
var $A_COMP_MENUS_MENU_NOTE = '* หมายเหตุ:เมนูบางชนิดอาจจะอยู่หลายกลุ่ม แต่ยังคงเป็นเมนูชนิดเดียวกัน';//KEN ADDED
var $A_COMP_MENUS_MENU_COM = 'คอมโพเน้นท์';//KEN ADDED
var $A_COMP_MENUS_MENU_LINKS = 'ลิงก์';//KEN ADDED
var $A_COMP_MENUS_MENU_ITEM_TYPE = 'ประเภทหมวดเมนู';//KEN ADDED
var $A_COMP_MENUS_MENU_HELP = 'ช่วยเหลือ';//KEN ADDED
var $A_COMP_MENUS_MENU_BLOGVIEW = 'อะไรคือ "Blog" view';//KEN ADDED
var $A_COMP_MENUS_MENU_TABLEVIEW = 'อะไรคือ "Table" view';//KEN ADDED
var $A_COMP_MENUS_MENU_LISTVIEW = 'อะไรคือ "List" view';//KEN ADDED
var $A_COMP_MENUS_ADD_ITEM = 'เลือกหมวดเมนู';
var $A_COMP_MENUS_SELECT_ADD = 'เลือกคอมโพเน้นท์ที่จะเพิ่ม';
var $A_COMP_MENUS_MOVE_ITEMS = 'ย้ายหมวดเมนู';
var $A_COMP_MENUS_MOVE_MENU = 'ย้ายไปหมวดเมนู';
var $A_COMP_MENUS_BEING_MOVED = 'กำลังย้ายหมวดเมนู';
var $A_COMP_MENUS_COPY_ITEMS = 'คัดลอกหมวดเมนู';
var $A_COMP_MENUS_NEXT = 'ต่อไป';
var $A_COMP_MENUS_COPY_MENU = 'คัดลอกไปเมนู';
var $A_COMP_MENUS_BEING_COPIED = 'กำลังคัดลอกเมนู';
var $A_COMP_MENUS_SELECT_TO = 'เลือกเมนูไป ';

//components/com_menus/admin.menus.php
var $A_COMP_MENUS_ITEM_SAVED = 'เมนูบันทึกสำเร็จ';//KEN ADDED
var $A_COMP_MENUS_MOVED_TO = ' ย้ายเมนูไปที่ ';
var $A_COMP_MENUS_COPIED_TO = ' คัดลอกเมนูไปที่ ';
var $A_COMP_MENUS_WRAPPER = 'แร็บเปอร์';
var $A_COMP_MENUS_SEPERATOR = 'แบ่งหัวข้อ / เส้นคั่น';
var $A_COMP_MENUS_LINK = 'ลิงก์ - ';
var $A_COMP_MENUS_STATIC = 'เนื้อหาสเตติก';
var $A_COMP_MENUS_URL = 'Url';
var $A_COMP_MENUS_CONTENT_ITEM = 'เนื้อหา';
var $A_COMP_MENUS_COMP_ITEM = 'คอมโพเน้นท์';
var $A_COMP_MENUS_CONT_ITEM = 'การติดต่อ';
var $A_COMP_MENUS_NEWSFEED = 'News Feeds';
var $A_COMP_MENUS_COMP = 'คอมโพเน้นท์';
var $A_COMP_MENUS_LIST = 'รายการ';
var $A_COMP_MENUS_TABLE = 'ตาราง';
var $A_COMP_MENUS_BLOG = 'บล็อก';
var $A_COMP_MENUS_CONT_SEC = 'หมวด เนื้อหา';
var $A_COMP_MENUS_CONT_CAT = 'ประเภทเนื้อหา';
var $A_COMP_MENUS_CONT_SEC_MULTI = 'หลายหมวดเนื้อหา';
var $A_COMP_MENUS_CONT_CAT_MULTI = 'หลายประเภทเนื้อหา';
var $A_COMP_MENUS_CONT_SEC_ARCH = 'หมวดคลังเนื้อหา';
var $A_COMP_MENUS_CONT_CAT_ARCH = 'ประเภทคลังเนื้อหา';
var $A_COMP_MENUS_CONTACT_CAT = 'ประเภทการติดต่อ';
var $A_COMP_MENUS_WEBLINK_CAT = 'ประเภทเว็บลิงก์';
var $A_COMP_MENUS_NEWS_CAT = 'ประเภท News Feeds';
var $A_COMP_MENUS_NEW_ORDER_SAVED = 'บันทึกการจัดลำดับใหม่แล้ว';//KEN ADDED
var $A_COMP_MENUS_EDIT_NEWSFEED_TIP = 'แก้ไข News Feeds นี้';
var $A_COMP_MENUS_EDIT_CONTACT_TIP = 'แก้ไขการติดต่อนี้';
var $A_COMP_MENUS_EDIT_CONTENT_TIP = 'แก้ไขข้อความนี้';
var $A_COMP_MENUS_EDIT_STATIC_TIP = 'แก้ไขข้อความสเตติกนี้';

//components/com_menus/component_item_link/component_item_link.menu.html.php
var $A_COMP_MENUS_CIL_LINK_NAME = 'ลิงก์ต้องมีชื่อ';
var $A_COMP_MENUS_CIL_SELECT_COMP = 'คุณต้องเลือกคอมโพเน้นท์ที่จะเชื่อมต่อ';
var $A_COMP_MENUS_CIL_LINK_COMP = 'คอมโพเน้นท์ที่จะลิงก์';
var $A_COMP_MENUS_CIL_ON_CLICK = 'เมื่อคลิกแล้วเปิดใน ';
var $A_COMP_MENUS_CIL_PARENT = 'หน้าต่างเดิม';
var $A_DETAILS = 'รายละเอียด';

//components/com_menus/components/components.menu.html.php
var $A_COMP_MENUS_CMP_ITEM_NAME = 'รายการจะต้องมีชื่อ';
var $A_COMP_MENUS_CMP_SELECT_CMP = 'โปรดเลือกคอมโพเน้นท์';
var $A_COMP_MENUS_PARAMETERS_AVAILABLE = 'สามารถตั้งค่าพารามิเตอร์หลังจากบันทึกเมนูนี้แล้ว';
var $A_COMP_MENUS_CMP_ITEM_COMP = 'รายการเมนู :: คอมโพเน้นท์';

//components/com_menus/contact_category_table/contact_category_table.menu.html.php
var $A_COMP_MENUS_CMP_CCT_CATEG = 'คุณต้องเลือกประเภท';
var $A_COMP_MENUS_CMP_CCT_TITLE = 'เมนูนี้ต้องมีชื่อ';
var $A_COMP_MENUS_CMP_CCT_BLANK = 'ถ้าคุณเว้นว่างไว้ชื่อประเภทจะถูกใช้แทนโดยอัตโนมัติ';
var $A_COMP_MENUS_CMP_CCT_THETITLE = 'หัวเรื่อง:';
var $A_COMP_MENUS_CMP_CCT_THECAT = 'ประเภท:';

//components/com_menus/contact_item_link/contact_item_link.menu.html.php
var $A_COMP_MENUS_CMP_CIL_LINK_NAME = 'ลิงก์จะต้องมีชื่อ';
var $A_COMP_MENUS_CMP_CIL_SEL_CONT = 'คุณจะต้องเลือกการติดต่อที่จะลิงก์';
var $A_COMP_MENUS_CMP_CIL_CONTACT = 'การติดต่อที่จะลิงก์:';
var $A_COMP_MENUS_CMP_CIL_ONCLICK = 'เมื่อคลิกจะเปิดใน:';
var $A_COMP_MENUS_CMP_CIL_HDR = 'รายการเมนู :: ลิงก์ - การติดต่อ';

//components\com_menus\content_archive_section\content_archive_section.menu.html.php
var $A_COMP_MENUS_CMP_CAS_BLANK = 'ถ้าคุณเว้นว่างไว้ชื่อหมวดจะถูกใช้แทนโดยอัตโนมัต';

//components\com_menus\content_blog_category\content_blog_category.menu.html.php
var $A_COMP_MENUS_CMP_CBC_CATEG = 'คุณสามารถเลือกหลายประเภท';

//components\com_menus\content_blog_section\content_blog_section.menu.html.php
var $A_COMP_MENUS_CMP_CBS_SECTION = 'คุณสามารถเลือกหลายหมวด';

//components\com_menus\content_item_link\content_item_link.menu.html.php
var $A_COMP_MENUS_CMP_CIL_SEL_LINK = 'คุณจะต้องเลือกเนื้อหาที่จะลิงก์';

//components/com_menus/wrapper/wrapper.menu.html.php
var $A_COMP_MENUS_WRAPPER_LINK = 'ลิงก์แร็บเปอร์';

//components/com_menus/separator/separator.menu.html.php
var $A_COMP_MENUS_SEPARATOR_PATTERN = 'รูปแบบ/ชื่อ';

//components/com_menus/content_typed/content_typed.menu.html.php
var $A_COMP_MENUS_TYPED_CONTENT_TO_LINK = 'พิมพ์ข้อความที่จะลิงก์';

//components/com_menus/content_item_link/content_item_link.menu.html.php
var $A_COMP_MENUS_CONTENT_TO_LINK = 'ข้อความที่จะลิงก์';

//components/com_menus/newsfeed_link/newsfeed_link.menu.html.php
var $A_COMP_MENUS_NEWSFEED_TO_LINK = 'News Feeds ที่จะลิงก์';
var $A_COMP_MENUS_NEWSFEED_SELECT_LINK = 'คุณจะต้องเลือก News Feeds ที่จะลิงก์';

//components\com_menus\url\url.menu.html.php
var $A_COMP_MENUS_URL_MUST = 'คุณต้องให้ url.';
var $A_COMP_MENUS_URL_LINK = 'ลิงก์';

	function adminLanguage()
	{
		global $TR_STRS;
		//Menu Caption Translation for initial mambo menutype
		$TR_STRS[strtolower('mainmenu')] = 'เมนูหลัก';
		$TR_STRS[strtolower('othermenu')] = 'เมนูอื่น';
		$TR_STRS[strtolower('topmenu')] = 'เมนูด้านบน';
		$TR_STRS[strtolower('usermenu')] = 'เมนูผู้ใช้';
		
		//Components menu caption
		//Banners
		$TR_STRS[strtolower('Banners')] = 'ป้ายโฆษณา';
		$TR_STRS[strtolower('Manage Banners')] = 'การจัดการป้ายโฆษณา';
		$TR_STRS[strtolower('Manage Clients')] = 'การจัดการเจ้าของป้ายโฆษณา';

		//Web Links
		$TR_STRS[strtolower('Web Links')] = 'เว็บลิงก์'; //Web Links
		$TR_STRS[strtolower('Weblink Items')] = 'รายการเว็บลิงก์'; //Weblink Items
		$TR_STRS[strtolower('Weblink Categories')] = 'ตารางประเภทเว็บลิงก์'; //Weblink Categories'

		//Contacts
		$TR_STRS[strtolower('Contacts')] = 'การติดต่อ'; //Contacts
		$TR_STRS[strtolower('Manage Contacts')] = 'จัดการการติดต่อ'; //Manage Contacts
		$TR_STRS[strtolower('Contact Categories')] = 'ประเภทการติดต่อ'; //Contact Categories

		//Polls
		$TR_STRS[strtolower('Polls')] = 'โพลล์';

		//News Feeds
		$TR_STRS[strtolower('News Feeds')] = 'News Feeds';
		$TR_STRS[strtolower('Manage News Feeds')] = 'จัดการ News Feeds';
		$TR_STRS[strtolower('Manage Categories')] = 'จัดการรายการ'; //Manage Categories

		//Syndicate
		$TR_STRS[strtolower('Syndicate')] = 'กระจายข่าว';

		//Mass Mail
		$TR_STRS[strtolower('Mass Mail')] = 'เมลกลุ่ม';
		//modules XML file
		$TR_STRS[strtolower('Archived Content')] = 'บันทึกเนื้อหา'; 
		$TR_STRS[strtolower('Count')] = 'นับ'; 
		$TR_STRS[strtolower('The number of items to display (default is 5)')] = 'จำนวนรายการที่ต้องการแสดงต่อหน้าเพจ ปกติกำหนดค่า = 5';  
		$TR_STRS[strtolower('The number of items to display (default is 10)')] = 'จำนวนรายการที่ต้องการแสดงต่อหน้าเพจ ปกติกำหนดค่า = 10';
		$TR_STRS[strtolower('Enable Cache')] = 'เปิดการทำงานของแคช';
		$TR_STRS[strtolower('Select whether to cache the content of this module')] = 'เลือกให้แคชของบทความทำงานจากโมดูล';
		$TR_STRS[strtolower('No')] = 'ไม่';
		$TR_STRS[strtolower('Yes')] = 'ใช่';
		$TR_STRS[strtolower('Module Class Suffix')] = 'คำเสริมท้ายคลาสของโมดูล';
		$TR_STRS[strtolower('A suffix to be applied to the css class of the module (table.moduletable), this allows individual module styling')] = 'คำเสริมท้ายคลาส css ของโมดูล (table.moduletable), โดยจะใช้แสดงเแพาะโมดูลนั้นๆ';
		$TR_STRS[strtolower('Banner')] = 'ป้ายโฆษณา';
		$TR_STRS[strtolower('Banner client')] = 'เจ้าของป้ายโฆษณา';
		$TR_STRS[strtolower("Reference to banner client id. Enter separated by ','!")] = "กำหนดหมายเลข ID ของ เจ้าของป้ายโฆษณาแต่ละราย โดยแยกด้วยเครื่องหมาย ','!";
		$TR_STRS[strtolower('Latest News')] = 'เนื้อหาล่าสุด';
		$TR_STRS[strtolower('Most Read Content')] = 'เนื้อหาที่มีการอ่านมากที่สุด';
		$TR_STRS[strtolower('Module Mode')] = 'โหมดโมดูล';
		$TR_STRS[strtolower('Allows you to control which type of Content to display in the module')] = 'กำหนดชนิดของเนื้อหาที่ต้องการแสดงในโมดูล';
		$TR_STRS[strtolower('Content Items only')] = 'หัวข้อของเนื้อหาเท่านั้น';
		$TR_STRS[strtolower('Static Content only')] = 'เฉพาะเนื้อหาสเตติก';
		$TR_STRS[strtolower('Both')] = 'ทั้งคู่';
		$TR_STRS[strtolower('Show')] = 'แสดง';
		$TR_STRS[strtolower('Hide')] = 'ซ่อน';
		$TR_STRS[strtolower('Frontpage Items')] = 'รายการเนื้อหาที่เว็บเพจหน้าแรก';
		$TR_STRS[strtolower('Show/Hide items designated for the Frontpage - only works when in Content Items only mode')] = 'แสดง/ซ่อน รายการที่มีหมายเลขสำหรับด้านหน้าเว็บ - จะทำได้เมื่ออยู่ในโหมดเนื้อหาเท่านั้น';
		$TR_STRS[strtolower('Category ID')] = 'หมายเลขประจำประเภท';
		$TR_STRS[strtolower('Selects items from a specific Category or set of Categories (to specify more than one Category, seperate with a comma , ).')] = 'เลือกรายการจากประเภทที่ต้องการ (หากต้องการมากกว่าหนึ่งประเภท ให้ใช้จุลภาคขั้น , ).';
		$TR_STRS[strtolower('Section ID')] = 'หมายเลขประจำหมวด';
		$TR_STRS[strtolower('Selects items from a specific Secion or set of Sections (to specify more than one Section, seperate with a comma , ).')] = 'เลือกรายการจากหมวดที่ต้องการ (หากต้องการมากกว่าหนึ่งหมวด ให้ใช้จุลภาคขั้น , ).';
		$TR_STRS[strtolower('Login Form')] = 'แบบฟอร์มการเข้าสู่ระบบเข้าสู่ระบบ';
		$TR_STRS[strtolower('Pre-text')] = 'ข้อความก่อนเข้าสู่ระบบ';
		$TR_STRS[strtolower('This is the Text or HTML that is displayed above the login form')] = 'ข้อความนี้จะปรากฎอยู่ด้านบนของแบบฟอร์มการเข้าสู่ระบบเข้าสู่ระบบ';
		$TR_STRS[strtolower('Post-text')] = 'ข้อความหลังออกจากระบบ';
		$TR_STRS[strtolower('This is the Text or HTML that is displayed below the login form')] = 'ข้อความนี้จะปรากฎอยู่ด้านล่างของแบบฟอร์มการเข้าสู่ระบบเข้าสู่ระบบ';
		$TR_STRS[strtolower('Login Redirection URL')] = 'URLของเพจที่ต้องการเมื่อผ่านการเข้าสู่ระบบเข้าสู่ระบบ';
		$TR_STRS[strtolower('What page will the login redirect to after login, if let blank will load front page')] = 'กำหนดหน้าเพจที่ต้องการหลังจากเข้าสู่ระบบเข้าสู่ระบบ หากไม่ระบ ุระบบจะเชื่อมกลับไปยังเว็บเพจหน้าแรก';
		$TR_STRS[strtolower('Logout Redirection URL')] = 'URLของเพจที่ต้องการเมื่อผ่านการออกจากระบบ';
		$TR_STRS[strtolower('What page will the logout redirect to after logout, if let blank will load front page')] = 'กำหนดหน้าเพจที่ต้องการหลังจากออกจากระบบ หากไม่ระบ ุระบบจะเชื่อมกลับไปยังเว็บเพจหน้าแรก';
		$TR_STRS[strtolower('Login Message')] = 'ข้อความแสดงการเข้าสู่ระบบ';
		$TR_STRS[strtolower('Show/Hide the javascript Pop-up indicating Login Success')] = 'แสดง/ซ่อน พ็อพอัพjavascript ที่แสดงว่าเข้าสู่ระบบสำเร็จ';
		$TR_STRS[strtolower('Logout Message')] = 'ข้อความแสดงการออกจากระบบ';
		$TR_STRS[strtolower('Show/Hide the javascript Pop-up indicating Logout Success')] = 'แสดง/ซ่อน พ็อพอัพjavascript ที่แสดงว่าออกจากะบบสำเร็จ';
		$TR_STRS[strtolower('Greeting')] = 'แสดงความยินดี';
		$TR_STRS[strtolower('Show/Hide the simple greeting text')] = 'แสดง/ซ่อน ข้อความแสดงความยินดี';
		$TR_STRS[strtolower('Name/Username')] = 'ชื่อ/ชื่อผู้ใช้งาน';
		$TR_STRS[strtolower('Username')] = 'ชื่อผู้ใช้งาน';
		$TR_STRS[strtolower('Name')] = 'ชื่อ';
		$TR_STRS[strtolower('Main Menu')] = 'เมนูหลัก';
		$TR_STRS[strtolower('Menu Class Suffix')] = 'คำเสริมท้ายคลาสของเมนู';
		$TR_STRS[strtolower('A suffix to be applied to the css class of the menu items')] = 'คำเสริมท้ายใช้กับคลาสของรายการเมนู';
		$TR_STRS[strtolower('Menu Name')] = 'ชื่อเมนู';
		$TR_STRS[strtolower("The name of the menu (default is 'mainmenu')")] = 'ชื่อของเมนู - (ค่าปกติคือ"เมนูหลัก")';
		$TR_STRS[strtolower('Menu Style')] = 'รูปแบบเมนู';
		$TR_STRS[strtolower('The menu style')] = 'รูปแบบเมนู';
		$TR_STRS[strtolower('Vertical')] = 'แนวตั้ง';
		$TR_STRS[strtolower('Horizontal')] = 'แนวนอน';
		$TR_STRS[strtolower('Flat List')] = 'เชื่อมโยงรายการ';
		$TR_STRS[strtolower('Show Menu Icons')] = 'แสดงไอคอนเมนู';
		$TR_STRS[strtolower('Show the Menu Icons you have selected for your menu items')] = 'แสดงไอคอนเมนูที่เลือกให้แก่รายการของเมนู';
		$TR_STRS[strtolower('Menu Icon Alignment')] = 'การเรียงไอคอนเมนู';
		$TR_STRS[strtolower('Alignment of the Menu Icons')] = 'การเรียงไอคอนเมนู';
		$TR_STRS[strtolower('Left')] = 'ซ้าย';
		$TR_STRS[strtolower('Right')] = 'ขวา';
		$TR_STRS[strtolower('Expand Menu')] = 'ขยายเมนู';
		$TR_STRS[strtolower('Expand the menu and make its sub-menus items always visible')] = 'ขยายส่วนของเมนูและจัดการให้เมนูย่อยสามารถมองเห็นได้ตลอดเวลา';
		$TR_STRS[strtolower('Indent Image')] = 'รูปภาพย่อหน้าเมนู';
		$TR_STRS[strtolower('Choose which indent image system to utilise')] = 'เลือกเพื่อเปลี่ยนรูปภาพย่อหน้าเมนูที่ต้องการใช้';
		$TR_STRS[strtolower('Template')] = 'เทมเพลท';
		$TR_STRS[strtolower('Mambo default images')] = 'รูปภาพตั้งต้นที่กำหนดโดยโปรแกรมแมมโบ้';
		$TR_STRS[strtolower('Use params below')] = 'ใช้ค่าของตัวแปรด้านล่าง';
		$TR_STRS[strtolower('None')] = 'ไม่มี';
		$TR_STRS[strtolower('Indent Image 1')] = 'รูปภาพย่อหน้าเมนู 1';
		$TR_STRS[strtolower('Image for the first sub-level')] = 'รูปภาพสำหรับเมนูย่อยระดับที่ 1';
		$TR_STRS[strtolower('Indent Image 2')] = 'รูปภาพย่อหน้าเมนู 2';
		$TR_STRS[strtolower('Image for the second sub-level')] = 'รูปภาพสำหรับเมนูย่อยระดับที่ 2';
		$TR_STRS[strtolower('Indent Image 3')] = 'รูปภาพย่อหน้าเมนู 3';
		$TR_STRS[strtolower('Image for the third sub-level')] = 'รูปภาพสำหรับเมนูย่อยระดับที่ 3';
		$TR_STRS[strtolower('Indent Image 4')] = 'รูปภาพย่อหน้าเมนู 4';
		$TR_STRS[strtolower('Image for the fourth sub-level')] = 'รูปภาพสำหรับเมนูย่อยระดับที่ 4';
		$TR_STRS[strtolower('Indent Image 5')] = 'รูปภาพย่อหน้าเมนู 5';
		$TR_STRS[strtolower('Image for the fifth sub-level')] = 'รูปภาพสำหรับเมนูย่อยระดับที่ 5';
		$TR_STRS[strtolower('Indent Image 6')] = 'รูปภาพย่อหน้าเมนู 6';
		$TR_STRS[strtolower('Image for the sixth sub-level')] = 'รูปภาพสำหรับเมนูย่อยระดับที่ 6';
		$TR_STRS[strtolower('Spacer')] = 'Spacer';
		$TR_STRS[strtolower('Spacer for Horizontal menu')] = 'Spacer for Horizontal menu';
		$TR_STRS[strtolower('End Spacer')] = 'End Spacer';
		$TR_STRS[strtolower('End Spacer for Horizontal menu')] = 'End Spacer for Horizontal menu';
		$TR_STRS[strtolower('Newsflash')] = 'Newsflash';
		$TR_STRS[strtolower('Category')] = 'หมวด';
		$TR_STRS[strtolower('A content cateogry')] = 'หมวดเนื้อหา';
		$TR_STRS[strtolower('Style')] = 'รูปแบบ';
		$TR_STRS[strtolower('The style to display the category')] = 'รูแบบในการแสดงหมวดของเนื้อหา';
		$TR_STRS[strtolower('Randomly choose one at a time')] = 'การเลือกแบบสุ่มจะเลือกเพียงรูปเดียวในแต่ละครั้ง';
		$TR_STRS[strtolower('Show images')] = 'แสดงรูปภาพ';
		$TR_STRS[strtolower('Display content item images')] = 'แสดงรูปภาพประจำเนื้อหา';
		$TR_STRS[strtolower('Linked Titles')] = 'กำหนดให้หัวข้อเป็นลิงก์';
		$TR_STRS[strtolower('Make the Item titles linkable')] = 'กำหนดให้หัวข้อเป็นลิงก์';
		$TR_STRS[strtolower('Use Global')] = 'ใช้ค่าเดียวกับโกลบอล';
		$TR_STRS[strtolower('Read More')] = 'อ่านต่อ';
		$TR_STRS[strtolower('Show/Hide the Read More button')] = 'แสดง/ซ่อนปุ่ม"อ่านต่อ" ';
		$TR_STRS[strtolower('Item Title')] = 'หัวข้อเนื้อหา';
		$TR_STRS[strtolower('Show item title')] = 'แสดงหัวข้อเนื้อเรื่อง';
		$TR_STRS[strtolower('No. of Items')] = 'จำนวนของเนื้อเรื่อง';
		$TR_STRS[strtolower('No of items to display')] = 'จำนวนเนื้อเรื่องที่ต้องการแสดงต่อครั้ง';
		$TR_STRS[strtolower('Poll')] = 'แบบสำรวจความคิดเห็น';
		$TR_STRS[strtolower('Random Image')] = 'ระบบสุ่มเลือกรูปภาพ';
		$TR_STRS[strtolower('Image Type')] = 'ประเภทของรูปภาพ';
		$TR_STRS[strtolower('Type of image PNG/GIF/JPG etc. (default is JPG)')] = 'ประเภทของรูปภาพ PNG/GIF/JPG etc. (ค่าปกติคือ JPG)';
		$TR_STRS[strtolower('Image Folder')] = 'โฟลเดอร์รูปภาพ';
		$TR_STRS[strtolower('Path to the image folder relative to the site url, eg: images/stories')] = 'พาทของโฟลเดอร์รูปภาพ, เช่น: images/stories';
		$TR_STRS[strtolower('Link')] = 'ลิงก์';
		$TR_STRS[strtolower('A URL to redirect to if image is clicked on, eg: http://www.mamboserver.com')] = 'URLที่ต้องการให้ระบบรีไดเร็กไปเมื่อทำการคลิกที่รูปภาพ เช่น http://www.mamboserver.com';
		$TR_STRS[strtolower('Width (px)')] = 'กว้าง (px)';
		$TR_STRS[strtolower('Image width (forces all images to be displayed with this width)')] = 'ความกว้างของรูป (ส่งผลให้ทุกรูปภาพถูกแสดงด้วยความกว้างนี้)';
		$TR_STRS[strtolower('Height (px)')] = 'สูง(px)';
		$TR_STRS[strtolower('Image height (forces all images to be displayed with the height)')] = 'ความสูงของรูป (ส่งผลให้ทุกรูปภาพถูกแสดงด้วยความสูงนี้)';
		$TR_STRS[strtolower('Related Items')] = 'หัวข้อที่เกี่ยวข้อง';
		$TR_STRS[strtolower('Text')] = 'ข้อความ';
		$TR_STRS[strtolower('Enter the text to be displayed along with the RSS links')] = 'กรุณาใส่ข้อความที่ต้องการให้แสดงกับลิงก์ RSS';
		$TR_STRS[strtolower('Show/Hide RSS 0.91 Link')] = 'แสดง/ซ่อนลิงก์ RSS 0.91';
		$TR_STRS[strtolower('Show/Hide RSS 1.0 Link')] = 'แสดง/ซ่อนลิงก์  RSS 1.0';
		$TR_STRS[strtolower('Show/Hide RSS 2.0 Link')] = 'แสดง/ซ่อนลิงก์  RSS 2.0';
		$TR_STRS[strtolower('Show/Hide Atom 0.3 Link')] = 'แสดง/ซ่อนลิงก์  Atom 0.3';
		$TR_STRS[strtolower('Show/Hide OPML Link')] = 'แสดง/ซ่อนลิงก์  OPML';
		$TR_STRS[strtolower('RSS 0.91 Image')] = 'รูป RSS 0.91';
		$TR_STRS[strtolower('Choose the image to be used')] = 'เลือกรูปภาพที่ต้องการ';
		$TR_STRS[strtolower('RSS 1.0 Image')] = 'รูป RSS 1.0';
		$TR_STRS[strtolower('RSS 2.0 Image')] = 'รูป RSS 2.0';
		$TR_STRS[strtolower('Atom Image')] = 'รูป Atom';
		$TR_STRS[strtolower('OPML Image')] = 'รูป OPML';
		$TR_STRS[strtolower('Search Module')] = 'โมดูลค้นหา';
		$TR_STRS[strtolower('Box Width')] = 'ความกว้าง';
		$TR_STRS[strtolower('Size of the search text box')] = 'ขนาดของเท็กซ์บล๊อกค้นหา';
		$TR_STRS[strtolower('The text that appears in the search text box, if left blank it will load _SEARCH_BOX from your language file')] = 'ข้อความนั้นจะปรากฎในเท็กซ์บล๊อกค้นหา - หากไม่ระบุ ระบบจะโหลดข้อมูลมาจากไฟล์ภาษาโดยอัตโนมัติ';
		$TR_STRS[strtolower('Search Button')] = 'ปุ่มค้นหา';
		$TR_STRS[strtolower('Display a Search Button')] = 'แสดงปุ่มค้นหา';
		$TR_STRS[strtolower('Button Position')] = 'ตำแหน่งปุ่ม';
		$TR_STRS[strtolower('Position of the button relative to the search box')] = 'ตำแหน่งของปุ่มจะถูกปรับเปลี่ยนตามเท็กซ์บล๊อกค้นหา';
		$TR_STRS[strtolower('Top')] = 'บน';
		$TR_STRS[strtolower('Bottom')] = 'ล่าง';
		$TR_STRS[strtolower('Button Text')] = 'ข้อความด้านล่าง';
		$TR_STRS[strtolower('The text that appears in the search button, if left blank it will load _SEARCH_TITLE from your language file')] = 'ข้อความนั้นจะปรากฎในปุ่มค้นหา - หากไม่ระบุ ระบบจะโหลดข้อมูลมาจากไฟล์ภาษาโดยอัตโนมัติ';
		$TR_STRS[strtolower('Sections')] = 'ส่วน';
		$TR_STRS[strtolower('Statistics')] = 'สถิติ';
		$TR_STRS[strtolower('Server Info')] = 'ข้อมูลเครื่องเซริฟเวอร์';
		$TR_STRS[strtolower('Display server information')] = 'แสดงข้อมูลเครื่องเซิร์ฟเวอร์';
		$TR_STRS[strtolower('Site Info')] = 'ข้อมูลเว็บไซต์';
		$TR_STRS[strtolower('Display site information')] = 'แสดงข้อมูลเว็บไซต์';
		$TR_STRS[strtolower('Hit Counter')] = 'ตัวนับจำนวนผู้ชม';
		$TR_STRS[strtolower('Display hit counter')] = 'แสดงตัวนับจำนวนผู้ชม';
		$TR_STRS[strtolower('Increase counter')] = 'เพิ่มค่าตัวนับ';
		$TR_STRS[strtolower('Enter the amount of hits to increase counter by')] = 'เพิ่มค่าตัวนับโดย';
		$TR_STRS[strtolower('Template Chooser')] = 'ตัวเลือกเทมเพลท';
		$TR_STRS[strtolower('Max. Name Length')] = 'ความยาวของชื่อสูงสุด';
		$TR_STRS[strtolower('This is the maximum length of the template name to display (default 20)')] = 'ความยาวของชื่อเทมเพลทสูงสุดที่จะถูกแสดง (ค่าปกติ = 20)';
		$TR_STRS[strtolower('Show Preview')] = 'แสดงพรีวิว';
		$TR_STRS[strtolower('Template preview is to be shown')] = 'แสดงพรีวิวเทมเพลท';
		$TR_STRS[strtolower('This is the width of the preview image (default 140)')] = 'ความกว้างรูปพรีวิวของเทมเพลท (ค่าปกติ =140)';
		$TR_STRS[strtolower('This is the height of the preview image (default 90)')] = 'ความสูงรูปพรีวิวของเทมเพลท (ค่าปกติ = 90)';
		$TR_STRS[strtolower("Who's Online")] = "ผู้เข้าชมในขณะนี้";
		$TR_STRS[strtolower('Display')] = 'แสดง';
		$TR_STRS[strtolower('Select what shall be shown')] = 'เลือกรายการที่ต้องการแสดง';
		$TR_STRS[strtolower('# of Guests/Members<br>')] = 'จำนวนของผู้ชม/สมาชิก<br>';
		$TR_STRS[strtolower('Member Names<br>')] = 'ชื่อสมาชิก<br>';
		$TR_STRS[strtolower('Wrapper Module')] = 'โมดูลแร็บเปอร์';
		$TR_STRS[strtolower('Url')] = 'Url';
		$TR_STRS[strtolower('Url to site/file you wish to display within the Iframe')] = 'Url ของเว็บไซต์หรือไฟล์ที่ต้องการแสดงใน Iframe';
		$TR_STRS[strtolower('Scroll Bars')] = 'สกรอลบาร์';
		$TR_STRS[strtolower('Show/Hide Horizontal & Vertical scroll bars.')] = 'แสดง/ซ่อน สกรอลบาร์ในแนวนอนและแนวตั้ง';
		$TR_STRS[strtolower('Auto')] = 'อัตโนมัติ';
		$TR_STRS[strtolower('Width of the IFrame Window, you can enter an absolute figure in pixels, or a relative figure by adding a %')] = 'ความกว้างของหน้าต่าง IFrame, คุณสามารถกำหนดหน่วยเป็น Pixel(px) หรือเปอร์เซ็น(%)';
		$TR_STRS[strtolower('Height of the IFrame Window')] = 'ความสูงของหน้าต่าง IFrame';
		$TR_STRS[strtolower('Auto Height')] = 'กำหนดความสูงอัตโนมัติ';
		$TR_STRS[strtolower('The height will automatically be set to the size of the external page. This will only work for pages on your own domain.')] = 'ค่าความสูงจะถูกกำหนดโดยอัตโนมัติ - คุณสมบัตินี้จะมีผลต่อหน้าเพจภายในโดเมนของคุณเท่านั้น';
		$TR_STRS[strtolower('Auto Add')] = 'เพิ่มอัตโนมัติ';
		$TR_STRS[strtolower('By default http:// will be added unless it detects http:// or https:// in the url link you provide, this allow you to switch this ability off')] = 'หากระบบไม่พบ http:// หรือ https:// โดยปกติระบบจะทำการเพิ่ม http:// ให้โดยอัตโนมัติ - คุณสามารถยกเลิกคุณสมบัตินี้ของระบบได้';

		$TR_STRS[strtolower('Search')] = 'ค้นหา';
		$TR_STRS[strtolower('User Menu')] = 'เมนูผู้ใช้';
		$TR_STRS[strtolower('Top Menu')] = 'เมนูด้านบน';
		$TR_STRS[strtolower('Other Menu')] = 'เมนูอื่นๆ';
		$TR_STRS[strtolower('Archive')] = 'คลังเนื้อหา';
		$TR_STRS[strtolower('Wrapper')] = 'แร็บเปอร์';
		$TR_STRS[strtolower('Popular')] = 'ความนิยม';

		$TR_STRS[strtolower('RSS URL')] = 'RSS URL';
		$TR_STRS[strtolower('Enter the URL of the RSS/RDF feed')] = 'ใส่ URL สำหรับ RSS/RDF feed';
		$TR_STRS[strtolower('Feed Description')] = 'คำอธิบาย Feed';
		$TR_STRS[strtolower('Show the description text for the whole Feed')] = 'แสดงข้อความคำอธิบายสำหรับใส่ Feed ทั้งหมด';
		$TR_STRS[strtolower('Feed Image')] = 'รูปภาพ Feed';
		$TR_STRS[strtolower('Show the image associated with the whole Feed')] = 'แสดงรูปภาพที่เกี่ยวข้องกับ Feed ทั้งหมด';
		$TR_STRS[strtolower('Items')] = 'รายการ';
		$TR_STRS[strtolower('Enter number of RSS items to display')] = 'ใส่จำนวนของรายการ RSS ที่ต้องการแสดง';
		$TR_STRS[strtolower('Item Description')] = 'รายละเอียด';
		$TR_STRS[strtolower('Show the description or intro text of individual news items')] = 'แสดงคำอธิบาย หรือ ข้อความส่วนต้นของรายการข่าวส่วนตัว';
		$TR_STRS[strtolower('Word Count')] = 'นับจำนวนคำ';
		$TR_STRS[strtolower('Allows you to limit the amount of visible item description text. 0 will show all the text')] = 'ความยามของข้อความที่ต้องการแสดง. ถ้าใส่ 0 จะแสดงทั้งหมด';

		//administrator/modules XML file
		$TR_STRS[strtolower('Logged')] = 'อยู่ในระบบ';
		$TR_STRS[strtolower('Logged in Users')] = 'ผู้ใช้งานที่ล็อกอินอยู่';
		$TR_STRS[strtolower('Components')] = 'คอมโพเน้นท์';
		$TR_STRS[strtolower('Popular Items')] = 'เนื้อหายอดนิยม';
		$TR_STRS[strtolower('Latest Items')] = 'เนื้อหาล่าสุด';
		$TR_STRS[strtolower('Menu Stats')] = 'เมนูสถิติ';
		$TR_STRS[strtolower('Unread Messages')] = 'ข้อความที่ยังไม่ได้เปิดอ่าน';
		$TR_STRS[strtolower('Online Users')] = 'ผู้ใช้งานที่ออนไลน์';
		$TR_STRS[strtolower('Quick Icons')] = 'ไอคอนทางลัด';
		$TR_STRS[strtolower('System Message')] = 'ข้อความจากระบบ';
		$TR_STRS[strtolower('Pathway')] = 'พาทเวย์';
		$TR_STRS[strtolower('Toolbar')] = 'ทูลบาร์';
		$TR_STRS[strtolower('Full Menu')] = 'เมนูเต็ม';

		//mambots XML file
		$TR_STRS[strtolower('MOS Image')] = 'MOS Image';
		$TR_STRS[strtolower('Legacy Mambot Includer')] = 'Legacy Mambot Includer';
		$TR_STRS[strtolower('Code support')] = 'Code support';
		$TR_STRS[strtolower('SEF')] = 'SEF';
		$TR_STRS[strtolower('MOS Rating')] = 'MOS Rating';
		$TR_STRS[strtolower('Email Cloaking')] = 'Email Cloaking';
		$TR_STRS[strtolower('GeSHi')] = 'GeSHi';
		$TR_STRS[strtolower('Load Module Positions')] = 'Load Module Positions';
		$TR_STRS[strtolower('MOS Pagination')] = 'MOS Pagination';
		$TR_STRS[strtolower('No WYSIWYG Editor')] = 'No WYSIWYG เอดิเตอร์';
		$TR_STRS[strtolower('TinyMCE WYSIWYG Editor')] = 'TinyMCE WYSIWYG เอดิเตอร์';
		$TR_STRS[strtolower('MOS Image Editor Button')] = 'MOS Image Editor Button';
		$TR_STRS[strtolower('MOS Pagebreak Editor Button')] = 'MOS Pagebreak Editor Button';
		$TR_STRS[strtolower('Search Content')] = 'ค้นหาเนื้อหา';
		$TR_STRS[strtolower('Search Weblinks')] = 'ค้นหาเว็บลิงก์';
		$TR_STRS[strtolower('Search Contacts')] = 'ค้นหาข้อมูลการติดต่อ';
		$TR_STRS[strtolower('Search Categories')] = 'ค้นหาหมวด';
		$TR_STRS[strtolower('Search Sections')] = 'ค้นหาส่วน';
		$TR_STRS[strtolower('Search Newsfeeds')] = 'ค้นหา Newsfeeds';

		$TR_STRS[strtolower('Mode')] = 'โหมด';
		$TR_STRS[strtolower('Select how the emails will be displayed')] = 'เลือกรูปแบบในการแสดงอีเมล';
		$TR_STRS[strtolower('Nonlinkable Text')] = 'ข้อความไม่สามารถลิงก์ได้';
		$TR_STRS[strtolower('As linkable mailto address')] = 'กำหนดให้เป็นลิงก์ที่เชื่อมต่อไปยังการส่งเมล';
		$TR_STRS[strtolower('Margin')] = 'เส้นขอบ';
		$TR_STRS[strtolower('Margin in px, of Div surrounding Image & Caption - only applies if using a Caption')] = 'เส้นขอบเป็น (พิกเซล) px, สำหรับรอบๆ Div รูปภาพ & คำอธิบายภาพ - เมื่อมีการใช้คำอธิบายภาพ';
		$TR_STRS[strtolower('Padding')] = 'ระยะห่าง';
		$TR_STRS[strtolower('Padding in px, of Div surrounding Image & Caption - only applies if using a Caption')] = 'ระยะห่างเป็น (พิกเซล) px, สำหรับรอบๆ Div รูปภาพ & คำอธิบายภาพ - เมื่อมีการใช้คำอธิบายภาพ';
		$TR_STRS[strtolower('Wrapped by Table - Column')] = 'แร็บเปอร์แบบตาราง - คอลัมน์';
		$TR_STRS[strtolower('Wrapped by Table - Horizontal')] = 'แร็บเปอร์แบบตาราง - แนวนอน';
		$TR_STRS[strtolower('Wrapped by Divs')] = 'แร็บเปอร์แบบ Divs';
		$TR_STRS[strtolower('No wrapping - raw output')] = 'ไม่ใช้แร็บเปอร์ - ผลลัพธ์ดิบ';
		$TR_STRS[strtolower('Site Title')] = 'หัวข้อเว็บไซต์';
		$TR_STRS[strtolower('title and heading attibutes from mambot added to Site Title tag')] = 'หัวเรื่อง และหัวข้อที่มาจากแมมบอทที่เพิ่มคำอธิบายหัวเรื่องเว็บ';

		$TR_STRS[strtolower('Functionality')] = 'หน้าที่';
		$TR_STRS[strtolower('Select functionality')] = 'เลือกหน้าที่';
		$TR_STRS[strtolower('Basic')] = 'พื้นฐาน';
		$TR_STRS[strtolower('Advanced')] = 'ขั้นสูง';
		$TR_STRS[strtolower('Text Direction')] = 'แนวข้อความ';
		$TR_STRS[strtolower('Ability to change text direction')] = 'ความสามารถในการเปลี่ยนแนวข้อความ';
		$TR_STRS[strtolower('Left to Right')] = 'จากซ้ายไปขวา';
		$TR_STRS[strtolower('Right to Left')] = 'จากขวาไปซ้าย';
		$TR_STRS[strtolower('Prohibited Elements')] = 'ห้ามแสดงส่วนประกอบ';
		$TR_STRS[strtolower('Elements that will be cleaned from the text')] = 'ส่วนประกอบเหล่านั้นจะทำความสะอาดข้อความ';
		$TR_STRS[strtolower('Template CSS classes')] = 'เทมเพลต CSS คลาส';
		$TR_STRS[strtolower('Load CSS classes from template_css.css')] = 'โหลดคลาส CSS จากไฟล์ template_css.css';
		$TR_STRS[strtolower('Custom CSS Classes')] = 'ทั้วไป CSS คลาส';
		$TR_STRS[strtolower('You can specify the loading of a custom CSS file - simply enter the FULL path to the css file you want loaded')] = 'คุณสามารถเจาะจงการโหลด CSS ไฟล์ปกติ - โดยใส่พาธเต็มๆ สู้ไฟล์ css ที่คุณต้องการโหลด';
		$TR_STRS[strtolower('Newlines')] = 'บรรทัดใหม่';
		$TR_STRS[strtolower('Newlines will be made into the selected option')] = 'บรรทัดใหม่จะถูกกำหนดให้กับตัวเลือกที่เลือกไว้';
		$TR_STRS[strtolower('BR Elements')] = 'แทรกโค๊ด BR';
		$TR_STRS[strtolower('P Elements')] = 'แทรกโค๊ด P';
		$TR_STRS[strtolower('Position of the toolbar')] = 'ตำแหน่งของทูลบาร์';
		$TR_STRS[strtolower('Popup Height')] = 'ความสูงของ พ็อพอัพ';
		$TR_STRS[strtolower('Height of HTML mode pop-up window - only in Advanced Mode')] = 'ความสูงของหน้าต่าง HTML โหมดพ็อพอัพ - เฉพาะ Advanced Mode';
		$TR_STRS[strtolower('Popup Width')] = 'ความกว้างของ Popup';
		$TR_STRS[strtolower('Width of HTML mode pop-up window - only in Advanced Mode')] = 'ความกว้างของหน้าต่าง HTML โหมดพ็อพอัพ - เฉพาะ Advanced Mode';

		//administrator/components/com_contact/contact.xml
		$TR_STRS[strtolower('Contact')] = 'ข้อมูลการติดต่อ';
		$TR_STRS[strtolower('This component shows a listing of Contact Information')] = 'คอมโพเน้นท์นี้ทำหน้าที่แสดงข้อมูลการติดต่อ';
		$TR_STRS[strtolower('Page Title')] = 'หัวข้อหน้าเพจ';
		$TR_STRS[strtolower('Show/Hide the pages Title')] = 'แสดง/ซ่อนหัวข้อหน้าเพจ';
		$TR_STRS[strtolower('Text to display at the top of the page. If left blank, the Menu name will be used instead')] = 'ข้อความนี้จะแสดงยังส่วนบนของหน้าเพจ - หากไม่ระบุ ระบบจะกำหนดให้เป็นชื่อของเมนูโดยอัตโนมัติ';
		$TR_STRS[strtolower('Category List - Section')] = 'รายการหมวด - ส่วน';
		$TR_STRS[strtolower('Show/Hide the List of Categories in List view page')] = 'แสดง/ซ่อน รายการหมวดของเนื้อหาในหน้ามุมมองแบบลิสรายการ  ';
		$TR_STRS[strtolower('Category List - Category')] = 'รายการหมวด - หมวด';
		$TR_STRS[strtolower('Show/Hide the List of Categories in Table view page')] = 'แสดง/ซ่อน รายการหมวดของเนื้อหาในหน้ามุมมองแบบตารางรายการ';
		$TR_STRS[strtolower('Category Description')] = 'รายละเอียดหมวดของเนื้อหา';
		$TR_STRS[strtolower('Show/Hide the Description for the list of other catgeories')] = 'แสดง/ซ่อน';
		$TR_STRS[strtolower('# Category Items')] = 'จำนวนรายการหมวดของเนื้อหา';
		$TR_STRS[strtolower('Show/Hide the number of items in each category')] = 'แสดง/ซ่อน จำนวนรายการในแต่ละหมวดของเนื้อหา';
		$TR_STRS[strtolower('Show/Hide the Description below')] = 'แสดง/ซ่อน รายละเอียดด้านล่างนี้';
		$TR_STRS[strtolower('Description for page, if left blank it will load _WEBLINKS_DESC from your language file')] = 'รายละเอียดของเว็บเพจ - หากไม่ระบุ ระบบจะโหลดข้อมูลมาจากไฟล์ภาษาโดยอัตโนมัติ';
		$TR_STRS[strtolower('Image for page, must be located in the /images/stories folder. Default will load web_links.jpg, No image will mean an image is not loaded')] = 'รูปภาพที่ต้องการแสดงบนหน้าเพจจะต้องถูกเก็บอยู่ในโฟลเดอร์ /images/stories - โดยปกติระบบจะโหลดรูป web_links.jpg - หากไม่มีรูปภาพในโฟลเดอร์ จะไม่การโหลดรูปใดใด';
		$TR_STRS[strtolower('Image Align')] = 'ตำแหน่งรูปภาพ';
		$TR_STRS[strtolower('Alignment of the image')] = 'การจัดเรียงรูปภาพ';
		$TR_STRS[strtolower('Table Headings')] = 'หัวข้อตาราง';
		$TR_STRS[strtolower('Show/Hide the Table Headings')] = 'แสดง/ซ่อน หัวข้อตาราง';
		$TR_STRS[strtolower('Position Column')] = 'ตำแหน่ง';
		$TR_STRS[strtolower('Show/Hide the Position column')] = 'แสดง/ซ่อน ตำแหน่ง';
		$TR_STRS[strtolower('Email Column')] = 'อีเมล';
		$TR_STRS[strtolower('Show/Hide the Email column')] = 'แสดง/ซ่อน อีเมล';
		$TR_STRS[strtolower('Telephone Column')] = 'โทรศัพท์';
		$TR_STRS[strtolower('Show/Hide the Telephone column')] = 'แสดง/ซ่อน โทรศัพท์';
		$TR_STRS[strtolower('Fax Column')] = 'โทรสาร';
		$TR_STRS[strtolower('Show/Hide the Fax column')] = 'แสดง/ซ่อน โทรสาร';

		//administrator/components/com_contact/contact_items.xml
		$TR_STRS[strtolower('Contact Items')] = 'รายการข้อมูลการติดต่อ';
		$TR_STRS[strtolower('Parameters for individual Contact Items')] = 'พารามิเตอร์สำหรับรายการการติดต่อ';
		$TR_STRS[strtolower('Menu Image')] = 'รูปภาพของเมนู';
		$TR_STRS[strtolower('A small image to be placed to the left or right of your menu item, images must be in images/stories/')] = 'รูปภาพขนาดเล็กจะวางอยู่ในตำแหน่งซ้ายหรือขวาของรายการเมนู โดยรูปภาพนั้นจะต้องเก็บอยู่ในโฟลเดอร์ images/stories/';
		$TR_STRS[strtolower('Page Class Suffix')] = 'คำเสริมท้ายคลาสของหน้า';
		$TR_STRS[strtolower('A suffix to be applied to the css classes of the page, this allows individual page styling')] = 'คำเสริมท้ายคลาส css ของแต่ละหน้า, สิ่งนี้จะทำงานในหน้าที่ต้องการ';
		$TR_STRS[strtolower('Print Icon')] = 'ไอคอนพิมพ์';
		$TR_STRS[strtolower('Show/Hide the item print button - only affects this page')] = 'แสดง/ซ่อน ปุ่มพิมพ์ - ให้มีผลสำหรับหน้านี้';
		$TR_STRS[strtolower('Back Button')] = 'ปุ่มย้อนกลับ';
		$TR_STRS[strtolower('Show/Hide a Back Button, that returns you to the previously view page')] = 'แสดง/ซ่อน ปุ่มย้อนกลับ เพื่อย้อนกลับไปยังเพจก่อนหน้านี้';
		$TR_STRS[strtolower('Name')] = 'ชื่อ';
		$TR_STRS[strtolower('Show/Hide the name info')] = 'แสดง/ซ่อน ชื่อ';
		$TR_STRS[strtolower('Position')] = 'ตำแหน่ง';
		$TR_STRS[strtolower('Show/Hide the position info')] = 'แสดง/ซ่อน ตำแหน่ง';
		$TR_STRS[strtolower('Email')] = 'อีเมล';
		$TR_STRS[strtolower('Show/Hide the email info, if you set to show the address will be protected from spambots by javascript cloaking')] = 'แสดง/ซ่อน รายละเอียดของอีเมล, หากกำหนดให้แสดง ที่อยู่จะถูกป้องกันจากระบบสแปมบอทด้วยjavascript cloaking';
		$TR_STRS[strtolower('Street Address')] = 'ที่อยู่,ถนน';
		$TR_STRS[strtolower('Show/Hide the street address info')] = 'แสดง/ซ่อน ที่อยู่,ถนน';
		$TR_STRS[strtolower('Town/Suburb')] = 'ตำบล,อำเภอ';
		$TR_STRS[strtolower('Show/Hide the suburb info')] = 'แสดง/ซ่อน ตำบล,อำเภอ';
		$TR_STRS[strtolower('State')] = 'จังหวัด';
		$TR_STRS[strtolower('Show/Hide the state info')] = 'แสดง/ซ่อน จังหวัด';
		$TR_STRS[strtolower('Country')] = 'ประเทศ';
		$TR_STRS[strtolower('Show/Hide the country info')] = 'แสดง/ซ่อน ประเทศ';
		$TR_STRS[strtolower('Post/Zip Code')] = 'รหัสไปรษณีย์';
		$TR_STRS[strtolower('Show/Hide the post code info')] = 'แสดง/ซ่อน รหัสไปรษณีย์';
		$TR_STRS[strtolower('Telephone')] = 'โทรศัพท์';
		$TR_STRS[strtolower('Show/Hide the telephone info')] = 'แสดง/ซ่อน โทรศัพท์';
		$TR_STRS[strtolower('Fax')] = 'โทรสาร';
		$TR_STRS[strtolower('Show/Hide the fax info')] = 'แสดง/ซ่อน โทรสาร';
		$TR_STRS[strtolower('Misc Info')] = 'ข้อมูลเพิ่มเติม';
		$TR_STRS[strtolower('Show/Hide the misc info')] = 'แสดง/ซ่อน ข้อมูลเพิ่มเติม';
		$TR_STRS[strtolower('Vcard')] = 'วีการ์ด';
		$TR_STRS[strtolower('Show/Hide the Vcard')] = 'ซ่อน/แสดง วีการ์ด';
		$TR_STRS[strtolower('Image')] = 'รูปภาพ';
		$TR_STRS[strtolower('Show/Hide the image')] = 'แสดง/ซ่อน รูปภาพ';
		$TR_STRS[strtolower('Email description')] = 'รายละเอียดอีเมล';
		$TR_STRS[strtolower('Show/Hide the Description Text below')] = 'แสดง/ซ่อน ข้อความแสดงรายละเอียดด้านล่าง';
		$TR_STRS[strtolower('Description text')] = 'ข้อความแสดงรายละเอียด';
		$TR_STRS[strtolower('The Description text for the Email form, if left blank it will use the _EMAIL_DESCRIPTION language definition')] = 'ข้อความเหล่านี้สำหรับแบบฟอร์มอีเมล, หากไม่ระบุระบบจะดึงมาจาก  _EMAIL_DESCRIPTION language definition';
		$TR_STRS[strtolower('Email Form')] = 'แบบฟอร์มอีเมล';
		$TR_STRS[strtolower('Show/Hide the email to form')] = 'แสดง/ซ่อน แบบฟอร์มอีเมล';
		$TR_STRS[strtolower('Email Copy')] = 'ทำสำเนาอีเมล';
		$TR_STRS[strtolower('Show/Hide the checkbox to email a copy to the senders address')] = 'แสดง/ซ่อน เช็คบล๊อกสำหรับสำเนาอีเมลกลับไปยังผู้ส่ง';
		$TR_STRS[strtolower('Drop Down')] = 'ดร๊อบดาวน์';
		$TR_STRS[strtolower('Show/Hide the Drop Down select list in Contact view')] = 'แสดง/ซ่อน ดร๊อบดาวน์สำหรับเลือกรายการในข้อมูลการติดต่อ';
		$TR_STRS[strtolower('Icons/text')] = 'ไอคอน/ข้อความ';
		$TR_STRS[strtolower('Use Icons, text or nothing next to the contact information displayed')] = 'ระบุว่าจะใช้ไอคอน ข้อความ หรือปล่อยว่าง สำหรับการแสดงข้อมูลการติดต่อ';
		$TR_STRS[strtolower('Icons')] = 'ไอคอน';
		$TR_STRS[strtolower('Address Icon')] = 'ไอคอนที่อยู่';
		$TR_STRS[strtolower('Icon for the Address info')] = 'ไอคอนของที่อยู่';
		$TR_STRS[strtolower('Email Icon')] = 'ไอคอนอีเมล';
		$TR_STRS[strtolower('Icon for the Email info')] = 'ไอคอนของอีเมล';
		$TR_STRS[strtolower('Telephone Icon')] = 'ไอคอนโทรศัพท์';
		$TR_STRS[strtolower('Icon for the Telephone info')] = 'ไอคอนของโทรศัพท์';
		$TR_STRS[strtolower('Fax Icon')] = 'ไอคอนโทรสาร';
		$TR_STRS[strtolower('Icon for the Fax info')] = 'ไอคอนของโทรสาร';
		$TR_STRS[strtolower('Misc Icon')] = 'ไอคอนข้อมูลอื่นๆ';
		$TR_STRS[strtolower('Icon for the Misc info')] = 'ไอคอนของข้อมูลอื่นๆ';

		//administrator/components/com_content XML files
		$TR_STRS[strtolower('Content Page')] = 'หน้าเนื้อหา';
		$TR_STRS[strtolower('This shows a single content page')] = 'แสดงเพียงหน้าเดียวของเนื้อหา';
		$TR_STRS[strtolower('Item Title')] = 'หัวข้อเนื้อหา';
		$TR_STRS[strtolower('Show/Hide the items title')] = 'แสดง/ซ่อน หัวข้อเนื้อหา';
		$TR_STRS[strtolower('Make your Item titles linkable')] = 'กำหนดให้หัวข้อเนื้อหาเป็นลิงก์';
		$TR_STRS[strtolower('Intro Text')] = 'บทนำ';
		$TR_STRS[strtolower('Show/Hide the intro text')] = 'แสดง/ซ่อน บทนำ';
		$TR_STRS[strtolower('Section Name')] = 'ส่วน';
		$TR_STRS[strtolower('Show/Hide the Section the item belongs to')] = 'การแสดง/ซ่อน ส่วนของเนื้อหาให้ขึ้นอยู่กับ..';
		$TR_STRS[strtolower('Section Name Linkable')] = 'กำหนดให้ส่วนของเนื้อหาเป็นลิงก์';
		$TR_STRS[strtolower('Make the Section text a link to the actual section page')] = 'กำหนดให้ส่วนของเนื้อหาเป็นลิงก์ไปยังหน้าของส่วนของเนื้อหา';
		$TR_STRS[strtolower('Category Name')] = 'หมวด';
		$TR_STRS[strtolower('Show/Hide the Category the item belongs to')] = 'การแสดง/ซ่อน หมวดของเนื้อหาให้ขึ้นอยู่กับ..';
		$TR_STRS[strtolower('Category Name Linkable')] = 'กำหนดให้หมวดของเนื้อหาเป็นลิงก์';
		$TR_STRS[strtolower('Make the Category text a link to the actual Category page')] = 'กำหนดใหหมวดของเนื้อหาเป็นลิงก์ไปยังหน้าของหมวดของเนื้อหา';
		$TR_STRS[strtolower('Item Rating')] = 'อัตราการเข้าชมเนื้อหา';
		$TR_STRS[strtolower('Show/Hide the item rating - only affects this page')] = 'แสดง/ซ่อน อัตราการเข้าชม - มีผลเฉพาะเนื้อหานี้เท่านั้น';
		$TR_STRS[strtolower('Author Names')] = 'ชื่อผู้แต่ง';
		$TR_STRS[strtolower('Show/Hide the item author - only affects this page')] = 'แสดง/ซ่อน ชื่อผู้แต่ง - มีผลเฉพาะเนื้อหานี้เท่านั้น';
		$TR_STRS[strtolower('Created Date and Time')] = 'วันที่และเวลาที่สร้างเนื้อหา';
		$TR_STRS[strtolower('Show/Hide the item creation date - only affects this page')] = 'แสดง/ซ่อน วันที่และเวลาที่สร้างเนื้อหา - มีผลเฉพาะเนื้อหานี้เท่านั้น';
		$TR_STRS[strtolower('Modified Date and Time')] = 'วันที่และเวลาที่แก้ไขเนื้อหา';
		$TR_STRS[strtolower('Show/Hide the item modification date - only affects this page')] = 'แสดง/ซ่อน วันที่และเวลาที่แก้ไขเนื้อหา - มีผลเฉพาะเนื้อหานี้เท่านั้น';
		$TR_STRS[strtolower('Show/Hide the item pdf button - only affects this page')] = 'แสดง/ซ่อน ปุ่มสำหรับแปลงเนื้อหาให้เป็นเอกสารPDF - มีผลเฉพาะเนื้อหานี้เท่านั้น';
		$TR_STRS[strtolower('Show/Hide the item email button - only affects this page')] = 'แสดง/ซ่อน ปุ่มสำหรับส่งเนื้อหาผ่านทางอีเมล - มีผลเฉพาะเนื้อหานี้เท่านั้น';
		$TR_STRS[strtolower('Key Reference')] = 'คีย์ที่ใช้อ้างอิง';
		$TR_STRS[strtolower('A text key that an item may be referenced by (like a help reference)')] = 'ข้อความหรือคำที่สามารถใช้อ้างอิงมายังเนื้อหานี้';

		//administrator/components/com_frontpage/frontpage.xml
		$TR_STRS[strtolower('Frontpage')] = 'เว็บเพจหน้าแรก';
		$TR_STRS[strtolower('This component shows all the published content items from your site marked Show on Frontpage.')] = 'คอมโพเน้นท์นี้ทำหน้าที่แสดงเนื้อหาที่เผยแพร่ทุกเนื้อหาไปยังเว็บเพจหน้าแรก';
		$TR_STRS[strtolower('Text to display at the top of the page')] = 'ข้อความที่ต้องการแสดงในส่วนบนของหน้าเว็บเพจ';
		$TR_STRS[strtolower('Show/Hide the Page title')] = 'แสดง/ซ่อน หัวข้อของหน้าเว็บเพจ';
		$TR_STRS[strtolower('# Leading')] = 'จำนวนรายการในส่วนของเนื้อหานำ';
		$TR_STRS[strtolower('Number of Items to display as a leading (full width) item. 0 will mean that no items will be displayed as leading.')] = 'จำนวนของรายการที่ต้องการแสดงในส่วนของเนื้อหานำ (กว้างเต็ม 100%). หากไม่ต้องการให้มีรายการแสดงในส่วนนี้ให้กำหนดค่านี้เท่ากับศูนย์ 0 ';
		$TR_STRS[strtolower('# Intro')] = 'จำนวนรายการในส่วนของเนื้อหาแนะนำ';
		$TR_STRS[strtolower('Number of Items to display with the introduction text shown.')] = 'จำนวนรายการในส่วนของเนื้อหาแนะนำ ซึ่งเป็นส่วนที่อยู่ถัดลงมาจากเนื้อหานำ';
		$TR_STRS[strtolower('Columns')] = 'จำนวนคอลัมน์ในส่วนของเนื้อหาแนะนำ';
		$TR_STRS[strtolower('When displaying the intro text, how many columns to use per row')] = 'กำหนดจำนวนคอลัมน์ต่อแถวในส่วนของเนื้อหาแนะนำ';
		$TR_STRS[strtolower('# Links')] = 'จำนวนรายการลิงก์';
		$TR_STRS[strtolower('Number of Items to display as Links.')] = 'จำนวนหัวข้อเนื้อหาที่ต้องการให้แสดงรายการแบบลิงก์';
		$TR_STRS[strtolower('Category Order')] = 'เรียงลำดับตามหมวดของเนื้อหา';
		$TR_STRS[strtolower('Order items by catgeory')] = 'การเรียงลำดับตามหมวดของเนื้อหา';
		$TR_STRS[strtolower('No, order by Primary Order only')] = 'เรียงลำดับตามการเรียงลำดับหลักเท่านั้น';
		$TR_STRS[strtolower('Ordering')] = 'การเรียงลำดับ';
		$TR_STRS[strtolower('Primary Order')] = 'การเรียงลำดับหลัก';
		$TR_STRS[strtolower('Order that the items will be displayed in.')] = 'จัดเรียงรายการที่แสดงอยู่.';
		$TR_STRS[strtolower('Pagination')] = 'การใส่เลขหน้า';
		$TR_STRS[strtolower('Show/Hide Pagination support')] = 'แสดง/ซ่อน ระบบสนับสนุนการใส่เลขหน้า';
		$TR_STRS[strtolower('Pagination Results')] = 'ผลลัพธ์การใส่เลขหน้า';
		$TR_STRS[strtolower('Show/Hide Pagination Results info ( e.g 1-4 of 4 )')] = 'แสดง/ซ่อน ผลลัพธ์การใส่เลขหน้า ( ตัวอย่างเช่น 1-4 จาก 4 )';
		$TR_STRS[strtolower('MOSImages')] = 'MOSImages';
		$TR_STRS[strtolower('Display {mosimages}.')] = 'แสดง {mosimages}.';
		$TR_STRS[strtolower('Item Titles')] = 'หัวข้อเนื้อหา';
		$TR_STRS[strtolower('Show/Hide the Read More link')] = 'แสดง/ซ่อน ลิงก์ "อ่านต่อ" ';
		$TR_STRS[strtolower('PDF Icon')] = 'ไอคอน PDF';

		//administrator/components/com_login/login.xml
		$TR_STRS[strtolower('Login Page Title')] = 'หัวข้อหน้าเข้าสู่ระบบ';
		$TR_STRS[strtolower('Login JS Message')] = 'ข้อความ JS เข้าสู่ระบบ';
		$TR_STRS[strtolower('Login Description')] = 'รายละเอียดหน้าเข้าสู่ระบบ';
		$TR_STRS[strtolower('Show/Hide the Login Description below')] = 'แสดง/ซ่อน รายละเอียดหน้าเข้าสู่ระบบด้านล่างนี้';
		$TR_STRS[strtolower('Login Description Text')] = 'ข้อความแสดงรายละเอียดหน้าเข้าสู่ระบบ';
		$TR_STRS[strtolower('Text to display on the login Page, if left blank _LOGIN_DESCRIPTION will be used')] = 'ข้อความที่ต้องการแสดงในหน้าเข้าสู่ระบบ หากไม่ระบุระบบจะโหลดข้อมูลมาจาก _LOGIN_DESCRIPTION';
		$TR_STRS[strtolower('Login Image')] = 'รูปภาพหน้าเข้าสู่ระบบ';
		$TR_STRS[strtolower('Image for the Login Page')] = 'รูปภาพหน้าเข้าสู่ระบบ';
		$TR_STRS[strtolower('Login Image Align')] = 'ตำแหน่งรูปภาพหน้าเข้าสู่ระบบ';
		$TR_STRS[strtolower('Alignment for Login Image')] = 'การจัดเรียงตำแหน่งรูปภาพหน้าเข้าสู่ระบบ';
		$TR_STRS[strtolower('Logout Page Title')] = 'หัวข้อหน้าออกจากระบบ';
		$TR_STRS[strtolower('What page will be redirected to after logout, if let blank will load front page')] = 'กำหนดหน้าเพจที่ต้องการหลังจากออกจากระบบ หากไม่ระบ ุระบบจะเชื่อมกลับไปยังเว็บเพจหน้าแรก';
		$TR_STRS[strtolower('Logout JS Message')] = 'ข้อความ JS ออกจากระบบ';
		$TR_STRS[strtolower('Logout Description')] = 'รายละเอียดการออกจากระบบ';
		$TR_STRS[strtolower('Show/Hide the Logout Description below')] = 'แสดง/ซ่อน รายละเอียดการออกจากระบบด้านล่างนี้';
		$TR_STRS[strtolower('Logout Description Text')] = 'ข้อความแสดงรายละเอียดการออกจากระบบ';
		$TR_STRS[strtolower('Text to display on the logout Page, if left blank _LOGOUT_DESCRIPTION will be used')] = 'ข้อความที่ต้องการแสดงในหน้าออกจากระบบ หากไม่ระบุระบบจะโหลดข้อมูลมาจาก _LOGOUT_DESCRIPTION';
		$TR_STRS[strtolower('Logout Image')] = 'รูปภาพหน้าออกจากระบบ';
		$TR_STRS[strtolower('Image for the Logout Page')] = 'รูปภาพหน้าออกจากระบบ';
		$TR_STRS[strtolower('Logout Image Align')] = 'ตำแหน่งรูปภาพหน้าออกจากระบบ';
		$TR_STRS[strtolower('Alignment for Logout Image')] = 'การจัดเรียงตำแหน่งรูปภาพหน้าออกจากระบบ';

//--- ให้ Mambothailand.com แปล
		//administrator/components/com_newsfeeds/newsfeeds.xml
		$TR_STRS[strtolower('Newsfeeds')] = 'Newsfeeds';
		$TR_STRS[strtolower('This component manages RSS/RDF newsfeeds')] = 'นี่คือคอมโพเน้นท์จัดการ RSS/RDF newsfeeds';
		$TR_STRS[strtolower('Name Column')] = 'ชื่อคอลัมน์';
		$TR_STRS[strtolower('Show/Hide the Feed Name column')] = 'แสดง/ซ่อน Feed Name คอลัมน์';
		$TR_STRS[strtolower('# Articles Column')] = 'จำนวนคอลัมน์';
		$TR_STRS[strtolower('Show/Hide the # of articles in the feed')] = 'แสดง/ซ่อน บทความใน feed';
		$TR_STRS[strtolower('Link Column')] = 'ลิงก์คอลัมน์';
		$TR_STRS[strtolower('Show/Hide the Feed Link column')] = 'แสดง/ซ่อน Feed ลิงก์คอลัมน์';
		$TR_STRS[strtolower('Show/Hide the image of the feed')] = 'แสดง/ซ่อน รูปภาพสำหรับ feed';
		$TR_STRS[strtolower('Show/Hide the description text of the feed')] = 'แสดง/ซ่อน ข้อความคำอธิบายของ feed';
		$TR_STRS[strtolower('Show/Hide the description or intro text of an item')] = 'แสดง/ซ่อน คำอธิบาย หรือข้อความส่วนต้นของรายการ';

		//administrator/components/com_syndicate XML files
		$TR_STRS[strtolower('Syndicate')] = 'กระจายข่าว';
		$TR_STRS[strtolower('This component controls the Syndication settings')] = 'คอมโพเน้นท์นี้ใช้ควบคุมการทำงานของการกระจายข่าว';
		$TR_STRS[strtolower('Cache')] = 'แคช';
		$TR_STRS[strtolower('Cache the feed files')] = 'แคชของ feed ไฟล์';
		$TR_STRS[strtolower('Cache Time')] = 'เวลาแคช';
		$TR_STRS[strtolower('Cache file will refresh every x seconds')] = 'กำหนดให้ทำการรีเฟรสแคททุกๆ กี่วินาที';
		$TR_STRS[strtolower('# Items')] = 'จำนวนรายการ';
		$TR_STRS[strtolower('Number of Items to syndicate')] = 'จำนวนรายการที่ต้องการทำการกระจายข่าว';
		$TR_STRS[strtolower('Title')] = 'หัวข้อ';
		$TR_STRS[strtolower('Syndication Title')] = 'หัวข้อกระจายข่าว';
		$TR_STRS[strtolower('Description')] = 'รายละเอียด';
		$TR_STRS[strtolower('Syndication Description')] = 'รายละเอียดกระจายข่าว';
		$TR_STRS[strtolower('Image to be included in feed')] = 'รูปภาพที่ถูกแสดงอยู่ใน feed';
		$TR_STRS[strtolower('Image Alt')] = 'ข้อความอธิบายของรูปภาพ';
		$TR_STRS[strtolower('Alt text for image')] = 'ข้อความที่กำหนดให้แก่ตัวแปรอธิบายของรูปภาพ';
		$TR_STRS[strtolower('Limit Text')] = 'จำกัดข้อความ';
		$TR_STRS[strtolower('Limit the article text to the value indicated below')] = 'จำกัดจำนวนข้อความในบทความที่แสดงด้านล่าง';
		$TR_STRS[strtolower('Text Length')] = 'ความยาวของข้อความ';
		$TR_STRS[strtolower('The word length of the article text - 0 will show no text')] = 'ความยาวของข้อความ - หากไม่ต้องการให้แสดงให้กำหนดค่านี้เป็น 0 ';
		$TR_STRS[strtolower('Order')] = 'ลำดับ';
		$TR_STRS[strtolower('Order that the items will be displayed')] = 'เรียงลำดับรายการที่แสดงอยู่';
		$TR_STRS[strtolower('Default')] = 'ค่าปกติ';
		$TR_STRS[strtolower('Frontpage Ordering')] = 'การจัดเรียงลำดับของเนื้อหาในหน้าแรก';
		$TR_STRS[strtolower('Oldest first')] = 'ให้ความสำคัญแก่เนื้อหาเก่าสุดเป็นอันดับแรก';
		$TR_STRS[strtolower('Most recent first')] = 'ให้ความสำคัญแก่เนื้อหาล่าสุดเป็นอันดับแรก';
		$TR_STRS[strtolower('Title Alphabetical')] = 'หัวเรื่องเรียงตามอักษร';
		$TR_STRS[strtolower('Title Reverse-Alphabetical')] = 'หัวเรื่องเรียงตามอักษรย้อนกลับ';
		$TR_STRS[strtolower('Author Alphabetical')] = 'ผู้เขียนเรียงตามอักษร';
		$TR_STRS[strtolower('Author Reverse-Alphabetical')] = 'ผู้เขียนเรียงตามอักษรย้อนกลับ';
		$TR_STRS[strtolower('Most Hits')] = 'มีผู้เข้าชมมากที่สุด';
		$TR_STRS[strtolower('Least Hits')] = 'มีผู้เข้าชมน้อยที่สุด';
		$TR_STRS[strtolower('Live Bookmarks')] = 'Live Bookmarks';
		$TR_STRS[strtolower('Activate support for Firefox Live Bookmarks functionality')] = 'กระตุ้นการสนับสนุนสำหรับ Firefox Live Bookmarks ฟังก์ชัน';
		$TR_STRS[strtolower('Off')] = 'ปิด';
		$TR_STRS[strtolower('RSS 0.91')] = 'RSS 0.91';
		$TR_STRS[strtolower('RSS 1.0')] = 'RSS 1.0';
		$TR_STRS[strtolower('RSS 2.0')] = 'RSS 2.0';
		$TR_STRS[strtolower('ATOM 0.3')] = 'ATOM 0.3';
		$TR_STRS[strtolower('Bookmark file')] = 'ไฟล์ Bookmark';
		$TR_STRS[strtolower('Special file name, if empty the default will be used.')] = 'ชื่อพิเศษ ,หากผู้ใช้เว้นว่างไว้ระบบจะตั้งให้โดยอัตโนมัติ';
		//administrator/components/com_newsfeeds/newsfeeds.xml
		$TR_STRS[strtolower('Newsfeeds')] = 'ข่าวสาร';
		$TR_STRS[strtolower('This component manages RSS/RDF newsfeeds')] = 'คอมโพเน้นท์สำหรับจัดการ RSS/RDF ';
		$TR_STRS[strtolower('Name Column')] = 'ชื่อคอลัมน์';
		$TR_STRS[strtolower('Show/Hide the Feed Name column')] = 'แสดง/ซ่อน ชื่อของคอลัมน์';
		$TR_STRS[strtolower('# Articles Column')] = '# คอลัมน์เนื้อหา';
		$TR_STRS[strtolower('Show/Hide the # of articles in the feed')] = 'แสดง/ซ่อน ตัว # ของเนื้อหาในการป้อน';
		$TR_STRS[strtolower('Link Column')] = 'คอลัมน์การเชื่อมโยง';
		$TR_STRS[strtolower('Show/Hide the Feed Link column')] = 'แสดง/ซ่อน คอลัมน์การเชื่อมโยง';
		$TR_STRS[strtolower('Show/Hide the image of the feed')] = 'แสดง/ซ่อน รูปภาพของการป้อน';
		$TR_STRS[strtolower('Show/Hide the description text of the feed')] = 'แสดง/ซ่อน คำอธิบายข้อความของการป้อน';
		$TR_STRS[strtolower('Show/Hide the description or intro text of an item')] = 'แสดง/ซ่อน คำอธิบายหรือคำขึ้นต้นข้อความของแต่ละอัน';

		//administrator/components/com_syndicate XML files
		$TR_STRS[strtolower('Syndicate')] = 'กระจายข่าวสาร';
		$TR_STRS[strtolower('This component controls the Syndication settings')] = 'คอมโพเน้นท์สำหรับควบคุมและติดตั้งของสมาคม';
		$TR_STRS[strtolower('Cache')] = 'หน่วยความจำชั่วคราว';
		$TR_STRS[strtolower('Cache the feed files')] = 'หน่วยความจำชั่วคราวของไฟล์ที่ถูกป้อน';
		$TR_STRS[strtolower('Cache Time')] = 'เวลาของหน่วยความจำชั่วคราว';
		$TR_STRS[strtolower('Cache file will refresh every x seconds')] = 'ไฟล์หน่วยความจำชั่วคราวจะทำใหม่ทุก ๆ x วินาที';
		$TR_STRS[strtolower('# Items')] = '# รายการในบัญชี';
		$TR_STRS[strtolower('Number of Items to syndicate')] = 'ตัวเลขของรายการบัญชีในสมาคม';
		$TR_STRS[strtolower('Title')] = 'ชื่อเรื่อง';
		$TR_STRS[strtolower('Syndication Title')] = 'ชื่อเรื่องสมาคม';
		$TR_STRS[strtolower('Description')] = 'คำอธิบาย';
		$TR_STRS[strtolower('Syndication Description')] = 'คำอธิบายสมาคม';
		$TR_STRS[strtolower('Image to be included in feed')] = 'รูปภาพถูกรวมเข้าในการป้อน';
		$TR_STRS[strtolower('Image Alt')] = 'ข้อความภาพ';
		$TR_STRS[strtolower('Alt text for image')] = 'ข้อความบนรูปภาพ';
		$TR_STRS[strtolower('Limit Text')] = 'จำกัดข้อความ';
		$TR_STRS[strtolower('Limit the article text to the value indicated below')] = 'จำกัดข้อความในเนื้อหาแสดงถึงค่าข้างล่าง';
		$TR_STRS[strtolower('Text Length')] = 'ความยาวของข้อความ';
		$TR_STRS[strtolower('The word length of the article text - 0 will show no text')] = 'ความยาวของคำในเนื้อหา - 0 จะไม่แสดงข้อความอีก';
		$TR_STRS[strtolower('Order')] = 'ลำดับ';
		$TR_STRS[strtolower('Order that the items will be displayed')] = 'รายการในบัญชีถูกเรียงตามลำดับในการแสดงผล';
		$TR_STRS[strtolower('Default')] = 'ค่าเริ่มต้น';
		$TR_STRS[strtolower('Frontpage Ordering')] = 'การจัดเรียงด้านหน้าเว็บ';
		$TR_STRS[strtolower('Oldest first')] = 'เก่าอยู่บนสุด';
		$TR_STRS[strtolower('Most recent first')] = 'ล่าสุดที่มีผู้ชมมาก';
		$TR_STRS[strtolower('Title Alphabetical')] = 'ชื่อเรื่องตามลำดับอักษร';
		$TR_STRS[strtolower('Title Reverse-Alphabetical')] = 'ชื่อเรื่อง ถอยหลัง-ตามลำดับตัวอักษร';
		$TR_STRS[strtolower('Author Alphabetical')] = 'ผู้แต่งตามลำดับตัวอักษร';
		$TR_STRS[strtolower('Author Reverse-Alphabetical')] = 'ผู้แต่ง ถอยหลัง-ตามลำดับตัวอักษร';
		$TR_STRS[strtolower('Most Hits')] = 'ถูกกดมากที่สุด';
		$TR_STRS[strtolower('Least Hits')] = 'ถูกกดไม่มากนัก';
		$TR_STRS[strtolower('Live Bookmarks')] = 'สมุดเยี่ยมชม';
		$TR_STRS[strtolower('Activate support for Firefox Live Bookmarks functionality')] = 'กระตุ้นให้รองรับสำหรับ Firefox โดยอัตโนมัติ';
		$TR_STRS[strtolower('Off')] = 'ปิด';
		$TR_STRS[strtolower('RSS 0.91')] = 'RSS 0.91';
		$TR_STRS[strtolower('RSS 1.0')] = 'RSS 1.0';
		$TR_STRS[strtolower('RSS 2.0')] = 'RSS 2.0';
		$TR_STRS[strtolower('ATOM 0.3')] = 'ATOM 0.3';
		$TR_STRS[strtolower('Bookmark file')] = 'ไฟล์สมุดเยี่ยมชม';
		$TR_STRS[strtolower('Special file name, if empty the default will be used.')] = 'ชื่อไฟล์แบบพิเศษ, ถ้าว่างเปล่า ค่าเริ่มต้นจะถูกใช้.';

		//administrator/components/com_weblinks/weblinks.xml
		$TR_STRS[strtolower('Hits')] = 'กด';
		$TR_STRS[strtolower('Show/Hide the Hits column')] = 'แสดง/ซ่อน จำนวนครั้งที่กดของคอลัมน์';
		$TR_STRS[strtolower('Link Descriptions')] = 'คำอธิบายของการเชื่อมโยง';
		$TR_STRS[strtolower('Show/Hide the Description text of the Links')] = 'แสดง/ซ่อน คำอธิบายข้อความของการเชื่อมโยง';
		$TR_STRS[strtolower('Icon')] = 'ไอคอน';
		$TR_STRS[strtolower('Icon to be used to the left of the url links in Table view')] = 'ไอคอนจะถูกใช้อยู่ทางด้านซ้ายของที่อยู่ของการเชื่อมต่อในแต่ละหน้าของการแสดงผล';

		//administrator/components/com_weblinks/weblinks_item.xml
		$TR_STRS[strtolower('This component shows a listing of Weblinks')] = 'คอมโพเน้นท์ สำหรับแสดงรายการของการเชื่อมโยงเว็บ';
		$TR_STRS[strtolower('Target')] = 'ที่หมาย';
		$TR_STRS[strtolower('Target window when the link is clicked')] = 'ที่หมายของหน้าต่างวินโดว์เมื่อคลิกที่การเชื่อมต่อ';
		$TR_STRS[strtolower('Parent Window With Browser Navigation')] = 'หน้าต่างเดียวกันกับโปรแกรมเบราว์เซอร์';
		$TR_STRS[strtolower('New Window With Browser Navigation')] = 'หน้าต่างใหม่กับโปรแกรมเบราว์เซอร์';
		$TR_STRS[strtolower('New Window Without Browser Navigation')] = 'หน้าต่างใหม่แยกออกจากโปรแกรมเบราว์เซอร์';

		//administrator/components/com_menus/contact_category_table/contact_category_table.xml
		$TR_STRS[strtolower('Other Categories')] = 'ประเภทอื่น ๆ';
		$TR_STRS[strtolower('When viewing a Category, Show/Hide the list of other Categories')] = 'เมื่อดูประเภท, แสดง/ซ่อน รายการอื่น ๆ';

		//administrator/components/com_menus/content_archive_category/content_archive_category.xml
		$TR_STRS[strtolower('Order by')] = 'เรียงลำดับโดย';
		$TR_STRS[strtolower('This overrides the ordering of the items.')] = 'ผ่านข้ามการเรียงลำดับของรายการในบัญชี.';

		//administrator/components/com_menus/content_blog_category/content_blog_category.xml
		$TR_STRS[strtolower('Show/Hide the Category Description')] = 'แสดง/ซ่อน คำอธบายของแต่ละประเภท';
		$TR_STRS[strtolower('Description Image')] = 'คำอธิบายรูปภาพ';
		$TR_STRS[strtolower('Show/Hide image of the Category Description')] = 'แสดง/ซ่อน คำอธบิายรูปภาพแต่ละประเภท';

		//administrator/components/com_menus/content_blog_section/content_blog_section.xml
		$TR_STRS[strtolower('Show/Hide the Section Description')] = 'แสดง/ซ่อน หมวดคำอธิบาย';
		$TR_STRS[strtolower('Show/Hide image of the Section Description')] = 'แสดง/ซ่อน คำอธิบายรูปภาพในแต่ละหมวด';

		//administrator/components/com_menus/content_category/content_category.xml
		$TR_STRS[strtolower('Table - Content Category')] = 'ตาราง - ประเภทของเนื้อหา';
		$TR_STRS[strtolower('Shows a Table view of Content items for a particular Category')] = 'แสดงมุมมองตารางของเนื้อหาสำหรับประเภทของเนื้อหาอย่างละเอียด';
		$TR_STRS[strtolower('Date Format')] = 'รูปแบบวันที่';
		$TR_STRS[strtolower('The format of the date displayed, using PHPs strftime Command Format - if left blank it will load the format from your language file')] = 'รูปแบบวันที่ที่แสดง, ใช้ PHP ใช้ PHPs สตริงค์ของเวลาที่มีรูปแบบน่าเชื่อถือ - ถ้าด้านซ้ายของมันว่างจะโหลดรูปแบบจากไฟล์ภาษา';
		$TR_STRS[strtolower('Date Column')] = 'วันที่คอลัมน์';
		$TR_STRS[strtolower('Show/Hide the Date column')] = 'แสดง/ซ่อน วันที่คอลัมน์';
		$TR_STRS[strtolower('Author Column')] = 'คอลัมน์ผู้แต่ง';
		$TR_STRS[strtolower('Show/Hide the Author column')] = 'แสดง/ซ่อน คอลัมน์ผู้แต่ง';
		$TR_STRS[strtolower('Hits Column')] = 'คอลัมน์นิยม';
		$TR_STRS[strtolower('Show/Hide the Hits column')] = 'แสดง/ซ่อน คอมลัมน์นิยม';
		$TR_STRS[strtolower('Navigation Bar')] = 'แถบนำทางไปยังที่ต่าง ๆ';
		$TR_STRS[strtolower('Show/Hide the Navigation bar')] = 'แสดง/ซ่อน แถบนำทางไปยังที่ต่าง ๆ';
		$TR_STRS[strtolower('Order Select')] = 'ลำดับการเลือก';
		$TR_STRS[strtolower('Show/Hide the Order Select dropdown')] = 'แสดง/ซ่อน ลำดับการเลือกดรอบดาวน์';
		$TR_STRS[strtolower('Display Select')] = 'การแสดงการเลือก';
		$TR_STRS[strtolower('Show/Hide the Display Select dropdown')] = 'แสดง/ซ่อน การแสดงการเลือกด้านล่าง';
		$TR_STRS[strtolower('Display Number')] = 'การแสดงตัวเลข';
		$TR_STRS[strtolower('Number of items to be displayed by default')] = 'ตัวเลขในรายการจะแสดงเป็นค่าเริ่มต้น';
		$TR_STRS[strtolower('Filter')] = 'ค้นหา';
		$TR_STRS[strtolower('Show/Hide the Filter ability')] = 'แสดง/ซ่อน ความสามารถของการค้นหา';
		$TR_STRS[strtolower('Filter Field')] = 'ขอบเขตการค้นหา';
		$TR_STRS[strtolower('Which field shall the filter apply to')] = 'ซึ่งเป็นขอบเขตของการค้นหาให้ได้ประโยชน์';
		$TR_STRS[strtolower('Author')] = 'ผู้แต่ง';
		$TR_STRS[strtolower('Show/Hide the listing of other Categories')] = 'แสดง/ซ่อน รายการของเนื้อหาประเภทอื่น';
		$TR_STRS[strtolower('Empty Categories')] = 'ประเภทเนื้อหาว่างเปล่า';
		$TR_STRS[strtolower('Show/Hide empty(no items) categories')] = 'แสดง/ซ่อน ว่างเปล่า(ไม่มีรายการ) ประเภทของเนื้อหา';
		$TR_STRS[strtolower('Show/Hide the Category Description, it will appear below the Category Name')] = 'แสดง/ซ่อน คำอธิบายประเภทของเนื้อหา, มันจะปรากฏชื่อด้านล่างประเภทของเนื้อหา';
		
		//administrator/components/com_menus/content_section/content_section.xml
		$TR_STRS[strtolower('Table - Content Section')] = 'ตาราง - หมวดเนื้อหา';
		$TR_STRS[strtolower('Creates a listing of Content categories for a particular section')] = 'สร้างรายการประเภทของเนื้อหาสำหรับหมวดอย่างละเอียด';
		$TR_STRS[strtolower('Section Title')] = 'หมวดของชื่อเรื่อง';
		$TR_STRS[strtolower('Show/hide the section title')] = 'แสดง/ซ่อน หมวดของชื่อเรื่อง';
		
		//administrator/components/com_menus/newsfeed_category_table/newsfeed_category_table.xml
		$TR_STRS[strtolower('A small image to be placed to the left or right of your menu item, images must be in /images')] = 'รูปขนาดเล็กจะถูกวางด้านซ้ายหรือขวาของเมนูแต่ละอัน, รูปภาพมักจะอยู่ใน /images';
		$TR_STRS[strtolower('Articles Column')] = 'คอลัมน์เนื้อหา';
		$TR_STRS[strtolower('Show/Hide the Articles column')] = 'แสดง/ซ่อน คอลัมน์เนื้อหา';

		//administrator/components/com_menus/wrapper/wrapper.xml
		$TR_STRS[strtolower('Width')] = 'กว้าง';
		$TR_STRS[strtolower('Height')] = 'ยาว';

		//administrator/components/com_menus all XML files' name and description
		$TR_STRS[strtolower('Link - Component Item')] = 'การเชื่อมโยง - ส่วนประกอบรายการในบัญชี';
		$TR_STRS[strtolower('Creates a link to an existing Mambo Component')] = 'สร้างการเชื่อมโยงออกจากส่วนประกอบของแมมโบ';
		$TR_STRS[strtolower('Component')] = 'ส่วนประกอบ';
		$TR_STRS[strtolower('Displays the frontend interface for a Component')] = 'หน้าแรกแสดงเป็นตัวประสานสำหรับส่วนประกอบ';
		$TR_STRS[strtolower('Table - Contact Category')] = 'ตาราง - ประเภทของผู้ติดต่อ';
		$TR_STRS[strtolower('Shows a Table view of Contact items for a particular Category')] = 'แสดงมุมมองตารางของผู้ติดต่ออย่างละเอียดในแต่ละประเภทของเนื้อหา';
		$TR_STRS[strtolower('Link - Contact Item')] = 'การเชื่อมโยง - รายการในบัญชีผู้ติดต่อ';
		$TR_STRS[strtolower('Creates a link to a Published Contact Item')] = 'สร้างการเชื่อมโยงหนึ่ง ประกาศรายการในบัญชีผู้ติดต่อ';
		$TR_STRS[strtolower('Blog - Content Category Archive')] = 'บล๊อก - ประเภทเนื้อหาเอกสารสำคัญ';
		$TR_STRS[strtolower('Shows a listing of Content items archived for a particular category')] = 'แสดงรายการของเนื้อหาเอกสารสำคัญสำหรับแบ่งแยกออกเป็นประเภทอย่างละเอียด';
		$TR_STRS[strtolower('Blog - Content Section Archive')] = 'บล๊อก - หมวดเนื้อหาสำคัญ';
		$TR_STRS[strtolower('Shows a listing of Content items archived for a particular section')] = 'แสดงรายการของเนื้อหา ให้ความสำคัญสำหรับประเภทของเนื้อหาอย่างละเอียด';
		$TR_STRS[strtolower('Blog - Content Category')] = 'บล๊อก - ประเภทเนื้อหา';
		$TR_STRS[strtolower('Displays a page of content items from multiple categories in a blog format')] = 'แสดงหน้าของเนื้อหาจากหลาย ๆ ประเภทในรูปแบบบล๊อก';
		$TR_STRS[strtolower('Blog - Content Section')] = 'บล๊อก - หมวดเนื้อหา';
		$TR_STRS[strtolower('Displays a page of content items from multiple sections in a blog format')] = 'แสดงหน้าของเนื้อหาจากหลาย ๆ หมวดในรูปแบบบล๊อก';
		$TR_STRS[strtolower('Table - Content Category')] = 'ตาราง - ประเภทเนื้อหา';
		$TR_STRS[strtolower('Shows a Table view of Content items for a particular Category')] = 'แสดงมุมมองตารางของเนื้อหาสำหรับแบ่งแยกออกเป็นประเภทอย่างละเอียด';
		$TR_STRS[strtolower('Link - Content Item')] = 'การเชื่อมโยง - เนื้อหาในรายการ';
		$TR_STRS[strtolower('Creates a link to a published Content Item in full view')] = 'สร้างการเชื่อมโยง ประกาศเนื้อหาในรายการในมุมมองเต็ม';
		$TR_STRS[strtolower('Table - Content Section')] = 'ตาราง - หมวดเนื้อหา';
		$TR_STRS[strtolower('Creates a listing of Content categories for a particular section')] = 'สร้างรายการของเนื้อหาแยกออกเป็นประเภทสำหรับหมวดอย่างละเอียด';
		$TR_STRS[strtolower('Link - Static Content')] = 'การเชื่อมโยง -  เนื้อหาสเตติก';
		$TR_STRS[strtolower('Creates a link to Static Content Item')] = 'สร้างรายการเชื่อมโยงถึงการใช้ร่วมกันของรายการในบัญชี';
		$TR_STRS[strtolower('Table - Newsfeed Category')] = 'ตาราง - ประเภทของข่าวสาร';
		$TR_STRS[strtolower('Shows a Table view of Newsfeed items for a particular Category')] = 'แสดงมุมมองตารางของข่าวสารรายการในบัญชีสำหรับประเภทอย่างละเอียด';
		$TR_STRS[strtolower('Link - Newsfeed')] = 'การเชื่อมโยง - ข่าวสารแบบป้อน';
		$TR_STRS[strtolower('Creates a link to an individual Published Newsfeed')] = 'สร้างการเชื่อมโยงถึงแต่ละอัน ประกาศข่าวสารแบบป้อน';
		$TR_STRS[strtolower('Separator / Placeholder')] = 'ตัวแยก / ตำแหน่งที่';
		$TR_STRS[strtolower('Creates a menu placeholder or separator')] = 'สร้างเมนูตำแหน่งที่ หรือ ตัวแยก';
		$TR_STRS[strtolower('Link - Url')] = 'การเชื่อมโยง - Url';
		$TR_STRS[strtolower('Creates url link')] = 'สร้าง url การเชื่อมโยง';
		$TR_STRS[strtolower('Table - Weblink Category')] = 'ตาราง - การเชื่อมโยงประเภทเว็บ';
		$TR_STRS[strtolower('Shows a Table view of Weblink items for a particular Weblink Category')] = 'แสดงมุมมองตารางของการเชื่อมโยงประเภทเว็บในรายการสำหรับประเภทการเชื่อมโยงเว็บอย่างละเอียด';
		$TR_STRS[strtolower('Wrapper')] = 'Wrapper';
		$TR_STRS[strtolower('Creates an IFrame that will wrap an external page/site into Mambo')] = 'สร้างแบบ  IFrame จะแสดงหน้าเว็บจากภายนอกไว้ในเว็บไซต์แมมโบ้';


	}


}

?>
<?php

/**
 * File install_thai.php 
 * @version $Id: install_thai.php,v 1.2 03/12/2005  by ninekrit Exp $
 * @copyright 2005  http://www.ATOMYMAXSITEhub.com 
 **/
//encoding

//-- version to install
define ('ATOMYMAXSITEVersion','2.5'); // new!
//-- Common
define ('_INSTALL_ISO','utf-8');
define ('_INSTALL_YES', "ใช่"); 
define ('_INSTALL_NO', "ไม่");
define ('_INSTALL_AVAILABLE', "สนับสนุน");
define ('_INSTALL_UNAVAILABLE', "ไม่สนับสนุน");
define ('_INSTALL_WRITABLE', "เขียนลงไฟล์ได้"); 
define ('_INSTALL_ON', "เปิด"); 
define ('_INSTALL_OFF', "ปิด"); 
define ('_INSTALL_UNWRITABLE', "เขียนลงไฟล์ไม่ได้"); 
define ('_INSTALL_NEXT', "ขั้นต่อไป >>");
define ('_INSTALL_BACK', '<< ย้อนกลับ'); // ##### new
define ('_INSTALL_WARN', 'กรุณาลบโฟล์เดอร์ install หรือเปลี่ยนชื่อเป็นอย่างอื่นก่อนใช้งานครับ');
//--Language choice
define ('_INSTALL_LANGUAGE_SECTION', "ภาษาที่ใช้ในการติดตั้ง");
define ('_INSTALL_LANGUAGE_DESCRIPTION', "โปรแกรมจะทำการค้นหาภาษา ที่คุณเลือกไว้ในเว็บบราวเซอร์ ให้เป็นภาษาหลัก ในการติดตั้ง atomymaxsite  กรุณาเลือกภาษาที่คุณต้องการ");
define ('_INSTALL_LANGUAGE_LABEL', "ภาษา");
define ('_INSTALL_LANGUAGE_CHECK','ตรวจสอบภาษาที่ใช้');
define ('_INSTALL_LANGUAGE_CHOOSE','- กรุณาเลือกภาษา -');
define ('_INSTALL_LANGUAGE_FRONT','ภาษาในส่วนของผู้ใช้');
define ('_INSTALL_LANGUAGE_BACK','ภาษาในส่วนของผู้ดูแล');
define ('_INSTALL_LANGUAGE_NOTE','[<strong>หมายเหตุ</strong>: เพิ่มเติมสำหรับชื่อภาษา :<br />f = เป็นทางการ/i = ไม่เป็นทางการ, เช่น german<strong>f</strong>, german<strong>i</strong>]');

//-- Index.php
	//--Left menu
define ('_INSTALL_LICENSE_ALERT', "กรุณาอ่านและทำความเข้าใจกับลิขสิทธิ์ก่อนการติดตั้งครับ");  
define ('_ATOMYMAXSITE_WEB_INSTALLER',"ระบบการติดตั้งatomymaxsite ::");  //  Add Title  by Ak.
define ('_INSTALL_ATOMYMAXSITE', "การติดตั้ง ATOMYMAXSITE"); 
define ('_INSTALL_STEP_PRECHECK', "ตรวจสอบระบบก่อนการติดตั้ง");
define ('_INSTALL_STEP_LICENSE', "ลิขสิทธิ์");
define ('_INSTALL_STEP_1', "ขั้นที่ ๑");
define ('_INSTALL_STEP_2', "ขั้นที่ ๒");
define ('_INSTALL_STEP_3', "ขั้นที่ ๓");
define ('_INSTALL_STEP_4', "ขั้นที่ ๔");
	//--Pre-check zone
define ('_INSTALL_PRECHECK_TITLE', "ตรวจสอบก่อนการติดตั้ง");
define ('_INSTALL_PRECHECK_SECTION', "ตรวจสอบก่อนการติดตั้งสำหรับ ");
define ('_INSTALL_PRECHECK_DESCRIPTION', "หากมีหัวข้อใดถูกไฮไลท์ด้วยสีแดง กรุณาทำการแก้ไขข้อผิดพลาด ก่อนทำการติดตั้งครับ <br />
			หากไม่ทำการแก้ไขอาจทำให้ การติดตั้ง ATOMYMAXSITE มีปัญหาในภายหลัง หรือทำงานไม่ถูกต้อง.");
define ('_INSTALL_PHP_VERSION', "PHP เวอร์ชัน >= 4.1.0");
define ('_INSTALL_PHP_ZLIB', "&nbsp; -  สนับสนุน  zlib compression ");
define ('_INSTALL_PHP_XML', "&nbsp; -  สนับสนุน XML ");
define ('_INSTALL_PHP_MYSQL', "&nbsp; -  สนับสนุน MySQL ");
define ('_INSTALL_CONFIG_FILE','&nbsp;- ไฟล์ <strong>ATOMYMAXSITE</strong> Configuration');
define ('_INSTALL_PHP_CONF', "คุณสามารถดำเนินการ ติดตั้งต่อไปได้ครับ เมื่อเสร็จสิ้นกระบวนการ ระบบจะแสดงผลค่าตัวแปรต่าง ๆ ที่ควรตั้งค่า ให้คุณเพียง copy แล้วนำไปวางไว้ใน text editor  ทำการบันทึก จากนั้นก็อัพโหลดขึ้นเซิร์ฟเวอร์");
define ('_INSTALL_SESSION', "Session save path");
define ('_INSTALL_SESSION_NOT_SET','ไม่มีกำหนดไว้');

	//--recommanded
define ('_INSTALL_PHP_SETTINGS_TITLE', "ค่าแนะนำในการติดตั้ง:");
define ('_INSTALL_PHP_SETTINGS_DESCRIPTION', "ค่าต่อไปนี้เป็นค่าแนะนำสำหรับ PHP เพื่อให้ ATOMYMAXSITE ทำงานได้ถูกต้อง<br />
		อย่างไรก็ตามถึงแม้ว่าค่าที่ท่าน ทำการติดตั้งไว้ในเซิร์ฟเวอร์ ของท่านอาจไม่ตรงตามนี้ทุกประการ  ATOMYMAXSITE  ก็อาจจะยังทำงานได้ครับ");
define ('_INSTALL_PHP_FONCTION', "ฟังก์ชัน");
define ('_INSTALL_PHP_FONCTION_IDEAL', "ค่าแนะนำ");
define ('_INSTALL_PHP_FONCTION_ACTUAL', "ปัจจุบัน");		
define ('_INSTALL_PHP_MODE', "Safe Mode:");
define ('_INSTALL_PHP_ERRORS', "Display Errors:");
define ('_INSTALL_PHP_UPLOAD', "File Uploads:");
define ('_INSTALL_PHP_QUOTES_GPC', "Magic Quotes GPC:");
define ('_INSTALL_PHP_QUOTES_RUNTIME', "Magic Quotes Runtime:");
define ('_INSTALL_PHP_GLOBALS', "Register Globals:");
define ('_INSTALL_PHP_OUTBUFFER', "Output Buffering:");
define ('_INSTALL_PHP_AUTOSTART_SESSION', "Session auto start:"); 
	//--file permission
define ('_INSTALL_DIRFILE_PERMS', "สิทธิ์การอนุญาต (Permission) ของไดเรกทอรีและไฟล์:");
define ('_INSTALL_DIRFILE_PERMS_INFO', " ท่านต้องตั้งค่าไดเร็กทอรี หรือไฟล์ให้สามารถเขียนทับไฟล์ได้ เมื่อใดก็ตามที่เห็นคำว่า \"เขียนลงไฟล์ไม่ได้\" ให้ท่านทำการแก้สิทธิ์ ของไฟล์หรือไดเร็กทอรีดังกล่าว");

	//-- additional settings (new by mic)
define ('_INSTALL_ADD_SETTINGS','Additional system informations');
define ('_INSTALL_ADD_SETTINGS_DESC','Following additional settings were checked und could be a problem if marked in red or lesser then standard. For exampleis the setting "short_open_tag" is "OFF", this can be the reason for errors in your scripts. In a case like that get in contact with the developer and force a correct scripting.');
define ('_INSTALL_MESS_OLDPHP1','Because of an outdated installed version of PHP [ %s ] the installer could not check the serversetting for possible languages. ATOMYMAXSITE will be installed in the languages definded above. Maybe your locale language setting in the backend is not set correct!'); // %s=phpversion #################
define ('_INSTALL_MESS_OLDPHP2','PLease check after installation process your language country code setting in the backend, maybe you have to ask your provider for the correct setting.<br /><br />Further tell your provider that the installed PHP version is an outdated one and does not fit with the security guidelines of PHP! [see more about here <a href="http://php.net">PHP.net</a> ]');#############

	//-- Copyright
define ('_MIRO_COPYRIGHT', "สงวนลิขสิทธิ์  c 2005  <a href='http://www.ATOMYMAXSITE-foundation.org'>ATOMYMAXSITE Foundation Inc.</a><br />");
define ('_MIRO_GNUGPL', " เป็นซอฟท์แวร์เสรีภายใต้ลิขสิทธิ์ GNU/GPL พัฒนาภาษาไทย <a href='http://www.ATOMYMAXSITEhub.com'>ATOMYMAXSITEHub.com</a>");	


//--Install.php
define ('_INSTALL_LICENSE_TITLE', "ลิขสิทธิ์");
define ('_INSTALL_LICENSE_TYPE', "ลิขสิทธิ์ GNU/GPL :");
define ('_INSTALL_LICENSE_CONDITION', "*** เช็คที่กล่องสี่เหลี่ยมหากต้องการติดตั้ง ATOMYMAXSITE ภายใต้ลิขสิทธิ์นี้ ***"); 
define ('_INSTALL_LICENSE_AGREE', "ข้าพเจ้าตกลงตามเงื่อนไขในลิขสิทธิ์  GPL ");
define ('_INSTALL_CHECK_LANG1','ท่านยังไม่ได้เลือกภาษา');
define ('_INSTALL_CHECK_LANG2','ท่านจะต้องเลือกภาษาสำหรับผู้ใช้และภาษาสำหรับผู้ดูแลระบบ');


//--Install1.php
define ('_INSTALL_DB_JS_HOSTNAME', "กรุณาใส่ชื่อโฮสต์ (เช่น Localhost)");
define ('_INSTALL_DB_JS_USERNAME', "กรุณาใส่ชื่อผู้ใช้ฐานข้อมูล ( เช่น root  )");
define ('_INSTALL_DB_JS_BASENAME', "กรุณาใส่ชื่อฐานข้อมูล ( เช่น ATOMYMAXSITE )");
define ('_INSTALL_DB_JS_PASSWORD', 'กรุณาใส่รหัสผ่านสำหรับใช้งานฐานข้อมูล');
define ('_INSTALL_DB_JS_WARNING', "กรุณาตรวจสอบให้แน่ใจว่าค่าดังกล่าวถูกต้อง \n ATOMYMAXSITE จะทำการสร้างฐานข้อมูลด้วยค่าที่ท่านระบุไว้นี้");
define ('_INSTALL_DB_SECTION', "การตั้งค่าฐานข้อมูล MySQL :");
define ('_INSTALL_DB_STEPS_DESCRIPTION', "<p>การติดตั้ง ATOMYMAXSITE สามารถทำได้ง่าย ๆ ใน 4 ขั้นตอน...</p>
  	   <p>กรุณาใส่ชื่อโฮสต์ที่ต้องการติดตั้ง  atomymaxsite ทั่วไปแล้วค่านี้จะเป็น  'localhost'.</p>
   		<p>ใส่ชื่อผู้ใช้ ฐานข้อมุล</p>
		<p>ใส่รหัสผ่านของฐานข้อมูล MySQL ที่คุณต้องการใช้กับ atomymaxsite</p>
		<p>ใส่รหัสผ่านอีกครั้ง</p>
		<p>ให้ระบุชื่อฐานข้อมูลที่จะใช้กับ atomymaxsite </p>");
define ('_INSTALL_DB_NAME', "ใส่ชื่อฐานข้อมูลด้วยครับ");
define ('_INSTALL_DB_HOSTNAME', "ชื่อโฮสต์");
define ('_INSTALL_DB_HOSTNAME_DESCRIPTION', "ค่าทั่วไปคือ 'localhost'");
define ('_INSTALL_DB_USERNAME', "ชื่อผู้ใช้ฐานข้อมูล MySQL ");
define ('_INSTALL_DB_USERNAME_DESC', "ชื่อผู้ใช้งานดาต้าเบส อาจจะใส่เป็น 'root' หรือชื่อผู้ใช้ที่ได้รับ จากผู้ให้บริการโฮสของท่าน");
define ('_INSTALL_DB_PASSWORD', "รหัสผ่านฐานข้อมูล MySQL ");
define ('_INSTALL_DB_PASSWORD_DESCRIPTION', "<strong>เพื่อความปลอดภัย กรุณากำหนดรหัสผ่าน</strong>");
define ('_INSTALL_DB_PASSWORD_VERRIFY',"ยืนยันรหัสผ่าน MySQL อีกครั้ง");
define ('_INSTALL_DB_PASSWORD_VERRIFY_DESC', "ใส่รหัสผ่านอีกครั้งเพื่อเป็นการยืนยัน");
define ('_INSTALL_DB_BASENAME', "ชื่อฐานข้อมูล MySQL ");
define ('_INSTALL_DB_BASENAME_DESC','โฮสบางแห่งมีเพียงดาเบสเดียวให้ท่านใช้งาน กรณีนี้ท่านสามารถใช้ชื่อนำหน้า (prefix) ตารางเพื่อติดตั้งมากกว่าหนึ่งไซต์');
define ('_INSTALL_DB_PREFIX', "คำอุปสรรค(Prefix)หน้าชื่อตาราง ");
define ('_INSTALL_DB_PREFIX_DESC', "ห้ามใช้ชื่อนำหน้าเป็น 'old_' เนื่องจาก atomymaxsite  จะใช้ค่านี้ในการสร้างตารางสำรอง");
define ('_INSTALL_DB_DROPTABLES', "ต้องการลบตารางที่มีอยู่หรือไม่ ?");
define ('_INSTALL_DB_BACKUP', "ต้องการสำรองข้อมูลตารางหรือไม่?");
define ('_INSTALL_DB_BACKUP_DESCRIPTION', "(ตารางฐานข้อมูลและข้อมูลเดิมในฐานข้อมูลที่ระบุจะถูกลบทิ้ง)");
define ('_INSTALL_DB_SAMPLE_DATA', "ต้องการติดตั้งข้อมูลตัวอย่างหรือไม่?");
define ('_INSTALL_DB_SAMPLE_DATA_DESC',"กรุณาคลิกเลือกไว้หากท่าน ยังไม่มีความชำนาญในการใช้งาน");
 
 
//--Install2.php
define ('_INSTALL_DB_ERROR1', "รายละเอียดของฐานข้อมูลที่กรอกไม่ถูกต้องหรือว่างไว้ครับ");
define ('_INSTALL_DB_ERROR2', "ชื่อผู้ใช้และรหัสผ่านที่กรอกไม่ถูกต้องครับ");
define ('_INSTALL_DB_ERROR3', "ไม่ได้ใส่ชื่อฐานข้อมูลครับ");
define ('_INSTALL_DB_ERROR4', "ฐานข้อมูลมีข้อผิดพลาดครับ");
define ('_INSTALL_DB_ERROR5', "กรุณาใส่ชื่อเว็บไซต์ด้วยครับ");
define ('_INSTALL_DB_ERROR6', "ท่านใส่รหัสผ่านสองครั้งไม่ตรงกัน กรุณาใส่ใหม่");
define ('_INSTALL_DB_SITENAME', "กรุณาใส่ชื่อเว็บไซต์ของท่าน:");
define ('_INSTALL_DB_DATAERROR', "มีข้อผิดพลาดในการแทรกข้อมูลลงในฐานข้อมูล!<br /> ไม่สามารถทำการติดตั้งต่อได้");
define ('_INSTALL_DB_INSTALLSUCCESS', "สำเร็จแล้วครับ!<br /><br />
  			พิมพ์ชื่อเว็บไซต์ของท่านที่นี่  ระบบจะใช้ชื่อนี้ในการส่งอีเมล ");		
define ('_INSTALL_DB_LOGERROR', "<br /><br />บันทึกข้อผิดพลาด:<br />\n");
define ('_INSTALL_DB_SITENAME_LABEL', "ชื่อเว็บไซต์");
define ('_INSTALL_SITE_NAME_DESCRIPTION', "เช่น  เว็บไซต์การเรียนการสอนวิชาภาษาไทย");
define ('_INSTALL_DB_FOOTER1_LABEL', "Footer1");
define ('_INSTALL_DB_FOOTER2_LABEL', "Footer2");
define ('_INSTALL_DB_TEMPLATE_LABEL', "templates");
define ('_INSTALL_SITE_FOOTER1_DESCRIPTION', "ข้อความบรรยายใต้เวปไซต์ บรรทัดที่1");
define ('_INSTALL_SITE_FOOTER2_DESCRIPTION', "ข้อความบรรยายใต้เวปไซต์ บรรทัดที่2");
define ('_INSTALL_SITE_TEMPLATE_DESCRIPTION', "เลือก template");
//--Install3.php
define ('_INSTALL_SITE_NONAME', "ไม่ได้ใส่ชื่อเว็บไซต์");
define ('_INSTALL_JS_SITENAME', "กรุณาใส่ชื่อ URL");
define ('_INSTALL_JS_PATH', "กรุณาใส่  absolute path ของเว็บไซต์");
define ('_INSTALL_JS_EMAIL', "กรุณาใส่ที่อยู่อีเมลในการติดต่อกับผู้ดูแลระบบ");
define ('_INSTALL_JS_PASSWORD', "กรุณาใส่รหัสผ่านสำหรับผู้ดูแลระบบ");
define ('_INSTALL_SITE_SECTION', "ยืนยันที่อยู่  URL, absolute path และอีเมลของผู้ดูแลระบบ");
define ('_INSTALL_SITE_DESCRIPTION', "<p>ไม่ต้องเปลี่ยนค่าใด ๆ ถ้าหากที่อยู่ URL และ Path ถูกต้องแล้ว ถ้าหากไม่มั่นใจ ให้ติดต่อผู้ให้บริการอินเทอร์เน็ท หรือผู้ดูแลระบบของท่าน 
    	         โดยทั่วไปแล้วค่าที่แสดงอยู่นี้เป็นค่าที่ถูกต้องแล้วและน่าจะทำงานกับเว็บไซต์ของท่านได้    	       <br />
    	          <br />
    	          ใส่อีเมลที่ต้องการใช้สำหรับเว็บไซต์ของท่าน ทั่วไปแล้วคืออีเมลของผู้ดูแลระบบ<br />");
define ('_INSTALL_SUPERADMIN_EMAIL', "อีเมล");
define ('_INSTALL_SUPERADMIN_PASSWORD', "รหัสผ่านของผู้ดูแลระบบ");
define ('_INSTALL_SITE_PATH', "Path");
define ('_INSTALL_SITE_URL', "URL");
define ('_INSTALL_ADMIN_PW','[แนะนำให้ท่านเปลี่ยนรหัสผ่าน เป็นรหัสผ่านที่ท่านต้องการ]');

// neu 2.0 ++++++++++++++++++++++++++++++++++++++
define ('_INSTALL_FILE_PERMISSIONS','File Permissions');
define ('_INSTALL_DONT_CHM_FILES','Don\'t CHMOD files (use server defaults)');
define ('_INSTALL_CHMOD_FILES_TO','CHMOD files to:');
define ('_INSTALL_CHMOD_USER','User:');
define ('_INSTALL_CHMOD_GROUP','Group:');
define ('_INSTALL_CHMOD_WORLD','World:');
define ('_INSTALL_CHMOD_READ','Read');
define ('_INSTALL_CHMOD_WRITE','Write');
define ('_INSTALL_CHMODE_EXECUTE','Execute');

define ('_INSTALL_DIR_PERMISSIONS','Directory Permissions');
define ('_INSTALL_CHMOD_DIR_TO','CHMOD directories to:');
define ('_INSTALL_CHMOD_SEARCH','Search');
define ('_INSTALL_CHMOD_FILES_FAIL','<u>Information</u>: File permissions could <strong>not</strong> be set!<br />Please change manually with FTP and CHMOD 0644 to following files:<br />');
// ende neu 2.0 ++++++++++++++++++++++++++++++++++

//--Install4.php
define ('_INSTALL_JS_CHECKEMAIL', "กรุณาใส่อีเมลที่ถูกต้องด้วยครับ");
define ('_INSTALL_JS_CHECKDB', "รายละเอียดของฐานข้อมูลไม่ถูกต้องหรือว่างไว้");
define ('_INSTALL_JS_CHECKSITENAME', "ไม่ได้ใส่ชื่อเว็บไซต์");
define ('_INSTALL_CONF_LANGUAGE', "'thai'");
define ('_INSTALL_CONF_SITE_MAINTAIN', "'เว็บไซต์กำลังอยู่ในช่วงอัพเดทครับ<br /> กรุณากลับมาใหม่ครับ'");
define ('_INSTALL_CONF_SITE_UNAVAILABLE', "'ไม่สามารถเข้าเว็บนี้ได้ครับ<br />กรุณาแจ้งผู้ดูแลระบบ'");
define ('_INSTALL_CONF_METADESC', "'ATOMYMAXSITE - ระบบการจัดการเนื้อหา'");
define ('_INSTALL_CONF_METAKEYS', "'ATOMYMAXSITE, ATOMYMAXSITE'");
define ('_INSTALL_CONF_LANGUAGE_REF', "th_TH");
define ('_INSTALL_CONF_LANGUAGE_AREF', 'thai'); // admin language (new by mic)
define ('_INSTALL_CHMOD_DIR', "เปลี่ยนแปลงสิทธิ์การใช้ไดเรกทอรีเรียบร้อยแล้ว");
define ('_INSTALL_CHMOD_DIR_FAIL', "ไม่สามารถเปลี่ยนสิทธิการใช้ไดเรกทอรีได้  กรุณาเปลี่ยนสิทธิของไดเรกทอรีต่อไปนี้เป็น 777:<br />");
define ('_INSTALL_JS_CHECKURL', "ไม่ได้ใส่ชื่อเว็บไซต์");
define ('_INSTALL_CONGRATULATION', "ขอแสดงความยินดีด้วยครับ !  การติดตั้อง ATOMYMAXSITE สำเร็จแล้ว");
define ('_INSTALL_DESCRIPTION', "<p>คลิกที่ปุ่ม \"ดูเว็บไซต์\" เพื่อเข้าไปยังเว็บ ATOMYMAXSITE  ของท่าน หรือคลิกที่ \"ผู้ดูแลระบบ\" เพื่อเข้าไปยังหน้าล็อกอินเข้าจัดการระบบ</p>");
define ('_INSTALL_POST_ACTION', "เมื่อทำการติดตั้งเรียบร้อยแล้วให้ท่านลบแฟ้ม INSTALLATION ออกจากเซิร์ฟเวอร์ด้วยครับ");
define ('_INSTALL_POST_ACTION1', 'SECURITY NOTE: ไดเร็กทอรี่ Installation ได้ถูกเปลี่ยนชื่อเป็น "###installtion"  .<br /><br />หากท่านไม่ต้องใช้อีกต่อไป กรุณาลบ ออกจากโฮสโดยเร็วที่สุด'); // ######################################## new
define ('_INSTALL_LOGIN', "รายละเอียดการเข้าสู่ระบบของผู้ดูแลระบบ");
define ('_INSTALL_ADMIN_USERNAME', "ชื่อผู้ใช้ : admin");
define ('_INSTALL_ADMIN_PASSWORD', "รหัสผ่าน : ");
define ('_INSTALL_ACTION', "คลิกที่ปุ่ม\"ดูเว็บไซต์\" เพื่อเข้าไปยังเว็บไซต์ ATOMYMAXSITE ของท่านหรือปุ่ม \"ผู้ดูแลระบบ\" เพื่อเข้าไปยังหน้าล็อกอินเข้าจัดการระบบ");
define ('_INSTALL_VIEWSITE', "ดูเว็บไซต์");
define ('_INSTALL_LOGINADMIN', "ผู้ดูแลระบบ");
define ('_INSTALL_ALERT', "ไม่สามารถเขียนไฟล์ configuration ได้ หรือมีปัญหาในการสร้างไฟล์ดังกล่าว
        ให้ท่านทำการก้อปปี้โค้ดข้างล่างนี้ไว้ใน txt editor จากนั้นให้บันทึกและอัพโหลดขึ้นเซิร์ฟเวอร์ คลิกที่ textarea เพื่อทำการไฮไลท์โค้ดทั้งหมด");
// mail
define ('_INSTALL_MAIL_SUBJECT','Notification of Installation of ATOMYMAXSITE ' . ATOMYMAXSITEVersion);
define ('_INSTALL_MAIL_MSG1','Hello Admin');
define ('_INSTALL_MAIL_MSG2','below you will find the settings defined during the installation process of ATOMYMAXSITE ' . ATOMYMAXSITEVersion . ' from this site:');
define ('_INSTALL_MAIL_MSG3','Website name : ');
define ('_INSTALL_MAIL_MSG4','Website link : ');
define ('_INSTALL_MAIL_MSG5','Time of installation ........... : ');
define ('_INSTALL_MAIL_MSG6','Installation was performed by IP : ');
define ('_INSTALL_MAIL_SQL_GEN','SQL-Settings');
define ('_INSTALL_MAIL_SQL_HOST','Host ....... : ');
define ('_INSTALL_MAIL_SQL_USER','Username ... : ');
define ('_INSTALL_MAIL_SQL_PW','Password ... : ');
define ('_INSTALL_MAIL_SQL_DB','Database ... : ');
define ('_INSTALL_MAIL_SQL_PREFIX','DB-Prefix .. : ');
define ('_INSTALL_MAIL_PATH_GEN','Path');
define ('_INSTALL_MAIL_PATH_ABS','Absolut : ');
define ('_INSTALL_MAIL_PATH_REL','Relativ : ');
define ('_INSTALL_MAIL_LANG_GEN','ค่ากำหนดภาษา');
define ('_INSTALL_MAIL_LANG_FRONT','ภาษาในส่วนของผู้ใช้ (Frontend) : ');
define ('_INSTALL_MAIL_LANG_BACK','ภาษาในส่วนของผู้ดูแล (Backend) : ');
define ('_INSTALL_MAIL_SAMPLEDB','ติดตั้งตัวอย่างข้อมูลเรียบร้อย');
define ('_INSTALL_MAIL_NO_SAMPLEDB','ไม่มีการติดตั้งตัวอย่างข้อมูล');
define ('_INSTALL_MAIL_CHMOD_FAIL','Information: for following directories <CHMOD> could not be executed! Please change  the rights to <0755> for:
/attach
/backup
/data
/icon
/images/personnel
/images/random
/images/config
/images/icon
/images/gallery
/modules/aboutus
/modules/couter
/modules/editortalk
/modules/block/banner.xml
/modules/rss/news.xml
/modules/smiletag/data
/templates
/UserFiles
/install
/webboard_upload

Following files to 0644:
includes/config.in.php
download.dat
research.dat');
define ('_INSTALL_MAIL_DEL_INSTALLDIR','Attention: for your own security, please delete the installation directory, inclusive all files and directories within!!');
define ('_INSTALL_MAIL_DEL_INSTALLDIR_RENAME','Attantion: the directory "installation" was renamed to  " %s "! If you don\'t need at anymore, delete it as soon as possible!'); // +++++ new
define ('_INSTALL_MAIL_SENT','An email with the most important settings was sent to "<strong>%s</strong>".');

// new 2.0 ++++++++++++++++++++++++++++++++
define ('_INSTALL_MESS_DIRSAND_FILES_UNCHANGED','Directory and file permissions left unchanged.');
// end new 2.0 +++++++++++++++++++++++++++

// languages
	// general
define ('_INSTALL_LANGUAGE_SERVER','ภาษาที่ให้บริการบนเซิร์ฟเวอร์นี้');
define ('_INSTALL_LANGUAGE_DESC','Following settings will give you an overview of possible language settings, please write down you could use this later within ATOMYMAXSITE.<br />Correct display of date depends on your browser settings!');
define ('_INSTALL_LANGUAGE_SETTING','ค่ากำหนด');
define ('_INSTALL_LANGUAGE_DATE','การแสดงผลวันที่');
define ('_INSTALL_LANGUAGE_INSTALL','Following language code will be installed:');

	// local settings
	// please define in alphabetical order !
define ('_INSTALL_LNG_AR','Arabian');
define ('_INSTALL_LNG_BG','Bulgarian');
define ('_INSTALL_LNG_CN','Chinese');
define ('_INSTALL_LNG_CS','Czech');
define ('_INSTALL_LNG_DA','Danish');
define ('_INSTALL_LNG_DE','German');
define ('_INSTALL_LNG_EN','English');
define ('_INSTALL_LNG_ES','Spanish');
define ('_INSTALL_LNG_FI','Finnish');
define ('_INSTALL_LNG_FR','French');
define ('_INSTALL_LNG_HU','Hungarian');
define ('_INSTALL_LNG_IT','Italian');
define ('_INSTALL_LNG_LT','Lithuanian');
define ('_INSTALL_LNG_NL','Dutch');
define ('_INSTALL_LNG_PL','Polish');
define ('_INSTALL_LNG_PT','Portuguese');
define ('_INSTALL_LNG_SV','Swedish');
define ('_INSTALL_LNG_TH','ไทย');
define ('_INSTALL_LNG_RU','Russian');


define ('_INSTALL_FOOTER_CREDIT',"พัฒนาโดย นายชัดสกร  พิกุลทอง <a href='http://maxtom.sytes.net' target='_blank'>  atomy</a> โทร 0899469997 เมล์ <a href='mailto:vt9vm@hotmail.com' target='_blank'>  vt9vm@hotmail.com  </a></br><a href='http://maxtom.sytes.net' target='_blank'>"._SCRIPT." "._VERSION."</a> เป็นซอฟท์แวร์ที่พัฒนาต่อจาก maxsite 1.10 ของคุณ อัษฎา อินต๊ะ จากเวป <a href='http://www.mocyc.com'>http://www.mocyc.com</a>");

define ('_INSTALL_CAPCHA_TITLE','การใช้งาน Capcha');
define ('_INSTALL_CAPCHA_ADD','เลือกใช้งาน Capcha :');
define ('_INSTALL_CAPCHA_TURE','ใช้งาน');
define ('_INSTALL_CAPCHA_FALSE','ไม่ใช้งาน');
define ('_INSTALL_CAPCHA_TYPE','ชนิด Capcha :');
define ('_INSTALL_CAPCHA_NOMAL','แบบตัวอักษรปกติ');
define ('_INSTALL_CAPCHA_SPE','แบบกำหนดตัวอักษร');
define ('_INSTALL_CAPCHA_NUM','จำนวนตัวอักษร :');
?>
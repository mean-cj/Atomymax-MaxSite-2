<?php
######################################################################
# WorkBoard 1.2.0
######################################################################
#
# Copyright (c) 2003 by Burnwave and Nukescripts Network
# http://www.burnwave.com/, http://www.nukescripts.net/
#
######################################################################

#############################################
# CORE SYSTEM
# DIR: admin/modules/workboard/
#############################################
######################################################################
# Global Admin Definitions
######################################################################
define("_WORKBOARD_ADMIN_EDIT","แก้ไข");
define("_WORKBOARD_ADMIN_DELETE","ลบ");
define("_WORKBOARD_ADMIN_YES","ใช่");
define("_WORKBOARD_ADMIN_NO","ไม่");
define("_WORKBOARD_ADMIN_FUNCTIONS","การทำงาน");
define("_WORKBOARD_ADMIN_UPDATE","บันทึก");
define("_WORKBOARD_ADMIN_ACTIVATE","ทำงาน");
define("_WORKBOARD_ADMIN_DEACTIVATE","ไม่ทำงาน");

######################################################################
# From file: members.php
######################################################################
define("_WORKBOARD_ADMIN_MEMBERS_MEMBERLIST","รายนามสมาชิก");
define("_WORKBOARD_ADMIN_MEMBERS_MEMBEROPTIONS","ข้อกำหนดสำหรับสมาชิก / สถิติ");
define("_WORKBOARD_ADMIN_MEMBERS_MEMBERADD","เพิ่มสมาชิก");
define("_WORKBOARD_ADMIN_MEMBERS_TOTALMEMBERS","สมาชิก");
define("_WORKBOARD_ADMIN_MEMBERS_MEMBERNAME","ชื่อของสมาชิก");
define("_WORKBOARD_ADMIN_MEMBERS_MEMBEREMAIL","อีเมล์ของสมาชิก");
define("_WORKBOARD_ADMIN_MEMBERS_NOMEMBERS","ยังไม่มีสมาชิกในฐานข้อมูล");
define("_WORKBOARD_ADMIN_MEMBERS_EDITMEMBER","แก้ไขสถานะ");
define("_WORKBOARD_ADMIN_MEMBERS_UPDATEMEMBER","ปรับปรุงสมาชิก");
define("_WORKBOARD_ADMIN_MEMBERS_DELETESTATUS","ลบสมาชิก");
define("_WORKBOARD_ADMIN_MEMBERS_SWAPMEMBER","เพื่อที่จะลบสมาชิกท่านนี้ กรุณาเข้าไปเปลี่ยนผู้รับผิดชอบในงานที่เกี่ยวข้อง");

######################################################################
# From file: index.php
######################################################################
define("_WORKBOARD_ADMIN_INDEX_PROJECTS","โครงการ");
define("_WORKBOARD_ADMIN_INDEX_PROJECTSDESC","จัดการโครงการ");
define("_WORKBOARD_ADMIN_INDEX_TASKS","งาน");
define("_WORKBOARD_ADMIN_INDEX_TASKSDESC","จัดการงานในโครงการ");
define("_WORKBOARD_ADMIN_INDEX_MEMBERS","สมาชิก");
define("_WORKBOARD_ADMIN_INDEX_MEMBERSDESC","จัดการสมาชิก");
define("_WORKBOARD_ADMIN_INDEX_PRIORITIES","ความสำคัญ");
define("_WORKBOARD_ADMIN_INDEX_PRIORITIESDESC","จัดการความสำคัญของงาน");
define("_WORKBOARD_ADMIN_INDEX_STATUSES","สถานะ");
define("_WORKBOARD_ADMIN_INDEX_STATUSESDESC","จัดการสถานะของงาน");
define("_WORKBOARD_ADMIN_INDEX_POSITIONS","ตำแหน่ง");
define("_WORKBOARD_ADMIN_INDEX_POSITIONSDESC","จัดการตำแหน่งในโครงการ");
define("_WORKBOARD_ADMIN_INDEX_COPYRIGHT","ฉ 2003-2004 <B>WorkBoard</B> || <a href=\"http://www.burnwave.com\"><b>Burnwave, Ltd.</b></a>, <a href=\"http://www.nukescripts.net\"><b>NukeScripts Network</b></a>, <a href=\"http://www.thainuke.net\"><b>Thai</b>Nuke</a>");

######################################################################
# From file: positions.php
######################################################################
define("_WORKBOARD_ADMIN_POSITION_POSITIONLIST","รายการตำแหน่ง");
define("_WORKBOARD_ADMIN_POSITION_POSITIONOPTIONS","ข้อกำหนดสำหรับตำแหน่งในโครงการ");
define("_WORKBOARD_ADMIN_POSITION_POSITIONADD","เพิ่มตำแหน่ง");
define("_WORKBOARD_ADMIN_POSITION_POSITIONNAME","ชื่อตำแหน่ง");
define("_WORKBOARD_ADMIN_POSITION_POSITIONDESCRIPTION","รายละเอียดของตำแหน่ง");
define("_WORKBOARD_ADMIN_POSITION_NOPOSITIONS","ยังไม่มีตำแหน่งในฐานข้อมูล");
define("_WORKBOARD_ADMIN_POSITION_EDITPOSITION","แก้ไขตำแหน่ง");
define("_WORKBOARD_ADMIN_POSITION_UPDATEPOSITION","ปรับปรุงตำแหน่ง");
define("_WORKBOARD_ADMIN_POSITION_DELETEPOSITION","ลบตำแหน่ง");
define("_WORKBOARD_ADMIN_POSITION_TOTALPOSITIONS","ตำแหน่งทั้งหมด");
define("_WORKBOARD_ADMIN_POSITION_SWAPPOSITION","เพื่อที่จะลบตำแหน่งนี้  กรุณาเข้าไปเปลี่ยนผู้รับผิดชอบในงานที่เกี่ยวข้อง");

######################################################################
# From file: priority.php
######################################################################
define("_WORKBOARD_ADMIN_PRIORITY_PRIORITYLIST","รายการความสำคัญ");
define("_WORKBOARD_ADMIN_PRIORITY_PRIORITYOPTIONS","ข้อกำหนดสำหรับความสำคัญ");
define("_WORKBOARD_ADMIN_PRIORITY_PRIORITYADD","เพิ่มความสำคัญ");
define("_WORKBOARD_ADMIN_PRIORITY_PRIORITYNAME","ชื่อความสำคัญ");
define("_WORKBOARD_ADMIN_PRIORITY_PRIORITYWEIGHT","ระดับความสำคัญ");
define("_WORKBOARD_ADMIN_PRIORITY_NOPRIORITY","ยังไม่มีความสำคัญในฐานข้อมูล");
define("_WORKBOARD_ADMIN_PRIORITY_EDITPRIORITY","แก้ไขความสำคัญ");
define("_WORKBOARD_ADMIN_PRIORITY_UPDATEPRIORITY","ปรับปรุงความสำคัญ");
define("_WORKBOARD_ADMIN_PRIORITY_DELETEPRIORITY","ลบความสำคัญ");
define("_WORKBOARD_ADMIN_PRIORITY_TOTALPRIORITIES","ความสำคัญทั้งหมด");
define("_WORKBOARD_ADMIN_PRIORITY_WEIGHT","ระดับ");
define("_WORKBOARD_ADMIN_PRIORITY_SWAPPRIORITY","เพื่อที่จะลบความสำคัญนี้  กรุณาเข้าไปเปลี่ยนในงานที่เกี่ยวข้อง");

######################################################################
# From file: projects.php
######################################################################
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTLIST","รายการโครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTOPTIONS","ข้อกำหนดสำหรับโครงการ / สถิติ");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTADD","เพิ่มโครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_TASKS","งาน");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTNAME","ชื่อโครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTDESCRIPTION","รายละเอียดของโครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_NOPROJECTS","ยังไม่มีโครงการในฐานข้อมูล");
define("_WORKBOARD_ADMIN_PROJECTS_EDITPROJECT","แก้ไขโครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_UPDATEPROJECT","ปรับปรุงโครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_DELETEPROJECT","ลบโครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_CONFIRMDELETE","การลบโครงการ จะลบงานทั้งหมดที่เกี่ยวข้องด้วย");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTTASKLIST","รายการงานในโครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECT","โครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTS","โครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTTASKS","งานในโครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_ADDTASK","เพิ่มงาน");
define("_WORKBOARD_ADMIN_PROJECTS_TASKSTATUS","สถานะ");
define("_WORKBOARD_ADMIN_PROJECTS_TOTALPROJECTS","โครงการทั้งหมด");
define("_WORKBOARD_ADMIN_PROJECTS_TOTALTASKS","งานทั้งหมด");
define("_WORKBOARD_ADMIN_PROJECTS_PROJECTMEMBERS","สมาชิกในโครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_NOTASKS","ยังไม่มีงานที่เกี่ยวกับโครงการนี้");
define("_WORKBOARD_ADMIN_PROJECTS_NOMEMBERS","ยังไม่มีสมาชิกที่รับผิดชอบโครงการนี้");
define("_WORKBOARD_ADMIN_PROJECTS_ASSIGNMEMBERS","สมาชิกที่รับผิดชอบโครงการ");
define("_WORKBOARD_ADMIN_PROJECTS_STATUSPERCENT","สถิติเป็นเปอร์เซ็นต์");
define("_WORKBOARD_ADMIN_PROJECTS_STATUSPERCENT_CALCULATE","(0 = คำนวนเปอร์เซ็นต์จากงาน)");
define("_WORKBOARD_ADMIN_PROJECTS_STATUS","สถานะ");
define("_WORKBOARD_ADMIN_PROJECTS_STARTDATE","วันเริ่มต้น");
define("_WORKBOARD_ADMIN_PROJECTS_PRIORITY","ความสำคัญ");
define("_WORKBOARD_ADMIN_PROJECTS_FINISHDATE","วันสิ้นสุด");


######################################################################
# From file: status.php
######################################################################
define("_WORKBOARD_ADMIN_STATUS_STATUSLIST","รายการสถานะ");
define("_WORKBOARD_ADMIN_STATUS_STATUSOPTIONS","ข้อกำหนดสำหรับสถานะ");
define("_WORKBOARD_ADMIN_STATUS_STATUSADD","เพิ่มสถานะ");
define("_WORKBOARD_ADMIN_STATUS_STATUSNAME","ชื่อสถานะ");
define("_WORKBOARD_ADMIN_STATUS_STATUSDESCRIPTION","รายละเอียดสถานะ");
define("_WORKBOARD_ADMIN_STATUS_NOSTATUS","ยังไม่มีสถานะในฐานข้อมูล");
define("_WORKBOARD_ADMIN_STATUS_EDITSTATUS","แก้ไขสถานะ");
define("_WORKBOARD_ADMIN_STATUS_UPDATESTATUS","ปรับปรุงสถานะ");
define("_WORKBOARD_ADMIN_STATUS_DELETESTATUS","ลบสถานะ");
define("_WORKBOARD_ADMIN_STATUS_TOTALSTATUSES","สถานะทั้งหมด");
define("_WORKBOARD_ADMIN_STATUS_SWAPSTATUS","เพื่อที่จะลบความสำคัญนี้  กรุณาเข้าไปเปลี่ยนในงานที่เกี่ยวข้อง");

######################################################################
# From file: tasks.php
######################################################################
define("_WORKBOARD_ADMIN_TASKS_PRIORITY","ความสำคัญ");
define("_WORKBOARD_ADMIN_TASKS_TASKLIST","รายการของงาน");
define("_WORKBOARD_ADMIN_TASKS_TASKOPTIONS","ข้อกำหนดสำหรับงาน / สถิติ");
define("_WORKBOARD_ADMIN_TASKS_TASKADD","เพิ่มงาน");
define("_WORKBOARD_ADMIN_TASKS_TASKNAME","ชื่องาน");
define("_WORKBOARD_ADMIN_TASKS_TASKDESCRIPTION","รายละเอียดของงาน");
define("_WORKBOARD_ADMIN_TASKS_PROJECTNAME","โครงการ");
define("_WORKBOARD_ADMIN_TASKS_ASSIGNMEMBERS","สมาชิกที่รับผิดชอบโครงการ");
define("_WORKBOARD_ADMIN_TASKS_NOTASKS","ยังไม่มีงานในฐานข้อมูล.");
define("_WORKBOARD_ADMIN_TASKS_EDITTASK","แก้ไขงาน");
define("_WORKBOARD_ADMIN_TASKS_UPDATETASK","ปรับปรุงงาน");
define("_WORKBOARD_ADMIN_TASKS_DELETETASK","ลบงาน");
define("_WORKBOARD_ADMIN_TASKS_TOTALTASKS","งานทั้งหมด");
define("_WORKBOARD_ADMIN_TASKS_PROJECT","โครงการ");
define("_WORKBOARD_ADMIN_TASKS_ASSIGNEDMEMBERS","สมาชิกที่รับผิดชอบโครงการ");
define("_WORKBOARD_ADMIN_TASKS_NONEASSIGNED","ยังไม่มีสมาชิกที่รับผิดชอบงานนี้");
define("_WORKBOARD_ADMIN_TASKS_STATUS","สถานะ");
define("_WORKBOARD_ADMIN_TASKS_ASC","ASC");
define("_WORKBOARD_ADMIN_TASKS_DESC","DESC");
define("_WORKBOARD_ADMIN_TASKS_SORT","เรียงลำดับ");
define("_WORKBOARD_ADMIN_TASKS_TASKID","รหัสของงาน");
define("_WORKBOARD_ADMIN_TASKS_PROJECTID","รหัสของโครงการ");
define("_WORKBOARD_ADMIN_TASKS_MEMBERID","รหัสของสมาชิก");
define("_WORKBOARD_ADMIN_TASKS_STATUSPERCENT","เปอร์เซ็นต์สถานะ");
define("_WORKBOARD_ADMIN_TASKS_STATUSID","รหัสของสถานะ");
define("_WORKBOARD_ADMIN_TASKS_PRIORITYID","รหัสของความสำคัญ");
define("_WORKBOARD_ADMIN_TASKS_PAGE","หน้า");
define("_WORKBOARD_ADMIN_TASKS_OF","ของ");
define("_WORKBOARD_ADMIN_TASKS_CONFIRMDELETE","คุณแน่ใจที่จะลบงานนี้?");
define("_WORKBOARD_ADMIN_TASKS_STARTDATE","วันเริ่มต้น");
define("_WORKBOARD_ADMIN_TASKS_FINISHDATE","วันสิ้นสุด");
define("_WORKBOARD_ADMIN_TASKS_NA","N/A");

######################################################################
# From file: includes/functions.php
######################################################################
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU","จัดการกระดานงาน");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_MAINMENU","เมนูหลัก");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_TASKS","งาน");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_POSITIONS","ตำแหน่ง");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_PRIORITIES","ความสำคัญ");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_PROJECTS","โครงการ");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_STATUSES","สถานะ");
define("_WORKBOARD_ADMIN_FUNCTIONS_MENU_MEMBERS","สมาชิก");

?>
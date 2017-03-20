#####  เกี่ยวกับโปรแกรม #####

AtomyMAXSITE 2.5 : 
เป็นระบบเว็บสำเร็จรูปอย่างง่ายๆ เพื่อเป็นพื้นฐานในการพัฒนาโปรแกรมแบบง่ายๆ 
โดยการแก้ไข Template แค่ไฟล์เดียว ไม่ได้มีระบบยิ่งใหญ่อะไรเหมือนพวก nuke , jumla , mambo 
หรือ CMS ตัวอื่นๆนะครับ เพราะบางครั้งผมคิดว่ามันเกินความจำเป็น ระบบที่ทำเลยออกจะเป็น Manual ซะมากกว่านะครับ 
เพราะผมทำระบบแนวๆนี้เพราะมันสามารถนำไปประยุกต์ใช้ทำเว็บได้หลากหลายกว่านะครับ


#####  ความต้องการของระบบ #####

ระบบปฏิบัติการ Windows/Linux (หากเป็นระบบปฏิบัติการ Windows แนะนำ Windows NT/2000/XP/2003) 

ซอฟต์แวร์เว็บเซิร์ฟเวอร์ชั่น Microsoft IIS, Apace ฯลฯ 
ติดตั้ง PHP เวอร์ชั่น 4.0 ขึ้นไป 
ติดตั้งฐานข้อมูล MySQL เวอร์ชัน 3.0 ขึ้นไป 


#####  การติดตั้ง #####

1. อัพโหลดไฟล์ทั้งหมดลงใน Server
2. ทำการ chmod โฟล์เดอร์เหล่านี้เป็น 777 รวมถึงไฟล์ต่างๆในโฟล์เดอร์ด้วย
chmod -R 777 attach
chmod -R 777 backup
chmod -R 777 data
chmod -R 777 icon
chmod -R 777 images/personnel
chmod -R 777 images/random
chmod -R 777 images/icon
chmod -R 777 images/gallery
chmod -R 777 modules/aboutus
chmod -R 777 modules/couter
chmod -R 777 modules/editortalk
chmod -R 777 modules/block/banner.xml
chmod -R 777 modules/rss/news.xml
chmod -R 777 modules/smiletag/data
chmod -R 777 templates
chmod -R 777 video
chmod -R 777 UserFiles
chmod -R 777 install
chmod -R 777 webboard_upload
chmod 777 includes/config.in.php
chmod 777 download.dat
chmod 777 research.dat
chmod 777 bots.txt
3. โฟล์เดอร์ UserFiles ต้องอยู่ใน root   www เท่านั้น
4. เปิดเว็บไซต์ http://เว็บของท่านที่เก็บ atomymaxsite/install/
5. กรอกข้อมูลให้ครบถ้วน แล้วกดปุ่ม ติดตั้ง Maxsite
6. ทำการทดสอบโดยเข้าระบบ admin ผ่านเมนูด้านล่างสุดโดยใช้ 
	username : admin
  password : กำหนดเองในขั้นตอนการติดตั้ง
7. ทำการทดสอบโดยเข้าระบบ user ผ่านเมนูของ user โดยใช้
	username : netty
	password : atomnet
8. สามารถเพิ่มข้อความในการแบนข้อความจากโฆษณาขายตรง และ คำหยาบ ได้
โดยเพิ่มข้อความในไฟล์
 includes/class.ban.php


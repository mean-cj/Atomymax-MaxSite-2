# phpMyAdmin SQL Dump
# version 2.5.3-rc2
# http://www.phpmyadmin.net
#
# โฮสต์: localhost
# เวลาในการสร้าง: 23 ก.ค. 2011  11:03น.
# รุ่นของเซิร์ฟเวอร์: 5.0.86
# รุ่นของ PHP: 5.2.11
# 
# ฐานข้อมูล : `banphue`
# 

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_activeuser`
#

CREATE TABLE `web_activeuser` (
  `ct_no` int(11) NOT NULL auto_increment,
  `ct_yyyy` int(4) NOT NULL default '0',
  `ct_mm` int(2) NOT NULL default '0',
  `ct_dd` int(2) NOT NULL default '0',
  `ct_ip` varchar(15) NOT NULL default '',
  `ct_count` int(2) NOT NULL default '0',
  `ct_time` int(20) NOT NULL default '0',
  PRIMARY KEY  (`ct_no`)
) ENGINE=MyISAM AUTO_INCREMENT=1   ;

#
# dump ตาราง `web_activeuser`
#


# --------------------------------------------------------

#
# โครงสร้างตาราง `web_admin`
#

CREATE TABLE `web_admin` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL default '',
  `password` varchar(150) default NULL,
  `name` varchar(255) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `level` tinyint(4) NOT NULL default '0',
  `picture` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `level` (`level`)
) ENGINE=MyISAM AUTO_INCREMENT=2 ;

#
# dump ตาราง `web_admin`
#

INSERT INTO `web_admin` VALUES (1, 'admin', 'f0cc68da195d9d620b6cfe05f6f07a62', 'นายชัดสกร พิกุลทอง', 'vt9vm@hotmail.com', 1, 'admin_1291354356_adm-04.jpg');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_alumnus`
#

CREATE TABLE `web_alumnus` (
  `id` int(5) NOT NULL auto_increment,
  `alum_id` varchar(10) NOT NULL default '',
  `first_name` varchar(30) default NULL,
  `last_name` varchar(40) default NULL,
  `nic_name` varchar(20) default NULL,
  `birthday` varchar(20) default NULL,
  `age` char(2) default NULL,
  `sex` char(1) default NULL,
  `picture` varchar(30) default '0',
  `numid` varchar(13) default NULL,
  `schid` varchar(5) default NULL,
  `yearfin` varchar(4) default NULL,
  `email` varchar(40) default NULL,
  `website` varchar(50) default NULL,
  `address` varchar(100) NOT NULL,
  `amper` varchar(40) NOT NULL,
  `province` varchar(20) default NULL,
  `school` varchar(100) default NULL,
  `WORK` varchar(100) default NULL,
  `hobby` varchar(100) default NULL,
  `COMMENT` varchar(100) default NULL,
  `icon` varchar(20) default NULL,
  `icq` varchar(10) default '0',
  `msn` varchar(50) default '0',
  `yahoo` varchar(30) default '0',
  `qq` varchar(10) default '0',
  `cam` char(1) default '0',
  `mic` char(1) default '0',
  `emo` char(3) default NULL,
  `worksta` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `alum_id` (`alum_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4  ;

#
# dump ตาราง `web_alumnus`
#

INSERT INTO `web_alumnus` VALUES (1, '0001', 'วิทูรย์', 'บุญเฉลียว', 'แป๊บ', '10/04/2527', '26', '1', '', '1440500003615', '', '2530', 'vituru_59@hotmail.com', 'http://', '6/202 ม.5', 'คลองสาววา', 'กรุงเทพมหานคร', '', 'บริษัท ณฐโชคปัญญาทรัพย์ จำกัด', 'ทำอาหาร', 'สวัสดีเพื่อนๆๆทุกคนครับ', '144.gif', '0', '0', '0', '0', '0', '0', 'e1', 'บริษัท ณฐโชคปัญญาทรัพย์ จำกัด', '0873384517', '10510');
INSERT INTO `web_alumnus` VALUES (2, '0002', 'โชคทวี', 'ศรีแพงเลิศ', 'ไดร์', '31/03/2530', '24', '1', '', '1440500089471', '', '2541', 'tapache@HOTMAIL.COM', 'http://', '66/9', 'ชื่นชม', 'มหาสารคาม', 'ทำงาน', 'กรุงเทพ', 'เล่นดนตรี', 'สวัสดีงับ', 'member.png', '0', '0', '0', '0', '0', '0', 'e1', 'กรุงเทพ', '0831513034', '44160');
INSERT INTO `web_alumnus` VALUES (3, '0003', 'นาย รุ่งโรจน์', 'แข็งฤทธิ์', 'โรจน์', '10/11/2528', '26', '1', '', '1440500017918', '', '2540', 'www.rungrot@hotmait.com', 'http://', '35/27 ถ.นวมินทร์', 'บึงกุ่ม', 'กรุงเทพมหานคร', '', 'กรุงเทพ', 'นอน', 'สวัสดีครับ', 'member.png', '0', '0', '0', '0', '0', '0', 'e1', 'กรุงเทพ', '0851505114', '10230');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_block`
#

CREATE TABLE `web_block` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `blockname` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `sfile` varchar(10) NOT NULL,
  `code` text,
  `pblock` char(10) default '0',
  `sort` int(5) NOT NULL default '1',
  `status` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33  ;

#
# dump ตาราง `web_block`
#

INSERT INTO `web_block` VALUES (1, 'mainmenu', 'เมนูหลัก', 'mainmenu', 'php', '', 'left', 1, 1);
INSERT INTO `web_block` VALUES (2, 'member', 'ระบบสมาชิก', 'member', 'php', '', 'left', 2, 1);
INSERT INTO `web_block` VALUES (3, 'shoutbox', 'ฝากข้อความ', 'shoutbox', 'php', '', 'left', 3, 1);
INSERT INTO `web_block` VALUES (4, 'linkimg', 'link banner', 'linkimg', 'php', '', 'left', 4, 0);
INSERT INTO `web_block` VALUES (5, 'poll', 'poll', 'poll', 'php', '', 'left', 5, 1);
INSERT INTO `web_block` VALUES (6, 'blog', 'blog สมาชิก', 'blog', 'php', '', 'left', 6, 0);
INSERT INTO `web_block` VALUES (7, 'googlesla', 'แปลภาษาจาก google', 'googlesla', 'php', '', 'left', 7, 0);
INSERT INTO `web_block` VALUES (8, 'weather', 'พยากรณ์อากาศ', 'weather', 'php', '', 'left', 8, 0);
INSERT INTO `web_block` VALUES (9, 'googlesearch', 'ค้นหาจาก google', 'googlesearch', 'php', '', 'left', 9, 0);
INSERT INTO `web_block` VALUES (10, 'catblog', 'หมวดหมู่ blog', 'catblog', 'php', '', 'left', 10, 0);
INSERT INTO `web_block` VALUES (11, 'alumnus', 'สมาคมศิษย์เก่า', 'alumnus', 'php', '', 'center', 1, 1);
INSERT INTO `web_block` VALUES (12, 'workboard', 'โครงการ/งาน', 'workboard', 'php', '', 'center', 2, 1);
INSERT INTO `web_block` VALUES (13, 'news2', 'ผลงานทางวิชาการ', 'shownews2', 'php', '', 'center', 3, 1);
INSERT INTO `web_block` VALUES (14, 'news3', 'การฝึกอบรม / ศึกษาดูงาน', 'shownews3', 'php', '', 'center', 4, 0);
INSERT INTO `web_block` VALUES (15, 'news4', 'ข่าวสารทั่วไป', 'shownews4', 'php', '', 'center', 5, 1);
INSERT INTO `web_block` VALUES (16, 'knowledge', 'สาระ / ความรู้', 'knowledge', 'php', '', 'center', 6, 0);
INSERT INTO `web_block` VALUES (17, 'download', 'เผยแพร่ download', 'download', 'php', '', 'center', 7, 1);
INSERT INTO `web_block` VALUES (18, 'newsrss', 'newsrss', 'newsrss', 'php', '', 'center', 8, 0);
INSERT INTO `web_block` VALUES (19, 'norsopor', 'ข่าวประจำวัน', 'norsopor', 'php', '', 'center', 9, 0);
INSERT INTO `web_block` VALUES (20, 'blogcenter', 'เล่าสู่กันฟัง', 'blogcenter', 'php', '', 'center', 10, 0);
INSERT INTO `web_block` VALUES (21, 'personnel', 'ทำเนียบบุคลากร', 'personnel', 'php', '', 'right', 1, 1);
INSERT INTO `web_block` VALUES (22, 'calendar', 'ปฏิทินกิจกรรม', 'calendar', 'php', '', 'right', 2, 1);
INSERT INTO `web_block` VALUES (23, 'gallery', 'คลังเก็บรูปภาพ', 'gallery', 'php', '', 'right', 3, 0);
INSERT INTO `web_block` VALUES (24, 'oil', 'ราคาน้ำมัน', 'oil', 'php', '', 'right', 4, 0);
INSERT INTO `web_block` VALUES (25, 'scrollerstop', 'คลังรูปภาพ', 'scrollerstop', 'php', '', 'right', 6, 1);
INSERT INTO `web_block` VALUES (26, 'weather_flash', 'พยากรณ์อากาศ', 'weather_flash', 'php', '', 'right', 7, 0);
INSERT INTO `web_block` VALUES (27, 'counter', 'สถิติผู้เยี่ยมชม', 'counter', 'php', '', 'right', 8, 1);
INSERT INTO `web_block` VALUES (28, 'webboard', 'กระดานถามตอบ', 'webboard', 'php', '', 'user1', 1, 1);
INSERT INTO `web_block` VALUES (29, 'rotator', 'สุ่มภาพข่าว', 'rotator', 'php', '', 'user2', 1, 0);
INSERT INTO `web_block` VALUES (30, 'randomimg', 'สุ่มรูปภาพ', 'randomimg', 'php', '', 'user2', 2, 0);
INSERT INTO `web_block` VALUES (31, 'flashslide', 'flashslide', 'flashslide', 'php', '', 'user2', 3, 1);
INSERT INTO `web_block` VALUES (32, 'news1', 'ข่าวประชาสัมพันธ์', 'shownews1', 'php', '', 'user2', 4, 1);
# --------------------------------------------------------

#
# โครงสร้างตาราง `web_blog`
#

CREATE TABLE `web_blog` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(10) NOT NULL default '',
  `topic` varchar(255) NOT NULL default '',
  `headline` varchar(255) NOT NULL default '',
  `detail` text NOT NULL,
  `posted` varchar(100) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  `update_date` varchar(50) NOT NULL default '',
  `enable_comment` tinyint(1) NOT NULL default '0',
  `pageview` int(11) NOT NULL default '0',
  `attach` varchar(100) NOT NULL,
  `pic` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=3   ;

#
# dump ตาราง `web_blog`
#

INSERT INTO `web_blog` VALUES (1, '2', 'ผงชูรส ที่มา-วัตถุดิบ-ประโยชน์และโทษ', 'สารปรุงแต่งรสอาหาร <strong><em><span style="color: #f00">ผงชูรส </span></em></strong>มีที่มาเริ่มจากในปี พ.ศ.2451 ศาสตราจารย์ ดร.คิคุนาเอะ อิเคดะ แห่งมหาวิทยาลัยโตเกียวอิมพีเรียล ประเทศญี่ปุ่น ค้นพบว่าผลึกสี', '<p>\r\n	สารปรุงแต่งรสอาหาร <strong><em><span style="color: #f00">ผงชูรส </span></em></strong>มีที่มาเริ่มจากในปี พ.ศ.2451 ศาสตราจารย์ ดร.คิคุนาเอะ อิเคดะ แห่งมหาวิทยาลัยโตเกียวอิมพีเรียล ประเทศญี่ปุ่น ค้นพบว่าผลึกสีน้ำตาลที่สกัดจากสาหร่ายทะเลที่ชื่อว่าคอมบุ คือ กรดกลูตามิก และเมื่อลองชิมพบว่ามีรสใกล้เคียงกับซุปสาหร่ายทะเล ซึ่งเป็นอาหารประจำวันของชาวญี่ปุ่นที่บริโภคกันมาหลายร้อยปี</p>\r\n<p>\r\n	จึงตั้งชื่อรสชาติของกรดกลูตามิกที่สกัดได้ว่า &quot;อูมามิ&quot; หลังจากนั้นได้จดสิทธิบัตรการผลิตกรดกลูตามิกในปริมาณมากๆ อันเป็นที่มาของอุตสาหกรรมผงชูรสในปัจจุบัน</p>\r\n<p>\r\n	<br />\r\n	ผงชูรสมีการขายในเชิงพาณิชย์ครั้งแรก ภายใต้ชื่อการค้าเป็นภาษาญี่ปุ่นว่า อายิโนะโมะโต๊ะ หมายถึง แก่นแท้ของรสชาติ ผลิตโดยใช้วิธีการย่อยแป้งสาลีด้วยกรด เพื่อให้ได้กรดอะมิโนแล้วจึงแยกกลูตาเมตออกมาภายหลัง&nbsp;</p>\r\n<p>\r\n	กระบวนการผลิตในปัจจุบันเริ่มจากใช้ขบวนการย่อยสลายแป้งมันสำปะหลังทางเคมี โดยใช้กรดกำมะถันหรือกรดซัลฟูริกที่อุณหภูมิ 130 องศาเซลเซียส จนได้สารละลายน้ำตาลกลูโคส จากนั้นผ่านกระบวนการหมักโดยใช้ยูเรียและเชื้อจุลินทรีย์จนได้แอมโมเนียกลูตาเมต ส่งผ่านกระบวนการทางเคมีต่อโดยใช้กรดเกลือหรือกรดไฮโดรคลอริก จนได้เป็นกรดกลูตามิก และผ่านกระบวนการเปลี่ยนแปลงทางเคมีโดยใช้โซเดียมไฮดรอกไซด์ จะได้สารละลายผงชูรสหยาบ นำไปผ่านขบวนการฟอกสีโดยใช้สารฟอกสี จนเป็นสารละลายผงชูรสใส แล้วผ่านขั้นตอนสุดท้ายด้วยการทำให้ตกผลึกจนกลายเป็นผลึกผงชูรส</p>\r\n<p>\r\n	อาการแพ้ผงชูรส หรือที่รู้จักกันทั่วไปว่า &quot;ไชนีสเรสทัวรองซินโดรม&quot; (Chinese Restaurant Syndrome) หรือ &quot;โรคภัตตาคารจีน&quot; เพราะร้านอาหารจีนมักใช้ผงชูรสกันมากนั่นเอง จะมีอาการชาและร้อนวูบวาบที่ปาก ลิ้น ใบหน้า โหนกแก้ม ต้นคอ หน้าอก บางคนมีผื่นแดงเกิดขึ้นตามตัว แน่นหน้าอก หายใจไม่สะดวก</p>\r\n<p>\r\n	ประโยชน์ผงชูรสคงแค่เพิ่มความอร่อย แต่มีโทษมหันต์ถ้ากินในปริมาณมากเกินไป กำหนดไว้ไม่ควรบริโภคเกิน 2 ช้อนชาต่อวัน&nbsp;</p>\r\n<p>\r\n	หากบริโภคมากเกินไปผงชูรสจะไปทำลายสมองส่วนควบคุมการเจริญเติบโต และระบบสืบพันธุ์ของร่างกาย ทำลาย ระบบประสาทตา สายตาเสีย ก่อให้เกิดมะเร็งได้โดยเฉพาะอาหารที่หมักผงชูรสแล้วนำไปปิ้ง ย่าง นอกจากนี้ผู้หญิงที่กำลังตั้งครรภ์ถ้าบริโภคมากเกินไปจะผ่านเยื่อกั้นระหว่างรกภายในร่างกายของผู้เป็นมารดากับทารกในครรภ์ได้ ทำให้ทารกในครรภ์ได้รับผลกระทบจากผงชูรสด้วย</p>\r\n<p>\r\n	วิธีการเลือกซื้อไม่ควรใช้ผงชูรสปลอม สังเกตจากตราประทับอย. และเลือกซื้อผงชูรสที่บรรจุในภาชนะปิดผนึกเรียบร้อย</p>\r\n', 'admin', '1272093318', '1272093318', 1, 116, '', '1');
INSERT INTO `web_blog` VALUES (2, '2', 'แผนการของ NASA ในการส่งดาวเทียมสังเกตการณ์ดวงอาทิตย์', '<strong><em><span style="color: #f00">ดวงอาทิตย์</span></em></strong> เป็นพลังผลักดันสำคัญเบื้องหลังสภาพภูมิอากาศของโลก แต่ความเปลี่ยนแปลงๆ ในดวงอาทิตย์มีผลกระทบมากเกินกว่าด้านสภาพอากาศบนโลกเรา ผู้สื่อข่าว Voice of America, Suzanne Presto มีรายงานเก', '<strong><em><span style="color: #f00">ดวงอาทิตย์</span></em></strong> เป็นพลังผลักดันสำคัญเบื้องหลังสภาพภูมิอากาศของโลก แต่ความเปลี่ยนแปลงๆ ในดวงอาทิตย์มีผลกระทบมากเกินกว่าด้านสภาพอากาศบนโลกเรา</p>\r\n\r\n	ผู้สื่อข่าว Voice of America, Suzanne Presto มีรายงานเกี่ยวกับแผนการของ NASA หรือองค์การอวกาศ สหรัฐฯ ในการส่งดาวเทียมสังเกตการณ์ดวงอาทิตย์เมื่อวันพฤหัสบดี ซึ่งคาดกันว่า ดาวเทียมสังเกตการณ์ดังกล่าวจะส่งภาพของดวงอาทิตย์อย่างหาที่เปรียบไม่ได้กลับมาให้นักวิทยาศาสตร์ได้ศึกษา &quot;สภาพอวกาศ&quot; ที่อาจมีผลกระทบต่อการสื่อสารทางดาวเทียม ระบบการนำร่อง และแม้กระทั่งสายไฟฟ้าบนโลก</p>\r\n<p>\r\n	ปรากฏการณ์ต่างๆ บนดวงอาทิตย์ ความเปลี่ยนแปลงในสนามแม่เหล็กของดวงอาทิตย์นั้น เป็นสาเหตุของสิ่งที่นักวิทยาศาสตร์เรียกว่า &quot;large particle events&quot; หรือ &quot;ปรากฏการณ์อนุภาคขนาดใหญ่&quot; ปรากฏการณ์ดังกล่าวมีผลกระทบต่อโลกได้ อย่างเมื่อครั้งที่เกิดไฟฟ้าดับในภาคใต้ของสวีเดนเมื่อ 7 ปีมาแล้ว</p>\r\n<p>\r\n	Dean Pesnell นักวิทยาศาสตร์ประจำโครงการดาวเทียมสังเกตการณ์ดวงอาทิตย์ขององค์การอวกาศ สหรัฐฯ หรือ NASA อธิบายว่า เมื่อเกิด &quot;ปรากฏการณ์อนุภาคขนาดใหญ่&quot; บนดวงอาทิตย์ อนุภาคเหล่านั้นจะแผ่กระจายออกไปในห้วงอวกาศในระบบสุริยะ และผ่านเข้ามาทำปฏิกริยากับสนามแม่เหล็กของโลกเรา และอาจก่อกวนหรือยังความเสียหายแก่ระบบกระแสไฟฟ้าบนโลกได้</p>\r\n<p>\r\n	Dean Pesnell ซึ่งทำงานอยู่ที่ศูนย์ควบคุมการบินอวกาศ Goddard ชานกรุงวอชิงตัน อธิบายว่า ดวงอาทิตย์มีปฏิกริยา และมีความเปลี่ยนแปลงอยู่ตลอดเวลา และสนามแม่เหล็กที่มีความเปลี่ยนแปลงจะส่งอนุภาคประจุไฟฟ้าออกสู่ระบบสุริยะ หรือเปลี่ยนเป็นการปะทุระเบิด ส่งก๊าซพวยพุ่งออกสู่ชั้นบรรยากาศของดวงอาทิตย์เอง หรือเกิดการปะทุระเบิดที่ปล่อยสารวัตถุดวงอาทิตย์ออกสู่ห้วงอวกาศ เป็นปริมาณหลายพันล้านตัน</p>\r\n<p>\r\n	ปรากฏการณ์ต่างๆ ดังกล่าวของดวงอาทิตย์จะเปลี่ยนแปรระดับพลังงาน และการแผ่รังสีในระบบสุริยะของเรา และอาจมีผลกระทบต่อเทคโนโลยี อย่างการสื่อสารโทรคมนาคม และระบบนำร่องต่างๆ บนโลกเราได้</p>\r\n<p>\r\n	ดาวเทียมสังเกตการณ์ดวงอาทิตย์ใหม่นี้จะส่งภาพถ่ายคุณภาพสูง คมชัดลึกกว่าภาพโทรทัศน์ HDTV 10 เท่า และรวบรวมข้อมูลต่างๆ เกี่ยวกับปรากฏการณ์ของดวงอาทิตย์ และในสนามแม่เหล็กของดวงอาทิตย์กลับมายังโลก คาดว่าข้อมูลและภาพถ่ายเหล่านี้จะช่วยให้นักวิทยาศาสตร์มีความรู้ความเข้าใจเกี่ยวกับดวงอาทิตย์มากขึ้น และสามารถคาดทำนายพายุสุริยะและปรากฏการณ์อื่นๆ ของดวงอาทิตย์ ที่อาจมีผลกระทบถึงการทำงานของยานอวกาศในวงโคจรรอบโลก ตลอดจนระบบไฟฟ้า ระบบการสื่อสารโทรคมนาคม และระบบนำร่องทั้งหลายบนโลกได้</p>\r\n<p>\r\n	ดาวเทียมสังเกตการณ์ดวงอาทิตย์ใหม่นี้จะทำงานเป็นเวลาราว 5 ปี.</p>\r\n', 'admin', '1273713026', '1273713026', 1, 205, '', '1');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_blog_category`
#

CREATE TABLE `web_blog_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(255) NOT NULL default '',
  `sort` int(11) NOT NULL default '0',
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11   ;

#
# dump ตาราง `web_blog_category`
#

INSERT INTO `web_blog_category` VALUES (1, 'วิทยาศาสตร์', 1, 'blog_1273721510.jpg');
INSERT INTO `web_blog_category` VALUES (2, 'ภาษาไทย', 2, 'blog_1273721524.jpg');
INSERT INTO `web_blog_category` VALUES (3, 'คณิตศาสตร์', 3, 'blog_1273721536.jpg');
INSERT INTO `web_blog_category` VALUES (4, 'สุขศึกษาและพลศึกษา', 4, 'blog_1273721548.jpg');
INSERT INTO `web_blog_category` VALUES (5, 'ศิลปศึกษา', 5, 'blog_1273721558.jpg');
INSERT INTO `web_blog_category` VALUES (6, 'การงานอาชีพฯ', 6, 'blog_1273721569.jpg');
INSERT INTO `web_blog_category` VALUES (7, 'ภาษาอังกฤษ', 7, 'blog_1273721581.jpg');
INSERT INTO `web_blog_category` VALUES (8, 'สังคมศึกษา', 8, 'blog_1273721591.jpg');
INSERT INTO `web_blog_category` VALUES (9, 'กลุ่มพัฒนาผู้เรียน', 9, 'blog_1273721770.jpg');
INSERT INTO `web_blog_category` VALUES (10, 'ทั่วๆไป', 10, 'blog_1273723889.jpg');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_blog_comment`
#

CREATE TABLE `web_blog_comment` (
  `id` int(7) NOT NULL auto_increment,
  `blog_id` int(7) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `comment` text NOT NULL,
  `ip` varchar(50) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `blog_id` (`blog_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2  ;

#
# dump ตาราง `web_blog_comment`
#

INSERT INTO `web_blog_comment` VALUES (1, 1, 'netty', 'ลองดูนะครับ', '127.0.0.1', '1273713215');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_blog_level`
#

CREATE TABLE `web_blog_level` (
  `level_id` int(5) NOT NULL auto_increment,
  `level_name` varchar(50) NOT NULL,
  `level_count` varchar(50) default NULL,
  PRIMARY KEY  (`level_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7  ;

#
# dump ตาราง `web_blog_level`
#

INSERT INTO `web_blog_level` VALUES (1, 'มือใหม่', '20');
INSERT INTO `web_blog_level` VALUES (2, 'มือเก่า', '40');
INSERT INTO `web_blog_level` VALUES (3, 'มือเก๋า', '60');
INSERT INTO `web_blog_level` VALUES (4, 'เซียน', '80');
INSERT INTO `web_blog_level` VALUES (5, 'โคตรเซียน', '100');
INSERT INTO `web_blog_level` VALUES (6, 'หนึ่งในใต้หล้า', '101');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_calendar`
#

CREATE TABLE `web_calendar` (
  `id` int(11) NOT NULL auto_increment,
  `date_event` date NOT NULL default '0000-00-00',
  `timeout` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL default '',
  `detail` text NOT NULL,
  `post_date` int(20) NOT NULL default '0',
  `update_date` int(20) NOT NULL default '0',
  `pageview` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `date_event` (`date_event`)
) ENGINE=MyISAM AUTO_INCREMENT=15  ;

#
# dump ตาราง `web_calendar`
#

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_config`
#

CREATE TABLE `web_config` (
  `id` int(2) NOT NULL auto_increment,
  `posit` varchar(100) default NULL,
  `name` varchar(150) default NULL,
  PRIMARY KEY  (`id`),
  KEY `posit` (`posit`)
) ENGINE=MyISAM AUTO_INCREMENT=9 ;

#
# dump ตาราง `web_config`
#

INSERT INTO `web_config` VALUES (1, 'title', ':: โรงเรียนบ้านผือ :: วิชาการเด่น เน้นจริยธรรม นำกีฬา พัฒนาชุมชน ::');
INSERT INTO `web_config` VALUES (2, 'url', 'http://banphue.sytes.net');
INSERT INTO `web_config` VALUES (3, 'path', '/home/banphue/public_html');
INSERT INTO `web_config` VALUES (4, 'footer1', 'โรงเรียนบ้านผือ ม.7 บ้านผือ ต.หนองกุง อ.ชื่นชม จ.มหาสารคาม 44160 สำนักงานเขตพื้นที่การศึกษาประถมศึกษามหาสารคาม เขต3');
INSERT INTO `web_config` VALUES (5, 'footer2', 'webmaster  นายชัดสกร พิกุลทอง ผู้อำนวยการสถานศึกษา เมล์  vt9vm@hotmail.com  โทร  0899469997');
INSERT INTO `web_config` VALUES (6, 'email', 'vt9vm@hotmail.com');
INSERT INTO `web_config` VALUES (7, 'templates', 'cli3');
INSERT INTO `web_config` VALUES (8, 'iso', 'tis-620');
# --------------------------------------------------------

#
# โครงสร้างตาราง `web_config_category`
#

CREATE TABLE `web_config_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 ;

#
# dump ตาราง `web_config_category`
#

INSERT INTO `web_config_category` VALUES (1, 'หัวเวปภาพเล็ก');
INSERT INTO `web_config_category` VALUES (2, 'หัวเวปภาพใหญ่');
INSERT INTO `web_config_category` VALUES (3, 'ท้ายเวป');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_download`
#

CREATE TABLE `web_download` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(10) NOT NULL default '',
  `topic` varchar(255) NOT NULL default '',
  `headline` varchar(255) NOT NULL default '',
  `detail` text NOT NULL,
  `posted` varchar(100) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  `update_date` varchar(50) NOT NULL default '',
  `enable_comment` tinyint(1) NOT NULL default '0',
  `full_text` varchar(100) NOT NULL default '',
  `pageview` int(11) NOT NULL default '0',
  `type` varchar(50) NOT NULL default '',
  `size` int(50) NOT NULL default '0',
  `rate` int(10) NOT NULL default '0',
  `status` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=1  ;

#
# dump ตาราง `web_download`
#


# --------------------------------------------------------

#
# โครงสร้างตาราง `web_download_category`
#

CREATE TABLE `web_download_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL default '0',
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 ;

#
# dump ตาราง `web_download_category`
#

INSERT INTO `web_download_category` VALUES (1, 'โปรแกรมการศึกษา', 1, 'Doc.png');
INSERT INTO `web_download_category` VALUES (2, 'โปรแกรมคอมพิวเตอร์', 2, 'Network.png');
INSERT INTO `web_download_category` VALUES (3, 'เอกสารประกอบการเรียน', 3, 'Picture.png');
INSERT INTO `web_download_category` VALUES (4, 'งานวิจัย/บทความทางวิชาการ', 4, '/Videos.png');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_download_comment`
#

CREATE TABLE `web_download_comment` (
  `id` int(7) NOT NULL auto_increment,
  `download_id` int(7) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `comment` text NOT NULL,
  `ip` varchar(50) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `download_id` (`download_id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;

#
# dump ตาราง `web_download_comment`
#


# --------------------------------------------------------

#
# โครงสร้างตาราง `web_gallery`
#

CREATE TABLE `web_gallery` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(10) NOT NULL default '',
  `posted` varchar(100) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  `enable_comment` tinyint(1) NOT NULL default '0',
  `pageview` int(11) NOT NULL default '0',
  `sort` int(11) NOT NULL default '0',
  `pic` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=5  ;

#
# dump ตาราง `web_gallery`
#
INSERT INTO `web_gallery` VALUES(1, '1', 'admin', '1310841751', 1, 1, 0, 'DSCN0923a.jpg');
INSERT INTO `web_gallery` VALUES(2, '1', 'admin', '1310841751', 1, 1, 0, 'DSCN0925a.jpg');
INSERT INTO `web_gallery` VALUES(3, '1', 'admin', '1310841751', 1, 2, 0, 'DSCN0928a.jpg');
INSERT INTO `web_gallery` VALUES(4, '1', 'admin', '1310841751', 1, 1, 0, 'DSCN0931a.jpg');
# --------------------------------------------------------

#
# โครงสร้างตาราง `web_gallery_category`
#

CREATE TABLE `web_gallery_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(255) NOT NULL default '',
  `category_detail` text NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 ;

#
# dump ตาราง `web_gallery_category`
#

INSERT INTO `web_gallery_category` VALUES (1, 'ทำบุญเข้าพรรษา', 'ครู นักเรียนได้ร่วมกันถวายเทียนพรรษา ถวายสังฑทาน บำเพ็ญประโยชน์โดยการทำความสะอาดวัดบ้านผือ เนื่องในโอกาสวันอาสาฬหบูชาและวันเข้าพรรษา ในวันที่ 14 กรกฎาคม 2554', '1310840961', 14);

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_gallery_comment`
#

CREATE TABLE `web_gallery_comment` (
  `id` int(7) NOT NULL auto_increment,
  `gallery_id` int(7) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `comment` text NOT NULL,
  `ip` varchar(50) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `gallery_id` (`gallery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

#
# dump ตาราง `web_gallery_comment`
#


# --------------------------------------------------------

#
# โครงสร้างตาราง `web_gbook`
#

CREATE TABLE `web_gbook` (
  `No` int(5) NOT NULL auto_increment,
  `Message` text NOT NULL,
  `Name` varchar(50) NOT NULL default '',
  `is_member` varchar(50) NOT NULL,
  `Email` varchar(30) NOT NULL default '',
  `IP` varchar(20) NOT NULL default '',
  `URL` varchar(80) NOT NULL default '',
  `Date` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`No`)
) ENGINE=MyISAM AUTO_INCREMENT=3  ;

#
# dump ตาราง `web_gbook`
#

INSERT INTO `web_gbook` VALUES(1, 'ขอแสดงความยินดี และดีใจเป็นอย่างยิ่งกับท่าน ผอ.ด้วยพึ่งได่ข่าวตั้งแต่เรียนจบ มหาบัณฑิต ม.ราม( ศก.รุ่น 5)ไม่ได้เจอกันเลย  ยอดเยี่ยมจริง ๆ ว่างทำ website โรงเรียนให้ด้วยนะโรงเรียนยังไม่มีเลยครับท่าน ', 'sung', '1', 'sung15@hotmail.com', '125.26.68.254', 'http://', 'พฤหัสบดี 16 ธ.ค. 2553');
INSERT INTO `web_gbook` VALUES(2, 'เวปสวยมากครับผม  ท่านพัฒนาจาก atomymaxsite2.0 ได้ดีมากครับผม <a href="http://maxtom.sytes.net">http://maxtom.sytes.net</a> ', 'noi', '0', '', '223.206.128.105', 'http://', 'เสาร์ 8 ม.ค. 2554');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_groups`
#

CREATE TABLE `web_groups` (
  `id` int(11) NOT NULL auto_increment,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `news_add` tinyint(4) NOT NULL default '0',
  `news_edit` tinyint(4) NOT NULL default '0',
  `news_del` tinyint(4) NOT NULL default '0',
  `newscat_add` tinyint(4) NOT NULL default '0',
  `newscat_edit` tinyint(4) NOT NULL default '0',
  `newscat_del` tinyint(4) NOT NULL default '0',
  `admin_add` tinyint(4) NOT NULL default '0',
  `admin_edit` tinyint(4) NOT NULL default '0',
  `admin_del` tinyint(4) NOT NULL default '0',
  `group_add` tinyint(4) NOT NULL default '0',
  `group_edit` tinyint(4) NOT NULL default '0',
  `group_del` tinyint(4) NOT NULL default '0',
  `links_add` tinyint(4) NOT NULL default '0',
  `links_edit` tinyint(4) NOT NULL default '0',
  `links_del` tinyint(4) NOT NULL default '0',
  `article_add` tinyint(4) NOT NULL default '0',
  `article_edit` tinyint(4) NOT NULL default '0',
  `article_del` tinyint(4) NOT NULL default '0',
  `articlecat_add` tinyint(4) NOT NULL default '0',
  `articlecat_edit` tinyint(4) NOT NULL default '0',
  `articlecat_del` tinyint(4) NOT NULL default '0',
  `contact_add` tinyint(4) NOT NULL default '0',
  `contact_edit` tinyint(4) NOT NULL default '0',
  `contact_del` tinyint(4) NOT NULL default '0',
  `calendar_add` tinyint(4) NOT NULL default '0',
  `calendar_edit` tinyint(4) NOT NULL default '0',
  `calendar_del` tinyint(4) NOT NULL default '0',
  `webboard_add` tinyint(4) NOT NULL default '0',
  `webboard_edit` tinyint(4) NOT NULL default '0',
  `webboard_del` tinyint(4) NOT NULL default '0',
  `editortalk_edit` tinyint(4) NOT NULL default '0',
  `aboutus_edit` tinyint(4) NOT NULL default '0',
  `minepass_edit` tinyint(4) NOT NULL default '0',
  `page_add` tinyint(4) NOT NULL default '0',
  `page_edit` tinyint(4) NOT NULL default '0',
  `page_del` tinyint(4) NOT NULL default '0',
  `research_add` tinyint(4) NOT NULL default '0',
  `research_edit` tinyint(4) NOT NULL default '0',
  `research_del` tinyint(4) NOT NULL default '0',
  `researchcat_add` tinyint(4) NOT NULL default '0',
  `researchcat_edit` tinyint(4) NOT NULL default '0',
  `researchcat_del` tinyint(4) NOT NULL default '0',
  `download_add` tinyint(4) NOT NULL default '0',
  `download_edit` tinyint(4) NOT NULL default '0',
  `download_del` tinyint(4) NOT NULL default '0',
  `downloadcat_add` tinyint(4) NOT NULL default '0',
  `downloadcat_edit` tinyint(4) NOT NULL default '0',
  `downloadcat_del` tinyint(4) NOT NULL default '0',
  `member_add` tinyint(4) NOT NULL default '0',
  `member_edit` tinyint(4) NOT NULL default '0',
  `member_del` tinyint(4) NOT NULL default '0',
  `config_add` tinyint(4) NOT NULL default '0',
  `config_edit` tinyint(4) NOT NULL default '0',
  `config_del` tinyint(4) NOT NULL default '0',
  `block_add` tinyint(4) NOT NULL default '0',
  `block_edit` tinyint(4) NOT NULL default '0',
  `block_del` tinyint(4) NOT NULL default '0',
  `poll_add` tinyint(4) NOT NULL default '0',
  `poll_edit` tinyint(4) NOT NULL default '0',
  `poll_del` tinyint(4) NOT NULL default '0',
  `gbook_edit` tinyint(4) NOT NULL default '0',
  `gbook_del` tinyint(4) NOT NULL default '0',
  `gallery_add` tinyint(4) NOT NULL default '0',
  `gallery_edit` tinyint(4) NOT NULL default '0',
  `gallery_del` tinyint(4) NOT NULL default '0',
  `gallery_detail` int(4) NOT NULL default '0',
  `gallerycat_add` tinyint(4) NOT NULL default '0',
  `gallerycat_edit` tinyint(4) NOT NULL default '0',
  `gallerycat_del` tinyint(4) NOT NULL default '0',
  `ipblock_add` tinyint(4) NOT NULL default '0',
  `ipblock_edit` tinyint(4) NOT NULL default '0',
  `ipblock_del` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4  ;

#
# dump ตาราง `web_groups`
#

INSERT INTO web_groups VALUES (1, 'Webmaster', 'webmaster', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1,  1, 1, 1, 1, 1, 1, 1, 1, 1);
INSERT INTO web_groups VALUES (2, 'Admin', 'admin', 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1,  1, 1, 1, 1, 1, 1, 1, 1, 1);
INSERT INTO web_groups VALUES (3, 'staff', 'staff', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
# --------------------------------------------------------

#
# โครงสร้างตาราง `web_ipblock`
#

CREATE TABLE `web_ipblock` (
  `id` int(11) NOT NULL auto_increment,
  `ip` varchar(30) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM AUTO_INCREMENT=1  ;

#
# dump ตาราง `web_ipblock`
#


# --------------------------------------------------------

#
# โครงสร้างตาราง `web_knowledge`
#

CREATE TABLE `web_knowledge` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(10) NOT NULL default '',
  `topic` varchar(255) NOT NULL default '',
  `headline` varchar(255) NOT NULL default '',
  `detail` text NOT NULL,
  `posted` varchar(100) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  `update_date` varchar(50) NOT NULL default '',
  `enable_comment` tinyint(1) NOT NULL default '0',
  `pageview` int(11) NOT NULL default '0',
  `attach` varchar(100) NOT NULL,
  `pic` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=3 ;

#
# dump ตาราง `web_knowledge`
#

INSERT INTO `web_knowledge` VALUES(1, '1', 'ธุรกิจโฆษณาบนเว็บ', 'การเติบโตของจำนวนโฮมเพจมีจำนวนเพิ่มขึ้นอย่างรวดเร็ว เชื่อกันว่าในปัจจุบันมีจำนวนโฮมเพจมากเกินกว่าหนึ่งล้านโฮมเพจ โฮมเพจเหล่านี้เชื่อมโยงกันเป็นเครือข่ายข้อมูลข่าวสารที่เรารู้จักกันในนาม WWW-World Wide Web<br />\r\n', '<img alt="" height="339" src="UserFiles/Image/xxx.jpg" width="444" /><br />\r\nการเติบโตของจำนวนโฮมเพจมีจำนวนเพิ่มขึ้นอย่างรวดเร็ว เชื่อกันว่าในปัจจุบันมีจำนวนโฮมเพจมากเกินกว่าหนึ่งล้านโฮมเพจ โฮมเพจเหล่านี้เชื่อมโยงกันเป็นเครือข่ายข้อมูลข่าวสารที่เรารู้จักกันในนาม WWW-World Wide Web<br />\r\n<br />\r\nชื่อของโฮมเพจหรือที่เรียกว่า เว็บไซท์ แต่ละแห่งต้องไม่ซ้ำกัน มีการขึ้นทะเบียนชื่อ ใครจดทะเบียนชื่อได้ก่อนก็ได้ใช้ ผู้จดทะเบียน ภายหลังไม่สามารถใช้ชื่อซ้ำได้ สร้างปัญหาให้กับองค์กรบางองค์กรที่ต้องการใช้ชื่อที่สื่อความหมายกับองค์กรมากที่สุด แต่ไปซ้ำกับชื่อที่มี อยู่แล้ว หลักการตั้งชื่อยังไม่มีกฎเกณฑ์อะไรมาก เพราะชื่อเป็นการแบ่งแยกตามกลุ่ม ดูจากชื่อเว็บไซส์ของสถานีโทรทัศน์ไทยห้าแห่ง ก็มีวิธี การตั้งชื่อแตกต่างกัน <br />\r\nเว็บไซส์แต่ละแห่งที่ตั้งกันขึ้นมามีจุดมุ่งหมายทางธุรกิจที่แตกต่างกันบางแห่งเป็นเสมือนสื่อการโฆษณาประชาสัมพันธ์องค์กร บางแห่งให้ข้อมูลเกี่ยวกับผลิตภัณฑ์หรือสินค้า บางแห่งใช้เป็นสื่อสำหรับการโต้ตอบกับลูกค้า ปัจจุบันมีการใช้เว็บไซส์เป็นแหล่งโฆษณา สินค้า บางแห่งยอมให้มีการสั่งซื้อสินค้าผ่านทางเครือข่ายอินเทอร์เน็ตได้โดยตรง ธุรกิจบนเว็บจึงดูจะมีความตื่นตัว และได้รับความสนใจ มาก บริษัทหรือองค์กรทางธุรกิจทุกองค์กรจึงต้องตั้งเว็บของตนเอง มีการสร้างศิลปะบนหน้าจอภาพให้ดูสวยงามดึงดูดให้อยากเข้าไปอ่าน หรือชม บางแห่งมีวิธีการล่อด้วยการขึ้นข้อความที่เร้าใจเพื่อให้คลิกเข้าไปดู เทคนิคและวิธีการเขียนเว็บ จึงได้รับการพัฒนาอย่างรวดเร็ว มีการใช้กราฟฟิก สีสัน เสียง และภาพเคลื่อนไหวประกอบกัน หรือบางแห่งได้ให้ข้อมูลที่เป็นประโยชน์เพื่อเรียกร้องให้คนเข้ามาเปิดดู <br />\r\nเว็บของแต่ละองค์กรจึงเหมือนกับเอกสารเผยแพร่ขององค์กรที่ไม่ต้องใช้กระดาษ ข้อเด่นของเอกสารเหล่านี้คือเป็นเอกสารที่ ผลิตขึ้นมาได้ง่าย รวดเร็วในการเปลี่ยนแปลงแก้ไข เป็นเอกสารที่สามารถส่งผ่านทางเครือข่ายไปยังที่ต่าง ๆ บนเครือข่ายได้ง่าย และที่สำคัญ คือรูปแบบของเอกสารสามารถแสดงผลข้อมูลแบบมัลติมีเดีย จึงทำให้เกิดความน่าสนใจ <br />\r\nด้วยความพยายามที่จะทำธุรกิจบนเครือข่ายเว็บโดยการตั้งเป็นห้างร้านเพื่อโฆษณาขายสินค้าบางแห่งที่ขายซอฟต์แวร์มีการให้ ตัวอย่างซอฟต์แวร์ที่สามารถ์ดาวน์โหลดมาทดลองใช้ดูก่อนได้ หากพอใจค่อยสั่งซื้อ การตั้งร้านค้าขายสินค้ามีมากมายตั้งแต่การขายหนังสือ สิ่งพิมพ์ ซีดี เทป ของใช้ในบ้าน เครื่องมือเครื่องใช้ที่ใช้กับคอมพิวเตอร์ เครื่องใช้สำนักงาน ฯลฯ การสั่งซื้อสินค้ามีแม้แต่การจัดส่งสินค้า โดยตรง เช่น ร้านขายพิซซ่าไปจนถึงการส่งสินค้าทางไปรษณีย์ส่วนการจัดเก็บเงินใช้วิธีการตัดโอนทางบัตรเครดิต <br />\r\nลักษณะการทำธุรกิจบนเครือข่ายเว็บจะทำกันในรูปแบบการโต้ตอบเพื่อชี้แจง หรือให้รายละเอียดเกี่ยวกับผลิตภัณฑ์การให้คำ ปรึกษา การบริการหลังการขาย รวมถึงการรับฟังความคิดเห็นจากผู้ใช้สินค้าเพื่อนำเอาข้อมูลไปใช้ในการปรับปรุงผลิตภัณฑ์สินค้าให้ดียิ่งขึ้น <br />\r\nแต่การซื้อขายผ่านทางเครือข่ายเว็บยังไม่เป็นที่แพร่หลาย เพราะเครือข่ายเว็บยัง จำกัดอยู่ในกลุ่มคนที่ใช้อินเทอร์เน็ต ทั้งนี้เพราะ เครือข่ายเว็บเป็นเครือข่ายสาธารณะ การส่งข้อมูลเกี่ยวกับบัตรเครดิตไปในเครือข่ายมีลักษณะที่เสี่ยง เพราะรหัสเหล่านี้ถ้าตกอยู่ในมือมิจฉาชีพ อาจนำเอาไปใช้ในทางมิชอบได้ ผู้สั่งซื้อสินค้าทางเครือข่ายเว็บยังมีความรู้สึกไม่กล้าที่จะส่งหมายเลขบัตรเครดิต ส่วนร้านค้าก็ยังมีการจำกัด ปริมาณเงินในการสั่งซื้อสินค้า เช่น ในวงเงินไม่เกินหนึ่งร้อยเหรียญ เป็นต้น <br />\r\nข้อจำกัดในเรื่องความปลอดภัยของการรับส่งข้อมูลบนเครือข่ายจึงต้องได้รับการปรับปรุงแก้ไขให้ดีขึ้น บริษัทผู้ดำเนินการบัตรเครดิต ทั้งหลายเห็นปัญหาเหล่านี้ จึงร่วมมือกับบริษัทผู้พัฒนาซอฟต์แวร์บนเครือข่ายเพื่อพัฒนาลายเซ็นดิจิตอล ที่ใช้สำหรับตรวจสอบและยืนยันตัว บุคคล หากโครงการนี้สำเร็จและนำออกมาใช้ได้ หนทางของการทำธุรกิจบนเว็บจะมั่นใจและแพร่หลายได้อีกมาก <br />\r\nนอกจากเรื่องลายเซ็นอิเล็กทรอนิกส์แล้ว ยังมีเรื่องการรักษาความปลอดภัยของข้อมูล การเข้ารหัส หรือที่เรียกว่า &quot;เอ็นคริพชั่น&quot; และ การถอดรหัส การป้องกันการบุกรุกเข้าไปโจรกรรมข้อมูลบนเครือข่าย เรื่องเหล่านี้กำลังเป็นปัญหาที่รุนแรงมากขึ้น และมีแนวโน้มที่จะเกิดขึ้น ได้มาก <br />\r\nสิ่งที่น่าสนใจในเรื่องการพัฒนาเทคนิคทางเว็บอีกประการหนึ่ง คือ มีการนำเอาเว็บมาใช้ในธุรกิจสินค้ายั่วยุกามารมณ์กันมากขึ้น เพราะธุรกิจนี้ให้บริการได้กว้างไกล ผู้ใช้อยู่ที่ใดก็สามารถเรียกเข้าหาได้ มีการให้บริการกับสมาชิกโดยการเก็บเงินค้าบริการ มีการให้บริการ กับสมาชิกโดยการเก็บเงินค้าบริการ นับเป็นสิ่งที่ล่อแหลมต่อศีลธรรมและขนบธรรมเนียมอันดีงาม <br />\r\nกลุ่มผู้กำหนดมาตรฐานกลางของ WWW ที่มหาวิทยาลัย MIT แห่งสหรัฐอเมริกาจึงได้ตกลงกัน และกำลังจะพัฒนามาตรฐาน การจัดระดับเว็บเพื่อกำหนดประเภทของเว็บไซส์ต่าง ๆ และให้บราวเซอร์มีระบบการป้องกันเพื่อให้มองเห็นเว็บไซส์ในระดับต่าง ๆ กันได้ หรือจำกัดกลุ่มผู้ใช้เฉพาะสมาชิก <br />\r\nการทำธุรกิจบนเว็บจึงเป็นธุรกิจที่กว้างไกลและไร้พรมแดน ผู้ตั้งร้านขายของบนเว็บหนึ่งแห่งสามารถบริการลูกค้าได้ทั่วโลก ไม่ว่า ลูกค้าจะอยู่ที่ใดบนเครือข่ายก็สามารถเข้าถึงได้ <br />\r\nธุรกิจบริการบนเว็บจึงมีแนวโน้มที่จะได้รับความนิยมเพิ่มขึ้น สิ่งที่สำคัญคือ ต้องมีระบบรักษาความปลอดภัยในเรื่องข้อมูล และสร้าง ความเชื่อมั่นว่าการส่งเงินผ่านบัตรเครดิตจะได้รับความคุ้มครองลายเซ็นอิเล็กทรอนิกส์จึงต้องได้รับการพัฒนาต่อไป ', 'admin', '1295870012', '1295870012', 1, 51, '', '1');
INSERT INTO `web_knowledge` VALUES(2, '1', 'เมื่อใดให้ลูกเรียนคอมพิวเตอร์', 'มีคำถามมากมายเกี่ยวกับการเรียนการสอนคอมพิวเตอร์ของเด็กพรั่งพรูเข้ามาในระยะนี้ ซึ่งคงมีอยู่ในใจของผู้อ่านจำนวนมาก โดยเฉพาะในยุคเทคโนโลยีสารสนเทศ ยุคการศึกษาแบบไร้พรมแดน ที่มีบทบาทเข้ามาเกี่ยวข้องอยู่มาก จนเกิดความลังเลใจว่า เราจะให้ลูก ได้เริ่มเรียนคอมพิวเ', '<img alt="" height="300" src="UserFiles/Image/kid.jpg" width="474" /><br />\r\nมีคำถามมากมายเกี่ยวกับการเรียนการสอนคอมพิวเตอร์ของเด็กพรั่งพรูเข้ามาในระยะนี้ ซึ่งคงมีอยู่ในใจของผู้อ่านจำนวนมาก โดยเฉพาะในยุคเทคโนโลยีสารสนเทศ ยุคการศึกษาแบบไร้พรมแดน ที่มีบทบาทเข้ามาเกี่ยวข้องอยู่มาก จนเกิดความลังเลใจว่า เราจะให้ลูก ได้เริ่มเรียนคอมพิวเตอร์เมื่อใดดี จากหลักปรัชญาแห่งการศึกษาที่สำคัญคือ การจัดการศึกษาให้เหมาะสมกับผู้เรียน ทั้งสภาพความพร้อมและสิ่งแวดล้อม จะต้องเอื้ออำนวยต่อการเรียนรู้ การจัดการศึกษาทั้งที่บ้านและที่โรงเรียน จึงต้องเปลี่ยนแปลงไปตามสภาพกาลเวลา <br />\r\nประเด็นอยู่ที่ว่า การนำความรู้ทางด้านคอมพิวเตอร์ให้กับเด็กและเยาวชนของชาติต้องคำนึงถึง สภาพความเหมาะสมต่อการเรียนรู้ การสอนคอมพิวเตอร์ให้กับเด็กจึงกระทำได้ทุกระดับอายุ ขึ้นอยู่กับการนำเนื้อหาใดไปสอน ซึ่งต้องเหมาะสมกับสภาพการรับรู้ <br />\r\nในวัยประถม เด็กเป็นผู้ใฝ่หาและอยากเรียนรู้ มีสภาพการเรียนรู้ที่ค่อนข้างจะรวดเร็ว หากจัดการศึกษาที่เหมาะสม เด็กจะเรียนรู้และเข้าใจในบางสิ่งบางอย่างได้รวดเร็ว ตรงกันข้าม หากนำสิ่งที่ยุ่งยากและซับซ้อนมาสอนเด็กในวัยต้นนี้ เด็กจะปฏิเสธและมีความ ฝังใจว่าสิ่งนั้นเป็นสิ่งยุ่งยาก และจะไม่ยอมรับอีกต่อไป <br />\r\nการให้เด็กได้เรียนคอมพิวเตอร์ในวัยเด็กจึงเสมือนดาบสองคม ที่อาจส่งผลในเชิงบวกหรือลบก็ได้ ผลที่เกิดขึ้นจึงอยู่ที่การจัดการ ศึกษาเป็นสำคัญ สภาพของผู้สอนที่เข้าใจวุฒิภาวะและความต้องการของเด็กเป็นสิ่งที่ต้องระวัง สิ่งใดที่ให้คุณแต่หากใช้ไม่ถูกต้องก็ย่อม ให้โทษได้เช่นกัน <br />\r\nการเรียนคอมพิวเตอร์ในประถมวัยนี้ เป็นเรื่องของความสนุกสนาน ความท้าทายในการค้นหาความจริง ความเพลิดเพลิน เพื่อ เตรียมความพร้อมที่จะไปศึกษาในโอกาสต่อไป การสอนในวัยนี้ จะต้องเน้นสร้างความพึงพอใจเป็นสิ่งง่าย ๆ ที่แฝงด้วยหลักการและ วิธีการคิดเพื่อเสริมสร้างสติปัญญา <br />\r\nครูผู้สอนคอมพิวเตอร์ในวัยประถมก็มีความสำคัญ ต้องเข้าใจในตัวเด็กเป็นอย่างดี เด็กอาจจะสนุกสนานกับการเล่นเกม สนุกสนาน กับการวาดภาพ การแสดงออกซึ่งความคิดริเริ่มต่าง ๆ ดังนั้นการสร้างบรรยากาศโดยใช้คอมพิวเตอร์เป็นเรื่องที่กระทำได้และกระทำได้ดีด้วย <br />\r\nคอมพิวเตอร์จะช่วยสร้างสรรค์เด็กในเรื่องความคิดริเริ่ม เด็กสามารถจินตนาการต่าง ๆ และแสดงออกบนจอภาพได้ สามารถใช้ ลำดับความคิดอย่างเป็นระบบ เพื่อให้คอมพิวเตอร์แสดงในสิ่งที่ตนเองต้องการ และยังสร้างความคิดอย่างมีเหตุมีผลมีความรอบคอบ ในสิ่งที่ตนเองทำ การเรียนคอมพิวเตอร์จึงทำให้เกิดการสร้างสรรค์ใฝ่หาและกระตือรือร้นในการค้นหาสิ่งแปลกใหม่ <br />\r\nจากประสบการณ์ทางด้านการศึกษาและงานวิจัยของนักการศึกษาชื่อดัง &quot;เซมอร์ พาเพิร์ด&quot; (Seymour Papert) ศาสตราจารย์แห่ง มหาวิทยาลัย MII ได้เน้นให้เห็นว่า เด็กจำนวนมากในประถมวัยนี้ ได้รับการสอนโดยเฉพาะการสอนคณิตศาสตร์ที่ผิด ทำให้เด็กเหล่านี้ เป็นโรค Mathophobia (โรคกลัวคณิตศาสตร์) และจะไม่ชอบคณิตศาสตร์ไปตลอดชีวิต การที่เด็กไม่ชอบคณิตศาสตร์ เพราะครูผู้สอน สร้างความรู้สึกยุ่งยากซับซ้อนให้กับเด็ก จึงส่งผลเสียให้เด็กฝังใจในสิ่งนั้นไปตลอด <br />\r\nเซมอร์ พาเพิร์ด ได้เขียนหนังสือเกี่ยวกับเรื่องนี้ไว้หลายเล่ม และยังได้พัฒนาการใช้คอมพิวเตอร์สอนเด็ก ในระดับประถมวัยด้วย สิ่งที่เขาให้ความสำคัญคือการสอนแบบมีรูปแบบ สร้างสิ่งที่เป็นความยุ่งยากซับซ้อนอย่างคณิตศาสตร์ให้เป็นสิ่งง่ายสนุกสนานโดยใช้ คอมพิวเตอร์เข้ามามีบทบาท พาเพิร์ดได้พัฒนาภาษาโลโกซึ่งเป็นการใช้คำสั่งสั่งเต่าให้เดินเป็นรูปร่างต่าง ๆ เป็นการเขียนรูปตาม จินตนาการเน้นให้เห็นว่า การเรียนเรขาคณิตเป็นเรื่องสนุกสนานได้ <br />\r\nในวัยประถม การจัดการศึกษาคอมพิวเตอร์ย่อมเป็นไปได้ แต่ต้องให้มีสภาพเหมาะสมกับวัย เน้นความพึงพอใจ ความสนุกสนาน ความเพลิดเพลิน เพื่อแรงกระตุ้นให้เกิดการเรียนรู้และเตรียมพร้อมสำหรับการศึกษาในขั้นสูงต่อไป ครูผู้สอนจะต้องมีความพร้อมทั้ง ในเรื่องคอมพิวเตอร์เอง และดัดแปลงวิธีการสอนให้เหมาะสมกับเด็ก <br />\r\nสำหรับวัยมัธยมศึกษา การจัดการศึกษาย่อมแตกต่างออกไป ในวัยนี้นักเรียนมีความพร้อมในเรื่องของฐานความรู้หลายอย่าง การจัดการศึกษาทางด้านคอมพิวเตอร์จึงมีส่วนเสริมให้ขบวนการสร้างสรรค์ปัญญาเต็มรูปแบบได้ <br />\r\nสิ่งที่สำคัญในการศึกษาวันนี้คือ อย่าเน้นในเรื่องวิชาชีพ แต่พยายามเน้นความพร้อมของเยาวชนในเรื่องการเรียนรู้ เน้นให้เห็นว่า คอมพิวเตอร์เป็นเครื่องมือที่จะเข้ามาสู่กระบวนการสร้างสรรค์ต่าง ๆ ได้มากมาย องค์ประกอบแห่งการเรียนรู้ในวัยนี้ จึงเน้นที่ต้องการ สร้างความคิดอย่างเป็นระบบ สร้างความคิดริเริ่มและให้เหตุผลแห่งการมองแบบตรรกศาสตร์ ด้วยความพร้อมที่จะนำคอมพิวเตอร์ ไปประยุกต์ใช้ประโยชน์กับงานด้านต่าง ๆ <br />\r\nการศึกษาคอมพิวเตอร์สำหรับเด็กและเยาวชนจึงสำคัญอยู่ที่ครูผู้สอน ครูผู้สอนต้องจัดการสร้างขบวนการเรียนรู้ตามความเหมาะสม ไม่นำสิ่งที่เป็นความยุ่งยากซับซ้อน ขบวนการสอนเด็กให้เป็นนักคอมพิวเตอร์ แต่เราต้องการให้เด็กมีความพร้อมที่จะใช้คอมพิวเตอร์ เพื่อประกอบการเรียนและอาชีพต่อไปภายภาคหน้า <br />\r\nเทคโนโลยีคอมพิวเตอร์กำลังมีบทบาทที่สำคัญ โดยเฉพาะสิ่งแวดล้อมมีส่วนเป็นแรงกระตุ้นมาก ในเด็กประถมวัยก็มีวิดีโอเทป เป็นสิ่งยั่วยุ ในเด็กวัยมัธยมศึกษาหรือเยาวชนก็มีสื่อที่ท้าทาย เช่น อินเทอร์เน็ตเป็นตัวกระตุ้น วัยแสวงหานี้จึงเป็นวัยที่อันตรายหาก จัดการทิศทางของการเรียนรู้ไม่ถูกต้อง จึงต้องให้ความสำคัญกับเด็กและเยาวชนมากขึ้น โดยจัดสิ่งแวดล้อมให้เหมาะสมกับการเรียนรู้ คอมพิวเตอร์ อย่าให้คอมพิวเตอร์เป็นเครื่องทำลายโดยที่ผู้ปกครองอาจไม่รู้ตัว ', 'admin', '1295870146', '1295870146', 1, 50, '', '1');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_knowledge_category`
#

CREATE TABLE `web_knowledge_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(255) NOT NULL default '',
  `sort` int(11) NOT NULL default '0',
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2  ;

#
# dump ตาราง `web_knowledge_category`
#

INSERT INTO `web_knowledge_category` VALUES (1, 'บทความทางวิชาการ', 1, 'Configure.png');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_knowledge_comment`
#

CREATE TABLE `web_knowledge_comment` (
  `id` int(7) NOT NULL auto_increment,
  `knowledge_id` int(7) default '0',
  `name` varchar(100) NOT NULL default '',
  `comment` text NOT NULL,
  `ip` varchar(50) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `knowledge_id` (`knowledge_id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;

#
# dump ตาราง `web_knowledge_comment`
#


# --------------------------------------------------------

#
# โครงสร้างตาราง `web_mail`
#

CREATE TABLE `web_mail` (
  `id` int(7) NOT NULL auto_increment,
  `subject` varchar(120) NOT NULL default '',
  `detail` longtext NOT NULL,
  `form_mail` varchar(120) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2  ;

#
# dump ตาราง `web_mail`
#

INSERT INTO `web_mail` VALUES (1, 'สุขสันต์วันเกิด', 'สุขสันต์วันเกิด ขอให้มีความสุขมากๆ นะครับผม จาก maxtom.sytes.net', 'vt9vm@hotmail.com');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_member`
#

CREATE TABLE `web_member` (
  `id` int(6) NOT NULL auto_increment,
  `member_id` varchar(20) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `nic_name` varchar(20) NOT NULL,
  `date` int(2) NOT NULL default '0',
  `month` int(2) NOT NULL default '0',
  `year` varchar(4) NOT NULL default '',
  `age` varchar(10) NOT NULL default '',
  `sex` varchar(8) NOT NULL default '',
  `address` varchar(150) NOT NULL default '',
  `amper` varchar(40) NOT NULL default '',
  `province` varchar(40) NOT NULL default '',
  `zipcode` varchar(15) NOT NULL default '',
  `phone` varchar(10) NOT NULL default '',
  `education` varchar(30) NOT NULL default '',
  `work` varchar(30) NOT NULL default '',
  `office` varchar(200) NOT NULL,
  `user` varchar(30) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `email` varchar(40) NOT NULL default '',
  `member_pic` varchar(50) NOT NULL,
  `signup` varchar(40) NOT NULL default '',
  `lastlog` varchar(28) NOT NULL,
  `dtnow` varchar(28) NOT NULL,
  `blog` varchar(5) default NULL,
  `post` int(6) NOT NULL,
  `topic` int(6) NOT NULL,
  `signature` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2  ;

#
# dump ตาราง `web_member`
#

INSERT INTO `web_member` VALUES (1, 'web1', 'นายชัดสกร พิกุลทอง', '', 23, 3, '2516', '36', 'ชาย', '152 หมู่ 2 ต.หนองครก', 'เมือง', 'ศรีสะเกษ', '33000', '0899469997', 'ปริญญาโท', 'ครู/อาจารย์', 'โรงเรียนเขวาไร่ศึกษา', 'admin', 'f0cc68da195d9d620b6cfe05f6f07a62', 'vt9vm@hotmail.com', 'admin_1291354356_adm-04.jpg', '30/11/2552', '14/06/10 - 20:41', '23/06/10 - 17:45', '1', 0, 1, '<img src="icon/sigtom.jpg">');
# --------------------------------------------------------

CREATE TABLE `web_menu` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(150) NOT NULL,
  `icon` varchar(150) NOT NULL,
  `link` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=26 ;

-- 
-- dump ตาราง `web_menu`
-- 

INSERT INTO `web_menu` VALUES (1, 'การตั้งค่า config', '19.png', '?name=admin&file=config');
INSERT INTO `web_menu` VALUES (2, 'ผู้ดูแลระบบ', 'chart.png', '?name=admin&file=user');
INSERT INTO `web_menu` VALUES (3, 'สมาชิก', '8.png', '?name=admin&file=member');
INSERT INTO `web_menu` VALUES (4, 'Filemanager', '20.png', '?name=admin&file=filemanager');
INSERT INTO `web_menu` VALUES (5, 'Block', '16.png', '?name=admin&file=block');
INSERT INTO `web_menu` VALUES (6, 'Editor Talk', '1.png', '?name=admin&file=editortalk');
INSERT INTO `web_menu` VALUES (7, 'Aboutus', '14.png', '?name=admin&file=aboutus');
INSERT INTO `web_menu` VALUES (8, 'ข่าวประชาสัมพันธ์', '2.png', '?name=admin&file=news');
INSERT INTO `web_menu` VALUES (9, 'สาระความรู้', '5.png', '?name=admin&file=knowledge');
INSERT INTO `web_menu` VALUES (10, 'ดาวน์โหลด', '9.png', '?name=admin&file=download');
INSERT INTO `web_menu` VALUES (11, 'Blog', '14.png', '?name=admin&file=blog');
INSERT INTO `web_menu` VALUES (12, 'ทำเนียบบุคลากร', '10.png', '?name=admin&file=personnel');
INSERT INTO `web_menu` VALUES (13, 'ผลงานทางวิชาการ', '3.png', '?name=admin&file=research');
INSERT INTO `web_menu` VALUES (14, 'Gallery', '12.png', '?name=admin&file=gallery');
INSERT INTO `web_menu` VALUES (15, 'ศิษย์เก่า', '11.png', '?name=admin&file=alumnus');
INSERT INTO `web_menu` VALUES (16, 'Webboard', 'history.png', '?name=admin&file=webboard');
INSERT INTO `web_menu` VALUES (17, 'สมุดเยี่ยม', 'users.png', '?name=admin&file=gbook');
INSERT INTO `web_menu` VALUES (18, 'ปฏิทินกิจกรรม', '4.png', '?name=admin&file=calendar');
INSERT INTO `web_menu` VALUES (19, 'ฝากข้อความ', '18.png', '?name=admin&file=smiletag');
INSERT INTO `web_menu` VALUES (20, 'สุ่มรูปภาพ', '13.png', '?name=admin&file=uploads');
INSERT INTO `web_menu` VALUES (21, 'Poll', 'plugin.png', '?name=admin&file=poll');
INSERT INTO `web_menu` VALUES (22, 'โครงการ', '17.png', '?name=admin/workboard&file=index&op=WorkBoardIndex');
INSERT INTO `web_menu` VALUES (23, 'รายการเมนู', '7.png', '?name=admin&file=page');
INSERT INTO `web_menu` VALUES (24, 'Backup', 'history.png', '?name=admin&file=backupindex');
INSERT INTO `web_menu` VALUES (25, 'ออกจากระบบ', '21.png', '?name=admin&file=logout');


#
# โครงสร้างตาราง `web_news`
#

CREATE TABLE `web_news` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(10) NOT NULL default '',
  `topic` varchar(255) NOT NULL default '',
  `headline` varchar(255) NOT NULL default '',
  `detail` text NOT NULL,
  `posted` varchar(100) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  `update_date` varchar(50) NOT NULL default '',
  `enable_comment` tinyint(1) NOT NULL default '0',
  `pageview` int(11) NOT NULL default '0',
  `attach` varchar(100) NOT NULL,
  `pic` int(1) default NULL,
  `ran` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=6  ;

#
# dump ตาราง `web_news`
#

INSERT INTO `web_news` VALUES(1, '2', 'วันต่อต้านยาเสพติด 2554', 'ประเทศไทย&nbsp; ในการประชุมเมื่อวันที่ 14 มิถุนายน 2531 ซึ่งที่ประชุมคณะรัฐมนตรีได้มีมติให้กำหนดวันที่ 26 มิถุนายน ของทุกปี เป็นวันต่อต้านยาเสพติดโดยเริ่มตั้งแต่ปี พ.ศ. 2531เป็นต้นมา', '<img align="left" alt="" height="150" src="UserFiles/Image/PIC_3836.jpg" width="200" />ประเทศไทย&nbsp; ในการประชุมเมื่อวันที่ 14 มิถุนายน 2531 ซึ่งที่ประชุมคณะรัฐมนตรีได้มีมติให้กำหนดวันที่ 26 มิถุนายน ของทุกปี เป็นวันต่อต้านยาเสพติดโดยเริ่มตั้งแต่ปี พ.ศ. 2531เป็นต้นมา<br />\r\n<br />\r\nรูปภาพเพิ่มเติม<br />\r\n<a href="http://banphue.sytes.net/?name=gallery&amp;op=gallery_detail&amp;id=12">http://banphue.sytes.net/&shy;name=gallery&amp;op=gallery_detail&amp;id=12</a>&nbsp;', 'admin', '1309600387', '1309600387', 1, 9, '', 1,0);
INSERT INTO `web_news` VALUES(2, '2', 'รณรงค์เลือกตั้ง ส.ส. 3 ก.ค.2554', 'การเลือกตั้ง ส.ส.ที่จะมีขึ้น&nbsp; ในวันที่ 3 กรกฎาคม 2554 จำนวนสมาชิกสภาผู้แทนราษฎร ทั้งประเทศรวม 500 คน แบ่งเป็น ส.ส. แบบแบ่งเขตเลือกตั้งจำนวน 375 คน และ ส.ส.แบบบัญชีรายชื่อจำนวน 125 คน&nbsp;&nbsp;โรงเรียนจัดการรณรงค์ขั้นในวันที่ 26 มิถุนายน 2554', '<img align="left" alt="" height="150" src="UserFiles/Image/P6230724.jpg" width="200" />การเลือกตั้ง ส.ส.ที่จะมีขึ้น&nbsp; ในวันที่ 3 กรกฎาคม 2554 นับเป็นการเลือกตั้ง ส.ส.ครั้งแรกภายหลังจากการประกาศใช้รัฐธรรมนูญแห่งราชอาณาจักรไทย แก้ไขเพิ่มเติม (ฉบับที่ 1)พุทธศักราช 2554 ซึ่งมีการแก้ไขเพิ่มเติมบทบัญญัติในส่วน&nbsp;&nbsp;&nbsp; ที่เกี่ยวข้องกับจำนวนสมาชิกสภาผู้แทนราษฎร ทั้งประเทศรวม 500 คน แบ่งเป็น ส.ส. แบบแบ่งเขตเลือกตั้งจำนวน 375 คน และ ส.ส.แบบบัญชีรายชื่อจำนวน 125 คน โดยมีเจตนารมณ์ที่คำนึงถึงสิทธิและความเสมอภาคในการเลือกตั้ง ไม่ว่าจะอยู่ในภูมิลำเนาใด พื้นที่ใด&nbsp; &nbsp;&nbsp;เขตใด ก็จะมีสิทธิที่เท่าเทียมกันในการไปใช้สิทธิเลือก ส.ส. จึงกำหนดให้ผู้มีสิทธิเลือกตั้งทุกคนทุกเขตเลือกตั้ง เลือกส.ส.แบบแบ่งเขตเลือกตั้งและแบบบัญชีรายชื่อได้อย่างละหนึ่งหมายเลขอย่างเท่าเทียมกันทั่วประเทศ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โรงเรียนจัดการรณรงค์ขั้นในวันที่ 26 มิถุนายน 2554&nbsp;&nbsp; <br />\r\n<br />\r\nรูปภาพเพิ่มเติม<br />\r\n<a href="http://banphue.sytes.net/?name=gallery&amp;op=gallery_detail&amp;id=13">http://banphue.sytes.net/&shy;name=gallery&amp;op=gallery_detail&amp;id=13</a>&nbsp;', 'admin', '1309601125', '1309601125', 1, 14, '', 1,0);
INSERT INTO `web_news` VALUES(3, '2', 'ร่วมกิจกรรมวันคล้ายวันสถาปนาคณะลูกเสือแห่งชาติ', 'กองลูกเสือโรงเรียนสามัญ โรงเรียนบ้านผือได้ร่วมกิจกรรมวันคล้ายวันสถาปนาคณะลูกเสือแห่งชาติ วันที่ 1 กรกฏาคม 2554 ณ ค่ายลูกเสือชั่วคราวโรงเรียนเชียงยืนพิทยาคม อ.ชื่นชม จ.มหาสารคาม', '<img align="left" alt="" height="150" src="UserFiles/Image/P6270821.jpg" width="200" />กองลูกเสือโรงเรียนสามัญ โรงเรียนบ้านผือได้ร่วมกิจกรรมวันคล้ายวันสถาปนาคณะลูกเสือแห่งชาติ วันที่ 1 กรกฏาคม 2554 ณ ค่ายลูกเสือชั่วคราวโรงเรียนเชียงยืนพิทยาคม อ.ชื่นชม จ.มหาสารคาม ซึ่งกิจกรรม มีพิธีสดุดีล้นเกล้ารัชกาลที่ 6 ผู้ให้กำเนิดลูกเสือไทย มีการเดินสวนสนาม และบำเพ็ญประโยชน์<br />\r\nรูปภาพเพิ่มเติมที่<br />\r\n<a href="http://banphue.sytes.net/index.php?name=gallery&amp;op=gallery_detail&amp;id=15">http://banphue.sytes.net/index.php&shy;name=gallery&amp;op=gallery_detail&amp;id=15</a>&nbsp;<br />\r\n', 'admin', '1310038120', '1310038120', 1, 15, '', 1,0);
INSERT INTO `web_news` VALUES(4, '2', 'เข้าค่ายภาษาอังกฤษ', 'โดยความร่วมมือระหว่างโรงเรียนบ้านผือ โรงเรียนบ้านจานโนนสูง โรงเรียนบ้านโคกข่า และคณะมนุษยศาสตร์และสังคมศาสตร์ มหาวิทยาลัยมหาสารคาม ได้จัดทำโครงการเข้าค่ายภาษาอังกฤษขึ้น ในวันที่ 9 กรกฎาคม 2554 ณ หอประชุมโรงเรียนบ้านจานโนนสูง<br />\r\n', '<img align="left" alt="" height="150" src="UserFiles/Image/S4204327a.jpg" width="200" />โดยความร่วมมือระหว่างโรงเรียนบ้านผือ โรงเรียนบ้านจานโนนสูง โรงเรียนบ้านโคกข่า และคณะมนุษยศาสตร์และสังคมศาสตร์ มหาวิทยาลัยมหาสารคาม ได้จัดทำโครงการเข้าค่ายภาษาอังกฤษขึ้น ในวันที่ 9 กรกฎาคม 2554 ณ หอประชุมโรงเรียนบ้านจานโนนสูง<br />\r\n', 'admin', '1310216972', '1310216972', 1, 15, '', 1,0);
INSERT INTO `web_news` VALUES(5, '2', 'ทำบุญเนื่องในโอกาสวันอาสาฬหบูชาและเข้าพรรษา', 'ครู นักเรียนได้ร่วมกันถวายเทียนพรรษา ถวายสังฑทาน บำเพ็ญประโยชน์โดยการทำความสะอาดวัดบ้านผือ เนื่องในโอกาสวันอาสาฬหบูชาและวันเข้าพรรษา ในวันที่ 14 กรกฎาคม 2554<br />\r\n', 'ครู นักเรียนได้ร่วมกันถวายเทียนพรรษา ถวายสังฑทาน บำเพ็ญประโยชน์โดยการทำความสะอาดวัดบ้านผือ เนื่องในโอกาสวันอาสาฬหบูชาและวันเข้าพรรษา ในวันที่ 14 กรกฎาคม 2554<br />\r\n<br />\r\nดูภาพเพิ่มเติมได้ที่<br />\r\n<a href="http://banphue.sytes.net/index.php?name=gallery&amp;op=gallery_detail&amp;id=17">http://banphue.sytes.net/index.php&shy;name=gallery&amp;op=gallery_detail&amp;id=17</a>&nbsp;<br />\r\n', 'admin', '1310842320', '1310842320', 1, 16, '', 1,0);

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_news_category`
#

CREATE TABLE `web_news_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(255) NOT NULL default '',
  `sort` int(11) NOT NULL default '0',
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4  ;

#
# dump ตาราง `web_news_category`
#

INSERT INTO `web_news_category` VALUES (1, 'ข่าวประชาสัมพันธ์', 1, 'Doc.png');
INSERT INTO `web_news_category` VALUES (2, 'ข่าวสารทั่วไป', 2, 'Apps.png');
INSERT INTO `web_news_category` VALUES (3, 'การฝึกอบรม/ศึกษาดูงาน', 3, 'Picture.png');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_news_comment`
#

CREATE TABLE `web_news_comment` (
  `id` int(7) NOT NULL auto_increment,
  `news_id` int(7) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `comment` text NOT NULL,
  `ip` varchar(50) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

#
# dump ตาราง `web_news_comment`
#

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_page`
#

CREATE TABLE `web_page` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `menuname` varchar(50) NOT NULL,
  `detail` text,
  `menugr` varchar(50) default NULL,
  `status` int(1) default '1',
  `sort` int(5) default '1',
  `proto` varchar(50) NOT NULL,
  `links` varchar(150) default NULL,
  `target` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16  ;

#
# dump ตาราง `web_page`
#

INSERT INTO `web_page` VALUES (1, 'personnel', 'ทำเนียบบุคลากร', NULL, 'mainmenu', 1, 5, '', 'index.php?name=personnel&file=detail', '_top');
INSERT INTO `web_page` VALUES (2, 'gallery', 'ประมวลภาพกิจกรรม', NULL, 'mainmenu', 1, 6, '', 'index.php?name=gallery', '_top');
INSERT INTO `web_page` VALUES (3, 'gbook', 'สมุดเยี่ยม', NULL, 'mainmenu', 1, 7, '', 'index.php?name=gbook', '_top');
INSERT INTO `web_page` VALUES (4, 'calendar', 'ปฏิทินกิจกรรม', NULL, 'mainmenu', 1, 8, '', 'index.php?name=calendar', '_top');
INSERT INTO `web_page` VALUES (5, 'news', 'ข่าวสาร/ประชาสัมพันธ์', NULL, 'mainmenu', 1, 9, '', 'index.php?name=news', '_top');
INSERT INTO `web_page` VALUES (6, 'knowledge', 'สาระความรู้', NULL, 'mainmenu', 1, 10, '', 'index.php?name=knowledge', '_top');
INSERT INTO `web_page` VALUES (7, 'workboard', 'โครงการ/งาน', NULL, 'mainmenu', 1, 11, '', 'index.php?name=workboard', '_top');
INSERT INTO `web_page` VALUES (8, 'webboard', 'กระดานข่าว', NULL, 'mainmenu', 1, 12, '', 'index.php?name=webboard', '_top');
INSERT INTO `web_page` VALUES (9, 'Downloads', 'ดาวน์โหลด', NULL, 'mainmenu', 1, 13, '', 'index.php?name=download', '_top');
INSERT INTO `web_page` VALUES (10, 'research', 'ผลงานทางวิชาการ', NULL, 'mainmenu', 1, 14, '', 'index.php?name=research', '_top');
INSERT INTO `web_page` VALUES (11, 'alumnus', 'สมาคมศิษย์เก่า', NULL, 'mainmenu', 1, 15, '', 'index.php?name=alumnus', '_top');
INSERT INTO `web_page` VALUES (12, 'ติดต่อเรา', 'contact', NULL, 'mainmenu', 1, 16, '', 'index.php?name=contact', '_top');
INSERT INTO `web_page` VALUES (13, 'Blog', 'blog', NULL, 'mainmenu', 1, 17, '', 'index.php?name=blog', '_top');
INSERT INTO `web_page` VALUES (14, 'ที่ตั้งโรงเรียน', 'ที่ตั้งโรงเรียน', '<p style="text-align: center">\r\n	<span style="font-size: 16px"><strong>ที่ตั้งโรงเรียน<br />\r\n	</strong></span></p>\r\n<center>\r\n	<iframe frameborder="0" height="450" marginheight="0" marginwidth="0" scrolling="no" src="http://maps.google.co.th/maps/ms?hl=th&amp;ie=UTF8&amp;msa=0&amp;msid=112899538573060308323.000496a7e9ada6b8025a5&amp;t=h&amp;ll=16.499659,103.106024&amp;spn=0.004598,0.00589&amp;z=17&amp;output=embed" width="550"></iframe><br />\r\n	<small>ดู <a href="http://maps.google.co.th/maps/ms?hl=th&amp;ie=UTF8&amp;msa=0&amp;msid=112899538573060308323.000496a7e9ada6b8025a5&amp;t=h&amp;ll=16.499659,103.106024&amp;spn=0.004598,0.00589&amp;z=17&amp;source=embed" style="text-align: left; color: #0000ff">โรงเรียนบ้านผือ</a> ในแผนที่ขนาดใหญ่กว่า</small></center>\r\n', 'mainmenu', 1, 3, '', NULL, '');
INSERT INTO `web_page` VALUES (15, 'ประวัติโรงเรียน', 'ประวัติโรงเรียน', '<p>\r\n	&nbsp;</p>\r\n<center>\r\n	<span style="font-size: 16px"><strong>ประวัติโรงเรียน</strong></span></center>\r\n<p>\r\n	<span style="font-size: 16px">โรงเรียนบ้านผือ&nbsp;&nbsp; ตั้งอยู่หมู่ที่&nbsp; 7&nbsp; ตำบลหนองกุง&nbsp; อำเภอชื่นชม&nbsp; จังหวัดมหาสารคาม&nbsp; ตั้งขึ้นเมื่อ&nbsp;&nbsp; พ.ศ.&nbsp; 2496&nbsp;&nbsp; โดย&nbsp; นายอำเภอเป็นผู้จัดตั้ง&nbsp; ด้วยงบประมาณของกระทรวงศึกษาธิการ&nbsp; ซึ่งมีนายบุญช่วย&nbsp; แสงไกร&nbsp; เป็นครูใหญ่คนแรก&nbsp; โดยใช้ศาลาวัดโพธิ์ศรีบ้านผือเป็นสถานศึกษา&nbsp;&nbsp; ต่อมาเมื่อวันที่&nbsp; 20&nbsp; กรกฎาคม&nbsp;&nbsp;&nbsp; 2516&nbsp;&nbsp; นายบุญทัน&nbsp;&nbsp; ศรีแพงเลิศ&nbsp; ผู้ใหญ่บ้านพร้อมดร้อมด้วยคณะกรรมการหมู่บ้านได้มอบที่ดินเพื่อใช้เป็นสถานที่ก่อตั้งโรงเรียน&nbsp; ทางราชการได้ใช้งบประมาณเพื่อก่อสร้างอาคารเรียนขึ้นและย้ายนักเรียนจากศาลาวัดโพธิ์ศรีบ้านผือมาที่โรงเรียนแห่งนี้จนถึงปัจจุบัน&nbsp; <br />\r\n	<br />\r\n	&nbsp;ปัจจุบันโรงเรียนบ้านผือ&nbsp;&nbsp; เปิดเรียนตั้งแต่ระดับชั้นอนุบาลจนถึงชั้นประถมศึกษาปีที่&nbsp; 6&nbsp; มีข้าราชการครูทั้งหมด&nbsp;&nbsp;8&nbsp; คน&nbsp; ครูอัตราจ้าง&nbsp; 1&nbsp; คน&nbsp; พนักงานบริการ&nbsp;&nbsp; 1&nbsp; คน&nbsp;&nbsp; นักเรียน&nbsp; 139&nbsp; คน&nbsp; มีนายชัดสกร พิกุลทอง&nbsp; เป็นผู้อำนวยการโรงเรียน<br />\r\n	<br />\r\n	</span></p>\r\n<p style="text-align: center">\r\n	<span style="font-size: 16px"><span style="color: #00f"><span style="font-size: 16px"><strong>คำขวัญขงโรงเรียน<br />\r\n	</strong></span></span></span></p>\r\n<p>\r\n	<span style="font-size: 16px">&nbsp;</span></p>\r\n<p style="text-align: center">\r\n	<span style="font-size: 16px"><span style="font-size: 16px">วิชาการเด่น<br />\r\n	เน้นจริยธรรม&nbsp; นำกีฬา<br />\r\n	พัฒนาชุมชน</span></span></p>\r\n<p style="text-align: center">\r\n	<span style="font-size: 16px"><span style="font-size: 16px"><br />\r\n	<strong><span style="color: #00f">ปรัชญาของโรงเรียน<br />\r\n	</span></strong></span><br />\r\n	&ldquo; ความสำเร็จของศิษย์&nbsp; คือ&nbsp; ความภูมิใจของครู &ldquo;</span></p>\r\n<p style="text-align: center">\r\n	<span style="font-size: 16px"><span style="font-size: 16px">&nbsp;</span></span></p>\r\n<p style="text-align: center">\r\n	<span style="font-size: 16px"><span style="font-size: 16px"><span style="color: #00f"><strong>สีประจำโรงเรียน<br />\r\n	</strong></span><br />\r\n	&ldquo; ขาว &ndash; น้ำเงิน &rdquo;<br />\r\n	</span></span></p>\r\n', 'mainmenu', 1, 4, '', NULL, '');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_personnel`
#

CREATE TABLE  `web_personnel` (
  `id` int(5) NOT NULL auto_increment,
  `p_name` varchar(50) NOT NULL,
  `p_position` varchar(100) NOT NULL,
  `p_data` varchar(100) NOT NULL,
  `p_add` varchar(100) NOT NULL,
  `p_tel` varchar(10) NOT NULL,
  `p_mail` varchar(30) NOT NULL,
  `p_pic` varchar(50) NOT NULL,
  `sort` int(2) NOT NULL,
  `boss` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=3 ;

--
-- dump ตาราง `web_personnel`
--

INSERT INTO `web_personnel` VALUES(1, 'นายชัดสกร พิกุลทอง', 'ผู้อำนวยการโรงเรียน', 'บริหารสถานศึกษา', '152 หมู่ 2 ต.หนองครก อ.เมือง จ.ศรีสะเกษ', '0899469997', 'vt9vm@hotmail.com', '1291602651_admin.jpg', 1, 1);
INSERT INTO `web_personnel` VALUES(2, 'นายบุญถม  ชิณช้าง', 'ครูชำนาญการพิเศษ', 'ผู้ช่วยผู้อำนวยการ', '', '', '', '1291900553_boontom.jpg', 4, 0);

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_personnel_group`
#

CREATE TABLE `web_personnel_group` (
  `gp_id` tinyint(2) NOT NULL auto_increment,
  `gp_name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `sort` int(2) NOT NULL,
  PRIMARY KEY  (`gp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6  ;

#
# dump ตาราง `web_personnel_group`
#

INSERT INTO `web_personnel_group` VALUES (1, 'ฝ่ายบริหาร', 'ฝ่ายบริหาร', 1);
INSERT INTO `web_personnel_group` VALUES (2, 'กลุ่มบริหารงานวิชาการ', 'กลุ่มบริหารงานวิชาการ', 2);
INSERT INTO `web_personnel_group` VALUES (3, 'กลุ่มบริหารงานบุคคล', 'กลุ่มบริหารงานบุคคล', 3);
INSERT INTO `web_personnel_group` VALUES (4, 'กลุ่มบริหารงานงบประมาณ', 'กลุ่มบริหารงานงบประมาณ', 4);
INSERT INTO `web_personnel_group` VALUES (5, 'กลุ่มบริหารงานทั่วไป', 'กลุ่มบริหารงานทั่วไป', 5);

# --------------------------------------------------------
#
# โครงสร้างตาราง `web_personnel_group`
#
CREATE TABLE `web_personnel_list` (
  `id` int(5) NOT NULL auto_increment,
  `g_id` int(5) NOT NULL,
  `u_id` int(5) NOT NULL,
  `p_order` int(5) NOT NULL,
  `p_detail` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `g_id` (`g_id`,`u_id`)
) ENGINE=MyISAM   AUTO_INCREMENT=3 ;

#
# dump ตาราง `web_personnel_list`
#

INSERT INTO `web_personnel_list` VALUES(1, 1, 1, 1, 'บริหารสถานศึกษา');
INSERT INTO `web_personnel_list` VALUES(2, 1, 2, 2, 'ผู้ช่วยผู้อำนวยการ');


#
# โครงสร้างตาราง `web_poll_votes`
#

CREATE TABLE `web_poll_votes` (
  `id` int(5) NOT NULL auto_increment,
  `poll_id` int(5) default NULL,
  `vote_id` int(5) default NULL,
  `ip` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1  ;

#
# dump ตาราง `web_poll_votes`
#



# --------------------------------------------------------

#
# โครงสร้างตาราง `web_polls`
#

CREATE TABLE `web_polls` (
  `id` int(5) NOT NULL auto_increment,
  `poll_question` text,
  `poll_options` text,
  `page` varchar(200) default NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2  ;

#
# dump ตาราง `web_polls`
#

INSERT INTO `web_polls` VALUES (1, 'คุณคิดว่าเวปนี้เป็นอย่างไร', 'ดีมาก|ดี|ปานกลาง|แย่|แย่มาก|', 'education', 1);

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_random`
#

CREATE TABLE `web_random` (
  `id` int(5) NOT NULL auto_increment,
  `rm_news` int(5) NOT NULL,
  `rm_image` varchar(255) NOT NULL,
  `rm_topic` varchar(255) NOT NULL,
  `rm_detail` varchar(255) NOT NULL,
  `rm_link` varchar(255) NOT NULL,
  `width` int(50) NOT NULL,
  `height` int(50) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(50) NOT NULL,
  `status` int(5) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM   AUTO_INCREMENT=1 ;

#
# dump ตาราง `web_random`
#

#
# โครงสร้างตาราง `web_research`
#

CREATE TABLE `web_research` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(10) NOT NULL default '',
  `topic` varchar(255) NOT NULL default '',
  `headline` varchar(255) NOT NULL default '',
  `detail` text NOT NULL,
  `posted` varchar(100) NOT NULL default '',
  `auth` varchar(100) NOT NULL,
  `post_date` varchar(50) NOT NULL default '',
  `update_date` varchar(50) NOT NULL default '',
  `enable_comment` tinyint(1) NOT NULL default '0',
  `abstract` varchar(100) NOT NULL,
  `full_text` varchar(100) NOT NULL,
  `pageview` int(11) NOT NULL default '0',
  `rate` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=3 ;

#
# dump ตาราง `web_research`
#

INSERT INTO `web_research` VALUES (1, '1', 'การพัฒนาการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี SQ3R  โดยการใช้แบบฝึกทักษะของนักเรียนชั้นมัธยมศึกษาปีที่  2', '<p>\r\n	การพัฒนาการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี SQ3R&nbsp; โดยการ ใช้แบบฝึกทักษะ&nbsp; ช่วยทำให้นักเรียนเกิดการเรียนรู้เป็นอย่างดี&nbsp; ส่งผลให้นักเรียนมีผลสัมฤทธิ์ทางการเรียนเป็นไปตามความมุ่งหมายที่กำหนดไว้&nbsp;&nbsp; จึงควรสนับสนุนให้ครูภาษ', '<p>\r\n	<strong><span style="color: #f00">ชื่อเรื่อง</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; การพัฒนาการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี SQ3R&nbsp; โดยการใช้แบบฝึกทักษะของนักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 2<br />\r\n	<span style="color: #f00">ชื่อผู้วิจัย</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; นางจิตตรา&nbsp; พิกุลทอง<br />\r\n	<span style="color: #f00">ตำแหน่ง</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;ครู&nbsp; วิทยฐานะ&nbsp; ครูชำนาญการ<br />\r\n	<span style="color: #f00">โรงเรียน&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;บรบือวิทยาคาร&nbsp;&nbsp; สำนักงานเขตพื้นที่การศึกษามัธยมศึกษา&nbsp;&nbsp; เขต&nbsp; 26<br />\r\n	<span style="color: #f00">ปีการศึกษา</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;2553</strong></p>\r\n<p style="text-align: center">\r\n	<br />\r\n	<strong>บทคัดย่อ</strong></p>\r\n<p>\r\n	<br />\r\n	&nbsp;การอ่านอย่างมีวิจารณญาณเป็นทักษะสำคัญและจำเป็นต่อนักเรียนมาก&nbsp; ทั้งนี้เพราะการอ่านทำให้ผู้อ่านมีความรู้ความเข้าใจ&nbsp; สามารถวิเคราะห์วิจารณ์&nbsp; และจดจำเรื่องราวได้&nbsp; ตลอดจนสามารถนำไปใช้ประโยชน์ในการดำเนินชีวิตประจำวัน&nbsp;&nbsp;&nbsp; การวิจัยในครั้งนี้มีความมุ่งหมายเพื่อ&nbsp;&nbsp; 1)&nbsp;&nbsp; เพื่อพัฒนาทักษะการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี SQ3R&nbsp; โดยการใช้แบบฝึกทักษะของนักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 2&nbsp;&nbsp; ที่มีประสิทธิภาพตามเกณฑ์&nbsp; 80/80&nbsp;&nbsp; 2)&nbsp; เพื่อหาดัชนีประสิทธิผลของแบบฝึกทักษะการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี&nbsp; SQ3R&nbsp;&nbsp; 3)&nbsp; เพื่อเปรียบเทียบผลสัมฤทธิ์ทางการเรียนวิชาภาษาไทย&nbsp; ระหว่างคะแนนก่อนเรียนและคะแนนหลังเรียน&nbsp;&nbsp; การอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี SQ3Rโดยการใช้ แบบฝึกทักษะของนักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 2&nbsp;&nbsp;&nbsp;&nbsp; 4)&nbsp; เพื่อศึกษาความพึงพอใจต่อการพัฒนาการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธีSQ3R&nbsp; โดยการใช้แบบฝึกทักษะของนักเรียนชั้นมัธยมศึกษปีที่&nbsp; 2 กลุ่มตัวอย่างที่ใช้ในการวิจัย ได้แก่&nbsp; นักเรียนชั้นมัธยมศึกษาปีที่ 2 /2 โรงเรียนบรบือวิทยาคาร&nbsp; สังกัดสำนักงานเขตพื้นที่การศึกษามัธยมศึกษา&nbsp; เขต&nbsp;&nbsp; 26&nbsp;&nbsp; ภาคเรียนที่&nbsp; 1 ปีการศึกษา&nbsp; 2553&nbsp;&nbsp;&nbsp; จำนวน 45&nbsp; คน ซึ่งได้มาโดยการเลือกแบบเจาะจง&nbsp; (Purposive&nbsp; Sampling) เครื่องมือที่ใช้ในการวิจัย&nbsp; คือ&nbsp; 1)&nbsp; แผนการจัดการเรียนรู้&nbsp; เรื่อง&nbsp; การอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี SQ3R ชั้นมัธยมศึกษา ปีที่&nbsp; 2&nbsp; จำนวน 7&nbsp; แผน&nbsp;&nbsp; แผนละ 2 ชั่วโมง&nbsp; รวม&nbsp; 14&nbsp; ชั่วโมง&nbsp;&nbsp;&nbsp; 2)&nbsp; แบบฝึกทักษะ&nbsp; การอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี SQ3R&nbsp; จำนวน&nbsp; 7&nbsp; เล่ม&nbsp;&nbsp; 3)&nbsp; แบบทดสอบวัดผลสัมฤทธิ์ทางการเรียนวิชาภาษาไทย&nbsp; ชั้นมัธยมศึกษาปีที่&nbsp; 2&nbsp; เป็นแบบปรนัย&nbsp;&nbsp; ชนิดเลือกตอบ 4 ตัวเลือก&nbsp;&nbsp; จำนวน&nbsp; 40&nbsp; ข้อ&nbsp;&nbsp;&nbsp; 4)&nbsp;&nbsp; แบบสอบถามความพึงพอใจของนักเรียน ชั้นมัธยมศึกษาปีที่&nbsp; 2&nbsp; ที่มีต่อการพัฒนาการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี SQ3Rโดยการใช้แบบฝึกทักษะ&nbsp;&nbsp; เป็นแบบมาตราส่วนประมาณค่า&nbsp;&nbsp; 5&nbsp; ระดับ&nbsp;&nbsp; (Rating Scale)&nbsp;&nbsp;&nbsp; จำนวน&nbsp; 20&nbsp; ข้อ<br />\r\n	&nbsp;ผลการวิจัย&nbsp; ปรากฏ&nbsp; ดังนี้<br />\r\n	&nbsp;&nbsp;1.&nbsp; ประสิทธิภาพของการพัฒนาการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี SQ3R&nbsp; โดยการใช้แบบฝึกทักษะของนักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 2&nbsp;&nbsp; มีประสิทธิภาพเท่ากับ&nbsp;&nbsp; 82.65/ 81.28&nbsp;&nbsp;&nbsp; <br />\r\n	&nbsp;&nbsp;2.&nbsp; ดัชนีประสิทธิผลของแบบฝึกทักษะการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี&nbsp; SQ3R&nbsp;&nbsp; มีค่าเท่ากับ&nbsp;&nbsp; 0.5489&nbsp; แสดงว่านักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 2&nbsp;&nbsp; มีความก้าวหน้าทางการเรียน ร้อยละ&nbsp; 54.89&nbsp; <br />\r\n	&nbsp;&nbsp;3.&nbsp; การเปรียบเทียบผลสัมฤทธิ์ทางการเรียนภาษาไทยของนักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 2&nbsp;&nbsp; ที่เรียนการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี SQ3Rโดยการใช้ แบบฝึกทักษะมีผลสัมฤทธิ์ทางการเรียนหลังเรียนสูงกว่าคะแนนก่อนเรียนอย่างมีนัยสำคัญทางสถิติที่ระดับ&nbsp; .01&nbsp; <br />\r\n	&nbsp;&nbsp;4.&nbsp; นักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 2&nbsp;&nbsp; มีความพึงพอใจต่อการพัฒนาการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี&nbsp; SQ3R โดยการใช้แบบฝึกทักษะ&nbsp; มีค่าเฉลี่ยรวมเท่ากับ&nbsp; 4.52 อยู่ในระดับมากที่สุด<br />\r\n	&nbsp;โดยสรุป&nbsp;&nbsp; การพัฒนาการอ่านอย่างมีวิจารณญาณด้วยรูปแบบการอ่านวิธี SQ3R&nbsp; โดยการ ใช้แบบฝึกทักษะ&nbsp; ช่วยทำให้นักเรียนเกิดการเรียนรู้เป็นอย่างดี&nbsp; ส่งผลให้นักเรียนมีผลสัมฤทธิ์ทางการเรียนเป็นไปตามความมุ่งหมายที่กำหนดไว้&nbsp;&nbsp; จึงควรสนับสนุนให้ครูภาษาไทยนำวิธีการสอนอ่านแบบ SQ3R ไปใช้ในการจัดกิจกรรมการอ่าน จะช่วยให้นักเรียนได้มีโอกาสฝึกทักษะการอ่าน และส่งเสริมกระบวนการคิดอย่างเป็นระบบ&nbsp; ทำให้การจัดกิจกรรมการเรียนการสอนภาษาไทยเป็นไปอย่างมีประสิทธิภาพ</p>\r\n', 'admin', 'นางจิตตรา  พิกุลทอง', '1298518879', '1298518879', 1, 'research_1298518879_abstract.swf', '', 114, 15);
INSERT INTO `web_research` VALUES (2, '1', 'การพัฒนาทักษะกีฬาวอลเลย์บอลโดยใช้แบบฝึกทักษะวอลเลย์บอล  รายวิชา  วอลเลย์บอล  1  พ  41201  มัธยมศึกษาปีที่  4  โรงเรียนวังลิ้นฟ้าวิทยาคม', 'การพัฒนาทักษะกีฬาวอลเลย์บอลโดยใช้แบบฝึกทักษะวอลเลย์บอล รายวิชาวอลเลย์บอล 1&nbsp; พ&nbsp; 41201&nbsp;&nbsp; ชั้นมัธยมศึกษาปีที่&nbsp; 4&nbsp; โรงเรียนวังลิ้นฟ้าวิทยาคม&nbsp;&nbsp; มีความมุ่งหมายของการวิจัย&nbsp;&nbsp; ดังนี้&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&n', 'การพัฒนาทักษะกีฬาวอลเลย์บอลโดยใช้แบบฝึกทักษะวอลเลย์บอล รายวิชาวอลเลย์บอล 1&nbsp; พ&nbsp; 41201&nbsp;&nbsp; ชั้นมัธยมศึกษาปีที่&nbsp; 4&nbsp; โรงเรียนวังลิ้นฟ้าวิทยาคม&nbsp;&nbsp; มีความมุ่งหมายของการวิจัย&nbsp;&nbsp; ดังนี้&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1)&nbsp; เพื่อพัฒนาทักษะกีฬาวอลเลย์บอลรายวิชา&nbsp; วอลเลย์บอล 1&nbsp; พ 41201&nbsp; โดยการใช้แบบฝึกทักษะของนักเรียนชั้นมัธยมศึกษาปีที่ 4&nbsp; ที่มีประสิทธิภาพตามเกณฑ์&nbsp; 80/80&nbsp; 2) เพื่อหาดัชนีประสิทธิผลของแบบฝึกทักษะกีฬาวอลเลย์บอล&nbsp; รายวิชา วอลเลย์บอล 1 พ 41201 ของนักเรียน ชั้นมัธยมศึกษา ปีที่&nbsp; 4&nbsp;&nbsp; 3) เพื่อเปรียบเทียบผลสัมฤทธิ์ทางการเรียนระหว่างคะแนนก่อนเรียนและคะแนนหลังเรียนทักษะกีฬาวอลเลย์บอล&nbsp;&nbsp; รายวิชา&nbsp; วอลเลย์บอล 1&nbsp; พ 41201&nbsp; โดยการใช้แบบฝึกทักษะของนักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 4&nbsp;&nbsp;&nbsp; 4) เพื่อศึกษาความพึงพอใจต่อการพัฒนาทักษะกีฬาวอลเลย์บอลโดยการใช้แบบฝึกทักษะรายวิชา&nbsp; วอลเลย์บอล 1&nbsp; พ&nbsp; 41201&nbsp; ของนักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 4&nbsp;&nbsp; กลุ่มตัวอย่าง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ที่ใช้ในการวิจัย&nbsp; ได้แก่&nbsp; นักเรียนชั้นมัธยมศึกษาปีที่ 4 โรงเรียนวังลิ้นฟ้าวิทยาคม&nbsp;&nbsp; ภาคเรียนที่&nbsp; 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ปีการศึกษา&nbsp;&nbsp; 2552&nbsp;&nbsp; จำนวน&nbsp; 30&nbsp;&nbsp; คน&nbsp; ซึ่งได้มาโดยการเลือกแบบเจาะจง&nbsp; (Purposive&nbsp; Sampling)เครื่องมือที่ใช้ในการวิจัย&nbsp;&nbsp; คือ&nbsp;&nbsp; 1)&nbsp;&nbsp; แผนการจัดการเรียนรู้&nbsp;&nbsp; 2)&nbsp;&nbsp; แบบฝึกทักษะกีฬาวอลเลย์บอล&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3)&nbsp; แบบทดสอบวัดผลสัมฤทธิ์ทางการเรียน ชั้นมัธยมศึกษาปีที่ 4&nbsp; เป็นแบบปรนัย&nbsp; ชนิดเลือกตอบ&nbsp;&nbsp; 4&nbsp; ตัวเลือก&nbsp;&nbsp; จำนวน&nbsp; 40&nbsp; ข้อ&nbsp;&nbsp; 4)&nbsp;&nbsp; แบบสอบถามความพึงพอใจของนักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 4&nbsp;&nbsp;&nbsp; ที่มีต่อการพัฒนาทักษะกีฬาวอลเลย์บอลโดยการใช้แบบฝึกทักษะ เป็นแบบมาตราส่วน ประมาณค่า&nbsp;&nbsp;&nbsp; 5&nbsp; ระดับ&nbsp;&nbsp; (Rating Scale)&nbsp;&nbsp;&nbsp; จำนวน&nbsp; 20&nbsp; ข้อ<br />\r\nผลการวิจัย&nbsp; ปรากฏ&nbsp; ดังนี้<br />\r\n&nbsp;&nbsp;1.&nbsp;&nbsp; ประสิทธิภาพของการพัฒนาทักษะกีฬาวอลเลย์บอล&nbsp;&nbsp; โดยการใช้แบบฝึกทักษะ ของนักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 4&nbsp;&nbsp; มีประสิทธิภาพเท่ากับ 82.06/ 81.08&nbsp;&nbsp;&nbsp; <br />\r\n&nbsp;&nbsp;2.&nbsp;&nbsp; ดัชนีประสิทธิผลของแบบฝึกทักษะกีฬาวอลเลย์บอล&nbsp;&nbsp;&nbsp; มีค่าเท่ากับ&nbsp;&nbsp; 0.6159&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; แสดงว่านักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 4&nbsp;&nbsp; มีความก้าวหน้าทางการเรียน&nbsp; ร้อยละ&nbsp; 61.59&nbsp; <br />\r\n&nbsp;3.&nbsp; การเปรียบเทียบผลสัมฤทธิ์ทางการเรียนของนักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 4&nbsp;&nbsp; ที่เรียน ทักษะกีฬาวอลเลย์บอล รายวิชา วอลเลย์บอล 1&nbsp; พ 41201&nbsp; โดยการใช้แบบฝึกทักษะ มีผลสัมฤทธิ์ทางการเรียนหลังเรียนสูงกว่าคะแนนก่อนเรียนอย่างมีนัยสำคัญทางสถิติที่ระดับ&nbsp; .05&nbsp; <br />\r\n&nbsp;4.&nbsp; นักเรียนชั้นมัธยมศึกษาปีที่&nbsp; 4&nbsp;&nbsp; มีความพึงพอใจต่อการพัฒนาทักษะกีฬาวอลเลย์บอล รายวิชา วอลเลย์บอล 1&nbsp; พ 41201&nbsp; โดยการใช้แบบฝึกทักษะ&nbsp; มีค่าเฉลี่ยรวมเท่ากับ&nbsp; 4.52&nbsp;&nbsp; อยู่ในระดับมากที่สุด<br />\r\nโดยสรุปในภาพรวมแบบฝึกทักษะวอลเลย์บอล&nbsp; รายวิชา&nbsp; วอลเลย์บอล 1&nbsp; พ&nbsp; 41201&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ', 'guest', 'นริศ  ประธรรมสาร', '1309345665', '1309345665', 0, '', '', 21, 0);

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_research_category`
#

CREATE TABLE `web_research_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(255) NOT NULL default '',
  `sort` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 ;

#
# dump ตาราง `web_research_category`
#

INSERT INTO `web_research_category` VALUES (1, 'งานวิจัยการศึกษา', 1);
INSERT INTO `web_research_category` VALUES (2, 'งานวิจัยทั่วไป', 2);
INSERT INTO `web_research_category` VALUES (3, 'นวัตกรรมทางการศึกษา', 3);

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_research_comment`
#

CREATE TABLE `web_research_comment` (
  `id` int(7) NOT NULL auto_increment,
  `research_id` int(7) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `comment` text NOT NULL,
  `ip` varchar(50) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `research_id` (`research_id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;

#
# dump ตาราง `web_research_comment`
#


# --------------------------------------------------------

#
# โครงสร้างตาราง `web_templates`
#

CREATE TABLE `web_templates` (
  `id` tinyint(5) NOT NULL auto_increment,
  `temname` varchar(200) NOT NULL,
  `picname` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `width` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `sort` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `temname` (`temname`)
) ENGINE=MyISAM AUTO_INCREMENT=7  ;

#
# dump ตาราง `web_templates`
#


INSERT INTO `web_templates` VALUES (1, 'cli3', 'topmini.png', 'image/x-png', '1000', '112', 1);

INSERT INTO `web_templates` VALUES (2, 'cli3', 'topbig.png', 'image/x-png', '1000', '288', 2);

INSERT INTO `web_templates` VALUES (3, 'cli3', 'footer.png', 'image/x-png', '1000', '79', 3);

INSERT INTO `web_templates` VALUES (4, 'atomy', 'banner1.png', 'image/x-png', '996', '36', 1);

INSERT INTO `web_templates` VALUES (5, 'atomy', 'banner.png', 'image/x-png', '996', '152', 2);

INSERT INTO `web_templates` VALUES (6, 'atomy', 'barfoot.png', 'image/x-png', '996', '94', 3);


# --------------------------------------------------------

#
# โครงสร้างตาราง `web_useronline`
#

CREATE TABLE IF NOT EXISTS `web_useronline` (
  `post_date` int(50) NOT NULL,
  `useronline` varchar(50) NOT NULL,
  `timeout` int(50) NOT NULL,
  `ip` varchar(50) NOT NULL
) ENGINE=MyISAM ;


#
# dump ตาราง `web_useronline`
#

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_vote`
#

CREATE TABLE `web_vote` (
  `id` int(11) NOT NULL auto_increment,
  `num` int(3) NOT NULL,
  `ip` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `name_id` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 ;

#
# dump ตาราง `web_vote`
#
INSERT INTO `web_vote` VALUES (1, 5, '223.206.13', 'gallery', 1);

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_webboard`
#

CREATE TABLE `web_webboard` (
  `id` int(11) NOT NULL auto_increment,
  `category` int(3) NOT NULL default '0',
  `topic` varchar(255) NOT NULL default '',
  `detail` text NOT NULL,
  `picture` varchar(50) NOT NULL default '',
  `post_name` varchar(50) NOT NULL default '',
  `is_member` int(7) NOT NULL default '0',
  `ip_address` varchar(50) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  `post_update` varchar(50) NOT NULL default '',
  `pin_date` varchar(50) NOT NULL,
  `pageview` int(5) NOT NULL default '0',
  `enable_show` int(2) NOT NULL,
  `att` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cat_id` (`category`),
  KEY `id` (`id`),
  KEY `post_date` (`post_date`)
) ENGINE=MyISAM AUTO_INCREMENT=3 ;

#
# dump ตาราง `web_webboard`
#

INSERT INTO `web_webboard` VALUES(1, 1, 'โหลดเวอร์ชัน 2.5', 'รอเวอร์ชัน 2.5 ครับ&nbsp; ตัวอย่างตามนี้&nbsp; <a href="http://banphue.sytes.net">http://banphue.sytes.net</a><br /><br />\r\n<br /><br />\r\nจะเปิดให้โหลดได้ตอนไหนครับ<br /><br />\r\nกำหนดวันไหนได้ครับ', '', 'ครูเอ็กซ์', 0, '182.52.184.117', '1300329304', '1309885042', '', 315, 0, '');
INSERT INTO `web_webboard` VALUES(2, 1, 'atomymaxsite2.5', '<p><br />\r\n	ท่าน ผอ. จะเปิดให้อัปเดทไหมครับ&nbsp; ถ้าได้เป็นวันไหนหรอครับ<br /><br />\r\n	<br /><br />\r\n	(สมาชิกเก่า)</p><br />\r\n', '', 'kikkok_2531', 0, '223.207.174.147', '1309885338', '1309885338', '', 81, 0, '');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_webboard_category`
#

CREATE TABLE `web_webboard_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_name` varchar(255) NOT NULL default '',
  `category_des` varchar(200) NOT NULL,
  `sort` int(11) NOT NULL default '0',
  `status` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 ;

#
# dump ตาราง `web_webboard_category`
#

INSERT INTO `web_webboard_category` VALUES (1, 'ห้องนั่งเล่น', '', 1,0);
INSERT INTO `web_webboard_category` VALUES (2, 'สอบถาม พูดคุยเกี่ยวกับการเรียนการสอน', '', 2,0);

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_webboard_comment`
#

CREATE TABLE `web_webboard_comment` (
  `id` int(11) NOT NULL auto_increment,
  `topic_id` int(7) NOT NULL default '0',
  `detail` text NOT NULL,
  `picture` varchar(50) NOT NULL default '',
  `post_name` varchar(50) NOT NULL default '',
  `is_member` int(7) NOT NULL default '0',
  `ip_address` varchar(50) NOT NULL default '',
  `post_date` varchar(50) NOT NULL default '',
  `att` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1  ;

#
# dump ตาราง `web_webboard_comment`
#

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_workboard_members`
#

CREATE TABLE `web_workboard_members` (
  `member_id` int(11) NOT NULL auto_increment,
  `member_name` varchar(255) NOT NULL default '',
  `member_email` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`member_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 ;

#
# dump ตาราง `web_workboard_members`
#

INSERT INTO `web_workboard_members` VALUES (1, 'นายชัดสกร  พิกุลทอง', 'vt9vm@hotmail.com');
INSERT INTO `web_workboard_members` VALUES (4, 'นายบุญถม  ชินช้าง', '');


# --------------------------------------------------------

#
# โครงสร้างตาราง `web_workboard_positions`
#

CREATE TABLE `web_workboard_positions` (
  `position_id` int(11) NOT NULL auto_increment,
  `position_name` varchar(255) NOT NULL default '',
  `position_description` text NOT NULL,
  PRIMARY KEY  (`position_id`),
  KEY `position_id` (`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6  ;

#
# dump ตาราง `web_workboard_positions`
#

INSERT INTO `web_workboard_positions` VALUES (1, 'กลุ่มบริหารงานบุคคล', 'กลุ่มบริหารงานบุคคล');
INSERT INTO `web_workboard_positions` VALUES (2, 'กลุ่มบริหารงานวิชาการ', 'กลุ่มบริหารงานวิชาการ');
INSERT INTO `web_workboard_positions` VALUES (4, 'กลุ่มบริหารงานทั่วไป', 'กลุ่มบริหารงานทั่วไป');
INSERT INTO `web_workboard_positions` VALUES (5, 'กลุ่มบริหารงานงบประมาณ', 'กลุ่มบริหารงานงบประมาณ');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_workboard_priorities`
#

CREATE TABLE `web_workboard_priorities` (
  `priority_id` int(11) NOT NULL auto_increment,
  `priority_name` varchar(30) NOT NULL default '',
  `priority_weight` int(11) NOT NULL default '1',
  PRIMARY KEY  (`priority_id`),
  KEY `priority_id` (`priority_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8  ;

#
# dump ตาราง `web_workboard_priorities`
#

INSERT INTO `web_workboard_priorities` VALUES (1, 'ต่ำ', 2);
INSERT INTO `web_workboard_priorities` VALUES (2, 'ต่ำมาก', 1);
INSERT INTO `web_workboard_priorities` VALUES (4, 'ไม่มี', 0);
INSERT INTO `web_workboard_priorities` VALUES (5, 'ปานกลาง', 3);
INSERT INTO `web_workboard_priorities` VALUES (6, 'สูง', 4);
INSERT INTO `web_workboard_priorities` VALUES (7, 'สูงมาก', 5);

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_workboard_projects`
#

CREATE TABLE `web_workboard_projects` (
  `project_id` int(11) NOT NULL auto_increment,
  `project_name` varchar(255) NOT NULL default '',
  `project_description` text NOT NULL,
  `priority_id` int(11) NOT NULL default '0',
  `status_id` int(11) NOT NULL default '0',
  `status_percent` float NOT NULL default '0',
  `date_created` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_started` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_finished` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`project_id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 ;

#
# dump ตาราง `web_workboard_projects`
#

INSERT INTO `web_workboard_projects` VALUES(1, 'เข้าค่ายลูกเสือ-ยุวกาชาด', 'เข้าค่ายลูกเสือ-ยุวกาชาด', 6, 5, 100, '2011-03-18 20:26:11', '2011-01-04 00:00:00', '2011-01-15 00:00:00');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_workboard_projects_members`
#

CREATE TABLE `web_workboard_projects_members` (
  `project_id` int(11) NOT NULL default '0',
  `member_id` int(11) NOT NULL default '0',
  `position_id` int(11) NOT NULL default '0',
  KEY `project_id` (`project_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM ;

#
# dump ตาราง `web_workboard_projects_members`
#
# --------------------------------------------------------

#
# โครงสร้างตาราง `web_workboard_status`
#

CREATE TABLE `web_workboard_status` (
  `status_id` int(11) NOT NULL auto_increment,
  `status_name` varchar(255) NOT NULL default '',
  `status_description` text NOT NULL,
  PRIMARY KEY  (`status_id`),
  KEY `status_id` (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9   ;

#
# dump ตาราง `web_workboard_status`
#

INSERT INTO `web_workboard_status` VALUES (1, 'วางแผน', 'วางแผน');
INSERT INTO `web_workboard_status` VALUES (2, 'เริ่ม', 'เริ่ม');
INSERT INTO `web_workboard_status` VALUES (3, 'เปิด', 'เปิด');
INSERT INTO `web_workboard_status` VALUES (4, 'ปิด', 'ปิด');
INSERT INTO `web_workboard_status` VALUES (5, 'เสร็จ', 'เสร็จ');
INSERT INTO `web_workboard_status` VALUES (6, 'รอ', 'รอ');
INSERT INTO `web_workboard_status` VALUES (7, 'หยุด', 'หยุด');
INSERT INTO `web_workboard_status` VALUES (8, 'ยกเลิก', 'ยกเลิก');

# --------------------------------------------------------

#
# โครงสร้างตาราง `web_workboard_tasks`
#

CREATE TABLE `web_workboard_tasks` (
  `task_id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL default '0',
  `task_name` varchar(255) NOT NULL default '',
  `task_description` text NOT NULL,
  `priority_id` int(11) NOT NULL default '0',
  `status_id` int(11) NOT NULL default '0',
  `status_percent` float NOT NULL default '0',
  `date_created` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_started` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_finished` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`task_id`),
  KEY `task_id` (`task_id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

#
# dump ตาราง `web_workboard_tasks`
#


# --------------------------------------------------------

#
# โครงสร้างตาราง `web_workboard_tasks_members`
#

CREATE TABLE `web_workboard_tasks_members` (
  `task_id` int(11) NOT NULL default '0',
  `member_id` int(11) NOT NULL default '0',
  KEY `task_id` (`task_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM ;

#
# dump ตาราง `web_workboard_tasks_members`
#




CREATE TABLE `kk_attached_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_type_id` int(11) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

INSERT INTO kk_attached_files VALUES("45","VAT Updated Certificate - Copy_1609606469476.pdf","contact","2","2021-01-02 17:54:29");
INSERT INTO kk_attached_files VALUES("46","VATCertificate Random Consulting_1609606811770.pdf","company","9","2021-01-02 18:00:11");
INSERT INTO kk_attached_files VALUES("47","RC Memorandum and certificate_1609606928492.pdf","company","9","2021-01-02 18:02:10");
INSERT INTO kk_attached_files VALUES("48","Certificate from Ministry of Finance double taxation agreement Malta and India_1609606951413.pdf","company","9","2021-01-02 18:02:31");
INSERT INTO kk_attached_files VALUES("49","Random Consulting Ltd_Tax Residence Certificate_1609606960862.pdf","company","9","2021-01-02 18:02:41");



CREATE TABLE `kk_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `emailconfirmed` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO kk_clients VALUES("1","mariogalea","mario.galea@rnggaming.com","","$2y$10$0xEAEc.G1jkot6gIhK1c1OdcukZgKq87dVzzuNecVZsmSDIsF7Yuy","ef6d8a645ef1ca2518c6f0b11470fafc","0","1","2020-12-27 21:50:25");



CREATE TABLE `kk_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment_to` varchar(255) NOT NULL,
  `to_id` int(11) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `reg_no` varchar(25) NOT NULL,
  `address` text,
  `vat_no` varchar(25) DEFAULT NULL,
  `description` text,
  `website` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date_formed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO kk_companies VALUES("9","Random Consulting Limited","C46368","{"address1":"The Cube LS3","address2":"Malta Life Sciences Park","city":"San Gwann","state":"MT","country":"Malta","pin":"SGN3000"}","19258035","BOV IBAN: 1234567890","www.rnggaming.com","1","2009-03-12 00:00:00","2021-01-02 17:41:07");
INSERT INTO kk_companies VALUES("10","BuiltinMT Ltd","C34567","{"address1":"The Cube LS3","address2":"Malta Life Sciences Park","city":"San Gwann","state":"MT","country":"Malta","pin":"SGN 3000"}","12345678","","","1","2021-01-01 17:12:36","2021-01-02 17:30:03");



CREATE TABLE `kk_contact_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `other` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO kk_contact_type VALUES("1","Supplier","Suppliers","","1","2020-12-28 11:07:37","2020-12-28 11:07:37");
INSERT INTO kk_contact_type VALUES("2","Employee","","","1","2020-12-28 11:07:51","2020-12-28 11:07:51");
INSERT INTO kk_contact_type VALUES("3","Client","","","1","2020-12-28 11:08:02","2020-12-28 11:08:02");



CREATE TABLE `kk_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salutation` varchar(40) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `company` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `website` varchar(255) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `country` varchar(100) NOT NULL,
  `persons` text NOT NULL,
  `remark` text NOT NULL,
  `lead_id` int(11) NOT NULL,
  `other` text NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contact_type` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO kk_contacts VALUES("1","Mr.","Anton","Magro","Griffiths and Associates","anton@griffithsassoc.com","35699077024","www.griffithsassoc.com ","","{"address1":"Level 1","address2":"Casal Naxaro, Labour Avenue","city":"Naxxar","state":"","country":"Malta","pin":"NXR9021","phone1":"+35627383631","fax":""}","Malta","[{"salutation":"","name":"","email":"","mobile":"","skype":"","designation":""}]","&lt;p&gt;Our Accountants.&lt;br&gt;&lt;/p&gt;","0","","2020-12-27 20:58:22","1");
INSERT INTO kk_contacts VALUES("2","Mr.","Mario","Galea","Random Consulting Limited","mario.s.galea@gmail.com","99445314","www.rnggaming.com","","{"address1":"LS3, The Cube ","address2":"Malta Life Sciences Park","city":"San Gwann","state":"MT","country":"Malta","pin":"SGN3000","phone1":"21388178","fax":""}","Malta","[{"salutation":"Ms.","name":"Aideen Shortt","email":"aideen.shortt@gmail.com","mobile":"+35699061782","skype":"altihood","designation":"Partner"},{"salutation":"","name":"Mario Galea","email":"mario.s.galea@gmail.com","mobile":"+35699445314","skype":"mario_galea","designation":"Director"}]","&lt;ol id=&quot;l2&quot;&gt;&lt;li&gt;&lt;p style=&quot;padding-left: 6pt;text-indent: 0pt;line-height: 108%;text-align: justify;&quot;&gt;Random
 Consulting is recognized globally as an expert firm in the online 
gaming sector. We have more than twenty years’ experience, and have been
 entrusted by governments, tribal nations, state agencies and law 
enforcement agencies for highly sensitive work in countries across the 
Americas, Asia and Europe to introduce regulatory reforms, new policies 
and implementations for online gaming.&lt;/p&gt;&lt;p style=&quot;padding-top: 7pt;padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: justify;&quot;&gt;Over
 the past years, Random Consulting has been involved in a wide range of 
projects related to online gaming in Europe, Canada and the United 
States. One of our best assets is the immediate availability of industry
 resources, which we can leverage at any time during our assignments to 
bring complementary knowledge and expertise to the project as and when 
needed. This helps raise our delivery standards as well as shorten the 
implementation timeframes.&lt;/p&gt;&lt;p style=&quot;padding-top: 7pt;padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: justify;&quot;&gt;The
 scope of experience of the consultants is unparalleled in the industry.
 Together the lead consultants have “hands-on” experience in every 
single one of the disciplines, including overall regulation along with 
setting up and running gambling sites themselves. This means that, 
unlike many other consultancies, Random Consulting can provide RS 
Economic Regulator with complete start-to- finish strategic and tactical
 support from a position of actual experience, not just theoretical 
exploration.&lt;/p&gt;&lt;p style=&quot;padding-top: 7pt;padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: justify;&quot;&gt;We
 are best known for our Online Gaming Standards. In 2013 Random 
Consulting worked with the Gaming Standards Association to turn these 
standards into global standards. The GSA set up the Online Gaming 
Committee which has now published the Regulatory Reporting Interface 
(RRI). Meanwhile Random Consulting has been instrumental in setting up 
GSA Europe which was officially launched in May 2017 in Malta and Mario 
Galea is one of three co-founders.&lt;/p&gt;&lt;p style=&quot;padding-top: 8pt;padding-left: 5pt;text-indent: 0pt;line-height: 107%;text-align: justify;&quot;&gt;These
 are documents covering different aspects of online gaming that can be 
adopted ‘out-of-the- box’. These standards cover such areas as:&lt;/p&gt;&lt;ul id=&quot;l3&quot;&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 8pt;padding-left: 41pt;text-indent: -18pt;text-align: left;&quot;&gt;Regulatory policy for licensing online gaming&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 41pt;text-indent: -18pt;text-align: left;&quot;&gt;Regulatory policy for cross border gaming.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-left: 41pt;text-indent: -18pt;text-align: left;&quot;&gt;Certification Policy for Technical systems for Online Gaming&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Player Management Systems Function &amp;amp; Procedures&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Funds Management Systems Functions &amp;amp; Procedures&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Games Management Systems Functions &amp;amp; Procedures&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Responsible Gaming Measures&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Player Protection Measures&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;KYC-Policies and Procedures&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Anti-money Laundering Policies and Procedures&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 3pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Payment Systems Policies and Procedures&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Prevention of Fraud and Collusion – Policies and Procedures&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Monitoring Systems for Online Gaming&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Technical Audit for Online Gaming Systems&lt;/p&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;padding-left: 6pt;text-indent: 0pt;text-align: justify;&quot;&gt;In addition, we assist clients in following areas:&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 9pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Technical set-up&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Strategic and operational processes&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Licensing and incorporation&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Games supplier selection&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Payment processing selection&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Customer acquisition: online, mobile, offline, agent and affiliate marketing&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;line-height: 108%;text-align: left;&quot;&gt;Data driven player retention to lengthen the player lifetime and increase the average player value&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Social media – brand management and B2C engagement&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Customer support operations&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Player management&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Day-to-day operations and transaction management&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Data and reporting evaluation to constantly increase overall business revenue&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;text-align: left;&quot;&gt;Bonusing and loyalty schemes&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p style=&quot;padding-top: 1pt;padding-left: 42pt;text-indent: -18pt;line-height: 108%;text-align: left;&quot;&gt;Products: Sportsbook, Casino, Bingo, Poker, Social games, Skill games, Lottery, Mobile, Live Gaming&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;padding-left: 6pt;text-indent: 0pt;line-height: 108%;text-align: justify;&quot;&gt;Random
 Consulting has won industry awards as well as formal appreciation 
awards from governments for our excellent work. Our partners are highly 
respected industry experts and are regular contributors to all the main 
online gaming trade journals. They are key speakers and moderators in 
trade shows and events around the world, as well as selected in-house 
trainers for operational and marketing functions for some of the largest
 European gambling operators including, for example, Betfair and 
Betsson.&lt;/p&gt;&lt;p style=&quot;padding-top: 7pt;padding-left: 6pt;text-indent: 0pt;line-height: 108%;text-align: justify;&quot;&gt;Our
 expert opinion has been featured in the New York Times, Reuters, Figaro
 and on Frontline, the popular PBS show in the United States.&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;h2 style=&quot;padding-top: 1pt;padding-left: 39pt;text-indent: -34pt;text-align: left;&quot;&gt;&lt;a name=&quot;bookmark2&quot; href=&quot;http://Relevant Project Experience&quot; target=&quot;_blank&quot;&gt;Relevant Project Experience&lt;/a&gt;&lt;/h2&gt;&lt;p style=&quot;padding-top: 7pt;padding-left: 5pt;text-indent: 0pt;line-height: 107%;text-align: left;&quot;&gt;A list of projects carried out by Random Consulting or some of its Team Members that are relevant to this Proposal.&lt;/p&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;table style=&quot;border-collapse:collapse;margin-left:6.25pt&quot; cellspacing=&quot;0&quot;&gt;&lt;tbody&gt;&lt;tr style=&quot;height:41pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#4471C4;border-left-style:solid;border-left-width:1pt;border-left-color:#4471C4&quot; bgcolor=&quot;#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s1&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;Jurisdiction&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#4471C4&quot; bgcolor=&quot;#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s1&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;Year&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#4471C4;border-right-style:solid;border-right-width:1pt;border-right-color:#4471C4&quot; bgcolor=&quot;#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s1&quot; style=&quot;padding-left: 13pt;text-indent: 0pt;text-align: left;&quot;&gt;Short Description of the Project&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:67pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;Malta&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2004&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 8pt;text-indent: 0pt;text-align: left;&quot;&gt;Drafted
 the Gaming Policy for Malta. Established the Malta Gaming Authority and
 managed it for five years. In 2006, Malta became the largest 
jurisdiction with over 500 licensed online operators.&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:54pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;Romania&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2008&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 4pt;text-indent: 0pt;text-align: left;&quot;&gt;Engaged
 as economic regulator for online game for the state. Set up regulatory 
policy and implemented the regulatory procedures for online gaming.&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:41pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;Nevada, USA&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2011&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 15pt;text-indent: 0pt;text-align: left;&quot;&gt;Knowledge transfer to the state of Nevada Gaming Control Board on the introduce online poker in the state.&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:41pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;New Jersey&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2013&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 20pt;text-indent: 0pt;text-align: left;&quot;&gt;Entrusted by the state to implement the regulatory policy and roll out online gaming in the state.&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:41pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-top: 6pt;padding-left: 5pt;padding-right: 16pt;text-indent: 0pt;text-align: left;&quot;&gt;Tulalip, Washington, USA&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2013&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 19pt;text-indent: 0pt;text-align: left;&quot;&gt;Set up a tribal policy for the introduction of online gaming within a reservation&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:41pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-top: 6pt;padding-left: 5pt;padding-right: 4pt;text-indent: 0pt;text-align: left;&quot;&gt;San Manuel, California, USA&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2014&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 19pt;text-indent: 0pt;text-align: left;&quot;&gt;Set up a tribal policy for the introduction of online gaming within a reservation&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:41pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-top: 6pt;padding-left: 5pt;padding-right: 14pt;text-indent: 0pt;text-align: left;&quot;&gt;Lagos State Lottery Board, Lagos, Nigeria&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2015&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 34pt;text-indent: 0pt;text-align: left;&quot;&gt;Co-drafted the regulatory policy for online gaming and knowledge transfer to the State lottery Board of Lagos&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:41pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;Malta&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2013&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 12pt;text-indent: 0pt;text-align: left;&quot;&gt;Set up iGaming Malta – An entity to carry out marketing for online gaming in Malta.&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:54pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;padding-right: 7pt;text-indent: 0pt;text-align: left;&quot;&gt;Department of Justice, California, USA&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2014&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 7pt;text-indent: 0pt;text-align: left;&quot;&gt;Drafted
 Senate Bill 678, the Online Poker Consumer Protection Consumer Act, for
 the state of California. Worked with the Department of Justice to set 
the regulatory policy.&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:41pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;padding-right: 13pt;text-indent: 0pt;text-align: left;&quot;&gt;Ontario Lotteries and Gaming Commission,&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;line-height: 12pt;text-align: left;&quot;&gt;Canada&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2015&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 14pt;text-indent: 0pt;text-align: left;&quot;&gt;Won the bid to set up online gaming within the province of Ontario&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:41pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;Mexico&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2015&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 33pt;text-indent: 0pt;text-align: left;&quot;&gt;Worked with Secretaría de Gobernación to introduce a regulatory framework for online gaming in Mexico.&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:54pt&quot;&gt;&lt;td style=&quot;width:117pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;US Virgin Islands&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:41pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;2016&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;Knowledge
 transfer to the Gaming commission on regulatory policy for online 
gaming. We also advised on the drafting of the legislation.&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;&lt;table style=&quot;border-collapse:collapse;margin-left:6.25pt&quot; cellspacing=&quot;0&quot;&gt;&lt;tbody&gt;&lt;tr style=&quot;height:54pt&quot;&gt;&lt;td style=&quot;width:115pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;Malta&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:43pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 7pt;text-indent: 0pt;text-align: left;&quot;&gt;2018&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 7pt;text-indent: 0pt;text-align: left;&quot;&gt;Started the implementation for a Unified Enhanced Automated Reporting and Monitoring System. This project is still ongoing&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:54pt&quot;&gt;&lt;td style=&quot;width:115pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;European Commission&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:43pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 7pt;text-indent: 0pt;text-align: left;&quot;&gt;2019&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 7pt;text-indent: 0pt;text-align: justify;&quot;&gt;Elected
 as project leader and member of the expert group to define and draft a 
technical standard for the monitoring and supervision of online gaming 
in Europe.&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr style=&quot;height:81pt&quot;&gt;&lt;td style=&quot;width:115pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-left-style:solid;border-left-width:1pt;border-left-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s2&quot; style=&quot;padding-left: 5pt;text-indent: 0pt;text-align: left;&quot;&gt;Republic of Georgia&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:43pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240&quot;&gt;&lt;p style=&quot;text-indent: 0pt;text-align: left;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 7pt;text-indent: 0pt;text-align: left;&quot;&gt;2020&lt;/p&gt;&lt;/td&gt;&lt;td style=&quot;width:293pt;border-top-style:solid;border-top-width:1pt;border-top-color:#A30240;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#A30240;border-right-style:solid;border-right-width:1pt;border-right-color:#A30240&quot;&gt;&lt;p class=&quot;s3&quot; style=&quot;padding-left: 13pt;padding-right: 19pt;text-indent: 0pt;text-align: left;&quot;&gt;Engaged
 to manage the gaming regulator on behalf of the Revenue service under 
the Ministry of Finance. The engagement is for both online and 
land-based gaming including 10,000 slot machines and 8 online gaming 
operators.&lt;/p&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;&lt;/li&gt;&lt;/ol&gt;","0","","2020-12-30 19:43:33","2");



CREATE TABLE `kk_currency` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(5) NOT NULL,
  `abbr` varchar(10) NOT NULL,
  `other` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO kk_currency VALUES("1","Euro","€","","1","2020-12-27 22:20:33");



CREATE TABLE `kk_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO kk_departments VALUES("1","Finance","1","2020-12-28 00:24:20");
INSERT INTO kk_departments VALUES("2","Licensing","1","2020-12-28 00:24:27");
INSERT INTO kk_departments VALUES("3","Compliance","1","2020-12-28 00:24:35");
INSERT INTO kk_departments VALUES("4","Admin","1","2020-12-28 00:24:46");
INSERT INTO kk_departments VALUES("5","Support","1","2020-12-28 00:24:52");



CREATE TABLE `kk_domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `registration_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `provider` varchar(255) NOT NULL,
  `hosting` varchar(255) NOT NULL,
  `customer` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `renew` tinyint(1) NOT NULL,
  `remark` text NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_email_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_to` varchar(100) NOT NULL,
  `email_bcc` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `allday` tinyint(1) NOT NULL,
  `color` varchar(255) NOT NULL,
  `other` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO kk_event VALUES("2","call aquani","to check ","2021-01-04 16:00:00","2021-01-03 15:55:43","0","","","1","2020-12-28 16:54:01");



CREATE TABLE `kk_expense_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `other` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO kk_expense_type VALUES("1","Courier","Courier Deliveries","","1","2020-12-27 23:45:01");
INSERT INTO kk_expense_type VALUES("2","Fuel","Fuel Payments","","1","2020-12-27 23:45:15");
INSERT INTO kk_expense_type VALUES("3","Food and Beverages","Food and Beverages","","1","2020-12-27 23:45:38");
INSERT INTO kk_expense_type VALUES("4","Cleaning","Cleaner or Cleaning Material","","1","2020-12-27 23:46:04");
INSERT INTO kk_expense_type VALUES("5","Maintenance","Small Maintenance expenses
","","1","2020-12-27 23:46:56");
INSERT INTO kk_expense_type VALUES("6","Consumables","Consumables other then Electronics","","1","2020-12-27 23:47:20");
INSERT INTO kk_expense_type VALUES("7","Electronics Parts","Electronic Stuff","","1","2020-12-27 23:47:44");
INSERT INTO kk_expense_type VALUES("8","Hardware","Small Hardware Stuff","","1","2020-12-27 23:48:04");



CREATE TABLE `kk_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_by` varchar(255) NOT NULL,
  `expense_type` int(11) NOT NULL,
  `currency` int(3) NOT NULL,
  `purchase_amount` int(100) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `description` text NOT NULL,
  `attached_file` text NOT NULL,
  `other` text NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO kk_expenses VALUES("1","Joan","4","1","50","1","2020-12-28","Cleaning on December 28","","","2020-12-28 15:18:10");



CREATE TABLE `kk_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `legal_name` varchar(255) NOT NULL,
  `language` varchar(10) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `theme` text NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO kk_info VALUES("1","http://portal.rnggaming.com/","Random Group","Random Group Limited","eng","","","info@rnggaming.com","{"address1":"LS3, The Cube","address2":"Malta Life Sciences Park","city":"San Gwann","country":"Malta","pincode":"SGN3000"}","21388817","","USD","{"layout":"","layout_fixed":"menu-fixed page-hdr-fixed","layout_menu":false,"side_menu":"dark","header_color":"page-hdr-colored page-hdr-gradient bg-secondary"}","2020-12-28 00:31:07");



CREATE TABLE `kk_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_number` int(11) NOT NULL DEFAULT '1',
  `item` varchar(255) NOT NULL,
  `description` text,
  `location` varchar(255) NOT NULL,
  `storage` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `picture_id` varchar(255) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `quantity` int(11) DEFAULT '1',
  `is_stock` tinyint(1) DEFAULT '0',
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inv_number` (`inv_number`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO kk_inventory VALUES("2","93","Acer Monitor","","2","","2","","2021-01-02","1","0","2021-01-02 13:15:32");
INSERT INTO kk_inventory VALUES("3","100","Another Computer","","1","","1","","2021-01-02","1","0","2021-01-02 15:13:19");
INSERT INTO kk_inventory VALUES("11","101","Random","wow","1","desk","1","","2020-10-01","1","0","2021-01-02 15:26:09");



CREATE TABLE `kk_inventory_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `other` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO kk_inventory_type VALUES("1","Personal Computer","Desktop Computers and Laptops","","1","2020-12-29 11:31:28","2020-12-28 12:26:35");
INSERT INTO kk_inventory_type VALUES("2","Computer Peripheral","Computer Peripherals such as keyboards and Monitors","","1","2020-12-28 12:27:03","2020-12-28 12:27:03");
INSERT INTO kk_inventory_type VALUES("3","Furniture and Fittings","Anything to sit on, sit at or sit by"," ","1","2020-12-28 12:27:03","2020-12-28 12:27:03");
INSERT INTO kk_inventory_type VALUES("4","Gaming Equipment","All Types of Gaming Equipment"," ","1","2020-12-29 11:32:37","2020-12-29 11:31:28");
INSERT INTO kk_inventory_type VALUES("5","AV Equipment","Audio Visual Equipment"," ","1","2020-12-29 11:32:37","2020-12-29 11:32:37");
INSERT INTO kk_inventory_type VALUES("6","Testing Instruments","Workbench equipment for testing and measurment"," ","1","2020-12-29 11:33:55","2020-12-29 11:33:55");
INSERT INTO kk_inventory_type VALUES("7","Stationery","Write, on, write with and erase","Stock","1","2020-12-29 11:37:13","2020-12-29 11:37:13");
INSERT INTO kk_inventory_type VALUES("8","Consumables","Puff!","Stock","1","2020-12-29 11:37:13","2020-12-29 11:37:13");
INSERT INTO kk_inventory_type VALUES("9","Stock","Stock Items","Stock","1","2020-12-29 11:37:40","2020-12-29 11:37:40");



CREATE TABLE `kk_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `duedate` date NOT NULL,
  `paiddate` date NOT NULL,
  `currency` int(5) NOT NULL,
  `paymenttype` int(11) NOT NULL,
  `items` text NOT NULL,
  `total` text,
  `subtotal` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `discount_type` int(2) NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid` decimal(10,2) NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `note` text,
  `tc` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `other` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `inv_status` tinyint(1) NOT NULL,
  `rid` int(11) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `currency` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `other` varchar(255) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO kk_items VALUES("1","Gaming License (Malta)","2","License","1","23000","A Malta License","","2020-12-28 00:00:33");
INSERT INTO kk_items VALUES("2","Software Development","2","hour","1","350","General Software Development","","2020-12-28 00:01:16");
INSERT INTO kk_items VALUES("3","Opening of Bank Account","2","account","1","1500","Opening of a Bank Account","","2020-12-28 00:02:22");
INSERT INTO kk_items VALUES("4","Compliance Audit","2","audit","1","7000","Compliance Audit"," ","2020-12-28 00:02:22");



CREATE TABLE `kk_leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salutation` varchar(30) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `company` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `website` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `country` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `source` varchar(255) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_location_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO kk_location_type VALUES("1","Main Office","Main Office ","1","2020-12-29 11:45:35");
INSERT INTO kk_location_type VALUES("2","MG Office","Mario Office","1","2020-12-29 11:49:00");
INSERT INTO kk_location_type VALUES("3","AS Office ","Aideen Office","1","2020-12-29 11:49:00");
INSERT INTO kk_location_type VALUES("4","MP Office","Mark Office","1","2020-12-29 11:49:00");
INSERT INTO kk_location_type VALUES("5","Front Lobby","Front Lobby","1","2020-12-29 11:49:00");
INSERT INTO kk_location_type VALUES("6","Kitchenette","Kitchenette","1","2020-12-29 11:49:00");
INSERT INTO kk_location_type VALUES("7","Store Room 1","Store Room","1","2020-12-29 11:49:00");
INSERT INTO kk_location_type VALUES("8","Store Room 2","Store Room","1","2020-12-29 11:49:00");
INSERT INTO kk_location_type VALUES("9","Data Room","Room Number 12","1","2020-12-29 11:49:00");
INSERT INTO kk_location_type VALUES("10","Datacentre","At Triq ic-cawsli, Qormi","1","2020-12-29 11:49:00");



CREATE TABLE `kk_login_attempts` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(96) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `count` int(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;




CREATE TABLE `kk_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `color` varchar(7) NOT NULL,
  `background` varchar(7) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `other` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO kk_notes VALUES("3","Hello","&lt;p&gt;Welcome to the Tardis&lt;br&gt;&lt;/p&gt;","#000000","#DEF58F","0","","1","2021-01-03 16:51:04");
INSERT INTO kk_notes VALUES("4","Start a new Year","","#000000","#F7BFFF","0","","1","2021-01-03 16:57:39");
INSERT INTO kk_notes VALUES("5","Beware of the Dog","&lt;p&gt;woof woof!&lt;br&gt;&lt;/p&gt;","#000000","#F39C12","0","","1","2021-01-03 17:17:02");
INSERT INTO kk_notes VALUES("6","Call Hilary","","#000000","#F39C12","0","","7","2021-01-03 17:22:25");



CREATE TABLE `kk_payment_gateway` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `mode` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO kk_payment_gateway VALUES("1","","","","0","1","0000-00-00 00:00:00");



CREATE TABLE `kk_payment_status` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `other` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `other` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO kk_payment_type VALUES("1","Bank Transfer","Bank Of Valletta
Malta","BOV","1","2020-12-27 22:21:09");
INSERT INTO kk_payment_type VALUES("2","Petty Cash","Payments form/to Petty Cash","Petty Box","1","2020-12-31 16:26:26");
INSERT INTO kk_payment_type VALUES("3","Cash","Cash other than Petty Cash","Other","1","2020-12-31 16:26:26");
INSERT INTO kk_payment_type VALUES("4","Credit Card","Credit Card","BOV","1","2020-12-31 16:26:26");
INSERT INTO kk_payment_type VALUES("5","PayPal","PayPal Payment"," ","1","2020-12-31 16:26:26");



CREATE TABLE `kk_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `method` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` int(3) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payer_ip` varchar(255) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `paid_to` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `customer` int(11) NOT NULL,
  `billing_method` int(2) NOT NULL,
  `currency` int(4) NOT NULL,
  `rate_hour` int(4) NOT NULL,
  `project_hour` int(4) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `staff` text NOT NULL,
  `task` text NOT NULL,
  `completed` int(3) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_proposal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `currency` int(5) NOT NULL,
  `paymenttype` int(2) NOT NULL,
  `date` date NOT NULL,
  `expiry` date NOT NULL,
  `rate` int(11) NOT NULL,
  `items` text NOT NULL,
  `total` text NOT NULL,
  `note` varchar(255) NOT NULL,
  `tc` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_recurring_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `currency` int(5) NOT NULL,
  `paymenttype` int(11) NOT NULL,
  `items` text NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `discount_type` int(2) NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `note` text,
  `tc` varchar(255) NOT NULL,
  `other` text NOT NULL,
  `repeat_every` varchar(10) NOT NULL,
  `inv_status` tinyint(1) NOT NULL,
  `inv_date` date NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_recurring_log` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `recurring_type` varchar(50) NOT NULL,
  `logs` text NOT NULL,
  `other` text NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `data` text,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO kk_setting VALUES("1","emailsetting","{"fromemail":"mario.galea@rnggaming.com","fromname":"Random Team","reply":"mario.galea@rnggaming.com","host":"mail.rnggaming.com","port":"465","username":"mario.galea@rnggaming.com","password":"Mgalea!1310","encryption":"tls","authentication":"1"}","1");
INSERT INTO kk_setting VALUES("2","recurring","123456","1");



CREATE TABLE `kk_subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_supplies_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `other` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO kk_supplies_type VALUES("1","Accounting","Accounting Services","","1","2020-12-28 10:04:53","2020-12-28 10:04:53");
INSERT INTO kk_supplies_type VALUES("2","Water","Water Bottles Supply","","1","2020-12-28 10:05:10","2020-12-28 10:05:10");
INSERT INTO kk_supplies_type VALUES("3","Mobiles","Mobile Phone Services","","1","2020-12-28 10:05:37","2020-12-28 10:05:37");
INSERT INTO kk_supplies_type VALUES("4","Internet","Internet Services","","1","2020-12-28 10:05:51","2020-12-28 10:05:51");
INSERT INTO kk_supplies_type VALUES("5","Legal","Legal Services","","1","2020-12-28 10:06:24","2020-12-28 10:06:24");
INSERT INTO kk_supplies_type VALUES("6","Printer","Printer Consumables and Repairs","","1","2020-12-28 10:07:04","2020-12-28 10:07:04");
INSERT INTO kk_supplies_type VALUES("7","Building","Building Administration and Security","","1","2020-12-28 10:07:41","2020-12-28 10:07:41");



CREATE TABLE `kk_taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `rate` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `other` text NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO kk_taxes VALUES("1","VAT","18","","","2020-12-28 00:03:30");



CREATE TABLE `kk_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO kk_template VALUES("1","newticket","New Ticket","Manasa Theme: New Ticket Received ","&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Dear {NAME},&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Your support ticket&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;font-weight: bolder; font-family: Verdana;&quot;&gt;{SUBJECT}&lt;/span&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;&amp;nbsp;has been submitted. We try to reply to all tickets as soon as possible, usually within 24 hours.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Your ID: {ID}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Your Email Address: {EMAIL}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Ticket message: {MESSAGE}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;You can view the status of your ticket here: {TICKETURL}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;You will receive an e-mail notification when our staff replies to your ticket.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: red;&quot;&gt;&lt;span style=&quot;font-weight: bolder; font-family: Verdana;&quot;&gt;*DO NOT REPLY TO THIS E-MAIL*&lt;/span&gt;&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!&lt;/span&gt;&lt;/p&gt;","0","2018-03-15 16:15:41");
INSERT INTO kk_template VALUES("2","deleteticket","Delete Ticket","Manasa Theme: Delete Ticket","&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Ticket Deleted&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Ticket Subject : {SUBJECT}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Ticket ID:{ID} is Deleted.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: red; font-family: Verdana;&quot;&gt;&lt;strong&gt;*DO NOT REPLY TO THIS E-MAIL*&lt;/strong&gt;&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!&lt;/span&gt;&lt;/p&gt;","0","2018-03-15 16:15:47");
INSERT INTO kk_template VALUES("3","ticketresponce","Ticket Responce","Manasa Theme: Ticket Responce ","&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Hello,&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Staff just reply of your ticket &lt;/span&gt;&lt;strong&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;{SUBJECT}&lt;/span&gt;&lt;/strong&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Name: {NAME}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;ID: {ID}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Email Address: {EMAIL}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Message: {MESSAGE}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;You can manage this ticket here: {TICKETURL}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: red; font-family: Verdana;&quot;&gt;&lt;strong&gt;*DO NOT REPLY TO THIS E-MAIL*&lt;/strong&gt;&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!&lt;/span&gt;&lt;/p&gt;","0","2018-03-15 16:16:01");
INSERT INTO kk_template VALUES("4","ticketreply","Ticket Reply","Manasa Theme: Ticket Reply  ","&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Hello,&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;A new reply of ticket &lt;/span&gt;&lt;strong&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;{SUBJECT} &lt;/span&gt;&lt;/strong&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;has been submitted.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Name: {NAME}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Ticket ID: {ID}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Email Address: {EMAIL}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Message: {MESSAGE}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;You can manage this ticket here:&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;{TICKETURL}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: red; font-family: Verdana;&quot;&gt;&lt;strong&gt;*DO NOT REPLY TO THIS E-MAIL*&lt;/strong&gt;&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!&lt;/span&gt;&lt;/p&gt;","0","2018-03-15 16:16:06");
INSERT INTO kk_template VALUES("5","closeticket","Close Ticket","Manasa Theme: Close Ticket ","&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Ticket Close&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Ticket Subject : {SUBJECT}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Ticket ID:{ID} is Closed.&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;You can manage this ticket here&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;{TICKETURL}&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;color: red; font-family: Verdana;&quot;&gt;&lt;strong&gt;*DO NOT REPLY TO THIS E-MAIL*&lt;/strong&gt;&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!&lt;/span&gt;&lt;/p&gt;","0","2018-03-15 16:16:13");
INSERT INTO kk_template VALUES("6","newinvoice","New Invoice","Manasa Theme: Invoice Created","&lt;div data-mce-style=&quot;padding: 5px; font-size: 11pt; font-weight: bold;&quot; style=&quot;padding: 5px;&quot;&gt;&lt;font color=&quot;#222222&quot; face=&quot;verdana, droid sans, lucida sans, sans-serif&quot;&gt;&lt;span style=&quot;font-size: 13.3333px; font-family: Verdana;&quot;&gt;Hello {company},&lt;/span&gt;&lt;/font&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 5px; font-size: 11pt; font-weight: bold;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; padding: 5px; font-size: 11pt; font-weight: bold;&quot;&gt;&lt;span style=&quot;font-size: 13.3333px; font-weight: 400; font-family: Verdana;&quot;&gt;This email serves as your official invoice from&amp;nbsp;&lt;/span&gt;&lt;strong style=&quot;font-size: 13.3333px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;{business_name}.&lt;/span&gt;&lt;/strong&gt;&lt;br&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 10px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 10px 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Invoice URL: {inv_url}&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Invoice ID: {inv_id}&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Invoice Amount: {amount}&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Paid Amount: {paid}&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Due Amount: {due}&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Due Date: {due_date}&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 5px;&quot;&gt;&lt;span data-mce-style=&quot;font-size: 13.3333330154419px; line-height: 21.3333320617676px;&quot; style=&quot;font-size: 13.3333px; line-height: 21.3333px; font-family: Verdana;&quot;&gt;Invoice PDF has been attached to this mail. If you have any questions or need assistance, please don't hesitate to contact us.&lt;/span&gt;&lt;br&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Best Regards,&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;{business_name} Team&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;br&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;span style=&quot;font-family: Poppins, Poppins, sans-serif; font-size: 14px; color: red;&quot;&gt;&lt;span style=&quot;font-weight: bolder; font-family: Verdana;&quot;&gt;*DO NOT REPLY TO THIS E-MAIL*&lt;/span&gt;&lt;/span&gt;&lt;br style=&quot;color: rgb(0, 0, 0); font-family: Poppins, Poppins, sans-serif; font-size: 14px;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: Verdana; font-size: 14px;&quot;&gt;This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!&lt;/span&gt;&lt;br&gt;&lt;/div&gt;","0","2018-03-15 16:16:23");
INSERT INTO kk_template VALUES("7","newquotes","New Quotes","Manasa Theme: Quotes Created","&lt;div data-mce-style=&quot;padding: 5px; font-size: 11pt; font-weight: bold;&quot; style=&quot;padding: 5px;&quot;&gt;&lt;span style=&quot;color: rgb(34, 34, 34); font-family: Verdana; font-size: 13.3333px;&quot;&gt;Hello {company}&lt;/span&gt;&lt;br&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, sans-serif; font-size: 13.3333px; padding: 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Here is the quote you requested for {project_name}. The quote is valid until {valid_until}.&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 10px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, sans-serif; font-size: 13.3333px; padding: 10px 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Quote URL: {quote_url}&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 10px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, sans-serif; font-size: 13.3333px; padding: 10px 5px;&quot;&gt;&lt;span style=&quot;font-size: 13.3333px; font-family: Verdana;&quot;&gt;Amount:&amp;nbsp;{amount}&lt;/span&gt;&lt;br&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, sans-serif; font-size: 13.3333px; padding: 5px;&quot;&gt;&lt;span data-mce-style=&quot;font-size: 13.3333330154419px; line-height: 21.3333320617676px;&quot; style=&quot;font-size: 13.3333px; line-height: 21.3333px;&quot;&gt;&lt;span style=&quot;font-family: Verdana; font-size: 13.3333px;&quot;&gt;Quote PDF has been attached to this mail.&lt;/span&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;&amp;nbsp;You may view the quote at any time and if you have any query then contact us.&lt;/span&gt;&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, sans-serif; font-size: 13.3333px; padding: 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Best Regards,&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;{business_name} Team&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;br&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;span style=&quot;font-family: Poppins, Poppins, sans-serif; font-size: 14px; color: red;&quot;&gt;&lt;span style=&quot;font-weight: bolder; font-family: Verdana;&quot;&gt;*DO NOT REPLY TO THIS E-MAIL*&lt;/span&gt;&lt;/span&gt;&lt;br style=&quot;color: rgb(0, 0, 0); font-family: Poppins, Poppins, sans-serif; font-size: 14px;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: Verdana; font-size: 14px;&quot;&gt;This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!&lt;/span&gt;&lt;br&gt;&lt;/div&gt;","0","2018-03-15 16:17:02");
INSERT INTO kk_template VALUES("8","newuser","New Admin User","Manasa Theme: New Admin User ","&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;Hello {name},&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;Welcome to {business_name}.&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;Your admin credentials has been created. Now you can login to admin portal. See below for credentials...&amp;nbsp;&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;---------------------------------------------------------------------------------------&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;Login URL: {login_url}&amp;nbsp;&lt;br&gt;Username: {username}&lt;br&gt;Email Address: {email}&lt;br&gt;Password: {password}&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;----------------------------------------------------------------------------------------&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;We very much appreciate you for choosing us.&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;{business_name} Team&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;&lt;span style=&quot;font-family: Poppins, Poppins, sans-serif; color: red;&quot;&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;*DO NOT REPLY TO THIS E-MAIL*&lt;/span&gt;&lt;/span&gt;&lt;br style=&quot;font-family: Poppins, Poppins, sans-serif;&quot;&gt;&lt;span style=&quot;font-family: Poppins, Poppins, sans-serif;&quot;&gt;This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!&lt;/span&gt;&lt;br&gt;&lt;/p&gt;","0","2018-03-15 10:42:22");
INSERT INTO kk_template VALUES("9","newclient","New Client","Manasa Theme: New Client","&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;Dear {name},&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;Welcome to {business_name}.&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;You can track your invoice, quotes, tickets, profile, transactions from this portal.&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;Your login information is as follows:&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;---------------------------------------------------------------------------------------&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;Login URL: {client_login_url}&amp;nbsp;&lt;br&gt;Email Address: {email}&lt;br&gt;Password: Your chosen password.&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;----------------------------------------------------------------------------------------&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;We very much appreciate you for choosing us.&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;{business_name} Team&lt;/p&gt;&lt;p style=&quot;font-family: Verdana, Arial, Helvetica, sans-serif;&quot;&gt;&lt;span style=&quot;font-family: Poppins, Poppins, sans-serif; color: red;&quot;&gt;&lt;span style=&quot;font-weight: bolder;&quot;&gt;*DO NOT REPLY TO THIS E-MAIL*&lt;/span&gt;&lt;/span&gt;&lt;br style=&quot;font-family: Poppins, Poppins, sans-serif;&quot;&gt;&lt;span style=&quot;font-family: Poppins, Poppins, sans-serif;&quot;&gt;This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!&lt;/span&gt;&lt;br&gt;&lt;/p&gt;","0","2018-03-15 12:29:34");
INSERT INTO kk_template VALUES("10","forgotpassword","Forgot password","Manasa Theme: forgot Password","&lt;div data-mce-style=&quot;padding: 5px; font-size: 11pt; font-weight: bold;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; padding: 5px; font-size: 11pt; font-weight: bold;&quot;&gt;&lt;span style=&quot;font-size: 13.3333px; font-weight: 400; font-family: Verdana;&quot;&gt;Hello {name}&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 5px; font-size: 11pt; font-weight: bold;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; padding: 5px; font-size: 11pt; font-weight: bold;&quot;&gt;&lt;span style=&quot;font-size: 13.3333px; font-weight: 400; font-family: Verdana;&quot;&gt;This is to confirm that we have received a Forgot Password request for your Account Username - {email}&lt;/span&gt;&lt;br&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Click this link to reset your password-&amp;nbsp;&lt;/span&gt;&lt;br&gt;&lt;font color=&quot;#1da9c0&quot;&gt;&lt;span style=&quot;padding: 3px; font-family: Verdana;&quot;&gt;&lt;b&gt;{reset_link}&lt;/b&gt;&lt;/span&gt;&lt;/font&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Please note: until your password has been changed, your current password will remain valid. If you have not generated this request. Please contact us as soon as possible.&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Regards,&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;{business_name} Team&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;br&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;span style=&quot;font-family: Poppins, Poppins, sans-serif; font-size: 14px; color: red;&quot;&gt;&lt;span style=&quot;font-weight: bolder; font-family: Verdana;&quot;&gt;*DO NOT REPLY TO THIS E-MAIL*&lt;/span&gt;&lt;/span&gt;&lt;br style=&quot;color: rgb(0, 0, 0); font-family: Poppins, Poppins, sans-serif; font-size: 14px;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: Verdana; font-size: 14px;&quot;&gt;This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!&lt;/span&gt;&lt;br&gt;&lt;/div&gt;","0","2018-03-15 16:17:17");
INSERT INTO kk_template VALUES("11","paymentconfirmation","Payment Confirmation","Invoice Payment Confirmation","&lt;div data-mce-style=&quot;padding: 5px; font-size: 11pt;&quot; style=&quot;padding: 5px;&quot;&gt;&lt;font color=&quot;#222222&quot; face=&quot;verdana, droid sans, lucida sans, sans-serif&quot;&gt;&lt;span style=&quot;font-size: 13.3333px; font-family: Verdana;&quot;&gt;Hello {company},&lt;/span&gt;&lt;/font&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 5px; font-size: 11pt;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; padding: 5px; font-size: 11pt; font-weight: bold;&quot;&gt;&lt;span style=&quot;font-size: 13.3333px; font-weight: 400; font-family: Verdana;&quot;&gt;This is a payment receipt for Invoice {id}&lt;/span&gt;&lt;br&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Login to your client Portal to view this invoice.&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 10px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 10px 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Invoice URL: {inv_url}&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Invoice ID: {id}&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Paid Amount: {paid_amount}&lt;/span&gt;&lt;br style=&quot;font-size: 13.3333px;&quot;&gt;&lt;span style=&quot;font-size: 13.3333px; font-family: Verdana;&quot;&gt;Paid Date: {paid_date}&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Transaction Id: {txn_id}&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 5px;&quot;&gt;&lt;span data-mce-style=&quot;font-size: 13.3333330154419px; line-height: 21.3333320617676px;&quot; style=&quot;font-size: 13.3333px; line-height: 21.3333px; font-family: Verdana;&quot;&gt;If you have any questions or need assistance, please don't hesitate to contact us.&lt;/span&gt;&lt;br&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;Best Regards,&lt;/span&gt;&lt;br&gt;&lt;span style=&quot;font-family: Verdana;&quot;&gt;{business_name} Team&lt;/span&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;br&gt;&lt;/div&gt;&lt;div data-mce-style=&quot;padding: 0px 5px;&quot; style=&quot;color: rgb(34, 34, 34); font-family: verdana, &amp;quot;droid sans&amp;quot;, &amp;quot;lucida sans&amp;quot;, sans-serif; font-size: 13.3333px; padding: 0px 5px;&quot;&gt;&lt;span style=&quot;font-family: Poppins, Poppins, sans-serif; font-size: 14px; color: red;&quot;&gt;&lt;span style=&quot;font-weight: bolder; font-family: Verdana;&quot;&gt;*DO NOT REPLY TO THIS E-MAIL*&lt;/span&gt;&lt;/span&gt;&lt;br style=&quot;color: rgb(0, 0, 0); font-family: Poppins, Poppins, sans-serif; font-size: 14px;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: Verdana; font-size: 14px;&quot;&gt;This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!&lt;/span&gt;&lt;br&gt;&lt;/div&gt;","0","2018-03-15 16:17:25");



CREATE TABLE `kk_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `department` varchar(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `reply_status` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_updated` datetime NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_tickets_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `attached` text NOT NULL,
  `message_by` tinyint(1) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `kk_user_role` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO kk_user_role VALUES("1","Admin","You can not change Admin role setting","["company","company\/add","company\/edit","company\/delete","company\/view","contacts","contact\/add","contact\/edit","contact\/delete","projects","project\/add","project\/edit","project\/delete","quotes","quote\/add","quote\/edit","quote\/delete","invoices","invoice\/add","invoice\/edit","invoice\/delete","expenses","expense\/add","expense\/edit","expense\/delete","users","user\/add","user\/edit","user\/delete","subscriber","subscriber\/add","subscriber\/edit","subscriber\/delete"]","2018-01-11 04:45:47");
INSERT INTO kk_user_role VALUES("2","backoffice user","An employee of the company with basic rights.","["company","company\/add","company\/edit","company\/delete","company\/view","contacts","contact\/add","contact\/edit","contact\/delete","contact\/view","clients","client\/edit","leads","projects","quote\/view","invoices","invoice\/view","recurring","recurring\/view","tickets","expenses","expense\/add"]","2020-12-27 11:35:54");
INSERT INTO kk_user_role VALUES("3","backoffice partner","A Company partner","["company","company\/add","company\/edit","company\/delete","company\/view","clients","client\/edit","client\/delete","leads","lead\/add","lead\/edit","lead\/delete","projects","project\/add","project\/edit","project\/delete","quotes","quote\/add","quote\/edit","quote\/delete","quote\/view","invoices","invoice\/add","invoice\/edit","invoice\/delete","invoice\/view","recurring","recurring\/add","recurring\/edit","recurring\/delete","recurring\/view","tickets","ticket\/add","ticket\/edit","ticket\/delete","expenses","expense\/add","expense\/edit","expense\/delete","subscriber","subscriber\/add","subscriber\/edit","contacts","contact\/add","contact\/edit","contact\/delete","contact\/view","clients","client\/edit","client\/delete","leads","lead\/add","lead\/edit","lead\/delete","projects","project\/add","project\/edit","project\/delete","quotes","quote\/add","quote\/edit","quote\/delete","quote\/view","invoices","invoice\/add","invoice\/edit","invoice\/delete","invoice\/view","recurring","recurring\/add","recurring\/edit","recurring\/delete","recurring\/view","tickets","ticket\/add","ticket\/edit","ticket\/delete","expenses","expense\/add","expense\/edit","expense\/delete","subscriber","subscriber\/add","subscriber\/edit","subscriber\/delete"]","2020-12-27 19:04:14");



CREATE TABLE `kk_users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `user_role` int(4) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `meta` text,
  `other` text,
  `password` varchar(255) NOT NULL,
  `temp_hash` varchar(225) NOT NULL,
  `emailconfirmed` bit(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date_of_joining` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO kk_users VALUES("1","1","Administrator","Random Group ","Office Manager","info@rnggaming.com","99445314","{"dob":"13-10-1969","address1":"","address2":"","city":"San Gwann","country":"Malta","pin":"412169"}","","$2y$10$0iUweOHddWEHzw1x28TGzumoC9abaheodRCptprZCcIS4DErsZ.Bu","","1","1","2018-02-15 14:24:06");
INSERT INTO kk_users VALUES("7","3","mgalea","Mario","Galea","mario.s.galea@gmail.com","+35699445314","{"dob":"13-10-1969","address1":"46 Dawn","address2":"Ruzar Briffa Street","city":"Mosta","country":"Malta","pin":""}","","$2y$10$Y3fZmHAk.dwB0WlYQkgUvu/cVbhrIVJKNrHllx8JniZXajymRGdHu","a9df4d7126a092bc344ce8f73414d357","","1","2020-12-27 20:27:17");
INSERT INTO kk_users VALUES("8","3","ashortt","Aideen","Shortt","aideen.shortt@gmail.com","+35699061782","{"dob":"06-03-1974","address1":"13 The Olives","address2":"Gwann Mamo Street","city":"Msida","country":"Malta","pin":"MSD2103"}","","$2y$10$h8Dqa86HyKLUGKfoQsLhQuANyMm7NgCC7mpJxkzfi.kpsU/QahZfe","a2c54de7d56a6d19eca312feaedea89d","","1","2020-12-27 20:31:26");
INSERT INTO kk_users VALUES("9","2","vesna","Vesna","Jankovic","vesna@rnggaming.com","35699026276","{"dob":"26-03-72","address1":"2","address2":"Essex Street","city":"San Gwann","country":"Malta","pin":"SGN2000"}","","$2y$10$M8o8e83OBp5rw9klWM5I/OHW/O0BSpKtzXYKBb.VGqVIw5Y12s3Gi","50bd8cf40437382ac95c4ec87c3977c7","","1","2020-12-28 15:29:12");


-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: arepa
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB-0+deb9u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `app_empleados`
--

DROP TABLE IF EXISTS `app_empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_empleados` (
  `emp_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_edatosid` int(10) NOT NULL,
  `emp_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_comision_percentaje` decimal(23,10) DEFAULT '0.0000000000',
  `emp_tipo` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_balance` decimal(23,10) NOT NULL DEFAULT '0.0000000000',
  `emp_estatus` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`emp_id`),
  UNIQUE KEY `username` (`emp_username`),
  KEY `person_id` (`emp_edatosid`),
  CONSTRAINT `app_empleados_ibfk_1` FOREIGN KEY (`emp_edatosid`) REFERENCES `app_empleados_info` (`einfo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_empleados`
--

LOCK TABLES `app_empleados` WRITE;
/*!40000 ALTER TABLE `app_empleados` DISABLE KEYS */;
INSERT INTO `app_empleados` VALUES (1,1,'admin','$2y$10$hq6JfElH3OwlydrrQusQWegkdgrvQ/HzuWv0eAOaQblDo/kMbdd02',0.0000000000,NULL,43307.6908000000,1);
/*!40000 ALTER TABLE `app_empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_empleados_info`
--

DROP TABLE IF EXISTS `app_empleados_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_empleados_info` (
  `einfo_id` int(10) NOT NULL AUTO_INCREMENT,
  `einfo_nombres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `einfo_apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `einfo_telefono_movil` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `einfo_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `einfo_direccion_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `einfo_direccion_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `einfo_ciudad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `einfo_estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `einfo_pais` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `einfo_imagenid` int(10) DEFAULT NULL,
  `einfo_eliminado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`einfo_id`),
  KEY `first_name` (`einfo_nombres`),
  KEY `last_name` (`einfo_apellidos`),
  KEY `email` (`einfo_email`),
  KEY `app_people_ibfk_1` (`einfo_imagenid`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_empleados_info`
--

LOCK TABLES `app_empleados_info` WRITE;
/*!40000 ALTER TABLE `app_empleados_info` DISABLE KEYS */;
INSERT INTO `app_empleados_info` VALUES (1,'Gimón Villena','Gimón Villena','04120559631','gustavojgimon@gmail.com','Urb. Dominga Ortiz de Paez','Urb. Dominga Ortiz de Paez','1','222','1',1,0);
/*!40000 ALTER TABLE `app_empleados_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_modules`
--

DROP TABLE IF EXISTS `app_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_modules` (
  `module_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `module_parentid` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_lang_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc_lang_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(10) NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `desc_lang_key` (`desc_lang_key`),
  UNIQUE KEY `name_lang_key` (`name_lang_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_modules`
--

LOCK TABLES `app_modules` WRITE;
/*!40000 ALTER TABLE `app_modules` DISABLE KEYS */;
INSERT INTO `app_modules` VALUES ('empleados','','Empleados','module_empleados',20,'home','green');
/*!40000 ALTER TABLE `app_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_modules_actions`
--

DROP TABLE IF EXISTS `app_modules_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_modules_actions` (
  `action_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `module_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `action_name_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`action_id`,`module_id`),
  KEY `app_modules_actions_ibfk_1` (`module_id`),
  CONSTRAINT `app_modules_actions_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `app_modules` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_modules_actions`
--

LOCK TABLES `app_modules_actions` WRITE;
/*!40000 ALTER TABLE `app_modules_actions` DISABLE KEYS */;
INSERT INTO `app_modules_actions` VALUES ('add_update','empleados','add_update',1),('search','empleados','search',2);
/*!40000 ALTER TABLE `app_modules_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_paises`
--

DROP TABLE IF EXISTS `app_paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_paises` (
  `pa_id` int(11) NOT NULL AUTO_INCREMENT,
  `pa_codiso` tinytext,
  `pa_codpais` tinytext,
  `pa_nombre` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`pa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_paises`
--

LOCK TABLES `app_paises` WRITE;
/*!40000 ALTER TABLE `app_paises` DISABLE KEYS */;
INSERT INTO `app_paises` VALUES (1,'AW','ABW','Aruba'),(2,'AF','AFG','Afganistán'),(3,'AO','AGO','Angola'),(4,'AI','AIA','Anguila'),(5,'AX','ALA','Islas Gland'),(6,'AL','ALB','Albania'),(7,'AD','AND','Andorra'),(8,'AN','ANT','Antillas Holandesas'),(9,'AE','ARE','Emiratos Árabes Unidos'),(10,'AR','ARG','Argentina'),(11,'AM','ARM','Armenia'),(12,'AS','ASM','Samoa Americana'),(13,'AQ','ATA','Antártida'),(14,'TF','ATF','Territorios Australes Franceses'),(15,'AG','ATG','Antigua y Barbuda'),(16,'AU','AUS','Australia'),(17,'AT','AUT','Austria'),(18,'AZ','AZE','Azerbaiyán'),(19,'BI','BDI','Burundi'),(20,'BE','BEL','Bélgica'),(21,'BJ','BEN','Benín'),(22,'BF','BFA','Burkina Faso'),(23,'BD','BGD','Bangladesh'),(24,'BG','BGR','Bulgaria'),(25,'BH','BHR','Bahréin'),(26,'BS','BHS','Bahamas'),(27,'BA','BIH','Bosnia y Herzegovina'),(28,'BY','BLR','Bielorrusia'),(29,'BZ','BLZ','Belice'),(30,'BM','BMU','Bermudas'),(31,'BO','BOL','Bolivia'),(32,'BR','BRA','Brasil'),(33,'BB','BRB','Barbados'),(34,'BN','BRN','Brunéi'),(35,'BT','BTN','Bhután'),(36,'BV','BVT','Isla Bouvet'),(37,'BW','BWA','Botsuana'),(38,'CF','CAF','República Centroafricana'),(39,'CA','CAN','Canadá'),(40,'CC','CCK','Islas Cocos'),(41,'CH','CHE','Suiza'),(42,'CL','CHL','Chile'),(43,'CN','CHN','China'),(44,'CI','CIV','Costa de Marfil'),(45,'CM','CMR','Camerún'),(46,'CD','COD','República Democrática del Congo'),(47,'CG','COG','Congo'),(48,'CK','COK','Islas Cook'),(49,'CO','COL','Colombia'),(50,'KM','COM','Comoras'),(51,'CV','CPV','Cabo Verde'),(52,'CR','CRI','Costa Rica'),(53,'CU','CUB','Cuba'),(54,'CX','CXR','Isla de Navidad'),(55,'KY','CYM','Islas Caimán'),(56,'CY','CYP','Chipre'),(57,'CZ','CZE','República Checa'),(58,'DE','DEU','Alemania'),(59,'DJ','DJI','Yibuti'),(60,'DM','DMA','Dominica'),(61,'DK','DNK','Dinamarca'),(62,'DO','DOM','República Dominicana'),(63,'DZ','DZA','Argelia'),(64,'EC','ECU','Ecuador'),(65,'EG','EGY','Egipto'),(66,'ER','ERI','Eritrea'),(67,'EH','ESH','Sahara Occidental'),(68,'ES','ESP','España'),(69,'EE','EST','Estonia'),(70,'ET','ETH','Etiopía'),(71,'FI','FIN','Finlandia'),(72,'FJ','FJI','Fiyi'),(73,'FK','FLK','Islas Malvinas'),(74,'FR','FRA','Francia'),(75,'FO','FRO','Islas Feroe'),(76,'FM','FSM','Micronesia'),(77,'GA','GAB','Gabón'),(78,'GB','GBR','Reino Unido'),(79,'GE','GEO','Georgia'),(80,'GH','GHA','Ghana'),(81,'GI','GIB','Gibraltar'),(82,'GN','GIN','Guinea'),(83,'GP','GLP','Guadalupe'),(84,'GM','GMB','Gambia'),(85,'GW','GNB','Guinea-Bissau'),(86,'GQ','GNQ','Guinea Ecuatorial'),(87,'GR','GRC','Grecia'),(88,'GD','GRD','Granada'),(89,'GL','GRL','Groenlandia'),(90,'GT','GTM','Guatemala'),(91,'GF','GUF','Guayana Francesa'),(92,'GU','GUM','Guam'),(93,'GY','GUY','Guyana'),(94,'HK','HKG','Hong Kong'),(95,'HM','HMD','Islas Heard y McDonald'),(96,'HN','HND','Honduras'),(97,'HR','HRV','Croacia'),(98,'HT','HTI','Haití'),(99,'HU','HUN','Hungría'),(100,'ID','IDN','Indonesia'),(101,'IN','IND','India'),(102,'IO','IOT','Territorio Británico del Océano Índico'),(103,'IE','IRL','Irlanda'),(104,'IR','IRN','Irán'),(105,'IQ','IRQ','Iraq'),(106,'IS','ISL','Islandia'),(107,'IL','ISR','Israel'),(108,'IT','ITA','Italia'),(109,'JM','JAM','Jamaica'),(110,'JO','JOR','Jordania'),(111,'JP','JPN','Japón'),(112,'KZ','KAZ','Kazajstán'),(113,'KE','KEN','Kenia'),(114,'KG','KGZ','Kirguistán'),(115,'KH','KHM','Camboya'),(116,'KI','KIR','Kiribati'),(117,'KN','KNA','San Cristóbal y Nieves'),(118,'KR','KOR','Corea del Sur'),(119,'KW','KWT','Kuwait'),(120,'LA','LAO','Laos'),(121,'LB','LBN','Líbano'),(122,'LR','LBR','Liberia'),(123,'LY','LBY','Libia'),(124,'LC','LCA','Santa Lucía'),(125,'LI','LIE','Liechtenstein'),(126,'LK','LKA','Sri Lanka'),(127,'LS','LSO','Lesotho'),(128,'LT','LTU','Lituania'),(129,'LU','LUX','Luxemburgo'),(130,'LV','LVA','Letonia'),(131,'MO','MAC','Macao'),(132,'MA','MAR','Marruecos'),(133,'MC','MCO','Mónaco'),(134,'MD','MDA','Moldavia'),(135,'MG','MDG','Madagascar'),(136,'MV','MDV','Maldivas'),(137,'MX','MEX','México'),(138,'MH','MHL','Islas Marshall'),(139,'MK','MKD','Macedonia'),(140,'ML','MLI','Malí'),(141,'MT','MLT','Malta'),(142,'MM','MMR','Myanmar'),(143,'ME','MNE','Montenegro'),(144,'MN','MNG','Mongolia'),(145,'MP','MNP','Islas Marianas del Norte'),(146,'MZ','MOZ','Mozambique'),(147,'MR','MRT','Mauritania'),(148,'MS','MSR','Montserrat'),(149,'MQ','MTQ','Martinica'),(150,'MU','MUS','Mauricio'),(151,'MW','MWI','Malaui'),(152,'MY','MYS','Malasia'),(153,'YT','MYT','Mayotte'),(154,'NA','NAM','Namibia'),(155,'NC','NCL','Nueva Caledonia'),(156,'NE','NER','Níger'),(157,'NF','NFK','Isla Norfolk'),(158,'NG','NGA','Nigeria'),(159,'NI','NIC','Nicaragua'),(160,'NU','NIU','Niue'),(161,'NL','NLD','Países Bajos'),(162,'NO','NOR','Noruega'),(163,'NP','NPL','Nepal'),(164,'NR','NRU','Nauru'),(165,'NZ','NZL','Nueva Zelanda'),(166,'OM','OMN','Omán'),(167,'PK','PAK','Pakistán'),(168,'PA','PAN','Panamá'),(169,'PN','PCN','Islas Pitcairn'),(170,'PE','PER','Perú'),(171,'PH','PHL','Filipinas'),(172,'PW','PLW','Palaos'),(173,'PG','PNG','Papúa Nueva Guinea'),(174,'PL','POL','Polonia'),(175,'PR','PRI','Puerto Rico'),(176,'KP','PRK','Corea del Norte'),(177,'PT','PRT','Portugal'),(178,'PY','PRY','Paraguay'),(179,'PS','PSE','Palestina'),(180,'PF','PYF','Polinesia Francesa'),(181,'QA','QAT','Qatar'),(182,'RE','REU','Reunión'),(183,'RO','ROU','Rumania'),(184,'RU','RUS','Rusia'),(185,'RW','RWA','Ruanda'),(186,'SA','SAU','Arabia Saudí'),(187,'SD','SDN','Sudán'),(188,'SN','SEN','Senegal'),(189,'SG','SGP','Singapur'),(190,'GS','SGS','Islas Georgias del Sur y Sandwich del Sur'),(191,'SH','SHN','Santa Helena'),(192,'SJ','SJM','Svalbard y Jan Mayen'),(193,'SB','SLB','Islas Salomón'),(194,'SL','SLE','Sierra Leona'),(195,'SV','SLV','El Salvador'),(196,'SM','SMR','San Marino'),(197,'SO','SOM','Somalia'),(198,'PM','SPM','San Pedro y Miquelón'),(199,'RS','SRB','Serbia'),(200,'ST','STP','Santo Tomé y Príncipe'),(201,'SR','SUR','Surinam'),(202,'SK','SVK','Eslovaquia'),(203,'SI','SVN','Eslovenia'),(204,'SE','SWE','Suecia'),(205,'SZ','SWZ','Suazilandia'),(206,'SC','SYC','Seychelles'),(207,'SY','SYR','Siria'),(208,'TC','TCA','Islas Turcas y Caicos'),(209,'TD','TCD','Chad'),(210,'TG','TGO','Togo'),(211,'TH','THA','Tailandia'),(212,'TJ','TJK','Tayikistán'),(213,'TK','TKL','Tokelau'),(214,'TM','TKM','Turkmenistán'),(215,'TL','TLS','Timor Oriental'),(216,'TO','TON','Tonga'),(217,'TT','TTO','Trinidad y Tobago'),(218,'TN','TUN','Túnez'),(219,'TR','TUR','Turquía'),(220,'TV','TUV','Tuvalu'),(221,'TW','TWN','Taiwán'),(222,'TZ','TZA','Tanzania'),(223,'UG','UGA','Uganda'),(224,'UA','UKR','Ucrania'),(225,'UM','UMI','Islas Ultramarinas de Estados Unidos'),(226,'UY','URY','Uruguay'),(227,'US','USA','Estados Unidos'),(228,'UZ','UZB','Uzbekistán'),(229,'VA','VAT','Ciudad del Vaticano'),(230,'VC','VCT','San Vicente y las Granadinas'),(231,'VE','VEN','Venezuela'),(232,'VG','VGB','Islas Vírgenes Británicas'),(233,'VI','VIR','Islas Vírgenes de los Estados Unidos'),(234,'VN','VNM','Vietnam'),(235,'VU','VUT','Vanuatu'),(236,'WF','WLF','Wallis y Futuna'),(237,'WS','WSM','Samoa'),(238,'YE','YEM','Yemen'),(239,'ZA','ZAF','Sudáfrica'),(240,'ZM','ZMB','Zambia'),(241,'ZW','ZWE','Zimbabue');
/*!40000 ALTER TABLE `app_paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_permissions`
--

DROP TABLE IF EXISTS `app_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_permissions` (
  `module_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `emp_id` int(10) NOT NULL,
  PRIMARY KEY (`module_id`,`emp_id`),
  KEY `person_id` (`emp_id`),
  CONSTRAINT `app_permissions_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `app_empleados_info` (`einfo_id`),
  CONSTRAINT `app_permissions_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `app_modules` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_permissions`
--

LOCK TABLES `app_permissions` WRITE;
/*!40000 ALTER TABLE `app_permissions` DISABLE KEYS */;
INSERT INTO `app_permissions` VALUES ('empleados',1);
/*!40000 ALTER TABLE `app_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_permissions_actions`
--

DROP TABLE IF EXISTS `app_permissions_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_permissions_actions` (
  `module_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `emp_id` int(11) NOT NULL,
  `action_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`module_id`,`emp_id`,`action_id`),
  KEY `app_permissions_actions_ibfk_2` (`emp_id`),
  KEY `app_permissions_actions_ibfk_3` (`action_id`),
  CONSTRAINT `app_permissions_actions_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `app_modules` (`module_id`),
  CONSTRAINT `app_permissions_actions_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `app_empleados_info` (`einfo_id`),
  CONSTRAINT `app_permissions_actions_ibfk_3` FOREIGN KEY (`action_id`) REFERENCES `app_modules_actions` (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_permissions_actions`
--

LOCK TABLES `app_permissions_actions` WRITE;
/*!40000 ALTER TABLE `app_permissions_actions` DISABLE KEYS */;
INSERT INTO `app_permissions_actions` VALUES ('empleados',1,'add_update'),('empleados',1,'search');
/*!40000 ALTER TABLE `app_permissions_actions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-28 22:49:30

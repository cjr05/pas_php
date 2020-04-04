-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: localhost    Database: pas_php
-- ------------------------------------------------------
-- Server version	5.5.53

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth` (
  `auth_id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(255) DEFAULT NULL,
  `auth_pid` int(255) DEFAULT NULL,
  `auth_c` varchar(255) NOT NULL,
  `auth_a` varchar(255) NOT NULL,
  PRIMARY KEY (`auth_id`)
) ENGINE=MyISAM AUTO_INCREMENT=209 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES (103,'员工信息',0,'',''),(201,'项目列表',105,'Project','project'),(202,'发布项目',105,'Project','add'),(203,'员工列表',103,'People','people'),(204,'添加员工',103,'People','add'),(102,'账户管理',0,'',''),(104,'财务管理',0,'',''),(206,'资金拨款',104,'Finance','finance'),(205,'修改信息',102,'Account','account'),(105,'项目管理',0,'',''),(106,'流程管理',0,'',''),(207,'类型列表',106,'Addprocess','process'),(208,'项目流程',106,'Addprocess','project');
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jiedian`
--

DROP TABLE IF EXISTS `jiedian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jiedian` (
  `code` int(33) NOT NULL,
  `name` varchar(33) NOT NULL,
  `people` varchar(33) NOT NULL,
  `jiedian` varchar(33) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jiedian`
--

LOCK TABLES `jiedian` WRITE;
/*!40000 ALTER TABLE `jiedian` DISABLE KEYS */;
INSERT INTO `jiedian` VALUES (0,'','','',0),(0,'','','',0),(1585809695,'游客126892125','admin','admin',0);
/*!40000 ALTER TABLE `jiedian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_name` varchar(33) NOT NULL,
  `auth_id` varchar(255) DEFAULT NULL,
  `auth_ca` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (2,'财务','123','','102,205,104,206','Finance-finance,Finance-see,Account-account,Index-see'),(3,'admin','123','',NULL,''),(4,'经理','123','','105,102,205,202,201','Manager-login,Account-account,Account-upd,Project-add,Project-see,Project-project'),(5,'员工','123','','102,105,205,201,202,106,208','Manager-login,Account-account,Account-upd,Project-project,Project-add,Project-see,Project-update,Addprocess-project');
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(22) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan`
--

LOCK TABLES `plan` WRITE;
/*!40000 ALTER TABLE `plan` DISABLE KEYS */;
INSERT INTO `plan` VALUES (1,'发起','负责人'),(2,'审核','超级管理员'),(3,'拨款','财务管理员');
/*!40000 ALTER TABLE `plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `principal`
--

DROP TABLE IF EXISTS `principal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `principal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `people` varchar(255) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `principal`
--

LOCK TABLES `principal` WRITE;
/*!40000 ALTER TABLE `principal` DISABLE KEYS */;
INSERT INTO `principal` VALUES (5,'吴昊','321321,dsa'),(4,'吴昊','符传越,李恩公开'),(13,'5号','6号,七号'),(14,'321321','3,2,1'),(15,'wuhao','1,2,3,4'),(16,'11','11'),(17,'wh','11,22,223'),(18,'wh','wh,吴浩,其他'),(102,'admin','wh,jack'),(103,'admin','wh,jack,xiaoxin'),(104,'admin','wh,jack,xiaoxin,jackCheng'),(108,'员工','无');
/*!40000 ALTER TABLE `principal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process`
--

DROP TABLE IF EXISTS `process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_type` varchar(255) DEFAULT NULL,
  `uid` int(9) NOT NULL,
  `uid_user` varchar(33) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process`
--

LOCK TABLES `process` WRITE;
/*!40000 ALTER TABLE `process` DISABLE KEYS */;
INSERT INTO `process` VALUES (1,'国土批建',0,''),(2,'商品进货',0,''),(6,'其他',0,'');
/*!40000 ALTER TABLE `process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `people` varchar(255) DEFAULT NULL,
  `other` varchar(33) NOT NULL,
  `money` int(11) DEFAULT NULL,
  `reason` longtext,
  `process_type` varchar(255) DEFAULT NULL,
  `ctime` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '1.已审批   0.未审批  -1.被退回',
  `is_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1.正常 0.禁用',
  `mstatus` tinyint(4) DEFAULT '0' COMMENT '1.已拨款  0.未拨款',
  `done` tinyint(4) DEFAULT '0' COMMENT '1.已完成 0.未完成',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (115,'知识产权','员工','团队经营',100000,'保护知识产权，更多的人享受待遇','其他','2020-04-04 09:55:11',0,1,0,0),(114,'建材购买','员工','wh,jack,xiaoxin,jackCheng',1000000,'多少点券来的','国土批建','2020-04-03 04:51:19',1,1,1,1),(113,'希望工程','员工','希望工程团队',1000000,'希望帮助更多的人。','其他','2020-04-02 04:31:37',1,1,1,0);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-04 17:11:51

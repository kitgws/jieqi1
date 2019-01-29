-- MySQL dump 10.13  Distrib 5.5.54, for Win32 (AMD64)
--
-- Host: localhost    Database: yuehuatai7
-- ------------------------------------------------------
-- Server version	5.5.54

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
-- Table structure for table `jieqi_article_actlog`
--

DROP TABLE IF EXISTS `jieqi_article_actlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_actlog` (
  `actlogid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) NOT NULL DEFAULT '',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(30) NOT NULL DEFAULT '',
  `tid` int(11) unsigned NOT NULL DEFAULT '0',
  `tname` varchar(30) NOT NULL DEFAULT '',
  `linkid` int(11) unsigned NOT NULL DEFAULT '0',
  `acttype` smallint(6) unsigned NOT NULL DEFAULT '0',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0',
  `actname` varchar(50) NOT NULL DEFAULT '',
  `actnum` int(11) unsigned NOT NULL DEFAULT '0',
  `actvalue` int(11) unsigned NOT NULL DEFAULT '0',
  `islog` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `credit` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `egold` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`actlogid`),
  KEY `articleid` (`articleid`,`actlogid`),
  KEY `uid` (`uid`,`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_actlog`
--

LOCK TABLES `jieqi_article_actlog` WRITE;
/*!40000 ALTER TABLE `jieqi_article_actlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_actlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_applywriter`
--

DROP TABLE IF EXISTS `jieqi_article_applywriter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_applywriter` (
  `applyid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `applytime` int(11) unsigned NOT NULL DEFAULT '0',
  `applyuid` int(11) unsigned NOT NULL DEFAULT '0',
  `applyname` varchar(30) NOT NULL DEFAULT '',
  `penname` varchar(30) NOT NULL DEFAULT '',
  `authtime` int(11) unsigned NOT NULL DEFAULT '0',
  `authuid` int(11) unsigned NOT NULL DEFAULT '0',
  `authname` varchar(30) NOT NULL DEFAULT '',
  `applytitle` varchar(100) NOT NULL DEFAULT '',
  `applytext` mediumtext,
  `applysize` int(11) unsigned NOT NULL DEFAULT '0',
  `authnote` text,
  `applyflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`applyid`),
  KEY `applyflag` (`applyflag`),
  KEY `applyename` (`applyname`),
  KEY `authname` (`authname`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_applywriter`
--

LOCK TABLES `jieqi_article_applywriter` WRITE;
/*!40000 ALTER TABLE `jieqi_article_applywriter` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_applywriter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_article`
--

DROP TABLE IF EXISTS `jieqi_article_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_article` (
  `articleid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourceid` int(11) unsigned NOT NULL DEFAULT '0',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) NOT NULL DEFAULT '',
  `articlecode` varchar(100) NOT NULL DEFAULT '',
  `backupname` varchar(50) NOT NULL DEFAULT '',
  `keywords` varchar(200) NOT NULL DEFAULT '',
  `roles` varchar(200) NOT NULL DEFAULT '',
  `initial` char(1) NOT NULL DEFAULT '',
  `authorid` int(11) unsigned NOT NULL DEFAULT '0',
  `author` varchar(30) NOT NULL DEFAULT '',
  `posterid` int(11) unsigned NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `agentid` int(11) unsigned NOT NULL DEFAULT '0',
  `agent` varchar(30) NOT NULL DEFAULT '',
  `masterid` int(11) unsigned NOT NULL DEFAULT '0',
  `master` varchar(30) NOT NULL DEFAULT '',
  `sortid` smallint(3) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(3) unsigned NOT NULL DEFAULT '0',
  `libid` smallint(3) unsigned NOT NULL DEFAULT '0',
  `intro` text,
  `notice` text,
  `foreword` text,
  `setting` text,
  `lastvolumeid` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvolume` varchar(100) NOT NULL DEFAULT '',
  `lastchapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `lastchapter` varchar(100) NOT NULL DEFAULT '',
  `lastsummary` text,
  `chapters` smallint(6) unsigned NOT NULL DEFAULT '0',
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `daysize` int(11) unsigned NOT NULL DEFAULT '0',
  `weeksize` int(11) unsigned NOT NULL DEFAULT '0',
  `monthsize` int(11) unsigned NOT NULL DEFAULT '0',
  `presize` int(11) unsigned NOT NULL DEFAULT '0',
  `monthupds` int(11) unsigned NOT NULL DEFAULT '0',
  `preupds` int(11) unsigned NOT NULL DEFAULT '0',
  `monthupdt` int(11) unsigned NOT NULL DEFAULT '0',
  `preupdt` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `dayvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `weekvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `monthvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `allvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvote` int(11) unsigned NOT NULL DEFAULT '0',
  `dayvote` int(11) unsigned NOT NULL DEFAULT '0',
  `weekvote` int(11) unsigned NOT NULL DEFAULT '0',
  `monthvote` int(11) unsigned NOT NULL DEFAULT '0',
  `allvote` int(11) unsigned NOT NULL DEFAULT '0',
  `lastdown` int(11) unsigned NOT NULL DEFAULT '0',
  `daydown` int(11) unsigned NOT NULL DEFAULT '0',
  `weekdown` int(11) unsigned NOT NULL DEFAULT '0',
  `monthdown` int(11) unsigned NOT NULL DEFAULT '0',
  `alldown` int(11) unsigned NOT NULL DEFAULT '0',
  `lastflower` int(11) unsigned NOT NULL DEFAULT '0',
  `dayflower` int(11) unsigned NOT NULL DEFAULT '0',
  `weekflower` int(11) unsigned NOT NULL DEFAULT '0',
  `monthflower` int(11) unsigned NOT NULL DEFAULT '0',
  `allflower` int(11) unsigned NOT NULL DEFAULT '0',
  `preflower` int(11) unsigned NOT NULL DEFAULT '0',
  `lastegg` int(11) unsigned NOT NULL DEFAULT '0',
  `dayegg` int(11) unsigned NOT NULL DEFAULT '0',
  `weekegg` int(11) unsigned NOT NULL DEFAULT '0',
  `monthegg` int(11) unsigned NOT NULL DEFAULT '0',
  `allegg` int(11) unsigned NOT NULL DEFAULT '0',
  `preegg` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvipvote` int(11) unsigned NOT NULL DEFAULT '0',
  `dayvipvote` int(11) unsigned NOT NULL DEFAULT '0',
  `weekvipvote` int(11) unsigned NOT NULL DEFAULT '0',
  `monthvipvote` int(11) unsigned NOT NULL DEFAULT '0',
  `allvipvote` int(11) unsigned NOT NULL DEFAULT '0',
  `previpvote` int(11) unsigned NOT NULL DEFAULT '0',
  `hotnum` int(11) unsigned NOT NULL DEFAULT '0',
  `goodnum` int(11) unsigned NOT NULL DEFAULT '0',
  `reviewsnum` int(11) unsigned NOT NULL DEFAULT '0',
  `ratenum` int(11) unsigned NOT NULL DEFAULT '0',
  `ratesum` int(11) unsigned NOT NULL DEFAULT '0',
  `rate1` int(11) unsigned NOT NULL DEFAULT '0',
  `rate2` int(11) unsigned NOT NULL DEFAULT '0',
  `rate3` int(11) unsigned NOT NULL DEFAULT '0',
  `rate4` int(11) unsigned NOT NULL DEFAULT '0',
  `rate5` int(11) unsigned NOT NULL DEFAULT '0',
  `toptime` int(11) unsigned NOT NULL DEFAULT '0',
  `saleprice` int(11) unsigned NOT NULL DEFAULT '0',
  `salenum` int(11) unsigned NOT NULL DEFAULT '0',
  `totalcost` int(11) unsigned NOT NULL DEFAULT '0',
  `articletype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `permission` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `firstflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `fullflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `imgflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `upaudit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `power` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `progress` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issign` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `signtime` int(11) unsigned NOT NULL DEFAULT '0',
  `buyout` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `monthly` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `discount` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `quality` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isshort` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `inmatch` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isshare` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `rgroup` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ispub` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pubtime` int(11) unsigned NOT NULL DEFAULT '0',
  `pubid` int(11) unsigned NOT NULL DEFAULT '0',
  `pubisbn` varchar(100) NOT NULL DEFAULT '',
  `pubinfo` text,
  `freetime` int(11) unsigned NOT NULL DEFAULT '0',
  `freesize` int(11) unsigned NOT NULL DEFAULT '0',
  `isvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `viptime` int(11) unsigned NOT NULL DEFAULT '0',
  `vipid` int(11) unsigned NOT NULL DEFAULT '0',
  `vippubid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `vipchapters` smallint(6) unsigned NOT NULL DEFAULT '0',
  `vipsize` int(11) unsigned NOT NULL DEFAULT '0',
  `vipvolumeid` int(11) unsigned NOT NULL DEFAULT '0',
  `vipvolume` varchar(100) NOT NULL DEFAULT '',
  `vipchapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `vipchapter` varchar(100) NOT NULL DEFAULT '',
  `vipsummary` text,
  `redrose` int(11) unsigned NOT NULL DEFAULT '0',
  `yellowrose` int(11) unsigned NOT NULL DEFAULT '0',
  `greenrose` int(11) unsigned NOT NULL DEFAULT '0',
  `bluerose` int(11) unsigned NOT NULL DEFAULT '0',
  `whiterose` int(11) unsigned NOT NULL DEFAULT '0',
  `blackrose` int(11) unsigned NOT NULL DEFAULT '0',
  `rosenum` int(11) unsigned NOT NULL DEFAULT '0',
  `gifts` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`articleid`),
  KEY `articlename` (`articlename`),
  KEY `posterid` (`posterid`),
  KEY `authorid` (`authorid`),
  KEY `sortid` (`sortid`,`typeid`),
  KEY `size` (`size`),
  KEY `lastupdate` (`lastupdate`),
  KEY `author` (`author`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_article`
--

LOCK TABLES `jieqi_article_article` WRITE;
/*!40000 ALTER TABLE `jieqi_article_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_articlelog`
--

DROP TABLE IF EXISTS `jieqi_article_articlelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_articlelog` (
  `logid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `logtime` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(255) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `chapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `chaptername` varchar(255) NOT NULL DEFAULT '',
  `reason` text,
  `chginfo` text,
  `chglog` text,
  `ischapter` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isdel` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `databak` mediumtext,
  PRIMARY KEY (`logid`),
  KEY `userid` (`userid`),
  KEY `ischapter` (`ischapter`),
  KEY `isdel` (`isdel`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_articlelog`
--

LOCK TABLES `jieqi_article_articlelog` WRITE;
/*!40000 ALTER TABLE `jieqi_article_articlelog` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_articlelog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_attachs`
--

DROP TABLE IF EXISTS `jieqi_article_attachs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_attachs` (
  `attachid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `chapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(80) NOT NULL DEFAULT '',
  `class` varchar(30) NOT NULL DEFAULT '',
  `postfix` varchar(30) NOT NULL DEFAULT '',
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `needexp` int(11) unsigned NOT NULL DEFAULT '0',
  `uptime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`attachid`),
  KEY `articleid` (`articleid`),
  KEY `chapterid` (`chapterid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_attachs`
--

LOCK TABLES `jieqi_article_attachs` WRITE;
/*!40000 ALTER TABLE `jieqi_article_attachs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_attachs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_avote`
--

DROP TABLE IF EXISTS `jieqi_article_avote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_avote` (
  `voteid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `item1` varchar(100) NOT NULL DEFAULT '',
  `item2` varchar(100) NOT NULL DEFAULT '',
  `item3` varchar(100) NOT NULL DEFAULT '',
  `item4` varchar(100) NOT NULL DEFAULT '',
  `item5` varchar(100) NOT NULL DEFAULT '',
  `item6` varchar(100) NOT NULL DEFAULT '',
  `item7` varchar(100) NOT NULL DEFAULT '',
  `item8` varchar(100) NOT NULL DEFAULT '',
  `item9` varchar(100) NOT NULL DEFAULT '',
  `item10` varchar(100) NOT NULL DEFAULT '',
  `useitem` tinyint(2) NOT NULL DEFAULT '0',
  `description` text,
  `ispublish` tinyint(1) NOT NULL DEFAULT '0',
  `mulselect` tinyint(1) NOT NULL DEFAULT '0',
  `timelimit` tinyint(1) NOT NULL DEFAULT '0',
  `needlogin` tinyint(1) NOT NULL DEFAULT '0',
  `starttime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`voteid`),
  KEY `articleid` (`articleid`,`ispublish`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_avote`
--

LOCK TABLES `jieqi_article_avote` WRITE;
/*!40000 ALTER TABLE `jieqi_article_avote` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_avote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_avstat`
--

DROP TABLE IF EXISTS `jieqi_article_avstat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_avstat` (
  `statid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `voteid` int(11) unsigned NOT NULL DEFAULT '0',
  `statall` int(11) unsigned NOT NULL DEFAULT '0',
  `stat1` int(11) unsigned NOT NULL DEFAULT '0',
  `stat2` int(11) unsigned NOT NULL DEFAULT '0',
  `stat3` int(11) unsigned NOT NULL DEFAULT '0',
  `stat4` int(11) unsigned NOT NULL DEFAULT '0',
  `stat5` int(11) unsigned NOT NULL DEFAULT '0',
  `stat6` int(11) unsigned NOT NULL DEFAULT '0',
  `stat7` int(11) unsigned NOT NULL DEFAULT '0',
  `stat8` int(11) unsigned NOT NULL DEFAULT '0',
  `stat9` int(11) unsigned NOT NULL DEFAULT '0',
  `stat10` int(11) unsigned NOT NULL DEFAULT '0',
  `canstat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`statid`),
  KEY `voteid` (`voteid`,`canstat`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_avstat`
--

LOCK TABLES `jieqi_article_avstat` WRITE;
/*!40000 ALTER TABLE `jieqi_article_avstat` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_avstat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_bookcase`
--

DROP TABLE IF EXISTS `jieqi_article_bookcase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_bookcase` (
  `caseid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `classid` smallint(3) NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `chapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `chaptername` varchar(100) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `chapterorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `joindate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`caseid`),
  KEY `articleid` (`articleid`),
  KEY `userid` (`userid`,`classid`),
  KEY `chapterid` (`chapterid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_bookcase`
--

LOCK TABLES `jieqi_article_bookcase` WRITE;
/*!40000 ALTER TABLE `jieqi_article_bookcase` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_bookcase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_chapter`
--

DROP TABLE IF EXISTS `jieqi_article_chapter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_chapter` (
  `chapterid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourceid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourcecid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourcecorder` int(11) unsigned NOT NULL DEFAULT '0',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `volumeid` int(11) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) unsigned NOT NULL DEFAULT '0',
  `poster` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(11) unsigned NOT NULL DEFAULT '0',
  `chaptername` varchar(100) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `chapterorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `saleprice` int(11) unsigned NOT NULL DEFAULT '0',
  `salenum` int(11) unsigned NOT NULL DEFAULT '0',
  `totalcost` int(11) unsigned NOT NULL DEFAULT '0',
  `attachment` text,
  `summary` text,
  `isimage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(6) unsigned NOT NULL DEFAULT '0',
  `chaptertype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `power` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`chapterid`),
  KEY `lastupdate` (`lastupdate`),
  KEY `articleid` (`articleid`,`chapterorder`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_chapter`
--

LOCK TABLES `jieqi_article_chapter` WRITE;
/*!40000 ALTER TABLE `jieqi_article_chapter` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_chapter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_credit`
--

DROP TABLE IF EXISTS `jieqi_article_credit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_credit` (
  `creditid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) NOT NULL DEFAULT '',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(30) NOT NULL DEFAULT '',
  `point` int(11) unsigned NOT NULL DEFAULT '0',
  `payegold` int(11) unsigned NOT NULL DEFAULT '0',
  `buyegold` int(11) unsigned NOT NULL DEFAULT '0',
  `upnum` int(11) unsigned NOT NULL DEFAULT '0',
  `uptime` int(11) unsigned NOT NULL DEFAULT '0',
  `vars` text,
  PRIMARY KEY (`creditid`),
  UNIQUE KEY `uid` (`uid`,`articleid`),
  KEY `articleid` (`articleid`,`point`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_credit`
--

LOCK TABLES `jieqi_article_credit` WRITE;
/*!40000 ALTER TABLE `jieqi_article_credit` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_credit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_draft`
--

DROP TABLE IF EXISTS `jieqi_article_draft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_draft` (
  `draftid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) NOT NULL DEFAULT '',
  `volumeid` int(11) unsigned NOT NULL DEFAULT '0',
  `volumename` varchar(100) NOT NULL DEFAULT '',
  `chapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `chapterorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `chaptertype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) unsigned NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(11) unsigned NOT NULL DEFAULT '0',
  `ispub` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pubdate` int(11) unsigned NOT NULL DEFAULT '0',
  `saleprice` int(11) NOT NULL DEFAULT '0',
  `chaptername` varchar(100) NOT NULL DEFAULT '',
  `chaptercontent` mediumtext,
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `note` text,
  `attachment` text,
  `isimage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `power` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `draftflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`draftid`),
  KEY `articleid` (`articleid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_draft`
--

LOCK TABLES `jieqi_article_draft` WRITE;
/*!40000 ALTER TABLE `jieqi_article_draft` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_draft` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_gifts`
--

DROP TABLE IF EXISTS `jieqi_article_gifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_gifts` (
  `id` int(11) unsigned NOT NULL DEFAULT '0',
  `lastredrose` int(11) unsigned NOT NULL DEFAULT '0',
  `allredrose` int(11) unsigned NOT NULL DEFAULT '0',
  `monthredrose` int(11) unsigned NOT NULL DEFAULT '0',
  `weekredrose` int(11) unsigned NOT NULL DEFAULT '0',
  `dayredrose` int(11) unsigned NOT NULL DEFAULT '0',
  `lastyellowrose` int(11) unsigned NOT NULL DEFAULT '0',
  `allyellowrose` int(11) unsigned NOT NULL DEFAULT '0',
  `monthyellowrose` int(11) unsigned NOT NULL DEFAULT '0',
  `weekyellowrose` int(11) unsigned NOT NULL DEFAULT '0',
  `dayyellowrose` int(11) unsigned NOT NULL DEFAULT '0',
  `lastgreenrose` int(11) unsigned NOT NULL DEFAULT '0',
  `allgreenrose` int(11) unsigned NOT NULL DEFAULT '0',
  `monthgreenrose` int(11) unsigned NOT NULL DEFAULT '0',
  `weekgreenrose` int(11) unsigned NOT NULL DEFAULT '0',
  `daygreenrose` int(11) unsigned NOT NULL DEFAULT '0',
  `lastbluerose` int(11) unsigned NOT NULL DEFAULT '0',
  `allbluerose` int(11) unsigned NOT NULL DEFAULT '0',
  `monthbluerose` int(11) unsigned NOT NULL DEFAULT '0',
  `weekbluerose` int(11) unsigned NOT NULL DEFAULT '0',
  `daybluerose` int(11) unsigned NOT NULL DEFAULT '0',
  `lastwhiterose` int(11) unsigned NOT NULL DEFAULT '0',
  `allwhiterose` int(11) unsigned NOT NULL DEFAULT '0',
  `monthwhiterose` int(11) unsigned NOT NULL DEFAULT '0',
  `weekwhiterose` int(11) unsigned NOT NULL DEFAULT '0',
  `daywhiterose` int(11) unsigned NOT NULL DEFAULT '0',
  `lastblackrose` int(11) unsigned NOT NULL DEFAULT '0',
  `allblackrose` int(11) unsigned NOT NULL DEFAULT '0',
  `monthblackrose` int(11) unsigned NOT NULL DEFAULT '0',
  `weekblackrose` int(11) unsigned NOT NULL DEFAULT '0',
  `dayblackrose` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_gifts`
--

LOCK TABLES `jieqi_article_gifts` WRITE;
/*!40000 ALTER TABLE `jieqi_article_gifts` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_gifts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_hurry`
--

DROP TABLE IF EXISTS `jieqi_article_hurry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_hurry` (
  `hurryid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) NOT NULL DEFAULT '',
  `vipid` int(11) unsigned NOT NULL DEFAULT '0',
  `authorid` int(11) unsigned NOT NULL DEFAULT '0',
  `author` varchar(30) NOT NULL DEFAULT '',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(30) NOT NULL DEFAULT '',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0',
  `minsize` int(11) unsigned NOT NULL DEFAULT '0',
  `overtime` int(11) unsigned NOT NULL DEFAULT '0',
  `toolnum` int(11) unsigned NOT NULL DEFAULT '0',
  `payegold` int(11) unsigned NOT NULL DEFAULT '0',
  `taxegold` int(11) unsigned NOT NULL DEFAULT '0',
  `winegold` int(11) unsigned NOT NULL DEFAULT '0',
  `payflag` tinyint(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`hurryid`),
  KEY `articleid` (`articleid`),
  KEY `authorid` (`authorid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_hurry`
--

LOCK TABLES `jieqi_article_hurry` WRITE;
/*!40000 ALTER TABLE `jieqi_article_hurry` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_hurry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_replies`
--

DROP TABLE IF EXISTS `jieqi_article_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_replies` (
  `postid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `topicid` int(10) unsigned NOT NULL DEFAULT '0',
  `istopic` tinyint(1) NOT NULL DEFAULT '0',
  `replypid` int(10) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(10) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `posterip` varchar(25) NOT NULL DEFAULT '',
  `editorid` int(10) NOT NULL DEFAULT '0',
  `editor` varchar(30) NOT NULL DEFAULT '',
  `edittime` int(10) NOT NULL DEFAULT '0',
  `editorip` varchar(25) NOT NULL DEFAULT '',
  `editnote` varchar(250) NOT NULL DEFAULT '',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `attachment` text,
  `subject` varchar(80) NOT NULL DEFAULT '',
  `posttext` mediumtext,
  `size` int(11) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`postid`),
  KEY `ownerid` (`ownerid`),
  KEY `ptopicid` (`topicid`,`posttime`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_replies`
--

LOCK TABLES `jieqi_article_replies` WRITE;
/*!40000 ALTER TABLE `jieqi_article_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_review`
--

DROP TABLE IF EXISTS `jieqi_article_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_review` (
  `reviewid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(50) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `reviewtitle` varchar(100) NOT NULL DEFAULT '',
  `reviewtext` mediumtext,
  `topflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `goodflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`reviewid`),
  KEY `articleid` (`articleid`),
  KEY `userid` (`userid`),
  KEY `display` (`display`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_review`
--

LOCK TABLES `jieqi_article_review` WRITE;
/*!40000 ALTER TABLE `jieqi_article_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_reviews`
--

DROP TABLE IF EXISTS `jieqi_article_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_reviews` (
  `topicid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `replierid` int(10) NOT NULL DEFAULT '0',
  `replier` varchar(30) NOT NULL DEFAULT '',
  `replytime` int(11) NOT NULL DEFAULT '0',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `islock` tinyint(1) NOT NULL DEFAULT '0',
  `istop` int(11) NOT NULL DEFAULT '0',
  `isgood` tinyint(1) NOT NULL DEFAULT '0',
  `is_recommend` tinyint(1) DEFAULT '0',
  `rate` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  `needperm` int(10) unsigned NOT NULL DEFAULT '0',
  `needscore` int(10) unsigned NOT NULL DEFAULT '0',
  `needexp` int(10) unsigned NOT NULL DEFAULT '0',
  `needprice` int(10) unsigned NOT NULL DEFAULT '0',
  `sortid` tinyint(3) NOT NULL DEFAULT '0',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `typeid` tinyint(3) NOT NULL DEFAULT '0',
  `lastinfo` varchar(255) NOT NULL DEFAULT '',
  `linkurl` varchar(100) NOT NULL DEFAULT '',
  `size` int(11) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicid`),
  KEY `posterid` (`posterid`,`replytime`),
  KEY `ownerid` (`ownerid`,`istop`,`replytime`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_reviews`
--

LOCK TABLES `jieqi_article_reviews` WRITE;
/*!40000 ALTER TABLE `jieqi_article_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_searchcache`
--

DROP TABLE IF EXISTS `jieqi_article_searchcache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_searchcache` (
  `cacheid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `searchtime` int(11) unsigned NOT NULL DEFAULT '0',
  `hashid` varchar(32) NOT NULL DEFAULT '0',
  `keywords` varchar(60) NOT NULL DEFAULT '',
  `searchtype` tinyint(1) NOT NULL DEFAULT '0',
  `results` int(11) unsigned NOT NULL DEFAULT '0',
  `aids` text,
  PRIMARY KEY (`cacheid`),
  UNIQUE KEY `hashid` (`hashid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_searchcache`
--

LOCK TABLES `jieqi_article_searchcache` WRITE;
/*!40000 ALTER TABLE `jieqi_article_searchcache` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_searchcache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_share`
--

DROP TABLE IF EXISTS `jieqi_article_share`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_share` (
  `shareid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ssid` int(11) unsigned NOT NULL DEFAULT '0',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `articlename` varchar(100) NOT NULL DEFAULT '',
  `sflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sset` text NOT NULL,
  PRIMARY KEY (`shareid`),
  UNIQUE KEY `sa` (`ssid`,`articleid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_share`
--

LOCK TABLES `jieqi_article_share` WRITE;
/*!40000 ALTER TABLE `jieqi_article_share` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_share` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_sizelog`
--

DROP TABLE IF EXISTS `jieqi_article_sizelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_sizelog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `bookid` int(11) unsigned NOT NULL DEFAULT '0',
  `data` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_sizelog`
--

LOCK TABLES `jieqi_article_sizelog` WRITE;
/*!40000 ALTER TABLE `jieqi_article_sizelog` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_sizelog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_synclog`
--

DROP TABLE IF EXISTS `jieqi_article_synclog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_synclog` (
  `logid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `starttime` int(11) unsigned NOT NULL DEFAULT '0',
  `finishtime` int(11) unsigned NOT NULL DEFAULT '0',
  `fromtime` int(11) unsigned NOT NULL DEFAULT '0',
  `articlenum` int(11) unsigned NOT NULL DEFAULT '0',
  `finishnum` int(11) unsigned NOT NULL DEFAULT '0',
  `retcode` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issuccess` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`logid`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_synclog`
--

LOCK TABLES `jieqi_article_synclog` WRITE;
/*!40000 ALTER TABLE `jieqi_article_synclog` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_synclog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_tag`
--

DROP TABLE IF EXISTS `jieqi_article_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_tag` (
  `tagid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(30) NOT NULL DEFAULT '',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0',
  `tagsort` smallint(3) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `linknum` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `dayvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `weekvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `monthvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `allvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagid`),
  UNIQUE KEY `tagname` (`tagname`),
  KEY `linknum` (`linknum`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_tag`
--

LOCK TABLES `jieqi_article_tag` WRITE;
/*!40000 ALTER TABLE `jieqi_article_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_article_taglink`
--

DROP TABLE IF EXISTS `jieqi_article_taglink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_article_taglink` (
  `tagid` int(11) unsigned NOT NULL DEFAULT '0',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `linktime` int(11) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `tagarticle` (`tagid`,`articleid`),
  KEY `articleid` (`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_article_taglink`
--

LOCK TABLES `jieqi_article_taglink` WRITE;
/*!40000 ALTER TABLE `jieqi_article_taglink` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_article_taglink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_forum_attachs`
--

DROP TABLE IF EXISTS `jieqi_forum_attachs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_forum_attachs` (
  `attachid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `topicid` int(11) unsigned NOT NULL DEFAULT '0',
  `postid` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(80) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `class` varchar(30) NOT NULL DEFAULT '',
  `postfix` varchar(30) NOT NULL DEFAULT '',
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `needperm` int(10) unsigned NOT NULL DEFAULT '0',
  `needscore` int(10) unsigned NOT NULL DEFAULT '0',
  `needexp` int(11) unsigned NOT NULL DEFAULT '0',
  `needprice` int(10) unsigned NOT NULL DEFAULT '0',
  `uptime` int(11) NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `remote` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`attachid`),
  KEY `topicid` (`topicid`),
  KEY `postid` (`postid`,`attachid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_forum_attachs`
--

LOCK TABLES `jieqi_forum_attachs` WRITE;
/*!40000 ALTER TABLE `jieqi_forum_attachs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_forum_attachs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_forum_forumcat`
--

DROP TABLE IF EXISTS `jieqi_forum_forumcat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_forum_forumcat` (
  `catid` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `cattitle` varchar(100) NOT NULL DEFAULT '',
  `catorder` mediumint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`catid`),
  KEY `catorder` (`catorder`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_forum_forumcat`
--

LOCK TABLES `jieqi_forum_forumcat` WRITE;
/*!40000 ALTER TABLE `jieqi_forum_forumcat` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_forum_forumcat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_forum_forumposts`
--

DROP TABLE IF EXISTS `jieqi_forum_forumposts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_forum_forumposts` (
  `postid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `topicid` int(11) unsigned NOT NULL DEFAULT '0',
  `istopic` tinyint(1) NOT NULL DEFAULT '0',
  `replypid` int(10) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(10) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `posterip` varchar(25) NOT NULL DEFAULT '',
  `editorid` int(10) NOT NULL DEFAULT '0',
  `editor` varchar(30) NOT NULL DEFAULT '',
  `edittime` int(11) NOT NULL DEFAULT '0',
  `editorip` varchar(25) NOT NULL DEFAULT '',
  `editnote` varchar(250) NOT NULL DEFAULT '',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `attachment` text,
  `subject` varchar(80) NOT NULL DEFAULT '',
  `size` int(10) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '0',
  `posttext` mediumtext,
  PRIMARY KEY (`postid`),
  KEY `ownerid` (`ownerid`),
  KEY `ptopicid` (`topicid`,`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_forum_forumposts`
--

LOCK TABLES `jieqi_forum_forumposts` WRITE;
/*!40000 ALTER TABLE `jieqi_forum_forumposts` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_forum_forumposts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_forum_forums`
--

DROP TABLE IF EXISTS `jieqi_forum_forums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_forum_forums` (
  `forumid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `catid` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `forumname` varchar(100) NOT NULL DEFAULT '',
  `forumdesc` text,
  `forumstatus` tinyint(4) NOT NULL DEFAULT '0',
  `forumorder` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `forumtype` tinyint(1) NOT NULL DEFAULT '0',
  `forumtopics` int(11) unsigned NOT NULL DEFAULT '0',
  `forumposts` int(11) unsigned NOT NULL DEFAULT '0',
  `forumlastinfo` text,
  `authview` text,
  `authread` text,
  `authpost` text,
  `authreply` text,
  `authupload` text,
  `authedit` text,
  `authdelete` text,
  `master` text,
  PRIMARY KEY (`forumid`),
  KEY `forumorder` (`forumorder`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_forum_forums`
--

LOCK TABLES `jieqi_forum_forums` WRITE;
/*!40000 ALTER TABLE `jieqi_forum_forums` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_forum_forums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_forum_forumtopics`
--

DROP TABLE IF EXISTS `jieqi_forum_forumtopics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_forum_forumtopics` (
  `topicid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `posterid` int(10) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  `replierid` int(10) NOT NULL DEFAULT '0',
  `replier` varchar(30) NOT NULL DEFAULT '',
  `replytime` int(11) NOT NULL DEFAULT '0',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `islock` tinyint(1) NOT NULL DEFAULT '0',
  `istop` int(11) NOT NULL DEFAULT '0',
  `isgood` tinyint(1) NOT NULL DEFAULT '0',
  `rate` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  `needperm` int(10) unsigned NOT NULL DEFAULT '0',
  `needscore` int(10) unsigned NOT NULL DEFAULT '0',
  `needexp` int(10) unsigned NOT NULL DEFAULT '0',
  `needprice` int(10) unsigned NOT NULL DEFAULT '0',
  `sortid` tinyint(3) NOT NULL DEFAULT '0',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `typeid` tinyint(3) NOT NULL DEFAULT '0',
  `lastinfo` varchar(250) NOT NULL DEFAULT '',
  `linkurl` varchar(100) NOT NULL DEFAULT '',
  `size` int(11) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicid`),
  KEY `topictype` (`sortid`),
  KEY `ownerid` (`ownerid`,`istop`,`replytime`),
  KEY `posterid` (`posterid`,`replytime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_forum_forumtopics`
--

LOCK TABLES `jieqi_forum_forumtopics` WRITE;
/*!40000 ALTER TABLE `jieqi_forum_forumtopics` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_forum_forumtopics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_link_link`
--

DROP TABLE IF EXISTS `jieqi_link_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_link_link` (
  `linkid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `linktype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `namecolor` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `logo` varchar(250) NOT NULL DEFAULT '',
  `introduce` text,
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `mastername` varchar(50) NOT NULL DEFAULT '',
  `mastertell` varchar(250) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `passed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `addtime` int(20) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`linkid`),
  KEY `typeid` (`passed`,`listorder`,`linkid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_link_link`
--

LOCK TABLES `jieqi_link_link` WRITE;
/*!40000 ALTER TABLE `jieqi_link_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_link_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_news_attachment`
--

DROP TABLE IF EXISTS `jieqi_news_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_news_attachment` (
  `attachid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ownerid` int(11) unsigned NOT NULL DEFAULT '0',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0',
  `uptime` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `attachname` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  `attachtype` varchar(30) NOT NULL DEFAULT '',
  `attachflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `attachpath` varchar(100) NOT NULL DEFAULT '',
  `attachsize` int(11) unsigned NOT NULL DEFAULT '0',
  `downloads` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`attachid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_news_attachment`
--

LOCK TABLES `jieqi_news_attachment` WRITE;
/*!40000 ALTER TABLE `jieqi_news_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_news_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_news_content`
--

DROP TABLE IF EXISTS `jieqi_news_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_news_content` (
  `topicid` int(11) NOT NULL DEFAULT '0',
  `contents` mediumtext NOT NULL,
  PRIMARY KEY (`topicid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_news_content`
--

LOCK TABLES `jieqi_news_content` WRITE;
/*!40000 ALTER TABLE `jieqi_news_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_news_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_news_sort`
--

DROP TABLE IF EXISTS `jieqi_news_sort`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_news_sort` (
  `sortid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `sortorder` smallint(6) unsigned NOT NULL DEFAULT '100',
  `sortname` varchar(30) NOT NULL DEFAULT '',
  `shortname` varchar(12) NOT NULL DEFAULT '',
  `description` varchar(250) NOT NULL DEFAULT '',
  `layer` tinyint(3) NOT NULL DEFAULT '0',
  `routes` text NOT NULL,
  `childs` text NOT NULL,
  PRIMARY KEY (`sortid`),
  KEY `parentid` (`parentid`),
  KEY `sortorder` (`sortorder`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_news_sort`
--

LOCK TABLES `jieqi_news_sort` WRITE;
/*!40000 ALTER TABLE `jieqi_news_sort` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_news_sort` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_news_special`
--

DROP TABLE IF EXISTS `jieqi_news_special`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_news_special` (
  `speid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sortid` int(11) NOT NULL DEFAULT '0',
  `addtime` varchar(10) NOT NULL,
  `edittime` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(80) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `linknum` int(11) NOT NULL DEFAULT '0',
  `toptime` varchar(10) NOT NULL,
  `lastvisit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dayvisit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `weekvisit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `monthvisit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `allvisit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lastvote` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dayvote` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `weekvote` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `monthvote` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `allvote` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `imgflag` tinyint(1) NOT NULL DEFAULT '0',
  `isgood` tinyint(1) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`speid`),
  UNIQUE KEY `sortid` (`sortid`),
  KEY `linknum` (`linknum`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_news_special`
--

LOCK TABLES `jieqi_news_special` WRITE;
/*!40000 ALTER TABLE `jieqi_news_special` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_news_special` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_news_spelink`
--

DROP TABLE IF EXISTS `jieqi_news_spelink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_news_spelink` (
  `slinkid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `linkid` int(11) NOT NULL DEFAULT '0',
  `addtime` varchar(10) NOT NULL,
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `ltitle` varchar(80) NOT NULL DEFAULT '',
  `lurl` varchar(200) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `rank` tinyint(1) NOT NULL DEFAULT '0',
  `lorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `goodnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `badnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `iscustom` tinyint(1) NOT NULL DEFAULT '0',
  `isgood` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`slinkid`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_news_spelink`
--

LOCK TABLES `jieqi_news_spelink` WRITE;
/*!40000 ALTER TABLE `jieqi_news_spelink` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_news_spelink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_news_tag`
--

DROP TABLE IF EXISTS `jieqi_news_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_news_tag` (
  `tagid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(30) NOT NULL DEFAULT '',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0',
  `tagsort` smallint(3) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `linknum` int(11) unsigned NOT NULL DEFAULT '0',
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagid`),
  UNIQUE KEY `tagname` (`tagname`),
  KEY `linknum` (`linknum`),
  KEY `views` (`views`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_news_tag`
--

LOCK TABLES `jieqi_news_tag` WRITE;
/*!40000 ALTER TABLE `jieqi_news_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_news_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_news_taglink`
--

DROP TABLE IF EXISTS `jieqi_news_taglink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_news_taglink` (
  `tagid` int(11) unsigned NOT NULL DEFAULT '0',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `linktime` int(11) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `tagarticle` (`tagid`,`articleid`),
  KEY `articleid` (`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_news_taglink`
--

LOCK TABLES `jieqi_news_taglink` WRITE;
/*!40000 ALTER TABLE `jieqi_news_taglink` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_news_taglink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_news_topic`
--

DROP TABLE IF EXISTS `jieqi_news_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_news_topic` (
  `topicid` int(11) NOT NULL AUTO_INCREMENT,
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posterip` varchar(25) NOT NULL DEFAULT '',
  `masterid` int(11) NOT NULL DEFAULT '0',
  `master` varchar(30) NOT NULL DEFAULT '',
  `masterip` varchar(25) NOT NULL DEFAULT '',
  `addtime` int(11) NOT NULL DEFAULT '0',
  `uptime` int(11) NOT NULL DEFAULT '0',
  `sortid` int(11) NOT NULL DEFAULT '0',
  `areaid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `subhead` varchar(80) NOT NULL DEFAULT '',
  `tags` varchar(50) NOT NULL DEFAULT '',
  `author` varchar(30) NOT NULL DEFAULT '',
  `aurl` varchar(100) NOT NULL DEFAULT '',
  `source` varchar(50) NOT NULL DEFAULT '',
  `surl` varchar(100) NOT NULL DEFAULT '',
  `gourl` varchar(100) NOT NULL DEFAULT '',
  `summary` text NOT NULL,
  `style` tinyint(1) NOT NULL DEFAULT '0',
  `cover` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `attach` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `review` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vote` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `login` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `marknum` int(11) unsigned NOT NULL DEFAULT '0',
  `topnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `downnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `scorenum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `sumscore` int(11) unsigned NOT NULL DEFAULT '0',
  `reviews` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicid`),
  KEY `posterid` (`posterid`),
  KEY `sortid` (`sortid`),
  KEY `areaid` (`areaid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_news_topic`
--

LOCK TABLES `jieqi_news_topic` WRITE;
/*!40000 ALTER TABLE `jieqi_news_topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_news_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_obook_mreport`
--

DROP TABLE IF EXISTS `jieqi_obook_mreport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_obook_mreport` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(255) NOT NULL,
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `author` varchar(255) NOT NULL,
  `allsale` int(11) unsigned NOT NULL DEFAULT '0',
  `sumtip` int(11) unsigned NOT NULL DEFAULT '0',
  `sumgift` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_obook_mreport`
--

LOCK TABLES `jieqi_obook_mreport` WRITE;
/*!40000 ALTER TABLE `jieqi_obook_mreport` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_obook_mreport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_obook_obook`
--

DROP TABLE IF EXISTS `jieqi_obook_obook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_obook_obook` (
  `obookid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourceid` int(11) unsigned NOT NULL DEFAULT '0',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `initial` char(1) NOT NULL DEFAULT '',
  `sortid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `intro` text,
  `notice` text,
  `setting` text,
  `lastvolumeid` int(11) unsigned NOT NULL DEFAULT '0',
  `lastvolume` varchar(255) NOT NULL DEFAULT '',
  `lastchapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `lastchapter` varchar(255) NOT NULL DEFAULT '',
  `lastsummary` text,
  `chapters` smallint(6) unsigned NOT NULL DEFAULT '0',
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `authorid` int(11) unsigned NOT NULL DEFAULT '0',
  `author` varchar(50) NOT NULL DEFAULT '',
  `aintro` text,
  `agentid` int(11) unsigned NOT NULL DEFAULT '0',
  `agent` varchar(50) NOT NULL DEFAULT '',
  `masterid` int(11) unsigned NOT NULL DEFAULT '0',
  `master` varchar(30) NOT NULL DEFAULT '',
  `posterid` int(11) unsigned NOT NULL DEFAULT '0',
  `poster` varchar(50) NOT NULL DEFAULT '',
  `publishid` int(11) unsigned NOT NULL DEFAULT '0',
  `tbookinfo` text,
  `toptime` int(11) unsigned NOT NULL DEFAULT '0',
  `goodnum` int(11) unsigned NOT NULL DEFAULT '0',
  `badnum` int(11) unsigned NOT NULL DEFAULT '0',
  `fullflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `imgflag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `saleprice` int(11) unsigned NOT NULL DEFAULT '0',
  `vipprice` int(11) unsigned NOT NULL DEFAULT '0',
  `sumegold` int(11) unsigned NOT NULL DEFAULT '0',
  `sumesilver` int(11) unsigned NOT NULL DEFAULT '0',
  `sumtip` int(11) unsigned NOT NULL DEFAULT '0',
  `sumhurry` int(11) unsigned NOT NULL DEFAULT '0',
  `sumbesp` int(11) unsigned NOT NULL DEFAULT '0',
  `sumaward` int(11) unsigned NOT NULL DEFAULT '0',
  `sumagent` int(11) unsigned NOT NULL DEFAULT '0',
  `sumgift` int(11) unsigned NOT NULL DEFAULT '0',
  `sumother` int(11) unsigned NOT NULL DEFAULT '0',
  `sumemoney` int(11) unsigned NOT NULL DEFAULT '0',
  `summoney` int(11) unsigned NOT NULL DEFAULT '0',
  `paidmoney` int(11) unsigned NOT NULL DEFAULT '0',
  `paidemoney` int(11) unsigned NOT NULL DEFAULT '0',
  `paytime` int(11) unsigned NOT NULL DEFAULT '0',
  `normalsale` int(11) unsigned NOT NULL DEFAULT '0',
  `vipsale` int(11) unsigned NOT NULL DEFAULT '0',
  `freesale` int(11) unsigned NOT NULL DEFAULT '0',
  `bespsale` int(11) unsigned NOT NULL DEFAULT '0',
  `totalsale` int(11) unsigned NOT NULL DEFAULT '0',
  `daysale` int(11) unsigned NOT NULL DEFAULT '0',
  `weeksale` int(11) unsigned NOT NULL DEFAULT '0',
  `monthsale` int(11) unsigned NOT NULL DEFAULT '0',
  `allsale` int(11) unsigned NOT NULL DEFAULT '0',
  `lastsale` int(11) unsigned NOT NULL DEFAULT '0',
  `canvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `canfree` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `canbesp` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hasebook` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hastbook` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`obookid`),
  KEY `articleid` (`articleid`),
  KEY `obookname` (`obookname`),
  KEY `display` (`display`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `jieqi_obook_obuy`
--

DROP TABLE IF EXISTS `jieqi_obook_obuy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_obook_obuy` (
  `obuyid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `osaleid` int(11) unsigned NOT NULL DEFAULT '0',
  `buytime` int(11) unsigned NOT NULL DEFAULT '0',
  `lastbuy` int(11) unsigned NOT NULL DEFAULT '0',
  `lastread` int(11) unsigned NOT NULL DEFAULT '0',
  `readnum` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `ochapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) NOT NULL DEFAULT '',
  `chaptername` varchar(100) NOT NULL DEFAULT '',
  `chapternum` int(11) unsigned NOT NULL DEFAULT '0',
  `buynum` int(11) unsigned NOT NULL DEFAULT '0',
  `buypay` int(11) unsigned NOT NULL DEFAULT '0',
  `isread` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isfull` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `autobuy` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `buymode` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `starlevel` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `oflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`obuyid`),
  UNIQUE KEY `userid` (`userid`,`obookid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jieqi_obook_obuyinfo`
--

DROP TABLE IF EXISTS `jieqi_obook_obuyinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_obook_obuyinfo` (
  `obuyinfoid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `osaleid` int(11) unsigned NOT NULL DEFAULT '0',
  `buytime` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `ochapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) NOT NULL DEFAULT '',
  `chaptername` varchar(100) NOT NULL DEFAULT '',
  `lastread` int(11) unsigned NOT NULL DEFAULT '0',
  `readnum` int(11) unsigned NOT NULL DEFAULT '0',
  `checkcode` varchar(10) NOT NULL DEFAULT '',
  `buyprice` int(11) unsigned NOT NULL DEFAULT '0',
  `buynum` int(11) unsigned NOT NULL DEFAULT '0',
  `buypay` int(11) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`obuyinfoid`),
  KEY `userid` (`userid`),
  KEY `obookid` (`obookid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jieqi_obook_ochapter`
--

DROP TABLE IF EXISTS `jieqi_obook_ochapter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_obook_ochapter` (
  `ochapterid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourceid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourcecid` int(11) unsigned NOT NULL DEFAULT '0',
  `sourcecorder` int(11) unsigned NOT NULL DEFAULT '0',
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `chapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `postdate` int(11) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(11) unsigned NOT NULL DEFAULT '0',
  `buytime` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) NOT NULL DEFAULT '',
  `chaptername` varchar(100) NOT NULL DEFAULT '',
  `chaptertype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `chapterorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `volumeid` int(11) unsigned NOT NULL DEFAULT '0',
  `summary` text,
  `size` int(11) unsigned NOT NULL DEFAULT '0',
  `pages` smallint(6) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) unsigned NOT NULL DEFAULT '0',
  `poster` varchar(50) NOT NULL DEFAULT '',
  `toptime` int(11) unsigned NOT NULL DEFAULT '0',
  `picflag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `saleprice` int(11) unsigned NOT NULL DEFAULT '0',
  `vipprice` int(11) unsigned NOT NULL DEFAULT '0',
  `sumegold` int(11) unsigned NOT NULL DEFAULT '0',
  `sumesilver` int(11) unsigned NOT NULL DEFAULT '0',
  `normalsale` int(11) unsigned NOT NULL DEFAULT '0',
  `vipsale` int(11) unsigned NOT NULL DEFAULT '0',
  `freesale` int(11) unsigned NOT NULL DEFAULT '0',
  `bespsale` int(11) unsigned NOT NULL DEFAULT '0',
  `totalsale` int(11) unsigned NOT NULL DEFAULT '0',
  `daysale` int(11) unsigned NOT NULL DEFAULT '0',
  `weeksale` int(11) unsigned NOT NULL DEFAULT '0',
  `monthsale` int(11) unsigned NOT NULL DEFAULT '0',
  `allsale` int(11) unsigned NOT NULL DEFAULT '0',
  `lastsale` int(11) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ochapterid`),
  KEY `obookid` (`obookid`)
) ENGINE=MyISAM AUTO_INCREMENT=1081 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_obook_ochapter`
--

LOCK TABLES `jieqi_obook_ochapter` WRITE;
/*!40000 ALTER TABLE `jieqi_obook_ochapter` DISABLE KEYS */;
INSERT INTO `jieqi_obook_ochapter` VALUES (1080,0,0,0,0,15,15,1080,1492925294,1492930187,0,'神医宝鉴','测试VIP章节',0,139,0,'    发放广汽 过去',12,0,1,'admin',0,0,100,0,100,0,1,0,0,0,1,1,1,1,1,1492930202,0,0,2);
/*!40000 ALTER TABLE `jieqi_obook_ochapter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_obook_ocontent`
--

DROP TABLE IF EXISTS `jieqi_obook_ocontent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_obook_ocontent` (
  `ochapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `ocontent` mediumtext,
  UNIQUE KEY `ochapterid` (`ochapterid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_obook_ocontent`
--

LOCK TABLES `jieqi_obook_ocontent` WRITE;
/*!40000 ALTER TABLE `jieqi_obook_ocontent` DISABLE KEYS */;
INSERT INTO `jieqi_obook_ocontent` VALUES (1080,'    发放广汽 过去');
/*!40000 ALTER TABLE `jieqi_obook_ocontent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_obook_osale`
--

DROP TABLE IF EXISTS `jieqi_obook_osale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_obook_osale` (
  `osaleid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `buytime` int(11) unsigned NOT NULL DEFAULT '0',
  `accountid` int(11) unsigned NOT NULL DEFAULT '0',
  `account` varchar(30) NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `ochapterid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `chaptername` varchar(100) NOT NULL DEFAULT '',
  `saleprice` int(11) unsigned NOT NULL DEFAULT '0',
  `salenum` int(11) unsigned NOT NULL DEFAULT '0',
  `sumprice` int(11) unsigned NOT NULL DEFAULT '0',
  `pricetype` tinyint(1) NOT NULL DEFAULT '0',
  `paytype` tinyint(1) NOT NULL DEFAULT '0',
  `payflag` tinyint(1) NOT NULL DEFAULT '0',
  `paynote` varchar(255) NOT NULL DEFAULT '',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`osaleid`),
  KEY `accountid` (`accountid`),
  KEY `obookid` (`obookid`),
  KEY `ochapterid` (`ochapterid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_obook_osale`
--

LOCK TABLES `jieqi_obook_osale` WRITE;
/*!40000 ALTER TABLE `jieqi_obook_osale` DISABLE KEYS */;
INSERT INTO `jieqi_obook_osale` VALUES (1,0,1492930202,5,'老a',15,15,1080,'神医宝鉴','测试VIP章节',100,1,100,0,0,0,'101.226.125.108',0,0);
/*!40000 ALTER TABLE `jieqi_obook_osale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_obook_paidlog`
--

DROP TABLE IF EXISTS `jieqi_obook_paidlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_obook_paidlog` (
  `paidid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `paytime` int(11) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `masterid` int(11) unsigned NOT NULL DEFAULT '0',
  `master` varchar(30) NOT NULL DEFAULT '',
  `obookid` int(11) unsigned NOT NULL DEFAULT '0',
  `obookname` varchar(100) NOT NULL DEFAULT '',
  `articleid` int(11) unsigned NOT NULL DEFAULT '0',
  `sumegold` int(11) NOT NULL DEFAULT '0',
  `sumesilver` int(11) NOT NULL DEFAULT '0',
  `sumemoney` int(11) NOT NULL DEFAULT '0',
  `paidemoney` int(11) NOT NULL DEFAULT '0',
  `payemoney` int(11) NOT NULL DEFAULT '0',
  `remainemoney` int(11) NOT NULL DEFAULT '0',
  `summoney` int(11) NOT NULL DEFAULT '0',
  `paymoney` int(11) NOT NULL DEFAULT '0',
  `remainmoney` int(11) NOT NULL DEFAULT '0',
  `paidcurrency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `paidtype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `paidflag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `payinfo` text,
  `paynote` text,
  PRIMARY KEY (`paidid`),
  KEY `userid` (`userid`),
  KEY `obookid` (`obookid`),
  KEY `articleid` (`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_obook_paidlog`
--

LOCK TABLES `jieqi_obook_paidlog` WRITE;
/*!40000 ALTER TABLE `jieqi_obook_paidlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_obook_paidlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_pay_balance`
--

DROP TABLE IF EXISTS `jieqi_pay_balance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_pay_balance` (
  `balid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `baltime` int(11) unsigned NOT NULL DEFAULT '0',
  `fromid` int(11) unsigned NOT NULL DEFAULT '0',
  `fromname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `toid` int(11) unsigned NOT NULL DEFAULT '0',
  `toname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `baltype` varchar(255) NOT NULL DEFAULT '',
  `ballog` varchar(255) NOT NULL DEFAULT '',
  `balegold` int(11) NOT NULL DEFAULT '0',
  `moneytype` tinyint(3) NOT NULL DEFAULT '0',
  `balmoney` int(11) NOT NULL DEFAULT '0',
  `balflag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`balid`),
  KEY `fromid` (`fromid`),
  KEY `fromname` (`fromname`),
  KEY `toid` (`toid`),
  KEY `toname` (`toname`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_pay_balance`
--

LOCK TABLES `jieqi_pay_balance` WRITE;
/*!40000 ALTER TABLE `jieqi_pay_balance` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_pay_balance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_pay_paycard`
--

DROP TABLE IF EXISTS `jieqi_pay_paycard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_pay_paycard` (
  `cardid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `batchno` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `cardno` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `cardpass` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `cardtype` int(1) unsigned NOT NULL DEFAULT '0',
  `payemoney` int(11) unsigned NOT NULL DEFAULT '0',
  `emoneytype` int(1) unsigned NOT NULL DEFAULT '0',
  `ispay` int(1) unsigned NOT NULL DEFAULT '0',
  `paytime` int(11) unsigned NOT NULL DEFAULT '0',
  `payuid` int(11) unsigned NOT NULL DEFAULT '0',
  `payname` varchar(30) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `flag` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cardid`),
  KEY `cardno` (`cardno`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_pay_paycard`
--

LOCK TABLES `jieqi_pay_paycard` WRITE;
/*!40000 ALTER TABLE `jieqi_pay_paycard` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_pay_paycard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_pay_paylog`
--

DROP TABLE IF EXISTS `jieqi_pay_paylog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_pay_paylog` (
  `payid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `buytime` int(11) unsigned NOT NULL DEFAULT '0',
  `rettime` int(11) unsigned NOT NULL DEFAULT '0',
  `buyid` int(11) unsigned NOT NULL DEFAULT '0',
  `buyname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `buyinfo` text,
  `moneytype` tinyint(3) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `egoldtype` tinyint(1) NOT NULL DEFAULT '0',
  `egold` int(11) NOT NULL DEFAULT '0',
  `paytype` varchar(30) NOT NULL DEFAULT '',
  `retserialno` varchar(100) NOT NULL DEFAULT '',
  `retaccount` varchar(100) NOT NULL DEFAULT '',
  `retinfo` text,
  `masterid` int(11) unsigned NOT NULL DEFAULT '0',
  `mastername` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `masterinfo` text,
  `note` text,
  `payflag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payid`),
  KEY `flag` (`payflag`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jieqi_pay_transfer`
--

DROP TABLE IF EXISTS `jieqi_pay_transfer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_pay_transfer` (
  `transid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `transtime` int(11) unsigned NOT NULL DEFAULT '0',
  `fromid` int(11) unsigned NOT NULL DEFAULT '0',
  `fromname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `toid` int(11) unsigned NOT NULL DEFAULT '0',
  `toname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `translog` varchar(255) NOT NULL DEFAULT '',
  `transegold` int(11) NOT NULL DEFAULT '0',
  `receiveegold` int(11) NOT NULL DEFAULT '0',
  `mastertime` int(11) unsigned NOT NULL DEFAULT '0',
  `masterid` int(11) unsigned NOT NULL DEFAULT '0',
  `mastername` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `masterlog` varchar(255) NOT NULL DEFAULT '',
  `transtype` tinyint(1) NOT NULL DEFAULT '0',
  `errflag` tinyint(1) NOT NULL DEFAULT '0',
  `transflag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`transid`),
  KEY `fromid` (`fromid`),
  KEY `fromname` (`fromname`),
  KEY `toid` (`toid`),
  KEY `toname` (`toname`),
  KEY `transtype` (`transtype`),
  KEY `transflag` (`transflag`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_pay_transfer`
--

LOCK TABLES `jieqi_pay_transfer` WRITE;
/*!40000 ALTER TABLE `jieqi_pay_transfer` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_pay_transfer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_action`
--

DROP TABLE IF EXISTS `jieqi_system_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_action` (
  `actionid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(50) NOT NULL DEFAULT '',
  `acttype` varchar(50) NOT NULL DEFAULT '',
  `acttitle` varchar(50) NOT NULL DEFAULT '',
  `minscore` int(11) NOT NULL DEFAULT '0',
  `islog` tinyint(1) NOT NULL DEFAULT '0',
  `isreview` tinyint(1) NOT NULL DEFAULT '0',
  `isvip` tinyint(1) NOT NULL DEFAULT '0',
  `ispay` tinyint(1) NOT NULL DEFAULT '0',
  `ismessage` tinyint(1) NOT NULL DEFAULT '0',
  `paytitle` varchar(50) NOT NULL DEFAULT '',
  `paybase` int(11) NOT NULL DEFAULT '0',
  `paymin` int(11) NOT NULL DEFAULT '0',
  `paymax` int(11) NOT NULL DEFAULT '0',
  `earnscore` int(11) NOT NULL DEFAULT '0',
  `earncredit` int(11) NOT NULL DEFAULT '0',
  `earnvipvote` int(11) NOT NULL DEFAULT '0',
  `lenmin` int(11) NOT NULL DEFAULT '0',
  `lenmax` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `actiontype` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`actionid`),
  KEY `acttype` (`acttype`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_action`
--

LOCK TABLES `jieqi_system_action` WRITE;
/*!40000 ALTER TABLE `jieqi_system_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_blocks`
--

DROP TABLE IF EXISTS `jieqi_system_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_blocks` (
  `bid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `blockname` varchar(50) NOT NULL DEFAULT '',
  `modname` varchar(50) NOT NULL DEFAULT '',
  `filename` varchar(50) NOT NULL DEFAULT '',
  `classname` varchar(50) NOT NULL DEFAULT '',
  `side` tinyint(3) NOT NULL DEFAULT '0',
  `title` text,
  `description` text,
  `content` mediumtext,
  `vars` text,
  `template` varchar(50) NOT NULL DEFAULT '',
  `cachetime` int(11) NOT NULL DEFAULT '0',
  `contenttype` tinyint(3) NOT NULL DEFAULT '0',
  `weight` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `showstatus` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `custom` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `canedit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `publish` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hasvars` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`),
  KEY `modname` (`modname`),
  KEY `publish` (`publish`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_blocks`
--

LOCK TABLES `jieqi_system_blocks` WRITE;
/*!40000 ALTER TABLE `jieqi_system_blocks` DISABLE KEYS */;
INSERT INTO `jieqi_system_blocks` VALUES (1,'本站公告','system','','BlockSystemCustom',4,'本站公告','','<br>\r\n欢迎使用 JIEQI CMS，安装完成后请删除install目录，然后进入后台进行参数、用户组、权限和区块的相关设置。\r\n<br><br>\r\n更多程序和使用方面咨询请访问：\r\n<br><br>\r\n<a href=\"http://www.jieqi.com\" target=\"_blank\">http://www.jieqi.com</a>\r\n<br><br>','','',0,1,10000,0,1,1,3,0),(2,'用户登录','system','block_login','BlockSystemLogin',0,'用户登录','','','','',0,4,10100,0,0,0,3,0),(3,'广告代码','system','','BlockSystemCustom',8,'','','<a href=\"http://www.jieqi.com\" target=\"_blank\">杰奇网络</a>','','',0,1,10150,0,1,1,0,0),(4,'用户分类','system','block_grouplist','BlockSystemGrouplist',0,'用户分类','','','','',0,0,10300,1,0,0,0,0),(5,'短消息','system','block_message','BlockSystemMessage',0,'短消息','','','','',0,0,10400,1,0,0,0,0),(6,'用户搜索','system','block_searchuser','BlockSystemSearchuser',0,'用户搜索','','','','',0,0,10500,1,0,0,0,0),(7,'用户排行','system','block_topuser','BlockSystemTopuser',0,'用户排行','','','','',0,0,10700,1,0,0,0,0),(8,'用户工具箱','system','block_userbox','BlockSystemUserbox',0,'用户工具箱','','','','',0,0,10800,1,0,0,0,0),(9,'用户设置','system','block_userset','BlockSystemUserset',0,'用户设置','','','','',0,0,10900,1,0,0,0,0),(13,'用户列表区块','system','block_userlist','BlockSystemUserlist',0,'用户排行','&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义模板和参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块默认模板文件为“block_userlist.html”，在/templates/blocks目录下，如果您定义了另外模板文件，也必须在此目录。模板文件设置留空表示使用默认模板。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置四个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排行方式（默认按用户积分），允许以下几种设置：1、“score” - 按用户积分；2、“experience” - 按经验值；3、“regdate” - 按加入日期；<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示行数，使用整数（默认 15）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是用户类别（默认 0 表示所有类别），此处使用得是用户组序号而不是名称，比如“专栏作家”类别序号是 5 ，这里就设置成 5，如果要同时选择多个类别，可以用“|”分隔，比如 3|4|7<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是指显示顺序（默认 0 表示按从大到小排序），1 表示从小到大排序。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均表示使用默认值。例子： “score,20,0,0” 表示显示20个积分最多的用户。','','score,15,0,0','block_userlist.html',0,4,11200,0,0,0,0,1),(14,'用户推荐区块','system','block_usercommend','BlockSystemUsercommend',0,'用户推荐','&nbsp;&nbsp;&nbsp;&nbsp;本区块根据设置的参数显示对应ID的用户<br>&nbsp;&nbsp;&nbsp;&nbsp;默认一个参数，设置推荐的用户ID，多个ID用“|”分割，比如 12|34|56','','','block_usercommend.html',0,4,11250,0,0,0,0,1),(15,'用户友情连接','system','block_userlink','BlockSystemUserlink',1,'用户友情连接','&nbsp;&nbsp;&nbsp;&nbsp;本区块显示某一用户自添加的友情连接<br>&nbsp;&nbsp;&nbsp;&nbsp;允许设置五个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排序字段，允许设置成“toptime”-置顶时间，或者“addtime”-添加时间<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示几条记录，默认10<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是排序方式：0-从大到小，1-从小到大<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是显示哪个用户的友情链接，允许设置成“self”-当前用户，“uid”-url参数里面uid值对应的用户，“0”-所有用户，设置成大于0的一个整数，表示指定这个uid的用户<br>&nbsp;&nbsp;&nbsp;&nbsp;参数五是内容过滤，0-都显示，1-显示置顶的链接，2-显示非置顶链接','','toptime,10,0,uid,0','block_userlink.html',0,4,11300,0,0,0,0,1),(16,'用户好友列表','system','block_ufriends','BlockSystemUfriends',1,'用户好友列表','&nbsp;&nbsp;&nbsp;&nbsp;本区块显示某一用户好友列表<br>&nbsp;&nbsp;&nbsp;&nbsp;允许设置四个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排序字段，允许设置成“friendsid”-好友记录ID，或者“adddate”-添加时间<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示几条记录，默认10<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是排序方式：0-从大到小，1-从小到大<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是显示哪个用户的好友列表，允许设置成“self”-当前用户，“uid”-url参数里面uid值对应的用户，“0”-所有用户，设置成大于0的一个整数，表示指定这个uid的用户','','friendsid,10,0,uid','block_ufriends.html',0,4,11400,0,0,0,0,1),(17,'用户资料','system','block_uinfo','BlockSystemUinfo',0,'用户资料','&nbsp;&nbsp;&nbsp;&nbsp;本区块显示某一用户资料<br>&nbsp;&nbsp;&nbsp;&nbsp;允许设置一个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是显示哪个用户的资料，允许设置成“self”-当前用户，“uid”-url参数里面uid值对应的用户，设置成大于0的一个整数，表示指定这个uid的用户','','uid','block_uinfo.html',0,4,11500,0,0,0,0,1),(18,'用户会客室主题','system','block_uptopics','BlockSystemUptopics',6,'会客室主题','&nbsp;&nbsp;&nbsp;&nbsp;本区块显示某一用户会客室主题<br>&nbsp;&nbsp;&nbsp;&nbsp;允许设置七个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排序字段，允许设置成“topicid”-主题序号，“posttime”-发表时间，“replytime”-最后回复时间，“views”-点击数，“replies”-回复数间<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示几条记录，默认10<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是排序方式：0-从大到小，1-从小到大<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是显示哪个用户的友情链接，允许设置成“self”-当前用户，“uid”-url参数里面uid值对应的用户，“0”-所有用户，设置成大于0的一个整数，表示指定这个uid的用户<br>&nbsp;&nbsp;&nbsp;&nbsp;参数五是否置顶贴，0-都显示，1-显示置顶，2-显示非置顶<br>&nbsp;&nbsp;&nbsp;&nbsp;参数六是否精华贴，0-都显示，1-显示精华，2-显示非精华<br>&nbsp;&nbsp;&nbsp;&nbsp;参数七是否锁定贴，0-都显示，1-显示锁定，2-显示非锁定','','topicid,10,0,uid,0,0,0','block_uptopics.html',0,4,11600,0,0,0,0,1),(19,'网页内容调用区块','system','block_fileget','BlockSystemFileget',0,'','&nbsp;&nbsp;&nbsp;&nbsp;本区块是通过URL获取网页内容作为自己的区块内容。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置三个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是访问的URL(必须设置)，如 http://www.domain.com/block.php?id=1<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是缓存时间（单位是秒），本参数可以留空或者设置成0，表示使用系统默认缓存时间。设置成-1表示不用缓存，设置大于0的整数表示自定义缓存时间。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是指获取的网页内容编码，留空表示和系统默认编码相同。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均表示使用默认值。例子： “http://www.domain.com/block.php?id=1,1800,utf-8” 表示获取这个网址内容，缓存半个小时，内容编码是utf-8','','','',0,4,12500,0,0,0,0,1),(20,'分类阅读','article','block_sort','BlockArticleSort',0,'分类阅读','','','','',0,0,20100,0,0,0,0,0),(21,'小说搜索','article','block_search','BlockArticleSearch',1,'小说搜索','','','','',0,0,20200,0,0,0,3,0),(22,'排 行 榜','article','block_toplist','BlockArticleToplist',0,'排 行 榜','','','','',0,0,20300,0,0,0,0,0),(40,'书评列表','article','block_reviewslist','BlockArticleReviewslist',0,'最新书评','&nbsp;&nbsp;&nbsp;&nbsp;本区块用于显示全站的最新书评或者某篇小说的最新书评。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置四个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是显示行数，使用整数（默认 10）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是指是否置顶书评（默认 0 表示不判断），1 表示只显示置顶书评，2 表示非置顶书评<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是指是否精华书评（默认 0 表示不判断），1 表示只显示精华书评，2 表示非精华书评<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是指小说ID，允许设置成：0-表示所有小说，大于0的整数-指定小说ID，字符串-如“id”-url参数里面id值对应的值，$开头的字符串-如“$articleid”-表示模板里面{?$articleid?}这个变量<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均表示使用默认值。例子： “15,0,1,0” 表示显示15条最新精华书评。','','10,0,0,64','block_reviewslist.html',0,4,22100,0,0,0,0,1),(93,'编辑推荐','article','block_commend','BlockArticleCommend',0,'编辑推荐','&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义模板和参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块默认模板文件为“block_commend.html”，在/modules/article/templates/blocks目录下，如果您定义了另外模板文件，也必须在此目录。模板文件设置留空表示使用默认模板。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置推荐的小说序号作为参数，不同参数之间用英文“|”分隔。比如： “123|234|456|678” 表示本区块调用这四个序号小说信息显示','','111|222|333','block_commend.html',0,1,23100,0,0,0,0,2),(43,'我的原创小说','article','block_myarticles','BlockArticleMyarticles',0,'我的原创小说','','','','',0,4,22400,1,0,0,0,0),(44,'我的转载小说','article','block_transarticles','BlockArticleTransarticles',0,'我的转载小说','','','','',0,4,22500,1,0,0,0,0),(45,'作家工具箱','article','block_writerbox','BlockArticleWriterbox',0,'作家工具箱','','','','',0,0,22600,1,0,0,0,0),(46,'小说列表区块','article','block_articlelist','BlockArticleArticlelist',0,'小说总排行','&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义模板和参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块默认模板文件为“block_articlelist.html”，在/modules/article/templates/blocks目录下，如果您定义了另外模板文件，也必须在此目录。模板文件设置留空表示使用默认模板。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置六个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排行方式（默认按总访问量），允许以下几种设置：1、“allvisit” - 按总访问量；2、“monthvisit” - 按月访问量；3、“weekvisit” - 按周访问量；4、“dayvisit” - 按日访问量；5、“allvote” - 按总推荐次数；6、“monthvote” - 按月推荐次数；7、“weekvote” - 按周推荐次数；8、“dayvote” - 按日推荐次数；9、“postdate” - 按最新入库；10、“toptime” - 按本站推荐；11、“goodnum” - 按收藏数量；12、“size” - 按小说字数；13、“lastupdate” - 按最近更新；<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示行数，使用整数（默认 15）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是小说类别（默认 0 表示所有类别），此处使用得是类别序号而不是名称，比如“玄幻小说”类别序号是 3 ，这里就设置成 3，如果要同时选择多个类别，可以用“|”分隔，比如 3|4|7<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是指是否原创（默认 0 表示不判断），1 表示只显示原创作品，2 表示转载作品<br>&nbsp;&nbsp;&nbsp;&nbsp;参数五是指是否全本（默认 0 表示不判断），1 表示只显示全本作品，2 表示连载作品<br>&nbsp;&nbsp;&nbsp;&nbsp;参数六是指显示顺序（默认 0 表示按从大到小排序），1 表示从小到大排序。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均表示使用默认值。例子： “lastupdate,,0,1,0,0” 表示显示15条最近更新的原创作品，其中第二个参数留空，所以使用默认的15条。','','allvisit,15,0,0,0,0','block_articlelist.html',0,4,23000,0,0,0,0,1),(47,'小说封面推荐','article','block_commend','BlockArticleCommend',0,'封面推荐','&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义模板和参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块默认模板文件为“block_commend.html”，在/modules/article/templates/blocks目录下，如果您定义了另外模板文件，也必须在此目录。模板文件设置留空表示使用默认模板。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置推荐的小说序号作为参数，不同参数之间用英文“|”分隔。比如： “123|234|456|678” 表示本区块调用这四个序号小说信息显示','','','block_commend.html',0,1,23100,0,0,0,0,2),(48,'用户小说','article','block_uarticles','BlockArticleUarticles',6,'我的小说','&nbsp;&nbsp;&nbsp;&nbsp;本区块显示某一用户的原创小说<br>&nbsp;&nbsp;&nbsp;&nbsp;允许设置五个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排序字段，允许设置成“lastupdate”-更新时间，“postdate”-发表时间，“articleid”-小说ID，“allvisit”-总点击，“monthvisit”-月点击，“weekvisit”-周点击，“allvote”-总推荐，“monthvote”-月推荐，“weekvote”-周推荐，“size”-字数，“goodnum”-收藏数<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示几条记录，默认10<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是排序方式：0-从大到小，1-从小到大<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是显示哪个用户的友情链接，允许设置成“self”-当前用户，“uid”-url参数里面uid值对应的用户，“0”-所有用户，设置成大于0的一个整数，表示指定这个uid的用户<br>&nbsp;&nbsp;&nbsp;&nbsp;参数五全本标志，0-都显示，1-显示全本，2-显示非全本','','lastupdate,10,0,uid,0','block_uarticles.html',0,4,25100,0,0,0,0,1),(49,'用户书架','article','block_ubookcase','BlockArticleUbookcase',6,'我的书架','&nbsp;&nbsp;&nbsp;&nbsp;本区块显示某一用户的书架小说<br>&nbsp;&nbsp;&nbsp;&nbsp;允许设置四个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排序字段，允许设置成“lastupdate”-更新时间，“joindate”-加入时间，“articleid”-小说ID，“caseid”-书架ID，“lastvisit”-最后访问时间<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示几条记录，默认10<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是排序方式：0-从大到小，1-从小到大<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是显示哪个用户的友情链接，允许设置成“self”-当前用户，“uid”-url参数里面uid值对应的用户，“0”-所有用户，设置成大于0的一个整数，表示指定这个uid的用户','','lastupdate,10,0,uid','block_ubookcase.html',0,4,25200,0,0,0,0,1),(92,'章节目录区块','article','block_achapters','BlockArticleAchapters',0,'章节目录','&nbsp;&nbsp;&nbsp;&nbsp;本区块显示某一篇小说的几个最新章节或者整个章节目录<br>&nbsp;&nbsp;&nbsp;&nbsp;允许设置五个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排序字段，允许设置成“chapterorder”-章节顺序，“postdate”-章节发表时间，“lastupdate”-章节更新时间，“chapterid”-章节ID。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示几条记录，设置成 0 表示显示全部章节。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是排序方式：0-从大到小，1-从小到大<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是指定小说ID，允许设置成：整数-指定小说ID，字符串-如“id”-url参数里面id值对应的值，$开头的字符串-如“$articleid”-表示模板里面{?$articleid?}这个变量<br>&nbsp;&nbsp;&nbsp;&nbsp;参数五是显示章节还是分卷：0-显示分卷及章节，1-只显示章节，2-只显示分卷','','chapterorder,10,1,id,0','block_achapters.html',0,4,25300,0,0,0,0,1),(58,'帖子列表区块','forum','block_topiclist','BlockForumTopiclist',0,'最新帖子','&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义模板和参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块默认模板文件为“block_topiclist.html”，在/modules/forum/templates/blocks目录下，如果您定义了另外模板文件，也必须在此目录。模板文件设置留空表示使用默认模板。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置四个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排行方式（默认按最近更新），允许以下几种设置：1、“replytime” - 按最近更新；2、“topictime” - 按主题发表时间；3、“topicviews” - 按阅读次数；4、“topicreplies” - 按回复次数；<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示行数，使用整数（默认 10）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是论坛类别（默认 0 表示所有类别），此处使用得是论坛板块序号而不是名称，比如“网友交流”版块序号是 3 ，这里就设置成 3，如果要同时选择多个版块，可以用“|”分隔，比如 3|4|7<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是指显示顺序（默认 0 表示按从大到小排序），1 表示从小到大排序。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均表示使用默认值。例子： “replytime,20,0,0” 表示显示20条最近更新的帖子。','','replytime,10,0,0','block_topiclist.html',0,4,40100,0,0,0,0,1),(59,'帖子推荐区块','forum','block_topiccommend','BlockForumTopiccommend',0,'推荐帖子','&nbsp;&nbsp;&nbsp;&nbsp;本区块根据参数里面的ID显示对应的推荐主题。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置一个参数，即推荐的主题ID。不过ID可以是多个用“|”分隔，如 12|34|56','','','block_topiccommend.html',0,4,41100,0,0,0,0,2),(63,'友情链接','link','block_linklist','BlockLinkLinklist',8,'友情链接','&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义模板和参数，并且不同的设置可以保存成不同的区块\r\n\r\n。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块默认模板文件为“block_linklist.html”，\r\n\r\n在/modules/link/templates/blocks目录下，如果您定义了另外模板文件，也必须在此目录。模板文件设\r\n\r\n置留空表示使用默认模板。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置四个参数，不同参数之间用英文\r\n\r\n逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是显示行数，使用整数（默认 10）\r\n\r\n<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是指按什么类型显示友情链接 0表示文字链接(默认)，1图片链接，2所有\r\n\r\n<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是指如何排序 0表示按排序字段+时间排序(默认), 1排序字段\r\n\r\n，2表示时间<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是指文字友情链接最大显示长度，必须是整数（默认 \r\n\r\n64 ，单位是字节，相当于 32 个汉字）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均\r\n\r\n表示使用默认值。例子： “10,0,1,64” 表示显示10条友情链接。','','10,2,0,64','block_linklist.html',0,1,22110,0,0,0,3,1),(104,'新闻搜索','news','block_search','BlockNewsSearch',1,'新闻搜索','','','','',0,0,20100,0,0,0,3,0),(105,'新闻内容列表','news','block_newslist','BlockNewsList',5,'新闻中心','&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置四个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是新闻所属一级栏目代号（“0”代表所有栏目），使用整数。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是新闻所属二级栏目代号（“0”代表一级栏目下所有二级栏目），使用整数。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是显示新闻条数，使用整数（默认 5）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是新闻标题显示字数，使用整数（默认 40）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均表示使用默认值。例子： “1,2,5,40” 表示显示新闻一级栏目为1，二级栏目为2的前5条的新闻列表。','','1,0,5,40','block_newslist.html',0,1,20200,0,0,0,0,1),(106,'最新新闻列表','news','block_newsupdatelist','BlockNewsUpdateList',0,'最新新闻','&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置四个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是新闻所属一级栏目代号（“0”代表所有栏目），使用整数。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是新闻所属二级栏目代号（“0”代表一级栏目下所有二级栏目），使用整数。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是显示新闻条数，使用整数（默认 6）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是新闻标题显示字数，使用整数（默认 24）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均表示使用默认值。例子： “1,2,6,24” 表示显示新闻一级栏目为1，二级栏目为2的前6条的最新新闻列表。','','0,0,6,24','block_newsupdatelist.html',0,1,20300,0,0,0,0,1),(107,'新闻头条区块','news','block_newstop','BlockNewsTop',4,'新闻头条','&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置三个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是新闻头条显示新闻对应的ID，使用整数。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是新闻标题显示字数，使用整数（默认16字）。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是显示新闻摘要的字数限制，使用整数（默认255字）。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均表示使用默认值。例子： “1,16,255” 表示显示头条新闻对应ID为1，新闻标题字数为16字，新闻摘要字数为255字。','','0,16,255','block_newstop.html',0,1,20400,0,0,0,0,1),(108,'新闻类别列表','news','block_newsclass','BlockNewsClass',0,'新闻类别','&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置二个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是新闻类别显示的字数，使用整数。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是新闻类别区别显示的条数，使用整数。','','16,5','block_newsclass.html',0,1,20300,0,0,0,3,1);
/*!40000 ALTER TABLE `jieqi_system_blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_blocks_wap`
--

DROP TABLE IF EXISTS `jieqi_system_blocks_wap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_blocks_wap` (
  `bid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `blockname` varchar(50) NOT NULL DEFAULT '',
  `modname` varchar(50) NOT NULL DEFAULT '',
  `filename` varchar(50) NOT NULL DEFAULT '',
  `classname` varchar(50) NOT NULL DEFAULT '',
  `side` tinyint(3) NOT NULL DEFAULT '0',
  `title` text,
  `description` text,
  `content` mediumtext,
  `vars` text,
  `template` varchar(50) NOT NULL DEFAULT '',
  `cachetime` int(11) NOT NULL DEFAULT '0',
  `contenttype` tinyint(3) NOT NULL DEFAULT '0',
  `weight` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `showstatus` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `custom` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `canedit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `publish` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hasvars` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`),
  KEY `modname` (`modname`),
  KEY `publish` (`publish`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_blocks_wap`
--

LOCK TABLES `jieqi_system_blocks_wap` WRITE;
/*!40000 ALTER TABLE `jieqi_system_blocks_wap` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_blocks_wap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_configs`
--

DROP TABLE IF EXISTS `jieqi_system_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_configs` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(50) NOT NULL DEFAULT '',
  `cname` varchar(50) NOT NULL DEFAULT '',
  `ctitle` varchar(50) NOT NULL DEFAULT '',
  `cvalue` text,
  `cdescription` text,
  `cdefine` tinyint(1) NOT NULL DEFAULT '0',
  `ctype` tinyint(1) NOT NULL DEFAULT '0',
  `options` text,
  `catorder` int(10) NOT NULL DEFAULT '0',
  `catname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cid`),
  UNIQUE KEY `modname` (`modname`,`cname`),
  KEY `catorder` (`catorder`),
  KEY `cdefine` (`cdefine`),
  KEY `catname` (`catname`)
) ENGINE=MyISAM AUTO_INCREMENT=529 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_configs`
--

LOCK TABLES `jieqi_system_configs` WRITE;
/*!40000 ALTER TABLE `jieqi_system_configs` DISABLE KEYS */;
INSERT INTO `jieqi_system_configs` VALUES (5,'system','onlinetime','在线统计时间','1800','单位“秒”',0,3,'',10800,'显示控制'),(7,'system','maxmessages','信箱最多消息数','50','',0,3,'',11000,'显示控制'),(8,'system','maxdaymsg','每天允许发消息数','0','设置成 0 表示不限制每天发短信数量',0,3,'',11050,'显示控制'),(10,'system','maxfriends','最多好友数量','50','',0,3,'',11300,'显示控制'),(11,'system','checkcodelogin','登陆时是否使用验证码','0','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',11900,'显示控制'),(12,'system','usegd','系统是否支持GD库','1','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',12000,'显示控制'),(13,'system','regtimelimit','同一IP几个小时内禁止重复注册','0','设置成 0 表示不限制',0,3,'',12100,'显示控制'),(14,'system','usernamelimit','注册用户名限制','0','',0,7,'a:2:{i:0;s:20:\"允许中英文及数字组合\";i:1;s:20:\"仅允许英文和数字组合\";}',12200,'显示控制'),(15,'system','avatardir','会员头像保存目录','avatar','',0,1,'',13100,'显示控制'),(16,'system','avatarurl','会员头像访问URL','','对应保存目录的url，最后不带斜杠，如果留空则系统自动判断',0,1,'',13150,'显示控制'),(17,'system','avatartype','头像允许上传的文件类型','.gif .jpg .jpeg .png','多个类型用空格分开，如\".gif .jpg .jpeg .png\"',0,1,'',13200,'显示控制'),(18,'system','avatarcut','是否要求裁剪头像图片','1','裁剪图片需要GD库支持',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',13250,'显示控制'),(19,'system','avatarsize','头像文件不得超过几K','1000','',0,3,'',13300,'显示控制'),(29,'system','mailtype','邮件发送方式','0','',0,7,'a:4:{i:0;s:14:\"不发送任何邮件\";i:1;s:40:\"通过 PHP 函数及 UNIX sendmail 发送(推荐)\";i:2;s:49:\"通过 SOCKET 连接 SMTP 服务器发送(支持 ESMTP 验证)\";i:3;s:60:\"通过 PHP 函数 SMTP 发送 Email(仅 win32 下有效, 不支持 ESMTP)\";}',30100,'邮件设置'),(30,'system','maildelimiter','邮件头的分隔符','1','',0,7,'a:2:{i:0;s:18:\"使用 LF 作为分隔符\";i:1;s:20:\"使用 CRLF 作为分隔符\";}',30200,'邮件设置'),(31,'system','mailserver','SMTP 服务器','','如：smtp.jieqi.com',0,1,'',30300,'邮件设置'),(32,'system','mailport','SMTP 端口','25','默认不需修改',0,3,'',30400,'邮件设置'),(33,'system','mailauth','是否需要 AUTH LOGIN 验证','1','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',30500,'邮件设置'),(34,'system','mailfrom','发信人地址','','如果需要验证,必须为本服务器地址。地址写法可以是 webmaster@jieqi.com 或者 JieqiCMS <webmaster@jieqi.com>',0,1,'',30500,'邮件设置'),(35,'system','mailuser','验证用户名','','SMTP 邮件服务器用户名(如：webmaster@jieqi.com)',0,1,'',30600,'邮件设置'),(36,'system','mailpassword','验证密码','','SMTP 邮件服务器密码',0,1,'',30700,'邮件设置'),(37,'system','posttitlemax','发帖标题最多几个字节','60','跟数据结构中的字段长度有关，一般不用修改',0,3,'',40100,'内容检查设置'),(38,'system','postintervaltime','两次发贴最少间隔时间','0','单位是秒，设置成 0 表示无时间间隔限制',0,3,'',40200,'内容检查设置'),(39,'system','postdenywords','禁止发表的词语','','禁止发表的词语每条一行，词语中可以使用“*”表示任意长字符串，或者使用“?”表示任意一个字节字符。如“a*d”可匹配“abd”、“abcd”，而“a?d”则匹配“abc”、“acd”',0,2,'',40300,'内容检查设置'),(40,'system','postreplacewords','发帖内容替换','','替换规则每条一行，写法为：“from=to”表示内容“from”将被替换成“to”。也可以只写“from”，这样内容中的“from”会替换成“**”，相当于隐藏关键词效果。',0,2,'',40400,'内容检查设置'),(41,'system','postminsize','发帖内容最少字节数','0','0 表示不限制',0,3,'',40500,'内容检查设置'),(42,'system','postmaxsize','发帖内容最多字节数','0','0 表示不限制',0,3,'',40600,'内容检查设置'),(43,'system','postdenyrubbish','禁止灌水帖子','0','被怀疑是灌水的帖子将禁止发表，程序判断不一定准确，请慎用',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',40700,'内容检查设置'),(44,'system','JIEQI_URL','网站地址','','虚拟路径（URL），后面不带斜线',1,1,'',10200,'网站基本信息'),(45,'system','JIEQI_SITE_NAME','网站名称','小说演示站','',1,1,'',10300,'网站基本信息'),(46,'system','JIEQI_CONTACT_EMAIL','联系Email','','',1,1,'',10500,'网站基本信息'),(47,'system','JIEQI_MAIN_SERVER','主服务器网址','','在使用多服务器情况下设置主服务器网址（如：http://www.domain.com），后面不带斜线，单服务器可以留空',1,1,'',10520,'网站基本信息'),(48,'system','JIEQI_USER_ENTRY','用户入口服务器网址','','在使用多服务器情况下设置用户注册、登录、退出等功能的服务器网址（如：http://www.domain.com），后面不带斜线，单服务器可以留空',1,1,'',10530,'网站基本信息'),(49,'system','JIEQI_META_KEYWORDS','网站关键字','','      多个关键字用\";\"隔开(小写分号)',1,2,'',10600,'网站基本信息'),(50,'system','JIEQI_META_DESCRIPTION','网站描述','','',1,2,'',10700,'网站基本信息'),(51,'system','JIEQI_META_COPYRIGHT','版权申明','','',1,2,'',10800,'网站基本信息'),(52,'system','JIEQI_BANNER','BANNER代码','','顶部banner插入代码，一般是468*60的图片',1,2,'',10900,'网站基本信息'),(53,'system','JIEQI_LICENSE_KEY','网站授权注册码','','',1,2,'',11100,'网站基本信息'),(54,'system','JIEQI_DB_TYPE','数据库类型','mysql','目前只支持mysql',1,7,'a:1:{s:5:\"mysql\";s:5:\"mysql\";}',20100,'数据库设置'),(55,'system','JIEQI_DB_CHARSET','数据库连接编码','gbk','',1,7,'a:6:{s:3:\"gbk\";s:3:\"gbk\";s:6:\"gb2312\";s:6:\"gb2312\";s:4:\"utf8\";s:4:\"utf8\";s:4:\"big5\";s:4:\"big5\";s:6:\"latin1\";s:6:\"latin1\";s:7:\"default\";s:7:\"default\";}',20120,'数据库设置'),(56,'system','JIEQI_DB_PREFIX','数据表前缀','jieqi','',1,1,'',20200,'数据库设置'),(57,'system','JIEQI_DB_HOST','数据库服务器','localhost','',1,1,'',20300,'数据库设置'),(58,'system','JIEQI_DB_USER','数据库用户名','','',1,1,'',20400,'数据库设置'),(59,'system','JIEQI_DB_PASS','数据库密码','','留空表示不修改密码',1,5,'',20500,'数据库设置'),(60,'system','JIEQI_DB_NAME','数据库名','','',1,1,'',20600,'数据库设置'),(61,'system','JIEQI_DB_PCONNECT','是否使用持久连接','0','',1,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',20700,'数据库设置'),(62,'system','JIEQI_IS_OPEN','网站是否开放','1','',1,7,'a:3:{i:1;s:8:\"网站开放\";i:0;s:8:\"网站关闭\";i:2;s:18:\"开放但禁止登录发表\";}',30100,'显示控制'),(63,'system','JIEQI_CLOSE_INFO','网站关闭时提示','网站维护中，请稍后访问......','',1,2,'',30200,'显示控制'),(64,'system','JIEQI_PROXY_DENIED','网站是否允许代理访问','1','',1,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',30230,'显示控制'),(65,'system','JIEQI_THEME_SET','网站风格设置','ledu','',1,1,'',30400,'显示控制'),(66,'system','JIEQI_TOP_BAR','顶部通栏代码','','',1,2,'',30800,'显示控制'),(67,'system','JIEQI_BOTTOM_BAR','底部通栏代码','','',1,2,'',30900,'显示控制'),(68,'system','JIEQI_ERROR_MODE','错误显示模式','0','',1,7,'a:3:{i:0;s:10:\"不显示错误\";i:1;s:8:\"显示错误\";i:2;s:14:\"显示错误和提示\";}',31200,'显示控制'),(69,'system','JIEQI_ALLOW_REGISTER','是否允许注册','1','',1,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',31300,'显示控制'),(70,'system','JIEQI_DENY_RELOGIN','禁止同一帐号多人登陆','0','',1,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',31320,'显示控制'),(71,'system','JIEQI_DATE_FORMAT','日期格式','Y-m-d','',1,1,'',31400,'显示控制'),(72,'system','JIEQI_TIME_FORMAT','时间格式','H:i:s','',1,1,'',31500,'显示控制'),(73,'system','JIEQI_SESSION_EXPRIE','session保持时间','0','单位为“秒”,设成“0”表示用系统默认参数',1,3,'',31600,'显示控制'),(74,'system','JIEQI_SESSION_STORAGE','session保存方式','file','',1,7,'a:2:{s:2:\"db\";s:6:\"数据库\";s:4:\"file\";s:4:\"文件\";}',31700,'显示控制'),(75,'system','JIEQI_SESSION_SAVEPATH','session保存路径','','只有在session文件方式保存时有效',1,1,'',31800,'显示控制'),(76,'system','JIEQI_COOKIE_DOMAIN','cookie的有效域名','','当适用多个子域名时候为了cookie同步，建议这里设置成主域名，如abc.com。留空则使用系统默认值',1,1,'',31820,'显示控制'),(77,'system','JIEQI_CUSTOM_INCLUDE','附加载入用户自定义程序','0','如果开启本功能，用户可以为每个页面设置一段附加的PHP程序。这种做法容易和系统程序冲突，请斟酌使用！',1,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',31850,'显示控制'),(78,'system','JIEQI_ENABLE_CACHE','是否启用缓存','0','',1,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',32200,'显示控制'),(79,'system','JIEQI_CACHE_LIFETIME','默认缓存时间','3600','单位为“秒”',1,3,'',32300,'显示控制'),(80,'system','JIEQI_CACHE_DIR','网页缓存路径','cache','支持三种写法：1、只填目录名（指网站跟目录下的子目录名），如： cahce ；2、使用完整路径，如： D:/web/cache ；3、使用Memcached，格式为 memcached://服务地址:端口号，如：memcached://127.0.0.1:11211',1,1,'',32320,'显示控制'),(81,'system','JIEQI_COMPILED_DIR','编译文件保存路径','compiled','可使用 dirname 这样的相对路径，或者 /path/dirname 这样的绝对路径',1,1,'',32360,'显示控制'),(82,'system','JIEQI_USE_GZIP','GZIP压缩','0','压缩输出有利于提高浏览速度',1,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',32400,'显示控制'),(84,'system','JIEQI_CHARSET_CONVERT','是否允许繁简转化','1','',1,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',32450,'显示控制'),(85,'system','JIEQI_AJAX_PAGE','是否使用AJAX翻页','0','',1,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',32460,'显示控制'),(86,'system','JIEQI_EGOLD_NAME','虚拟货币名称','小说币','',1,1,'',32500,'显示控制'),(87,'system','JIEQI_FORM_MAX','最大表单宽度','100%','一般同整站宽度，可用百分比或数字',1,1,'',32600,'显示控制'),(88,'system','JIEQI_FORM_MIDDLE','中等表单宽度','80%','一般指网站一边有栏目时，另一边允许的宽度，可用百分比或数字',1,1,'',32700,'显示控制'),(89,'system','JIEQI_FORM_MIN','最小表单宽度','40%','一般指网站两边都有栏目时，中间允许的宽度，可用百分比或数字',1,1,'',32767,'显示控制'),(90,'system','JIEQI_MAX_PAGES','列表最大页数','0','0表示不限制页数',1,3,'',32800,'显示控制'),(91,'system','JIEQI_PROMOTION_VISIT','访问推广增加贡献值','0','访问者通过用户提供的推广链接(如 index.php?fromuid=1)访问网站，推广人所得的贡献值。设置为 0 表示不启用本功能。',1,3,'',33100,'显示控制'),(92,'system','JIEQI_PROMOTION_REGISTER','注册推广增加贡献值','0','访问者通过用户提供的推广链接(如 index.php?fromuid=1)访问网站并注册为会员，推广人所得的贡献值。设置为 0 表示不启用本功能。',1,3,'',33200,'显示控制'),(488,'system','JIEQI_PAGE_ROWS','列表每页默认记录数','30','指需要分页显示的列表，默认每页显示几条记录。',1,3,'',32900,'显示控制'),(417,'system','postcheckcode','发帖是否使用验证码','0','',0,9,'a:2:{i:7;s:2:\"是\";i:0;s:2:\"否\";}',40800,'内容检查设置'),(418,'system','postdenytimes','禁止发帖的时间段','','请使用 24 小时时段格式，每个时间段一行，留空为不限制。如：每日晚 11:25 到次日早 5:05 可设置为: 23:25-5:05 ；每日早 9:00 到当日下午 2:30 可设置为: 9:00-14:30',0,2,'',40260,'内容检查设置'),(421,'system','JIEQI_TIME_ZONE','时区设置','','默认留空，表示用系统默认时区，如果系统时间跟网站时间不同，可设置本参数。中国地区设置成“PRC”。',1,1,'',31380,'显示控制'),(499,'system','fakeuserpage','会员主页伪静态规则','','\r\n变量：<{$id}>（会员ID），<{$id|subdirectory}>（会员ID子目录）。。\r\n例如：/page/<{$id}>.html\r\n指向：/userpage.php?id=$id',0,1,'',21200,'文件参数'),(498,'system','fakeuserinfo','会员信息页伪静态规则','','\r\n变量：<{$id}>（会员ID），<{$id|subdirectory}>（会员ID子目录）。。\r\n例如：/user/<{$id}>.html\r\n指向：/userinfo.php?id=$id',0,1,'',21100,'文件参数'),(102,'system','JIEQI_PAGE_STYLE','翻页模式','1','多页模式适合电脑站，上下页模式适合手机站',1,7,'a:2:{i:1;s:8:\"多页模式\";i:2;s:10:\"上下页模式\";}',32470,'显示控制'),(103,'system','JIEQI_PAGE_LINKS','多页模板最多显示几页','10','只有翻页为多页模式时候有效',1,1,'',32480,'显示控制'),(95,'article','pagenum','小说列表一页显示几行','30','',0,3,'',12200,'显示控制'),(96,'article','cachenum','小说列表缓存几个页面','10','',0,3,'',12300,'显示控制'),(98,'article','topcachenum','排行榜缓存几个页面','10','',0,3,'',12350,'显示控制'),(105,'article','reviewwidth','评论显示宽度','90','单位是“字节”，1个汉字等于2个字节',0,3,'',12900,'显示控制'),(106,'article','maxreviewsize','最大评论长度','0','单位是“字节”，设为0表示无限制',0,3,'',13000,'显示控制'),(107,'article','minreviewsize','最小评论长度','0','单位是“字节”，设为0表示无限制',0,3,'',13100,'显示控制'),(108,'article','goodreviewpercent','精华书评百分比','10','百分之',0,3,'',13150,'显示控制'),(109,'article','reviewenter','书评允许显示换行','1','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',13600,'显示控制'),(110,'article','maxbookmarks','默认书架藏书量','20','',0,3,'',13650,'显示控制'),(111,'article','maxmarkclass','书架最多类别数','5','用户书架最多允许分几个类别，设置成0表示不允许分类。',0,3,'',13660,'显示控制'),(113,'article','textwatermark','文字水印','','指的是隐藏在阅读页面的一些文字，其中<{$randtext}>将被替换成一组随机字符。例如：“<span style=\"display:none\">版权所有：<{$randtext}>杰奇网络</span>”（style=\"display:none\" 是指默认不可见，但是页面上全选复制时候会包含本部分内容）',0,2,'',13850,'显示控制'),(114,'article','pageimagecode','阅读页面图片显示代码','<div class=\"divimage\"><img src=\"<{$imageurl}>\" border=\"0\" class=\"imagecontent\"></div>','小说生成阅读页面时候，显示图片附件的html代码。其中<{$imageurl}>将被替换成实际图片地址',0,2,'',13860,'显示控制'),(115,'article','txtarticlehead','TXT全文头部附加内容','','生成TXT全文下载，内容头部和尾部可以附加一些预想设置的内容，比如本站名字地址。',0,2,'',13870,'显示控制'),(116,'article','txtarticlefoot','TXT全文尾部附加内容','','生成TXT全文下载，内容头部和尾部可以附加一些预想设置的内容，比如本站名字地址。',0,2,'',13880,'显示控制'),(117,'article','authtypeset','是否允许自动排版','1','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',14030,'显示控制'),(118,'article','autotypeset','默认自动排版','1','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',14100,'显示控制'),(119,'article','searchtype','搜索匹配方式','0','',0,7,'a:3:{i:0;s:8:\"模糊匹配\";i:1;s:10:\"半模糊匹配\";i:2;s:8:\"完整匹配\";}',14150,'显示控制'),(120,'article','minsearchlen','搜索关键字最少长度','2','',0,3,'',14200,'显示控制'),(121,'article','maxsearchres','最大搜索结果数','300','',0,3,'',14300,'显示控制'),(122,'article','minsearchtime','两次搜索间隔时间','5','',0,3,'',14400,'显示控制'),(123,'article','checkappwriter','申请作者是否需要审核','1','需要审核时会员提交申请，管理员审核。不需要审核则用户点申请，直接成为作者',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',14900,'显示控制'),(124,'article','articlevote','小说是否允许发起投票','0','本项设置是否允许投票和最大允许一个投票选项',0,7,'a:10:{i:0;s:10:\"不允许投票\";i:2;s:11:\"最大2个选项\";i:3;s:11:\"最大3个选项\";i:4;s:11:\"最大4个选项\";i:5;s:11:\"最大5个选项\";i:6;s:11:\"最大6个选项\";i:7;s:11:\"最大7个选项\";i:8;s:11:\"最大8个选项\";i:9;s:11:\"最大9个选项\";i:10;s:12:\"最大10个选项\";}',14950,'显示控制'),(125,'article','writergroup','默认作者类型','专栏作家','用户申请作者后默认的类型（如：临时作者）',0,1,'',15000,'显示控制'),(126,'article','samearticlename','小说标题是否允许重复','0','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',15100,'显示控制'),(127,'article','visitstatnum','小说点击统计基数','1','即用户访问一篇小说算几个点击，设置成 0 的话不进行点击统计',0,3,'',15200,'显示控制'),(128,'article','eachlinknum','每篇小说允许互换链接数','0','即一篇小说可以在信息页面设置几本站内的书作为推荐，设为0表示开启本功能',0,3,'',15300,'显示控制'),(129,'article','maketxt','是否生成文本文件','1','目前必须生成',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',20080,'文件参数'),(130,'article','txtdir','文本保存目录','txt','',0,1,'',20100,'文件参数'),(131,'article','txturl','访问文本的URL','','文本用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',20120,'文件参数'),(132,'article','makeopf','是否生成opf文件','1','目前自动生成',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',20280,'文件参数'),(133,'article','opfdir','OPF文件目录','txt','一般和文本放在同一目录',0,1,'',20300,'文件参数'),(134,'article','opfurl','访问OPF的URL','','OPF文件用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',20320,'文件参数'),(135,'article','makehtml','是否生成html','1','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',20680,'文件参数'),(136,'article','htmldir','HTML目录','D:\\webroot\\yuehuatai7','',0,1,'',20700,'文件参数'),(137,'article','htmlurl','访问HTML的URL','http://7.yuehuatai.com','HTML文件用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',20720,'文件参数'),(138,'article','htmlfile','HTML文件后缀','.html','',0,7,'a:3:{s:5:\".html\";s:5:\".html\";s:4:\".htm\";s:4:\".htm\";s:6:\".shtml\";s:6:\".shtml\";} ',20800,'文件参数'),(139,'article','makefull','是否生成全文阅读','0','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',20820,'文件参数'),(140,'article','fulldir','全文阅读目录','fulltext','',0,1,'',20840,'文件参数'),(141,'article','fullurl','访问全文阅读的URL','','全文阅读用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',20860,'文件参数'),(142,'article','makezip','是否生成zip','0','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',20880,'文件参数'),(143,'article','zipdir','ZIP目录','zip','',0,1,'',20900,'文件参数'),(144,'article','zipurl','访问ZIP文件的URL','','ZIP文件用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',20920,'文件参数'),(145,'article','maketxtfull','是否生成TXT全文','0','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',21100,'文件参数'),(146,'article','txtfulldir','TXT全文目录','txtfull','',0,1,'',21120,'文件参数'),(147,'article','txtfullurl','访问TXT全文的URL','','用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',21140,'文件参数'),(148,'article','makeumd','是否生成UMD电子书','0','全部不选表示不生成umd',0,10,'a:4:{i:1;s:7:\"全本umd\";i:2;s:7:\"64K分卷\";i:4;s:8:\"128K分卷\";i:16;s:8:\"512K分卷\";}',21200,'文件参数'),(149,'article','umddir','UMD文件目录','umd','',0,1,'',21220,'文件参数'),(150,'article','umdurl','访问UMD文件的URL','','用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',21240,'文件参数'),(151,'article','makejar','是否生成JAR电子书','0','全部不选表示不生成jar',0,10,'a:4:{i:1;s:7:\"全本jar\";i:2;s:7:\"64K分卷\";i:4;s:8:\"128K分卷\";i:16;s:8:\"512K分卷\";}',21300,'文件参数'),(152,'article','jardir','JAR文件目录','jar','',0,1,'',21320,'文件参数'),(153,'article','jarurl','访问JAR文件的URL','','用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',21340,'文件参数'),(154,'article','imagedir','封面图片保存目录','image','',0,1,'',21780,'文件参数'),(155,'article','imagetype','封面图片文件后缀','.jpg','',0,7,'a:4:{s:4:\".jpg\";s:4:\".jpg\";s:5:\".jpeg\";s:5:\".jpeg\";s:4:\".gif\";s:4:\".gif\";s:4:\".png\";s:4:\".png\";}',21800,'文件参数'),(156,'article','imageurl','访问封面图片的URL','','图片用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',21820,'文件参数'),(157,'article','fakeinfo','小说信息页面伪静态规则','/book/<{$id}>.html','\r\n变量：<{$id}>（小说ID），<{$acode}>（小说拼音代码），<{$id|subdirectory}>（小说ID子目录）。\r\n例如：/info/<{$id}>.html\r\n指向：/modules/article/articleinfo.php?id=$id\r\n例如：/info/<{$acode}>.html\r\n指向：/modules/article/articleinfo.php?acode=$acode',0,1,'',21910,'文件参数'),(158,'article','fakesort','小说分类页面伪静态规则','/sort/<{$sortid}>/<{$page}>.html','\r\n变量：<{$sortid}>（分类ID），<{$sortcode}>（分类英文代码），<{$page}>（页码），<{$page|subdirectory}>（页码子目录）。\r\n例如：/sort/<{$sortid}>/<{$page}>.html\r\n指向：/modules/article/articlelist.php?sortid=$sortid&page=$page',0,1,'',21920,'文件参数'),(159,'article','fakeinitial','首字母分类页面伪静态规则','','\r\n变量：<{$initial}>（小说名首字母），<{$page}>（页码），<{$page|subdirectory}>（页码子目录）。\r\n例如：/initial/<{$initial}>/<{$page}>.html\r\n指向：/modules/article/articlelist.php?initial=$initial&page=$page',0,1,'',21930,'文件参数'),(160,'article','faketoplist','排行榜页面伪静态规则','/top/<{$order}>/<{$page}>.html','\r\n变量：<{$order}>（排序方式），<{$sortid}>（分类ID），<{$sortcode}>（分类英文代码），<{$page}>（页码），<{$page|subdirectory}>（页码子目录）。\r\n例如：/top/<{$order}>/<{$page}>.html\r\n指向：/modules/article/toplist.php?order=$order&page=$page',0,1,'',21940,'文件参数'),(161,'article','staticurl','小说内静态链接根地址','','用于小说和程序保存在不同服务器场合，留空表示用系统默认路径',0,1,'',22000,'文件参数'),(162,'article','dynamicurl','小说内动态链接根地址','','用于小说和程序保存在不同服务器场合，留空表示用系统默认路径',0,1,'',22100,'文件参数'),(167,'article','dayvotes','每天允许推荐次数','1','',0,3,'',30600,'积分设置'),(170,'article','voteminsize','多少字数以上的文章才允许推荐','0','如果设置成 0 则表示不限制字数',0,3,'',30630,'积分设置'),(428,'article','vipvote','打赏送月票','1000','控制打赏送月票比例，设置成0表示关闭。',0,3,'',31340,'积分设置'),(429,'article','flower','鲜花单价','10','控制虚拟币打赏鲜花单价，设置成0表示关闭。',0,3,'鲜花',31350,'积分设置'),(430,'article','egg','鸡蛋单价','10','控制虚拟币打赏鸡蛋单价，设置成0表示关闭。',0,3,'鸡蛋',31400,'积分设置'),(431,'article','experience','小说打赏总经验值','100000','控制打赏总经验值，设置成0表示关闭。',0,3,'经验',31450,'积分设置'),(432,'article','vipvotenums','vip用户默认月票数','1','',0,3,'',31500,'积分设置'),(433,'article','vipvoteegold','当月虚拟币消费超过多少增加一个月票','1000','',0,3,'',31550,'积分设置'),(489,'article','coverwidth','封面小图宽度','120','',0,3,'',21830,'文件参数'),(490,'article','coverheight','封面小图高度','150','',0,3,'',21840,'文件参数'),(491,'article','coverlwidth','封面大图宽度','240','',0,3,'',21850,'文件参数'),(179,'article','attachdir','附件保存目录','attachment','',0,1,'',32767,'附件设置'),(180,'article','attachtype','允许上传的附件类型','gif jpg jpeg png bmp swf','多个附件用空格格开',0,1,'',32767,'附件设置'),(181,'article','maxattachnum','一次发文最多附件数','5','设成 0 就表示禁止附件上传',0,3,'',32767,'附件设置'),(182,'article','maximagesize','图片附件最大允许几K','1000','',0,3,'',32767,'附件设置'),(183,'article','maxfilesize','文件附件最大允许几K','1000','',0,3,'',32767,'附件设置'),(184,'article','attachurl','访问附件的URL','','附件用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',32767,'附件设置'),(185,'article','attachwater','图片附件添加水印及位置','0','本功能需要 GD 库支持才能使用，对 JPG/PNG/GIF 格式的上传图片有效',0,7,'a:11:{i:0;s:8:\"不加水印\";i:1;s:8:\"顶部居左\";i:2;s:8:\"顶部居中\";i:3;s:8:\"顶部居右\";i:4;s:8:\"中部居左\";i:5;s:8:\"中部居中\";i:6;s:8:\"中部居右\";i:7;s:8:\"底部居左\";i:8;s:8:\"底部居中\";i:9;s:8:\"底部居右\";i:10;s:8:\"随机位置\";}',32810,'附件设置'),(186,'article','attachwimage','附件水印图片文件','watermark.gif','允许 JPG/PNG/GIF 格式，默认只需填文件名，放在 modules/article/images 目录下',0,1,'',32820,'附件设置'),(187,'article','attachwtrans','水印图片与原图片的融合度','30','范围为 1～100 的整数，数值越大水印图片透明度越低。',0,3,'',32830,'附件设置'),(188,'article','attachwquality','jpeg图片质量','90','范围为 0～100 的整数，数值越大结果图片效果越好，但尺寸也越大。',0,3,'',32840,'附件设置'),(492,'article','coverlheight','封面大图高度','300','',0,3,'',21860,'文件参数'),(422,'article','maketxtjs','是否生成章节内容JS','0','用于章节阅读页JS调用内容的模式',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',20600,'文件参数'),(423,'article','usetxtjs','是否启用章节内容JS','0','启用后生成阅读页时内容部分赋值JS调用，而不是图文内容。',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',20610,'文件参数'),(424,'article','txtjsdir','章节内容JS目录','js','',0,1,'',20620,'文件参数'),(425,'article','txtjsurl','访问章节内容JS的URL','','章节内容JS用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',20630,'文件参数'),(426,'article','maxrates','小说评分最大值','10','',0,3,'',30550,'积分设置'),(427,'article','dayrates','每天可以评分次数','1','',0,3,'',30560,'积分设置'),(497,'article','fakefulltop','全本排行伪静态规则','','\r\n变量：<{$order}>（排序方式），<{$sortid}>（分类ID），<{$sortcode}>（分类英文代码），<{$page}>（页码），<{$page|subdirectory}>（页码子目录）。\r\n例如：/fulltop/<{$order}>/<{$page}>.html\r\n指向：/modules/article/toplist.php?fullflag=1&order=$order&page=$page',0,1,'',21942,'文件参数'),(494,'article','fakeauthor','作者专栏伪静态规则','/author/<{$id}>.html','\r\n变量：<{$id}>（作者ID），<{$id|subdirectory}>（作者ID子目录）。。\r\n例如：/author/<{$id}>.html\r\n指向：/modules/article/authorpage.php?id=$id',0,1,'',21980,'文件参数'),(484,'article','fakearticle','小说目录页伪静态规则','/book<{$aid|subdirectory}>/<{$aid}>/index.html','\r\n变量：<{$aid}>（小说ID），<{$acode}>（小说拼音代码），<{$aid|subdirectory}>（小说ID子目录）。\r\n例如：/html<{$aid|subdirectory}>/<{$aid}>/index.html\r\n指向：/modules/article/reader.php?aid=$aid\r\n例如：/html<{$aid|subdirectory}>/<{$acode}>/index.html\r\n指向：/modules/article/reader.php?acode=$acode',0,1,'',21950,'文件参数'),(485,'article','fakechapter','小说章节页伪静态规则','/book<{$aid|subdirectory}>/<{$aid}>/<{$cid}>.html','\r\n变量：<{$aid}>（小说ID），<{$acode}>（小说拼音代码），<{$aid|subdirectory}>（小说ID子目录），<{$cid}>（章节ID）。\r\n例如：/html<{$aid|subdirectory}>/<{$aid}>/<{$cid}>.html\r\n指向：/modules/article/reader.php?aid=$aid&cid=$cid\r\n例如：/html<{$aid|subdirectory}>/<{$acode}>/<{$cid}>.html\r\n指向：/modules/article/reader.php?acode=$acode&cid=$cid',0,1,'',21960,'文件参数'),(495,'article','fakefullsort','全本分类伪静态规则','','\r\n变量：<{$sortid}>（分类ID），<{$sortcode}>（分类英文代码），<{$page}>（页码），<{$page|subdirectory}>（页码子目录）。\r\n例如：/fullsort/<{$sortid}>/<{$page}>.html\r\n指向：/modules/article/articlelist.php?fullflag=1&sortid=$sortid&page=$page',0,1,'',21922,'文件参数'),(493,'article','fakefilter','书库伪静态规则','/shuku/<{$order}>_<{$sortid}>_<{$size}>_<{$update}>_<{$initial}>_<{$progress}>_<{$isvip}>_<{$page}>.html','\r\n变量：<{$order}>（排序方式），<{$rgroup}>（所属频道），<{$sortid}>（分类ID），<{$size}>（作品字数），<{$update}>（更新时间），<{$initial}>（书名首字母），<{$progress}>（写作进度），<{$isvip}>（VIP状态），<{$page}>（页码）。\r\n例如：/<{$order}>_<{$sortid}>_<{$size}>_<{$update}>_<{$initial}>_<{$progress}>_<{$isvip}>_<{$page}>.html\r\n指向：/modules/article/articlefilter.php?order=$order&rgroup=$rgroup&sortid=$sortid&size=$size&update=$update&initial=$initial&progress=$progress&isvip=$isvip&page=$page',0,2,'',21945,'文件参数'),(368,'article','tagwords','作品预设标签','','标签词语每条一行',0,2,'',13900,'显示控制'),(369,'article','taglimit','仅允许使用预设标签','0','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',14010,'显示控制'),(370,'article','uptiming','是否支持定时发表','0','若启用定时发表，需要服务器上设置定时任务配合。',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',14020,'显示控制'),(514,'article','indexprows','目录页每页显示几个章节','0','只有动态显示目录时候才允许翻页，一般用于手机站，设为 0 表示不翻页',0,3,'',12150,'显示控制'),(434,'article','greenrose','绿玫瑰单价','100','控制虚拟币打赏鲜花单价，设置成0表示关闭。',0,3,'绿玫瑰',31700,'积分设置'),(435,'article','bluerose','蓝玫瑰单价','500','控制虚拟币打赏鸡蛋单价，设置成0表示关闭。',0,3,'蓝玫瑰',31750,'积分设置'),(436,'article','whiterose','白玫瑰单价','1000','控制虚拟币打赏鲜花单价，设置成0表示关闭。',0,3,'白玫瑰',31800,'积分设置'),(437,'article','blackrose','黑玫瑰单价','5000','控制虚拟币打赏鲜花单价，设置成0表示关闭。',0,3,'黑玫瑰',31850,'积分设置'),(438,'article','yellowrose','黄玫瑰单价','10','控制虚拟币打赏鸡蛋单价，设置成0表示关闭。',0,3,'黄玫瑰',31650,'积分设置'),(439,'article','redrose','红玫瑰单价','1','控制虚拟币打赏鲜花单价，设置成0表示关闭。',0,3,'红玫瑰',31600,'积分设置'),(440,'article','isvipsize','申请上架所需字数','300000','判断作品是否符合申请上架标准',0,3,NULL,14020,'显示控制'),(441,'article','issignsize','申请签约所需字数','100000','判断作品是否符合申请签约标准',0,3,NULL,14020,'显示控制'),(442,'article','vipbuff','是否允许签约作品修改章节状态','1',NULL,0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',14020,'显示控制'),(443,'article','chapternew','是否允许作者修改章节内容','1',NULL,0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',14020,'显示控制'),(241,'forum','topicnum','每页显示几个主题','30','',0,3,'',10100,'显示控制'),(242,'forum','postnum','每页显示几个回复','10','',0,3,'',10200,'显示控制'),(243,'forum','quotelength','回复时的最大引用长度','200','',0,3,'',10300,'显示控制'),(244,'forum','searchtype','搜索匹配方式','0','',0,7,'a:3:{i:0;s:8:\"模糊匹配\";i:1;s:10:\"半模糊匹配\";i:2;s:8:\"完整匹配\";}',10950,'显示控制'),(245,'forum','minsearchlen','搜索关键字最少长度','4','',0,3,'',11000,'显示控制'),(246,'forum','maxsearchres','最大搜索结果数','300','',0,3,'',11100,'显示控制'),(247,'forum','minsearchtime','两次搜索最少间隔时间','30','',0,3,'',11200,'显示控制'),(248,'forum','textwatermark','文字水印','','指的是隐藏在阅读页面，的一些文字。其中<{$randtext}>将被替换成一组随机字符',0,2,'',11300,'显示控制'),(249,'forum','scoretopic','发表主题积分','2','',0,3,'',20100,'积分设置'),(250,'forum','scorereply','发表回复积分','1','',0,3,'',20200,'积分设置'),(251,'forum','scoregoodtopic','主题精华积分','5','',0,3,'',20300,'积分设置'),(252,'forum','attachdir','附件保存目录','attachment','',0,1,'',30100,'附件设置'),(253,'forum','attachurl','访问附件的URL','','附件用相对路径的话此处留空，否则用完整url，最后不带斜杠',0,1,'',30120,'附件设置'),(254,'forum','attachtype','允许上传的附件类型','gif jpg jpeg png bmp swf zip rar txt','多个附件用空格格开',0,1,'',30200,'附件设置'),(255,'forum','maxattachnum','一次发帖最多附件数','5','设成 0 就表示禁止附件上传',0,3,'',30300,'附件设置'),(256,'forum','maximagesize','图片附件最大允许几K','1000','',0,3,'',30400,'附件设置'),(257,'forum','maxfilesize','文件附件最大允许几K','1000','',0,3,'',30500,'附件设置'),(258,'forum','attachwater','图片附件添加水印及位置','0','本功能需要 GD 库支持才能使用，对 JPG/PNG/GIF 格式的上传图片有效',0,7,'a:11:{i:0;s:8:\"不加水印\";i:1;s:8:\"顶部居左\";i:2;s:8:\"顶部居中\";i:3;s:8:\"顶部居右\";i:4;s:8:\"中部居左\";i:5;s:8:\"中部居中\";i:6;s:8:\"中部居右\";i:7;s:8:\"底部居左\";i:8;s:8:\"底部居中\";i:9;s:8:\"底部居右\";i:10;s:8:\"随机位置\";}',36010,'附件设置'),(259,'forum','attachwimage','附件水印图片文件','watermark.gif','允许 JPG/PNG/GIF 格式，默认只需填文件名，放在 modules/article/images 目录下',0,1,'',36020,'附件设置'),(260,'forum','attachwtrans','水印图片与原图片的融合度','30','范围为 1～100 的整数，数值越大水印图片透明度越低。',0,3,'',36030,'附件设置'),(261,'forum','attachwquality','jpeg图片质量','90','范围为 0～100 的整数，数值越大结果图片效果越好，但尺寸也越大。',0,3,'',36040,'附件设置'),(515,'news','newsmanagepnum','新闻管理页新闻列表条数','10','',0,3,'',10100,'显示控制'),(516,'news','newsmanageword','新闻管理页新闻标题字数','40','',0,3,'',10200,'显示控制'),(517,'news','attachmanagepnum','附件管理页附件列表条数','10','',0,3,'',10300,'显示控制'),(518,'news','newslistpnum','新闻列表页新闻列表条数','10','',0,3,'',10400,'显示控制'),(519,'news','newslistword','新闻列表页新闻标题字数','40','',0,3,'',10500,'显示控制'),(520,'news','relatenewsenable','是否显示相关新闻','0','',0,7,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',10600,'显示控制'),(521,'news','relatenewslistpnum','相关新闻列表条数','5','',0,3,'',10700,'显示控制'),(522,'news','relatenewslistword','相关新闻标题字数','40','',0,3,'',10800,'显示控制'),(523,'news','maxkeyword','最多允许关键字个数','3','',0,3,'',10900,'显示控制'),(524,'news','newslistcache','新闻列表页缓存页数','10','',0,3,'',20100,'缓存控制'),(525,'news','minclicktime','两次点击最少时间间隔','3600','单位为: 秒',0,3,'',30100,'时间控制'),(526,'news','imagedir','上传附件保存目录','image','',0,1,'',50100,'附件设置'),(527,'news','imagetype','允许上传附件类型','gif jpg jpeg png bmp','多个类型用空格隔开',0,1,'',50200,'附件设置'),(528,'news','maximagesize','允许上传附件最大尺寸','200','单位为: K',0,1,'',50300,'附件设置'),(312,'obook','staticurl','阅读页面根地址','','用于电子书购买和阅读在不同服务器场合，留空表示用系统默认路径',0,1,'',10100,'显示控制'),(313,'obook','dynamicurl','交易页面根地址','','用于电子书购买和阅读在不同服务器场合，留空表示用系统默认路径',0,1,'',10200,'显示控制'),(322,'obook','topcachenum','电子书列表缓存几个页面','10','',0,3,'',10700,'显示控制'),(333,'obook','obkstartx','文字离图片左边距离','20','（象素点）',0,3,'',30100,'阅读设置'),(334,'obook','obkstarty','文字离图片顶部距离','50','（象素点）',0,3,'',30200,'阅读设置'),(335,'obook','obklinewidth','阅读时一行显示几个字节','80','一个汉字是2个字节，英文字母1个字节',0,3,'',30300,'阅读设置'),(336,'obook','obkfontsize','阅读字体大小','14','',0,3,'',30400,'阅读设置'),(337,'obook','obkfontjt','简体字库文件路径','C:/Windows/Fonts/simsun.ttc','',0,1,'',30420,'阅读设置'),(338,'obook','obkfontft','繁体字库文件路径','C:/Windows/Fonts/simsun.ttc','',0,1,'',30440,'阅读设置'),(339,'obook','obkcharconvert','图片文字是否进行繁简转换','1','',0,9,'a:2:{i:1;s:2:\"是\";i:0;s:2:\"否\";}',30460,'阅读设置'),(340,'obook','obkimagetype','生成图片格式','png','',0,1,'',30500,'阅读设置'),(341,'obook','jpegquality','jpeg图片质量','90','范围为 0～100 的整数，数值越大结果图片效果越好，但尺寸也越大，本参数仅生成jpeg格式图片时有效。',0,3,'',30550,'阅读设置'),(342,'obook','obkimagecolor','图片背景颜色','#ffffff','',0,1,'',30600,'阅读设置'),(343,'obook','obktextcolor','阅读字体颜色','#000000','',0,1,'',30700,'阅读设置'),(344,'obook','obkangle','字体倾斜角度','0','',0,3,'',30800,'阅读设置'),(345,'obook','obkshadowcolor','字体阴影颜色','#000000','',0,1,'',30900,'阅读设置'),(346,'obook','obkshadowdeep','字体阴影深度','0','0 表示不使用阴影',0,3,'',31000,'阅读设置'),(347,'obook','obkwatertext','是否加文字水印及水印位置','0','本功能需要 GD 库支持才能使用，对 JPG/PNG/GIF 格式的图片有效',0,7,'a:3:{i:0;s:8:\"不加水印\";i:1;s:8:\"图片四角\";i:2;s:8:\"背景平铺\";}',31050,'阅读设置'),(348,'obook','obkwaterformat','文字水印格式','','这里设置的文字水印，在实际显示时候<{$userid}>会替换成雨用户ID，<{$username}>替换成用户名',0,1,'',31060,'阅读设置'),(349,'obook','obkwatercolor','文字水印颜色','#ff6600','',0,1,'',31100,'阅读设置'),(350,'obook','obkwatersize','文字水印字体大小','16','',0,3,'',31200,'阅读设置'),(351,'obook','obkwaterangle','文字水印倾斜角度','45','',0,3,'',31300,'阅读设置'),(352,'obook','obkwaterpct','文字水印透明度','30','',0,3,'',31400,'阅读设置'),(353,'obook','obookwater','是否加图片水印及水印位置','0','本功能需要 GD 库支持才能使用，对 JPG/PNG/GIF 格式的图片有效',0,7,'a:11:{i:0;s:8:\"不加水印\";i:1;s:8:\"顶部居左\";i:2;s:8:\"顶部居中\";i:3;s:8:\"顶部居右\";i:4;s:8:\"中部居左\";i:5;s:8:\"中部居中\";i:6;s:8:\"中部居右\";i:7;s:8:\"底部居左\";i:8;s:8:\"底部居中\";i:9;s:8:\"底部居右\";i:10;s:8:\"随机位置\";}',31500,'阅读设置'),(354,'obook','obookwimage','水印图片文件','watermark.gif','允许 JPG/PNG/GIF 格式，默认只需填文件名，放在 modules/obook/images 目录下',0,1,'',31600,'阅读设置'),(355,'obook','obookwtrans','水印图片与原图片的融合度','30','范围为 1～100 的整数，数值越大水印图片透明度越低。',0,3,'',31700,'阅读设置'),(356,'obook','obookreadhead','阅读文字头部附加内容','','阅读一个电子书章节时候，内容头部和尾部可以附加一些预先设置的内容，比如网站名称、版权声明等。',0,2,'',32100,'阅读设置'),(357,'obook','obookreadfoot','阅读文字尾部附加内容','','阅读一个电子书章节时候，内容头部和尾部可以附加一些预先设置的内容，比如网站名称、版权声明等。',0,2,'',32200,'阅读设置'),(360,'obook','wordsperegold','默认几个汉字售价一虚拟币','333','',0,3,'',40300,'积分设置'),(361,'obook','priceround','按字节计算虚拟币时非整数处理方式','0','',0,7,'a:3:{i:0;s:8:\"四舍五入\";i:1;s:8:\"只舍不入\";i:2;s:8:\"只入不舍\";}',40400,'积分设置'),(362,'pay','paylogpnum','在线支付记录每页显示数','50','',0,3,'',10700,'显示控制'),(363,'pay','egoldtransrate','虚拟货币转换比率','100','百分比，请填写0~100的数字，0表示不允许转换',0,3,'',11100,'显示控制'),(364,'pay','creditransrate','销售积分转换比率','10','百分比，请填写0~100的数字，0表示不允许转换',0,3,'',11200,'显示控制'),(365,'pay','scoretransrate','网站积分转换比率','0','百分比，请填写0~100的数字，0表示不允许转换',0,3,'',11300,'显示控制');
/*!40000 ALTER TABLE `jieqi_system_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_configs_wap`
--

DROP TABLE IF EXISTS `jieqi_system_configs_wap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_configs_wap` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(50) NOT NULL DEFAULT '',
  `cname` varchar(50) NOT NULL DEFAULT '',
  `ctitle` varchar(50) NOT NULL DEFAULT '',
  `cvalue` text,
  `cdescription` text,
  `cdefine` tinyint(1) NOT NULL DEFAULT '0',
  `ctype` tinyint(1) NOT NULL DEFAULT '0',
  `options` text,
  `catorder` int(10) NOT NULL DEFAULT '0',
  `catname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cid`),
  UNIQUE KEY `modname` (`modname`,`cname`),
  KEY `catorder` (`catorder`),
  KEY `cdefine` (`cdefine`),
  KEY `catname` (`catname`)
) ENGINE=MyISAM AUTO_INCREMENT=554 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_configs_wap`
--

LOCK TABLES `jieqi_system_configs_wap` WRITE;
/*!40000 ALTER TABLE `jieqi_system_configs_wap` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_configs_wap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_friends`
--

DROP TABLE IF EXISTS `jieqi_system_friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_friends` (
  `friendsid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `adddate` int(11) NOT NULL DEFAULT '0',
  `myid` int(11) unsigned NOT NULL DEFAULT '0',
  `myname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `yourid` int(11) unsigned NOT NULL DEFAULT '0',
  `yourname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `teamid` int(11) unsigned NOT NULL DEFAULT '0',
  `team` varchar(50) NOT NULL DEFAULT '',
  `fset` text,
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`friendsid`),
  UNIQUE KEY `myid` (`myid`,`yourid`),
  KEY `teamid` (`teamid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_friends`
--

LOCK TABLES `jieqi_system_friends` WRITE;
/*!40000 ALTER TABLE `jieqi_system_friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_groups`
--

DROP TABLE IF EXISTS `jieqi_system_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_groups` (
  `groupid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  `grouptype` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_groups`
--

LOCK TABLES `jieqi_system_groups` WRITE;
/*!40000 ALTER TABLE `jieqi_system_groups` DISABLE KEYS */;
INSERT INTO `jieqi_system_groups` VALUES (1,'游客','未注册或者未登陆的访客',1),(2,'系统管理员','最高权限拥有者',1),(3,'普通会员','注册并且已经登陆的会员',1),(4,'高级会员','资深的会员',0),(5,'荣誉会员','特殊荣誉的会员',0),(6,'专栏作家','普通作家',0),(7,'驻站作家','本站专职作家',0),(8,'初级版主','处理普通事务',0),(9,'中级版主','处理中级事务',0),(10,'高级版主','除了系统管理员最高权限',0);
/*!40000 ALTER TABLE `jieqi_system_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_honors`
--

DROP TABLE IF EXISTS `jieqi_system_honors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_honors` (
  `honorid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(250) NOT NULL DEFAULT '',
  `minscore` int(11) NOT NULL DEFAULT '0',
  `maxscore` int(11) NOT NULL DEFAULT '0',
  `setting` text,
  `honortype` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`honorid`),
  KEY `minscore` (`minscore`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_honors`
--

LOCK TABLES `jieqi_system_honors` WRITE;
/*!40000 ALTER TABLE `jieqi_system_honors` DISABLE KEYS */;
INSERT INTO `jieqi_system_honors` VALUES (1,'新手上路',-9999999,10,'',0),(2,'普通会员',50,200,'',0),(3,'中级会员',200,500,'',0),(4,'高级会员',500,1000,'',0),(5,'金牌会员',1000,3000,'',0),(6,'本站元老',3000,9999999,'',0);
/*!40000 ALTER TABLE `jieqi_system_honors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_logs`
--

DROP TABLE IF EXISTS `jieqi_system_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_logs` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `siteid` int(11) NOT NULL DEFAULT '0',
  `logtype` tinyint(3) NOT NULL DEFAULT '0',
  `loglevel` tinyint(3) NOT NULL DEFAULT '0',
  `logtime` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `userip` varchar(25) NOT NULL DEFAULT '',
  `targetname` varchar(60) NOT NULL DEFAULT '',
  `targetid` int(11) NOT NULL DEFAULT '0',
  `targettitle` varchar(60) NOT NULL DEFAULT '',
  `logurl` varchar(100) NOT NULL DEFAULT '',
  `logcode` int(11) NOT NULL DEFAULT '0',
  `logtitle` varchar(100) NOT NULL DEFAULT '',
  `logdata` text,
  `lognote` text,
  `fromdata` text,
  `todata` text,
  PRIMARY KEY (`logid`),
  KEY `logtype` (`logtype`),
  KEY `loglevel` (`loglevel`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `jieqi_system_message`
--

DROP TABLE IF EXISTS `jieqi_system_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_message` (
  `messageid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `postdate` int(11) NOT NULL DEFAULT '0',
  `fromid` int(11) unsigned NOT NULL DEFAULT '0',
  `fromname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `toid` int(11) unsigned NOT NULL DEFAULT '0',
  `toname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `content` mediumtext,
  `messagetype` tinyint(1) NOT NULL DEFAULT '0',
  `isread` tinyint(1) NOT NULL DEFAULT '0',
  `fromdel` tinyint(1) NOT NULL DEFAULT '0',
  `todel` tinyint(1) NOT NULL DEFAULT '0',
  `enablebbcode` tinyint(1) NOT NULL DEFAULT '1',
  `enablehtml` tinyint(1) NOT NULL DEFAULT '0',
  `enablesmilies` tinyint(1) NOT NULL DEFAULT '1',
  `attachsig` tinyint(1) NOT NULL DEFAULT '1',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`messageid`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_message`
--

LOCK TABLES `jieqi_system_message` WRITE;
/*!40000 ALTER TABLE `jieqi_system_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_modules`
--

DROP TABLE IF EXISTS `jieqi_system_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_modules` (
  `mid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `caption` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  `version` smallint(5) unsigned NOT NULL DEFAULT '100',
  `vtype` varchar(30) NOT NULL DEFAULT '',
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
  `weight` smallint(5) unsigned NOT NULL DEFAULT '0',
  `publish` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `modtype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_modules`
--

LOCK TABLES `jieqi_system_modules` WRITE;
/*!40000 ALTER TABLE `jieqi_system_modules` DISABLE KEYS */;
INSERT INTO `jieqi_system_modules` VALUES (1,'article','小说连载','发布连载类型小说',220,'',0,990,1,0),(4,'forum','交流论坛','与本站结合的论坛',220,'',0,590,1,0),(7,'link','友情链接','管理本站的友情链接',220,'',0,570,1,0),(9,'news','新闻发布','与本站结合的新闻发布',220,'',0,0,1,0),(2,'obook','VIP电子书','小说连载的收费阅读模式',220,'',0,980,1,0),(3,'pay','在线充值','虚拟币充值',220,'',0,790,1,0);
/*!40000 ALTER TABLE `jieqi_system_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_online`
--

DROP TABLE IF EXISTS `jieqi_system_online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_online` (
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `sid` varchar(32) NOT NULL DEFAULT '',
  `uname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `name` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `pass` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `groupid` tinyint(3) NOT NULL DEFAULT '0',
  `logintime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `operate` varchar(100) NOT NULL DEFAULT '',
  `ip` varchar(25) NOT NULL DEFAULT '',
  `browser` varchar(50) NOT NULL DEFAULT '',
  `os` varchar(50) NOT NULL DEFAULT '',
  `location` varchar(100) NOT NULL DEFAULT '',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  KEY `uid` (`uid`),
  KEY `sid` (`sid`),
  KEY `groupid` (`groupid`),
  KEY `updatetime` (`updatetime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jieqi_system_persons`
--

DROP TABLE IF EXISTS `jieqi_system_persons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_persons` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `realname` varchar(30) NOT NULL DEFAULT '',
  `gender` varchar(6) NOT NULL DEFAULT '',
  `birthyear` varchar(255) NOT NULL,
  `birthmonth` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `telephone` varchar(13) NOT NULL DEFAULT '',
  `mobilephone` varchar(11) NOT NULL DEFAULT '',
  `idcardtype` varchar(30) NOT NULL DEFAULT '',
  `idcard` varchar(11) NOT NULL DEFAULT '',
  `qq` varchar(11) NOT NULL DEFAULT '',
  `idcardimage` varchar(255) NOT NULL,
  `address` varchar(60) NOT NULL DEFAULT '',
  `zipcode` varchar(6) NOT NULL DEFAULT '',
  `areaid` int(11) unsigned NOT NULL DEFAULT '0',
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `banktype` varchar(20) NOT NULL DEFAULT '',
  `bankname` varchar(60) NOT NULL DEFAULT '',
  `bankcard` varchar(20) NOT NULL DEFAULT '',
  `bankuser` varchar(30) NOT NULL DEFAULT '',
  `bankuinfo` varchar(255) NOT NULL,
  `myprofile` varchar(255) NOT NULL,
  `divided` int(3) NOT NULL DEFAULT '0',
  `denyedit` int(1) NOT NULL DEFAULT '0',
  `mynote` text,
  `mynotice` text,
  `ownerid` int(11) unsigned NOT NULL DEFAULT '0',
  `ownermark` varchar(255) NOT NULL,
  `addvars` varchar(255) NOT NULL,
  `editdata` varchar(255) NOT NULL DEFAULT '',
  `edittime` int(11) unsigned NOT NULL DEFAULT '0',
  `ugroup` int(11) unsigned NOT NULL DEFAULT '0',
  `ulevel` int(11) unsigned NOT NULL DEFAULT '0',
  `authstate` int(11) unsigned NOT NULL DEFAULT '0',
  `audittime` int(11) unsigned NOT NULL DEFAULT '0',
  `isaudit` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `realname` (`realname`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_persons`
--

LOCK TABLES `jieqi_system_persons` WRITE;
/*!40000 ALTER TABLE `jieqi_system_persons` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_persons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_power`
--

DROP TABLE IF EXISTS `jieqi_system_power`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_power` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(50) NOT NULL DEFAULT '',
  `pname` varchar(50) NOT NULL DEFAULT '',
  `ptitle` varchar(50) NOT NULL DEFAULT '',
  `pdescription` text,
  `pgroups` text,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `modname` (`modname`,`pname`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_power`
--

LOCK TABLES `jieqi_system_power` WRITE;
/*!40000 ALTER TABLE `jieqi_system_power` DISABLE KEYS */;
INSERT INTO `jieqi_system_power` VALUES (1,'system','adminpanel','进入管理面板','','a:3:{i:0;s:1:\"8\";i:1;s:1:\"9\";i:2;s:2:\"10\";}'),(2,'system','adminconfig','管理参数设置','',''),(3,'system','adminpower','管理权限设置','',''),(4,'system','admingroup','管理用户组','',''),(5,'system','adminuser','管理用户','','a:1:{i:0;s:2:\"10\";}'),(6,'system','deluser','删除用户','','a:1:{i:0;s:2:\"10\";}'),(7,'system','adminblock','管理区块','','a:1:{i:0;s:2:\"10\";}'),(8,'system','adminpaylog','管理在线支付','',''),(9,'system','adminmessage','管理短消息','','a:2:{i:0;s:1:\"9\";i:1;s:2:\"10\";}'),(10,'system','adminuserlog','管理用户日志','','a:3:{i:0;s:1:\"8\";i:1;s:1:\"9\";i:2;s:2:\"10\";}'),(11,'system','viewuser','查看用户列表','','a:8:{i:0;s:1:\"3\";i:1;s:1:\"4\";i:2;s:1:\"5\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"8\";i:6;s:1:\"9\";i:7;s:2:\"10\";}'),(12,'system','viewonline','查看在线用户','','a:3:{i:0;s:1:\"8\";i:1;s:1:\"9\";i:2;s:2:\"10\";}'),(13,'system','changegroup','管理用户等级','指修改用户组权限（注意：只有系统管理员才能设置系统管理员）','a:1:{i:0;s:2:\"10\";}'),(14,'system','adminvip','管理用户VIP信息','修改VIP状态，虚拟货币等',''),(15,'system','sendmessage','向其他会员发送短信','','a:8:{i:0;s:1:\"3\";i:1;s:1:\"4\";i:2;s:1:\"5\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"8\";i:6;s:1:\"9\";i:7;s:2:\"10\";}'),(16,'system','haveparlor','拥有个人会客室','','a:5:{i:0;s:1:\"6\";i:1;s:1:\"7\";i:2;s:1:\"8\";i:3;s:1:\"9\";i:4;s:2:\"10\";}'),(17,'system','parlorpost','允许在会客室发帖','','a:8:{i:0;s:1:\"3\";i:1;s:1:\"4\";i:2;s:1:\"5\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"8\";i:6;s:1:\"9\";i:7;s:2:\"10\";}'),(18,'system','manageallparlor','管理所有会客室','','a:2:{i:0;s:1:\"9\";i:1;s:2:\"10\";}'),(19,'system','adminreport','管理用户报告','','a:3:{i:0;s:1:\"8\";i:1;s:1:\"9\";i:2;s:2:\"10\";}'),(20,'article','adminconfig','管理参数设置','',''),(21,'article','adminpower','管理权限设置','',''),(22,'article','authorpanel','进入作家专栏','','a:5:{i:0;s:1:\"6\";i:1;s:1:\"7\";i:2;s:1:\"8\";i:3;s:1:\"9\";i:4;s:2:\"10\";}'),(23,'article','newarticle','发表小说','包括发表新小说、并且可以对自己的小说有增加章节、编辑章节和删除章节权限','a:5:{i:0;s:1:\"6\";i:1;s:1:\"7\";i:2;s:1:\"8\";i:3;s:1:\"9\";i:4;s:2:\"10\";}'),(24,'article','transarticle','转载小说','','a:3:{i:0;s:1:\"8\";i:1;s:1:\"9\";i:2;s:2:\"10\";}'),(25,'article','needcheck','发表小说不需要审查','','a:4:{i:0;s:1:\"7\";i:1;s:1:\"8\";i:2;s:1:\"9\";i:3;s:2:\"10\";}'),(26,'article','manageallarticle','管理他人小说','','a:2:{i:0;s:1:\"9\";i:1;s:2:\"10\";}'),(27,'article','delmyarticle','删除自己小说','','a:4:{i:0;s:1:\"7\";i:1;s:1:\"8\";i:2;s:1:\"9\";i:3;s:2:\"10\";}'),(28,'article','delallarticle','删除他人小说','','a:1:{i:0;s:2:\"10\";}'),(29,'article','manageallreview','管理他人书评','','a:2:{i:0;s:1:\"9\";i:1;s:2:\"10\";}'),(30,'article','newdraft','使用草稿箱','允许作者将章节保存到草稿箱的权限','a:1:{i:0;s:2:\"10\";}'),(31,'article','managesort','管理小说分类','管理小说类别',''),(32,'article','articleupattach','发文允许上传附件','',''),(33,'article','reviewupattach','书评允许上传附件','',''),(34,'article','viewuplog','查看更新记录','','a:3:{i:0;s:1:\"8\";i:1;s:1:\"9\";i:2;s:2:\"10\";}'),(35,'article','newreview','发表书评','','a:8:{i:0;s:1:\"3\";i:1;s:1:\"4\";i:2;s:1:\"5\";i:3;s:1:\"6\";i:4;s:1:\"7\";i:5;s:1:\"8\";i:6;s:1:\"9\";i:7;s:2:\"10\";}'),(36,'article','articlemodify','修改小说统计','','a:1:{i:0;s:2:\"10\";}'),(37,'article','setwriter','审核会员申请成为作者','','a:2:{i:0;s:1:\"9\";i:1;s:2:\"10\";}'),(38,'article','uptiming','定时发表章节','',''),(54,'forum','adminconfig','管理参数设置','',''),(102,'news','adminconfig','管理参数设置','',''),(103,'news','adminpower','管理权限设置','',''),(104,'news','managecategory','管理新闻栏目','',''),(105,'news','newslist','查看新闻列表','',''),(106,'news','newsaddback','新闻后台发布','',''),(107,'news','newsaddfront','新闻前台发布','',''),(108,'news','newsneedaudit','新闻需要审核','',''),(109,'news','newsedit','新闻编辑','',''),(110,'news','newsdel','新闻删除','',''),(111,'news','newsaudit','新闻审核','',''),(112,'news','newsputop','新闻置顶','',''),(113,'news','newshtml','管理新闻静态化','',''),(114,'news','manageattach','管理附件','',''),(115,'news','attachadd','上传附件','',''),(93,'obook','newobook','发布电子书','只能以自己名义发布电子书',''),(94,'obook','transobook','转载电子书','可以以他人名义名义发布',''),(95,'obook','manageallobook','管理电子书','管理所有电子书',''),(96,'obook','needcheck','发布电子书不需要审查','',''),(97,'obook','viewbuylog','查看购买记录','',''),(98,'obook','customprice','允许自定电子书价格','',''),(99,'obook','freeread','免费阅读电子书','',''),(100,'pay','adminpaylog','管理充值记录','',''),(101,'pay','adminconfig','参数设置','','');
/*!40000 ALTER TABLE `jieqi_system_power` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_pposts`
--

DROP TABLE IF EXISTS `jieqi_system_pposts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_pposts` (
  `postid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `topicid` int(10) unsigned NOT NULL DEFAULT '0',
  `istopic` tinyint(1) NOT NULL DEFAULT '0',
  `replypid` int(10) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(11) unsigned NOT NULL DEFAULT '0',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `posterip` varchar(25) NOT NULL DEFAULT '',
  `editorid` int(10) NOT NULL DEFAULT '0',
  `editor` varchar(30) NOT NULL DEFAULT '',
  `edittime` int(10) NOT NULL DEFAULT '0',
  `editorip` varchar(25) NOT NULL DEFAULT '',
  `editnote` varchar(250) NOT NULL DEFAULT '',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `attachment` text,
  `subject` varchar(80) NOT NULL DEFAULT '',
  `posttext` mediumtext,
  `size` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`postid`),
  KEY `ownerid` (`ownerid`),
  KEY `ptopicid` (`topicid`,`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_pposts`
--

LOCK TABLES `jieqi_system_pposts` WRITE;
/*!40000 ALTER TABLE `jieqi_system_pposts` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_pposts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_promotions`
--

DROP TABLE IF EXISTS `jieqi_system_promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_promotions` (
  `ip` varchar(15) NOT NULL DEFAULT '',
  `uid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_promotions`
--

LOCK TABLES `jieqi_system_promotions` WRITE;
/*!40000 ALTER TABLE `jieqi_system_promotions` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_ptopics`
--

DROP TABLE IF EXISTS `jieqi_system_ptopics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_ptopics` (
  `topicid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `ownerid` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `posterid` int(11) NOT NULL DEFAULT '0',
  `poster` varchar(30) NOT NULL DEFAULT '',
  `posttime` int(11) NOT NULL DEFAULT '0',
  `replierid` int(10) NOT NULL DEFAULT '0',
  `replier` varchar(30) NOT NULL DEFAULT '',
  `replytime` int(11) NOT NULL DEFAULT '0',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `islock` tinyint(1) NOT NULL DEFAULT '0',
  `istop` int(11) NOT NULL DEFAULT '0',
  `isgood` tinyint(1) NOT NULL DEFAULT '0',
  `rate` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  `needperm` int(10) unsigned NOT NULL DEFAULT '0',
  `needscore` int(10) unsigned NOT NULL DEFAULT '0',
  `needexp` int(10) unsigned NOT NULL DEFAULT '0',
  `needprice` int(10) unsigned NOT NULL DEFAULT '0',
  `sortid` tinyint(3) NOT NULL DEFAULT '0',
  `iconid` tinyint(3) NOT NULL DEFAULT '0',
  `typeid` tinyint(3) NOT NULL DEFAULT '0',
  `lastinfo` varchar(255) NOT NULL DEFAULT '',
  `linkurl` varchar(100) NOT NULL DEFAULT '',
  `size` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicid`),
  KEY `ownerid` (`ownerid`,`istop`,`replytime`),
  KEY `posterid` (`posterid`,`replytime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_ptopics`
--

LOCK TABLES `jieqi_system_ptopics` WRITE;
/*!40000 ALTER TABLE `jieqi_system_ptopics` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_ptopics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_qiandao`
--

DROP TABLE IF EXISTS `jieqi_system_qiandao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_qiandao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `totalsign` int(11) NOT NULL,
  `dates` text NOT NULL,
  `times` int(11) unsigned NOT NULL DEFAULT '0',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `jieqi_system_registerip`
--

DROP TABLE IF EXISTS `jieqi_system_registerip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_registerip` (
  `ip` char(15) NOT NULL DEFAULT '',
  `regtime` int(11) unsigned NOT NULL DEFAULT '0',
  `count` smallint(6) NOT NULL DEFAULT '0',
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_registerip`
--

LOCK TABLES `jieqi_system_registerip` WRITE;
/*!40000 ALTER TABLE `jieqi_system_registerip` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_registerip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_report`
--

DROP TABLE IF EXISTS `jieqi_system_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_report` (
  `reportid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `reporttime` int(11) unsigned NOT NULL DEFAULT '0',
  `reportuid` int(11) unsigned NOT NULL DEFAULT '0',
  `reportname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `authtime` int(11) unsigned NOT NULL DEFAULT '0',
  `authuid` int(11) unsigned NOT NULL DEFAULT '0',
  `authname` varchar(30) CHARACTER SET gbk COLLATE gbk_bin NOT NULL DEFAULT '',
  `reporttitle` varchar(100) NOT NULL DEFAULT '',
  `reporttext` mediumtext,
  `reportsize` int(11) unsigned NOT NULL DEFAULT '0',
  `reportfield` varchar(250) NOT NULL DEFAULT '',
  `authnote` text,
  `reportsort` smallint(6) unsigned NOT NULL DEFAULT '0',
  `reporttype` smallint(6) unsigned NOT NULL DEFAULT '0',
  `authflag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`reportid`),
  KEY `reportsort` (`reportsort`),
  KEY `reporttype` (`reporttype`),
  KEY `reportname` (`reportname`),
  KEY `authname` (`authname`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_report`
--

LOCK TABLES `jieqi_system_report` WRITE;
/*!40000 ALTER TABLE `jieqi_system_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_right`
--

DROP TABLE IF EXISTS `jieqi_system_right`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_right` (
  `rid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(50) NOT NULL DEFAULT '',
  `rname` varchar(50) NOT NULL DEFAULT '',
  `rtitle` varchar(50) NOT NULL DEFAULT '',
  `rdescription` text,
  `rhonors` text,
  PRIMARY KEY (`rid`),
  KEY `modname` (`modname`,`rname`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_right`
--

LOCK TABLES `jieqi_system_right` WRITE;
/*!40000 ALTER TABLE `jieqi_system_right` DISABLE KEYS */;
INSERT INTO `jieqi_system_right` VALUES (1,'system','maxfriends','最大好友数','','a:6:{i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";i:4;s:0:\"\";i:5;s:0:\"\";i:6;s:0:\"\";}'),(2,'system','maxmessages','信箱最多消息数','','a:6:{i:1;s:1:\"0\";i:2;s:1:\"2\";i:3;s:1:\"3\";i:4;s:1:\"4\";i:5;s:1:\"5\";i:6;s:1:\"6\";}'),(3,'system','maxdaymsg','每天允许发消息数','','a:6:{i:1;s:0:\"\";i:2;s:0:\"\";i:3;s:0:\"\";i:4;s:0:\"\";i:5;s:0:\"\";i:6;s:0:\"\";}'),(4,'article','maxbookmarks','书架最大收藏量','',''),(5,'article','dayvotes','每天允许推荐次数','',''),(6,'article','dayrates','每天允许评分次数','','');
/*!40000 ALTER TABLE `jieqi_system_right` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_session`
--

DROP TABLE IF EXISTS `jieqi_system_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_session` (
  `sess_id` varchar(32) NOT NULL DEFAULT '',
  `sess_updated` int(11) unsigned NOT NULL DEFAULT '0',
  `sess_data` text,
  PRIMARY KEY (`sess_id`),
  KEY `sess_updated` (`sess_updated`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_session`
--

LOCK TABLES `jieqi_system_session` WRITE;
/*!40000 ALTER TABLE `jieqi_system_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_userapi`
--

DROP TABLE IF EXISTS `jieqi_system_userapi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_userapi` (
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `apiflag` int(11) unsigned NOT NULL DEFAULT '0',
  `apidata` text,
  `apiset` text,
  `qqid` varchar(100) NOT NULL DEFAULT '',
  `weixinid` varchar(32) NOT NULL,
  `qqtid` varchar(100) NOT NULL DEFAULT '',
  `baiduid` varchar(100) NOT NULL DEFAULT '',
  `weiboid` varchar(100) NOT NULL DEFAULT '',
  `taobaoid` varchar(100) NOT NULL DEFAULT '',
  `alipayid` varchar(100) NOT NULL DEFAULT '',
  `kaixin001id` varchar(100) NOT NULL DEFAULT '',
  `doubanid` varchar(100) NOT NULL DEFAULT '',
  `163id` varchar(100) NOT NULL DEFAULT '',
  `sohuid` varchar(100) NOT NULL DEFAULT '',
  `renrenid` varchar(100) NOT NULL DEFAULT '',
  `tianyaid` varchar(100) NOT NULL DEFAULT '',
  `sdoid` varchar(100) NOT NULL DEFAULT '',
  `googleid` varchar(100) NOT NULL DEFAULT '',
  `msnid` varchar(100) NOT NULL DEFAULT '',
  `yohooid` varchar(100) NOT NULL DEFAULT '',
  `facebookid` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`),
  KEY `qqid` (`qqid`),
  KEY `qqtid` (`qqtid`),
  KEY `weiboid` (`weiboid`),
  KEY `taobaoid` (`taobaoid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `jieqi_system_userlink`
--

DROP TABLE IF EXISTS `jieqi_system_userlink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_userlink` (
  `ulid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ultitle` varchar(60) NOT NULL DEFAULT '',
  `ulurl` varchar(100) NOT NULL DEFAULT '',
  `ulinfo` varchar(255) NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL DEFAULT '',
  `score` tinyint(1) NOT NULL DEFAULT '0',
  `weight` smallint(6) NOT NULL DEFAULT '0',
  `toptime` int(11) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL DEFAULT '0',
  `allvisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ulid`),
  KEY `userid` (`userid`,`toptime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_userlink`
--

LOCK TABLES `jieqi_system_userlink` WRITE;
/*!40000 ALTER TABLE `jieqi_system_userlink` DISABLE KEYS */;
/*!40000 ALTER TABLE `jieqi_system_userlink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_userlog`
--

DROP TABLE IF EXISTS `jieqi_system_userlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_userlog` (
  `logid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `logtime` int(11) unsigned NOT NULL DEFAULT '0',
  `fromid` int(11) unsigned NOT NULL DEFAULT '0',
  `fromname` varchar(30) NOT NULL DEFAULT '',
  `toid` int(11) unsigned NOT NULL DEFAULT '0',
  `toname` varchar(30) NOT NULL DEFAULT '',
  `reason` text,
  `chginfo` text,
  `chglog` text,
  `isdel` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userlog` mediumtext,
  PRIMARY KEY (`logid`),
  KEY `logtime` (`logtime`),
  KEY `fromid` (`fromid`),
  KEY `toid` (`toid`),
  KEY `fromname` (`fromname`),
  KEY `toname` (`toname`),
  KEY `isdel` (`isdel`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `jieqi_system_users`
--

DROP TABLE IF EXISTS `jieqi_system_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_users` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(11) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(30) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `pass` varchar(32) NOT NULL DEFAULT '',
  `salt` varchar(32) NOT NULL DEFAULT '',
  `groupid` tinyint(3) NOT NULL DEFAULT '0',
  `regdate` int(11) unsigned NOT NULL DEFAULT '0',
  `initial` char(1) NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(60) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `avatar` int(11) NOT NULL DEFAULT '0',
  `workid` tinyint(3) NOT NULL DEFAULT '0',
  `qq` varchar(15) NOT NULL DEFAULT '',
  `icq` varchar(15) NOT NULL DEFAULT '',
  `msn` varchar(60) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `sign` text,
  `intro` text,
  `setting` text,
  `badges` text,
  `lastlogin` int(10) unsigned NOT NULL DEFAULT '0',
  `verify` int(11) unsigned NOT NULL DEFAULT '0',
  `showset` int(11) unsigned NOT NULL DEFAULT '0',
  `acceptset` int(11) unsigned NOT NULL DEFAULT '0',
  `monthscore` int(11) NOT NULL DEFAULT '0',
  `weekscore` int(11) NOT NULL DEFAULT '0',
  `dayscore` int(11) NOT NULL DEFAULT '0',
  `lastscore` int(11) unsigned NOT NULL DEFAULT '0',
  `experience` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `egold` int(11) NOT NULL DEFAULT '0',
  `esilver` int(11) NOT NULL DEFAULT '0',
  `sumtip` int(11) unsigned NOT NULL DEFAULT '0',
  `sumtask` int(11) unsigned NOT NULL DEFAULT '0',
  `sumworks` int(11) unsigned NOT NULL DEFAULT '0',
  `sumaward` int(11) unsigned NOT NULL DEFAULT '0',
  `sumgift` int(11) unsigned NOT NULL DEFAULT '0',
  `sumother` int(11) unsigned NOT NULL DEFAULT '0',
  `sumemoney` int(11) unsigned NOT NULL DEFAULT '0',
  `summoney` int(11) unsigned NOT NULL DEFAULT '0',
  `paidmoney` int(11) unsigned NOT NULL DEFAULT '0',
  `paidemoney` int(11) unsigned NOT NULL DEFAULT '0',
  `paytime` int(11) unsigned NOT NULL DEFAULT '0',
  `credit` int(11) NOT NULL DEFAULT '0',
  `goodnum` int(11) NOT NULL DEFAULT '0',
  `badnum` int(11) NOT NULL DEFAULT '0',
  `expenses` int(11) NOT NULL DEFAULT '0',
  `conisbind` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `viplevel` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isvip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `overtime` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `juan` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_users`
--

LOCK TABLES `jieqi_system_users` WRITE;
/*!40000 ALTER TABLE `jieqi_system_users` DISABLE KEYS */;
INSERT INTO `jieqi_system_users` VALUES (1,0,'admin','admin','21232f297a57a5a743894a0e4a801fc3','',2,1381334400,'A',0,'admin@jieqi.com','',0,0,'','','','',NULL,NULL,'a:3:{s:6:\"lastip\";s:13:\"218.56.65.134\";s:8:\"loginsid\";s:26:\"qo0kaefm4qqfpmndlak1raout3\";s:9:\"logindate\";s:10:\"2017-06-22\";}',NULL,1498091613,0,0,0,0,370,10,0,5267,5387,10999,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3000,0,0,1,1498954850,0,0),(29,0,'ej4vIKmOL1OHJicO','ej4vIKmOL1OHJicO','c0efe5f80b1d5a01c4320e1c75f2c568','d18a6c2cefd02537',3,1493904787,'E',0,'5IieskOgjiM6BblE@qq.com','',0,0,'','','','','','','a:1:{s:5:\"regip\";s:15:\"101.226.125.108\";}','',1493904787,0,0,0,0,0,0,0,10,10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0),(28,0,'lGLK3Tp2Y58xKOEw','lGLK3Tp2Y58xKOEw','e17b0fa87357039ff1208c6169d54eea','c5ff40cea7e96ae0',3,1493903772,'L',0,'gRB2tteI61RtgluQ@qq.com','',0,0,'','','','','','','a:4:{s:5:\"regip\";s:14:\"223.244.246.51\";s:6:\"lastip\";s:14:\"223.244.246.51\";s:8:\"loginsid\";s:26:\"8l6o46o0cc99vs7fq5j2g9vds6\";s:9:\"logindate\";s:10:\"2017-05-04\";}','',1493903892,0,0,0,0,0,0,0,12,12,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0),(27,0,'JDZOcqgVQcvDMoPM','JDZOcqgVQcvDMoPM','eafb8ff7c5c97e6fb368d6534bb21007','928f1f686e79b9cb',3,1493903709,'J',0,'koUiZbeg64zd5GIR@qq.com','',0,0,'','','','','','','a:4:{s:5:\"regip\";s:15:\"101.226.125.108\";s:6:\"lastip\";s:15:\"101.226.125.108\";s:8:\"loginsid\";s:26:\"kcjcq9bngn6d9n9mofka254q96\";s:9:\"logindate\";s:10:\"2017-05-04\";}','',1493904248,0,0,0,0,0,0,0,12,12,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0);
/*!40000 ALTER TABLE `jieqi_system_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jieqi_system_vips`
--

DROP TABLE IF EXISTS `jieqi_system_vips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jieqi_system_vips` (
  `vipid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `caption` varchar(255) NOT NULL,
  `minegold` int(11) unsigned NOT NULL DEFAULT '0',
  `maxegold` int(11) unsigned NOT NULL DEFAULT '0',
  `extraegold` int(11) unsigned NOT NULL DEFAULT '0',
  `extradiv` int(11) unsigned NOT NULL DEFAULT '0',
  `viptype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vipid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jieqi_system_vips`
--

LOCK TABLES `jieqi_system_vips` WRITE;
/*!40000 ALTER TABLE `jieqi_system_vips` DISABLE KEYS */;
INSERT INTO `jieqi_system_vips` VALUES (1,'VIP1',0,1000,300,100,0),(2,'VIP2',2000,5000,600,100,9),(3,'VIP3',10000,10000,1500,200,9);
/*!40000 ALTER TABLE `jieqi_system_vips` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-22  9:07:19

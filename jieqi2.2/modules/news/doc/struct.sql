--
-- ��Ľṹ `jieqi_news_sort`
--
#�����
DROP TABLE IF EXISTS `jieqi_news_sort`;
CREATE TABLE `jieqi_news_sort` (
  `sortid` smallint(6) unsigned NOT NULL auto_increment,          #���ID
  `parentid` smallint(6) unsigned NOT NULL default '0',           #���ID
  `sortorder` smallint(6) unsigned NOT NULL default '100',        #�������
  `sortname` varchar(30) NOT NULL default '',                     #�������
  `shortname` varchar(12) NOT NULL default '',                    #���������д
  `description` varchar(250) NOT NULL default '',                 #�������
  `layer` tinyint(3) NOT NULL default '0',                        #������
  `routes` text NOT NULL,                                         #���·��
  `childs` text NOT NULL,                                         #�������
  PRIMARY KEY  (`sortid`),
  KEY `parentid` (`parentid`),
  KEY `sortorder` (`sortorder`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- ��Ľṹ `jieqi_news_news`
--
#��������
DROP TABLE IF EXISTS `jieqi_news_topic`;
CREATE TABLE `jieqi_news_topic` (
  `topicid` int(11) NOT NULL auto_increment,                      #ID
  `posterid` int(11) NOT NULL default '0',                        #������ID
  `poster` varchar(30) NOT NULL default '',                       #����������
  `posterip` varchar(25) NOT NULL default '',                     #������IP
  `masterid` int(11) NOT NULL default '0',                        #������ID
  `master` varchar(30) NOT NULL default '',                       #����������
  `masterip` varchar(25) NOT NULL default '',                     #������IP
  `addtime` int(11) NOT NULL default '0',                         #����ʱ��
  `uptime` int(11) NOT NULL default '0',                          #����ʱ��
  `sortid` int(11) NOT NULL default '0',                          #���ID
  `areaid` int(11) NOT NULL default '0',                          #����ID
  `title` varchar(80) NOT NULL default '',                        #���� 
  `subhead` varchar(80) NOT NULL default '',                      #������ 
  `tags` varchar(50) NOT NULL default '',                         #��ǩ
  `author` varchar(30) NOT NULL default '',                       #����
  `aurl` varchar(100) NOT NULL default '',                        #����url
  `source` varchar(50) NOT NULL default '',                       #��Դ
  `surl` varchar(100) NOT NULL default '',                        #��Դurl
  `gourl` varchar(100) NOT NULL default '',                       #��ת��url
  `summary` text NOT NULL,                                        #ժҪ
  `style` tinyint(1) NOT NULL default '0',                        #���ԣ������� 1-��Ŀ 2-�Ӵ� 4-���� 8-ͷ�� 16-�Ƽ���
  `cover` tinyint(1) unsigned NOT NULL default '0',               #����ͼ��־(0-��ͼƬ 1-СͼƬ 2����ͼƬ 3����СͼƬ����)
  `attach` tinyint(1) unsigned NOT NULL default '0',              #������־(0-�޸��� 1-�и���)
  `review` tinyint(1) unsigned NOT NULL default '0',              #�Ƿ���������(0-���� 1-��ֹ)
  `vote` tinyint(1) unsigned NOT NULL default '0',                #�Ƿ���ͶƱ(0-�� 1-��)
  `login` tinyint(1) unsigned NOT NULL default '0',               #�Ƿ��¼�Ķ�(0-���� 1-��Ҫ)
  `display` tinyint(1) NOT NULL default '0',                      #�Ƿ���ʾ 0-��ʾ 1-���� 2-����
  `views` int(11) unsigned NOT NULL default '0',                  #�������
  `marknum`int(11) unsigned NOT NULL default '0',                 #�ղ���
  `topnum` mediumint(8) unsigned NOT NULL default '0',            #�Ҷ�����
  `downnum` mediumint(8) unsigned NOT NULL default '0',           #�Ҳȴ���
  `scorenum` mediumint(8) unsigned NOT NULL default '0',          #���ִ���
  `sumscore` int(11) unsigned NOT NULL default '0',               #�ܷ���
  `reviews` mediumint(8) unsigned NOT NULL default '0',           #����������
  `replies` mediumint(8) unsigned NOT NULL default '0',           #����������
  PRIMARY KEY  (`topicid`),
  KEY `posterid` (`posterid`),
  KEY `sortid` (`sortid`),
  KEY `areaid` (`areaid`)
) TYPE=MyISAM;

#��������-�Ƿ��������ۣ��Ƿ��¼�Ķ�
#��������-��ҳ���ؼ����滻����ȡ����ͼ
 
-- --------------------------------------------------------

-- 
-- ��Ľṹ `jieqi_news_content`
-- 
#��������
DROP TABLE IF EXISTS `jieqi_news_content`;
CREATE TABLE `jieqi_news_content` (
  `topicid` int(11) NOT NULL default '0',                         #����ID
  `contents` mediumtext NOT NULL,                                 #����
  PRIMARY KEY  (`topicid`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- ��Ľṹ `jieqi_news_attachment`
-- 
DROP TABLE IF EXISTS `jieqi_news_attachment`;
CREATE TABLE `jieqi_news_attachment` (
  `attachid` int(10) unsigned NOT NULL auto_increment,
  `ownerid` int(11) unsigned NOT NULL default '0',
  `addtime` int(11) unsigned NOT NULL default '0',
  `uptime` int(11) unsigned NOT NULL default '0',
  `userid` int(11) unsigned NOT NULL default '0',
  `username` varchar(30) NOT NULL default '',
  `attachname` varchar(50) NOT NULL default '',
  `description` varchar(100) NOT NULL default '',
  `attachtype` varchar(30) NOT NULL default '',
  `attachflag` tinyint(1) unsigned NOT NULL default '0',
  `attachpath` varchar(100) NOT NULL default '',
  `attachsize` int(11) unsigned NOT NULL default '0',
  `downloads` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`attachid`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- ��Ľṹ `jieqi_news_tag`
--

DROP TABLE IF EXISTS `jieqi_news_tag`;
CREATE TABLE `jieqi_news_tag` (
  `tagid` int(11) unsigned NOT NULL auto_increment,               #��ǩID
  `tagname` varchar(30) NOT NULL default '',                      #��ǩ��
  `addtime` int(11) unsigned NOT NULL default '0',                #����ʱ��
  `tagsort` smallint(3) unsigned NOT NULL default '0',            #tag����
  `userid` int(11) unsigned NOT NULL default '0',                 #������ID
  `username` varchar(30) NOT NULL default '',                     #������
  `linknum` int(11) unsigned NOT NULL default '0',                #����������
  `views` int(11) unsigned NOT NULL default '0',                  #��ǩ�����
  `display` tinyint(1) unsigned NOT NULL default '0',             #�Ƿ���ʾ
  PRIMARY KEY  (`tagid`),
  UNIQUE KEY `tagname` (`tagname`),
  KEY `linknum` (`linknum`),
  KEY `views` (`views`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- ��Ľṹ `jieqi_news_taglink`
--

DROP TABLE IF EXISTS `jieqi_news_taglink`;
CREATE TABLE `jieqi_news_taglink` (
  `tagid` int(11) unsigned NOT NULL default '0',                  #��ǩID
  `articleid` int(11) unsigned NOT NULL default '0',              #����ID
  `linktime` int(11) unsigned NOT NULL default '0',               #����ʱ��
  UNIQUE KEY `tagarticle` (`tagid`, `articleid`),
  KEY `articleid` (`articleid`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- ��Ľṹ `jieqi_news_tagcache`
--

-- DROP TABLE IF EXISTS `jieqi_news_tagcache`;
-- CREATE TABLE `jieqi_news_tagcache` (
--   `tagid` int(11) unsigned NOT NULL default '0',                  #��ǩID
--   `tagname` varchar(30) NOT NULL default '',                      #��ǩ��
--   `uptime` int(11) unsigned NOT NULL default '0',                 #����ʱ��
--   `linkids` mediumtext NOT NULL,                                  #����������ID���ö��ŷָ�
--   UNIQUE KEY  `tagid` (`tagid`),
--   UNIQUE KEY `tagname` (`tagname`)
-- ) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- ��Ľṹ `jieqi_news_special`
--
#ר��
DROP TABLE IF EXISTS `jieqi_news_special`;
CREATE TABLE `jieqi_news_special` (
  `speid` int(11) unsigned NOT NULL auto_increment,               #ר��ID
  `sortid` int(11) NOT NULL default '0',                          #���ID
  `addtime` varchar(10) NOT NULL,                                 #����ʱ��
  `edittime` int(11) NOT NULL default '0',                        #�޸�ʱ��
  `userid` int(11) unsigned NOT NULL default '0',                 #������ID
  `username` varchar(30) NOT NULL default '',                     #������
  `title` varchar(80) NOT NULL default '',                        #ר����� 
  `description` text NOT NULL,                                    #ר��˵��
  `linknum` int(11) NOT NULL default '0',                         #������¼��
  `toptime` varchar(10) NOT NULL,                                 #�ö�ʱ��
  `lastvisit` mediumint(8) unsigned NOT NULL default '0',         #������ʱ��
  `dayvisit` mediumint(8) unsigned NOT NULL default '0',          #�յ��
  `weekvisit` mediumint(8) unsigned NOT NULL default '0',         #�ܵ��
  `monthvisit` mediumint(8) unsigned NOT NULL default '0',        #�µ��
  `allvisit` mediumint(8) unsigned NOT NULL default '0',          #�ܵ��
  `lastvote` mediumint(8) unsigned NOT NULL default '0',          #����Ƽ�ʱ��
  `dayvote` mediumint(8) unsigned NOT NULL default '0',           #���Ƽ�
  `weekvote` mediumint(8) unsigned NOT NULL default '0',          #���Ƽ�
  `monthvote` mediumint(8) unsigned NOT NULL default '0',         #���Ƽ�
  `allvote` mediumint(8) unsigned NOT NULL default '0',           #���Ƽ�
  `imgflag` tinyint(1) NOT NULL default '0',                      #����ͼ��־ 0-��ͼ 1-Сͼ
  `isgood` tinyint(1) NOT NULL default '0',                       #������־ 0-��ͨ 1-����
  `display` tinyint(1) NOT NULL default '0',                      #�Ƿ���ʾ 0-��ʾ 1-���� 2-����
  PRIMARY KEY  (`speid`),
  UNIQUE KEY `sortid` (`sortid`),
  KEY `linknum` (`linknum`),
  KEY `userid` (`userid`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- ��Ľṹ `jieqi_news_spelink`
--
#ר������
DROP TABLE IF EXISTS `jieqi_news_spelink`;
CREATE TABLE `jieqi_news_spelink` (
  `slinkid` int(11) unsigned NOT NULL auto_increment,             #����ID
  `linkid` int(11) NOT NULL default '0',                          #������¼ID
  `addtime` varchar(10) NOT NULL,                                 #����ʱ��
  `userid` int(11) unsigned NOT NULL default '0',                 #������ID
  `username` varchar(30) NOT NULL default '',                     #������
  `ltitle` varchar(80) NOT NULL default '',                       #�Զ������ 
  `lurl` varchar(200) NOT NULL default '',                        #�Զ���URL
  `note` text NOT NULL,                                           #��¼ע��
  `rank` tinyint(1) NOT NULL default '0',                         #����
  `lorder` mediumint(8) unsigned NOT NULL default '0',            #����ֵ
  `goodnum` mediumint(8) unsigned NOT NULL default '0',           #֧����
  `badnum` mediumint(8) unsigned NOT NULL default '0',            #������
  `iscustom` tinyint(1) NOT NULL default '0',                     #�Ƿ��Զ������� 0-�� 1-��
  `isgood` tinyint(1) NOT NULL default '0',                       #������־ 0-��ͨ 1-����
  PRIMARY KEY  (`slinkid`),
  UNIQUE KEY `userid` (`userid`)
) TYPE=MyISAM;
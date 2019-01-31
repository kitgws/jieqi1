--
-- 表的结构 `jieqi_news_sort`
--
#分类表
DROP TABLE IF EXISTS `jieqi_news_sort`;
CREATE TABLE `jieqi_news_sort` (
  `sortid` smallint(6) unsigned NOT NULL auto_increment,          #类别ID
  `parentid` smallint(6) unsigned NOT NULL default '0',           #类别父ID
  `sortorder` smallint(6) unsigned NOT NULL default '100',        #类别排序
  `sortname` varchar(30) NOT NULL default '',                     #类别名称
  `shortname` varchar(12) NOT NULL default '',                    #类别名称缩写
  `description` varchar(250) NOT NULL default '',                 #类别描述
  `layer` tinyint(3) NOT NULL default '0',                        #类别层数
  `routes` text NOT NULL,                                         #类别路由
  `childs` text NOT NULL,                                         #相关子类
  PRIMARY KEY  (`sortid`),
  KEY `parentid` (`parentid`),
  KEY `sortorder` (`sortorder`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- 表的结构 `jieqi_news_news`
--
#新闻主题
DROP TABLE IF EXISTS `jieqi_news_topic`;
CREATE TABLE `jieqi_news_topic` (
  `topicid` int(11) NOT NULL auto_increment,                      #ID
  `posterid` int(11) NOT NULL default '0',                        #发表者ID
  `poster` varchar(30) NOT NULL default '',                       #发表者名称
  `posterip` varchar(25) NOT NULL default '',                     #发表者IP
  `masterid` int(11) NOT NULL default '0',                        #管理者ID
  `master` varchar(30) NOT NULL default '',                       #管理者名称
  `masterip` varchar(25) NOT NULL default '',                     #管理者IP
  `addtime` int(11) NOT NULL default '0',                         #发表时间
  `uptime` int(11) NOT NULL default '0',                          #更新时间
  `sortid` int(11) NOT NULL default '0',                          #类别ID
  `areaid` int(11) NOT NULL default '0',                          #地域ID
  `title` varchar(80) NOT NULL default '',                        #标题 
  `subhead` varchar(80) NOT NULL default '',                      #副标题 
  `tags` varchar(50) NOT NULL default '',                         #标签
  `author` varchar(30) NOT NULL default '',                       #作者
  `aurl` varchar(100) NOT NULL default '',                        #作者url
  `source` varchar(50) NOT NULL default '',                       #来源
  `surl` varchar(100) NOT NULL default '',                        #来源url
  `gourl` varchar(100) NOT NULL default '',                       #跳转到url
  `summary` text NOT NULL,                                        #摘要
  `style` tinyint(1) NOT NULL default '0',                        #属性（二进制 1-醒目 2-加粗 4-滚动 8-头条 16-推荐）
  `cover` tinyint(1) unsigned NOT NULL default '0',               #缩略图标志(0-无图片 1-小图片 2－大图片 3－大小图片都有)
  `attach` tinyint(1) unsigned NOT NULL default '0',              #附件标志(0-无附件 1-有附件)
  `review` tinyint(1) unsigned NOT NULL default '0',              #是否允许评论(0-允许 1-禁止)
  `vote` tinyint(1) unsigned NOT NULL default '0',                #是否发起投票(0-无 1-有)
  `login` tinyint(1) unsigned NOT NULL default '0',               #是否登录阅读(0-不用 1-需要)
  `display` tinyint(1) NOT NULL default '0',                      #是否显示 0-显示 1-待审 2-隐藏
  `views` int(11) unsigned NOT NULL default '0',                  #浏览次数
  `marknum`int(11) unsigned NOT NULL default '0',                 #收藏数
  `topnum` mediumint(8) unsigned NOT NULL default '0',            #我顶次数
  `downnum` mediumint(8) unsigned NOT NULL default '0',           #我踩次数
  `scorenum` mediumint(8) unsigned NOT NULL default '0',          #评分次数
  `sumscore` int(11) unsigned NOT NULL default '0',               #总分数
  `reviews` mediumint(8) unsigned NOT NULL default '0',           #评论主题数
  `replies` mediumint(8) unsigned NOT NULL default '0',           #评论帖子数
  PRIMARY KEY  (`topicid`),
  KEY `posterid` (`posterid`),
  KEY `sortid` (`sortid`),
  KEY `areaid` (`areaid`)
) TYPE=MyISAM;

#属性设置-是否允许评论，是否登录阅读
#其他功能-分页，关键字替换，提取略缩图
 
-- --------------------------------------------------------

-- 
-- 表的结构 `jieqi_news_content`
-- 
#新闻内容
DROP TABLE IF EXISTS `jieqi_news_content`;
CREATE TABLE `jieqi_news_content` (
  `topicid` int(11) NOT NULL default '0',                         #主题ID
  `contents` mediumtext NOT NULL,                                 #内容
  PRIMARY KEY  (`topicid`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- 表的结构 `jieqi_news_attachment`
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
-- 表的结构 `jieqi_news_tag`
--

DROP TABLE IF EXISTS `jieqi_news_tag`;
CREATE TABLE `jieqi_news_tag` (
  `tagid` int(11) unsigned NOT NULL auto_increment,               #标签ID
  `tagname` varchar(30) NOT NULL default '',                      #标签名
  `addtime` int(11) unsigned NOT NULL default '0',                #建立时间
  `tagsort` smallint(3) unsigned NOT NULL default '0',            #tag类型
  `userid` int(11) unsigned NOT NULL default '0',                 #发表人ID
  `username` varchar(30) NOT NULL default '',                     #发表人
  `linknum` int(11) unsigned NOT NULL default '0',                #关联文章数
  `views` int(11) unsigned NOT NULL default '0',                  #标签点击数
  `display` tinyint(1) unsigned NOT NULL default '0',             #是否显示
  PRIMARY KEY  (`tagid`),
  UNIQUE KEY `tagname` (`tagname`),
  KEY `linknum` (`linknum`),
  KEY `views` (`views`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- 表的结构 `jieqi_news_taglink`
--

DROP TABLE IF EXISTS `jieqi_news_taglink`;
CREATE TABLE `jieqi_news_taglink` (
  `tagid` int(11) unsigned NOT NULL default '0',                  #标签ID
  `articleid` int(11) unsigned NOT NULL default '0',              #文章ID
  `linktime` int(11) unsigned NOT NULL default '0',               #建立时间
  UNIQUE KEY `tagarticle` (`tagid`, `articleid`),
  KEY `articleid` (`articleid`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- 表的结构 `jieqi_news_tagcache`
--

-- DROP TABLE IF EXISTS `jieqi_news_tagcache`;
-- CREATE TABLE `jieqi_news_tagcache` (
--   `tagid` int(11) unsigned NOT NULL default '0',                  #标签ID
--   `tagname` varchar(30) NOT NULL default '',                      #标签名
--   `uptime` int(11) unsigned NOT NULL default '0',                 #更新时间
--   `linkids` mediumtext NOT NULL,                                  #关联的文章ID，用逗号分隔
--   UNIQUE KEY  `tagid` (`tagid`),
--   UNIQUE KEY `tagname` (`tagname`)
-- ) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- 表的结构 `jieqi_news_special`
--
#专题
DROP TABLE IF EXISTS `jieqi_news_special`;
CREATE TABLE `jieqi_news_special` (
  `speid` int(11) unsigned NOT NULL auto_increment,               #专题ID
  `sortid` int(11) NOT NULL default '0',                          #类别ID
  `addtime` varchar(10) NOT NULL,                                 #建立时间
  `edittime` int(11) NOT NULL default '0',                        #修改时间
  `userid` int(11) unsigned NOT NULL default '0',                 #发表人ID
  `username` varchar(30) NOT NULL default '',                     #发表人
  `title` varchar(80) NOT NULL default '',                        #专题标题 
  `description` text NOT NULL,                                    #专题说明
  `linknum` int(11) NOT NULL default '0',                         #关联记录数
  `toptime` varchar(10) NOT NULL,                                 #置顶时间
  `lastvisit` mediumint(8) unsigned NOT NULL default '0',         #最后访问时间
  `dayvisit` mediumint(8) unsigned NOT NULL default '0',          #日点击
  `weekvisit` mediumint(8) unsigned NOT NULL default '0',         #周点击
  `monthvisit` mediumint(8) unsigned NOT NULL default '0',        #月点击
  `allvisit` mediumint(8) unsigned NOT NULL default '0',          #总点击
  `lastvote` mediumint(8) unsigned NOT NULL default '0',          #最后推荐时间
  `dayvote` mediumint(8) unsigned NOT NULL default '0',           #日推荐
  `weekvote` mediumint(8) unsigned NOT NULL default '0',          #周推荐
  `monthvote` mediumint(8) unsigned NOT NULL default '0',         #月推荐
  `allvote` mediumint(8) unsigned NOT NULL default '0',           #总推荐
  `imgflag` tinyint(1) NOT NULL default '0',                      #略缩图标志 0-无图 1-小图
  `isgood` tinyint(1) NOT NULL default '0',                       #精华标志 0-普通 1-精华
  `display` tinyint(1) NOT NULL default '0',                      #是否显示 0-显示 1-隐藏 2-待审
  PRIMARY KEY  (`speid`),
  UNIQUE KEY `sortid` (`sortid`),
  KEY `linknum` (`linknum`),
  KEY `userid` (`userid`)
) TYPE=MyISAM;

-- --------------------------------------------------------

--
-- 表的结构 `jieqi_news_spelink`
--
#专题链接
DROP TABLE IF EXISTS `jieqi_news_spelink`;
CREATE TABLE `jieqi_news_spelink` (
  `slinkid` int(11) unsigned NOT NULL auto_increment,             #链接ID
  `linkid` int(11) NOT NULL default '0',                          #关联记录ID
  `addtime` varchar(10) NOT NULL,                                 #建立时间
  `userid` int(11) unsigned NOT NULL default '0',                 #发表人ID
  `username` varchar(30) NOT NULL default '',                     #发表人
  `ltitle` varchar(80) NOT NULL default '',                       #自定义标题 
  `lurl` varchar(200) NOT NULL default '',                        #自定义URL
  `note` text NOT NULL,                                           #记录注解
  `rank` tinyint(1) NOT NULL default '0',                         #评分
  `lorder` mediumint(8) unsigned NOT NULL default '0',            #排序值
  `goodnum` mediumint(8) unsigned NOT NULL default '0',           #支持数
  `badnum` mediumint(8) unsigned NOT NULL default '0',            #反对数
  `iscustom` tinyint(1) NOT NULL default '0',                     #是否自定义链接 0-否 1-是
  `isgood` tinyint(1) NOT NULL default '0',                       #精华标志 0-普通 1-精华
  PRIMARY KEY  (`slinkid`),
  UNIQUE KEY `userid` (`userid`)
) TYPE=MyISAM;
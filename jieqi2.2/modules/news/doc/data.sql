-- 
-- 导出表中的数据 `jieqi_system_blocks`
-- 

INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES (0, '新闻搜索', 'news', 'block_search', 'BlockNewsSearch', 1, '新闻搜索', '', '', '', '', 0, 0, 20100, 0, 0, 0, 0, 0);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES (0, '新闻列表', 'news', 'block_newslist', 'BlockNewsList', 1, '新闻列表', '&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块允许设置四个参数，不同参数之间用英文逗号分隔“,”。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数一是排序字段，有以下可选项：topicid - 新闻序号（默认），addtime - 发表时间，uptime - 更新时间，views - 点击数。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数二是显示新闻条数，使用整数（默认 15）。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数三是新闻类别序号，使用整数（默认 0 表示不限类别）<br>&nbsp;&nbsp;&nbsp;&nbsp;参数四是指显示顺序（默认 0 表示按从大到小排序），1 表示从小到大排序。<br>&nbsp;&nbsp;&nbsp;&nbsp;参数设置中一项或者多项留空均表示使用默认值。例子： “topicid,10” 显示最新的10条新闻（这里的第一个参数用 topicid 和用 addtime 效果是一样的）', '', 'topicid,15,0,0', 'block_newslist.html', 0, 4, 20200, 0, 0, 0, 0, 1);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES (0, '分类列表', 'news', 'block_sortsubs', 'BlockNewsSortsubs', 1, '分类列表', '&nbsp;&nbsp;&nbsp;&nbsp;本区块允许用户自定义参数，并且不同的设置可以保存成不同的区块。<br>&nbsp;&nbsp;&nbsp;&nbsp;区块有一个参数，默认是 0 表示显示顶级分类，如果是大于 0 的值，表示显示本分类ID的下级分类。<br>&nbsp;&nbsp;&nbsp;&nbsp;这个参数除了设置成具体数字，还可以设置成字符串，比如 sortid 表示url参数里面的sortid值。', '', '0', 'block_sortsubs.html', 0, 4, 20300, 0, 0, 0, 0, 1);

-- 
-- 导出表中的数据 `jieqi_system_configs`
-- 

INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'newsmanagepnum', '后台新闻管理每页几条', '30', '', 0, 3, '', 10100, '显示控制');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'attachmanagepnum', '后台附件管理页每页几条', '30', '', 0, 3, '', 10300, '显示控制');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'newslistpnum', '前台新闻列表每页几条', '10', '', 0, 3, '', 10400, '显示控制');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'newslistcache', '前台新闻列表缓存页数', '10', '', 0, 3, '', 20100, '显示控制');

INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'news', 'fakeinfo', '新闻信息页伪静态规则', '', '\r\n伪静态规则是带有替换标记的路径，留空表示不使用本规则。\r\n允许使用的替换标记有 <{$id}> 新闻ID ,<{$id|subdirectory}> 根据新闻ID生成的子目录。\r\n如：/files/news/html/<{$id|subdirectory}>/<{$id}>.html', 0, 1, '', 30100, '文件参数');

INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'news', 'fakesort', '新闻列表伪静态规则', '', '\r\n伪静态规则是带有替换标记的路径，留空表示不使用本规则。\r\n允许使用的替换标记有 <{$sortid}> 分类ID ,<{$page}> 页码，<{$page|subdirectory}> 根据页码生成的子目录。\r\n如：/files/news/sort<{$sortid}><{$page|subdirectory}>/<{$page}>.html', 0, 1, '', 30200, '文件参数');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'coverdir', '缩略图保存目录', 'cover', '', 0, 1, '', 50050, '附件设置');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'imagedir', '上传附件保存目录', 'image', '目前仅限图片上传，指新闻编辑器里面的图片上传功能', 0, 1, '', 50100, '附件设置');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'imagetype', '允许上传附件类型', 'gif jpg jpeg png bmp', '多个类型用空格隔开', 0, 1, '', 50200, '附件设置');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'maximagesize', '允许上传附件最大尺寸', '200', '单位为: K', 0, 1, '', 50300, '附件设置');

-- 
-- 导出表中的数据 `jieqi_system_modules`
-- 

INSERT INTO `jieqi_system_modules` (`mid`, `name`, `caption`, `description`, `version`, `vtype`, `lastupdate`, `weight`, `publish`, `modtype`) VALUES (0, 'news', '新闻发布', '新闻发布和管理', 130, '', 0, 0, 1, 0);

-- 
-- 导出表中的数据 `jieqi_system_power`
-- 

INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'adminconfig', '管理参数设置', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'adminpower', '管理权限设置', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'managecategory', '管理新闻栏目', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newslist', '查看新闻列表', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsaddback', '新闻后台发布', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsaddfront', '新闻前台提交', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsneedaudit', '新闻需要审核', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsedit', '新闻编辑', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsdel', '新闻删除', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsaudit', '审核新闻', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsputop', '新闻置顶', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newshtml', '管理新闻静态化', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'manageattach', '管理附件', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'attachadd', '上传附件', '', '');

-- 
-- �������е����� `jieqi_system_blocks`
-- 

INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES (0, '��������', 'news', 'block_search', 'BlockNewsSearch', 1, '��������', '', '', '', '', 0, 0, 20100, 0, 0, 0, 0, 0);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES (0, '�����б�', 'news', 'block_newslist', 'BlockNewsList', 1, '�����б�', '&nbsp;&nbsp;&nbsp;&nbsp;�����������û��Զ�����������Ҳ�ͬ�����ÿ��Ա���ɲ�ͬ�����顣<br>&nbsp;&nbsp;&nbsp;&nbsp;�������������ĸ���������ͬ����֮����Ӣ�Ķ��ŷָ���,����<br>&nbsp;&nbsp;&nbsp;&nbsp;����һ�������ֶΣ������¿�ѡ�topicid - ������ţ�Ĭ�ϣ���addtime - ����ʱ�䣬uptime - ����ʱ�䣬views - �������<br>&nbsp;&nbsp;&nbsp;&nbsp;����������ʾ����������ʹ��������Ĭ�� 15����<br>&nbsp;&nbsp;&nbsp;&nbsp;�����������������ţ�ʹ��������Ĭ�� 0 ��ʾ�������<br>&nbsp;&nbsp;&nbsp;&nbsp;��������ָ��ʾ˳��Ĭ�� 0 ��ʾ���Ӵ�С���򣩣�1 ��ʾ��С��������<br>&nbsp;&nbsp;&nbsp;&nbsp;����������һ����߶������վ���ʾʹ��Ĭ��ֵ�����ӣ� ��topicid,10�� ��ʾ���µ�10�����ţ�����ĵ�һ�������� topicid ���� addtime Ч����һ���ģ�', '', 'topicid,15,0,0', 'block_newslist.html', 0, 4, 20200, 0, 0, 0, 0, 1);
INSERT INTO `jieqi_system_blocks` (`bid`, `blockname`, `modname`, `filename`, `classname`, `side`, `title`, `description`, `content`, `vars`, `template`, `cachetime`, `contenttype`, `weight`, `showstatus`, `custom`, `canedit`, `publish`, `hasvars`) VALUES (0, '�����б�', 'news', 'block_sortsubs', 'BlockNewsSortsubs', 1, '�����б�', '&nbsp;&nbsp;&nbsp;&nbsp;�����������û��Զ�����������Ҳ�ͬ�����ÿ��Ա���ɲ�ͬ�����顣<br>&nbsp;&nbsp;&nbsp;&nbsp;������һ��������Ĭ���� 0 ��ʾ��ʾ�������࣬����Ǵ��� 0 ��ֵ����ʾ��ʾ������ID���¼����ࡣ<br>&nbsp;&nbsp;&nbsp;&nbsp;��������������óɾ������֣����������ó��ַ��������� sortid ��ʾurl���������sortidֵ��', '', '0', 'block_sortsubs.html', 0, 4, 20300, 0, 0, 0, 0, 1);

-- 
-- �������е����� `jieqi_system_configs`
-- 

INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'newsmanagepnum', '��̨���Ź���ÿҳ����', '30', '', 0, 3, '', 10100, '��ʾ����');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'attachmanagepnum', '��̨��������ҳÿҳ����', '30', '', 0, 3, '', 10300, '��ʾ����');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'newslistpnum', 'ǰ̨�����б�ÿҳ����', '10', '', 0, 3, '', 10400, '��ʾ����');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'newslistcache', 'ǰ̨�����б���ҳ��', '10', '', 0, 3, '', 20100, '��ʾ����');

INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'news', 'fakeinfo', '������Ϣҳα��̬����', '', '\r\nα��̬�����Ǵ����滻��ǵ�·�������ձ�ʾ��ʹ�ñ�����\r\n����ʹ�õ��滻����� <{$id}> ����ID ,<{$id|subdirectory}> ��������ID���ɵ���Ŀ¼��\r\n�磺/files/news/html/<{$id|subdirectory}>/<{$id}>.html', 0, 1, '', 30100, '�ļ�����');

INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES(0, 'news', 'fakesort', '�����б�α��̬����', '', '\r\nα��̬�����Ǵ����滻��ǵ�·�������ձ�ʾ��ʹ�ñ�����\r\n����ʹ�õ��滻����� <{$sortid}> ����ID ,<{$page}> ҳ�룬<{$page|subdirectory}> ����ҳ�����ɵ���Ŀ¼��\r\n�磺/files/news/sort<{$sortid}><{$page|subdirectory}>/<{$page}>.html', 0, 1, '', 30200, '�ļ�����');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'coverdir', '����ͼ����Ŀ¼', 'cover', '', 0, 1, '', 50050, '��������');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'imagedir', '�ϴ���������Ŀ¼', 'image', 'Ŀǰ����ͼƬ�ϴ���ָ���ű༭�������ͼƬ�ϴ�����', 0, 1, '', 50100, '��������');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'imagetype', '�����ϴ���������', 'gif jpg jpeg png bmp', '��������ÿո����', 0, 1, '', 50200, '��������');
INSERT INTO `jieqi_system_configs` (`cid`, `modname`, `cname`, `ctitle`, `cvalue`, `cdescription`, `cdefine`, `ctype`, `options`, `catorder`, `catname`) VALUES (0, 'news', 'maximagesize', '�����ϴ��������ߴ�', '200', '��λΪ: K', 0, 1, '', 50300, '��������');

-- 
-- �������е����� `jieqi_system_modules`
-- 

INSERT INTO `jieqi_system_modules` (`mid`, `name`, `caption`, `description`, `version`, `vtype`, `lastupdate`, `weight`, `publish`, `modtype`) VALUES (0, 'news', '���ŷ���', '���ŷ����͹���', 130, '', 0, 0, 1, 0);

-- 
-- �������е����� `jieqi_system_power`
-- 

INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'adminconfig', '�����������', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'adminpower', '����Ȩ������', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'managecategory', '����������Ŀ', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newslist', '�鿴�����б�', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsaddback', '���ź�̨����', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsaddfront', '����ǰ̨�ύ', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsneedaudit', '������Ҫ���', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsedit', '���ű༭', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsdel', '����ɾ��', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsaudit', '�������', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newsputop', '�����ö�', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'newshtml', '�������ž�̬��', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'manageattach', '������', '', '');
INSERT INTO `jieqi_system_power` (`pid`, `modname`, `pname`, `ptitle`, `pdescription`, `pgroups`) VALUES (0, 'news', 'attachadd', '�ϴ�����', '', '');

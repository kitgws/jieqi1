<?php
//��Ա���ֶ�����ز�������
//acttitle-�������� minscore-���ٻ������ϲ���ִ�б�����  islog-�Ƿ��¼��־  isvip-�Ƿ�VIP����
//ispay-�Ƿ�������  paytitle-�������� paybase-���ѻ���ֵ paymin-��С����ֵ paymax-�������ֵ
// earnscore-��ö��ٸ��˻��� earncredit-��ö��ٹ���ֵ

$jieqiAction['system']['register'] = array('acttitle'=>'��Աע��', 'minscore'=>0, 'islog'=>0, 'isvip'=>0, 'ispay'=>0, 'paytitle'=>'', 'paybase'=>1, 'paymin'=>0, 'paymax'=>0, 'earnscore'=>10, 'earncredit'=>0, 'lenmin'=>3, 'lenmax'=>14);

$jieqiAction['system']['login'] = array('acttitle'=>'��Ա��¼', 'minscore'=>0, 'islog'=>0, 'isvip'=>0, 'ispay'=>0, 'paytitle'=>'', 'paybase'=>1, 'paymin'=>0, 'paymax'=>0, 'earnscore'=>2, 'earncredit'=>0);

$jieqiAction['system']['adclick'] = array('acttitle'=>'������', 'minscore'=>0, 'islog'=>0, 'isvip'=>0, 'ispay'=>0, 'paytitle'=>'', 'paybase'=>1, 'paymin'=>0, 'paymax'=>5, 'earnscore'=>1, 'earncredit'=>0);

$jieqiAction['system']['newmessage'] = array('acttitle'=>'��վ�ڶ���', 'minscore'=>0, 'islog'=>0, 'isvip'=>0, 'ispay'=>0, 'paytitle'=>'', 'paybase'=>1, 'paymin'=>0, 'paymax'=>0, 'earnscore'=>0, 'earncredit'=>0);

$jieqiAction['system']['ptopic'] = array('acttitle'=>'����ҷ���', 'minscore'=>0, 'islog'=>0, 'isvip'=>0, 'ispay'=>0, 'paytitle'=>'', 'paybase'=>1, 'paymin'=>0, 'paymax'=>0, 'earnscore'=>0, 'earncredit'=>0);

$jieqiAction['system']['tip'] = array('acttitle'=>'����', 'minscore'=>0, 'islog'=>1, 'isvip'=>1, 'ispay'=>1, 'paytitle'=>JIEQI_EGOLD_NAME, 'paybase'=>1, 'paymin'=>20, 'paymax'=>0, 'earnscore'=>1, 'earncredit'=>2, 'ismessage'=>1);

?>
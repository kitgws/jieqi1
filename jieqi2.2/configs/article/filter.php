<?php
//������������

//����ʽ
$jieqiFilter['article']['order'] = array(
	'allvote' => array('caption'=>'�Ƽ�', 'order'=>'allvote DESC'),
	'lastupdate' => array('caption'=>'����', 'order'=>'lastupdate DESC'),
	'allvisit' => array('caption'=>'����', 'order'=>'allvisit DESC'),
);

//��������(ע�⣺size �����ݿ����ֽ�������ʵ��������2��)
$jieqiFilter['article']['size'] = array(
	1 => array('caption'=>'30������', 'limit'=>'size < 600000'),
	2 => array('caption'=>'30-50��', 'limit'=>'size >= 600000 AND size < 1000000'),
	3 => array('caption'=>'50-100��', 'limit'=>'size >= 1000000 AND size < 2000000'),
	4 => array('caption'=>'100-200��', 'limit'=>'size >= 2000000 AND size < 4000000'),
	5 => array('caption'=>'200������', 'limit'=>'size >= 4000000')
);

//����ʱ��
$jieqiFilter['article']['update'] = array(
	1 => array('caption'=>'������', 'days'=>3),
	2 => array('caption'=>'������', 'days'=>7),
	3 => array('caption'=>'������', 'days'=>15),
	4 => array('caption'=>'һ����', 'days'=>30)
);

//����Ƶ��
$jieqiFilter['article']['rgroup'] = array(
	1 => array('caption'=>'����', 'limit'=>'rgroup = 0'),
	2 => array('caption'=>'Ů��', 'limit'=>'rgroup = 1')
);

//�Ƿ�ԭ��
$jieqiFilter['article']['original'] = array(
	1 => array('caption'=>'ԭ��', 'limit'=>'authorid > 0'),
	2 => array('caption'=>'ת��', 'limit'=>'authorid = 0'),
);

//д������
$jieqiFilter['article']['isfull'] = array(
	1 => array('caption'=>'������', 'limit'=>'fullflag = 0'),
	2 => array('caption'=>'���걾', 'limit'=>'fullflag = 1')
);

//VIPѡ��
$jieqiFilter['article']['isvip'] = array(
	1 => array('caption'=>'�����Ʒ', 'limit'=>'isvip = 0'),
	2 => array('caption'=>'VIP��Ʒ', 'limit'=>'isvip > 0'),
	3 => array('caption'=>'ǩԼ��Ʒ', 'limit'=>'issign > 0'),
	4 => array('caption'=>'������Ʒ', 'limit'=>'isvip > 0 AND monthly > 0')
);

?>
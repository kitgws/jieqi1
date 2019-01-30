<?php
//过滤条件设置

//排序方式
$jieqiFilter['article']['order'] = array(
	'allvote' => array('caption'=>'推荐', 'order'=>'allvote DESC'),
	'lastupdate' => array('caption'=>'最新', 'order'=>'lastupdate DESC'),
	'allvisit' => array('caption'=>'人气', 'order'=>'allvisit DESC'),
);

//字数限制(注意：size 在数据库是字节数，是实际字数的2倍)
$jieqiFilter['article']['size'] = array(
	1 => array('caption'=>'30万以下', 'limit'=>'size < 600000'),
	2 => array('caption'=>'30-50万', 'limit'=>'size >= 600000 AND size < 1000000'),
	3 => array('caption'=>'50-100万', 'limit'=>'size >= 1000000 AND size < 2000000'),
	4 => array('caption'=>'100-200万', 'limit'=>'size >= 2000000 AND size < 4000000'),
	5 => array('caption'=>'200万以上', 'limit'=>'size >= 4000000')
);

//更新时间
$jieqiFilter['article']['update'] = array(
	1 => array('caption'=>'三日内', 'days'=>3),
	2 => array('caption'=>'七日内', 'days'=>7),
	3 => array('caption'=>'半月内', 'days'=>15),
	4 => array('caption'=>'一月内', 'days'=>30)
);

//所属频道
$jieqiFilter['article']['rgroup'] = array(
	1 => array('caption'=>'男生', 'limit'=>'rgroup = 0'),
	2 => array('caption'=>'女生', 'limit'=>'rgroup = 1')
);

//是否原创
$jieqiFilter['article']['original'] = array(
	1 => array('caption'=>'原创', 'limit'=>'authorid > 0'),
	2 => array('caption'=>'转载', 'limit'=>'authorid = 0'),
);

//写作进度
$jieqiFilter['article']['isfull'] = array(
	1 => array('caption'=>'连载中', 'limit'=>'fullflag = 0'),
	2 => array('caption'=>'已完本', 'limit'=>'fullflag = 1')
);

//VIP选项
$jieqiFilter['article']['isvip'] = array(
	1 => array('caption'=>'免费作品', 'limit'=>'isvip = 0'),
	2 => array('caption'=>'VIP作品', 'limit'=>'isvip > 0'),
	3 => array('caption'=>'签约作品', 'limit'=>'issign > 0'),
	4 => array('caption'=>'包月作品', 'limit'=>'isvip > 0 AND monthly > 0')
);

?>
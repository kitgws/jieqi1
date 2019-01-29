<?php 
/*
每日签到
*/
define('JIEQI_MODULE_NAME', 'system');
require_once('global.php');
$conn=mysql_connect(JIEQI_DB_HOST,JIEQI_DB_USER,JIEQI_DB_PASS) or die('链接失败');mysql_select_db(JIEQI_DB_NAME, $conn);@mysql_query("SET names gbk");//SQL连接
//include_once(JIEQI_ROOT_PATH.'/header.php');
jieqi_checklogin();
include_once(JIEQI_ROOT_PATH.'/class/users.php');
$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
$jieqiUsers = $users_handler->get($_SESSION['jieqiUserId']);
if(!$jieqiUsers) jieqi_printfail(LANG_NO_USER);
jieqi_loadlang('qiandao', JIEQI_MODULE_NAME);


$experience = $jieqiUsers->getVar('experience');//经验值
$username = $jieqiUsers->getVar('name');
$uid = (int)$jieqiUsers->getVar('uid');


$uid = $_SESSION['jieqiUserId'];
$nowtime = time();
$todaydate = date('Y-m-d',$nowtime);
$today = date('d',$nowtime);
$s = ',';
$todays=$s.$today;
//功能设置
//连续签到奖励的积分，按照天来增加
$bili = 2;//就是天数乘以这个数字，得到最终积分数
$maxnums = 20;//奖励
$newUser = 100;//新签到用户获取积分数
$t7 = 10;
$t15 = 30;
$t30 = 50;

$todayunix = strtotime($todaydate);
$isQiandao = mysql_query("select * from `jieqi_system_qiandao` where `uid`='$uid' and `times`>'$todayunix' limit 1");
$result = mysql_fetch_object($isQiandao);

if($result->times){
	jieqi_printfail($jieqiLang['system']['need_qiandao_caption']);
}

//检测该用户是否签到过
$isUser = mysql_query("select `id` from `jieqi_system_qiandao` where `uid`='$uid' limit 1");
$result2 = mysql_fetch_object($isUser);

if(!$result2->id){
	mysql_query("insert into `jieqi_system_qiandao` set `uid`='$uid', `uname`='$username', `totalsign`='1', `dates`='$today',`times`='$nowtime'");
	mysql_query("UPDATE `jieqi_system_users` SET `score`=`score`+'$newUser' where uid='$uid'");
	jieqi_msgwin(LANG_DO_SUCCESS, sprintf($jieqiLang['system']['need_qiandao_score'], $newUser));
	//jieqi_jumppage('/qiandao', '您是新签到用户，奖励积分'.$newUser.'点', '<font color="blue">正在跳转，请稍候...</font>');exit;
}else{
	$isQiandaonew = mysql_query("select * from `jieqi_system_qiandao` where `uid`='$uid' limit 1");
	$resultnew = mysql_fetch_object($isQiandaonew);
	$lastqiandaomonth = date('Y-m',$resultnew->times);
	$thismonth = date('Y-m', $nowtime);
	$lastqiandaounix = strtotime($lastqiandaomonth);
	$thisunix = strtotime($thismonth);
	
	$lastqiandaodate = date('Y-m-d',$resultnew->times);
	$thisdate = date('Y-m-d', $nowtime);
	$lastqiandaodateunix = strtotime($lastqiandaodate);
	$thisdateunix = strtotime($thisdate);
	//奖励积分数

//	if($lastqiandaounix == $thisunix){//如果是当前月份
    if($lastqiandaounix == $thisunix){
	if($resultnew->totalsign == 7){
		$jifenNums=$maxnums;
		$juan=$t7;
			mysql_query("UPDATE `jieqi_system_qiandao` SET `times`='$nowtime', `totalsign`=`totalsign`+1 WHERE `uid`='$uid'");
			mysql_query("UPDATE jieqi_system_qiandao SET dates=concat(dates,$todays)  WHERE uid=$uid");
			mysql_query("UPDATE `jieqi_system_users` SET `score`=`score`+'$jifenNums',`juan`=`juan`+'$juan' where uid='$uid'");
			jieqi_msgwin(LANG_DO_SUCCESS, sprintf($jieqiLang['system']['need_maxscore_num'], $juan,$jifenNums));
			//jieqi_jumppage('/qiandao', '感谢您的签到，连续签到有奖励哦！', '<font color="blue">正在跳转，请稍候...</font>');
	}else if($resultnew->totalsign == 15){
		$jifenNums=$maxnums;
		$juan=$t15;
			mysql_query("UPDATE `jieqi_system_qiandao` SET `times`='$nowtime', `totalsign`=`totalsign`+1 WHERE `uid`='$uid'");
			mysql_query("UPDATE jieqi_system_qiandao SET dates=concat(dates,',$today')  WHERE uid=$uid");
			mysql_query("UPDATE `jieqi_system_users` SET `score`=`score`+'$jifenNums',`juan`=`juan`+'$juan' where uid='$uid'");
			jieqi_msgwin(LANG_DO_SUCCESS, sprintf($jieqiLang['system']['need_maxscore_num'], $juan,$jifenNums));
	}else if($resultnew->totalsign == 15){
		$jifenNums=$maxnums;
		$juan=$t30;
			mysql_query("UPDATE `jieqi_system_qiandao` SET `times`='$nowtime', `totalsign`=`totalsign`+1 WHERE `uid`='$uid'");
		    mysql_query("UPDATE jieqi_system_qiandao SET dates=concat(dates,',$today')  WHERE uid=$uid");
			mysql_query("UPDATE `jieqi_system_users` SET `score`=`score`+'$jifenNums',`juan`=`juan`+'$juan' where uid='$uid'");
			jieqi_msgwin(LANG_DO_SUCCESS, sprintf($jieqiLang['system']['need_maxscore_num'], $juan,$jifenNums));
	}else{
			mysql_query("UPDATE `jieqi_system_qiandao` SET `times`='$nowtime', `totalsign`=`totalsign`+1 WHERE `uid`='$uid'");
			mysql_query("UPDATE jieqi_system_qiandao SET dates=concat(dates,',$today')  WHERE uid=$uid");
			mysql_query("UPDATE `jieqi_system_users` SET `score`=`score`+'$maxnums' where uid='$uid'");
			jieqi_msgwin(LANG_DO_SUCCESS, sprintf($jieqiLang['system']['need_maxscore_nums'], $maxnums));
	}

	}else{
		//如果不是当前月份

			mysql_query("UPDATE `jieqi_system_qiandao` SET `totalsign`='1',`dates`='$today',`times`='$nowtime' WHERE `uid`='$uid'");
			mysql_query("UPDATE `jieqi_system_users` SET `score`=`score`+'$maxnums' where uid='$uid'");
			jieqi_msgwin(LANG_DO_SUCCESS, sprintf($jieqiLang['system']['need_maxscore_nums'], $maxnums));

	}
}
?>
<?php
//zend53   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

function jieqi_news_vars($news)
{
	global $jieqiModules;
	global $jieqiSort;
	global $jieqiConfigs;
	global $jieqiLang;
	global $jieqiOption;

	if (!isset($jieqiSort["news"])) {
		jieqi_getconfigs("news", "sort");
	}

	if (!isset($jieqiConfigs["news"])) {
		jieqi_getconfigs("news", "configs");
	}

	if (!isset($jieqiLang["news"])) {
		jieqi_loadlang("news", JIEQI_MODULE_NAME);
	}

	$ret = $news->getVars("s");
	$ret["summary"] = str_replace("<br />", " ", $ret["summary"]);
	$ret["sortname"] = $jieqiSort["news"][$ret["sortid"]]["sortname"];
    $id = $ret["topicid"];
	$rets = mysql_query("SELECT * FROM jieqi_news_content WHERE  topicid= $id");
	$plevel = mysql_fetch_object($rets);
	$ret["contents"] = $plevel->contents;
	
	if (is_array($jieqiOption["news"])) {
		foreach ($jieqiOption["news"] as $k => $v ) {
			if (isset($ret[$k])) {
				$ret[$k . "_s"] = $v["items"][$ret[$k]];
			}
		}
	}

	return $ret;
}


?>

<?php
//zend53   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

function jieqi_system_usersvars($users, $format = "s")
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiLang;
	global $jieqiOption;
	global $jieqiHonors;
	global $jieqiVips;
	include_once (JIEQI_ROOT_PATH . "/class/users.php");

	if (!isset($jieqiHonors)) {
		jieqi_getconfigs("system", "honors");
	}

	$ret = jieqi_query_rowvars($users, $format, "system");

	if (strlen($ret["name"]) == 0) {
		$ret["name"] = $ret["uname"];
	}

	$ret["setting"] = (is_object($users) ? jieqi_funtoarray("jieqi_htmlstr", jieqi_unserialize($users->getVar("setting", "n"))) : jieqi_funtoarray("jieqi_htmlstr", jieqi_unserialize($users["setting"])));
	$ret["verify_n"] = $ret["verify"];
	$ret["verify"] = JieqiUsersHandler::extractUserset($ret["verify"], "verify");
	$ret["showset_n"] = $ret["showset"];
	$ret["showset"] = JieqiUsersHandler::extractUserset($ret["showset"], "showset");
	$ret["acceptset_n"] = $ret["acceptset"];
	$ret["acceptset"] = JieqiUsersHandler::extractUserset($ret["acceptset"], "acceptset");
	$ret["group"] = $users->getGroup();
	$ret["viptype"] = $users->getViptype();
	$honorid = jieqi_gethonorid($users->getVar("score"), $jieqiHonors);
	$ret["honorid"] = $honorid;
	$ret["honor"] = $jieqiHonors[$honorid]["name"][intval($users->getVar("workid", "n"))];
	$vipid = jieqi_getvipid($users->getVar('expenses'), $jieqiVips);
	$ret["vipid"] = $vipid;
	$ret["vip"] = $jieqiVips[$vipid]['caption'];
	if ((0 < $ret["overtime"]) && (JIEQI_NOW_TIME < $ret["overtime"])) {
		$ret["monthly"] = 1;
	}
	else {
		$ret["monthly"] = 0;
	}

	$ret["url_avatar"] = jieqi_geturl("system", "avatar", $users->getVar("uid", "n"), "s", $users->getVar("avatar", "n"));
	if (!empty($jieqiModules["badge"]["publish"]) && is_file($jieqiModules["badge"]["path"] . "/include/badgefunction.php")) {
		include_once ($jieqiModules["badge"]["path"] . "/include/badgefunction.php");
		$ret["url_group"] = getbadgeurl(1, $users->getVar("groupid"), 0, true);
		$ret["url_honor"] = getbadgeurl(2, $honorid, 0, true);
		$jieqi_badgerows = array();
		$badgeary = jieqi_unserialize($users->getVar("badges", "n"));
		if (is_array($badgeary) && (0 < count($badgeary))) {
			$m = 0;

			foreach ($badgeary as $badge ) {
				$jieqi_badgerows[$m]["imageurl"] = getbadgeurl($badge["btypeid"], $badge["linkid"], $badge["imagetype"]);
				$jieqi_badgerows[$m]["caption"] = jieqi_htmlstr($badge["caption"]);
				$m++;
			}
		}

		$ret["badgerows"] = $jieqi_badgerows;
		$ret["use_badge"] = 1;
	}
	else {
		$ret["use_badge"] = 0;
	}

	return $ret;
}


?>

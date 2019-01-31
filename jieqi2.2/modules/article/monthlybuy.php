<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_checklogin();
include_once (JIEQI_ROOT_PATH . "/class/users.php");
$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
$users = $users_handler->get($_SESSION["jieqiUserId"]);

if (!is_object($users)) {
	jieqi_printfail($jieqiLang["obook"]["need_user_login"]);
}

jieqi_loadlang("monthly", JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);

if (!isset($_POST["act"])) {
	$_POST["act"] = "show";
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "monthly", "jieqiMonthly");
jieqi_loadlang("list", JIEQI_MODULE_NAME);

switch ($_POST["act"]) {
case "buy":
	jieqi_checkpost();
	$errtext = "";
	$_REQUEST["buytype"] = intval($_REQUEST["buytype"]);
	if (($_REQUEST["buytype"] <= 0) || (($jieqiMonthly["article"]["mode"] == 1) && !isset($jieqiMonthly["article"]["options"][$_REQUEST["buytype"]]))) {
		$errtext .= $jieqiLang["article"]["monthly_buytype_error"];
	}

	$needegold = ($jieqiMonthly["article"]["mode"] == 1 ? intval($jieqiMonthly["article"]["options"][$_REQUEST["buytype"]]) : intval($jieqiMonthly["article"]["megold"]) * $_REQUEST["buytype"]);

	if ($needegold <= 0) {
		$errtext .= $jieqiLang["article"]["monthly_needegold_error"];
	}

	$usermoney = $users->getEmoney();

	if ($usermoney["emoney"] < $needegold) {
		$errtext .= sprintf($jieqiLang["article"]["monthly_egold_low"], $jieqiModules["pay"]["url"] . "buyegold.php");
	}

	if (empty($errtext)) {
		$ret = $users_handler->payout($users, $needegold);

		if (!$ret) {
			jieqi_printfail($jieqiLang["article"]["user_payout_failure"]);
		}

		$overtime = $users->getVar("overtime");

		if ($overtime < JIEQI_NOW_TIME) {
			$overtime = JIEQI_NOW_TIME;
		}

		$overtime = mktime(date("H", $overtime), date("i", $overtime), date("s", $overtime), date("m", $overtime) + $_REQUEST["buytype"], date("d", $overtime), date("Y", $overtime));
		$users->setVar("overtime", $overtime);
		$users_handler->insert($users);
		include_once (JIEQI_ROOT_PATH . "/header.php");
		$jieqiTpl->assign("jieqi_contents", jieqi_msgbox(LANG_DO_SUCCESS, sprintf($jieqiLang["article"]["monthly_buy_success"], date("Y-m-d", $overtime))));
		include_once (JIEQI_ROOT_PATH . "/footer.php");
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case "show":
default:
	include_once (JIEQI_ROOT_PATH . "/header.php");
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$usermoney = $users->getEmoney();
	$jieqiTpl->assign("egold", $usermoney["egold"]);
	$jieqiTpl->assign("esilver", $usermoney["esilver"]);
	$jieqiTpl->assign("overtime", $users->getVar("overtime"));
	$jieqiTpl->assign("state", $users->getVar("state"));
	$jieqiTpl->assign_by_ref("jieqimonthly", $jieqiMonthly);
	$jieqiTpl->assign("buytype", intval($_REQUEST["buytype"]));
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/monthlybuy.html";
	include_once (JIEQI_ROOT_PATH . "/footer.php");
	break;
}

?>

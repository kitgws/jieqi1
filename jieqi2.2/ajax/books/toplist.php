<?php
header("Content-Type: text/html; charset=GBK");
define("JIEQI_MODULE_NAME", "article");

if (!defined("JIEQI_GLOBAL_INCLUDE")) {
	include_once ("../../global.php");
}

jieqi_loadlang("list", JIEQI_MODULE_NAME);
jieqi_getconfigs("article", "configs");
jieqi_getconfigs("article", "sort");
jieqi_getconfigs("article", "top");
$jieqiTset["jieqi_page_template"] = $jieqiModules["article"]["path"] . "/templates/bookajax.html";
include_once (JIEQI_ROOT_PATH . "/header.php");
$jieqiPset = jieqi_get_pageset();

if (!isset($_GET["order"]) && isset($_GET["sort"])) {
	$_GET["order"] = $_GET["sort"];
}

if (empty($_GET["order"]) || !isset($jieqiTop["article"][$_GET["order"]])) {
	$_GET["order"] = "";

	foreach ($jieqiTop["article"] as $k => $v ) {
		if ($_GET["order"] == "") {
			$_GET["order"] = $k;
		}

		if (0 < $v["default"]) {
			$_GET["order"] = $k;
			break;
		}
	}
}

$orderfield = "";

if (!empty($_GET["order"])) {
	$jieqiTpl->assign("ordername", $jieqiTop["article"][$_GET["order"]]["caption"]);
	$jieqiTpl->assign("order", $_GET["order"]);
	$orderfield = trim($jieqiTop["article"][$_GET["order"]]["sort"]);
}
else {
	$jieqiTpl->assign("ordername", "");
	$jieqiTpl->assign("order", "");
}

$jieqiTpl->assign("orderfield", $orderfield);
if (!isset($_GET["sortid"]) && isset($_GET["class"])) {
	$_GET["sortid"] = $_GET["class"];
	unset($_GET["class"]);
}

$int_sortid = 0;
$use_sortcode = false;
if (!empty($_GET["sortid"]) && is_numeric($_GET["sortid"]) && isset($jieqiSort["article"][$_GET["sortid"]])) {
	$_GET["sortid"] = intval($_GET["sortid"]);
	$int_sortid = $_GET["sortid"];
}

if (empty($int_sortid)) {
	if (isset($_GET["sortcode"])) {
		$_GET["sortcode"] = trim($_GET["sortcode"]);
	}
	else {
		if (isset($_GET["sortid"]) && !is_numeric($_GET["sortid"])) {
			$_GET["sortcode"] = trim($_GET["sortid"]);
		}
		else {
			$_GET["sortcode"] = "";
		}
	}

	if (0 < strlen($_GET["sortcode"])) {
		foreach ($jieqiSort["article"] as $k => $v ) {
			if (isset($v["code"]) && ($v["code"] == $_GET["sortcode"])) {
				$int_sortid = intval($k);
				$use_sortcode = true;
				break;
			}
		}
	}
}

if (empty($int_sortid)) {
	$_GET["sortid"] = "";
	$_GET["sortcode"] = "";
	$jieqiTpl->assign("sortid", 0);
	$jieqiTpl->assign("sort", "");
	$jieqiTpl->assign("sortcode", "");
}
else {
	$_GET["sortcode"] = (isset($jieqiSort["article"][$int_sortid]["code"]) ? $jieqiSort["article"][$int_sortid]["code"] : "");
	$jieqiTpl->assign("sortid", $int_sortid);
	$jieqiTpl->assign("sort", $jieqiSort["article"][$int_sortid]["caption"]);
	$jieqiTpl->assign("sortcode", $_GET["sortcode"]);
}

if (empty($_GET["fullflag"])) {
	$_GET["fullflag"] = "";
}
else {
	$_GET["fullflag"] = 1;
}

if (!empty($_GET["fullflag"])) {
	$jieqiTpl->assign("fullflag", 1);
}
else {
	$jieqiTpl->assign("fullflag", 0);
}

include_once ($jieqiModules["article"]["path"] . "/include/funarticle.php");
$jieqiTset["jieqi_contents_cacheid"] = $_GET["order"] . "_" . $int_sortid . "_" . $_GET["fullflag"];
$pagecacheid = $jieqiTset["jieqi_contents_cacheid"];
$jieqiTset["jieqi_contents_cacheid"] .= "_" . $_REQUEST["page"];

if (!isset($jieqiConfigs["article"]["topcachenum"])) {
	$jieqiConfigs["article"]["topcachenum"] = $jieqiConfigs["article"]["cachenum"];
}

$content_used_cache = false;
if (JIEQI_USE_CACHE && ($_REQUEST["page"] <= $jieqiConfigs["article"]["topcachenum"])) {
	$jieqiTpl->setCaching(1);
	$jieqiTpl->setCachType(1);

	if ($jieqiTpl->is_cached($jieqiTset["jieqi_contents_template"], $jieqiTset["jieqi_contents_cacheid"], NULL, NULL, NULL, false)) {
		if (in_array($jieqiTop["article"][$_GET["order"]]["sort"], array("lastupdate", "postdate"))) {
			$uptime = jieqi_article_getuptime();
			$cachedtime = $jieqiTpl->get_cachedtime($jieqiTset["jieqi_contents_template"], $jieqiTset["jieqi_contents_cacheid"]);
			if (($uptime < $cachedtime) || ((JIEQI_NOW_TIME - $cachedtime) < 15)) {
				$content_used_cache = true;
			}
			else {
				$jieqiTpl->setCaching(2);
			}
		}
		else {
			$content_used_cache = true;
		}
	}
}
else {
	$jieqiTpl->setCaching(0);
}

$articletitle = "";

if (!$content_used_cache) {
	$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
	$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$jieqiTpl->assign("sortrows", jieqi_funtoarray("jieqi_htmlstr", $jieqiSort["article"]));
	$jieqiTpl->assign_by_ref("toprows", $jieqiTop["article"]);
	include_once ($jieqiModules["article"]["path"] . "/class/article.php");
	$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
	$topsql = " WHERE display = 0 AND size > 0";
	if (!empty($_GET["fullflag"]) && is_numeric($_GET["fullflag"])) {
		$topsql .= " AND fullflag = " . $_GET["fullflag"];

		if ($articletitle != "") {
			$articletitle .= " - ";
		}

		$articletitle .= $jieqiLang["article"]["list_full_title"];
	}

	if (!empty($_GET["order"])) {
		if ($articletitle != "") {
			$articletitle .= " - ";
		}

		$articletitle .= $jieqiTop["article"][$_GET["order"]]["caption"];
	}

	if (!empty($int_sortid) && is_numeric($int_sortid)) {
		$topsql .= " AND sortid = " . $int_sortid;

		if ($articletitle != "") {
			$articletitle .= " - ";
		}

		$articletitle .= $jieqiSort["article"][$int_sortid]["caption"];
	}

	if ($articletitle == "") {
		$articletitle = $jieqiLang["article"]["list_article_title"];
	}

	$jieqiTpl->assign("articletitle", $articletitle);
	$tmpvar = explode("-", date("Y-m-d", JIEQI_NOW_TIME));
	$daystart = mktime(0, 0, 0, (int) $tmpvar[1], (int) $tmpvar[2], (int) $tmpvar[0]);
	$monthstart = mktime(0, 0, 0, (int) $tmpvar[1], 1, (int) $tmpvar[0]);
	$tmpvar = date("w", JIEQI_NOW_TIME);

	if ($tmpvar == 0) {
		$tmpvar = 7;
	}

	$weekstart = $daystart;

	if (1 < $tmpvar) {
		$weekstart -= ($tmpvar - 1) * 86400;
	}

	$repfrom = array("<{\$daystart}>", "<{\$weekstart}>", "<{\$monthstart}>");
	$repto = array($daystart, $weekstart, $monthstart);

	if ($jieqiTop["article"][$_GET["order"]]["where"] != "") {
		$topsql .= " AND " . str_replace($repfrom, $repto, $jieqiTop["article"][$_GET["order"]]["where"]);
	}

	$cotsql = "SELECT count(*) AS cot FROM " . jieqi_dbprefix("article_article") . $topsql;

	if ($jieqiTop["article"][$_GET["order"]]["order"] != "") {
		$topsql .= " ORDER BY " . $jieqiTop["article"][$_GET["order"]]["sort"] . " " . $jieqiTop["article"][$_GET["order"]]["order"];
	}

	$topsql .= " LIMIT " . intval($jieqiPset["start"]) . ", " . intval($jieqiPset["rows"]);
	$topsql = "SELECT * FROM " . jieqi_dbprefix("article_article") . $topsql;
	$article_handler->execute($topsql);
	$articlerows = array();
	$k = 0;

	while ($v = $article_handler->getObject()) {
		$articlerows[$k] = jieqi_article_vars($v);
		$articlerows[$k]["ordervalue"] = "";

		if (isset($articlerows[$k][$orderfield])) {
			$articlerows[$k]["ordervalue"] = $articlerows[$k][$orderfield];
		}
		else {
			$tmpary = preg_split("/[\+\-\*\/%]/i", $orderfield, -1, PREG_SPLIT_NO_EMPTY);
			$validfield = true;
			$fieldfrom = array();
			$fieldto = array();

			foreach ($tmpary as $t ) {
				$t = trim($t);
				if (!is_numeric($t) && !isset($articlerows[$k][$t])) {
					$validfield = false;
					break;
				}

				if (isset($articlerows[$k][$t])) {
					$fieldfrom[] = $t;
					$fieldto[] = intval($articlerows[$k][$t]);
				}
			}

			if (($validfield == true) && (0 < count($fieldfrom))) {
				eval ("\$articlerows[\$k]['ordervalue'] = round(" . str_replace($fieldfrom, $fieldto, $orderfield) . ");");
			}
		}

		$sizeary = array("size", "freesize", "vipsize", "monthsize", "premonthsize", "weeksize", "daysize");

		if (in_array($orderfield, $sizeary)) {
			$articlerows[$k]["ordervalue_n"] = $articlerows[$k]["ordervalue"];
			$articlerows[$k]["ordervalue"] = jieqi_sizeformat($articlerows[$k]["ordervalue"], "c");
			$articlerows[$k]["ordertype"] = "size";
		}
		else {
			if (($orderfield == "lastupdate") || ($orderfield == "postdate") || ($orderfield == "toptime")) {
				$articlerows[$k]["ordervalue_n"] = $articlerows[$k]["ordervalue"];
				$articlerows[$k]["ordervalue"] = date("Y-m-d", $articlerows[$k]["ordervalue"]);
				$articlerows[$k]["ordertype"] = "date";
			}
			else {
				$articlerows[$k]["ordertype"] = "int";
			}
		}

		$k++;
	}

	$jieqiTpl->assign_by_ref("articlerows", $articlerows);
	include_once (JIEQI_ROOT_PATH . "/lib/html/page.php");

	if (JIEQI_USE_CACHE) {
		jieqi_getcachevars("article", "toplistlog");

		if (!is_array($jieqiToplistlog)) {
			$jieqiToplistlog = array();
		}

		if (!isset($jieqiToplistlog[$pagecacheid]) || (JIEQI_CACHE_LIFETIME < (JIEQI_NOW_TIME - $jieqiToplistlog[$pagecacheid]["time"]))) {
			$article_handler->execute($cotsql);
			$row = $article_handler->getRow();
			$jieqiToplistlog[$pagecacheid] = array("rows" => intval($row["cot"]), "time" => JIEQI_NOW_TIME);
			jieqi_setcachevars("toplistlog", "jieqiToplistlog", $jieqiToplistlog, "article");
		}

		$toplistrows = $jieqiToplistlog[$pagecacheid]["rows"];
	}
	else {
		$article_handler->execute($cotsql);
		$row = $article_handler->getRow();
		$toplistrows = intval($row["cot"]);
	}

	$jieqiPset["count"] = $toplistrows;
	$jumppage = new JieqiPage($jieqiPset);

	if (!$use_sortcode) {
		$jumppage->setlink(jieqi_geturl("article", "toplist", 0, $_GET["order"], $_GET["sortid"], $_GET["fullflag"]));
	}
	else {
		$jumppage->setlink(jieqi_geturl("article", "toplist", 0, $_GET["order"], $_GET["sortcode"], $_GET["fullflag"]));
	}

	$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
}

include_once (JIEQI_ROOT_PATH . "/footer.php");
$jieqiTpl->assign("_request", jieqi_funtoarray("jieqi_htmlstr", $_REQUEST));
include_once (JIEQI_ROOT_PATH . "/footer.php");
require_once("/configs/define.php");
@mysql_connect(constant("JIEQI_DB_HOST"), constant("JIEQI_DB_USER"),constant("JIEQI_DB_PASS"));  
@mysql_query("SET NAMES 'gbk'");
@mysql_select_db(constant("JIEQI_DB_NAME"));
$gxkg="UPDATE jieqi_article_article SET  intro = REPLACE(REPLACE(intro, CHAR(10), ''), CHAR(13), '')";
$query->execute($gxkg);
?>

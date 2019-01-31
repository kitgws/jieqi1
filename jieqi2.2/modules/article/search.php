<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_loadlang("search", JIEQI_MODULE_NAME);

if (isset($_REQUEST["searchkey"])) {
	$_REQUEST["searchkey"] = trim($_REQUEST["searchkey"]);
}

if (!isset($_REQUEST["searchkey"]) || (strlen($_REQUEST["searchkey"]) == 0)) {
	include_once (JIEQI_ROOT_PATH . "/header.php");
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/search.html";
	include_once (JIEQI_ROOT_PATH . "/footer.php");
	exit();
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
if (!empty($jieqiConfigs["article"]["minsearchlen"]) && (strlen($_REQUEST["searchkey"]) < intval($jieqiConfigs["article"]["minsearchlen"]))) {
	jieqi_printfail(sprintf($jieqiLang["article"]["search_minsize_limit"], $jieqiConfigs["article"]["minsearchlen"]));
}

if (!empty($jieqiConfigs["article"]["minsearchtime"]) && empty($_REQUEST["page"])) {
	$jieqi_visit_time = jieqi_strtosary($_COOKIE["jieqiVisitTime"]);

	if (!empty($_SESSION["jieqiArticlesearchTime"])) {
		$logtime = $_SESSION["jieqiArticlesearchTime"];
	}
	else if (!empty($jieqi_visit_time["jieqiArticlesearchTime"])) {
		$logtime = $jieqi_visit_time["jieqiArticlesearchTime"];
	}
	else {
		$logtime = 0;
	}

	if ((0 < $logtime) && ((JIEQI_NOW_TIME - $logtime) < intval($jieqiConfigs["article"]["minsearchtime"]))) {
		jieqi_printfail(sprintf($jieqiLang["article"]["search_time_limit"], $jieqiConfigs["article"]["minsearchtime"]));
	}

	$_SESSION["jieqiArticlesearchTime"] = JIEQI_NOW_TIME;
	$jieqi_visit_time["jieqiArticlesearchTime"] = JIEQI_NOW_TIME;
	setcookie("jieqiVisitTime", jieqi_sarytostr($jieqi_visit_time), JIEQI_NOW_TIME + 3600, "/", JIEQI_COOKIE_DOMAIN, 0);
}

$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
$stypeary = array("all" => 0, "articlename" => 1, "author" => 2, "keywords" => 4);
if (!isset($_REQUEST["searchtype"]) || !isset($stypeary[$_REQUEST["searchtype"]])) {
	$_REQUEST["searchtype"] = "articlename";
}

$intstype = intval($stypeary[$_REQUEST["searchtype"]]);
$_REQUEST["searchkey"] = str_replace("&", " ", $_REQUEST["searchkey"]);
$searchstring = $_REQUEST["searchkey"] . "&&" . $_REQUEST["searchtype"];
$hashid = md5($searchstring);
$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/searchresult.html";
include_once (JIEQI_ROOT_PATH . "/header.php");
$jieqiPset = jieqi_get_pageset();
include_once ($jieqiModules["article"]["path"] . "/class/searchcache.php");
$searchcache_handler = &JieqiSearchcacheHandler::getInstance("JieqiSearchcacheHandler");
$criteria = new CriteriaCompo(new Criteria("hashid", $hashid, "="));
$criteria->setLimit(1);
$criteria->setStart(0);
$searchcache_handler->queryObjects($criteria);
$searchcache = $searchcache_handler->getObject();
$usecache = false;

if (is_object($searchcache)) {
	if ($searchcache->getVar("results", "n") == 1) {
		$cachetime = 86400;
	}
	else if ($searchcache->getVar("results", "n") == 0) {
		$cachetime = 1800;
	}
	else {
		$cachetime = 7200;
	}

	if ((JIEQI_NOW_TIME - $searchcache->getVar("searchtime")) < $cachetime) {
		$usecache = true;
	}
}

include_once ($jieqiModules["article"]["path"] . "/class/article.php");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");

if ($usecache) {
	$allresults = $searchcache->getVar("results", "n");
	$aids = $searchcache->getVar("aids", "n");

	if (empty($aids)) {
		$aids = 0;
	}
	else if ($allresults == 1) {
		$aids = intval($aids);
	}
	else {
		$aids = trim($aids);
	}

	if ($jieqiPset["rows"] < $allresults) {
		$aidary = explode(",", $aids);
		$search_resultnum = count($aidary);
		$maxpage = ceil($search_resultnum / $jieqiPset["rows"]);

		if ($maxpage < $_REQUEST["page"]) {
			$_REQUEST["page"] = $maxpage;
			$jieqiPset["page"] = $_REQUEST["page"];
			$jieqiPset["start"] = ($jieqiPset["page"] - 1) * $jieqiPset["rows"];
		}

		$startid = $jieqiPset["start"];
		$aids = "";
		$i = $startid;
		$j = 0;
		while (($i < $search_resultnum) && ($j < $jieqiPset["rows"])) {
			if (!empty($aids)) {
				$aids .= ",";
			}

			$aids .= intval($aidary[$i]);
			$i++;
			$j++;
		}

		$rescount = $j;
	}
	else {
		$startid = 0;
		$_REQUEST["page"] = 1;
		$rescount = $allresults;
	}

	$sql = "SELECT * FROM " . jieqi_dbprefix("article_article") . " WHERE articleid IN (" . jieqi_dbslashes($aids) . ") ORDER BY lastupdate DESC LIMIT 0, " . $jieqiPset["rows"];
	$res = $article_handler->execute($sql);
	$truecount = $article_handler->db->getRowsNum($res);

	if ($truecount != $rescount) {
		$usecache = false;
	}
}

if (!$usecache) {
	$jieqiConfigs["article"]["maxsearchres"] = intval($jieqiConfigs["article"]["maxsearchres"]);

	if (empty($jieqiConfigs["article"]["maxsearchres"])) {
		$jieqiConfigs["article"]["maxsearchres"] = 200;
	}

	$sql = "SELECT * FROM " . jieqi_dbprefix("article_article") . " WHERE display = 0 AND size > 0";

	if (!empty($_REQUEST["searchkey"])) {
		if ($jieqiConfigs["article"]["searchtype"] == 1) {
			$tmpvar = "LIKE '" . jieqi_dbslashes($_REQUEST["searchkey"]) . "%'";
		}
		else if ($jieqiConfigs["article"]["searchtype"] == 2) {
			$tmpvar = "= '" . jieqi_dbslashes($_REQUEST["searchkey"]) . "%'";
		}
		else {
			$tmpvar = "LIKE '%" . jieqi_dbslashes($_REQUEST["searchkey"]) . "%'";
		}

		if ($_REQUEST["searchtype"] == "all") {
			$sql .= " AND (articlename $tmpvar OR author $tmpvar OR keywords $tmpvar)";
		}
		else {
			$sql .= " AND {$_REQUEST["searchtype"]} $tmpvar";
		}
	}

	$sql .= " ORDER BY lastupdate DESC LIMIT 0, {$jieqiConfigs["article"]["maxsearchres"]}";
	$res = $article_handler->execute($sql);
	$allresults = $article_handler->db->getRowsNum($res);

	if ($allresults <= $jieqiPset["rows"]) {
		$rescount = $allresults;
	}
	else {
		$rescount = $jieqiPset["rows"];
	}

	$_REQUEST["page"] = 1;
}

if ($rescount == 1) {
	$article = $article_handler->getObject();

	if (!is_object($article)) {
		jieqi_printfail($jieqiLang["article"]["no_search_result"]);
	}

	$url_articleinfo = jieqi_geturl("article", "article", $article->getVar("articleid"), "info", $article->getVar("articlecode", "n"));
	header("Location: " . jieqi_headstr($url_articleinfo));

	if (!$usecache) {
		$aids = $article->getVar("articleid");
		$cleancache = false;

		if (is_object($searchcache)) {
			$searchcache->setVar("searchtime", JIEQI_NOW_TIME);
			$searchcache->setVar("results", $allresults);
			$searchcache->setVar("aids", $aids);

			if (date("s", JIEQI_NOW_TIME) == "00") {
				$cleancache = true;
			}
		}
		else {
			$searchcache = $searchcache_handler->create();
			$searchcache->setVar("searchtime", JIEQI_NOW_TIME);
			$searchcache->setVar("hashid", $hashid);
			$searchcache->setVar("keywords", $_REQUEST["searchkey"]);
			$searchcache->setVar("searchtype", $intstype);
			$searchcache->setVar("results", $allresults);
			$searchcache->setVar("aids", $aids);
		}

		$searchcache_handler->insert($searchcache);

		if ($cleancache) {
			$criteria = new CriteriaCompo(new Criteria("searchtime", JIEQI_NOW_TIME - $cachetime, "<"));
			$searchcache_handler->delete($criteria);
		}
	}

	jieqi_freeresource();
	exit();
}
else {
	include_once ($jieqiModules["article"]["path"] . "/include/funarticle.php");
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$jieqiTpl->assign("resultcount", $rescount);
	$jieqiTpl->assign("articletitle", $jieqiLang["article"]["search_result"]);
	$articlerows = array();
	$k = 0;
	$aids = "";

	while ($v = $article_handler->getObject()) {
		if (!$usecache) {
			if (!empty($aids)) {
				$aids .= ",";
			}

			$aids .= $v->getVar("articleid");
		}

		$articlerows[$k] = jieqi_article_vars($v);
		$searchkey_html = jieqi_htmlstr($_REQUEST["searchkey"]);
		$articlerows[$k]["articlename_hl"] = (($_REQUEST["searchtype"] == "articlename") || ($_REQUEST["searchtype"] == "all") ? str_replace($searchkey_html, "<span class=\"hottext\">" . $searchkey_html . "</span>", $articlerows[$k]["articlename"]) : $articlerows[$k]["articlename"]);
		$articlerows[$k]["author_hl"] = (($_REQUEST["searchtype"] == "author") || ($_REQUEST["searchtype"] == "all") ? str_replace($searchkey_html, "<span class=\"hottext\">" . $searchkey_html . "</span>", $articlerows[$k]["author"]) : $articlerows[$k]["author"]);
		$articlerows[$k]["keywords_hl"] = (($_REQUEST["searchtype"] == "keywords") || ($_REQUEST["searchtype"] == "all") ? str_replace($searchkey_html, "<span class=\"hottext\">" . $searchkey_html . "</span>", $articlerows[$k]["keywords"]) : $articlerows[$k]["keywords"]);
		$k++;

		if ($jieqiPset["rows"] <= $k) {
			break;
		}
	}

	$jieqiTpl->assign_by_ref("articlerows", $articlerows);

	if (!$usecache) {
		while ($v = $article_handler->getObject()) {
			if (!empty($aids)) {
				$aids .= ",";
			}

			$aids .= $v->getVar("articleid");
		}

		if (is_object($searchcache)) {
			$searchcache->setVar("searchtime", JIEQI_NOW_TIME);
			$searchcache->setVar("results", $allresults);
			$searchcache->setVar("aids", $aids);
		}
		else {
			$searchcache = $searchcache_handler->create();
			$searchcache->setVar("searchtime", JIEQI_NOW_TIME);
			$searchcache->setVar("hashid", $hashid);
			$searchcache->setVar("keywords", $_REQUEST["searchkey"]);
			$searchcache->setVar("searchtype", $intstype);
			$searchcache->setVar("results", $allresults);
			$searchcache->setVar("aids", $aids);
		}

		$searchcache_handler->insert($searchcache);
	}

	$jieqiTpl->assign("searchkey", jieqi_htmlstr($_REQUEST["searchkey"]));
	$jieqiTpl->assign("searchtype", jieqi_htmlstr($_REQUEST["searchtype"]));
	$jieqiTpl->assign("allresults", jieqi_htmlstr($allresults));
	include_once (JIEQI_ROOT_PATH . "/lib/html/page.php");
	if (!empty($jieqiConfigs["article"]["maxsearchres"]) && (intval($jieqiConfigs["article"]["maxsearchres"]) < $allresults)) {
		$allresults = intval($jieqiConfigs["article"]["maxsearchres"]);
	}

	if ($_REQUEST["page"] != $jieqiPset["page"]) {
		$jieqiPset["page"] = $_REQUEST["page"];
		$jieqiPset["start"] = ($jieqiPset["page"] - 1) * $jieqiPset["rows"];
	}

	$jieqiPset["count"] = $allresults;
	$jumppage = new JieqiPage($jieqiPset);
	$jumppage->setlink("", true, true);
	$jieqiTpl->assign("url_jumppage", $jumppage->whole_bar());
	$jieqiTpl->setCaching(0);
	$ajax_key=$_REQUEST["searchkey"];
	$jieqiTpl->assign( "ajax_key", $ajax_key );
	include_once (JIEQI_ROOT_PATH . "/footer.php");
}

?>

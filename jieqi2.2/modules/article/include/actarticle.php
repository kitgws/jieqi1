<?php
//zend53   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

function jieqi_article_delete($aid, $batch = false)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqi_file_postfix;
	global $jieqiAction;
	global $article_handler;
	global $chapter_handler;

	if (!isset($jieqiAction["article"])) {
		jieqi_getconfigs("article", "action", "jieqiAction");
	}

	$article = $article_handler->get($aid);

	if (!is_object($article)) {
		return false;
	}

	$article_handler->delete($aid);
	$package = new JieqiPackage($aid);
	$package->delete();

	if (!$batch) {
		$posterary = array();

		if (!empty($jieqiAction["article"]["chapteradd"]["earnscore"])) {
			$criteria0 = new CriteriaCompo(new Criteria("articleid", $aid, "="));
			$chapter_handler->queryObjects($criteria0);

			while ($chapterobj = $chapter_handler->getObject()) {
				$posterid = intval($chapterobj->getVar("posterid"));

				if (isset($posterary[$posterid])) {
					$posterary[$posterid] += $jieqiAction["article"]["chapteradd"]["earnscore"];
				}
				else {
					$posterary[$posterid] = $jieqiAction["article"]["chapteradd"]["earnscore"];
				}
			}

			unset($criteria0);
		}
	}

	$criteria = new CriteriaCompo(new Criteria("articleid", $aid, "="));
	$chapter_handler->delete($criteria);
	include_once ($jieqiModules["article"]["path"] . "/class/articleattachs.php");
	$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
	$attachs_handler->delete($criteria);
	$criteria1 = new CriteriaCompo(new Criteria("ownerid", $aid, "="));
	include_once ($jieqiModules["article"]["path"] . "/class/reviews.php");
	$reviews_handler = &JieqiReviewsHandler::getInstance("JieqiReviewsHandler");
	$reviews_handler->delete($criteria1);
	include_once ($jieqiModules["article"]["path"] . "/class/replies.php");
	$replies_handler = &JieqiRepliesHandler::getInstance("JieqiRepliesHandler");
	$replies_handler->delete($criteria1);
	include_once ($jieqiModules["article"]["path"] . "/class/bookcase.php");
	$bookcase_handler = &JieqiBookcaseHandler::getInstance("JieqiBookcaseHandler");
	$bookcase_handler->delete($criteria);
	$imagedir = jieqi_uploadpath($jieqiConfigs["article"]["imagedir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;

	if (is_dir($imagedir)) {
		jieqi_delfolder($imagedir, true);
	}

	if (!$batch) {
		include_once ($jieqiModules["article"]["path"] . "/class/articlelog.php");
		$articlelog_handler = &JieqiArticlelogHandler::getInstance("JieqiArticlelogHandler");
		$newlog = $articlelog_handler->create();
		$newlog->setVar("siteid", $article->getVar("siteid", "n"));
		$newlog->setVar("logtime", JIEQI_NOW_TIME);
		$newlog->setVar("userid", $_SESSION["jieqiUserId"]);
		$newlog->setVar("username", $_SESSION["jieqiUserName"]);
		$newlog->setVar("articleid", $article->getVar("articleid", "n"));
		$newlog->setVar("articlename", $article->getVar("articlename", "n"));
		$newlog->setVar("chapterid", 0);
		$newlog->setVar("chaptername", "");
		$newlog->setVar("reason", "");
		$newlog->setVar("chginfo", $jieqiLang["article"]["delete_article"]);
		$newlog->setVar("chglog", "");
		$newlog->setVar("ischapter", "0");
		$newlog->setVar("isdel", "1");
		$newlog->setVar("databak", serialize($article->getVars()));
		$articlelog_handler->insert($newlog);
	}

	if (!$batch) {
		include_once (JIEQI_ROOT_PATH . "/class/users.php");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");

		if (!empty($jieqiAction["article"]["articleadd"]["earnscore"])) {
			$posterid = intval($article->getVar("posterid"));

			if (isset($posterary[$posterid])) {
				$posterary[$posterid] += $jieqiAction["article"]["articleadd"]["earnscore"];
			}
			else {
				$posterary[$posterid] = $jieqiAction["article"]["articleadd"]["earnscore"];
			}
		}

		foreach ($posterary as $pid => $pscore ) {
			$users_handler->changeScore($pid, $pscore, false);
		}
	}

	if (2 <= floatval(JIEQI_VERSION)) {
		include_once (JIEQI_ROOT_PATH . "/include/funtag.php");
		$tags = jieqi_tag_clean($article->getVar("keywords", "n"));
		jieqi_tag_delete($tags, $article->getVar("articleid", "n"), array("tag" => jieqi_dbprefix("article_tag"), "taglink" => jieqi_dbprefix("article_taglink")));
	}

	if (!$batch) {
		jieqi_article_updateinfo($article, "articledel");
	}

	return $article;
}

function jieqi_article_clean($aid, $batch = false)
{
	global $jieqiModules;
	global $article_handler;
	global $chapter_handler;
	global $jieqiConfigs;
	global $jieqiAction;

	if (!isset($jieqiAction["article"])) {
		jieqi_getconfigs("article", "action", "jieqiAction");
	}

	$article = $article_handler->get($aid);

	if (!is_object($article)) {
		return false;
	}

	$criteria = new CriteriaCompo(new Criteria("articleid", $aid));
	$fields = array("lastchapter" => "", "lastchapterid" => 0, "lastvolume" => "", "lastvolumeid" => 0, "chapters" => 0, "size" => 0, "freesize" => 0);
	$article_handler->updatefields($fields, $criteria);
	$package = new JieqiPackage($aid);
	$package->delete();
	$package->initPackage($article->getVars("n"), true);

	if (!$batch) {
		$posterary = array();

		if (!empty($jieqiAction["article"]["chapteradd"]["earnscore"])) {
			$criteria0 = new CriteriaCompo(new Criteria("articleid", $aid, "="));
			$chapter_handler->queryObjects($criteria0);

			while ($chapterobj = $chapter_handler->getObject()) {
				$posterid = intval($chapterobj->getVar("posterid"));

				if (isset($posterary[$posterid])) {
					$posterary[$posterid] += $jieqiAction["article"]["chapteradd"]["earnscore"];
				}
				else {
					$posterary[$posterid] = $jieqiAction["article"]["chapteradd"]["earnscore"];
				}
			}

			unset($criteria0);
		}
	}

	$criteria = new CriteriaCompo(new Criteria("articleid", $aid, "="));
	$chapter_handler->delete($criteria);
	include_once ($jieqiModules["article"]["path"] . "/class/articleattachs.php");
	$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
	$attachs_handler->delete($criteria);

	if (!$batch) {
		include_once (JIEQI_ROOT_PATH . "/class/users.php");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");

		if (!empty($jieqiAction["article"]["articleadd"]["earnscore"])) {
			$posterid = intval($article->getVar("posterid"));

			if (isset($posterary[$posterid])) {
				$posterary[$posterid] += $jieqiAction["article"]["articleadd"]["earnscore"];
			}
			else {
				$posterary[$posterid] = $jieqiAction["article"]["articleadd"]["earnscore"];
			}
		}

		foreach ($posterary as $pid => $pscore ) {
			$users_handler->changeScore($pid, $pscore, false);
		}
	}

	if (!$batch) {
		jieqi_article_updateinfo(0);
	}

	return $article;
}

function jieqi_article_delchapter($aid, $criteria, $batch = false)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiAction;
	global $article_handler;
	global $chapter_handler;
	global $jieqi_file_postfix;

	if (!isset($jieqiAction["article"])) {
		jieqi_getconfigs("article", "action", "jieqiAction");
	}

	if (!is_object($criteria)) {
		return false;
	}

	$criteria->add(new Criteria("articleid", intval($aid)));
	$article = $article_handler->get($aid);

	if (!is_object($article)) {
		return false;
	}

	$posterary = array();
	$chapter_handler->queryObjects($criteria);
	$chapterary = array();
	$k = 0;
	$cids = "";
	$lastchapterid = intval($article->getVar("lastchapterid"));
	$lastvolumeid = intval($article->getVar("lastvolumeid"));
	$vipchapterid = intval($article->getVar("vipchapterid"));
	$vipvolumeid = intval($article->getVar("vipvolumeid"));
	$uplastchapter = false;
	$uplastvolume = false;
	$upvipchapter = false;
	$upvipvolume = false;
	$subdaysize = 0;
	$subweeksize = 0;
	$submonthsize = 0;
	$subsize = 0;
	$subfreesize = 0;
	$subvipsize = 0;
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

	while ($chapterobj = $chapter_handler->getObject()) {
		$chapterary[$k]["id"] = intval($chapterobj->getVar("chapterid"));

		if ($chapterary[$k]["id"] == $lastchapterid) {
			$uplastchapter = true;
		}

		if ($chapterary[$k]["id"] == $lastvolumeid) {
			$uplastvolume = true;
		}

		if ($chapterary[$k]["id"] == $vipchapterid) {
			$upvipchapter = true;
		}

		if ($chapterary[$k]["id"] == $vipvolumeid) {
			$upvipvolume = true;
		}

		if ($cids != "") {
			$cids .= ",";
		}

		$cids .= $chapterary[$k]["id"];
		$chapterary[$k]["size"] = intval($chapterobj->getVar("size", "n"));
		$clastupdate = intval($chapterobj->getVar("lastupdate", "n"));

		if ($daystart <= $clastupdate) {
			$subdaysize += $chapterary[$k]["size"];
		}

		if ($weekstart <= $clastupdate) {
			$subweeksize += $chapterary[$k]["size"];
		}

		if ($monthstart <= $clastupdate) {
			$submonthsize += $chapterary[$k]["size"];
		}

		$subsize += $chapterary[$k]["size"];

		if (0 < intval($chapterobj->getVar("isvip", "n"))) {
			$subvipsize += $chapterary[$k]["size"];
		}
		else {
			$subfreesize += $chapterary[$k]["size"];
		}

		$chapterary[$k]["attach"] = ($chapterobj->getVar("attachment", "n") == "" ? 0 : 1);
		$chapterary[$k]["chapterorder"] = intval($chapterobj->getVar("chapterorder"));
		$chapterary[$k]["saleprice"] = intval($chapterobj->getVar("saleprice"));
		$chapterary[$k]["isimage"] = intval($chapterobj->getVar("isimage"));
		$chapterary[$k]["isvip"] = intval($chapterobj->getVar("isvip"));
		$chapterary[$k]["chaptertype"] = intval($chapterobj->getVar("chaptertype"));
		$chapterary[$k]["power"] = intval($chapterobj->getVar("power"));
		$k++;

		if (!empty($jieqiAction["article"]["chapteradd"]["earnscore"])) {
			$posterid = intval($chapterobj->getVar("posterid"));

			if (isset($posterary[$posterid])) {
				$posterary[$posterid] += $jieqiAction["article"]["chapteradd"]["earnscore"];
			}
			else {
				$posterary[$posterid] = $jieqiAction["article"]["chapteradd"]["earnscore"];
			}
		}
	}

	$chapter_handler->delete($criteria);

	if ($cids != "") {
		$criteria1 = new CriteriaCompo();
		$criteria1->add(new Criteria("chapterid", "(" . $cids . ")", "IN"));
		include_once ($jieqiModules["article"]["path"] . "/class/articleattachs.php");
		$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
		$attachs_handler->delete($criteria1);
	}

	$htmldir = jieqi_uploadpath($jieqiConfigs["article"]["htmldir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;
	$txtjsdir = jieqi_uploadpath($jieqiConfigs["article"]["txtjsdir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;
	$attachdir = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;

	foreach ($chapterary as $c ) {
		jieqi_delete_achapterc($aid, $c["id"], intval($c["isvip"]), intval($c["chaptertype"]));

		if (is_file($htmldir . "/" . $c["id"] . $jieqiConfigs["article"]["htmlfile"])) {
			jieqi_delfile($htmldir . "/" . $c["id"] . $jieqiConfigs["article"]["htmlfile"]);
		}

		if (is_file($txtjsdir . "/" . $c["id"] . $jieqi_file_postfix["js"])) {
			jieqi_delfile($txtjsdir . "/" . $c["id"] . $jieqi_file_postfix["js"]);
		}

		if (is_dir($attachdir . "/" . $c["id"])) {
			jieqi_delfolder($attachdir . "/" . $c["id"]);
		}
	}

	include_once ($jieqiModules["article"]["path"] . "/include/repack.php");
	$ptypes = array("makeopf" => 1, "makehtml" => $jieqiConfigs["article"]["makehtml"], "maketxtjs" => $jieqiConfigs["article"]["maketxtjs"], "makezip" => $jieqiConfigs["article"]["makezip"], "makefull" => $jieqiConfigs["article"]["makefull"], "maketxtfull" => $jieqiConfigs["article"]["maketxtfull"], "makeumd" => $jieqiConfigs["article"]["makeumd"], "makejar" => $jieqiConfigs["article"]["makejar"]);
	article_repack($aid, $ptypes, 0);

	if (!$batch) {
		include_once (JIEQI_ROOT_PATH . "/class/users.php");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");

		if (!empty($jieqiAction["article"]["articleadd"]["earnscore"])) {
			$posterid = intval($article->getVar("posterid"));

			if (isset($posterary[$posterid])) {
				$posterary[$posterid] += $jieqiAction["article"]["articleadd"]["earnscore"];
			}
			else {
				$posterary[$posterid] = $jieqiAction["article"]["articleadd"]["earnscore"];
			}
		}

		foreach ($posterary as $pid => $pscore ) {
			$users_handler->changeScore($pid, $pscore, false);
		}
	}

	$newdaysize = ($subdaysize < intval($article->getVar("daysize", "n")) ? intval($article->getVar("daysize", "n")) - $subdaysize : 0);
	$newweeksize = ($subweeksize < intval($article->getVar("weeksize", "n")) ? intval($article->getVar("weeksize", "n")) - $subweeksize : 0);
	$newmonthsize = ($submonthsize < intval($article->getVar("monthsize", "n")) ? intval($article->getVar("monthsize", "n")) - $submonthsize : 0);
	$newsize = ($subsize < intval($article->getVar("size", "n")) ? intval($article->getVar("size", "n")) - $subsize : 0);
	$freesize = ($subfreesize < intval($article->getVar("freesize", "n")) ? intval($article->getVar("freesize", "n")) - $subfreesize : 0);
	$vipsize = ($subvipsize < intval($article->getVar("vipsize", "n")) ? intval($article->getVar("vipsize", "n")) - $subvipsize : 0);
	$article->setVar("daysize", $newdaysize);
	$article->setVar("weeksize", $newweeksize);
	$article->setVar("monthsize", $newmonthsize);
	$article->setVar("size", $newsize);
	$article->setVar("freesize", $freesize);
	$article->setVar("vipsize", $vipsize);
	if ($uplastchapter || $uplastvolume) {
		if ($uplastchapter) {
			$lastinfo = jieqi_article_searchlast($article, "lastchapter");
			$article->setVar("lastchapter", $lastinfo["name"]);
			$article->setVar("lastchapterid", $lastinfo["id"]);
			$article->setVar("lastsummary", $lastinfo["summary"]);
		}

		$lastinfo = jieqi_article_searchlast($article, "lastvolume");
		$article->setVar("lastvolume", $lastinfo["name"]);
		$article->setVar("lastvolumeid", $lastinfo["id"]);
	}

	if ($upvipchapter || $upvipvolume) {
		if ($upvipchapter) {
			$lastinfo = jieqi_article_searchlast($article, "vipchapter");
			$article->setVar("vipchapter", $lastinfo["name"]);
			$article->setVar("vipchapterid", $lastinfo["id"]);
			$article->setVar("vipsummary", $lastinfo["summary"]);
		}

		$lastinfo = jieqi_article_searchlast($article, "vipvolume");
		$article->setVar("vipvolume", $lastinfo["name"]);
		$article->setVar("vipvolumeid", $lastinfo["id"]);
	}

	$article_handler->insert($article);

	if (!$batch) {
		jieqi_article_updateinfo(0);
	}

	return $article;
}

function jieqi_article_delonechapter($chapter, $article = NULL, $batch = false)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiAction;
	global $article_handler;
	global $chapter_handler;
	global $jieqi_file_postfix;

	if (!isset($jieqiAction["article"])) {
		jieqi_getconfigs("article", "action", "jieqiAction");
	}

	if (!is_object($chapter)) {
		$chapter = $chapter_handler->get(intval($chapter));

		if (!$chapter) {
			return false;
		}

		$article = $article_handler->get($chapter->getVar("articleid"));

		if (!$article) {
			return false;
		}
	}

	$chapterid = intval($chapter->getVar("chapterid", "n"));
	$isvip = intval($chapter->getVar("isvip", "n"));
	$chapter_handler->delete($chapterid);

	if ($chapter->getVar("chapterorder") < $article->getVar("chapters")) {
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->add(new Criteria("chapterorder", $chapter->getVar("chapterorder"), ">"));
		$chapter_handler->updatefields("chapterorder = chapterorder - 1", $criteria);
	}

	unset($criteria);
	$updateblock = false;
	if (($chapterid == $article->getVar("lastchapterid")) || ($chapterid == $article->getVar("lastvolumeid"))) {
		if ($chapterid == $article->getVar("lastchapterid")) {
			$lastinfo = jieqi_article_searchlast($article, "lastchapter");
			$article->setVar("lastchapter", $lastinfo["name"]);
			$article->setVar("lastchapterid", $lastinfo["id"]);
			$article->setVar("lastsummary", $lastinfo["summary"]);
		}

		$lastinfo = jieqi_article_searchlast($article, "lastvolume");
		$article->setVar("lastvolume", $lastinfo["name"]);
		$article->setVar("lastvolumeid", $lastinfo["id"]);
		$updateblock = true;
	}
	else {
		if (($chapterid == $article->getVar("vipchapterid")) || ($chapterid == $article->getVar("vipvolumeid"))) {
			if ($chapterid == $article->getVar("vipchapterid")) {
				$lastinfo = jieqi_article_searchlast($article, "vipchapter");
				$article->setVar("vipchapter", $lastinfo["name"]);
				$article->setVar("vipchapterid", $lastinfo["id"]);
				$article->setVar("vipsummary", $lastinfo["summary"]);
			}

			$lastinfo = jieqi_article_searchlast($article, "vipvolume");
			$article->setVar("vipvolume", $lastinfo["name"]);
			$article->setVar("vipvolumeid", $lastinfo["id"]);
			$updateblock = true;
		}
	}

	$article->setVar("chapters", $article->getVar("chapters") - 1);

	if (0 < $isvip) {
		$article->setVar("vipchapters", $article->getVar("vipchapters") - 1);
	}

	$subdaysize = 0;
	$subweeksize = 0;
	$submonthsize = 0;
	$subsize = 0;
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

	$clastupdate = intval($chapter->getVar("lastupdate", "n"));

	if ($daystart <= $clastupdate) {
		$subdaysize += intval($chapter->getVar("size", "n"));
	}

	if ($weekstart <= $clastupdate) {
		$subweeksize += intval($chapter->getVar("size", "n"));
	}

	if ($monthstart <= $clastupdate) {
		$submonthsize += intval($chapter->getVar("size", "n"));
	}

	$subsize += intval($chapter->getVar("size", "n"));
	$newdaysize = ($subdaysize < intval($article->getVar("daysize", "n")) ? intval($article->getVar("daysize", "n")) - $subdaysize : 0);
	$newweeksize = ($subweeksize < intval($article->getVar("weeksize", "n")) ? intval($article->getVar("weeksize", "n")) - $subweeksize : 0);
	$newmonthsize = ($submonthsize < intval($article->getVar("monthsize", "n")) ? intval($article->getVar("monthsize", "n")) - $submonthsize : 0);
	$newsize = ($subsize < intval($article->getVar("size", "n")) ? intval($article->getVar("size", "n")) - $subsize : 0);
	$article->setVar("daysize", $newdaysize);
	$article->setVar("weeksize", $newweeksize);
	$article->setVar("monthsize", $newmonthsize);
	$article->setVar("size", $newsize);

	if (0 < $isvip) {
		$vipsize = ($subsize < intval($article->getVar("vipsize", "n")) ? intval($article->getVar("vipsize", "n")) - $subsize : 0);
		$article->setVar("vipsize", $vipsize);
	}
	else {
		$freesize = ($subsize < intval($article->getVar("freesize", "n")) ? intval($article->getVar("freesize", "n")) - $subsize : 0);
		$article->setVar("freesize", $freesize);
	}

	$article_handler->insert($article);
	include_once ($jieqiModules["article"]["path"] . "/class/articleattachs.php");
	$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
	$criteria = new CriteriaCompo(new Criteria("chapterid", $chapterid));
	$attachs_handler->delete($criteria);

	if (!$batch) {
		include_once (JIEQI_ROOT_PATH . "/class/users.php");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
		jieqi_getconfigs(JIEQI_MODULE_NAME, "configs");
		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
		$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);

		if (!empty($jieqiAction["article"]["chapteradd"]["earnscore"])) {
			$users_handler->changeScore($chapter->getVar("posterid"), $jieqiAction["article"]["chapteradd"]["earnscore"], false);
		}
	}

	include_once ($jieqiModules["article"]["path"] . "/class/package.php");
	$package = new JieqiPackage($article->getVar("articleid"));
	$package->delChapter($chapter);
	return $updateblock;
}

function jieqi_article_chapterset($chapter, $article = NULL, $action = "free")
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiAction;
	global $article_handler;
	global $chapter_handler;
	global $obook_handler;
	global $ochapter_handler;
	global $ocontent_handler;
	global $jieqi_file_postfix;
	global $query;

	if (!in_array($action, array("vip", "free", "show", "hide"))) {
		return false;
	}

	if (!is_object($chapter)) {
		$chapter = $chapter_handler->get(intval($chapter));

		if (!$chapter) {
			return false;
		}

		$article = $article_handler->get($chapter->getVar("articleid"));

		if (!$article) {
			return false;
		}
	}

	$articleid = intval($chapter->getVar("articleid", "n"));
	$chapterid = intval($chapter->getVar("chapterid", "n"));
	$isvip = intval($chapter->getVar("isvip", "n"));
	$display = intval($chapter->getVar("display", "n"));

	switch ($action) {
	case "show":
		if ($display == 0) {
			return false;
		}

		$chapter->setVar("display", 0);
		$chapter_handler->insert($chapter);

		if (0 < $isvip) {
			if (!is_a($ochapter_handler, "JieqiOchapterHandler")) {
				include_once ($jieqiModules["obook"]["path"] . "/class/ochapter.php");
				$ochapter_handler = &JieqiOchapterHandler::getInstance("JieqiOchapterHandler");
			}

			$ochapter = $ochapter_handler->get($chapterid, "chapterid");

			if (is_object($ochapter)) {
				$ochapter->setVar("display", 0);
				$ochapter_handler->insert($ochapter);
			}
		}

		break;

	case "hide":
		if ($display == 1) {
			return false;
		}

		$chapter->setVar("display", 1);
		$chapter_handler->insert($chapter);

		if (0 < $isvip) {
			if (!is_a($ochapter_handler, "JieqiOchapterHandler")) {
				include_once ($jieqiModules["obook"]["path"] . "/class/ochapter.php");
				$ochapter_handler = &JieqiOchapterHandler::getInstance("JieqiOchapterHandler");
			}

			$ochapter = $ochapter_handler->get($chapterid, "chapterid");

			if (is_object($ochapter)) {
				$ochapter->setVar("display", 1);
				$ochapter_handler->insert($ochapter);
			}
		}

		break;

	case "free":
		if ($isvip == 0) {
			return false;
		}

		$chapter->setVar("isvip", 0);
		$chapter_handler->insert($chapter);
		include_once ($jieqiModules["article"]["path"] . "/class/package.php");
		jieqi_convert_achapterc($articleid, $chapterid, "free");

		if (!is_a($ochapter_handler, "JieqiOchapterHandler")) {
			include_once ($jieqiModules["obook"]["path"] . "/class/ochapter.php");
			$ochapter_handler = &JieqiOchapterHandler::getInstance("JieqiOchapterHandler");
		}

		if (!is_a($ocontent_handler, "JieqiOcontentHandler")) {
			include_once ($jieqiModules["obook"]["path"] . "/class/ocontent.php");
			$ocontent_handler = &JieqiOcontentHandler::getInstance("JieqiOcontentHandler");
		}

		include_once ($jieqiModules["obook"]["path"] . "/class/ocontent.php");
		$content_handler = &JieqiOcontentHandler::getInstance("JieqiOcontentHandler");
		$ochapter = $ochapter_handler->get($chapterid, "chapterid");

		if (is_object($ochapter)) {
			if (intval($ochapter->getVar("sumegold", "n")) == 0) {
				$ochapter_handler->delete($chapterid, "chapterid");
				$ocontent_handler->delete($chapterid, "ochapterid");

				if (!is_a($query, "JieqiQueryHandler")) {
					jieqi_includedb();
					$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
				}

				$sql = "UPDATE  " . jieqi_dbprefix("obook_obook") . " SET chapters = chapters - 1 WHERE articleid = " . intval($articleid);
				$query->execute($sql);
			}
			else {
				$ochapter->setVar("display", 2);
				$ochapter_handler->insert($ochapter);
			}
		}

		break;

	case "vip":
		if (0 < $isvip) {
			return false;
		}

		if (!isset($jieqiConfigs["article"])) {
			jieqi_getconfigs("article", "configs");
		}

		if (!isset($jieqiConfigs["obook"])) {
			jieqi_getconfigs("obook", "configs");
		}

		$saleprice = intval($chapter->getVar("saleprice", "n"));
		$chaptersize = intval($chapter->getVar("size", "n"));
		if (($saleprice == 0) && (0 < $chaptersize) && is_numeric($jieqiConfigs["obook"]["wordsperegold"]) && (0 < $jieqiConfigs["obook"]["wordsperegold"])) {
			$wordsperegold = ceil($jieqiConfigs["obook"]["wordsperegold"]) * 2;

			if ($jieqiConfigs["obook"]["priceround"] == 1) {
				$saleprice = floor($chaptersize / $wordsperegold);
			}
			else if ($jieqiConfigs["obook"]["priceround"] == 2) {
				$saleprice = ceil($chaptersize / $wordsperegold);
			}
			else {
				$saleprice = round($chaptersize / $wordsperegold);
			}

			$chapter->setVar("saleprice", $saleprice);
		}

		$chapter->setVar("isvip", 1);
		$chapter_handler->insert($chapter);
		include_once ($jieqiModules["article"]["path"] . "/class/package.php");
		jieqi_convert_achapterc($articleid, $chapterid, "vip");

		if (!is_a($obook_handler, "JieqiObookHandler")) {
			include_once ($jieqiModules["obook"]["path"] . "/class/obook.php");
			$obook_handler = &JieqiObookHandler::getInstance("JieqiObookHandler");
		}

		if (!is_a($ochapter_handler, "JieqiOchapterHandler")) {
			include_once ($jieqiModules["obook"]["path"] . "/class/ochapter.php");
			$ochapter_handler = &JieqiOchapterHandler::getInstance("JieqiOchapterHandler");
		}

		$ochapter = $ochapter_handler->get($chapterid, "chapterid");

		if (is_object($ochapter)) {
			if (!is_a($query, "JieqiQueryHandler")) {
				jieqi_includedb();
				$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
			}

			$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET lastupdate = '" . intval($chapter->getVar("lastupdate", "n")) . "', chaptername = '" . jieqi_dbslashes($chapter->getVar("chaptername", "n")) . "', summary = '" . jieqi_dbslashes($chapter->getVar("summary", "n")) . "', size = '" . intval($chapter->getVar("size", "n")) . "', saleprice = '" . intval($chapter->getVar("saleprice", "n")) . "', display = 0 WHERE chapterid = " . intval($chapter->getVar("chapterid", "n"));
			$query->execute($sql);
		}
		else {
			$obookid = intval($chapter->getVar("vipid", "n"));

			if ($obookid == 0) {
				include_once ($jieqiModules["obook"]["path"] . "/include/actobook.php");
				$obook = jieqi_obook_autocreate($article, 1);

				if (!is_object($obook)) {
					jieqi_printfail($obook);
				}

				$obookid = intval($obook->getVar("obookid", "n"));
			}

			$ochapter = $ochapter_handler->create();
			$ochapter->setVar("ochapterid", $chapter->getVar("chapterid", "n"));
			$ochapter->setVar("siteid", $chapter->getVar("siteid", "n"));
			$ochapter->setVar("obookid", $obookid);
			$ochapter->setVar("articleid", $chapter->getVar("articleid", "n"));
			$ochapter->setVar("chapterid", $chapter->getVar("chapterid", "n"));
			$ochapter->setVar("postdate", $chapter->getVar("postdate", "n"));
			$ochapter->setVar("lastupdate", $chapter->getVar("lastupdate", "n"));
			$ochapter->setVar("buytime", 0);
			$ochapter->setVar("obookname", $chapter->getVar("articlename", "n"));
			$ochapter->setVar("chaptername", $chapter->getVar("chaptername", "n"));
			$ochapter->setVar("chapterorder", $chapter->getVar("chapterorder", "n"));
			$ochapter->setVar("summary", $chapter->getVar("summary", "n"));
			$ochapter->setVar("size", $chapter->getVar("size", "n"));
			$ochapter->setVar("posterid", $chapter->getVar("posterid", "n"));
			$ochapter->setVar("poster", $chapter->getVar("poster", "n"));
			$ochapter->setVar("toptime", 0);
			$ochapter->setVar("picflag", $chapter->getVar("isimage", "n"));
			$ochapter->setVar("chaptertype", $chapter->getVar("chaptertype", "n"));
			$ochapter->setVar("saleprice", $chapter->getVar("saleprice", "n"));
			$ochapter->setVar("vipprice", $chapter->getVar("saleprice", "n"));
			$ochapter->setVar("sumegold", 0);
			$ochapter->setVar("sumesilver", 0);
			$ochapter->setVar("normalsale", 0);
			$ochapter->setVar("vipsale", 0);
			$ochapter->setVar("freesale", 0);
			$ochapter->setVar("bespsale", 0);
			$ochapter->setVar("totalsale", 0);
			$ochapter->setVar("daysale", 0);
			$ochapter->setVar("weeksale", 0);
			$ochapter->setVar("monthsale", 0);
			$ochapter->setVar("allsale", 0);
			$ochapter->setVar("lastsale", 0);
			$ochapter->setVar("state", 0);
			$ochapter->setVar("flag", 0);
			$ochapter->setVar("display", 0);
			$ochapter_handler->insert($ochapter);

			if (!is_a($query, "JieqiQueryHandler")) {
				jieqi_includedb();
				$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
			}

			$sql = "UPDATE  " . jieqi_dbprefix("obook_obook") . " SET chapters = chapters + 1 WHERE articleid = " . intval($articleid);
			$query->execute($sql);
		}

		break;

	default:
		return false;
		break;
	}

	$updateblock = false;
	if (($chapterid == $article->getVar("lastchapterid")) || ($chapterid == $article->getVar("lastvolumeid")) || ($chapterid == $article->getVar("vipchapterid")) || ($chapterid == $article->getVar("vipvolumeid"))) {
		$lastinfo = jieqi_article_searchlast($article, "all");
		$article->setVar("lastchapter", $lastinfo["lastchapter"]);
		$article->setVar("lastchapterid", $lastinfo["lastchapterid"]);
		$article->setVar("lastsummary", $lastinfo["lastsummary"]);
		$article->setVar("lastvolume", $lastinfo["lastvolume"]);
		$article->setVar("lastvolumeid", $lastinfo["lastvolumeid"]);
		$article->setVar("vipchapter", $lastinfo["vipchapter"]);
		$article->setVar("vipchapterid", $lastinfo["vipchapterid"]);
		$article->setVar("vipsummary", $lastinfo["vipsummary"]);
		$article->setVar("vipvolume", $lastinfo["vipvolume"]);
		$article->setVar("vipvolumeid", $lastinfo["vipvolumeid"]);
		$updateblock = true;
	}

	$subsize = intval($chapter->getVar("size", "n"));

	if ($action == "vip") {
		$article->setVar("vipchapters", $article->getVar("vipchapters") + 1);
		$article->setVar("vipsize", $article->getVar("vipsize") + $subsize);
		$article->setVar("freesize", $article->getVar("freesize") - $subsize);
	}
	else if ($action == "free") {
		$article->setVar("vipchapters", $article->getVar("vipchapters") - 1);
		$article->setVar("vipsize", $article->getVar("vipsize") - $subsize);
		$article->setVar("freesize", $article->getVar("freesize") + $subsize);
	}

	$article_handler->insert($article);
	include_once ($jieqiModules["article"]["path"] . "/class/package.php");
	$package = new JieqiPackage($article->getVar("articleid"));
	$package->setChapter($chapter);
	return $updateblock;
}

function jieqi_article_searchlast($article, $lasttype)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $article_handler;
	global $chapter_handler;
	$ret = array("id" => 0, "name" => "", "summary" => "");

	switch ($lasttype) {
	case "lastchapter":
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid", "n")));
		$criteria->add(new Criteria("chaptertype", 0, "="));
		$criteria->add(new Criteria("isvip", 0, "="));
		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$criteria->setStart(0);
		$criteria->setLimit(1);
		$chapter_handler->queryObjects($criteria);
		$tmpchapter = $chapter_handler->getObject();

		if ($tmpchapter) {
			$ret = array("id" => $tmpchapter->getVar("chapterid", "n"), "name" => $tmpchapter->getVar("chaptername", "n"), "summary" => $tmpchapter->getVar("summary", "n"));
		}

		break;

	case "lastvolume":
		$lastchapterorder = 0;
		$lastchapterid = intval($article->getVar("lastchapterid", "n"));

		if (0 < $lastchapterid) {
			$tmpchapter = $chapter_handler->get($lastchapterid);

			if (is_object($tmpchapter)) {
				$lastchapterorder = intval($tmpchapter->getVar("chapterorder", "n"));
			}
		}

		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->add(new Criteria("chaptertype", 1, "="));

		if (0 < $lastchapterorder) {
			$criteria->add(new Criteria("chapterorder", $lastchapterorder, "<"));
		}

		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$criteria->setStart(0);
		$criteria->setLimit(1);
		$chapter_handler->queryObjects($criteria);
		$tmpchapter = $chapter_handler->getObject();

		if ($tmpchapter) {
			$ret = array("id" => $tmpchapter->getVar("chapterid", "n"), "name" => $tmpchapter->getVar("chaptername", "n"), "summary" => $tmpchapter->getVar("summary", "n"));
		}

		break;

	case "vipchapter":
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->add(new Criteria("chaptertype", 0, "="));
		$criteria->add(new Criteria("isvip", 0, ">"));
		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$criteria->setStart(0);
		$criteria->setLimit(1);
		$chapter_handler->queryObjects($criteria);
		$tmpchapter = $chapter_handler->getObject();

		if ($tmpchapter) {
			$ret = array("id" => $tmpchapter->getVar("chapterid", "n"), "name" => $tmpchapter->getVar("chaptername", "n"), "summary" => $tmpchapter->getVar("summary", "n"));
		}

		break;

	case "vipvolume":
		$vipchapterorder = 0;
		$vipchapterid = intval($article->getVar("vipchapterid", "n"));

		if (0 < $vipchapterid) {
			$tmpchapter = $chapter_handler->get($vipchapterid);

			if (is_object($tmpchapter)) {
				$vipchapterorder = intval($tmpchapter->getVar("chapterorder", "n"));
			}
		}

		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->add(new Criteria("chaptertype", 1, "="));

		if (0 < $vipchapterorder) {
			$criteria->add(new Criteria("chapterorder", $vipchapterorder, "<"));
		}

		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$criteria->setStart(0);
		$criteria->setLimit(1);
		$chapter_handler->queryObjects($criteria);
		$tmpchapter = $chapter_handler->getObject();

		if ($tmpchapter) {
			$ret = array("id" => $tmpchapter->getVar("chapterid", "n"), "name" => $tmpchapter->getVar("chaptername", "n"), "summary" => $tmpchapter->getVar("summary", "n"));
		}

		break;

	case "all":
		$ret = array("lastchapterid" => 0, "lastchapter" => "", "lastsummary" => "", "lastvolumeid" => 0, "lastvolume" => "", "vipchapterid" => 0, "vipchapter" => "", "vipsummary" => "", "vipvolumeid" => 0, "vipvolume" => "");
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$chapter_handler->queryObjects($criteria);

		while ($tmpchapter = $chapter_handler->getObject()) {
			if ($tmpchapter->getVar("chaptertype", "n") == 0) {
				if ($tmpchapter->getVar("isvip", "n") == 0) {
					if ($ret["lastchapterid"] == 0) {
						$ret["lastchapterid"] = $tmpchapter->getVar("chapterid", "n");
						$ret["lastchapter"] = $tmpchapter->getVar("chaptername", "n");
						$ret["lastsummary"] = $tmpchapter->getVar("summary", "n");
					}
				}
				else if ($ret["vipchapterid"] == 0) {
					$ret["vipchapterid"] = $tmpchapter->getVar("chapterid", "n");
					$ret["vipchapter"] = $tmpchapter->getVar("chaptername", "n");
					$ret["vipsummary"] = $tmpchapter->getVar("summary", "n");
				}
			}
			else {
				if (($ret["lastvolumeid"] == 0) && (0 < $ret["lastchapterid"])) {
					$ret["lastvolumeid"] = $tmpchapter->getVar("chapterid", "n");
					$ret["lastvolume"] = $tmpchapter->getVar("chaptername", "n");
				}

				if (($ret["vipvolumeid"] == 0) && (0 < $ret["vipchapterid"])) {
					$ret["vipvolumeid"] = $tmpchapter->getVar("chapterid", "n");
					$ret["vipvolume"] = $tmpchapter->getVar("chaptername", "n");
				}
			}

			if ((0 < $ret["lastchapterid"]) && $ret["lastvolumeid"] && (($article->getVar("vipid", "n") == 0) || ((0 < $ret["vipchapterid"]) && (0 < $ret["vipvolumeid"])))) {
				break;
			}
		}

		break;

	case "full":
		$ret = array("lastchapterid" => 0, "lastchapter" => "", "lastsummary" => "", "lastvolumeid" => 0, "lastvolume" => "", "size" => 0, "chapters" => 0, "freetime" => 0, "freesize" => 0, "isvip" => $article->getVar("isvip", "n"), "vipchapterid" => 0, "vipchapter" => "", "vipsummary" => "", "vipvolumeid" => 0, "vipvolume" => "", "vipchapters" => 0, "vipsize" => 0, "viptime" => 0);
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->setSort("chapterorder");
		$criteria->setOrder("DESC");
		$chapter_handler->queryObjects($criteria);

		while ($tmpchapter = $chapter_handler->getObject()) {
			$ret["chapters"] += 1;

			if ($tmpchapter->getVar("chaptertype", "n") == 0) {
				$ret["size"] += $tmpchapter->getVar("size", "n");

				if ($tmpchapter->getVar("isvip", "n") == 0) {
					if ($ret["lastchapterid"] == 0) {
						$ret["lastchapterid"] = $tmpchapter->getVar("chapterid", "n");
						$ret["lastchapter"] = $tmpchapter->getVar("chaptername", "n");
						$ret["lastsummary"] = $tmpchapter->getVar("summary", "n");
					}

					if ($ret["freetime"] < $tmpchapter->getVar("postdate", "n")) {
						$ret["freetime"] = $tmpchapter->getVar("postdate", "n");
					}

					$ret["freesize"] += $tmpchapter->getVar("size", "n");
				}
				else {
					if ($ret["vipchapterid"] == 0) {
						$ret["vipchapterid"] = $tmpchapter->getVar("chapterid", "n");
						$ret["vipchapter"] = $tmpchapter->getVar("chaptername", "n");
						$ret["vipsummary"] = $tmpchapter->getVar("summary", "n");
					}

					if ($ret["isvip"] == 0) {
						$ret["isvip"] = 1;
					}

					if ($ret["viptime"] < $tmpchapter->getVar("postdate", "n")) {
						$ret["viptime"] = $tmpchapter->getVar("postdate", "n");
					}

					$ret["vipsize"] += $tmpchapter->getVar("size", "n");
					$ret["vipchapters"] += 1;
				}
			}
			else {
				if (($ret["lastvolumeid"] == 0) && (0 < $ret["lastchapterid"])) {
					$ret["lastvolumeid"] = $tmpchapter->getVar("chapterid", "n");
					$ret["lastvolume"] = $tmpchapter->getVar("chaptername", "n");
				}

				if (($ret["vipvolumeid"] == 0) && (0 < $ret["vipchapterid"])) {
					$ret["vipvolumeid"] = $tmpchapter->getVar("chapterid", "n");
					$ret["vipvolume"] = $tmpchapter->getVar("chaptername", "n");
				}
			}
		}

		if (($ret["vipchapters"] == 0) && (0 < $ret["isvip"])) {
			$ret["isvip"] = 0;
		}

		break;
	}

	return $ret;
}

function jieqi_article_chapterpcheck(&$postvars, &$attachvars)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiLang;
	global $article_handler;
	global $chapter_handler;
	$errors = array();
	$postvars["chaptertype"] = intval($postvars["chaptertype"]);

	if (strlen($postvars["chaptername"]) == 0) {
		$errors[] = $jieqiLang["article"]["need_chapter_title"];
	}

	if (!isset($jieqiConfigs["system"])) {
		jieqi_getconfigs("system", "configs");
	}

	include_once (JIEQI_ROOT_PATH . "/include/checker.php");
	$checker = new JieqiChecker();

	if (!empty($jieqiConfigs["system"]["postdenywords"])) {
		$matchwords1 = $checker->deny_words($postvars["chaptername"], $jieqiConfigs["system"]["postdenywords"], true);
		$matchwords2 = $checker->deny_words($postvars["chaptercontent"], $jieqiConfigs["system"]["postdenywords"], true);
		if (is_array($matchwords1) || is_array($matchwords2)) {
			if (!isset($jieqiLang["system"]["post"])) {
				jieqi_loadlang("post", "system");
			}

			$matchwords = array();

			if (is_array($matchwords1)) {
				$matchwords = array_merge($matchwords, $matchwords1);
			}

			if (is_array($matchwords2)) {
				$matchwords = array_merge($matchwords, $matchwords2);
			}

			$errors[] = sprintf($jieqiLang["system"]["post_words_deny"], implode(" ", jieqi_funtoarray("htmlspecialchars", $matchwords)));
		}
	}

	if ($postvars["uptiming"] == 1) {
		$postvars["pubyear"] = intval(trim($postvars["pubyear"]));
		$postvars["pubmonth"] = intval(trim($postvars["pubmonth"]));
		$postvars["pubday"] = intval(trim($postvars["pubday"]));
		$postvars["pubhour"] = intval(trim($postvars["pubhour"]));
		$postvars["pubminute"] = intval(trim($postvars["pubminute"]));
		$postvars["pubsecond"] = intval(trim($postvars["pubsecond"]));
		$postvars["pubtime"] = @mktime($postvars["pubhour"], $postvars["pubminute"], $postvars["pubsecond"], $postvars["pubmonth"], $postvars["pubday"], $postvars["pubyear"]);

		if ($postvars["pubtime"] <= JIEQI_NOW_TIME) {
			$errors[] = $jieqiLang["article"]["uptiming_time_low"];
		}
	}

	$attachvars = array(
		"id"   => array(),
		"info" => array()
		);
	$attachnum = 0;
	if ($postvars["canupload"] && is_numeric($jieqiConfigs["article"]["maxattachnum"]) && (0 < $jieqiConfigs["article"]["maxattachnum"]) && isset($_FILES["attachfile"])) {
		$maxfilenum = intval($jieqiConfigs["article"]["maxattachnum"]);
		$typeary = explode(" ", trim($jieqiConfigs["article"]["attachtype"]));

		foreach ($typeary as $k => $v ) {
			if (substr($v, 0, 1) == ".") {
				$typeary[$k] = substr($typeary[$k], 1);
			}
		}

		foreach ($_FILES["attachfile"]["name"] as $k => $v ) {
			if (!empty($v)) {
				$tmpary = explode(".", $v);
				$tmpint = count($tmpary) - 1;
				$tmpary[$tmpint] = strtolower(trim($tmpary[$tmpint]));
				$denyary = array("htm", "html", "shtml", "php", "asp", "aspx", "jsp", "pl", "cgi");
				if (empty($tmpary[$tmpint]) || !in_array($tmpary[$tmpint], $typeary)) {
					$errors[] = sprintf($jieqiLang["article"]["upload_filetype_error"], $v);
				}
				else if (in_array($tmpary[$tmpint], $denyary)) {
					$errors[] = sprintf($jieqiLang["article"]["upload_filetype_limit"], $tmpary[$tmpint]);
				}

				if (preg_match("/\.(gif|jpg|jpeg|png|bmp)$/i", $v)) {
					$fclass = "image";

					if ((intval($jieqiConfigs["article"]["maximagesize"]) * 1024) < $_FILES["attachfile"]["size"][$k]) {
						$errors[] = sprintf($jieqiLang["article"]["upload_filesize_toolarge"], $v, intval($jieqiConfigs["article"]["maximagesize"]));
					}
				}
				else {
					$fclass = "file";

					if ((intval($jieqiConfigs["article"]["maxfilesize"]) * 1024) < $_FILES["attachfile"]["size"][$k]) {
						$errors[] = sprintf($jieqiLang["article"]["upload_filesize_toolarge"], $v, intval($jieqiConfigs["article"]["maxfilesize"]));
					}
				}

				if (!empty($errtext)) {
					jieqi_delfile($_FILES["attachfile"]["tmp_name"][$k]);
				}
				else {
					$attachvars["id"][$attachnum] = $k;
					$attachvars["info"][$attachnum] = array("name" => $v, "class" => $fclass, "postfix" => $tmpary[$tmpint], "size" => $_FILES["attachfile"]["size"][$k]);
					$attachnum++;
				}
			}
		}
	}

	if ((count($postvars["oldattach"]) == 0) && ($attachnum == 0) && ($postvars["chaptertype"] == 0) && (strlen($postvars["chaptercontent"]) == 0)) {
		$errtext .= $jieqiLang["article"]["need_chapter_content"] . "<br />";
	}

	if (empty($errors) && ($postvars["chaptertype"] == 0)) {
		if (isset($jieqiConfigs["system"]["postreplacewords"]) && !empty($jieqiConfigs["system"]["postreplacewords"])) {
			$checker->replace_words($postvars["chaptername"], $jieqiConfigs["system"]["postreplacewords"]);
			$checker->replace_words($postvars["chaptercontent"], $jieqiConfigs["system"]["postreplacewords"]);
		}

		if (($jieqiConfigs["article"]["authtypeset"] == 2) || (($jieqiConfigs["article"]["authtypeset"] == 1) && ($postvars["typeset"] == 1))) {
			include_once (JIEQI_ROOT_PATH . "/lib/text/texttypeset.php");
			$texttypeset = new TextTypeset();
			$postvars["chaptercontent"] = $texttypeset->doTypeset($postvars["chaptercontent"]);
		}
	}

	return $errors;
}

function jieqi_article_addchapter(&$postvars, &$attachvars, $article)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiLang;
	global $jieqiAction;
	global $article_handler;
	global $chapter_handler;

	if (!isset($jieqiConfigs["article"])) {
		jieqi_getconfigs("article", "configs");
	}

	if (!isset($jieqiConfigs["obook"])) {
		jieqi_getconfigs("obook", "configs");
	}

	$postvars["chaptertype"] = intval($postvars["chaptertype"]);

	if (!is_array($attachvars["info"])) {
		$attachvars = array(
			"id"   => array(),
			"info" => array()
			);
	}

	$attachnum = count($attachvars["info"]);

	if (0 < $attachnum) {
		include_once ($jieqiModules["article"]["path"] . "/class/articleattachs.php");
		$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");

		foreach ($attachvars["info"] as $k => $v ) {
			if (empty($attachvars["info"][$k]["attachid"])) {
				$newAttach = $attachs_handler->create();
				$newAttach->setVar("articleid", $article->getVar("articleid"));
				$newAttach->setVar("chapterid", 0);
				$newAttach->setVar("name", $v["name"]);
				$newAttach->setVar("class", $v["class"]);
				$newAttach->setVar("postfix", $v["postfix"]);
				$newAttach->setVar("size", $v["size"]);
				$newAttach->setVar("hits", 0);
				$newAttach->setVar("needexp", 0);
				$newAttach->setVar("uptime", JIEQI_NOW_TIME);

				if ($attachs_handler->insert($newAttach)) {
					$attachid = $newAttach->getVar("attachid");
					$attachvars["info"][$k]["attachid"] = $attachid;
				}
				else {
					$attachvars["info"][$k]["attachid"] = 0;
				}
			}
		}
	}

	include_once ($jieqiModules["article"]["path"] . "/class/chapter.php");
	$chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
	$chaptercount = $article->getVar("chapters");
	$postvars["chapterorder"] = intval($postvars["chapterorder"]);

	if (empty($postvars["chapterorder"])) {
		$postvars["chapterorder"] = $chaptercount + 1;
	}

	if ($postvars["chapterorder"] <= $chaptercount) {
		$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
		$criteria->add(new Criteria("chapterorder", $postvars["chapterorder"], ">="));
		$chapter_handler->updatefields("chapterorder = chapterorder + 1", $criteria);
		unset($criteria);
	}

	$newChapter = $chapter_handler->create();
	$newChapter->setVar("siteid", $article->getVar("siteid", "n"));
	$newChapter->setVar("articleid", $article->getVar("articleid", "n"));
	$newChapter->setVar("articlename", $article->getVar("articlename", "n"));
	$newChapter->setVar("volumeid", 0);

	if (!empty($postvars["posterid"])) {
		$newChapter->setVar("posterid", $postvars["posterid"]);
		$newChapter->setVar("poster", $postvars["poster"]);
	}
	else if (!empty($_SESSION["jieqiUserId"])) {
		$newChapter->setVar("posterid", $_SESSION["jieqiUserId"]);
		$newChapter->setVar("poster", $_SESSION["jieqiUserName"]);
	}
	else {
		$newChapter->setVar("posterid", 0);
		$newChapter->setVar("poster", "");
	}

	$newChapter->setVar("postdate", JIEQI_NOW_TIME);
	$newChapter->setVar("lastupdate", JIEQI_NOW_TIME);
	$newChapter->setVar("chaptername", $postvars["chaptername"]);
	$newChapter->setVar("chapterorder", $postvars["chapterorder"]);
	$chaptersize = strlen(preg_replace("/\s/", "", $postvars["chaptercontent"]));
	if ((0 < $chaptersize) && (!isset($postvars["saleprice"]) || !is_numeric($postvars["saleprice"]) || (intval($postvars["saleprice"]) < 0))) {
		$postvars["saleprice"] = 0;
		if (is_numeric($jieqiConfigs["obook"]["wordsperegold"]) && (0 < $jieqiConfigs["obook"]["wordsperegold"])) {
			$wordsperegold = ceil($jieqiConfigs["obook"]["wordsperegold"]) * 2;

			if ($jieqiConfigs["obook"]["priceround"] == 1) {
				$postvars["saleprice"] = floor($chaptersize / $wordsperegold);
			}
			else if ($jieqiConfigs["obook"]["priceround"] == 2) {
				$postvars["saleprice"] = ceil($chaptersize / $wordsperegold);
			}
			else {
				$postvars["saleprice"] = round($chaptersize / $wordsperegold);
			}
		}
	}
	else {
		$postvars["saleprice"] = ($chaptersize == 0 ? 0 : intval($postvars["saleprice"]));
	}

	$newChapter->setVar("size", $chaptersize);
	$newChapter->setVar("saleprice", $postvars["saleprice"]);
	$newChapter->setVar("salenum", 0);
	$newChapter->setVar("totalcost", 0);
	$newChapter->setVar("attachment", serialize($attachvars["info"]));

	if (0 < $chaptersize) {
		$newChapter->setVar("summary", jieqi_substr($postvars["chaptercontent"], 0, 500, ".."));
	}
	else {
		$newChapter->setVar("summary", "");
	}

	if (($chaptersize == 0) && (0 < $attachnum) && ($postvars["chaptertype"] == 0)) {
		$newChapter->setVar("isimage", 1);
	}

	$newChapter->setVar("isimage", 0);
	$newChapter->setVar("isvip", intval($postvars["isvip"]));

	if (0 < $postvars["chaptertype"]) {
		$newChapter->setVar("chaptertype", 1);
	}
	else {
		$newChapter->setVar("chaptertype", 0);
	}

	$newChapter->setVar("power", 0);
	$newChapter->setVar("display", 0);

	if (!$chapter_handler->insert($newChapter)) {
		if (0 < $attachnum) {
			include_once ($jieqiModules["article"]["path"] . "/class/articleattachs.php");
			$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");

			foreach ($attachvars["info"] as $k => $v ) {
				if (0 < $v["attachid"]) {
					$attachs_handler->delete($v["attachid"]);
				}
			}
		}

		return false;
	}
	else {
		if ($postvars["chaptertype"] == 0) {
			$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
			$criteria->add(new Criteria("chapterorder", $postvars["chapterorder"], "<"));
			$criteria->add(new Criteria("chaptertype", 1, "="));
			$criteria->setSort("chapterorder");
			$criteria->setOrder("DESC");
			$criteria->setLimit(1);
			$chapter_handler->queryObjects($criteria);
			$tmpchapter = $chapter_handler->getObject();

			if (is_object($tmpchapter)) {
				$lastvolume = $tmpchapter->getVar("chaptername", "n");
				$lastvolumeid = $tmpchapter->getVar("chapterid", "n");
			}
			else {
				$lastvolume = "";
				$lastvolumeid = 0;
			}

			unset($tmpchapter);
			unset($criteria);

			if (!empty($postvars["isvip"])) {
				$article->setVar("vipchapter", $postvars["chaptername"]);
				$article->setVar("vipchapterid", $newChapter->getVar("chapterid", "n"));
				$article->setVar("vipsummary", $newChapter->getVar("summary", "n"));

				if ($article->getVar("vipvolumeid") != $lastvolumeid) {
					$article->setVar("vipvolume", $lastvolume);
					$article->setVar("vipvolumeid", $lastvolumeid);
				}
			}
			else {
				$article->setVar("lastchapter", $postvars["chaptername"]);
				$article->setVar("lastchapterid", $newChapter->getVar("chapterid", "n"));
				$article->setVar("lastsummary", $newChapter->getVar("summary", "n"));

				if ($article->getVar("lastvolumeid") != $lastvolumeid) {
					$article->setVar("lastvolume", $lastvolume);
					$article->setVar("lastvolumeid", $lastvolumeid);
				}
			}
		}
		else {
			$criteria = new CriteriaCompo(new Criteria("articleid", $article->getVar("articleid")));
			$criteria->add(new Criteria("chapterorder", $postvars["chapterorder"], ">"));
			$criteria->add(new Criteria("chaptertype", 0, "="));
			$criteria->setSort("chapterorder");
			$criteria->setOrder("DESC");
			$chapter_handler->queryObjects($criteria);
			$tmpchapter = $chapter_handler->getObject();

			if (is_object($tmpchapter)) {
				if (!empty($postvars["isvip"])) {
					if ($tmpchapter->getVar("chapterid", "n") == $article->getVar("vipchapterid", "n")) {
						$article->setVar("vipvolume", $postvars["chaptername"]);
						$article->setVar("vipvolumeid", $newChapter->getVar("chapterid", "n"));
					}
				}
				else if ($tmpchapter->getVar("chapterid", "n") == $article->getVar("lastchapterid", "n")) {
					$article->setVar("lastvolume", $postvars["chaptername"]);
					$article->setVar("lastvolumeid", $newChapter->getVar("chapterid", "n"));
				}
			}

			unset($tmpchapter);
			unset($criteria);
		}

		include_once (JIEQI_ROOT_PATH . "/include/funstat.php");
		$lasttime = $article->getVar("lastupdate", "n");
		$addorup = jieqi_visit_addorup($lasttime);
		$daysize = ($addorup["day"] ? $chaptersize : $article->getVar("daysize", "n") + $chaptersize);
		$weeksize = ($addorup["week"] ? $chaptersize : $article->getVar("weeksize", "n") + $chaptersize);
		$monthsize = ($addorup["month"] ? $chaptersize : $article->getVar("monthsize", "n") + $chaptersize);
		$allsize = $article->getVar("size", "n") + $chaptersize;
           $size = mysql_query("INSERT INTO jieqi_article_sizelog  (`size` ,`bookid` ,`data`)VALUES ('" . $chaptersize . "', '" . $article->getVar('articleid') . "', '" . intval(JIEQI_NOW_TIME) . "')");
		if (2.2 <= floatval(JIEQI_VERSION)) {
			if ($addorup["month"]) {
				$article->setVar("presize", $article->getVar("monthsize", "n"));
				$article->setVar("preupds", $article->getVar("monthupds", "n"));
				$article->setVar("preupdt", $article->getVar("monthupdt", "n"));
				$article->setVar("monthupds", 0);
				$article->setVar("monthupdt", 0);
			}

			if ($addorup["day"]) {
				$article->setVar("monthupds", $article->getVar("monthupds", "n") + 1);
				$tmpvar = intval($article->getVar("monthupdt", "n")) | pow(2, intval(date("d", JIEQI_NOW_TIME)) - 1);
				$article->setVar("monthupdt", $tmpvar);
			}
		}

		$article->setVar("daysize", $daysize);
		$article->setVar("weeksize", $weeksize);
		$article->setVar("monthsize", $monthsize);
		$article->setVar("size", $allsize);

		if (!empty($postvars["isvip"])) {
			$vipsize = $article->getVar("vipsize", "n") + $chaptersize;
			$article->setVar("vipsize", $vipsize);
		}
		else {
			$freesize = $article->getVar("freesize", "n") + $chaptersize;
			$article->setVar("freesize", $freesize);
		}

		if ($postvars["fullflag"] == 1) {
			$article->setVar("fullflag", 1);
		}

		$article->setVar("lastupdate", JIEQI_NOW_TIME);
		$article->setVar("chapters", $article->getVar("chapters") + 1);

		if (!empty($postvars["isvip"])) {
			$article->setVar("vipchapters", $article->getVar("vipchapters") + 1);
			$article->setVar("viptime", JIEQI_NOW_TIME);
		}
		else {
			$article->setVar("freetime", JIEQI_NOW_TIME);
		}

		$article_handler->insert($article);
		$make_image_water = false;
		if (function_exists("gd_info") && (0 < $jieqiConfigs["article"]["attachwater"]) && (JIEQI_MODULE_VTYPE != "") && (JIEQI_MODULE_VTYPE != "Free")) {
			if ((strpos($jieqiConfigs["article"]["attachwimage"], "/") === false) && (strpos($jieqiConfigs["article"]["attachwimage"], "\\") === false)) {
				$water_image_file = $jieqiModules["article"]["path"] . "/images/" . $jieqiConfigs["article"]["attachwimage"];
			}
			else {
				$water_image_file = $jieqiConfigs["article"]["attachwimage"];
			}

			if (is_file($water_image_file)) {
				$make_image_water = true;
				include_once (JIEQI_ROOT_PATH . "/lib/image/imagewater.php");
			}
		}

		if (0 < $attachnum) {
			$attachs_handler->execute("UPDATE " . jieqi_dbprefix("article_attachs") . " SET chapterid=" . $newChapter->getVar("chapterid") . " WHERE articleid=" . $article->getVar("articleid", "n") . " AND chapterid = 0");
			$attachdir = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article");
			$attachdir .= jieqi_getsubdir($newChapter->getVar("articleid"));
			$attachdir .= "/" . $newChapter->getVar("articleid");
			$attachdir .= "/" . $newChapter->getVar("chapterid");
			jieqi_checkdir($attachdir, true);

			foreach ($attachvars["info"] as $k => $v ) {
				$fileid = $attachvars["id"][$k];
				$attach_save_path = $attachdir . "/" . $v["attachid"] . "." . $v["postfix"];
				$tmp_attachfile = $attachdir . "/" . basename($_FILES["attachfile"]["tmp_name"][$fileid]) . "." . $v["postfix"];
				@move_uploaded_file($_FILES["attachfile"]["tmp_name"][$fileid], $tmp_attachfile);
				if ($make_image_water && preg_match("/\.(gif|jpg|jpeg|png)$/i", $tmp_attachfile)) {
					$img = new ImageWater();
					$img->save_image_file = $tmp_attachfile;
					$img->codepage = JIEQI_SYSTEM_CHARSET;
					$img->wm_image_pos = $jieqiConfigs["article"]["attachwater"];
					$img->wm_image_name = $water_image_file;
					$img->wm_image_transition = $jieqiConfigs["article"]["attachwtrans"];
					$img->jpeg_quality = $jieqiConfigs["article"]["attachwquality"];
					$img->create($tmp_attachfile);
					unset($img);
				}

				jieqi_copyfile($tmp_attachfile, $attach_save_path, 511, true);
			}
		}

		if (!empty($postvars["isvip"]) && ($postvars["chaptertype"] == 0)) {
			global $obook_handler;
			global $ochapter_handler;

			if (!is_a($obook_handler, "JieqiObookHandler")) {
				include_once ($jieqiModules["obook"]["path"] . "/class/obook.php");
				$obook_handler = &JieqiObookHandler::getInstance("JieqiObookHandler");
			}

			if (!is_a($ochapter_handler, "JieqiOchapterHandler")) {
				include_once ($jieqiModules["obook"]["path"] . "/class/ochapter.php");
				$ochapter_handler = &JieqiOchapterHandler::getInstance("JieqiOchapterHandler");
			}

			include_once ($jieqiModules["obook"]["path"] . "/include/actobook.php");
			$obook = jieqi_obook_autocreate($article, 1);

			if (!is_object($obook)) {
				jieqi_printfail($obook);
			}

			$ochapter = $ochapter_handler->create();
			$ochapter->setVar("ochapterid", $newChapter->getVar("chapterid", "n"));
			$ochapter->setVar("siteid", $newChapter->getVar("siteid", "n"));
			$ochapter->setVar("obookid", $obook->getVar("obookid", "n"));
			$ochapter->setVar("articleid", $newChapter->getVar("articleid", "n"));
			$ochapter->setVar("chapterid", $newChapter->getVar("chapterid", "n"));
			$ochapter->setVar("postdate", $newChapter->getVar("postdate", "n"));
			$ochapter->setVar("lastupdate", $newChapter->getVar("lastupdate", "n"));
			$ochapter->setVar("buytime", 0);
			$ochapter->setVar("obookname", $newChapter->getVar("articlename", "n"));
			$ochapter->setVar("chaptername", $newChapter->getVar("chaptername", "n"));
			$ochapter->setVar("chapterorder", $newChapter->getVar("chapterorder", "n"));
			$ochapter->setVar("summary", $newChapter->getVar("summary", "n"));
			$ochapter->setVar("size", $newChapter->getVar("size", "n"));
			$ochapter->setVar("posterid", $newChapter->getVar("posterid", "n"));
			$ochapter->setVar("poster", $newChapter->getVar("poster", "n"));
			$ochapter->setVar("toptime", 0);
			$ochapter->setVar("picflag", $newChapter->getVar("isimage", "n"));
			$ochapter->setVar("chaptertype", $newChapter->getVar("chaptertype", "n"));
			$ochapter->setVar("saleprice", $newChapter->getVar("saleprice", "n"));
			$ochapter->setVar("vipprice", $newChapter->getVar("saleprice", "n"));
			$ochapter->setVar("sumegold", 0);
			$ochapter->setVar("sumesilver", 0);
			$ochapter->setVar("normalsale", 0);
			$ochapter->setVar("vipsale", 0);
			$ochapter->setVar("freesale", 0);
			$ochapter->setVar("bespsale", 0);
			$ochapter->setVar("totalsale", 0);
			$ochapter->setVar("daysale", 0);
			$ochapter->setVar("weeksale", 0);
			$ochapter->setVar("monthsale", 0);
			$ochapter->setVar("allsale", 0);
			$ochapter->setVar("lastsale", 0);
			$ochapter->setVar("state", 0);
			$ochapter->setVar("flag", 0);
			$ochapter->setVar("display", 0);
			$ochapter_handler->insert($ochapter);
			$obook->setVar("chapters", intval($obook->getVars("chapters", "n")) + 1);
			$obook_handler->insert($obook);
		}

		include_once ($jieqiModules["article"]["path"] . "/class/package.php");
		$package = new JieqiPackage($article->getVar("articleid", "n"));
		$package->addChapter($newChapter, $postvars["chaptercontent"], $article);

		if (!empty($postvars["draftid"])) {
			if (!is_a($draft_handler, "JieqiDraftHandler")) {
				include_once ($jieqiModules["article"]["path"] . "/class/draft.php");
				$draft_handler = &JieqiDraftHandler::getInstance("JieqiDraftHandler");
			}

			$draft_handler->delete($postvars["draftid"]);
		}

		if ($postvars["chaptertype"] == 0) {
			include_once ($jieqiModules["article"]["path"] . "/include/funaction.php");
			$actions = array("actname" => "chapteradd", "actnum" => 1);
			jieqi_article_actiondo($actions, $article);
		}

		if ($postvars["chaptertype"] == 0) {
			jieqi_article_updateinfo($article, "chapternew");
		}
	}
}

function jieqi_article_updateinfo($article = 0, $act = "chapternew")
{
	global $jieqiTpl;
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiArticleuplog;
	global $article_handler;
	global $chapter_handler;
	if (is_numeric($article) && ($article <= 0)) {
		jieqi_getcachevars("article", "articleuplog");

		if (!is_array($jieqiArticleuplog)) {
			$jieqiArticleuplog = array("articleuptime" => 0, "vipuptime" => 0, "chapteruptime" => 0);
		}

		$jieqiArticleuplog["articleuptime"] = JIEQI_NOW_TIME;
		if (($article == 0) || ($article == -1)) {
			$jieqiArticleuplog["chapteruptime"] = JIEQI_NOW_TIME;
		}

		if (($article == 0) || ($article == -2)) {
			$jieqiArticleuplog["vipuptime"] = JIEQI_NOW_TIME;
		}

		jieqi_setcachevars("articleuplog", "jieqiArticleuplog", $jieqiArticleuplog, "article");
		return true;
	}

	if (!is_object($article)) {
		$article = $article_handler->get(intval($article));

		if (!$article) {
			return false;
		}
	}

	$aid = intval($article->getVar("articleid"));

	if ($act == "articlehide") {
		if (JIEQI_USE_CACHE) {
			if (!is_a($jieqiTpl, "JieqiTpl")) {
				include_once (JIEQI_ROOT_PATH . "/lib/template/template.php");
				$jieqiTpl = &JieqiTpl::getInstance();
			}

			$jieqiTpl->clear_cache($jieqiModules["article"]["path"] . "/templates/articleinfo.html", intval($article->getVar("articleid")));
		}

		if (0 < $jieqiConfigs["article"]["fakestatic"]) {
			include_once ($jieqiModules["article"]["path"] . "/include/funstatic.php");
			article_delete_sinfo($aid, false);
		}

		if (0 < $jieqiConfigs["article"]["makehtml"]) {
			$htmldir = jieqi_uploadpath($jieqiConfigs["article"]["htmldir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;
			jieqi_article_filehide($htmldir, true);
		}

		if (0 < $jieqiConfigs["article"]["makefull"]) {
			$htmlfile = jieqi_uploadpath($jieqiConfigs["article"]["fulldir"], "article") . jieqi_getsubdir($aid) . "/" . $aid . $jieqiConfigs["article"]["htmlfile"];
			jieqi_article_filehide($htmlfile, true);
		}
	}

	if (in_array($act, array("articlehide", "articleshow"))) {
		include_once ($jieqiModules["article"]["path"] . "/include/repack.php");
		article_repack($aid, array("makeopf" => 1), 0);
	}

	if ($article->getVar("display") != "0") {
		return true;
	}

	$uparticle = false;
	$upchapter = false;
	$upstatic = "";

	switch ($act) {
	case "articlenew":
		$uparticle = true;
		$upchapter = false;
		$upstatic = "articlenew";
		break;

	case "articleedit":
		$uparticle = true;
		$upchapter = false;
		$upstatic = "articleedit";
		break;

	case "articlehide":
		$uparticle = true;
		$upchapter = false;
		$upstatic = "";
		break;

	case "articleshow":
		$uparticle = true;
		$upchapter = false;
		$upstatic = "articleedit";
		break;

	case "articledel":
		$uparticle = true;
		$upchapter = true;
		$upstatic = "articledel";
		break;

	case "chapternew":
		$uparticle = false;
		$upchapter = true;
		$upstatic = "chapternew";
		break;

	case "chapteredit":
		$uparticle = false;
		$upchapter = true;
		$upstatic = "chapteredit";
		break;

	case "chapterdel":
		$uparticle = false;
		$upchapter = true;
		$upstatic = "chapterdel";
		break;

	case "reviewnew":
		$uparticle = false;
		$upchapter = false;
		$upstatic = "reviewnew";
		break;
	}

	if (($uparticle == true) || ($upchapter == true)) {
		jieqi_getcachevars("article", "articleuplog");

		if (!is_array($jieqiArticleuplog)) {
			$jieqiArticleuplog = array("articleuptime" => 0, "chapteruptime" => 0);
		}

		if ($uparticle) {
			$jieqiArticleuplog["articleuptime"] = JIEQI_NOW_TIME;
		}

		if ($upchapter) {
			$jieqiArticleuplog["chapteruptime"] = JIEQI_NOW_TIME;
		}

		jieqi_setcachevars("articleuplog", "jieqiArticleuplog", $jieqiArticleuplog, "article");
	}

	if (JIEQI_USE_CACHE) {
		if (!is_a($jieqiTpl, "JieqiTpl")) {
			include_once (JIEQI_ROOT_PATH . "/lib/template/template.php");
			$jieqiTpl = &JieqiTpl::getInstance();
		}

		$jieqiTpl->clear_cache($jieqiModules["article"]["path"] . "/templates/articleinfo.html", intval($article->getVar("articleid")));
	}

	if (($upstatic != "") && (0 < $jieqiConfigs["article"]["fakestatic"])) {
		include_once ($jieqiModules["article"]["path"] . "/include/funstatic.php");
		article_update_static($upstatic, intval($article->getVar("articleid")), intval($article->getVar("sortid")));
	}

	if ($act == "articleshow") {
		if (0 < $jieqiConfigs["article"]["makehtml"]) {
			$htmldir = jieqi_uploadpath($jieqiConfigs["article"]["htmldir"], "article") . jieqi_getsubdir($aid) . "/" . $aid;

			if (!jieqi_article_filehide($htmldir, false)) {
				include_once ($jieqiModules["article"]["path"] . "/include/repack.php");
				article_repack($aid, array("makehtml" => 1), 0);
			}
		}

		if (0 < $jieqiConfigs["article"]["makefull"]) {
			$htmlfile = jieqi_uploadpath($jieqiConfigs["article"]["fulldir"], "article") . jieqi_getsubdir($aid) . "/" . $aid . $jieqiConfigs["article"]["htmlfile"];

			if (!jieqi_article_filehide($htmlfile, false)) {
				include_once ($jieqiModules["article"]["path"] . "/include/repack.php");
				article_repack($aid, array("makefull" => 1), 0);
			}
		}
	}
}

function jieqi_article_filehide($file, $hide = true)
{
	$hidechar = ".";
	$dirname = dirname($file);
	$basename = basename($file);
	$hidefile = $dirname . "/" . $hidechar . $basename;

	if ($hide) {
		if (!file_exists($file)) {
			return false;
		}

		$ret = true;

		if (is_file($hidefile)) {
			$ret = jieqi_delfile($hidefile);
		}
		else if (is_dir($hidefile)) {
			$ret = jieqi_delfolder($hidefile, true);
		}

		if ($ret) {
			return rename($file, $hidefile);
		}
		else {
			if (is_file($file)) {
				jieqi_delfile($file);
			}
			else if (is_dir($file)) {
				jieqi_delfolder($file, true);
			}

			return true;
		}
	}
	else {
		if (!file_exists($hidefile)) {
			if (file_exists($file)) {
				return true;
			}
			else {
				return false;
			}
		}

		$ret = true;

		if (is_file($file)) {
			$ret = jieqi_delfile($file);
		}
		else if (is_dir($file)) {
			$ret = jieqi_delfolder($file, true);
		}

		if ($ret) {
			return rename($hidefile, $file);
		}
		else {
			if (is_file($hidefile)) {
				jieqi_delfile($hidefile);
			}
			else if (is_dir($hidefile)) {
				jieqi_delfolder($hidefile, true);
			}

			return true;
		}
	}
}

if (!defined("JIEQI_ROOT_PATH")) {
	exit();
}

include_once ($jieqiModules["article"]["path"] . "/class/article.php");

if (!isset($article_handler)) {
	$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
}

include_once ($jieqiModules["article"]["path"] . "/class/chapter.php");

if (!isset($chapter_handler)) {
	$chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
}

include_once ($jieqiModules["article"]["path"] . "/class/package.php");

if (!isset($jieqiConfigs["article"])) {
	jieqi_getconfigs("article", "configs");
}

$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);

?>

<?php
//zend53   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
jieqi_loadlang("article", JIEQI_MODULE_NAME);

if ($_REQUEST["chaptertype"] == 1) {
	$typename = $jieqiLang["article"]["volume_name"];
}
else {
	$typename = $jieqiLang["article"]["chapter_name"];
}

if (empty($_REQUEST["id"])) {
	jieqi_printfail(sprintf($jieqiLang["article"]["chapter_volume_notexists"], $typename));
}

include_once ($jieqiModules["article"]["path"] . "/class/chapter.php");
$chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
$chapter = $chapter_handler->get($_REQUEST["id"]);

if (!$chapter) {
	jieqi_printfail(sprintf($jieqiLang["article"]["chapter_volume_notexists"], $typename));
}

if ($chapter->getVar("chaptertype") == 1) {
	$_REQUEST["chaptertype"] = 1;
	$typename = $jieqiLang["article"]["volume_name"];
}
else {
	$typename = $jieqiLang["article"]["chapter_name"];
	$_REQUEST["chaptertype"] = 0;
}

include_once ($jieqiModules["article"]["path"] . "/class/article.php");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$article = $article_handler->get($chapter->getVar("articleid"));

if (!$article) {
	jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
}

jieqi_getconfigs("article", "power");
jieqi_getconfigs("obook", "power");
$canedit = jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
if (!$canedit && !empty($_SESSION["jieqiUserId"])) {
	$tmpvar = $_SESSION["jieqiUserId"];
	if ((0 < $tmpvar) && (($article->getVar("authorid") == $tmpvar) || ($chapter->getVar("posterid") == $tmpvar) || ($article->getVar("agentid") == $tmpvar))) {
		$canedit = true;
	}
}

if (!$canedit) {
	jieqi_printfail(sprintf($jieqiLang["article"]["noper_edit_chapter"], $typename));
}

$canupload = jieqi_checkpower($jieqiPower["article"]["articleupattach"], $jieqiUsersStatus, $jieqiUsersGroup, true);
$customprice = jieqi_checkpower($jieqiPower["obook"]["customprice"], $jieqiUsersStatus, $jieqiUsersGroup, true);
jieqi_getconfigs("article", "configs");
jieqi_getconfigs("obook", "configs");
$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);

if (!isset($_POST["act"])) {
	$_POST["act"] = "edit";
}

switch ($_POST["act"]) {
case "update":
	jieqi_checkpost();
	$_POST = jieqi_funtoarray("trim", $_POST);
	$_POST["canupload"] = $canupload;
	include_once ($jieqiModules["article"]["path"] . "/include/actarticle.php");
	$attachvars = array();
	$errors = jieqi_article_chapterpcheck($_POST, $attachvars);

	if (empty($errors)) {
		$tmptime = JIEQI_NOW_TIME;
		$tmpvar = $chapter->getVar("attachment", "n");

		if (!empty($tmpvar)) {
			$tmpattachary = jieqi_unserialize($tmpvar);

			if (!is_array($tmpattachary)) {
				$tmpattachary = array();
			}

			if (!is_array($_POST["oldattach"])) {
				if (is_string($_POST["oldattach"])) {
					$_POST["oldattach"] = array($_POST["oldattach"]);
				}
				else {
					$_POST["oldattach"] = array();
				}
			}

			$oldattachary = array();

			foreach ($tmpattachary as $val ) {
				if (in_array($val["attachid"], $_POST["oldattach"])) {
					$oldattachary[] = $val;
				}
				else {
					include_once ($jieqiModules["article"]["path"] . "/class/articleattachs.php");
					$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
					$attachs_handler->delete($val["attachid"]);
					$afname = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article") . jieqi_getsubdir($chapter->getVar("articleid", "n")) . "/" . $chapter->getVar("articleid", "n") . "/" . $chapter->getVar("chapterid", "n") . "/" . $val["attachid"] . "." . $val["postfix"];
					jieqi_delfile($afname);
				}
			}
		}
		else {
			$oldattachary = array();
		}

		if (0 < count($attachvars["info"])) {
			include_once ($jieqiModules["article"]["path"] . "/class/articleattachs.php");

			if (!is_object($attachs_handler)) {
				$attachs_handler = &JieqiArticleattachsHandler::getInstance("JieqiArticleattachsHandler");
			}

			$attachdir = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article");
			$attachdir .= jieqi_getsubdir($chapter->getVar("articleid"));
			$attachdir .= "/" . $chapter->getVar("articleid");
			$attachdir .= "/" . $chapter->getVar("chapterid");
			jieqi_checkdir($attachdir, true);
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

			foreach ($attachvars["info"] as $k => $v ) {
				$fileid = $attachvars["id"][$k];
				$newAttach = $attachs_handler->create();
				$newAttach->setVar("articleid", $chapter->getVar("articleid", "n"));
				$newAttach->setVar("chapterid", $chapter->getVar("chapterid", "n"));
				$newAttach->setVar("name", $v["name"]);
				$newAttach->setVar("class", $v["class"]);
				$newAttach->setVar("postfix", $v["postfix"]);
				$newAttach->setVar("size", $v["size"]);
				$newAttach->setVar("hits", 0);
				$newAttach->setVar("needexp", 0);
				$newAttach->setVar("uptime", $chapter->getVar("postdate", "n"));

				if ($attachs_handler->insert($newAttach)) {
					$attachid = $newAttach->getVar("attachid");
					$attachvars["info"][$k]["attachid"] = $attachid;
				}
				else {
					$attachvars["info"][$k]["attachid"] = 0;
				}

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

		foreach ($attachvars["info"] as $val ) {
			$oldattachary[] = $val;
		}

		if (0 < count($oldattachary)) {
			$attachinfo = serialize($oldattachary);
		}

		$chapter->setVar("attachment", $attachinfo);
		$summary = (0 < strlen($_POST["chaptercontent"]) ? jieqi_substr($_POST["chaptercontent"], 0, 500, "..") : "");
		$chapter->setVar("summary", $summary);
		if ((strlen($_POST["chaptercontent"]) == 0) && (0 < count($oldattachary)) && ($_REQUEST["chaptertype"] == 0)) {
			$chapter->setVar("isimage", 1);
		}
		else {
			$chapter->setVar("isimage", 0);
		}

		$chapter->setVar("articleid", $article->getVar("articleid"));

		if (!empty($_SESSION["jieqiUserId"])) {
			$chapter->setVar("posterid", $_SESSION["jieqiUserId"]);
			$chapter->setVar("poster", $_SESSION["jieqiUserName"]);
		}
		else {
			$chapter->setVar("posterid", 0);
			$chapter->setVar("poster", "");
		}

		$chapter->setVar("lastupdate", JIEQI_NOW_TIME);
		$chapter->setVar("chaptername", $_POST["chaptername"]);

		if ($_REQUEST["chaptertype"] == 0) {
			$chaptersize = strlen(preg_replace("/\s/", "", $_POST["chaptercontent"]));
			$beforesize = $chapter->getVar("size");
			$chapter->setVar("size", $chaptersize);

			if (0 < $chapter->getVar("isvip", "n")) {
				if ((0 < $chaptersize) && (!isset($_POST["saleprice"]) || !is_numeric($_POST["saleprice"]) || (intval($_POST["saleprice"]) < 0))) {
					$_POST["saleprice"] = 0;
					if (is_numeric($jieqiConfigs["obook"]["wordsperegold"]) && (0 < $jieqiConfigs["obook"]["wordsperegold"])) {
						$wordsperegold = ceil($jieqiConfigs["obook"]["wordsperegold"]) * 2;

						if ($jieqiConfigs["obook"]["priceround"] == 1) {
							$_POST["saleprice"] = floor($chaptersize / $wordsperegold);
						}
						else if ($jieqiConfigs["obook"]["priceround"] == 2) {
							$_POST["saleprice"] = ceil($chaptersize / $wordsperegold);
						}
						else {
							$_POST["saleprice"] = round($chaptersize / $wordsperegold);
						}
					}
				}
				else {
					$_POST["saleprice"] = ($chaptersize == 0 ? 0 : intval($_POST["saleprice"]));
				}

				$chapter->setVar("saleprice", $_POST["saleprice"]);
			}
		}
		else {
			$_POST["chaptercontent"] = "";
		}

		if (!$chapter_handler->insert($chapter)) {
			jieqi_printfail($jieqiLang["article"]["chapter_edit_failure"]);
		}
		else {
			if ($_REQUEST["chaptertype"] == 0) {
				if (0 < intval($chapter->getVar("isvip", "n"))) {
					$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
					$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET lastupdate = '" . intval($chapter->getVar("lastupdate", "n")) . "', chaptername = '" . jieqi_dbslashes($chapter->getVar("chaptername", "n")) . "', summary = '" . jieqi_dbslashes($chapter->getVar("summary", "n")) . "', size = '" . intval($chapter->getVar("size", "n")) . "', saleprice = '" . intval($chapter->getVar("saleprice", "n")) . "' WHERE chapterid = " . intval($chapter->getVar("chapterid", "n"));
					$query->execute($sql);
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
					$subdaysize += $beforesize - $chaptersize;
				}

				if ($weekstart <= $clastupdate) {
					$subweeksize += $beforesize - $chaptersize;
				}

				if ($monthstart <= $clastupdate) {
					$submonthsize += $beforesize - $chaptersize;
				}

				$subsize += $beforesize - $chaptersize;
				$newdaysize = ($subdaysize < intval($article->getVar("daysize", "n")) ? intval($article->getVar("daysize", "n")) - $subdaysize : 0);
				$newweeksize = ($subweeksize < intval($article->getVar("weeksize", "n")) ? intval($article->getVar("weeksize", "n")) - $subweeksize : 0);
				$newmonthsize = ($submonthsize < intval($article->getVar("monthsize", "n")) ? intval($article->getVar("monthsize", "n")) - $submonthsize : 0);
				$newsize = ($subsize < intval($article->getVar("size", "n")) ? intval($article->getVar("size", "n")) - $subsize : 0);
				$article->setVar("daysize", $newdaysize);
				$article->setVar("weeksize", $newweeksize);
				$article->setVar("monthsize", $newmonthsize);
				$article->setVar("size", $newsize);

				if ($chapter->getVar("chapterid") == $article->getVar("lastchapterid")) {
					$article->setVar("lastchapter", $_POST["chaptername"]);
					$article->setVar("lastsummary", $summary);
				}
				else if ($chapter->getVar("chapterid") == $article->getVar("vipchapterid")) {
					$article->setVar("vipchapter", $_POST["chaptername"]);
					$article->setVar("vipsummary", $summary);
				}
			}
			else if ($chapter->getVar("chapterid") == $article->getVar("lastvolumeid")) {
				$article->setVar("lastvolume", $_POST["chaptername"]);
			}
			else if ($chapter->getVar("chapterid") == $article->getVar("vipvolumeid")) {
				$article->setVar("vipvolume", $_POST["chaptername"]);
			}

			$article_handler->insert($article);
			@clearstatcache();
			include_once ($jieqiModules["article"]["path"] . "/class/package.php");
			$package = new JieqiPackage($article->getVar("articleid"));
			$package->editChapter($chapter, $_POST["chaptercontent"]);
			jieqi_jumppage($article_static_url . "/articlemanage.php?id=" . $article->getVar("articleid"), LANG_DO_SUCCESS, $jieqiLang["article"]["chapter_edit_success"]);
		}
	}
	else {
		jieqi_printfail(implode("<br />", $errors));
	}

	break;

case "edit":
default:
	include_once (JIEQI_ROOT_PATH . "/header.php");
	include_once (JIEQI_ROOT_PATH . "/lib/html/formloader.php");
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$jieqiTpl->assign("url_chapteredit", $article_static_url . "/chapteredit.php?do=submit");
	include_once ($jieqiModules["article"]["path"] . "/include/funarticle.php");
	$articlevals = jieqi_article_vars($article);
	$jieqiTpl->assign_by_ref("articlevals", $articlevals);

	foreach ($articlevals as $k => $v ) {
		$jieqiTpl->assign($k, $articlevals[$k]);
	}

	$chaptervals = jieqi_query_rowvars($chapter, "e");
	$jieqiTpl->assign_by_ref("chaptervals", $chaptervals);

	foreach ($chaptervals as $k => $v ) {
		$jieqiTpl->assign($k, $chaptervals[$k]);
	}

	include_once ($jieqiModules["article"]["path"] . "/class/package.php");
	$chaptercontent = jieqi_get_achapterc(array("articleid" => $article->getVar("articleid", "n"), "chapterid" => $chapter->getVar("chapterid", "n"), "isvip" => $chapter->getVar("isvip", "n"), "chaptertype" => $chapter->getVar("chaptertype", "n"), "display" => 0, "getformat" => "txt"));
	$jieqiTpl->assign("chaptercontent", htmlspecialchars($chaptercontent, ENT_QUOTES));

	if ($customprice) {
		$jieqiTpl->assign("customprice", 1);
	}
	else {
		$jieqiTpl->assign("customprice", 0);
	}

	$autoprice = 0;

	if (0 < $chapter->getVar("isvip", "n")) {
		$defaultprice = 0;
		$chaptersize = strlen(preg_replace("/\s/", "", $chaptercontent));
		if ((0 < $chaptersize) && is_numeric($jieqiConfigs["obook"]["wordsperegold"]) && (0 < $jieqiConfigs["obook"]["wordsperegold"])) {
			$wordsperegold = ceil($jieqiConfigs["obook"]["wordsperegold"]) * 2;

			if ($jieqiConfigs["obook"]["priceround"] == 1) {
				$defaultprice = floor($chaptersize / $wordsperegold);
			}
			else if ($jieqiConfigs["obook"]["priceround"] == 2) {
				$defaultprice = ceil($chaptersize / $wordsperegold);
			}
			else {
				$defaultprice = round($chaptersize / $wordsperegold);
			}
		}

		if ($defaultprice == intval($chapter->getVar("saleprice", "n"))) {
			$autoprice = 1;
		}
	}

	$jieqiTpl->assign("autoprice", $autoprice);
	$jieqiTpl->assign("authtypeset", $jieqiConfigs["article"]["authtypeset"]);
	$jieqiTpl->assign("canupload", $canupload);
	if ($canupload && is_numeric($jieqiConfigs["article"]["maxattachnum"]) && (0 < $jieqiConfigs["article"]["maxattachnum"])) {
		$maxattachnum = intval($jieqiConfigs["article"]["maxattachnum"]);
	}
	else {
		$maxattachnum = 0;
	}

	$jieqiTpl->assign("maxattachnum", $maxattachnum);
	$jieqiTpl->assign("attachtype", $jieqiConfigs["article"]["attachtype"]);
	$jieqiTpl->assign("maximagesize", $jieqiConfigs["article"]["maximagesize"]);
	$jieqiTpl->assign("maxfilesize", $jieqiConfigs["article"]["maxfilesize"]);
	$tmpvar = $chapter->getVar("attachment", "n");
	$attachnum = 0;
	$attachrows = array();

	if (!empty($tmpvar)) {
		$attachrows = jieqi_unserialize($tmpvar);

		if (!is_array($attachrows)) {
			$attachrows = array();
		}

		$attachnum = count($attachrows);

		foreach ($attachrows as $k => $v ) {
			$attachrows[$k]["name"] = jieqi_htmlstr($attachrows[$k]["name"]);
		}
	}

	$jieqiTpl->assign("attachnum", $attachnum);
	$jieqiTpl->assign_by_ref("attachrows", $attachrows);
	$jieqiTpl->assign("chapterid", $_REQUEST["id"]);

	if ($chapter->getVar("chaptertype") == 1) {
		$chaptertype = 1;
	}
	else {
		$chaptertype = 0;
	}

	$jieqiTpl->assign("chaptertype", $chaptertype);
	$jieqiTpl->assign("chapternew", intval($jieqiConfigs["article"]["chapternew"]));
	$jieqiTpl->assign("authorarea", 1);
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/chapteredit.html";
	include_once (JIEQI_ROOT_PATH . "/footer.php");
	break;
}

?>

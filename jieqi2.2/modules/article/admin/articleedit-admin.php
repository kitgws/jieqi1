<?php
//zend53   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../../global.php");
if (empty($_REQUEST["id"]) || !is_numeric($_REQUEST["id"])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

$_REQUEST["id"] = intval($_REQUEST["id"]);
jieqi_loadlang("article", JIEQI_MODULE_NAME);
include_once ($jieqiModules["article"]["path"] . "/class/article.php");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$article = $article_handler->get($_REQUEST["id"]);

if (!$article) {
	jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
$ismanager = jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
$canedit = $ismanager;
if (!$canedit && !empty($_SESSION["jieqiUserId"])) {
	$tmpvar = $_SESSION["jieqiUserId"];
	if ((0 < $tmpvar) && (($article->getVar("authorid") == $tmpvar) || ($article->getVar("posterid") == $tmpvar) || ($article->getVar("agentid") == $tmpvar))) {
		$canedit = true;
	}
}

if (!$canedit) {
	jieqi_printfail($jieqiLang["article"]["noper_edit_article"]);
}

$allowmodify = jieqi_checkpower($jieqiPower["article"]["articlemodify"], $jieqiUsersStatus, $jieqiUsersGroup, true);

if (!isset($_REQUEST["action"])) {
	$_REQUEST["action"] = "edit";
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "configs", "jieqiConfigs");
jieqi_getconfigs(JIEQI_MODULE_NAME, "option", "jieqiOption");
jieqi_getconfigs(JIEQI_MODULE_NAME, "sort", "jieqiSort");
jieqi_getconfigs("obook", "publisher", "jieqiPublisher");

if (!is_numeric($jieqiConfigs["article"]["eachlinknum"])) {
	$jieqiConfigs["article"]["eachlinknum"] = 0;
}
else {
	$jieqiConfigs["article"]["eachlinknum"] = intval($jieqiConfigs["article"]["eachlinknum"]);
}

$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $jieqiModules["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);

switch ($_REQUEST["action"]) {
case "update":
	$_POST["articlename"] = trim($_POST["articlename"]);

	if (isset($_POST["backupname"])) {
		$_POST["backupname"] = trim($_POST["backupname"]);
	}

	$_POST["author"] = trim($_POST["author"]);
	$_POST["agent"] = trim($_POST["agent"]);
	$_POST["sortid"] = (isset($_POST["sortid"]) ? intval($_POST["sortid"]) : 0);
	$_POST["typeid"] = (isset($_POST["typeid"]) ? intval($_POST["typeid"]) : 0);

	if (!isset($jieqiSort["article"][$_POST["sortid"]]["types"][$_POST["typeid"]])) {
		$_POST["typeid"] = 0;
	}

	if (!isset($jieqiSort["article"][$_POST["sortid"]])) {
		$_POST["sortid"] = 0;
	}

	$errtext = "";
	include_once (JIEQI_ROOT_PATH . "/lib/text/textfunction.php");

	if (strlen($_POST["articlename"]) == 0) {
		$errtext .= $jieqiLang["article"]["need_article_title"] . "<br />";
	}
	else if (!jieqi_safestring($_POST["articlename"])) {
		$errtext .= $jieqiLang["article"]["limit_article_title"] . "<br />";
	}

	jieqi_getconfigs("article", "deny", "jieqiDeny");

	if (!isset($jieqiConfigs["system"])) {
		jieqi_getconfigs("system", "configs", "jieqiConfigs");
	}

	if (!isset($jieqiDeny["article"])) {
		$jieqiDeny["article"] = $jieqiConfigs["system"]["postdenywords"];
	}

	include_once (JIEQI_ROOT_PATH . "/include/checker.php");
	$checker = new JieqiChecker();
	if (!empty($jieqiDeny["article"]) || !empty($jieqiConfigs["system"]["postdenywords"])) {
		if (!empty($jieqiDeny["article"])) {
			$matchwords = $checker->deny_words($_POST["articlename"], $jieqiDeny["article"], true, true);

			if (is_array($matchwords)) {
				$errtext .= sprintf($jieqiLang["article"]["article_deny_articlename"], implode(" ", jieqi_funtoarray("htmlspecialchars", $matchwords))) . "<br />";
			}
		}

		if (!empty($jieqiConfigs["system"]["postdenywords"])) {
			if (!empty($_POST["intro"])) {
				$matchwords = $checker->deny_words($_POST["intro"], $jieqiConfigs["system"]["postdenywords"], true);

				if (is_array($matchwords)) {
					$errtext .= sprintf($jieqiLang["article"]["article_deny_intro"], implode(" ", jieqi_funtoarray("htmlspecialchars", $matchwords))) . "<br />";
				}
			}

			if (!empty($_POST["notice"])) {
				$matchwords = $checker->deny_words($_POST["notice"], $jieqiConfigs["system"]["postdenywords"], true);

				if (is_array($matchwords)) {
					$errtext .= sprintf($jieqiLang["article"]["article_deny_notice"], implode(" ", jieqi_funtoarray("htmlspecialchars", $matchwords))) . "<br />";
				}
			}

			if (!empty($_POST["keywords"])) {
				$matchwords = $checker->deny_words($_POST["keywords"], $jieqiConfigs["system"]["postdenywords"], true);

				if (is_array($matchwords)) {
					$errtext .= sprintf($jieqiLang["article"]["article_deny_keywords"], implode(" ", jieqi_funtoarray("htmlspecialchars", $matchwords))) . "<br />";
				}
			}
		}
	}

	$typeary = explode(" ", trim($jieqiConfigs["article"]["imagetype"]));

	foreach ($typeary as $k => $v ) {
		if (substr($v, 0, 1) != ".") {
			$typeary[$k] = "." . $typeary[$k];
		}
	}

	if (!empty($_FILES["articlespic"]["name"])) {
		$simage_postfix = strrchr(trim(strtolower($_FILES["articlespic"]["name"])), ".");

		if (preg_match("/\.(gif|jpg|jpeg|png|bmp)$/i", $_FILES["articlespic"]["name"])) {
			if (!in_array($simage_postfix, $typeary)) {
				$errtext .= sprintf($jieqiLang["article"]["simage_type_error"], $jieqiConfigs["article"]["imagetype"]) . "<br />";
			}
		}
		else {
			$errtext .= sprintf($jieqiLang["article"]["simage_not_image"], $_FILES["articlespic"]["name"]) . "<br />";
		}

		if (!empty($errtext)) {
			jieqi_delfile($_FILES["articlespic"]["tmp_name"]);
		}
	}

	if (!empty($_FILES["articlelpic"]["name"])) {
		$limage_postfix = strrchr(trim(strtolower($_FILES["articlelpic"]["name"])), ".");

		if (preg_match("/\.(gif|jpg|jpeg|png|bmp)$/i", $_FILES["articlelpic"]["name"])) {
			if (!in_array($limage_postfix, $typeary)) {
				$errtext .= sprintf($jieqiLang["article"]["limage_type_error"], $jieqiConfigs["article"]["imagetype"]) . "<br />";
			}
		}
		else {
			$errtext .= sprintf($jieqiLang["article"]["limage_not_image"], $_FILES["articlelpic"]["name"]) . "<br />";
		}

		if (!empty($errtext)) {
			jieqi_delfile($_FILES["articlelpic"]["tmp_name"]);
		}
	}

	if (empty($errtext)) {
		if (($article->getVar("articlename", "n") != $_POST["articlename"]) && ($jieqiConfigs["article"]["samearticlename"] != 1)) {
			if (0 < $article_handler->getCount(new Criteria("articlename", $_POST["articlename"], "="))) {
				jieqi_printfail(sprintf($jieqiLang["article"]["articletitle_has_exists"], jieqi_htmlstr($_POST["articlename"])));
			}
		}

		if (!empty($jieqiConfigs["system"]["postreplacewords"])) {
			if (!empty($_POST["intro"])) {
				$checker->replace_words($_POST["intro"], $jieqiConfigs["system"]["postreplacewords"]);
			}

			if (!empty($_POST["notice"])) {
				$checker->replace_words($_POST["notice"], $jieqiConfigs["system"]["postreplacewords"]);
			}

			if (!empty($_POST["keywords"])) {
				$checker->replace_words($_POST["keywords"], $jieqiConfigs["system"]["postreplacewords"]);
			}
		}

		$article->setVar("articlename", $_POST["articlename"]);

		if (isset($_POST["backupname"])) {
			$article->setVar("backupname", $_POST["backupname"]);
		}

		if (2 <= floatval(JIEQI_VERSION)) {
			include_once (JIEQI_ROOT_PATH . "/include/funtag.php");
			$oldtags = jieqi_tag_clean($article->getVar("keywords", "n"));
			$tagary = jieqi_tag_clean($_POST["keywords"]);
			$_POST["keywords"] = implode(" ", $tagary);
		}

		$article->setVar("keywords", trim($_POST["keywords"]));
		$article->setVar("initial", jieqi_getinitial($_POST["articlename"]));
		include_once (JIEQI_ROOT_PATH . "/class/users.php");
		$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
		$agentobj = false;

		if (!empty($_POST["agent"])) {
			$agentobj = $users_handler->getByname($_POST["agent"], 3);
		}

		if (is_object($agentobj)) {
			$article->setVar("agentid", $agentobj->getVar("uid"));
			$article->setVar("agent", $agentobj->getVar("uname", "n"));
		}
		else {
			$article->setVar("agentid", 0);
			$article->setVar("agent", "");
		}

		if (jieqi_checkpower($jieqiPower["article"]["transarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true)) {
			if (empty($_POST["author"])) {
				if (!empty($_SESSION["jieqiUserId"])) {
					$article->setVar("authorid", $_SESSION["jieqiUserId"]);
					$article->setVar("author", $_SESSION["jieqiUserName"]);
				}
				else {
					$article->setVar("authorid", 0);
					$article->setVar("author", "");
				}
			}
			else {
				$article->setVar("author", $_POST["author"]);

				if ($_POST["authorflag"]) {
					include_once (JIEQI_ROOT_PATH . "/class/users.php");
					$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
					$authorobj = $users_handler->getByname($_POST["author"], 3);

					if (is_object($authorobj)) {
						$article->setVar("authorid", $authorobj->getVar("uid", "n"));
					}
				}
				else {
					$article->setVar("authorid", 0);
				}
			}
		}

		if (isset($jieqiOption["article"]["firstflag"]["items"][$_POST["firstflag"]])) {
			$article->setVar("firstflag", $_POST["firstflag"]);
		}

		if (isset($jieqiOption["article"]["permission"]["items"][$_POST["permission"]])) {
			$article->setVar("permission", $_POST["permission"]);
		}

		if (isset($jieqiOption["article"]["isshort"]["items"][$_POST["isshort"]])) {
			$article->setVar("isshort", $_POST["isshort"]);
		}

		if (isset($jieqiOption["article"]["inmatch"]["items"][$_POST["inmatch"]])) {
			$article->setVar("inmatch", $_POST["inmatch"]);
		}

		$rgroup = 0;
		if (isset($jieqiSort["article"][$_POST["sortid"]]["group"]) && (0 <= $jieqiSort["article"][$_POST["sortid"]]["group"])) {
			$rgroup = intval($jieqiSort["article"][$_POST["sortid"]]["group"]);
		}
		else if (isset($_POST["rgroup"])) {
			$rgroup = intval($_POST["rgroup"]);
		}

		if (isset($jieqiOption["article"]["rgroup"]["items"][$rgroup])) {
			$article->setVar("rgroup", $rgroup);
		}

		$_POST["progress"] = intval($_POST["progress"]);

		if (isset($jieqiOption["article"]["progress"]["items"][$_POST["progress"]])) {
			$article->setVar("progress", $_POST["progress"]);
			$tmpvar = -1;

			foreach ($jieqiOption["article"]["progress"]["items"] as $k => $v ) {
				if ($tmpvar < $k) {
					$tmpvar = $k;
				}
			}

			if (!isset($_POST["fullflag"])) {
				$_POST["fullflag"] = ($_POST["progress"] == $tmpvar ? 1 : 0);
			}
		}

		$article->setVar("fullflag", intval($_POST["fullflag"]));
		$article->setVar("sortid", $_POST["sortid"]);
		$article->setVar("typeid", $_POST["typeid"]);
		$article->setVar("intro", $_POST["intro"]);
		$article->setVar("notice", $_POST["notice"]);
		$old_imgflag = $article->getVar("imgflag");
		$imgflag = $old_imgflag;
		$imgtary = array(1 => ".gif", 2 => ".jpg", 3 => ".jpeg", 4 => ".png", 5 => ".bmp");

		if (!empty($_FILES["articlespic"]["name"])) {
			$imgflag = $imgflag | 1;
			$tmpvar = intval(array_search($simage_postfix, $imgtary));

			if (0 < $tmpvar) {
				$imgflag = ($imgflag & 227) | ($tmpvar * 4);
			}
		}

		if (!empty($_FILES["articlelpic"]["name"])) {
			$imgflag = $imgflag | 2;
			$tmpvar = intval(array_search($limage_postfix, $imgtary));

			if (0 < $tmpvar) {
				$imgflag = ($imgflag & 31) | ($tmpvar * 32);
			}
		}

		$article->setVar("imgflag", $imgflag);

		if (0 < $jieqiConfigs["article"]["eachlinknum"]) {
			$_POST["eachlinkids"] = trim($_POST["eachlinkids"]);
			$setting = unserialize($article->getVar("setting", "n"));

			if (!empty($setting["eachlink"]["ids"])) {
				$linkvalue = implode(" ", $setting["eachlink"]["ids"]);
			}
			else {
				$linkvalue = "";
			}

			if ($linkvalue != $_POST["eachlinkids"]) {
				$tmpary = array_unique(explode(" ", $_POST["eachlinkids"]));

				foreach ($tmpary as $k => $v ) {
					if (!is_numeric($v)) {
						unset($tmpary[$k]);
					}
					else {
						$tmpary[$k] = intval($tmpary[$k]);
					}
				}

				$linkids = array();
				$linknames = array();

				if (count(0 < $tmpary)) {
					$sql = "SELECT articleid, articlename FROM " . jieqi_dbprefix("article_article") . " WHERE articleid IN (" . implode(",", $tmpary) . ")";
					$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
					$query->execute($sql);
					$linknum = 0;
					while (($arow = $query->getRow()) && ($linknum < $jieqiConfigs["article"]["eachlinknum"])) {
						if ($arow["articleid"] != $article->getVar("articleid", "n")) {
							$linkids[$linknum] = $arow["articleid"];
							$linknames[$linknum] = $arow["articlename"];
							$linknum++;
						}
					}
				}

				$setting["eachlink"]["ids"] = $linkids;
				$setting["eachlink"]["names"] = $linknames;
				$article->setVar("setting", serialize($setting));
			}
		}

		if ($allowmodify) {
			if (isset($_POST["poster"]) && (0 < strlen($_POST["poster"]))) {
				include_once (JIEQI_ROOT_PATH . "/class/users.php");
				$users_handler = &JieqiUsersHandler::getInstance("JieqiUsersHandler");
				$posterobj = $users_handler->getByname($_POST["poster"], 3);

				if (is_object($posterobj)) {
					$article->setVar("poster", $posterobj->getVar("name", "n"));
					$article->setVar("posterid", $posterobj->getVar("uid", "n"));
				}
			}

			$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");

			if (isset($jieqiOption["article"]["monthly"]["items"][$_POST["monthly"]])) {
				$_POST["monthly"] = intval($_POST["monthly"]);
				$article->setVar("monthly", $_POST["monthly"]);
				$sql = "UPDATE " . jieqi_dbprefix("obook_obook") . " SET canbesp = " . $_POST["monthly"] . " WHERE articleid = " . intval($article->getVar("articleid", "n"));
				$query->execute($sql);
			}

			if (isset($jieqiOption["article"]["buyout"]["items"][$_POST["buyout"]])) {
				$article->setVar("buyout", $_POST["buyout"]);
			}

			if (isset($jieqiOption["article"]["discount"]["items"][$_POST["discount"]])) {
				$article->setVar("discount", $_POST["discount"]);
			}

			if (isset($jieqiOption["article"]["quality"]["items"][$_POST["quality"]])) {
				$article->setVar("quality", $_POST["quality"]);
			}

			if (isset($jieqiOption["article"]["isshare"]["items"][$_POST["isshare"]])) {
				$article->setVar("isshare", $_POST["isshare"]);
			}

			if (isset($jieqiOption["article"]["rgroup"]["items"][$_POST["rgroup"]])) {
				$article->setVar("rgroup", $_POST["rgroup"]);
			}

			if (isset($jieqiOption["article"]["ispub"]["items"][$_POST["ispub"]])) {
				$article->setVar("ispub", $_POST["ispub"]);
			}
			
			if (isset($jieqiOption["article"]["isvip"]["items"][$_POST["isvip"]])) {
				$article->setVar("isvip", $_POST["isvip"]);
			}

			if (isset($_POST["issign"])) {
				$_POST["issign"] = intval($_POST["issign"]);
				$article->setVar("issign", $_POST["issign"]);

				if (10 <= $_POST["issign"]) {
					if (intval($article->getVar("signtime", "n")) == 0) {
						$article->setVar("signtime", JIEQI_NOW_TIME);
					}
                  if($_POST["isvip"] >= 1){
					if (intval($article->getVar("isvip", "n")) == 0) {
						$article->setVar("isvip", 1);
					}

					if (intval($article->getVar("vipid", "n")) == 0) {
						$sql = "SELECT * FROM " . jieqi_dbprefix("obook_obook") . " WHERE obookname = '" . jieqi_dbslashes($article->getVar("articlename", "n")) . "' LIMIT 0,1";
						$query->execute($sql);
						$obookrow = $query->getRow();
						if (is_array($obookrow) && !empty($obookrow["articleid"])) {
							$sql = "SELECT * FROM " . jieqi_dbprefix("article_article") . " WHERE articleid = " . intval($obookrow["articleid"]) . " LIMIT 0,1";
							$query->execute($sql);
							$articlerow = $query->getRow();
							if (!$articlerow || ($articlerow["articleid"] == $article->getVar("articleid", "n"))) {
								$article->setVar("viptime", $obookrow["lastupdate"]);
								$article->setVar("vipid", $obookrow["obookid"]);
								$article->setVar("vipchapters", $obookrow["chapters"]);
								$article->setVar("vipsize", $obookrow["size"]);
								$article->setVar("vipvolumeid", $obookrow["lastvolumeid"]);
								$article->setVar("vipvolume", $obookrow["lastvolume"]);
								$article->setVar("vipchapterid", $obookrow["lastchapterid"]);
								$article->setVar("vipchapter", $obookrow["lastchapter"]);
								$article->setVar("vipsummary", $obookrow["lastsummary"]);

								if (!$articlerow) {
									$sql = "UPDATE " . jieqi_dbprefix("obook_obook") . " SET articleid = " . intval($article->getVar("articleid", "n")) . " WHERE obookid = " . intval($obookrow["obookid"]);
									$query->execute($sql);
									$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET articleid = " . intval($article->getVar("articleid", "n")) . " WHERE obookid = " . intval($obookrow["obookid"]);
									$query->execute($sql);
									$sql = "UPDATE " . jieqi_dbprefix("obook_paidlog") . " SET articleid = " . intval($article->getVar("articleid", "n")) . " WHERE obookid = " . intval($obookrow["obookid"]);
									$query->execute($sql);
								}
							}
						}
					}
				  }
				}
				else if (0 < $_POST["issign"]) {
					if (intval($article->getVar("signtime", "n")) == 0) {
						$article->setVar("signtime", JIEQI_NOW_TIME);
					}

					if ((0 < intval($article->getVar("isvip", "n"))) && (intval($article->getVar("vipchapters", "n")) == 0)) {
						$article->setVar("isvip", 0);
					}
				}
				else if ($_POST["issign"] == 0) {
					if (0 < intval($article->getVar("signtime", "n"))) {
						$article->setVar("signtime", 0);
					}

					if ((0 < intval($article->getVar("isvip", "n"))) && (intval($article->getVar("vipchapters", "n")) == 0)) {
						$article->setVar("isvip", 0);
					}
				}
			}

			if ((0 < $_POST["issign"]) && isset($_POST["publishid"]) && isset($jieqiPublisher[$_POST["publishid"]])) {
				$article->setVar("vippubid", intval($_POST["publishid"]));
				$sql = "UPDATE " . jieqi_dbprefix("obook_obook") . " SET publishid = " . intval($_POST["publishid"]) . " WHERE articleid = " . intval($article->getVar("articleid", "n"));
				$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
				$query->execute($sql);
			}

			if (2 <= floatval(JIEQI_VERSION)) {
				$statary = array("dayvisit", "weekvisit", "monthvisit", "allvisit", "dayvote", "weekvote", "monthvote", "allvote", "dayflower", "weekflower", "monthflower", "allflower", "dayegg", "weekegg", "monthegg", "allegg", "dayvipvote", "weekvipvote", "monthvipvote", "allvipvote");
			}
			else {
				$statary = array("dayvisit", "weekvisit", "monthvisit", "allvisit", "dayvote", "weekvote", "monthvote", "allvote");
			}

			foreach ($statary as $v ) {
				if (isset($_POST[$v])) {
					$article->setVar($v, intval($_POST[$v]));
				}
			}
		}

		if (!$article_handler->insert($article)) {
			jieqi_printfail($jieqiLang["article"]["article_edit_failure"]);
		}
		else {
			$id = $article->getVar("articleid", "n");
			$vipid = intval($article->getVar("vipid", "n"));

			if (0 < $vipid) {
				$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
				$sql = "UPDATE " . jieqi_dbprefix("obook_obook") . " SET obookname = '" . jieqi_dbslashes($article->getVar("articlename", "n")) . "', keywords = '" . jieqi_dbslashes($article->getVar("keywords", "n")) . "', initial = '" . jieqi_dbslashes($article->getVar("initial", "n")) . "', sortid = " . intval($article->getVar("sortid", "n")) . ", intro = '" . jieqi_dbslashes($article->getVar("intro", "n")) . "', notice = '" . jieqi_dbslashes($article->getVar("notice", "n")) . "', authorid = " . intval($article->getVar("authorid", "n")) . ", author = '" . jieqi_dbslashes($article->getVar("author", "n")) . "', agentid = " . intval($article->getVar("agentid", "n")) . ", agent = '" . jieqi_dbslashes($article->getVar("agent", "n")) . "', posterid = " . intval($article->getVar("posterid", "n")) . ", poster = '" . jieqi_dbslashes($article->getVar("poster", "n")) . "', publishid = " . intval($article->getVar("vippubid", "n")) . ", imgflag = " . intval($article->getVar("imgflag", "n")) . " WHERE obookid = " . $vipid;
				$query->execute($sql);
				$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET obookname = '" . jieqi_dbslashes($article->getVar("articlename", "n")) . "' WHERE obookid = " . $vipid;
				$query->execute($sql);
			}

			if (2 <= floatval(JIEQI_VERSION)) {
				jieqi_tag_update($oldtags, $tagary, $id, array("tag" => jieqi_dbprefix("article_tag"), "taglink" => jieqi_dbprefix("article_taglink")));
			}

			include_once ($jieqiModules["article"]["path"] . "/class/package.php");
			$package = new JieqiPackage($id);
			$package->editPackage($article->getVars("n"), true);
			include_once ($jieqiModules["article"]["path"] . "/include/funarticle.php");

			if ($old_imgflag != $imgflag) {
				$tmpvar = ($old_imgflag >> 2) & 7;

				if (isset($imgtary[$tmpvar])) {
					if (is_file($package->getDir("imagedir") . "/" . $id . "s" . $imgtary[$tmpvar])) {
						jieqi_delfile($package->getDir("imagedir") . "/" . $id . "s" . $imgtary[$tmpvar]);
					}
				}

				$tmpvar = $old_imgflag >> 5;

				if (isset($imgtary[$tmpvar])) {
					if (is_file($package->getDir("imagedir") . "/" . $id . "l" . $imgtary[$tmpvar])) {
						jieqi_delfile($package->getDir("imagedir") . "/" . $id . "l" . $imgtary[$tmpvar]);
					}
				}
			}

			if (!empty($_FILES["articlespic"]["name"])) {
				jieqi_article_coverdo($_FILES["articlespic"], "s");
				jieqi_copyfile($_FILES["articlespic"]["tmp_name"], $package->getDir("imagedir") . "/" . $id . "s" . $simage_postfix, 511, true);
			}

			if (!empty($_FILES["articlelpic"]["name"])) {
				jieqi_article_coverdo($_FILES["articlelpic"], "l");
				jieqi_copyfile($_FILES["articlelpic"]["tmp_name"], $package->getDir("imagedir") . "/" . $id . "l" . $limage_postfix, 511, true);
			}

			if (JIEQI_USE_CACHE) {
				if (!is_a($jieqiTpl, "JieqiTpl")) {
					include_once (JIEQI_ROOT_PATH . "/lib/template/template.php");
					$jieqiTpl = &JieqiTpl::getInstance();
				}

				$jieqiTpl->clear_cache($jieqiModules["article"]["path"] . "/templates/articleinfo.html", $id);
			}

			if (0 < $jieqiConfigs["article"]["fakestatic"]) {
				include_once ($jieqiModules["article"]["path"] . "/include/funstatic.php");
				article_update_static("articleedit", $id, $article->getVar("sortid", "n"));
			}

			jieqi_jumppage($article_static_url . "/articlemanage.php?id=" . $id, LANG_DO_SUCCESS, $jieqiLang["article"]["article_edit_success"]);
		}
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case "edit":
default:
	include_once (JIEQI_ROOT_PATH . "/admin/header.php");
	include_once ($jieqiModules["article"]["path"] . "/include/funarticle.php");
	$jieqiTpl->assign("article_static_url", $article_static_url);
	$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
	$jieqiTpl->assign("url_articleedit", $JIEQI_URL  . "/modules/article/admin/articleedit-admin.php?do=submit");
	jieqi_getconfigs(JIEQI_MODULE_NAME, "sort", "jieqiSort");
	$jieqiTpl->assign("sortrows", jieqi_funtoarray("jieqi_htmlstr", $jieqiSort["article"]));

	foreach ($jieqiOption["article"] as $k => $v ) {
		$jieqiTpl->assign_by_ref($k, $jieqiOption["article"][$k]);
	}

	$articlevals = jieqi_article_vars($article, true, "e");

	if (0 < $article->getVar("authorid")) {
		$articlevals["authorflag"] = 1;
	}
	else {
		$articlevals["authorflag"] = 0;
	}

	$jieqiTpl->assign("eachlinknum", $jieqiConfigs["article"]["eachlinknum"]);

	if (0 < $jieqiConfigs["article"]["eachlinknum"]) {
		$setting = unserialize($article->getVar("setting", "n"));

		if (!empty($setting["eachlink"]["ids"])) {
			$articlevals["eachlinkids"] = implode(" ", $setting["eachlink"]["ids"]);
		}
		else {
			$articlevals["eachlinkids"] = "";
		}
	}

	$jieqiTpl->assign_by_ref("articlevals", $articlevals);

	if (2 <= floatval(JIEQI_VERSION)) {
		include_once (JIEQI_ROOT_PATH . "/include/funtag.php");
		$oldtags = jieqi_tag_clean($article->getVar("keywords", "n"));
		$jieqiTpl->assign("taglimit", intval($jieqiConfigs["article"]["taglimit"]));
		$tagwords = array();
		$tmpary = preg_split("/\s+/s", $jieqiConfigs["article"]["tagwords"]);
		$k = 0;

		foreach ($tmpary as $v ) {
			if (0 < strlen($v)) {
				$tagwords[$k]["name"] = jieqi_htmlstr($v);
				$tagwords[$k]["use"] = (in_array($v, $oldtags) ? 1 : 0);
				$k++;
			}
		}

		$jieqiTpl->assign_by_ref("tagwords", $tagwords);
		$jieqiTpl->assign_by_ref("tagnum", count($tagwords));
	}

	if (jieqi_checkpower($jieqiPower["article"]["transarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true)) {
		$jieqiTpl->assign("allowtrans", 1);
	}
	else {
		$jieqiTpl->assign("allowtrans", 0);
	}

	$jieqiTpl->assign("imagetype", $jieqiConfigs["article"]["imagetype"]);
	$jieqiTpl->assign("allowmodify", $allowmodify);
	$jieqiTpl->assign("ismanager", $ismanager);

	if (2 <= floatval(JIEQI_VERSION)) {
		$jieqiTpl->assign("publisherrows", jieqi_funtoarray("jieqi_htmlstr", $jieqiPublisher));
		$publishid = $article->getVar("vippubid", "n");
		if ((0 < $article->getVar("issign", "n")) && (0 < $article->getVar("vipid", "n"))) {
			$obookid = intval($article->getVar("vipid", "n"));
			include_once ($jieqiModules["obook"]["path"] . "/class/obook.php");
			$obook_handler = &JieqiObookHandler::getInstance("JieqiObookHandler");
			$obook = $obook_handler->get($obookid);

			if (is_object($obook)) {
				$publishid = $obook->getVar("publishid", "n");
			}
		}

		$jieqiTpl->assign("publishid", $publishid);
	}

	$jieqiTpl->assign("authorarea", 1);
	$jieqiTpl->setCaching(0);
	$jieqiTset["jieqi_contents_template"] = $jieqiModules["article"]["path"] . "/templates/admin/articleedit-admin.html";
	include_once (JIEQI_ROOT_PATH . "/admin/footer.php");
	break;
}

?>

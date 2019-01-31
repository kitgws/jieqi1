<?php
//zend53   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

function jieqi_sync_articleinfo($sync_article)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $article_handler;
	global $jieqi_checker;

	if (!isset($jieqiConfigs["system"])) {
		jieqi_getconfigs("system", "configs");
	}

	if (!is_a($jieqi_checker, "JieqiChecker")) {
		include_once (JIEQI_ROOT_PATH . "/include/checker.php");
		$jieqi_checker = new JieqiChecker();
	}

	if (!isset($jieqiConfigs["article"])) {
		jieqi_getconfigs("article", "configs", "jieqiConfigs");
	}

	if (!is_a($article_handler, "JieqiArticleHandler")) {
		include_once ($jieqiModules["article"]["path"] . "/class/article.php");
		$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
	}

	$sync_article = jieqi_funtoarray("trim", $sync_article);
	$keywords = (isset($sync_article["keywords"]) ? $sync_article["keywords"] : "");
	$intro = (isset($sync_article["intro"]) ? $sync_article["intro"] : "");
	$notice = (isset($sync_article["notice"]) ? $sync_article["notice"] : "");
	if (isset($jieqiConfigs["system"]["postreplacewords"]) && !empty($jieqiConfigs["system"]["postreplacewords"])) {
		if (!empty($keywords)) {
			$jieqi_checker->replace_words($keywords, $jieqiConfigs["system"]["postreplacewords"]);
		}

		if (!empty($intro)) {
			$jieqi_checker->replace_words($intro, $jieqiConfigs["system"]["postreplacewords"]);
		}

		if (!empty($notice)) {
			$jieqi_checker->replace_words($notice, $jieqiConfigs["system"]["postreplacewords"]);
		}
	}

	include_once (JIEQI_ROOT_PATH . "/lib/text/textfunction.php");
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria("siteid", $sync_article["siteid"]));
	$criteria->add(new Criteria("sourceid", $sync_article["sourceid"]));
	$criteria->setLimit(1);
	$article_handler->queryObjects($criteria);
	$article = $article_handler->getObject();
	$updatecode = false;
	$articlecode = jieqi_getpinyin($sync_article["articlename"]);

	if (!preg_match("/^[a-z]/i", $articlecode)) {
		$articlecode = "i" . $articlecode;
	}

	if (!is_object($article)) {
		$article = $article_handler->create();
		$article->setVar("siteid", $sync_article["siteid"]);
		$article->setVar("sourceid", $sync_article["sourceid"]);
		$article->setVar("postdate", JIEQI_NOW_TIME);
		$article->setVar("lastupdate", $sync_article["lastupdate"]);
		$article->setVar("sortid", $sync_article["sortid"]);
		$article->setVar("typeid", $sync_article["typeid"]);
		$article->setVar("rgroup", $sync_article["rgroup"]);
		$article->setVar("articlename", $sync_article["articlename"]);

		if (0 < $article_handler->getCount(new Criteria("articlecode", $articlecode, "="))) {
			$updatecode = true;
		}
		else {
			$article->setVar("articlecode", $articlecode);
		}

		$article->setVar("initial", jieqi_getinitial($sync_article["articlename"]));
		$article->setVar("author", $sync_article["author"]);
		$article->setVar("authorid", $sync_article["authorid"]);

		if (!empty($_SESSION["jieqiUserId"])) {
			$article->setVar("posterid", $_SESSION["jieqiUserId"]);
			$article->setVar("poster", $_SESSION["jieqiUserName"]);
		}
		else {
			$article->setVar("posterid", 0);
			$article->setVar("poster", "");
		}

		$article->setVar("keywords", $keywords);
		$article->setVar("permission", $sync_article["permission"]);
		$article->setVar("firstflag", $sync_article["firstflag"]);
		$article->setVar("intro", $intro);
		$article->setVar("notice", $notice);
		$article->setVar("fullflag", $sync_article["fullflag"]);
		$article->setVar("isvip", $sync_article["isvip"]);
		$imgret = jieqi_sync_getcover($sync_article["cover"]);

		if (is_array($imgret)) {
			$article->setVar("imgflag", (intval($imgret["imgflag"]) * 4) + 1);
			$setting = array();
			$setting["cover"] = $sync_article["cover"];
			$article->setVar("setting", serialize($setting));
		}
		else {
			$article->setVar("imgflag", 0);
		}
	}
	else {
		$article->setVar("lastupdate", $sync_article["lastupdate"]);
		$article->setVar("sortid", $sync_article["sortid"]);
		$article->setVar("typeid", $sync_article["typeid"]);
		$article->setVar("rgroup", $sync_article["rgroup"]);
		$article->setVar("articlename", $sync_article["articlename"]);

		if ($articlecode != $article->getVar("articlecode", "n")) {
			if (0 < $article_handler->getCount(new Criteria("articlecode", $articlecode, "="))) {
				$articlecode .= "_" . $article->getVar("articleid", "n");
			}

			$article->setVar("articlecode", $articlecode);
		}

		$article->setVar("initial", jieqi_getinitial($sync_article["articlename"]));
		$article->setVar("author", $sync_article["author"]);

		if (isset($sync_article["keywords"])) {
			$article->setVar("keywords", $keywords);
		}

		if (isset($sync_article["intro"])) {
			$article->setVar("intro", $intro);
		}

		if (isset($sync_article["notice"])) {
			$article->setVar("notice", $notice);
		}

		$article->setVar("fullflag", $sync_article["fullflag"]);

		if ($article->getVar("imgflag", "n") == 0) {
			$imgret = jieqi_sync_getcover($sync_article["cover"]);

			if (is_array($imgret)) {
				$article->setVar("imgflag", (intval($imgret["imgflag"]) * 4) + 1);
				$setting = unserialize($article->getVar("setting", "n"));
				$setting["cover"] = $sync_article["cover"];
				$article->setVar("setting", serialize($setting));
			}
		}
	}

	$ret = $article_handler->insert($article);

	if ($ret) {
		if ($updatecode) {
			$articlecode .= "_" . $article->getVar("articleid", "n");
			$article_handler->updatefields(array("articlecode" => $articlecode), new Criteria("articleid", $article->getVar("articleid", "n"), "="));
		}
	}

	if ($ret && isset($imgret["imgdata"]) && in_array($imgret["imgtype"], array(".gif", ".jpg", ".jpeg", ".png", ".bmp"))) {
		$articleid = intval($article->getVar("articleid", "n"));
		$imgdir = jieqi_uploadpath($jieqiConfigs["article"]["imagedir"], "article") . jieqi_getsubdir($articleid) . "/" . $articleid;
		jieqi_checkdir($imgdir, true);
		$imgdir .= "/" . $articleid . "s" . $imgret["imgtype"];
		jieqi_writefile($imgdir, $imgret["imgdata"]);
	}

	if ($ret) {
		return $article;
	}
	else {
		return false;
	}
}

function jieqi_sync_getcover($cover)
{
	if (preg_match("/^https?:\/\/[^\s\\r\\n\\t\\f<>]+(\.gif|\.jpg|\.jpeg|\.png|\.bmp)$/i", $cover, $matches)) {
		$imgtary = array(".gif" => 1, ".jpg" => 2, ".jpeg" => 3, ".png" => 4, ".bmp" => 5);

		if (!isset($imgtary[$matches[1]])) {
			return false;
		}

		$ret = array("imgflag" => $imgtary[$matches[1]], "imgtype" => $matches[1]);
		$ret["imgdata"] = jieqi_sync_geturlcontent($cover);

		if (!$ret["imgdata"]) {
			return false;
		}
		else {
			return $ret;
		}
	}
	else {
		return false;
	}
}

function jieqi_sync_geturlcontent($url)
{
	if (!preg_match("/^http/", $url)) {
		return false;
	}
	else {
            $curl=new Http_Curl($url,60);
            $content = $curl->createCurl();
            while (!$content) {
                ++$i;
                $content = $curl->createCurl();
                if ($i>3)        break;
            }
            $str = urlencode($content);
            $head = strtolower(substr($str, 0,6));
            if ($head == '%1f%8b') {
                $gz = gzinflate(substr($content,10,-8));
                if ($gz) {
                    $content = $gz;
                }
            }
            return $content;
	}
}

function jieqi_sync_chapterupdate($sync_chapter, $old_chapter)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiLang;
	global $query;
	global $article_handler;
	global $chapter_handler;
	global $obook_handler;
	global $ochapter_handler;
	global $jieqi_checker;

	if (!isset($jieqiConfigs["system"])) {
		jieqi_getconfigs("system", "configs");
	}

	if (!is_a($jieqi_checker, "JieqiChecker")) {
		include_once (JIEQI_ROOT_PATH . "/include/checker.php");
		$jieqi_checker = new JieqiChecker();
	}

	$sync_chapter = jieqi_funtoarray("trim", $sync_chapter);
	$upfields = array();

	if ($sync_chapter["chapterorder"] != $old_chapter["chapterorder"]) {
		$upfields["chapterorder"] = $sync_chapter["chapterorder"];
	}

	if ($sync_chapter["chaptername"] != $old_chapter["chaptername"]) {
		$upfields["chaptername"] = $sync_chapter["chaptername"];
	}

	if ($sync_chapter["size"] != $old_chapter["size"]) {
		$upfields["size"] = $sync_chapter["size"];
	}

	if ($sync_chapter["saleprice"] != $old_chapter["saleprice"]) {
		$upfields["saleprice"] = $sync_chapter["saleprice"];
	}

	if ($sync_chapter["lastupdate"] != $old_chapter["lastupdate"]) {
		$upfields["lastupdate"] = $sync_chapter["lastupdate"];
	}

	if ($sync_chapter["isvip"] != $old_chapter["isvip"]) {
		$upfields["isvip"] = $sync_chapter["isvip"];
	}

	if (empty($upfields)) {
		return false;
	}

	if ($sync_chapter["summary"] != $old_chapter["summary"]) {
		$upfields["summary"] = $sync_chapter["summary"];
	}

	if ((isset($upfields["isvip"]) && ($upfields["isvip"] == 0)) || (isset($upfields["size"]) && ($sync_chapter["isvip"] == 0))) {
		if (0 < strlen($sync_chapter["url_content"])) {
			$uc_content = json_decode(jieqi_sync_geturlcontent($sync_chapter["url_content"]),true);
                        $uc_content = iconv("UTF-8","GBK//IGNORE",$uc_content["content"]);
			if ($uc_content === false) {
				return sprintf($jieqiLang["article"]["sync_chaptercontent_failure"], jieqi_htmlstr($sync_chapter["chaptername"]) . "<br />URL:" . $sync_chapter["url_content"]);
			}

			if (isset($jieqiConfigs["system"]["postreplacewords"]) && !empty($jieqiConfigs["system"]["postreplacewords"])) {
				$jieqi_checker->replace_words($uc_content, $jieqiConfigs["system"]["postreplacewords"]);
			}

			include_once ($jieqiModules["article"]["path"] . "/class/package.php");
			jieqi_save_achapterc($old_chapter["articleid"], $old_chapter["chapterid"], $uc_content, 0);
		}
	}

	if (!is_a($query, "JieqiQueryHandler")) {
		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
	}

	$sql = $query->makeupsql(jieqi_dbprefix("article_chapter"), $upfields, "UPDATE", array("chapterid" => $old_chapter["chapterid"]));
	$query->execute($sql);

	if (isset($upfields["isvip"])) {
		if ($upfields["isvip"] == 0) {
			$sql = "SELECT * FROM " . jieqi_dbprefix("obook_ochapter") . " WHERE chapterid = {$old_chapter["chapterid"]} LIMIT 0, 1";
			$query->execute($sql);
			$row = $query->getRow();

			if (is_array($row)) {
				if ($row["sumegold"] == 0) {
					$sql = "DELETE FROM " . jieqi_dbprefix("obook_ochapter") . " WHERE chapterid = {$old_chapter["chapterid"]}";
					$query->execute($sql);
					$sql = "DELETE FROM " . jieqi_dbprefix("obook_ocontent") . " WHERE ochapterid = {$old_chapter["chapterid"]}";
					$query->execute($sql);
				}
				else {
					$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET display = 2 WHERE chapterid = {$old_chapter["chapterid"]}";
					$query->execute($sql);
				}
			}
		} else {
			include_once ($jieqiModules["article"]["path"] . "/class/package.php");
			jieqi_delete_achapterc($old_chapter["articleid"], $old_chapter["chapterid"], 0);

			if (!is_a($ochapter_handler, "JieqiOchapterHandler")) {
				include_once ($jieqiModules["obook"]["path"] . "/class/ochapter.php");
				$ochapter_handler = &JieqiOchapterHandler::getInstance("JieqiOchapterHandler");
			}

			$ochapter = $ochapter_handler->get($old_chapter["chapterid"], "chapterid");

			if (is_object($ochapter)) {
				$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET lastupdate = '" . intval($sync_chapter["lastupdate"]) . "', chaptername = '" . jieqi_dbslashes($sync_chapter["chaptername"]) . "', summary = '" . jieqi_dbslashes($sync_chapter["summary"]) . "', size = '" . intval($sync_chapter["size"]) . "', saleprice = '" . intval($sync_chapter["saleprice"]) . "', display = 0 WHERE chapterid = " . intval($old_chapter["chapterid"]);
				$query->execute($sql);
                                $uc_content = json_decode(jieqi_sync_geturlcontent($sync_chapter["url_content"]),true);
                                $uc_content = iconv("UTF-8","GBK//IGNORE",$uc_content["content"]);
                                if ($uc_content === false) {
                                        return sprintf($jieqiLang["article"]["sync_chaptercontent_failure"], jieqi_htmlstr($sync_chapter["chaptername"]) . "<br />URL:" . $sync_chapter["url_content"]);
                                } else {
                                    $sql = "DELETE FROM " . jieqi_dbprefix("obook_ocontent") . " WHERE ochapterid = {$old_chapter["chapterid"]}";
                                    $query->execute($sql);
                                    $sql = "insert into " . jieqi_dbprefix("obook_ocontent") . " (`ochapterid`, `ocontent`) values ('{$old_chapter["chapterid"]}','$uc_content')";
                                    $query->execute($sql);
                                }
			}
			else {
				$ochapter = $ochapter_handler->create();
				$ochapter->setVar("ochapterid", $old_chapter["chapterid"]);
				$ochapter->setVar("siteid", $old_chapter["siteid"]);
				$ochapter->setVar("sourceid", $old_chapter["sourceid"]);
				$ochapter->setVar("sourcecid", $old_chapter["sourcecid"]);
				$ochapter->setVar("sourcecorder", $old_chapter["sourcecorder"]);
				$ochapter->setVar("obookid", $old_chapter["obookid"]);
				$ochapter->setVar("articleid", $old_chapter["articleid"]);
				$ochapter->setVar("chapterid", $old_chapter["chapterid"]);
				$ochapter->setVar("postdate", $old_chapter["postdate"]);
				$ochapter->setVar("lastupdate", $sync_chapter["lastupdate"]);
				$ochapter->setVar("obookname", $old_chapter["articlename"]);
				$ochapter->setVar("chaptername", $sync_chapter["chaptername"]);
				$ochapter->setVar("chapterorder", $sync_chapter["chapterorder"]);
				$ochapter->setVar("summary", $sync_chapter["summary"]);
				$ochapter->setVar("size", $sync_chapter["size"]);
				$ochapter->setVar("pages", $old_chapter["pages"]);
				$ochapter->setVar("posterid", $old_chapter["posterid"]);
				$ochapter->setVar("poster", $old_chapter["poster"]);
				$ochapter->setVar("picflag", $old_chapter["isimage"]);
				$ochapter->setVar("chaptertype", $old_chapter["chaptertype"]);
				$ochapter->setVar("saleprice", $sync_chapter["saleprice"]);
				$ochapter->setVar("vipprice", $sync_chapter["saleprice"]);
				$oinfo = $ochapter_handler->insert($ochapter);
                                
                                $uc_content = json_decode(jieqi_sync_geturlcontent($sync_chapter["url_content"]),true);
                                $uc_content = iconv("UTF-8","GBK//IGNORE",$uc_content["content"]);
                                if ($uc_content === false) {
                                        return sprintf($jieqiLang["article"]["sync_chaptercontent_failure"], jieqi_htmlstr($sync_chapter["chaptername"]) . "<br />URL:" . $sync_chapter["url_content"]);
                                } else {
                                    $sql = "DELETE FROM " . jieqi_dbprefix("obook_ocontent") . " WHERE ochapterid = {$old_chapter["chapterid"]}";
                                    $query->execute($sql);
                                    $sql = "insert into " . jieqi_dbprefix("obook_ocontent") . " (`ochapterid`, `ocontent`) values ('{$old_chapter["chapterid"]}','$uc_content')";
                                    $query->execute($sql);
                                }                               
			}
		}
	}
	else {
		if ((0 < $sync_chapter["isvip"]) && (0 < count($upfields))) {
			$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET lastupdate = '" . intval($sync_chapter["lastupdate"]) . "', chaptername = '" . jieqi_dbslashes($sync_chapter["chaptername"]) . "', summary = '" . jieqi_dbslashes($sync_chapter["summary"]) . "', size = '" . intval($sync_chapter["size"]) . "', saleprice = '" . intval($sync_chapter["saleprice"]) . "', display = 0 WHERE chapterid = " . intval($old_chapter["chapterid"]);
			$query->execute($sql);
                        $uc_content = json_decode(jieqi_sync_geturlcontent($sync_chapter["url_content"]),true);
                        $uc_content = iconv("UTF-8","GBK//IGNORE",$uc_content["content"]);
                        if ($uc_content === false) {
                                return sprintf($jieqiLang["article"]["sync_chaptercontent_failure"], jieqi_htmlstr($sync_chapter["chaptername"]) . "<br />URL:" . $sync_chapter["url_content"]);
                        } else {
                            $sql = "DELETE FROM " . jieqi_dbprefix("obook_ocontent") . " WHERE ochapterid = {$old_chapter["chapterid"]}";
                            $query->execute($sql);
                            $sql = "insert into " . jieqi_dbprefix("obook_ocontent") . " (`ochapterid`, `ocontent`) values ('{$old_chapter["chapterid"]}','$uc_content')";
                            $query->execute($sql);
                        }
		}
	}

	return true;
}

function jieqi_sync_chapternew($sync_chapter, $article)
{
	global $jieqiModules;
	global $jieqiConfigs;
	global $jieqiLang;
	global $query;
	global $article_handler;
	global $chapter_handler;
	global $obook_handler;
	global $ochapter_handler;
	global $jieqi_checker;

	if (!isset($jieqiConfigs["system"])) {
		jieqi_getconfigs("system", "configs");
	}

	if (!is_a($jieqi_checker, "JieqiChecker")) {
		include_once (JIEQI_ROOT_PATH . "/include/checker.php");
		$jieqi_checker = new JieqiChecker();
	}

	if (!is_a($article_handler, "JieqiChapterHandler")) {
		include_once ($jieqiModules["article"]["path"] . "/class/chapter.php");
		$chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
	}

	$sync_chapter = jieqi_funtoarray("trim", $sync_chapter);
	$uc_content = "";
	if (($sync_chapter["isvip"] == 0) && ($sync_chapter["chaptertype"] == 0) && (0 < $sync_chapter["size"])) {
		if (0 < strlen($sync_chapter["url_content"])) {
			$uc_content = json_decode(jieqi_sync_geturlcontent($sync_chapter["url_content"]),true);
                        $uc_content = iconv("UTF-8","GBK//IGNORE",$uc_content["content"]);

			if ($uc_content === false) {
				return sprintf($jieqiLang["article"]["sync_chaptercontent_failure"], jieqi_htmlstr($sync_chapter["chaptername"]) . "<br />URL:" . $sync_chapter["url_content"]);
			}

			if (isset($jieqiConfigs["system"]["postreplacewords"]) && !empty($jieqiConfigs["system"]["postreplacewords"])) {
				$jieqi_checker->replace_words($uc_content, $jieqiConfigs["system"]["postreplacewords"]);
			}
		}
	}

	$newChapter = $chapter_handler->create();
	$newChapter->setVar("siteid", $article->getVar("siteid", "n"));
	$newChapter->setVar("sourceid", $sync_chapter["sourceid"]);
	$newChapter->setVar("sourcecid", $sync_chapter["sourcecid"]);
	$newChapter->setVar("sourcecorder", $sync_chapter["sourcecorder"]);
	$newChapter->setVar("articleid", $article->getVar("articleid", "n"));
	$newChapter->setVar("articlename", $article->getVar("articlename", "n"));
	$newChapter->setVar("volumeid", 0);

	if (!empty($_SESSION["jieqiUserId"])) {
		$newChapter->setVar("posterid", $_SESSION["jieqiUserId"]);
		$newChapter->setVar("poster", $_SESSION["jieqiUserName"]);
	}
	else {
		$newChapter->setVar("posterid", 0);
		$newChapter->setVar("poster", "");
	}

	$newChapter->setVar("postdate", $sync_chapter["lastupdate"]);
	$newChapter->setVar("lastupdate", $sync_chapter["lastupdate"]);
	$newChapter->setVar("chaptername", $sync_chapter["chaptername"]);
	$newChapter->setVar("chapterorder", $sync_chapter["chapterorder"]);
	$newChapter->setVar("size", $sync_chapter["size"]);
	$newChapter->setVar("saleprice", $sync_chapter["saleprice"]);
	$newChapter->setVar("isvip", $sync_chapter["isvip"]);
	$newChapter->setVar("chaptertype", $sync_chapter["chaptertype"]);

	if ($chapter_handler->insert($newChapter)) {
		if ((0 < $newChapter->getVar("isvip", "n")) && ($newChapter->getVar("chaptertype", "n") == 0)) {
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

			if (intval($article->getVar("issign", "n")) < 10) {
				$article->setVar("issign", 10);
			}

			$obookid = intval($article->getVar("vipid", "n"));

			if ($obookid == 0) {
				include_once ($jieqiModules["obook"]["path"] . "/include/actobook.php");
				$obook = jieqi_obook_autocreate($article, 1);

				if (!is_object($obook)) {
					$chapter_handler->delete($newChapter->getVar("chapterid", "n"));
					return $obook;
				}

				$obookid = intval($obook->getVar("obookid", "n"));
			}

			$ochapter = $ochapter_handler->create();
			$ochapter->setVar("ochapterid", $newChapter->getVar("chapterid", "n"));
			$ochapter->setVar("siteid", $newChapter->getVar("siteid", "n"));
			$ochapter->setVar("sourceid", $newChapter->getVar("sourceid", "n"));
			$ochapter->setVar("sourcecid", $newChapter->getVar("sourcecid", "n"));
			$ochapter->setVar("sourcecorder", $newChapter->getVar("sourcecorder", "n"));
			$ochapter->setVar("obookid", $obookid);
			$ochapter->setVar("articleid", $newChapter->getVar("articleid", "n"));
			$ochapter->setVar("chapterid", $newChapter->getVar("chapterid", "n"));
			$ochapter->setVar("postdate", $newChapter->getVar("postdate", "n"));
			$ochapter->setVar("lastupdate", $newChapter->getVar("lastupdate", "n"));
			$ochapter->setVar("obookname", $newChapter->getVar("articlename", "n"));
			$ochapter->setVar("chaptername", $newChapter->getVar("chaptername", "n"));
			$ochapter->setVar("chapterorder", $newChapter->getVar("chapterorder", "n"));
			$ochapter->setVar("summary", $newChapter->getVar("summary", "n"));
			$ochapter->setVar("size", $newChapter->getVar("size", "n"));
			$ochapter->setVar("pages", $newChapter->getVar("pages", "n"));
			$ochapter->setVar("posterid", $newChapter->getVar("posterid", "n"));
			$ochapter->setVar("poster", $newChapter->getVar("poster", "n"));
			$ochapter->setVar("picflag", $newChapter->getVar("isimage", "n"));
			$ochapter->setVar("chaptertype", $newChapter->getVar("chaptertype", "n"));
			$ochapter->setVar("saleprice", $newChapter->getVar("saleprice", "n"));
			$ochapter->setVar("vipprice", $newChapter->getVar("saleprice", "n"));
			$ochapter_handler->insert($ochapter);
                        $uc_content = json_decode(jieqi_sync_geturlcontent($sync_chapter["url_content"]),true);
                        $uc_content = iconv("UTF-8","GBK//IGNORE",$uc_content["content"]);
                        if ($uc_content === false) {
                                return sprintf($jieqiLang["article"]["sync_chaptercontent_failure"], jieqi_htmlstr($sync_chapter["chaptername"]) . "<br />URL:" . $sync_chapter["url_content"]);
                        } else {
                            $sql = "DELETE FROM " . jieqi_dbprefix("obook_ocontent") . " WHERE ochapterid = {$newChapter->getVar("chapterid", "n")}";
                            $query->execute($sql);
                            $sql = "insert into " . jieqi_dbprefix("obook_ocontent") . " (`ochapterid`, `ocontent`) values ('{$newChapter->getVar("chapterid", "n")}','{$uc_content}')";
                            $query->execute($sql);
                        }
		}
		else {
			if (($sync_chapter["isvip"] == 0) && ($sync_chapter["chaptertype"] == 0) && (0 < strlen($sync_chapter["url_content"]))) {
				include_once ($jieqiModules["article"]["path"] . "/class/package.php");
				jieqi_save_achapterc($newChapter->getVar("articleid", "n"), $newChapter->getVar("chapterid", "n"), $uc_content, 0);
			}
		}
	}
	else {
		return $jieqiLang["article"]["sync_chapteradd_failure"];
	}

	return true;
}

function jieqi_sync_delchapters($cids, $article)
{
	global $query;
	global $jieqiConfigs;
	global $jieqiModules;

	if (!isset($jieqiConfigs["article"])) {
		jieqi_getconfigs("article", "configs", "jieqiConfigs");
	}

	if (!is_a($query, "JieqiQueryHandler")) {
		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
	}

	$articleid = intval($article->getVar("articleid", "n"));
	$cidary = array();

	foreach ($cids as $c ) {
		$cidary[] = intval($c["chapterid"]);
	}

	$sql = "DELETE FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid = $articleid AND chapterid IN (" . implode(",", $cidary) . ")";
	$query->execute($sql);
	$sql = "DELETE FROM " . jieqi_dbprefix("article_attachs") . " WHERE articleid = $articleid AND chapterid IN (" . implode(",", $cidary) . ")";
	$query->execute($sql);
	include_once ($jieqiModules["article"]["path"] . "/class/package.php");
	$htmldir = jieqi_uploadpath($jieqiConfigs["article"]["htmldir"], "article") . jieqi_getsubdir($articleid) . "/" . $articleid;
	$txtjsdir = jieqi_uploadpath($jieqiConfigs["article"]["txtjsdir"], "article") . jieqi_getsubdir($articleid) . "/" . $articleid;
	$attachdir = jieqi_uploadpath($jieqiConfigs["article"]["attachdir"], "article") . jieqi_getsubdir($articleid) . "/" . $articleid;

	foreach ($cids as $c ) {
		jieqi_delete_achapterc($articleid, $c["chapterid"], intval($c["isvip"]), intval($c["chaptertype"]));

		if (is_file($htmldir . "/" . $c["chapterid"] . $jieqiConfigs["article"]["htmlfile"])) {
			jieqi_delfile($htmldir . "/" . $c["chapterid"] . $jieqiConfigs["article"]["htmlfile"]);
		}

		if (is_file($txtjsdir . "/" . $c["chapterid"] . $jieqi_file_postfix["js"])) {
			jieqi_delfile($txtjsdir . "/" . $c["chapterid"] . $jieqi_file_postfix["js"]);
		}

		if (is_dir($attachdir . "/" . $c["chapterid"])) {
			jieqi_delfolder($attachdir . "/" . $c["chapterid"]);
		}
	}

	return true;
}






class Http_Curl {
protected $_useragent = 'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)';
     protected $_url; 
     protected $_followlocation; 
     protected $_proxy; 
     protected $_timeout; 
     protected $_maxRedirects; 
     protected $_cookieFileLocation = './cookie.txt'; 
     protected $_post; 
     protected $_postFields; 
     protected $_referer ="http://www.baidu.com"; 
     protected $_hosts='';
     protected $_session; 
     protected $_webpage; 
     protected $_includeHeader =1;
     protected $_noBody; 
     protected $_status; 
     protected $_binaryTransfer; 
     public    $authentication = 0; 
     public    $auth_name      = ''; 
     public    $auth_pass      = ''; 
     public static $_instance = null;
     
     public function useAuth($use){ 
       $this->authentication = 0; 
       if($use == true) $this->authentication = 1; 
     } 

     public function setName($name){ 
       $this->auth_name = $name; 
     } 
     public function setPass($pass){ 
       $this->auth_pass = $pass; 
     } 

     public function __construct($url,$timeOut = 5,$proxy='',$followlocation = true,$maxRedirecs = 4,$binaryTransfer = false,$includeHeader = false,$noBody = false){ 
         $this->_url = $url; 
         $this->_proxy = $proxy; 
         $this->_followlocation = $followlocation; 
         $this->_timeout = $timeOut; 
         $this->_maxRedirects = $maxRedirecs; 
         $this->_noBody = $noBody; 
         $this->_includeHeader = $includeHeader; 
         $this->_binaryTransfer = $binaryTransfer; 
         $this->_cookieFileLocation = dirname(__FILE__).'/cookie.txt'; 
     }
     
 /**    
     public static function getInstance($url,$followlocation = true,$timeOut = 30,$maxRedirecs = 4,$binaryTransfer = false,$includeHeader = false,$noBody = false){
     	if(!(self::$_instance instanceof DCurl)){
     		self::$_instance = new DCurl($url,$followlocation,$timeOut,$maxRedirecs,$binaryTransfer,$includeHeader,$noBody);
     	}
     	return self::$_instance;
     }
**/
     
    public function setReferer($referer){ 
      $this->_referer = $referer; 
    } 
     /**
      * 要配置的虚拟域名
      * @param string $domain，如admin.ncms.dailypad.cn
      */
    public function setHosts($domain){
        $this->_hosts=$domain;
    }
    
     public function setCookiFileLocation($path) 
     { 
         $this->_cookieFileLocation = $path; 
     } 
	/**
	*Post请求的字段
	 * @param array $postFields ?求?????
	 */
     public function setPost ($postFields) 
     { 
        $this->_post = true; 
        $this->_postFields = $postFields; 
     } 

     public function setUserAgent($userAgent) 
     { 
         $this->_useragent = $userAgent; 
     } 
	//向url地址发送请求
     public function createCurl($url = 'null') 
     { 
        if($url != 'null'){ 
          $this->_url = $url;
        }

         $s = curl_init(); 
         if ($this->_proxy) {
             curl_setopt($s, CURLOPT_PROXY,$this->_proxy); 
         }
          
		//需要获取的URL地址，也可以在curl_init()函数中设置
         curl_setopt($s,CURLOPT_URL,$this->_url); 
		 //一个用来设置HTTP头字段的数组。使用如下的形式的数组进行设置： array('Content-type: text/plain', 'Content-length: 100') 
         curl_setopt($s,CURLOPT_HTTPHEADER,array('Expect:')); //This will remove the expect http header
         curl_setopt($s,CURLOPT_HTTPHEADER,array('Accept-Encoding:gzip,deflate')); //This will remove the expect http header
		 //设置cURL允许执行的最长秒数。
         curl_setopt($s,CURLOPT_CONNECTTIMEOUT,$this->_timeout);
         curl_setopt($s,CURLOPT_TIMEOUT,$this->_timeout); 
          
		 //指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的。
         curl_setopt($s,CURLOPT_MAXREDIRS,$this->_maxRedirects); 
		 //将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
         curl_setopt($s,CURLOPT_RETURNTRANSFER,true); 
         if(!empty($this->_hosts)){
         	curl_setopt($s,CURLOPT_HTTPHEADER, array('Host:'.$this->_hosts) );
         }
		 //启用时会将服务器服务器返回的"Location: "放在header中递归的返回给服务器，使用CURLOPT_MAXREDIRS可以限定递归返回的数量。
         curl_setopt($s,CURLOPT_FOLLOWLOCATION,$this->_followlocation); 
		 //连接结束后保存cookie信息的文件。
         curl_setopt($s,CURLOPT_COOKIEJAR,$this->_cookieFileLocation); 
		 //包含cookie数据的文件名，cookie文件的格式可以是Netscape格式，或者只是纯HTTP头部信息存入文件。 
         curl_setopt($s,CURLOPT_COOKIEFILE,$this->_cookieFileLocation); 

         if($this->authentication == 1){ 
		 //传递一个连接中需要的用户名和密码，格式为："[username]:[password]"。
           curl_setopt($s, CURLOPT_USERPWD, $this->auth_name.':'.$this->auth_pass);
          } 
         if($this->_post) 
         { 
			//启用时会发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表单提交的一样。 
             curl_setopt($s,CURLOPT_POST,true); 			 //全部数据使用HTTP协议中的"POST"操作来发送。要发送文件，在文件名前面加上@前缀并使用完整路径。这个参数可以通过urlencoded后的字符串类似'para1=val1&para2=val2&...'或使用一个以字段名为键值，字段数据为值的数组。如果value是一个数组，Content-Type头将会被设置成multipart/form-data。 
             curl_setopt($s,CURLOPT_POSTFIELDS,$this->_postFields); 

         } 

         if($this->_includeHeader) 
         { 
				//启用时会将头文件的信息作为数据流输出。 
               curl_setopt($s,CURLOPT_HEADER,1); 
         } 

         if($this->_noBody) 
         { 
			//启用时将不对HTML中的BODY部分进行输出。 
             curl_setopt($s,CURLOPT_NOBODY,true); 
         } 
         /* 
         if($this->_binary) 
         { 
			//在启用CURLOPT_RETURNTRANSFER的时候，返回原生的（Raw）输出。
             curl_setopt($s,CURLOPT_BINARYTRANSFER,true); 
         } 
         */ 
		 //在HTTP请求中包含一个"User-Agent: "头的字符串。
         curl_setopt($s,CURLOPT_USERAGENT,$this->_useragent); 
		 //在HTTP请求头中"Referer: "的内容。
         curl_setopt($s,CURLOPT_REFERER,$this->_referer); 

         $this->_webpage = curl_exec($s); 
                   $this->_status = curl_getinfo($s,CURLINFO_HTTP_CODE); 
         curl_close($s); 
         return $this->_webpage;
     }
	//得到状态码
   public function getHttpStatus() 
   { 
       return $this->_status; 
   } 
	//得到内容，直接 echo $obj_name
   public function __tostring(){ 
      return $this->_webpage; 
   } 
   
   /**
    * 通过Curl向远程地址提交Post数据
    * @param array $data 提交的数据
    * @param string $url 远程URL地址
    * @param array $key 可能存在的用于验证合法性的符号
    * @example
    * $data=json_encode($data);<br/>
    * $data=array('action'=>'get','data'=>$data,'table'=>'admin');<br/>
    * $return=curlPost($data);<br/>
    * p($return);
    */
   public function post($data=array()){
   	if(!is_array($data)) die('$data format error！');
   	$this->setPost($data);
   	$this->createCurl();
   	return $this->__tostring();
   }    
    
    
}


?>

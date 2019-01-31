<?php
//zend53   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

define("JIEQI_MODULE_NAME", "article");
require_once ("../../global.php");
if (empty($_REQUEST["id"]) || !isset($_POST["act"]) || !in_array($_POST["act"], array("vip", "free", "show", "hide"))) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

jieqi_checkpost();
jieqi_loadlang("article", JIEQI_MODULE_NAME);

if ($_GET["chaptertype"] == 1) {
	$typename = $jieqiLang["article"]["volume_name"];
}
else {
	$typename = $jieqiLang["article"]["chapter_name"];
}

$_REQUEST["id"] = intval($_REQUEST["id"]);
include_once ($jieqiModules["article"]["path"] . "/class/chapter.php");
$chapter_handler = &JieqiChapterHandler::getInstance("JieqiChapterHandler");
$chapter = $chapter_handler->get($_REQUEST["id"]);

if (!$chapter) {
	jieqi_printfail($jieqiLang["article"]["set_chapter_notexists"]);
}

if ($chapter->getVar("chaptertype", "n") != 0) {
	jieqi_printfail($jieqiLang["article"]["set_volume_notallow"]);
}

include_once ($jieqiModules["article"]["path"] . "/class/article.php");
$article_handler = &JieqiArticleHandler::getInstance("JieqiArticleHandler");
$article = $article_handler->get($chapter->getVar("articleid"));

if (!$article) {
	jieqi_printfail($jieqiLang["article"]["article_not_exists"]);
}

if ((floatval(JIEQI_VERSION) < 2.1) || (intval($article->getVar("issign", "n")) < 10)) {
	jieqi_printfail($jieqiLang["article"]["set_chapter_notsupport"]);
}
jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
$vipmanager = jieqi_checkpower($jieqiPower["article"]["managevip"], $jieqiUsersStatus, $jieqiUsersGroup, true);
if (!$vipmanager && in_array($_POST["act"], array("vip", "free"))) {
	jieqi_printfail(sprintf($jieqiLang["article"]["set_chapter_notsupport"], $typename));
}

jieqi_getconfigs(JIEQI_MODULE_NAME, "power");
$ismanager = jieqi_checkpower($jieqiPower["article"]["manageallarticle"], $jieqiUsersStatus, $jieqiUsersGroup, true);
if (!$ismanager && in_array($_POST["act"], array("show", "hide"))) {
	jieqi_printfail(sprintf($jieqiLang["article"]["noper_set_chapter"], $typename));
}

$canedit = $ismanager;
if (!$canedit && !empty($_SESSION["jieqiUserId"])) {
	$tmpvar = $_SESSION["jieqiUserId"];
	if ((0 < $tmpvar) && (($article->getVar("authorid") == $tmpvar) || ($chapter->getVar("posterid") == $tmpvar) || ($article->getVar("agentid") == $tmpvar))) {
		$canedit = true;
	}
}

if (!$canedit) {
	jieqi_printfail(sprintf($jieqiLang["article"]["noper_edit_chapter"], $typename));
}

include_once ($jieqiModules["article"]["path"] . "/include/actarticle.php");
$ret = jieqi_article_chapterset($chapter, $article, $_POST["act"]);

if ($ret) {
	jieqi_article_updateinfo($article, "chapteredit");
}

jieqi_jumppage($article_static_url . "/articlemanage.php?id=" . $article->getVar("articleid"), LANG_DO_SUCCESS, $jieqiLang["article"]["chapter_set_success"]);

?>

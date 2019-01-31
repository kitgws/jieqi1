<?php
//zend53   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

class BlockArticleMycredit extends JieqiBlock
{
	public $module = "article";
	public $template = "block_mycredit.html";
	public $cachetime = -1;
	public $exevars = array("articleid" => "id");

	public function BlockArticleMycredit(&$vars)
	{
		global $jieqiTpl;
		global $jieqiTop;
		$this->JieqiBlock($vars);

		if (!empty($this->blockvars["vars"])) {
			$varary = explode(",", trim($this->blockvars["vars"]));
			$arynum = count($varary);

			if (0 < $arynum) {
				$varary[0] = trim($varary[0]);

				if (is_numeric($varary[0])) {
					$this->exevars["articleid"] = intval($varary[0]);
				}
				else if (substr($varary[0], 0, 1) == "\$") {
					$tmpvar1 = $jieqiTpl->get_assign(substr($varary[0], 1));
					$this->exevars["articleid"] = intval($tmpvar1);
				}
				else {
					if (isset($_REQUEST[$varary[0]]) && is_numeric($_REQUEST[$varary[0]])) {
						$this->exevars["articleid"] = intval($_REQUEST[$varary[0]]);
					}
				}
			}
		}
	}

	public function setContent($isreturn = false)
	{
		global $jieqiTpl;
		global $jieqiModules;
		global $jieqiConfigs;
		global $jieqiCredit;
		global $query;

		if (!is_a($query, "JieqiQueryHandler")) {
			jieqi_includedb();
			$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
		}

		if (!isset($jieqiConfigs["article"])) {
			jieqi_getconfigs("article", "configs", "jieqiConfigs");
		}

		if (!isset($jieqiCredit["article"])) {
			jieqi_getconfigs("article", "credit", "jieqiCredit");
		}

		$article_static_url = (empty($jieqiConfigs["article"]["staticurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["staticurl"]);
		$article_dynamic_url = (empty($jieqiConfigs["article"]["dynamicurl"]) ? $GLOBALS["jieqiModules"]["article"]["url"] : $jieqiConfigs["article"]["dynamicurl"]);
		$jieqiTpl->assign("article_static_url", $article_static_url);
		$jieqiTpl->assign("article_dynamic_url", $article_dynamic_url);
		$mycredits = array("uid" => $_SESSION["jieqiUserid"], "credit" => 0, "rank" => "", "upcredit" => 0, "nextcedit" => 0, "nextrank" => "");
		if (is_numeric($this->exevars["articleid"]) && (0 < $this->exevars["articleid"]) && (0 < $_SESSION["jieqiUserId"])) {
			$sql = "SELECT * FROM " . jieqi_dbprefix("article_credit") . " WHERE uid = " . intval($_SESSION["jieqiUserId"]) . " AND articleid = " . intval($this->exevars["articleid"]) . " LIMIT 0, 1";
			$query->execute($sql);
			$row = $query->getRow();

			if (is_array($row)) {
				$mycredits["credit"] = intval($row["point"]);
			}
		}

		foreach ($jieqiCredit["article"] as $v ) {
			$mincredit = 0;
			if (($v["minnum"] <= $mycredits["credit"]) && ($mincredit <= $v["minnum"])) {
				$mycredits["rank"] = $v["caption"];
				$mycredits["img"] = $v["icourl"];
				$mincredit = $v["minnum"];
			}

			if (($mycredits["credit"] < $v["minnum"]) && (($v["minnum"] < $mycredits["nextcedit"]) || ($mycredits["nextcedit"] == 0))) {
				$mycredits["nextcedit"] = $v["minnum"];
				$mycredits["nextrank"] = $v["caption"];
			}
		}

		$mycredits["upcredit"] = $mycredits["nextcedit"] - $mycredits["credit"];
		$jieqiTpl->assign_by_ref("mycredits", $mycredits);
	}
}


?>

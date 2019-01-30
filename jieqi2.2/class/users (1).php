<?php
//zend53   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

class JieqiUsers extends JieqiObjectData
{
	public $tableFields = array();

	public function JieqiUsers()
	{
		global $system_users_fields;
		$this->JieqiObjectData();
		$this->tableFields = &$system_users_fields;

		foreach ($this->tableFields as $k => $v ) {
			$this->initVar($k, $v["type"], $v["value"], $v["caption"], $v["required"], $v["maxlength"]);
		}
	}

	public function getGroup()
	{
		global $jieqiGroups;
		return $jieqiGroups[$this->getVar("groupid")];
	}

	public function getViptype()
	{
		global $jieqiLang;
		jieqi_loadlang("users", "system");
		$vipflag = $this->getVar("isvip");

		if ($vipflag == 0) {
			return $jieqiLang["system"]["user_no_vip"];
		}
		else if ($vipflag == 1) {
			return $jieqiLang["system"]["user_is_vip"];
		}
		else if (1 < $vipflag) {
			return $jieqiLang["system"]["user_super_vip"];
		}
	}

	public function getStatus()
	{
		switch ($this->getVar("groupid")) {
		case JIEQI_GROUP_GUEST:
			return JIEQI_GROUP_GUEST;
			break;

		case JIEQI_GROUP_ADMIN:
			return JIEQI_GROUP_ADMIN;
			break;

		default:
			return JIEQI_GROUP_USER;
			break;
		}
	}

	public function getUserset($field, $name = "")
	{
		global $system_users_soptions;

		if (!isset($system_users_soptions[$field])) {
			return false;
		}

		$ret = $system_users_soptions[$field];
		$var = intval($this->getVar($field, "n"));
		$s = decbin($var);
		$l = strlen($s);
		$p = 1;

		foreach ($ret as $k => $v ) {
			if (($p <= $l) && ($s[$l - $p] != "0")) {
				$ret[$k] = 1;
			}

			if ($name == $k) {
				return $ret[$k];
			}

			$p++;
		}

		return $ret;
	}

	public function upUserset($field, $name, $value)
	{
		global $system_users_soptions;
		$ret = intval($this->getVar($field, "n"));

		if (!isset($system_users_soptions[$field])) {
			return $ret;
		}

		$p = array_search($name, $system_users_soptions[$field]);

		if ($p === false) {
			return $ret;
		}

		$value = (0 < $value ? "1" : "0");
		$s = decbin($ret);
		$l = strlen($s);
		$p += 1;

		if ($l < $p) {
			$s = str_repeat("0", $p - $l);
			$l = $p;
		}

		$s[$l - $p] = $value;
		return bindec($s);
	}

	public function encryptPass($pass)
	{
		$salt = $this->getVar("salt", "n");

		if (!empty($salt)) {
			return md5(md5($pass) . $salt);
		}
		else {
			return md5($pass);
		}
	}

	public function getEmoney($sync = false, $type = "all")
	{
		global $jieqiSetting;
		global $jieqiLang;
		if (($sync == true) && defined("JIEQI_CLOUDPAY")) {
			if (!isset($jieqiSetting)) {
				jieqi_getconfigs("system", "setting", "jieqiSetting");
			}

			if (isset($jieqiSetting["siteid"]) && (0 < intval($jieqiSetting["siteid"]))) {
				include_once (JIEQI_ROOT_PATH . "/include/apiclient.php");
				$jieqiapi = new JieqiApiClient($jieqiSetting);
				$params = array("suid" => intval($this->getVar("uid", "n")));
				$ret = $jieqiapi->api("system/get_useregold", $params);

				if ($ret["ret"] < 0) {
					jieqi_printfail(jieqi_htmlstr($ret["msg"]));
				}

				if (!is_array($ret["msg"])) {
					jieqi_printfail("error return data format");
				}

				$result = $ret["msg"];
				if (isset($result["ret"]) && ($result["ret"] < 0)) {
					jieqi_printfail(jieqi_htmlstr($result["msg"]));
				}
				else {
					if (isset($result["egold"])) {
						$result["egold"] = intval($result["egold"]);
					}

					if (isset($result["egold"]) && (0 <= $result["egold"]) && ($result["egold"] != $this->getVar("egold"))) {
						$this->setVar("egold", $result["egold"]);
						$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
						$query->execute("UPDATE " . jieqi_dbprefix("system_users") . " SET egold = {$result["egold"]} WHERE uid = " . intval($this->getVar("uid", "n")));
					}
				}
			}
		}

		$ret = array();
		$ret["egold"] = intval($this->getVar("egold"));
		$ret["esilver"] = intval($this->getVar("esilver"));
		$ret["emoney"] = $ret["egold"] + $ret["esilver"];

		switch ($type) {
		case "egold":
			return $ret["egold"];
			break;

		case "esilver":
			return $ret["esilver"];
			break;

		case "emoney":
			return $ret["emoney"];
			break;

		case "all":
		default:
			return $ret;
			break;
		}
	}

	public function saveToSession()
	{
		global $jieqiModules;
		global $jieqiHonors;

		if ($_SESSION["jieqiUserId"] == $this->getVar("uid")) {
			$_SESSION["jieqiUserName"] = (0 < strlen($this->getVar("name", "n")) ? $this->getVar("name", "n") : $this->getVar("uname", "n"));
			$_SESSION["jieqiUserPass"] = $this->getVar("pass", "n");
			$_SESSION["jieqiUserGroup"] = $this->getVar("groupid", "n");
			$_SESSION["jieqiUserEmail"] = $this->getVar("email", "n");
			$_SESSION["jieqiUserAvatar"] = $this->getVar("avatar", "n");
			$_SESSION["jieqiUserScore"] = $this->getVar("score", "n");
			$_SESSION["jieqiUserExperience"] = $this->getVar("experience", "n");
			$_SESSION["jieqiUserVip"] = $this->getVar("isvip", "n");
			$_SESSION["jieqiUserEgold"] = $this->getVar("egold", "n");
			jieqi_getconfigs("system", "honors");
			$honorid = intval(jieqi_gethonorid($this->getVar("score"), $jieqiHonors));
			$_SESSION["jieqiUserHonorid"] = $honorid;
			$_SESSION["jieqiUserHonor"] = (isset($jieqiHonors[$honorid]["name"][intval($this->getVar("workid", "n"))]) ? $jieqiHonors[$honorid]["name"][intval($this->getVar("workid", "n"))] : $jieqiHonors[$honorid]["caption"]);

			if (!empty($jieqiModules["badge"]["publish"])) {
				$_SESSION["jieqiUserBadges"] = $this->getVar("badges", "n");
			}

			$_SESSION["jieqiUserSet"] = jieqi_unserialize($this->getVar("setting", "n"));
		}
	}
}

class JieqiUsersHandler extends JieqiObjectHandler
{
	public $tableFields = array();
	public $tableFieldid = array();

	public function JieqiUsersHandler($db = "")
	{
		global $system_users_fields;
		$this->JieqiObjectHandler($db);
		$this->tableFields = &$system_users_fields;
		$this->basename = "users";
		$this->autoid = "uid";
		$this->dbname = jieqi_dbprefix("system_users");
		$this->fullname = true;

		foreach ($this->tableFields as $k => $v ) {
			$this->tableFieldid[$v["name"]] = $k;
		}
	}

	public function encryptPass($pass, $salt = "")
	{
		if (!empty($salt)) {
			return md5(md5($pass) . $salt);
		}
		else {
			return md5($pass);
		}
	}

	public function extractUserset($var, $field, $name = "")
	{
		global $system_users_soptions;

		if (!isset($system_users_soptions[$field])) {
			return false;
		}

		$ret = $system_users_soptions[$field];
		$var = intval($var);
		$s = decbin($var);
		$l = strlen($s);
		$p = 1;

		foreach ($ret as $k => $v ) {
			if (($p <= $l) && ($s[$l - $p] != "0")) {
				$ret[$k] = 1;
			}

			if ($name == $k) {
				return $ret[$k];
			}

			$p++;
		}

		return $ret;
	}

	public function getByname($name, $flag = 1)
	{
		if (!empty($name)) {
			$name = jieqi_dbslashes($name);

			if ($flag == 3) {
				$sql = "SELECT * FROM " . jieqi_dbprefix($this->dbname, $this->fullname) . " WHERE " . $this->tableFields["uname"]["name"] . "='" . $name . "' OR " . $this->tableFields["name"]["name"] . "='" . $name . "' ORDER BY name DESC";
			}
			else if ($flag == 2) {
				$sql = "SELECT * FROM " . jieqi_dbprefix($this->dbname, $this->fullname) . " WHERE " . $this->tableFields["name"]["name"] . "='" . $name . "'";
			}
			else {
				$sql = "SELECT * FROM " . jieqi_dbprefix($this->dbname, $this->fullname) . " WHERE " . $this->tableFields["uname"]["name"] . "='" . $name . "'";
			}

			if (!$result = $this->db->query($sql)) {
				return false;
			}

			$numrows = $this->db->getRowsNum($result);

			if (1 <= $numrows) {
				$tmpvar = "Jieqi" . ucfirst($this->basename);
				$$this->basename = new $tmpvar();
				$$this->basename->setVars($this->db->fetchArray($result));
				return $$this->basename;
			}
		}

		return false;
	}

	public function changeCredit($uid, $credit, $isadd = true)
	{
		if (empty($credit) || !is_numeric($credit) || empty($uid) || !is_numeric($uid)) {
			return false;
		}

		if ($isadd) {
			$sql = "UPDATE " . jieqi_dbprefix($this->dbname, $this->fullname) . " SET credit=credit+" . $credit . " WHERE " . $this->tableFields["uid"]["name"] . "=" . $uid;
		}
		else {
			$sql = "UPDATE " . jieqi_dbprefix($this->dbname, $this->fullname) . " SET credit=credit-" . $credit . " WHERE " . $this->tableFields["uid"]["name"] . "=" . $uid;
		}

		$this->db->query($sql);
		return true;
	}

	public function changeScore($uid, $score, $isadd = true, $delexperience = true)
	{
		if (empty($score) || !is_numeric($score) || empty($uid) || !is_numeric($uid)) {
			return false;
		}

		if ($score < 0) {
			$isadd = !$isadd;
			$score = abs($score);
		}

		if ($isadd) {
			$tmpuser = $this->get($uid);

			if (!is_object($tmpuser)) {
				return false;
			}

			$oldscore = $tmpuser->getVar("lastscore", "n");
			$lastdate = date("Y-m-d", $oldscore);
			$lasttime = JIEQI_NOW_TIME;
			$nowdate = date("Y-m-d", $lasttime);
			$nowweek = date("w", $lasttime);
			$sql = "UPDATE " . jieqi_dbprefix($this->dbname, $this->fullname) . " SET experience=experience+" . $score . ", score=score+" . $score;

			if ($nowdate == $lastdate) {
				$sql .= ", monthscore=monthscore+" . $score . ", weekscore=weekscore+" . $score . ", dayscore=dayscore+" . $score;
			}
			else {
				if (substr($nowdate, 0, 7) == substr($lastdate, 0, 7)) {
					$sql .= ", monthscore=monthscore+" . $score;
				}
				else {
					$sql .= ", monthscore=" . $score;
				}

				if ($nowweek == 1) {
					$sql .= ", weekscore=" . $score;
				}
				else {
					$sql .= ", weekscore=weekscore+" . $score;
				}

				$sql .= ", dayscore=" . $score;
			}

			$sql .= " WHERE " . $this->tableFields["uid"]["name"] . "=" . $uid;
		}
		else if ($delexperience) {
			$sql = "UPDATE " . jieqi_dbprefix($this->dbname, $this->fullname) . " SET experience=experience-" . $score . ", score=score-" . $score . ", monthscore=monthscore-" . $score . " WHERE " . $this->tableFields["uid"]["name"] . "=" . $uid;
		}
		else {
			$sql = "UPDATE " . jieqi_dbprefix($this->dbname, $this->fullname) . " SET score=score-" . $score . ", monthscore=monthscore-" . $score . " WHERE " . $this->tableFields["uid"]["name"] . "=" . $uid;
		}

		$this->db->query($sql);

		if ($_SESSION["jieqiUserId"] == $uid) {
			if ($isadd) {
				$_SESSION["jieqiUserScore"] = $_SESSION["jieqiUserScore"] + $score;
				$_SESSION["jieqiUserExperience"] = $_SESSION["jieqiUserExperience"] + $score;
			}
			else {
				$_SESSION["jieqiUserScore"] = $_SESSION["jieqiUserScore"] - $score;

				if ($delexperience) {
					$_SESSION["jieqiUserExperience"] = $_SESSION["jieqiUserExperience"] - $score;
				}
			}
		}

		return true;
	}

	public function payout(&$users, $emoney)
	{
		$emoney = intval($emoney);

		if ($emoney <= 0) {
			return false;
		}

		if (is_a($users, "JieqiUsers")) {
			$tmpuser = &$users;
			$uid = intval($tmpuser->getVar("uid", "n"));
		}
		else {
			$uid = intval($users);

			if ($uid <= 0) {
				return false;
			}

			$tmpuser = $this->get($uid);

			if (!is_object($tmpuser)) {
				return false;
			}
		}

		$useregold = intval($tmpuser->getVar("egold", "n"));
		$useresilver = intval($tmpuser->getVar("esilver", "n"));
		$expenses = intval($tmpuser->getVar("expenses", "n"));
		$useremoney = $useregold + $useresilver;

		if ($useremoney < $emoney) {
			return false;
		}

		if ($emoney <= $useregold) {
			$tmpuser->setVar("egold", $useregold - $emoney);
		}
		else if ($emoney <= $useresilver) {
			$tmpuser->setVar("esilver", $useresilver - $emoney);
		}
		else {
			$tmpuser->setVar("egold", 0);
			$tmpuser->setVar("esilver", ($useresilver + $useregold) - $emoney);
		}

		$tmpuser->setVar("expenses", $expenses + $emoney);
		if (!empty($_SESSION["jieqiUserId"]) && ($tmpuser->getVar("uid", "n") == $_SESSION["jieqiUserId"])) {
			$tmpuser->saveToSession();
		}

		return $this->insert($tmpuser);
	}

	public function payback($uid, $emoney)
	{
		if (is_a($uid, "JieqiUsers")) {
			$uid = intval($uid->getVar("uid", "n"));
		}
		else {
			$uid = intval($uid);
		}

		$emoney = intval($emoney);
		if (($uid <= 0) || ($emoney <= 0)) {
			return false;
		}

		$sql = "UPDATE " . $this->dbname . " SET egold = egold + " . $emoney . ", expenses = expenses - " . $emoney . " WHERE uid = " . $uid;
		return $this->execute($sql);
	}

	public function income($uid, $emoney, $usesliver = 0, $addscore = 0, $updatevip = 1)
	{
		global $jieqiConfigs;
		$tmpuser = $this->get($uid);

		if (is_object($tmpuser)) {
			$tmpuser->setVar("egold", $tmpuser->getVar("egold") + $emoney);

			if (0 < $emoney) {
				$updatevip = intval($updatevip);
				if ((0 < $updatevip) && ($tmpuser->getVar("isvip") < $updatevip)) {
					$tmpuser->setVar("isvip", $updatevip);
				}

				global $jieqiTasks;
				$userset = jieqi_unserialize($tmpuser->getVar("setting", "n"));
				$taskscore = 0;
				jieqi_getconfigs("system", "tasks", "jieqiTasks");
				if (isset($jieqiTasks["pay"]["buy"]) && empty($userset["tasks"]["pay"]["buy"])) {
					$userset["tasks"]["pay"]["buy"] = 1;
					$taskscore = intval($jieqiTasks["pay"]["buy"]["score"]);
				}

				$addscore = intval($addscore) + $taskscore;

				if (0 < $addscore) {
					$tmpuser->setVar("score", $tmpuser->getVar("score") + $addscore);
				}

				if (!isset($jieqiConfigs["system"])) {
					jieqi_getconfigs("system", "configs", "jieqiConfigs");
				}

				if (!empty($jieqiConfigs["system"]["inaddvipvote"])) {
					$vipvoteadd = floor($emoney / intval($jieqiConfigs["system"]["inaddvipvote"]));
					$userset["gift"]["vipvote"] = intval($userset["gift"]["vipvote"]) + $vipvoteadd;
					$tmpuser->setVar("setting", serialize($userset));
				}
			}

			if (!empty($_SESSION["jieqiUserId"]) && ($uid == $_SESSION["jieqiUserId"])) {
				$tmpuser->saveToSession();
			}

			$this->insert($tmpuser);
			return true;
		}

		return false;
	}

	public function get($id)
	{
		if (is_numeric($id) && (0 < intval($id))) {
			$id = intval($id);
			$sql = "SELECT * FROM " . jieqi_dbprefix($this->dbname, $this->fullname) . " WHERE " . $this->tableFields[$this->autoid]["name"] . "=" . $id;

			if (!$result = $this->db->query($sql, 0, 0, true)) {
				return false;
			}

			$datarow = $this->db->fetchArray($result);

			if (is_array($datarow)) {
				$tmpvar = "Jieqi" . ucfirst($this->basename);
				$$this->basename = new $tmpvar();

				foreach ($datarow as $k => $v ) {
					if (isset($this->tableFieldid[$k])) {
						$$this->basename->setVar($this->tableFieldid[$k], $v, true, false);
					}
					else {
						$$this->basename->setVar($k, $v, true, false);
					}
				}

				return $$this->basename;
			}
		}

		return false;
	}

	public function insert(&$baseobj)
	{
		if (strcasecmp(get_class($baseobj), "jieqi" . $this->basename) != 0) {
			return false;
		}

		if ($baseobj->isNew()) {
			if (is_numeric($baseobj->getVar($this->autoid, "n"))) {
				$$this->autoid = intval($baseobj->getVar($this->autoid, "n"));
			}
			else {
				$$this->autoid = $this->db->genId($this->dbname . "_" . $this->autoid . "_seq");
			}

			$sql = "INSERT INTO " . jieqi_dbprefix($this->dbname, $this->fullname) . " (";
			$values = ") VALUES (";
			$start = true;

			foreach ($baseobj->vars as $k => $v ) {
				if (!$start) {
					$sql .= ", ";
					$values .= ", ";
				}
				else {
					$start = false;
				}

				if (isset($this->tableFields[$k]["name"])) {
					$sql .= $this->tableFields[$k]["name"];
				}
				else {
					$sql .= $k;
				}

				if ($v["type"] == JIEQI_TYPE_INT) {
					if ($k != $this->autoid) {
						if (!is_numeric($v["value"])) {
							$v["value"] = @intval($v["value"]);
						}

						$values .= $this->db->quoteString($v["value"]);
					}
					else {
						$values .= $$this->autoid;
					}
				}
				else {
					$values .= $this->db->quoteString($v["value"]);
				}
			}

			$sql .= $values . ")";
			unset($values);
		}
		else {
			$sql = "UPDATE " . jieqi_dbprefix($this->dbname, $this->fullname) . " SET ";
			$start = true;

			foreach ($baseobj->vars as $k => $v ) {
				if (($k != $this->autoid) && $v["isdirty"]) {
					if (!$start) {
						$sql .= ", ";
					}
					else {
						$start = false;
					}

					if (isset($this->tableFields[$k]["name"])) {
						$k = $this->tableFields[$k]["name"];
					}

					if ($v["type"] == JIEQI_TYPE_INT) {
						if (!is_numeric($v["value"])) {
							$v["value"] = @intval($v["value"]);
						}

						$sql .= $k . "=" . $this->db->quoteString($v["value"]);
					}
					else {
						$sql .= $k . "=" . $this->db->quoteString($v["value"]);
					}
				}
			}

			if ($start) {
				return true;
			}

			$sql .= " WHERE " . $this->tableFields[$this->autoid]["name"] . "=" . intval($baseobj->vars[$this->autoid]["value"]);
		}

		$result = $this->db->query($sql);

		if (!$result) {
			return false;
		}

		if ($baseobj->isNew()) {
			$baseobj->setVar($this->autoid, $this->db->getInsertId());
		}

		return true;
	}

	public function delete($criteria = 0)
	{
		$sql = "";

		if (is_numeric($criteria)) {
			$criteria = intval($criteria);
			$sql = "DELETE FROM " . jieqi_dbprefix($this->dbname, $this->fullname) . " WHERE " . $this->tableFields[$this->autoid]["name"] . "=" . $criteria;
		}
		else {
			if (is_object($criteria) && is_subclass_of($criteria, "criteriaelement")) {
				$tmpstr = $criteria->renderWhere();

				if (!empty($tmpstr)) {
					$sql = "DELETE FROM " . jieqi_dbprefix($this->dbname, $this->fullname) . " " . $tmpstr;
				}
			}
		}

		if (empty($sql)) {
			return false;
		}

		$result = $this->db->query($sql);

		if (!$result) {
			return false;
		}

		return true;
	}

	public function queryObjects($criteria = NULL, $nobuffer = false)
	{
		$limit = $start = 0;
		$sql = "SELECT * FROM " . jieqi_dbprefix($this->dbname, $this->fullname);
		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement")) {
			$sql .= " " . $criteria->renderWhere();

			if ($criteria->getGroupby() != "") {
				$sql .= " GROUP BY " . $criteria->getGroupby();
			}

			if ($criteria->getSort() != "") {
				$sql .= " ORDER BY " . $criteria->getSort() . " " . $criteria->getOrder();
			}

			$limit = $criteria->getLimit();
			$start = $criteria->getStart();
		}

		$this->sqlres = $this->db->query($sql, $limit, $start, $nobuffer);
		return $this->sqlres;
	}

	public function getObject($result = "")
	{
		static $dbrowobj;

		if ($result == "") {
			$result = $this->sqlres;
		}

		if (!$result) {
			return false;
		}
		else {
			$tmpvar = "Jieqi" . ucfirst($this->basename);
			$myrow = $this->db->fetchArray($result);

			if (!$myrow) {
				return false;
			}
			else {
				if (!isset($dbrowobj)) {
					$dbrowobj = new $tmpvar();
				}

				foreach ($myrow as $k => $v ) {
					if (isset($this->tableFieldid[$k])) {
						$dbrowobj->setVar($this->tableFieldid[$k], $v, true, false);
					}
					else {
						$dbrowobj->setVar($k, $v, true, false);
					}
				}

				return $dbrowobj;
			}
		}
	}

	public function getRow($result = "")
	{
		if ($result == "") {
			$result = $this->sqlres;
		}

		if (!$result) {
			return false;
		}
		else {
			$myrow = $this->db->fetchArray($result);

			if (!$myrow) {
				return false;
			}
			else {
				return $myrow;
			}
		}
	}

	public function getCount($criteria = NULL)
	{
		$sql = "SELECT COUNT(*) FROM " . jieqi_dbprefix($this->dbname, $this->fullname);
		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement")) {
			$sql .= " " . $criteria->renderWhere();
		}

		$result = $this->db->query($sql, 0, 0, true);

		if (!$result) {
			return 0;
		}

		list($count) = $this->db->fetchRow($result);
		return $count;
	}

	public function updatefields($fields, $criteria = NULL)
	{
		$sql = "UPDATE " . jieqi_dbprefix($this->dbname, $this->fullname) . " SET ";
		$start = true;

		if (is_array($fields)) {
			foreach ($fields as $k => $v ) {
				if (!$start) {
					$sql .= ", ";
				}
				else {
					$start = false;
				}

				if (isset($this->tableFields[$k]["name"])) {
					$k = $this->tableFields[$k]["name"];
				}

				if (is_numeric($v)) {
					$sql .= $k . "=" . $v;
				}
				else {
					$sql .= $k . "=" . $this->db->quoteString($v);
				}
			}
		}
		else {
			$sql .= $fields;
		}

		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement")) {
			$sql .= " " . $criteria->renderWhere();
		}

		if (!$result = $this->db->query($sql)) {
			return false;
		}

		return true;
	}
}

jieqi_includedb();
global $system_users_fields;
$system_users_fields = array();
$system_users_fields["uid"] = array("name" => "uid", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "序号", "required" => false, "maxlength" => 11);
$system_users_fields["siteid"] = array("name" => "siteid", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "网站序号", "required" => false, "maxlength" => 6);
$system_users_fields["uname"] = array("name" => "uname", "type" => JIEQI_TYPE_TXTBOX, "value" => "", "caption" => "用户名", "required" => true, "maxlength" => 30);
$system_users_fields["name"] = array("name" => "name", "type" => JIEQI_TYPE_TXTBOX, "value" => "", "caption" => "真实姓名", "required" => false, "maxlength" => 60);
$system_users_fields["pass"] = array("name" => "pass", "type" => JIEQI_TYPE_TXTBOX, "value" => "", "caption" => "密码", "required" => false, "maxlength" => 32);
$system_users_fields["salt"] = array("name" => "salt", "type" => JIEQI_TYPE_TXTBOX, "value" => "", "caption" => "密码加盐", "required" => false, "maxlength" => 32);
$system_users_fields["groupid"] = array("name" => "groupid", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "用户组序号", "required" => false, "maxlength" => 3);
$system_users_fields["regdate"] = array("name" => "regdate", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "注册日期", "required" => false, "maxlength" => 11);
$system_users_fields["initial"] = array("name" => "initial", "type" => JIEQI_TYPE_TXTBOX, "value" => "", "caption" => "用户名首字母", "required" => false, "maxlength" => 1);
$system_users_fields["sex"] = array("name" => "sex", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "性别", "required" => false, "maxlength" => 1);
$system_users_fields["email"] = array("name" => "email", "type" => JIEQI_TYPE_TXTBOX, "value" => "", "caption" => "Email", "required" => true, "maxlength" => 60);
$system_users_fields["url"] = array("name" => "url", "type" => JIEQI_TYPE_TXTBOX, "value" => "", "caption" => "网站", "required" => false, "maxlength" => 100);
$system_users_fields["avatar"] = array("name" => "avatar", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "头像", "required" => false, "maxlength" => 11);
$system_users_fields["workid"] = array("name" => "workid", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "职业", "required" => false, "maxlength" => 11);
$system_users_fields["qq"] = array("name" => "qq", "type" => JIEQI_TYPE_TXTBOX, "value" => "", "caption" => "QQ", "required" => false, "maxlength" => 15);
$system_users_fields["icq"] = array("name" => "icq", "type" => JIEQI_TYPE_TXTBOX, "value" => "", "caption" => "ICQ", "required" => false, "maxlength" => 15);
$system_users_fields["msn"] = array("name" => "msn", "type" => JIEQI_TYPE_TXTBOX, "value" => "", "caption" => "MSN", "required" => false, "maxlength" => 60);
$system_users_fields["mobile"] = array("name" => "mobile", "type" => JIEQI_TYPE_TXTBOX, "value" => "", "caption" => "手机", "required" => false, "maxlength" => 20);
$system_users_fields["sign"] = array("name" => "sign", "type" => JIEQI_TYPE_TXTAREA, "value" => "", "caption" => "签名", "required" => false, "maxlength" => NULL);
$system_users_fields["intro"] = array("name" => "intro", "type" => JIEQI_TYPE_TXTAREA, "value" => "", "caption" => "个人简介", "required" => false, "maxlength" => NULL);
$system_users_fields["setting"] = array("name" => "setting", "type" => JIEQI_TYPE_TXTAREA, "value" => "", "caption" => "用户设置", "required" => false, "maxlength" => NULL);
$system_users_fields["badges"] = array("name" => "badges", "type" => JIEQI_TYPE_TXTAREA, "value" => "", "caption" => "其他信息", "required" => false, "maxlength" => NULL);
$system_users_fields["lastlogin"] = array("name" => "lastlogin", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "最后登录", "required" => false, "maxlength" => 10);
$system_users_fields["verify"] = array("name" => "verify", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "已验证信息", "required" => false, "maxlength" => 11);
$system_users_fields["showset"] = array("name" => "showset", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "显示设置", "required" => false, "maxlength" => 11);
$system_users_fields["acceptset"] = array("name" => "acceptset", "type" => JIEQI_TYPE_INT, "value" => 1, "caption" => "接受设置", "required" => false, "maxlength" => 11);
$system_users_fields["monthscore"] = array("name" => "monthscore", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "本月积分", "required" => false, "maxlength" => 11);
$system_users_fields["weekscore"] = array("name" => "weekscore", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "本周积分", "required" => false, "maxlength" => 11);
$system_users_fields["dayscore"] = array("name" => "dayscore", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "本日积分", "required" => false, "maxlength" => 11);
$system_users_fields["lastscore"] = array("name" => "lastscore", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "最后积分", "required" => false, "maxlength" => 11);
$system_users_fields["experience"] = array("name" => "experience", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "经验值", "required" => false, "maxlength" => 11);
$system_users_fields["score"] = array("name" => "score", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "积分", "required" => false, "maxlength" => 11);
$system_users_fields["egold"] = array("name" => "egold", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "虚拟货币", "required" => false, "maxlength" => 11);
$system_users_fields["esilver"] = array("name" => "esilver", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "银币", "required" => false, "maxlength" => 11);
$system_users_fields["sumtip"] = array("name" => "sumtip", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "打赏收入", "required" => false, "maxlength" => 11);
$system_users_fields["sumtask"] = array("name" => "sumtask", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "任务收入", "required" => false, "maxlength" => 11);
$system_users_fields["sumworks"] = array("name" => "sumworks", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "作品收入", "required" => false, "maxlength" => 11);
$system_users_fields["sumaward"] = array("name" => "sumaward", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "奖金收入", "required" => false, "maxlength" => 11);
$system_users_fields["sumother"] = array("name" => "sumother", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "其它收入", "required" => false, "maxlength" => 11);
$system_users_fields["sumemoney"] = array("name" => "sumemoney", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "虚拟币收入", "required" => false, "maxlength" => 11);
$system_users_fields["summoney"] = array("name" => "summoney", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "现金收入", "required" => false, "maxlength" => 11);
$system_users_fields["paidmoney"] = array("name" => "paidmoney", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "已付现金", "required" => false, "maxlength" => 11);
$system_users_fields["paidemoney"] = array("name" => "paidemoney", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "已付虚拟币", "required" => false, "maxlength" => 11);
$system_users_fields["paytime"] = array("name" => "paytime", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "付款时间", "required" => false, "maxlength" => 11);
$system_users_fields["credit"] = array("name" => "credit", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "信用度", "required" => false, "maxlength" => 11);
$system_users_fields["goodnum"] = array("name" => "goodnum", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "好评", "required" => false, "maxlength" => 11);
$system_users_fields["badnum"] = array("name" => "badnum", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "差评", "required" => false, "maxlength" => 11);
$system_users_fields["expenses"] = array("name" => "expenses", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "消费额", "required" => false, "maxlength" => 11);
$system_users_fields["conisbind"] = array("name" => "conisbind", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "是否绑定QQ登录", "required" => false, "maxlength" => 11);
$system_users_fields["viplevel"] = array("name" => "viplevel", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "包月等级", "required" => false, "maxlength" => 11);
$system_users_fields["isvip"] = array("name" => "isvip", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "是否VIP会员", "required" => false, "maxlength" => 1);
$system_users_fields["overtime"] = array("name" => "overtime", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "过期时间", "required" => false, "maxlength" => 11);
$system_users_fields["state"] = array("name" => "state", "type" => JIEQI_TYPE_INT, "value" => 0, "caption" => "用户包月等级", "required" => false, "maxlength" => 1);
global $system_users_soptions;
$system_users_soptions = array(
	"verify"    => array("email" => 0, "mobile" => 0),
	"showset"   => array("email" => 0),
	"acceptset" => array("email" => 0)
	);

?>

<?php

define("JIEQI_MODULE_NAME", "system");
require_once ("../global.php");
include_once (JIEQI_ROOT_PATH . "/class/power.php");
$power_handler = &JieqiPowerHandler::getInstance("JieqiPowerHandler");
$power_handler->getSavedVars("system");
jieqi_checkpower($jieqiPower["system"]["adminconfig"], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang("vips", JIEQI_MODULE_NAME);
include_once (JIEQI_ROOT_PATH . "/lib/html/formloader.php");
include_once (JIEQI_ROOT_PATH . "/class/vips.php");
$vips_handler = &JieqivipsHandler::getInstance("JieqivipsHandler");

if (empty($_REQUEST["action"])) {
	$_REQUEST["action"] = "show";
}

switch ($_REQUEST["action"]) {
case "new":
	$errtext = "";

	if (empty($_POST["caption"])) {
		$errtext .= $jieqiLang["system"]["need_vip_caption"] . "<br />";
	}

	if (!is_numeric($_POST["minegold"])) {
		$errtext .= $jieqiLang["system"]["need_minegold_num"] . "<br />";
	}

	if (!is_numeric($_POST["extraegold"])) {
		$errtext .= $jieqiLang["system"]["need_extraegold_num"] . "<br />";
	}

	$_POST["minegold"] = intval($_POST["minegold"]);
	$_POST["maxegold"] = intval($_POST["maxegold"]);
	$_POST["viptype"] = intval($_POST["viptype"]);
	$_POST["extraegold"] = intval($_POST["extraegold"]);
	$_POST["extradiv"] = intval($_POST["extradiv"]);


	if (empty($errtext)) {
		$vips = $vips_handler->create();
		$vips->setVar("caption", $_POST["caption"]);
		$vips->setVar("minegold", $_POST["minegold"]);
		$vips->setVar("maxegold", $_POST["maxegold"]);
		$vips->setVar("viptype", $_POST["viptype"]);
		$vips->setVar("extraegold", $_POST["extraegold"]);
		$vips->setVar("extradiv", $_POST["extradiv"]);
	//	$vips->setVar("viptype", "0");

		if (!$vips_handler->insert($vips)) {
			jieqi_printfail($jieqiLang["system"]["add_vip_failure"]);
		}
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case "delete":
	if (!empty($_REQUEST["id"])) {
		$vips_handler->delete($_REQUEST["id"]);
	}

	break;

case "update":
	if (!empty($_REQUEST["id"]) && !empty($_POST["caption"])) {
		$vips = $vips_handler->get($_REQUEST["id"]);

		if (is_object($vips)) {
			$errtext = "";

			if (empty($_POST["caption"])) {
				$errtext .= $jieqiLang["system"]["need_vip_caption"] . "<br />";
			}
             if (!is_numeric($_POST["minegold"])) {
				$errtext .= $jieqiLang["system"]["need_minegold_num"] . "<br />";
			}

			if (!is_numeric($_POST["viptype"])) {
				$errtext .= $jieqiLang["system"]["need_viptype_num"] . "<br />";
			}

			
			if (!is_numeric($_POST["extraegold"])) {
				$errtext .= $jieqiLang["system"]["need_extraegold_num"] . "<br />";
			}
			
			if (!is_numeric($_POST["extradiv"])) {
				$errtext .= $jieqiLang["system"]["need_extradiv_num"] . "<br />";
			}

			$_POST["minegold"] = intval($_POST["minegold"]);
			$_POST["maxegold"] = intval($_POST["maxegold"]);
			$_POST["viptype"] = intval($_POST["viptype"]);
			$_POST["extraegold"] = intval($_POST["extraegold"]);
			$_POST["extradiv"] = intval($_POST["extradiv"]);

			if (empty($errtext)) {
				$vips->setVar("caption", $_POST["caption"]);
				$vips->setVar("minegold", $_POST["minegold"]);
				$vips->setVar("maxegold", $_POST["maxegold"]);
				$vips->setVar("viptype", $_POST["viptype"]);
				$vips->setVar("extraegold", $_POST["extraegold"]);
				$vips->setVar("extradiv", $_POST["extradiv"]);

				if (!$vips_handler->insert($vips)) {
					jieqi_printfail($jieqiLang["system"]["edit_vip_failure"]);
				}
			}
			else {
				jieqi_printfail($errtext);
			}
		}
	}

	break;

case "edit":
	if (!empty($_REQUEST["id"])) {
		$vips = $vips_handler->get($_REQUEST["id"]);

		if (is_object($vips)) {
			include_once (JIEQI_ROOT_PATH . "/admin/header.php");
			$vips_form = new JieqiThemeForm($jieqiLang["system"]["edit_vip"], "vipsedit", JIEQI_URL . "/admin/vips.php");
			$vips_form->addElement(new JieqiFormText($jieqiLang["system"]["table_vips_caption"], "caption", 30, 250, $vips->getVar("caption", "e")), true);
			$vips_form->addElement(new JieqiFormTextArea($jieqiLang["system"]["table_vips_minegold"], "minegold", $vips->getVar("minegold", "e"), 5, 50));
			$vips_form->addElement(new JieqiFormTextArea($jieqiLang["system"]["table_vips_maxegold"], "maxegold", $vips->getVar("minegold", "e"), 5, 50));
			$vips_form->addElement(new JieqiFormTextArea($jieqiLang["system"]["table_vips_viptype"], "viptype", $vips->getVar("viptype", "e"), 5, 50));
			$vips_form->addElement(new JieqiFormTextArea($jieqiLang["system"]["table_vips_extraegold"], "extraegold", $vips->getVar("extraegold", "e"), 5, 50));
			$vips_form->addElement(new JieqiFormTextArea($jieqiLang["system"]["table_vips_extradiv"], "extradiv", $vips->getVar("extradiv", "e"), 5, 50));
			$vips_form->addElement(new JieqiFormHidden("action", "update"));
			$vips_form->addElement(new JieqiFormHidden("id", $_REQUEST["id"]));
			$vips_form->addElement(new JieqiFormButton("&nbsp;", "submit", LANG_SAVE, "submit"));
			$jieqiTpl->assign("jieqi_contents", "<br />" . $vips_form->render(JIEQI_FORM_MAX) . "<br />");
			include_once (JIEQI_ROOT_PATH . "/admin/footer.php");
			exit();
		}
	}

	break;
}

include_once (JIEQI_ROOT_PATH . "/admin/header.php");
$criteria = new CriteriaCompo();
$criteria->setSort("minegold");
$criteria->setOrder("ASC");
$vips_handler->queryObjects($criteria);
$vips = array();
$vipary = array();
$i = 0;

while ($v = $vips_handler->getObject()) {
	$nameary = explode(" ", $v->getVar("caption"));
	$vipary[$v->getVar("vipid")] = array("caption" => $nameary[0], "minegold" => $v->getVar("minegold"),"maxegold" => $v->getVar("maxegold"), "extraegold" => $v->getVar("extraegold"), "extradiv" => $v->getVar("extradiv"),"viptype" => $v->getVar("viptype"));
	$vips[$i]["vipid"] = $v->getVar("vipid");
	$vips[$i]["caption"] = implode("<br />", $nameary);
	$vips[$i]["minegold"] = $v->getVar("minegold");
	$vips[$i]["maxegold"] = $v->getVar("maxegold");
	$vips[$i]["extraegold"] = $v->getVar("extraegold");
	$vips[$i]["extradiv"] = $v->getVar("extradiv");
	$vips[$i]["viptype"] = $v->getVar("viptype");
	$i++;
	if ((!empty($_REQUEST["id"]) || !empty($_POST["caption"])) && (0 < count($vipary))) {
	jieqi_setconfigs("vips", "jieqiVips", $vipary, "system");
}
}

$jieqiTpl->assign_by_ref("vips", $vips);
$vips_form = new JieqiThemeForm($jieqiLang["system"]["add_vip"], "vipsnew", JIEQI_URL . "/admin/vips.php");
$vips_form->addElement(new JieqiFormText($jieqiLang["system"]["table_vips_caption"], "caption", 30, 250, ""), true);
$vips_form->addElement(new JieqiFormText($jieqiLang["system"]["table_vips_minegold"], "minegold", 30, 50, ""), true);
$vips_form->addElement(new JieqiFormText($jieqiLang["system"]["table_vips_maxegold"], "maxegold", 30, 50, ""), true);
$vips_form->addElement(new JieqiFormText($jieqiLang["system"]["table_vips_viptype"], "viptype", 30, 50, ""), true);
$vips_form->addElement(new JieqiFormText($jieqiLang["system"]["table_vips_extraegold"], "extraegold", 30, 50, ""), true);
$vips_form->addElement(new JieqiFormText($jieqiLang["system"]["table_vips_extradiv"], "extradiv", 30, 50, ""), true);
$vips_form->addElement(new JieqiFormHidden("action", "new"));
$vips_form->addElement(new JieqiFormButton("&nbsp;", "submit", $jieqiLang["system"]["add_vip"], "submit"));
$jieqiTpl->assign("form_addvip", "<br />" . $vips_form->render(JIEQI_FORM_MAX) . "<br />");
$jieqiTpl->setCaching(0);
$jieqiTset["jieqi_contents_template"] = JIEQI_ROOT_PATH . "/templates/admin/vips.html";
include_once (JIEQI_ROOT_PATH . "/admin/footer.php");

?>

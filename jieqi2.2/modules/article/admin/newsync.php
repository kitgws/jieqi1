<?php
@ignore_user_abort(true);
@set_time_limit(7000);
@session_write_close();
require_once ("../../../global.php");
$id = 1;// intval($_GET['id']);
include JIEQI_ROOT_PATH."/configs/article/syncsite.php";
include JIEQI_ROOT_PATH."/configs/article/sync_".$syncsite[$id]['config']."_site.php";
$sid = $sync['sid'];
$key = $sync['key'];
$uptime = $sync['uptime'];
/* 
 * 测试接口  ：sid:1   sign:h49s734bca43htoc62gd    
http://www.meiguiwxw.com/apis/jieqi/articlelist.php?sid=1&key=h49s734bca43htoc62gd  小说列表

http://www.meiguiwxw.com/apis/jieqi/articleinfo.php?aid=8 小说信息

http://www.meiguiwxw.com/apis/jieqi/articlechapter.php?aid=8   章节列表

http://www.meiguiwxw.com/apis/jieqi/chaptercontent.php?aid=8&cid=7937  内容 
 */

include_once ($jieqiModules["article"]["path"] . "/include/funsync2.php");
include_once (JIEQI_ROOT_PATH . "/lib/text/textfunction.php");
jieqi_includedb();
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");

jieqi_getconfigs("article", "configs");
jieqi_getconfigs("system", "setting", "jieqiSetting");
//获取列表
$page=1;
do {
    if (!$uptime) {
       $para = 'page='.$page.'&sid='.$sid; 
    } else {
        $para = 'page='.$page.'&sid='.$sid.'&uptime='.$uptime;
    }
    
    $sign = md5($para.'&key='.$key);
    $url = $sync['alist'].'?'.$para.'&sign='.$sign;
    //echo $url;
    $list = json_decode(jieqi_sync_geturlcontent($url),true);
    foreach ($list as $k=>$v) {
        $sourceupdate = strtotime($v['lastupdate']);
        $sql = "SELECT articleid, articlename, lastupdate, display FROM " . jieqi_dbprefix("article_article") . " WHERE sourceid = " . $v['articleid'] . " LIMIT 0, 1";
	$query->execute($sql);
	$arow = $query->getRow();
//	if (is_array($arow) && (($sourceupdate <= $arow["lastupdate"]) || ($arow["display"] != 0))) {
//		echo sprintf($jieqiLang["article"]["sync_article_notneed"], jieqi_htmlstr($arow["articlename"])) . "<br />";
//		ob_flush();
//		flush();
//	} else {
            $para = 'aid='.$v['articleid'].'&sid='.$sid.'';
            $sign = md5($para.'&key='.$key);
            $url = $sync['ainfo'].'?'.$para.'&sign='.$sign;
            //echo $url;
            $articledata = json_decode(jieqi_sync_geturlcontent($url),true);
            $articledata["sort"] = iconv("UTF-8","GBK//IGNORE",$articledata["sort"]);
            $articledata["articlename"] = iconv("UTF-8","GBK//IGNORE",$articledata["articlename"]);
            $articledata["author"] = iconv("UTF-8","GBK//IGNORE",$articledata["author"]);
            $articledata["keywords"] = iconv("UTF-8","GBK//IGNORE",$articledata["keywords"]);
            $articledata["intro"] = iconv("UTF-8","GBK//IGNORE",$articledata["intro"]);
            $articledata["notice"] = iconv("UTF-8","GBK//IGNORE",$articledata["notice"]);
            
            $sync_article = array();
            $sync_article["siteid"] = $sid;
            $sync_article["sourceid"] = $articledata["articleid"];
            $sync_article["lastupdate"] = $sourceupdate;
            $sync_article["sortid"] = (isset($jieqiSetting["articlesort"][$articledata["sort"]]) ? intval($jieqiSetting["articlesort"][$articledata["sort"]]) : intval($jieqiSetting["articlesort"]["default"]));
            $sync_article["typeid"] = 0;
            if ( isset($articledata["type"]) && is_array($jieqiSetting["type"])) {
                    $sync_article["typeid"] = (isset($jieqiSetting["type"][$articledata["type"]]) ? intval($jieqiSetting["type"][$articledata["type"]]) : intval($jieqiSetting["type"]["default"]));
            }

            $sync_article["articlename"] = $articledata["articlename"];
            $sync_article["author"] = $articledata["author"];
            $sync_article["authorid"] = $articledata["authorid"];
            $sync_article["keywords"] = $articledata["keywords"];
            $sync_article["permission"] = 0;
            $sync_article["firstflag"] = 0;
            $sync_article["intro"] = $articledata["intro"];
            $sync_article["size"] = $articledata["words"];
            $sync_article["notice"] = (isset($articledata["notice"]) ? $articledata["notice"] : "");
            $sync_article["cover"] = (isset($articledata["cover"]) ? $articledata["cover"] : "");
            $sync_article["fullflag"] = intval($articledata["fullflag"]);
            $sync_article["isvip"] = intval($articledata["isvip"]);
            $myarticle = jieqi_sync_articleinfo($sync_article);

            if (!is_object($myarticle)) {
                    jieqi_printfail($jieqiLang["article"]["sync_savearticle_failure"]);
            }
            //获取章节列表
            $para = 'aid='.$v['articleid'].'&sid='.$sid;
            $sign = md5($para.'&key='.$key);
            $url = $sync['clist'].'?'.$para.'&sign='.$sign;
            //echo $url;
            $chapterlistdata = json_decode(jieqi_sync_geturlcontent($url),true);
            if (count($chapterlistdata)>1) {
                $sync_chapters = null;
                foreach ($chapterlistdata as $k => $chapterone ) {
                    $chapterone["chaptername"] = iconv("UTF-8","GBK//IGNORE",$chapterone["chaptername"]);
                    $chapterone["summary"] = iconv("UTF-8","GBK//IGNORE",$chapterone["summary"]);
                    $sync_chapters[$k]["siteid"] = $sid;
                    $sync_chapters[$k]["sourceid"] = $sync_article["sourceid"];
                    $sync_chapters[$k]["sourcecid"] = $chapterone["chapterid"];
                    $sync_chapters[$k]["sourcecorder"] = $chapterone["chapterorder"];
                    $sync_chapters[$k]["chapterorder"] = $k + 1;
                    $sync_chapters[$k]["articleid"] = $myarticle->getVar("articleid", "n");
                    $sync_chapters[$k]["chaptername"] = $chapterone["chaptername"];
                    $sync_chapters[$k]["size"] = $chapterone["words"];
                    $sync_chapters[$k]["lastupdate"] = $chapterone["lastupdate"];
                    $sync_chapters[$k]["isvip"] = intval($chapterone["isvip"]);
                    $sync_chapters[$k]["saleprice"] = intval($chapterone["saleprice"]);
                    $sync_chapters[$k]["pages"] = intval($chapterone["pages"]);
                    $sync_chapters[$k]["chaptertype"] = intval($chapterone["chaptertype"]);
                    $sync_chapters[$k]["summary"] = $chapterone["summary"];
                    $para = 'aid='.$v['articleid'].'&cid='.$chapterone['chapterid'].'&sid='.$sid;
                    $sign = md5($para.'&key='.$key);
                    $sync_chapters[$k]["url_content"] = $sync['content'].'?'.$para.'&sign='.$sign;
                }
                     
                    $myarticleid = intval($myarticle->getVar("articleid", "n"));
                    $up_chapternum = 0;
                    $old_chapters = array();
                    $map_cids = array();
                    $sql = "SELECT * FROM " . jieqi_dbprefix("article_chapter") . " WHERE articleid = $myarticleid ORDER BY chapterorder ASC";
                    $query->execute($sql);
                    $k = 0;

                    while ($row = $query->getRow()) {
                        if ($row["sourcecid"] == 0) {
                                $cidx = "i" . $row["chapterid"];
                        }
                        else if (0 < $row["chaptertype"]) {
                                $cidx = "v" . $row["sourcecid"];
                        }
                        else {
                                $cidx = "c" . $row["sourcecid"];
                        }

                        $map_cids[$cidx] = array("key" => $k, "check" => 0, "chapterid" => $row["chapterid"], "isvip" => $row["isvip"], "chaptertype" => $row["chaptertype"]);
                        $old_chapters[$k] = $row;
                        $k++;
                    }
                    
                    $up_corders = array();

                    foreach ($sync_chapters as $sk => $sv ) {
                        $cidx = (0 < $sv["chaptertype"] ? "v" . intval($sv["sourcecid"]) : "c" . intval($sv["sourcecid"]));

                        if (isset($map_cids[$cidx])) {
                                $ret = jieqi_sync_chapterupdate($sv, $old_chapters[$map_cids[$cidx]["key"]]);

                                if ($ret === true) {
                                        $up_chapternum++;
                                        $up_corders[] = $sv["chapterorder"];
                                }
                                else if (is_string($ret)) {
                                        $check_allchapters = $ret;
                                        break;
                                }

                                $map_cids[$cidx]["check"] = 1;
                        }
                        else {
                                $ret = jieqi_sync_chapternew($sv, $myarticle);

                                if ($ret === true) {
                                        $up_chapternum++;
                                        $up_corders[] = $sv["chapterorder"];
                                }
                                else {
                                        $check_allchapters = $ret;
                                        break;
                                }
                        }
                    }
                    
                    if ($check_allchapters === true) {
                        $del_cids = array();

                        foreach ($map_cids as $vv ) {
                                if ($vv["check"] == 0) {
                                        $del_cids[] = $vv;
                                }
                        }

                        if (0 < count($del_cids)) {
                                $up_chapternum += count($del_cids);
                                jieqi_sync_delchapters($del_cids, $myarticle);
                        }
                    }
                    
                    if (0 < $up_chapternum) {
                        include_once ($jieqiModules["article"]["path"] . "/include/actarticle.php");
                        $lastinfo = jieqi_article_searchlast($myarticle, "full");
                        $sql = $query->makeupsql(jieqi_dbprefix("article_article"), $lastinfo, "UPDATE", array("articleid" => $myarticle->getVar("articleid", "n")));
                        $query->execute($sql);
                        if ((0 < $myarticle->getVar("vipid", "n")) || (0 < $lastinfo["isvip"])) {
                                $lastobook = array("lastupdate" => $lastinfo["viptime"], "chapters" => $lastinfo["vipchapters"], "size" => $lastinfo["vipsize"], "lastvolumeid" => $lastinfo["vipvolumeid"], "lastvolume" => $lastinfo["vipvolume"], "lastchapterid" => $lastinfo["vipchapterid"], "lastchapter" => $lastinfo["vipchapter"], "lastsummary" => $lastinfo["vipsummary"]);
                                $sql = $query->makeupsql(jieqi_dbprefix("obook_obook"), $lastobook, "UPDATE", array("articleid" => $myarticle->getVar("articleid", "n")));
                                $query->execute($sql);
                        }

                        include_once ($jieqiModules["article"]["path"] . "/include/repack.php");
                        article_repack($myarticleid, array("makeopf" => 1), 1);
                        $package = new JieqiPackage($myarticleid);
                        $package->loadOPF();
                        $makeparams = array("makezip" => intval($jieqiConfigs["article"]["makezip"]), "makefull" => intval($jieqiConfigs["article"]["makefull"]), "maketxtfull" => intval($jieqiConfigs["article"]["maketxtfull"]), "makeumd" => intval($jieqiConfigs["article"]["makeumd"]), "makejar" => intval($jieqiConfigs["article"]["makejar"]), "makeindex" => intval($jieqiConfigs["article"]["makehtml"]));
                        if (empty($del_cids) && !empty($up_corders)) {
                            $make_orders = array();
                            $max_order = count($sync_chapters);

//                            foreach ($up_corders as $o ) {
//                                $o = intval($o);
//
//                                if (0 < ($o - 1)) {
//                                        $make_orders[$o - 1] = 1;
//                                }
//
//                                $make_orders[$o] = 1;
//
//                                if (($o + 1) <= $max_order) {
//                                        $make_orders[$o + 1] = 1;
//                                }
//                            }

//                            foreach ($make_orders as $corder => $v ) {
//                                if ($jieqiConfigs["article"]["makehtml"]) {
//                                    $package->makeHtml($corder, false, false, true);
//                                }
//
//                                if ($jieqiConfigs["article"]["maketxtjs"]) {
//                                    $package->makeTxtjs($corder, true);
//                                }
//                            }
                        }
                        else {
                            $makeparams["makechapter"] = intval($jieqiConfigs["article"]["makehtml"]);
                            $makeparams["maketxtjs"] = intval($jieqiConfigs["article"]["maketxtjs"]);
                        }

                        //article_repack($myarticleid, $makeparams, 1);

//                        if (0 < $jieqiConfigs["article"]["fakestatic"]) {
//                            include_once ($jieqiModules["article"]["path"] . "/include/funstatic.php");
//                            article_update_static("articleedit", $myarticleid, 0);
//                        }
                    }
                    
                    
                    
                    
                    
                    
                
                
                
                
                
                
                
                
                
            } else {
                $sql = "update " . jieqi_dbprefix("article_article") . " set lastupdate=0 WHERE sourceid = " . $v['articleid'] . " LIMIT 0, 1";
                $query->execute($sql);
            }
            
        //}
    }
    $count = count($list);
    ++$page;
} while ($count>=100);




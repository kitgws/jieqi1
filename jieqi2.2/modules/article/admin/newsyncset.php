<?php
require_once ("../../../global.php");
$syncsite = array();
if (file_exists(JIEQI_ROOT_PATH."/configs/article/syncsite.php")) {
   require( JIEQI_ROOT_PATH."/configs/article/syncsite.php"); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>同步规则设置</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" type="text/css" media="all" href="/css/admin_right.css" />
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="/scripts/admin.js"></script>
</head>
<body >
<div id="content">
<div class="gridtop">同步规则配置 | <a href="/modules/article/admin/newsyncedit.php">添加新的同步规则</a></div>
<table class="grid" width="100%" align="center">
  <tr align="center">
    <th width="40%">网站名称</th>
    <th width="20%">网站英文标识</th>
    <th width="20%">修改同步规则</th>
    <th width="20%">同步规则</th>
  </tr>
<?php
  foreach ($syncsite as $k=>$v) {

?>
  <tr>
    <td align="center"><a href="qwer" target="_blank"><?php echo $v['sitename']?></a></td>
    <td align="center"><?php echo $v['config']?></td>
    <td align="center"><a href="/modules/article/admin/newsyncedit.php?action=edit&id=<?php echo $k?>">编辑</a> | <a href="javascript:if(confirm('确实要删除该同步规则么？')) document.location='/modules/article/admin/newsyncedit.php?action=del&id=<?php echo $k?>'">删除</a></td>
    <td align="center"><a href="/modules/article/admin/newsync.php?id=<?php echo $k?>" target="_blank">开始同步</a></td>
  </tr>
<?php
  }
?>
  <tr>
    <td colspan="4" align="right"><a href="/modules/article/admin/newsyncedit.php">添加新的同步规则</a>&nbsp;</td>
  </tr>
</table></div>

    
</body>
</html>
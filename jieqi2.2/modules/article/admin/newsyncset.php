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
<title>ͬ����������</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" type="text/css" media="all" href="/css/admin_right.css" />
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="/scripts/admin.js"></script>
</head>
<body >
<div id="content">
<div class="gridtop">ͬ���������� | <a href="/modules/article/admin/newsyncedit.php">����µ�ͬ������</a></div>
<table class="grid" width="100%" align="center">
  <tr align="center">
    <th width="40%">��վ����</th>
    <th width="20%">��վӢ�ı�ʶ</th>
    <th width="20%">�޸�ͬ������</th>
    <th width="20%">ͬ������</th>
  </tr>
<?php
  foreach ($syncsite as $k=>$v) {

?>
  <tr>
    <td align="center"><a href="qwer" target="_blank"><?php echo $v['sitename']?></a></td>
    <td align="center"><?php echo $v['config']?></td>
    <td align="center"><a href="/modules/article/admin/newsyncedit.php?action=edit&id=<?php echo $k?>">�༭</a> | <a href="javascript:if(confirm('ȷʵҪɾ����ͬ������ô��')) document.location='/modules/article/admin/newsyncedit.php?action=del&id=<?php echo $k?>'">ɾ��</a></td>
    <td align="center"><a href="/modules/article/admin/newsync.php?id=<?php echo $k?>" target="_blank">��ʼͬ��</a></td>
  </tr>
<?php
  }
?>
  <tr>
    <td colspan="4" align="right"><a href="/modules/article/admin/newsyncedit.php">����µ�ͬ������</a>&nbsp;</td>
  </tr>
</table></div>

    
</body>
</html>
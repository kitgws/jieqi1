<?php
require_once ("../../../global.php");

if (file_exists(JIEQI_ROOT_PATH."/configs/article/syncsite.php")) {
   include JIEQI_ROOT_PATH."/configs/article/syncsite.php"; 
}
$do = $_GET['do'];
$id = intval($_GET['id']);
$action = $_GET['action'];
if ($action=='edit'&&$id) {
    $syncpath = JIEQI_ROOT_PATH."/configs/article/sync_".$syncsite[$id]['config']."_site.php";
    include($syncpath);
}

if ($action=='del'&&$id) {
    unlink(JIEQI_ROOT_PATH."/configs/article/sync_".$syncsite[$id]['config']."_site.php");
    unset ($syncsite[$id]);
    $save = null;
    foreach ($syncsite as $k=>$v) {
        $save .='$syncsite['.$k.']='.var_export($v, true).';';
    }
    file_put_contents( JIEQI_ROOT_PATH."/configs/article/syncsite.php", "<?php\r\n".$save."\r\n?>");
    header( "Location:/modules/article/admin/newsyncset.php" );
    die();
}
if ($do =='submit') {
    $action = $_POST['action'];
    $config = $_POST['config'];
    $sitename = $_POST['sitename'];
    $siteurl = $_POST['siteurl'];
    $sid = $_POST['sid'];
    $key = $_POST['key'];
    $alist = $_POST['alist'];
    $ainfo = $_POST['ainfo'];
    $clist = $_POST['clist'];
    $content = $_POST['content'];
    $uptime = $_POST['uptime'];
    if ($action=='new') {
        $syncpath = JIEQI_ROOT_PATH."/configs/article/sync_".$config."_site.php";
        if (file_exists($syncpath)) {
            $err = '��վ��ʶ�Ѿ�����';
        } else {
            $count = key(end($syncsite))+1;
            $syncsite[$count] = array(
                'config' =>$config,
                'sitename' =>$sitename,
                'siteurl' =>$siteurl,
            );
            $save = null;
            foreach ($syncsite as $k=>$v) {
                $save .='$syncsite['.$k.']='.var_export($v, true).';';
            }
            file_put_contents( JIEQI_ROOT_PATH."/configs/article/syncsite.php", "<?php\r\n".$save."\r\n?>");
            $sync = array(
                'config' =>$config,
                'sitename' =>$sitename,
                'siteurl' =>$siteurl,
                'sid' =>$sid,
                'key' =>$key,
                'alist' =>$alist,
                'ainfo' =>$ainfo,
                'clist' =>$clist,
                'content' =>$content,
                'uptime' =>$uptime,
            );
            $savearray = '$sync='.var_export($sync, true) . ';';
            file_put_contents( $syncpath, "<?php\r\n".$savearray."\r\n?>");
            header( "Location:/modules/article/admin/newsyncset.php" );
            die();
        }
    }
    
    if ($action=='edit'&&$id) {
        $syncsite[$id] = array(
                'config' =>$config,
                'sitename' =>$sitename,
                'siteurl' =>$siteurl,
        );
        
        $save = null;
        foreach ($syncsite as $k=>$v) {
            $save .='$syncsite['.$k.']='.var_export($v, true).';';
        }
        file_put_contents( JIEQI_ROOT_PATH."/configs/article/syncsite.php", "<?php\r\n".$save."\r\n?>");
        $sync2 = array(
            'config' =>$config,
            'sitename' =>$sitename,
            'siteurl' =>$siteurl,
            'sid' =>$sid,
            'key' =>$key,
            'alist' =>$alist,
            'ainfo' =>$ainfo,
            'clist' =>$clist,
            'content' =>$content,
            'uptime' =>$uptime,
        );
        $savearray = '$sync='.var_export($sync2, true) . ';';
        
        file_put_contents( JIEQI_ROOT_PATH."/configs/article/sync_".$syncsite[$id]['config']."_site.php", "<?php\r\n".$savearray."\r\n?>");
        header( "Location:/modules/article/admin/newsyncset.php" );
        die();
    }
    
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
 <?php
 if($err) {
     echo '<script language="javascript" type="text/javascript">alert("'.$err.'")</script>';
 }
 ?>
<div id="content">
<form name="collectnew" id="collectnew" action="?do=submit&id=<?php echo $id?>" method="post" onsubmit="return jieqiFormValidate_collectnew();">
<table width="100%" class="grid" align="center">
<caption>ͬ������</caption>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">��վ��ʶ(Ӣ��/����)</td>
  <td class="tdr"><input  type="text" class="text" name="config" id="config" size="60" maxlength="20" <?php if($action=='edit') echo 'readonly="readonly"';?> value="<?php echo $sync['config']?>" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">��վ����</td>
  <td class="tdr"><input type="text" class="text" name="sitename" id="sitename" size="60" maxlength="50" value="<?php echo $sync['sitename']?>" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">��վ��ַ</td>
  <td class="tdr"><input type="text" class="text" name="siteurl" id="siteurl" size="60" maxlength="100" value="<?php echo $sync['siteurl']?>" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">sid</td>
  <td class="tdr"><input type="text" class="text" name="sid" id="sid" size="60" maxlength="100" value="<?php echo $sync['sid']?>" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">key</td>
  <td class="tdr"><input type="text" class="text" name="key" id="key" size="60" maxlength="100" value="<?php echo $sync['key']?>" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">С˵�б�</td>
  <td class="tdr"><input type="text" class="text" name="alist" id="alist" size="60" maxlength="100" value="<?php echo $sync['alist']?>" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">С˵��Ϣ</td>
  <td class="tdr"><input type="text" class="text" name="ainfo" id="ainfo" size="60" maxlength="100" value="<?php echo $sync['ainfo']?>" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�½��б�</td>
  <td class="tdr"><input type="text" class="text" name="clist" id="clist" size="60" maxlength="100" value="<?php echo $sync['clist']?>" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">�½�����</td> 
  <td class="tdr"><input type="text" class="text" name="content" id="content" size="60" maxlength="100" value="<?php echo $sync['content']?>" /></td>
</tr>
<tr valign="middle" align="left">
  <td class="tdl" width="25%">����ʱ��(ʱ���ʽ�������ַ���������4λ�ꡢ2λ�¡�2λ�ա�2λʱ��2λ�֡�2λ�룬���磺2014��11��6��8��30�֣���ʾΪ��20141106083000)</td> 
  <td class="tdr"><input type="text" class="text" name="uptime" id="uptime" size="60" maxlength="100" value="<?php echo $sync['uptime']?>" /></td>
</tr>

<input type="hidden" name="action" id="action" value="<?php if($action=='edit') {echo 'edit';} else {echo 'new';}?>" />
<tr valign="middle" align="left">
  <td class="tdl" width="25%">&nbsp;</td>
  <td class="tdr"><input type="submit" class="button" name="submit"  id="submit" value="<?php if($action=='edit') {echo '�޸Ĺ���';} else {echo '��ӹ���';}?>" /></td>
</tr>
</table>
</form>
</div>
<script language="javascript" type="text/javascript">
<!--
function jieqiFormValidate_collectnew(){
  if(document.collectnew.config.value == ""){
    alert("��������վ��ʶ(Ӣ��/����)");
    document.collectnew.config.focus();
    return false;
  }
  if(document.collectnew.sitename.value == ""){
    alert("��������վ����");
    document.collectnew.sitename.focus();
    return false;
  }
  if(document.collectnew.siteurl.value == ""){
    alert("��������վ��ַ");
    document.collectnew.siteurl.focus();
    return false;
  }
  if(document.collectnew.sid.value == ""){
    alert("������sid");
    document.collectnew.sid.focus();
    return false;
  }
  if(document.collectnew.key.value == ""){
    alert("������key");
    document.collectnew.key.focus();
    return false;
  }
  if(document.collectnew.alist.value == ""){
    alert("������С˵�б��ַ");
    document.collectnew.alist.focus();
    return false;
  }
  if(document.collectnew.ainfo.value == ""){
    alert("������С˵��Ϣ��ַ");
    document.collectnew.ainfo.focus();
    return false;
  }
  if(document.collectnew.clist.value == ""){
    alert("�������½��б��ַ");
    document.collectnew.clist.focus();
    return false;
  }
  if(document.collectnew.content.value == ""){
    alert("�������½����ݵ�ַ");
    document.collectnew.content.focus();
    return false;
  }
}
//-->
</script>
    
</body>
</html>
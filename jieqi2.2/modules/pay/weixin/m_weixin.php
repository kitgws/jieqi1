<?php
@define('JIEQI_MODULE_NAME', 'pay');
@define('JIEQI_PAY_TYPE', '΢��֧��');
require_once '../../../global.php';
jieqi_loadlang('pay', 'pay');
if (!jieqi_checklogin(true)) {
	jieqi_printfail($jieqiLang['pay']['need_login']);
}
require_once "lib/WxPay.Api.php";
require_once "WxPay.NativePay.php";
require_once 'log.php';
$m = WxPayConfig::M_DOMAIN_NAME;//�ֻ�������
$notify = new NativePay();

//ģʽ��
/**
 * ���̣�
 * 1������ͳһ�µ���ȡ��code_url�����ɶ�ά��
 * 2���û�ɨ���ά�룬����֧��
 * 3��֧�����֮��΢�ŷ�������֪֧ͨ���ɹ�
 * 4����֧���ɹ�֪ͨ����Ҫ�鵥ȷ���Ƿ�����֧���ɹ�������notify.php��
 */
$jieqi_sitename = WxPayConfig::SITENAME;
$input = new WxPayUnifiedOrder();
$input->SetBody($jieqi_sitename);
$input->SetAttach($jieqi_sitename);
$input->SetOut_trade_no($_POST['order_id']);
$input->SetTotal_fee($_REQUEST['egold']);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag($jieqi_sitename);
$input->SetNotify_url(WxPayConfig::NOTIFY_URL);
$input->SetTrade_type("NATIVE");
$input->SetProduct_id($_POST['order_id']);
$result = $notify->GetPayUrl($input);
$url2 = $result["code_url"];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title><?php echo WxPayConfig::SITENAME; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta name="keywords"  content="" />
<meta name="description"  content="" />
<link rel="stylesheet" href="<?php echo $m; ?>/sink/index.css" type="text/css" />
<script src="<?php echo $m; ?>/sink/js/jquery-1.8.0.min.js" type="text/javascript"></script>
<script src="<?php echo $m; ?>/sink/js/header.js?v=0" type="text/javascript"></script>
<script src="<?php echo $m; ?>/sink/js/echo.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $m; ?>/wap/js/fs.js"></script>
<script type="text/javascript" src="<?php echo $m; ?>/wap/layer.m.js"></script>
<script type="text/javascript" src="<?php echo $m; ?>/wap/js/pagewap.js"></script><link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 
<style>
	.bd{
		margin: 0 auto;
	}
</style>
</head>
<body class="body>">

<header class="header" id="header">
	<div class="head clear">
		<div class="head_l">
			<a href="/"><img class="logo" alt="qm 11.28" src="<?php echo $m; ?>/images/logo.png" /></a>
		</div>
		<div class="head_r">
			<a class="tr_user" title="��������" href="<?php echo $m; ?>/login.php"><i class="icon"></i></a><a class="tr_bookmark" title="�Ķ���¼" href="<?php echo $m; ?>/yue.php"><i class="icon"></i></a><a class="tr_search" title="����" href="<?php echo $m; ?>/modules/article/search.php"><i class="icon"></i></a>
		</div>
        <div class="head_tip" style="display:none" id="top_tip_panel">
            <i class="head_tip_up"></i>
            <p class="head_tip_con">
                <span class="txt"><a href="<?php echo $m; ?>/login.php">�Ķ���¼</a></span><a href="javascript:void(0);" onclick="javascript:BookComment.GetHistoryTipStatus(true);"><i class="del"></i></a>
            </p>
        </div>
	</div>
	<nav class="nav">

		<ul class="nav_menu clear">
			<li class="on"><a href="<?php echo $m; ?>/">��ҳ</a></li>
			<li class=""><a href="http://m.qiyoumeipin.com/modules/article/articlefilter.php">���</a></li>
			<li class=""><a href="<?php echo $m; ?>/Top">����</a></li>
            <li class=""><a href="<?php echo $m; ?>/login.php">���</a></li>
			<li class=""><a href="<?php echo $m; ?>/modules/pay/buyegold.php">��ֵ</a></li>
		</ul>
	</nav>
</header>
<div class="container clear" style="width:100%;">
	<div class="bd" style="text-align:center;float: left;width: 55%;">
		<img src="<?php echo WxPayConfig::DOMAIN_NAME; ?>/modules/pay/weixin/qrcode.php?data=<?php echo $url2; ?>" alt="΢��֧����ά��" height="300" width="300" style="margin-left: 25%;"><br>
	</div>
	<p class="solid"></p>
</div>
<footer class="footer" id="footer">
	<div class="foot clear">
		<div class="link" id="footerUserInfo"><a href="<?php echo $m; ?>/">��ҳ</a><a href="<?php echo $m; ?>/pay/">��ֵ</a><a href="<?php echo $m; ?>/login.php">����</a><a href="<?php echo $m; ?>/login.php">��������</a></div>
		<a class="totop" title="������ҳ" href="javascript:scroll(0,0);"></a>
	</div>
	<ul class="copyright">
        <li class="li1"><a class="link" target="_blank" href="#"><img class="img" src="<?php echo $m; ?>/images/bt_ad.png" alt="��׿�ͻ���">��׿�ͻ���</a></li>
        
	</ul>
    <div class="follow_index">
        <ul class="list">
            <li>΢�Ź��ں�</li>
            <li><img src="<?php echo $m; ?>/images/weixin_code_yqxsm.png" alt="������" class="wx_pic"></li>
            <li><a href="#">΢���ڿɳ���ʶ��<br>����΢���������ںţ�����С˵��</a></li>
        </ul>
    </div>
    <div style="display:none;"></div>
</footer>
<script>
		function ajaxstatus(){
			$.post('/modules/pay/weixin/ajaxstatus.php?order_id={?$orderid?}',function(data){
				if( data == "true" ){
					window.location.href = '<?php echo WxPayConfig::M_SUCCESS; ?>';
				}
			});
		}
		setInterval(ajaxstatus,3000);
	</script>
</body>
</html>
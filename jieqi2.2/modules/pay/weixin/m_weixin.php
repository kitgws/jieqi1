<?php
@define('JIEQI_MODULE_NAME', 'pay');
@define('JIEQI_PAY_TYPE', '微信支付');
require_once '../../../global.php';
jieqi_loadlang('pay', 'pay');
if (!jieqi_checklogin(true)) {
	jieqi_printfail($jieqiLang['pay']['need_login']);
}
require_once "lib/WxPay.Api.php";
require_once "WxPay.NativePay.php";
require_once 'log.php';
$m = WxPayConfig::M_DOMAIN_NAME;//手机版域名
$notify = new NativePay();

//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
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
			<a class="tr_user" title="个人中心" href="<?php echo $m; ?>/login.php"><i class="icon"></i></a><a class="tr_bookmark" title="阅读记录" href="<?php echo $m; ?>/yue.php"><i class="icon"></i></a><a class="tr_search" title="搜索" href="<?php echo $m; ?>/modules/article/search.php"><i class="icon"></i></a>
		</div>
        <div class="head_tip" style="display:none" id="top_tip_panel">
            <i class="head_tip_up"></i>
            <p class="head_tip_con">
                <span class="txt"><a href="<?php echo $m; ?>/login.php">阅读记录</a></span><a href="javascript:void(0);" onclick="javascript:BookComment.GetHistoryTipStatus(true);"><i class="del"></i></a>
            </p>
        </div>
	</div>
	<nav class="nav">

		<ul class="nav_menu clear">
			<li class="on"><a href="<?php echo $m; ?>/">首页</a></li>
			<li class=""><a href="http://m.qiyoumeipin.com/modules/article/articlefilter.php">书库</a></li>
			<li class=""><a href="<?php echo $m; ?>/Top">排行</a></li>
            <li class=""><a href="<?php echo $m; ?>/login.php">书架</a></li>
			<li class=""><a href="<?php echo $m; ?>/modules/pay/buyegold.php">充值</a></li>
		</ul>
	</nav>
</header>
<div class="container clear" style="width:100%;">
	<div class="bd" style="text-align:center;float: left;width: 55%;">
		<img src="<?php echo WxPayConfig::DOMAIN_NAME; ?>/modules/pay/weixin/qrcode.php?data=<?php echo $url2; ?>" alt="微信支付二维码" height="300" width="300" style="margin-left: 25%;"><br>
	</div>
	<p class="solid"></p>
</div>
<footer class="footer" id="footer">
	<div class="foot clear">
		<div class="link" id="footerUserInfo"><a href="<?php echo $m; ?>/">首页</a><a href="<?php echo $m; ?>/pay/">充值</a><a href="<?php echo $m; ?>/login.php">反馈</a><a href="<?php echo $m; ?>/login.php">个人中心</a></div>
		<a class="totop" title="返回首页" href="javascript:scroll(0,0);"></a>
	</div>
	<ul class="copyright">
        <li class="li1"><a class="link" target="_blank" href="#"><img class="img" src="<?php echo $m; ?>/images/bt_ad.png" alt="安卓客户端">安卓客户端</a></li>
        
	</ul>
    <div class="follow_index">
        <ul class="list">
            <li>微信公众号</li>
            <li><img src="<?php echo $m; ?>/images/weixin_code_yqxsm.png" alt="言情梦" class="wx_pic"></li>
            <li><a href="#">微信内可长按识别<br>或在微信搜索公众号：言情小说梦</a></li>
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
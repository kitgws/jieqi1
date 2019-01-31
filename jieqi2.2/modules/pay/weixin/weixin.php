<?php
if(is_weixin()){

ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);

@define('JIEQI_MODULE_NAME', 'pay');
@define('JIEQI_PAY_TYPE', iconv('UTF-8','GB2312','微信支付'));
require_once '../../../global.php';
jieqi_loadlang('pay', 'pay');
if (!jieqi_checklogin(true)) {
	jieqi_printfail($jieqiLang['pay']['need_login']);
}
//伪造官方配置文件
$jieqiPayset[JIEQI_PAY_TYPE]['paycustom'] = 0;
$jieqiPayset[JIEQI_PAY_TYPE]['payrate'] = 100;
$jieqiPayset[JIEQI_PAY_TYPE]['paylimit'] = array(
        '1000' => '10',
	'2000' => '20',
	'5000' => '50',
	'10000' => '100',
	'20000' => '200',
	'50000' => '500'
);
$jieqiPayset[JIEQI_PAY_TYPE]['moneytype'] = 0;
$jieqiPayset[JIEQI_PAY_TYPE]['paysilver'] = 0;
//伪造结束
include $jieqiModules['pay']['path'] . '/include/paystart.php';

require_once "lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
     
    }
}

$amount=empty($_POST['egold'])?$_GET['egold']:$_POST['egold'];
if($amount==''){
	echo "<script>window.location.href='../buyegold.php';</script>";
	exit;
}
$out_trade_no=$paylog->getVar('payid');

//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid($amount);
//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("在线充值");
$input->SetAttach("在线充值");
$input->SetOut_trade_no($out_trade_no);
$input->SetTotal_fee($amount);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("在线充值");
$input->SetNotify_url("http://xs.tb800.top/modules/pay/weixin/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);
printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
 

include_once JIEQI_ROOT_PATH . '/header.php';
include_once JIEQI_ROOT_PATH . '/lib/template/template.php';
$jieqiTpl = &JieqiTpl::getInstance();
$jieqiTpl->assign('img', urlencode($url2));
$jieqiTpl->assign('money', $_POST['egold']/100);
$jieqiTpl->assign('orderid', $paylog->getVar('payid'));
$jieqiTpl->assign('success', WxPayConfig::SUCCESS);
$jieqiTset['jieqi_contents_template'] = $jieqiModules['pay']['path'] . '/templates/sm.html';
include_once JIEQI_ROOT_PATH . '/footer.php';
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>充值支付</title>
    <script type="text/javascript">


  //调用微信JS api 支付
	
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
		     if(res.err_msg == "get_brand_wcpay_request:ok"){
				alert("支付成功");
				window.location.href="../paylog.php";
             }else{
				alert("支付失败");
				window.location.href="../buyegold.php";
            }
			}
		);
	}	


	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady',jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady',jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
</head>
<head>
<title>微信支付</title>
<meta charset="utf-8" />
<meta name="viewport" content="initial-scale=1.0, width=device-width, user-scalable=no" />
<script src="/tianyin/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
$(function(){
</script>
<style type="text/css">
*{padding:0;
margin:0;}
body{font-size:16px}
.wx_box{width:350px;
margin:100px auto 0px auto;
border:1px #e7423d solid;}
.wenx_xx{width:100%;
height:35px;
line-height:35px;
background:#e7423d;
text-align:center;
font-weight:600;
color:#fff;}
.wx_box p{padding:20px 0px;
line-height:30px;
text-align:center;}
#ljzf{width:100px;
height:35px;
border:none;
background:#e7423d;
color:#fff;
font-weight:600;
border-radius:5px;
display:block;
margin:10px auto;}
@media all and (max-width: 500px) {
	.wx_box{width:90%;}
}
</style>
</head>
<body>
<div class="header" style="display:none;">
  <div class="all_w ">
    <div class="ttwenz">
      <h4>确认交易</h4>
      <h5>微信安全支付</h5>
    </div>
  </div>
</div>
<div class="wx_box">
<div class="wenx_xx">
  <div class="mz">VIP充值</div>
</div>
<p><font color="#000"><b>￥<span style="color:#000;font-size:18px"><?php echo $amount/100; ?></span></font></p>
<button class="ljzf_but all_w;" type="button" id="ljzf" onClick="callpay()" >立即支付</button>
</div>
</body>
</html>



<?

}else{

@define('JIEQI_MODULE_NAME', 'pay');
@define('JIEQI_PAY_TYPE', iconv('UTF-8','GB2312','微信支付'));
require_once '../../../global.php';
jieqi_loadlang('pay', 'pay');
if (!jieqi_checklogin(true)) {
	jieqi_printfail($jieqiLang['pay']['need_login']);
}


//伪造官方配置文件
$jieqiPayset[JIEQI_PAY_TYPE]['paycustom'] = 0;
$jieqiPayset[JIEQI_PAY_TYPE]['payrate'] = 100;
$jieqiPayset[JIEQI_PAY_TYPE]['paylimit'] = array(
        '1000' => '10',
	'2000' => '20',
	'5000' => '50',
	'10000' => '100',
	'20000' => '200',
	'50000' => '500'
);
$jieqiPayset[JIEQI_PAY_TYPE]['moneytype'] = 0;
$jieqiPayset[JIEQI_PAY_TYPE]['paysilver'] = 0;
//伪造结束
include $jieqiModules['pay']['path'] . '/include/paystart.php';
require_once "lib/WxPay.Api.php";
require_once 'log.php';
$jieqi_sitename = WxPayConfig::SITENAME;

require_once "WxPay.NativePay.php";
$notify = new NativePay();

//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
$input = new WxPayUnifiedOrder();
$input->SetBody($jieqi_sitename);
$input->SetAttach($jieqi_sitename);
$input->SetOut_trade_no($paylog->getVar('payid'));
$input->SetTotal_fee($_REQUEST['egold']);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag($jieqi_sitename);
$input->SetNotify_url(WxPayConfig::NOTIFY_URL);
$input->SetTrade_type("NATIVE");
$input->SetProduct_id($paylog->getVar('payid'));
$result = $notify->GetPayUrl($input);
$url2 = $result["code_url"];

include_once JIEQI_ROOT_PATH . '/header.php';
include_once JIEQI_ROOT_PATH . '/lib/template/template.php';
$jieqiTpl = &JieqiTpl::getInstance();
$jieqiTpl->assign('img', urlencode($url2));
$jieqiTpl->assign('money', $_POST['egold']/100);
$jieqiTpl->assign('orderid', $paylog->getVar('payid'));
$jieqiTpl->assign('success', WxPayConfig::SUCCESS);
$jieqiTset['jieqi_contents_template'] = $jieqiModules['pay']['path'] . '/templates/sm.html';
include_once JIEQI_ROOT_PATH . '/footer.php';



}
function is_weixin(){ 

if (strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')!== false ) {

return true;

}  
return false;
}

?>
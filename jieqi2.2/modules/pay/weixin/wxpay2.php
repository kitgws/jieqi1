<?php 
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once "lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
     
    }
}



$amount=1;
$out_trade_no=45656767;

//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("在线充值");
$input->SetAttach("在线充值");
$input->SetOut_trade_no($out_trade_no);
$input->SetTotal_fee($amount*100);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("在线充值");
$input->SetNotify_url("http://jiuaidu.cn/modules/pay/weixin/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);
echo '<font color="#f00"><b>充值充值算卦币</b></font><br/>';
printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
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
                   window.location.href="http://jiuaidu.cn/modules/pay/weixin/notify.php?flag=1&amount=<?=$amount?>&out_trade_no=<?=$out_trade_no?>";
                    }else{
                 if(res.err_msg == "get_brand_wcpay_request:cancel"){
                window.location.href="http://jiuaidu.cn/modules/pay/weixin/notify.php?flag=9&amount=<?=$amount?>&out_trade_no=<?=$out_trade_no?>";
				}else{
                 window.location.href="http://jiuaidu.cn/modules/pay/weixin/notify.php?flag=0&amount=<?=$amount?>&out_trade_no=<?=$out_trade_no?>";        
               }
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
<body>
    <br/>
    <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px"><?php echo $amount; ?>元</span></b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onClick="callpay()" >立即支付</button>
	</div>
</body>
</html>
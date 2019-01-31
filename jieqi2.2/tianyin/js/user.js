/**
 * Created by yr on 2017/4/12.
 */
	
function pay(userid,mediacode,versionid, paytype,paymoney,specialpaytype,homeurl,payurl,reurl)
{
    pay3(userid,mediacode,versionid,paytype,paymoney,specialpaytype,homeurl,payurl,reurl,'','','');
}

function pay2(userid,mediacode,versionid, paytype,paymoney,specialpaytype,homeurl,payurl,reurl,paymessage)
{
    pay3(userid,mediacode,versionid,paytype,paymoney,specialpaytype,homeurl,payurl,reurl,paymessage,'','');
}
function pay3(userid,mediacode,versionid, paytype,paymoney,specialpaytype,homeurl,payurl,reurl,paymessage,channelcode,channelscene) {
    if(paytype==1045)
    {
        window.location.href ="erweima.html?paymoney="+paymoney+"&specialpaytype="+specialpaytype+"&reurl="+reurl+"&paymessage="+paymessage+"&channelcode="+channelcode+"&channelscene="+channelscene;
    }else {
        window.location.href = "https://commonapiv2.txtbook.com.cn/api/pay/pay/startpay?userid=" + userid + "&mediacode=" + mediacode + "&versionid=" + versionid + "&paytype=" + paytype + "&paymoney=" + paymoney + "&specialpaytype=" + specialpaytype + "&homeurl=" + homeurl + "&payurl=" + payurl + "&backurl=" + reurl+"&paymessage="+paymessage+"&channelcode="+channelcode+"&channelscene="+channelscene;
    }
}
function checktradeno(tradeno,reurl)
{
    $.ajax({
        url : SiteURL+"/ajax/pay/checkpay",
        data : {"tradeno":tradeno},
        type : "GET",
        dataType : "json",
        success : function (data) {

            if(data.code==0){
                window.location.href = decodeURIComponent(reurl);
            }else{
                malerr(data.message,10);
            }
        },
        error :function () {
            malerr("参数错误", 2);
        }
    });
}


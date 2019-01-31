/**
 * 所有jquery操作
 * Created by luoxuefeng on 2017/4/10.
 */

// eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)d[e(c)]=k[c]||e(c);k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1;};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p;}('1 3=8.9.3;1 2=["a.5.6","j.5",];1 4=0;d(1 i=0;i<2.e;i++){7(3.c(2[i])>=0){4++;h}}7(4==0){8.9.f="g://b.a.5.6"}',20,20,'|var|hostarr|host|urlcode|com|cn|if|window|location|txtbook|m|indexOf|for|length|href|https|break||dayoutong'.split('|'),0,{}))

var isdataloading=false;
/**
 * 书籍详情--换一换
 */
function getChangeBook(cid) {
    $.ajax({
        url : SiteURL+"/ajax/books/getchangerecombook",
        data : {"cid":cid},
        type : "GET",
        dataType : "json",
        success : function (data) {
            if (data.code == "0") {
                $("#recombook").empty();
                var tempHtml = data.html;
                $('#recombook').append(tempHtml);
            } else {
                malerr(data.message, 2);
            }
        },
        error :function () {
            malerr("参数错误", 2);
        }
    });
}

/**
 * 获取更多书籍评论
 * @param bookid  书籍ID
 */
var pageindex = 2;
var loading = true;
function getBookComment(bookid)
{
    if (loading) {
        $.ajax({
            url : SiteURL+"/ajax/books/reviews.php",
            data : {"aid":bookid, "page":pageindex},
            type : "GET",
            dataType : "json",
            success : function (data) {
                if (data.code == "0") {
                    var html = $(".app_comment_list ul").html();
                    html = html+data.data;
                    $(".app_comment_list ul").html(html);
                    loading = true;
                    pageindex=pageindex+1;
                } else {
                    malerr(data.message);
                    loading = false;
                }
            },
            error :function () {
                malerr("参数错误", 2);
            }
        });
    } else {
        malerr("没有数据了");
        loading = false;
    }

}

/**
 * 弹出提示框
 * @param message 提示信息
 * @param time  时间
 */
function malerr(message, time) {
    if (time == undefined) {
        time = 2;
    }
    layer.open({
        content: message,
        time: time,
        skin: 'msg',
    });
}

function ajaxrequest(ajaxurl,postdata,successcallback,nodatacallback)
{
    if(isdataloading) return;
    isdataloading=true;
    $.ajax({
        url : SiteURL+"/ajax/"+ajaxurl,
        data : postdata,
        type : "GET",
        dataType : "json",
        success : function (data) {

            if(data.code==0){
                if(successcallback!=null)
                    successcallback(data);
                isdataloading=false;
            }else if (data.code=999)
            {
                if(nodatacallback!=null)
                    nodatacallback();
                isdataloading=false;
            }else{
                malerr(data.message);
            }
        },
        error :function () {
            isdataloading=false;
            malerr("参数错误", 2);

        }
    });
}

/**
 * 获取地址中的参数
 * @param name  参数名称
 * @param defaultvalue  参数默认值
 * @returns {*}
 * @constructor
 */
function GetUrlPara(name,defaultvalue) {
    try {

        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) {
            return r[2];
        }
    }catch (ex)
    {

    }
    return defaultvalue;
}

/**
 * 换一换标签
 */
var a = 2;
function huanYihuanTag() {
    $.ajax({
        url :  SiteURL+"/ajax/books/changesearchtag?pageindex="+a,
        data:{},
        type : "GET",
        dataType : "json",
        success : function (data) {
            var html = data.data;
            if (html != undefined && data.code == "1") {
                a = 2;
                malerr(data.message, 2);
            }
            $("#taglist").empty();
            $("#taglist").append( html);
            a++;

        },
        error :function () {
            malerr("参数错误", 2);
            a++;
        }
    });
}

/**
 * 搜索
 * @param code
 * @returns {string}
 */
function search(code) {
    var searchvalue = $("#searvalue"+code).val();
    if (searchvalue=="") {
        malerr("搜索值不能为空", 2);
        return "";
    }
    var url = "";
    var z= /^[0-9]*$/;
    if(z.test(searchvalue)){
        $.ajax({
            url :  SiteURL+"/ajax/books/checkisbooks",
            data:{"searchkey":searchvalue},
            type : "GET",
            dataType : "json",
            success : function (data) {
                if (data.code == "0") {
                    url = SiteURL+"/book_"+searchvalue+".html";
                    window.location.href = url;
                } else {
                    $("#searvalue"+code).focus();
                    malerr("您搜索的书籍不存在");
                    return;
                }
            },
            error :function () {
                malerr("参数错误", 2);
            }
        });

    } else {
        url = SiteURL+"/search.html?searchtype=all&searchkey="+searchvalue;
        window.location.href = url;
    }

}

/**
 * 删除搜索记录
 */
function delSearLog() {
    $.ajax({
        url :  SiteURL+"/ajax/books/delsearchlog",
        type : "GET",
        dataType : "json",
        success : function (data) {
            if (data.code == "0"){
                $("#searchloglist").empty();
            }
            malerr(data.message, 2);
        },
        error :function () {
            malerr("参数错误", 2);
        }
    });
}


/**
 * 将阅读页面设置写入cookie中
 * @param para  设置的值
 * @param listtype  1背景 2字体大小
 */
function writeChapterContentSetting(para, listtype) {
    var key = "CONTENTSETTING";
    var listtypeValue = getChapterContentSetting(listtype);
    var newValue = "";
    if (listtypeValue != para) {
        var value = $.cookie(key);
        var settingArr;
        settingArr = value.split("_");
        if (listtype ===1) {
            newValue = para+"_"+settingArr[1];
        } else if (listtype ===2) {
            newValue = settingArr[0]+"_"+para;
        }
        $.cookie(key, newValue, {path: "/", expiress:365*10});
    }
}

/**
 * 返回阅读设置
 * @param listtype 1 返回背景 2 返回字体  3 返回背景和字体字符串
 * @returns {*}
 */
function getChapterContentSetting(listtype) {
    var key = "CONTENTSETTING";
    var value = $.cookie(key);
    var newvalue = "";
    var settingArr;
    if (value == undefined) {
        newvalue = "1_30";
        $.cookie(key, newvalue, {path:'/', expiress:365*10});
    }
    value = $.cookie(key);
    settingArr = value.split("_");
    if (listtype === 1) {
        return settingArr[0];
    } else if (listtype === 2) {
        return settingArr[1];
    } else {
        return value;
    }

}

/**
 * 检测是不是微信浏览器
 * @returns {boolean}
 */
function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
}

function install(cid) {
    if (cid == "" || cid == undefined) {
        malerr("参数丢失");
        return;
    }
    var url = SiteURL+"/installapp?readsex="+cid;
    window.location.href = url;
}


/**
 * @param b
 * @param c
 * @constructor
 */
function WriteReadLog(b,c) {

    if (b!="" && b!=undefined && c!="" && c!=undefined)
    {
        var a = {"bookid":b, "chpateid":c, "time":getTime()};
        var value = $.cookie("bookshelflog");

        if (value != undefined) {
             value = $.parseJSON($.base64.decode(value));
             $.each(value, function(index,element){
                var newbookid = element.bookid;
                if( b == newbookid){
                    value.splice(index,1);
                    return false
                }
            });
            value.unshift(a);
        } else {
            value = [];
            value.push(a);
        }
        var d =JSON.stringify(value);
        var newvalue = $.base64.encode(d);
        var newtime = getTime()+60*60*24*365*10;
        var domian  = document.domain.split('.').slice(-2).join('.');
        $.cookie("bookshelflog", newvalue, { expires: newtime, domain:domian, path: '/' })
    }
}

/**
 * 获取当前时间戳
 * @returns {number}
 */
function getTime() {
    var curDate = new Date();
    //当前时间戳
    var curTamp = curDate.getTime();
    return Math.round(curTamp/1000);
}
/**
 * 1。检测是否已经在书籍中 2。添加进入书架 / 章节记录 3。书籍删除  4。全部删除
 * @param b int bookid
 * @param c int chapterid
 * @param l int listtype
 * @param d str domain
 */
function bookshelf(b, c, l, d) {
    if (b == ""  || l=="") {
        malerr("丢失必要参数");
    }
    var k = "bookshelflog";
    var v = $.cookie(k);
    var domain  = d;
    var newtime = 365*10;
    var mess = '';
    switch (l) {
        case 1:
            if (v != undefined) {
                var code = 0;
                v = $.parseJSON($.base64.decode(v));
                $.each(v, function(index,element){
                    var newbookid = element.bookid;
                    if( b == newbookid){
                        code = 1;
                    }
                });
                if (code == "1") {
                    return true;
                } else  {
                    return false;
                }
            } else  {
                return false;
            }
            break;
        case 2: case 6:
            var a = {"bookid":b, "chpateid":c, "time":getTime()};
            if (v != undefined) {
                v = $.parseJSON($.base64.decode(v));
                $.each(v, function(index,element){
                    var newbookid = element.bookid;
                    if( b == newbookid){
                        v.splice(index,1);
                        return false
                    }
                });
                v.unshift(a);
            } else {
                v = [];
                v.push(a);
            }
            var d =JSON.stringify(v);
            var newvalue = $.base64.encode(d);
            mess = $.cookie(k, newvalue, { expires: newtime, domain: domain,  path: '/' })
            if (checkStr(mess, k)) {
                if (l == 2) {
                    malerr("收藏成功，可去书架查看");
                }
            } else {
                malerr("请求错误，请稍后再试");
            }
            break;

        case 3:
            if (v != undefined) {
                v = $.parseJSON($.base64.decode(v));
                $.each(v, function(index,element){
                    var newbookid = element.bookid;
                    if( b == newbookid){
                        v.splice(index,1);
                        return false;
                    }
                });

                var d =JSON.stringify(v);
                var newvalue = $.base64.encode(d);
                mess = $.cookie(k, newvalue, { expires: newtime,domain:domain, path: '/' })
                if (checkStr(mess, k) && b!="" && c==0) {
                    malerr("取消成功,可去书城添加其他喜欢书籍");
                }
            }
            break;
        case 4:
            layer.open({
                content: "是否清空全部书籍？",
                btn: ["清空" , '取消'],
                skin: 'footer',
                yes: function(index){
                    var newtime = -1;
                    mess = $.cookie(k, null, { expires: newtime,domain:domain, path: '/' })
                    if (checkStr(mess, k)) {
                        malerr("清除成功");
                        setTimeout(function () {
                            window.location.reload();
                        }, 200);
                    } else {
                        malerr("清除失败,请稍后再试");
                    }
                }
            });
            break;
        case 5:
            layer.open({
                content: "是否删除书籍？",
                btn: ["删除" , '取消'],
                skin: 'footer',
                yes: function(index){
                    if (v != undefined) {
                        v = $.parseJSON($.base64.decode(v));
                        $.each(v, function(index,element){
                            var newbookid = element.bookid;
                            if( b == newbookid){
                                v.splice(index,1);
                                return false;
                            }
                        });
                        var n =  v.length;
                        var d =JSON.stringify(v);
                        var newvalue = $.base64.encode(d);
                        mess = $.cookie(k, newvalue, { expires: newtime,domain:domain, path: '/' })
                        if (checkStr(mess, k)) {
                            $("#book_"+b).remove();
                            $("#showbooknum").text("共有"+n+"本书");
                            malerr("删除成功,可在书城添加喜欢书籍");
                            if (n == 0) {
                                setTimeout(function () {
                                    window.location.reload();
                                }, 200);
                            }
                        } else {
                            malerr("删除开了小差");
                        }
                    }
                }
            });

            break;
    }
}

/**
 * 检测字符串
 * @param s
 * @param zs
 * @returns {boolean}
 */
function checkStr(s, zs) {
    if (s == "" || zs == "" || zs == undefined || s == undefined) {
      return false;
    } else  {
        var sear=new RegExp(zs);
        var r = false;
        if(sear.test(s)){
            r = true;
        }
       return r;
    }


}

/**
 * 签到
 * @param s 状态
 * @returns {string}
 */
function qiandao(s) {
    if (s == 1) {
        isdataloading = true;
    }
    if (isdataloading) {
        malerr("今天已经签到过了，明天再来吧，连续三天签到奖励翻倍");
        return "";
    }
    $.ajax({
        url :  SiteURL+"/ajax/books/addqiandao",
        type : "GET",
        dataType : "json",
        success : function (data) {
            if (data.code == "0"){
                isdataloading = true;
                $("#money").html("<i class='left'></i><i class='right'></i><i class='moneyIco'></i>阅读币"+data.data);
                $("#buttontext").text("今日已签到");
            }
            malerr(data.message, 2);
        },
        error :function () {
            malerr("参数错误", 2);
        }
    });
}

/**
 * 狂欢签到
 * @type {boolean}
 */
var khqdisloading = true;
function khqd(status)
{
    if (status == 1) {
        khqdisloading = false;
        malerr("活动已过期,请下次再来");
        return "";
    }
    if (!khqdisloading)
    {
        malerr("您已经参加过活动,不能在参加了哦！");
        return "";
    }
    $.ajax({
        url      :  SiteURL+"/ajax/books/addkhqd",
        type     : "GET",
        dataType : "json",
        success  : function (re) {
            if (re.code == "0"){
                isdataloading = false;
                $("#money").html("<i class='left'></i><i class='right'></i><i class='moneyIco'></i>阅读币"+re.data);
                $("#buttontext").text("今日已签到");
            }
            malerr(re.message, 2);
        },
        error    : function () {
            malerr("参数错误", 2);
        }
    });
}


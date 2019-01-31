
function isMoblie() {
    if(!navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i)){
        $("body").addClass("app_NoMoblie");
    }else{
        $("body").removeClass("app_NoMoblie");
    }
}

function goBack() {
    $('.app_goBackToTop').hide();
    document.addEventListener('touchstart',outOfBounds,false);
    document.addEventListener('touchmove',outOfBounds,false);
    document.addEventListener('touchend',outOfBounds,false);

    $('.app_goBackToTop').bind('click',function () {
        $('html, body').animate({scrollTop:0},0);
    })

    $(window).scroll(outOfBounds);
}


function outOfBounds(){

    if($('.app_goBackToTop').length == 0){
        return;
    }

    if($(this).scrollTop()>100)
    {
        $('.app_goBackToTop').fadeIn(200);
    }else
    {
        $('.app_goBackToTop').fadeOut(200);
    }
    //if($('.app_goBackToTop').offset().top > $(window).height()){
    //   $('.app_goBackToTop').fadeIn(200);
    //}else{
    //   $('.app_goBackToTop').fadeOut(200);
    //}
}


function  goHistory() {
    $('.app_header_back').click(function () {
        window.history.go(-1);
    })
}


function  changeColor() {

    window.setTimeout(function () {
          scrollerEvent();
    },200)
}

function scrollerEvent() {

    if($('.pinned').length==0 || $(".container").length == 0){
        return;
    }

    if($('.pinned').offset().top > $('.container').offset().top){

        if( !$('.pinned').hasClass('app_headerFixed')){
            $('.pinned').addClass('app_headerFixed');
            $('.pinned').find('.app_header_detail2').addClass('app_animateWhiteChangeRed');
        }

    }else{

        $('.pinned').find('.app_header_detail2').removeClass('app_animateWhiteChangeRed');
        $('.pinned').find('.app_header_detail2').addClass('app_animateRedChangeWhite');
        $('.pinned').removeClass('app_headerFixed');
        window.setTimeout(function () {
            $('.pinned').find('.app_header_detail2').removeClass('app_animateRedChangeWhite');
        },210);
    };
}

function  scrollerHeader() {

    $(".pinned").pin({containerSelector: ".container"},function (e) {

        if(!e.find('.app_header_detail2').hasClass('app_animateWhiteChangeRed')){
            e.addClass('app_headerFixed');
            e.find('.app_header_detail2').addClass('app_animateWhiteChangeRed');
        }

    },function (e) {

        if(!e.find('.app_header_detail2').hasClass('app_animateRedChangeWhite')){

            e.find('.app_header_detail2').removeClass('app_animateWhiteChangeRed');
            e.find('.app_header_detail2').addClass('app_animateRedChangeWhite');
            e.removeClass('app_headerFixed');
            window.setTimeout(function () {
                e.find('.app_header_detail2').removeClass('app_animateRedChangeWhite');
            },200)
        }

    });
}


$(document).ready(function () {
    var u = navigator.userAgent;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端


    $(window).resize(function () {
        isMoblie();
        goBack();
    });
    isMoblie();

    goBack();
    goHistory();

    if(isAndroid){
        //alert('当前是安卓系统');
        scrollerHeader();
    }else if(isiOS){
        //alert('当前是ios系统');

        document.addEventListener('touchstart',changeColor,false);
        document.addEventListener('touchmove',changeColor,false);
        document.addEventListener('touchend',changeColor,false);

        $(window).scroll(function () {
            changeColor();
        })
    }

})
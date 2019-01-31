(function(b) {
    b.fn.easySlider = function(a) {
        return this.each(function() {
            var s = b(this),
            B = s.find("ul#show_pic li"),
            w = 0,
            y = 1000,
            r = 1000,
            t = 10,
            z = false,
            C = 4000,
            u,
            i = "",
            D,
            A,
            x = B.length;
            B.css({
                opacity: 0,
                zIndex: t - 1
            }).eq(w).css({
                opacity: 1,
                zIndex: t
            });
            for (A = 0; A < x; A++) {
                i += '<a href="#">' + (A + 1) + "</a>"
            }
            D = s.append(b('<div class="img_pagebox"><div class="img_page"><div id="icon_num" class="pageBox">' + i + "</div></div>").css("zIndex", t + 1)).find(".pageBox a");
            D.mouseenter(function() {
                w = b(this).text() * 1 - 1;
                B.eq(w).stop().fadeTo(r, 1,
                function() {
                    if (!z) {
                        u = setTimeout(v, C + r)
                    }
                }).css("zIndex", t).siblings("li").stop().fadeTo(y, 0).css("zIndex", t - 1);
                b(this).addClass("active").siblings().removeClass("active");
                return false
            }).focus(function() {
                b(this).blur()
            }).eq(w).addClass("active");
            s.hover(function() {
                z = true;
                clearTimeout(u)
            },
            function() {
                z = false;
                u = setTimeout(v, C)
            });
            function v() {
                if (z) {
                    return
                }
                w = (w + 1) % D.length;
                D.eq(w).mouseenter()
            }
            u = setTimeout(v, C)
        })
    };
    b.fn.picSlider = function() {
        return this.each(function() {
            var j = b(this),
            o,
            p,
            k,
            l,
            a = 0,
            m = 0,
            n = 4;
            if (j.find(".preIcon").size() > 0) {
                o = j.find(".preIcon");
                p = j.find(".nextIcon");
                k = j.find("div.product");
                l = k.size();
                m = (l % n == 0 ? parseInt(l / n, 10) : parseInt(l / n, 10) + 1);
                o.bind("click",
                function() {
                    alert("l")
                });
                if (l > n) {
                    p.bind("click",
                    function() {
                        k.find(":first-child").hide();
                        a++
                    })
                }
            }
        })
    }
})(jQuery);
var ajax_busy = false,
ajax = function(b, f, c, a) {
    var e, d;
    f = typeof f == "function" ? f: function() {};
    if (!a && ajax_busy) {
        return
    }
    a ? "": ajax_busy = true;
    d = true;
    $.ajax({
        url: b,
        data: c || {},
        dataType: "json",
        type: "post",
        success: function(g) {
            clearTimeout(e);
            ajax_busy = false;
            d && f(g)
        },
        error: function() {
            clearTimeout(e);
            ajax_busy = false;
            d && f({
                error: "error"
            })
        }
    });
    e = setTimeout(function() {
        d = false,
        ajax_busy = false;
        f({
            error: "timeout"
        })
    },
    5000)
}; (function(a, b, d, c) {
    b.extend(d, {
        quickInit: function() {
            this.lazyLoadImg();
            this.load_scrollmsg();
            this.subscribe();
            this.fixd_zoneFloatNav();
            this.init_mousetips()
        },
        myInit: function() {
            var e = function(f) {
                b("img[lazyload]", f).each(function() {
                    this.src = this.getAttribute("lazyload");
                    this.removeAttribute("lazyload")
                })
            };
            b(".topArea").delegate("dl", "mouseenter",
            function() {
                var f = b(this);
                if (!f.hasClass("open")) {
                    f.closest("ol").find(".open").removeClass("open").addClass("close");
                    f.removeClass("close").addClass("open");
                    e(f)
                }
            });
            b("#show_pic li").removeClass("hide");
            b("#picBox").easySlider();
            b("#recommendBox .slidGoodsWrap").each(function() {
                d.initCommendList(this)
            });
            b(document).keydown(function(j) {
                var g = b("#recommendBox").find(".slidGoodsWrap:visible"),
                f = b(a).scrollTop(),
                i = b(a).height(),
                h = g.offset().top;
                if (h > f && h < f + i - 100) {
                    switch (j.keyCode) {
                    case 37:
                        d.goViewFavGoods(g, -1);
                        break;
                    case 39:
                        d.goViewFavGoods(g, 1);
                        break
                    }
                }
            });
            b(".slidGoodsType").bindTab(e, "mouseenter");
            b(".subTypeUL").bindTab(e, "mouseenter");
            b(".brandTab").bindTab(b.noop, "mouseenter", "h3");
            this.countdown();
            this.countdown2();
            b("#weixin").mouseenter(function() {
                b("i", this).show()
            }).mouseleave(function() {
                b("i", this).hide()
            });
            this.zoneFnHover()
        },
        fixd_zoneFloatNav: function() {
            var k = b(".zoneFloatNav"),
            e = b(".zone0"),
            h = e.offset().top,
            i = h,
            g = h - 470,
            f = 0,
            j = function() {
                var n = (document.body.scrollTop || document.documentElement.scrollTop),
                m = b(a),
                l = b("#srcoll2Top");
                if (m.width() <= 1152 || m.height() < 731) {
                    k.hide();
                    setTimeout(function() {
                        if (b.isIE6) {
                            l.css({
                                top: parseInt(b("a.guideOnline,a.guideOnlineDis").eq(0).css("top")) + 60
                            })
                        } else {
                            b("#srcoll2Top").css("top", 470)
                        }
                    },
                    40);
                    return
                } else {
                    k.show();
                    setTimeout(function() {
                        if (b.isIE6) {
                            l.css({
                                top: parseInt(b("a.guideOnline,a.guideOnlineDis").eq(0).css("top")) + 285
                            })
                        } else {
                            b("#srcoll2Top").css("top", 695)
                        }
                    },
                    40)
                }
                if (n > g) {
                    if (b.isIE6) {
                        k.css({
                            position: "absolute",
                            top: (i + n - g) + "px"
                        })
                    } else {
                        k.css({
                            position: "fixed",
                            top: 470 + "px"
                        })
                    }
                } else {
                    k.css({
                        position: "absolute",
                        top: i + "px"
                    })
                }
            };
            k.length && b(a).scroll(j) && b(a).resize(j) && j();
            b("a", k).click(function(m) {
                var l = document.body.scrollTop ? document.body: document.documentElement.scrollTop ? document.documentElement: null;
                f = b("a", k).index(this);
                f = f == 6 ? 114 : f;
                if (l) {
                    b(l).animate({
                        scrollTop: b(".zone" + f).offset().top
                    },
                    300)
                } else {
                    b(l).scrollTop(b(".zone" + f).offset().top)
                }
            })
        },
        initCommendList: function(e) {
            b(e).find(".slidGoodsViewL").click(function(f) {
                d.goViewFavGoods(e, -4);
                f.preventDefault()
            }).end().find(".slidGoodsViewR").click(function(f) {
                d.goViewFavGoods(e, 4);
                f.preventDefault()
            })
        },
        goViewLock: 0,
        goViewFavGoods: function(e, g) {
            if (this.goViewLock) {
                return
            }
            this.goViewLock = 1;
            var l = b(".productsView", e),
            m = l.find(".product"),
            k = m.length,
            f = Math.min(Math.abs(g), k),
            j = 0,
            n = [],
            h;
            if (g > 0) {
                for (h = 0; h < f; h++) {
                    j += m.eq(h).outerWidth();
                    l.append(m.eq(h).clone());
                    n.push(m.eq(h))
                }
                l.animate({
                    left: "-" + j + "px"
                },
                function() {
                    b.each(n,
                    function(i, o) {
                        o.remove()
                    });
                    l.css("left", "0px");
                    d.goViewLock = 0
                })
            } else {
                for (h = 0; h < f; h++) {
                    j += m.eq(k - h - 1).outerWidth();
                    l.prepend(m.eq(k - h - 1).clone()).css("left", "-" + j + "px");
                    n.push(m.eq(k - h - 1))
                }
                l.animate({
                    left: "0px"
                },
                function() {
                    b.each(n,
                    function(i, o) {
                        o.remove()
                    });
                    d.goViewLock = 0
                })
            }
        },
        timeParse: function(j) {
            var i = parseInt(j / (60 * 60)),
            e,
            g,
            f = '<strong class="c_orange">{h}</strong>时<strong class="c_orange">{m}</strong>分<strong class="c_orange">{s}</strong>秒';
            j %= 60 * 60;
            e = parseInt(j / 60);
            g = j % 60;
            return b.format(f, {
                h: i,
                m: e,
                s: g
            })
        },
        timeParse2: function(k) {
            var j = parseInt(k / (60 * 60 * 24)),
            i,
            e,
            g,
            f = '<strong class="day">{d}</strong><em>天</em><strong class="hour">{h}</strong><em class="hourTxt">小时</em><strong class="min">{m}</strong><em>分</em><strong class="sec">{s}</strong><em>秒</em>';
            k %= 60 * 60 * 24;
            i = parseInt(k / (60 * 60));
            k %= 60 * 60;
            e = parseInt(k / 60);
            g = k % 60;
            return b.format(f, {
                d: j,
                h: i,
                m: e,
                s: g
            })
        },
        wait_time: function(j, i, f, e) {
            var g = 0,
            h = e || 1000,
            k;
            i(j);
            k = setInterval(function() {
                g += 1;
                if (g < j) {
                    i(j - g)
                } else {
                    f();
                    clearInterval(k)
                }
            },
            h);
            return k
        },
        countdown: function() {
            b("p.timerInfo[time]").each(function() {
                var e = b(this);
                d.wait_time(parseInt(e.attr("time")),
                function(f) {
                    e.html(d.timeParse(f))
                },
                function() {
                    e.html(d.timeParse(0))
                })
            })
        },
        countdown2: function() {
            b("div.timerBox[time]").each(function() {
                var e = b(this);
                d.wait_time(parseInt(e.attr("time")),
                function(f) {
                    b("span.timer", e).html(d.timeParse2(f))
                },
                function() {
                    b("span.timer", e).html(d.timeParse2(0))
                })
            })
        },
        load_scrollmsg: function() {
            var f = b("div.commWrap"),
            g = b("ul", f);
            if (f.height() >= g.height()) {
                return
            }
            function e() {
                var i = g.children("li:first"),
                h = i.height();
                g.animate({
                    top: -h + "px"
                },
                500,
                function() {
                    g.css("top", "0px").append(i);
                    setTimeout(function() {
                        e()
                    },
                    7000)
                })
            }
            e()
        },
        subscribe: function() {
            var h = b(".inputArea"),
            g = b(":button", h),
            e = b(":text", h),
            j,
            f = {
                error: "<div class='addGoods2FavDialog addFavErr'><h3><b></b>提示</h3><p>{content}</p><a class='iDialogClose'></a></div>",
                success: "<div class='addGoods2FavDialog addFavOK'><h3><b></b>订阅成功！</h3><p>我们会将网站促销信息发送到您的 {content} 邮箱中，如果您想退订，请从邮件中选择退订即可。</p><a class='iDialogClose'></a></div>"
            },
            i = function(k, l) {
                b.dialog({
                    type: "shell",
                    content: b.format(f[k ? "success": "error"], {
                        content: l
                    }),
                    width: 0,
                    timeout: 0,
                    animate: 3,
                    layout: -1,
                    position: "c"
                })
            };
            g.click(function() {
                j = b.trim(e.val());
                b.dialog();
                if (j.length == 0 || j == e.attr("placeholder") || (!/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(j))) {
                    return i(false, "请输入正确的邮箱格式哦")
                }
                ajax("/index/dingyue.html",
                function(k) {
                    if (k.retcode == 0) {
                        return i(true, j)
                    } else {
                        return i(false, "真遗憾，订阅失败！<br/>请稍后再试")
                    }
                },
                {
                    dingyueEmail: j
                })
            })
        },
        init_mousetips: function() {
            b(document).delegate("div.product div.linksBox", "mouseenter",
            function() {
                var e = b("a.proIntro", this);
                if (!e.attr("_top")) {
                    e.attr("_top", e.css("top"))
                }
                e.addClass("introHover").stop(true).animate({
                    top: b(this).height() - e.height()
                },
                150)
            }).delegate("div.product div.linksBox", "mouseleave",
            function() {
                var e = b("a.proIntro", this);
                e.removeClass("introHover").stop(true).animate({
                    top: e.attr("_top")
                },
                150)
            });
            b("div.hotArea ol li").mouseenter(function() {
                b(this).addClass("brandHover")
            }).mouseleave(function() {
                b(this).removeClass("brandHover")
            })
        },
        zoneFnHover: function() {
            b("div.leftBox").delegate("div.zoneFnWrap", "mouseenter",
            function() {
                b("a.aZoneFn", this).css("opacity", 0.5)
            }).delegate("div.zoneFnWrap", "mouseleave",
            function() {
                b("a.aZoneFn", this).css("opacity", 1)
            })
        }
    })
})(window, jQuery, Core);
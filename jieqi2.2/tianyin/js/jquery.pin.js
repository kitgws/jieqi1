
(function ($) {
    "use strict";
    $.fn.pin = function (options,fun1,fun2) {
        var _this = $(this);
        var scrollY = 0, elements = [], disabled = false, $window = $(window);

        options = options || {};

        var recalculateLimits = function () {
            for (var i=0, len=elements.length; i<len; i++) {
                var $this = elements[i];

                if (options.minWidth && $window.width() <= options.minWidth) {
                    if ($this.parent().is(".pin-wrapper")) { $this.unwrap(); }
                    $this.css({width: "", left: "", top: "", position: ""});
                    if (options.activeClass) { $this.removeClass(options.activeClass); }
                    disabled = true;
                    continue;
                } else {
                    disabled = false;
                }

                var $container = options.containerSelector ? $this.closest(options.containerSelector) : $(document.body);
                var offset = $this.offset();
                var containerOffset = $container.offset();
                var parentOffset = $this.offsetParent().offset();

                if (!$this.parent().is(".pin-wrapper")) {
                    $this.wrap("<div class='pin-wrapper'>");
                }

                var pad = $.extend({
                  top: 0,
                  bottom: 0
                }, options.padding || {});

                $this.data("pin", {
                    pad: pad,
                    from: (options.containerSelector ? containerOffset.top : offset.top) - pad.top,
                    to: containerOffset.top + $container.height() - $this.outerHeight() - pad.bottom,
                    end: containerOffset.top + $container.height(),
                    parentTop: parentOffset.top
                });

                $this.css({width: '100%'});
                $this.parent().css("height", $this.outerHeight());

            }
        };

        var onScroll = function () {

            if (disabled) { return; }

            scrollY = $window.scrollTop();


            var elmts = [];
            for (var i=0, len=elements.length; i<len; i++) {
                var $this = $(elements[i]),
                    data  = $this.data("pin");

                if (!data) { // Removed element
                  continue;
                }

                elmts.push($this);

                var from = data.from - data.pad.bottom,
                      to = data.to - data.pad.top;

                if (from + $this.outerHeight() > data.end) {
                    $this.css('position', '');
                    continue;
                }

                if (from < scrollY) {

                    !($this.css("position") == "fixed") && $this.css({
                        left: 0,
                        top: data.pad.top
                    }).css("position", "fixed");

                    fun1(_this);
                    if (options.activeClass) { $this.addClass(options.activeClass); }
                }
             //
             //   if (from < scrollY && to > scrollY) {
              //      !($this.css("position") == "fixed") && $this.css({
              //          left: $this.offset().left,
              //          top: data.pad.top
              //      }).css("position", "fixed");
              //      fun1(_this);
             //       if (options.activeClass) { $this.addClass(options.activeClass); }
            //    }

            //    else if (scrollY >= to) {
             //       $this.css({
              //          left: "",
              //          top: to - data.parentTop + data.pad.top
              //      }).css("position", "absolute");
              //      if (options.activeClass) { $this.addClass(options.activeClass); }
             //   }
                else {
                    $this.css({position: "", top: "", left: ""});
                    fun2(_this);
                    if (options.activeClass) { $this.removeClass(options.activeClass); }
                }
          }



          elements = elmts;
        };


        var update = function () { recalculateLimits(); onScroll(); };

        this.each(function () {
            var $this = $(this),
                data  = $(this).data('pin') || {};

            if (data && data.update) { return; }
            elements.push($this);
            $("img", this).one("load", recalculateLimits);
            data.update = update;
            $(this).data('pin', data);
        });

        $window.scroll(onScroll);
        $window.resize(function () { recalculateLimits(); });


        recalculateLimits();
        //判断手机横竖屏状态：
        window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", function() {
            if (window.orientation === 180 || window.orientation === 0) {
                window.location.reload();
            }
            if (window.orientation === 90 || window.orientation === -90 ){
                window.location.reload();
            }
        }, false);
        $window.load(update);

        return this;
      };
})(jQuery);




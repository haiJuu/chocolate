// 使用jquery將img插入body中
(function () {
    $("body").append("<img id='goTopButton' style='display:none;z-index:5;cursor:pointer;width:100px' title='Back to top'/>");
    var img = "./images/bntop01.png",
        location = 0.8,
        right = 20,
        opacity = 0.8,
        speed = 2000,
        $button = $("#goTopButton"),
        $body = $(document),
        $win = $(window);
    $button.attr("src", img);

    window.goTopMove = function () {
        var scrollH = $body.scrollTop(),
            winH = $win.height(),
            css = { "top": winH * location + "px", "position": "fixed", "right": right, "opacity": opacity,"border-radius":"100px" };
        if (scrollH > 20) {
            $button.css(css);
            $button.fadeIn("slow");
        } else {
            $button.fadeOut("slow");
            css = {"background-color":"rgba(0, 0, 0,0)","transform":"none","transition": "none" };
            $button.css(css);
        }
    };
    $win.on({
        scroll: function () { goTopMove(); },
        resize: function () { goTopMove(); }
    });

    $button.on({
        mouseover: function () { $button.css("opacity", 1); },
        mouseout: function () { $button.css("opacity", opacity); },
        click: function () {
            css = {"background-color":"rgb(26, 16, 6)","transform":"rotateY(1800deg)","transition": "all 3s ease-out 0s" };
            $button.css(css);
            $("html,body").animate({ scrollTop: 0 }, speed)
        }
    });
})(jQuery);
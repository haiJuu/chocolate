// 
$(function () {
    $(".card .row.mt-2 .col-md-4 a").mouseover(function () {
        var imgsrc = $(this).children("img").attr("src");
        $("#showGoods").attr({
            "src": imgsrc
        });
    });

    $(".fancybox").fancybox();
})


// 
function add_cart(product_id) {
    var qty = $("#qty").val();
    if (qty <= 0) {
        alert("產品數量不得為0或為負數，請在修改數量!");
        return (false);
    }

    if (qty == undefined) {
        qty = 1;
    } else if (qty >= 50) {
        alert("由於採購限，產品數量將限制在50以下!");
        return (false);
    }

    // $.ajax 函式呼叫後台的 add_cart.php
    $.ajax({
        url: './add_cart.php',
        type: 'get',
        dataType: 'json',
        data: {
            p_id: p_id,
            qty: qty,
        },

        success: function (data) {
            if (data.c == true) {
                alert(data.m);
                window.location.reload();
            } else {
                alert(data.m);
            }
        },

        error: function (data) {
            alert("系統目前無法連接到後台資料庫");
        }

        // error: function(xhr, status, error) {
        //     alert("錯誤碼: " + xhr.status + "\n訊息: " + error + "\n響應: " + xhr.responseText);
        // }

    })

}

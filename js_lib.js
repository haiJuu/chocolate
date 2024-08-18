// 
$(function () {
    $(".goods a").mouseover(function () {
        var img_src = $(this).children("img").attr("src");
        $("#showGoods").attr({
            "src": img_src
        });
    });

    $(".fancybox").fancybox();
})


// product_list
// goods_content
function addCart(p_id) {
    var qty = $("#qty").val();
    if (qty <= 0) {
        alert("輸入的產品數量必須大於 0 ");
        return (false);
    }

    if (qty == undefined) {
        qty = 1;
    } else if (qty >= 50) {
        alert("購買的產品總數量上限為 50 ");
        return (false);
    }

    // $.ajax 函式呼叫後台的 add_cart.php
    $.ajax({
        url: './addcart.php',
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
            alert("目前無法連接到系統");
        }

        // error: function(xhr, status, error) {
        //     alert("錯誤碼: " + xhr.status + "\n訊息: " + error + "\n響應: " + xhr.responseText);
        // }

    })

}

// productList
// goodsContent
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
        url: './cartAdd.php',
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


// goodsContent
$(function () {
    $(".goods a").mouseover(function () {
        var img_src = $(this).children("img").attr("src");
        $("#showGoods").attr({
            "src": img_src
        });
    });

    $(".fancybox").fancybox();
})


// cartContent
function btn_confirmLink(message, url) {
    if (message == "" || url == "") {
        return false;
    }
    if (confirm(message)) {
        window.location = url;
    }
    return false;
}

$(".cart input").change(function () {
    var qty = $(this).val();
    const cart_id = $(this).attr("cart_id");
    if (qty <= 0 || qty >= 50) {
        alert("限制數量在 1 - 49 之間");
        return false;
    }

    console.log("cart_id");

    $.ajax({
        url: 'cartChange.php',
        type: 'post',
        dataType: 'json',
        data: {
            cart_id: cart_id,
            qty: qty,
        },
        success: function (data) {
            if (data.c == true) {
                window.location.reload();
            } else {
                alert(data.m);
            }
        },
        error: function (data) {
            alert("目前無法連接到系統");
        }
    });

});


// login
$(function () {
    $("#form1").submit(function () {
        const inputAccount = $("#inputAccount").val();
        const inputPassword = $("#inputPassword").val();

        $("#loading").show();

        $.ajax({
            url: 'auth_user.php',
            type: 'post',
            dataType: 'json',
            data: {
                inputAccount: inputAccount,
                inputPassword: inputPassword,
            },
            success: function (data) {
                if (data.c == true) {
                    alert(data.m);
                    window.location.href = "<?php echo $sPath; ?>";
                } else {
                    alert(data.m);
                }
            },
            error: function (data) {
                alert("目前無法連接到系統");
            }

        });
    });
});

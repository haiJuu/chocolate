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

    // $.Ajax 函式呼叫後台的 add_cart.php
    $.ajax({
        url: './cartAddAjax.php',
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
$(".cart input").change(function () {
    var qty = $(this).val();
    const cart_id = $(this).attr("cart_id");
    if (qty <= 0 || qty >= 50) {
        alert("限制數量在 1 - 49 之間");
        return false;
    }

    $.ajax({
        url: 'cartChangeAjax.php',
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


// header
// cartContent
function confirmLink(message, url) {
    if (message == "" || url == "") {
        return false;
    }
    if (confirm(message)) {
        window.location = url;
    }
    return false;
}


// register
function getCaptcha() {
    var inputTxt = document.getElementById("captcha");
    inputTxt.value = captchaCode("can", 150, 50, "blue", "white", "28px", 5);
}

$(function () {
    getCaptcha();

    $("#city").change(function () {

        var auto_no = $("#city").val();
        if (auto_no == "") {
            return false;
        }

        $.ajax({
            url: "./registerTownAjax.php",
            type: "post",
            dataType: "json",
            data: {
                auto_no: auto_no,
            },
            success: function (data) {
                if (data.c == true) {
                    $("#town").html(data.m);
                    $("#zip").val("");
                } else {
                    alert(data.m)
                }
            },
            error: function (data) {
                alert("目前無法連接到系統");
            }
        });

    });

    $("#town").change(function () {

        var auto_no = $("#town").val();
        if (auto_no == "") {
            return false;
        }

        $.ajax({
            url: "registerZipAjax.php",
            type: "get",
            dataType: "json",
            data: {
                auto_no: auto_no,
            },
            success: function (data) {
                if (data.c == true) {
                    $("#zip").val(data.post);
                    $("#zipcode").html(data.post + " " + data.cname + data.tname);
                } else {
                    alert(data.m)
                }
            },
            error: function (data) {
                alert("目前無法連接到系統");
            }
        });

    });
});

$("#uploadImg").click(function (e) {
    var memberImgName = $("#memberImg").val();
    var dotIndex = memberImgName.lastIndexOf(".") + 1;
    let imgFormat = memberImgName.substr(dotIndex, memberImgName.length).toLowerCase();
    if (imgFormat == "jpg" || imgFormat == "jpeg" || imgFormat == "png" || imgFormat == "gif") {
        $("#progress-div01").css("display", "flex");
        let memberImg = document.getElementById("memberImg").files[0];
        let formMemberImg = new FormData();
        formMemberImg.append("memberImg", memberImg);
        let requestUploadImg = new XMLHttpRequest();
        requestUploadImg.upload.addEventListener("progress", progressHandler, false);
        requestUploadImg.addEventListener("load", completeHandler, false);
        requestUploadImg.addEventListener("error", errorHandler, false);
        requestUploadImg.addEventListener("abort", abortHandler, false);
        requestUploadImg.open("POST", "./registerUploadImg.php");
        requestUploadImg.send(formMemberImg);
        return false;
    } else {
        alert("上傳僅支援jpg,jpeg,png,gif 檔案格式");
    }
});

function progressHandler(event) {
    let percent = Math.round((event.loaded / event.total) * 100);
    $("#progress-bar01").css("width", percent + "%");
    $("#progress-bar01").html(percent + "%");
};

function completeHandler(event) {
    let data = JSON.parse(event.target.responseText);
    if (data.success == "true") {
        $("#uploadname").val(data.memberImgName);
        $("#showImg").attr({
            "src": "./images/member/" + data.memberImgName,
            "style": "display:block;"
        });
        $("button.btn.btn-danger").attr({
            "style": "display:none;",
        });
    } else {
        alert(data.error);
    }
};

function errorHandler(event) {
    alert("Upload Failed: 上傳發生錯誤");
};

function abortHandler(event) {
    alert("Upload Aborted: 上傳作業取消");
};


jQuery.validator.addMethod("tssnFormat", function (value, element, param) {
    var tssn = /^[a-zA-Z]{1}[1-2]{1}[0-9]{8}$/;
    return this.optional(element) || (tssn.test(value));
});

jQuery.validator.addMethod("phoneFormat", function (value, element, param) {
    var checkphone = /^[0]{1}[9]{1}[0-9]{8}$/;
    return this.optional(element) || (checkphone.test(value));
});

jQuery.validator.addMethod("townRequired", function (value, element, param) {
    return (value !== "");
});

$("#reg").validate({
    rules: {
        email: {
            required: true,
            email: true,
            remote: "./registerCheckEmail.php"
        },
        pw1: {
            required: true,
            maxlength: 20,
            minlength: 4
        },
        pw2: {
            required: true,
            equalTo: "#pw1"
        },
        cname: {
            required: true
        },
        tssn: {
            required: true,
            tssnFormat: true
        },
        birthday: {
            required: true
        },
        mobile: {
            required: true,
            phoneFormat: true
        },
        address: {
            required: true
        },
        town: {
            townRequired: true
        },
        recaptcha: {
            required: true,
            equalTo: "#captcha"
        },
    },

    messages: {
        email: {
            required: "email信箱不得為空白",
            email: "email信箱格式錯誤",
            remote: "email信箱已經註冊"
        },
        pw1: {
            required: "密碼不得為空白",
            maxlength: "密碼最大長度為20位(4-20位英文字母與數字的組合)",
            minlength: "密碼最小長度為4位(4-20位英文字母與數字的組合)"
        },
        pw2: {
            required: "確認密碼不得為空白",
            equalTo: "兩次輸入的密碼必須一致！"
        },
        cname: {
            required: "使用者名稱不得為空白"
        },
        tssn: {
            required: "身份證ID不得為空白",
            tssnFormat: "身份證ID格式有誤"
        },
        birthday: {
            required: "生日不得為空白"
        },
        mobile: {
            required: "手機號碼不得為空白",
            phoneFormat: "手機號碼格式有誤"
        },
        address: {
            required: "地址不得為空白"
        },
        town: {
            townRequired: "需選擇郵遞區號"
        },
        recaptcha: {
            required: "驗證碼不得為空白！",
            equalTo: "驗證碼需相同！"
        },
    },

})
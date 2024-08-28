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
function btnConfirmLink(message, url) {
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

    $("#myCity").change(function () {

        var CNo = $("#myCity").val();
        if (CNo == "") {
            return false;
        }

        $.ajax({
            url: "Town_ajax.php",
            type: "post",
            dataType: "json",
            data: {
                CNo: CNo,
            },
            success: function (data) {
                if (data.c == true) {
                    $("#myTown").html(data.m);
                    $("#myZip").val("");
                } else {
                    alert(data.m)
                }
            },
            error: function (data) {
                alert("系統目前無法連接到後台資料庫");
            }
        });

    });

    $("#myTown").change(function () {

        var AutoNo = $("#myTown").val();
        if (AutoNo == "") {
            return false;
        }

        $.ajax({
            url: "Zip_ajax.php",
            type: "get",
            dataType: "json",
            data: {
                AutoNo: AutoNo,
            },
            success: function (data) {
                if (data.c == true) {
                    $("#myZip").val(data.Post);
                    $("#zipcode").html(data.Post + data.Cityname + data.Name);
                } else {
                    alert(data.m)
                }
            },
            error: function (data) {
                alert("系統目前無法連接到後台資料庫");
            }
        });

    });
});


function getId(el) {
    return document.getElementById(el);
}

$("#uploadForm").click(function (e) {
    var fileName = $("#fileToUpload").val();
    var idxDot = fileName.lastIndexOf(".") + 1;
    let extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
    if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "gif") {
        $("#progress-div01").css("display", "flex");
        let file1 = getId("fileToUpload").files[0];
        let formdata = new FormData();
        formdata.append("file1", file1);
        let ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", "file_upload_parser.php");
        ajax.send(formdata);
        return false;
    } else {
        alert("目前只支援jpg,jpeg,png,gif 檔案格式上傳!");
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
        $("#uploadname").val(data.fileName);
        $("#showimg").attr({
            "src": "uploads/" + data.fileName,
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

jQuery.validator.addMethod("tssn", function (value, element, param) {
    var tssn = /^[a-zA-Z]{1}[1-2]{1}[0-9]{8}$/;
    return this.optional(element) || (tssn.test(value));
});

jQuery.validator.addMethod("checkphone", function (value, element, param) {
    var checkphone = /^[0]{1}[9]{1}[0-9]{8}$/;
    return this.optional(element) || (checkphone.test(value));
});

jQuery.validator.addMethod("checkMyTown", function (value, element, param) {
    return (value !== "");
});

$("#reg").validate({
    rules: {
        email: {
            required: true,
            email: true,
            remote: "checkemail.php"
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
            tssn: true
        },
        birthday: {
            required: true
        },
        mobile: {
            required: true,
            checkphone: true
        },
        address: {
            required: true
        },
        myTown: {
            checkMyTown: true
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
            tssn: "身份證ID格式有誤"
        },
        birthday: {
            required: "生日不得為空白"
        },
        mobile: {
            required: "手機號碼不得為空白",
            checkphone: "手機號碼格式有誤"
        },
        address: {
            required: "地址不得為空白"
        },
        myTown: {
            checkMyTown: "需選擇郵遞區號"
        },
        recaptcha: {
            required: "驗證碼不得為空白！",
            equalTo: "驗證碼需相同！"
        },
    },

})
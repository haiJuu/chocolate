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


// classContent
// productContent
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

    $.ajax({
        url: './ajaxCartQtyAdd.php',
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


// productContent
$(function () {
    $(".product a").mouseover(function () {
        var img_src = $(this).children("img").attr("src");
        $("#showProduct").attr({
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
        url: './ajaxCartQtyChange.php',
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
    $("#loginForm").submit(function () {
        const inputAccount = $("#inputAccount").val();
        const inputPassword = MD5($("#inputPassword").val());

        // $("#loading").show();

        $.ajax({
            url: './ajaxMemberLogin.php',
            type: 'post',
            dataType: 'json',
            data: {
                inputAccount: inputAccount,
                inputPassword: inputPassword,
            },
            success: function (data) {
                if (data.c == true) {
                    alert(data.m);
                    window.location.href = "<?php echo $goToPath; ?>";
                } else {
                    alert(data.m);
                }
            },
            error: function (data) {
                alert("目前無法連接到系統");
            }

        });
    });

    $("#checkEye").click(function () {
        var inputPassword = $("#inputPassword")

        if ($("#checkEye").hasClass('fa-eye')) {

            $("#checkEye").removeClass('fa-eye').addClass('fa-eye-slash');
            inputPassword.attr('type', 'text');
        } else {
            inputPassword.attr('type', 'password');
            $("#checkEye").removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    if (e.target.classList.contains('fa-eye')) {
        //換class 病患 type
        e.target.classList.remove('fa-eye');
        e.target.classList.add('fa-eye-slash');
        floatingPassword.setAttribute('type', 'text')
    } else {
        floatingPassword.setAttribute('type', 'password');
        e.target.classList.remove('fa-eye-slash');
        e.target.classList.add('fa-eye')
    }
});





// registerContent
// memberContent
function getCaptcha() {
    var inputText = document.getElementById("captcha");
    inputText.value = captchaCode("can", 150, 50, "blue", "white", "28px", 5);
}

function progressHandler(event) {
    let percent = Math.round((event.loaded / event.total) * 100);
    $("#progress-bar").css("width", percent + "%");
    $("#progress-bar").html(percent + "%");
};

function completeHandler(event) {
    let data = JSON.parse(event.target.responseText);
    if (data.success == "true") {
        $("#uploadname").val(data.memberImgName);
        $("#showImg").attr({
            "src": "./images/member/" + data.memberImgName,
            "style": "display:block;"
        });
        $("button.btn.btn-light.btn-upload").attr({
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

$("#uploadImg").click(function (e) {
    var memberImgName = $("#memberImg").val();
    var dotIndex = memberImgName.lastIndexOf(".") + 1;
    let imgFormat = memberImgName.substr(dotIndex, memberImgName.length).toLowerCase();
    if (imgFormat == "jpg" || imgFormat == "jpeg" || imgFormat == "png" || imgFormat == "gif") {
        $("#progress").css("display", "flex");
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


$("#register").validate({
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
            required: false,
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
            required: "必填",
            email: "email信箱格式錯誤",
            remote: "email信箱已經註冊"
        },
        pw1: {
            required: "必填",
            maxlength: "密碼最大長度為20位(4-20位英文字母與數字的組合)",
            minlength: "密碼最小長度為4位(4-20位英文字母與數字的組合)"
        },
        pw2: {
            required: "必填",
            equalTo: "兩次輸入的密碼必須一致"
        },
        cname: {
            required: "必填"
        },
        tssn: {
            required: "",
            tssnFormat: "身份證格式有誤"
        },
        birthday: {
            required: "必填"
        },
        mobile: {
            required: "必填",
            phoneFormat: "手機號碼格式有誤"
        },
        address: {
            required: "必填"
        },
        town: {
            townRequired: "必填"
        },
        recaptcha: {
            required: "必填",
            equalTo: "驗證碼需相同"
        },
    },

})


// registerContent
// checkoutContent
$(function () {

    $("#city").change(function () {

        var auto_no = $("#city").val();
        if (auto_no == "") {
            $("#town").html("<option value=''>選擇鄉鎮市區</option>");
            $("#zip").val("");
            $('#zipcode').html("");
            return false;
        }

        $.ajax({
            url: "./ajaxCityTown.php",
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
            $('#zip').val("");
            $('#zipcode').html("");
            return false;
        }

        $.ajax({
            url: "./ajaxTownZip.php",
            type: "get",
            dataType: "json",
            data: {
                auto_no: auto_no,
            },
            success: function (data) {
                if (data.c == true) {
                    $("#zip").val(data.post);
                    $("#zipcode").html(data.post + " " + data.city_name + data.town_name);
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

// memberContent
$(function () {
    $("#member").validate({
        onfocusout: false,
        rules: {
            cname: {
                required: true
            },
            tssn: {
                required: false,
                tssnFormat: true
            },
            birthday: {
                required: true
            },
            recaptcha: {
                required: true,
                equalTo: "#captcha"
            },
        },

        messages: {
            cname: {
                required: "必填"
            },
            tssn: {
                required: "",
                tssnFormat: "身份證ID格式有誤"
            },
            birthday: {
                required: "必填"
            },
            recaptcha: {
                required: "必填",
                equalTo: "驗證碼需相同"
            },
        },

    });
});

// checkoutContent
$(function () {
    $('#addbook').click(function () {
        var validate = 0, msg = "";
        var cname = $("#cname").val();
        var mobile = $("#mobile").val();
        var zip = $("#zip").val();
        var address = $("#address").val();

        if (cname == "") {
            msg = msg + "收件姓名不得為空白\n";
            validate = 1;
        }
        if (mobile == "") {
            msg = msg + "電話號碼不得為空白\n";
            validate = 1;
        }
        if (zip == "") {
            msg = msg + "縣市鄉鎮市區不得為空白\n";
            validate = 1;
        }
        if (address == "") {
            msg = msg + "地址不得為空白\n";
            validate = 1;
        }
        if (validate) {
            alert(msg);
            return false
        }

        $.ajax({
            url: './ajaxAddbook.php',
            type: 'post',
            dataType: 'json',
            data: {
                cname: cname,
                mobile: mobile,
                zip: zip,
                address: address,
            },
            success: function (data) {
                if (data.c == true) {
                    alert(data.m)
                    window.location.reload();
                } else {
                    alert(data.m);
                }
            },
            error: function (data) {
                alert("目前無法連接到系統");
            }
        })
    });

    $('input[name=setdefault]').change(function () {
        var address_id = $(this).val();

        $.ajax({
            url: './ajaxAddbookSetdefault.php',
            type: 'post',
            dataType: 'json',
            data: {
                address_id: address_id,
            },
            success: function (data) {
                if (data.c == true) {
                    alert(data.m)
                    window.location.reload();
                } else {
                    alert(data.m)
                }
            },
            error: function (data) {
                alert("目前無法連接到系統");
            },
        })
    })

    $('#howpay').change(function () {
        const howpay = document.getElementById('howpay').value;
        const howpayDiv = document.getElementById('howpayContent');

        let howpayContent = '';

        switch (howpay) {
            case 'cod':
                howpayContent = '';
                break;
            case 'credit':
                howpayContent = `<div class="creditInfoGroup">
    <input type="text" id="creditId" name="creditId" class="creditInfoControl" placeholder="信用卡號碼" required>
    <label for="creditId">信用卡號碼</label>
</div>

<div class="creditInfoGroup">
    <input type="text" id="creditName" name="creditName" class="creditInfoControl" placeholder="持卡人姓名" required>
    <label for="creditName">持卡人姓名</label>
</div>

<div class="creditInfoGroup">
    <input type="text" id="creditDate" name="creditDate" class="creditInfoControl" placeholder="MM/YY" required>
    <label for="creditDate">有效期</label>
</div>

<div class="creditInfoGroup">
    <input type="text" id="creditCVV" name="creditCVV" class="creditInfoControl" placeholder="CVV" required>
    <label for="creditCVV">安全碼</label>
</div>
`;
                break;
            case 'bank':
                howpayContent = "<p>收款帳戶：</p><p>銀行名稱：中華郵政 (700)</p><p>帳戶號碼：0001-2345-6789</p>";
                break;
            case 'epay':
                howpayContent = "<div><input type='radio' name='epay' id='epay[]' checked><img src='./images/Apple_Pay_logo.svg' alt='applepay'></div><div><input type='radio' name='epay' id='epay[]'><img src='./images/Line_pay_logo.svg' alt='linepay'></div><div><input type='radio' name='epay' id='epay[]'><img src='./images/JKOPAY_logo.svg' alt='jkopay'></div>";
                break;
            default:
                howpayContent = '';
        }

        howpayDiv.innerHTML = howpayContent;
    })

    $('#uorder').click(function () {
        let msg = "系統將進行結帳處理，請確認產品金額與收件人是否正確!";
        if (!confirm(msg)) return false;
        // $('#loading').show();

        var address_id = $('input[name=setdefault]:checked').val();
        var e_invoice = $("#e_invoice").val();
        var company_name = $("#company_name").val();
        var tax_ID_number = $("#tax_ID_number").val();
        var remark = $("#remark").val();

        $.ajax({
            url: './ajaxUorderAdd.php',
            type: 'post',
            dataType: 'json',
            data: {
                address_id: address_id,
                e_invoice: e_invoice,
                company_name: company_name,
                tax_ID_number: tax_ID_number,
                remark: remark,
            },
            success: function (data) {
                if (data.c == true) {
                    alert(data.m)
                    window.location.href = "./order.php";
                } else {
                    alert(data.m)
                }
            },
            error: function (data) {
                alert("目前無法連接到系統");
            },
        })
    })
});


// orderContent
$(function () {
    $('#goToUpper').click(function () {
        window.history.back();
    })
})
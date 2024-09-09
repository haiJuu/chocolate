<?php
require_once("./connections/conn_db.php");

(!isset($_SESSION)) ? session_start() : "";

require_once("phpLib.php");
?>


<!doctype html>
<html lang="zh-TW">

<head>

    <?php require_once("./headFile.php") ?>

    <style>
        .input-group>.form-control {
            width: 100%;
        }

        span.error-tips,
        span.error-tips::before {
            font-family: "Font Awesome 5 Free";
            color: red;
            font-weight: 900;
            content: "\f0c4";
        }

        span.valid-tips,
        span.valid-tips::before {
            font-family: "Font Awesome 5 Free";
            color: greenyellow;
            font-weight: 900;
            content: "\f00c";
        }

        .text-white {
            color: white;
        }
    </style>

</head>

<body>

    <header class="container-fluid fixed-top">

        <?php require_once("./header.php") ?>

        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item">會員</li>
                    <li class="breadcrumb-item">個人資料</li>
                </ol>
            </nav>
        </div>

    </header>

    <section id="content" class="container-fluid">

        <?php require_once("./memberContent.php");
        ?>

    </section>

    <footer class="container-fluid">

        <?php require_once("./footer.php") ?>

    </footer>

    <?php require_once("./jsFile.php") ?>



    <script type="text/javascript">
        $(function() {
            jQuery.validator.addMethod("tssn", function(value, element, param) {
                var tssn = /^[a-zA-Z]{1}[1-2]{1}[0-9]{8}$/;
                return this.optional(element) || (tssn.test(value));
            });

            $("#member").validate({
                onfocusout: false,
                rules: {
                    cname: {
                        required: true
                    },
                    tssn: {
                        required: false,
                        tssn: true
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
                        required: "使用者名稱不得為空白"
                    },
                    tssn: {
                        required: "身份證ID不得為空白",
                        tssn: "身份證ID格式有誤"
                    },
                    birthday: {
                        required: "生日不得為空白"
                    },
                    recaptcha: {
                        required: "驗證碼不得為空白！",
                        equalTo: "驗證碼需相同！"
                    },
                },

            });

            $('#changePW').validate({
                rules: {
                    PWOld: {
                        required: true,
                        remote: "checkPW.php?email_id=<?php echo $_SESSION['email_id'] ?>",
                    },
                    PWNew1: {
                        required: true,
                        maxlength: 20,
                        minlength: 4,
                    },
                    PWNew2: {
                        required: true,
                        equalTo: "#PWNew1",
                    },
                },
                messages: {
                    PWOld: {
                        required: "舊密碼不得為空白",
                        remote: "舊密碼輸入錯誤",
                    },
                    PWNew1: {
                        required: "新密碼不得為空白",
                        maxlength: "密碼最大長度為20位(4-20位英文字母與數字的組合)",
                        minlength: "密碼最小長度為4位(4-20位英文字母與數字的組合)"
                    },
                    PWNew2: {
                        required: "確認密碼不得為空白",
                        equalTo: "兩次輸入的密碼必須一致",
                    },
                }
            })

        })
    </script>

</body>

</html>
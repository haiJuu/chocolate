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

    <script>
        const Vue3 = Vue.createApp({
            data() {
                return {
                    email_id: <?php echo $_SESSION['email_id']; ?>,
                    member: [],
                    captcha: '',
                    readonly: true,
                    PWOld: '',
                    PWNEW1: '',
                    PWNew2: '',
                }
            },
            methods: {
                getMemberInfo() {
                    axios.get('./ajaxMember.php', {
                            params: {
                                email_id: this.email_id
                            }
                        })
                        .then((res) => {
                            let data = res.data;
                            if (data.c == true) {
                                this.member = data.d[0];
                            } else {
                                alert(data.m)
                            }
                        })
                        .catch(function(error) {
                            alert("系統目前無法連接到後台資料庫")
                        })
                },
                getCaptcha() {
                    this.captcha = captchaCode("can", 150, 50, "blue", "white", "28px", 5);
                },
                editMember() {
                    this.readonly = false;
                },
                async saveMember() {
                    let valid = $('#reg').valid();
                    console.log("Valid:", valid); // 確認 valid 的值
                    if (valid) {
                        console.log("進入了 valid 區塊");
                        let imgfile = $('#uploadname').val();
                        console.log("imgfile:", imgfile); // 檢查 imgfile 值
                        if (imgfile != '') {
                            this.member.member_img = imgfile;
                        }

                        console.log("this.member:", this.member); // 確認 this.member 是否正確

                        try {
                            console.log("開始 axios 請求");
                            const res = await axios.get('reqMember.php', {
                                params: {
                                    birthday: this.member.birthday,
                                    cname: this.member.cname,
                                    emailid: this.member.email_id,
                                    imgname: this.member.member_img,
                                    tssn: this.member.tssn,
                                }
                            });

                            let data = res.data;
                            if (data.c == true) {
                                alert(data.m);
                                location.reload();
                                console.log("2");
                            }
                        } catch (error) {
                            console.log("請求失敗，進入 catch 區塊", error);
                            alert(error + " 系統目前無法連接到後台資料庫");
                            console.log("3");
                        }
                    }

                    console.log("4"); // 程式最後執行
                },
                async savePW() {
                    let valid = $("#changePW").valid();
                    if (valid) {
                        await axios.get("reqchangePW.php", {
                                params: {
                                    emailid: this.member.emailid,
                                    PWNew1: MD5(this.PWNew1),
                                }
                            })
                            .then((res) => {
                                let data = res.data;
                                if (data.c == true) {
                                    $("#changePW").validate().resetForm();
                                    this.PWOld = "";
                                    this.PWNew1 = "";
                                    this.PWNew2 = "";
                                    $("#mClose").click();
                                    alert(data.m);
                                }
                            })
                            .catch(function(error) {
                                alert(error);
                            });
                    }
                },
            },
            mounted() {
                this.getCaptcha();
                this.getMemberInfo();
            }
        });

        Vue3.mount('#modify');
    </script>

    <script type="text/javascript">
        $(function() {
            jQuery.validator.addMethod("tssn", function(value, element, param) {
                var tssn = /^[a-zA-Z]{1}[1-2]{1}[0-9]{8}$/;
                return this.optional(element) || (tssn.test(value));
            });

            $("#reg").validate({
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
                        remote: "checkPW.php?emailid=<?php echo $_SESSION['emailid'] ?>",
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
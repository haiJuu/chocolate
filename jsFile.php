<!-- boostrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- <script src="./bootstrap-5.2.3-dist/js/bootstrap.bundle.js"></script> -->


<!-- jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- <script src="./gotop.js"></script> -->
<script src="./fancybox-2.1.7/source/jquery.fancybox.js"></script>
<script src="./commlib.js"></script>
<script src="./jquery.validate.js"></script>

<!-- vue -->
<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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
                        alert("目前無法連接到系統")
                    })
            },
            getCaptcha() {
                this.captcha = captchaCode("can", 150, 50, "blue", "white", "28px", 5);
            },
            editMember() {
                this.readonly = false;
            },
            async saveMember() {
                let valid = $('#member').valid();
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
                        const res = await axios.get('./ajaxMemberUpdate.php', {
                            params: {
                                birthday: this.member.birthday,
                                cname: this.member.cname,
                                email_id: this.member.email_id,
                                member_img: this.member.member_img,
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
                        console.log("請求失敗，進入 catch 區塊");
                        alert("目前無法連接到系統");
                        console.log("3");
                    }
                }

                console.log("4"); // 程式最後執行
            },
            async savePW() {
                let valid = $("#changePW").valid();
                if (valid) {
                    await axios.get("./ajaxMemberPwdUpdate.php", {
                            params: {
                                email_id: this.member.email_id,
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
                            alert("目前無法連接到系統");
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

<!-- js_lib -->
<script src="./jsLib.js"></script>
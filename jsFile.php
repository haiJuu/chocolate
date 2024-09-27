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
                if (valid) {
                    let imgfile = $('#uploadname').val();
                    if (imgfile != '') {
                        this.member.member_img = imgfile;
                    }

                    try {
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
                        alert("目前無法連接到系統");
                    }
                }
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
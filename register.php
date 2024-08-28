<?php
require_once("./connections/conn_db.php");

(!isset($_SESSION)) ? session_start() : "";

require_once("phpLib.php");
?>


<!doctype html>
<html lang="zh-TW">

<head>

    <?php require_once("./headFile.php") ?>

</head>

<body>

    <header class="container-fluid fixed-top">

        <?php require_once("./header.php") ?>

    </header>

    <?php
    // if ((isset($_POST['formctl'])) && ($_POST['formctl'] == 'reg')) {
    //     $email = $_POST['email'];
    //     $pw1 = md5($_POST['pw1']);
    //     $cname = $_POST['cname'];
    //     $tssn = $_POST['tssn'];
    //     $birthday = $_POST['birthday'];
    //     $mobile = $_POST['mobile'];
    //     $myzip = $_POST['myZip'] == "" ? NULL : $_POST['myZip'];
    //     $address = $_POST['address'] == "" ? NULL : $_POST['address'];
    //     $imgname = $_POST['uploadname'] == "" ? NULL : $_POST['uploadname'];
    //     $insertsql = "INSERT INTO member(email,pw1,cname,tssn,birthday,imgname) VALUES ('" . $email . "','" . $pw1 . "','" . $cname . "','" . $tssn . "','" . $birthday . "','" . $imgname . "')";
    //     $Result = $link->query($insertsql);
    //     $emailid = $link->lastInsertId();

    //     if ($Result) {
    //         $insertsql = "INSERT INTO addbook(emailid,setdefault,cname,mobile,myzip,address) VALUES ('" . $emailid . "','1','" . $cname . "','" . $mobile . "','" . $myzip . "','" . $address . "')";
    //         $Result = $link->query($insertsql);

    //         $_SESSION['login'] = true;
    //         $_SESSION['emailid'] = $emailid;
    //         $_SESSION['email'] = $email;
    //         $_SESSION['cname'] = $cname;
    //         echo "<script language='javascript'>alert('謝謝您，會員資料已完成註冊');location.href='./index.php'</script>";
    //     }
    // }
    ?>


    <section id="content" class="container-fluid">

        <div class="register">

            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>會員註冊頁面</h1>
                    <p>請輸入相關資料，*為必須輸入欄位</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-2 text-left">
                    <form action="./register.php" method="POST" id="reg" name="reg">
                        <div class="input-group mb-3">
                            <input type="email" id="email" name="email" class="form-control" placeholder="*請輸入email帳號">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="pw1" name="pw1" class="form-control" placeholder="*請輸入密碼">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="pw2" name="pw2" class="form-control" placeholder="*請再次確認密碼">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="cname" name="cname" class="form-control" placeholder="*請輸入姓名">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="tssn" name="tssn" class="form-control" placeholder="請輸入身份證字號">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="birthday" name="birthday" class="form-control" placeholder="*請選擇生日" onfocus="(this.type='date')">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" id="mobile" name="mobile" class="form-control" placeholder="請輸入手機號碼">
                        </div>

                        <div class="input-group mb-3">
                            <select id="myCity" name="myCity" class="form-control">
                                <option value="">請選擇市區</option>
                                <?php
                                $city = "SELECT * FROM city WHERE State=0";
                                $city_rs = $link->query($city);
                                while ($city_rows = $city_rs->fetch()) {
                                ?>
                                    <option value="<?php echo $city_rows['AutoNo']; ?>"><?php echo $city_rows['Name']; ?></option>

                                <?php } ?>
                            </select>
                            <br>
                            <select id="myTown" name="myTown" class="form-control">
                                <option value="">請選擇地區</option>
                            </select>
                        </div>
                        <label for="address" class="form-label" id="zipcode" name="zipcode">郵遞區號：地址</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="myZip" name="myZip" value="">
                            <input type="text" id="address" name="address" class="form-control" placeholder="請輸入後續地址">
                        </div>

                        <label for="fileToUpload" class="form-label">上傳相片：</label>
                        <div class="input-group mb-3">
                            <input type="file" id="fileToUpload" name="fileToUpload" class="form-control" title="請上傳相片圖示" accept="image/x-png,image/jpeg,image/gif,image/jpg">

                            <p>
                                <button type="button" class="btn btn-danger" id="uploadForm" name="uploadForm">開始上傳</button>
                            </p>

                            <div class="progress" id="progress-div01" style="width:100%;display:none;">
                                <div id="progress-bar01" class="progress-bar progress-bar-striped" role="progressbar" style="width:0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>

                            <input type="hidden" id="uploadname" name="uploadname" value="">

                            <img src="" alt="photo" id="showimg" name="showimg" class="img-fluid" style="display:none;">
                        </div>

                        <div class="input-group mb-3">
                            <input type="hidden" id="captcha" name="captcha" value=" ">
                            <a href="javascript:void(0);" title="按我更新認證" onclick="getCaptcha();">
                                <canvas id="can"></canvas>
                            </a>
                            <input type="text" id="recaptcha" name="recaptcha" class="form-control" placeholder="請輸入認證碼">
                        </div>

                        <input type="hidden" name="formctl" id="formctl" value="reg">

                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-success btn-lg">送出</button>
                        </div>

                        <!-- <div class="input-group mb-3">
                                    <input type="" id="" name="" class="form-control" placeholder="">
                                </div> -->

                    </form>
                </div>
            </div>

        </div>
        </div>
        </div>

        </div>

    </section>

    <footer class="container-fluid">

        <?php require_once("./footer.php") ?>

    </footer>

    <?php require_once("./jsFile.php") ?>

</body>

</html>
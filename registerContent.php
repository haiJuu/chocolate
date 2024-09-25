<div class="register">

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8 col-10 text-center">
            <h1>填寫註冊資料</h1>
            <br><br>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-10 col-10 text-left">
            <form action="./register.php" method="POST" id="register" name="register">

                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-8 col-10 text-left mb-3">*姓名　　&nbsp;<input type="text" id="cname" name="cname" placeholder="請輸入姓名" class="w-75">
                    </div>
                    <div class="col-md-6 col-sm-8 col-10 text-left mb-3">
                        *帳號　　&nbsp;<input type="email" id="email" name="email" placeholder="請輸入EMAIL" class="w-75">
                    </div>
                </div>

                <div class="row justify-content-center">

                    <div class="col-md-6 col-sm-8 col-10 text-left mb-3">
                        *密碼設定&nbsp;<input type="password" id="pw1" name="pw1" placeholder="請輸入密碼" class="w-75">
                    </div>

                    <div class="col-md-6 col-sm-8 col-10 text-left mb-3">
                        *密碼確認&nbsp;<input type="password" id="pw2" name="pw2" placeholder="請再次輸入密碼" class="w-75">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-8 col-10 text-left mb-3">&nbsp;身分證號 <input type="text" id="tssn" name="tssn" placeholder="請輸入身份證號" class="w-75">
                    </div>
                    <div class="col-md-6 col-sm-8 col-10 text-left mb-3">
                        *生日　　&nbsp;<input type="text" id="birthday" name="birthday" placeholder="請選擇生日" onfocus="(this.type='date')" class="w-75">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-8 col-10 text-left mb-3">
                        *手機　　&nbsp;<input type="text" id="mobile" name="mobile" placeholder="請輸入手機號碼" class="w-75">
                    </div>
                    <div class="col-md-6 col-sm-8 col-10 text-left mb-3">
                        *地址　　&nbsp;<select id="city" name="city">
                            <option value="">選擇縣市</option>
                            <?php
                            $select_city = "SELECT * FROM city WHERE state=0";
                            $city = $link->query($select_city);
                            while ($fetch_city = $city->fetch()) {
                            ?>
                                <option value="<?php echo $fetch_city['auto_no']; ?>"><?php echo $fetch_city['city_name']; ?></option>
                            <?php } ?>
                        </select>

                        <select id="town" name="town">
                            <option value="">選擇鄉鎮市區</option>
                        </select>

                        <br>
                        <label for="address" id="zipcode" name="zipcode"></label>
                        <input type="hidden" id="zip" name="zip" value="">
                        <br>　　　　&nbsp;
                        <input type="text" id="address" name="address" placeholder="請輸入後續地址" class="w-75">
                    </div>

                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-8 col-10 text-left mb-3">
                        <label for="memberImg" class="form-label">&nbsp;頭貼設定
                        </label><br>

                        <input type="file" id="memberImg" name="memberImg" class="form-control mb-1 w-75" title="請上傳相片圖示" accept="image/x-png,image/jpeg,image/gif,image/jpg" style="display:inline-block;">
                        <button type="button" class="btn btn-light" id="uploadImg" name="uploadImg">上傳</button>

                        <div class="progress" id="progress" style="width:100%;display:none;">
                            <div id="progress-bar" class="progress-bar progress-bar-striped" role="progressbar" style="width:0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>

                        <input type="hidden" id="uploadname" name="uploadname" value="">
                        <img src="" alt="photo" id="showImg" name="showImg" class="img-fluid" style="display:none;">
                    </div>

                    <div class="col-md-6 col-sm-8 col-10 text-left mb-3">
                        <label for="memberImg" class="form-label">*認證碼　</label>
                        <input type="hidden" id="captcha" name="captcha" value=" ">
                        <input type="text" id="recaptcha" name="recaptcha" placeholder="請輸入認證碼" class="mb-2 w-75">
                        <br>
                        　　　　　<a href="javascript:void(0);" title="按我更新認證" onclick="getCaptcha();">
                            <canvas id="can"></canvas>
                        </a>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <input type="hidden" name="register" id="register" value="register">

                    <div class="col-md-6 col-sm-8 col-10 mb-3 text-center" style="display:inline-block;">
                        <button type="submit" class="btn">註冊</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- <div class="row justify-content-center">
        <div class="col-md-6 col-sm-8 col-10 text-left">
            <form action="./register.php" method="POST" id="register" name="register">
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
                <div class="input-group mb-2">
                    <select id="city" name="city" class="form-control w-50">
                        <option value="">選擇縣市</option>
                        <?php
                        $select_city = "SELECT * FROM city WHERE state=0";
                        $city = $link->query($select_city);
                        while ($fetch_city = $city->fetch()) {
                        ?>
                            <option value="<?php echo $fetch_city['auto_no']; ?>"><?php echo $fetch_city['city_name']; ?></option>
                        <?php } ?>
                    </select>
                    <select id="town" name="town" class="form-control w-50">
                        <option value="">選擇鄉鎮市區</option>
                    </select>
                </div>
                <label for="address" class="form-label" id="zipcode" name="zipcode">郵遞區號：</label>
                <div class="input-group mb-3">
                    <input type="hidden" id="zip" name="zip" value="">
                    <input type="text" id="address" name="address" class="form-control" placeholder="請輸入後續地址">
                </div>
                <label for="memberImg" class="form-label">上傳相片：</label>
                <div class="input-group mb-3">
                    <input type="file" id="memberImg" name="memberImg" class="form-control mb-1" title="請上傳相片圖示" accept="image/x-png,image/jpeg,image/gif,image/jpg">
                    <p>
                        <button type="button" class="btn btn-danger" id="uploadImg" name="uploadImg">開始上傳</button>
                    </p>
                    <div class="progress" id="progress" style="width:100%;display:none;">
                        <div id="progress-bar" class="progress-bar progress-bar-striped" role="progressbar" style="width:0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <input type="hidden" id="uploadname" name="uploadname" value="">
                    <img src="" alt="photo" id="showImg" name="showImg" class="img-fluid" style="display:none;">
                </div>
                <div class="input-group mb-3">
                    <input type="hidden" id="captcha" name="captcha" value=" ">
                    <a href="javascript:void(0);" title="按我更新認證" onclick="getCaptcha();">
                        <canvas id="can"></canvas>
                    </a>
                    <input type="text" id="recaptcha" name="recaptcha" class="form-control" placeholder="請輸入認證碼">
                </div>

                <input type="hidden" name="register" id="register" value="register">

                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-dark">註冊</button>
                </div>
            </form>
        </div>
    </div> -->

</div>
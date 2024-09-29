<div class="member row justify-content-center">

    <div class="col-md-8 col-sm-8 col-12">

        <div class="row justify-content-center" id="modify" name="modify">
            <div class="col-md-4 col-sm-6 col-8 text-start">
                <form action="" method="GET" id="member" name="member">
                    <div class="w-100 mb-3">
                        *帳號　　&nbsp;<input type="email" id="email" name="email" readonly v-model="member.email" class="w-75">
                    </div>

                    <div class="w-100 mb-3">
                        *姓名　　&nbsp;<input type="text" id="cname" name="cname" placeholder="請輸入姓名" :readonly="readonly" v-model="member.cname" class="w-75">
                    </div>
                    <div class="w-100 mb-3">
                        &nbsp;身分證號&nbsp;<input type="text" id="tssn" name="tssn" placeholder="請輸入身份證號" :readonly="readonly" v-model="member.tssn" class="w-75">
                    </div>
                    <div class="w-100 mb-3">
                        *生日　　&nbsp;<input type="text" id="birthday" name="birthday" placeholder="請選擇生日" onfocus="(this.type='date')" :readonly="readonly" v-model="member.birthday" class="w-75">
                    </div>

                    <div class="w-100 mb-3">
                        <label for="memberImg">&nbsp;頭貼設定</label>
                    </div>

                    <div class="w-100 mb-3" v-show="!readonly">
                        <input type="file" id="memberImg" name="memberImg" class="form-control w-75 me-1 mb-1" title="請上傳相片圖示" accept="image/x-png,image/jpeg,image/gif,image/jpg" style="display:inline-block">
                        <button type="button" class="btn btn-light btn-upload" id="uploadImg" name="uploadImg">上傳</button>
                    </div>

                    <div class="mb-3" v-show="!readonly">
                        <div class="progress" id="progress" style="width:100%;display:none;">
                            <div id="progress-bar" class="progress-bar progress-bar-striped" role="progressbar" style="width:0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <input type="hidden" id="uploadname" name="uploadname" value="">
                        <img src="" alt="photo" id="showImg" name="showImg" class="img-fluid" style="display:none;">
                    </div>

                    <div class="w-100 mb-3" v-if="readonly">
                        <img :src="`./images/member/${(member.member_img)?member.member_img:'bear.jpg'}`" alt="photo" class="w-100" :title="`${(member.member_img)?member.member_img:'此為預設頭貼'}`">
                    </div>

                    <div class="w-100 mb-1" v-show="!readonly">
                        <label for="memberImg" class="form-label">*認證碼　</label>
                        <input type="text" id="recaptcha" name="recaptcha" class="w-75" placeholder="請輸入認證碼">
                    </div>

                    <div class="w-100 mb-3" v-show="!readonly">
                        <input type="hidden" v-model="captcha" id="captcha" name="captcha">
                        　　　　　<a href="javascript:void(0);" title="按我更新認證" @click="getCaptcha()">
                            <canvas id="can"></canvas>
                        </a>
                    </div>

                    <div class="input-group mb-3 justify-content-center">
                        <button type="button" class="btn btn-gray btn-lg me-2" @click="editMember" v-if="readonly">更新會員資料</button>
                        <button type="button" class="btn btn-gray btn-lg me-2" v-if="readonly" data-bs-toggle="modal" data-bs-target="#exampleModal">變更會員密碼</button>
                    </div>
                    <div class="input-group justify-content-end">
                        <button type="button" class="btn btn-light btn-lg me-2" @click="saveMember" v-if="!readonly">儲存資料</button>
                        <button type="button" class="btn btn-gray btn-lg" @click="readonly=true" v-if="!readonly">離開</button>
                    </div>

                </form>
            </div>

            <!--  Memeber Change Password Modal  -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas a-user-lock me-2"></i>變更會員密碼</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form id="changePW" name="changePW">

                                <div class="w-100 mb-3">
                                    <label for="PWOld" class="form-label">*舊密碼</label><br>
                                    <input type="password" name="PWOld" id="PWOld" placeholder="請輸入舊密碼" v-model="PWOld" class="w-100">
                                </div>
                                <div class="w-100 mb-3">
                                    <label for="PWNew1" class="form-label">*新密碼設定</label><br>
                                    <input type="password" name="PWNew1" id="PWNew1" placeholder="請輸入新密碼" v-model="PWNew1" class="w-100">
                                </div>
                                <div class="w-100 mb-3">
                                    <label for="PWNew2" class="form-label">*新密碼確認</label><br>
                                    <input type="password" name="PWNew2" id="PWNew2" placeholder="請再次輸入新密碼" v-model="PWNew2" class="w-100">
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" @click="savePW">儲存密碼</button>
                            <button type="button" class="btn btn-gray" id="mClose" name="mClose" data-bs-dismiss="modal">離開</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- <div class="row" id="modify" name="modify">
            <div class="col-lg-8 offset-2 text-left">
                <form action="" method="GET" id="member" name="member">
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control" readonly v-model="member.email">
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" id="cname" name="cname" class="form-control" placeholder="*請輸入姓名" :readonly="readonly" v-model="member.cname">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="tssn" name="tssn" class="form-control" placeholder="請輸入身份證字號" :readonly="readonly" v-model="member.tssn">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="birthday" name="birthday" class="form-control" placeholder="*請選擇生日" onfocus="(this.type='date')" :readonly="readonly" v-model="member.birthday">
                    </div>

                    <label for="memberImg" class="form-label">頭貼設定：</label>
                    <div class="input-group mb-3" v-show="!readonly">
                        <input type="file" id="memberImg" name="memberImg" class="form-control" title="請上傳相片圖示" accept="image/x-png,image/jpeg,image/gif,image/jpg">
                        <p>
                            <button type="button" class="btn btn-light" id="uploadImg" name="uploadImg">上傳</button>
                        </p>

                        <div class="progress" id="progress" style="width:100%;display:none;">
                            <div id="progress-bar" class="progress-bar progress-bar-striped" role="progressbar" style="width:0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>

                        <input type="hidden" id="uploadname" name="uploadname" value="">

                        <img src="" alt="photo" id="showImg" name="showImg" class="img-fluid" style="display:none;">
                    </div>

                    <div class="input-group mb-3" v-if="readonly">
                        <img :src="`./images/member/${(member.member_img)?member.member_img:'bear.jpg'}`" alt="photo" style="width:20%;" :title="`${(member.member_img)?member.member_img:'此為預設頭貼'}`">
                    </div>

                    <div class="input-group mb-3" v-show="!readonly">
                        <input type="hidden" v-model="captcha" id="captcha" name="captcha">
                        <a href="javascript:void(0);" title="按我更新認證" @click="getCaptcha()">
                            <canvas id="can"></canvas>
                        </a>
                        <input type="text" id="recaptcha" name="recaptcha" class="form-control" placeholder="請輸入認證碼">
                    </div>

                    <div class="input-group mb-3">
                        <button type="button" class="btn btn-warning btn-lg me-2 text-white" @click="editMember" v-if="readonly">更新會員資料</button>
                        <button type="button" class="btn btn-info btn-lg me-2 text-white" v-if="readonly" data-bs-toggle="modal" data-bs-target="#exampleModal">變更會員密碼</button>
                        <button type="button" class="btn btn-primary btn-lg me-2 text-white" @click="saveMember" v-if="!readonly">儲存資料</button>
                        <button type=" button" class="btn btn-secondary btn-lg text-white" @click="readonlt=true" v-if="!readonly">離開</button>
                    </div>

                </form>
            </div> -->

        <!--  Memeber Change Password Modal  -->
        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas a-user-lock me-2"></i>會員密碼變更頁面</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form id="changePW" name="changePW">

                                <div class="mb-3">
                                    <label for="PWOld" class="form-label">請輸入舊密碼</label>
                                    <input type="password" class="form-control" name="PWOld" id="PWOld" placeholder="Current Password" v-model="PWOld">
                                </div>
                                <div class="mb-3">
                                    <label for="PWNew1" class="form-label">請輸入新密碼</label>
                                    <input type="password" class="form-control" name="PWNew1" id="PWNew1" placeholder="New Password" v-model="PWNew1">
                                </div>
                                <div class="mb-3">
                                    <label for="PWNew2" class="form-label">請再確認新密碼</label>
                                    <input type="password" class="form-control" name="PWNew2" id="PWNew2" placeholder="Verify Password" v-model="PWNew2">
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="mClose" name="mClose" data-bs-dismiss="modal">離開</button>
                            <button type="button" class="btn btn-primary" @click="savePW">儲存密碼</button>
                        </div>
                    </div>
                </div>
            </div>

        </div> -->

    </div>
</div>
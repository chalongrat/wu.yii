<?php

namespace app\views;

use Yii;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,200;0,400;0,800;1,200;1,400;1,800&family=Kanit:ital,wght@0,200;0,300;0,400;0,700;1,200;1,300;1,400;1,700&family=Mitr:wght@400;500;600;700&display=swap');
</style>

<style>
    body {
        font-family: 'K2D', sans-serif !important;
    }

    .auth_left {
        background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbJ-fdxm9paU6zN7SDp28pmgycf52fFlhCqg&usqp=CAU');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        /* Set a height so you can see the background */
    }

    /* CSS */
    .button-85 {
        padding: 0.6em 2em;
        border: none;
        outline: none;
        color: rgb(255, 255, 255);
        background: #111;
        cursor: pointer;
        position: relative;
        z-index: 0;
        border-radius: 10px;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button-85:before {
        content: "";
        background: linear-gradient(45deg,
                #ff0000,
                #ff7300,
                #fffb00,
                #48ff00,
                #00ffd5,
                #002bff,
                #7a00ff,
                #ff00c8,
                #ff0000);
        position: absolute;
        top: -2px;
        left: -2px;
        background-size: 400%;
        z-index: -1;
        filter: blur(5px);
        -webkit-filter: blur(5px);
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        animation: glowing-button-85 20s linear infinite;
        transition: opacity 0.3s ease-in-out;
        border-radius: 10px;
    }

    @keyframes glowing-button-85 {
        0% {
            background-position: 0 0;
        }

        50% {
            background-position: 400% 0;
        }

        100% {
            background-position: 0 0;
        }
    }

    .button-85:after {
        z-index: -1;
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: #222;
        left: 0;
        top: 0;
        border-radius: 10px;
    }


    /* slide image */
    .image-container {
        width: 500px;
        /* ปรับขนาดตามที่ต้องการ */
        height: 400px;
        /* ปรับขนาดตามที่ต้องการ */
        overflow: hidden;
        position: relative;
    }

    .image-container img {
        width: 100%;
        height: auto;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        transition: opacity 2s ease-in-out;
    }

    .image-container img {
        width: 100%;
        /* กำหนดความกว้างของรูปภาพ */
        height: auto;
        /* ความสูงจะปรับอัตโนมัติเพื่อรักษาสัดส่วน */
    }
</style>

<div class="auth">
    <div class="auth_left row">
        <div class="col-3"></div>

        <div class="col-5">
            <div class="row">
                <div class="col-12">
                    <img src="/theme/assets/images/wu-white.png" width="160p" />
                </div>

                <div class="col-8"></div>

                <div class="col-12">
                    <p style="color: white;" id="loginTxt4">ระบบบริหารจัดการผลงานทางวิชาการ มหาวิทยาลัยวลัยลักษณ์</p>
                </div>
            </div>

            <div class="card card-login" style="height: 380px;">
                <div class="text-center mb-1">
                    <div class="card-body" style="padding-top: 30px">
                        <div class="card-title">
                            <h4 class="text-center login-title">
                                <dt id="loginTxt">เข้าสู่ระบบ</dt>
                            </h4>
                        </div>

                        <form method="post">
                            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                            <div class="row">
                                <div class="selectgroup w-100 col-12">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="LoginForm[lang]" value="th" class="selectgroup-input" checked="" onClick="language.value = this.value;ChangeLang('th');">
                                        <span class="selectgroup-button">ภาษาไทย</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="LoginForm[lang]" value="en" class="selectgroup-input" onClick="language.value = this.value;ChangeLang('en');">
                                        <span class="selectgroup-button">ENGLISH</span>
                                    </label>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-icon">
                                    <span class="input-icon-addon"><i class="fe fe-user"></i></span>
                                    <input type="text" name="userrname" class="form-control form-control-login" value="<?= $lf->username ?>" placeholder="<?= Yii::t('app', 'Email or Username') ?>" required>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="input-icon">
                                    <span class="input-icon-addon"><i class="fa fa-unlock-alt"></i></span>
                                    <input type="password" name="passsword" class="form-control form-control-login" placeholder="<?= Yii::t('app', 'Password') ?>" required>
                                </div>
                            </div>

                            <div class="form-footer">
                                <!-- check_users_status -->
                                <input type="hidden" name="language" id="language" value='TH'>

                                <button class="btn btn-login" id="send-data" type="submit" style="width: 100%;">
                                    <dt id="loginTxt2"><?= Yii::t('app', 'เข้าสู่ระบบ') ?></dt>
                                </button>

                                <!-- <button class="button-85" role="button">Button 85</button> -->
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function ChangeLang(lang) {
                        if (lang == 'th') {
                            $('#loginTxt').html('เข้าสู่ระบบ');
                            $('#loginTxt2').html('เข้าสู่ระบบ');
                            $('#loginTxt3').html('ระบบบริหารจัดการผลงานทางวิชาการ มหาวิทยาลัยวลัยลักษณ์');
                            $('#loginTxt4').html('ระบบบริหารจัดการผลงานทางวิชาการ มหาวิทยาลัยวลัยลักษณ์');
                        } else if (lang == 'en') {
                            $('#loginTxt').html('Log in');
                            $('#loginTxt2').html('Log in');
                            $('#loginTxt3').html('Academic Works Information System');
                            $('#loginTxt4').html('Academic Works Information System');
                        }
                    }

                    document.addEventListener("DOMContentLoaded", function() {
                        const images = document.querySelectorAll('.image-container img');
                        let currentImageIndex = 0;

                        function showNextImage() {
                            images[currentImageIndex].style.opacity = 0; // ซ่อนรูปปัจจุบัน
                            currentImageIndex = (currentImageIndex + 1) % images.length; // เลื่อนไปรูปถัดไป
                            images[currentImageIndex].style.opacity = 1; // แสดงรูปใหม่
                        }

                        // แสดงรูปภาพแรกทันทีเมื่อหน้าเว็บโหลด
                        images[currentImageIndex].style.opacity = 1;

                        // เรียกใช้ฟังก์ชันเปลี่ยนรูปภาพทุก 3 วินาที
                        setInterval(showNextImage, 6000);
                    });
                </script>

            </div>
        </div>

        <div class="col-3"></div>

    </div>

    <div class="auth_right">
        <div class="carousel slide" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="image-container">
                        <img src="/theme/assets/images/hero.png" class="img-fluid" alt="Image 4" />
                        <img src="/theme/assets/images/hero-img.png" class="img-fluid" alt="Image 6" />
                        <img src="/theme/assets/images/validation.png" class="img-fluid" alt="Image 5" />
                        <!-- <img src="/theme/assets/images/freelance-img.png" class="img-fluid" alt="Image 3" /> -->
                        <!-- <img src="/theme/assets/images/about-img.png" class="img-fluid" alt="Image 2" /> -->
                        <!-- <img src="/theme/assets/images/slider-img.png" class="img-fluid" alt="Image 1" /> -->
                    </div>

                    <!-- about-img -->
                    <div class="px-4 mt-3">
                        <!-- <h4 style="color: white;" id="loginTxt3">Academic Works Information System</h4> -->
                        <h5 style="color: white;" id="loginTxt3">ระบบบริหารจัดการผลงานทางวิชาการ มหาวิทยาลัยวลัยลักษณ์</h5>
                        <br>
                        <img src="/theme/assets/images/phone.png" width="20px" />
                        <span style="color: white;"> 73476</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
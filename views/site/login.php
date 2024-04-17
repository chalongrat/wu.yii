<?php

namespace app\views;

use Yii;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<style>
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
</style>


<div class="auth">
    <div class="auth_left">
        <div class="card card-login">
            <div class="text-center mb-2">
                <div class="card-body">
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
                        $('#loginTxt3').html('บริหารจัดการผลงานทางวิชาการ มหาวิทยาลัยวลัยลักษณ์');
                    } else if (lang == 'en') {
                        $('#loginTxt').html('Log in');
                        $('#loginTxt2').html('Log in');
                        $('#loginTxt3').html('Academic Works Information System');
                    }
                }
            </script>

        </div>
    </div>
    <div class="auth_right">
        <div class="carousel slide" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= Url::base() ?>/theme/assets/images/slider2.png" class="img-fluid" alt="login page" />
                    <div class="px-4 mt-4">
                        <h4>Academic Works Information System</h4>
                        <p id="loginTxt3">บริหารจัดการผลงานทางวิชาการ มหาวิทยาลัยวลัยลักษณ์</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
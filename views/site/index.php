<?php

use app\assets\AppAsset;

/** @var yii\web\View $this */
$this->registerJsFile('@web/app/card/menuCard.js', ['depends' => AppAsset::className()]);
$this->title = 'menu';
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,200;0,400;0,800;1,200;1,400;1,800&family=Kanit:ital,wght@0,200;0,300;0,400;0,700;1,200;1,300;1,400;1,700&family=Mitr:wght@400;500;600;700&display=swap');
</style>

<style>
    .fontsize18 {
        font-size: 18px;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        /* font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica,
            Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; */
        font-family: 'K2D', sans-serif !important;
    }

    .card-header {
        font-family: 'Mitr', sans-serif !important;
    }

    .main-container {
        padding: 30px;
    }

    /* HEADING */

    .heading {
        text-align: center;
    }

    .heading__title {
        font-weight: 600;
    }

    .heading__credits {
        margin: 10px 0px;
        color: #888888;
        font-size: 25px;
        transition: all 0.5s;
    }

    .heading__link {
        text-decoration: none;
    }

    .heading__credits .heading__link {
        color: inherit;
    }

    /* CARDS */

    .cards {
        display: flex;
        flex-wrap: wrap;
        /* justify-content: space-between; */
    }

    .card-css {
        /* margin: 5px; */
        padding: 20px;
        /* width: 500px; */
        min-height: 200px;
        display: grid;
        grid-template-rows: 20px 50px 1fr 50px;
        border-radius: 10px;
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.25);
        transition: all 0.2s;
    }

    .card-css:hover {
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.4);
        transform: scale(1.01);
    }

    .card-css1:hover {
        box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.4);
        transform: scale(1.05);
    }

    .card__link,
    .card__exit,
    .card__icon {
        position: relative;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.9);
    }

    .card__link::after {
        position: absolute;
        top: 25px;
        left: 0;
        content: "";
        width: 0%;
        height: 3px;
        background-color: rgba(255, 255, 255, 0.6);
        transition: all 0.5s;
    }

    .card__link:hover::after {
        width: 100%;
    }


    /* CARD BACKGROUNDS */

    .card-1 {
        /* background: radial-gradient(#1fe4f5, #3fbafe); */
        background: #3fbafe;
    }

    .card-2 {
        /* background: radial-gradient(#fbc1cc, #fa99b2); */
        background: #fa99b2;
    }

    .card-3 {
        /* background: radial-gradient(#76b2fe, #b69efe); */
        background: #b69efe;
    }

    .card-4 {
        /* background: radial-gradient(#60efbc, #58d5c9); */
        background: #58d5c9;
    }

    .card-5 {
        /* background: radial-gradient(#f588d8, #c0a3e5); */
        background: #c0a3e5;
    }

    .card-6 {
        /* background: radial-gradient(#EEEEEE, #BCBCBC); */
        /* background: radial-gradient(#F3F6F4, #BCBCBC); */
        background: white;
    }

    /* RESPONSIVE */

    @media (max-width: 1600px) {
        .cards {
            justify-content: center;
        }
    }

    .card-header {
        padding-bottom: 5px;
    }

    .card-body {
        padding-top: 5px;
    }

    /** rewrite */
    .title {
        font-weight: 800;
    }

    .pb-10,
    .right_chat,
    .new_timeline h4 {
        padding-bottom: 0px;
    }

    .desc h4 {
        margin-bottom: 0.2rem;
    }
</style>


<div class="site-index">
    <div class="section-body">
        <div style="overflow-x: auto;">
            <input type="hidden" id="personid" class="form-control" value="<?php //Yii::$app->users->getPersonID() 
                                                                            ?>">
            <div class="card-body">
                <div class="clearfix">
                    <div class="col-12"><br></div>

                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">ทำนุบำรุงศิลปะวัฒนธรรม</h3>
                                    <div class="card-options">
                                        <label class="custom-switch m-0">
                                            <input type="checkbox" value="1" class="custom-switch-input" checked="">
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <span class="tag tag-blue mb-3">Web Design</span>
                                    <p>ภาระงานงานทำนุบำรุงศิลปะและวัฒนธรรม</p>
                                </div>
                                <div class="card-footer">
                                    <div class="clearfix">
                                        <div class="float-left"><strong>15%</strong></div>
                                        <div class="float-right"><small class="text-muted">Progress</small></div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-red" role="progressbar" style="width: 15%" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">วิจัยและพัฒนาผลงานฯ</h3>
                                    <div class="card-options">
                                        <label class="custom-switch m-0">
                                            <input type="checkbox" value="1" class="custom-switch-input" checked="">
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <span class="tag tag-danger mb-3">Web Design</span>
                                    <p style="margin-bottom: 0px;">ผลงานสร้างสรรค์</p>
                                    <p style="margin-bottom: 0px;">การพัฒนาระบบสารสนเทศและสื่อการศึกษา</p>
                                    <p style="margin-bottom: 0px;">งานออกแบบ</p>
                                    <p style="margin-bottom: 0px;">การผลิตภาพยนตร์สารคดี หรือภาพยนตร์สั้น</p>
                                </div>
                                <div class="card-footer">
                                    <div class="clearfix">
                                        <div class="float-left"><strong>15%</strong></div>
                                        <div class="float-right"><small class="text-muted">Progress</small></div>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-red" role="progressbar" style="width: 15%" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <div class="card h-100">
                                <div class="card-status"></div>
                                <div class="card-header">
                                    <h3 class="card-title">บริการวิชาการ</h3>
                                    <div class="card-options">
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="new_timeline mt-3">
                                        <li>
                                            <div class="bullet pink"></div>
                                            <!-- <div class="time">11:00am</div> -->
                                            <div class="desc">
                                                <h3>การบริการที่ปรึกษา</h3>
                                                <h4>การเป็นที่ปรึกษาให้แก่หน่วยงานทั้งภาครัฐและเอกชน</h4>
                                                <h4>การติดตามและประเมินผลโครงการและการให้คำปรึกษาทั่วไป</h4>
                                                <h4>การรับดำเนินการสำรวจ ศึกษา วิจัยและพัฒนาให้แก่หน่วยงาน</h4>
                                                <h4>การวางระบบ ออกแบบ (เป็นงานที่พัฒนาขึ้นใหม่)</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bullet pink"></div>
                                            <!-- <div class="time">11:30am</div> -->
                                            <div class="desc">
                                                <h3>การบรรยายพิเศษ</h3>
                                                <h4>การเป็นอาจารย์พิเศษในสถาบันการศึกษาอื่น</h4>
                                                <h4>โครงการพิเศษของมหาวิทยาลัย เช่น โอลิมปิกวิชา</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bullet green"></div>
                                            <!-- <div class="time">12:00pm</div> -->
                                            <div class="desc">
                                                <h3>การฝึกอบรมและเผยแพร่</h3>
                                                <h4>การเป็นวิทยากร การจัดรายการวิทยุและโทรทัศน์</h4>
                                                <h4>การเป็นหัวหน้าโครงการบริการวิชาการด้านการ</h4>
                                                <h4>การเขียนบทความทั่วไป สารคดี</h4>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bullet green"></div>
                                            <!-- <div class="time">2:00pm</div> -->
                                            <div class="desc">
                                                <h3>การให้บริการทางการศึกษาภายนอกมหาวิทยาลัย</h3>
                                                <i class="fa fa-caret-right"></i>
                                                <a href="#" style="color: #c0a3e5;">“In-Kind Opportunity”</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bullet orange"></div>
                                            <!-- <div class="time">1:30pm</div> -->
                                            <div class="desc">
                                                <h3>การให้บริการตรวจวัดและวิเคราะห์</h3>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="bullet green"></div>
                                            <!-- <div class="time">2:38pm</div> -->
                                            <div class="desc">
                                                <h3>การเผยแพร่สิ่งประดิษฐ์</h3>
                                                <h4>Go to Home</h4>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h3 class="card-title">บริการวิชาการ</h3>
                                    <div class="card-options">
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                        <div class="item-action dropdown ml-2">
                                            <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled feeds_widget">
                                        <li>
                                            <div class="feeds-left"><i class="fa fa-thumbs-o-up"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title">การบริการที่ปรึกษา</h4>
                                                <small>การเป็นที่ปรึกษาให้แก่หน่วยงานทั้งภาครัฐ..</small>
                                                <small>การติดตามและประเมินผลโครงการและการให้คำปรึกษาทั่วไป</small>
                                                <small>การรับดำเนินการสำรวจ ศึกษา วิจัยและพัฒนา</small>
                                                <small>การวางระบบ ออกแบบ (เป็นงานที่พัฒนาขึ้นใหม่)</small>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="feeds-left"><i class="fa fa-user"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title">การบรรยายพิเศษ</h4>
                                                <small>การเป็นอาจารย์พิเศษในสถาบันการศึกษาอื่น</small>
                                                <small>โครงการพิเศษของมหาวิทยาลัย เช่น โอลิมปิกวิชาการ</small>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="feeds-left"><i class="fa fa-question-circle"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-warning">การฝึกอบรมและเผยแพร่</h4>
                                                <small>การเป็นวิทยากร การจัดรายการวิทยุและโทรทัศน์</small>
                                                <small>การเป็นหัวหน้าโครงการบริการวิชาการด้านการฝึกอบรม</small>
                                                <small>การเขียนบทความทั่วไป สารคดี</small>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="feeds-left"><i class="fa fa-check"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">การให้บริการทางการศึกษาภายนอกมหาวิทยาลัย</h4>
                                                <small>การเป็นอาจารย์ที่ปรึกษาวิทยานิพนธ์ให้กับหน่วยงานภายนอก</small>
                                                <small>ประธานหรือกรรมการสอบโครงร่างหรือสอบป้องกันวิทยานิพนธ์</small>
                                                <small>การเป็นกรรมการวิชาการ หรือกรรมการวิชาชีพ</small>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="feeds-left"><i class="fa fa-building"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title">การให้บริการตรวจวัดและวิเคราะห์</h4>
                                                <small>การให้บริการวิเคราะห์ทางห้องปฏิบัติการ หรือ การตรวจวัด</small>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="feeds-left"><i class="fa fa-image"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title">การเผยแพร่สิ่งประดิษฐ์</h4>
                                                <small>การเผยแพร่เครื่องมือ อุปกรณ์ สิ่งประดิษฐ์ และโปรแกรมคอมพิวเตอร์</small>
                                            </div>
                                        </li>

                                    </ul>
                                </div>

                            </div>
                        </div>


                    </div>


                    <!-- <div class="bd-example row">
                        <div class="col-4 pb-4">
                            <div class="card text-black card-6 card-css1 mb-3 h-100" style="max-width: 100%;">
                                <div class="card-header fontsize18">งานวิจัย</div>
                                <div class="card-body">
                                    <h5 class="card-title">Primary card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 pb-4">
                            <div class="card text-black card-6 card-css1 mb-3 h-100" style="max-width: 100%;">
                                <div class="card-header fontsize18">บริการวิชาการ</div>
                                <div class="card-body">
                                    <span>- การบริการที่ปรึกษา</span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><a href="javascript:void(0)">- การเป็นที่ปรึกษาให้แก่หน่วยงานทั้งภาครัฐและเอกชนโดยใช้วิชาชีพเป็นองค์ประกอบ</a></span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><a href="javascript:void(0)">- การติดตามและประเมินผลโครงการและการให้คำปรึกษาทั่วไป</a></span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><a href="javascript:void(0)">- การรับดำเนินการสำรวจ ศึกษา วิจัยและพัฒนาให้แก่หน่วยงานทั้งภาครัฐและเอกชน</a></span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><a href="javascript:void(0)">- การวางระบบ ออกแบบ (เป็นงานที่พัฒนาขึ้นใหม่)</a></span>
                                    <br>

                                    <span>- การบรรยายพิเศษ</span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><a href="javascript:void(0)">- การเป็นอาจารย์พิเศษในสถาบันการศึกษาอื่น</a></span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><a href="javascript:void(0)">- โครงการพิเศษของมหาวิทยาลัย เช่น โอลิมปิกวิชาการ สอนปรับพื้นฐานให้นักศึกษาใหม่ เป็นต้น</a></span>
                                    <br>

                                    <span>- การฝึกอบรมและเผยแพร่</span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><a href="javascript:void(0)">- การเป็นวิทยากร การจัดรายการวิทยุและโทรทัศน์</a></span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><a href="javascript:void(0)">- การเป็นหัวหน้าโครงการบริการวิชาการด้านการฝึกอบรม สัมมนาประชุมทางวิชาการ</a></span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span><a href="javascript:void(0)">- การเขียนบทความทั่วไป สารคดี</a></span>
                                    <br>


                                    <span>- การให้บริการทางการศึกษาภายนอกมหาวิทยาลัย และการผลิตสื่อการศึกษา</span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span>- การเป็นอาจารย์ที่ปรึกษาวิทยานิพนธ์ให้กับหน่วยงานภายนอก</span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="javascript:void(0)">- ที่ปรึกษาหลัก</a></span>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="javascript:void(0)">- ที่ปรึกษาร่วม</a></span>
                                    <br>

                                </div>
                            </div>
                        </div>

                        <div class="col-4 pb-4">
                            <div class="card text-black card-6 card-css1 mb-3 h-100" style="max-width: 100%;">
                                <div class="card-header fontsize18">ภาระงานงานทำนุบำรุงศิลปะและวัฒนธรรม</div>
                                <div class="card-body">
                                    <a href="javascript:void(0)">- งานทำนุบำรุงศิลปะและวัฒนธรรม</a>

                                </div>
                            </div>
                        </div>

                        <div class="col-4 pb-4">
                            <div class="card text-black card-4 card-css1 mb-3 h-100" style="max-width: 100%;">
                                <div class="card-header fontsize18">ภาระงานทำนุบำรุงศิลปฯ</div>
                                <div class="card-body">
                                    <h5 class="card-title">Danger card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 pb-4">
                            <div class="card text-black card-5 card-css1 mb-3 h-100" style="max-width: 100%;">
                                <div class="card-header fontsize18">ภาระงานอาจารย์ที่ปรึกษา</div>
                                <div class="card-body">
                                    <h5 class="card-title">Warning card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-4 pb-4">
                            <div class="card text-black card-1 card-css1 mb-3 h-100" style="max-width: 100%;">
                                <div class="card-header fontsize18">ภาระงานประธานหรือผู้ประสานงานหลักสูตร</div>
                                <div class="card-body">
                                    <h5 class="card-title">Info card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 pb-4">
                            <div class="card text-black card-2 card-css1 mb-3 h-100" style="max-width: 100%;">
                                <div class="card-header fontsize18">งานอื่นๆ</div>
                                <div class="card-body">
                                    <h5 class="card-title">Light card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 pb-4">
                            <div class="card text-black card-3 card-css1 mb-3 h-100" style="max-width: 100%;">
                                <div class="card-header fontsize18">สรุปภาระงานทั้งหมด</div>
                                <div class="card-body">
                                    <h5 class="card-title">Dark card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <a href="/apsjob/jobform" class="has-arrow arrow-c switch_module" data-menu-id="9" data-module-id="9" data-main-menu-name="Welfare &amp; Benefits">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <span>View Form </span>
                    </a>

                    <div class="row" id="dinamic_format"></div>

                </div>
            </div>
        </div>
    </div>
</div>
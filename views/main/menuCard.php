<?php

use app\assets\AppAsset;

/** @var yii\web\View $this */
$this->registerJsFile('@web/app/card/menuCard.js', ['depends' => AppAsset::className()]);
$this->title = 'หน้าหลัก';
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,200;0,400;0,800;1,200;1,400;1,800&family=Kanit:ital,wght@0,200;0,300;0,400;0,700;1,200;1,300;1,400;1,700&family=Mitr:wght@400;500;600;700&display=swap');
</style>

<style>
    .fontsize18 {
        font-size: 18px;
    }

    .fixedfront {
        font-size: 14px;
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

    /* .card-body {
        padding-top: 5px;
    } */

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

<div class="site-index" id="menuCard">
    <div class="section-body">
        <div style="overflow-x: hidden;">
            <div class="card-body">
                <div class="clearfix">

                    <div class="row" id="dinamic_format"></div>

                </div>
            </div>
        </div>
    </div>
</div>
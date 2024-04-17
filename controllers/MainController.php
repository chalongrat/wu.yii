<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

use app\models\LoginForm;
use app\models\User;

use yii\web\Request;

class MainController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
            return $this->redirect(['site/login']);

        // $this->layout = false;
        return $this->render('menuCard');
    }
}

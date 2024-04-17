<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;


class CultureformController extends Controller
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

    public function actionIndex(?string $formType = null)
    {
        $this->layout = false;
        return $this->render('culturelist', ['formType' => $formType]);
    }

    public function actionCuleditform(?int $formListID = null)
    {
        $this->layout = false;
        return $this->render('cultureform', ['formListID' => $formListID]);
    }
}

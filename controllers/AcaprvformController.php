<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class AcaprvformController extends Controller
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
        return $this->render('acaprvlist', ['formType' => $formType]);
    }

    public function actionAcaprvform(?int $formListID = null, ?string $formType = null)
    {
        $this->layout = false;
        return $this->render('acaprvform', ['formListID' => $formListID, 'formType' => $formType]);
    }
}

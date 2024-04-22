<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class RegacaformController extends Controller
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
        return $this->render('regacalist', ['formType' => $formType]);
    }

    public function actionRegacaform(?string $formListID = null, ?string $formType = null)
    {
        $this->layout = false;
        return $this->render('regacaform', ['formListID' => $formListID, 'formType' => $formType]);
    }

    // // auth from hrms
    // public function actionAcaprvform_auth(?int $formListID = null, ?string $formType = null)
    // {
    //     return $this->render('acaprvform', ['formListID' => $formListID, 'formType' => $formType]);
    // }
}

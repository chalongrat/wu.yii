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
        return $this->render('culturelist', ['formType' => $formType, 'bypass' => null]);
    }

    public function actionCuleditform(?int $formListID = null, ?string $formType = null)
    {
        $this->layout = false;
        return $this->render('cultureform', ['formListID' => $formListID, 'formType' => $formType]);
    }

    // auth from hrms
    public function actionCultureform_auth(?int $formListID = null, ?string $formType = null)
    {
        return $this->render('cultureform', ['formListID' => $formListID, 'formType' => $formType]);
    }
}

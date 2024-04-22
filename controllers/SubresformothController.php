<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class SubresformothController extends Controller
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
        return $this->render('subreslist', ['formType' => $formType]);
    }

    public function actionSubresform(?int $formListID = null, ?string $formType = null)
    {
        $this->layout = false;
        return $this->render('subresform', ['formListID' => $formListID, 'formType' => $formType]);
    }

    // auth from hrms
    public function actionSubresformoth_auth(?int $formListID = null, ?string $formType = null)
    {
        return $this->render('subresform', ['formListID' => $formListID, 'formType' => $formType]);
    }
}

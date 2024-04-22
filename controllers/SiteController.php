<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

use app\models\LoginForm;
use app\models\User;

use yii\web\Request;

class SiteController extends Controller
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => false
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
            return $this->redirect(['login']);

        return $this->redirect(['/main']);
    }

    public function actionLogin()
    {
        $lf = new LoginForm();

        $lf->password = '';

        if ($this->request->isPost) {
            $this->setHttpLoginRequest($this->request, $lf);

            if ($lf->auth()) {
                return $this->goHome();
            }
        }

        $this->layout = "blank";
        return $this->render('login_v3', [
            'lf' => $lf,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    private function setHttpLoginRequest(Request $r, LoginForm $l): void
    {
        $l->username = $r->post("userrname");
        $l->password = $r->post("passsword");
    }
}

<?php

namespace app\controllers;

use app\components\UserIdentity;
use yii\helpers\Url;
use app\models\User;
use Yii;
use yii\web\Controller;

class ExternalController extends Controller
{
    public function beforeAction($action)
    {
        $token = $this->request->get("access_token");
        $moduleType_name = $this->request->get("moduletype_name");
        $moduleType_id = $this->request->get("formtype_id");
        $formid = $this->request->get("form_id");

        // var_dump($token);
        // var_dump($moduleType_name);
        // var_dump($moduleType_id);
        // var_dump($formid);

        $user = User::findIdentityByAccessToken($token);

        Yii::$app->user->login($user);

        if (!$user) {
            return $this->redirect(['site/login']);
        } else {
            $ident = new UserIdentity();
            $identInfo = $ident->authToken($token);

            if ($identInfo) {
                Yii::$app->session->set("profile", $identInfo->profile);

                //set lang
                Yii::$app->session->set("sessionLang", $user->USER_LANG);

                // return $this->redirect(['/cultureform/culeditform_auth', 'formListID' => $formid, 'formType' => $moduleType_id]);
                return $this->redirect(['/' . $moduleType_name . '/' . $moduleType_name . '_auth', 'formListID' => $formid, 'formType' => $moduleType_id]);
            }

            return $this->redirect(["site/index"]);
        }
    }

    public function actionIndex()
    {
        // echo "<br>xxxxxxxx";
    }
}

<?php

namespace app\controllers;

use app\components\UserIdentity;
use yii\helpers\Url;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\db\Connection;

class UsersController extends Controller
{
    public function actionUpdatelang($lang, $person_id)
    {
        $u = User::findByPersonid($person_id);

        if ($u) {
            $u->USER_LANG = $lang;
            $u->save();

            //set lang
            Yii::$app->session->set("sessionLang", $lang);
        }
        // return $this->redirect(Url::toRoute(['site/index']));
    }
}

<?php

namespace app\components;

use app\models\_Service;
use Yii;
use yii\base\Component;

class UserComponent extends Component
{
    public function getUserlanguage()
    {
        $session = Yii::$app->session;
        $session->open();
        return empty($session->get('language')) ? 'th' : $session->get('language');
    }

    public function getIdentity($id = null)
    {
        if ($id == null) {
            $id = Yii::$app->user->identity->USERNAME;
        }
        return _Service::studenIdentity($id);
    }

    public function getActiveUser()
    {
        $model = Yii::$app->db->createCommand("SELECT ID
        FROM STD_USER ")
            ->queryOne();
    }
}

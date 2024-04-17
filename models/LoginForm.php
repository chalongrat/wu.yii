<?php

namespace app\models;

use app\components\UserIdentity;
use stdClass;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $role = 2;

    private $_user = false;
    public $lang = "th";


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }

    public function auth(): mixed
    {
        $ident = new UserIdentity();
        $identInfo = $ident->authAd($this->username, $this->password, $this->role);

        if ($identInfo->code === 200) {

            Yii::$app->session->set("profile", $identInfo->profile);

            $u = User::findByUsername($this->username);

            if (empty($u)) {
                $u = new User();
                $u->USERNAME = $this->username;
                $u->PASSWORD_HASH = Yii::$app->security->generatePasswordHash($this->password);
                $u->PERSON_ID = $identInfo->profile->person_id;
                $u->USER_LANG = $this->lang;
                $u->CREATED_AT = date('d-M-Y h.i.s a');
            }

            $u->ACCESS_TOKEN = Yii::$app->security->generateRandomString() . "." . time();
            $u->UPDATED_AT = date('d-M-Y h.i.s a');
            $u->save();

            return Yii::$app->user->login($u, $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }
}

<?php

namespace app\models;

use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $full_name;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'DBACFG.CFG_USER';
    }

    public static function primaryKey() {
        return ["ID"];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PASSWORD_HASH', 'USERNAME'], 'required'],
            [['STATUS'], 'integer'],
            [['PERSON_ID'], 'number'],
            [['CREATED_AT', 'UPDATED_AT'], 'safe'],
            [['USER_LANG'], 'string', 'max' => 2],
            [['PASSWORD_HASH', 'USERNAME', 'ACCESS_TOKEN', 'AUTH_KEY', 'RESET_PASSWORD_TOKEN'], 'string', 'max' => 100],
        ];
    }


    public static function findByUsername($username) {
        return static::findOne(['USERNAME'=>$username, 'STATUS' => 1]);
    }

    public function getAuthKey()
    {
        return $this->AUTH_KEY;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public static function findIdentity($id)
    {
        return static::findOne(['ID'=>$id, 'STATUS' => 1]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['ACCESS_TOKEN' => $token]);
    }

    public function validatePassword($password) {  
        return Yii::$app->security->validatePassword($password, $this->PASSWORD_HASH);
    }

}

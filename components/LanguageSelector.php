<?php

namespace app\components;

use app\models\User;
use Yii;
use yii\base\BootstrapInterface;
use yii\web\Cookie;
use yii\base\Exception;

class LanguageSelector implements BootstrapInterface
{
    public $supportedLanguages = [];

    public function bootstrap($app)
    {
        $cookies = $app->response->cookies;
        $languageNew = \Yii::$app->users->getUserLanguage();

        if (Yii::$app->helpers->decodeUrl('language')) {
            $_SESSION['language'] = Yii::$app->helpers->decodeUrl('language');
            $languageNew = Yii::$app->helpers->decodeUrl('language');
        }

        if ($languageNew !== null) {
            if (!in_array($languageNew, $this->supportedLanguages)) { //ตรวจสอบว่า language ที่ส่งมาตรงกับที่ตั้งค่าไว้หรือเปล่า
                throw new Exception('Invalid your selected language.'); //ถ้าไม่มี language ในรายการก็ exception
            }
            $cookies->add(new Cookie([
                'name' => 'language',
                'value' => $languageNew,
                'expire' => time() + 60 * 60 * 24 * 30,
            ]));
            $app->language = $languageNew;

            if (!empty(Yii::$app->user->id)) {
                $identity = User::findOne(['ID' => Yii::$app->user->id]);
                if ($identity) {
                    $identity->USER_LANG = $app->language;
                    // $identity->save();
                    Yii::$app->user->setIdentity($identity);
                }
            }
        } else {
            $preferedLanguage = isset($app->request->cookies['language']) ? (string) $app->request->cookies['language'] : 'th'; //หากยังไม่ได้เลือกภาษาให้เป็นภาษาไทยก่อน
            if (empty($preferedLanguage)) {
                $preferedLanguage = $app->request->getPreferedLanguage($this->supportedLanguages); //หากยังไม่เลือกภาษา ให้ตรวจสอบว่าอยู่ในรายการหรือเปล่า
            }
            $app->language = $preferedLanguage;
        }
    }
}

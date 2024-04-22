<?php

namespace app\components;

use stdClass;

use Yii;

class UserIdentity
{
    function authAd(string $uname, string $pwd, mixed $role): ?stdClass
    {
        $password = str_replace("&", "/#", $pwd);

        $identityProfile = $this->authentication($uname, $password, $role);

        return $identityProfile;
    }

    private function authentication(string $u, string  $p, mixed $r): stdClass
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $url = 'https://apisprd.wu.ac.th/oauth/auth/login';
        // $url = 'https://apisprd.wu.ac.th/apis/oauth/auth/login';

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        date_default_timezone_set("Asia/Bangkok");

        $chOne = curl_init();
        curl_setopt($chOne, CURLOPT_URL, $url);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($chOne, CURLOPT_POST, 1);
        curl_setopt($chOne, CURLOPT_POSTFIELDS, "username={$u}&password={$p}&r={$r}&clientId=" . Yii::$app->id);
        $headers = array('Content-type: application/x-www-form-urlencoded');
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($chOne);

        return json_decode($result);
    }

    function authToken(string $token): ?stdClass
    {
        // return $identityProfile;

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $url = 'https://apisprd.wu.ac.th/oauth/auth/login-token?accessToken=' . $token;

        // $url = 'https://apisprd.wu.ac.th/apis/oauth/auth/login';

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        date_default_timezone_set("Asia/Bangkok");

        $chOne = curl_init();
        curl_setopt($chOne, CURLOPT_URL, $url);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
        // curl_setopt($chOne, CURLOPT_POST, 1);
        // curl_setopt($chOne, CURLOPT_POSTFIELDS, "accessToken={$token}");
        $headers = array('Content-type: application/x-www-form-urlencoded');
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($chOne);

        return json_decode($result);
    }
}

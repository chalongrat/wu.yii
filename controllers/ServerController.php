<?php

namespace app\controllers;

use app\components\UserIdentity;
use yii\helpers\Url;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\db\Connection;

class ServerController extends Controller
{
    public function beforeAction($action)
    {
        $err_api_server = "";
        $url = 'https://apisqas.wu.ac.th/server/status/server';

        $response = @file_get_contents($url);

        if ($response == false || strpos($http_response_header[0], '404') !== false) {
            // "URL returned a 404 error."
            $err_api_server = 404;
        } else {
            // URL is accessible.
            $err_api_server = 200;
        }

        //----------------------------------------------------------------
        $err_db_server = "";
        $url = 'https://apisqas.wu.ac.th/server/status/db';

        $response = @file_get_contents($url);

        if ($response == false || strpos($http_response_header[0], '404') !== false) {
            // "URL returned a 404 error."
            $err_db_server = 520;
        } else {
            // URL is accessible.
            $err_db_server = 200;
        }

        // return $message;
        return $err_api_server . "/" . $err_db_server;
    }

    public function actionIndex()
    {
        return $this->beforeAction(null);
    }
}

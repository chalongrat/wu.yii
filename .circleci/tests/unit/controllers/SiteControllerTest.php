<?php

namespace tests\unit\controllers;

use app\controllers\SiteController;
use GuzzleHttp\Psr7\Request;
use Yii;


class SiteControllersTest extends \Codeception\Test\Unit {

    public function testActionIndex() {
        $controller = new SiteController('site', Yii::$app);
        $response = $controller->actionIndex();
        $this->assertStringContainsString('Congratulations!', $response);
        $this->assertStringNotContainsString('heading', $response);
    }

    public function testActionSingupUser() {
        // $request_mock = $this->createMock(Request::class);
        // $request_mock->method('POST')->willReturn([
        //     'SignupForm' => [
        //         'username' => 'dev01',
        //         'email' => 'dev01@mail.com',
        //         'password' => '123456'
        //     ]
        // ]);

        // Yii::$app->set('request', $request_mock);
        // $controller = new SiteController('site', Yii::$app);
        // $response = $controller->actionSignupUser();
        // $this->assertArrayHasKey('response', $response);
        // $this->assertEquals('Ok', $response['response']);
    }
}

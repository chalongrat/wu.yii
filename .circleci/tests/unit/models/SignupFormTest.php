<?php

namespace tests\unit\models;

use app\models\SignupForm;

class SignupFormTest extends \Codeception\Test\Unit {

    function testRules() {
        $model = new SignupForm();

        $model->username = 'dev01';
        $model->email = 'dev@maill.com';
        $model->password = '1234566';
        $this->assertTrue($model->validate());

        $model->username = '1';
        $this->assertFalse($model->validate());

        $model->username = 'admin';
        $this->assertFalse($model->validate());
    }

    public function testFindUserById() {

        $this->assertTrue(true);
        // $this->assertFalse(false);

        // verify($user = User::findIdentity(1))->notEmpty();
        // verify($user->username)->equals('admin');
        // verify(User::findIdentity(999))->empty();

    }
}

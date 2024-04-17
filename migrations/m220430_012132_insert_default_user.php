<?php

use yii\db\Migration;

/**
 * Class m220430_012132_insert_default_user
 */
class m220430_012132_insert_default_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        //default password = 123456
        $this->insert('user', array(
            'id' => 1,
            'username' => 'admin',
            'fname' => 'ผู้พัฒนา',
            'lname' => 'ระดับสูงสุด',
            'tel_no' => '0875548754',
            'auth_key' => 'UnMCS4aTGGG2ulDBz-iNAcg8jDVmbA_i',
            'password_hash' => '$2y$13$9cOOiiLFop4y.IW.rc7W7./6m5U2FCrSLGpicwYe3cwacnIybc4GS',
            'password_reset_token' => null,
            'email' => 'dev.default@example.com',
            'role' => 0,
            'status' => 10,

        ));

        //default password = 123456
        $this->insert('user', array(
            //'id' => 2,
            'username' => 'user01',
            'fname' => 'ผู้ใช้งาน01',
            'lname' => 'ทดสอบ01',
            'tel_no' => '0867542168',
            'auth_key' => 'UnMCS4aTGGG2ulDBz-iNAcg8jDVmbI_b',
            'password_hash' => '$2y$13$9cOOiiLFop4y.IW.rc7W7./6m5U2FCrSLGpicwYe3cwacnIybc4GS',
            'password_reset_token' => null,
            'email' => 'user01.default@example.com',
            'role' => 1,
            'status' => 10,

        ));

        //default password = 123456
        $this->insert('user', array(
            //'id' => 2,
            'username' => 'user02',
            'fname' => 'ผู้ใช้งาน02',
            'lname' => 'ทดสอบ02',
            'tel_no' => '0875554214',
            'auth_key' => 'UnMCS4aTGGG2ulDBz-iNAcg8jDVmbI_c',
            'password_hash' => '$2y$13$9cOOiiLFop4y.IW.rc7W7./6m5U2FCrSLGpicwYe3cwacnIybc4GS',
            'password_reset_token' => null,
            'email' => 'user02.default@example.com',
            'role' => 1,
            'status' => 10,

        ));

        //default password = 123456
        $this->insert('user', array(
            //'id' => 2,
            'username' => 'user03',
            'fname' => 'ผู้ใช้งาน03',
            'lname' => 'ทดสอบ03',
            'tel_no' => '0875456878',
            'auth_key' => 'UnMCS4aTGGG2ulDBz-iNAcg8jDVmbI_d',
            'password_hash' => '$2y$13$9cOOiiLFop4y.IW.rc7W7./6m5U2FCrSLGpicwYe3cwacnIybc4GS',
            'password_reset_token' => null,
            'email' => 'user03.default@example.com',
            'role' => 2,
            'status' => 10,

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->truncateTable('user')->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220430_012132_insert_default_user cannot be reverted.\n";

        return false;
    }
    */
}

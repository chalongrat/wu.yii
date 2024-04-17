<?php

use yii\db\Migration;

/**
 * Class m220101_004717_add_profile_column_to_user
 */
class m220101_004717_add_profile_column_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'fname', $this->string(100)->defaultValue('Your fullname')->after('username'));
        $this->addColumn('{{%user}}', 'lname', $this->string(100)->defaultValue('Your lastname')->after('fname'));
        $this->addColumn('{{%user}}', 'tel_no', $this->string(50)->defaultValue(null)->after('lname'));
        $this->addColumn('{{%user}}', 'role', $this->integer(2)->defaultValue(1)->after('tel_no')->notNull());

        //make self foreignkey 
        $this->addForeignKey(
            'fk_user_created_by_user_id',
            '{{%user}}',
            'created_by_user_id',
            '{{%user}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_user_updated_by_user_id',
            '{{%user}}',
            'updated_by_user_id',
            '{{%user}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey('fk_user_created_by_user_id', '{{%user}}');
        $this->dropForeignKey('fk_user_updated_by_user_id', '{{%user}}');

        $this->dropColumn('{{%user}}', 'fname');
        $this->dropColumn('{{%user}}', 'lname');
        $this->dropColumn('{{%user}}', 'role');
        $this->dropColumn('{{%user}}', 'tel_no');
        //echo "m220101_004717_add_profile_column_to_user .\n";

        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220101_004717_add_profile_column_to_user cannot be reverted.\n";

        return false;
    }
    */
}

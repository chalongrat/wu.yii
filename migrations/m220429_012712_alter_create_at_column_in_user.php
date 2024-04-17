<?php

use yii\db\Migration;

/**
 * Class m220429_012712_alter_create_at_column_in_user
 */
class m220429_012712_alter_create_at_column_in_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->alterColumn('{{%user}}', 'created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('{{%user}}', 'updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE NOW()'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220429_012712_alter_create_at_column_in_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220429_012712_alter_create_at_column_in_user cannot be reverted.\n";

        return false;
    }
    */
}

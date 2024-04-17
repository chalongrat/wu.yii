<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbnumber".
 *
 * @property int $number_a
 * @property int $number_b
 * @property int $result
 * @property int $pk_number
 */
class Tbnumber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbnumber';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number_a', 'number_b', 'result', 'pk_number'], 'required'],
            [['number_a', 'number_b', 'result', 'pk_number'], 'integer'],
            [['pk_number'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'number_a' => 'Number A',
            'number_b' => 'Number B',
            'result' => 'Result',
            'pk_number' => 'Pk Number',
        ];
    }
}

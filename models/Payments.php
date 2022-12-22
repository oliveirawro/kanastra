<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $debtId
 * @property string $paidAt
 * @property float $paidAmount
 * @property string $paidBy
 */
class Payments extends \yii\db\ActiveRecord
{

    const SCENARIO_CREATE = 'create';


    public static function tableName()
    {
        return 'payments';
    }

    public function rules()
    {
        return [
            [['debtId', 'paidAt', 'paidAmount', 'paidBy'], 'required'],
            [['debtId'], 'integer'],
            [['paidAt'], 'safe'],
            [['paidAmount'], 'number'],
            [['debtId'], 'unique'],
            [
                'paidBy', 'match',
                'pattern' => '/^[a-zA-Z\s]+$/',
                'message' => 'Invalid characters in paidBy field',
            ],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['debtId','paidAt','paidAmount','paidBy'];
        return $scenarios;
    }




    public function attributeLabels()
    {
        return [
            'debtId' => 'Payments ID',
            'paidAt' => 'Paid At',
            'paidAmount' => 'Paid Amount',
            'paidBy' => 'Paid By',
        ];
    }
}

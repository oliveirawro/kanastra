<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoices".
 *
 * @property int $id
 * @property string $governmentId
 * @property string $name
 * @property int $debtId
 * @property string $email
 * @property float $debtAmount
 * @property string $debtDueDate
 */
class Invoices extends \yii\db\ActiveRecord
{

    public $paidAmount;
    public $paidAt;
    public $paidBy;

    public static function tableName()
    {
        return 'invoices';
    }


    public function rules()
    {
        return [
            [['debtId'], 'integer'],
            [['governmentId', 'name', 'debtId', 'email', 'debtAmount', 'debtDueDate'], 'required'],
            [['debtAmount'], 'number'],
            [['debtDueDate','paidAt'], 'safe'],
            [['debtId'], 'unique'],
            [['governmentId'], 'string', 'max' => 20],
            [['name', 'email'], 'string', 'max' => 200],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'governmentId' => 'Government ID',
            'name' => 'Name',
            'debtId' => 'Payments ID',
            'email' => 'Email',
            'debtAmount' => 'Payments Amount',
            'debtDueDate' => 'Payments Due Date',
            'paidAt' => 'paidAt',
        ];
    }
}

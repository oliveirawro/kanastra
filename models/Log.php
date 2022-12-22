<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;


class Log extends \yii\db\ActiveRecord
{

    public $file;

    public static function tableName()
    {
        return 'log';
    }


    public function rules()
    {
        return [
            [['action', 'dateTimeAction'], 'required'],
            [['action'], 'string'],
            [['file'], 'file'],
            [['dateTimeAction'], 'safe'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action' => 'Action',
            'dateTimeAction' => 'Date Time Loaded',
        ];
    }
}

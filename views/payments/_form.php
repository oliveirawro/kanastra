<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Payments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="debt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'debtId', [
        'options' => ['class' => 'form-group form-inline'] ])
        ->textInput(['style' => 'width: 80px; margin-left: 10px;']); ?>

    <?= $form->field($model, 'paidAt', [
        'options' => ['class' => 'form-group form-inline'] ])
        ->textInput(['style' => 'width: 200px; margin-left: 10px;']); ?>

    <?= $form->field($model, 'paidAmount', [
        'options' => ['class' => 'form-group form-inline'] ])
        ->textInput(['style' => 'width: 80px; margin-left: 10px;','maxlength' => true]); ?>

    <?= $form->field($model, 'paidBy', [
        'options' => ['class' => 'form-group form-inline'] ])
        ->textInput(['style' => 'width: 200px; margin-left: 10px;','maxlength' => true]); ?>



    <div class="form-group" style="float: right">
        <?=Html::a("<i class='fa fa-caret-left'></i> " . "Back" ,["index"], ["class" => "cla-btn btn-primary"]); ?>
        <?=Html::submitButton(Yii::t('app', 'Save'), ['name' => 'btnSubmit', 'value' => 'true', 'id'=>'btnSubmit', 'class' => 'cla-btn btn-green']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

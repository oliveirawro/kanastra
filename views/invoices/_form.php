<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Invoices $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="invoices-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'governmentId', [
        'options' => ['class' => 'form-group form-inline'] ])
        ->textInput(['style' => 'width: 150px; margin-left: 10px;', ['maxlength' => true]]); ?>

    <?= $form->field($model, 'name', [
        'options' => ['class' => 'form-group form-inline'] ])
        ->textInput(['style' => 'width: 300px; margin-left: 10px;', ['maxlength' => true]]); ?>

    <?= $form->field($model, 'debtId', [
        'options' => ['class' => 'form-group form-inline'] ])
        ->textInput(['style' => 'width: 80px; margin-left: 10px;']); ?>

    <?= $form->field($model, 'email', [
        'options' => ['class' => 'form-group form-inline'] ])
        ->textInput(['style' => 'width: 200px; margin-left: 10px;', ['maxlength' => true]]); ?>

    <?= $form->field($model, 'debtAmount', [
        'options' => ['class' => 'form-group form-inline'] ])
        ->textInput(['style' => 'width: 100px; margin-left: 10px;', ['maxlength' => true]]); ?>

    <?= $form->field($model, 'debtDueDate', [
        'options' => ['class' => 'form-group form-inline'] ])
        ->textInput(['style' => 'width: 200px; margin-left: 10px;']); ?>



    <div class="form-group" style="float: right">
        <?=Html::a("<i class='fa fa-caret-left'></i> " . "Back" ,["index"], ["class" => "cla-btn btn-primary"]); ?>
        <?=Html::submitButton(Yii::t('app', 'Save'), ['name' => 'btnSubmit', 'value' => 'true', 'id'=>'btnSubmit', 'class' => 'cla-btn btn-green']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

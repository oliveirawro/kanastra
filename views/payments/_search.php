<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PaymentsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="debt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <div class="row"  style="background-color:#efefef; margin: 20px 2px 20px 2px; padding:10px">

        <div class="col-lg-4">
            <h4>Search by:</h4>

            <?= $form->field($model, 'debtId', [
                'options' => ['class' => 'form-group form-inline'] ])
                ->textInput(['style' => 'width: 200px; margin-left: 10px;']); ?>
        </div>

        <div class="col-lg-4" style="padding-top:40px">

            <?= $form->field($model, 'paidBy', [
                'options' => ['class' => 'form-group form-inline'] ])
                ->textInput(['style' => 'width: 200px; margin-left: 10px;']); ?>

        </div>
        <div class="col-lg-4"style="padding-top:40px">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>






    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $modelLog app\models\Log */
/* @var $form yii\widgets\ActiveForm */

$this->params['breadcrumbs'][] = ['label' => 'Upload CSV', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div id="title-bar" class="container" style="">
    <div style="">
        <h1 class="title">Upload CSV</h1>
        <p class='subtitle'>Please upload a CSV file to parser.</p>
    </div>
</div>



<div class="url-create">


    <div class="url-form form-gray">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <div class="" style="height: 250px">


            <div class="col-sm-11" style="margin-top:50px">
                <?= $form->field($modelLog, 'file')->fileInput(['class' =>'btn btn-yellow', 'style' => 'width:500px;'])->label(''); ?>
            </div>

        </div>


        <div class="form-group" style="float: right">
            <?=Html::a("<i class='fa fa-caret-left'></i> " . "Back" ,["index"], ["class" => "cla-btn btn-primary"]); ?>
            <?=Html::submitButton(Yii::t('app', 'Upload'), ['name' => 'btnSubmit', 'value' => 'true', 'id'=>'btnSubmit', 'class' => 'cla-btn btn-green']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

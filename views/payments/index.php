<?php

use app\models\Payments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\PaymentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="debt-index">


    <p style="float: right">
        <?= Html::a('Add Payments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>


    <?php echo $this->render('_search', ['model' => $searchModel]); ?>


    <script>

        $(function() {

            window.setInterval(function(){
                $.pjax.reload({container: '#pjax_id', async: false});
            }, 2000); //reloading after 2 seconds...

        });

    </script>



    <?php Pjax::begin(['id'=>'pjax_id', 'timeout' => 500]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}{pager}{summary}',
        'columns' => [


            [
                'label' => 'Payments Id',
                'attribute' => 'debtId',
                'value' => 'debtId',
                'contentOptions' => ['style' => 'width: 80px;text-align:center'],
                'headerOptions'  => ['style' => 'text-align:center'],
            ],

            [
                'label' => 'Paid At',
                'attribute' => 'paidAt',
                'value' => function($model) {
                    return date("d/m/Y H:m:s", strtotime($model->paidAt));
                },
            ],

            [
                'label' => 'Paid Amount',
                'attribute' => 'paidAmount',
                'value' => function($model) {
                    return number_format($model->paidAmount, 2, ',', '.');
                },
                'headerOptions'  => ['style' => 'text-align:center'],
                'contentOptions' => ['style' => 'width: 200px;text-align:right'],
            ],

            [
                'label' => 'Paid By',
                'attribute' => 'paidBy',
                'value' => 'paidBy',
            ],

            

        ],
    ]);
    ?>

    <?php Pjax::end(); ?>



</div>

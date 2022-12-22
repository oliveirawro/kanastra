<?php

use app\models\Invoices;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use app\common\Util;
use yii\db\Query;
use yii\data\SqlDataProvider;


/** @var yii\web\View $this */
/** @var app\models\InvoicesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoices-index">

    <p style="float: right">
        <?= Html::a('Add Invoice', ['create'], ['class' => 'btn btn-success']) ?>
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
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => [


            [
                'label' => 'Debt Id',
                'attribute' => 'debtId',
                'value' => 'debtId',
                'contentOptions' => ['style' => 'width: 80px;text-align:center'],
                'headerOptions'  => ['style' => 'text-align:center'],
            ],

            [
                'label' => 'Government Id',
                'attribute' => 'governmentId',
                'value' => function($dataProvider) {
                    return Util::formatCPF($dataProvider->governmentId);
                },
            ],

            [
                'label' => 'Name',
                'attribute' => 'name',
                'value' => 'name',
            ],

            [
                'label' => 'Email',
                'attribute' => 'email',
                'value' => 'email',
            ],

            [
                'label' => 'Debt Amount',
                'attribute' => 'debtAmount',
                'value' => function($model) {
                    return number_format($model->debtAmount, 2, ',', '.');
                },
                'headerOptions'  => ['style' => 'text-align:center'],
            ],

            [
                'label' => 'Debt Due Date',
                'attribute' => 'debtDueDate',
                'value' => function($model) {
                    return (!$model->debtDueDate) ? "" : date("d/m/Y h:m:s", strtotime($model->debtDueDate));
                },
            ],

            [
                'label' => 'Paid At',
                'attribute' => 'paidAt',
                'value' => function($model) {
                    return (!$model->paidAt) ? "" : date("d/m/Y h:m:s", strtotime($model->paidAt));
                },
            ],

            [
                'label' => 'Paid Amount',
                'attribute' => 'paidAmount',
                'value' => function($model) {
                    return (!$model->paidAmount) ? "" : number_format($model->paidAmount, 2, ',', '.');
                },
            ],

            [
                'label' => 'Paid By',
                'attribute' => 'paidBy',
                'value' => 'paidBy',
            ],




        ],
    ]); ?>





</div>

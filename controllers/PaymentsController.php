<?php

namespace app\controllers;

use app\common\Util;
use app\models\Invoices;
use app\models\Payments;
use app\models\PaymentsSearch;
use app\models\Log;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PaymentsController implements the CRUD actions for Payments model.
 */
class PaymentsController extends Controller
{

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'receive-payment' => ['POST'],
                    ],
                ],
            ]
        );
    }


    public function beforeAction($action) {
        if($action->id == 'create-payments') {
            \Yii::$app->request->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }


    public function actionIndex()
    {
        $searchModel = new PaymentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pagination' => ['pageSize' => 10],
        ]);
    }





    public function actionCreate()
    {
        $model = new Payments();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                return $this->redirect(['payments/index']);

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }




    public function actionReceivePayment()
    {


        $data = json_decode(\Yii::$app->request->getRawBody());
        $data = (array) $data;



        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $debt = new Payments();
        $debt->scenario = Payments:: SCENARIO_CREATE;
        $debt->attributes = $data;


        if($debt->validate())
        {
            $debt->save();
            return array('status' => true, 'data'=> 'Payload is successfully updated');
        }
        else
        {
            return array('status'=>false,'data'=>$debt->getErrors());
        }
    }




    protected function findModel($debtId)
    {
        if (($model = Payments::findOne(['debtId' => $debtId])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace app\controllers;

use app\models\Invoices;
use app\models\InvoicesSearch;
use app\models\Log;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * InvoicesController implements the CRUD actions for Invoices model.
 */
class InvoicesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }


    public function actionIndex()
    {
        $searchModel = new InvoicesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }




    public function actionCreate()
    {
        $model = new Invoices();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                return $this->redirect(['invoices/index']);

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



    public function actionUpload()
    {
        $modelLog = new Log();

        $posted = \Yii::$app->request->post();

        if ($modelLog->load($posted)) {

            $uploadPath = dirname(__DIR__) . '/uploads/';
            $modelLog->dateTimeAction = date("Y-m-d H:i:s");

            if (\Yii::$app->request->isPost) {

                $modelLog->file = UploadedFile::getInstance($modelLog, 'file');
                $fileName =  time() . '__' . $modelLog->file->baseName . '.' . $modelLog->file->extension;
                $modelLog->action = "File uploaded: " . $fileName;


                if ($modelLog->file && $modelLog->validate()) {

                    $fullFileName = $uploadPath . $fileName;
                    $modelLog->file->saveAs($fullFileName);
                    $modelLog->save();

                    $this->fileParser($fullFileName);

                }

            }

        }

        return $this->render('upload', [
            'modelLog' => $modelLog,
        ]);

    }





    function fileParser($fullFileName='')
    {

        if(!file_exists($fullFileName) || !is_readable($fullFileName))
            return FALSE;

        $header = NULL;
        $data = array();
        $sql = "";
        if (($handle = fopen($fullFileName, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);

            }
            fclose($handle);
        }

        $columns = ['name', 'governmentId', 'email', 'debtAmount', 'debtDueDate', 'debtId'];

        try {
            \Yii::$app->db->createCommand()
                ->batchInsert('invoices', $columns, $data)
                ->execute();

        } catch (\yii\db\Exception $exception) {

        }

        return $this->redirect(['invoices/index']);


    }


    public function actionReceiveInvoice()
    {


        $request = \Yii::$app->request->getRawBody();
        $splited = preg_split("/\\r\\n|\\r|\\n/", $request);
        $data = array();

        foreach ($splited as $line) {
            $data[] = str_getcsv($line);
        }

        array_shift($data); # remove column header


        $columns = ['name', 'governmentId', 'email', 'debtAmount', 'debtDueDate', 'debtId'];

        try {

            \Yii::$app->db->createCommand()
                ->batchInsert('invoices', $columns, $data)
                ->execute();

            return 'Payload is successfully loaded';

        } catch(\yii\db\Exception $e) {
            var_dump($e->errorInfo[2]);
            die;
        }

    }





    protected function findModel($id)
    {
        if (($model = Invoices::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

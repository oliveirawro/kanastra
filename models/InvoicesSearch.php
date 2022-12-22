<?php

namespace app\models;

use app\models\Invoices;
use yii\base\Model;
use yii\data\ActiveDataProvider;



class InvoicesSearch extends Invoices
{


    public function rules()
    {
        return [
            [['id', 'debtId'], 'integer'],
            [['governmentId', 'name', 'email', 'debtDueDate'], 'safe'],
            [['debtAmount'], 'number'],
        ];
    }


    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        //$query = Invoices::find();

        $model = 'invoices';
        $query = Invoices::find();

        $query->leftJoin( 'payments', 'payments.debtId = invoices.debtId')->select(
            ['invoices.debtId', 'governmentId', 'name', 'email', 'debtAmount', 'debtDueDate', 'paidAt', 'paidBy', 'paidAmount']
        );


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            $model.'.id' => $this->id,
            $model.'.debtId' => $this->debtId,
            $model.'.debtAmount' => $this->debtAmount,
            $model.'.debtDueDate' => $this->debtDueDate,
            //'paidBy' => 'invoices.paidBy'

        ]);

        $query->andFilterWhere(['like', 'governmentId', $this->governmentId])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }





    public function getDebtors()
    {

        $query = Invoices::find();

        $query->leftJoin('payments', 'payments.debtId = invoices.debtId')
            ->select(['invoices.debtId', 'governmentId', 'name', 'email', 'debtAmount', 'debtDueDate', 'paidAt', 'paidBy', 'paidAmount'])
            ->where(['paidAt' => null]);

        $sql = $query->createCommand()->getRawSql();
        $query_data = \Yii::$app->db->createCommand($sql)->queryAll();

        return (array) $query_data;

    }


}

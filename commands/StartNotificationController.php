<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\InvoicesSearch;


class StartNotificationController extends Controller
{



    public function sendNotification($debtId, $governmentId, $name, $email, $debtAmount, $debtDueDate)
    {

        //send email procedure
        //...
        //...
        //...


        //loging
        $action = 'Notification sent to: <'. $email . '> 
                  | debId: '        . $debtId . '
                  | customer: '     . $name . ' 
                  | debt:'          . $debtAmount . ' 
                  | debtDueDate:'   . $debtDueDate;


        $dateTimeAction = date("Y-m-d H:i:s");

        $query = Yii::$app->db->createCommand()->insert('log',
            [
                'action'                    => $action,
                'dateTimeAction'            => $dateTimeAction
            ]);

        $query->execute();

        echo "Action: " . $action . "\n";
        echo "dateTimeAction: " . $dateTimeAction . "\n\n\n";


    }




    public function actionIndex()
    {

        $debtorsList = InvoicesSearch::getDebtors();

        foreach ($debtorsList as $field) {

            $debtId         = $field['debtId'];
            $governmentId   = $field['governmentId'];
            $name           = $field['name'];
            $email          = $field['email'];
            $debtAmount     = $field['debtAmount'];
            $debtDueDate    = $field['debtDueDate'];

            try {

                $this->sendNotification($debtId, $governmentId, $name, $email, $debtAmount, $debtDueDate);

            } catch (Exception $e) {

                echo "********* Error trying send notification" . $e->getMessage() . "**************";

            }

        }

        return ExitCode::OK;
    }
}

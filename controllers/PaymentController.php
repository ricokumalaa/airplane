<?php

namespace app\controllers;

use Yii;
// use yii\web\Controller;
use app\extensions\SessionController;
use app\models\Payment;

class PaymentController extends SessionController
{
    public function actionIndex()
    {
        if($this->sessionId == NULL)
        {
            $this->redirect(\Yii::$app->urlManager->createUrl("signin/"));
        }

        $this->layout = 'airplanenav';

        $payment = new Payment();

        $paymentLists = $payment->getAllPayment();
        $sessionId = $this->sessionId;
        $sessionFirstName = $this->sessionFirstName;

        return $this->render('payment', [
            'paymentLists' => json_encode($paymentLists),
            'sessionId' => json_encode($sessionId),
            'sessionFirstName' => json_encode($sessionFirstName)
        ]);
    }

    public function actionAdd()
    {
        $payment = new Payment();

        $paymentName = Yii::$app->request->getBodyParam('payment');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $payment->paymentName = $paymentName;
        $payment->createBy = $sessionId;
        $payment->scenario = 'add-payment';

        if($payment->validate())
        {
            $addPaymentSummary = $payment->addPayment();
            $paymentLists = $payment->getAllPayment();

            return json_encode([
                $addPaymentSummary,
                $paymentLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $payment->errors
            ]);
        }
    }

    public function actionUpdate()
    {
        $payment = new Payment();

        $id = Yii::$app->request->getBodyParam('id');
        $paymentName = Yii::$app->request->getBodyParam('payment');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $payment->id = $id;
        $payment->paymentName = $paymentName;
        $payment->updateBy = $sessionId;
        $payment->scenario = 'update-payment';

        if($payment->validate())
        {   
            $updatePaymentSummary = $payment->updatePayment();
            $paymentLists = $payment->getAllPayment();

            return json_encode([
                $updatePaymentSummary,
                $paymentLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $payment->errors
            ]);
        }
    }

    public function actionDelete()
    {
        $payment = new Payment();

        $id = Yii::$app->request->getBodyParam('id');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $payment->id = $id;
        $payment->updateBy = $sessionId;
        $payment->scenario = 'delete-payment';

        if($payment->validate())
        {   
            $deletePaymentSummary = $payment->deletePayment();
            $paymentLists = $payment->getAllPayment();

            return json_encode([
                $deletePaymentSummary,
                $paymentLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $payment->errors
            ]);
        }
    }
}
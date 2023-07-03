<?php

namespace app\controllers;

use Yii;
// use yii\web\Controller;
use app\extensions\SessionController;
use app\models\Seat;

class SeatController extends SessionController
{
    public function actionIndex()
    {
        if($this->sessionId == NULL)
        {
            $this->redirect(\Yii::$app->urlManager->createUrl("signin/"));
        }

        $this->layout = 'airplanenav';

        $seat = new Seat();

        $seatLists = $seat->getAllSeatType();
        $sessionId = $this->sessionId;
        $sessionFirstName = $this->sessionFirstName;

        return $this->render('seat', [
            'seatLists' => json_encode($seatLists),
            'sessionId' => json_encode($sessionId),
            'sessionFirstName' => json_encode($sessionFirstName)
        ]);
    }

    public function actionAdd()
    {
        $seat = new Seat();

        $name = Yii::$app->request->getBodyParam('type');
        $color = Yii::$app->request->getBodyParam('color');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $seat->name = $name;
        $seat->color = $color;
        $seat->createBy = $sessionId;
        $seat->scenario = 'add-seat-type';

        if($seat->validate())
        {
            $addSeatSummary = $seat->addSeatType();
            $seatLists = $seat->getAllSeatType();

            return json_encode([
                $addSeatSummary,
                $seatLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $seat->errors
            ]);
        }
    }

    public function actionUpdate()
    {
        $seat = new Seat();

        $id = Yii::$app->request->getBodyParam('id');
        $name = Yii::$app->request->getBodyParam('type');
        $color = Yii::$app->request->getBodyParam('color');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $seat->id = $id;
        $seat->name = $name;
        $seat->color = $color;
        $seat->updateBy = $sessionId;
        $seat->scenario = 'update-seat-type';


        if($seat->validate())
        {   
            $updateSeatSummary = $seat->updateSeatType();
            $seatLists = $seat->getAllSeatType();

            return json_encode([
                $updateSeatSummary,
                $seatLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $seat->errors
            ]);
        }
    }

    public function actionDelete()
    {
        $seat = new Seat();

        $id = Yii::$app->request->getBodyParam('id');

        $seat->id = $id;
        $seat->scenario = 'delete-seat-type';

        if($seat->validate())
        {   
            $deleteSeatSummary = $seat->deleteSeatType();
            $seatLists = $seat->getAllSeatType();
            
            return json_encode([
                $deleteSeatSummary,
                $seatLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $user->errors
            ]);
        }
    }
}
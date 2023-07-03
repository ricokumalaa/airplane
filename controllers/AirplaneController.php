<?php

namespace app\controllers;

use Yii;
// use yii\web\Controller;
use app\extensions\SessionController;
use app\models\Airplane;
use app\models\Seat;

class AirplaneController extends SessionController
{
    public function actionIndex()
    {
        if($this->sessionId == NULL)
        {
            $this->redirect(\Yii::$app->urlManager->createUrl("signin/"));
        }

        $this->layout = 'airplanenav';

        $airplane = new Airplane();
        $seat = new Seat();

        $airplaneLists = $airplane->getAllAirplane();
        $seatLists = $seat->getAllSeatType();
        $sessionId = $this->sessionId;
        $sessionFirstName = $this->sessionFirstName;

        return $this->render('airplane', [
            'airplaneLists' => json_encode($airplaneLists),
            'seatLists' => json_encode($seatLists),
            'sessionId' => json_encode($sessionId),
            'sessionFirstName' => json_encode($sessionFirstName)
        ]);
    }

    public function actionAdd()
    {
        $airplane = new Airplane();

        $name = Yii::$app->request->getBodyParam('name');
        $brand = Yii::$app->request->getBodyParam('brand');
        $model = Yii::$app->request->getBodyParam('model');
        $regis = Yii::$app->request->getBodyParam('regis');
        $color = Yii::$app->request->getBodyParam('color');
        $seatType = Yii::$app->request->getBodyParam('seatType');
        $row = Yii::$app->request->getBodyParam('row');
        $column = Yii::$app->request->getBodyParam('column');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $airplane->name = $name;
        $airplane->brand = $brand;
        $airplane->model = $model;
        $airplane->regis = $regis;
        $airplane->color = $color;
        $airplane->seatType = $seatType;
        $airplane->row = $row;
        $airplane->column = $column;
        $airplane->createBy = $sessionId;
        $airplane->scenario = 'add-airplane';

        if($airplane->validate())
        {
            $addAirplaneSummary = $airplane->addAirplane();
            $airplaneLists = $airplane->getAllAirplane();

            return json_encode([
                $addAirplaneSummary,
                $airplaneLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $airplane->errors
            ]);
        }
    }

    public function actionUpdate()
    {
        $differentSeat = array();
        $currentSeat = array();
        $seatToRemove = array();
        $seatToRemove = array();
        $airplane = new Airplane();

        $id = Yii::$app->request->getBodyParam('id');
        $name = Yii::$app->request->getBodyParam('name');
        $brand = Yii::$app->request->getBodyParam('brand');
        $model = Yii::$app->request->getBodyParam('model');
        $regis = Yii::$app->request->getBodyParam('regis');
        $color = Yii::$app->request->getBodyParam('color');
        $seatType = Yii::$app->request->getBodyParam('seatType');
        $row = Yii::$app->request->getBodyParam('row');
        $column = Yii::$app->request->getBodyParam('column');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');
        
        $airplane->id = $id;
        $airplane->name = $name;
        $airplane->brand = $brand;
        $airplane->model = $model;
        $airplane->regis = $regis;
        $airplane->color = $color;
        $airplane->seatType = $seatType;
        $airplane->row = $row;
        $airplane->column = $column;
        $airplane->createBy = $sessionId;
        $airplane->updateBy = $sessionId;
        $airplane->scenario = 'update-airplane';

        $seatTypeLists = $airplane->getSeatType();

        for ($i=0; $i < sizeof($seatTypeLists); $i++) { 
            array_push($currentSeat, $seatTypeLists[$i]['ID']);
        }

        $seatToRemove = array_diff($currentSeat, $seatType);
        $seatToAdd = array_diff($seatType, $currentSeat);
        $seatToAdd = array_values($seatToAdd);
        $seatToRemove = array_values($seatToRemove);

        $airplane->seatToAdd = $seatToAdd;
        $airplane->seatToRemove = $seatToRemove;

        if($airplane->validate())
        {
            $updateAirplaneSummary = $airplane->updateAirplane();
            $updateAirplaneSeatTypeSummary = NULL;
            if($updateAirplaneSummary['errNum'] == 0)
            {
                $updateAirplaneSeatTypeSummary = $airplane->updateAirplaneSeatType();
            }
            $AirplaneLists = $airplane->getAllAirplane();

            return json_encode([
                $updateAirplaneSummary,
                $AirplaneLists,
                $updateAirplaneSeatTypeSummary
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $airplane->errors
            ]);
        }
    }

    public function actionDelete()
    {
        $airplane = new Airplane();

        $id = Yii::$app->request->getBodyParam('airplaneId');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $airplane->id = $id;
        $airplane->updateBy = $sessionId;
        $airplane->scenario = 'delete-airplane';

        if($airplane->validate())
        {   
            $deleteAirplaneSummary = $airplane->deleteAirplane();
            $airplaneLists = $airplane->getAllAirplane();
            
            return json_encode([
                $deleteAirplaneSummary,
                $airplaneLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $airplane->errors
            ]);
        }
    }

    public function actionSetSeat()
    {
        $airplane = new Airplane();
        $x = array();
        $y = array();

        $airplaneId = Yii::$app->request->getBodyParam('airplaneId');
        $seatTypeId = Yii::$app->request->getBodyParam('seatTypeId');
        $seatStatus = Yii::$app->request->getBodyParam('seatStatus');
        $selectedSeat = Yii::$app->request->getBodyParam('selectedSeat');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        for ($i=0; $i < COUNT($selectedSeat) ; $i++) { 
            array_push($x, $selectedSeat[$i]['x']);
            array_push($y, $selectedSeat[$i]['y']);
        }
        
        $airplane->id = $airplaneId;
        $airplane->seatTypeId = $seatTypeId;
        $airplane->seatStatus = $seatStatus;
        $airplane->x = $x;
        $airplane->y = $y;
        $airplane->createBy = $sessionId;
        $airplane->updateBy = $sessionId;
        $airplane->scenario = 'set-seat';
        
        if($airplane->validate())
        {
            if($seatStatus == 'enable')
            {
                $setSeatResult = $airplane->setSeat();
            }
            else
            {
                $setSeatResult = $airplane->disableSeat();
            }
            $airplaneLists = $airplane->getAllAirplane();
            $seatMapLists = $airplane->getSeatMap();

            return json_encode([
                $setSeatResult,
                $airplaneLists,
                $seatMapLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $airplane->errors
            ]);
        }
    }

    public function actionGetSeat()
    {
        $airplane = new Airplane();

        $airplaneId = Yii::$app->request->getBodyParam('airplaneId');

        $airplane->id = $airplaneId;
        
        $seatMapLists = $airplane->getSeatMap();
        
        return json_encode([
            $seatMapLists
        ]);
    }
}
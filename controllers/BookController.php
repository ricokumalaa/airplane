<?php

namespace app\controllers;

use Yii;
// use yii\web\Controller;
use app\extensions\SessionController;
use app\models\Book;

class BookController extends SessionController
{
    public function actionIndex()
    {
        if($this->sessionId == NULL)
        {
            $this->redirect(\Yii::$app->urlManager->createUrl("signin/"));
        }

        $this->layout = 'airplanenav';

        $book = new Book();

        $availableFlightLists = $book->getAvailableFlight();
        $paymentLists = $book->getPayment();
        $sessionId = $this->sessionId;
        $sessionFirstName = $this->sessionFirstName;

        return $this->render('book', [
            'availableFlightLists' => json_encode($availableFlightLists),
            'paymentLists' => json_encode($paymentLists),
            'sessionId' => json_encode($sessionId),
            'sessionFirstName' => json_encode($sessionFirstName),
        ]);
    }

    public function actionGetSeat()
    {
        $book = new Book();

        $airplaneId = Yii::$app->request->getBodyParam('airplaneId');
        $seatTypeId = Yii::$app->request->getBodyParam('seatTypeId');

        $book->id = $airplaneId;
        $book->seatTypeId = $seatTypeId;
        
        $seatMapLists = $book->getSeatMap();
        
        return json_encode([
            $seatMapLists
        ]);
    }

    public function actionShowAvailableSeat()
    {
        $book = new Book();

        $airplaneId = Yii::$app->request->getBodyParam('airplaneId');
        $flightId = Yii::$app->request->getBodyParam('flightId');
        $seatTypeId = Yii::$app->request->getBodyParam('seatTypeId');

        $book->id = $airplaneId;
        $book->flightId = $flightId;
        $book->seatTypeId = $seatTypeId;
        
        $seatMapLists = $book->getSeatMap();
        $bookedSeatLists = $book->getBookedSeat();
        
        return json_encode([
            $seatMapLists,
            $bookedSeatLists
        ]);
    }

    public function actionAdd()
    {
        $book = new Book();
        $x = array();
        $y = array();
        $passangersName = array();

        $id = Yii::$app->request->getBodyParam('flightId');
        $seatTypeId = Yii::$app->request->getBodyParam('seatTypeId');
        $adultPassanger = Yii::$app->request->getBodyParam('adultPassanger');
        $childPassanger = Yii::$app->request->getBodyParam('childPassanger');
        $additionalBaggage = Yii::$app->request->getBodyParam('additionalBaggage');
        $totalTicket = Yii::$app->request->getBodyParam('totalTicket');
        $totalPrice = Yii::$app->request->getBodyParam('totalPrice');
        $bookSeat = Yii::$app->request->getBodyParam('bookSeat');
        $passangerName = Yii::$app->request->getBodyParam('passangerName');
        $childName = Yii::$app->request->getBodyParam('childName');
        $paymentId = Yii::$app->request->getBodyParam('paymentId');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        for ($i=0; $i < count($bookSeat); $i++) 
        { 
            array_push($x, $bookSeat[$i]["x"]);
            array_push($y, $bookSeat[$i]["y"]);
            array_push($passangersName, $passangerName[$i]);
        }

        $book->flightId = $id;
        $book->seatTypeId = $seatTypeId;
        $book->adultPassanger = $adultPassanger;
        $book->childPassanger = $childPassanger;
        $book->additionalBaggage = $additionalBaggage;
        $book->totalTicket = $totalTicket;
        $book->totalPrice = $totalPrice;
        $book->x = $x;
        $book->y = $y;
        $book->passangersName = $passangersName;
        $book->paymentId = $paymentId;
        $book->createBy = $sessionId;
        $book->scenario = 'add-book';

        if($book->validate())
        {
            $addBookSummary = $book->addBook();
            $availableFlightLists = $book->getAvailableFlight();
            $bookReport = $book->getLatestBook();
            // die(var_dump($bookReport[0]["ID"]));
            $book->id = $bookReport[0]["ID"];
            $ticketLists = $book->getTicket();

            return json_encode([
                $addBookSummary,
                $availableFlightLists,
                $bookReport,
                $ticketLists
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
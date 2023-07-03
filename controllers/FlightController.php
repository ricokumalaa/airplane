<?php

namespace app\controllers;

use Yii;
use DateTime;
// use yii\web\Controller;
use app\extensions\SessionController;
use app\models\Flight;
use app\models\Transit;

class FlightController extends SessionController
{
    public function actionIndex()
    {
        if($this->sessionId == NULL)
        {
            $this->redirect(\Yii::$app->urlManager->createUrl("signin/"));
        }

        $this->layout = 'airplanenav';

        $flight = new Flight();

        $flightLists = $flight->getAllFlight();
        $availableAirplaneLists = $flight->getAllAvailableAirplane();
        $sessionId = $this->sessionId;
        $sessionFirstName = $this->sessionFirstName;

        return $this->render('flight', [
            'flightLists' => json_encode($flightLists),
            'availableAirplaneLists' => json_encode($availableAirplaneLists),
            'sessionId' => json_encode($sessionId),
            'sessionFirstName' => json_encode($sessionFirstName)
        ]);
    }

    public function actionAdd()
    {
        $flight = new Flight();

        $airplaneId = Yii::$app->request->getBodyParam('airplaneId');
        $origin = Yii::$app->request->getBodyParam('origin');
        $destination = Yii::$app->request->getBodyParam('destination');
        $departure = Yii::$app->request->getBodyParam('departure');
        $arrival = Yii::$app->request->getBodyParam('arrival');
        $duration = Yii::$app->request->getBodyParam('duration');
        $baggage = Yii::$app->request->getBodyParam('baggage');
        $adult = Yii::$app->request->getBodyParam('adult');
        $child = Yii::$app->request->getBodyParam('child');
        $baggagePrice = Yii::$app->request->getBodyParam('baggagePrice');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $flight->airplaneId = $airplaneId;
        $flight->origin = $origin;
        $flight->destination = $destination;
        $flight->departure = $departure;
        $flight->arrival = $arrival;
        $flight->duration = $duration;
        $flight->baggage = $baggage;
        $flight->adult = $adult;
        $flight->child = $child;
        $flight->baggagePrice = $baggagePrice;
        $flight->createBy = $sessionId;
        $flight->scenario = 'add-flight';

        if($flight->validate())
        {
            $flightBefore = $flight->getFlightBefore();
            $flightAfter = $flight->getFlightAfter();
            
            $flightArrivalBefore = $flightBefore ? new DateTime($flightBefore[0]["ARRIVAL_TIME"]) : NULL;
            $flightDepartureAfter = $flightAfter ? new DateTime($flightAfter[0]["DEPARTURE_TIME"]) : NULL;
            $departureTime = new DateTime($departure);
            $arrivalTime = new DateTime($arrival);

            $flightLists = $flight->getAllFlight();
            
            if (($flightBefore && !$flightAfter) || (!$flightBefore && $flightAfter))
            {
                if(!($flightArrivalBefore && $flightArrivalBefore < $departureTime) && !($flightDepartureAfter && $flightDepartureAfter > $arrivalTime))
                {
                    $addFlightSummary = [
                        'errNum' => 1,
                        'errStr' => 'Airplane still has a flight on going at this time!'
                    ];

                    return json_encode([
                        $addFlightSummary,
                        $flightLists
                    ]);
                }
            }
            else if($flightBefore && $flightAfter)
            {
                if(!($flightArrivalBefore < $departureTime) || !($flightDepartureAfter > $arrivalTime))
                {
                    // die(var_dump("ada dua duanya tapi salah"));
                    $addFlightSummary = [
                        'errNum' => 1,
                        'errStr' => 'Airplane still has a flight on going at this time!'
                    ];

                    return json_encode([
                        $addFlightSummary,
                        $flightLists
                    ]);
                }
            }

            // die(var_dump("ketabamha kok"));
            $addFlightSummary = $flight->addFlight();
            $flightLists = $flight->getAllFlight();

            return json_encode([
                $addFlightSummary,
                $flightLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $flight->errors
            ]);
        }
    }

    public function actionUpdate()
    {
        $flight = new Flight();

        $id = Yii::$app->request->getBodyParam('id');
        $airplaneId = Yii::$app->request->getBodyParam('airplaneId');
        $origin = Yii::$app->request->getBodyParam('origin');
        $destination = Yii::$app->request->getBodyParam('destination');
        $departure = Yii::$app->request->getBodyParam('departure');
        $arrival = Yii::$app->request->getBodyParam('arrival');
        $duration = Yii::$app->request->getBodyParam('duration');
        $baggage = Yii::$app->request->getBodyParam('baggage');
        $adult = Yii::$app->request->getBodyParam('adult');
        $child = Yii::$app->request->getBodyParam('child');
        $baggagePrice = Yii::$app->request->getBodyParam('baggagePrice');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $flight->id = $id;
        $flight->airplaneId = $airplaneId;
        $flight->origin = $origin;
        $flight->destination = $destination;
        $flight->departure = $departure;
        $flight->arrival = $arrival;
        $flight->duration = $duration;
        $flight->baggage = $baggage;
        $flight->adult = $adult;
        $flight->child = $child;
        $flight->baggagePrice = $baggagePrice;
        $flight->updateBy = $sessionId;
        $flight->scenario = 'update-flight';

        if($flight->validate())
        {
            $containTransit = $flight->containTransit();
            $flightBefore = $flight->getFlightBeforeUpdate();
            $flightAfter = $flight->getFlightAfterUpdate();

            $departureTime = new DateTime($departure);
            $arrivalTime = new DateTime($arrival);
            
            $flightLists = $flight->getAllFlight();

            if($containTransit)
            {
                $firstTransit = $flight->getFirstTransit();
                $lastTransit = $flight->getLastTransit();
                
                $firstTransitArrival = new DateTime($firstTransit[0]["ARRIVAL_TIME"]);
                $lastTransitDeparture = new DateTime($lastTransit[0]["DEPARTURE_TIME"]);

                if(!($firstTransitArrival > $departureTime) || !($lastTransitDeparture < $arrivalTime))
                {
                    $updateFlightSummary = [
                        'errNum' => 1,
                        'errStr' => 'Airplane still has an on going transit at this time!'
                    ];

                    return json_encode([
                        $updateFlightSummary,
                        $flightLists
                    ]);
                }
            }

            $flightArrivalBefore = $flightBefore ? new DateTime($flightBefore[0]["ARRIVAL_TIME"]) : NULL;
            $flightDepartureAfter = $flightAfter ? new DateTime($flightAfter[0]["DEPARTURE_TIME"]) : NULL;


            $flightLists = $flight->getAllFlight();
            
            if (($flightBefore && !$flightAfter) || (!$flightBefore && $flightAfter))
            {
                if(!($flightArrivalBefore && $flightArrivalBefore < $departureTime) && !($flightDepartureAfter && $flightDepartureAfter > $arrivalTime))
                {
                    $updateFlightSummary = [
                        'errNum' => 1,
                        'errStr' => 'Airplane still has a flight on going at this time!'
                    ];

                    return json_encode([
                        $updateFlightSummary,
                        $flightLists
                    ]);
                }
            }
            else if($flightBefore && $flightAfter)
            {
                if(!($flightArrivalBefore < $departureTime) || !($flightDepartureAfter > $arrivalTime))
                {
                    $updateFlightSummary = [
                        'errNum' => 1,
                        'errStr' => 'Airplane still has a flight on going at this time!'
                    ];

                    return json_encode([
                        $updateFlightSummary,
                        $flightLists
                    ]);
                }
            }

            $updateFlightSummary = $flight->updateFlight();
            $flightLists = $flight->getAllFlight();

            return json_encode([
                $updateFlightSummary,
                $flightLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $flight->errors
            ]);
        }
    }

    public function actionDelete()
    {
        $flight = new Flight();

        $id = Yii::$app->request->getBodyParam('flightId');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $flight->id = $id;
        $flight->updateBy = $sessionId;
        $flight->scenario = 'delete-flight';

        if($flight->validate())
        {   
            $deleteFlightSummary = $flight->deleteFlight();
            $flightLists = $flight->getAllFlight();

            return json_encode([
                $deleteFlightSummary,
                $flightLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $flight->errors
            ]);
        }
    }

    public function actionAddTransit()
    {
        $flight = new Flight();
        $transit = new Transit();

        $flightId = Yii::$app->request->getBodyParam('id');
        $destination = Yii::$app->request->getBodyParam('destination');
        $arrival = Yii::$app->request->getBodyParam('arrival');
        $departure = Yii::$app->request->getBodyParam('departure');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $transit->flightId = $flightId;
        $transit->destination = $destination;
        $transit->arrival = $arrival;
        $transit->departure = $departure;
        $transit->createBy = $sessionId;
        $transit->scenario = 'add-transit';

        if($transit->validate())
        {
            $transitBefore = $transit->getTransitBefore();
            $transitAfter = $transit->getTransitAfter();
            
            $transitDepartureBefore = $transitBefore ? new DateTime($transitBefore[0]["DEPARTURE_TIME"]) : NULL;
            $transitArrivalAfter = $transitAfter ? new DateTime($transitAfter[0]["ARRIVAL_TIME"]) : NULL;
            $departureTime = new DateTime($departure);
            $arrivalTime = new DateTime($arrival);

            $flightLists = $flight->getAllFlight();
            
            if (($transitBefore && !$transitAfter) || (!$transitBefore && $transitAfter))
            {
                if(!($transitDepartureBefore && $transitDepartureBefore < $arrivalTime) && !($transitArrivalAfter && $transitArrivalAfter > $departureTime))
                {
                    $addTransitSummary = [
                        'errNum' => 1,
                        'errStr' => 'Airplane has another transit schedule at this time!'
                    ];

                    return json_encode([
                        $addTransitSummary,
                        $flightLists
                    ]);
                }
            }
            else if($transitBefore && $transitAfter)
            {
                if(!($transitDepartureBefore < $arrivalTime) || !($transitArrivalAfter > $departureTime))
                {
                    $addTransitSummary = [
                        'errNum' => 1,
                        'errStr' => 'Airplane has another transit schedule at this time!'
                    ];

                    return json_encode([
                        $addTransitSummary,
                        $flightLists
                    ]);
                }
            }

            $addTransitSummary = $transit->addTransit();
            $flightLists = $flight->getAllFlight();

            return json_encode([
                $addTransitSummary,
                $flightLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $transit->errors
            ]);
        }
    }

    public function actionGetTransit()
    {
        $transit = new transit();

        $flightId = Yii::$app->request->getBodyParam('flightId');

        $transit->flightId = $flightId;

        $transitLists = $transit->getFlightTransit();

        return json_encode([
            $transitLists,
        ]);
    }

    public function actionUpdateTransit()
    {
        $transit = new Transit();
        $flight = new Flight();

        $id = Yii::$app->request->getBodyParam('transitId');
        $flightId = Yii::$app->request->getBodyParam('flightId');
        $destination = Yii::$app->request->getBodyParam('destination');
        $arrival = Yii::$app->request->getBodyParam('arrival');
        $departure = Yii::$app->request->getBodyParam('departure');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $transit->id = $id;
        $transit->flightId = $flightId;
        $transit->destination = $destination;
        $transit->arrival = $arrival;
        $transit->departure = $departure;
        $transit->updateBy = $sessionId;
        $transit->scenario = 'update-transit';

        if($transit->validate())
        {
            $transitBefore = $transit->getEditTransitBefore();
            $transitAfter = $transit->getEditTransitAfter();
            
            $transitDepartureBefore = $transitBefore ? new DateTime($transitBefore[0]["DEPARTURE_TIME"]) : NULL;
            $transitArrivalAfter = $transitAfter ? new DateTime($transitAfter[0]["ARRIVAL_TIME"]) : NULL;
            $departureTime = new DateTime($departure);
            $arrivalTime = new DateTime($arrival);

            $flightLists = $flight->getAllFlight();
            
            if (($transitBefore && !$transitAfter) || (!$transitBefore && $transitAfter))
            {
                if(!($transitDepartureBefore && $transitDepartureBefore < $arrivalTime) && !($transitArrivalAfter && $transitArrivalAfter > $departureTime))
                {
                    $updateTransitSummary = [
                        'errNum' => 1,
                        'errStr' => 'Airplane has another transit schedule at this time!'
                    ];

                    return json_encode([
                        $updateTransitSummary,
                        $flightLists
                    ]);
                }
            }
            else if($transitBefore && $transitAfter)
            {
                if(!($transitDepartureBefore < $arrivalTime) || !($transitArrivalAfter > $departureTime))
                {
                    $updateTransitSummary = [
                        'errNum' => 1,
                        'errStr' => 'Airplane has another transit schedule at this time!'
                    ];

                    return json_encode([
                        $updateTransitSummary,
                        $flightLists
                    ]);
                }
            }

            $updateTransitSummary = $transit->updateTransit();
            $flightLists = $flight->getAllFlight();

            return json_encode([
                $updateTransitSummary,
                $flightLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $transit->errors
            ]);
        }
    }

    public function actionDeleteTransit()
    {
        $transit = new Transit();
        $flight = new Flight();

        $id = Yii::$app->request->getBodyParam('transitId');
        $flightId = Yii::$app->request->getBodyParam('flightId');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $transit->id = $id;
        $transit->flightId = $flightId;
        $transit->updateBy = $sessionId;
        $transit->scenario = 'delete-transit';

        if($transit->validate())
        {   
            $deleteTransitSummary = $transit->deleteTransit();
            $flightLists = $flight->getAllFlight();
            $transitLists = $transit->getFlightTransit();

            return json_encode([
                $deleteTransitSummary,
                $flightLists,
                $transitLists
            ]);
        }
        else
        {
            return json_encode([
                'errNum' => 1,
                'errStr' => $transit->errors
            ]);
        }
    }
}
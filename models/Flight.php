<?php

namespace app\models;

use Yii;
use PDO;
use yii\base\Model;

class Flight extends Model
{
    public $id;
    public $airplaneId;
    public $origin;
    public $destination;
    public $departure;
    public $arrival;
    public $duration;
    public $baggage;
    public $adult;
    public $child;
    public $baggagePrice;
    public $createBy;
    public $updateBy;
    public $errNum = 0;
    public $errStr = '';

    public function rules()
    {
        return [
            [['airplaneId', 'origin', 'destination', 'departure', 'arrival', 'duration', 'baggage', 'adult', 'child', 'baggagePrice', 'createBy'], 'required', 'on' => ['add-flight']],
            [['airplaneId', 'origin', 'destination', 'departure', 'arrival', 'duration', 'baggage', 'adult', 'child', 'baggagePrice', 'updateBy'], 'required', 'on' => ['update-flight']],
            [['id', 'updateBy'], 'required', 'on' => ['delete-flight']],
        ];
    }

    public function getAllFlight()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    f.id,
                    f.airplane_id,
                    (a.name || ' - ' || a.airplane_brand || ' - ' || a.airplane_model) AS airplane_name,
                    f.origin,
                    f.destination,
                    TO_CHAR(f.departure_time, 'DD-MM-YYYY HH24:MI') AS departure_time,
                    TO_CHAR(f.arrival_time, 'DD-MM-YYYY HH24:MI') AS arrival_time,
                    TO_CHAR(f.duration_time, 'HH24:MI') AS duration_time,
                    f.available_baggage,
                    f.adult_price,
                    f.child_price,
                    f.baggage_price,
                    COUNT(t.id) AS total_transit
                FROM
                    rico_ap_flights f
                    LEFT JOIN rico_ap_transits t ON f.id = t.flight_id
                    LEFT JOIN rico_ap_airplanes a ON f.airplane_id = a.id
                WHERE 
                    f.status = 1
                GROUP BY
                    f.id,
                    f.airplane_id,
                    a.name,
                    a.airplane_brand,
                    a.airplane_model,
                    f.origin,
                    f.destination,
                    f.departure_time,
                    f.arrival_time,
                    f.duration_time,
                    f.available_baggage,
                    f.adult_price,
                    f.child_price,
                    f.baggage_price
                ORDER BY
                    f.id
                ";

        $st = $db->createCommand($sql);
        // $st->bindParam(':flightId', $this->flightId);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getAllAvailableAirplane()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    ra.id,
                    (ra.name || ' - ' || ra.airplane_brand || ' - ' || ra.airplane_model) AS name,
                    max_row,
                    max_column
                FROM
                    rico_ap_airplanes ra
                WHERE 
                    status = 1
                    AND 1 = (
                            SELECT
                                1
                            FROM
                                rico_ap_airplane_seats ras
                            WHERE
                                ras.airplane_id = ra.id
                                AND rownum <= 1   
                            )
                ORDER BY
                        ra.id
                ";

        $st = $db->createCommand($sql);
        // $st->bindParam(':sessionId', $this->sessionId);
        $rows = $st->queryAll();

        return $rows;
    }

    public function addFlight()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_flights_insert
                    (
                        out_code                    =>  :outCode,
                        out_msg                     =>  :outMsg,
                        in_airplane_id              =>  :airplaneId,                        
                        in_origin                   =>  :origin,                        
                        in_destination              =>  :destination,                                              
                        in_departure_time           =>  TO_DATE(:departure, 'DD-MM-YYYY HH24:MI'),                                              
                        in_arrival_time             =>  TO_DATE(:arrival, 'DD-MM-YYYY HH24:MI'),                                              
                        in_duration_time            =>  TO_DATE(:duration, 'HH24:MI'),                                              
                        in_available_baggage        =>  :baggage,                                              
                        in_adult_price              =>  :adult,                                              
                        in_child_price              =>  :child,                                              
                        in_baggage_price            =>  :baggagePrice,                                              
                        in_create_by                =>  :createBy
                    );
                END;
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':airplaneId', $this->airplaneId);
        $st->bindParam(':origin', $this->origin);
        $st->bindParam(':destination', $this->destination);
        $st->bindParam(':departure', $this->departure);
        $st->bindParam(':arrival', $this->arrival);
        $st->bindParam(':duration', $this->duration);
        $st->bindParam(':baggage', $this->baggage);
        $st->bindParam(':adult', $this->adult);
        $st->bindParam(':child', $this->child);
        $st->bindParam(':baggagePrice', $this->baggagePrice);
        $st->bindParam(':createBy', $this->createBy);

        $tr = $db->beginTransaction();
        $st->execute();
        // $tr->rollback();

        if($this->errNum == 0)
        {
            $tr->commit();
        }
        else
        {
            $tr->rollback();
        }

        return[
            'errNum' => $this->errNum,
            'errStr' => $this->errStr
        ];
    }

    public function getFlightBefore()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    *
                FROM
                    (
                    SELECT
                        id,
                        TO_CHAR(departure_time, 'DD-MM-YYYY HH24:MI') AS departure_time,
                        TO_CHAR(arrival_time, 'DD-MM-YYYY HH24:MI') arrival_time
                    FROM
                        rico_ap_flights
                    WHERE
                        airplane_id = :airplaneId
                        AND departure_time <= TO_DATE(:departure, 'DD-MM-YYYY HH24:MI')
                        AND status = 1
                    ORDER BY arrival_time DESC
                    )
                WHERE
                    rownum = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':airplaneId', $this->airplaneId);
        $st->bindParam(':departure', $this->departure);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getFlightAfter()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    *
                FROM
                    (
                    SELECT
                        id,
                        TO_CHAR(departure_time, 'DD-MM-YYYY HH24:MI') AS departure_time,
                        TO_CHAR(arrival_time, 'DD-MM-YYYY HH24:MI') arrival_time
                    FROM
                        rico_ap_flights
                    WHERE
                        airplane_id = :airplaneId
                        AND departure_time >= TO_DATE(:departure, 'DD-MM-YYYY HH24:MI')
                        AND status = 1
                    ORDER BY arrival_time ASC
                    )
                WHERE
                    rownum = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':airplaneId', $this->airplaneId);
        $st->bindParam(':departure', $this->departure);
        $rows = $st->queryAll();

        return $rows;
    }

    public function updateFlight()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_flights_update
                    (
                        out_code                        =>  :outCode,
                        out_msg                         =>  :outMsg,
                        in_flight_id                    =>  :id,                                           
                        in_airplane_id                  =>  :airplaneId,                                           
                        in_origin                       =>  :origin,                                                
                        in_destination                  =>  :destination,                                                
                        in_departure_time               =>  TO_DATE(:departure, 'DD-MM-YYYY HH24:MI'),                        
                        in_arrival_time                 =>  TO_DATE(:arrival, 'DD-MM-YYYY HH24:MI'),                        
                        in_duration_time                =>  TO_DATE(:duration, 'HH24:MI'),                        
                        in_available_baggage            =>  :baggage,                        
                        in_adult_price                  =>  :adult,                        
                        in_child_price                  =>  :child,                        
                        in_baggage_price                =>  :baggagePrice,                        
                        in_update_by                    =>  :updateBy               
                    );
                END;";

        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':airplaneId', $this->airplaneId);
        $st->bindParam(':origin', $this->origin);
        $st->bindParam(':destination', $this->destination);
        $st->bindParam(':departure', $this->departure);
        $st->bindParam(':arrival', $this->arrival);
        $st->bindParam(':duration', $this->duration);
        $st->bindParam(':baggage', $this->baggage);
        $st->bindParam(':adult', $this->adult);
        $st->bindParam(':child', $this->child);
        $st->bindParam(':baggagePrice', $this->baggagePrice);
        $st->bindParam(':updateBy', $this->updateBy);

        $tr = $db->beginTransaction();
        $st->execute();
        // $tr->rollback();

        if($this->errNum == 0)
        {
            $tr->commit();
        }
        else
        {
            $tr->rollback();
        }

        return[
            'errNum' => $this->errNum,
            'errStr' => $this->errStr
        ];
    }

    public function containTransit()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    1
                FROM
                    rico_ap_transits
                WHERE
                    flight_id = :flightId
                    AND status = 1
                    AND rownum = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':flightId', $this->id);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getFirstTransit()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    *
                FROM
                    (
                    SELECT
                        id,
                        TO_CHAR(departure_time, 'DD-MM-YYYY HH24:MI') AS departure_time,
                        TO_CHAR(arrival_time, 'DD-MM-YYYY HH24:MI') arrival_time
                    FROM
                        rico_ap_transits
                    WHERE
                        flight_id = :flightId
                        AND status = 1
                    ORDER BY
                        arrival_time ASC
                    )
                WHERE
                    rownum = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':flightId', $this->id);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getLastTransit()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    *
                FROM
                    (
                    SELECT
                        id,
                        TO_CHAR(departure_time, 'DD-MM-YYYY HH24:MI') AS departure_time,
                        TO_CHAR(arrival_time, 'DD-MM-YYYY HH24:MI') arrival_time
                    FROM
                        rico_ap_transits
                    WHERE
                        flight_id = :flightId
                        AND status = 1
                    ORDER BY 
                        departure_time DESC
                    )
                WHERE
                    rownum = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':flightId', $this->id);
        $rows = $st->queryAll();

        return $rows;
    }
    
    public function getFlightBeforeUpdate()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    *
                FROM
                    (
                    SELECT
                        id,
                        TO_CHAR(departure_time, 'DD-MM-YYYY HH24:MI') AS departure_time,
                        TO_CHAR(arrival_time, 'DD-MM-YYYY HH24:MI') arrival_time
                    FROM
                        rico_ap_flights
                    WHERE
                        airplane_id = :airplaneId
                        AND departure_time <= TO_DATE(:departure, 'DD-MM-YYYY HH24:MI')
                        AND id != :flightId
                        AND status = 1
                    ORDER BY arrival_time DESC
                    )
                WHERE
                    rownum = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':flightId', $this->id);
        $st->bindParam(':airplaneId', $this->airplaneId);
        $st->bindParam(':departure', $this->departure);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getFlightAfterUpdate()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    *
                FROM
                    (
                    SELECT
                        id,
                        TO_CHAR(departure_time, 'DD-MM-YYYY HH24:MI') AS departure_time,
                        TO_CHAR(arrival_time, 'DD-MM-YYYY HH24:MI') arrival_time
                    FROM
                        rico_ap_flights
                    WHERE
                        airplane_id = :airplaneId
                        AND departure_time >= TO_DATE(:departure, 'DD-MM-YYYY HH24:MI')
                        AND id != :flightId
                        AND status = 1
                    ORDER BY arrival_time ASC
                    )
                WHERE
                    rownum = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':flightId', $this->id);
        $st->bindParam(':airplaneId', $this->airplaneId);
        $st->bindParam(':departure', $this->departure);
        $rows = $st->queryAll();

        return $rows;
    }

    public function deleteFlight()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_flights_delete
                    (
                        out_code            =>  :outCode,
                        out_msg             =>  :outMsg,
                        in_flight_id        =>  :flightId,                                                                 
                        in_update_by        =>  :updateBy               
                    );
                END;";

        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':flightId', $this->id);
        $st->bindParam(':updateBy', $this->updateBy);

        $tr = $db->beginTransaction();
        $st->execute();
        // $tr->rollback();

        if($this->errNum == 0)
        {
            $tr->commit();
        }
        else
        {
            $tr->rollback();
        }

        return[
            'errNum' => $this->errNum,
            'errStr' => $this->errStr
        ];
    }
}
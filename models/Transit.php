<?php

namespace app\models;

use Yii;
use PDO;
use yii\base\Model;

class Transit extends Model
{
    public $id;
    public $flightId;
    public $destination;
    public $arrival;
    public $departure;
    public $createBy;
    public $updateBy;
    public $errNum = 0;
    public $errStr = '';

    public function rules()
    {
        return [
            [['flightId', 'destination', 'arrival', 'departure', 'createBy'], 'required', 'on' => ['add-transit']],
            [['id', 'flightId', 'destination', 'arrival', 'departure', 'updateBy'], 'required', 'on' => ['update-transit']],
            [['id', 'flightId', 'updateBy'], 'required', 'on' => ['delete-transit']],
        ];
    }

    public function addTransit()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_transits_insert
                    (
                        out_code                    =>  :outCode,
                        out_msg                     =>  :outMsg,
                        in_flight_id                =>  :flightId,                                            
                        in_destination              =>  :destination,                                              
                        in_arrival_time             =>  TO_DATE(:arrival, 'DD-MM-YYYY HH24:MI'),                                              
                        in_departure_time           =>  TO_DATE(:departure, 'DD-MM-YYYY HH24:MI'),                                                                                          
                        in_create_by                =>  :createBy
                    );
                END;
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':flightId', $this->flightId);
        $st->bindParam(':destination', $this->destination);
        $st->bindParam(':arrival', $this->arrival);
        $st->bindParam(':departure', $this->departure);
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

    public function updateTransit()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_transits_update
                    (
                        out_code                    =>  :outCode,
                        out_msg                     =>  :outMsg,
                        in_id                       =>  :id,                                            
                        in_flight_id                =>  :flightId,                                            
                        in_destination              =>  :destination,                                              
                        in_arrival_time             =>  TO_DATE(:arrival, 'DD-MM-YYYY HH24:MI'),                                              
                        in_departure_time           =>  TO_DATE(:departure, 'DD-MM-YYYY HH24:MI'),                                                                                          
                        in_update_by                =>  :updateBy
                    );
                END;
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':flightId', $this->flightId);
        $st->bindParam(':destination', $this->destination);
        $st->bindParam(':arrival', $this->arrival);
        $st->bindParam(':departure', $this->departure);
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

    public function deleteTransit()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_transits_delete
                    (
                        out_code            =>  :outCode,
                        out_msg             =>  :outMsg,
                        in_id               =>  :id,                                                                 
                        in_update_by        =>  :updateBy               
                    );
                END;";

        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
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

    public function getTransitBefore()
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
                        AND arrival_time <= TO_DATE(:arrival, 'DD-MM-YYYY HH24:MI')
                        AND status = 1
                    ORDER BY 
                        arrival_time DESC
                    )
                WHERE
                    rownum = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':flightId', $this->flightId);
        $st->bindParam(':arrival', $this->arrival);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getTransitAfter()
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
                        AND departure_time >= TO_DATE(:arrival, 'DD-MM-YYYY HH24:MI')
                        AND status = 1
                    ORDER BY 
                        departure_time ASC
                    )
                WHERE
                    rownum = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':flightId', $this->flightId);
        $st->bindParam(':arrival', $this->arrival);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getEditTransitBefore()
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
                        AND id != :id
                        AND arrival_time <= TO_DATE(:arrival, 'DD-MM-YYYY HH24:MI')
                        AND status = 1
                    ORDER BY 
                        arrival_time DESC
                    )
                WHERE
                    rownum = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':flightId', $this->flightId);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':arrival', $this->arrival);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getEditTransitAfter()
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
                        AND id != :id
                        AND departure_time >= TO_DATE(:arrival, 'DD-MM-YYYY HH24:MI')
                        AND status = 1
                    ORDER BY 
                        departure_time ASC
                    )
                WHERE
                    rownum = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':flightId', $this->flightId);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':arrival', $this->arrival);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getFlightTransit()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    id,
                    flight_id,
                    destination,
                    TO_CHAR(arrival_time, 'DD-MM-YYYY HH24:MI') AS arrival_time,
                    TO_CHAR(departure_time, 'DD-MM-YYYY HH24:MI') AS departure_time
                FROM
                    rico_ap_transits
                WHERE 
                    status = 1
                    AND flight_id = :flightId
                ORDER BY
                    arrival_time ASC
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':flightId', $this->flightId);
        $rows = $st->queryAll();

        return $rows;
    }

}
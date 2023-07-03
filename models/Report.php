<?php

namespace app\models;

use Yii;
use PDO;
use yii\base\Model;

class Report extends Model
{
    public $id;
    public $bookId;
    public $flightId;
    public $paymentId;
    public $seatTypeId;
    public $adultPassanger;
    public $childPassanger;
    public $additionalBaggage;
    public $totalTicket;
    public $totalPrice;
    public $x;
    public $y;
    public $passangersName;
    public $createBy;
    public $updateBy;
    public $errNum = 0;
    public $errStr = '';

    public function rules()
    {
        return [
            [['flightId', 'paymentId', 'seatTypeId', 'adultPassanger', 'childPassanger', 'additionalBaggage', 'totalTicket', 'totalPrice', 'x', 'y', 'passangersName', 'createBy'], 'required', 'on' => ['add-book']],
        ];
    }

    public function getBookReport()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    b.id,
                    f.id AS flight_id,
                    b.code,
                    TO_CHAR(b.create_time, 'DD-MM-YYYY') AS create_time,
                    (ra.name || ' - ' || ra.airplane_brand || ' - ' || ra.airplane_model) AS airplane_name,
                    (f.origin || ' - ' || f.destination) AS flight_route,
                    TO_CHAR(f.departure_time, 'DD-MM-YYYY HH24:MI') AS departure_time,
                    TO_CHAR(f.arrival_time, 'DD-MM-YYYY HH24:MI') AS arrival_time,
                    b.adult_passanger,
                    b.child_passanger,
                    b.total_ticket,
                    b.total_price,
                    p.name AS payment_method,
                    COUNT(t.id) AS total_transit
                FROM
                    rico_ap_books b
                    LEFT JOIN rico_ap_flights f ON b.flight_id = f.id
                    LEFT JOIN rico_ap_airplanes ra ON f.airplane_id = ra.id
                    LEFT JOIN rico_ap_payments p ON b.payment_id = p.id
                    LEFT JOIN rico_ap_transits t ON f.id = t.flight_id
                WHERE
                    b.status = 1
                GROUP BY
                    b.id,
                    f.id,
                    b.code,
                    b.create_time,
                    ra.name,
                    ra.airplane_brand,
                    ra.airplane_model,
                    f.origin,
                    f.destination,
                    f.departure_time,
                    f.arrival_time,
                    b.adult_passanger,
                    b.child_passanger,
                    b.total_ticket,
                    b.total_price,
                    p.name
                ORDER BY
                    b.id
                ";

        $st = $db->createCommand($sql);
        // $st->bindParam(':sessionId', $this->sessionId);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getTicket()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    t.x,
                    t.y,
                    t.name AS passanger_name,
                    rst.name
                FROM 
                    rico_ap_books b 
                    JOIN rico_ap_flights f ON f.id = b.flight_id
                    JOIN rico_ap_tickets t ON b.id = t.book_id
                    JOIN rico_ap_seat_types rst ON t.seat_type_id = rst.id
                WHERE 
                    b.id = :bookId
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':bookId', $this->bookId);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getSeatMap()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    ras.id,
                    ras.x,
                    ras.y,
                    ras.seat_type_id,
                    rst.name,
                    rst.color
                FROM
                    rico_ap_airplane_seats ras
                    JOIN rico_ap_seat_types rst ON ras.seat_type_id = rst.id
                WHERE
                    ras.airplane_id = :airplaneId
                    AND ras.seat_type_id = :seatTypeId
                    AND ras.status = 1
                ORDER BY
                    ras.x,
                    ras.y
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':airplaneId', $this->id);
        $st->bindParam(':seatTypeId', $this->seatTypeId);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getBookedSeat()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    id, 
                    flight_id,
                    x,
                    y
                FROM
                    rico_ap_tickets
                WHERE
                    flight_id = :flightId
                    AND seat_type_id = :seatTypeId
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':flightId', $this->flightId);
        $st->bindParam(':seatTypeId', $this->seatTypeId);
        $rows = $st->queryAll();

        return $rows;
    }

    public function addBook()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_books_insert
                    (
                        out_code                    =>  :outCode,
                        out_msg                     =>  :outMsg,
                        in_flight_id                =>  :flightId,                        
                        in_payment_id               =>  :paymentId,                        
                        in_seat_type_id             =>  :seatTypeId,                        
                        in_adult_passanger          =>  :adultPassanger,                        
                        in_child_passanger          =>  :childPassanger,                        
                        in_additional_baggage       =>  :additionalBaggage,                        
                        in_total_ticket             =>  :totalTicket,                        
                        in_total_price              =>  :totalPrice,                        
                        in_x                        =>  rico_arr_ap_seat_row_column(:x),                        
                        in_y                        =>  rico_arr_ap_seat_row_column(:y),                        
                        in_passangers_name          =>  rico_arr_ap_passanger_name(:passangersName),                      
                        in_create_by                =>  :createBy               
                    );
                END;";

        $this->replaceSQLArrayPlaceholder(':x', $this->x, $sql);
        $this->replaceSQLArrayPlaceholder(':y', $this->y, $sql);
        $this->replaceSQLArrayPlaceholder(':passangersName', $this->passangersName, $sql);
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':flightId', $this->flightId);
        $st->bindParam(':seatTypeId', $this->seatTypeId);
        $st->bindParam(':adultPassanger', $this->adultPassanger);
        $st->bindParam(':childPassanger', $this->childPassanger);
        $st->bindParam(':additionalBaggage', $this->additionalBaggage);
        $st->bindParam(':totalTicket', $this->totalTicket);
        $st->bindParam(':totalPrice', $this->totalPrice);
        $this->bindArraySQL(':x', $this->x, $st);
        $this->bindArraySQL(':y', $this->y, $st);
        $this->bindArraySQL(':passangersName', $this->passangersName, $st);
        $st->bindParam(':paymentId', $this->paymentId);
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

    public function replaceSQLArrayPlaceholder($attributeNameBind, $arrayValue, &$sql)
    {
        $attributeBind = [];
        $attributeBindString = '';

        if( !empty($arrayValue) ) {
            foreach( $arrayValue as $index => $attribute ) {
                $attributeBind[] = "$attributeNameBind$index";
            }
        }

        $attributeBindString = implode(',', $attributeBind);

        if( $attributeNameBind[0] == ':' ) {
            $attributeNameBind = substr($attributeNameBind, 1);
        }

        $sql = preg_replace('/:\b' . $attributeNameBind . '\b/', $attributeBindString, $sql);

        return true;
    }

    public function bindArraySQL($attributeNameBind, $arrayValue, $st)
    {
        if( !empty($arrayValue) ) {
            foreach( $arrayValue as $index => $value ) {            
                $st->bindParam( "$attributeNameBind$index", $arrayValue[$index] );
            }
        }

        return true;
    }
}
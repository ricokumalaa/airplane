<?php

namespace app\models;

use Yii;
use PDO;
use yii\base\Model;

class Seat extends Model
{
    public $id;
    public $name;
    public $color;
    public $createBy;
    public $updateBy;
    public $errNum = 0;
    public $errStr = '';

    public function rules()
    {
        return [
            [['name', 'color'], 'required', 'on' => ['add-seat-type', 'update-seat-type']],
            [['id'], 'required', 'on' => ['delete-seat-type']],
        ];
    }

    public function getAllSeatType()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    id,
                    name,
                    color
                FROM
                    rico_ap_seat_types
                WHERE 
                    status = 1
                ORDER BY
                    id
                ";

        $st = $db->createCommand($sql);
        // $st->bindParam(':sessionId', $this->sessionId);
        $rows = $st->queryAll();

        return $rows;
    }

    public function addSeatType()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_seat_types_insert
                    (
                        out_code            =>  :outCode,
                        out_msg             =>  :outMsg,
                        in_name             =>  :name,                        
                        in_color            =>  :color,                                                
                        in_create_by        =>  :createBy               
                    );
                END;";

        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':name', $this->name);
        $st->bindParam(':color', $this->color);
        $st->bindParam(':createBy', $this->createBy);

        $tr = $db->beginTransaction();
        $st->execute();

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

    public function updateSeatType()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_seat_types_update
                    (
                        out_code            =>  :outCode,
                        out_msg             =>  :outMsg,
                        in_id               =>  :id,                        
                        in_name             =>  :name,                        
                        in_color            =>  :color,                                                
                        in_update_by        =>  :updateBy               
                    );
                END;";

        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':name', $this->name);
        $st->bindParam(':color', $this->color);
        $st->bindParam(':updateBy', $this->updateBy);

        $tr = $db->beginTransaction();
        $st->execute();

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

    public function deleteSeatType()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_seat_types_delete
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
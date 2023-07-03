<?php

namespace app\models;

use Yii;
use PDO;
use yii\base\Model;

class Airplane extends Model
{
    public $id;
    public $name;
    public $brand;
    public $model;
    public $regis;
    public $color;
    public $seatType;
    public $seatTypeId;
    public $seatStatus;
    public $x;
    public $y;
    public $row;
    public $column;
    public $createBy;
    public $updateBy;
    public $seatToAdd;
    public $seatToRemove;
    public $errNum = 0;
    public $errStr = '';

    public function rules()
    {
        return [
            [['name', 'brand', 'model', 'regis', 'color', 'seatType', 'row', 'column'], 'required', 'on' => ['add-airplane', 'update-airplane']],
            [['id', 'x', 'y', 'seatStatus'], 'required', 'on' => ['set-seat']],
            [['id', 'updateBy'], 'required', 'on' => ['delete-airplane']],
        ];
    }

    public function getAllAirplane()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    a.id,
                    a.name,
                    a.airplane_brand,
                    a.airplane_model,
                    a.registration_number,
                    a.color,
                    a.max_row,
                    a.max_column,
                    LISTAGG(ast.seat_type_id, ', ') WITHIN GROUP (ORDER BY ast.seat_type_id) seat_type_id,
                    LISTAGG(st.name, ', ') WITHIN GROUP (ORDER BY st.id) seat_type_name,
                    LISTAGG(st.color, ', ') WITHIN GROUP (ORDER BY st.id) seat_type_color
                FROM
                    rico_ap_airplanes a
                    JOIN rico_ap_airplane_seat_types ast ON a.id = ast.airplane_id
                    JOIN rico_ap_seat_types st ON ast.seat_type_id = st.id
                WHERE 
                    a.status = 1
                GROUP BY
                    a.id,
                    a.name,
                    a.airplane_brand,
                    a.airplane_model,
                    a.registration_number,
                    a.color,
                    a.max_row,
                    a.max_column
                ORDER BY
                    a.id
                ";

        $st = $db->createCommand($sql);
        // $st->bindParam(':sessionId', $this->sessionId);
        $rows = $st->queryAll();

        return $rows;
    }

    public function addAirplane()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_airplanes_insert
                    (
                        out_code                    =>  :outCode,
                        out_msg                     =>  :outMsg,
                        in_name                     =>  :name,                        
                        in_airplane_brand           =>  :brand,                                               
                        in_airplane_model           =>  :model,                                               
                        in_registration_number      =>  :regis,                                               
                        in_color                    =>  :color,                                               
                        in_seat_type                =>  rico_arr_ap_seat_types(:seatType),                                               
                        in_max_row                  =>  :row,                                               
                        in_max_column               =>  :column,                                                                       
                        in_create_by                =>  :create_by               
                    );
                END;";
        
        $this->replaceSQLArrayPlaceholder(':seatType', $this->seatType, $sql);
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':name', $this->name);
        $st->bindParam(':brand', $this->brand);
        $st->bindParam(':model', $this->model);
        $st->bindParam(':regis', $this->regis);
        $st->bindParam(':color', $this->color);
        $st->bindParam(':row', $this->row);
        $st->bindParam(':column', $this->column);
        $this->bindArraySQL(':seatType', $this->seatType, $st);
        $st->bindParam(':create_by', $this->createBy);

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

    public function setSeat()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_airplanes_set_seats
                    (
                        out_code                    =>  :outCode,
                        out_msg                     =>  :outMsg,
                        in_airplane_id              =>  :airplaneId,                        
                        in_seat_type_id             =>  :seatTypeId,                                               
                        in_x                        =>  rico_arr_ap_max_row(:x),                                               
                        in_y                        =>  rico_arr_ap_max_column(:y),                                               
                        in_create_by                =>  :createBy,                                                                                                                      
                        in_update_by                =>  :updateBy               
                    );
                END;";
        
        $this->replaceSQLArrayPlaceholder(':x', $this->x, $sql);
        $this->replaceSQLArrayPlaceholder(':y', $this->y, $sql);
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':airplaneId', $this->id);
        $st->bindParam(':seatTypeId', $this->seatTypeId);
        $this->bindArraySQL(':x', $this->x, $st);
        $this->bindArraySQL(':y', $this->y, $st);
        $st->bindParam(':createBy', $this->createBy);
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

    public function disableSeat()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_ap_disable_seat
                    (
                        out_code                    =>  :outCode,
                        out_msg                     =>  :outMsg,
                        in_airplane_id              =>  :airplaneId,                        
                        in_seat_type_id             =>  :seatTypeId,                                               
                        in_x                        =>  rico_arr_ap_max_row(:x),                                               
                        in_y                        =>  rico_arr_ap_max_column(:y),                                               
                        in_create_by                =>  :createBy,                                                                                                                      
                        in_update_by                =>  :updateBy               
                    );
                END;";
        
        $this->replaceSQLArrayPlaceholder(':x', $this->x, $sql);
        $this->replaceSQLArrayPlaceholder(':y', $this->y, $sql);
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':airplaneId', $this->id);
        $st->bindParam(':seatTypeId', $this->seatTypeId);
        $this->bindArraySQL(':x', $this->x, $st);
        $this->bindArraySQL(':y', $this->y, $st);
        $st->bindParam(':createBy', $this->createBy);
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
                    AND ras.status = 1
                ORDER BY
                    ras.x,
                    ras.y
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':airplaneId', $this->id);
        $rows = $st->queryAll();

        return $rows;
    }

    public function getSeatType()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    seat_type_id AS id
                FROM
                    rico_ap_airplane_seat_types
                WHERE
                    airplane_id = :airplaneId
                    AND status = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':airplaneId', $this->id);
        $rows = $st->queryAll();

        return $rows;
    }

    public function updateAirplane()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_airplanes_update
                    (
                        out_code                    =>  :outCode,
                        out_msg                     =>  :outMsg,
                        in_id                       =>  :id,                        
                        in_name                     =>  :name,                        
                        in_airplane_brand           =>  :brand,                                               
                        in_airplane_model           =>  :model,                                               
                        in_registration_number      =>  :regis,                                               
                        in_color                    =>  :color,                                                                                        
                        in_max_row                  =>  :row,                                               
                        in_max_column               =>  :column,                                                                       
                        in_update_by                =>  :update_by               
                    );
                END;";
        
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':name', $this->name);
        $st->bindParam(':brand', $this->brand);
        $st->bindParam(':model', $this->model);
        $st->bindParam(':regis', $this->regis);
        $st->bindParam(':color', $this->color);
        $st->bindParam(':row', $this->row);
        $st->bindParam(':column', $this->column);
        $st->bindParam(':update_by', $this->updateBy);

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

    public function updateAirplaneSeatType()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_r_ap_ap_seat_types_update
                    (
                        out_code                    =>  :outCode,
                        out_msg                     =>  :outMsg,
                        in_id                       =>  :id,                                                                                             
                        in_seat_to_add              =>  rico_arr_ap_seat_to_add(:seat_to_add),                                                                                             
                        in_seat_to_remove           =>  rico_arr_ap_seat_to_remove(:seat_to_remove),                                                                                             
                        in_create_by                =>  :create_by               
                    );
                END;";
        
        $this->replaceSQLArrayPlaceholder(':seat_to_add', $this->seatToAdd, $sql);
        $this->replaceSQLArrayPlaceholder(':seat_to_remove', $this->seatToRemove, $sql);
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $this->bindArraySQL(':seat_to_add', $this->seatToAdd, $st);
        $this->bindArraySQL(':seat_to_remove', $this->seatToRemove, $st);
        $st->bindParam(':create_by', $this->createBy);

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

    public function deleteAirplane()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_airplanes_delete
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
            // $tr->rollback();
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
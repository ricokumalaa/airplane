<?php

namespace app\models;

use Yii;
use PDO;
use yii\base\Model;

class Payment extends Model
{
    public $id;
    public $paymentName;
    public $createBy;
    public $updateBy;
    public $errNum = 0;
    public $errStr = '';

    public function rules()
    {
        return [
            [['paymentName', 'createBy'], 'required', 'on' => ['add-payment']],
            [['id', 'paymentName', 'updateBy'], 'required', 'on' => ['update-payment']],
            [['id', 'updateBy'], 'required', 'on' => ['delete-payment']],
        ];
    }

    public function getAllPayment()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    id,
                    name
                FROM
                    rico_ap_payments
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

    public function addPayment()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_payments_insert
                    (
                        out_code            =>  :outCode,
                        out_msg             =>  :outMsg,
                        in_name             =>  :paymentName,                                            
                        in_create_by        =>  :createBy               
                    );
                END;";
        
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':paymentName', $this->paymentName);
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

    public function updatePayment()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_payments_update
                    (
                        out_code            =>  :outCode,
                        out_msg             =>  :outMsg,
                        in_id               =>  :id,                                           
                        in_name            =>  :paymentName,                                                                 
                        in_update_by        =>  :updateBy               
                    );
                END;";

        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':paymentName', $this->paymentName);
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

    public function deletePayment()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_payments_delete
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
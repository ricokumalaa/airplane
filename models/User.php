<?php

namespace app\models;

use Yii;
use PDO;
use yii\base\Model;

class User extends Model
{
    public $id;
    public $email;
    public $firstName;
    public $lastName;
    public $password;
    public $password_repeat;
    public $nik;
    public $phoneNumber;
    public $address;
    public $createBy;
    public $updateBy;
    public $errNum = 0;
    public $errStr = '';

    public function rules()
    {
        return [
            [['email', 'firstName', 'lastName', 'password', 'password_repeat', 'nik', 'phoneNumber', 'address'], 'required', 'on' => ['add-user']],
            [['password'], 'compare', 'on' => ['add-user']],
            [['email'], 'email', 'on' =>['add-user']],
            [['email', 'firstName', 'lastName', 'nik', 'phoneNumber', 'address'], 'required', 'on' => ['update-user']],
            [['id'], 'required', 'on' => ['delete-user']],
        ];
    }

    public function getAllUser()
    {
        $db = Yii::$app->db;

        $sql = "SELECT
                    id,
                    first_name,
                    last_name,
                    email,
                    nik,
                    phone_number,
                    address
                FROM
                    rico_ap_users
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

    public function addUser()
    {
        $db = Yii::$app->db;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $sql = "BEGIN
                    sp_rico_ap_users_insert
                    (
                        out_code            =>  :outCode,
                        out_msg             =>  :outMsg,
                        in_email            =>  :email,                        
                        in_password         =>  :password,                        
                        in_first_name       =>  :firstName,                        
                        in_last_name        =>  :lastName,                        
                        in_nik              =>  :nik,                        
                        in_phone_number     =>  :phoneNumber,                        
                        in_address          =>  :address,                        
                        in_create_by        =>  :createBy               
                    );
                END;";
        
        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':email', $this->email);
        $st->bindParam(':password', $this->password);
        $st->bindParam(':firstName', $this->firstName);
        $st->bindParam(':lastName', $this->lastName);
        $st->bindParam(':nik', $this->nik);
        $st->bindParam(':phoneNumber', $this->phoneNumber);
        $st->bindParam(':address', $this->address);
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

    public function updateUser()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_users_update
                    (
                        out_code            =>  :outCode,
                        out_msg             =>  :outMsg,
                        in_id               =>  :id,                                           
                        in_email            =>  :email,                                           
                        in_first_name       =>  :firstName,                        
                        in_last_name        =>  :lastName,                        
                        in_nik              =>  :nik,                        
                        in_phone_number     =>  :phoneNumber,                        
                        in_address          =>  :address,                        
                        in_update_by        =>  :updateBy               
                    );
                END;";

        $st = $db->createCommand($sql);
        $st->bindParam(':outCode', $this->errNum, PDO::PARAM_INT, 3);
        $st->bindParam(':outMsg', $this->errStr, PDO::PARAM_STR, 255);
        $st->bindParam(':id', $this->id);
        $st->bindParam(':email', $this->email);
        $st->bindParam(':firstName', $this->firstName);
        $st->bindParam(':lastName', $this->lastName);
        $st->bindParam(':nik', $this->nik);
        $st->bindParam(':phoneNumber', $this->phoneNumber);
        $st->bindParam(':address', $this->address);
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

    public function deleteUser()
    {
        $db = Yii::$app->db;

        $sql = "BEGIN
                    sp_rico_ap_users_delete
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
}
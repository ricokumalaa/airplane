<?php

namespace app\models;

use Yii;
use PDO;
use yii\base\Model;

class Signin extends Model
{
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'password'], 'required', 'on' => ['check-login']],
        ];
    }

    public function checkUser()
    {
        $db = Yii::$app->db;
        
        $sql = "SELECT
                    id,
                    first_name,
                    password
                FROM
                    rico_ap_users
                WHERE
                    email = :email
                    AND status = 1
                ";

        $st = $db->createCommand($sql);
        $st->bindParam(':email', $this->email);

        $tr = $db->beginTransaction();
        $rows = $st->queryAll();

        return $rows;
    }
}
<?php

namespace app\controllers;

use Yii;
// use yii\web\Controller;
use app\extensions\SessionController;
use app\models\User;

class UserController extends SessionController
{
    public function actionIndex()
    {
        if($this->sessionId == NULL)
        {
            $this->redirect(\Yii::$app->urlManager->createUrl("signin/"));
        }

        $this->layout = 'airplanenav';

        $user = new User();

        $userLists = $user->getAllUser();
        $sessionId = $this->sessionId;
        $sessionFirstName = $this->sessionFirstName;

        return $this->render('user', [
            'userLists' => json_encode($userLists),
            'sessionId' => json_encode($sessionId),
            'sessionFirstName' => json_encode($sessionFirstName)
        ]);
    }

    public function actionAdd()
    {
        $user = new User();

        $email = Yii::$app->request->getBodyParam('email');
        $firstName = Yii::$app->request->getBodyParam('firstName');
        $lastName = Yii::$app->request->getBodyParam('lastName');
        $password = Yii::$app->request->getBodyParam('password');
        $confPassword = Yii::$app->request->getBodyParam('confPassword');
        $nik = Yii::$app->request->getBodyParam('nik');
        $phoneNumber = Yii::$app->request->getBodyParam('phoneNumber');
        $address = Yii::$app->request->getBodyParam('address');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $user->email = $email;
        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->password = $password;
        $user->password_repeat = $confPassword;
        $user->nik = $nik;
        $user->phoneNumber = $phoneNumber;
        $user->address = $address;
        $user->createBy = $sessionId;
        $user->scenario = 'add-user';

        if($user->validate())
        {
            $addUserSummary = $user->addUser();
            $userLists = $user->getAllUser();

            return json_encode([
                $addUserSummary,
                $userLists
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

    public function actionUpdate()
    {
        $user = new User();

        $id = Yii::$app->request->getBodyParam('id');
        $email = Yii::$app->request->getBodyParam('email');
        $firstName = Yii::$app->request->getBodyParam('firstName');
        $lastName = Yii::$app->request->getBodyParam('lastName');
        $nik = Yii::$app->request->getBodyParam('nik');
        $phoneNumber = Yii::$app->request->getBodyParam('phone');
        $address = Yii::$app->request->getBodyParam('address');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $user->id = $id;
        $user->email = $email;
        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->nik = $nik;
        $user->phoneNumber = $phoneNumber;
        $user->address = $address;
        $user->updateBy = $sessionId;
        $user->scenario = 'update-user';

        if($user->validate())
        {   
            $updateUserSummary = $user->updateUser();
            $userLists = $user->getAllUser();

            return json_encode([
                $updateUserSummary,
                $userLists
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

    public function actionDelete()
    {
        $user = new User();

        $id = Yii::$app->request->getBodyParam('id');
        $sessionId = Yii::$app->request->getBodyParam('sessionId');

        $user->id = $id;
        $user->updateBy = $sessionId;
        $user->scenario = 'delete-user';

        if($user->validate())
        {   
            $deleteUserSummary = $user->deleteUser();
            $userLists = $user->getAllUser();
            // die(var_dump($userLists));
            return json_encode([
                $deleteUserSummary,
                $userLists
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